<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PendaftaranModel extends CI_Model {


    public function getListPasienSelesai($jp_id) {
        $sql = "
            SELECT `pp`.*, pem.form, `pem`.`status`, `pem`.`asuhan_keperawatan`, `p`.`nama` `nama_pasien`, `p`.`jk`, p.telepon, `p`.`usia`, `u`.`nama` `nama_dokter`, `jp`.`nama` `jenis_pendaftaran`
            FROM `pemeriksaan` `pem`
            JOIN `pendaftaran_pasien` `pp` ON `pem`.`pendaftaran_id` = `pp`.`id`
            JOIN `pasien` `p` ON `p`.`id` = `pp`.`pasien` and `p`.`is_active` = 1
            JOIN `user` `u` ON `u`.`id` = `pp`.`dokter` and `u`.`is_active` = 1
            JOIN `jenis_pendaftaran` `jp` ON `jp`.`id` = `pp`.`jenis_pendaftaran_id` and `jp`.`is_active` = 1
            WHERE `pp`.`is_active` = '1'
            AND pp.jenis_pendaftaran_id = $jp_id
            AND pem.id IN (
                SELECT MAX(id)
                FROM pemeriksaan
                WHERE status = 'selesai'
                GROUP BY pasien_id
            )
            GROUP BY `p`.`id`
            ORDER BY `pp`.`waktu_pendaftaran` DESC
        ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getDokter() {
        $this->db->select('u.*, ug.grup_id, g.nama_grup');
        $this->db->from('user u');
        $this->db->join('user_grup ug', 'ug.user_id = u.id', 'left');
        $this->db->join('grup g', 'g.id = ug.grup_id', 'left');
        $this->db->where('g.nama_grup', 'dokter');
        $this->db->where('u.is_active', '1');

        return $this->db->get();
    }

    public function getPasienById($id) {
        $this->db->where('id', $id);
        $this->db->where('is_active', '1');

        return $this->db->get('pasien');
    }

    public function getPemeriksaanPasienById($id) {
        $this->db->select('pem.*, p.no_rm,p.nama nama_p, u.nama nama_d');
        $this->db->join('pasien p', 'p.id = pem.pasien_id', 'left');
        $this->db->join('user u', 'u.id = pem.dokter_id', 'left');
        $this->db->where('pem.pasien_id', $id);
        $this->db->where('pem.is_active', '1');

        return $this->db->get('pemeriksaan pem');
    }

    public function getPendaftaranByIdPasien($id) {
        return $this->db
            ->select('pem.*')
            ->where('pem.pasien', $id)
            ->get('pendaftaran_pasien pem');
    }

    public function cek_id() {
        $this->db->select_max('no_rm');
        $this->db->from('pasien');
        return $this->db->get();
    }

    public function getJenisPendaftaran() {
        $this->db->where('is_active', '1');
        $this->db->where('status', '1');
        return $this->db->get('jenis_pendaftaran');
    }

    public function getJenisPendaftaranById($id) {
        $this->db->where('id', $id);
        $this->db->where('is_active', '1');
        $this->db->where('status', '1');
        return $this->db->get('jenis_pendaftaran');
    }

    public function getListPendaftaran() {
        $this->db->select('pp.*, p.nama nama_pasien, p.jk, p.usia, u.nama nama_dokter, jp.nama jenis_pendaftaran');
        $this->db->from('pendaftaran_pasien pp');
        $this->db->join('pasien p', 'p.id = pp.pasien and p.is_active = 1');
        $this->db->join('user u', 'u.id = pp.dokter and u.is_active = 1');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id and jp.is_active = 1');
        $this->db->where('pp.is_active', '1');
        return $this->db->get();
    }

    public function getListPasienAntri() {
        $this->db->select('pp.*, p.nama nama_pasien, p.id as pasien_id, p.jk, p.usia, u.nama nama_dokter, jp.nama jenis_pendaftaran');
        $this->db->from('pendaftaran_pasien pp');
        $this->db->join('pasien p', 'p.id = pp.pasien and p.is_active = 1');
        $this->db->join('user u', 'u.id = pp.dokter and u.is_active = 1');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id and jp.is_active = 1');
        $this->db->where('pp.is_active', '1');
        $this->db->where('pp.waktu_pendaftaran >=', date('Y-m-d 00:00:00'));
        $this->db->order_by('pp.waktu_pendaftaran', 'asc');

        return $this->db->get();
    }

    public function getListPasienCetakKartu($jenis_pendaftaran_id = 0) {
        if ($jenis_pendaftaran_id) {
            $this->db->where('pp.jenis_pendaftaran_id', $jenis_pendaftaran_id);
        }

        $this->db->select('pp.id as pendaftaran_id, p.no_rm, p.id pasien_id, p.nama nama_pasien, p.jk, p.usia, p.alamat, p.nik, v.name as desa, d.name as kec, r.name as kab, pr.name as prov');
        $this->db->from('pendaftaran_pasien pp');
        $this->db->join('pasien p', 'p.id = pp.pasien and p.is_active = 1');
        $this->db->join('pemeriksaan pem', 'pem.pendaftaran_id = pp.id', 'left');
        $this->db->join('villages v', 'v.id = p.desa_ktp', 'left');
        $this->db->join('districts d', 'd.id = p.kecamatan_ktp', 'left');
        $this->db->join('regencies r', 'r.id = p.kabupaten_ktp', 'left');
        $this->db->join('provinces pr', 'pr.id = p.provinsi_ktp', 'left');
        $this->db->where('pp.is_active', '1');
        $this->db->where('pem.status !=', 'selesai');
        $this->db->order_by('pp.waktu_pendaftaran', 'asc');

        return $this->db->get();
    }

    public function cari($id = '') {
        $this->db->where('no_rm', $id);
        $this->db->where('is_active', '1');
        return $this->db->get('pasien');
    }

    public function getDetailPasienBaruHariIni() {
        $this->db->select('jp.nama AS nama_jenis_pendaftaran, COUNT(pp.jenis_pendaftaran_id) AS jumlah_pasien, jp.id as id_poli');
        $this->db->from('pendaftaran_pasien pp');
        $this->db->join('pemeriksaan p', 'p.pendaftaran_id = pp.id');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id');
        $this->db->join('pasien pas', 'pas.id = pp.pasien');
        $this->db->where('p.status', 'selesai');
        $this->db->where('DATE(pp.created_at) = CURDATE()', null, false);
        $this->db->where('DATE(pas.created_at) = CURDATE()', null, false);
        // $this->db->where('DATE(pp.created_at) = SUBDATE(NOW(), 1)', null, false );
        $this->db->group_by('pp.jenis_pendaftaran_id');

        return $this->db->get();
    }

    public function getListDetailPasienBaruHariIni($jenis_pendaftaran) {
        $this->db->select('pp.*, p.id pasien_id, p.nama nama_pasien, p.no_rm, p.jk, p.usia, u.nama nama_dokter, jp.id as jenis_pendaftaran_id, jp.nama jenis_pendaftaran' );
        $this->db->from('pemeriksaan pem');
        $this->db->join('pendaftaran_pasien pp', 'pem.pendaftaran_id = pp.id');
        $this->db->join('pasien p', 'p.id = pp.pasien and p.is_active = 1');
        $this->db->join('user u', 'u.id = pp.dokter and u.is_active = 1');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id and jp.is_active = 1');
        $this->db->where('pem.status', 'selesai');
        $this->db->where('DATE(pp.created_at) = CURDATE()', null, false);
        if ($jenis_pendaftaran) $this->db->where('pp.jenis_pendaftaran_id', $jenis_pendaftaran );
        return  $this->db->get();
    }

    function cari_kode($keyword) {
        $sql = "
            SELECT 
                *
            FROM 
                pasien
            WHERE
                ( 
                    no_rm LIKE '%" . $this->db->escape_like_str($keyword) . "%' 
                    OR nama LIKE '%" . $this->db->escape_like_str($keyword) . "%' 
                    OR nik LIKE '%" . $this->db->escape_like_str($keyword) . "%' 
                )
            AND is_active = 1
            LIMIT 100
            ";
        return $this->db->query($sql);
    }

    function hapusPendaftaran($idPendaftaran) {
        return $this->db->query("UPDATE pendaftaran_pasien SET is_active = 0 WHERE id = '$idPendaftaran'");
    }
}
