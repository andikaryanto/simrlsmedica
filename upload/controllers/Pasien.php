<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();		
       
        $this->load->library('template');
        $this->load->Model('PasienModel');
        $this->load->Model('MainModel');
	}
	
	public function index(){
		redirect('Pasien/listPasien');
	}

	public function pendaftaran_baru()
	{		
		if ($this->input->post('submit') == 1){	
			$session = $this->session->userdata('logged_in');

			$cek_id  = $this->PendaftaranModel->cek_id()->row_array(); //array dibuka
			$max_id  = $cek_id['no_rm'];
			$max_id1 = (int) substr($max_id,3,5); // dijadikan int
			$max_id2 = $max_id1 + 1; //ditambah 1

			if($max_id2<10){
				$no_rm = "00000".$max_id2;
			}else if($max_id2<100){
				$no_rm = "0000".$max_id2;
			}else if($max_id2<1000){
				$no_rm = "000".$max_id2;
			}else if($max_id2<10000){
				$no_rm = "00".$max_id2;
			}else{
				$no_rm = "0".$max_id2;
			}
						//print_r($session->id);die();

			$tanggal = $this->input->post('tanggal_lahir');

			// tanggal hari ini
			$today = new DateTime('today');

			// tahun
			$y = $today->diff($tanggal)->y;

			// bulan
			$m = $today->diff($tanggal)->m;

			// hari
			$d = $today->diff($tanggal)->d;
			
			$pasien = array(
							'no_rm'         => $no_rm, 
							'nama'          => $this->input->post('nama'), 
							'tanggal_lahir' => $this->input->post('tanggal_lahir'), 
							'usia'          => $y . " tahun " . $m . " bulan " . $d . " hari" , 
							'tempat_lahir'  => $this->input->post('tempat_lahir'), 
							'jk'            => $this->input->post('jenis_kelamin'), 
							'alamat'        => $this->input->post('alamat'), 
							'telepon'       => $this->input->post('telepon'), 
							'pekerjaan'     => $this->input->post('pekerjaan'), 							
							'creator'       => $session->id				
					);		
			
			//print_r($insert);die();
			$insert_id = $this->MainModel->insert_id($tabel='pasien',$pasien);

			// tanggal lahir

			
			


			$rm = array(
						'no_rm'                => $no_rm, 
						'pasien'               => $insert_id, 
						'penanggungjawab'      => $this->input->post('penanggungjawab'), 
						'biopsikososial'       => $this->input->post('biopsikososial'),
						'jenis_pendaftaran_id' => $this->input->post('jenis_pendaftaran'), 
						'asuhan_keperawatan'   => $this->input->post('asuhan'), 
						'dokter'               => $this->input->post('dokter'), 
						'creator'              => $session->id
					); 
			
			$insert2 = $this->MainModel->insert($tabel='pendaftaran_pasien',$rm);

			if($insert2){
				$this->session->set_flashdata('success', 'Pendaftaran pasien berhasil!');
				redirect('pendaftaran/pendaftaran_baru','refresh');
			}
			

		} else {
			$data['jenis_pendaftaran'] = $this->PendaftaranModel->getJenisPendaftaran();
			$data['dokter'] =$this->PendaftaranModel->getDokter();
			$this->template->view('pendaftaran/pendaftaran_v',$data);
		}
		
	}



	public function listPasien()
	{
		$data['listPendaftaran'] = $this->PasienModel->getListPasien();
		
		$this->template->view('master/pasien/list_pasien_v',$data);
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

