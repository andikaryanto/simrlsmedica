<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/25/19
 * Time: 9:40 AM
 */

class DetailBahanPemeriksaanModel extends CI_Model {

    public function getDetailBahanByPemeriksaanId($pemeriksaan_id) {
        return $this->db
            ->select('dbp.*, b.nama , b.harga_jual' )
            ->join('bahan_habis_pakai b', 'b.id = dbp.bahan_id and b.is_active = 1')
            ->join('pemeriksaan pem', 'pem.id = dbp.pemeriksaan_id and pem.is_active = 1')
            ->where('dbp.pemeriksaan_id', $pemeriksaan_id)
            ->get('detail_bahan_pemeriksaan dbp');
    }

}
