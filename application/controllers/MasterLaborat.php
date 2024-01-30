<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masterlaborat extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();		
       
        $this->load->library('template');
        $this->load->Model('PenyakitModel');
        $this->load->Model('TarifTindakanModel');
        $this->load->Model('MainModel');
	}

	public function listLayanan()
	{
		$data['layanan'] = $this->PenyakitModel->getListLayananLaborat();
		
		$this->template->view('master_laborat/layanan/list_layanan_v',$data);
	}

	public function tambah_layanan()
	{		
		if ($this->input->post('submit') == 1){	
			$session = $this->session->userdata('logged_in');			
			$layanan = array(
						'kode'               => $this->input->post('kode'), 
						'nama'       => $this->input->post('nama'),
						'is_laborat' 	=> '1', 
						'creator'            => $session->id
					); 
			
			$insert = $this->MainModel->insert($tabel='penyakit',$layanan);

			if($insert){
				$this->session->set_flashdata('success', 'Tambah layanan laborat berhasil!');
				redirect('masterlaborat/listLayanan','refresh');
			}else{
				$this->session->set_flashdata('warning', 'Tambah layanan laborat gagal!');
				redirect('masterlaborat/tambah_layanan','refresh');
			}
			

		} else {
			
			$this->template->view('master_laborat/layanan/tambah_layanan_v');
		}
		
	}
	

	public function edit($id){
		$sesi = $this->session->userdata('logged_in');
		$data['layanan'] = $this->PenyakitModel->getLayananLaboratById($id)->row();
		//print_r($data['Penyakit']);die();		
		$this->template->view('master_laborat/layanan/layanan_edit_v',$data);
	}

	public function simpanUpdate(){
		$sesi = $this->session->userdata('logged_in');
		//print_r($this->input->post());die();				
							
 		$id = $this->input->post('id');    	
    	
    			$layanan = array(
						'kode'       => $this->input->post('kode'), 						 
						'nama'       => $this->input->post('nama'), 				 
						
					); 
    		$a = $this->MainModel->update($tabel='penyakit', $layanan,$id);
    		

    		if ($a) {
    			$this->session->set_flashdata('success', 'Data layanan laborat berhasil update!');
    			redirect('masterlaborat/listLayanan');
    		}
    
    	$this->session->set_flashdata('warning', 'Data layanan laborat gagal update!');
    	redirect('masterlaborat/listLayanan');
		
	}

	public function delete_layanan($id){
		$data = array('is_active' => '0' );
		$delete = $this->MainModel->delete($table='penyakit',$data,$id);
		if($delete){
			$this->session->set_flashdata('success', 'Data layanan laborat berhasil dihapus!');
    		redirect('masterlaborat/listLayanan');
		}
		$this->session->set_flashdata('warning', 'Data layanan laborat gagal dihapus!');
    	redirect('masterlaborat/listLayanan');

	}


	// Tarif Tindakan
	public function listTarifTindakan(){
		$data['tarif_tindakan'] = $this->TarifTindakanModel->getListTindakanLaborat();
		
		$this->template->view('master_laborat/tarif_tindakan/list_tarif_tindakan_v',$data);
	}

	public function tambah_TarifTindakan(){		
		if ($this->input->post('submit') == 1){	
			$session = $this->session->userdata('logged_in');			
			$TarifTindakan = array(
				'nama'               => $this->input->post('nama_tindakan'), 
				'tarif_perawat'      => $this->input->post('tarif_perawat'), 
				'tarif_dokter'       => $this->input->post('tarif_dokter'), 
				'tarif_lain'         => $this->input->post('tarif_lain'),
				'is_laborat'		 => '1',
				'klinik'             => $this->input->post('klinik'), 
				'tarif_pasien'       => $this->input->post('tarif_pasien'),						 
				'creator'            => $session->id
			); 
			
			$insert = $this->MainModel->insert($tabel='tarif_tindakan',$TarifTindakan);

			if($insert){
				$this->session->set_flashdata('success', 'Tambah Tarif Tindakan berhasil!');
				redirect('masterlaborat/listTarifTindakan','refresh');
			}else{
				$this->session->set_flashdata('warning', 'Tambah Tarif Tindakan gagal!');
				redirect('masterlaborat/tambah_TarifTindakan','refresh');
			}
			

		} else {
			
			$this->template->view('master_laborat/tarif_tindakan/tambah_tariftindakan_v');
		}
		
	}
	

	public function edit_tindakan($id){
		$sesi = $this->session->userdata('logged_in');
		$data['tarif_tindakan'] = $this->TarifTindakanModel->getTarifTindakanLaboratById($id)->row();
		//print_r($data['TarifTindakan']);die();		
		$this->template->view('master_laborat/tarif_tindakan/tariftindakan_edit_v',$data);
	}

	public function simpanUpdateTindakan(){
		$sesi = $this->session->userdata('logged_in');
		//print_r($this->input->post());die();				

		$id = $this->input->post('id');    	

		$TarifTindakan = array(
			'nama'               => $this->input->post('nama_tindakan'), 
			'tarif_perawat'      => $this->input->post('tarif_perawat'), 
			'tarif_dokter'       => $this->input->post('tarif_dokter'), 
			'tarif_lain'         => $this->input->post('tarif_lain'),
			'klinik'             => $this->input->post('klinik'), 
			'tarif_pasien'       => $this->input->post('tarif_pasien'),						 


		); 
		$a = $this->MainModel->update($tabel='tarif_tindakan', $TarifTindakan,$id);


		if ($a) {
			$this->session->set_flashdata('success', 'Data Tarif Tindakan berhasil update!');
			redirect('masterlaborat/listTarifTindakan');
		}

		$this->session->set_flashdata('warning', 'Data Tarif Tindakan gagal update!');
		redirect('masterlaborat/listTarifTindakan');
		
	}

	public function delete_TarifTindakan($id){
		$data = array('is_active' => '0' );
		$delete = $this->MainModel->delete($table='tarif_tindakan',$data,$id);
		if($delete){
			$this->session->set_flashdata('success', 'Data Tarif Tindakan berhasil dihapus!');
			redirect('masterlaborat/listTarifTindakan');
		}
		$this->session->set_flashdata('warning', 'Data Tarif Tindakan gagal dihapus!');
		redirect('masterlaborat/listTarifTindakan');

	}

}

