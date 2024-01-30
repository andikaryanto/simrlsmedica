<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PasienModel extends CI_Model {

   

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

    public function getListPasien()
    {            
             
                
                $this->db->where('is_active', '1' );
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