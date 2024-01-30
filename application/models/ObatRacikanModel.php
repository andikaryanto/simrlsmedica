<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ObatRacikanModel extends CI_Model {

    public function getRacikanByIdPemeriksaan($id) {
        return $this->db
            ->where('is_active', 1)
            ->where('pemeriksaan_id', $id)
            ->get('detail_obat_racikan_pemeriksaan');
    }

    public function getObatRacikanByIdDetailObatRacikan($id) {
        return $this->db
            ->where('obr.is_active', 1)
            ->where('detail_obat_racikan_pemeriksaan_id', $id)
            ->join('obat o', 'obr.obat_id = o.id')
            ->get('obat_racikan obr');
    }
}