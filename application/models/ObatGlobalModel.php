<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ObatGlobalModel extends CI_Model
{
    public function get_obat_luar($periode = '')
    {
        if ($periode == 'harian') {
            $this->db->where('date_format(db.created_at,"%Y-%m-%d")', 'CURDATE()', FALSE);
        }
        else if (is_array($periode)) {
            $this->db->where('db.created_at >=', $periode['start']);
            $this->db->where('db.created_at <=', $periode['end'].' 23:59:59');
        }
        else {
            $this->db->where('MONTH(db.created_at)', 'MONTH(CURDATE())', FALSE);
            $this->db->where('YEAR(db.created_at)', 'YEAR(CURDATE())', FALSE);
        }

        return $this->db
            ->where('db.is_active', '1')
            ->join('obat o', 'o.id = db.obat_id')
            ->select('db.obat_id, o.nama as nama_obat, db.jumlah_satuan as jumlah, o.harga_jual as harga')
            ->get('detail_penjualan_obat_luar db')
            ->result();
    }

    public function get_obat_racikan_luar($periode = '')
    {
        if ($periode == 'harian') {
            $this->db->where('date_format(db.created_at,"%Y-%m-%d")', 'CURDATE()', FALSE);
        }
        else if (is_array($periode)) {
            $this->db->where('db.created_at >=', $periode['start']);
            $this->db->where('db.created_at <=', $periode['end'].' 23:59:59');
        }
        else {
            $this->db->where('MONTH(db.created_at)', 'MONTH(CURDATE())', FALSE);
            $this->db->where('YEAR(db.created_at)', 'YEAR(CURDATE())', FALSE);
        }

        return $this->db
            ->where('db.is_active', '1')
            ->join('obat o', 'o.id = db.obat_id')
            ->select('db.obat_id, o.nama as nama_obat, db.jumlah_satuan as jumlah, o.harga_jual as harga')
            ->get('obat_racikan_luar db')
            ->result();
    }

    public function get_obat_pemeriksaan($periode = '')
    {
        if ($periode == 'harian') {
            $this->db->where('date_format(db.created_at,"%Y-%m-%d")', 'CURDATE()', FALSE);
        }
        else if (is_array($periode)) {
            $this->db->where('db.created_at >=', $periode['start']);
            $this->db->where('db.created_at <=', $periode['end'].' 23:59:59');
        }
        else {
            $this->db->where('MONTH(db.created_at)', 'MONTH(CURDATE())', FALSE);
            $this->db->where('YEAR(db.created_at)', 'YEAR(CURDATE())', FALSE);
        }

        return $this->db
            ->where('db.is_active', '1')
            ->join('obat o', 'o.id = db.obat_id')
            ->select('db.obat_id, o.nama as nama_obat, db.jumlah_satuan as jumlah, o.harga_jual as harga')
            ->get('detail_obat_pemeriksaan db')
            ->result();
    }

    public function get_obat_racikan_pemeriksaan($periode = '')
    {
        if ($periode == 'harian') {
            $this->db->where('date_format(db.created_at,"%Y-%m-%d")', 'CURDATE()', FALSE);
        }
        else if (is_array($periode)) {
            $this->db->where('db.created_at >=', $periode['start']);
            $this->db->where('db.created_at <=', $periode['end'].' 23:59:59');
        }
        else {
            $this->db->where('MONTH(db.created_at)', 'MONTH(CURDATE())', FALSE);
            $this->db->where('YEAR(db.created_at)', 'YEAR(CURDATE())', FALSE);
        }

        return $this->db
            ->where('db.is_active', '1')
            ->join('obat o', 'o.id = db.obat_id')
            ->select('db.obat_id, o.nama as nama_obat, db.jumlah_satuan as jumlah, o.harga_jual as harga')
            ->get('obat_racikan db')
            ->result();
    }
}
