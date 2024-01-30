<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PembelianObatModel extends CI_Model {

    public function getPembelianObat($periode = '') {
        if (is_array($periode)) {
            $this->db->where('created_at >=', $periode['start']);
            $this->db->where('created_at <=', $periode['end'].' 23:59:59');
        }
        return $this->db->where('is_active', 1)->get('pembelian_obat');
    }

    public function getPembelianObatyId($id) {
        return $this->db
            ->where('id', $id)
            ->where('is_active', 1)
            ->get('pembelian_obat');
    }

    public function getReturObat($periode = '') {
        if (is_array($periode)) {
            $this->db->where('created_at >=', $periode['start']);
            $this->db->where('created_at <=', $periode['end'].' 23:59:59');
        }
        return $this->db->where('is_active', 1)->get('retur_obat');
    }

    public function getReturObatyId($id) {
        return $this->db
            ->where('id', $id)
            ->where('is_active', 1)
            ->get('retur_obat');
    }

}
