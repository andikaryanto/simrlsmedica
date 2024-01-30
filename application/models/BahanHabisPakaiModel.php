<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/25/19
 * Time: 9:40 AM
 */

class BahanHabisPakaiModel extends CI_Model {

    public function getBahanById($id) {
        return $this->db
            ->where('is_active', 1)
            ->where('id', $id)
            ->get('bahan_habis_pakai');
    }

    public function listBhp() {
        return $this->db
            ->where('is_active', 1)
            ->get('bahan_habis_pakai');
    }

    public function listBarangLain() {
        return $this->db
            ->where('is_active', 1)
            ->get('barang_lain');
    }

    public function getSettingpersen()
    {
        $this->db->where('is_active', 1);
        $this->db->where('nama', 'harga_bahan_habis_pakai');
        return $this->db->get('prosentase_harga');
    }

}
