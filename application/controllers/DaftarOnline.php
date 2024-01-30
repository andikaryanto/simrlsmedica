<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DaftarOnline extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('template');
        $this->load->Model('PendaftaranModel');
        $this->load->Model('LaporanModel');
        $this->load->Model('MainModel');
        $this->load->Model('PemeriksaanModel');
        $this->load->Model('PasienModel');
        $this->load->Model('PlaceModel');
        $this->load->helper(['kode_booking', 'usia']);
    }

    public function index()
    {
        $data['listPendaftaran'] = $this->PendaftaranModel->getListPasienAntri();
        $data['jaminan'] = $this->config->item('pendaftaran');
        $data['jenis_pendaftaran'] = $this->PendaftaranModel->getJenisPendaftaran();

        $this->load->view('pendaftaran/list_pendaftaran_online', $data);
    }

    private function getNextNoRm()
    {
        $m = date('Ym');
        $p = $this->db->query("SELECT * FROM pasien WHERE no_rm like '$m%' ORDER BY no_rm DESC")->row();
        $no = $p && $p->no_rm ? str_pad(((int) substr($p->no_rm, -4)) + 1, 4, '0', STR_PAD_LEFT) : '0001';
        return date('Ym').$no;
    }

    public function baru($id_antrian = 0)
    {
        if ($this->input->post('submit') == 1) {
            $id_jenis_pendaftaran = $this->input->post('jenis_pendaftaran');
            $data['jenis_pendaftaran'] = $this->PendaftaranModel->getJenisPendaftaran($id_jenis_pendaftaran)->row();

            $pasien = array(
                'no_rm' => $this->getNextNoRm(),
                'no_bpjs' => $this->input->post('no_jaminan') ?? '',
                'nama' => $this->input->post('nama'),
                'nik' => $this->input->post('nik'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'usia' => get_usia($this->input->post('tanggal_lahir')),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'jk' => $this->input->post('jenis_kelamin'),
                'alamat' => $this->input->post('alamat'),
                'alamat_domisili' => $this->input->post('alamat_domisili'),
                'telepon' => $this->input->post('telepon'),
                'pekerjaan' => $this->input->post('pekerjaan'),
                'agama' => $this->input->post('agama'),
                'tingkat_pendidikan' => $this->input->post('tingkat_pendidikan'),
                'penanggungjawab' => $this->input->post('penanggungjawab'),
                'creator' => 1,
                'provinsi_ktp' => $this->input->post('provinsi_ktp') ?? null,
                'kabupaten_ktp' => $this->input->post('kabupaten_ktp') ?? null,
                'kecamatan_ktp' => $this->input->post('kecamatan_ktp') ?? null,
                'desa_ktp' => $this->input->post('desa_ktp') ?? null,
                'provinsi_domisili' => $this->input->post('provinsi_domisili') ?? null,
                'kabupaten_domisili' => $this->input->post('kabupaten_domisili') ?? null,
                'kecamatan_domisili' => $this->input->post('kecamatan_domisili') ?? null,
                'desa_domisili' => $this->input->post('desa_domisili') ?? null,
            );

            if ($this->input->post('jaminan') == 'bpjs' && $this->input->post('no_jaminan')) {
                $pasien['no_bpjs'] = $this->input->post('no_jaminan');
            }

            $insert_id = $this->MainModel->insert_id($tabel = 'pasien', $pasien);

            $idJenisPendaftaranYangLangsungKePemeriksaan = [19, 25, 44, 45, 40, 41, 42, 43, 59];
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
                'jenis_kunjungan' => $this->input->post('jenis_kunjungan'),
                'jaminan' => $this->input->post('jaminan') ?? 'umum',
                'no_jaminan' => $this->input->post('no_jaminan'),
                'nomor_rujukan' => $this->input->post('nomor_rujukan') ?? null,
                'dokter' => $this->input->post('dokter'),
                'status' => $apakaLangsungKePemeriksaan ? 'diperiksa' : 'antri',
                'is_bpjs' => (isset($_POST['pasien_bpjs']) ? 1 : 0),
                'creator' => 1
            );

            $insert_id2 = $this->MainModel->insert_id($tabel = 'pendaftaran_pasien', $rm);

            if ($apakaLangsungKePemeriksaan || $this->input->post('jenis_pendaftaran') == 58) {
                $periksa = array(
                    'pendaftaran_id' => $insert_id2,
                    'dokter_id' => $this->input->post('dokter'),
                    'pasien_id' => $insert_id,
                    'perawat_id' => '',
                    'no_rm' => $this->input->post('no_rm'),
                    'nama_pasien' => $this->input->post('nama'),
                    'keluhan_utama' => '',
                    'diagnosa_perawat' => '',
                    'asuhan_keperawatan' => '',
                    'bmi' => '',
                    'td' => '',
                    'r' => '',
                    'bb' => '',
                    'n' => '',
                    's' => '',
                    'tb' => '',
                    'is_bpjs' => 0,
                    'jaminan' => $this->input->post('jaminan'),
                    'status' => $this->input->post('jenis_pendaftaran') == 58 ? 'belum' : 'sudah_periksa_awal',
                    'creator' => $this->session->userdata('logged_in')->id
                );
                $pemeriksaan_id = $this->MainModel->insert_id($tabel = 'pemeriksaan', $periksa);
            }
            else {
                $pemeriksaan_id = null;
            }

            $kode_booking = generateKodeBooking();
            $id_antrian = $this->MainModel->insert_id('antrian', [
                'pendaftaran_id' => $insert_id2,
                'pemeriksaan_id' => $pemeriksaan_id,
                'jenis_pendaftaran_id' => $this->input->post('jenis_pendaftaran'),
                'pasien_id' => $insert_id,
                'due_date' => date('Y-m-d'),
                'kode_antrian' => generateKodeAntrian($this->input->post('jenis_pendaftaran'), date('Y-m-d')),
                'is_check_in' => true,
                'check_in_at' => date('Y-m-d H:i'),
                'kode_booking' => $kode_booking
            ]);

            $jns = $this->db->query("SELECT * FROM jenis_pendaftaran WHERE id = {$this->input->post('jenis_pendaftaran')}")->row();
            $dok = $this->db->query("SELECT * FROM user WHERE id = {$this->input->post('dokter')}")->row();
            $ant = $this->db->query("SELECT * FROM antrian WHERE id = $id_antrian")->row();
            $due_date = date('Y-m-d');
            $total_antrian_jkn = $this->db->query("SELECT * FROM antrian JOIN pendaftaran_pasien pp ON pp.id = antrian.pendaftaran_id WHERE antrian.jenis_pendaftaran_id = $jns->id AND due_date = '$due_date' AND pp.jaminan = 'bpjs'")->result();
            $total_antrian_non_jkn = $this->db->query("SELECT * FROM antrian JOIN pendaftaran_pasien pp ON pp.id = antrian.pendaftaran_id WHERE antrian.jenis_pendaftaran_id = $jns->id AND due_date = '$due_date' AND pp.jaminan != 'bpjs'")->result();
            $sisa_antrian = $this->db->query("SELECT * FROM antrian WHERE jenis_pendaftaran_id = $jns->id AND due_date = '$due_date' AND is_called = 0")->result();
            $c = count($sisa_antrian);
            $b = ($c - 1) * 15;
            $t = strtotime("+$b minutes");
            $body = [
                "kodebooking" => $kode_booking,
                "jenispasien" => $this->input->post('jaminan') == 'bpjs' ? 'JKN' : 'NON JKN',
                "nomorkartu" => $this->input->post('no_jaminan') ?? '',
                'nik' => $this->input->post('nik'),
                'nohp' => $this->input->post('telepon'),
                'kodepoli' => $jns->kode_bpjs ? explode(',', $jns->kode_bpjs)[0] : '',
                "namapoli" => $jns->nama,
                "pasienbaru" => 1,
                "norm" => $this->input->post('no_rm'),
                "tanggalperiksa" => date('Y-m-d'),
                "kodedokter" => (int)($dok->bpjs_id ?? '0'),
                "namadokter" => $dok->nama,
                "jampraktek" => '08:00-16:00',
                "jeniskunjungan" => $this->input->post('jenis_kunjungan'),
                "nomorreferensi" => $this->input->post('nomor_rujukan') ?? '',
                "nomorantrean" => $ant->kode_antrian,
                "angkaantrean" => (int) preg_replace("/[^0-9]/", "", $ant->kode_antrian),
                "estimasidilayani" => $t,
                "sisakuotajkn" => $jns->kuota_jkn - count($total_antrian_jkn),
                "kuotajkn" => (int) $jns->kuota_jkn,
                "sisakuotanonjkn" => $jns->kuota_non_jkn - count($total_antrian_non_jkn),
                "kuotanonjkn" => (int) $jns->kuota_non_jkn,
                "keterangan" => "Peserta harap 60 menit lebih awal guna pencatatan administrasi.",
            ];
            $res = $this->post("{$this->base_url_antrean}antrean/add", json_encode($body), true);
            $this->MainModel->insert('bpjs_jknmobile_log', [
                'url' => 'antrean/add',
                'header' => 'pend-baru',
                'request' => json_encode($body),
                'response' => json_encode($res),
            ]);

            $id_antrian_fo = $this->input->post('id_antrian');
            if ($id_antrian_fo) {
                $this->db->where('id', $id_antrian_fo)->update('antrian_front_office', [
                    'mulai_tunggu_poli_at' => date('Y-m-d H:i:s'),
                    'pendaftaran_id' => $insert_id2,
                    'pemeriksaan_id' => $pemeriksaan_id,
                ]);
                $a = $this->db->query("SELECT * FROM antrian_front_office WHERE id = $id_antrian_fo")->row();
                if ($a) {
                    foreach ([1,2,3] as $v) {
                        $waktu = $v == 1 ? $a->mulai_tunggu_admisi_at : ($v == 2 ? $a->mulai_layan_admisi_at : $a->mulai_tunggu_poli_at);
                        $task_body = ['kodebooking' => $kode_booking, 'taskid' => $v, 'waktu' => strtotime($waktu).'000'];
                        $this->MainModel->insert('bpjs_jknmobile_log', [
                            'url' => 'antrean/updatewaktu',
                            'header' => 'task '.$v,
                            'request' => json_encode($task_body),
                            'response' => json_encode($this->post("{$this->base_url_antrean}antrean/updatewaktu", json_encode($task_body), true)),
                        ]);
                    }
                }
            }
            else {
                foreach ([1,2,3] as $v) {
                    $task_body = ['kodebooking' => $kode_booking, 'taskid' => $v, 'waktu' => time().'000'];
                    $this->MainModel->insert('bpjs_jknmobile_log', [
                        'url' => 'antrean/updatewaktu',
                        'header' => 'task '.$v,
                        'request' => json_encode($task_body),
                        'response' => json_encode($this->post("{$this->base_url_antrean}antrean/updatewaktu", json_encode($task_body), true)),
                    ]);
                }
            }

            if ($insert_id2) {
                $this->session->set_flashdata('success', 'Pendaftaran pasien berhasil!');
                redirect('DaftarOnline', 'refresh');
            }

        } else {
            $data['no_rm_auto'] = $this->getNextNoRm();
            $data['jenis_pendaftaran'] = $this->PendaftaranModel->getJenisPendaftaran();
            $data['dokter'] = $this->PendaftaranModel->getDokter();
            $data['jaminan'] = $this->config->item('pendaftaran');
            $data['provinces'] = $this->PlaceModel->getProvinces();
            $data['regencies'] = $this->PlaceModel->getregencies();
            $data['districts'] = $this->PlaceModel->getDistricts();
            $data['base_url_vclaim'] = '' /*MY_BpjsController::$base_url_vclaim_*/;
            $data['id_antrian'] = $id_antrian;

            $this->load->view('pendaftaran/pendaftaran_baru_online', $data);
        }
    }

    public function lama()
    {
        if ($this->input->post('submit') == 1) {

            $idJenisPendaftaranYangLangsungKePemeriksaan = [19, 25, 44, 45, 40, 41, 42, 43, 59];
            $apakaLangsungKePemeriksaan = in_array($this->input->post('jenis_pendaftaran'), $idJenisPendaftaranYangLangsungKePemeriksaan);

            $id = $this->input->post('id');
            $user = array(
                'nama' => $this->input->post('nama'),
                'no_bpjs' => $this->input->post('no_jaminan'),
                'nik' => $this->input->post('nik'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'usia' => get_usia($this->input->post('tanggal_lahir')),
                'jk' => $this->input->post('jenis_kelamin'),
                'alamat' => $this->input->post('alamat'),
                'alamat_domisili'          =>$this->input->post('alamat_domisili'),
                'telepon' => $this->input->post('telepon'),
                'pekerjaan' => $this->input->post('pekerjaan'),
                'agama' => $this->input->post('agama'),
                'tingkat_pendidikan' => $this->input->post('tingkat_pendidikan'),
                'penanggungjawab' => $this->input->post('penanggungjawab'),
                'creator' => 1
            );

            if ($this->input->post('jaminan') == 'bpjs' && $this->input->post('no_jaminan')) {
                $pasien['no_bpjs'] = $this->input->post('no_jaminan');
            }

            $a = $this->MainModel->update($tabel = 'pasien', $user, $id);

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
                'jenis_kunjungan' => $this->input->post('jenis_kunjungan'),
                'jaminan' => $this->input->post('jaminan') ?? 'umum',
                'no_jaminan' => $this->input->post('no_jaminan'),
                'nomor_rujukan' => $this->input->post('nomor_rujukan') ?? null,
                'dokter' => $this->input->post('dokter'),
                'status' => $apakaLangsungKePemeriksaan ? 'diperiksa' : 'antri',
                'is_bpjs' => (isset($_POST['pasien_bpjs']) ? 1 : 0),
                'creator' => 1
            );

            $insert = $this->MainModel->insert_id($tabel = 'pendaftaran_pasien', $rm);

            if ($apakaLangsungKePemeriksaan || $this->input->post('jenis_pendaftaran') == 58) {
                $periksa = array(
                    'pendaftaran_id' => $insert,
                    'dokter_id' => $this->input->post('dokter'),
                    'pasien_id' => $this->input->post('id'),
                    'perawat_id' => '',
                    'no_rm' => $this->input->post('no_rm'),
                    'nama_pasien' => $this->input->post('nama'),
                    'keluhan_utama' => '',
                    'diagnosa_perawat' => '',
                    'asuhan_keperawatan' => '',
                    'bmi' => '',
                    'td' => '',
                    'r' => '',
                    'bb' => '',
                    'n' => '',
                    's' => '',
                    'tb' => '',
                    'is_bpjs' => 0,
                    'jaminan' => $this->input->post('jaminan'),
                    'status' => $this->input->post('jenis_pendaftaran') == 58 ? 'belum' : 'sudah_periksa_awal',
                    'creator' => $this->session->userdata('logged_in')->id
                );
                $pemeriksaan_id = $this->MainModel->insert_id($tabel = 'pemeriksaan', $periksa);
            }
            else {
                $pemeriksaan_id = null;
            }

            $kode_booking = generateKodeBooking();
            $id_antrian = $this->MainModel->insert_id('antrian', [
                'pendaftaran_id' => $insert,
                'pemeriksaan_id' => $pemeriksaan_id,
                'jenis_pendaftaran_id' => $this->input->post('jenis_pendaftaran'),
                'pasien_id' => $this->input->post('id'),
                'due_date' => date('Y-m-d'),
                'kode_antrian' => generateKodeAntrian($this->input->post('jenis_pendaftaran'), date('Y-m-d')),
                'is_check_in' => true,
                'check_in_at' => date('Y-m-d H:i'),
                'kode_booking' => $kode_booking
            ]);

            $jns = $this->db->query("SELECT * FROM jenis_pendaftaran WHERE id = {$this->input->post('jenis_pendaftaran')}")->row();
            $dok = $this->db->query("SELECT * FROM user WHERE id = {$this->input->post('dokter')}")->row();
            $ant = $this->db->query("SELECT * FROM antrian WHERE id = $id_antrian")->row();
            $due_date = date('Y-m-d');
            $total_antrian_jkn = $this->db->query("SELECT * FROM antrian JOIN pendaftaran_pasien pp ON pp.id = antrian.pendaftaran_id WHERE antrian.jenis_pendaftaran_id = $jns->id AND due_date = '$due_date' AND pp.jaminan = 'bpjs'")->result();
            $total_antrian_non_jkn = $this->db->query("SELECT * FROM antrian JOIN pendaftaran_pasien pp ON pp.id = antrian.pendaftaran_id WHERE antrian.jenis_pendaftaran_id = $jns->id AND due_date = '$due_date' AND pp.jaminan != 'bpjs'")->result();
            $sisa_antrian = $this->db->query("SELECT * FROM antrian WHERE jenis_pendaftaran_id = $jns->id AND due_date = '$due_date' AND is_called = 0")->result();
            $c = count($sisa_antrian);
            $b = ($c - 1) * 15;
            $t = strtotime("+$b minutes");
            $body = [
                "kodebooking" => $kode_booking,
                "jenispasien" => $this->input->post('jaminan') == 'bpjs' ? 'JKN' : 'NON JKN',
                "nomorkartu" => $this->input->post('no_jaminan') ?? '',
                'nik' => $this->input->post('nik'),
                'nohp' => $this->input->post('telepon'),
                'kodepoli' => $jns->kode_bpjs ? explode(',', $jns->kode_bpjs)[0] : '',
                "namapoli" => $jns->nama,
                "pasienbaru" => 0,
                "norm" => $this->input->post('no_rm'),
                "tanggalperiksa" => date('Y-m-d'),
                "kodedokter" => (int)($dok->bpjs_id ?? '0'),
                "namadokter" => $dok->nama,
                "jampraktek" => '08:00-16:00',
                "jeniskunjungan" => $this->input->post('jenis_kunjungan'),
                "nomorreferensi" => $this->input->post('nomor_rujukan') ?? '',
                "nomorantrean" => $ant->kode_antrian,
                "angkaantrean" => (int) preg_replace("/[^0-9]/", "", $ant->kode_antrian),
                "estimasidilayani" => $t,
                "sisakuotajkn" => $jns->kuota_jkn - count($total_antrian_jkn),
                "kuotajkn" => (int) $jns->kuota_jkn,
                "sisakuotanonjkn" => $jns->kuota_non_jkn - count($total_antrian_non_jkn),
                "kuotanonjkn" => (int) $jns->kuota_non_jkn,
                "keterangan" => "Peserta harap 60 menit lebih awal guna pencatatan administrasi.",
            ];
            $res = $this->post("{$this->base_url_antrean}antrean/add", json_encode($body), true);
            $this->MainModel->insert('bpjs_jknmobile_log', [
                'url' => 'antrean/add',
                'header' => 'pend-lama',
                'request' => json_encode($body),
                'response' => json_encode($res),
                'ws_bpjs_request' => '',
                'ws_bpjs_response' => '',
            ]);

            $id_antrian_fo = $this->input->post('id_antrian');
            if ($id_antrian_fo) {
                $this->db->where('id', $id_antrian_fo)->update('antrian_front_office', [
                    'mulai_tunggu_poli_at' => date('Y-m-d H:i:s'),
                    'pendaftaran_id' => $insert,
                    'pemeriksaan_id' => $pemeriksaan_id,
                ]);
            }

            $task_body = ['kodebooking' => $kode_booking, 'taskid' => 3, 'waktu' => time().'000'];
            $this->MainModel->insert('bpjs_jknmobile_log', [
                'url' => 'antrean/updatewaktu',
                'header' => 'task 3',
                'request' => json_encode($task_body),
                'response' => json_encode($this->post("{$this->base_url_antrean}antrean/updatewaktu", json_encode($task_body), true)),
            ]);

            if ($insert) {
                $this->session->set_flashdata('success', 'Pendaftaran pasien berhasil!');
                redirect('DaftarOnline', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Pendaftaran pasien gagal!');
                redirect('DaftarOnline', 'refresh');
            }

        } else {
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
            $data['base_url_vclaim'] = '' /*MY_BpjsController::$base_url_vclaim_*/;
            $data['id_antrian'] = 0;

            $this->load->view('pendaftaran/pendaftaran_lama_online', $data);
        }
    }
}