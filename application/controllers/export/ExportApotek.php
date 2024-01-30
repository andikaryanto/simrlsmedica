<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'controllers/export/BaseExportExcel.php';

class ExportApotek extends BaseExportExcel
{
    public function __construct() {
        parent::__construct();

        $this->load->library('template');
        $this->load->Model('GudangObatModel');
        $this->load->Model('ObatModel');
        $this->load->Model('PembelianObatModel');
    }

    public function stokObat() {
        $listObat = $this->ObatModel->listObat()->result();

        $this->row(['Stok Obat']);
        $this->row();
        $this->row(['No', 'Nama', 'Distributor', 'Harga Beli', 'Harga Jual', 'Stok Obat']);
        foreach ($listObat as $k => $row) {
            $this->row([$k + 1, ucwords($row->nama), $row->distributor, 'Rp '.number_format($row->harga_beli,2,',','.'), 'Rp '.number_format($row->harga_jual,2,',','.'), $row->stok_obat]);
        }
        $this->printExcel('stok_obat');
    }

    public function pembelian() {
        $start_date = $this->input->post('from');
        $end_date = $this->input->post('to');
        $periode = ($start_date && $end_date) ? ['start' => $start_date, 'end' => $end_date] : '';

        $data['pembelian'] = $this->PembelianObatModel->getPembelianObat($periode)->result();
        foreach ($data['pembelian'] as &$datum) {

            $list_obat = json_decode($datum->list_obat);
            $obats = array();
            foreach ($list_obat as &$v) {
                $o = new stdClass();
                $o->obat = $this->ObatModel->getObatById($v->id)->row();
                $o->jumlah = $v->jml;

                $obats[] = $o;
            }
            $datum->obats = $obats;
        }

        $this->row(['Pembelian Obat']);
        if ($start_date && $end_date) {
            $this->row(["($start_date - $end_date)"]);
        }
        $this->row();
        $this->row(['No', 'No Faktur', 'Tgl Faktur', 'Tgl Jatuh Tempo', 'Distributor', 'Profit (%)', 'Total', 'Tgl Dibuat']);
        foreach ($data['pembelian'] as $k => $row) {
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
        $this->printExcel('pembelian_obat');
    }

    public function gudang($what) {
        $obat = ($what == 'obat_ok') ? $this->GudangObatModel->getObat() : $this->GudangObatModel->getObat(false);

        $this->row([($what == 'obat_ok') ? 'Gudang - Obat Ok' : 'Gudang - Obat Kedaluarsa']);
        $this->row();
        $this->row(['No', 'Obat', 'Tgl Kedaluarsa', 'Jumlah', 'Update']);
        foreach ($obat as $k => $value) {
            $this->row([
                $k + 1,
                $value->nama,
                date('d M Y', strtotime($value->tanggal_kadaluwarsa)),
                $value->jumlah,
                $value->updated_at ? date('d M Y', strtotime($value->updated_at)) : '-'
            ]);
        }
        $this->printExcel(($what == 'obat_ok') ? 'obat_ok' : 'obat_kedaluarsa');
    }

    public function mutasi()
    {
        $mutasi = $this->GudangObatModel->getMutasi();

        $this->row(['mutasi']);
        $this->row();
        $this->row(['No', 'Tanggal', 'Item', 'Kedaluarsa', 'Jml', 'Tujuan', 'Keterangan']);
        foreach ($mutasi as $k => $value) {
            $ke = $value->jumlah < 0 ? 'Keluar' : 'Masuk';
            $this->row([
                $k + 1,
                date('d M Y H:i', strtotime($value->created_at)).' - '.$ke,
                $value->nama,
                date('d M Y', strtotime($value->tanggal_kadaluwarsa)),
                ($value->jumlah < 0 ? (-1 * $value->jumlah) : $value->jumlah),
                $value->tujuan,
                $value->note
            ]);
        }
        $this->printExcel('mutasi');
    }
}
