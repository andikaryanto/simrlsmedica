<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keuangan extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('template');
        $this->load->Model('KeuanganModel');
        $this->load->Model('InsentifModel');
        $this->load->Model('MainModel');
        $this->load->Model('ObatGlobalModel');
        $this->load->Model('PendaftaranModel');
    }

    public function index() {
        redirect('Keuangan/listPemasukan');
    }

    public function listPemasukan() {
        $item = $this->input->get('item');
        $jenis_pendaftaran_id = $this->input->get('jp_id');

        $data['detail'] = $this->KeuanganModel->getListPemasukanDetail($item, $jenis_pendaftaran_id);
        $data['jpem'] = urldecode($this->input->get('jpem'));
        $data['jp_name'] = urldecode($this->input->get('jp_name'));

        $this->template->view('keuangan/list_laba_v',$data);
    }

    public function listPemasukanObatLuar() {
        $tipe = $this->input->get('tipe');

        $data['detail'] = $this->KeuanganModel->getListPemasukanObatLuarDetail($tipe);
        $data['tipe'] = str_replace('_', ' ', $tipe);

        $this->template->view('keuangan/list_laba_v',$data);
    }

    public function listTotalPemasukan_OLD() {
        $data['total_tindakan'] = $this->KeuanganModel->getTotallabaTindakan();
        $this->template->view('keuangan/resume_pemasukan',$data);
    }

    public function resume_pemasukan() {
        $start_date = $this->input->get('from');
        $end_date = $this->input->get('to');

        if ($start_date && $end_date) {
            $date['start'] = $start_date;
            $date['end'] = $end_date;

            $data['total_jasa_medis'] = $this->KeuanganModel->getLabaByPendaftaran('tindakan', $date);
            $data['total_obat'] = $this->KeuanganModel->getLabaByPendaftaran('obat', $date);
            $data['total_obat_racikan'] = $this->KeuanganModel->getLabaByPendaftaran('obat racikan', $date);
            $data['total_jasa_racik'] = $this->KeuanganModel->getLabaByPendaftaran('jasa racik', $date);
            $data['total_bahan_habis_pakai'] = $this->KeuanganModel->getLabaByPendaftaran('bahan habis pakai', $date);
            $data['total_by_jenis_layanan'] = $this->KeuanganModel->getLabaByLayanan($date);
            $data['total_obat_resep_luar'] = $this->KeuanganModel->getLabaObatLuarByPendaftaran($date);

            $data['insentif_dokter'] = $this->InsentifModel->listInsentifDokter($date);
            $data['insentif_perawat'] = $this->InsentifModel->listInsentifPerawat($date);
        }
        else {
            $data['total_jasa_medis'] = $this->KeuanganModel->getLabaByPendaftaran('tindakan', 'bulanan');
            $data['total_obat'] = $this->KeuanganModel->getLabaByPendaftaran('obat', 'bulanan');
            $data['total_obat_racikan'] = $this->KeuanganModel->getLabaByPendaftaran('obat racikan', 'bulanan');
            $data['total_jasa_racik'] = $this->KeuanganModel->getLabaByPendaftaran('jasa racik', 'bulanan');
            $data['total_bahan_habis_pakai'] = $this->KeuanganModel->getLabaByPendaftaran('bahan habis pakai', 'bulanan');
            $data['total_by_jenis_layanan'] = $this->KeuanganModel->getLabaByLayanan('bulanan');
            $data['total_obat_resep_luar'] = $this->KeuanganModel->getLabaObatLuarByPendaftaran();

            $data['insentif_dokter'] = $this->InsentifModel->listInsentifDokter('bulanan');
            $data['insentif_perawat'] = $this->InsentifModel->listInsentifPerawat('bulanan');
        }

        //lama
//        $data['total_jasa_medis'] = $this->KeuanganModel->getLabaByPendaftaran('tindakan');
//        $data['total_obat'] = $this->KeuanganModel->getLabaByPendaftaran('obat');
//        $data['total_obat_racikan'] = $this->KeuanganModel->getLabaByPendaftaran('obat racikan');
//        $data['total_jasa_racik'] = $this->KeuanganModel->getLabaByPendaftaran('jasa racik');
//        $data['total_bahan_habis_pakai'] = $this->KeuanganModel->getLabaByPendaftaran('bahan habis pakai');
//        $data['total_by_jenis_layanan'] = $this->KeuanganModel->getLabaByLayanan();
//        $data['total_obat_resep_luar'] = $this->KeuanganModel->getLabaObatLuarByPendaftaran();

        $this->template->view('keuangan/resume_pemasukan',$data);
    }

    public function resume_pemasukan_()
    {
        $data['kode_poli'] = $this->config->item('poli');
        $data['jenis_pendaftaran_all'] = $this->PendaftaranModel->getJenisPendaftaran()->result();
        $data['jaminan'] = $this->config->item('pendaftaran');
        $data['tindakan_all'] = $this->db->query("SELECT * FROM tarif_tindakan WHERE is_active = 1")->result();
        $data['tindakan_lab_all'] = $this->db->query("
            SELECT * FROM jenis_layanan_laboratorium 
            WHERE is_active = 1 
        ")->result();
        $data['tindakan_lab_all_merge'] = array_merge($data['tindakan_all'], $data['tindakan_lab_all']);
        $data['dokter_all'] = $this->PendaftaranModel->getDokter();

        $jenis = $this->input->get('jenis');
        $from = $this->input->get('from');
        $to = $this->input->get('to');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $poli = $this->input->get('poli') ?? '';
        $tindakan = $this->input->get('tindakan') ?? [];
        $jenis_pendaftaran = $this->input->get('jenis_pendaftaran') ?? '';
        $dokter = $this->input->get('dokter') ?? '';

        $start_date = $end_date = date('Y-m-d');
        if ($jenis == 2) {
            $start_date = $from;
            $end_date = $to;
        }
        if ($jenis == 3) {
            $start_date = date("$tahun-$bulan-01");
            $end_date = date("$tahun-$bulan-t");
        }

        $data['jenis'] = $jenis;
        $data['from'] = $from;
        $data['to'] = $to;
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['poli'] = $poli;
        $data['tindakan'] = $tindakan;
        $data['jenis_pendaftaran'] = $jenis_pendaftaran;
        $data['dokter'] = $dokter;

        if ($poli == 'konsumsi') {
            $data['jasa_medis'] = $this->KeuanganModel->getListPemasukanKonsumsi($start_date, $end_date);
        }
        else {
            $data['jasa_medis'] = $this->KeuanganModel->getListPemasukanTindakan($start_date, $end_date, $poli, $tindakan, $jenis_pendaftaran, $dokter);
        }

        $this->template->view('keuangan/resume_pemasukan_', $data);
    }

    public function resume_frekuensi_tindakan()
    {
        $data['kode_poli'] = $this->config->item('poli');
        $data['jenis_pendaftaran_all'] = $this->PendaftaranModel->getJenisPendaftaran();
        $data['jaminan'] = $this->config->item('pendaftaran');

        $jenis = $this->input->get('jenis');
        $from = $this->input->get('from');
        $to = $this->input->get('to');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $poli = $this->input->get('poli') ?? '';
        $jenis_pendaftaran = $this->input->get('jenis_pendaftaran') ?? '';

        $start_date = $end_date = date('Y-m-d');
        if ($jenis == 2) {
            $start_date = $from;
            $end_date = $to;
        }
        if ($jenis == 3) {
            $start_date = date("$tahun-$bulan-01");
            $end_date = date("$tahun-$bulan-t");
        }

        $data['jenis'] = $jenis;
        $data['from'] = $from;
        $data['to'] = $to;
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['poli'] = $poli;
        $data['jenis_pendaftaran'] = $jenis_pendaftaran;

        $data['list'] = $this->KeuanganModel->getFrekuensiTindakan($start_date, $end_date, $poli, $jenis_pendaftaran);

        $this->template->view('keuangan/resume_frekuensi_tindakan', $data);
    }

    public function detail_resume_frekuensi_tindakan($tindakan_id)
    {
        $data['kode_poli'] = $this->config->item('poli');
        $data['jenis_pendaftaran_all'] = $this->PendaftaranModel->getJenisPendaftaran();
        $data['jaminan'] = $this->config->item('pendaftaran');

        $jenis = $this->input->get('jenis');
        $from = $this->input->get('from');
        $to = $this->input->get('to');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $poli = $this->input->get('poli') ?? '';
        $jenis_pendaftaran = $this->input->get('jenis_pendaftaran') ?? '';

        $start_date = $end_date = date('Y-m-d');
        if ($jenis == 2) {
            $start_date = $from;
            $end_date = $to;
        }
        if ($jenis == 3) {
            $start_date = date("$tahun-$bulan-01");
            $end_date = date("$tahun-$bulan-t");
        }

        $data['jenis'] = $jenis;
        $data['from'] = $from;
        $data['to'] = $to;
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['poli'] = $poli;
        $data['jenis_pendaftaran'] = $jenis_pendaftaran;

        $data['list'] = $this->KeuanganModel->getListPemasukanTindakan($start_date, $end_date, $poli, [$tindakan_id], $jenis_pendaftaran, null);

        $this->template->view('keuangan/detail_resume_frekuensi_tindakan', $data);
    }

    public function penjualan_obat_global_()
    {
        $jenis = $this->input->get('jenis');
        $from = $this->input->get('from');
        $to = $this->input->get('to');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $poli = $this->input->get('poli') ?? '';

        $start_date = $end_date = date('Y-m-d');
        if ($jenis == 2) {
            $start_date = $from;
            $end_date = $to;
        }
        if ($jenis == 3) {
            $start_date = date("$tahun-$bulan-01");
            $end_date = date("$tahun-$bulan-t");
        }

        $data['jenis'] = $jenis;
        $data['from'] = $from;
        $data['to'] = $to;
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['poli'] = $poli;

        $periode = ['start' => $start_date, 'end' => $end_date];
        $obat_luar = !$poli || $poli == 'x' ? $this->ObatGlobalModel->get_obat_luar($periode) : [];
        $obat_racikan_luar = !$poli || $poli == 'x' ? $this->ObatGlobalModel->get_obat_racikan_luar($periode) : [];
        $obat_pemeriksaan = !$poli || $poli != 'x' ? $this->ObatGlobalModel->get_obat_pemeriksaan($periode, $poli == 'x' ? '' : $poli) : [];
        $obat_racikan_pemeriksaan = !$poli || $poli != 'x' ? $this->ObatGlobalModel->get_obat_racikan_pemeriksaan($periode, $poli == 'x' ? '' : $poli) : [];
        $obats = [];

        function searchById($id, $nama, &$array) {
            foreach ($array as $key => $val) {
                if (($val->obat_id != null && $val->obat_id == $id) || $val->nama_obat == $nama) {
                    return $val;
                }
            }
            return null;
        }

        $all = [
            $obat_luar,
            $obat_racikan_luar,
            $obat_pemeriksaan,
            $obat_racikan_pemeriksaan
        ];

        foreach ($all as $o) {
            foreach ($o as $k1 => $o1) {

                $found = searchById($o1->obat_id, $o1->nama_obat, $obats);
                if ($found) {
                    $ext = $o1;
                    $ext->jumlah += $found->jumlah;
                    foreach ($obats as $k => $obat) {
                        if (($obat->obat_id != null && $obat->obat_id == $o1->obat_id) || $obat->nama_obat == $o1->nama_obat) {
                            unset($obats[$k]);
                            break;
                        }
                    }
                    $obats[] = $ext;
                }
                else {
                    $obats[] = $o1;
                }
            }
        }

        $obats = array_filter($obats, function ($var) {
            return ($var->jumlah > 0);
        });

        usort($obats, function ($a, $b) {
            return $b->jumlah - $a->jumlah;
        });

        $data['jenis_pendaftaran_all'] = $this->PendaftaranModel->getJenisPendaftaran();
        $data['detail'] = $obats;

        $this->template->view('keuangan/penjualan_obat_global', $data);
    }

    public function penjualan_obat_global() {
        $start_date = $this->input->get('from');
        $end_date = $this->input->get('to');
        $periode = ($start_date && $end_date) ? ['start' => $start_date, 'end' => $end_date] : '';

        $obat_luar = $this->ObatGlobalModel->get_obat_luar($periode);
        $obat_racikan_luar = $this->ObatGlobalModel->get_obat_racikan_luar($periode);
        $obat_pemeriksaan = $this->ObatGlobalModel->get_obat_pemeriksaan($periode);
        $obat_racikan_pemeriksaan = $this->ObatGlobalModel->get_obat_racikan_pemeriksaan($periode);
        $obats = [];

        function searchById($id, &$array) {
            foreach ($array as $key => $val) {
                if ($val->obat_id == $id) {
                    return $val;
                }
            }
            return null;
        }
        foreach ([$obat_luar, $obat_racikan_luar, $obat_pemeriksaan, $obat_racikan_pemeriksaan] as $o) {
            foreach ($o as $k1 => $o1) {
                $found = searchById($o1->obat_id, $obats);
                if ($found) {
                    $found->jumlah += $o1->jumlah;
                }
                else {
                    $obats[] = $o1;
                }
            }
        }

        usort($obats, function ($a, $b) {
            return $b->jumlah - $a->jumlah;
        });

        $this->template->view('keuangan/penjualan_obat_global', ['detail' => $obats]);
    }

    public function listTotalPiutang() {
        $dari = $this->input->get('from');
        $sampai = $this->input->get('to');

        if (!$dari) $dari = date('Y-m-01');
        if (!$sampai) $sampai = date('Y-m-d');

        $data['total_by_jenis_layanan'] = $this->KeuanganModel->getLabaByLayanan(['start' => $dari, 'end' => $sampai]);
        $data['from'] = $dari;
        $data['to'] = $sampai;

        $this->template->view('keuangan/list_total_piutang_v',$data);
    }

    public function detail_piutang() {
        $jaminan = $this->input->get('jaminan');
        $dari = $this->input->get('from');
        $sampai = $this->input->get('to');

        if (!$dari) $dari = date('Y-m-01');
        if (!$sampai) $sampai = date('Y-m-d');

        $data['list'] = $this->KeuanganModel->getListPiutangByJaminan(['start' => $dari, 'end' => $sampai], $jaminan);
        $data['jaminan'] = $jaminan;
        $data['from'] = $dari;
        $data['to'] = $sampai;

        $this->template->view('keuangan/detail_piutang', $data);
    }

    public function listPengeluaranObat() {
        //$data['tindakan'] = $this->KeuanganModel->getTindakanPemeriksaan();
        $data['obat'] = $this->KeuanganModel->getObatPemeriksaan();
        //print_r($data['tindakan']->result());die();
        $this->template->view('keuangan/list_pengeluaran_obat_v',$data);
    }

    public function listPengeluaranTindakan() {
        $data['tindakan'] = $this->KeuanganModel->getTindakanPemeriksaan();
        //$data['obat'] = $this->KeuanganModel->getObatPemeriksaan();
        //print_r($data['tindakan']->result());die();
        $this->template->view('keuangan/list_pengeluaran_tindakan_v',$data);
    }

    public function listTotalPengeluaran_OLD() {
        $data['tindakan'] = $this->KeuanganModel->getTotalTindakan();
        $data['obat'] = $this->KeuanganModel->getTotalObatPemeriksaan();
        //print_r($data['tindakan']->result());die();
        $this->template->view('keuangan/list_total_pengeluaran_v',$data);
    }

    public function listTotalPengeluaran() {
        $data['dokter'] = $this->InsentifModel->listInsentifDokter();
		$data['perawat'] = $this->InsentifModel->listInsentifPerawat();

        $this->template->view('keuangan/list_total_pengeluaran_new_v',$data);
    }

    public function labaRugi_OLD() {
        $data['tindakan'] = $this->KeuanganModel->getTotalTindakan();

        $data['obat'] = $this->KeuanganModel->getTotalObatPemeriksaan();

        $data['total_tindakan'] = $this->KeuanganModel->getTotallabaTindakan();

        $this->template->view('keuangan/laba_rugi_v',$data);
    }

    public function labaRugi() {
		$start_date = $this->input->get('from');
		$end_date = $this->input->get('to');

		if ($start_date && $end_date) {
		    $date['start'] = $start_date;
		    $date['end'] = $end_date;

            $data['total_jasa_medis'] = $this->KeuanganModel->getLabaByPendaftaran('tindakan', $date);
            $data['total_obat'] = $this->KeuanganModel->getLabaByPendaftaran('obat', $date);
            $data['total_obat_racikan'] = $this->KeuanganModel->getLabaByPendaftaran('obat racikan', $date);
            $data['total_jasa_racik'] = $this->KeuanganModel->getLabaByPendaftaran('jasa racik', $date);
            $data['total_bahan_habis_pakai'] = $this->KeuanganModel->getLabaByPendaftaran('bahan habis pakai', $date);
            $data['total_by_jenis_layanan'] = $this->KeuanganModel->getLabaByLayanan($date);
            $data['total_obat_resep_luar'] = $this->KeuanganModel->getLabaObatLuarByPendaftaran($date);

            $data['insentif_dokter'] = $this->InsentifModel->listInsentifDokter($date);
    		$data['insentif_perawat'] = $this->InsentifModel->listInsentifPerawat($date);
		}
		else {
            $data['total_jasa_medis'] = $this->KeuanganModel->getLabaByPendaftaran('tindakan', 'bulanan');
            $data['total_obat'] = $this->KeuanganModel->getLabaByPendaftaran('obat', 'bulanan');
            $data['total_obat_racikan'] = $this->KeuanganModel->getLabaByPendaftaran('obat racikan', 'bulanan');
            $data['total_jasa_racik'] = $this->KeuanganModel->getLabaByPendaftaran('jasa racik', 'bulanan');
            $data['total_bahan_habis_pakai'] = $this->KeuanganModel->getLabaByPendaftaran('bahan habis pakai', 'bulanan');
            $data['total_by_jenis_layanan'] = $this->KeuanganModel->getLabaByLayanan('bulanan');
            $data['total_obat_resep_luar'] = $this->KeuanganModel->getLabaObatLuarByPendaftaran();

            $data['insentif_dokter'] = $this->InsentifModel->listInsentifDokter('bulanan');
    		$data['insentif_perawat'] = $this->InsentifModel->listInsentifPerawat('bulanan');
		}

        $this->template->view('keuangan/laba_rugi_v',$data);
    }
}
