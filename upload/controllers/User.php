<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();		
       
        $this->load->library('template');
        $this->load->Model('UserModel');
        $this->load->Model('MainModel');
	}
	
	public function index()
	{
		$sesi = $this->session->userdata('logged_in');
		$data['sesi'] = $this->session->userdata('logged_in');
		$data['user'] = $this->UserModel->listAllUser();
		//print_r($data['spp']->result());die();
		$this->template->view('user/list_user_v',$data);
	}

	public function detailuser($id){
		$sesi = $this->session->userdata('logged_in');
		$data['user'] = $this->UserModel->getUserById($id)->row();
		$data['grup'] = $this->UserModel->getGrup()->result();
		//print_r($data['user']);die();
		$this->template->view('user/detailuser_v',$data);
	}

	public function adduser(){
		$sesi = $this->session->userdata('logged_in');
		$data['grup'] = $this->UserModel->getGrup()->result();
		//print_r($data['user']);die();
		$this->template->view('user/adduser_v',$data);
	}

	public function simpanUpdate(){
		$sesi = $this->session->userdata('logged_in');
		
				$config1['upload_path'] = FCPATH.'assets/img/profil';
				$config1['allowed_types'] = 'gif|jpg|png';
				$config1['file_name'] = $this->input->post('username').'.jpg';
				$config1['overwrite'] = TRUE;
				$config1['max_size'] = 2048000;
				$this->load->library('upload',$config1);
				
				/*if($this->upload->do_upload('foto')){
					 $result = $this->upload->data('file_name');
			            echo "<pre>";
			            print_r($result);
			            echo "</pre>";
				}else{
					$aa = $this->upload->display_errors();
					 print_r($aa);
				}die();*/
				
				
				
			
 		$id = $this->input->post('id');
 		
    	if($this->upload->do_upload('foto')){ 
    		
    		$user = array(
						'nama'     =>$this->input->post('nama'),
						'username' =>$this->input->post('username'),
						'email'    =>$this->input->post('email'),
						'password' =>md5($this->input->post('password')),
						'password_ori' =>$this->input->post('password'),
						'telepon'  =>$this->input->post('telepon'),						
						'foto'     =>$this->upload->data('file_name'),
						'creator'  =>$sesi->id
    					 );
    		$a = $this->MainModel->update($tabel='user', $user,$id);
    		$user_grup = array(
						
						'grup_id'  =>$this->input->post('nama_grup'),
						'creator'  =>$sesi->id
						
    					 );
    		
    		$b = $this->MainModel->update($tabel='user_grup', $user_grup,$id);
    		if ($a==1 && $b ==1) {
    			$this->session->set_flashdata('success', 'Profil berhasil update!');
    			redirect('User/detailuser/'.$sesi->id);
    		}

    	}else{
    	
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
    		$user_grup = array(
						
						'grup_id'  =>$this->input->post('nama_grup'),
						'creator'  =>$sesi->id
						
    					 );
    		
    		$b= $this->MainModel->update($tabel='user_grup', $user_grup,$id);

    		if ($a==1 && $b ==1) {
    			$this->session->set_flashdata('success', 'Profil berhasil update!');
    			redirect('User/detailuser/'.$sesi->id);
    		}
    	}
    	$this->session->set_flashdata('warning', 'Profil gagal update!');
    	redirect('User/detailuser/'.$sesi->id);
		
	}

	public function simpan_adduser(){
		$sesi = $this->session->userdata('logged_in');
		
 		$id = $this->input->post('id'); 		
    	
    		$user = array(
						'nama'     =>$this->input->post('nama'),
						'username' =>$this->input->post('username'),
						'email'    =>$this->input->post('email'),
						'password' =>md5($this->input->post('password')),
						'password_ori' =>$this->input->post('password'),
						'telepon'  =>$this->input->post('telepon'),												
						'creator'  =>$sesi->id
    					 );
    		$user_id = $this->MainModel->insert_id($tabel='user', $user);
    		$user_grup = array(
						
						'grup_id'  =>$this->input->post('nama_grup'),
						'user_id'  =>$user_id,
						'creator'  =>$sesi->id
						
    					 );
    		
    		$b= $this->MainModel->insert($tabel='user_grup', $user_grup);

    		if ($b) {
    			$this->session->set_flashdata('success', 'Profil berhasil update!');
    			redirect('User');
    		}
    	
    	$this->session->set_flashdata('warning', 'Profil gagal update!');
    	redirect('User');
		
	}
	



	
}

