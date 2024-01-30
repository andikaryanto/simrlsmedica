<?php

class Spirometri extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('template');
        $this->load->Model('SpirometriModel');
        $this->load->Model('UserModel');
        $this->load->Model('MainModel');
    }

    public function index(){
        redirect('Spirometri/listSpirometri');
    }

    public function listSpirometri() {
        $data['listSpirometri'] = $this->SpirometriModel->listSpirometri();
        $this->template->view('master/spirometri/list_spirometri_v',$data);
    }

    public function edit($id){
        $data['user'] = $this->UserModel->getUserById($id)->row();
        $data['grup'] = $this->UserModel->getGrup()->result();

        $this->template->view('master/spirometri/editspirometri_v',$data);
    }

    public function simpanUpdate(){
        $sesi = $this->session->userdata('logged_in');

        $config1['upload_path'] = FCPATH.'assets/img/profil';
        $config1['allowed_types'] = 'gif|jpg|png';
        //$config1['file_name'] = $this->input->post('username').'.jpg';
        $config1['overwrite'] = TRUE;
        $config1['max_size'] = 2048000;
        $this->load->library('upload',$config1);

        $id = $this->input->post('id');

        if($this->upload->do_upload('foto')) {

            $user = array(
                'nama'         =>$this->input->post('nama'),
                'username'     =>$this->input->post('username'),
                'email'        =>$this->input->post('email'),
                'password'     =>md5($this->input->post('password')),
                'password_ori' =>$this->input->post('password'),
                'telepon'      =>$this->input->post('telepon'),
                'foto'         =>$this->upload->data('file_name'),
                'creator'      =>$sesi->id
            );
            $a = $this->MainModel->update($tabel='user', $user,$id);

            if ($a) {
                $this->session->set_flashdata('success', 'Data Spirometri berhasil update!');
                redirect('Spirometri/listSpirometri');
            }

        }
        else {
            $user = array(
                'nama'     =>$this->input->post('nama'),
                'username' =>$this->input->post('username'),
                'email'    =>$this->input->post('email'),
                'password' =>md5($this->input->post('password')),
                'password_ori' =>$this->input->post('password'),
                'telepon'  =>$this->input->post('telepon'),
                'creator'  =>$sesi->id
            );
            $a = $this->MainModel->update($tabel='user', $user,$id);
            if ($a) {
                $this->session->set_flashdata('success', 'Data Spirometri berhasil update!');
                redirect('Spirometri/listSpirometri');
            }
        }
        $this->session->set_flashdata('warning', 'Data Spirometri gagal update!');
        redirect('Spirometri/listSpirometri');
    }

    public function delete_spirometri($id){
        $data = array('is_active' => '0' );
        $delete = $this->MainModel->delete($table='user',$data,$id);
        if($delete){
            $this->session->set_flashdata('success', 'Data Spirometri berhasil dihapus!');
            redirect('Spirometri/listSpirometri');
        }
        $this->session->set_flashdata('warning', 'Data Spirometri gagal dihapus!');
        redirect('Spirometri/listSpirometri');
    }
}