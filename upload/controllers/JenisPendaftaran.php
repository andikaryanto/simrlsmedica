<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JenisPendaftaran extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();		
       
        $this->load->library('template');
        $this->load->Model('JenisPendaftaranModel');
        $this->load->Model('MainModel');
	}
	
	public function index(){
		redirect('JenisPendaftaran/listJenisPendaftaran');
	}

	



	public function listJenisPendaftaran()
	{
		$data['listJenisPendaftaran'] = $this->JenisPendaftaranModel->listJenisPendaftaran();
		
		$this->template->view('master/jenis_pendaftaran/list_jenis_pendaftaran_v',$data);
	}
	



	
}

