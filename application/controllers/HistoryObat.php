<?php


class HistoryObat extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('template');
        $this->load->Model('HistoryObatModel');
    }

    public function stokAwal()
    {
        $jenis = $this->input->get('jenis');
        $tanggal = $this->input->get('tanggal');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');

        if (!$bulan) $bulan = intval(date('m'));
        if (!$tahun) $tahun = intval(date('Y'));

        $data['data'] = $this->HistoryObatModel->stokAwal($jenis, $tanggal, $bulan, $tahun);
        $data['jenis'] = $jenis;
        $data['tanggal'] = $tanggal;
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $this->template->view('history_obat/list_stok_awal_obat', $data);
    }

    public function stokAkhir()
    {
        $jenis = $this->input->get('jenis');
        $tanggal = $this->input->get('tanggal');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');

        if (!$bulan) $bulan = intval(date('m'));
        if (!$tahun) $tahun = intval(date('Y'));

        $data['data'] = $this->HistoryObatModel->stokAkhir($jenis, $tanggal, $bulan, $tahun);
        $data['jenis'] = $jenis;
        $data['tanggal'] = $tanggal;
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $this->template->view('history_obat/list_stok_akhir_obat', $data);
    }

    public function riwayat()
    {
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');

        if (!$bulan) $bulan = intval(date('m'));
        if (!$tahun) $tahun = intval(date('Y'));

        $data['data'] = $this->HistoryObatModel->riwayat($bulan, $tahun);
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $this->template->view('history_obat/list_riwayat_obat', $data);
    }
}