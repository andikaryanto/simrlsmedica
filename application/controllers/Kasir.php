<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('template');
        $this->load->Model('KasirModel');
        $this->load->Model('UserModel');
        $this->load->Model('MainModel');
        $this->load->Model('JenisPendaftaranModel');
    }

    public function index() {
        redirect('Kasir/listKasir');
    }

    public function listKasir() {
        $data['listKasir'] = $this->KasirModel->listKasir();

        $this->template->view('master/kasir/list_kasir_v', $data);
    }

    public function addKasir() {
        $data['jenis_pendaftaran'] = $this->JenisPendaftaranModel->listJenisPendaftaran()->result();
        $this->template->view('master/kasir/addkasir_v', $data);
    }

    public function edit($id) {
        $data['user'] = $this->UserModel->getUserById($id)->row();
        $data['grup'] = $this->UserModel->getGrup()->result();
        $data['jenis_pendaftaran'] = $this->JenisPendaftaranModel->listJenisPendaftaran()->result();

        $this->template->view('master/kasir/editkasir_v', $data);
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
            $this->session->set_flashdata('success', 'Data Kasir berhasil update!');
            redirect('Kasir/listKasir');
        }

        $this->session->set_flashdata('warning', 'Data Kasir gagal update!');
        redirect('Kasir/listKasir');

    }

    public function simpan_addkasir() {
        $user = array(
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
            'password_ori' => $this->input->post('password'),
            'telepon' => $this->input->post('telepon'),
            'creator' => $this->session->userdata('logged_in')->id
        );
        $user_id = $this->MainModel->insert_id($tabel = 'user', $user);
        $user_grup = array(
            'grup_id' => '16', // 16 adalah id grup kasir sesuai table grup
            'user_id' => $user_id,
            'creator' => $this->session->userdata('logged_in')->id
        );
        $b = $this->MainModel->insert($tabel = 'user_grup', $user_grup);

        if ($b) {
            $this->session->set_flashdata('success', 'Profil berhasil update!');
            redirect('Kasir');
        }

        $this->session->set_flashdata('warning', 'Profil gagal update!');
        redirect('Kasir');
    }

    public function delete_kasir($id) {
        $data = array('is_active' => '0');
        $delete = $this->MainModel->delete($table = 'user', $data, $id);
        if ($delete) {
            $this->session->set_flashdata('success', 'Data Kasir berhasil dihapus!');
            redirect('Kasir/listKasir');
        }
        $this->session->set_flashdata('warning', 'Data Kasir gagal dihapus!');
        redirect('Kasir/listKasir');
    }
}