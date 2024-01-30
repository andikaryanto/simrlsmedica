<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/25/19
 * Time: 9:53 AM
 */

class DetailObatRacikanPemeriksaanModel extends CI_Model {

    public function getDetailObatRacikanByPemeriksaanId($pemeriksaan_id) {
        return $this->db->query("
            SELECT id,nama_racikan, signa, catatan, sum(subtotal) AS total 
            FROM (
                SELECT dorp.*, ora.obat_id, ora.jumlah_satuan, o.nama, o.harga_jual, 
                (ora.jumlah_satuan * o.harga_jual) AS subtotal 
                FROM detail_obat_racikan_pemeriksaan dorp
                JOIN obat_racikan ora ON dorp.id = ora.detail_obat_racikan_pemeriksaan_id
                JOIN obat o ON o.id = ora.obat_id 
                WHERE dorp.pemeriksaan_id = $pemeriksaan_id
            ) AS AA 
            GROUP BY id, nama_racikan, signa
        ");
    }

    public function getAllObatOfObatRacikanByPemeriksaanId($pemeriksaan_id)
    {
        return $this->db->query("
            SELECT * FROM obat_racikan ora 
            JOIN detail_obat_racikan_pemeriksaan dorp ON ora.detail_obat_racikan_pemeriksaan_id = dorp.id
            WHERE dorp.pemeriksaan_id = '$pemeriksaan_id'
        ");
    }
}
