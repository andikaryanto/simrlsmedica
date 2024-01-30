<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TarifTindakan extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();		
       
        $this->load->library('template');
        $this->load->Model('TarifTindakanModel');
        $this->load->Model('MainModel');
	}
	
	public function index(){
		redirect('TarifTindakan/listTarifTindakan');
	}

	public function listTarifTindakan()
	{
		$data['tarif_tindakan'] = $this->TarifTindakanModel->getListTindakan();
		
		$this->template->view('master/tarif_tindakan/list_tarif_tindakan_v',$data);
	}

	public function tambah_TarifTindakan()
	{		
		if ($this->input->post('submit') == 1){	
			$session = $this->session->userdata('logged_in');			
			$TarifTindakan = array(
						'nama'               => $this->input->post('nama_tindakan'), 
						'tarif_perawat'      => $this->input->post('tarif_perawat'), 
						'tarif_dokter'       => $this->input->post('tarif_dokter'), 
						'tarif_lain'         => $this->input->post('tarif_lain'),
						'klinik'             => $this->input->post('klinik'), 
						'tarif_pasien'       => $this->input->post('tarif_pasien'),						 
						'creator'            => $session->id
					); 
			
			$insert = $this->MainModel->insert($tabel='tarif_tindakan',$TarifTindakan);

			if($insert){
				$this->session->set_flashdata('success', 'Tambah Tarif Tindakan berhasil!');
				redirect('TarifTindakan/listTarifTindakan','refresh');
			}else{
				$this->session->set_flashdata('warning', 'Tambah Tarif Tindakan gagal!');
				redirect('TarifTindakan/tambah_TarifTindakan','refresh');
			}
			

		} else {
			
			$this->template->view('master/tarif_tindakan/tambah_tariftindakan_v');
		}
		
	}
	

	public function edit($id){
		$sesi = $this->session->userdata('logged_in');
		$data['tarif_tindakan'] = $this->TarifTindakanModel->getTarifTindakanById($id)->row();
		//print_r($data['TarifTindakan']);die();		
		$this->template->view('master/tarif_tindakan/tariftindakan_edit_v',$data);
	}

	public function simpanUpdate(){
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
    			redirect('TarifTindakan/listTarifTindakan');
    		}
    
    	$this->session->set_flashdata('warning', 'Data Tarif Tindakan gagal update!');
    	redirect('TarifTindakan/listTarifTindakan');
		
	}

	public function delete_TarifTindakan($id){
		$data = array('is_active' => '0' );
		$delete = $this->MainModel->delete($table='tarif_tindakan',$data,$id);
		if($delete){
			$this->session->set_flashdata('success', 'Data Tarif Tindakan berhasil dihapus!');
    		redirect('TarifTindakan/listTarifTindakan');
		}
		$this->session->set_flashdata('warning', 'Data Tarif Tindakan gagal dihapus!');
    	redirect('TarifTindakan/listTarifTindakan');

	}



	
}

