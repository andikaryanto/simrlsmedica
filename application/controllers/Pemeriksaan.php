<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemeriksaan extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('template');
        $this->load->Model('PendaftaranModel');
        $this->load->Model('PemeriksaanModel');
        $this->load->Model('LaporanModel');
        $this->load->Model('ObatModel');
        $this->load->Model('MainModel');
        $this->load->Model('TarifTindakanModel');
        $this->load->Model('PenyakitModel');
        $this->load->Model('PerawatModel');
        $this->load->Model('DetailPenyakitPemeriksaanModel');
        $this->load->Model('DetailTindakanPemeriksaanModel');
        $this->load->Model('AdminModel');
        $this->load->Model('FrontOfficeModel');
    }

    public function index() {
        if ($this->input->post('submit')) {
            $insert = $this->MainModel->insert($pasien);
        } else {
            $this->template->view('pemeriksaan/pemeriksaan_v');
        }
    }

    public function rekamedis() {
        $id = $this->input->post('id');

        $data['pasien'] = $this->PendaftaranModel->getPasienById($id)->row();
        $data['pemeriksaan'] = $this->PendaftaranModel->getPemeriksaanPasienById($id)->result();

        $data['tindakan'] = $this->LaporanModel->getTindakanById($id);
        $data['obat'] = $this->LaporanModel->getObatPemeriksaanById($id);
        $data['penyakit'] = $this->LaporanModel->getPenyakitPemeriksaanById($id);
        $data['racikan'] = $this->LaporanModel->getRacikanPemeriksaan();
        $data['pendaftaran'] = $this->PendaftaranModel->getPendaftaranByIdPasien($id)->row();

        $this->load->view('pemeriksaan/rekamedis', $data);
    }

    public function listpemeriksaanPasien() {
        $u = $this->session->get_userdata('logged_in');
        $u = $u['logged_in'];
        $is_dokter = $u->nama_grup == 'dokter';
        $is_perawat = $u->nama_grup == 'perawat';
        $is_laborat = $u->nama_grup == 'laborat';
        $is_ekg = $u->nama_grup == 'ekg';
        $is_spirometri = $u->nama_grup == 'spirometri';
        // echo json_encode($u);die();

        if ($is_dokter || $is_perawat) {
            $data['listPendaftaran'] = $this->PemeriksaanModel->getListPemeriksaanSudahPeriksaAwalByIdJenisPendaftaran($u->id_jenis_pendaftaran);
        } else if ($is_laborat || $is_ekg || $is_spirometri) {

            if ($is_laborat) {
                $id = '19';
            } else if ($is_ekg) {
                $id = '40';
            } else if ($is_spirometri) {
                $id = '42';
            }
            $data['listPendaftaran'] = $this->PemeriksaanModel->getListPemeriksaanSudahPeriksaAwalByIdJenisPendaftaran($id);
        } else {
            $data['listPendaftaran'] = $this->PemeriksaanModel->getListPemeriksaanSudahPeriksaAwal();
        }

        $y = $this->PemeriksaanModel->getJenisPendafataranSudahPeriksaAwal();
        $data['jenis_pendaftaran'] = [];
        foreach($y as &$jp) {
            if ($jp->jenis_pendaftaran_id == 19 || $jp->jenis_pendaftaran_id == 58) {
                continue;
            }
            $jp->list = $this->PemeriksaanModel->getListPemeriksaanSudahPeriksaAwalByIdJenisPendaftaran($jp->jenis_pendaftaran_id)->result();
            $data['jenis_pendaftaran'][] = $jp;
        }

        $data['jaminan'] = $this->config->item('pendaftaran');

        $this->template->view('pemeriksaan/list_blom_diperiksa_v', $data);
    }

    public function listPasienSelesaiPeriksa() {
        $data['listPemeriksaan'] = $this->PemeriksaanModel->getListPemeriksaanSudahPeriksa()->result();
        foreach ($data['listPemeriksaan'] as &$datum) {
            $datum->penyakits = $this->DetailPenyakitPemeriksaanModel->getDetailPenyakitByPemeriksaanId($datum->id)->result();
        }

        $data['jaminan'] = $this->config->item('pendaftaran');

        $this->template->view('pemeriksaan/list_pasien_diperiksa_v', $data);
    }

    public function detail() {
        $id = $this->input->get('id_pasien');
        $pemeriksaan = $this->PendaftaranModel->getPemeriksaanPasienById($id)->result();
        $tindakan = $this->LaporanModel->getTindakanById($id);
        $obat = $this->LaporanModel->getObatPemeriksaanById($id);
        $penyakit = $this->LaporanModel->getPenyakitPemeriksaanById($id);
        /* $html='';
         foreach ($pemeriksaan as $key) {
            $html .='<p>'.$key->waktu_pemeriksaan.'</p>';
        }*/
        $html = '<div class="box box-danger">
              <div class="box-header">
                <h3 class="box-title">Riwayat Periksa</h3>&nbsp;&nbsp;

              </div>

              <div class="box-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                          <tr>
                              <th>No</th>
                              <th>Tanggal Periksa</th>
                              <th>Diagnosis Jenis Penyakit</th>
                              <th>Obat</th>
                              <th>Tindakan</th>
                          </tr>
                      </thead>
                      <tbody>';
        $no = 0;
        foreach ($pemeriksaan as $row) {
            $no++;
            $date = date('d-F-Y', strtotime($row->waktu_pemeriksaan));
            $html .= '<tr>
                              <td>' . $no . '</td>
                              <td>' . $date . '</td>
                              <td> <table style="font-size: 10px">
                                      <thead>
                                          <tr>
                                              <th>Nama Penyakit</th>
                                              <th>Kode</th>
                                          </tr>
                                      </thead>
                                      <tbody>';


            foreach ($penyakit->result() as $row1) {
                if ($row->id == $row1->pemeriksaan_id) {
                    $html .= '<tr>
                                                    <td>' . $row1->nama . '</td>
                                                    <td>' . $row1->kode . '</td>
                                                </tr>';
                }
            }

            $html .= '</tbody>
                                  </table>
                              </td>
                              <td>
                                <table style="font-size: 10px">
                                      <thead>
                                          <tr>

                                              <th>Nama Obat</th>
                                              <th>jumlah</th>
                                          </tr>
                                      </thead>
                                      <tbody>';


            foreach ($obat->result() as $row2) {
                if ($row->id == $row2->pemeriksaan_id) {
                    $html .= '<tr>

                                                    <td>' . $row2->nama . '</td>
                                                     <td>' . $row2->jumlah_satuan . '</td>
                                                </tr>';
                }
                $no++;
            }


            $html .= '</tbody>

                                  </table>
                                </td>
                                <td>
                                  <table style="font-size: 10px">
                                      <thead>
                                          <tr>

                                              <th>Nama Tindakan</th>


                                          </tr>
                                      </thead>
                                      <tbody>';


            foreach ($tindakan->result() as $row3) {
                if ($row->id == $row3->pemeriksaan_id) {
                    $html .= '<tr>

                                                    <td>' . $row3->nama . '</td>

                                                </tr>';
                }
            }

            $html .= '</tbody>
                                  </table>
                                </td>
                          </tr>';

        }


        $html .= '</tbody>

                </table>
              </div>

                </div>';
        echo $html;
    }

    public function periksa($id = "") {

        $session = $this->session->userdata('logged_in');

        if ($this->input->post('submit') == 1 || $this->input->post('rujuk') || $this->input->post('input_resep')) {
            if (isset($_POST['meta'])) {
                $meta = serialize($this->input->post('meta'));
            }
            else {
                $meta = '';
            }

            $hd = isset($_POST['hd']) ? serialize($this->input->post('hd')) : '';

            $hp_lab = $this->input->post('hasil_penunjang_laboratorium');
            $hp_ekg = $this->input->post('hasil_penunjang_ekg');
            $hp_spirometri = $this->input->post('hasil_penunjang_spirometri');

            if ($hp_lab) {
                $hp['laboratorium'] = $hp_lab;
            }
            if ($hp_ekg) {
                $hp['ekg'] = $hp_ekg;
            }
            if ($hp_spirometri) {
                $hp['spirometri'] = $hp_spirometri;
            }

            $periksa = array(
                'td' => $this->input->post('td'),
                'r' => $this->input->post('r'),
//                'bb' => $this->input->post('bb'),
                'n' => $this->input->post('n'),
                's' => $this->input->post('s'),
//                'tb' => $this->input->post('tb'),
                'dokter_id' => $this->input->post('dokter_id'),
                'diagnosa_perawat' => $this->input->post('diagnosa_perawat'),
                'keluhan_utama' => $this->input->post('keluhan_utama'),
                'catatan_odontogram' => $this->input->post('catatan_odontogram'),
                'kajian_perawat'    => json_encode([
                    'status_fisik' => $this->input->post('status_fisik'),
                    'psikososial' => $this->input->post('psikososial'),
                    'riwayat_kesehatan_pasien' => $this->input->post('riwayat_kesehatan_pasien'),
                    'riwayat_penggunaan_obat' => $this->input->post('riwayat_penggunaan_obat'),
                ]),
                'meta' => $meta,
                'hd' => $hd,
                'amammesia' => $this->input->post('amammesia'),
                'diagnosis' => $this->input->post('diagnosis'),
                'pemeriksaan_fisik' => nl2br($this->input->post('pemeriksaan_fisik')),
                'hasil_penunjang' => json_encode($hp),
                'diagnosis_banding' => $this->input->post('diagnosis_banding'),
                'deskripsi_tindakan' => $this->input->post('deskripsi_tindakan'),
                'saran_pemeriksaan' => $this->input->post('saran_pemeriksaan'),
                'creator' => $session->id,
                'form' => serialize($this->input->post('form'))
            );

            if (!isset($_POST['rujuk']) || !$_POST['rujuk']) {
                $periksa['sudah_obat'] = 1;
                $periksa['sudah_periksa_dokter'] = 1;
            }

            if ($this->input->post('kode_daftar') == 'PL' || $this->input->post('kode_daftar') == 'BPJS-PL') {
                $periksa['hasil_lab'] = $this->getHasilLab();
            }

            if (isset($_POST['asuhan_keperawatan'])) {
                $periksa['asuhan_keperawatan'] = $this->input->post('asuhan_keperawatan');
            }

            $excap = array(
                'PE',
                'BPJS-PE',
                'P-Sirometri',
                'BPJS-P-Sirometri',
                'P-Laborat',
                'BPJS-P-Laborat'
            );
            if (in_array($_POST['kode_daftar'], $excap)) {
//                $periksa['diagnosis_jenis_penyakit'] = $this->input->post('diagnosis_jenis_penyakit');
            }

            $this->MainModel->update('pemeriksaan', $periksa, $id);

            $pemeriksaan = $this->PemeriksaanModel->getPemeriksaanById($id)->row();
            if ($pemeriksaan->sudah_periksa_perawat && $pemeriksaan->sudah_periksa_dokter) {
                $this->MainModel->update('pemeriksaan', ['status' => 'sudah_periksa'], $id);
            }

            //UPLOAD
            $config['upload_path'] = FCPATH.'/upload/';
            $config['allowed_types'] = '*';
            $config['max_size'] = 2000;

            $this->load->library('upload', $config);
            $this->upload->initialize($config, false);

            if (isset($_FILES['dokumen'])) {

                $files = $_FILES;
                $cpt = count($_FILES ['dokumen'] ['name']);

                for ($i = 0; $i < $cpt; $i ++) {

                    $name = time().str_replace(' ', '_', $files ['dokumen'] ['name'] [$i]);
                    $_FILES ['dokumen'] ['name'] = $name;
                    $_FILES ['dokumen'] ['type'] = $files ['dokumen'] ['type'] [$i];
                    $_FILES ['dokumen'] ['tmp_name'] = $files ['dokumen'] ['tmp_name'] [$i];
                    $_FILES ['dokumen'] ['error'] = $files ['dokumen'] ['error'] [$i];
                    $_FILES ['dokumen'] ['size'] = $files ['dokumen'] ['size'] [$i];

                    if(!($this->upload->do_upload('dokumen')) || $files ['dokumen'] ['error'] [$i] !=0){
//                        die($this->upload->display_errors().' '.$_FILES ['dokumen'] ['type']);
                    }
                    else {
                        $this->MainModel->insert('pemeriksaan_dokumen', [
                            'type' => $files ['dokumen'] ['type'] [$i],
                            'pemeriksaan_id' => $id,
                            'dokumen' => $name
                        ]);
                    }
                }
            }
            //END UPLOAD

            $input_tindakan = $this->input->post('tindakan');
            foreach ($input_tindakan as $key => $value) {
                $tindakan = array(
                    'pemeriksaan_id' => $id,
                    'tarif_tindakan_id' => $value,
                    'creator' => $session->id
                );
                $this->MainModel->insert_id('detail_tindakan_pemeriksaan', $tindakan);
            }

            if (!in_array($pendaftaran['kode_daftar'], $excap)) {
                $penyakit = $this->input->post('diagnosis_jenis_penyakit');
                foreach ($penyakit as $key => $value) {
                    $penyakit = array(
                        'pemeriksaan_id' => $id,
                        'penyakit_id' => $value,
                        'creator	' => $session->id
                    );
                    $this->MainModel->insert_id('detail_penyakit_pemeriksaan', $penyakit);
                }
            }

            // start
            $jumlah_satuan = $this->input->post('jumlah_satuan_sunat');
            $signa_obat = $this->input->post('signa_obat_sunat');
            $input_obat = $this->input->post('nama_obat_sunat');
            $i = 0;
            foreach ($input_obat as $key => $value) {
                $obat = array(
                    'pemeriksaan_id' => $id,
                    'obat_id' => $value,
                    'jumlah_satuan' => $jumlah_satuan[$i],
                    'signa_obat' => $signa_obat[$i],
                    'creator' => $session->id,
                    'sunat' => 1
                );

                if ($obat['obat_id'] != "") {
                    $this->MainModel->insert_id('detail_obat_pemeriksaan', $obat);
                }

                $i++;
            }

            // start
            $jumlah_satuan = $this->input->post('jumlah_satuan');
            $signa_obat = $this->input->post('signa_obat');
            $input_obat = $this->input->post('nama_obat');
            $i = 0;
            foreach ($input_obat as $key => $value) {
                $obat = array(
                    'pemeriksaan_id' => $id,
                    'obat_id' => $value,
                    'jumlah_satuan' => $jumlah_satuan[$i],
                    'signa_obat' => $signa_obat[$i],
                    'creator' => $session->id
                );

                if ($obat['obat_id'] != "") {
                    $this->MainModel->insert_id('detail_obat_pemeriksaan', $obat);
                    $obat = $this->ObatModel->getObatById($value)->row();
                    $stok = array('stok_obat' => ($obat->stok_obat) - $jumlah_satuan[$i]);
                }

                $i++;
            }

            for ($n = 1; $n <= 9; $n++) {
                $signa = $this->input->post('signa' . $n);
                $catatan = $this->input->post('catatan' . $n);
                $racikan = array(
                    'pemeriksaan_id' => $id,
                    'nama_racikan' => 'racikan ' . $n,
                    'signa' => $signa,
                    'catatan' => $catatan,
                    'creator' => $session->id
                );
                $jumlah_satuan = $this->input->post('jumlah_satuan_racikan' . $n);

                if ($signa != "") {
                    $j = 0;
                    $detail_obat_racikan_pemeriksaan_id = $this->MainModel->insert_id('detail_obat_racikan_pemeriksaan', $racikan);
                    $input_obat = $this->input->post('nama_obat_racikan'.$n);

                    foreach ($input_obat as $key => $value) {
                        if ($value != '') {
                            $obat_racikan = array(
                                'detail_obat_racikan_pemeriksaan_id' => $detail_obat_racikan_pemeriksaan_id,
                                'obat_id' => $value,
                                'jumlah_satuan' => $jumlah_satuan[$j],
                                'creator' => $session->id
                            );

                            $this->MainModel->insert('obat_racikan', $obat_racikan);
                            $obat = $this->ObatModel->getObatById($value)->row();
                            $stok = array('stok_obat' => ($obat->stok_obat) - $jumlah_satuan[$j]);
//                            $this->MainModel->update('obat', $stok, $value); // OBAT TIDAK BERKURANG KETIKA DOKTER SUBMIT
                        }

                        $j++;
                    }
                }
            }
            // end

            if (isset($_POST['id'])) {
                $x=0;
                $jumlah_bahan =$_POST['qty'];
                foreach ($_POST['id'] as $value) {
                    $this->db->insert(
                        'detail_bahan_pemeriksaan',
                        array(
                            'pemeriksaan_id' => $id,
                            'bahan_id' => $value,
                            'jumlah' => $jumlah_bahan[$x],
                            'creator' => $session->id
                        )
                    );
                    $bahan = $this->ObatModel->getBahanById($value)->row();
                    $stok = array('jumlah' => ($bahan->jumlah) - $jumlah_bahan[$x]);
//                    $this->MainModel->update('bahan_habis_pakai',$stok,$value);  // EDIT OBAT JUGA BELUM MEMPENGARUHI STOK
                    $x++;

                }
            }

            if ($this->input->post('surat')) {
                $this->MainModel->update('pendaftaran_pasien', ['surat' => $this->input->post('surat')], $this->input->post('pendaftaran_id'));
            }

            if (isset($_POST['rujuk']) && $_POST['rujuk']) {
                if ($_POST['rujuk'] == 'lab') {
                    redirect('Permintaan/lab/'.$id, 'refresh');
                }
                else if ($_POST['rujuk'] == 'radio') {
                    redirect('Permintaan/radio/'.$id, 'refresh');
                }
            }
            else {
                $this->session->set_flashdata('success', 'Pemeriksaan pasien berhasil!');
                redirect('pemeriksaan/listPasienSelesaiPeriksa');
            }
        } else {
            $data['pendaftaran'] = $this->PemeriksaanModel->getPendaftaranByIdPemeriksaan($id)->row_array();
            $data['pemeriksaan'] = $this->PemeriksaanModel->getPemeriksaanById($id)->row_array();
            $data['pasien'] = $this->db->query("SELECT * FROM pasien WHERE id = {$data['pemeriksaan']['pasien_id']}")->row_array();
            $data['form'] = unserialize($data['pemeriksaan']['form']);
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
            $data['penyakit'] = $this->PemeriksaanModel->getPenyakitByCategory($category);
            $data['dokter'] = $this->PendaftaranModel->getDokter();
            $data['listPerawat'] = $this->PerawatModel->listPerawat();
            $data['listFrontOffice'] = $this->FrontOfficeModel->listFrontOffice();

            $data['penyakit_pasien'] = $this->DetailPenyakitPemeriksaanModel->getDetailPenyakitByPemeriksaanId($data['pemeriksaan']['id']);
            $data['tindakan_pasien'] = $this->DetailTindakanPemeriksaanModel->getDetailTindakanByPemeriksaanId($data['pemeriksaan']['id']);
            $data['kajian_perawat'] = json_decode($data['pemeriksaan']['kajian_perawat'], true);

            if ($category == 'sunat')
                $this->template->view('pemeriksaan/pemeriksaan_sunat', $data);
            else if ($category == 'rawat luka')
                $this->template->view('pemeriksaan/pemeriksaan_rawat_luka', $data);
            else
                $this->template->view('pemeriksaan/pemeriksaan_v', $data);
        }
    }

    private function getHasilLab() {
        $forms = [
            'hemoglobin','led','leukosit','hitung','eosinophyl','basophyl','stab','segment','lymposit','monosit','sel_lainnya','eosinofil','eritrosit','trombocyt','reticulocyt',
            'hematacrit','mcv','mch','mchc','waktu_pendarahan','waktu_pembekuan','waktu_prothombin','waktu_rekalsifikasi','ptt','thrombotes_owren','fibrinogen','retraksi_bekuan',
            'retraksi_osmotik','malaria','plasmodium_falcifarum','plasmodium_vivax','prc_pembendungan','darah_lengkap','rdw_cv','rdw_sd','mpv','pdw','pct','limfosit','analisa_hb',
            'analisa_hb','hba2','hbf','ferritin','tibc','pt','aptt','inr','ureum_darah','ureum_urin','creatin_darah','creatin_urine','creatin_clearence','urea_clearence','alkali_reserve',
            'fosfat_anorganik','uric_acid','serum_iron','tibc','bilirudin_total','bilirudin_direk','bilirudin_indirek','protein_total','albumin','sgot','sgpt','gamma_gt','askali_fosfatase',
            'chollinesterase','ck','ldh','ck_m8','alpha_hbdh','globulin','gula_darah_puasa','reduksi','gula_darah_2jam','reduksi_2','gula_darah_sewaktu','gtt_puasa','gtt_1/2jam','gtt_1jam',
            'gtt_11/2jam','gtt_2jam','hb_A-1c','ii','cholesterol_total','hdl_cholesterol','ldl_cholesterol','triglycerida','lipid_total','cholesterol_ldl_direk','natrium','kalium','chlorida',
            'calsium','magnesium','pengecatan_gram','bta','mikroskopik_gonore','trikomonas','jamur','kultur_sensitivitas','batang_gram-','batang_gram+','coccus_gram-','coccus_gram+','trichomonas',
            'mikroskopik_candida','widal','salmonela_typhi_O','salmonela_typhi_h','salmonela_paratyphi_a_h','salmonela_paratyphi_ao','salmonela_paratyphi_bo','salmonela_paratyphi_co',
            'salmonela_paratyphi_bh','salmonela_paratyphi_ch','hbsag','hiv','tpha','hbsag','dengue_ig_g','dengue_ig_m','anti_hbsag','antihbc_total','hbc','anti_tb_ig_m','anti_tb_ig_g','hcv',
            'anti_hev_ig_m','anti_hev_ig_g','hbeag','anti_hbe','vdrl','asto','titer_reumatoid_factor','anti_hav_igm','anti_hcv','toxoplasma_ig_a','toxoplasma_ig_g','toxoplasma_ig_g','toxoplasma_ig_m',
            'rubella_ig_g','rubella_ig_m','anti_cmv_ig_g','anti_cmv_ig_m','anti_hsv2_ig_g','anti_hsv2_ig_m','tb_ict','tes_mantoux','dengue_ns1','anti_hbsag','chinkungunya_igm','salmonella_igg',
            'salmonella_igm','serum_iron','ca_125','leptospora_igm','tpha','hbsag','igm_anti_salmonella_typhi','anti_hbs_titer','urin_rutin','fisis_warna','kejernihan','bau','kimia_ph','berat_jenis',
            'protein','glukosa','urobillinogen','billirudin','keton','lekosit_esterase','nitrit','blood','sedimen_epitel','lekosit','erytrosit','silinder_granula','silinder_lekosit','kristal',
            'bakteri','trikomonas','candida','silinder_eritrosit','silinder_hyalin','warna','bau','konsistensi','mikroskopis','telur_cacing','amuba','sisa_pencernaan','protein','lemak','karbohidrat',
            'bensidin_test','metode','abstinensia','dikeluarkan_jam','diterima_di_lab_jam','diperiksa_jam','i_makroskopis','warna','liquefaksi','konsistensi','bau','volume','ph','ii_mikroskopis',
            'konsentrasi','motilitas','a_linier_cepat','b_linier_lambat','c_tidak_progressif','d_tidak_motil','viabilitas_(%hidup)','morfologi_(%normal)','morfologi_abnormal','sel_bulat','sel_leukosit',
            'aglutinasi','fruktosa','t3','t4','tsh','ft4','egfr','tshs','cea','afp','psa','cea','administrasi','lancet','spuit_3cc','spuit_5cc','vacutainer','wing_needle','spuit_1cc','spuit_3cc','amphetamine',
            'spuit_3cc','bzo_(benzodizepiner)','thc_(marijuana)','met_(methamphetamine)','tes_kehamilan','rhesus','golongan_darah'
        ];

        $res = [];
        foreach ($forms as $form) {
            if ($this->input->post($form)) {
                $res[$form] = $this->input->post($form);
            }
        }

        return json_encode($res);
    }

    public function hapus($id, $pendaftaran_id)
    {
        $ant = $this->db->query("SELECT * FROM antrian WHERE pendaftaran_id = $id")->row();
        $this->db->query("DELETE FROM antrian WHERE pendaftaran_id = $pendaftaran_id");
        $this->MainModel->delete('pemeriksaan', ['is_active' => 0], $id);
        $this->MainModel->delete('pendaftaran_pasien', ['is_active' => 0], $pendaftaran_id);

        $this->session->set_flashdata('success', 'Berhasil menghapus pemeriksaan');
        redirect('pemeriksaan/listpemeriksaanPasien', 'refresh');
    }

}
