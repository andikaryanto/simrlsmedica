<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('template');
        $this->load->Model('PendaftaranModel');
        $this->load->Model('LaporanModel');
        $this->load->Model('MainModel');
        $this->load->Model('PemeriksaanModel');
        $this->load->Model('PasienModel');
        $this->load->Model('PlaceModel');
        $this->load->Model('AdministrasiModel');
        $this->load->helper(['kode_booking', 'usia']);
    }

    public function index() {
        redirect('pendaftaran/listPendaftaranPasien');
    }

    public function listPendaftaranPasien() {
        $data['listPendaftaran'] = $this->PendaftaranModel->getListPasienAntri();
        $data['jaminan'] = $this->config->item('pendaftaran');
        $data['jenis_pendaftaran'] = $this->PendaftaranModel->getJenisPendaftaran();

        $d = date('Y-m-d 23:59:59', strtotime("+7 day"));
        $data['resume'] = $this->db->query("
            select a.due_date, jp.nama, count(pp.id) as total, pp.tipe_layanan, pp.jenis_pendaftaran_id from pendaftaran_pasien pp
            join jenis_pendaftaran jp on pp.jenis_pendaftaran_id = jp.id
            join antrian a on a.pendaftaran_id = pp.id
            join pasien p on pp.pasien = p.id and pp.is_active = 1
            join user u on pp.dokter = u.id and u.is_active = 1
            where date(a.due_date) <= '$d'
            and pp.is_active = 1
            and (pp.status = 'antri' or pp.status = 'diperiksa')
            group by pp.jenis_pendaftaran_id, date(a.due_date)
            order by a.due_date
        ")->result();

        $this->template->view('pendaftaran/list_pendaftaran_v', $data);
    }

    public function rencanaKunjunganPoliOrto()
    {
        $p = $this->PendaftaranModel->getListPasienSelesai(55);
        $pp = [];

        foreach ($p as &$q) {
            $q->pemeriksaan_selanjutnya = $q->form ? unserialize($q->form)['next'] : '';

            $d1 = date_create(date('Y-m-d', strtotime('now')));
            $d2 = date_create(date('Y-m-d', strtotime($q->pemeriksaan_selanjutnya)));
            $diff = (int)date_diff($d1, $d2)->format("%a");

            if (strtotime($q->pemeriksaan_selanjutnya) < strtotime('now') || $diff <= 7) {
                $pp[] = $q;
            }
        }

        $data['jenis_pendaftaran'] = $this->PendaftaranModel->getJenisPendaftaran();
        $data['jaminan'] = $this->config->item('pendaftaran');
        $data['listPendaftaran'] = $pp;

        $this->template->view('pendaftaran/list_rencana_kunjungan_poli_orto', $data);
    }

    public function rencanaKunjunganSunat()
    {
        $p = $this->PendaftaranModel->getListPasienSelesai(56);
        $pp = [];

        foreach ($p as &$q) {
            $q->pemeriksaan_selanjutnya = $q->form ? unserialize($q->form)['next'] : '';

            $d1 = date_create(date('Y-m-d', strtotime('now')));
            $d2 = date_create(date('Y-m-d', strtotime($q->pemeriksaan_selanjutnya)));
            $diff = (int)date_diff($d1, $d2)->format("%a");

            if (strtotime($q->pemeriksaan_selanjutnya) < strtotime('now') || $diff <= 7) {
                $pp[] = $q;
            }
        }

        $data['jaminan'] = $this->config->item('pendaftaran');
        $data['listPendaftaran'] = $pp;

        $this->template->view('pendaftaran/list_rencana_kunjungan_sunat', $data);
    }

    public function pendaftaran_baru($id_antrian = 0) {
        if ($this->input->post('submit') == 1) {
            $session = $this->session->userdata('logged_in');
            $id_jenis_pendaftaran = $this->input->post('jenis_pendaftaran');
            $data['jenis_pendaftaran'] = $this->PendaftaranModel->getJenisPendaftaran($id_jenis_pendaftaran)->row();
            $kode_pendaftaran = $data['jenis_pendaftaran']->kode;

            $cek_id = $this->PendaftaranModel->cek_id()->row_array(); //array dibuka
            $max_id = $cek_id['no_rm'];
            $max_id1 = (int)substr($max_id, 1); // dijadikan int
            $max_id2 = $max_id1 + 1; //ditambah 1

            if ($max_id2 < 10) {
                $no_rm = $kode_pendaftaran . '0000' . $max_id2;
            } else if ($max_id2 < 100) {
                $no_rm = $kode_pendaftaran . '000' . $max_id2;
            } else if ($max_id2 < 1000) {
                $no_rm = $kode_pendaftaran . '00' . $max_id2;
            } else {
                $no_rm = $kode_pendaftaran . '0' . $max_id2;
            }

            $pasien = array(
                'no_rm' => $this->input->post('no_rm'),
                'nama' => $this->input->post('nama'),
                'nik' => $this->input->post('nik'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'usia' => get_usia($this->input->post('tanggal_lahir')),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'jk' => $this->input->post('jenis_kelamin'),
                'alamat' => $this->input->post('alamat'),
                'alamat_domisili' => $this->input->post('alamat_domisili'),
                'telepon' => $this->input->post('telepon'),
                'agama' => $this->input->post('agama'),
                'pendidikan' => $this->input->post('pendidikan'),
                'perkawinan' => $this->input->post('perkawinan'),
                'pekerjaan' => $this->input->post('pekerjaan'),
                'creator' => $session->id,
                'provinsi_ktp' => $this->input->post('provinsi_ktp') ?? null,
                'kabupaten_ktp' => $this->input->post('kabupaten_ktp') ?? null,
                'kecamatan_ktp' => $this->input->post('kecamatan_ktp') ?? null,
                'desa_ktp' => $this->input->post('desa_ktp') ?? null,
                'provinsi_domisili' => $this->input->post('provinsi_domisili') ?? null,
                'kabupaten_domisili' => $this->input->post('kabupaten_domisili') ?? null,
                'kecamatan_domisili' => $this->input->post('kecamatan_domisili') ?? null,
                'desa_domisili' => $this->input->post('desa_domisili') ?? null,
            );

            $insert_id = $this->MainModel->insert_id($tabel = 'pasien', $pasien);

            $idJenisPendaftaranYangLangsungKePemeriksaan = [19, 55, 56];
            $apakaLangsungKePemeriksaan = in_array($this->input->post('jenis_pendaftaran'), $idJenisPendaftaranYangLangsungKePemeriksaan);

            $rm = array(
                'td' => $this->input->post('td'),
                'r' => $this->input->post('r'),
                'bb' => $this->input->post('bb'),
                'n' => $this->input->post('n'),
                's' => $this->input->post('s'),
                'tb' => $this->input->post('tb'),
                'bmi' => $this->input->post('bmi'),
                'no_rm' => $this->input->post('no_rm'),
                'pasien' => $insert_id,
                'penanggungjawab' => $this->input->post('penanggungjawab'),
                'biopsikososial' => $this->input->post('biopsikososial'),
                'jenis_pendaftaran_id' => $this->input->post('jenis_pendaftaran'),
                'jaminan' => $this->input->post('jaminan'),
                'no_jaminan' => $this->input->post('no_jaminan'),
                'dokter' => $this->input->post('dokter'),
                'status' => $apakaLangsungKePemeriksaan? 'diperiksa' : 'antri',
                'is_bpjs' => (isset($_POST['pasien_bpjs']) ? 1 : 0),
                'creator' => $session->id,
                'surat' => $this->input->post('surat'),
                'sifat' => $this->input->post('sifat'),
                'tipe_layanan' => $this->input->post('tipe_layanan'),
                'rujukan' => $this->input->post('rujukan'),
            );

            if ($this->input->post('due_date') != date('Y-m-d')) {
                $rm['created_at'] = $this->input->post('due_date');
                $rm['waktu_pendaftaran'] = $this->input->post('due_date');
            }

            $insert_id2 = $this->MainModel->insert_id($tabel = 'pendaftaran_pasien', $rm);

            $periksa = array(
                'pendaftaran_id'    => $insert_id2,
                'dokter_id'         => $this->input->post('dokter'),
                'pasien_id'         => $insert_id,
                'perawat_id'        => '',
                'no_rm'             => $this->input->post('no_rm'),
                'nama_pasien'       => $this->input->post('nama'),
                'keluhan_utama'     => '',
                'diagnosa_perawat'  => '',
                'asuhan_keperawatan'=> '',
                'bmi'               => '',
                'td'                => '',
                'r'                 => '',
                'bb'                => '',
                'n'                 => '',
                's'                 => '',
                'tb'                => '',
                'is_bpjs'           => 0,
                'jaminan'           => $this->input->post('jaminan'),
                'status'            => 'sudah_periksa_awal',
                'sudah_periksa_perawat' => ($apakaLangsungKePemeriksaan && $this->input->post('jenis_pendaftaran') != 19) ? 1 : 0,
                'creator'           => $this->session->userdata('logged_in')->id
            );
            $pemeriksaan_id = $this->MainModel->insert_id($tabel = 'pemeriksaan', $periksa);

            $this->MainModel->insert_id('antrian', [
                'pendaftaran_id' => $insert_id2,
                'pemeriksaan_id' => $pemeriksaan_id,
                'jenis_pendaftaran_id' => $this->input->post('jenis_pendaftaran'),
                'pasien_id' => $this->input->post('id'),
                'due_date' => $this->input->post('due_date'),
                'kode_antrian' => generateKodeAntrian($this->input->post('jenis_pendaftaran'), date('Y-m-d')),
                'is_check_in' => true,
                'check_in_at' => date('Y-m-d H:i'),
                'kode_booking' => generateKodeBooking()
            ]);

            $id_antrian_fo = $this->input->post('id_antrian');
            if ($id_antrian_fo) {
                $this->db->where('id', $id_antrian_fo)->update('antrian_front_office', [
                    'mulai_tunggu_poli_at' => date('Y-m-d H:i:s'),
                    'pendaftaran_id' => $insert_id2,
                    'pemeriksaan_id' => $pemeriksaan_id,
                ]);
            }

            if ($insert_id2) {
                $this->session->set_flashdata('success', 'Pendaftaran pasien berhasil!');
                redirect('pendaftaran/listPendaftaranPasien', 'refresh');
            }

        } else {
            $data['no_rm_auto'] = $this->PasienModel->getNoRmAuto();
            $data['jenis_pendaftaran'] = $this->PendaftaranModel->getJenisPendaftaran();
            $data['dokter'] = $this->PendaftaranModel->getDokter();
            $data['jaminan'] = $this->config->item('pendaftaran');
            $data['provinces'] = $this->PlaceModel->getProvinces();
            $data['regencies'] = $this->PlaceModel->getregencies();
            $data['districts'] = $this->PlaceModel->getDistricts();
            $data['id_antrian'] = $id_antrian;

            $this->template->view('pendaftaran/pendaftaran_v', $data);
        }

    }

    public function pendaftaran_baruqw() {
        if ($this->input->post('submit') == 1) {
            $session = $this->session->userdata('logged_in');
            $id_jenis_pendaftaran = $this->input->post('jenis_pendaftaran');
            $data['jenis_pendaftaran'] = $this->PendaftaranModel->getJenisPendaftaran($id_jenis_pendaftaran)->row();
            $kode_pendaftaran = $data['jenis_pendaftaran']->kode;

            $cek_id = $this->PendaftaranModel->cek_id()->row_array(); //array dibuka
            $max_id = $cek_id['no_rm'];
            $max_id1 = (int)substr($max_id, 1); // dijadikan int
            $max_id2 = $max_id1 + 1; //ditambah 1

            if ($max_id2 < 10) {
                $no_rm = $kode_pendaftaran . '0000' . $max_id2;
            } else if ($max_id2 < 100) {
                $no_rm = $kode_pendaftaran . '000' . $max_id2;
            } else if ($max_id2 < 1000) {
                $no_rm = $kode_pendaftaran . '00' . $max_id2;
            } else {
                $no_rm = $kode_pendaftaran . '0' . $max_id2;
            }


            $tanggal = $this->input->post('tanggal_lahir');


            $tanggal_lahir = strtotime($tanggal);
            $sekarang = time(); // Waktu sekarang
            $diff = $sekarang - $tanggal_lahir;
            $umurtahun = floor($diff / (60 * 60 * 24 * 365));
            $sisatahun = $diff % (60 * 60 * 24 * 365);

            $umurbulan = floor($sisatahun / (60 * 60 * 24 * 30));
            $sisabulan = $sisatahun % (60 * 60 * 24 * 30);

            $umurhari = floor($sisabulan / (60 * 60 * 24 * 30));


            //print_r(substr($no_rm, 0,1).substr($no_rm, -5));die();
            $pasien = array(
                'no_rm' => $no_rm,
                'nama' => $this->input->post('nama'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'usia' => $umurtahun . " tahun " . $umurbulan . " bulan " . $umurhari . " hari",
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'jk' => $this->input->post('jenis_kelamin'),
                'alamat' => $this->input->post('alamat'),
                'telepon' => $this->input->post('telepon'),
                'pekerjaan' => $this->input->post('pekerjaan'),
                'creator' => $session->id
            );

            //print_r($insert);die();
            $insert_id = $this->MainModel->insert_id($tabel = 'pasien', $pasien);

            // tanggal lahir

            $rm = array(
                'no_rm' => $no_rm,
                'pasien' => $insert_id,
                'penanggungjawab' => $this->input->post('penanggungjawab'),
                'biopsikososial' => $this->input->post('biopsikososial'),
                'jenis_pendaftaran_id' => $this->input->post('jenis_pendaftaran'),
                'asuhan_keperawatan' => $this->input->post('asuhan'),
                'dokter' => $this->input->post('dokter'),
                'creator' => $session->id
            );

            $insert2 = $this->MainModel->insert($tabel = 'pendaftaran_pasien', $rm);

            if ($insert2) {
                $this->session->set_flashdata('success', 'Pendaftaran pasien berhasil!');
                redirect('pendaftaran/listPendaftaranPasien', 'refresh');
            }


        } else {
            $data['jenis_pendaftaran'] = $this->PendaftaranModel->getJenisPendaftaran();
            $data['dokter'] = $this->PendaftaranModel->getDokter();
            $this->template->view('pendaftaran/pendaftaran_v', $data);
        }

    }


    public function pendaftaran_lama() {
        if ($this->input->post('submit') == 1) {
            $session = $this->session->userdata('logged_in');

            $idJenisPendaftaranYangLangsungKePemeriksaan = [19, 55, 56];
            $apakaLangsungKePemeriksaan = in_array($this->input->post('jenis_pendaftaran'), $idJenisPendaftaranYangLangsungKePemeriksaan);

            $id = $this->input->post('id');
            $user = array(
                'nama' => $this->input->post('nama'),
                'nik' => $this->input->post('nik'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'usia' => get_usia($this->input->post('tanggal_lahir')),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'jk' => $this->input->post('jenis_kelamin'),
                'alamat' => $this->input->post('alamat'),
                'alamat_domisili' => $this->input->post('alamat_domisili'),
                'telepon' => $this->input->post('telepon'),
                'agama' => $this->input->post('agama'),
                'pendidikan' => $this->input->post('pendidikan'),
                'perkawinan' => $this->input->post('perkawinan'),
                'pekerjaan' => $this->input->post('pekerjaan'),
                'creator' => $session->id,
             );
            $a = $this->MainModel->update($tabel='pasien', $user,$id);

            $rm = array(
                'td' => $this->input->post('td'),
                'r' => $this->input->post('r'),
                'bb' => $this->input->post('bb'),
                'n' => $this->input->post('n'),
                's' => $this->input->post('s'),
                'tb' => $this->input->post('tb'),
                'bmi' => $this->input->post('bmi'),
                'no_rm' => $this->input->post('no_rm'),
                'pasien' => $this->input->post('id'),
                'penanggungjawab' => $this->input->post('penanggungjawab'),
                'biopsikososial' => $this->input->post('biopsikososial'),
                'jenis_pendaftaran_id' => $this->input->post('jenis_pendaftaran'),
                'jaminan' => $this->input->post('jaminan'),
                'no_jaminan' => $this->input->post('no_jaminan'),
                'dokter' => $this->input->post('dokter'),
                'status' => $apakaLangsungKePemeriksaan? 'diperiksa' : 'antri',
                'is_bpjs' => (isset($_POST['pasien_bpjs']) ? 1 : 0),
                'creator' => $session->id,
                'surat' => $this->input->post('surat'),
                'sifat' => $this->input->post('sifat'),
                'tipe_layanan' => $this->input->post('tipe_layanan'),
                'rujukan' => $this->input->post('rujukan'),
            );

            if ($this->input->post('due_date') != date('Y-m-d')) {
                $rm['created_at'] = $this->input->post('due_date');
                $rm['waktu_pendaftaran'] = $this->input->post('due_date');
            }

            $insert = $this->MainModel->insert_id($tabel = 'pendaftaran_pasien', $rm);

            $periksa = array(
                'pendaftaran_id'    => $insert,
                'dokter_id'         => $this->input->post('dokter'),
                'pasien_id'         => $this->input->post('id'),
                'perawat_id'        => '',
                'no_rm'             => $this->input->post('no_rm'),
                'nama_pasien'       => $this->input->post('nama'),
                'keluhan_utama'     => '',
                'diagnosa_perawat'  => '',
                'asuhan_keperawatan'=> '',
                'bmi'               => '',
                'td'                => '',
                'r'                 => '',
                'bb'                => '',
                'n'                 => '',
                's'                 => '',
                'tb'                => '',
                'is_bpjs'           => 0,
                'jaminan'           => $this->input->post('jaminan'),
                'status'            => 'sudah_periksa_awal',
                'sudah_periksa_perawat' => ($apakaLangsungKePemeriksaan && $this->input->post('jenis_pendaftaran') != 19) ? 1 : 0,
                'creator'           => $this->session->userdata('logged_in')->id
            );
            $pemeriksaan_id = $this->MainModel->insert_id($tabel = 'pemeriksaan', $periksa);

            $this->MainModel->insert_id('antrian', [
                'pendaftaran_id' => $insert,
                'pemeriksaan_id' => $pemeriksaan_id,
                'jenis_pendaftaran_id' => $this->input->post('jenis_pendaftaran'),
                'pasien_id' => $this->input->post('id'),
                'due_date' => $this->input->post('due_date'),
                'kode_antrian' => generateKodeAntrian($this->input->post('jenis_pendaftaran'), date('Y-m-d')),
                'is_check_in' => true,
                'check_in_at' => date('Y-m-d H:i'),
                'kode_booking' => generateKodeBooking()
            ]);

            $id_antrian_fo = $this->input->post('id_antrian');
            if ($id_antrian_fo) {
                $this->db->where('id', $id_antrian_fo)->update('antrian_front_office', [
                    'mulai_tunggu_poli_at' => date('Y-m-d H:i:s'),
                    'pendaftaran_id' => $insert,
                    'pemeriksaan_id' => $pemeriksaan_id,
                ]);
            }

            if ($insert) {
                $this->session->set_flashdata('success', 'Pendaftaran pasien berhasil!');
                redirect('pendaftaran/listPendaftaranPasien', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Pendaftaran pasien gagal!');
                redirect('pendaftaran/pendaftaran_lama', 'refresh');
            }


        } else {
            $id = $this->input->post('id_pasien');
            //print_r($id);die();
            $data['jenis_pendaftaran'] = $this->PendaftaranModel->getJenisPendaftaran();
            $data['dokter'] = $this->PendaftaranModel->getDokter();
            $data['pasien'] = $this->PendaftaranModel->getPasienById($id)->row();
            $data['jaminan'] = $this->config->item('pendaftaran');
            //print_r($data['pasien']);die();
            $this->template->view('pendaftaran/pendaftaran_lama_v', $data);
        }

    }

    public function pendaftaran_lama2($id_antrian = 0) {
        $id = $this->input->post('id_pasien') ?? $this->session->flashdata('id_pasien');

        $data['jenis_pendaftaran'] = $this->PendaftaranModel->getJenisPendaftaran();
        $data['dokter'] = $this->PendaftaranModel->getDokter();
        $data['pasien'] = $this->PendaftaranModel->getPasienById($id)->row();
        $data['pemeriksaan'] = $this->PendaftaranModel->getPemeriksaanPasienById($id)->result();

        $data['tindakan'] = $this->LaporanModel->getTindakanById($id);
        $data['obat'] = $this->LaporanModel->getObatPemeriksaanById($id);
        $data['penyakit'] = $this->LaporanModel->getPenyakitPemeriksaanById($id);
        $data['racikan'] = $this->LaporanModel->getRacikanPemeriksaan();
        $data['pendaftaran'] = $this->PendaftaranModel->getPendaftaranByIdPasien($id)->row();
        $data['jaminan'] = $this->config->item('pendaftaran');
        $data['id_antrian'] = $id_antrian;

        $this->template->view('pendaftaran/pendaftaran_lama2_v', $data);
    }

    public function cari() {
        $no_rm = $this->input->get('no_rm');
        $cari = $this->PendaftaranModel->cari($no_rm)->result();
        echo json_encode($cari);
    }

    public function ajax_kode() {
        if ($this->input->is_ajax_request()) {
            $keyword = $this->input->post('keyword');


            $pasien = $this->PendaftaranModel->cari_kode($keyword);

            if ($pasien->num_rows() > 0) {
                $json['status'] = 1;
                $json['datanya'] = "<ul id='daftar-autocomplete'>";
                foreach ($pasien->result() as $b) {
                    $json['datanya'] .= "
						<li>
						    <span id='kodenya' style='display: none;'>" . $b->id . "</span>
							<b>NO RM</b> :
							<span id='no_rmnya'>" . $b->no_rm . "</span> <br />
							<b>NIK</b> :
							<span id='niknya'>" . $b->nik . "</span> <br />
							<b>Nama</b> :
							<span id='namanya'>" . $b->nama . "</span> <br />
							<b>Alamat</b> :
							<span id='alamatnya'>" . $b->alamat . "</span> <br />

						</li>
					";
                }
                $json['datanya'] .= "</ul>";
            } else {
                $json['status'] = 0;
            }

            echo json_encode($json);
        }
    }

    public function barcode_kode() {
        if ($this->input->is_ajax_request()) {
            $keyword = $this->input->post('keyword');


            $pasien = $this->PendaftaranModel->cari_kode($keyword);
            if ($pasien->num_rows() > 0) {

                $json['status'] = 1;
                foreach ($pasien->result() as $b) {

                    $json['kode'] = $b->id;
                    $json['no_rm'] = $b->no_rm;
                    $json['nama'] = $b->nama;

                }
            } else {

                $json['pesan'] = "Keyword Yang Dimasukkan Belum Terdaftar";
                $json['status'] = 0;

            }
            echo json_encode($json);
        }
    }

    public function hapus_pendaftaran($id) {
        if ($this->PendaftaranModel->hapusPendaftaran($id)) {
            $this->session->set_flashdata('success', 'Data pendaftaran berhasil dihapus!');
            redirect('pendaftaran/listPendaftaranPasien');
        }
        else {
            $this->session->set_flashdata('warning', 'Data pendaftaran gagal dihapus!');
            redirect('pendaftaran/listPendaftaranPasien');
        }
    }

    public function villages($district_id)
    {
        $res = $this->db->query("SELECT * FROM villages WHERE district_id = {$district_id}")->result();
        echo json_encode($res);
    }

    public function set_jenis($pemeriksaan_id, $jaminan)
    {
        $pem = $this->db->query("SELECT * FROM pemeriksaan WHERE id = $pemeriksaan_id")->row();
        $this->MainModel->update('pemeriksaan', ['jaminan' => $jaminan], $pemeriksaan_id);
        $this->MainModel->update('pendaftaran_pasien', ['jaminan' => $jaminan], $pem->pendaftaran_id);

        $this->session->set_flashdata('success', 'Berhasil mengubah jenis pendaftaran');
        redirect('Administrasi/listPasienSelesaiPeriksa');
    }

    public function cetak_kartu($pendaftaran_id = 0)
    {
        if ($pendaftaran_id) {
            $pendaftaran = $this->db->query("SELECT * FROM pendaftaran_pasien WHERE id = $pendaftaran_id")->row();
            $data['pasien'] = $this->db->query("SELECT * FROM pasien WHERE id = $pendaftaran->pasien")->row();
            $data['klinik'] = $this->AdministrasiModel->getKlinik()->row();

            $this->load->view('pendaftaran/print_kartu', $data);
        }
        else {
            $data['listPendaftaran'] = $this->PendaftaranModel->getListPasienCetakKartu();
            $data['jaminan'] = $this->config->item('pendaftaran');

            $this->template->view('pendaftaran/cetak_kartu', $data);
        }
    }
}
