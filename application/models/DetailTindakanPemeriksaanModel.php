<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/25/19
 * Time: 9:31 AM
 */

class DetailTindakanPemeriksaanModel extends CI_Model {

    public function getDetailTindakanByPemeriksaanId($pemeriksaan_id) {
        return $this->db
            ->select('dtp.*, td.nama , td.tarif_pasien')
            ->join('tarif_tindakan td', 'td.id = dtp.tarif_tindakan_id and td.is_active = 1')
            ->join('pemeriksaan pem', 'pem.id = dtp.pemeriksaan_id and dtp.is_active = 1')
            ->where('dtp.pemeriksaan_id', $pemeriksaan_id)
            ->get('detail_tindakan_pemeriksaan dtp');
    }

}