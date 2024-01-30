<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/25/19
 * Time: 9:46 AM
 */

class DetailPenyakitPemeriksaanModel extends CI_Model {

    public function getDetailPenyakitByPemeriksaanId($pemeriksaan_id) {
        return $this->db
            ->select('dpp.*, pen.nama , pen.kode' )
            ->join('penyakit pen', 'pen.id = dpp.penyakit_id')
            ->join('pemeriksaan pem', 'pem.id = dpp.pemeriksaan_id')
            ->where('dpp.pemeriksaan_id', $pemeriksaan_id)
            ->get('detail_penyakit_pemeriksaan dpp');
    }

}