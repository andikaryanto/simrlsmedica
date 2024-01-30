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
				$this->session->set_flashdata('success', 'Pendaftaran pasien berhasil!');
				redirect('pendaftaran/listPendaftaranPasien','refresh');
			}else{
				$this->session->set_flashdata('warning', 'Pendaftaran pasien gagal!');
				redirect('pendaftaran/pendaftaran_lama','refresh');
			}
			

		} else {
			$data['jenis_pendaftaran'] = $this->PendaftaranModel->getJenisPendaftaran();
			$data['dokter'] =$this->PendaftaranModel->getDokter();
			$this->template->view('pendaftaran/pendaftaran_lama_v',$data);
		}
		
	}
	

	public function ajax_kode()
	{
		if($this->input->is_ajax_request())
		{
			$keyword 	= $this->input->post('keyword');

			

			$pasien = $this->PendaftaranModel->cari_kode($keyword);

			if($pasien->num_rows() > 0)
			{
				$json['status'] 	= 1;
				$json['datanya'] 	= "<ul id='daftar-autocomplete'>";
				foreach($pasien->result() as $b)
				{
					$json['datanya'] .= "
						<li>
							<b>Kode</b> : 
							<span id='kodenya'>".$b->id."</span> <br />
							<span id='no_rmnya'>".$b->no_rm."</span> <br />
							<span id='namanya'>".$b->nama."</span> <br />
							
						</li>
					";
					/*$json['datanya'] .= "
						<li>
							<b>Kode</b> : 
							<span id='kodenya'>".$b->id."</span> <br />
							<span id='barangnya'>".$b->nama_usaha."</span> <br />
							<span id='harganya'>".$b->badan_hukum."</span>
						</li>
					";*/
				}
				$json['datanya'] .= "</ul>";
			}
			else
			{
				$json['status'] = 0;
			}

			echo json_encode($json);
		}
	}



	
}

