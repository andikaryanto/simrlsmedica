<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KabagKeuangan extends MY_Controller
{
    public function __construct() {
        parent::__construct();

        $this->load->library('template');
        $this->load->Model('UserModel');
        $this->load->Model('MainModel');
        $this->load->Model('JenisPendaftaranModel');
    }

    public function index() {
        redirect('KabagKeuangan/list_kabag_keuangan');
    }

    public function list_kabag_keuangan() {
        $data['list_kabag_keuangan'] = $this->UserModel->list_kabag_keuangan();

        $this->template->view('master/hak_akses/kabag_keuangan/list_kabag_keuangan', $data);
    }

    public function add_kabag_keuangan() {
        $data['jenis_pendaftaran'] = $this->JenisPendaftaranModel->listJenisPendaftaran()->result();
        $this->template->view('master/hak_akses/kabag_keuangan/add_kabag_keuangan', $data);
    }

    public function edit($id) {
        $data['user'] = $this->UserModel->getUserById($id)->row();
        $data['grup'] = $this->UserModel->getGrup()->result();
        $data['jenis_pendaftaran'] = $this->JenisPendaftaranModel->listJenisPendaftaran()->result();

        $this->template->view('master/hak_akses/kabag_keuangan/edit_kabag_keuangan', $data);
    }

    public function simpan_update() {
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
            $this->session->set_flashdata('success', 'Data kabag keuangan berhasil update!');
            redirect('KabagKeuangan/list_kabag_keuangan');
        }

        $this->session->set_flashdata('warning', 'Data kabag keuangan gagal update!');
        redirect('KabagKeuangan/list_kabag_keuangan');
    }

    public function simpan_add_kabag_keuangan() {
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
            'grup_id' => '21', // 6 adalah id grup kabag_keuangan sesuai table grup
            'user_id' => $user_id,
            'creator' => $this->session->userdata('logged_in')->id
        );
        $b = $this->MainModel->insert($tabel = 'user_grup', $user_grup);

        if ($b) {
            $this->session->set_flashdata('success', 'Profil berhasil update!');
            redirect('KabagKeuangan');
        }

        $this->session->set_flashdata('warning', 'Profil gagal update!');
        redirect('KabagKeuangan');
    }

    public function delete_kabag_keuangan($id) {
        $data = array('is_active' => '0');
        $delete = $this->MainModel->delete($table = 'user', $data, $id);
        if ($delete) {
            $this->session->set_flashdata('success', 'Data kabag keuangan berhasil dihapus!');
            redirect('KabagKeuangan/list_kabag_keuangan');
        }
        $this->session->set_flashdata('warning', 'Data kabag keuangan gagal dihapus!');
        redirect('KabagKeuangan/list_kabag_keuangan');
    }
}
