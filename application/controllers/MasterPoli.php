<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterPoli extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('template');
        $this->load->Model('PenyakitModel');
        $this->load->Model('TarifTindakanModel');
        $this->load->Model('MainModel');
    }

    public function getDetailTindakan($id_pemeriksaan){
        $data = $this->db
            ->select('
                detail_tindakan_pemeriksaan.id,
                detail_tindakan_pemeriksaan.pemeriksaan_id,
                detail_tindakan_pemeriksaan.tarif_tindakan_id,
                tarif_tindakan.nama,
                tarif_tindakan.tarif_perawat,
                tarif_tindakan.tarif_dokter,
                tarif_tindakan.tarif_lain,
                tarif_tindakan.tarif_pasien
                ')
            ->from('detail_tindakan_pemeriksaan')
            ->join('tarif_tindakan', 'detail_tindakan_pemeriksaan.tarif_tindakan_id = tarif_tindakan.id', 'left')
            ->where('detail_tindakan_pemeriksaan.pemeriksaan_id', $id_pemeriksaan)
            ->get()->result();
        return $data;
    }

    public function transaksi($kat=false){
        if ($kat) {
            $data['kode'] = $this->config->item('poli')[$kat]['kode'];
            $data['jaminan'] =$this->config->item('pendaftaran');
            $data['context'] = $this;
            $data['transaksi'] = $this->db
                ->select('
                    pemeriksaan.id,
                    pemeriksaan.pendaftaran_id,
                    pemeriksaan.jaminan,
                    pemeriksaan.no_rm,
                    pemeriksaan.nama_pasien,
                    pendaftaran_pasien.jenis_pendaftaran_id,
                    pendaftaran_pasien.waktu_pendaftaran,
                    pendaftaran_pasien.dokter,
                    user.nama,
                    jenis_pendaftaran.kode
                    ')
                ->from('pemeriksaan')
                ->join('pendaftaran_pasien', 'pemeriksaan.pendaftaran_id = pendaftaran_pasien.id', 'left')
                ->join('user', 'pendaftaran_pasien.dokter = user.id', 'left')
                ->join('jenis_pendaftaran', 'pendaftaran_pasien.jenis_pendaftaran_id = jenis_pendaftaran.id', 'left')
                ->where_in('pemeriksaan.status', ['sudah_periksa', 'selesai', 'bayar', 'sudah_obat'])
                ->where_in('jenis_pendaftaran.kode', $data['kode'])
                ->get()->result();

            $this->template->view('master_poli/transaksi',$data);
        }
        else{
            show_404();
        }

    }

    public function listPenyakit() {
        $data['jenis'] = str_replace('%20', ' ', $this->uri->segment(3));

        $data_poli = $this->config->item('poli');
        if(isset($data_poli[$data['jenis']])){
            $data['title'] = 'Data Penyakit '.$data_poli[$data['jenis']]['penyakit'];
            $data['penyakit'] = $this->PenyakitModel->getListByCategory($data['jenis']);
        }

        $this->template->view('master_poli/penyakit/list',$data);
    }

    public function tambah_Penyakit() {

        if ($this->input->post('submit') == 1) {

            $session = $this->session->userdata('logged_in');
            $Penyakit = array(
                'kode'      => $this->input->post('kode'),
                'nama'      => $this->input->post('nama'),
                'creator'   => $session->id,
                'category'  => $this->input->post('jenis')
            );

//            if ($this->input->post('jenis') == 'umum') {
//                $Penyakit['is_umum'] = '1';
//            }
//            else if ($this->input->post('jenis') == 'gigi') {
//                $Penyakit['is_poligigi'] = '1';
//            }
//            else if ($this->input->post('jenis') == 'kia') {
//                $Penyakit['is_kia'] = '1';
//            }
//            else if ($this->input->post('jenis') == 'fisioterapi') {
//                $Penyakit['is_fisio'] = '1';
//            }
//            else if ($this->input->post('jenis') == 'laboratorium') {
//                $Penyakit['is_laborat'] = '1';
//            }

            $insert = $this->MainModel->insert($tabel='penyakit',$Penyakit);

            if($insert) {
                $this->session->set_flashdata('success', 'Tambah Penyakit  '. $this->input->post('jenis') .' berhasil!');
                redirect('MasterPoli/listPenyakit/'.$this->input->post('jenis'),'refresh');
            }
            else {
                $this->session->set_flashdata('warning', 'Tambah Penyakit gigi gagal!');
                redirect('MasterPoli/tambah_Penyakit/'.$this->input->post('jenis'),'refresh');
            }
        }
        else {
            $data['jenis'] = str_replace('%20', ' ', $this->uri->segment(3));
            if ($data['jenis'] == 'umum') {
                $data['title'] = 'Tambah Penyakit Umum';
            }
            else if ($data['jenis'] == 'gigi') {
                $data['title'] = 'Tambah Penyakit Gigi';
            }
            else if ($data['jenis'] == 'kia') {
                $data['title'] = 'Tambah Penyakit KIA';
            }
            else if ($data['jenis'] == 'fisioterapi') {
                $data['title'] = 'Tambah Penyakit Fisioterapi';
            }
            else if ($data['jenis'] == 'laboratorium') {
                $data['title'] = 'Tambah Layanan Laboratorium';
            }
            else if ($data['jenis'] == 'laboratorium') {
                $data['title'] = 'Tambah Layanan Laboratorium';
            }
            else if ($data['jenis'] == 'rawat luka') {
                $data['title'] = 'Tambah Penyakit Rawat Luka';
            }

            $data_poli = $this->config->item('poli');
            unset($data_poli['gigi']);
            if(isset($data_poli[$data['jenis']])){
                $data['title'] = 'Tambah Layanan '.$data_poli[$data['jenis']]['penyakit'];
            }

            $this->template->view('master_poli/penyakit/tambah', $data);
        }
    }

    public function edit() {
        $id = $this->uri->segment(4);
        $data['jenis'] = $this->uri->segment(3);
        $data['penyakit'] = $this->PenyakitModel->getPenyakitById($id)->row();

        if ($data['jenis'] == 'umum') {
            $data['title'] = 'Edit Penyakit Umum';
        }
        else if ($data['jenis'] == 'gigi') {
            $data['title'] = 'Edit Penyakit Gigi';
        }
        else if ($data['jenis'] == 'kia') {
            $data['title'] = 'Edit Penyakit KIA';
        }
        else if ($data['jenis'] == 'fisioterapi') {
            $data['title'] = 'Edit Penyakit Fisioterapi';
        }
        else if ($data['jenis'] == 'laboratorium') {
            $data['title'] = 'Edit Layanan Laboratorium';
        }

        $data_poli = $this->config->item('poli');
        unset($data_poli['gigi']);
        if(isset($data_poli[$data['jenis']])){
            $data['title'] = 'Edit Layanan '.$data_poli[$data['jenis']]['penyakit'];
        }

        $this->template->view('master_poli/penyakit/edit', $data);
    }

    public function simpanUpdate() {

        $id = $this->input->post('id');
        $Penyakit = array(
            'kode'  => $this->input->post('kode'),
            'nama'  => $this->input->post('nama'),
        );

        $a = $this->MainModel->update($tabel='penyakit', $Penyakit, $id);

        if ($a) {
            $this->session->set_flashdata('success', 'Data Penyakit gigi berhasil update!');
            redirect('MasterPoli/listPenyakit/'.$this->input->post('jenis'));
        }
        else {
            $this->session->set_flashdata('warning', 'Data Penyakit gigi gagal update!');
            redirect('MasterPoli/listPenyakit/'.$this->input->post('jenis'));
        }
    }

    public function delete_Penyakit() {

        $id = $this->uri->segment(4);
        $data = array('is_active' => '0' );
        $delete = $this->MainModel->delete($table='penyakit',$data,$id);

        if($delete) {
            $this->session->set_flashdata('success', 'Data Penyakit gigi berhasil dihapus!');
            redirect('MasterPoli/listPenyakit/'.$this->uri->segment(3));
        }
        else {
            $this->session->set_flashdata('warning', 'Data Penyakit gigi gagal dihapus!');
            redirect('MasterPoli/listPenyakit/'.$this->uri->segment(3));
        }
    }

    // #################################### Tarif Tindakan ####################################

    public function listTarifTindakan(){
        $data['jenis'] = urldecode($this->uri->segment(3));
        $data_poli = $this->config->item('poli');
        if(isset($data_poli[$data['jenis']])){
            $data['title'] = 'Data Tarif Tindakan '.$data_poli[$data['jenis']]['penyakit'];
            $data['penyakit'] = $this->TarifTindakanModel->getListByCategory($data['jenis']);
        }

        $this->template->view('master_poli/tarif_tindakan/list',$data);
    }

    public function tambah_TarifTindakan() {

        if ($this->input->post('submit') == 1) {

            $session = $this->session->userdata('logged_in');
            $TarifTindakan = array(
                'nama'               => $this->input->post('nama_tindakan'),
                'tarif_perawat'      => $this->input->post('tarif_perawat'),
                'tarif_dokter'       => $this->input->post('tarif_dokter'),
                'tarif_apoteker'       => $this->input->post('tarif_apoteker'),
                'tarif_lain'         => $this->input->post('tarif_lain'),
                'klinik'             => $this->input->post('klinik'),
                'jm_admin'             => $this->input->post('jm_admin'),
                'pajak'             => $this->input->post('pajak'),
                'zakat'             => $this->input->post('zakat'),
                'bhp'             => $this->input->post('bhp'),
                'tarif_pasien'       => $this->input->post('tarif_pasien'),
                'creator'            => $session->id,
                'category'  => $this->input->post('jenis')
            );

            $insert = $this->MainModel->insert($tabel='tarif_tindakan',$TarifTindakan);

            if($insert) {
                $this->session->set_flashdata('success', 'Tambah Tarif Tindakan berhasil!');
                redirect('MasterPoli/listTarifTindakan/'.$this->input->post('jenis'),'refresh');
            }
            else {
                $this->session->set_flashdata('warning', 'Tambah Tarif Tindakan gagal!');
                redirect('MasterPoli/tambah_TarifTindakan/'.$this->input->post('jenis'),'refresh');
            }
        }
        else {
            $data['jenis'] = urldecode($this->uri->segment(3));
            $data_poli = $this->config->item('poli');
            unset($data_poli['gigi']);
            if(isset($data_poli[$data['jenis']])){
                $data['title'] = 'Tambah Tarif Tindakan '.$data_poli[$data['jenis']]['penyakit'];
            }

            $this->template->view('master_poli/tarif_tindakan/tambah', $data);
        }
    }

    public function edit_tindakan(){
        $id = $this->uri->segment(4);
        $data['jenis'] = urldecode($this->uri->segment(3));
        $data['tarif_tindakan'] = $this->TarifTindakanModel->getTarifTindakanById($id)->row();

        $data_poli = $this->config->item('poli');
        unset($data_poli['gigi']);
        if(isset($data_poli[$data['jenis']])){
            $data['title'] = 'Edit Tarif Tindakan '.$data_poli[$data['jenis']]['penyakit'];
        }

        $this->template->view('master_poli/tarif_tindakan/edit', $data);
    }

    public function simpanUpdateTindakan(){

        $id = $this->input->post('id');
        $TarifTindakan = array(
            'nama'               => $this->input->post('nama_tindakan'),
            'tarif_perawat'      => $this->input->post('tarif_perawat'),
            'tarif_dokter'       => $this->input->post('tarif_dokter'),
            'tarif_apoteker'       => $this->input->post('tarif_apoteker'),
            'tarif_lain'         => $this->input->post('tarif_lain'),
            'klinik'             => $this->input->post('klinik'),
            'jm_admin'             => $this->input->post('jm_admin'),
            'pajak'             => $this->input->post('pajak'),
            'zakat'             => $this->input->post('zakat'),
            'bhp'             => $this->input->post('bhp'),
            'tarif_pasien'       => $this->input->post('tarif_pasien'),
        );

        $a = $this->MainModel->update($tabel='tarif_tindakan', $TarifTindakan,$id);

        if ($a) {
            $this->session->set_flashdata('success', 'Data Tarif Tindakan berhasil update!');
            redirect('MasterPoli/listTarifTindakan/'.$this->input->post('jenis'));
        }
        else {
            $this->session->set_flashdata('warning', 'Data Tarif Tindakan gagal update!');
            redirect('MasterPoli/listTarifTindakan/'.$this->input->post('jenis'));
        }
    }

    public function delete_TarifTindakan() {

        $id = $this->uri->segment(4);
        $data = array('is_active' => '0' );
        $delete = $this->MainModel->delete($table='tarif_tindakan',$data,$id);

        if($delete) {
            $this->session->set_flashdata('success', 'Data Tarif Tindakan berhasil dihapus!');
            redirect('MasterPoli/listTarifTindakan/'.$this->uri->segment(3));
        }
        else {
            $this->session->set_flashdata('warning', 'Data Tarif Tindakan gagal dihapus!');
            redirect('MasterPoli/listTarifTindakan/'.$this->uri->segment(3));
        }
    }
}
