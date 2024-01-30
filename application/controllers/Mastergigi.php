<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mastergigi extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();		
       
        $this->load->library('template');
        $this->load->Model('PenyakitModel');
        $this->load->Model('TarifTindakanModel');
        $this->load->Model('MainModel');
	}

	public function listPenyakit()
	{
		$data['penyakit'] = $this->PenyakitModel->getListPenyakitGigi();
		$this->template->view('master_gigi/penyakit/list_penyakit_v',$data);
	}

	public function tambah_Penyakit()
	{		
		if ($this->input->post('submit') == 1){	
			$session = $this->session->userdata('logged_in');			
			$Penyakit = array(
						'kode'               => $this->input->post('kode'), 
						'nama'       => $this->input->post('nama'),
						'is_poligigi' 	=> '1', 
						'creator'            => $session->id
					); 
			
			$insert = $this->MainModel->insert($tabel='penyakit',$Penyakit);

			if($insert){
				$this->session->set_flashdata('success', 'Tambah Penyakit  gigi berhasil!');
				redirect('Mastergigi/listPenyakit','refresh');
			}else{
				$this->session->set_flashdata('warning', 'Tambah Penyakit gigi gagal!');
				redirect('Mastergigi/tambah_Penyakit','refresh');
			}
			

		} else {
			
			$this->template->view('master_gigi/penyakit/tambah_penyakit_v');
		}
		
	}
	

	public function edit($id){
		$sesi = $this->session->userdata('logged_in');
		$data['penyakit'] = $this->PenyakitModel->getPenyakitGigiById($id)->row();
		//print_r($data['Penyakit']);die();		
		$this->template->view('master_gigi/penyakit/penyakit_edit_v',$data);
	}

	public function simpanUpdate(){
		$sesi = $this->session->userdata('logged_in');
		//print_r($this->input->post());die();				
							
 		$id = $this->input->post('id');    	
    	
    			$Penyakit = array(
						'kode'       => $this->input->post('kode'), 						 
						'nama'       => $this->input->post('nama'), 				 
						
					); 
    		$a = $this->MainModel->update($tabel='penyakit', $Penyakit,$id);
    		

    		if ($a) {
    			$this->session->set_flashdata('success', 'Data Penyakit gigi berhasil update!');
    			redirect('mastergigi/listPenyakit');
    		}
    
    	$this->session->set_flashdata('warning', 'Data Penyakit gigi gagal update!');
    	redirect('mastergigi/listPenyakit');
		
	}

	public function delete_Penyakit($id){
		$data = array('is_active' => '0' );
		$delete = $this->MainModel->delete($table='penyakit',$data,$id);
		if($delete){
			$this->session->set_flashdata('success', 'Data Penyakit gigi berhasil dihapus!');
    		redirect('Mastergigi/listPenyakit');
		}
		$this->session->set_flashdata('warning', 'Data Penyakit gigi gagal dihapus!');
    	redirect('Mastergigi/listPenyakit');

	}


	// Tarif Tindakan
	public function listTarifTindakan(){
		$data['tarif_tindakan'] = $this->TarifTindakanModel->getListTindakanGigi();
		
		$this->template->view('master_gigi/tarif_tindakan/list_tarif_tindakan_v',$data);
	}

	public function tambah_TarifTindakan(){		
		if ($this->input->post('submit') == 1){	
			$session = $this->session->userdata('logged_in');			
			$TarifTindakan = array(
				'nama'               => $this->input->post('nama_tindakan'), 
				'tarif_perawat'      => $this->input->post('tarif_perawat'), 
				'tarif_dokter'       => $this->input->post('tarif_dokter'), 
                'tarif_apoteker'       => $this->input->post('tarif_apoteker'),
				'tarif_lain'         => $this->input->post('tarif_lain'),
				'is_poligigi'		 => '1',
				'klinik'             => $this->input->post('klinik'), 
				'tarif_pasien'       => $this->input->post('tarif_pasien'),						 
				'creator'            => $session->id
			); 
			
			$insert = $this->MainModel->insert($tabel='tarif_tindakan',$TarifTindakan);

			if($insert){
				$this->session->set_flashdata('success', 'Tambah Tarif Tindakan berhasil!');
				redirect('mastergigi/listTarifTindakan','refresh');
			}else{
				$this->session->set_flashdata('warning', 'Tambah Tarif Tindakan gagal!');
				redirect('mastergigi/tambah_TarifTindakan','refresh');
			}
			

		} else {
			
			$this->template->view('master_gigi/tarif_tindakan/tambah_tariftindakan_v');
		}
		
	}
	

	public function edit_tindakan($id){
		$sesi = $this->session->userdata('logged_in');
		$data['tarif_tindakan'] = $this->TarifTindakanModel->getTarifTindakanGigiById($id)->row();
		//print_r($data['TarifTindakan']);die();		
		$this->template->view('master_gigi/tarif_tindakan/tariftindakan_edit_v',$data);
	}

	public function simpanUpdateTindakan(){
		$sesi = $this->session->userdata('logged_in');
		//print_r($this->input->post());die();				

		$id = $this->input->post('id');    	

		$TarifTindakan = array(
			'nama'               => $this->input->post('nama_tindakan'), 
			'tarif_perawat'      => $this->input->post('tarif_perawat'), 
			'tarif_dokter'       => $this->input->post('tarif_dokter'), 
            'tarif_apoteker'       => $this->input->post('tarif_apoteker'),
			'tarif_lain'         => $this->input->post('tarif_lain'),
			'klinik'             => $this->input->post('klinik'), 
			'tarif_pasien'       => $this->input->post('tarif_pasien'),						 


		); 
		$a = $this->MainModel->update($tabel='tarif_tindakan', $TarifTindakan,$id);


		if ($a) {
			$this->session->set_flashdata('success', 'Data Tarif Tindakan berhasil update!');
			redirect('mastergigi/listTarifTindakan');
		}

		$this->session->set_flashdata('warning', 'Data Tarif Tindakan gagal update!');
		redirect('mastergigi/listTarifTindakan');
		
	}

	public function delete_TarifTindakan($id){
		$data = array('is_active' => '0' );
		$delete = $this->MainModel->delete($table='tarif_tindakan',$data,$id);
		if($delete){
			$this->session->set_flashdata('success', 'Data Tarif Tindakan berhasil dihapus!');
			redirect('mastergigi/listTarifTindakan');
		}
		$this->session->set_flashdata('warning', 'Data Tarif Tindakan gagal dihapus!');
		redirect('mastergigi/listTarifTindakan');

	}

}

