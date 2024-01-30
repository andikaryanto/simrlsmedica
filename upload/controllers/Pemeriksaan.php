<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemeriksaan extends MY_Controller {

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
		
		if ($this->input->post('submit'))
		{	
			
			$insert = $this->MainModel->insert($pasien);
		} else 
		{
			$this->template->view('pemeriksaan/pemeriksaan_v');
		}
		
	}
	public function listpemeriksaanPasien()
	{
		$data['listPendaftaran'] = $this->PendaftaranModel->getListPendaftaran();
		
		$this->template->view('pemeriksaan/list_blom_diperiksa_v',$data);
	}

	public function listPasienSelesaiPeriksa()
	{
		$data['listPemeriksaan'] = $this->PemeriksaanModel->getListPemeriksaan();
		
		$this->template->view('pemeriksaan/list_pasien_diperiksa_v',$data);
	}

	public function periksa($id="")
	{
		$session = $this->session->userdata('logged_in');
		if ($this->input->post('submit') == 1)
		{	
			/*print_r($this->input->post('nama_obat'));die();*/
			$periksa = array(
						'pendaftaran_id'           => $this->input->post('pendaftaran_id'), 
						'dokter_id'                => $this->input->post('dokter_id'), 
						'pasien_id'                => $id, 
						'no_rm'                    => $this->input->post('no_rm'), 
						'td'                       => $this->input->post('td'), 
						'r'                        => $this->input->post('r'), 
						'bb'                       => $this->input->post('bb'), 
						'n'                        => $this->input->post('n'), 
						's'                        => $this->input->post('s'), 
						'tb'                       => $this->input->post('tb'), 
						'bmi'                      => $this->input->post('bmi'), 
						'keluhan_utama'            => $this->input->post('keluhan_utama'), 
						'amammesia'                => $this->input->post('amammesia'), 
						'diagnosis'                => $this->input->post('diagnosis'), 
						'pemeriksaan_fisik'        => $this->input->post('pemeriksaan_fisik'), 
						'diagnosis_jenis_penyakit' => $this->input->post('diagnosis_jenis_penyakit'), 
						'diagnosis_banding'        => $this->input->post('diagnosis_banding'), 						
						'deskripsi_tindakan'       => $this->input->post('deskripsi_tindakan'), 
						'saran_pemeriksaan'        => $this->input->post('saran_pemeriksaan'), 
						'asuhan_keperawatan'       => $this->input->post('asuhan_keperawatan'), 
						'status'                   => 'selesai', 
						'creator'                  => $session->id
					);
			
			$pemeriksaan_id = $this->MainModel->insert_id('pemeriksaan',$periksa);
			
			if ($pemeriksaan_id) {
				$input_tindakan = $this->input->post('tindakan');
				foreach ($input_tindakan as $key => $value) {
					$tindakan = array(
								'pemeriksaan_id' => $pemeriksaan_id, 
								'tarif_tindakan_id' =>  $value,
								'creator	'     => $session->id
							);
					
					$this->MainModel->insert_id('detail_tindakan_pemeriksaan',$tindakan);
				}


				$jumlah_satuan = $this->input->post('jumlah_satuan');
				$input_obat = $this->input->post('nama_obat');
				$i =0;
				foreach ($input_obat as $key => $value) {
					$obat = array(
								'pemeriksaan_id' => $pemeriksaan_id, 
								'obat_id'        => $value, 
								'jumlah_satuan'  => $jumlah_satuan[$i], 
								'creator	'     => $session->id

							);
					
					if ($obat['obat_id'] != "") {
						$this->MainModel->insert_id('detail_obat_pemeriksaan',$obat);
					}		
					
				$i++;
				}
				$this->session->set_flashdata('success', 'Pemeriksaan pasien berhasil!');
				redirect('pemeriksaan/listPasienSelesaiPeriksa');
			}else{
				$this->session->set_flashdata('warning', 'Pemeriksaan pasien gagal, ulangi lagi!');
				redirect('pemeriksaan/listpemeriksaanPasien');
			}			
			
		} else 
		{	
			$data['obat']  = $this->PemeriksaanModel->getObat();
			$data['tindakan']  = $this->PemeriksaanModel->getTindakan();
			$data['pendaftaran']  = $this->PemeriksaanModel->getPendaftaranById($id)->row_array();
			//print_r($data['pendaftaran'] );die();
			$this->template->view('pemeriksaan/pemeriksaan_v',$data);
		}
		
	}

	
	
	


	
}

