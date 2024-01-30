<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('template');
        $this->load->Model('PasienModel');
        $this->load->Model('UserModel');
        $this->load->Model('MainModel');
    }

    public function index()
    {
        redirect('Pasien/listPasien');
    }

    public function listPasien()
    {
        $data['listPendaftaran'] = $this->PasienModel->getListPasien();

        $this->template->view('master/pasien/list_pasien_v', $data);
    }


    public function edit($id, $to = 0, $id_pendaftaran = 0)
    {
        $data['pasien'] = $this->PasienModel->getPasienById($id)->row();
        $data['to'] = $to;
        $data['id_pendaftaran'] = $id_pendaftaran;
        $data['pendaftaran'] = $this->db->query("SELECT * FROM pendaftaran_pasien WHERE id = $id_pendaftaran")->row();
        $data['jaminan'] = $this->config->item('pendaftaran');

        $this->template->view('master/pasien/pasien_edit_v', $data);
    }

    public function simpanUpdate()
    {
        $sesi = $this->session->userdata('logged_in');
        $id = $this->input->post('id');
        $to = $this->input->post('to');

        $user = array(
            'nama' => $this->input->post('nama'),
            'nik' => $this->input->post('nik'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'jk' => $this->input->post('jenis_kelamin'),
            'alamat' => $this->input->post('alamat'),
            'alamat_domisili' => $this->input->post('alamat_domisili'),
            'telepon' => $this->input->post('telepon'),
            'agama' => $this->input->post('agama'),
            'pendidikan' => $this->input->post('pendidikan'),
            'perkawinan' => $this->input->post('perkawinan'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'penanggungjawab' => $this->input->post('penanggungjawab'),
            'biopsikososial' => $this->input->post('biopsikososial'),
            'creator' => $sesi->id
        );
        $a = $this->MainModel->update($tabel = 'pasien', $user, $id);

        $jaminan = $this->input->post('jaminan');
        $id_pendaftaran = $this->input->post('id_pendaftaran');
        $this->db->query("UPDATE pendaftaran_pasien SET jaminan = '$jaminan' WHERE id = $id_pendaftaran");

        if ($a)
            $this->session->set_flashdata('success', 'Data Pasien berhasil update!');
        else
            $this->session->set_flashdata('warning', 'Data Pasien gagal update!');

        if ($to == 'pendaftaran')
            redirect('pendaftaran/listPendaftaranPasien');
        else
            redirect('Pasien/listPasien');
    }

    public function delete_pasien($id)
    {
        $data = array('is_active' => '0');
        $delete = $this->MainModel->delete($table = 'pasien', $data, $id);
        if ($delete) {
            $this->session->set_flashdata('success', 'Data Pasien berhasil dihapus!');
            redirect('Pasien/listPasien');
        }
        $this->session->set_flashdata('warning', 'Data Pasien gagal dihapus!');
        redirect('Pasien/listPasien');

    }


    public function ajax_kode()
    {
        if ($this->input->is_ajax_request()) {
            $keyword = $this->input->post('keyword');


            $pasien = $this->PendaftaranModel->cari_kode($keyword);

            if ($pasien->num_rows() > 0) {
                $json['status'] = 1;
                $json['datanya'] = "<ul id='daftar-autocomplete'>";
                foreach ($pasien->result() as $b) {
                    $json['datanya'] .= "
						<li>
							<b>Kode</b> : 
							<span id='kodenya'>" . $b->id . "</span> <br />
							<span id='no_rmnya'>" . $b->no_rm . "</span> <br />
							<span id='namanya'>" . $b->nama . "</span> <br />
							
						</li>
					";
                    /*$json['datanya'] .= "
                        <li>
                            <b>Kode</b> :
                            <span id='kodenya'>".$b->id."</span> <br />
                            <span id='barangnya'>".$b->nama_usaha."</span> <br />
                            <span id='harganya'>".$b->badan_hukum."</span>
                        </li>
                    ";*/
                }
                $json['datanya'] .= "</ul>";
            } else {
                $json['status'] = 0;
            }

            echo json_encode($json);
        }
    }


}

