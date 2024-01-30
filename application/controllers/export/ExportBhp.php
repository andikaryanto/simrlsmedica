<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'controllers/export/BaseExportExcel.php';

class ExportBhp extends BaseExportExcel
{
    public function __construct() {
        parent::__construct();

        $this->load->library('template');
        $this->load->Model('GudangBahanModel');
        $this->load->Model('GudangObatModel');
        $this->load->Model('ObatModel');
        $this->load->Model('PembelianObatModel');
    }

    public function stok() {
        $data = $this->db->get_where('bahan_habis_pakai', ['is_active' => 1])->result();

        $this->row(['Stok Bahan Habis Pakai']);
        $this->row();
        $this->row(['No', 'Nama', 'Harga Beli', 'Harga Jual', 'Stok', 'Tgl. Update']);
        foreach ($data as $k => $row) {
            $this->row([
                $k + 1,
                $row->nama,
                'Rp '.number_format($row->harga_beli, 2, ',', '.'),
                'Rp '.number_format($row->harga_jual, 2, ',', '.'),
                $row->jumlah.' '.$row->satuan,
                $row->updated_at ? date('d M Y, H:i', strtotime( $row->updated_at )) : date('d M Y, H:i', strtotime($row->created_at))
            ]);
        }
        $this->printExcel('stok_bahan_habis_pakai');
    }

    public function pembelian() {
        $data = $this->db->get_where('pembelian_bahan', ['is_active' => 1])->result();

        $this->row(['Pembelian Bahan Habis Pakai']);
        $this->row();
        $this->row(['No', 'No Faktur', 'Tgl Faktur', 'Tgl Jatuh Tempo', 'Nama Distributor', 'Profit (%)', 'Total', 'Tgl Dibuat']);
        foreach ($data as $k => $row) {
            $this->row([
                $k + 1,
                ucwords($row->no_faktur),
                date('d M Y', strtotime($row->tgl_faktur)),
                date('d M Y', strtotime($row->tgl_jatuh_tempo)),
                ucwords($row->nama_distributor),
                $row->profit.'%',
                'Rp '.number_format($row->total, 2, ',', '.'),
                date('d M Y', strtotime($row->created_at))
            ]);
        }
        $this->printExcel('pembelian_bahan_habis_pakai');
    }

    public function gudang() {
        $data = $this->GudangBahanModel->getObat();

        $this->row(['Gudang Bahan Habis Pakai']);
        $this->row();
        $this->row(['No', 'Obat', 'Jumlah', 'Update']);
        foreach ($data as $k => $value) {
            $this->row([
                $k + 1,
                ucwords($value->nama),
                $value->jumlah .' '.$value->satuan,
                $value->updated_at ? date('d M Y', strtotime($value->updated_at)) : '-'
            ]);
        }
        $this->printExcel('gudang_bahan_habis_pakai');
    }

    public function mutasi() {
        $data = $this->GudangBahanModel->getMutasi();

        $this->row(['Mutasi Bahan Habis Pakai']);
        $this->row();
        $this->row(['No', 'Tanggal', 'Item', 'Kedaluarsa', 'Jml', 'Tujuan', 'Keterangan']);
        foreach ($data as $k => $value) {
            $ke = $value->jumlah < 0 ? 'Keluar' : 'Masuk';
            $this->row([
                $k + 1,
                date('d M Y H:i', strtotime($value->created_at)).' - '.$ke,
                $value->nama,
                date('d M Y', strtotime($value->tanggal_kadaluwarsa)),
                ($value->jumlah < 0 ? (-1 * $value->jumlah) : $value->jumlah).' '.$value->satuan,
                $value->tujuan,
                $value->note
            ]);
        }
        $this->printExcel('mutasi_bahan_habis_pakai');
    }
}
