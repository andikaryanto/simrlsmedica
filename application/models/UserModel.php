<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    public function listAllUser()
    {

         $this->db->select('u.*,ug.id user_grup_id, g.nama_grup');
         $this->db->from('user u');
         $this->db->join('user_grup ug', 'ug.user_id = u.id');
         $this->db->join('grup g', 'ug.grup_id = g.id');
         $this->db->where('u.is_active', 1);
         $this->db->where('g.nama_grup !=', 'superadmin');

        return $this->db->get();
    }

    public function getUserById($id)
    {

         $this->db->select('u.*,ug.id as user_grup_id, ug.grup_id, g.nama_grup');
         $this->db->from('user u');
         $this->db->join('user_grup ug', 'ug.user_id = u.id');
         $this->db->join('grup g', 'ug.grup_id = g.id');
         $this->db->where('u.is_active', 1);
         $this->db->where('u.id', $id);

        return $this->db->get();
    }

    public function getGrup()
    {
         $this->db->where('is_active', 1);
        return $this->db->get('grup');
    }

    public function getKlinik()
    {
         $this->db->where('is_active', 1);
        return $this->db->get('klinik');
    }


   //////////////////
    public function list_kabag_farmasi() {

        $this->db->select('u.*,ug.id user_grup_id, g.nama_grup, jp.nama as nama_poli');
        $this->db->from('user u');
        $this->db->join('user_grup ug', 'ug.user_id = u.id');
        $this->db->join('grup g', 'ug.grup_id = g.id');
        $this->db->join('jenis_pendaftaran jp', 'u.id_jenis_pendaftaran = jp.id', 'LEFT');
        $this->db->where('u.is_active', 1);
        $this->db->where('g.nama_grup', 'kabag_farmasi');

        return $this->db->get();
    }

    public function list_kabag_layanan_medis() {

        $this->db->select('u.*,ug.id user_grup_id, g.nama_grup, jp.nama as nama_poli');
        $this->db->from('user u');
        $this->db->join('user_grup ug', 'ug.user_id = u.id');
        $this->db->join('grup g', 'ug.grup_id = g.id');
        $this->db->join('jenis_pendaftaran jp', 'u.id_jenis_pendaftaran = jp.id', 'LEFT');
        $this->db->where('u.is_active', 1);
        $this->db->where('g.nama_grup', 'kabag_layanan_medis');

        return $this->db->get();
    }

    public function list_kabag_keuangan() {

        $this->db->select('u.*,ug.id user_grup_id, g.nama_grup, jp.nama as nama_poli');
        $this->db->from('user u');
        $this->db->join('user_grup ug', 'ug.user_id = u.id');
        $this->db->join('grup g', 'ug.grup_id = g.id');
        $this->db->join('jenis_pendaftaran jp', 'u.id_jenis_pendaftaran = jp.id', 'LEFT');
        $this->db->where('u.is_active', 1);
        $this->db->where('g.nama_grup', 'kabag_keuangan');

        return $this->db->get();
    }

    public function list_admin_obat() {

        $this->db->select('u.*,ug.id user_grup_id, g.nama_grup, jp.nama as nama_poli');
        $this->db->from('user u');
        $this->db->join('user_grup ug', 'ug.user_id = u.id');
        $this->db->join('grup g', 'ug.grup_id = g.id');
        $this->db->join('jenis_pendaftaran jp', 'u.id_jenis_pendaftaran = jp.id', 'LEFT');
        $this->db->where('u.is_active', 1);
        $this->db->where('g.nama_grup', 'admin_obat');

        return $this->db->get();
    }
}
