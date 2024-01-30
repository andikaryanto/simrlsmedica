<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PendaftaranModel extends CI_Model {

   

    public function getDokter()
    {            
                $this->db->select('u.*, ug.grup_id, g.nama_grup');
                $this->db->from('user u');
                $this->db->join('user_grup ug','ug.user_id = u.id' , 'left' );
                $this->db->join('grup g','g.id = ug.grup_id', 'left' );
                $this->db->where('g.nama_grup', 'dokter' );
                $this->db->where('u.is_active', '1' );
               
        return $this->db->get();
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
    public function cari($id='')
    {
            $this->db->where('no_rm',$id );
            $this->db->where('is_active', '1');
            return  $this->db->get('pasien');
    }

  

     function cari_kode($keyword)
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