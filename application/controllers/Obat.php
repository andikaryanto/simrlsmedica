<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();		
       
        $this->load->library('template');
        $this->load->Model('ObatModel');
        $this->load->Model('MainModel');
	}
	
	public function index(){
		redirect('Obat/listObat');
	}

	public function listObat()
	{
		$data['listObat'] = $this->ObatModel->listObat();
		
		$this->template->view('master/obat/list_obat_v',$data);
	}

	public function tambah_obat()
	{		
		if ($this->input->post('submit') == 1){	
			$session = $this->session->userdata('logged_in');			
			$obat = array(
						'no_urut'             => $this->input->post('no_urut'), 
						'kode_obat'           => $this->input->post('kode_obat'), 
						'nama'                => $this->input->post('nama'), 
						'jenis'               => $this->input->post('jenis'),
						'kategori'            => $this->input->post('kategori'), 
						'nomor_batch'         => $this->input->post('nomor_batch'), 
						'tanggal_kadaluwarsa' => $this->input->post('tanggal_kadaluwarsa'), 
						'distributor'         => $this->input->post('distributor'), 
						'harga_jual'          => $this->input->post('harga_jual'), 
						'harga_beli'          => $this->input->post('harga_beli'), 
						'stok_obat'           => $this->input->post('stok_obat'), 
						'creator'             => $session->id
					); 
			
			$insert = $this->MainModel->insert($tabel='obat',$obat);

			if($insert){
				$this->session->set_flashdata('success', 'Tambah obat berhasil!');
				redirect('Obat/listObat','refresh');
			}else{
				$this->session->set_flashdata('warning', 'Tambah obat gagal!');
				redirect('Obat/tambah_obat','refresh');
			}
			

		} else {
			$data['persen'] = $this->ObatModel->getSettingpersen()->row();
			$this->template->view('master/obat/tambah_obat_v',$data);
		}
		
	}
	

	public function edit($id){
		$sesi = $this->session->userdata('logged_in');
		$data['persen'] = $this->ObatModel->getSettingpersen()->row();
		$data['obat'] = $this->ObatModel->getObatById($id)->row();
		//print_r($data['obat']);die();		
		$this->template->view('master/obat/obat_edit_v',$data);
	}

	public function simpanUpdate(){
		$sesi = $this->session->userdata('logged_in');
		//print_r($this->input->post());die();				
							
 		$id = $this->input->post('id');    	
    	
    			$obat = array(
						'no_urut'             => $this->input->post('no_urut'), 
						'kode_obat'           => $this->input->post('kode_obat'), 
						'nama'                => $this->input->post('nama'), 
						'jenis'               => $this->input->post('jenis'),
						'kategori'            => $this->input->post('kategori'), 
						'nomor_batch'         => $this->input->post('nomor_batch'), 
						'tanggal_kadaluwarsa' => $this->input->post('tanggal_kadaluwarsa'), 
						'distributor'         => $this->input->post('distributor'), 
						'harga_jual'          => $this->input->post('harga_jual'), 
						'harga_beli'          => $this->input->post('harga_beli'), 
						'stok_obat'           => $this->input->post('stok_obat'), 
						'creator'             => $sesi->id
					); 
    		$a = $this->MainModel->update($tabel='obat', $obat,$id);
    		

    		if ($a) {
    			$this->session->set_flashdata('success', 'Data Obat berhasil update!');
    			redirect('Obat/listObat');
    		}
    
    	$this->session->set_flashdata('warning', 'Data Obat gagal update!');
    	redirect('Obat/listObat');
		
	}

	public function delete_obat($id){
		$data = array('is_active' => '0' );
		$delete = $this->MainModel->delete($table='obat',$data,$id);
		if($delete){
			$this->session->set_flashdata('success', 'Data Obat berhasil dihapus!');
    		redirect('Obat/listObat');
		}
		$this->session->set_flashdata('warning', 'Data Obat gagal dihapus!');
    	redirect('Obat/listObat');

	}

	/*public function setting_persen(){
		$data['obat'] = $this->ObatModel->getSettingpersen()->row();
		$this->template->view('master/obat/obat_edit_v',$data);
		if($delete){
			$this->session->set_flashdata('success', 'Data Obat berhasil dihapus!');
    		redirect('Obat/listObat');
		}
		$this->session->set_flashdata('warning', 'Data Obat gagal dihapus!');
    	redirect('Obat/listObat');

	}*/
	public function setting_persen()
	{		
		if ($this->input->post('submit') == 1){	
			$id =$this->input->post('id');
			$session = $this->session->userdata('logged_in');			
			$persen = array(
						'prosentase'             => $this->input->post('prosentase')
						
					); 
			
			$update = $this->MainModel->update($tabel='prosentase_harga',$persen,$id);
			
			if($update){
				$this->session->set_flashdata('success', 'Edit persen harga obat berhasil!');
				redirect('Obat/listObat','refresh');
			}else{
				$this->session->set_flashdata('warning', 'Edit persen harga obat gagal!');
				redirect('Obat/listObat','refresh');
			}
			

		} else {
			
		$data['persen'] = $this->ObatModel->getSettingpersen()->row();
		$this->template->view('master/obat/persen_obat_v',$data);
		}
		
	}
	
	public function getStokObat(){
		$id = $this->input->get('id');
		
		$data = $this->ObatModel->getObatById($id)->row();
		$stok = $data->stok_obat;
		echo $stok;

		
		
	}



	
}

