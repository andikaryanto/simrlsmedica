<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PemeriksaanModel extends CI_Model {


    public function getListPendaftaran_antri() {
        $this->db->select('pp.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter, jp.id as jp_id, jp.nama jenis_pendaftaran, jp.kode AS kode_daftar, pem.sudah_periksa_perawat, pem.sudah_periksa_dokter');
        $this->db->select('a.id as antrian_id, a.kode_antrian, a.is_mobile_jkn, a.is_check_in, afo.mulai_layan_poli_at, afo.id as afo_id');
        $this->db->from('pendaftaran_pasien pp');
        $this->db->join('pemeriksaan pem', 'pem.pendaftaran_id = pp.id');
        $this->db->join('pasien p', 'p.id = pp.pasien and p.is_active = 1');
        $this->db->join('user u', 'u.id = pp.dokter and u.is_active = 1');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id and jp.is_active = 1');
        $this->db->join('antrian a', 'a.pendaftaran_id = pp.id', 'left');
        $this->db->join('antrian_front_office afo', 'afo.pendaftaran_id = pp.id', 'left');
        $this->db->where('pp.is_active', '1');
        $this->db->where('pem.status', 'sudah_periksa_awal');
        $this->db->order_by('pp.waktu_pendaftaran', 'asc');
        return $this->db->get();
    }

    public function getJenisPendafataranSudahPeriksaAwal() {
        $this->db->select('pp.jenis_pendaftaran_id, jp.nama jenis_pendaftaran');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pendaftaran_pasien pp', 'pp.id = pem.pendaftaran_id');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id');
        $this->db->where('pem.is_active', '1');
        $this->db->where('pem.status', 'sudah_periksa_awal');
        $this->db->where('jp.is_active', '1');
        $this->db->where('jp.status', '1');
        $this->db->group_by('pp.jenis_pendaftaran_id');
        $this->db->order_by('pem.waktu_pemeriksaan', 'asc');
        return $this->db->get()->result();
    }

//    public function getListPendaftaran_antriByIdJenisPendafataran($id_jenis_pendaftaran) {
//        $this->db->select('pp.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter, jp.nama jenis_pendaftaran, jp.kode AS kode_daftar');
//        $this->db->from('pendaftaran_pasien pp');
//        $this->db->join('pasien p', 'p.id = pp.pasien and p.is_active = 1');
//        $this->db->join('user u', 'u.id = pp.dokter and u.is_active = 1');
//        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id and jp.is_active = 1');
//        $this->db->where('pp.is_active', '1');
//        $this->db->where('pp.status', 'antri');
//        $this->db->where('pp.jenis_pendaftaran_id', $id_jenis_pendaftaran);
//        $this->db->order_by('pp.waktu_pendaftaran', 'asc');
//        return $this->db->get();
//    }

    public function getListPendaftaran_antriByIdJenisPendafataran($id_jenis_pendaftaran) {
        $this->db->select('pp.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter, jp.id as jp_id, jp.nama jenis_pendaftaran, jp.kode AS kode_daftar, pem.sudah_periksa_perawat, pem.sudah_periksa_dokter');
        $this->db->select('a.id as antrian_id, a.kode_antrian, a.is_mobile_jkn, a.is_check_in, afo.mulai_layan_poli_at, afo.id as afo_id');
        $this->db->from('pendaftaran_pasien pp');
        $this->db->join('pemeriksaan pem', 'pem.pendaftaran_id = pp.id');
        $this->db->join('pasien p', 'p.id = pp.pasien and p.is_active = 1');
        $this->db->join('user u', 'u.id = pp.dokter and u.is_active = 1');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id and jp.is_active = 1');
        $this->db->join('antrian a', 'a.pendaftaran_id = pp.id', 'left');
        $this->db->join('antrian_front_office afo', 'afo.pendaftaran_id = pp.id', 'left');
        $this->db->where('pp.is_active', '1');
        $this->db->where('pem.status', 'sudah_periksa_awal');
        $this->db->where('pp.jenis_pendaftaran_id', $id_jenis_pendaftaran);
        $this->db->order_by('pp.waktu_pendaftaran', 'asc');
        return $this->db->get();
    }

    public function getPemeriksaanByIdPendaftaran($id) {
        $this->db->select('pmr.*, p.id as pasien_id, p.nama nama_pasien, p.alamat, p.jk, p.alamat, p.telepon, p.pekerjaan, p.usia, p.agama, u.nama nama_dokter, jp.nama jenis_pendaftaran, jp.kode AS kode_daftar');
        $this->db->from('pemeriksaan pmr');
        $this->db->join('pendaftaran_pasien pp', 'pmr.pendaftaran_id = pp.id and pmr.is_active = 1');
        $this->db->join('pasien p', 'p.id = pp.pasien and p.is_active = 1');
        $this->db->join('user u', 'u.id = pp.dokter and u.is_active = 1');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id and jp.is_active = 1');
        $this->db->where('pp.is_active', '1');
        $this->db->where('pp.id', $id);

        return $this->db->get();
    }

    public function getPrevPemeriksaanByIdPasien($pasien_id, $prev_id) {
        $this->db->select('pmr.*, p.id as pasien_id, p.nama nama_pasien, p.alamat, p.jk, p.alamat, p.telepon, p.pekerjaan, p.usia, p.agama, u.nama nama_dokter, jp.nama jenis_pendaftaran, jp.kode AS kode_daftar');
        $this->db->from('pemeriksaan pmr');
        $this->db->join('pendaftaran_pasien pp', 'pmr.pendaftaran_id = pp.id and pmr.is_active = 1');
        $this->db->join('pasien p', 'p.id = pp.pasien and p.is_active = 1');
        $this->db->join('user u', 'u.id = pp.dokter and u.is_active = 1');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id and jp.is_active = 1');
        $this->db->where('pp.is_active', '1');
        $this->db->where('pp.pasien', $pasien_id);
        $this->db->where('pmr.id <', $prev_id);
        $this->db->order_by('pmr.id', 'desc');

        return $this->db->get();
    }

    public function getPendaftaranById($id) {
        $this->db->select('pp.*, pem.id as pemeriksaan_id, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter, jp.nama jenis_pendaftaran, jp.kode AS kode_daftar');
        $this->db->from('pendaftaran_pasien pp');
        $this->db->join('pemeriksaan pem', 'pem.pendaftaran_id = pp.id', 'left');
        $this->db->join('pasien p', 'p.id = pp.pasien and p.is_active = 1');
        $this->db->join('user u', 'u.id = pp.dokter and u.is_active = 1');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id and jp.is_active = 1');
        $this->db->where('pp.is_active', '1');
        $this->db->where('pp.id', $id);

        return $this->db->get();
    }

    public function getPendaftaranByIdPemeriksaan($id) {
        $this->db->select('pp.*, p.nama nama_pasien, p.alamat, p.jk, p.alamat, p.usia, u.nama nama_dokter, jp.nama jenis_pendaftaran, jp.kode AS kode_daftar');
        $this->db->from('pendaftaran_pasien pp');
        $this->db->join('pasien p', 'p.id = pp.pasien and p.is_active = 1');
        $this->db->join('user u', 'u.id = pp.dokter and u.is_active = 1');
        $this->db->join('pemeriksaan pmr', 'pmr.pendaftaran_id = pp.id and pmr.is_active = 1');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id and jp.is_active = 1');
        $this->db->where('pp.is_active', '1');
        $this->db->where('pmr.id', $id);

        return $this->db->get();
    }

    public function getTindakan_all() {
        $this->db->where('is_active', '1');
        return $this->db->get('tarif_tindakan');
    }

    public function getTindakanByCategory($category) {
        $this->db->where('is_active', '1');
        $this->db->where('category', $category);
        return $this->db->get('tarif_tindakan');
    }

//    public function getPenyakit() {
//        $this->db->where('is_active', '1');
//        $this->db->where('is_poligigi', '0');
//        $this->db->where('is_laborat', '0');
//        return $this->db->get('penyakit');
//    }

    public function getPenyakitByCategory($category) {
        $this->db->where('is_active', '1');
        $this->db->where('category', $category);
        return $this->db->get('penyakit');
    }

//    // Poligigi
//    public function getTindakanGigi() {
//        $this->db->where('is_active', '1');
//        $this->db->where('is_poligigi', '1');
//        return $this->db->get('tarif_tindakan');
//    }
//
//    public function getPenyakitGigi() {
//        $this->db->where('is_active', '1');
//        $this->db->where('is_poligigi', '1');
//        return $this->db->get('penyakit');
//    }
//
//    // Laborat
//    public function getTindakanLaborat() {
//        $this->db->where('is_active', '1');
//        $this->db->where('is_laborat', '1');
//        return $this->db->get('tarif_tindakan');
//    }
//
//    public function getLayananLaborat() {
//        $this->db->where('is_active', '1');
//        $this->db->where('is_laborat', '1');
//        return $this->db->get('penyakit');
//    }
//
//    // EKG
//    public function getTindakanOf($jenis) {
//        $col = $this->config->item('poli')[$jenis]['column'];
//
//        $this->db->where('is_active', '1');
//        $this->db->where($col, '1');
//        return $this->db->get('tarif_tindakan');
//    }
//
//    public function getLayananOf($jenis) {
//        $col = $this->config->item('poli')[$jenis]['column'];
//
//        $this->db->where('is_active', '1');
//        $this->db->where($col, '1');
//        return $this->db->get('penyakit');
//    }

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

    public function getJenisPendaftaran() {
        $this->db->where('is_active', '1');
        $this->db->where('status', '1');
        return $this->db->get('jenis_pendaftaran');
    }

    public function getListPendaftaran() {
        $this->db->select('pp.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter, jp.nama jenis_pendaftaran');
        $this->db->from('pendaftaran_pasien pp');
        $this->db->join('pasien p', 'p.id = pp.pasien and p.is_active = 1');
        $this->db->join('user u', 'u.id = pp.dokter and u.is_active = 1');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id and jp.is_active = 1');
        $this->db->where('pp.is_active', '1');
        return $this->db->get();
    }

    public function getListPemeriksaan_sehat() {
        $this->db->select('pem.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter, jp.nama as poli, pen.tipe_layanan');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
        $this->db->join('pendaftaran_pasien pen', 'pen.id = pem.pendaftaran_id and pen.is_active = 1');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pen.jenis_pendaftaran_id');

        $this->db->where('pem.is_active', '1');
        $this->db->where("(pem.status = 'selesai' OR pem.status = 'sudah_periksa')", null);
        $this->db->where('pen.surat', 'sehat');
        return $this->db->get();
    }

    public function getListPemeriksaan_consent() {
        $this->db->select('pem.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter, jp.nama as poli');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
        $this->db->join('pendaftaran_pasien pen', 'pen.id = pem.pendaftaran_id and pen.is_active = 1');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pen.jenis_pendaftaran_id');

        $this->db->where('pem.is_active', '1');
        $this->db->where('pen.surat', 'consent');
        $this->db->order_by('pen.id', 'desc');
        return $this->db->get();
    }

    public function getListPemeriksaan_sakit() {
        $this->db->select('pem.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter, jp.nama as poli, pen.tipe_layanan');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
        $this->db->join('pendaftaran_pasien pen', 'pen.id = pem.pendaftaran_id and pen.is_active = 1');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pen.jenis_pendaftaran_id');

        $this->db->where('pem.is_active', '1');
        $this->db->where("(pem.status = 'selesai' OR pem.status = 'sudah_periksa')", null);
        $this->db->where('pen.surat', 'sakit');
        return $this->db->get();
    }

    public function getJenisPendafataranAntrian() {
        $this->db->select('pp.jenis_pendaftaran_id, jp.nama jenis_pendaftaran');
        $this->db->from('pendaftaran_pasien pp');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id and jp.is_active = 1');
        $this->db->where('pp.is_active', '1');
        $this->db->where('jp.id', '20');
//        $this->db->where('pp.status', 'antri');
        $this->db->group_by('pp.jenis_pendaftaran_id');
        $this->db->order_by('pp.waktu_pendaftaran', 'asc');
        return $this->db->get()->result();
    }

    public function getListPemeriksaan() {
        $this->db->select('pem.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
        $this->db->where('pem.is_active', '1');
        $this->db->where('pem.status', 'selesai');
        $this->db->order_by('pem.waktu_pemeriksaan', 'asc');
        return $this->db->get();
    }

    public function getListPemeriksaanSudahPeriksaAwal() {
        $this->db->select('pem.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter, jp.nama as jenis_pendaftaran');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pendaftaran_pasien pp', 'pp.id = pem.pendaftaran_id');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
        $this->db->where('pem.is_active', '1');
        $this->db->where('pem.status', 'sudah_periksa_awal');
        $this->db->order_by('pem.waktu_pemeriksaan', 'asc');
        return $this->db->get();
    }

    public function getListPemeriksaanSudahPeriksaAwalByIdJenisPendaftaran(...$id_jenis_pendaftaran) {
        $this->db->select('pem.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter, jp.nama as jenis_pendaftaran');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pendaftaran_pasien pp', 'pp.id = pem.pendaftaran_id');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
        $this->db->where('pem.is_active', '1');
        $this->db->where('pem.status', 'sudah_periksa_awal');
        $this->db->where_in('pp.jenis_pendaftaran_id', $id_jenis_pendaftaran);
        $this->db->order_by('pem.waktu_pemeriksaan', 'asc');

//        $this->db->select('pem.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter, jp.nama as jenis_pendaftaran, jp.id as jenis_pendaftaran_id');
//        $this->db->select('a.id as antrian_id, a.kode_antrian, a.is_mobile_jkn, a.is_check_in, afo.mulai_layan_poli_at, afo.id as afo_id');
//        $this->db->from('pemeriksaan pem');
//        $this->db->join('pendaftaran_pasien pp', 'pp.id = pem.pendaftaran_id');
//        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id');
//        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
//        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
//        $this->db->join('antrian a', 'a.pendaftaran_id = pp.id', 'left');
//        $this->db->join('antrian_front_office afo', 'afo.pendaftaran_id = pp.id', 'left');
//        $this->db->where('pem.is_active', '1');
//        $this->db->where('pem.status', 'sudah_periksa_awal');
//        $this->db->where_in('pp.jenis_pendaftaran_id', $id_jenis_pendaftaran);
//        $this->db->order_by('pem.waktu_pemeriksaan', 'asc');
        return $this->db->get();
    }

    public function getListPemeriksaanLaboratoriumAfterPeriksa() {
        $this->db->select('pem.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
        $this->db->join('pendaftaran_pasien pp', 'pp.id = pem.pendaftaran_id and pp.is_active = 1');
        $this->db->where('pem.is_active', '1');
        $this->db->where('pp.jenis_pendaftaran_id', '19');
        $this->db->where('(pem.status', "'sudah_periksa'", false);
        $this->db->or_where('pem.status', "'sudah_bayar'", false);
        $this->db->or_where('pem.status', "'selesai')", false);
        $this->db->order_by('pem.waktu_pemeriksaan', 'desc');
        $this->db->limit(500);
        return $this->db->get();
    }

    public function getListPemeriksaanSudahPeriksa() {
        $this->db->select('pem.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter, p.alamat, pp.waktu_pendaftaran, jp.nama as jenis_layanan');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pendaftaran_pasien pp', 'pp.id = pem.pendaftaran_id');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id and jp.is_active = 1 and jp.status = 1');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
        $this->db->where('pem.is_active', '1');
        $this->db->where('pem.status', 'sudah_periksa');
        $this->db->order_by('pem.waktu_pemeriksaan', 'asc');
        return $this->db->get();
    }

    public function getListPemeriksaanLaboratoriumSudahPeriksa() {
        $this->db->select('pem.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
        $this->db->join('pendaftaran_pasien pp', 'pp.id = pem.pendaftaran_id and pp.is_active = 1');
        $this->db->where('pem.is_active', '1');
        $this->db->where('pem.status', 'sudah_periksa');
        $this->db->where('pp.jenis_pendaftaran_id', '19');
        $this->db->order_by('pem.waktu_pemeriksaan', 'asc');
        return $this->db->get();
    }

    public function getListPemeriksaanLaboratoriumSudahBayar() {
        $this->db->select('pem.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
        $this->db->join('pendaftaran_pasien pp', 'pp.id = pem.pendaftaran_id and pp.is_active = 1');
        $this->db->where('pem.is_active', '1');
        $this->db->where('pem.status', 'sudah_bayar');
        $this->db->where('pp.jenis_pendaftaran_id', '19');
        $this->db->order_by('pem.waktu_pemeriksaan', 'asc');
        return $this->db->get();
    }

    public function getListPemeriksaanLaboratoriumSelesai() {
        $this->db->select('pem.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
        $this->db->join('pendaftaran_pasien pp', 'pp.id = pem.pendaftaran_id and pp.is_active = 1');
        $this->db->where('pem.is_active', '1');
        $this->db->where('pem.status', 'selesai');
        $this->db->where('pp.jenis_pendaftaran_id', '19');
        $this->db->order_by('pem.waktu_pemeriksaan', 'asc');
        return $this->db->get();
    }

    public function getListPemeriksaanSudahPeriksaAtauSudahBayar() {
        $this->db->select('pem.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
        $this->db->where('pem.is_active', '1');
        $this->db->where('(pem.status', "'sudah_periksa'", false);
        $this->db->or_where('pem.status', "'sudah_bayar')", false);
        $this->db->order_by('pem.waktu_pemeriksaan', 'asc');
        return $this->db->get();
    }

    public function getListPemeriksaanTanpaLabSudahPeriksaAtauSudahBayar() {
        $this->db->select('pem.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter, pp.tdk_diambil, jp.nama poli');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
        $this->db->join('pendaftaran_pasien pp', 'pp.id = pem.pendaftaran_id and pp.is_active = 1');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id');
        $this->db->where('pp.jenis_pendaftaran_id !=', '19');
        $this->db->where('pem.is_active', '1');
        $this->db->where('date(pem.created_at) >=', '2023-08-15');
        $this->db->where('(pem.status', "'sudah_periksa'", false);
        $this->db->or_where('pem.status', "'sudah_bayar')", false);
        $this->db->order_by('pem.waktu_pemeriksaan', 'asc');
        $this->db->limit(300);
        return $this->db->get();
    }

    public function getListPemeriksaanSetelahPeriksa() {
        $this->db->select('pem.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
        $this->db->where('pem.is_active', '1');
        $this->db->where("pem.status != 'belum'", null);
        $this->db->order_by('pem.waktu_pemeriksaan', 'asc');
        return $this->db->get();
    }

    public function getListPemeriksaanSetelahPeriksa100() {
        $this->db->select('pem.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
        $this->db->where('pem.is_active', '1');
        $this->db->where("pem.status != 'belum'", null);
        $this->db->order_by('pem.waktu_pemeriksaan', 'desc');
        $this->db->limit(200);
        return $this->db->get();
    }

    public function getListPemeriksaanSudahPeriksaAtauSudahObat() {
        $this->db->select('pem.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
        $this->db->where('pem.is_active', '1');
        $this->db->where('(pem.status', "'sudah_periksa'", FALSE);
        $this->db->or_where('pem.status', "'sudah_obat')", FALSE);
        $this->db->order_by('pem.waktu_pemeriksaan', 'asc');
        return $this->db->get();
    }

    public function getListPemeriksaanSudahPeriksaAtauSudahObatAtauSudahBayar() {
        $this->db->select('pem.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter, jp.nama as poli');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
        $this->db->join('pendaftaran_pasien ps', 'pem.pendaftaran_id = ps.id');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = ps.jenis_pendaftaran_id');
        $this->db->where('pem.is_active', '1');
        $this->db->where('(pem.status', "'sudah_periksa'", FALSE);
        $this->db->or_where('pem.status', "'sudah_obat'", FALSE);
        $this->db->or_where('pem.status', "'sudah_bayar')", FALSE);
        $this->db->order_by('pem.waktu_pemeriksaan', 'asc');
        return $this->db->get();
    }

    public function getListPemeriksaanSelesai($periode = '') {
        $this->db->select('pem.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, u.nama nama_dokter, jp.nama AS nama_jenis_pendaftaran, b.total AS total_bayar');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
        $this->db->join('pendaftaran_pasien ps', 'pem.pendaftaran_id = ps.id');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = ps.jenis_pendaftaran_id');
        $this->db->join('bayar b', 'b.pemeriksaan_id = pem.id');
        $this->db->where('pem.is_active', '1');
        $this->db->where('pem.status', "'selesai'", FALSE);
        $this->db->order_by('pem.waktu_pemeriksaan', 'asc');

        if ($periode == 'harian') {
            $this->db->where('DATE(pem.created_at) = CURDATE()', null, FALSE);
        } else if ($periode == 'bulanan') {
            $this->db->where('MONTH(pem.created_at) = MONTH(CURDATE())', null, FALSE);
        } else {
            $this->db->where("DATE(pem.created_at) = '$periode'", null, FALSE);
        }

        return $this->db->get();
    }

    public function getPemeriksaanById($id) {
        $this->db->select('pem.*');
        $this->db->from('pemeriksaan pem');
        $this->db->where('pem.id', $id);
        return $this->db->get();
    }

    public function getPasienHariIni() {
        $this->db->select('*');
        $this->db->from('pemeriksaan');
        $this->db->where('status', 'selesai');
        $this->db->where('DATE(created_at) = CURDATE()', null, false);
        return $this->db->get();
    }

    public function getPasienBulanIni() {
        $this->db->select('*');
        $this->db->from('pemeriksaan pp');
        $this->db->join('pasien p', 'p.id = pp.pasien_id and p.is_active = 1');
        $this->db->where('pp.status', 'selesai');
        $this->db->where('MONTH(pp.created_at) = MONTH(CURDATE())', null, false);
        $this->db->where('YEAR(pp.created_at) = YEAR(CURDATE())', null, false);
        return $this->db->get();
    }

    public function getDetailPasienBulanIni() {
        $this->db->select('COUNT(jp.id) AS jumlah_pasien, jp.nama AS nama_jenis_pendaftaran, jp.id as id_poli');
        $this->db->from('pemeriksaan pem');

        $this->db->join('pendaftaran_pasien ps', 'pem.pendaftaran_id = ps.id');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = ps.jenis_pendaftaran_id');
        $this->db->join('pasien p', 'p.id = ps.pasien and p.is_active = 1');

        $this->db->where('pem.status', 'selesai');
        $this->db->where('MONTH(pem.created_at) = MONTH(CURDATE()) AND YEAR(pem.created_at) = YEAR(CURDATE())', null, false);
        $this->db->group_by('jp.id');

        return $this->db->get();
    }

    public function getListDetailPasienBulanIni($jenis_pendaftaran) {
        $this->db->select('pp.*, p.id pasien_id, p.nama nama_pasien, p.no_rm, p.jk, p.usia, u.nama nama_dokter, jp.id as jenis_pendaftaran_id, jp.nama jenis_pendaftaran, pp.tipe_layanan' );
        $this->db->from('pemeriksaan pem');
        $this->db->join('pendaftaran_pasien pp', 'pem.pendaftaran_id = pp.id');
        $this->db->join('pasien p', 'p.id = pp.pasien and p.is_active = 1');
        $this->db->join('user u', 'u.id = pp.dokter and u.is_active = 1');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id and jp.is_active = 1');
        $this->db->where('pem.status', 'selesai');
        $this->db->where('MONTH(pem.created_at) = MONTH(CURDATE()) AND YEAR(pem.created_at) = YEAR(CURDATE())', null, false);
        if ($jenis_pendaftaran) $this->db->where('pp.jenis_pendaftaran_id', $jenis_pendaftaran );
        return  $this->db->get();
    }

    public function getDetailPasienHariIni() {
        $this->db->select('pem.*, p.nama nama_pasien, COUNT(jp.id) AS jumlah_pasien, jp.nama AS nama_jenis_pendaftaran, jp.id AS id_poli');
        $this->db->from('pemeriksaan pem');

        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
        $this->db->join('pendaftaran_pasien ps', 'pem.pendaftaran_id = ps.id');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = ps.jenis_pendaftaran_id');

        $this->db->where('pem.status', 'selesai');
        $this->db->where('DATE(pem.created_at) = CURDATE()', null, false);
        $this->db->group_by('jp.id');

        return $this->db->get();
    }

    public function getListDetailKunjunganHariIni($jenis_pendaftaran)
    {
        $this->db->select('pp.*, p.id pasien_id, p.nama nama_pasien, p.no_rm, p.jk, p.usia, u.nama nama_dokter, jp.id as jenis_pendaftaran_id, jp.nama jenis_pendaftaran' );
        $this->db->from('pemeriksaan pem');
        $this->db->join('pendaftaran_pasien pp', 'pem.pendaftaran_id = pp.id');
        $this->db->join('pasien p', 'p.id = pp.pasien and p.is_active = 1');
        $this->db->join('user u', 'u.id = pp.dokter and u.is_active = 1');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id and jp.is_active = 1');
        $this->db->where('pem.status', 'selesai');
        $this->db->where('DATE(pem.created_at) = CURDATE()', null, false);
        if ($jenis_pendaftaran) $this->db->where('pp.jenis_pendaftaran_id', $jenis_pendaftaran );
        return  $this->db->get();
    }

    public function getTransaksiBulanIni() {
        $this->db->select('SUM(b.total) AS total_bayar');
        $this->db->from('pemeriksaan pem');
        $this->db->join('bayar b', 'b.pemeriksaan_id = pem.id');
        $this->db->where('pem.is_active', '1');
        $this->db->where('pem.status', "'selesai'", FALSE);
        $this->db->where('MONTH(b.created_at) = MONTH(CURDATE()) AND YEAR(b.created_at) = YEAR(CURDATE())', null, false);
        return $this->db->get();
    }

    public function getDetailTransaksiBulanIni($jp_id = 0) {
        $this->db->select('pem.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, jp.nama AS nama_jenis_pendaftaran, b.total AS total_bayar, b.id as bayar_id');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('pendaftaran_pasien ps', 'pem.pendaftaran_id = ps.id and ps.is_active = 1');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = ps.jenis_pendaftaran_id');
        $this->db->join('bayar b', 'b.pemeriksaan_id = pem.id');
        $this->db->where('pem.is_active', '1');
        $this->db->where('pem.status', "'selesai'", FALSE);
        $this->db->where('MONTH(b.created_at) = MONTH(CURDATE()) AND YEAR(b.created_at) = YEAR(CURDATE())', null, false);
        $this->db->order_by('pem.waktu_pemeriksaan', 'asc');
        if ($jp_id) $this->db->where('jp.id', $jp_id );
        return $this->db->get();
    }

    public function getDetailTransaksiBulanIniByStartAndEndDate($start_date, $end_date, $jp_id = 0) {
        $this->db->select('pem.*, p.nama nama_pasien, p.alamat, p.jk, p.usia, jp.nama AS nama_jenis_pendaftaran, b.total AS total_bayar, b.id as bayar_id');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('pendaftaran_pasien ps', 'pem.pendaftaran_id = ps.id and ps.is_active = 1');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = ps.jenis_pendaftaran_id');
        $this->db->join('bayar b', 'b.pemeriksaan_id = pem.id');
        $this->db->where('pem.is_active', '1');
        $this->db->where('pem.status', "'selesai'", FALSE);
        $this->db->where('MONTH(b.created_at) = MONTH(CURDATE()) AND YEAR(b.created_at) = YEAR(CURDATE())', null, false);
        $this->db->where('pem.created_at >=', $start_date);
        $this->db->where('pem.created_at <=', $end_date.' 23:59:59');
        $this->db->order_by('pem.waktu_pemeriksaan', 'asc');
        if ($jp_id) $this->db->where('jp.id', $jp_id );
        return $this->db->get();
    }

    public function getDetailTransaksiBulanIniGroupByJenisPendaftaran() {
        $this->db->select('jp.nama AS nama_jenis_pendaftaran, jp.id as id_poli, SUM(b.total) AS total_bayar');
        $this->db->from('pemeriksaan pem');
        $this->db->join('pendaftaran_pasien ps', 'pem.pendaftaran_id = ps.id and ps.is_active = 1');
        $this->db->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = ps.jenis_pendaftaran_id');
        $this->db->join('bayar b', 'b.pemeriksaan_id = pem.id');
        $this->db->where('pem.is_active', '1');
        $this->db->where('pem.status', "'selesai'", FALSE);
        $this->db->where('MONTH(b.created_at) = MONTH(CURDATE()) AND YEAR(b.created_at) = YEAR(CURDATE())', null, false);
        $this->db->group_by('jp.id');
        return $this->db->get();
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

    public function getDetailBayarByBayarId($bayar_id)
    {
        return $this->db
            ->select('jenis_item, SUM(subtotal) as subtotal')
            ->where('bayar_id', $bayar_id)
            ->group_by('jenis_item')
            ->get('detail_bayar')
            ->result();
    }
}
