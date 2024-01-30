<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PemeriksaanAwal extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('template');
        $this->load->Model('PemeriksaanModel');
        $this->load->Model('MainModel');
        $this->load->Model('PasienModel');
        $this->load->Model('PerawatModel');
    }

    public function index() {
	    $u = $this->session->get_userdata('logged_in');
	    $u = $u['logged_in'];
	    $is_dokter = $u->nama_grup == 'dokter';
	    $is_perawat = $u->nama_grup == 'perawat';
	    $is_laborat = $u->nama_grup == 'laborat';
	    $is_ekg = $u->nama_grup == 'ekg';
	    $is_spirometri = $u->nama_grup == 'spirometri';

	    if ($is_dokter || $is_perawat) {
		    $data['listPendaftaran'] = $this->PemeriksaanModel->getListPendaftaran_antriByIdJenisPendafataran($u->id_jenis_pendaftaran);
	    }
	    else if ($is_laborat || $is_ekg || $is_spirometri) {

	        if ($is_laborat) {
	            $id = '19';
	        }
	        else if ($is_ekg) {
	            $id = '40';
	        }
	        else if ($is_spirometri) {
	            $id = '42';
	        }
		    $data['listPendaftaran'] = $this->PemeriksaanModel->getListPendaftaran_antriByIdJenisPendafataran($id);
	    }
	    else {
		    $data['listPendaftaran'] = $this->PemeriksaanModel->getListPendaftaran_antri();
	    }

        $data['jenis_pendaftaran'] = $this->PemeriksaanModel->getJenisPendafataranAntrian();
        foreach($data['jenis_pendaftaran'] as &$jp) {
            $jp->list = $this->PemeriksaanModel->getListPendaftaran_antriByIdJenisPendafataran($jp->jenis_pendaftaran_id)->result();
        }

        $data['jaminan'] =$this->config->item('pendaftaran');
        $this->template->view('pemeriksaan_awal/list',$data);
    }

    public function periksa($id) {
        $data['pendaftaran']  = $this->PemeriksaanModel->getPendaftaranById($id)->row_array();
        $data['pemeriksaan'] = $this->PemeriksaanModel->getPemeriksaanByIdPendaftaran($id)->row_array();
        $data['prev_pemeriksaan'] = $this->PemeriksaanModel->getPrevPemeriksaanByIdPasien($data['pemeriksaan']['pasien_id'], $data['pemeriksaan']['id'])->row_array();
        $data['form'] = unserialize($data['pemeriksaan']['form']);
        $data['kajian_perawat'] = json_decode($data['pemeriksaan']['kajian_perawat'], true);

        $data['jaminan'] =$this->config->item('pendaftaran');
        $data['listPerawat'] = $this->PerawatModel->listPerawat();
        $this->template->view('pemeriksaan_awal/periksa', $data);
    }

    public function simpanPeriksa($id) {
        $input_perawat = $this->input->post('perawat') ?? [];
        $periksa = array(
            'pendaftaran_id'    => $this->input->post('pendaftaran_id'),
            'dokter_id'         => $this->input->post('dokter_id'),
            'pasien_id'         => $id,
            'perawat_id'        => $this->session->userdata('logged_in')->id,
            'detail_perawat_id' => implode(',', $input_perawat) == null ? '' : implode(',', $input_perawat),
            'no_rm'             => $this->input->post('no_rm'),
            'nama_pasien'       => $this->input->post('nama_pasien'),
            'keluhan_utama'     => $this->input->post('keluhan_utama'),
            'kajian_perawat'    => json_encode([
                'status_fisik' => $this->input->post('status_fisik'),
                'psikososial' => $this->input->post('psikososial'),
                'riwayat_kesehatan_pasien' => $this->input->post('riwayat_kesehatan_pasien'),
                'riwayat_penggunaan_obat' => $this->input->post('riwayat_penggunaan_obat'),
            ]),
            'diagnosa_perawat'  => $this->input->post('diagnosa_perawat'),
            'asuhan_keperawatan'=> $this->input->post('asuhan_keperawatan'),
            'bmi'               => $this->input->post('bmi'),
            'td'                => $this->input->post('td'),
            'r'                 => $this->input->post('r'),
            'bb'                => $this->input->post('bb'),
            'n'                 => $this->input->post('n'),
            's'                 => $this->input->post('s'),
            'tb'                => $this->input->post('tb'),
            'is_bpjs'                => $this->input->post('is_bpjs'),
            'jaminan'                => $this->input->post('jaminan'),
            'status'            => 'sudah_periksa_awal',
            'form' => serialize($this->input->post('form')),
            'sudah_periksa_perawat' => 1,
            'creator'           => $this->session->userdata('logged_in')->id
        );

        $this->MainModel->update('pendaftaran_pasien', array('status' =>'diperiksa'), $this->input->post('pendaftaran_id'));
        $this->MainModel->update('pemeriksaan',$periksa, $this->input->post('pemeriksaan_id'));

        $pemeriksaan = $this->PemeriksaanModel->getPemeriksaanById($this->input->post('pemeriksaan_id'))->row();
        if ($pemeriksaan->sudah_periksa_perawat && $pemeriksaan->sudah_periksa_dokter) {
            $this->MainModel->update('pemeriksaan', ['status' => 'sudah_periksa'], $this->input->post('pemeriksaan_id'));
        }

        $this->session->set_flashdata('success', 'Pemeriksaan awal pasien berhasil!');
        redirect('PemeriksaanAwal/');
    }

    public function hapus($pendaftaran_id)
    {
        $this->MainModel->delete('pendaftaran_pasien', ['is_active' => 0], $pendaftaran_id);
        $this->db->where('pendaftaran_id', $pendaftaran_id)->update('pemeriksaan', ['is_active' => 0]);

        $this->session->set_flashdata('success', 'Berhasil menghapus pendaftaran');
        redirect('PemeriksaanAwal', 'refresh');
    }
}
