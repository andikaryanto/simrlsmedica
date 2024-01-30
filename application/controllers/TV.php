<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TV extends CI_Controller
{
    public function __construct()
    {
//         error_reporting(E_ALL);
//         ini_set('display_errors', 1);

        parent::__construct();

        $this->load->model('PendaftaranModel');
        $this->load->model('MainModel');
//        $this->load->model('RuangOperasiModel');
    }

    public function poli()
    {
        $data = $this->data_poli();
        $this->load->view('tv/poli', $data);
    }

    public function data_poli($ajax = 0)
    {
        $today = date('Y-m-d');
        $data['list'] = $this->db->query("
            SELECT antrian.*, jp.nama as nama_poli, u.nama as nama_dokter, pas.nama as nama_pasien, pas.nik, pas.no_rm 
            FROM antrian 
            JOIN jenis_pendaftaran jp ON jp.id = antrian.jenis_pendaftaran_id 
            JOIN pendaftaran_pasien p ON p.id = antrian.pendaftaran_id
            JOIN user u ON u.id = p.dokter
            JOIN pasien pas ON pas.id = p.pasien
            WHERE due_date = '$today'
            AND is_called = 0
        ")->result();

        $data['last_called'] = $this->db->query("
            SELECT antrian.*, jp.nama as nama_poli, u.nama as nama_dokter, pas.nama as nama_pasien, pas.nik, pas.no_rm
            FROM antrian 
            JOIN jenis_pendaftaran jp ON jp.id = antrian.jenis_pendaftaran_id 
            JOIN pendaftaran_pasien p ON p.id = antrian.pendaftaran_id
            JOIN user u ON u.id = p.dokter
            JOIN pasien pas ON pas.id = p.pasien
            WHERE due_date = '$today' 
            AND is_called = 1
            ORDER BY id DESC
        ")->row();

        $data['jenis_pendaftaran'] = [];
        foreach ($this->PendaftaranModel->getJenisPendaftaran()->result() as $v) {
            $all = $this->db->query("SELECT * FROM antrian WHERE due_date = '$today' AND jenis_pendaftaran_id = $v->id")->result();
            if (count($all)) {
                $done = $this->db->query("SELECT * FROM antrian WHERE due_date = '$today' AND jenis_pendaftaran_id = $v->id AND is_done = 1")->result();
                $v->total_antrian = count($all);
                $v->sisa_antrian = count($all) - count($done);
                $v->can_call_next = $v->sisa_antrian > 0;

                $last_called = $this->db->query("SELECT * FROM antrian WHERE due_date = '$today' AND jenis_pendaftaran_id = $v->id AND is_called = 1 ORDER BY id DESC")->row();
                $last_done = $this->db->query("SELECT * FROM antrian WHERE due_date = '$today' AND jenis_pendaftaran_id = $v->id AND is_done = 1 ORDER BY id DESC")->row();
                $v->last = $last_called ?? $last_done;

                $after = $v->last ? "AND a.id > {$v->last->id}" : '';
                $v->next = $this->db->query("
                    SELECT a.*, jp.nama as nama_poli, u.nama as nama_dokter, pas.nama as nama_pasien, pas.nik, pas.no_rm
                    FROM antrian a
                    JOIN jenis_pendaftaran jp ON jp.id = a.jenis_pendaftaran_id  
                    JOIN pendaftaran_pasien p ON p.id = a.pendaftaran_id
                    JOIN user u ON u.id = p.dokter
                    JOIN pasien pas ON pas.id = p.pasien
                    WHERE due_date = '$today' AND a.jenis_pendaftaran_id = $v->id AND is_called = 0 
                    $after
                    ORDER BY a.id ASC
                ")->row();

                $v->sisa_kuota_non_jkn = $v->kuota_non_jkn - count($this->db->query("SELECT id FROM pendaftaran_pasien WHERE jaminan != 'bpjs' AND DATE(created_at) = '$today' AND jenis_pendaftaran_id = $v->id AND is_active = 1")->result());
                $v->sisa_kuota_jkn = $v->kuota_jkn - count($this->db->query("SELECT id FROM pendaftaran_pasien WHERE jaminan = 'bpjs' AND DATE(created_at) = '$today' AND jenis_pendaftaran_id = $v->id AND is_active = 1")->result());

                $data['jenis_pendaftaran'] []= $v;
            }
        }

        if ($ajax) {
            echo json_encode($data);
        }
        return $data;
    }

    public function farmasi()
    {
        $data = $this->data_farmasi();
        $this->load->view('tv/farmasi', $data);
    }

    public function data_farmasi($ajax = 0)
    {
        $today = date('Y-m-d');
        $data['list'] = $this->db->query("
            SELECT antrian.*, jp.nama as nama_poli, u.nama as nama_dokter, pas.nama as nama_pasien, pas.nik, pas.no_rm 
            FROM antrian_farmasi as antrian
            JOIN pendaftaran_pasien p ON p.id = antrian.pendaftaran_id
            JOIN jenis_pendaftaran jp ON jp.id = p.jenis_pendaftaran_id 
            JOIN user u ON u.id = p.dokter
            JOIN pasien pas ON pas.id = p.pasien
            WHERE due_date = '$today'
            AND is_called = 0
        ")->result();

        $data['last_called'] = $this->db->query("
            SELECT antrian.*, jp.nama as nama_poli, u.nama as nama_dokter, pas.nama as nama_pasien, pas.nik, pas.no_rm
            FROM antrian_farmasi as antrian
            JOIN pendaftaran_pasien p ON p.id = antrian.pendaftaran_id
            JOIN jenis_pendaftaran jp ON jp.id = p.jenis_pendaftaran_id 
            JOIN user u ON u.id = p.dokter
            JOIN pasien pas ON pas.id = p.pasien
            WHERE due_date = '$today' 
            AND is_called = 1
            ORDER BY id DESC
        ")->row();

        if ($ajax) {
            echo json_encode($data);
        }
        return $data;
    }

    public function call_next($id_antrian)
    {
//        $this->MainModel->update('antrian_farmasi', ['is_called' => true], $id_antrian);
        echo json_encode(['success' => true]);
    }

    public function ok()
    {
        $data = $this->data_ok();
        $this->load->view('tv/ok', $data);
    }

    private function setDari(&$d)
    {
        if ($d['jenis'] == 19) {
            $d['dari'] = "Ruang Bersalin";
        }
        else if ($d['via_bangsal']) {
            $d['dari'] = $d['bed_name'].' - '.$d['bedgroup'];
        }
        else {
            $d['dari'] = $d['nama_poli'];
        }
    }

//    public function data_ok($ajax = 0)
//    {
//        $data['list'] = $this->RuangOperasiModel->getBaru();
//        foreach ($data['list'] as &$d) {
//            $this->setDari($d);
//        }
//
//        if ($ajax) {
//            echo json_encode($data);
//        }
//        return $data;
//    }
}