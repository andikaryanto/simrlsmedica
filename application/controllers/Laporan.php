<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

        $this->load->library('template');
        $this->load->Model('LaporanModel');
        $this->load->Model('PemeriksaanModel');
        $this->load->Model('AdministrasiModel');
        $this->load->Model('MainModel');
        $this->load->Model('PasienModel');
        $this->load->Model('ObatRacikanModel');
        $this->load->Model('DetailObatPemeriksaanModel');
        $this->load->Model('DetailObatRacikanPemeriksaanModel');
        $this->load->Model('UserModel');

//		$this->load->helper(array('file','php_with_mpdf_helper'));
//		$this->load->helper(array('file','mpdf'));
	}

	public function index()
	{
		redirect('Laporan/jumlahKunjungan');
	}

	public function jumlahKunjungan()
	{
		$start_date = ($this->input->get('from'))?$this->input->get('from'):date('Y-m-d');
		$end_date = ($this->input->get('to'))?$this->input->get('to'):date('Y-m-d');
		$tipe_pasien = $this->input->get('tipe_pasien');
		$jenis_pendaftaran = $this->input->get('jenis_pendaftaran');

        $data['jaminan'] = $this->config->item('poli');
        $data['jumlah_kunjungan'] = $this->LaporanModel->getKunjunganPasien($start_date,$end_date, $jenis_pendaftaran);
        $data['ListPendaftaran'] = $this->LaporanModel->getListPendaftaranByJenis($start_date,$end_date,$jenis_pendaftaran)->result();
        foreach ($data['ListPendaftaran'] as &$d) {
            $d->penyakit = $this->LaporanModel->getSimplePenyakitPemeriksaanByIdPemeriksaan($d->pemeriksaan_id)->result();
        }

        $data['from'] = $start_date;
		$data['to'] = $end_date;
		$data['tipe_pasien'] = $tipe_pasien;
		$this->template->view('laporan/pasien/jumlah_kunjungan',$data);
	}

	public function jumlahPasien()
	{
		$start_date = ($this->input->get('from'))?$this->input->get('from'):date('Y-m-d');
		$end_date = ($this->input->get('to'))?$this->input->get('to'):date('Y-m-d');
        $tipe_pasien = $this->input->get('tipe_pasien');
		$jenis_pendaftaran = $this->input->get('jenis_pendaftaran');

        $data['jaminan'] = $this->config->item('poli');
		$data['jumlah_pasien'] = $this->LaporanModel->getJumlahPasien($start_date,$end_date, $jenis_pendaftaran);
        $data['list_jumlah_pasien'] = $this->LaporanModel->listJumlahPasien($start_date,$end_date,$tipe_pasien)->result();

        foreach ($data['list_jumlah_pasien'] as &$d) {
            $d->penyakit = $this->LaporanModel->getSimplePenyakitPemeriksaanByIdPemeriksaan($d->pemeriksaan_id)->result();
        }

		$data['from'] = $start_date;
		$data['to'] = $end_date;
        $data['tipe_pasien'] = $tipe_pasien;
        $data['jenis_pendaftaran'] = $jenis_pendaftaran;
		$this->template->view('laporan/pasien/jumlah_pasien',$data);
	}

	public function jumlahPasienBaru()
	{
		$start_date = ($this->input->get('from'))?$this->input->get('from'):date('Y-m-d');
		$end_date = ($this->input->get('to'))?$this->input->get('to'):date('Y-m-d');
        $tipe_pasien = $this->input->get('tipe_pasien');

        $data['jaminan'] = $this->config->item('pendaftaran');
		$data['jumlah_pasien_baru'] = $this->LaporanModel->jumlahPasienBaru($start_date,$end_date);
        $data['list_jumlah_pasien_baru'] = $this->LaporanModel->listJumlahPasienBaru($start_date,$end_date,$tipe_pasien)->result();

        foreach ($data['list_jumlah_pasien_baru'] as &$d) {
            $d->penyakit = $this->LaporanModel->getPenyakitPemeriksaanById($d->pasien_id)->result();
        }

		$data['from'] = $start_date;
		$data['to'] = $end_date;
        $data['tipe_pasien'] = $tipe_pasien;
		$this->template->view('laporan/pasien/jumlah_pasien_baru',$data);
	}

	public function jumlahPasien20()
	{
		$start_date = ($this->input->get('from'))?$this->input->get('from'):date('Y-m-d');
		$end_date = ($this->input->get('to'))?$this->input->get('to'):date('Y-m-d');
		$jenis_pendaftaran = $this->input->get('jenis_pendaftaran');
		$data['listjenispendaftaran'] = $this->LaporanModel->getJenisPendaftaran();
		$data['jumlah_pasien20'] = $this->LaporanModel->jumlahPasien20($start_date,$end_date);
        $data['list_jumlah_pasien20'] = $this->LaporanModel->listJumlahPasien20($start_date,$end_date,$jenis_pendaftaran)->result();

		$data['from'] = $start_date;
		$data['to'] = $end_date;
        $data['jenis_pendaftaran'] = $jenis_pendaftaran;
		$this->template->view('laporan/pasien/jumlah_pasien20',$data);
	}

	public function rata2Kunjungan()
	{
		$start_date = ($this->input->get('from'))?$this->input->get('from'):date('Y-m-d');
		$end_date = ($this->input->get('to'))?$this->input->get('to'):date('Y-m-d');
        $tipe_pasien = $this->input->get('tipe_pasien');

        $data['jaminan'] = $this->config->item('pendaftaran');
		$data['rata_kunjungan'] = $this->LaporanModel->getRataKunjungan($start_date,$end_date)->result();
		$data['list_rata_kunjungan']  = $this->LaporanModel->listRataKunjungan($start_date,$end_date)->result();

        $namas = array_map(function ($v) { return $v->nama;  }, $data['rata_kunjungan']);
        $namas = array_unique($namas);
        $res = [];

		foreach ($namas as $n) {
		    $tgls = [];
		    $jumlah = 0;
		    $id = '';
            foreach ($data['rata_kunjungan'] as $d) {
                if ($d->nama == $n) {
                    $b = str_pad($d->bulan, 2, '0', STR_PAD_LEFT);
                    $t = str_pad($d->tanggal, 2, '0', STR_PAD_LEFT);
                    $tgls[] = "{$d->tahun}-{$b}-{$t}";
                    $jumlah += $d->jumlah;
                    $id = $d->id;
                }
            }
            $rata = $jumlah / sizeof($tgls);
            $res[] = array(
                'id' => $id,
                'nama' => $n,
                'rata_rata' => round($rata, 2),
            );
        }

		$data['from']                 = $start_date;
		$data['to']                   = $end_date;
        $data['tipe_pasien']          = $tipe_pasien;
        $data['res']                  = $res;
		$this->template->view('laporan/pasien/rata2kunjungan',$data);
	}

	public function rata2Pasien()
	{
        $start_date = ($this->input->get('from'))?$this->input->get('from'):date('Y-m-d');
        $end_date = ($this->input->get('to'))?$this->input->get('to'):date('Y-m-d');
        $tipe_pasien = $this->input->get('tipe_pasien');

        $data['jaminan'] = $this->config->item('pendaftaran');
        $data['listjenispendaftaran'] = $this->LaporanModel->getJenisPendaftaran();
        $data['rata_kunjungan']       = $this->LaporanModel->getRataPasien($start_date,$end_date)->result();

        $namas = array_map(function ($v) { return $v->nama;  }, $data['rata_kunjungan']);
        $namas = array_unique($namas);
        $res = [];

        foreach ($namas as $n) {
            $tgls = [];
            $jumlah = 0;
            $id = '';
            foreach ($data['rata_kunjungan'] as $d) {
                if ($d->nama == $n) {
                    $b = str_pad($d->bulan, 2, '0', STR_PAD_LEFT);
                    $t = str_pad($d->tanggal, 2, '0', STR_PAD_LEFT);
                    $tgls[] = "{$d->tahun}-{$b}-{$t}";
                    $jumlah += $d->jumlah;
                    $id = $d->id;
                }
            }
            $rata = $jumlah / sizeof($tgls);
            $res[] = array(
                'id' => $id,
                'nama' => $n,
                'rata_rata' => round($rata, 2),
            );
        }

        $data['from']                 = $start_date;
        $data['to']                   = $end_date;
        $data['tipe_pasien']          = $tipe_pasien;
        $data['res']                  = $res;
        $this->template->view('laporan/pasien/rata2pasien',$data);
	}

	public function performaDokter() {
        $start_date                   = ($this->input->get('from'))?$this->input->get('from'):date('Y-m-d');
        $end_date                     = ($this->input->get('to'))?$this->input->get('to'):date('Y-m-d');
        $jenis_pendaftaran            = $this->input->get('jenis_pendaftaran');

		$data['listjenispendaftaran'] = $this->LaporanModel->getJenisPendaftaran();
		$data['dokter'] = $this->LaporanModel->listDokter();
		$data['jenis'] = $this->LaporanModel->getJenisPendaftaran();

		if ($start_date != '' && $end_date != '') {
			$data['performa_dokter'] = $this->LaporanModel->getPerformaDokter($start_date, $end_date, $jenis_pendaftaran);
		}
		else {
			$data['performa_dokter'] = $this->LaporanModel->getPerformaDokter2($jenis_pendaftaran);
		}

		$data['from'] = $start_date;
		$data['to'] = $end_date;
        $data['jenis_pendaftaran'] = $jenis_pendaftaran;
		$this->template->view('laporan/dokter/performa_dokter', $data);
	}

	public function performaPerawat() {
        $start_date                   = ($this->input->get('from'))?$this->input->get('from'):date('Y-m-d');
        $end_date                     = ($this->input->get('to'))?$this->input->get('to'):date('Y-m-d');
        $jenis_pendaftaran            = $this->input->get('jenis_pendaftaran');

        $data['listjenispendaftaran'] = $this->LaporanModel->getJenisPendaftaran();
        $data['jenis'] = $this->LaporanModel->getJenisPendaftaran();

        if ($start_date != '' && $end_date != '') {
            $data['performa_perawat'] = $this->LaporanModel->getPerformaPerawat($start_date, $end_date, $jenis_pendaftaran);
        }
        else {
            $data['performa_perawat'] = $this->LaporanModel->getPerformaPerawat2($jenis_pendaftaran);
        }

        $data['from'] = $start_date;
        $data['to'] = $end_date;
        $data['jenis_pendaftaran'] = $jenis_pendaftaran;
        $this->template->view('laporan/perawat/performa_perawat', $data);
	}

	public function Obat() {
        $start_date         = ($this->input->get('from'))?$this->input->get('from'):date('Y-m-d');
        $end_date           = ($this->input->get('to'))?$this->input->get('to'):date('Y-m-d');
        $jenis_pendaftaran  = $this->input->get('jenis_pendaftaran');

        $obat = $this->LaporanModel->getObatPemeriksaan($start_date, $end_date, $jenis_pendaftaran)->result();
        $obat_racikan = $this->LaporanModel->getObatRacikanPemeriksaan($start_date, $end_date, $jenis_pendaftaran)->result();
        $res = $obat;
        foreach ($obat_racikan as &$o) {
            $ids = array_map(function ($v) { return $v->obat_id; }, $obat);
            if (!in_array($o->obat_id, $ids)) {
                $res[] = $o;
            }
            else {
                foreach ($res as &$r) {
                    if ($r->obat_id == $o->obat_id) {
                        $r->jumlah += $o->jumlah;
                        break;
                    }
                }
            }
        }
        usort($res, function($a, $b) {
            return $b->jumlah - $a->jumlah;
        });

        $data['listjenispendaftaran'] = $this->LaporanModel->getJenisPendaftaran();
        $data['obat'] = array_slice($res, 0, 10);
        $data['from'] = $start_date;
		$data['to'] = $end_date;
        $data['jenis_pendaftaran'] = $jenis_pendaftaran;
		$this->template->view('laporan/obat/obat',$data);
	}

    public function obat_resep_luar() {
        $start_date         = ($this->input->get('from'))?$this->input->get('from'):date('Y-m-d');
        $end_date           = ($this->input->get('to'))?$this->input->get('to'):date('Y-m-d');

        $obat = $this->LaporanModel->getObatResepLuar($start_date, $end_date)->result();
        $obat_racikan = $this->LaporanModel->getObatRacikResepLuar($start_date, $end_date)->result();
        $res = $obat;
        foreach ($obat_racikan as &$o) {
            $ids = array_map(function ($v) { return $v->obat_id; }, $obat);
            if (!in_array($o->obat_id, $ids)) {
                $res[] = $o;
            }
            else {
                foreach ($res as &$r) {
                    if ($r->obat_id == $o->obat_id) {
                        $r->jumlah += $o->jumlah;
                        break;
                    }
                }
            }
        }
        usort($res, function($a, $b) {
            return $b->jumlah - $a->jumlah;
        });

        $data['listjenispendaftaran'] = $this->LaporanModel->getJenisPendaftaran();
        $data['obat'] = array_slice($res, 0, 10);
        $data['from'] = $start_date;
        $data['to'] = $end_date;
        $this->template->view('laporan/obat/resep_luar',$data);
    }

    public function obat_obat_bebas() {
        $start_date         = ($this->input->get('from'))?$this->input->get('from'):date('Y-m-d');
        $end_date           = ($this->input->get('to'))?$this->input->get('to'):date('Y-m-d');

        $obat = $this->LaporanModel->getObatObatBebas($start_date, $end_date)->result();
        $obat_racikan = $this->LaporanModel->getObatRacikObatBebas($start_date, $end_date)->result();
        $res = $obat;
        foreach ($obat_racikan as &$o) {
            $ids = array_map(function ($v) { return $v->obat_id; }, $obat);
            if (!in_array($o->obat_id, $ids)) {
                $res[] = $o;
            }
            else {
                foreach ($res as &$r) {
                    if ($r->obat_id == $o->obat_id) {
                        $r->jumlah += $o->jumlah;
                        break;
                    }
                }
            }
        }
        usort($res, function($a, $b) {
            return $b->jumlah - $a->jumlah;
        });

        $data['listjenispendaftaran'] = $this->LaporanModel->getJenisPendaftaran();
        $data['obat'] = array_slice($res, 0, 10);
        $data['from'] = $start_date;
        $data['to'] = $end_date;
        $this->template->view('laporan/obat/obat_bebas',$data);
    }

    public function obat_obat_internal() {
        $start_date         = ($this->input->get('from'))?$this->input->get('from'):date('Y-m-d');
        $end_date           = ($this->input->get('to'))?$this->input->get('to'):date('Y-m-d');

        $obat = $this->LaporanModel->getObatObatInternal($start_date, $end_date)->result();
        $obat_racikan = $this->LaporanModel->getObatRacikObatInternal($start_date, $end_date)->result();
        $res = $obat;
        foreach ($obat_racikan as &$o) {
            $ids = array_map(function ($v) { return $v->obat_id; }, $obat);
            if (!in_array($o->obat_id, $ids)) {
                $res[] = $o;
            }
            else {
                foreach ($res as &$r) {
                    if ($r->obat_id == $o->obat_id) {
                        $r->jumlah += $o->jumlah;
                        break;
                    }
                }
            }
        }
        usort($res, function($a, $b) {
            return $b->jumlah - $a->jumlah;
        });

        $data['listjenispendaftaran'] = $this->LaporanModel->getJenisPendaftaran();
        $data['obat'] = array_slice($res, 0, 10);
        $data['from'] = $start_date;
        $data['to'] = $end_date;
        $this->template->view('laporan/obat/obat_internal',$data);
    }

	public function Penyakit() {
        $start_date         = ($this->input->get('from'))?$this->input->get('from'):date('Y-m-d');
        $end_date           = ($this->input->get('to'))?$this->input->get('to'):date('Y-m-d');
        $jenis_pendaftaran  = $this->input->get('jenis_pendaftaran');

		$data['listjenispendaftaran'] = $this->LaporanModel->getJenisPendaftaran();
        $data['penyakit'] = $this->LaporanModel->getPenyakitPemeriksaan($start_date, $end_date, $jenis_pendaftaran);

		$data['from'] = $start_date;
		$data['to'] = $end_date;
        $data['jenis_pendaftaran'] = $jenis_pendaftaran;
		$this->template->view('laporan/penyakit/penyakit',$data);
	}

	public function RekamMedis($pasien_id = false) {
		$start_date = $this->input->get('from');
		$end_date = $this->input->get('to');

		$data['listjenispendaftaran'] = $this->LaporanModel->getJenisPendaftaran();
        $data['pasien'] = $this->LaporanModel->getPasienPemeriksaan2();

        $data['from'] = $start_date;
        $data['to'] = $end_date;

        if ($pasien_id) {
            $data['pemeriksaan'] = $this->LaporanModel->getPemeriksaanBayarById($pasien_id)->result();
            $data['tindakan'] = $this->LaporanModel->getTindakanById($pasien_id);
            $data['obat'] = $this->LaporanModel->getObatPemeriksaanById($pasien_id);
            $data['penyakit'] = $this->LaporanModel->getPenyakitPemeriksaanById($pasien_id);
            $data['racikan']  = $this->LaporanModel->getRacikanPemeriksaan($pasien_id);
            $data['pasien_terpilih']  = $this->PasienModel->getPasienById($pasien_id)->row();

            foreach ($data['pemeriksaan'] as $v) {
                $v->racikans = $this->ObatRacikanModel->getRacikanByIdPemeriksaan($v->id)->result();
                foreach ($v->racikans as &$vv) {
                    $vv->racikan = $this->ObatRacikanModel->getObatRacikanByIdDetailObatRacikan($vv->id)->result();
                }
            }

            $this->template->view('laporan/rekam_medis/detail_rekam_medis',$data);
        }
        else {
            $this->template->view('laporan/rekam_medis/rekam_medis',$data);
        }
    }

    public function DetailRiwayatPoli($pemeriksaan_id)
    {
        $data['pendaftaran'] = $this->PemeriksaanModel->getPendaftaranByIdPemeriksaan($pemeriksaan_id)->row_array();
        $data['pemeriksaan'] = $this->PemeriksaanModel->getPemeriksaanById($pemeriksaan_id)->row_array();
        $data['dokumen'] = $this->db->query("SELECT * FROM pemeriksaan_dokumen WHERE pemeriksaan_id = $pemeriksaan_id")->result();
        $data['tht_result'] = unserialize($data['pemeriksaan']['meta']);
        $data['hd'] = unserialize($data['pemeriksaan']['hd']);

        $data['jaminan'] = $this->config->item('pendaftaran');
        $data['obat_periksa'] = $this->DetailObatPemeriksaanModel->getDetailObatByPemeriksaanId($pemeriksaan_id)->result();
        $data['obat_racikan_periksa'] = $this->DetailObatRacikanPemeriksaanModel->getDetailObatRacikanByPemeriksaanId($pemeriksaan_id)->result();
        foreach ($data['obat_racikan_periksa'] as $k => $v) {
            $data['obat_racikan_periksa'][$k]->obat = $this->AdministrasiModel->getListObatByDetailObatRacikanPemeriksaanId($v->id)->result();
        }

        $category = 'umum';
        foreach ($this->config->item('poli') as $k => $v) {
            if (in_array($data['pendaftaran']['kode_daftar'], $v['kode'])) {
                $category = $k;
                break;
            }
        }

        $data['tindakan'] = $this->LaporanModel->getTindakanByIdPemeriksaan($pemeriksaan_id)->result();
        $data['all_penyakit'] = $this->PemeriksaanModel->getPenyakitByCategory($category)->result();
        $data['penyakit'] = $this->LaporanModel->getPenyakitPemeriksaanByIdPemeriksaan($pemeriksaan_id)->result();

        $this->template->view('laporan/rekam_medis/detail_riwayat_poli', $data);
    }

    function EditRekamMedis($id, $to = 0)
    {
        $data['to'] = $to;
        $data['pemeriksaan'] = $this->LaporanModel->getPemeriksaanSudahPeriksaByIdPemeriksaan($id)->row_array();
        $data['dokumen'] = $this->db->query("SELECT * FROM pemeriksaan_dokumen WHERE pemeriksaan_id = $id")->result();
        $data['form'] = unserialize($data['pemeriksaan']['form']);
        $data['kajian_perawat'] = json_decode($data['pemeriksaan']['kajian_perawat'], true);
        $data['s_tindakan'] = $this->LaporanModel->getTindakanByIdPemeriksaan($id)->result();
        $data['s_obat'] = $this->LaporanModel->getObatPemeriksaanByIdPemeriksaan($id)->result();
        $data['s_penyakit'] = $this->LaporanModel->getPenyakitPemeriksaanByIdPemeriksaan($id)->result();
        $data['s_racikan']  = $this->LaporanModel->getRacikanPemeriksaan($id)->result();
        $data['pasien_terpilih']  = $this->PasienModel->getPasienById($data['pemeriksaan']['pasien_id'])->row();

        //----------- Pilihan All
        $data['obat'] = $this->PemeriksaanModel->getObat()->result();
        $data['tindakan'] = $this->PemeriksaanModel->getTindakanByCategory('umum')->result();
        $data['penyakit'] = $this->PemeriksaanModel->getPenyakitByCategory('umum')->result();

        $data['tindakan_gigi'] = $this->PemeriksaanModel->getTindakanByCategory('gigi')->result();
        $data['penyakit_gigi'] = $this->PemeriksaanModel->getPenyakitByCategory('gigi')->result();

        $data['tindakan_laborat'] = $this->PemeriksaanModel->getTindakanByCategory('laboratorium')->result();
        $data['layanan_laborat'] = $this->PemeriksaanModel->getPenyakitByCategory('laboratorium')->result();

        $data['pendaftaran'] = $this->PemeriksaanModel->getPendaftaranByIdPemeriksaan($id)->row_array();
        //----------- END Pilihan All

        $data['obat1'] = $this->db->get_where('obat', ['is_active' => 1, 'stok_obat >' => 0])->result();
        $data['bahan'] = $this->db->get_where('bahan_habis_pakai', ['is_active' => 1, 'jumlah >' => 0])->result();

        $pemeriksaan_id = $data['pemeriksaan']['id'];
        $data['jaminan'] = $this->config->item('pendaftaran');
        $data['obat_periksa'] = $this->DetailObatPemeriksaanModel->getDetailObatByPemeriksaanId($pemeriksaan_id)->result();
        $data['obat_racikan_periksa'] = $this->DetailObatRacikanPemeriksaanModel->getDetailObatRacikanByPemeriksaanId($pemeriksaan_id)->result();
        foreach ($data['obat_racikan_periksa'] as $k => $v) {
            $data['obat_racikan_periksa'][$k]->obat = $this->AdministrasiModel->getListObatByDetailObatRacikanPemeriksaanId($v->id)->result();
        }


        $this->template->view('laporan/rekam_medis/edit_rekam_medis',$data);
    }

    function SimpanEditRekamMedis($pemeriksaan_id) {
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

        $session = $this->session->userdata('logged_in');
        $periksa = array(
            'keluhan_utama' => $this->input->post('keluhan_utama'),
            'catatan_odontogram' => $this->input->post('catatan_odontogram'),
            'meta' => $meta,
            'hd' => $hd,
            'diagnosa_perawat' => $this->input->post('diagnosa_perawat'),
            'amammesia' => $this->input->post('amammesia'),
            'diagnosis' => $this->input->post('diagnosis'),
            'kajian_perawat'    => json_encode([
                'status_fisik' => $this->input->post('status_fisik'),
                'psikososial' => $this->input->post('psikososial'),
                'riwayat_kesehatan_pasien' => $this->input->post('riwayat_kesehatan_pasien'),
                'riwayat_penggunaan_obat' => $this->input->post('riwayat_penggunaan_obat'),
            ]),
            'pemeriksaan_fisik' => nl2br($this->input->post('pemeriksaan_fisik')),
            'hasil_penunjang' => json_encode($hp),
            'diagnosis_banding' => $this->input->post('diagnosis_banding'),
            'deskripsi_tindakan' => $this->input->post('deskripsi_tindakan'),
            'saran_pemeriksaan' => $this->input->post('saran_pemeriksaan'),
            'form' => serialize($this->input->post('form'))
        );
        if ($this->input->post('kode_daftar') == 'PL' || $this->input->post('kode_daftar') == 'BPJS-PL') {
            $periksa['hasil_lab'] = $this->getHasilLab();
        }

        if (isset($_POST['asuhan_keperawatan'])) {
            $periksa['asuhan_keperawatan'] = $this->input->post('asuhan_keperawatan');
        }

        $this->MainModel->update('pemeriksaan', $periksa, $pemeriksaan_id);

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
                        'pemeriksaan_id' => $pemeriksaan_id,
                        'dokumen' => $name
                    ]);
                }
            }
        }
        //END UPLOAD

        $input_tindakan = $this->input->post('tindakan');
        $penyakit = $this->input->post('diagnosis_jenis_penyakit');

        $this->db->delete('detail_tindakan_pemeriksaan', array('pemeriksaan_id' => $pemeriksaan_id));
        $this->db->delete('detail_penyakit_pemeriksaan', array('pemeriksaan_id' => $pemeriksaan_id));

        // --------------- TINDAKAN ---------------- //

        $tin = array();
        foreach ($input_tindakan as $key => $value) {
            $tindakan = array(
                'pemeriksaan_id' => $pemeriksaan_id,
                'tarif_tindakan_id' => $value,
                'creator' => $session->id
            );
            $tin[] = $tindakan;

            $this->MainModel->insert_id('detail_tindakan_pemeriksaan', $tindakan);
        }

        // --------------- PENYAKIT ---------------- //

        $pen = array();
        foreach ($penyakit as $key => $value) {
            $penyakit = array(
                'pemeriksaan_id' => $pemeriksaan_id,
                'penyakit_id' => $value,
                'creator' => $session->id
            );
            $pen[] = $penyakit;

            $this->MainModel->insert_id('detail_penyakit_pemeriksaan',$penyakit);
        }

        if ($this->input->post('to') == 'perawat')
            redirect('PemeriksaanAwal');
        else if ($this->input->post('to') == 'dokter')
            redirect('pemeriksaan/listPasienSelesaiPeriksa');
        else if ($this->input->post('to') == 'dokter_igd')
            redirect('Igd/selesai');
        else
            redirect('Laporan/RekamMedis/'.$this->input->post('pasien_id'));
    }

    public function downloadPemeriksaan($pemeriksaan_id)
    {
        $data['pendaftaran'] = $this->PemeriksaanModel->getPendaftaranByIdPemeriksaan($pemeriksaan_id)->row_array();
        $data['pemeriksaan'] = $this->PemeriksaanModel->getPemeriksaanById($pemeriksaan_id)->row_array();
        $data['tht_result'] = unserialize($data['pemeriksaan']['meta']);
        $data['jaminan'] = $this->config->item('pendaftaran');
        $data['obat_periksa'] = $this->DetailObatPemeriksaanModel->getDetailObatByPemeriksaanId($pemeriksaan_id)->result();
        $data['obat_racikan_periksa'] = $this->DetailObatRacikanPemeriksaanModel->getDetailObatRacikanByPemeriksaanId($pemeriksaan_id)->result();
        foreach ($data['obat_racikan_periksa'] as $k => $v) {
            $data['obat_racikan_periksa'][$k]->obat = $this->AdministrasiModel->getListObatByDetailObatRacikanPemeriksaanId($v->id)->result();
        }

        $category = 'umum';
        foreach ($this->config->item('poli') as $k => $v) {
            if (in_array($data['pendaftaran']['kode_daftar'], $v['kode'])) {
                $category = $k;
                break;
            }
        }

        $data['tindakan'] = $this->LaporanModel->getTindakanByIdPemeriksaan($pemeriksaan_id)->result();
        $data['all_penyakit'] = $this->PemeriksaanModel->getPenyakitByCategory($category)->result();
        $data['penyakit'] = $this->LaporanModel->getPenyakitPemeriksaanByIdPemeriksaan($pemeriksaan_id)->result();

        $data['head']          = $this->load->view('template/head', $data, TRUE);
        $data['header']        = $this->load->view('template/header', $data, TRUE);
        $data['sidebar']       = $this->load->view('template/sidebar', $data, TRUE);
        $data['right_sidebar'] = $this->load->view('template/right_sidebar', $data, TRUE);
        $data['footer']        = $this->load->view('template/footer', $data, TRUE);
        $data['footer_js']     = $this->load->view('template/footer_js', $data, TRUE);

        $date = date('dmY_His');
        $f_name = "rekam_medis_" . $date . ".pdf";

        $this->load->helper('mpdf');
        $mpdf=new mPDF('c');

        $stylesheet = '
        table.bor, th.bor, td.bor {
            font-size: 12px;
            border: 1px solid #e5e5e5;
        }
        th, td {
            padding: 0px 5px;
        }
        td.cat {
            min-width: 100px;
            max-width: 300px;
        }
        td.no-data {
            padding: 5px;
            text-align: center;
        }
        .select2-container {
           width: 100% !important;
        }
        input {
           width: 100% !important;
        }
        .opt { 
          display:inline-block; 
          vertical-align:top; 
          overflow:hidden; 
          border:solid grey 1px;
        }
        .opt select { 
          padding:10px; 
          margin:-5px -20px -5px -5px; 
        }
        /*!
 * Bootstrap v4.0.0 (https://getbootstrap.com)
 * Copyright 2011-2018 The Bootstrap Authors
 * Copyright 2011-2018 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
/*# sourceMappingURL=bootstrap.min.css.map */
        
        ';
        $html = $this->load->view('laporan/rekam_medis/riwayat_poli_download', $param, true);
//die(json_encode($stylesheet));
        $mpdf->WriteHTML($stylesheet, 1);
        $mpdf->WriteHTML($html, 2);
        $mpdf->Output($f_name, 'D');
        exit;
    }

    public function printPemeriksaan($pemeriksaan_id)
    {
        $data['klinik'] = $this->UserModel->getKlinik()->row();
        $data['pendaftaran'] = $this->PemeriksaanModel->getPendaftaranByIdPemeriksaan($pemeriksaan_id)->row_array();
        $data['pemeriksaan'] = $this->PemeriksaanModel->getPemeriksaanById($pemeriksaan_id)->row_array();
        $data['form'] = unserialize($data['pemeriksaan']['form']);
        $data['telaah'] = unserialize($data['pemeriksaan']['telaah']);
        $data['tht_result'] = unserialize($data['pemeriksaan']['meta']);
        $data['kajian_perawat'] = json_decode($data['pemeriksaan']['kajian_perawat'], true);
        $data['pasien'] = $this->PasienModel->getPasienById($data['pemeriksaan']['pasien_id'])->row_array();
        $data['tht_result'] = unserialize($data['pemeriksaan']['meta']);
        $data['jaminan'] = $this->config->item('pendaftaran');
        $data['obat_periksa'] = $this->DetailObatPemeriksaanModel->getDetailObatByPemeriksaanId($pemeriksaan_id)->result();
        $data['obat_racikan_periksa'] = $this->DetailObatRacikanPemeriksaanModel->getDetailObatRacikanByPemeriksaanId($pemeriksaan_id)->result();
        foreach ($data['obat_racikan_periksa'] as $k => $v) {
            $data['obat_racikan_periksa'][$k]->obat = $this->AdministrasiModel->getListObatByDetailObatRacikanPemeriksaanId($v->id)->result();
        }

        $category = 'umum';
        foreach ($this->config->item('poli') as $k => $v) {
            if (in_array($data['pendaftaran']['kode_daftar'], $v['kode'])) {
                $category = $k;
                break;
            }
        }

        $data['tindakan'] = $this->LaporanModel->getTindakanByIdPemeriksaan($pemeriksaan_id)->result();
        $data['all_penyakit'] = $this->PemeriksaanModel->getPenyakitByCategory($category)->result();
        $data['penyakit'] = $this->LaporanModel->getPenyakitPemeriksaanByIdPemeriksaan($pemeriksaan_id)->result();

        $data['soap'] = json_decode($data['pemeriksaan']['soap_apoteker']);
        $data['telaah'] = json_decode($data['pemeriksaan']['telaah'], true);
        $data['idx'] = [
            'resep_lengkap',
            'pasien_sesuai',
            'nama_obat',
            'bentuk_sediaan',
            'dosis',
            'jumlah_obat',
            'aturan_pakai',
            'tepat_indikasi',
            'tepat_dosis',
            'tepat_waktu_penggunaan',
            'duplikasi_pengobatan',
            'alergi',
            'kontraindikasi',
            'telaah_obat',
            'nama_obat_dengan_resep',
            'jumlah_dosis_dengan_resep',
            'rute_dengan_resep',
            'waktu_frekuensi_pemberian',
        ];

        if ($category == 'umum') {
            $this->load->view('laporan/rekam_medis/print/umum', $data);
        }
        else if ($category == 'sunat') {
            $this->load->view('laporan/rekam_medis/print/sunat', $data);
        }
        else if ($category == 'rawat luka') {
            $this->load->view('laporan/rekam_medis/print/rawat_luka', $data);
        }
        else {
            $data['head']          = $this->load->view('template/head', $data, TRUE);
            $data['header']        = $this->load->view('template/header', $data, TRUE);
            $data['sidebar']       = $this->load->view('template/sidebar', $data, TRUE);
            $data['right_sidebar'] = $this->load->view('template/right_sidebar', $data, TRUE);
            $data['footer']        = $this->load->view('template/footer', $data, TRUE);
            $data['footer_js']     = $this->load->view('template/footer_js', $data, TRUE);

            $this->load->view('laporan/rekam_medis/riwayat_poli_print', $data);
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
}
