<?php

class AntrianPoli extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('template');
        $this->load->model('PendaftaranModel');
        $this->load->model('MainModel');
    }

    public function index()
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

        $this->template->view('antrian/poli/list', $data);
    }

    public function call_next($id_antrian)
    {
        $this->MainModel->update('antrian', ['is_called' => true], $id_antrian);
        echo json_encode(['success' => true]);
    }

    public function tidak_hadir($antrian_id)
    {
        $ant = $this->db->query("SELECT * FROM antrian WHERE id = $antrian_id")->row();
        if ($this->PendaftaranModel->hapusPendaftaran($ant->pendaftaran_id)) {
            if ($ant) {
                $task_body = ['kodebooking' => $ant->kode_booking ?? '', 'taskid' => 99, 'waktu' => time().'000'];
                $this->MainModel->insert('bpjs_jknmobile_log', [
                    'url' => 'antrean/updatewaktu',
                    'header' => 'task 99',
                    'request' => json_encode($task_body),
                    'response' => json_encode($this->post("{$this->base_url_antrean}antrean/updatewaktu", json_encode($task_body), true)),
                ]);

                $body = [
                    'kodebooking' => $ant->kode_booking,
                    'keterangan' => 'Dibatalkan petugas'
                ];
                $res = $this->post("{$this->base_url_antrean}antrean/batal", json_encode($body), true);
                $this->MainModel->insert('bpjs_jknmobile_log', [
                    'url' => 'antrean/batal',
                    'header' => '',
                    'request' => json_encode($body),
                    'response' => json_encode($res),
                    'ws_bpjs_request' => '',
                    'ws_bpjs_response' => '',
                ]);
            }

            $this->session->set_flashdata('success', 'Data antrian berhasil dihapus!');
            redirect('AntrianPoli');
        } else {
            $this->session->set_flashdata('warning', 'Data antrian gagal dihapus!');
            redirect('AntrianPoli');
        }
    }
}