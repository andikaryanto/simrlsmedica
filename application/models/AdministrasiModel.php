<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdministrasiModel extends CI_Model {


    public function getTindakan() {
        $this->db->where('is_active', '1');
        return $this->db->get('tarif_tindakan');
    }

    public function getKlinik() {
        $this->db->where('is_active', '1');
        return $this->db->get('klinik');
    }

    public function getObat() {
        $this->db->where('is_active', '1');
        return $this->db->get('obat');
    }

    public function cek_id() {
        $this->db->select_max('no_rm');
        $this->db->from('pasien');
        return $this->db->get();


        return $this->db->get();
    }


    public function getListPemeriksaan() {
        $this->db->select('pem.*, p.nama nama_pasien, p.jk, p.usia, u.nama nama_dokter');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
        $this->db->where('pem.is_active', '1');
        $this->db->where('pem.status', 'selesai');
        return $this->db->get();
    }

    public function getPemeriksaanById($id) {
        $this->db->select('pem.*, p.nama nama_pasien, p.jk, p.usia,p.alamat, p.tanggal_lahir, p.telepon, p.pekerjaan, u.nama as nama_dokter, u.sip, jpdf.kode, pdf.jaminan, pdf.no_jaminan, pdf.jenis_pendaftaran_id');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
        $this->db->join('pendaftaran_pasien pdf', 'pdf.id = pem.pendaftaran_id');
        $this->db->join('jenis_pendaftaran jpdf', 'jpdf.id = pdf.jenis_pendaftaran_id');
        $this->db->where('pem.is_active', '1');
        $this->db->where('pem.id', $id);
        return $this->db->get();
    }

    public function getTindakanById($id) {
        $this->db->select('dtp.*, td.nama , td.tarif_pasien');
        $this->db->join('tarif_tindakan td', 'td.id = dtp.tarif_tindakan_id and td.is_active = 1');
        $this->db->where('dtp.pemeriksaan_id', $id);
        $this->db->where('dtp.is_active', '1');
        return $this->db->get('detail_tindakan_pemeriksaan dtp');
    }

    public function getTindakanLabByIdPemeriksaan($id) {
        $this->db->select('dtp.*, td.nama , td.tarif_pasien');
        $this->db->join('jenis_layanan_laboratorium td', 'td.id = dtp.jenis_layanan_id and td.is_active = 1');
        $this->db->where('dtp.pemeriksaan_id', $id);
        $this->db->where('dtp.is_active', '1');
        return $this->db->get('detail_tindakan_pemeriksaan_lab dtp');
    }

    public function getObatPemeriksaanById($id) {
        $this->db->select('dop.*, o.nama , o.harga_jual');
        $this->db->join('obat o', 'o.id = dop.obat_id');
        $this->db->where('dop.sunat', 0);
        $this->db->where('dop.pemeriksaan_id', $id);
        $this->db->where('dop.is_active', '1');
        return $this->db->get('detail_obat_pemeriksaan dop');
    }

    public function getObatSunatPemeriksaanById($id) {
        $this->db->select('dop.*, o.nama , o.harga_jual');
        $this->db->join('obat o', 'o.id = dop.obat_id');
        $this->db->where('dop.sunat', 1);
        $this->db->where('dop.pemeriksaan_id', $id);
        $this->db->where('dop.is_active', '1');
        return $this->db->get('detail_obat_pemeriksaan dop');
    }

    public function getBahanHabisPakaiPemeriksaanById($id) {
        $this->db->select('dbh.*, b.nama , b.harga_jual');
        $this->db->join('bahan_habis_pakai b', 'b.id = dbh.bahan_id and b.is_active = 1');
        $this->db->where('dbh.pemeriksaan_id', $id);
        $this->db->where('dbh.is_active', '1');
        return $this->db->get('detail_bahan_pemeriksaan dbh');
    }

    public function getListRacikanByPemeriksaanId($id) {
        $sql = "SELECT * FROM detail_obat_racikan_pemeriksaan WHERE pemeriksaan_id = '$id'";
        return $this->db->query($sql);
    }

    public function getListObatByDetailObatRacikanPemeriksaanId($id) {
        $sql = "SELECT o.*, ora.* FROM obat_racikan ora JOIN obat o ON ora.obat_id = o.id JOIN detail_obat_racikan_pemeriksaan dorp ON ora.detail_obat_racikan_pemeriksaan_id = dorp.id WHERE dorp.id = '$id'";
        return $this->db->query($sql);
    }

    public function getRacikanPemeriksaanById($id) {
        $sql = "SELECT id,nama_racikan, signa, sum(subtotal) as total from
                (select dorp.*, ora.obat_id, ora.jumlah_satuan, o.nama, o.harga_jual, (ora.jumlah_satuan*o.harga_jual) as subtotal from detail_obat_racikan_pemeriksaan dorp 
                join obat_racikan ora ON dorp.id = ora.detail_obat_racikan_pemeriksaan_id
                join obat o on o.id = ora.obat_id where dorp.pemeriksaan_id = $id ) as AA group by id,nama_racikan,signa
            ";
        return $this->db->query($sql);
    }

    public function getRacikanPemeriksaan() {
        $sql = "SELECT id, pemeriksaan_id, nama_racikan, signa, sum(subtotal) as total from
            (select dorp.*, ora.obat_id, ora.jumlah_satuan, o.nama, o.harga_jual, (ora.jumlah_satuan*o.harga_jual) as subtotal from detail_obat_racikan_pemeriksaan dorp 
            join obat_racikan ora ON dorp.id = ora.detail_obat_racikan_pemeriksaan_id
            join obat o on o.id = ora.obat_id ) as AA group by id,pemeriksaan_id,nama_racikan,signa
            ";
        return $this->db->query($sql);
    }

    public function getBayarById($id) {
        $this->db->select('b.*, pem.*, p.nama nama_pasien, p.jk, p.usia,p.alamat, p.telepon, p.pekerjaan, pdf.jaminan, pdf.no_jaminan, u.nama nama_dokter');

        $this->db->from('bayar b');
        $this->db->join('pemeriksaan pem', 'pem.id = b.pemeriksaan_id and pem.is_active = 1');
        $this->db->join('pendaftaran_pasien pdf', 'pdf.id = pem.pendaftaran_id');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');

        $this->db->where('b.id', $id);
        $this->db->where('b.is_active', '1');
        return $this->db->get();
    }

    public function getTindakanBayarById($id) {

        $this->db->where('db.bayar_id', $id);
        $this->db->where('db.jenis_item', 'tindakan');
        $this->db->where('db.is_active', '1');
        return $this->db->get('detail_bayar db');
    }

    public function getObatBayarById($id) {

        $this->db->where('db.bayar_id', $id);
        $this->db->where('db.jenis_item', 'obat');
        $this->db->where('db.is_active', '1');
        return $this->db->get('detail_bayar db');
    }

    public function getObatSunatBayarById($id) {

        $this->db->where('db.bayar_id', $id);
        $this->db->where('db.jenis_item', 'obat operasi/sunat');
        $this->db->where('db.is_active', '1');
        return $this->db->get('detail_bayar db');
    }

    public function getObatRacikanBayarById($id) {

        $this->db->where('db.bayar_id', $id);
        $this->db->where('db.jenis_item', 'obat racikan');
        $this->db->where('db.is_active', '1');
        return $this->db->get('detail_bayar db');
    }

    public function getBahanBayarById($id) {

        $this->db->where('db.bayar_id', $id);
        $this->db->where('db.jenis_item', 'bahan habis pakai');
        $this->db->where('db.is_active', '1');
        return $this->db->get('detail_bayar db');
    }

    public function getJasaRacikBayarById($id) {

        $this->db->where('db.bayar_id', $id);
        $this->db->where('db.jenis_item', 'jasa racik');
        $this->db->where('db.is_active', '1');
        return $this->db->get('detail_bayar db');
    }

    function cari_kode($keyword) {
        $sql = "
            SELECT 
                id, nama_usaha, badan_hukum
            FROM 
                klien
            WHERE
                ( 
                    id LIKE '%" . $this->db->escape_like_str($keyword) . "%' 
                    OR nama_usaha LIKE '%" . $this->db->escape_like_str($keyword) . "%' 
                )
            ";
        return $this->db->query($sql);


    }

    public function getTindakanDetail() {
        $this->db->select('dtp.*, td.nama , td.tarif_pasien');
        $this->db->join('tarif_tindakan td', 'td.id = dtp.tarif_tindakan_id and td.is_active = 1');
        $this->db->join('pemeriksaan pem', 'pem.id = dtp.pemeriksaan_id and dtp.is_active = 1');

        $this->db->where('dtp.is_active', '1');
        return $this->db->get('detail_tindakan_pemeriksaan dtp');
    }

    public function getObatPemeriksaanDetail() {
        $this->db->select('dop.*, o.nama , o.harga_jual');
        $this->db->join('obat o', 'o.id = dop.obat_id');
        $this->db->join('pemeriksaan pem', 'pem.id = dop.pemeriksaan_id and pem.is_active = 1');

        $this->db->where('dop.is_active', '1');
        return $this->db->get('detail_obat_pemeriksaan dop');
    }

    public function getPenyakitPemeriksaanDetail() {
        $this->db->select('dpp.*, pen.nama , pen.kode');
        $this->db->join('penyakit pen', 'pen.id = dpp.penyakit_id and pen.is_active = 1');
        $this->db->join('pemeriksaan pem', 'pem.id = dpp.pemeriksaan_id and pem.is_active = 1');

        $this->db->where('dpp.is_active', '1');
        return $this->db->get('detail_penyakit_pemeriksaan dpp');
    }


}
