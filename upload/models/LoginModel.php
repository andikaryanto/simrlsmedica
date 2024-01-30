<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

    public function ambilProfile($username, $password)
    {
        
         $this->db->select('u.*,ug.id user_grup_id, g.nama_grup');
         $this->db->from('user u');
         $this->db->join('user_grup ug', 'ug.user_id = u.id');
         $this->db->join('grup g', 'ug.grup_id = g.id');
         $this->db->where('username', $username);
         $this->db->where('password', $password);
        return $this->db->get();
    }

    public function check_username($username) {
        $this->db->where('username', $username);
        return $this->db->get('user');
    }

    public function check_password($password) {
        $this->db->where('password', $password);
        return $this->db->get('user');
    }

    /*public function ambilProfile($username, $password)
    {
        $sql = "SELECT * FROM user WHERE username = '".$username."' AND password = '".$password."' ";
        return $this->db->query($sql);
    }*/

    public function Logout($id_user, $ip)
    {
        $sql = "UPDATE tbl_session_key SET STATUS_LOGIN ='0', `UPDATED_AT` = now() where id_user='".$id_user."' and ip_address='".$ip."'";
        return $this->db->query($sql);
    }

    
}