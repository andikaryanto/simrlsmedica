<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyakit extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();		
       
        $this->load->library('template');
        $this->load->Model('PenyakitModel');
        $this->load->Model('MainModel');
	}
	
	public function index(){
		redirect('Penyakit/listPenyakit');
	}

	public function listPenyakit()
	{
		$data['penyakit'] = $this->PenyakitModel->getListPenyakit();
		
		$this->template->view('master/penyakit/list_penyakit_v',$data);
	}

	public function tambah_Penyakit()
	{		
		if ($this->input->post('submit') == 1){	
			$session = $this->session->userdata('logged_in');			
			$Penyakit = array(
						'kode'               => $this->input->post('kode'), 
						 
						'nama'       => $this->input->post('nama'), 
					/*	'gender'         => $this->input->post('gender'),
						'age'             => $this->input->post('age'), */
									 
						'creator'            => $session->id
					); 
			
			$insert = $this->MainModel->insert($tabel='penyakit',$Penyakit);

			if($insert){
				$this->session->set_flashdata('success', 'Tambah Penyakit berhasil!');
				redirect('Penyakit/listPenyakit','refresh');
			}else{
				$this->session->set_flashdata('warning', 'Tambah Penyakit gagal!');
				redirect('Penyakit/tambah_Penyakit','refresh');
			}
			

		} else {
			
			$this->template->view('master/penyakit/tambah_penyakit_v');
		}
		
	}
	

	public function edit($id){
		$sesi = $this->session->userdata('logged_in');
		$data['penyakit'] = $this->PenyakitModel->getPenyakitById($id)->row();
		//print_r($data['Penyakit']);die();		
		$this->template->view('master/penyakit/penyakit_edit_v',$data);
	}

	public function simpanUpdate(){
		$sesi = $this->session->userdata('logged_in');
		//print_r($this->input->post());die();				
							
 		$id = $this->input->post('id');    	
    	
    			$Penyakit = array(
						'kode'               => $this->input->post('kode'), 						 
						'nama'       => $this->input->post('nama'), 				 
						
					
					); 
    		$a = $this->MainModel->update($tabel='penyakit', $Penyakit,$id);
    		

    		if ($a) {
    			$this->session->set_flashdata('success', 'Data Penyakit berhasil update!');
    			redirect('Penyakit/listPenyakit');
    		}
    
    	$this->session->set_flashdata('warning', 'Data Penyakit gagal update!');
    	redirect('Penyakit/listPenyakit');
		
	}

	public function delete_Penyakit($id){
		$data = array('is_active' => '0' );
		$delete = $this->MainModel->delete($table='penyakit',$data,$id);
		if($delete){
			$this->session->set_flashdata('success', 'Data Penyakit berhasil dihapus!');
    		redirect('Penyakit/listPenyakit');
		}
		$this->session->set_flashdata('warning', 'Data Penyakit gagal dihapus!');
    	redirect('Penyakit/listPenyakit');

	}



	
}

