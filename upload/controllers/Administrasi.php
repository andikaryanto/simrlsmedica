<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrasi extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();		
       
        $this->load->library('template');
        $this->load->Model('PendaftaranModel');
        $this->load->Model('PemeriksaanModel');
        $this->load->Model('MainModel');
	}
	
	public function index()
	{
		
		redirect('Administrasi/listPasienSelesaiPeriksa');
		
	}
	

	public function listPasienSelesaiPeriksa()
	{
		$data['listPemeriksaan'] = $this->PemeriksaanModel->getListPemeriksaan();		
		$this->template->view('administrasi/list_pasien_selesai_v',$data);
	}

	public function pemberianObat()
	{
		$data['listPemeriksaan'] = $this->PemeriksaanModel->getListPemeriksaan();		
		$this->template->view('administrasi/list_pasien_selesai_v',$data);
	}

	

	
	
	


	
}

