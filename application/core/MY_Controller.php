<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller 
{
		public function __construct() 
		{
			parent::__construct();

            if ($this->uri->segment(1) == 'DaftarOnline') {

            }
            else {
                if(empty($this->session->userdata('logged_in')))
                {
                    $this->session->set_flashdata('warning', 'Silahkan Login Dahulu');
                    redirect('Login/index','refresh');
                }

                $StatusLogin = $this->cek_session();

                //print_r($StatusLogin);die();
                if(!$StatusLogin){
                    $this->session->set_flashdata('error', 'Waktu Login Sudah Habis, Silahkan Login Dahulu');
                    redirect('Login/index','refresh');
                }
            }
		}

		public function cek_session() 
		{
			$session_cek = $this->session->userdata('logged_in');

	        return $session_cek;
		}

		public function query_error($pesan = "Terjadi kesalahan, coba lagi !")
		{
			$json['status'] = 0;
			$json['pesan'] 	= $pesan;
			echo json_encode($json);
		}
}
?>