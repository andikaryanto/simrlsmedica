<?php


class Permintaan extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('template');
        $this->load->Model('MainModel');
        $this->load->Model('PendaftaranModel');
        $this->load->Model('PemeriksaanModel');
//        $this->load->Model('IgdModel');
        $this->load->Model('JenisLayananLaboratoirumModel');
        $this->load->helper('kode_booking');
    }

    private function get_next_kode_antrian($jenis_pendaftaran_id, $due_date)
    {
        $r = $this->db->query("
            SELECT * FROM antrian 
            WHERE date(due_date) = '$due_date' 
            AND jenis_pendaftaran_id = $jenis_pendaftaran_id 
            ORDER BY id DESC
        ")->row();
        $num = $r == null ? 0 : (int) preg_replace("/[^0-9]/", "", $r->kode_antrian);
        $num = str_pad(++$num, 3, "0", STR_PAD_LEFT);

        $j = $this->db->query("SELECT * FROM jenis_pendaftaran WHERE id = $jenis_pendaftaran_id")->row();
        return "$j->kode_antrian$num";
    }

//    public function pendaftaran()
//    {
//        $data['listPendaftaran'] = $this->IgdModel->getListPasienAntri();
//        $data['jaminan'] = $this->config->item('pendaftaran');
//
//        $this->template->view('igd/list_pendaftaran', $data);
//    }

    public function lab($pemeriksaan_id, $from_igd = 0)
    {
        $data['pendaftaran'] = $this->PemeriksaanModel->getPendaftaranByIdPemeriksaan($pemeriksaan_id)->row();
        $data['pemeriksaan'] = $this->PemeriksaanModel->getPemeriksaanById($pemeriksaan_id)->row();
        $data['jenis_layanan_lab'] = $this->JenisLayananLaboratoirumModel->get_all_children_and_paket();
        $data['rawat_inap_id'] = 0;
        $data['from_igd'] = $from_igd;

        $this->template->view('permintaan/lab', $data);
    }

    public function lab_from_inap($pendaftaran_id, $rawat_inap_id)
    {
        $data['pendaftaran'] = $this->PemeriksaanModel->getPendaftaranById($pendaftaran_id, true)->row();
        $data['pemeriksaan'] = $this->PemeriksaanModel->getPemeriksaanByIdPendaftaran($pendaftaran_id, true)->row();
        $data['jenis_layanan_lab'] = $this->JenisLayananLaboratoirumModel->get_all_children_and_paket();
        $data['rawat_inap_id'] = $rawat_inap_id;
        $data['from_igd'] = 0;

        $this->template->view('permintaan/lab', $data);
    }

    public function insert_lab()
    {
        $session = $this->session->userdata('logged_in');
        $pasien_id = $this->input->post('pasien_id');
        $pemeriksaan_id = $this->input->post('pemeriksaan_id');
        $pendaftaran_id = $this->input->post('pendaftaran_id');
        $rawat_inap_id = $this->input->post('rawat_inap_id');
        $pendaftaran = $this->db->query('SELECT * FROM pendaftaran_pasien WHERE id = '.$pendaftaran_id)->row();

        $rm = array(
            'pendaftaran_id' => $pendaftaran_id,
            'td' => $pendaftaran->td,
            'r' => $pendaftaran->r,
            'bb' => $pendaftaran->bb,
            'n' => $pendaftaran->n,
            's' => $pendaftaran->s,
            'tb' => $pendaftaran->tb,
            'bmi' => $pendaftaran->bmi,
            'no_rm' => $pendaftaran->no_rm,
            'pasien' => $pendaftaran->pasien,
            'penanggungjawab' => $pendaftaran->penanggungjawab,
            'biopsikososial' => $pendaftaran->biopsikososial,
            'jaminan' => $pendaftaran->jaminan,
            'no_jaminan' => $pendaftaran->no_jaminan,
            'jenis_pendaftaran_id' => 19,
            'dokter' => $pendaftaran->dokter,
            'status' => 'diperiksa',
            'is_bpjs' => $pendaftaran->jaminan,
            'creator' => $session->id
        );

        $insert = $this->MainModel->insert_id($tabel = 'pendaftaran_pasien', $rm);

        $periksa = array(
            'pendaftaran_id'    => $insert,
            'dokter_id'         => $this->input->post('dokter_id'),
            'pasien_id'         => $pasien_id,
            'perawat_id'        => '',
            'no_rm'             => $rm['no_rm'],
            'nama_pasien'       => $this->input->post('pasien'),
            'keluhan_utama'     => '',
            'diagnosa_perawat'  => '',
            'asuhan_keperawatan'=> '',
            'bmi'               => '',
            'td'                => '',
            'r'                 => '',
            'bb'                => '',
            'n'                 => '',
            's'                 => '',
            'tb'                => '',
            'is_bpjs'           => $this->input->post('jaminan') == 'bpjs' ? 1 : 0,
            'jaminan'           => $this->input->post('jaminan'),
            'status'            => 'sudah_periksa_awal',
            'sudah_obat'        => 1,
            'creator'           => $this->session->userdata('logged_in')->id
        );
        $pem_id = $this->MainModel->insert_id($tabel = 'pemeriksaan', $periksa);

        $input_tindakan = $this->input->post('tindakan');
        foreach ($input_tindakan as $key => $value) {
            $tindakan = array(
                'pemeriksaan_id' => $pem_id,
                'jenis_layanan_id' => $value,
                'creator' => $session->id
            );
            $this->MainModel->insert_id('detail_tindakan_pemeriksaan_lab', $tindakan);
        }

        $this->MainModel->insert('antrian', [
            'pendaftaran_id' => $insert,
            'pemeriksaan_id' => $pem_id,
            'jenis_pendaftaran_id' => 19,
            'pasien_id' => $pasien_id,
            'due_date' => date('Y-m-d'),
            'kode_antrian' => generateKodeAntrian(19, date('Y-m-d')),
            'is_check_in' => true,
            'check_in_at' => date('Y-m-d H:i'),
            'kode_booking' => generateKodeBooking()
        ]);

        if ($insert)
            $this->session->set_flashdata('success', 'Rujuk ke lab berhasil!');
        else
            $this->session->set_flashdata('warning', 'Rujuk ke lab gagal!');

        if ($this->input->post('rawat_inap_id'))
            redirect('RawatInap/detail/'.$this->input->post('rawat_inap_id'), 'refresh');
        else {
            if ($this->input->post('from_igd'))
                redirect('Igd/periksa/'.$pemeriksaan_id, 'refresh');
            else
                redirect('pemeriksaan/periksa/'.$pemeriksaan_id, 'refresh');
        }
    }

    public function radio($pemeriksaan_id, $from_igd = 0)
    {
        $data['pendaftaran'] = $this->PemeriksaanModel->getPendaftaranByIdPemeriksaan($pemeriksaan_id)->row();
        $data['pemeriksaan'] = $this->PemeriksaanModel->getPemeriksaanById($pemeriksaan_id)->row();
        $data['tindakan'] = $this->PemeriksaanModel->getTindakanByCategory('rad');
        $data['rawat_inap_id'] = 0;
        $data['from_igd'] = $from_igd;

        $this->template->view('permintaan/radiologi', $data);
    }

    public function radio_from_inap($pendaftaran_id, $rawat_inap_id)
    {
        $data['pendaftaran'] = $this->PemeriksaanModel->getPendaftaranById($pendaftaran_id)->row();
        $data['pemeriksaan'] = $this->PemeriksaanModel->getPemeriksaanByIdPendaftaran($pendaftaran_id)->row();
        $data['tindakan'] = $this->PemeriksaanModel->getTindakanByCategory('rad');
        $data['rawat_inap_id'] = $rawat_inap_id;
        $data['from_igd'] = 0;

        $this->template->view('permintaan/radiologi', $data);
    }

    public function insert_radio()
    {
        $session = $this->session->userdata('logged_in');
        $pasien_id = $this->input->post('pasien_id');
        $pemeriksaan_id = $this->input->post('pemeriksaan_id');
        $pendaftaran_id = $this->input->post('pendaftaran_id');
        $rawat_inap_id = $this->input->post('rawat_inap_id');
        $pendaftaran = $this->db->query('SELECT * FROM pendaftaran_pasien WHERE id = '.$pendaftaran_id)->row();
        $ri = $this->db->query("SELECT * FROM rawat_inap WHERE id = $rawat_inap_id")->row();

        $rm = array(
            'pendaftaran_id' => $pendaftaran_id,
            'td' => $pendaftaran->td,
            'r' => $pendaftaran->r,
            'bb' => $pendaftaran->bb,
            'n' => $pendaftaran->n,
            's' => $pendaftaran->s,
            'tb' => $pendaftaran->tb,
            'bmi' => $pendaftaran->bmi,
            'no_rm' => $pendaftaran->no_rm,
            'pasien' => $pendaftaran->pasien,
            'penanggungjawab' => $pendaftaran->penanggungjawab,
            'biopsikososial' => $pendaftaran->biopsikososial,
            'jaminan' => $pendaftaran->jaminan,
            'no_jaminan' => $pendaftaran->no_jaminan,
            'jenis_pendaftaran_id' => 59,
            'dokter' => $ri ? $ri->dpjp_id : $pendaftaran->dokter,
            'status' => 'diperiksa',
            'is_bpjs' => $pendaftaran->jaminan,
            'creator' => $session->id
        );

        $insert = $this->MainModel->insert_id($tabel = 'pendaftaran_pasien', $rm);

        $periksa = array(
            'pendaftaran_id'    => $insert,
            'dokter_id'         => $ri ? $ri->dpjp_id : $this->input->post('dokter_id'),
            'pasien_id'         => $pasien_id,
            'perawat_id'        => '',
            'no_rm'             => $rm['no_rm'],
            'nama_pasien'       => $this->input->post('pasien'),
            'keluhan_utama'     => '',
            'diagnosa_perawat'  => '',
            'asuhan_keperawatan'=> '',
            'bmi'               => '',
            'td'                => '',
            'r'                 => '',
            'bb'                => '',
            'n'                 => '',
            's'                 => '',
            'tb'                => '',
            'is_bpjs'           => $this->input->post('jaminan') == 'bpjs' ? 1 : 0,
            'jaminan'           => $this->input->post('jaminan'),
            'status'            => 'sudah_periksa_awal',
            'sudah_obat'        => 1,
            'creator'           => $this->session->userdata('logged_in')->id
        );
        $pem_id = $this->MainModel->insert_id($tabel = 'pemeriksaan', $periksa);

        $input_tindakan = $this->input->post('tindakan');
        foreach ($input_tindakan as $key => $value) {
            $tindakan = array(
                'pemeriksaan_id' => $pem_id,
                'tarif_tindakan_id' => $value,
                'jumlah_perawat' => 0,
                'perawat' => '',
                'tarif_per_perawat' => 0,
                'creator' => $session->id
            );
            $this->MainModel->insert_id('detail_tindakan_pemeriksaan', $tindakan);
        }

        $this->MainModel->insert('antrian', [
            'pendaftaran_id' => $insert,
            'pemeriksaan_id' => $pem_id,
            'jenis_pendaftaran_id' => 59,
            'pasien_id' => $pasien_id,
            'due_date' => date('Y-m-d'),
            'kode_antrian' => generateKodeAntrian(59, date('Y-m-d')),
            'is_check_in' => true,
            'check_in_at' => date('Y-m-d H:i'),
            'kode_booking' => generateKodeBooking()
        ]);

        if ($insert)
            $this->session->set_flashdata('success', 'Rujuk ke radiologi berhasil!');
        else
            $this->session->set_flashdata('warning', 'Rujuk ke radiologi gagal!');

        if ($this->input->post('rawat_inap_id'))
            redirect('RawatInap/detail/'.$this->input->post('rawat_inap_id'), 'refresh');
        else {
            if ($this->input->post('from_igd'))
                redirect('Igd/periksa/'.$pemeriksaan_id, 'refresh');
            else
                redirect('pemeriksaan/periksa/'.$pemeriksaan_id, 'refresh');
        }
    }
}