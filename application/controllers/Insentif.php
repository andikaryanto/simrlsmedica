<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insentif extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

        $this->load->library('template');
        $this->load->Model('ObatModel');
        $this->load->Model('InsentifModel');
        $this->load->Model('MainModel');
	}

	public function index(){
		redirect('Insentif/listInsentifDokter');
	}

	public function listInsentifDokter()
	{
        $dari = $this->input->get('from');
        $sampai = $this->input->get('to');

        if (!$dari) $dari = date('Y-m-01');
        if (!$sampai) $sampai = date('Y-m-d');

        $data['listInsentif'] = $this->InsentifModel->listInsentifDokter($dari, $sampai);

        $data['from'] = $dari;
        $data['to'] = $sampai;

        $this->template->view('insentif_dokter/list_insentif_dokter_v',$data);
	}

	public function listShiftDokter()
	{
		$data['listshift'] = $this->InsentifModel->shiftDokter();

		//print_r($data['listshift']->result());die();
		$this->template->view('insentif_dokter/list_insentif_dokter_v',$data);
	}

	public function listShiftPerawat()
	{
		$data['listshift'] = $this->InsentifModel->shiftPerawat();
		//print_r($data['listshift']->result());die();

		$this->template->view('insentif_dokter/list_insentif_dokter_v',$data);
	}


    public function DetailInsentifDokter($id='')
    {
        $dari = $this->input->get('from');
        $sampai = $this->input->get('to');

        if (!$dari) $dari = date('Y-m-01');
        if (!$sampai) $sampai = date('Y-m-d');

        $data['listInsentif'] = $this->InsentifModel->DetailInsentifDokter($id, $dari, $sampai);

        $this->template->view('insentif_dokter/detail_insentif_dokter_v',$data);
    }

	public function listInsentifPerawat()
	{
		$data['listInsentif'] = $this->InsentifModel->listInsentifPerawat();
		$data['listshift'] = $this->InsentifModel->shiftPerawat();

		$this->template->view('insentif_perawat/list_insentif_perawat_v',$data);
	}

	public function listInsentifApoteker()
	{
		$data['listInsentif'] = $this->InsentifModel->listInsentifApoteker();
		$data['insentif_resep'] = $this->InsentifModel->getInsentifResep();
		$data['listshift'] = $this->InsentifModel->shiftApoteker();

		$this->template->view('insentif_apoteker/list_insentif_apoteker_v',$data);
	}

	public function DetailInsentifPerawat($id='')
	{
		$data['listInsentif'] = $this->InsentifModel->DetailInsentifPerawat($id);

		$this->template->view('insentif_perawat/detail_insentif_perawat_v',$data);
	}

	public function DetailInsentifApoteker($id='')
	{
		$data['listInsentif'] = $this->InsentifModel->DetailInsentifApoteker($id);
		$data['insentif_resep'] = $this->InsentifModel->getInsentifResep();

		$this->template->view('insentif_perawat/detail_insentif_apoteker_v',$data);
	}

	public function listInsentifShift(){

		$data['list_shift'] = $this->InsentifModel->listShift();
		//print_r($data['list_shift']->result());die();
		$this->template->view('master/shift/list_shift_v',$data);
	}

	public function editInsentifShift($id){

		$data['list_shift'] = $this->InsentifModel->listShiftById($id)->row();
		//print_r($data['list_shift']);die();
		$this->template->view('master/shift/shift_edit_v',$data);
	}

	public function simpanUpdateShift(){
		$sesi = $this->session->userdata('logged_in');
		//print_r($this->input->post());die();

 		$id = $this->input->post('id');

    			$obat = array(
						'shift'             => $this->input->post('shift'),
						'insentif'           => $this->input->post('insentif'),

						'creator'             => $sesi->id
					);
    		$a = $this->MainModel->update($tabel='insentif_shift', $obat,$id);

    		if ($a) {
    			$this->session->set_flashdata('success', 'Data shift berhasil update!');
    			redirect('Insentif/listInsentifShift');
    		}else{
    			$this->session->set_flashdata('warning', 'Data shift gagal update!');
    			redirect('Insentif/listInsentifShift');
    		}


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




}
