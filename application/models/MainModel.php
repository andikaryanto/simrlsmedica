<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainModel extends CI_Model {

    public function insert($tabel,$data){
        return $this->db->insert($tabel, $data);
    }

     public function insert_id($tabel, $data){
        $this->db->insert($tabel, $data);
        return $this->db->insert_id();
    }

    public function update($tabel,$data,$id){
        $this->db->where('id', $id);
        return $this->db->update($tabel, $data);
    }

    public function delete($tabel,$data,$id){
        $this->db->where('id', $id);
        return $this->db->update($tabel, $data);
    }

    public function hardDelete($tabel, $id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($tabel);
    }

    public function hardDeleteWhere($tabel, $where)
    {
        return $this->db->where($where[0], $where[1])->delete($tabel);
    }
}