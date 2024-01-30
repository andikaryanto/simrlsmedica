<?php

/**
 *
 */
class BahanHabisPakai extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('template');
        $this->load->Model('MainModel');
        $this->load->Model('BahanHabisPakaiModel');
        $this->load->Model('GudangBahanModel');
    }

    public function stok() {
        if (isset($_POST['do_save']) && $_POST['do_save'] == 'abdush') {
            $session = $this->session->userdata('logged_in');

            if ($_POST['id'] == 0) {
                $bahan = array(
                    'nama' => $_POST['nama'],

                    'margin' => $_POST['margin'],
                    'harga_beli' => $_POST['harga_beli'],
                    'harga_jual' => $_POST['harga_jual'],
                    'harga_jual_bpjs' => $_POST['harga_jual_bpjs'],
                    'harga_jual_kecantikan' => $_POST['harga_jual_kecantikan'],
                    'is_umum' => $_POST['is_umum'] ? 1 : 0,
                    'is_bpjs' => $_POST['is_bpjs'] ? 1 : 0,
                    'is_kecantikan' => $_POST['is_kecantikan'] ? 1 : 0,

                    'jumlah' => $_POST['stok'],
                    'satuan' => $_POST['satuan'],
                    'kode_barang' => $_POST['kode_barang'],
                    'creator' => $session->id
                );
                $data = $this->MainModel->insert($tabel = 'bahan_habis_pakai', $bahan);
            } else {
                $bahan = array(
                    'nama' => $_POST['nama'],

                    'margin' => $_POST['margin'],
                    'harga_beli' => $_POST['harga_beli'],
                    'harga_jual' => $_POST['harga_jual'],
                    'harga_jual_bpjs' => $_POST['harga_jual_bpjs'],
                    'harga_jual_kecantikan' => $_POST['harga_jual_kecantikan'],
                    'is_umum' => $_POST['is_umum'] ? 1 : 0,
                    'is_bpjs' => $_POST['is_bpjs'] ? 1 : 0,
                    'is_kecantikan' => $_POST['is_kecantikan'] ? 1 : 0,

                    'jumlah' => $_POST['stok'],
                    'satuan' => $_POST['satuan'],
                    'kode_barang' => $_POST['kode_barang'],
                );
                $data = $this->MainModel->update($tabel = 'bahan_habis_pakai', $bahan, $_POST['id']);
            }

            if ($data) {
                $this->session->set_flashdata('success', 'Tambah bahan habis pakai berhasil!');
            } else {
                $this->session->set_flashdata('warning', 'Tambah bahan habis pakai gagal!');
            }

            redirect('BahanHabisPakai/stok', 'refresh');
        } else {
            $data['bahan'] = $this->db->get_where('bahan_habis_pakai', ['is_active' => 1])->result();
            $data['persen'] = $this->BahanHabisPakaiModel->getSettingpersen()->result();
            $this->template->view('master/habis_pakai/stok', $data);
        }
    }

    public function delete($id = false) {
        if ($id) {
            $data = $this->MainModel->delete($tabel = 'bahan_habis_pakai', ['is_active' => 0], $id);

            if ($data) {
                $this->session->set_flashdata('success', 'Hapus bahan habis pakai berhasil!');
            } else {
                $this->session->set_flashdata('warning', 'Hapus bahan habis pakai gagal!');
            }

            redirect('BahanHabisPakai/stok', 'refresh');
        } else {
            show_404();
        }
    }

    public function pembelian() {
        $data['pemebelian'] = $this->db->get_where('pembelian_bahan', ['is_active' => 1])->result();
        $this->template->view('master/habis_pakai/pembelian', $data);
    }

    public function settingPersenPembelian() {
        if ($this->input->post('submit') == 1) {

            $update = $this->MainModel->update(
                $tabel='prosentase_harga',
                ['prosentase' => $this->input->post('id-4')],
                4
            );
            $update &= $this->MainModel->update(
                $tabel='prosentase_harga',
                ['prosentase' => $this->input->post('id-5')],
                5
            );
            $update &= $this->MainModel->update(
                $tabel='prosentase_harga',
                ['prosentase' => $this->input->post('id-6')],
                6
            );

            if ($update) {
                $this->session->set_flashdata('success', 'Edit persen harga obat berhasil!');
            }
            else {
                $this->session->set_flashdata('warning', 'Edit persen harga obat gagal!');
            }
            redirect('BahanHabisPakai/pembelian', 'refresh');
        }
        else {
            $data['persen'] = $this->BahanHabisPakaiModel->getSettingpersen()->result();
            $this->template->view('master/habis_pakai/persen', $data);
        }
    }

    public function tambahPembelian() {
        if ($this->input->post('submit') == 1) {
            $session = $this->session->userdata('logged_in');
            $pembelian = array(
                'no_faktur' => $this->input->post('no_faktur'),
                'tgl_faktur' => $this->input->post('tgl_faktur'),
                'tgl_jatuh_tempo' => $this->input->post('tgl_jatuh_tempo'),
                'nama_distributor' => $this->input->post('nama_distributor'),
                'total' => $this->input->post('total'),
                'profit' => $this->db->get_where('prosentase_harga', ['id' => 2])->row()->prosentase,
                'pajak_ppn' => 10,
                'creator' => $session->id
            );

            $error = 0;

            $id_pembelian = $this->MainModel->insert_id($tabel = 'pembelian_bahan', $pembelian);
            if (!$id_pembelian) $error++;

            $data_obat = array();

            foreach ($this->input->post('obat') as $key => $value) {
                $riwayat = array(
                    'id_bahan' => $value['id_obat'],
                    'id_pembelian' => $id_pembelian,

                    'margin' => str_replace(',', '.', $value['margin'] ?? ''),
                    'harga_beli' => $value['harga_beli'],
                    'harga_jual' => $value['harga_jual'],
                    'harga_jual_bpjs' => $value['harga_jual_bpjs'],
                    'harga_jual_kecantikan' => $value['harga_jual_kecantikan'],
                    'is_umum' => $value['is_umum'] ? 1 : 0,
                    'is_bpjs' => $value['is_bpjs'] ? 1 : 0,
                    'is_kecantikan' => $value['is_kecantikan'] ? 1 : 0,

                    'jumlah' => $value['jumlah'],
                    'satuan' => $value['satuan']
                );

                $insert_riwata = $this->MainModel->insert_id($tabel = 'riwayat_pembelian_bahan', $riwayat);

                $data_obat[$insert_riwata] = $value;

                $id_item = $this->GudangBahanModel->updateDataObat($value['id_obat'], $value['jumlah'] * -1);

//                $this->GudangBahanModel->updateMutasi(
//                    $id_item,
//                    $value['jumlah'],
//                    'Gudang',
//                    'Pembelian ID: ' . $id_pembelian
//                );

                if (!$insert_riwata) $error++;
            }

            if ($error == 0) {
                $update_pembelian = $this->MainModel->update($tabel = 'pembelian_bahan', ['list_bahan' => serialize($data_obat)], $id_pembelian);
                if (!$update_pembelian) $error++;
            }

            if ($error == 0) {
                $this->session->set_flashdata('success', 'Tambah pembelian bahan habis pakai berhasil!');
                redirect('BahanHabisPakai/pembelian', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Tambah pembelian bahan habis pakai gagal!');
                redirect('BahanHabisPakai/tambahPembelian', 'refresh');
            }
        } else {
            $data['persen'] = $this->BahanHabisPakaiModel->getSettingpersen()->result();
            $data['bahan'] = $this->db->get_where('bahan_habis_pakai', ['is_active' => 1])->result();
            $data['is_edit'] = false;
            $this->template->view('master/habis_pakai/tambah_pembelian', $data);
        }
    }

    public function editPembelian($id_pembelian) {
        if ($this->input->post('submit') == 1) {
            $sesi = $this->session->userdata('logged_in');
            $id = $id_pembelian;
            $p = $this->db->get_where('pembelian_bahan', ['id' => $id_pembelian])->row();

            $old_obat = unserialize($p->list_bahan);
            $data_obat = array();
            $error = 0;

            foreach ($old_obat as $key => $value) {
                if (isset($_POST['obat']['row-' . $key])) {
                    unset($_POST['obat']['row-' . $key]);
                    $data_obat[$key] = $value;
                } else {
                    $id_item = $this->GudangBahanModel->updateStock($value['id_obat'], (0 - $value['jumlah']));

                    $this->GudangBahanModel->updateMutasi(
                        $id_item,
                        (0 - $value['jumlah']),
                        'Penyesuaian Data',
                        'Update pembelian ID: ' . $p->id
                    );

                    $this->db->delete('riwayat_pembelian_bahan', array('id' => $key));
                }
            }

            foreach ($_POST['obat'] as $key => $value) {
                $riwayat = array(
                    'id_bahan' => $value['id_obat'],
                    'id_pembelian' => $p->id,

                    'margin' => 0,
                    'harga_beli' => $value['harga_beli'],
                    'harga_jual' => $value['harga_jual'],
                    'harga_jual_bpjs' => $value['harga_jual_bpjs'],
                    'harga_jual_kecantikan' => $value['harga_jual_kecantikan'],
                    'is_umum' => $value['is_umum'] ? 1 : 0,
                    'is_bpjs' => $value['is_bpjs'] ? 1 : 0,
                    'is_kecantikan' => $value['is_kecantikan'] ? 1 : 0,

                    'jumlah' => $value['jumlah'],
                    'satuan' => $value['satuan']
                );

                $insert_riwata = $this->MainModel->insert_id($tabel = 'riwayat_pembelian_bahan', $riwayat);
                $data_obat[$insert_riwata] = $value;

                $id_item = $this->GudangBahanModel->updateStock($value['id_obat'], $value['jumlah']);

                $this->GudangBahanModel->updateMutasi(
                    $id_item,
                    $value['jumlah'],
                    'Gudang',
                    'Pembelian ID: ' . $p->id
                );

                if (!$insert_riwata) $error++;
            }

            if ($error == 0) {
                $pembelian = array(
                    'no_faktur' => $this->input->post('no_faktur'),
                    'tgl_faktur' => $this->input->post('tgl_faktur'),
                    'tgl_jatuh_tempo' => $this->input->post('tgl_jatuh_tempo'),
                    'nama_distributor' => $this->input->post('nama_distributor'),
                    'total' => $this->input->post('total'),
                    'list_bahan' => serialize($data_obat)
                );
                $update_pembelian = $this->MainModel->update($tabel = 'pembelian_bahan', $pembelian, $p->id);
                if (!$update_pembelian) $error++;
            }

            if ($error == 0) {
                $this->session->set_flashdata('success', 'Data bahan habis pakai berhasil update!');
            } else {
                $this->session->set_flashdata('warning', 'Data bahan habis pakai gagal update!');
            }

            redirect('BahanHabisPakai/pembelian');

        } else {
            $p = $this->db->get_where('pembelian_bahan', ['id' => $id_pembelian])->row();
            $data['pembelian'] = $p;
            $data['persen'] = $this->BahanHabisPakaiModel->getSettingpersen()->result();
            $data['bahan'] = $this->db->get_where('bahan_habis_pakai', ['is_active' => 1])->result();
            $data['is_edit'] = true;
            $this->template->view('master/habis_pakai/tambah_pembelian', $data);
        }
    }

    public function retur() {
        $data['retur'] = $this->db->get_where('retur_bahan', ['is_active' => 1])->result();
        $this->template->view('master/habis_pakai/retur', $data);
    }

    public function tambahRetur() {
        if ($this->input->post('submit') == 1) {
            $session = $this->session->userdata('logged_in');
            $pembelian = array(
                'no_faktur' => $this->input->post('no_faktur'),
                'tgl_faktur' => $this->input->post('tgl_faktur'),
                'tgl_jatuh_tempo' => $this->input->post('tgl_jatuh_tempo'),
                'nama_distributor' => $this->input->post('nama_distributor'),
                'total' => $this->input->post('total'),
                'profit' => $this->db->get_where('prosentase_harga', ['id' => 2])->row()->prosentase,
                'pajak_ppn' => 10,
                'creator' => $session->id
            );

            $error = 0;

            $id_retur = $this->MainModel->insert_id($tabel = 'retur_bahan', $pembelian);

            $data_obat = array();

            foreach ($this->input->post('obat') as $key => $value) {
                $riwayat = array(
                    'id_bahan' => $value['id_obat'],
                    'id_retur' => $id_retur,

                    'margin' => 0,
                    'harga_beli' => $value['harga_beli'],
                    'harga_jual' => $value['harga_jual'],
                    'harga_jual_bpjs' => $value['harga_jual_bpjs'],
                    'harga_jual_kecantikan' => $value['harga_jual_kecantikan'],
                    'is_umum' => $value['is_umum'] ? 1 : 0,
                    'is_bpjs' => $value['is_bpjs'] ? 1 : 0,
                    'is_kecantikan' => $value['is_kecantikan'] ? 1 : 0,

                    'jumlah' => $value['jumlah'],
                    'satuan' => $value['satuan']
                );

                $insert_riwata = $this->MainModel->insert_id($tabel = 'riwayat_retur_bahan', $riwayat);

                $data_obat[$insert_riwata] = $value;

                $id_item = $this->GudangBahanModel->updateDataObat($value['id_obat'], $value['jumlah']);

//                $this->GudangBahanModel->updateMutasi(
//                    $id_item,
//                    $value['jumlah'],
//                    'Gudang',
//                    'Pembelian ID: ' . $id_pembelian
//                );

                if (!$insert_riwata) $error++;
            }

            if ($error == 0) {
                $update_pembelian = $this->MainModel->update($tabel = 'retur_bahan', ['list_bahan' => serialize($data_obat)], $id_retur);
                if (!$update_pembelian) $error++;
            }

            if ($error == 0) {
                $this->session->set_flashdata('success', 'Tambah retur bahan habis pakai berhasil!');
                redirect('BahanHabisPakai/retur', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Tambah retur bahan habis pakai gagal!');
                redirect('BahanHabisPakai/tambahRetur', 'refresh');
            }
        } else {
            $data['persen'] = $this->BahanHabisPakaiModel->getSettingpersen()->result();
            $data['bahan'] = $this->db->get_where('bahan_habis_pakai', ['is_active' => 1])->result();
            $data['is_edit'] = false;
            $this->template->view('master/habis_pakai/tambah_retur', $data);
        }
    }

    public function editRetur($id_pembelian) {
        if ($this->input->post('submit') == 1) {
            $sesi = $this->session->userdata('logged_in');
            $id = $id_pembelian;
            $p = $this->db->get_where('retur_bahan', ['id' => $id_pembelian])->row();

            $old_obat = unserialize($p->list_bahan);
            $data_obat = array();
            $error = 0;

            foreach ($old_obat as $key => $value) {
                if (isset($_POST['obat']['row-' . $key])) {
                    unset($_POST['obat']['row-' . $key]);
                    $data_obat[$key] = $value;
                } else {
                    $id_item = $this->GudangBahanModel->updateDataObat($value['id_obat'], $value['jumlah'] * -1);

//                    $this->GudangBahanModel->updateMutasi(
//                        $id_item,
//                        (0 - $value['jumlah']),
//                        'Penyesuaian Data',
//                        'Update pembelian ID: ' . $p->id
//                    );

                    $this->db->delete('riwayat_pembelian_bahan', array('id' => $key));
                }
            }

            foreach ($_POST['obat'] as $key => $value) {
                $riwayat = array(
                    'id_bahan' => $value['id_obat'],
                    'id_retur' => $p->id,

                    'margin' => 0,
                    'harga_beli' => $value['harga_beli'],
                    'harga_jual' => $value['harga_jual'],
                    'harga_jual_bpjs' => $value['harga_jual_bpjs'],
                    'harga_jual_kecantikan' => $value['harga_jual_kecantikan'],
                    'is_umum' => $value['is_umum'] ? 1 : 0,
                    'is_bpjs' => $value['is_bpjs'] ? 1 : 0,
                    'is_kecantikan' => $value['is_kecantikan'] ? 1 : 0,

                    'jumlah' => $value['jumlah'],
                    'satuan' => $value['satuan']
                );

                $insert_riwata = $this->MainModel->insert_id($tabel = 'riwayat_retur_bahan', $riwayat);
                $data_obat[$insert_riwata] = $value;

                $id_item = $this->GudangBahanModel->updateDataObat($value['id_obat'], $value['jumlah']);

//                $this->GudangBahanModel->updateMutasi(
//                    $id_item,
//                    $value['jumlah'],
//                    'Gudang',
//                    'Pembelian ID: ' . $p->id
//                );

                if (!$insert_riwata) $error++;
            }

            if ($error == 0) {
                $pembelian = array(
                    'no_faktur' => $this->input->post('no_faktur'),
                    'tgl_faktur' => $this->input->post('tgl_faktur'),
                    'tgl_jatuh_tempo' => $this->input->post('tgl_jatuh_tempo'),
                    'nama_distributor' => $this->input->post('nama_distributor'),
                    'total' => $this->input->post('total'),
                    'list_bahan' => serialize($data_obat)
                );
                $update_pembelian = $this->MainModel->update($tabel = 'retur_bahan', $pembelian, $p->id);
                if (!$update_pembelian) $error++;
            }

            if ($error == 0) {
                $this->session->set_flashdata('success', 'Data bahan habis pakai berhasil update!');
            } else {
                $this->session->set_flashdata('warning', 'Data bahan habis pakai gagal update!');
            }

            redirect('BahanHabisPakai/retur');

        } else {
            $p = $this->db->get_where('retur_bahan', ['id' => $id_pembelian])->row();
            $data['pembelian'] = $p;
            $data['persen'] = $this->BahanHabisPakaiModel->getSettingpersen()->result();
            $data['bahan'] = $this->db->get_where('bahan_habis_pakai', ['is_active' => 1])->result();
            $data['is_edit'] = true;
            $this->template->view('master/habis_pakai/tambah_retur', $data);
        }
    }

    public function gudang() {
        $data['bahan'] = $this->GudangBahanModel->getObat();

        $this->template->view('master/habis_pakai/gudang', $data);
    }

    public function mutasi() {
        $data['mutasi'] = $this->GudangBahanModel->getMutasi();
//        echo json_encode($data['mutasi']);die();

        $this->template->view('master/habis_pakai/mutasi', $data);
    }

    public function tambahMutasi() {
        if ($this->input->post('submit') == 1) {

            foreach ($_POST['item'] as $key => $value) {
                $stock = 0 - $value['jumlah'];
                $this->GudangBahanModel->updateMutasi(
                    $key,
                    $stock,
                    $_POST['tujuan'],
                    $_POST['note'],
                    $_POST['tanggal'] . ' ' . $_POST['pukul']
                );

                $this->GudangBahanModel->updateStockByID($key, $stock);
            }

            $this->session->set_flashdata('success', 'Tambah mutasi bahan habis pakai berhasil!');
            redirect('BahanHabisPakai/mutasi', 'refresh');

        } else {
            $data['bahan'] = $this->db->get_where('bahan_habis_pakai', ['is_active' => 1])->result();
            $this->template->view('master/habis_pakai/tambah_mutasi', $data);
        }
    }

    public function getDataBahanDiGudang() {
        header('Content-Type: application/json');
        $data = $this->GudangBahanModel->getObatOnGudang($_POST['id']);
        echo json_encode($data);
    }

    public function ajax_create() {
        try {
            $bahan = array(
                'nama' => $_POST['nama'],
                'kode_barang' => $_POST['kode_barang'],
                'satuan' => $_POST['satuan'],
                'jumlah' => $_POST['stok'],
                'creator' => 1
            );
            $id = $this->MainModel->insert_id($tabel = 'bahan_habis_pakai', $bahan);

            echo json_encode([
                'success' => true,
                'data' => $this->db->get_where('bahan_habis_pakai', ['id' => $id])->row()
            ]);
        }
        catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function ajax_create_obat() {
        try {
            $bahan = array(
                'nama' => $_POST['nama'],
                'kode_barang' => $_POST['kode_barang'],
                'stok_obat' => $_POST['stok'],
                'kategori' => $_POST['kategori'],
                'creator' => 1
            );
            $id = $this->MainModel->insert_id($tabel = 'obat', $bahan);

            echo json_encode([
                'success' => true,
                'data' => $this->db->get_where('obat', ['id' => $id])->row()
            ]);
        }
        catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function ajax_create_barang_lain() {
        try {
            $bahan = array(
                'nama' => $_POST['nama'],
                'kode_barang' => $_POST['kode_barang'],
                'jumlah' => $_POST['stok'],
                'satuan' => $_POST['satuan'],
                'creator' => 1
            );
            $id = $this->MainModel->insert_id($tabel = 'barang_lain', $bahan);

            echo json_encode([
                'success' => true,
                'data' => $this->db->get_where('barang_lain', ['id' => $id])->row()
            ]);
        }
        catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function input()
    {
        $data['input'] = $this->db->query("
            SELECT input_bahan.*, bhp.nama, input_bahan.id FROM input_bahan
            JOIN bahan_habis_pakai bhp on input_bahan.bahan_id = bhp.id
            ORDER BY input_bahan.created_at DESC 
        ")->result();

        $this->template->view('master/habis_pakai/input', $data);
    }

    public function tambahInput()
    {
        if ($this->input->post()) {
            $bahan_id = $this->input->post('bahan_id');
            $b = $this->db->query("SELECT * FROM bahan_habis_pakai WHERE id = $bahan_id")->row();
            if ($this->input->post('jumlah') > $b->jumlah) {
                $this->session->set_flashdata('warning', 'Jumlah melebihi stok bahan');
                return redirect('BahanHabisPakai/tambahInput', 'refresh');
            }

            $this->MainModel->insert('input_bahan', [
                'bahan_id' => $bahan_id,
                'tgl_digunakan' => $this->input->post('tgl_digunakan'),
                'jumlah' => $this->input->post('jumlah'),
                'satuan' => $this->input->post('satuan'),
            ]);

            $this->db->where('id', $bahan_id)->update('bahan_habis_pakai', ['jumlah' => $b->jumlah - $this->input->post('jumlah')]);
            $this->session->set_flashdata('success', 'Input bahan habis pakai berhasil!');
            redirect('BahanHabisPakai/input', 'refresh');
        }
        else {
            $data['bahan'] = $this->db->query("SELECT * FROM bahan_habis_pakai WHERE is_active = 1 AND jumlah > 0")->result();
            $this->template->view('master/habis_pakai/tambahInput', $data);
        }
    }

    public function editInput($id)
    {
        if ($this->input->post()) {
            $bahan_id = $this->input->post('bahan_id');
            $b = $this->db->query("SELECT * FROM bahan_habis_pakai WHERE id = $bahan_id")->row();
            if ($this->input->post('jumlah') > $b->jumlah) {
                $this->session->set_flashdata('warning', 'Jumlah melebihi stok bahan');
                return redirect('BahanHabisPakai/editInput/'.$id, 'refresh');
            }

            $prev = $this->db->query("SELECT * FROM input_bahan WHERE id = $id")->row();
            $prev_b = $this->db->query("SELECT * FROM bahan_habis_pakai WHERE id = $prev->bahan_id")->row();
            $this->MainModel->update('bahan_habis_pakai', ['jumlah' => $prev_b->jumlah + $prev->jumlah], $prev->bahan_id);

            $this->MainModel->update('input_bahan', [
                'bahan_id' => $bahan_id,
                'tgl_digunakan' => $this->input->post('tgl_digunakan'),
                'jumlah' => $this->input->post('jumlah'),
                'satuan' => $this->input->post('satuan'),
            ], $id);

            $this->db->where('id', $bahan_id)->update('bahan_habis_pakai', ['jumlah' => $b->jumlah - $this->input->post('jumlah')]);
            $this->session->set_flashdata('success', 'Input bahan habis pakai berhasil!');
            redirect('BahanHabisPakai/input', 'refresh');
        }
        else {
            $data['input'] = $this->db->query("SELECT * FROM input_bahan WHERE id = $id")->row();
            $data['bahan'] = $this->db->query("SELECT * FROM bahan_habis_pakai WHERE is_active = 1 AND jumlah > 0")->result();
            $this->template->view('master/habis_pakai/editInput', $data);
        }
    }

    public function deleteInput($id)
    {
        $prev = $this->db->query("SELECT * FROM input_bahan WHERE id = $id")->row();
        $b = $this->db->query("SELECT * FROM bahan_habis_pakai WHERE id = $prev->bahan_id")->row();
        $this->MainModel->update('bahan_habis_pakai', ['jumlah' => $b->jumlah + $prev->jumlah], $prev->bahan_id);
        $this->db->where('id', $id)->delete('input_bahan');

        $this->session->set_flashdata('success', 'Hapus input bahan habis pakai berhasil!');
        redirect('BahanHabisPakai/input', 'refresh');
    }
}