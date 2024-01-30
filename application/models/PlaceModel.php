<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PlaceModel extends CI_Model
{
    public function getProvinces()
    {
        return $this->db->query("SELECT * FROM provinces")->result();
    }

    public function getRegencies()
    {
        return $this->db->query("SELECT * FROM regencies")->result();
    }

    public function getDistricts()
    {
        return $this->db->query("SELECT * FROM districts")->result();
    }

    public function getVillages()
    {
        return $this->db->query("SELECT * FROM villages")->result();
    }
}