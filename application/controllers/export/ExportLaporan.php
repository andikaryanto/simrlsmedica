<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'controllers/export/BaseExportExcel.php';

class ExportLaporan extends BaseExportExcel
{
    public function __construct() {
        parent::__construct();

        $this->load->library('template');
        $this->load->Model('ObatGlobalModel');
        $this->load->Model('LaporanModel');
        $this->load->Model('PendaftaranModel');
    }

    public function resep_internal()
    {
        $start_date         = ($this->input->post('from'))?$this->input->post('from'):date('Y-m-d');
        $end_date           = ($this->input->post('to'))?$this->input->post('to'):date('Y-m-d');
        $jenis_pendaftaran  = $this->input->post('jenis_pendaftaran');

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

        $data['obat'] = array_slice($res, 0, 10);

        $this->row(['Resep Internal']);
        if ($jenis_pendaftaran) {
            $j = $this->PendaftaranModel->getJenisPendaftaranById($jenis_pendaftaran)->row()->nama;
            $this->row(["($j)"]);
        }
        if ($start_date && $end_date) {
            $this->row(["($start_date - $end_date)"]);
        }
        $this->row();
        $this->row(['No', 'Nama', 'Jumlah']);
        foreach ($data['obat'] as $k => $v) {
            $this->row([$k + 1, ucwords($v->nama), $v->jumlah]);
        }
        $this->printExcel('resep_internal');
    }

    public function obat_resep_luar() {
        $start_date         = ($this->input->post('from'))?$this->input->post('from'):date('Y-m-d');
        $end_date           = ($this->input->post('to'))?$this->input->post('to'):date('Y-m-d');

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

        $data['obat'] = array_slice($res, 0, 10);

        $this->row(['Resep Luar']);
        if ($start_date && $end_date) {
            $this->row(["($start_date - $end_date)"]);
        }
        $this->row();
        $this->row(['No', 'Nama', 'Jumlah']);
        foreach ($data['obat'] as $k => $v) {
            $this->row([$k + 1, ucwords($v->nama), $v->jumlah]);
        }
        $this->printExcel('resep_luar');
    }

    public function obat_obat_bebas() {
        $start_date         = ($this->input->post('from'))?$this->input->post('from'):date('Y-m-d');
        $end_date           = ($this->input->post('to'))?$this->input->post('to'):date('Y-m-d');

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

        $data['obat'] = array_slice($res, 0, 10);

        $this->row(['Obat Bebas']);
        if ($start_date && $end_date) {
            $this->row(["($start_date - $end_date)"]);
        }
        $this->row();
        $this->row(['No', 'Nama', 'Jumlah']);
        foreach ($data['obat'] as $k => $v) {
            $this->row([$k + 1, ucwords($v->nama), $v->jumlah]);
        }
        $this->printExcel('obat_bebas');
    }

    public function obat_obat_internal() {
        $start_date         = ($this->input->post('from'))?$this->input->post('from'):date('Y-m-d');
        $end_date           = ($this->input->post('to'))?$this->input->post('to'):date('Y-m-d');

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

        $data['obat'] = array_slice($res, 0, 10);

        $this->row(['Obat Internal']);
        if ($start_date && $end_date) {
            $this->row(["($start_date - $end_date)"]);
        }
        $this->row();
        $this->row(['No', 'Nama', 'Jumlah']);
        foreach ($data['obat'] as $k => $v) {
            $this->row([$k + 1, ucwords($v->nama), $v->jumlah]);
        }
        $this->printExcel('obat_internal');
    }

    public function penjualan_obat_global()
    {
        $start_date = $this->input->post('from');
        $end_date = $this->input->post('to');
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

        $this->row(['Penjualan Obat Global']);
        if ($start_date && $end_date) {
            $this->row(["($start_date - $end_date)"]);
        }
        $this->row();
        $this->row(['No', 'Item', 'Jumlah', 'Harga', 'Subtotal']);
        foreach ($obats as $k => $v) {
            $this->row([$k + 1, ucwords($v->nama_obat), $v->jumlah, $v->harga, $v->jumlah * $v->harga]);
        }
        $this->printExcel('penjualan_obat_global');
    }
}
