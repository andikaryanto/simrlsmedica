<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenyakitModel extends CI_Model {

    public function getListPenyakit()
    {
        $this->db->where('is_active', '1' );
        $this->db->where('is_poligigi', '0');
        $this->db->where('is_laborat', '0');

        return $this->db->get('penyakit');
    }

    // Poligigi

    public function getPenyakitGigiById($id)
    {
        $this->db->where('is_active', '1' );
        $this->db->where('id', $id );

        return $this->db->get('penyakit');
    }

    // Laboratorium

    public function getLayananLaboratById($id)
    {
        $this->db->where('is_active', '1' );
        $this->db->where('id', $id );

        return $this->db->get('penyakit');
    }

    public function getListLayananLaborat()
    {
        $this->db->where('is_active', '1' );
        $this->db->where('is_laborat', '1');
        return $this->db->get('penyakit');
    }

    public function getObat()
    {
        $this->db->where('is_active', '1' );
        return $this->db->get('obat');
    }

    public function cek_id()
    {
                $this->db->select_max('no_rm');
                $this->db->from('pasien');
        return $this->db->get();


        return $this->db->get();
    }

    public function getJenisPendaftaran()
    {
                $this->db->where('is_active', '1' );
                $this->db->where('status', '1' );
        return  $this->db->get('jenis_pendaftaran');
    }

    public function getListPendaftaran()
    {
                $this->db->select('pp.*, p.nama nama_pasien, p.jk, p.usia, u.nama nama_dokter, jp.nama jenis_pendaftaran' );
                $this->db->from('pendaftaran_pasien pp');
                $this->db->join('pasien p', 'p.id = pp.pasien and p.is_active = 1');
                $this->db->join('user u', 'u.id = pp.dokter and u.is_active = 1');
                $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id and jp.is_active = 1');
                $this->db->where('pp.is_active', '1' );
        return  $this->db->get();
    }

    public function getListPemeriksaan()
    {
                $this->db->select('pem.*, p.nama nama_pasien, p.jk, p.usia, u.nama nama_dokter' );
                $this->db->from('pemeriksaan pem');
                $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
                $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');

                $this->db->where('pem.is_active', '1' );
                $this->db->where('pem.status', 'selesai' );
        return  $this->db->get();
    }



    function cari_kode($keyword)
    {
        $sql = "
            SELECT
                id, nama_usaha, badan_hukum
            FROM
                klien
            WHERE
                (
                    id LIKE '%".$this->db->escape_like_str($keyword)."%'
                    OR nama_usaha LIKE '%".$this->db->escape_like_str($keyword)."%'
                )
            ";
        return $this->db->query($sql);
    }

    // untuk MasterPoli
    public function getPenyakitById($id)
    {
        return $this->db
            ->where('is_active', '1')
            ->where('id', $id)
            ->get('penyakit');
    }

//    public function getListPenyakitUmum() {
//        return $this->db
//            ->where('is_active', '1')
//            ->where('is_umum', '1')
//            ->get('penyakit');
//    }
//
//    public function getListPenyakitGigi() {
//        return $this->db
//            ->where('is_active', '1')
//            ->where('is_poligigi', '1')
//            ->get('penyakit');
//    }
//
//    public function getListPenyakitKia() {
//        return $this->db
//            ->where('is_active', '1')
//            ->where('is_kia', '1')
//            ->get('penyakit');
//    }
//
//    public function getListPenyakitFisio() {
//        return $this->db
//            ->where('is_active', '1')
//            ->where('is_fisio', '1')
//            ->get('penyakit');
//    }
//
//    public function getListPenyakitLaborat() {
//        return $this->db
//            ->where('is_active', '1')
//            ->where('is_laborat', '1')
//            ->get('penyakit');
//    }

    public function getListByCategory($catgeory) {
        return $this->db
            ->where('is_active', '1')
            ->where('category', $catgeory)
            ->get('penyakit');
    }
}
