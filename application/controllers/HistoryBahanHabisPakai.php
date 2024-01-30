<?php


class HistoryBahanHabisPakai extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('template');
        $this->load->Model('HistoryBahanHabisPakaiModel');
    }

    public function stokAwal()
    {
        $jenis = $this->input->get('jenis');
        $tanggal = $this->input->get('tanggal');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');

        if (!$bulan) $bulan = intval(date('m'));
        if (!$tahun) $tahun = intval(date('Y'));

        $data['data'] = $this->HistoryBahanHabisPakaiModel->stokAwal($jenis, $tanggal, $bulan, $tahun);
        $data['jenis'] = $jenis;
        $data['tanggal'] = $tanggal;
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $this->template->view('history_bahan_habis_pakai/list_stok_awal_bhp', $data);
    }

    public function stokAkhir()
    {
        $jenis = $this->input->get('jenis');
        $tanggal = $this->input->get('tanggal');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');

        if (!$bulan) $bulan = intval(date('m'));
        if (!$tahun) $tahun = intval(date('Y'));

        $data['data'] = $this->HistoryBahanHabisPakaiModel->stokAkhir($jenis, $tanggal, $bulan, $tahun);
        $data['jenis'] = $jenis;
        $data['tanggal'] = $tanggal;
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $this->template->view('history_bahan_habis_pakai/list_stok_akhir_bhp', $data);
    }

    public function riwayat()
    {
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');

        if (!$bulan) $bulan = intval(date('m'));
        if (!$tahun) $tahun = intval(date('Y'));

        $data['data'] = $this->HistoryBahanHabisPakaiModel->riwayat($bulan, $tahun);
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $this->template->view('history_bahan_habis_pakai/list_riwayat_bhp', $data);
    }
}