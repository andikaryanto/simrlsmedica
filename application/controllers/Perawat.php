<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perawat extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();		
       
        $this->load->library('template');
        $this->load->Model('PerawatModel');
        $this->load->Model('UserModel');
        $this->load->Model('MainModel');
        $this->load->Model('JenisPendaftaranModel');
	}
	
	public function index(){
		redirect('Perawat/listPerawat');
	}

	public function listPerawat()
	{
		$data['listPerawat'] = $this->PerawatModel->listPerawat();
		
		$this->template->view('master/perawat/list_perawat_v',$data);
	}

    public function addPerawat() {
        $data['jenis_pendaftaran'] = $this->JenisPendaftaranModel->listJenisPendaftaran()->result();
        $this->template->view('master/perawat/addperawat_v', $data);
    }

	public function edit($id){
		$data['user'] = $this->UserModel->getUserById($id)->row();
		$data['grup'] = $this->UserModel->getGrup()->result();
        $data['jenis_pendaftaran'] = $this->JenisPendaftaranModel->listJenisPendaftaran()->result();
		
		$this->template->view('master/perawat/editperawat_v',$data);
	}

	public function simpanUpdate() {
        $sesi = $this->session->userdata('logged_in');

        $config1['upload_path'] = FCPATH . 'assets/img/profil';
        $config1['allowed_types'] = 'gif|jpg|png';
        $config1['overwrite'] = TRUE;
        $config1['max_size'] = 2048000;
        $this->load->library('upload', $config1);

        $id = $this->input->post('id');
        $user = array(
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
            'password_ori' => $this->input->post('password'),
            'telepon' => $this->input->post('telepon'),
            'creator' => $sesi->id
        );

        if ($this->upload->do_upload('foto')) {
            $user['foto'] = $this->upload->data('file_name');
        }

        if ($this->MainModel->update($tabel = 'user', $user, $id)) {
            $this->session->set_flashdata('success', 'Data Perawat berhasil update!');
            redirect('Perawat/listPerawat');
        }

        $this->session->set_flashdata('warning', 'Data Perawat gagal update!');
        redirect('Perawat/listPerawat');

    }

    public function simpan_addperawat() {
        $user = array(
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
            'password_ori' => $this->input->post('password'),
            'telepon' => $this->input->post('telepon'),
            'id_jenis_pendaftaran' => $this->input->post('id_jenis_pendaftaran') ?? 0,
            'creator' => $this->session->userdata('logged_in')->id
        );
        $user_id = $this->MainModel->insert_id($tabel = 'user', $user);
        $user_grup = array(
            'grup_id' => '7', // 7 adalah id grup perawat sesuai table grup
            'user_id' => $user_id,
            'creator' => $this->session->userdata('logged_in')->id
        );
        $b = $this->MainModel->insert($tabel = 'user_grup', $user_grup);

        if ($b) {
            $this->session->set_flashdata('success', 'Profil berhasil update!');
            redirect('Perawat');
        }

        $this->session->set_flashdata('warning', 'Profil gagal update!');
        redirect('Perawat');
    }

	public function delete_perawat($id){
		$data = array('is_active' => '0' );
		$delete = $this->MainModel->delete($table='user',$data,$id);
		if($delete){
			$this->session->set_flashdata('success', 'Data Perawat berhasil dihapus!');
    		redirect('Perawat/listPerawat');
		}
		$this->session->set_flashdata('warning', 'Data Perawat gagal dihapus!');
    	redirect('Perawat/listPerawat');

	}
}

