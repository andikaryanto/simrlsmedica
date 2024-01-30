<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PasienModel extends CI_Model {

    public function cek_id()
    {
                $this->db->select_max('no_rm');
                $this->db->from('pasien');
        return $this->db->get();

    }

    public function getJenisPendaftaran()
    {
                $this->db->where('is_active', '1' );
        return  $this->db->get('jenis_pendaftaran');
    }

    public function getListPasien()
    {
                $this->db->where('is_active', '1' );
                $this->db->order_by("id", "desc");
                $this->db->limit(100);
        return  $this->db->get('pasien');
    }

    public function getPasienById($id)
    {
                $this->db->where('is_active', '1' );
                $this->db->where('id',$id);
        return  $this->db->get('pasien');
    }

    public function getPasienBaruHariIni()
    {
        $this->db->select('p.*');
        $this->db->from('pasien p');
        $this->db->join('pemeriksaan pm', 'pm.pasien_id = p.id');
        // $this->db->where('p.is_active', '1' );
        $this->db->where('pm.status', "selesai");
        $this->db->where('DATE(p.created_at) = CURDATE()', null, false);
        $this->db->group_by('p.id');
        return  $this->db->get();
    }

    public function getPasienBulanIni()
    {
                $this->db->where('is_active', '1' );
                $this->db->where('MONTH(created_at) = MONTH(CURDATE())', null, false);
                $this->db->where('YEAR(created_at) = YEAR(CURDATE())', null, false);
        return  $this->db->get('pasien');
    }

    public function getNoRmAuto()
    {
        $this->db->select('no_rm');
        $this->db->from('pasien');
        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        $no_rm = (int) $this->db->get()->row()->no_rm;
        $no_rm++;
        return str_pad($no_rm, 8, '0', STR_PAD_LEFT);
    }

    public function cari_kode($keyword)
    {
        $sql = "
            SELECT 
                id, no_rm, nama, usia
            FROM 
                pasien
            WHERE
                ( 
                    no_rm LIKE '%".$this->db->escape_like_str($keyword)."%' 
                    OR nama LIKE '%".$this->db->escape_like_str($keyword)."%' 
                )
            ";
        return $this->db->query($sql);
    }
}
