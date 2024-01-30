<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'controllers/export/BaseExportExcel.php';

class ExportLaporanPasien extends BaseExportExcel
{
    public function __construct() {
        parent::__construct();

        $this->load->library('template');
        $this->load->Model('ObatGlobalModel');
        $this->load->Model('LaporanModel');
        $this->load->Model('PendaftaranModel');
    }

    public function jumlahKunjunganTop()
    {
        $start_date         = ($this->input->post('from'))?$this->input->post('from'):date('Y-m-d');
        $end_date           = ($this->input->post('to'))?$this->input->post('to'):date('Y-m-d');
        $jenis_pendaftaran  = $this->input->post('jenis_pendaftaran');

        $jumlah_kunjungan = $this->LaporanModel->getKunjunganPasien($start_date,$end_date)->result();

        $this->row(['Laporan Kunjungan Pasien']);
        if ($jenis_pendaftaran) {
            $j = $this->PendaftaranModel->getJenisPendaftaranById($jenis_pendaftaran)->row()->nama;
            $this->row(["($j)"]);
        }
        if ($start_date && $end_date) {
            $this->row(["($start_date - $end_date)"]);
        }
        $this->row();
        $this->row(['No', 'Keterangan', 'Jumlah']);
        foreach ($jumlah_kunjungan as $k => $row) {
            if ($row->id == $jenis_pendaftaran || $jenis_pendaftaran == '') {
                $this->row([
                    $k + 1,
                    ucwords($row->nama),
                    ucwords($row->jumlah),
                ]);
            }
        }
        $this->printExcel('laporan_kunjungan_pasien');
    }

    public function jumlahKunjunganBottom()
    {
        $start_date         = ($this->input->post('from'))?$this->input->post('from'):date('Y-m-d');
        $end_date           = ($this->input->post('to'))?$this->input->post('to'):date('Y-m-d');
        $jenis_pendaftaran  = $this->input->post('jenis_pendaftaran');

        $ListPendaftaran = $this->LaporanModel->getListPendaftaran($start_date,$end_date,$jenis_pendaftaran)->result();
        foreach ($ListPendaftaran as &$d) {
            $d->penyakit = $this->LaporanModel->getPenyakitPemeriksaanById($d->pasien_id)->result();
        }

        $this->row(['Laporan Kunjungan Pasien']);
        if ($jenis_pendaftaran) {
            $j = $this->PendaftaranModel->getJenisPendaftaranById($jenis_pendaftaran)->row()->nama;
            $this->row(["($j)"]);
        }
        if ($start_date && $end_date) {
            $this->row(["($start_date - $end_date)"]);
        }
        $this->row();
        $this->row(['No', 'Waktu Kunjungan', 'Nama Pasien', 'No RM', 'Usia', 'Alamat', 'Nama Dokter', 'Diagnosis Jenis Penyakit']);
        foreach ($ListPendaftaran as $k => $row) {
            $penyakit = '';
            if ($row->penyakit) {
                foreach ($row->penyakit as $k1 => $row1) {
                    $penyakit .= $row1->nama.' - '.$row1->kode;
                    if ($k1 < sizeof($row->penyakit) - 1) {
                        $penyakit .= '\n';
                    }
                }
            }

            $this->row([
                $k + 1,
                $this->DateIndo($row->waktu_pendaftaran),
                ucwords($row->nama_pasien),
                ucwords($row->no_rm),
                ucwords($row->usia),
                ucwords($row->alamat),
                ucwords($row->nama_dokter),
                $penyakit
            ]);
        }
        $this->printExcel('laporan_kunjungan_pasien');
    }
}
