<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();		
        $this->load->model('LoginModel');
	}
	
	public function index()
	{
		session_destroy();
		$this->load->view('login/form_login');
	}

	 public function login() {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $checkusername = $this->LoginModel->check_username($this->input->post('username', TRUE))->row();
        $checkpassword = $this->LoginModel->check_password(md5($this->input->post('password', TRUE)))->row();
       

        $data_login = $this->LoginModel->ambilProfile($username,$password)->row();
        	
       
        if($data_login){
        
            $this->session->set_userdata('logged_in',$data_login);
            //$this->session->set_flashdata('success', '<b>Hai '.ucwords($data_login['nama']).'</b>, Selamat datang di CBT. ');
             redirect('Dashboard','refresh');
        }
        else  if ($checkpassword && $checkusername && !$data_login){
           $this->session->set_flashdata('warning', 'Password dan Email tidak cocok!');
            redirect('Login','refresh');       
        }

        else  if (!$checkusername && $checkpassword){
            $this->session->set_flashdata('warning', 'Maaf username tidak benar!');
            redirect('Login','refresh');
        }
        else if ($checkusername && !$checkpassword) {
            $this->session->set_flashdata('warning', 'Maaf password tidak benar!');
            redirect('Login','refresh');
        } else {
        	$this->session->set_flashdata('warning', 'Maaf username dan password tidak benar!');
            redirect('Login','refresh');
        }
       
    }

    public function logout() 
    {
       /* $id_user = $this->session->userdata('logged_in')['result']->client_id;
        $ip = $this->input->ip_address();*/
        //$this->LoginModel->Logout($id_user,$ip);
        redirect('Login/index','refresh');     
    }
}
