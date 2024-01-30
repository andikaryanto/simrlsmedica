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

	public function status($id, $status)
	{	
		if ($status == 1) {
			$data = array('status' =>2, );
		}else{
			$data = array('status' =>1, );
		}
		
		
		if ($this->MainModel->update($tabel='jenis_pendaftaran',$data,$id)) {
			$this->session->set_flashdata('success', 'Status Jenis Pendaftaran berhasil diubah!');
			redirect('JenisPendaftaran/listJenisPendaftaran','refresh');
		}else{
			$this->session->set_flashdata('warning', 'Status Jenis Pendaftaran gagal diubah!');
			redirect('JenisPendaftaran/listJenisPendaftaran','refresh');
		}
		
	}

	public function addJenisPendaftaran(){
		$sesi = $this->session->userdata('logged_in');
	
		$this->template->view('master/jenis_pendaftaran/jenispendaftaran_tambah_v');
	}

	public function edit($id){
		$sesi = $this->session->userdata('logged_in');
		$data['jenis_pendaftaran'] = $this->JenisPendaftaranModel->getJenisPendaftaranById($id)->row();
		//print_r($data['obat']);die();		
		$this->template->view('master/jenis_pendaftaran/jenispendaftaran_edit_v',$data);
	}

	public function simpanTambah(){
		$sesi = $this->session->userdata('logged_in');
		//print_r($this->input->post());die();				
							
 		$id = $this->input->post('id');    	
    	
    			$jenis_pendaftaran = array(
						'nama'             => $this->input->post('nama'), 					
						'kode'             => $this->input->post('kode'), 					
						'status'             => 1, 					
						'creator'             => $sesi->id
					); 
    		$a = $this->MainModel->insert($tabel='jenis_pendaftaran', $jenis_pendaftaran);
    		

    		if ($a) {
    			$this->session->set_flashdata('success', 'Data Jenis Pendaftaran berhasil ditambah!');
    			redirect('JenisPendaftaran/listJenisPendaftaran');
    		}
    
    	$this->session->set_flashdata('warning', 'Data Jenis Pendaftaran gagal ditambah!');
    	redirect('JenisPendaftaran/listJenisPendaftaran');
		
	}
	public function simpanUpdate(){
		$sesi = $this->session->userdata('logged_in');
		//print_r($this->input->post());die();				
							
 		$id = $this->input->post('id');    	
    	
    			$jenis_pendaftaran = array(
						'nama'             => $this->input->post('nama'), 					
						'kode'             => $this->input->post('kode'), 					
						'creator'             => $sesi->id
					); 
    		$a = $this->MainModel->update($tabel='jenis_pendaftaran', $jenis_pendaftaran,$id);
    		

    		if ($a) {
    			$this->session->set_flashdata('success', 'Data Jenis Pendaftaran berhasil update!');
    			redirect('JenisPendaftaran/listJenisPendaftaran');
    		}
    
    	$this->session->set_flashdata('warning', 'Data Jenis Pendaftaran gagal update!');
    	redirect('JenisPendaftaran/listJenisPendaftaran');
		
	}

	public function delete_jenispendaftaran($id){
		$data = array('is_active' => '0' );
		$delete = $this->MainModel->delete($table='jenis_pendaftaran',$data,$id);
		if($delete){
			$this->session->set_flashdata('success', 'Data Jenis Pendaftaran berhasil dihapus!');
    		redirect('JenisPendaftaran/listJenisPendaftaran');
		}
		$this->session->set_flashdata('warning', 'Data Jenis Pendaftaran gagal dihapus!');
    	redirect('JenisPendaftaran/listJenisPendaftaran');

	}
	



	
}

