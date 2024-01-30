<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SppModel extends CI_Model {

    public function getSpp()
    {
        
         $this->db->select('spp.*, 
         					klien.badan_hukum, 
         					klien.nama_usaha, 
         					klien.alamat, 
         					klien.tlp,
         					klien.nama_kontak_person,
         					klien.tlp_kontak_person,
         					klien.email_kontak_person,
         					
         					');
         $this->db->from('spp');        
         $this->db->join('klien','spp.id_klien = klien.id');        
        return $this->db->get();
    }

    public function insertSpp($data){
        return $this->db->insert('spp', $data);
        
    }
    public function insertPemohon($data){
        return $this->db->insert('klien', $data);
        
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
   

    
}