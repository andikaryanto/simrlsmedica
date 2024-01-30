<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perawat extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();		
       
        $this->load->library('template');
        $this->load->Model('PerawatModel');
        $this->load->Model('MainModel');
	}
	
	public function index(){
		redirect('Perawat/listPerawat');
	}

	public function listPerawat()
	{
		$data['listPerawat'] = $this->PerawatModel->listPerawat();
		
		$this->template->view('master/perawat/list_perawat_v',$data);
	}
	



	
}

