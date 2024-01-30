<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->library('template');
        $this->load->Model('AdministrasiModel');
        $this->load->Model('PasienModel');
        $this->load->Model('PemeriksaanModel');
        $this->load->Model('PendaftaranModel');
        $this->load->Model('JenisPendaftaranModel');
        $this->load->Model('PembelianObatModel');
        $this->load->Model('GudangObatModel');
        $this->load->Model('DashboardModel');
        $this->load->Model('LaporanModel');
        $this->load->Model('ObatLuarModel');
        $this->load->Model('KeuanganModel');
	}

	public function index()
	{
        $data['pasien_hari_ini'] = sizeof($this->PemeriksaanModel->getPasienHariIni()->result());
        $data['pasien_baru_hari_ini'] = sizeof($this->PasienModel->getPasienBaruHariIni()->result());
        $data['total_pasien'] = sizeof($this->PemeriksaanModel->getPasienBulanIni()->result());
        $data['total_transaksi'] = $this->DashboardModel->getTotalTransaksiBulanIniV2()->row()->total;

        foreach ($this->DashboardModel->getLabaObatLuarByPendaftaran()->result() as $d) {
            $data['total_transaksi'] += $d->total_bayar;
        }

        $data['obat_kedaluarsa'] = $this->GudangObatModel->getObat(false);
        $data['pembelian'] = $this->PembelianObatModel->getPembelianObat()->result();

        $data['chart_kunjungan'] = $this->DashboardModel->getKunjungan()->result();
        $data['chart_penyakit'] = $this->DashboardModel->getPenyakit()->result();

        $data['laba'] = 0;
        foreach ($this->KeuanganModel->getLabaByLayanan(['start' => date('Y-m-01'), 'end' => date('Y-m-d')])->result() as $item) {
            $data['laba'] += $item->total;
        }

        $this->template->view('template/content', $data);
	}

	public function pasienHariIni($id_poli = 0) {
	    if ($id_poli == 0) {
            $data['list'] = $this->PemeriksaanModel->getDetailPasienHariIni()->result();
            $this->template->view('dashboard/pasien_hari_ini', $data);
        }
	    else {
	        $poli = $this->JenisPendaftaranModel->getJenisPendaftaranById($id_poli)->row();
	        $data['title'] = "Pasien hari ini ({$poli->nama})";
            $data['ListPendaftaran'] = $this->PemeriksaanModel->getListDetailKunjunganHariIni($id_poli)->result();
            foreach ($data['ListPendaftaran'] as &$d) {
                $d->penyakit = $this->LaporanModel->getPenyakitPemeriksaanById($d->pasien_id)->result();
            }
            $this->template->view('dashboard/detail_kunjungan', $data);
        }
	}

	public function pasienBaru($id_poli = 0) {
        if ($id_poli == 0) {
            $data['list'] = $this->PendaftaranModel->getDetailPasienBaruHariIni()->result();
            $this->template->view('dashboard/pasien_baru', $data);
        }
        else {
            $poli = $this->JenisPendaftaranModel->getJenisPendaftaranById($id_poli)->row();
            $data['title'] = "Pasien baru ({$poli->nama})";
            $data['ListPendaftaran'] = $this->PendaftaranModel->getListDetailPasienBaruHariIni($id_poli)->result();
            foreach ($data['ListPendaftaran'] as &$d) {
                $d->penyakit = $this->LaporanModel->getPenyakitPemeriksaanById($d->pasien_id)->result();
            }
            $this->template->view('dashboard/detail_kunjungan', $data);
        }
	}

	public function totalPasien($id_poli = 0) {
        if ($id_poli == 0) {
            $data['list'] = $this->PemeriksaanModel->getDetailPasienBulanIni()->result();
            $this->template->view('dashboard/total_pasien', $data);
        }
        else {
            $poli = $this->JenisPendaftaranModel->getJenisPendaftaranById($id_poli)->row();
            $data['title'] = "Total Pasien ({$poli->nama})";
            $data['ListPendaftaran'] = $this->PemeriksaanModel->getListDetailPasienBulanIni($id_poli)->result();
            foreach ($data['ListPendaftaran'] as &$d) {
                $d->penyakit = $this->LaporanModel->getPenyakitPemeriksaanById($d->pasien_id)->result();
            }
            $data['klinik'] = $this->db->query("SELECT * from klinik")->row();
            $data['id_poli'] = $id_poli;
            $this->template->view('dashboard/detail_kunjungan', $data);
        }
	}

	public function totalTransaksi($id_poli = 0) {
	    if ($id_poli === 0) {
            $data['list'] = $this->PemeriksaanModel->getDetailTransaksiBulanIniGroupByJenisPendaftaran()->result();
            $data['list_obat_luar'] = $this->DashboardModel->getLabaObatLuarByPendaftaran()->result();

            usort($data['list'], function($a, $b) {
                return $b->total_bayar - $a->total_bayar;
            });
            usort($data['list_obat_luar'], function($a, $b) {
                return $b->total_bayar - $a->total_bayar;
            });

            $this->template->view('dashboard/total_transaksi_all', $data);
        }
	    else {
            $start_date = $this->input->get('from');
            $end_date = $this->input->get('to');

	        if (is_numeric($id_poli)) {
                $poli = $this->JenisPendaftaranModel->getJenisPendaftaranById($id_poli)->row();

                if ($start_date && $end_date) {
                    $data['list'] = $this->PemeriksaanModel->getDetailTransaksiBulanIniByStartAndEndDate($start_date, $end_date, $id_poli)->result();
                    $date['from'] = $start_date;
                    $date['to'] = $end_date;
                }
                else {
                    $data['list'] = $this->PemeriksaanModel->getDetailTransaksiBulanIni($id_poli)->result();
                }

                $data['title'] = "Total Transaksi ({$poli->nama})";
                $data['jaminan'] = $this->config->item('pendaftaran');
                $data['id_poli'] = $id_poli;

                function search($id, $array) {
                    foreach ($array as $key => $val) {
                        if ($val->jenis_item === $id) {
                            return $val->subtotal;
                        }
                    }
                    return 0;
                }

                foreach ($data['list'] as &$d) {
                    $detail = $this->PemeriksaanModel->getDetailBayarByBayarId($d->bayar_id);
                    $d->biaya_tindakan = search('tindakan', $detail);
                    $d->biaya_obat = search('obat', $detail);
                    $d->biaya_obat_racikan = search('obat racikan', $detail);
                    $d->biaya_jasa_racik = search('jasa racik', $detail);
                    $d->biaya_bahan_habis_pakai = search('bahan habis pakai', $detail);
                }

                $this->template->view('dashboard/total_transaksi', $data);
            }
	        else {
                if ($id_poli == 'resep_luar') {
                    $this->rekapitulasi_resep_luar($start_date, $end_date);
                }
                else if ($id_poli == 'obat_bebas') {
                    $this->rekapitulasi_obat_bebas($start_date, $end_date);
                }
                else if ($id_poli == 'obat_internal') {
                    $this->rekapitulasi_obat_internal($start_date, $end_date);
                }
            }
        }
	}

    public function rekapitulasi_resep_luar($start_date, $end_date)
    {
        if ($start_date && $end_date) {
            $data['list'] = $this->DashboardModel->getPenjualanResepLuarSudahBayar(['start' => $start_date, 'end' => $end_date]);
            $date['from'] = $start_date;
            $date['to'] = $end_date;
        }
        else {
            $data['list'] = $this->DashboardModel->getPenjualanResepLuarSudahBayar();
        }

        $data['id_poli'] = 'resep_luar';
        $data['obat'] = $this->ObatLuarModel->getDetailPenjualanObatLuar();
        $data['racikan'] = $this->ObatLuarModel->getRekapRacikan();

        $this->template->view('dashboard/rekap_resep_luar', $data);
    }

    public function rekapitulasi_obat_bebas($start_date, $end_date)
    {
        if ($start_date && $end_date) {
            $data['list'] = $this->DashboardModel->getPenjualanObatBebasSudahBayar(['start' => $start_date, 'end' => $end_date]);
            $date['from'] = $start_date;
            $date['to'] = $end_date;
        }
        else {
            $data['list'] = $this->DashboardModel->getPenjualanObatBebasSudahBayar();
        }

        $data['id_poli'] = 'obat_bebas';
        $data['obat'] = $this->ObatLuarModel->getDetailPenjualanObatLuar();
        $data['racikan'] = $this->ObatLuarModel->getRekapRacikan();

        $this->template->view('dashboard/rekap_obat_bebas', $data);
    }

    public function rekapitulasi_obat_internal($start_date, $end_date)
    {
        if ($start_date && $end_date) {
            $data['list'] = $this->DashboardModel->getPenjualanObatInternalSudahBayar(['start' => $start_date, 'end' => $end_date]);
            $date['from'] = $start_date;
            $date['to'] = $end_date;
        }
        else {
            $data['list'] = $this->DashboardModel->getPenjualanObatInternalSudahBayar();
        }

        $data['id_poli'] = 'obat_internal';
        $data['obat'] = $this->ObatLuarModel->getDetailPenjualanObatLuar();
        $data['racikan'] = $this->ObatLuarModel->getRekapRacikan();

        $this->template->view('dashboard/rekap_obat_internal', $data);
    }
}
