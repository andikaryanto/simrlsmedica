<?php

class Laboratorium extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('template');
        $this->load->Model('LaboratModel');
        $this->load->Model('UserModel');
        $this->load->Model('MainModel');
        $this->load->Model('ObatModel');
        $this->load->Model('PemeriksaanModel');
        $this->load->Model('AdministrasiModel');
        $this->load->Model('JenisLayananLaboratoirumModel');
        $this->load->Model('DetailPenyakitPemeriksaanModel');
        $this->load->Model('DokterModel');
        $this->load->Model('PasienModel');

        $this->load->helper(array('file', 'php_with_mpdf_helper'));
        $this->load->helper(array('file', 'mpdf'));
    }

    public function index()
    {
        redirect('Laboratorium/listLaborat');
    }

    public function listpemeriksaanPasien()
    {
        $id_laborat = '19';
        $data['jaminan'] = $this->config->item('pendaftaran');
        $data['listPendaftaran'] = [];

        $list = $this->PemeriksaanModel->getListPemeriksaanSudahPeriksaAwalByIdJenisPendaftaran($id_laborat)->result();
        foreach ($list as &$l) {
            if (!$l->sudah_periksa_perawat) { // hanya jika blm ada bhpnya
                $jl = $this->JenisLayananLaboratoirumModel->byIdPemeriksaan($l->id);
                $l->layanan = $jl;
                $data['listPendaftaran'][] = $l;
            }
        }

        $this->template->view('laboratorium/list_belum_diperiksa', $data);
    }

    public function periksaAwal($id)
    {
        $session = $this->session->userdata('logged_in');

        if ($this->input->post('submit') == 1) {
            $this->MainModel->update('pemeriksaan', [
                'sudah_obat' => 1,
                'sudah_periksa_perawat' => 1,
                'meta' => serialize([
                    'tgl_ambil_spesimen' => date('Y-m-d H:i:s')
                ])
            ], $id);
            $this->MainModel->hardDeleteWhere('detail_tindakan_pemeriksaan_lab', ['pemeriksaan_id', $id]);

            $input_tindakan = $this->input->post('tindakan');
            foreach ($input_tindakan as $key => $value) {
                $tindakan = array(
                    'pemeriksaan_id' => $id,
                    'jenis_layanan_id' => $value,
                    'creator' => $session->id
                );
                $this->MainModel->insert_id('detail_tindakan_pemeriksaan_lab', $tindakan);
            }

            $x=0;
            $jumlah_bahan = $_POST['qty'];
            foreach ($_POST['id'] ?? [] as $value) {
                $this->db->insert('detail_bahan_pemeriksaan', [
                    'pemeriksaan_id' => $id,
                    'bahan_id' => $value,
                    'jumlah' => $jumlah_bahan[$x],
                    'creator' => $session->id
                ]);
                $bahan = $this->ObatModel->getBahanById($value)->row();
                $stok = array('jumlah' => ($bahan->jumlah) - $jumlah_bahan[$x]);
                $this->MainModel->update('bahan_habis_pakai',$stok,$value);
                $x++;
            }

            $this->session->set_flashdata('success', 'Pemeriksaan pasien berhasil!');
            redirect('laboratorium/pemeriksaanLab');
        }
        else {
            $data['pendaftaran'] = $this->PemeriksaanModel->getPendaftaranByIdPemeriksaan($id)->row_array();
            $data['pemeriksaan'] = $this->PemeriksaanModel->getPemeriksaanById($id)->row_array();
            $data['jaminan'] = $this->config->item('pendaftaran');

            $data['obat'] = $this->PemeriksaanModel->getObat();
            $data['obat1'] = $this->db->get_where('obat', ['is_active' => 1, 'stok_obat >' => 0])->result();
            $data['bahan'] = $this->db->get_where('bahan_habis_pakai', ['is_active' => 1, 'jumlah >' => 0])->result();

            $category = 'umum';
            foreach ($this->config->item('poli') as $k => $v) {
                if (in_array($data['pendaftaran']['kode_daftar'], $v['kode'])) {
                    $category = $k;
                    break;
                }
            }

            $data['tindakan'] = $this->PemeriksaanModel->getTindakanByCategory($category);
            $data['jenis_layanan_lab'] = $this->JenisLayananLaboratoirumModel->get_all_children_and_paket();
            $data['selected_jenis_layanan_lab'] = $this->JenisLayananLaboratoirumModel->byIdPemeriksaan($data['pemeriksaan']['id']);

            $this->template->view('laboratorium/pemeriksaan_awal', $data);
        }
    }

    public function pengecekanAwal()
    {
        $data['listPemeriksaan'] = $this->PemeriksaanModel->getListPemeriksaanLaboratoriumSudahPeriksa()->result();
        foreach ($data['listPemeriksaan'] as &$datum) {
            $datum->layanan = $this->JenisLayananLaboratoirumModel->byIdPemeriksaan($datum->id);
        }

        $data['jaminan'] = $this->config->item('pendaftaran');

        $this->template->view('laboratorium/list_pasien_pengecekan_awal', $data);
    }

    public function pemeriksaanLab()
    {
        $id_laborat = '19';
        $list = $this->PemeriksaanModel->getListPemeriksaanSudahPeriksaAwalByIdJenisPendaftaran($id_laborat)->result();
        $data['listPemeriksaan'] = [];

        foreach ($list as &$datum) {
            $l = $this->JenisLayananLaboratoirumModel->byIdPemeriksaan($datum->id);
            if (count($l) > 0) {
                $datum->layanan = $l;
                $data['listPemeriksaan'][] = $datum;
            }
        }

        $data['jaminan'] = $this->config->item('pendaftaran');

        $this->template->view('laboratorium/list_pasien_pemeriksaan_lab', $data);
    }

    public function periksa($id) //'belum','sudah_periksa_awal','sudah_periksa','sudah_obat','sudah_bayar','bayar','selesai'
    {
        $layanan = $this->JenisLayananLaboratoirumModel->byIdPemeriksaan($id);

        $ids = array_map(function ($v) { return $v->parent_id; }, $layanan);
        $ids = implode(',', $ids);
        $parents = $this->db->query("SELECT * FROM jenis_layanan_laboratorium WHERE id IN($ids)")->result();
        foreach ($parents as &$parent) {
            if ($parent->is_paket)
                $parent->children = $this->JenisLayananLaboratoirumModel->byIdPemeriksaanAndIdparentPaket($id, $parent->id);
            else
                $parent->children = $this->JenisLayananLaboratoirumModel->byIdPemeriksaanAndIdparent($id, $parent->id);
        }

        if ($this->input->post('submit') == 1) {

            foreach ($parents as &$parent) {
                foreach ($parent->children as &$child) {
                    $child->result = $this->input->post('child_'.$child->id);
                }
            }

            $pem = $this->db->query("SELECT * FROM pemeriksaan WHERE id = $id")->row();
            $meta = unserialize($pem->meta);
            $meta['tgl_hasil_pemeriksaan'] = date('Y-m-d H:i:s');
            $this->MainModel->update('pemeriksaan', [
                'status' => 'sudah_periksa',
                'hasil_lab' => json_encode($parents),
                'meta' => serialize($meta)
            ], $id);

            $this->session->set_flashdata('success', 'Pemeriksaan pasien berhasil!');
            redirect('laboratorium/rekapitulasiLab');
        }
        else {
            $data['pendaftaran'] = $this->PemeriksaanModel->getPendaftaranByIdPemeriksaan($id)->row_array();
            $data['pemeriksaan'] = $this->PemeriksaanModel->getPemeriksaanById($id)->row_array();
            $data['parents'] = $parents;

            $this->template->view('laboratorium/periksa', $data);
        }
    }

    public function rekapitulasiLab()
    {
        $data['listPemeriksaan'] = $this->PemeriksaanModel->getListPemeriksaanLaboratoriumAfterPeriksa()->result();
        foreach ($data['listPemeriksaan'] as &$datum) {
            $datum->layanan = $this->JenisLayananLaboratoirumModel->byIdPemeriksaan($datum->id);
        }

        $data['jaminan'] = $this->config->item('pendaftaran');

        $this->template->view('laboratorium/list_pasien_rekapitulasi_lab', $data);
    }

    public function tarifDanLayanan($parent_id = 0)
    {
        if (!$parent_id) {
            $data['jenis_layanan_lab'] = $this->JenisLayananLaboratoirumModel->get_parents();
            $this->template->view('laboratorium/tarif_tindakan_list', $data);
        }
        else {
            $data['parent'] = $this->JenisLayananLaboratoirumModel->byId($parent_id);
            $data['jenis_layanan_lab'] = $this->JenisLayananLaboratoirumModel->get_children_of($parent_id);
            $this->template->view('laboratorium/tarif_tindakan_children_list', $data);
        }
    }

    public function tambahTarifDanLayanan($parent_id = 0)
    {
        if ($parent_id) {
            $data['parent'] = $this->JenisLayananLaboratoirumModel->byId($parent_id);
            $this->template->view('laboratorium/tarif_tindakan_children_input', $data);
        }
        else {
            $this->template->view('laboratorium/tarif_tindakan_input');
        }
    }

    public function editTarifDanLayanan($id, $is_parent = 0)
    {
        if ($is_parent) {
            $data['jenis_layanan_lab'] = $this->JenisLayananLaboratoirumModel->byId($id);
            $this->template->view('laboratorium/tarif_tindakan_input', $data);
        }
        else {
            $data['jenis_layanan_lab'] = $this->JenisLayananLaboratoirumModel->byId($id);
            $data['parent'] = $this->JenisLayananLaboratoirumModel->byId($data['jenis_layanan_lab']->parent_id);
            $this->template->view('laboratorium/tarif_tindakan_children_input', $data);
        }
    }

    public function simpanTarifDanLayanan()
    {
        $session = $this->session->userdata('logged_in');
        $TarifTindakan = array(
            'nama'               => $this->input->post('nama_tindakan'),
            'is_paket'           => (int) $this->input->post('is_paket'),
            'creator'            => $session->id,
        );

        if ((int) $this->input->post('is_paket')) {
            $TarifTindakan = array_merge($TarifTindakan, array(
                'tarif_owner'       => $this->input->post('tarif_owner'),
                'klinik'            => $this->input->post('klinik'),
                'tarif_karyawan'    => $this->input->post('tarif_karyawan'),
                'tarif_lain'        => $this->input->post('tarif_lain'),
                'tarif_dokter'      => $this->input->post('tarif_dokter'),
                'tarif_perawat'     => $this->input->post('tarif_perawat'),
                'tarif_analis'      => $this->input->post('tarif_analis'),
                'tarif_apoteker'    => $this->input->post('tarif_apoteker'),
                'tarif_pasien'      => $this->input->post('tarif_pasien'),
            ));
        }

        if ($this->input->post('id')) {
            $this->MainModel->update('jenis_layanan_laboratorium', $TarifTindakan, $this->input->post('id'));
            $this->session->set_flashdata('success', 'Data Layanan Laborat berhasil diedit!');
        }
        else {
            $this->MainModel->insert('jenis_layanan_laboratorium', $TarifTindakan);
            $this->session->set_flashdata('success', 'Data Layanan Laborat berhasil ditambahkan!');
        }

        redirect('laboratorium/tarifDanLayanan/');
    }

    public function simpanTarifDanLayananChildren()
    {
        $session = $this->session->userdata('logged_in');
        $TarifTindakan = array(
            'nama'               => $this->input->post('nama_tindakan'),
            'tarif_owner'       => $this->input->post('tarif_owner'),
            'klinik'            => $this->input->post('klinik'),
            'tarif_karyawan'    => $this->input->post('tarif_karyawan'),
            'tarif_lain'        => $this->input->post('tarif_lain'),
            'tarif_dokter'      => $this->input->post('tarif_dokter'),
            'tarif_perawat'     => $this->input->post('tarif_perawat'),
            'tarif_analis'      => $this->input->post('tarif_analis'),
            'tarif_apoteker'    => $this->input->post('tarif_apoteker'),
            'tarif_pasien'      => $this->input->post('tarif_pasien'),
            'satuan'             => $this->input->post('satuan'),
            'nilai_rujukan'      => $this->input->post('nilai_rujukan'),
            'creator'            => $session->id,
            'parent_id'  => $this->input->post('parent_id')
        );

        if ($this->input->post('id')) {
            $this->MainModel->update('jenis_layanan_laboratorium', $TarifTindakan, $this->input->post('id'));
            $this->session->set_flashdata('success', 'Data Layanan Laborat berhasil diedit!');
        }
        else {
            $this->MainModel->insert('jenis_layanan_laboratorium', $TarifTindakan);
            $this->session->set_flashdata('success', 'Data Layanan Laborat berhasil ditambahkan!');
        }

        redirect('laboratorium/tarifDanLayanan/'.$this->input->post('parent_id'));
    }

    public function deleteTarifDanLayanan($id)
    {
        $delete = $this->MainModel->delete('jenis_layanan_laboratorium', ['is_active' => '0'], $id);
        if ($delete) {
            $this->session->set_flashdata('success', 'Data Laborat berhasil dihapus!');
            redirect('laboratorium/tarifDanLayanan');
        }
        $this->session->set_flashdata('warning', 'Data Laborat gagal dihapus!');
        redirect('laboratorium/tarifDanLayanan');
    }

    // ---------------------------------------------------------

    public function listLaborat()
    {
        $data['listLaborat'] = $this->LaboratModel->listLaborat();
        $this->template->view('master/laboratorium/list_laborat_v', $data);
    }

    public function add_laborat()
    {
        $data['grup'] = $this->UserModel->getGrup()->result();
        $this->template->view('master/laboratorium/add_laborat', $data);
    }

    public function simpan_addlaborat()
    {
        $sesi = $this->session->userdata('logged_in');
        $user = array(
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
            'password_ori' => $this->input->post('password'),
            'telepon' => $this->input->post('telepon'),
            'creator' => $sesi->id
        );
        $user_id = $this->MainModel->insert_id('user', $user);
        $user_grup = array(
            'grup_id' => 13,
            'user_id' => $user_id,
            'creator' => $sesi->id
        );
        $b = $this->MainModel->insert('user_grup', $user_grup);

        if ($b) {
            $this->session->set_flashdata('success', 'Berhasil menambahkan laborat!');
            redirect('Laboratorium/listLaborat');
        }

        $this->session->set_flashdata('warning', 'Gagal menambahkan laborat!');
        redirect('Laboratorium/listLaborat');
    }

    public function edit($id)
    {
        $data['user'] = $this->UserModel->getUserById($id)->row();
        $data['grup'] = $this->UserModel->getGrup()->result();

        $this->template->view('master/laboratorium/editlaborat_v', $data);
    }

    public function simpanUpdate()
    {
        $sesi = $this->session->userdata('logged_in');

        $config1['upload_path'] = FCPATH . 'assets/img/profil';
        $config1['allowed_types'] = 'gif|jpg|png';
        //$config1['file_name'] = $this->input->post('username').'.jpg';
        $config1['overwrite'] = TRUE;
        $config1['max_size'] = 2048000;
        $this->load->library('upload', $config1);

        $id = $this->input->post('id');

        if ($this->upload->do_upload('foto')) {

            $user = array(
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'password_ori' => $this->input->post('password'),
                'telepon' => $this->input->post('telepon'),
                'foto' => $this->upload->data('file_name'),
                'creator' => $sesi->id
            );
            $a = $this->MainModel->update($tabel = 'user', $user, $id);

            if ($a) {
                $this->session->set_flashdata('success', 'Data Laborat berhasil update!');
                redirect('laboratorium/listLaborat');
            }

        } else {
            $user = array(
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'password_ori' => $this->input->post('password'),
                'telepon' => $this->input->post('telepon'),
                'creator' => $sesi->id
            );
            $a = $this->MainModel->update($tabel = 'user', $user, $id);
            if ($a) {
                $this->session->set_flashdata('success', 'Data Laborat berhasil update!');
                redirect('laboratorium/listLaborat');
            }
        }
        $this->session->set_flashdata('warning', 'Data Laborat gagal update!');
        redirect('laboratorium/listLaborat');
    }

    public function delete_laborat($id)
    {
        $data = array('is_active' => '0');
        $delete = $this->MainModel->delete($table = 'user', $data, $id);
        if ($delete) {
            $this->session->set_flashdata('success', 'Data Laborat berhasil dihapus!');
            redirect('laboratorium/listLaborat');
        }
        $this->session->set_flashdata('warning', 'Data Laborat gagal dihapus!');
        redirect('laboratorium/listLaborat');
    }

    public function detail($id)
    {
        $data['pendaftaran'] = $this->PemeriksaanModel->getPendaftaranByIdPemeriksaan($id)->row_array();
        $data['pemeriksaan'] = $this->PemeriksaanModel->getPemeriksaanById($id)->row_array();
        $data['layanan'] = $this->JenisLayananLaboratoirumModel->byIdPemeriksaan($id);//die(json_encode($data['pendaftaran']));

        $this->template->view('laboratorium/detail', $data);
    }

    private $l = '[{"children" : [{"id" : "hemoglobin", "name" : "Hemoglobin", "normal_value" : "P:13.0 - 16.0 | W:12.0 - 14.0", "satuan" : "g/dL"}, {"id" : "led", "name" : "LED 1jam/2jam", "normal_value" : "P < 10 | W < 15", "satuan" : "mm/j"}, {"id" : "leukosit", "name" : "Leukosit", "normal_value" : "5000-10000", "satuan" : "10³/µL"}, {"id" : "hitung", "name" : "Hitung Jenis", "normal_value" : "", "satuan" : ""}, {"id" : "eosinophyl", "name" : "Eosinophyl", "normal_value" : "1-3", "satuan" : "%"}, {"id" : "basophyl", "name" : "Basophyl", "normal_value" : "0-1", "satuan" : "%"}, {"id" : "stab", "name" : "Stab", "normal_value" : "2-6", "satuan" : "%"}, {"id" : "segment", "name" : "Segment", "normal_value" : "50-70", "satuan" : "%"}, {"id" : "lymposit", "name" : "Lymposit", "normal_value" : "20-40", "satuan" : "%"}, {"id" : "monosit", "name" : "Monosit", "normal_value" : "2-8", "satuan" : "%"}, {"id" : "sel_lainnya", "name" : "Sel Lainnya", "normal_value" : "", "satuan" : ""}, {"id" : "eosinofil", "name" : "Eosinofil", "normal_value" : "50-300", "satuan" : "/cmm"}, {"id" : "eritrosit", "name" : "Erytrosit", "normal_value" : "P:4.5 - 5.5 | W:4.0 - 5.0", "satuan" : "10^6/µL"}, {"id" : "trombocyt", "name" : "Trombocyt", "normal_value" : "150.000 - 500.000", "satuan" : "10³/µL"}, {"id" : "reticulocyt", "name" : "Reticulocyt", "normal_value" : "0.5-1.5", "satuan" : "%"}, {"id" : "hematacrit", "name" : "Hematacrit", "normal_value" : "P:40-48% | W:37-43% | A:31-47%", "satuan" : "%"}, {"id" : "mcv", "name" : "MCV", "normal_value" : "82-92", "satuan" : "fL"}, {"id" : "mch", "name" : "MCH", "normal_value" : "27-31", "satuan" : "Pikogram"}, {"id" : "mchc", "name" : "MCHC", "normal_value" : "32-36", "satuan" : "g/dL"}, {"id" : "waktu_pendarahan", "name" : "Waktu Pendarahan", "normal_value" : "1-3", "satuan" : "menit"}, {"id" : "waktu_pembekuan", "name" : "Waktu Pembekuan", "normal_value" : "10-15", "satuan" : "menit"}, {"id" : "waktu_prothombin", "name" : "Waktu Prothombin", "normal_value" : "11-14", "satuan" : "detik"}, {"id" : "waktu_rkalsifikasi", "name" : "Waktu Rekalsifikasi", "normal_value" : "100-250", "satuan" : "detik"}, {"id" : "ptt", "name" : "PTT", "normal_value" : "30-40", "satuan" : "detik"}, {"id" : "thrombotes_owren", "name" : "Thrombotes Owren", "normal_value" : "70-100", "satuan" : "%"}, {"id" : "fibrinogen", "name" : "Fibrinogen", "normal_value" : "200-400", "satuan" : "mg/dL"}, {"id" : "retraksi_bekuan", "name" : "Retraksi Bekuan", "normal_value" : "40-60", "satuan" : "%"}, {"id" : "retraksi_osmotik", "name" : "Retraksi Osmotik", "normal_value" : "0.40-0.30", "satuan" : "%"}, {"id" : "malaria", "name" : "Malaria", "normal_value" : "", "satuan" : ""}, {"id" : "plasmodium_falcifarum", "name" : "Plasmodium Falcifarum", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "plasmodium_vivax", "name" : "Plasmodium Vivax", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "prc_pembendungan", "name" : "Prc Pembendungan", "normal_value" : "Pethecia < 10", "satuan" : ""}, {"id" : "darah_lengkap", "name" : "Darah Lengkap", "normal_value" : "", "satuan" : ""}, {"id" : "rdw_cv", "name" : "RDW-CV", "normal_value" : "11.5-14.5", "satuan" : "%"}, {"id" : "rdw_sd", "name" : "RDW-SD", "normal_value" : "35-56", "satuan" : "fL"}, {"id" : "mpv", "name" : "MPV", "normal_value" : "7-11", "satuan" : "fL"}, {"id" : "pdw", "name" : "PDW", "normal_value" : "15-17", "satuan" : ""}, {"id" : "pct", "name" : "PCT", "normal_value" : "0.108-0.282", "satuan" : "%"}, {"id" : "limfosit", "name" : "Limfosit", "normal_value" : "", "satuan" : ""}, {"id" : "analisa_hb", "name" : "Analisa HB (HPLC)", "normal_value" : "", "satuan" : ""}, {"id" : "analisa_hb", "name" : "Analisa HB (HPLC)", "normal_value" : "", "satuan" : "%"}, {"id" : "hba2", "name" : "HbA2", "normal_value" : "2.0-3.6%", "satuan" : "%"}, {"id" : "hbf", "name" : "HbF", "normal_value" : "< 1%", "satuan" : ""}, {"id" : "ferritin", "name" : "Ferritin", "normal_value" : "13-150", "satuan" : ""}, {"id" : "tibc", "name" : "TIBC", "normal_value" : "260-389", "satuan" : ""}, {"id" : "pt", "name" : "PT", "normal_value" : "10.70-14.30", "satuan" : "detik"}, {"id" : "aptt", "name" : "APTT", "normal_value" : "21.00-36.50", "satuan" : "detik"}, {"id" : "inr", "name" : "INR", "normal_value" : "0.8-1.2", "satuan" : ""}], "index" : 1, "name" : "Hematologi"}, {"children" : [{"id" : "ureum_darah", "name" : "Ureum Darah", "normal_value" : "10-50", "satuan" : "mg/100 ml"}, {"id" : "ureum_urin", "name" : "Ureum Urin", "normal_value" : "20-35", "satuan" : "g/24 jam"}, {"id" : "creatine_darah", "name" : "Creatine Darah", "normal_value" : "0.7-1.7", "satuan" : "mg/100 ml"}, {"id" : "creatine_urine", "name" : "Creatine Urine", "normal_value" : "1-3", "satuan" : "g/24 jam"}, {"id" : "creatine_clearence", "name" : "Creatine Clearence", "normal_value" : "117+20", "satuan" : "ml/menit"}, {"id" : "urea_clearence", "name" : "Urea Clearence", "normal_value" : "70-100", "satuan" : "ml/menit"}, {"id" : "alkali_reserve", "name" : "Alkali Reserve", "normal_value" : "24-31", "satuan" : "mEG/l"}, {"id" : "fosfat_anorganik", "name" : "Fosfat Anorganik", "normal_value" : "2-4 (dewasa) | 5-6 (anak)", "satuan" : "mg/100ml"}, {"id" : "uric_acid", "name" : "Uric Acid", "normal_value" : "P:3.4-7.0 | W:2.4-5.7", "satuan" : "mg/100ml"}, {"id" : "serum_iron", "name" : "Serum Iron", "normal_value" : "P:53-167 | W:49-151", "satuan" : "µg/100 ml"}, {"id" : "tibc", "name" : "TIBC", "normal_value" : "280-400", "satuan" : "µg/100 ml"}], "index" : 2, "name" : "FUNGSI GINJAL"}, {"children" : [{"id" : "bilirudin_total", "name" : "Bilirudin Total", "normal_value" : "0.3-1.0", "satuan" : "mg/100 ml"}, {"id" : "bilirudin_direk", "name" : "Bilirudin Direk", "normal_value" : "sd 0.4", "satuan" : "mg/100 ml"}, {"id" : "bilirudin_indirek", "name" : "Bilirudin Indirek", "normal_value" : "sd 0.6", "satuan" : "mg/100 ml"}, {"id" : "protein_total", "name" : "Protein Total", "normal_value" : "6.8 - 8.7", "satuan" : "g/100 ml"}, {"id" : "albumin", "name" : "Albumin", "normal_value" : "3.8 - 5.1", "satuan" : "g/100 ml"}, {"id" : "sgot", "name" : "SGOT", "normal_value" : "P:s/d 37 | W:s/d 31", "satuan" : "µ/l"}, {"id" : "sgpt", "name" : "SGPT", "normal_value" : "P:s/d 40 | W:s/d 31", "satuan" : "µ/l"}, {"id" : "gamma_gt", "name" : "Gamma GT", "normal_value" : "11-61", "satuan" : "µ/l"}, {"id" : "askali_fosfatase", "name" : "Askali Fosfatase", "normal_value" : "34-114", "satuan" : "µ/l"}, {"id" : "chollinesterase", "name" : "Chollinesterase (CHE)", "normal_value" : "4620-11500", "satuan" : "µ/l"}], "index" : 3, "name" : "FUNGSI HATI"}, {"children" : [{"id" : "ck", "name" : "CK", "normal_value" : "W:24-170", "satuan" : "µ/l"}, {"id" : "ldh", "name" : "LDH", "normal_value" : "<480", "satuan" : "µ/l"}, {"id" : "ck_m8", "name" : "Ck-M8", "normal_value" : "<25", "satuan" : "µ/l"}, {"id" : "alpha_hbdh", "name" : "Alpha HBDH", "normal_value" : "65-165", "satuan" : "µ/l"}, {"id" : "globulin", "name" : "Globulin", "normal_value" : "1.5-3.6", "satuan" : "g/100 ml"}], "index" : 4, "name" : "FUNGSI JANTUNG"}, {"children" : [{"id" : "gula_darah_puasa", "name" : "Gula Darah Puasa", "normal_value" : "70-100", "satuan" : "mg %"}, {"id" : "reduksi", "name" : "Reduksi", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "gula_darah_2jam", "name" : "Gula Darah 2 jam PP", "normal_value" : "<=140", "satuan" : "mg %"}, {"id" : "reduksi_2", "name" : "Reduksi", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "gula_darah_sewaktu", "name" : "Gula Darah Sewaktu", "normal_value" : "<=180", "satuan" : "mg %"}, {"id" : "gtt_puasa", "name" : "GTT:Puasa", "normal_value" : "70-100", "satuan" : "mg %"}, {"id" : "gtt_1/2jam", "name" : "GTT:1/2jam", "normal_value" : "110-170", "satuan" : "mg %"}, {"id" : "gtt_1jam", "name" : "GTT:1jam", "normal_value" : "120-170", "satuan" : "mg %"}, {"id" : "gtt_11/2jam", "name" : "GTT:1 1/2jam", "normal_value" : "100-140", "satuan" : "mg %"}, {"id" : "gtt_2jam", "name" : "GTT:2jam", "normal_value" : "20-120", "satuan" : "mg %"}, {"id" : "hb_A-1c", "name" : "Hb A1-C", "normal_value" : "4.2-7.0", "satuan" : "%"}, {"id" : "ii", "name" : "II", "normal_value" : "4-7", "satuan" : "unit"}], "index" : 5, "name" : "GULA DARAH"}, {"children" : [{"id" : "cholesterol_total", "name" : "Cholesterol Total", "normal_value" : "150-200", "satuan" : "mg/100 ml"}, {"id" : "hdl_cholesterol", "name" : "HDL Cholesterol", "normal_value" : "P:35-55 | W:45-65", "satuan" : "mg/100 ml"}, {"id" : "ldl_cholesterol", "name" : "LDL Cholesterol", "normal_value" : "100-130", "satuan" : "mg/100 ml"}, {"id" : "triglycerida", "name" : "Triglycerida", "normal_value" : "40-155", "satuan" : "mg/100 ml"}, {"id" : "lipid_total", "name" : "Lipid Total", "normal_value" : "600-1000", "satuan" : "mg/100 ml"}, {"id" : "cholesterol_ldl_direk", "name" : "Cholesterol LDL Direk", "normal_value" : "<140", "satuan" : "mg/100 ml"}], "index" : 6, "name" : "PROFIL LEMAK"}, {"children" : [{"id" : "natrium", "name" : "Natrium", "normal_value" : "135-147", "satuan" : "mEg/l"}, {"id" : "kalium", "name" : "Kalium", "normal_value" : "3.5-5.5", "satuan" : "mEg/l"}, {"id" : "chlorida", "name" : "Chlorida", "normal_value" : "96-106", "satuan" : "mEg/l"}, {"id" : "calsium", "name" : "Calsium", "normal_value" : "8.1-10.4", "satuan" : "mg/100 ml"}, {"id" : "magnesium", "name" : "Magnesium", "normal_value" : "1.58 - 2.55", "satuan" : "mg/dl"}], "index" : 7, "name" : "ELEKTROLIT dan GAS DARAH"}, {"children" : [{"id" : "pengecatan_gram", "name" : "Pengecatan Gram", "normal_value" : "", "satuan" : ""}, {"id" : "bta", "name" : "BTA", "normal_value" : "", "satuan" : ""}, {"id" : "mikroskopik_gonore", "name" : "Mikroskopik Gonorhe", "normal_value" : "", "satuan" : ""}, {"id" : "trikomonas", "name" : "Trikomonas", "normal_value" : "", "satuan" : ""}, {"id" : "jamur", "name" : "Jamur", "normal_value" : "", "satuan" : ""}, {"id" : "kultur_sensitivitas", "name" : "Kultur dan Sensitifitas Tes", "normal_value" : "", "satuan" : ""}, {"id" : "batang_gram-", "name" : "Batang Gram-", "normal_value" : "", "satuan" : ""}, {"id" : "batang_gram+", "name" : "Batang Gram+", "normal_value" : "", "satuan" : ""}, {"id" : "coccus_gram-", "name" : "Coccus Gram-", "normal_value" : "", "satuan" : ""}, {"id" : "coccus_gram+", "name" : "Coccus Gram+", "normal_value" : "", "satuan" : ""}, {"id" : "trichomonas", "name" : "Trichomonas", "normal_value" : "", "satuan" : ""}, {"id" : "mikroskopik_candida", "name" : "Mikroskopik Candida", "normal_value" : "", "satuan" : ""}], "index" : 8, "name" : "MIKROBIOLOGI"}, {"children" : [{"id" : "widal", "name" : "Widal", "normal_value" : "", "satuan" : ""}, {"id" : "salmonela_typhi_O", "name" : "Salmonela Typhi O", "normal_value" : "Negatif -", "satuan" : ""}, {"id" : "salmonela_typhi_h", "name" : "Salmonela Typhi H", "normal_value" : "Negatif -", "satuan" : ""}, {"id" : "salmonela_paratyphi_a_h", "name" : "Salmonela Paratyphi A-H", "normal_value" : "Negatif -", "satuan" : ""}, {"id" : "salmonela_paratyphi_ao", "name" : "Salmonela Paratyphi AO", "normal_value" : "Negatif -", "satuan" : ""}, {"id" : "salmonela_paratyphi_bo", "name" : "Salmonela Paratyphi BO", "normal_value" : "Negatif -", "satuan" : ""}, {"id" : "salmonela_paratyphi_co", "name" : "Salmonela Paratyphi CO", "normal_value" : "Negatif -", "satuan" : ""}, {"id" : "salmonela_paratyphi_bh", "name" : "Salmonela Paratyphi BH", "normal_value" : "Negatif -", "satuan" : ""}, {"id" : "salmonela_paratyphi_ch", "name" : "Salmonela Paratyphi CH", "normal_value" : "Negatif -", "satuan" : ""}, {"id" : "hbsag", "name" : "HBsAg", "normal_value" : "0.13", "satuan" : "ng/ml"}, {"id" : "hiv", "name" : "HIV", "normal_value" : "", "satuan" : ""}, {"id" : "tpha", "name" : "TPHA", "normal_value" : "", "satuan" : ""}, {"id" : "rhematoid_factor", "name" : "Rhematoid Factor", "normal_value" : "", "satuan" : ""}, {"id" : "dengue_ig_g", "name" : "Dengue Ig G", "normal_value" : "", "satuan" : ""}, {"id" : "dengue_ig_m", "name" : "Dengue Ig M", "normal_value" : "", "satuan" : ""}, {"id" : "anti_hbsag", "name" : "Anti HBsAg", "normal_value" : "Negatif < 8 | Positif > 12", "satuan" : "mIU/ml"}, {"id" : "antihbc_total", "name" : "Anti-HBc Total", "normal_value" : "Positif < 1.0 | Negatif => 1.40", "satuan" : "Index"}, {"id" : "hbc", "name" : "HBc", "normal_value" : "", "satuan" : ""}, {"id" : "anti_tb_ig_m", "name" : "Anti TB Ig M", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "anti_tb_ig_g", "name" : "Anti TB Ig G", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "hcv", "name" : "HCV", "normal_value" : "", "satuan" : ""}, {"id" : "anti_hev_ig_m", "name" : "Anti HEV Ig M", "normal_value" : "", "satuan" : ""}, {"id" : "anti_hev_ig_g", "name" : "Anti HEV Ig G", "normal_value" : "", "satuan" : ""}, {"id" : "hbeag", "name" : "HBeAg", "normal_value" : "Negativ < 0.10 | Positif => 0.10", "satuan" : "Index"}, {"id" : "anti_hbe", "name" : "Anti HBe", "normal_value" : "", "satuan" : ""}, {"id" : "vdrl", "name" : "VDRL", "normal_value" : "non reaktif", "satuan" : ""}, {"id" : "asto", "name" : "ASTO", "normal_value" : "", "satuan" : ""}], "index" : 9, "name" : "SEROIMONOLOGI"}, {"children" : [{"id" : "titer_reumatoid_factor", "name" : "Titer Reumatoid Factor", "normal_value" : "Negatif: < 8", "satuan" : ""}, {"id" : "anti_hav_igm", "name" : "Anti HAV IgM", "normal_value" : "Negatif < 0.4 | Positif =>0.5", "satuan" : ""}, {"id" : "anti_hcv", "name" : "Anti HCV", "normal_value" : "", "satuan" : ""}, {"id" : "toxoplasma_ig_a", "name" : "Toxoplasma Ig A", "normal_value" : "", "satuan" : ""}, {"id" : "toxoplasma_ig_g", "name" : "Toxoplasma Ig G", "normal_value" : "Negatif < 4 | Positif => 8", "satuan" : ""}, {"id" : "toxoplasma_ig_g", "name" : "Toxoplasma Ig G", "normal_value" : "Negatif < 4 | Positif => 8", "satuan" : ""}, {"id" : "toxoplasma_ig_m", "name" : "Toxoplasma Ig M", "normal_value" : "Negatif < 0.55 | Positif => 0.65", "satuan" : ""}, {"id" : "rubella_ig_g", "name" : "Rubella Ig G", "normal_value" : "Negatif < 10 | Positif => 15", "satuan" : ""}, {"id" : "rubella_ig_m", "name" : "Rubella Ig M", "normal_value" : "Negatif < 0.80 | Positif => 1.20", "satuan" : ""}, {"id" : "anti_cmv_ig_g", "name" : "Anti CMV Ig G", "normal_value" : "Negatif < 4 | Positif => 6", "satuan" : ""}, {"id" : "anti_cmv_ig_m", "name" : "Anti CMV Ig M", "normal_value" : "Negatif < 0.7 | Positif => 0.9", "satuan" : ""}, {"id" : "anti_hsv2_ig_g", "name" : "Anti HSV2 Ig G", "normal_value" : "Negatif < 0.8 | Positif => 1.1", "satuan" : ""}, {"id" : "anti_hsv2_ig_m", "name" : "Anti HSV2 Ig M", "normal_value" : "Negatif < 0.8 | Positif => 1.1", "satuan" : ""}, {"id" : "tb_ict", "name" : "TB ICT", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "tes_mantaoux", "name" : "Tes Mantoux", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "dengue_ns1", "name" : "Dengue NS1", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "anti_hbsag", "name" : "Anti HBsAg", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "chikungunya_igm", "name" : "Chikungunya IgM", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "salmonella_igg", "name" : "Salmonella IgG", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "salmonella_igm", "name" : "Salmonella IgM", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "serum_iron", "name" : "Serum Iron NS1", "normal_value" : "62-173", "satuan" : ""}, {"id" : "ca_125", "name" : "CA 125", "normal_value" : "< 35", "satuan" : ""}, {"id" : "leptospora_igm", "name" : "Leptospira_IgM", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "tpha", "name" : "TPHA", "normal_value" : "Non Reaktif", "satuan" : ""}, {"id" : "hbsag", "name" : "HBsAg", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "igm_anti_salmonella_typhi", "name" : "IgM Anti Salmonella Typhi", "normal_value" : "Negatif <= 2 | Borderline:3", "satuan" : ""}, {"id" : "anti_hbs_titer", "name" : "Anti Hbs Titer", "normal_value" : "Negatif < 10 | Positif => 10", "satuan" : ""}], "index" : 10, "name" : "CRP"}, {"children" : [{"id" : "urin_rutin", "name" : "Urin Rutin", "normal_value" : "", "satuan" : ""}, {"id" : "fisis_warna", "name" : "Fisis Warna", "normal_value" : "", "satuan" : ""}, {"id" : "kejernihan", "name" : "Kejernihan", "normal_value" : "", "satuan" : ""}, {"id" : "bau", "name" : "Bau", "normal_value" : "", "satuan" : ""}, {"id" : "kimia_ph", "name" : "Kimia PH", "normal_value" : "", "satuan" : ""}, {"id" : "berat_jenis", "name" : "Berat Jenis", "normal_value" : "", "satuan" : ""}, {"id" : "protein", "name" : "Protein", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "glukosa", "name" : "Glukosa", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "urobillinogen", "name" : "Urobillinogen", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "billirudin", "name" : "Billirudin", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "keton", "name" : "Keton", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "lekosit_esterase", "name" : "Lekosit Esterase", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "nitrit", "name" : "Nitrit", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "blood", "name" : "Blood", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "sedimen_epitel", "name" : "Sedimen Epitel", "normal_value" : "", "satuan" : "/LPK"}, {"id" : "lekosit", "name" : "Lekosit", "normal_value" : "", "satuan" : "/LPB"}, {"id" : "erystrosit", "name" : "Erytrosit", "normal_value" : "", "satuan" : "/LPB"}, {"id" : "silinder_granula", "name" : "Silinder Granula", "normal_value" : "", "satuan" : ""}, {"id" : "silinder_lekosit", "name" : "Silinder Lekosit", "normal_value" : "", "satuan" : ""}, {"id" : "kristal", "name" : "Kristal", "normal_value" : "", "satuan" : ""}, {"id" : "bakteri", "name" : "Bakteri", "normal_value" : "", "satuan" : ""}, {"id" : "trikomonas", "name" : "Trikomonas", "normal_value" : "", "satuan" : ""}, {"id" : "candida", "name" : "Candida", "normal_value" : "", "satuan" : ""}, {"id" : "silinder_eritrosit", "name" : "Silinder Eritrosit", "normal_value" : "", "satuan" : ""}, {"id" : "silinder_hyalin", "name" : "Silinder Hyalin", "normal_value" : "", "satuan" : ""}], "index" : 11, "name" : "URINALISA"}, {"children" : [{"id" : "warnar", "name" : "Warna", "normal_value" : "Khas", "satuan" : ""}, {"id" : "bau", "name" : "Bau", "normal_value" : "", "satuan" : ""}, {"id" : "konsistensi", "name" : "Konsistensi", "normal_value" : "", "satuan" : ""}, {"id" : "mikroskopis", "name" : "Mikroskopis", "normal_value" : "", "satuan" : ""}, {"id" : "telur_cacing", "name" : "Telur Cacing", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "amuba", "name" : "Amuba", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "sisa_pencernaan", "name" : "Sisa Pencernaan", "normal_value" : "", "satuan" : ""}, {"id" : "Protein", "name" : "Protein", "normal_value" : "", "satuan" : ""}, {"id" : "lemak", "name" : "Lemak", "normal_value" : "", "satuan" : ""}, {"id" : "karbohidrat", "name" : "Karbohidrat", "normal_value" : "", "satuan" : ""}, {"id" : "bensidin_test", "name" : "Bensidin Test", "normal_value" : "", "satuan" : ""}], "index" : 12, "name" : "FESES"}, {"children" : [{"id" : "metode", "name" : "Metode", "normal_value" : "", "satuan" : ""}, {"id" : "abstinensia", "name" : "Abstinensia", "normal_value" : "", "satuan" : ""}, {"id" : "dikeluarkan_jam", "name" : "Dikeluarkan Jam", "normal_value" : "", "satuan" : ""}, {"id" : "diterima_di_lab_jam", "name" : "Diterima di lab jam", "normal_value" : "", "satuan" : ""}, {"id" : "diperiksa_jam", "name" : "Diperiksa jam", "normal_value" : "", "satuan" : ""}, {"id" : "i_makroskopis", "name" : "I MAKROSKOPIS", "normal_value" : "", "satuan" : ""}, {"id" : "warna", "name" : "Warna", "normal_value" : "Putih Abu-Abu", "satuan" : ""}, {"id" : "liquefaksi", "name" : "Liquefaksi", "normal_value" : "< 60 menit", "satuan" : ""}, {"id" : "konsistensi", "name" : "Konsistensi", "normal_value" : "Encer", "satuan" : ""}, {"id" : "bau", "name" : "Bau", "normal_value" : "Khas", "satuan" : ""}, {"id" : "volume", "name" : "Volume", "normal_value" : "=> 2ml", "satuan" : ""}, {"id" : "ph", "name" : "PH", "normal_value" : "7.2 - 7.8", "satuan" : ""}, {"id" : "ii_mikroskopis", "name" : "II Mikroskopis", "normal_value" : "", "satuan" : ""}, {"id" : "konsentrasi", "name" : "Konsentrasi( x 10^6/ml)", "normal_value" : "=>20 x ( 10^6/ml)", "satuan" : ""}, {"id" : "motilitas", "name" : "Motilitas(%)", "normal_value" : "", "satuan" : ""}, {"id" : "a_linier_cepat", "name" : "A Linier Cepat", "normal_value" : "=>50% (A)+(B)", "satuan" : ""}, {"id" : "b_linier_lambat", "name" : "B Linier Lambat", "normal_value" : "atau", "satuan" : ""}, {"id" : "c_tidak_progressif", "name" : "C Tidak Progressif", "normal_value" : "=>25%(A)", "satuan" : ""}, {"id" : "d_tidak_motil", "name" : "D Tidak Motil", "normal_value" : "", "satuan" : ""}, {"id" : "viabilitas_(%hidup)", "name" : "Viabilitas (%hidup)", "normal_value" : "=>75%", "satuan" : ""}, {"id" : "morfologi_(%normal)", "name" : "Morfologi (%Normal)", "normal_value" : "=>30%", "satuan" : ""}, {"id" : "morfologi_abnormal", "name" : "Morfologi Abnormal(K,L,E, Cyt)", "normal_value" : "", "satuan" : ""}, {"id" : "sel_bulat", "name" : "Sel Bulat( x10^6/ml)", "normal_value" : "< 1x10^6/ml", "satuan" : ""}, {"id" : "sel_leukosit", "name" : "Sel Leukosit( x10^6/ml)", "normal_value" : "< 1x10^6/ml", "satuan" : ""}, {"id" : "aglutinasi", "name" : "Aglutinasi", "normal_value" : "Tidak", "satuan" : ""}, {"id" : "fruktosa", "name" : "Fruktosa", "normal_value" : "> 13 u mol/ejakulat", "satuan" : ""}], "index" : 13, "name" : "SPERMATOZOA"}, {"children" : [{"id" : "t3", "name" : "T3", "normal_value" : "0.92-2.33", "satuan" : "nmol/I"}, {"id" : "t4", "name" : "T4", "normal_value" : "60-120", "satuan" : "nmol/I"}, {"id" : "tsh", "name" : "TSH", "normal_value" : "Hipertiroid < 0.15 | Euthyroid 0.25 - 5", "satuan" : "uIU/ml"}, {"id" : "ft4", "name" : "FT4", "normal_value" : "1.6-19.4", "satuan" : "pmol/I"}, {"id" : "egfr", "name" : "Egfr", "normal_value" : "Normal =>90 | Ringan:60-89", "satuan" : ""}, {"id" : "tshs", "name" : "TSHs", "normal_value" : "0.27 - 4.70", "satuan" : "ml/min/1.73 m"}], "index" : 14, "name" : "HORMON"}, {"children" : [{"id" : "cea", "name" : "CEA", "normal_value" : "", "satuan" : ""}, {"id" : "afp", "name" : "AFP", "normal_value" : "", "satuan" : ""}, {"id" : "psa", "name" : "PSA", "normal_value" : "", "satuan" : ""}, {"id" : "cea", "name" : "CEA", "normal_value" : "", "satuan" : ""}], "index" : 15, "name" : "PETANDA TUMOR"}, {"children" : [{"id" : "administrasi", "name" : "Administrasi", "normal_value" : "", "satuan" : ""}], "index" : 16, "name" : "ADMINISTRASI"}, {"children" : [{"id" : "lancet", "name" : "Lancet", "normal_value" : "", "satuan" : ""}, {"id" : "spuit_3cc", "name" : "Spuit 3cc", "normal_value" : "", "satuan" : ""}, {"id" : "spuit_5cc", "name" : "Spuit 5cc", "normal_value" : "", "satuan" : ""}, {"id" : "vacutainer", "name" : "Vacutainer", "normal_value" : "", "satuan" : ""}, {"id" : "wing_needle", "name" : "Wing Needle", "normal_value" : "", "satuan" : ""}, {"id" : "spuit_1cc", "name" : "Spuit 1cc", "normal_value" : "", "satuan" : ""}, {"id" : "hand_scun", "name" : "Hand Scun", "normal_value" : "", "satuan" : ""}], "index" : 17, "name" : "BAHAN"}, {"children" : [{"id" : "amphetamine", "name" : "Amphetamine", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "spuit_3cc", "name" : "Morphine", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "bzo_(benzodizepiner)", "name" : "BZO (Benzodizepiner)", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "thc_(marijuana)", "name" : "THC (Marijuana)", "normal_value" : "Negatif", "satuan" : ""}, {"id" : "met_(methamphetamine)", "name" : "MET (Methamphetamine)", "normal_value" : "Negatif", "satuan" : ""}], "index" : 18, "name" : "NARKOBA"}, {"children" : [{"id" : "tes_kehamilan", "name" : "Tes Kehamilan", "normal_value" : "", "satuan" : ""}], "index" : 19, "name" : "KEHAMILAN"}, {"children" : [{"id" : "rhesus", "name" : "Rhesus", "normal_value" : "", "satuan" : ""}, {"id" : "golongan_darah", "name" : "Golongan Darah", "normal_value" : "", "satuan" : ""}], "index" : 20, "name" : "GOLONGAN DARAH"}]';

    public function cetak($id)
    {
        $data['pendaftaran'] = $this->PemeriksaanModel->getPendaftaranByIdPemeriksaan($id)->row_array();
        $data['pemeriksaan'] = $this->PemeriksaanModel->getPemeriksaanById($id)->row_array();
        $data['meta'] = unserialize($data['pemeriksaan']['meta']);
        $data['layanan'] = $this->JenisLayananLaboratoirumModel->byIdPemeriksaan($id);
        $data['klinik'] = $this->AdministrasiModel->getKlinik()->row();
        $data['dokter'] = $this->DokterModel->getUserById($data['pemeriksaan']['dokter_id'])->row();
        $data['all_layanan'] = json_decode($this->l);
        $data['pemeriksa'] = $this->session->userdata('logged_in')->nama;
        $data['pasien'] = $this->PasienModel->getPasienById($data['pendaftaran']['pasien'])->row();

        if (isset($data['pendaftaran']['pednafataran_id']) && $data['pendaftaran']['pednafataran_id'] != null) {
            $data['pengirim'] = $data['dokter']->nama;
        }
        else {
            $data['pengirim'] = '';
        }

        $this->load->view('laboratorium/cetak_sesungguhnya', $data);
    }

//    private $all_layanan = '[{"title": "Hematologi"},{"label": "Hematologi", "name": "hematologi", "param": ""},{"title": "DL Automatic"},{"label": "LEUCO WBC", "name": "leuco_wbc", "param": "L:4.7-10.3  P:4.3-11.3"},{"label": "ERY RBC", "name": "ery_rbc", "param": "L:4.33-5.95  P:3.9-4.5"},{"label": "HB HGB", "name": "hb_hgb", "param": "L:13.4-17.7P:11.4-15.1"},{"label": "PCV HCT", "name": "pct_hcv", "param": "L:40-47  P:38-42"},{"label": "MCV", "name": "mcv", "param": "80-93"},{"label": "MCH", "name": "mch", "param": "27-31"},{"label": "MCHC", "name": "mchc", "param": "32-36"},{"label": "Trombo PLT", "name": "trombo_plt", "param": "x1000/ul (150-350)"},{"label": "DIFF", "name": "diff", "param": ""},{"label": "Ensinofil", "name": "ensinofil", "param": "1-2%"},{"label": "Basofil", "name": "basofil", "param": "0-1%"},{"label": "Stab", "name": "stab", "param": "3-5%"},{"label": "Segment", "name": "segment", "param": "54-62%"},{"label": "Lymfosit", "name": "lymfosit", "param": "25-33%"},{"label": "Monosit", "name": "monosit", "param": "3-7%"},{"title": "FAAL HEMOSTATIS"},{"label": "PPT", "name": "ppt", "param": "C= 7.8 +/- 2 detikdari C"},{"label": "APIT", "name": "apit", "param": "C= 31.8 +/- 7 detikdari C"},{"label": "BT", "name": "bt", "param": "2-3 menit"},{"label": "CT", "name": "ct", "param": "5-10 menit"},{"label": "Laju Endap Darah", "name": "laju_endap_darah", "param": "L: 0-15;P :0-20mm/jam"},{"label": "Gol Darah", "name": "gol_darah", "param": ""},{"label": "Gol Darah Rhesus", "name": "gol_darah_rhesus", "param": ""},{"title": "FUNGSI GINJAL"},{"label": "Bun", "name": "bun", "param": "mg/dl < 22"},{"label": "Creatinine", "name": "creatinene", "param": "mg/dl L: <1.52 ; P: <1.19"},{"label": "Uric Acid", "name": "uric_acid", "param": "mg/dl L: 3.0 – 7.0 ; P: 2.3 – 6.0"},{"title": "GLUKOSA DARAH"},{"label": "Glukosa Acak", "name": "glukosa_acak", "param": "< 160 mg / dl"},{"label": "Glukosa Puasa", "name": "glukosa_puasa", "param": "<120 mg / dl"},{"label": "Glukosa 2jp", "name": "glukosa_2jp", "param": "< 160 mg / dl"},{"label": " HbA-1c", "name": "hbA-1c", "param": "Normal : < 5.7"},{"label": " HbA-1c＿a", "name": "hbA-1c_a", "param": "Normal : < 5.7"},{"label": " HbA-1c＿b", "name": "hbA-1c_b", "param": "Pre Diabetes : 5.7 – 6.4"},{"label": " HbA-1c＿c", "name": "hbA-1c_c", "param": "Diabetes : >/= 6.5"},{"label": " HbA-1c＿d", "name": "hbA-1c_d", "param": "Target Terapi : < 7.0"},{"label": "Reduksi", "name": "reduksi_2", "param": "Negatif"},{"label": "Gula Darah Sewaktu", "name": "gula_darah_sewaktu", "param": "<=180"},{"label": "GTT:Puasa", "name": "gtt_puasa", "param": "70-100"},{"label": "GTT:1/2jam", "name": "gtt_1/2jam", "param": "110-170"},{"label": "GTT:1jam", "name": "gtt_1jam", "param": "120-170"},{"label": "GTT:1 1/2jam", "name": "gtt_11/2jam", "param": "100-140"},{"label": "GTT:2jam", "name": "gtt_2jam", "param": "20-120"},{"label": "Hb A1-C", "name": "hb_A-1c", "param": "4.2-7.0"},{"label": "II", "name": "ii", "param": "4-7"},{"title": "FAAL HATI"},{"label": "SGOT", "name": "sgot", "param": "L: <37 ; P: <31u/l"},{"label": "SGPT", "name": "sgpt", "param": "L: <40 ; P: <31 u/l"},{"label": "S Albumin", "name": "s_albumin", "param": "3.5-5.0 gr %"},{"label": "Bilirubin", "name": "bilirubin", "param": ""},{"label": "Direct", "name": "direct", "param": "< 0.25 mg/dl"},{"label": "Indirect", "name": "indirect", "param": "< 0.75 mg / dl"},{"label": "Total", "name": "total", "param": "< 1.00 mg / dl"},{"title": "LEMAK DARAH"},{"label": "Cholesterol", "name": "cholesterol", "param": "< 220 mg / dl"},{"label": "Trigliserida", "name": "trigliserida", "param": "< 150 mg / dl"},{"label": "HDL Chol", "name": "hdl_chol", "param": "L:> 55 ; P:> 60 mg/dl"},{"label": "LDL Chol", "name": "ldl_chol", "param": "< 150 mg / dl"},{"title": " ELEKTROLIT"},{"label": "Na", "name": "na", "param": "135-145 mEg/L"},{"label": "K", "name": "k", "param": "3.5- 5.5 mEg/L"},{"label": "Cl", "name": "cl", "param": "90-110 mEg/L"},{"title": "IMMUNOSEROLOGI"},{"label": "HBsAg RPHA ", "name": "hBsAg_rPHA", "param": "Non Reaktif"},{"label": "VDRL", "name": "vdrl", "param": "Non Reaktif"},{"label": " IgG Anti DHF", "name": "igG_anti_dHF", "param": "Negatif"},{"label": " IgM Anti DHF", "name": "igm_anti_dHF", "param": "Negatif"},{"label": "Anti HIV", "name": "anti_hiv", "param": "Non Reaktif"},{"title": "WIDAL"},{"label": "Type O", "name": "type_o", "param": "Negatif: < 8"},{"label": "Type H", "name": "type_h", "param": "Negatif: < 8"},{"label": "Type A", "name": "type_a", "param": "Negatif: < 8"},{"label": "Type B", "name": "type_b", "param": "Negatif: < 8"},{"title": "URIN LENGKAP"},{"label": "Albumin", "name": "albumin", "param": "Negatif"},{"label": "Reduksi", "name": "Reduksi", "param": "Negatif"},{"label": "Urobilin", "name": "urobilin", "param": "Negatif"},{"label": "Bilirubin", "name": "bilirubin", "param": "Negtif"},{"label": "PH", "name": "ph", "param": "4.5 - 7.5"},{"label": "Berat Jenis", "name": "berat_jenis", "param": "1.010 - 1.025"},{"label": "Blood", "name": "blood", "param": "Negatif"},{"label": "Leukosit", "name": "leukosit", "param": "Negatif"},{"label": "Nitrit", "name": "nitrit", "param": "Negatif"},{"label": "Keton", "name": "keton", "param": "Negatif"},{"label": "SEDIMENT", "name": "sediment", "param": ""},{"label": "Eritrocyt", "name": "eritrocyt", "param": "0 - 1 /lp"},{"label": "Leukosit", "name": "leukosit2", "param": "0 - 1 /lp"},{"label": "Epitel", "name": "epitel", "param": ""},{"label": "Silinder", "name": "silinder", "param": "Negatif"},{"label": "Kristal", "name": "kristal", "param": "Negatif"},{"label": "Lain - Lain", "name": "lain_lain", "param": "Negatif"},{"label": "Mikroalbumin", "name": "mikroalbumin", "param": "< 20 mg /L"},{"title": "PPT Test Pack"}]';
//    private $all_layanan_1 = '[{"title": "Hematologi"},{"label": "Hematologi", "name": "hematologi", "param": ""},{"title": "DL Automatic"},{"label": "LEUCO WBC", "name": "leuco_wbc", "param": "L:4.7-10.3  P:4.3-11.3"},{"label": "ERY RBC", "name": "ery_rbc", "param": "L:4.33-5.95  P:3.9-4.5"},{"label": "HB HGB", "name": "hb_hgb", "param": "L:13.4-17.7P:11.4-15.1"},{"label": "PCV HCT", "name": "pct_hcv", "param": "L:40-47  P:38-42"},{"label": "MCV", "name": "mcv", "param": "80-93"},{"label": "MCH", "name": "mch", "param": "27-31"},{"label": "MCHC", "name": "mchc", "param": "32-36"},{"label": "Trombo PLT", "name": "trombo_plt", "param": "x1000/ul (150-350)"},{"label": "DIFF", "name": "diff", "param": ""},{"label": "Ensinofil", "name": "ensinofil", "param": "1-2%"},{"label": "Basofil", "name": "basofil", "param": "0-1%"},{"label": "Stab", "name": "stab", "param": "3-5%"},{"label": "Segment", "name": "segment", "param": "54-62%"},{"label": "Lymfosit", "name": "lymfosit", "param": "25-33%"},{"label": "Monosit", "name": "monosit", "param": "3-7%"},{"title": "FAAL HEMOSTATIS"},{"label": "PPT", "name": "ppt", "param": "C= 7.8 +/- 2 detikdari C"},{"label": "APIT", "name": "apit", "param": "C= 31.8 +/- 7 detikdari C"},{"label": "BT", "name": "bt", "param": "2-3 menit"},{"label": "CT", "name": "ct", "param": "5-10 menit"},{"label": "Laju Endap Darah", "name": "laju_endap_darah", "param": "L: 0-15;P :0-20mm/jam"},{"label": "Gol Darah", "name": "gol_darah", "param": ""},{"label": "Gol Darah Rhesus", "name": "gol_darah_rhesus", "param": ""},{"title": "FUNGSI GINJAL"},{"label": "Bun", "name": "bun", "param": "mg/dl < 22"},{"label": "Creatinine", "name": "creatinene", "param": "mg/dl L: <1.52 ; P: <1.19"},{"label": "Uric Acid", "name": "uric_acid", "param": "mg/dl L: 3.0 – 7.0 ; P: 2.3 – 6.0"},{"title": "GLUKOSA DARAH"},{"label": "Glukosa Acak", "name": "glukosa_acak", "param": "< 160 mg / dl"},{"label": "Glukosa Puasa", "name": "glukosa_puasa", "param": "<120 mg / dl"},{"label": "Glukosa 2jp", "name": "glukosa_2jp", "param": "< 160 mg / dl"},{"label": " HbA-1c", "name": "hbA-1c", "param": "Normal : < 5.7"},{"label": " HbA-1c＿a", "name": "hbA-1c_a", "param": "Normal : < 5.7"},{"label": " HbA-1c＿b", "name": "hbA-1c_b", "param": "Pre Diabetes : 5.7 – 6.4"},{"label": " HbA-1c＿c", "name": "hbA-1c_c", "param": "Diabetes : >/= 6.5"},{"label": " HbA-1c＿d", "name": "hbA-1c_d", "param": "Target Terapi : < 7.0"},{"label": "Reduksi", "name": "reduksi_2", "param": "Negatif"},{"label": "Gula Darah Sewaktu", "name": "gula_darah_sewaktu", "param": "<=180"},{"label": "GTT:Puasa", "name": "gtt_puasa", "param": "70-100"},{"label": "GTT:1/2jam", "name": "gtt_1/2jam", "param": "110-170"},{"label": "GTT:1jam", "name": "gtt_1jam", "param": "120-170"},{"label": "GTT:1 1/2jam", "name": "gtt_11/2jam", "param": "100-140"},{"label": "GTT:2jam", "name": "gtt_2jam", "param": "20-120"},{"label": "Hb A1-C", "name": "hb_A-1c", "param": "4.2-7.0"},{"label": "II", "name": "ii", "param": "4-7"}]';
//    private $all_layanan_2 = '[{"title": "FAAL HATI"},{"label": "SGOT", "name": "sgot", "param": "L: <37 ; P: <31u/l"},{"label": "SGPT", "name": "sgpt", "param": "L: <40 ; P: <31 u/l"},{"label": "S Albumin", "name": "s_albumin", "param": "3.5-5.0 gr %"},{"label": "Bilirubin", "name": "bilirubin", "param": ""},{"label": "Direct", "name": "direct", "param": "< 0.25 mg/dl"},{"label": "Indirect", "name": "indirect", "param": "< 0.75 mg / dl"},{"label": "Total", "name": "total", "param": "< 1.00 mg / dl"},{"title": "LEMAK DARAH"},{"label": "Cholesterol", "name": "cholesterol", "param": "< 220 mg / dl"},{"label": "Trigliserida", "name": "trigliserida", "param": "< 150 mg / dl"},{"label": "HDL Chol", "name": "hdl_chol", "param": "L:> 55 ; P:> 60 mg/dl"},{"label": "LDL Chol", "name": "ldl_chol", "param": "< 150 mg / dl"},{"title": " ELEKTROLIT"},{"label": "Na", "name": "na", "param": "135-145 mEg/L"},{"label": "K", "name": "k", "param": "3.5- 5.5 mEg/L"},{"label": "Cl", "name": "cl", "param": "90-110 mEg/L"},{"title": "IMMUNOSEROLOGI"},{"label": "HBsAg RPHA ", "name": "hBsAg_rPHA", "param": "Non Reaktif"},{"label": "VDRL", "name": "vdrl", "param": "Non Reaktif"},{"label": " IgG Anti DHF", "name": "igG_anti_dHF", "param": "Negatif"},{"label": " IgM Anti DHF", "name": "igm_anti_dHF", "param": "Negatif"},{"label": "Anti HIV", "name": "anti_hiv", "param": "Non Reaktif"},{"title": "WIDAL"},{"label": "Type O", "name": "type_o", "param": "Negatif: < 8"},{"label": "Type H", "name": "type_h", "param": "Negatif: < 8"},{"label": "Type A", "name": "type_a", "param": "Negatif: < 8"},{"label": "Type B", "name": "type_b", "param": "Negatif: < 8"},{"title": "URIN LENGKAP"},{"label": "Albumin", "name": "albumin", "param": "Negatif"},{"label": "Reduksi", "name": "Reduksi", "param": "Negatif"},{"label": "Urobilin", "name": "urobilin", "param": "Negatif"},{"label": "Bilirubin", "name": "bilirubin", "param": "Negtif"},{"label": "PH", "name": "ph", "param": "4.5 - 7.5"},{"label": "Berat Jenis", "name": "berat_jenis", "param": "1.010 - 1.025"},{"label": "Blood", "name": "blood", "param": "Negatif"},{"label": "Leukosit", "name": "leukosit", "param": "Negatif"},{"label": "Nitrit", "name": "nitrit", "param": "Negatif"},{"label": "Keton", "name": "keton", "param": "Negatif"},{"label": "SEDIMENT", "name": "sediment", "param": ""},{"label": "Eritrocyt", "name": "eritrocyt", "param": "0 - 1 /lp"},{"label": "Leukosit", "name": "leukosit2", "param": "0 - 1 /lp"},{"label": "Epitel", "name": "epitel", "param": ""},{"label": "Silinder", "name": "silinder", "param": "Negatif"},{"label": "Kristal", "name": "kristal", "param": "Negatif"},{"label": "Lain - Lain", "name": "lain_lain", "param": "Negatif"},{"label": "Mikroalbumin", "name": "mikroalbumin", "param": "< 20 mg /L"},{"title": "PPT Test Pack"}]';
//
//    public function cetak($id)
//    {
//        $data['pendaftaran'] = $this->PemeriksaanModel->getPendaftaranByIdPemeriksaan($id)->row_array();
//        $data['pemeriksaan'] = $this->PemeriksaanModel->getPemeriksaanById($id)->row_array();
//        $data['layanan'] = $this->JenisLayananLaboratoirumModel->byIdPemeriksaan($id);
//        $data['klinik'] = $this->AdministrasiModel->getKlinik()->row();
//        $data['dokter'] = $this->DokterModel->getUserById($data['pemeriksaan']['dokter_id'])->row();
//        $data['all_layanan_1'] = json_decode($this->all_layanan_1);
//        $data['all_layanan_2'] = json_decode($this->all_layanan_2);
//        $data['pemeriksa'] = $this->session->userdata('logged_in')->nama;
//        $data['hasil_lab'] = json_decode($data['pemeriksaan']['hasil_lab'], true);
//
//        $this->load->view('laboratorium/cetak_2', $data);
//    }

    public function unduh($id)
    {
        $data['pendaftaran'] = $this->PemeriksaanModel->getPendaftaranByIdPemeriksaan($id)->row_array();
        $data['pemeriksaan'] = $this->PemeriksaanModel->getPemeriksaanById($id)->row_array();
        $data['layanan'] = $this->JenisLayananLaboratoirumModel->byIdPemeriksaan($id);
        $data['klinik'] = $this->AdministrasiModel->getKlinik()->row();
        $data['dokter'] = $this->DokterModel->getUserById($data['pemeriksaan']['dokter_id'])->row();
        $data['all_layanan'] = json_decode($this->all_layanan);
        $data['pemeriksa'] = $this->session->userdata('logged_in')->nama;
        $data['hasil_lab'] = json_decode($data['pemeriksaan']['hasil_lab'], true);

        ini_set("memory_limit","20000M");
        $mpdf = new mPDF('c','A4','','');
        $mpdf->mirrorMargins = 10;

        $mpdf->WriteHTML($this->load->view('laboratorium/unduh_2', $data, true));
        $mpdf->SetHTMLFooter($footer,'E');
        $mpdf->Output('lab-'.time().'.pdf','D');

    }

    private function getHasilLab() {
        $forms = [
            'hematologi', 'leuco_wbc', 'ery_rbc', 'hb_hgb', 'pct_hcv', 'mcv', 'mch', 'mchc', 'trombo_plt', 'diff',
            'ensinofil', 'basofil', 'stab', 'segment', 'lymfosit', 'monosit', 'ppt', 'apit', 'bt', 'ct', 'laju_endap_darah',
            'gol_darah', 'gol_darah_rhesus', 'bun', 'creatinene', 'uric_acid', 'glukosa_acak', 'glukosa_puasa',
            'glukosa_2jp', 'hbA-1c', 'hbA-1c_a', 'hbA-1c_b', 'hbA-1c_c', 'hbA-1c_d', 'reduksi_2', 'gula_darah_sewaktu',
            'gtt_puasa', 'gtt_1/2jam', 'gtt_1jam', 'gtt_11/2jam', 'gtt_2jam', 'hb_A-1c', 'ii', 'sgot', 'sgpt',
            's_albumin', 'bilirubin', 'direct', 'indirect', 'total', 'cholesterol', 'trigliserida', 'hdl_chol',
            'ldl_chol', 'na', 'k', 'cl', 'hBsAg_rPHA', 'vdrl', 'igG_anti_dHF', 'igm_anti_dHF', 'anti_hiv',
            'type_o', 'type_h', 'type_a', 'type_b', 'albumin', 'Reduksi', 'urobilin', 'bilirubin_negatif', 'ph', 'berat_jenis',
            'blood', 'leukosit', 'nitrit', 'keton', 'sediment', 'eritrocyt', 'leukosit2', 'epitel', 'silinder',
            'kristal', 'lain_lain', 'mikroalbumin'
        ];

        $res = [];
        foreach ($forms as $form) {
            $res[$form] = $this->input->post($form);
        }

        return json_encode($res);
    }

    public function hapus($id, $to)
    {
        $this->MainModel->delete('pemeriksaan', ['is_active' => 0], $id);
        $this->MainModel->delete('pendaftaran_pasien', ['is_active' => 0], $id);

        $this->session->set_flashdata('success', 'Berhasil menghapus pemeriksaan');
        redirect("laboratorium/$to", 'refresh');
    }
}
