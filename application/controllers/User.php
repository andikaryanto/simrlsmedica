<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('template');
        $this->load->Model('UserModel');
        $this->load->Model('MainModel');
        $this->load->Model('LoginModel');
    }

    public function index() {
        $sesi = $this->session->userdata('logged_in');
        $data['sesi'] = $this->session->userdata('logged_in');
        $data['user'] = $this->UserModel->listAllUser();
        //print_r($data['spp']->result());die();
        $this->template->view('user/list_user_v', $data);
    }

    public function detailuser($id) {
        $sesi = $this->session->userdata('logged_in');
        $data['user'] = $this->UserModel->getUserById($id)->row();
        $data['grup'] = $this->UserModel->getGrup()->result();
        $this->template->view('user/detailuser_v', $data);
    }

    public function detailklinik() {
        $sesi = $this->session->userdata('logged_in');
        $data['klinik'] = $this->UserModel->getKlinik()->row();

        //print_r($data['user']);die();
        $this->template->view('user/detailklinik_v', $data);
    }

    public function adduser() {
        $sesi = $this->session->userdata('logged_in');
        $data['grup'] = $this->UserModel->getGrup()->result();
        //print_r($data['user']);die();
        $this->template->view('user/adduser_v', $data);
    }

    public function simpanUpdateKlinik() {
        $sesi = $this->session->userdata('logged_in');

        $config1['upload_path'] = FCPATH . 'assets/img/klinik';
        $config1['allowed_types'] = 'gif|jpg|png';
        //$config1['file_name'] = $this->input->post('telepon').'.jpg';
        $config1['overwrite'] = TRUE;
        $config1['max_size'] = 2048000;
        $this->load->library('upload', $config1);

        $id = $this->input->post('id');

        if ($this->upload->do_upload('foto')) {

            $user = array(
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'email' => $this->input->post('email'),
                'telepon' => $this->input->post('telepon'),
                'kota' => $this->input->post('kota'),
                'dpjp' => $this->input->post('dpjp'),
                'ppjp' => $this->input->post('ppjp'),
                'apoteker' => $this->input->post('apoteker'),
                'foto' => $this->upload->data('file_name'),
                'creator' => $sesi->id
            );
            $a = $this->MainModel->update($tabel = 'klinik', $user, $id);

            if ($a) {
                $this->session->set_flashdata('success', 'Data Klinik berhasil update!');
                redirect('User/detailklinik', 'refresh');
            }

        } else {

            $user = array(
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'email' => $this->input->post('email'),
                'telepon' => $this->input->post('telepon'),
                'kota' => $this->input->post('kota'),
                'dpjp' => $this->input->post('dpjp'),
                'ppjp' => $this->input->post('ppjp'),
                'apoteker' => $this->input->post('apoteker'),

                'creator' => $sesi->id
            );
            $a = $this->MainModel->update($tabel = 'klinik', $user, $id);


            if ($a) {
                $this->session->set_flashdata('success', 'Data Klinik berhasil update!');
                redirect('User/detailklinik', 'refresh');
            }
        }
        $this->session->set_flashdata('warning', 'Data Klinik gagal update!');
        redirect('User/detailklinik', 'refresh');

    }

    public function simpanUpdate() {
        $sesi = $this->session->userdata('logged_in');

        $config1['upload_path'] = FCPATH . 'assets/img/profil';
        $config1['allowed_types'] = 'gif|jpg|png';
        //$config1['file_name'] = $this->input->post('username').'.jpg';
        $config1['overwrite'] = TRUE;
        $config1['max_size'] = 2048000;
        $this->load->library('upload', $config1);

        $id = $this->input->post('id');

        if ($this->upload->do_upload('foto')) {

            $user = array(
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'password_ori' => $this->input->post('password'),
                'telepon' => $this->input->post('telepon'),
                'foto' => $this->upload->data('file_name'),
                'creator' => $sesi->id
            );
            $a = $this->MainModel->update($tabel = 'user', $user, $id);
            $user_grup = array(

                'grup_id' => $this->input->post('nama_grup'),
                'creator' => $sesi->id

            );

            $b = $this->MainModel->update($tabel = 'user_grup', $user_grup, $id);
            if ($a == 1 && $b == 1) {
                $data_login = $this->LoginModel->ambilProfileById($id)->row();
                $this->session->set_userdata('logged_in', $data_login);
                $this->session->set_flashdata('success', 'Profil berhasil update!');
                redirect('User/detailuser/' . $id);
            }

        } else {

            $user = array(
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'password_ori' => $this->input->post('password'),
                'telepon' => $this->input->post('telepon'),
                'creator' => $sesi->id
            );
            $a = $this->MainModel->update($tabel = 'user', $user, $id);
            $user_grup = array(

                'grup_id' => $this->input->post('nama_grup'),
                'creator' => $sesi->id

            );

            $b = $this->MainModel->update($tabel = 'user_grup', $user_grup, $id);

            if ($a == 1 && $b == 1) {
                $data_login = $this->LoginModel->ambilProfileById($id)->row();
                $this->session->set_userdata('logged_in', $data_login);
                $this->session->set_flashdata('success', 'Profil berhasil update!');
                redirect('User/detailuser/' . $id);
            }
        }
        $this->session->set_flashdata('warning', 'Profil gagal update!');
        redirect('User/detailuser/' . $id);

    }

    public function simpan_adduser() {
        $sesi = $this->session->userdata('logged_in');

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
        $user_id = $this->MainModel->insert_id($tabel = 'user', $user);
        $user_grup = array(

            'grup_id' => $this->input->post('nama_grup'),
            'user_id' => $user_id,
            'creator' => $sesi->id

        );

        $b = $this->MainModel->insert($tabel = 'user_grup', $user_grup);

        if ($b) {
            $this->session->set_flashdata('success', 'Profil berhasil update!');
            redirect('User');
        }

        $this->session->set_flashdata('warning', 'Profil gagal update!');
        redirect('User');

    }
}

