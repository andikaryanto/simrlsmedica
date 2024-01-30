<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('LoginModel');
	}

    function UniqueMachineID($salt = "") {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $temp = sys_get_temp_dir().DIRECTORY_SEPARATOR."diskpartscript.txt";
            if(!file_exists($temp) && !is_file($temp)) file_put_contents($temp, "select disk 0\ndetail disk");
            $output = shell_exec("diskpart /s ".$temp);
            $lines = explode("\n",$output);
            $result = array_filter($lines,function($line) {
                return stripos($line,"ID:")!==false;
            });
            if(count($result)>0) {
                $result = array_shift(array_values($result));
                $result = explode(":",$result);
                $result = trim(end($result));
            } else $result = $output;
        } else {
            $result = shell_exec("blkid -o value -s UUID");
            if(stripos($result,"blkid")!==false) {
                $result = $_SERVER['HTTP_HOST'];
            }
        }
        return md5($salt.md5($result));
    }

	public function index()
	{
		session_destroy();
		$uuid = $this->UniqueMachineID();
		$this->load->view('login/form_login', compact('uuid'));
	}

    public function login() {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $checkusername = $this->LoginModel->check_username($this->input->post('username', TRUE))->row();
        $checkpassword = $this->LoginModel->check_password(md5($this->input->post('password', TRUE)))->row();

        $data_login = $this->LoginModel->ambilProfile($username,$password)->row();

        if($data_login) {
            if ($data_login->nama_grup == 'superadmin') {
                 $this->session->set_userdata('logged_in', $data_login);
                 redirect('Dashboard','refresh');
            }
            else if ($data_login->nama_grup == 'dokter') {
                 $this->session->set_userdata('logged_in', $data_login);
                 redirect('pemeriksaan/listpemeriksaanPasien','refresh');
            }
            else if ($data_login->nama_grup == 'perawat') {
                $this->session->set_userdata('logged_in', $data_login);
                redirect('PemeriksaanAwal','refresh');
            }
            else if ($data_login->nama_grup == 'apoteker') {
                $this->session->set_userdata('logged_in', $data_login);
                redirect('apotek/resep_n','refresh');
            }
            else if ($data_login->nama_grup == 'front_office') {
                $this->session->set_userdata('logged_in', $data_login);
                redirect('pendaftaran/listPendaftaranPasien','refresh');
            }
            else if ($data_login->nama_grup == 'administrasi_keuangan') {
                $this->session->set_userdata('logged_in', $data_login);
                redirect('Insentif/listInsentifDokter','refresh');
            }
            else if ($data_login->nama_grup == 'admin') {
                $this->session->set_userdata('logged_in', $data_login);
                redirect('Dashboard','refresh');
            }
            else if ($data_login->nama_grup == 'kasir') {
                 $this->session->set_userdata('logged_in', $data_login);
                 redirect('Administrasi/listPasienSelesaiPeriksa','refresh');
            }
            else if ($data_login->nama_grup == 'laborat') {
                $this->session->set_userdata('logged_in', $data_login);
                redirect('pemeriksaan/listpemeriksaanPasien','refresh');
            }
            else if ($data_login->nama_grup == 'ekg') {
                $this->session->set_userdata('logged_in', $data_login);
                redirect('pemeriksaan/listpemeriksaanPasien','refresh');
            }
            else if ($data_login->nama_grup == 'spirometri') {
                $this->session->set_userdata('logged_in', $data_login);
                redirect('pemeriksaan/listpemeriksaanPasien','refresh');
            }
            else if ($data_login->nama_grup == 'admin_obat') {
                $this->session->set_userdata('logged_in', $data_login);
                redirect('apotek/stokObat','refresh');
            }
            else {
                $this->session->set_userdata('logged_in', $data_login);
                redirect('Dashboard','refresh');
            }
        }
        else if ($checkpassword && $checkusername && !$data_login){
            $this->session->set_flashdata('warning', 'Password dan Email tidak cocok!');
            redirect('Login','refresh');
        }
        else if (!$checkusername && $checkpassword){
            $this->session->set_flashdata('warning', 'Maaf username tidak benar!');
            redirect('Login','refresh');
        }
        else if ($checkusername && !$checkpassword) {
            $this->session->set_flashdata('warning', 'Maaf password tidak benar!');
            redirect('Login','refresh');
        }
        else {
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
