<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/25/19
 * Time: 9:40 AM
 */

class DetailObatPemeriksaanModel extends CI_Model {

    public function getDetailObatByPemeriksaanId($pemeriksaan_id) {
        return $this->db
            ->select('dop.*, o.nama , o.harga_jual' )
            ->join('obat o', 'o.id = dop.obat_id')
            ->join('pemeriksaan pem', 'pem.id = dop.pemeriksaan_id and pem.is_active = 1')
            ->where('dop.pemeriksaan_id', $pemeriksaan_id)
            ->get('detail_obat_pemeriksaan dop');
    }

}