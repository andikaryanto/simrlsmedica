<?php

class AntrianFrontOffice extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('template');
        $this->load->model('MainModel');
    }

    public function index()
    {
        $today = date('Y-m-d');
        $data['list'] = $this->db->query("
            SELECT * FROM antrian_front_office 
            WHERE due_date = '$today'
            AND is_called = 0
        ")->result();

        $last = $this->db->query("
            SELECT * FROM antrian_front_office 
            WHERE due_date = '$today' 
            AND is_called = 1
            ORDER BY id DESC
        ")->row();

        $data['current_no'] = $last ? $last->no_antrian : '';
        $data['last_id'] = $last ? $last->id : '0';

        $this->template->view('antrian/front_office/list', $data);
    }

    public function panggil($id)
    {
        $this->MainModel->update('antrian_front_office', ['is_called' => 1], $id);
        return json_encode(['success' => true]);
    }

    public function ambil()
    {
        $today = date('Y-m-d');
        $last = $this->db->query("
            SELECT * FROM antrian_front_office 
            WHERE due_date = '$today' 
            ORDER BY id DESC
        ")->row();
        if ($last) {
            $last_no = (int) (preg_replace("/[^0-9]/", "", $last->no_antrian));
            $next_no_antrian = 'ADM-'.(1 + $last_no);
        }
        else {
            $next_no_antrian = 'ADM-1';
        }

        $this->db->insert('antrian_front_office', [
            'no_antrian' => $next_no_antrian,
            'due_date' => $today
        ]);

        $this->session->set_flashdata('success', 'Berhasil ambil antrian!');
        $this->session->set_flashdata('print', 'yes');
        $this->session->set_flashdata('nomor', $next_no_antrian);
        redirect('AntrianFrontOffice/index');
    }

    public function layani($id)
    {
        $this->db->where('id', $id)->update('antrian_front_office', ['mulai_layan_admisi_at' => date('Y-m-d H:i:s')]);

        if ($this->input->post('jns_pasien') == 1) { //baru
            redirect("Pendaftaran/pendaftaran_baru/$id");
        }
        else {
            $this->session->set_flashdata('id_pasien', $this->input->post('id_pasien'));
            redirect("Pendaftaran/Pendaftaran_lama2/$id");
        }
    }

    public function hapus($id)
    {
        $this->db->where('id', $id)->delete('antrian_front_office');
        $this->session->set_flashdata('success', 'Berhasil hapus antrian!');
        redirect('AntrianFrontOffice/index');
    }

    public function print($no)
    {
        $data['no'] = $no;
        $today = date('Y-m-d');
        $a = $this->db->query("
            SELECT * FROM antrian_front_office 
            WHERE due_date = '$today' 
            AND no_antrian = '$no'
        ")->row();

        $last = $this->db->query("
            SELECT * FROM antrian_front_office 
            WHERE due_date = '$today' 
            AND mulai_tunggu_poli_at IS NULL
            AND created_at <= '$a->created_at'
            ORDER BY id DESC
        ")->result();
        $data['sisa'] = count($last);
        $this->load->view('antrian/front_office/print', $data);
    }
}

