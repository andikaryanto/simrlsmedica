<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();		
       
        $this->load->library('template');
        $this->load->Model('DokterModel');
        $this->load->Model('MainModel');
	}
	
	public function index(){
		redirect('Dokter/listDokter');
	}

	



	public function listDokter()
	{
		$data['listDokter'] = $this->DokterModel->listDokter();
		
		$this->template->view('master/dokter/list_dokter_v',$data);
	}
	public function pendaftaran_baru1()
	{	
		if ($this->input->post('submit'))
		{	
			$data_pemohon = array(
						'badan_hukum'             => $this->input->post('nama_usaha'), 
						'nama_usaha'              => $this->input->post('nama_usaha'), 
						'alamat'                  => $this->input->post('alamat'), 
						'tlp'                     => $this->input->post('telepon'), 
						'email'                   => $this->input->post('email'), 
						'nama_kontak_person	'     => $this->input->post('nama_kontak'),
						'tlp_kontak_person	'     => $this->input->post('telepon_kontak'), 
						'email_kontak_person	' => $this->input->post('email_kontak') 
					);

			//$id_pemohon = $this->SppModel->insertPemohon($data_pemohon);

			$data_spp = array(
						'id_klien'      => $id_pemohon, 
						'no_client'     => $this->input->post('no_client'), 
						'no_aplikasi'   => $this->input->post('no_aplikasi'), 
						'no_referensi'  => $this->input->post('no_referensi'), 
						'jatuh_tempo'   => $this->input->post('jatuh_tempo'), 
						'jenis_stasiun' => $this->input->post('jenis_stasiun'), 
						'tagihan_bhp'   => $this->input->post('tagihan_bhp'), 
						'scan_spp'      => $this->input->post('scan_spp'), 						
						'status	'       => "baru"
					);
			//print_r($data_spp);die();
			$insert_spp = $this->SppModel->insertSpp($data_spp);
		} else 
		{
			$this->template->view('spp/tambah_spp_baru_view');
		}
	
	}
	public function pendaftaran_lama()
	{	
		if ($this->input->post('submit'))
		{
			$data_spp = array(
						'id_klien' => $id_pemohon, 
						'no_client' => $this->input->post('no_client'), 
						'no_aplikasi' => $this->input->post('no_aplikasi'), 
						'no_referensi' => $this->input->post('no_referensi'), 
						'jatuh_tempo' => $this->input->post('jatuh_tempo'), 
						'jenis_stasiun' => $this->input->post('frekuensi_tx'), 
						'frekuensi_tx' => $this->input->post('jatuh_tempo'), 
						'frekuensi_rx' => $this->input->post('frekuensi_rx'), 
						'status	' => "baru"
					);
			$insert_spp = $this->SppModel->insertSpp($data_spp);

		} else 
		{
			$this->template->view('spp/tambah_spp_perpanjang_view');
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

