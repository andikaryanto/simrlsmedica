<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KlinikModel extends CI_Model {

    public function getKlinik() {
        $this->db->where('is_active', 1);
        return $this->db->get('klinik')->row();
    }
}