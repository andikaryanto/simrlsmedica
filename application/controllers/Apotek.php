<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Apotek extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('template');
        $this->load->Model('ObatModel');
        $this->load->Model('MainModel');
        $this->load->Model('PembelianObatModel');
        $this->load->Model('PemeriksaanModel');
        $this->load->Model('AdministrasiModel');
        $this->load->Model('ObatRacikanModel');
        $this->load->Model('GudangObatModel');
        $this->load->Model('ObatLuarModel');
        $this->load->Model('BahanHabisPakaiModel');
        $this->load->Model('DetailObatPemeriksaanModel');
        $this->load->Model('DetailObatRacikanPemeriksaanModel');
        $this->load->Model('DetailBahanPemeriksaanModel');
        $this->load->Model('JenisLayananLaboratoirumModel');
//        $this->load->model('RawatInapModel');
//        $this->load->model('RuangOperasiModel');
//        $this->load->model('RuangBersalinModel');
//        $this->load->model('TransferPasienModel');
        $this->load->helper(array('file', 'php_with_mpdf_helper'));
        $this->load->helper(array('file', 'mpdf'));
    }

    public function list_input_resep()
    {
        $data['listPendaftaran'] = $this->PemeriksaanModel->getListInputResep()->result();
        $data['jaminan'] =$this->config->item('pendaftaran');

        $this->template->view('master/apotek/list_input_resep',$data);
    }

    public function list_resep_ranap()
    {
        $data['list'] = $this->RawatInapModel->getBaru();
        $this->template->view('master/apotek/list_resep_ranap',$data);
    }

    public function list_resep_ok()
    {
        $data['list'] = $this->RuangOperasiModel->getBaru();
        $this->template->view('master/apotek/list_resep_ok',$data);
    }

    public function list_resep_vk()
    {
        $data['list'] = $this->RuangBersalinModel->getBaru();
        $this->template->view('master/apotek/list_resep_vk',$data);
    }

    public function list_resep_transfer($current_place_type)
    {
        $data['current_place_type'] = $current_place_type;
        $what = $current_place_type == 'OK' ? 'ruang operasi' : ($current_place_type == 'VK' ? 'ruang bersalin' : $current_place_type);
        $data['list'] = $this->RawatInapModel->getBaruOfTransfer(strtolower($what));
        $this->template->view('master/apotek/list_resep_transfer', $data);
    }

    public function detail_resep_ranap($jenis, $rawat_inap_id, $transfer_id = '')
    {
        $data['obat1'] = $this->db->get_where('obat', ['is_active' => 1, 'stok_obat >' => 0])->result();
        $data['jenis'] = $jenis;
        $data['rawat_inap_id'] = $rawat_inap_id;
        $data['transfer_id'] = $transfer_id;

        if ($jenis == 'ranap') {
            $data['resep'] = $this->RawatInapModel->getResepByRawatInapId($rawat_inap_id);
        }
        else {
            $jenis_ruangan_id = $jenis == 'VK' ? 2 : ($jenis == 'OK' ? 3 : 0);
            if ($jenis_ruangan_id == 0) {
                $jenis_ruangan_id = $this->TransferPasienModel->getJenisRuanganByNama($jenis)->id;
            }
            $data['resep'] = $this->RuangBersalinModel->getResepByTransferId($transfer_id, $jenis_ruangan_id);
        }

        foreach ($data['resep'] as &$d) {
            $d->obat = $this->RawatInapModel->getObatByResepId($d->id);
            $d->obat_racik = $this->RawatInapModel->getObatRacikByResepId($d->id);
            foreach ($d->obat_racik as &$dd) {
                $dd->detail = $this->RawatInapModel->getObatRacikDetailByResepObatRacikId($dd->id);
                $dd->total = 0;
                foreach ($dd->detail as $ddd) {
                    $dd->total += $ddd->jumlah * $ddd->harga_jual;
                }
            }
        }

        $this->template->view('master/apotek/detail_resep_ranap',$data);
    }

    public function tambah_obat()
    {
        $ri_resep_id = $this->input->post('ri_resep_id');
        $jumlah_satuan = $this->input->post('jumlah_satuan');
        $signa_obat = $this->input->post('signa_obat');
        $input_obat = $this->input->post('nama_obat');
        $i = 0;
        foreach ($input_obat as $key => $value) {
            if ($value != "") {
                $obat = array(
                    'ri_resep_id' => $ri_resep_id,
                    'obat_id' => $value,
                    'jumlah' => $jumlah_satuan[$i],
                    'signa' => $signa_obat[$i],
                );
                $this->MainModel->insert_id('ri_resep_obat', $obat);
                $obat = $this->ObatModel->getObatById($value)->row();
                $stok = array('stok_obat' => ($obat->stok_obat) - $jumlah_satuan[$i]);
                $this->MainModel->update('obat', $stok, $value);
            }
            $i++;
        }

        $this->session->set_flashdata('success', 'Tambah obat berhasil!');
        redirect($this->input->post('current_url'));
    }

    public function hapus_obat()
    {
        $ri_resep_obat_id = $this->input->post('ri_resep_obat_id');
        $obat_id = $this->input->post('obat_id');

        $jumlah = $this->MainModel->select('ri_resep_obat', ['id', $ri_resep_obat_id])->row()->jumlah;
        $obat = $this->ObatModel->getObatById($obat_id)->row();
        $stok = array('stok_obat' => ($obat->stok_obat) + $jumlah);
        $this->MainModel->update('obat', $stok, $obat_id);

        $this->MainModel->hardDelete('ri_resep_obat', $ri_resep_obat_id);

        $this->session->set_flashdata('success', 'Hapus obat berhasil!');
        redirect($this->input->post('current_url'));
    }

    public function hapus_resep()
    {
        $ri_resep_id = $this->input->post('ri_resep_id');
        $ri_resep_obats = $this->MainModel->select('ri_resep_obat', ['ri_resep_id', $ri_resep_id])->result();

        foreach ($ri_resep_obats as $ri_resep_obat) {
            $jumlah = $ri_resep_obat->jumlah;
            $obat = $this->ObatModel->getObatById($ri_resep_obat->obat_id)->row();
            $stok = array('stok_obat' => ($obat->stok_obat) + $jumlah);
            $this->MainModel->update('obat', $stok, $ri_resep_obat->obat_id);

            $this->MainModel->hardDelete('ri_resep_obat', $ri_resep_obat->id);
        }

        $this->MainModel->hardDelete('ri_resep', $ri_resep_id);

        $this->session->set_flashdata('success', 'Hapus resep berhasil!');
        redirect($this->input->post('current_url'));
    }

    public function input_resep($id = '')
    {
        $session = $this->session->userdata('logged_in');

        if ($this->input->post('submit') == 1) {
            $jumlah_satuan = $this->input->post('jumlah_satuan');
            $signa_obat = $this->input->post('signa_obat');
            $input_obat = $this->input->post('nama_obat');
            $i = 0;
            foreach ($input_obat as $key => $value) {
                $obat = array(
                    'pemeriksaan_id' => $id,
                    'obat_id' => $value,
                    'jumlah_satuan' => $jumlah_satuan[$i],
                    'signa_obat' => $signa_obat[$i],
                    'creator' => $session->id
                );

                if ($obat['obat_id'] != "") {
                    $this->MainModel->insert_id('detail_obat_pemeriksaan', $obat);
                    $obat = $this->ObatModel->getObatById($value)->row();
                    $stok = array('stok_obat' => ($obat->stok_obat) - $jumlah_satuan[$i]);
//                    $this->MainModel->update('obat', $stok, $value); // OBAT TIDAK BERKURANG KETIKA DOKTER SUBMIT
                }

                $i++;
            }

            for ($n = 1; $n <= 9; $n++) {
                $signa = $this->input->post('signa' . $n);
                $catatan = $this->input->post('catatan' . $n);
                $racikan = array(
                    'pemeriksaan_id' => $id,
                    'nama_racikan' => 'racikan ' . $n,
                    'signa' => $signa,
                    'catatan' => $catatan,
                    'creator' => $session->id
                );
                $jumlah_satuan = $this->input->post('jumlah_satuan_racikan' . $n);

                if ($signa != "") {
                    $j = 0;
                    $detail_obat_racikan_pemeriksaan_id = $this->MainModel->insert_id('detail_obat_racikan_pemeriksaan', $racikan);
                    $input_obat = $this->input->post('nama_obat_racikan'.$n);

                    foreach ($input_obat as $key => $value) {
                        if ($value != '') {
                            $obat_racikan = array(
                                'detail_obat_racikan_pemeriksaan_id' => $detail_obat_racikan_pemeriksaan_id,
                                'obat_id' => $value,
                                'jumlah_satuan' => $jumlah_satuan[$j],
                                'creator' => $session->id
                            );

                            $this->MainModel->insert('obat_racikan', $obat_racikan);
                            $obat = $this->ObatModel->getObatById($value)->row();
                            $stok = array('stok_obat' => ($obat->stok_obat) - $jumlah_satuan[$j]);
//                            $this->MainModel->update('obat', $stok, $value); // OBAT TIDAK BERKURANG KETIKA DOKTER SUBMIT
                        }

                        $j++;
                    }
                }
            }

            $this->MainModel->update('pemeriksaan', ['sudah_obat'=>1, 'jasa_racik'=>$this->input->post('jasa_racik')], $id);
            $this->session->set_flashdata('success', 'Input obat berhasil!');
            redirect('apotek/list_input_resep');
        }
        else {
            $data['pendaftaran'] = $this->PemeriksaanModel->getPendaftaranByIdPemeriksaan($id)->row_array();
            $data['pemeriksaan'] = $this->PemeriksaanModel->getPemeriksaanById($id)->row_array();
            $data['jaminan'] = $this->config->item('pendaftaran');

            $data['obat'] = $this->PemeriksaanModel->getObat();
            $data['obat1'] = $this->db->get_where('obat', ['is_active' => 1, 'stok_obat >' => 0])->result();

            $this->template->view('master/apotek/input_resep', $data);
        }
    }

    public function input_resep_ranap($jenis, $rawat_inap_id, $transfer_id = '')
    {
        if ($this->input->post('insert') == 1) {
            $transfer_id = $transfer_id ? $transfer_id : $this->RawatInapModel->getById($rawat_inap_id)->transfer_id;
            $jenis_ruangan_id = $jenis == 'ranap' ? 1 : ($jenis == 'OK' ? 3 : ($jenis == 'VK' ? 2 : 0));

            if ($jenis_ruangan_id == 0) {
                $jenis_ruangan_id = $this->TransferPasienModel->getJenisRuanganByNama($jenis)->id;
            }

            $ri_resep_id = $this->MainModel->insert_id('ri_resep', [
                'rawat_inap_id' => $rawat_inap_id,
                'transfer_id' => $transfer_id,
                'jenis_ruangan_id' => $jenis_ruangan_id,
                'jasa_racik' => $this->input->post('jasa_racik')
            ]);

            $jumlah_satuan = $this->input->post('jumlah_satuan');
            $signa_obat = $this->input->post('signa_obat');
            $input_obat = $this->input->post('nama_obat');
            $i = 0;
            foreach ($input_obat as $key => $value) {
                if ($value != "") {
                    $obat = array(
                        'ri_resep_id' => $ri_resep_id,
                        'obat_id' => $value,
                        'jumlah' => $jumlah_satuan[$i],
                        'signa' => $signa_obat[$i],
                    );
                    $this->MainModel->insert_id('ri_resep_obat', $obat);
                    $obat = $this->ObatModel->getObatById($value)->row();
                    $stok = array('stok_obat' => ($obat->stok_obat) - $jumlah_satuan[$i]);
                    $this->MainModel->update('obat', $stok, $value);
                }
                $i++;
            }

            for ($n = 1; $n <= 9; $n++) {
                $signa = $this->input->post('signa' . $n);
                $catatan = $this->input->post('catatan' . $n);
                $racikan = array(
                    'ri_resep_id' => $ri_resep_id,
                    'nama_racikan' => 'racikan ' . $n,
                    'signa' => $signa,
                    'catatan' => $catatan,
                );
                $jumlah_satuan = $this->input->post('jumlah_satuan_racikan' . $n);

                if ($signa != "") {
                    $j = 0;
                    $ri_resep_obat_racik_id = $this->MainModel->insert_id('ri_resep_obat_racik', $racikan);
                    $input_obat = $this->input->post('nama_obat_racikan'.$n);

                    foreach ($input_obat as $key => $value) {
                        if ($value != '') {
                            $obat_racikan = array(
                                'ri_resep_obat_racik_id' => $ri_resep_obat_racik_id,
                                'obat_id' => $value,
                                'jumlah' => $jumlah_satuan[$j],
                            );

                            $this->MainModel->insert('ri_resep_obat_racik_detail', $obat_racikan);
                            $obat = $this->ObatModel->getObatById($value)->row();
                            $stok = array('stok_obat' => ($obat->stok_obat) - $jumlah_satuan[$j]);
                            $this->MainModel->update('obat', $stok, $value);
                        }
                        $j++;
                    }
                }
            }

            $this->session->set_flashdata('success', 'Input obat berhasil!');
            if ($jenis == 'ranap') {
                redirect('apotek/list_resep_ranap');
            }
            else {
                redirect('apotek/list_resep_transfer/'.$jenis);
            }
        }
        else {
            $data['rawat_inap'] = $this->RawatInapModel->getById($rawat_inap_id);
            $data['pasien'] = $this->RawatInapModel->getPasienById($data['rawat_inap']->pasien_id);
            $data['obat'] = $this->PemeriksaanModel->getObat();
            $data['obat1'] = $this->db->get_where('obat', ['is_active' => 1, 'stok_obat >' => 0])->result();
            $data['jenis'] = $jenis;
            $data['transfer_id'] = $transfer_id;
            $data['jenis_title'] = $jenis == 'ranap' ? 'Ranap' : ($jenis == 'ok' ? 'OK' : ($jenis == 'vk' ? 'VK' : '-'));
            $data['redirect'] = $jenis == 'ranap' ?
                "apotek/input_resep_ranap/{$jenis}/{$rawat_inap_id}" :
                "apotek/input_resep_ranap/{$jenis}/{$rawat_inap_id}/{$transfer_id}";

            $this->template->view('master/apotek/input_resep_ranap', $data);
        }
    }

    //---------------- GUDANG --------------

    public function gudang()
    {
        $data['obat_ok'] = $this->GudangObatModel->getObat();
        $data['obat_kedaluarsa'] = $this->GudangObatModel->getObat(false);

        $this->template->view('master/apotek/gudang',$data);
    }

    //---------------- MUTASI --------------

    public function mutasi()
    {
        $data['mutasi'] = $this->GudangObatModel->getMutasi();

        $this->template->view('master/apotek/mutasi',$data);
    }

    public function tambahMutasiObat()
    {
        if ($this->input->post('submit') == 1){

            foreach ($_POST['item'] as $key => $value) {
                $stock = 0 - $value['jumlah'];
                $this->GudangObatModel->updateMutasi(
                    $key,
                    $stock,
                    $_POST['tujuan'],
                    $_POST['note'],
                    $_POST['tanggal'].' '.$_POST['pukul']
                );

                $this->GudangObatModel->updateStockByID($key, $stock);
            }

            $this->session->set_flashdata('success', 'Tambah mutasi obat berhasil!');
            redirect('Apotek/mutasi','refresh');

        }
        else{
            $data['obat'] = $this->ObatModel->listObat();
            $this->template->view('master/apotek/tambah_mutasi',$data);
        }
    }

    public function getDataObatDiGudang(){
        header('Content-Type: application/json');
        $data = $this->GudangObatModel->getObatOnGudang($_POST['id']);
        echo json_encode( $data );
    }

    //---------------- OBAT ----------------

    public function stokObat() {
        $data['listObat'] = $this->ObatModel->listObat();

        $this->template->view('master/apotek/stok_obat',$data);
    }

    public function tambahObat() {
        if ($this->input->post('submit') == 1) {
            $session = $this->session->userdata('logged_in');
            $obat = array(
                'no_urut'             => 0,
                'kode_barang'         => $this->input->post('kode_barang'),
                'nama'                => $this->input->post('nama'),
                'jenis'               => '',
                'kategori'            => $this->input->post('kategori'),
                'nomor_batch'         => $this->input->post('nomor_batch'),
                'tanggal_kadaluwarsa' => $this->input->post('tanggal_kadaluwarsa'),
                'distributor'         => $this->input->post('distributor'),

                'harga_beli'          => $this->input->post('harga_beli'),
                'margin'              => str_replace(',', '.', $this->input->post('margin') ?? ''),
                'harga_jual'          => $this->input->post('harga_jual'),
                'harga_jual_bpjs'     => $this->input->post('harga_jual_bpjs') ?? 0,
                'harga_jual_kecantikan' => $this->input->post('harga_jual_kecantikan') ?? 0,

                'is_umum'             => 1,
                'is_bpjs'             => $this->input->post('is_bpjs') ? 1 : 0,
                'is_kecantikan'       => $this->input->post('is_kecantikan') ? 1 : 0,

                'stok_obat'           => $this->input->post('stok_obat'),
                'creator'             => $session->id
            );

            $insert = $this->MainModel->insert($tabel='obat',$obat);

            if($insert){
                $this->session->set_flashdata('success', 'Tambah obat berhasil!');
                redirect('Apotek/stokObat','refresh');
            }
            else{
                $this->session->set_flashdata('warning', 'Tambah obat gagal!');
                redirect('Apotek/tambahObat','refresh');
            }
        }
        else {
            $data['persen'] = $this->ObatModel->getSettingpersen()->result();
            $this->template->view('master/apotek/tambah_obat',$data);
        }
    }

    public function editObat($id) {

        $data['persen'] = $this->ObatModel->getSettingpersen()->result();
        $data['obat'] = $this->ObatModel->getObatById($id)->row();

        $this->template->view('master/apotek/edit_obat',$data);
    }

    public function simpanUpdate() {
        $sesi = $this->session->userdata('logged_in');
        $id = $this->input->post('id');
        $obat = array(
            'no_urut'             => 0,
            'kode_barang'         => $this->input->post('kode_barang'),
            'nama'                => $this->input->post('nama'),
            'jenis'               => '',
            'kategori'            => $this->input->post('kategori'),
            'nomor_batch'         => $this->input->post('nomor_batch'),
            'tanggal_kadaluwarsa' => $this->input->post('tanggal_kadaluwarsa'),
            'distributor'         => $this->input->post('distributor'),

            'harga_beli'          => $this->input->post('harga_beli'),
            'margin'              => 0,
            'harga_jual'          => $this->input->post('harga_jual'),
            'harga_jual_bpjs'     => $this->input->post('harga_jual_bpjs'),
            'harga_jual_kecantikan' => $this->input->post('harga_jual_kecantikan'),

            'is_umum'             => $this->input->post('is_umum') ? 1 : 0,
            'is_bpjs'             => $this->input->post('is_bpjs') ? 1 : 0,
            'is_kecantikan'       => $this->input->post('is_kecantikan') ? 1 : 0,

            'stok_obat'           => $this->input->post('stok_obat'),
            'creator'             => $sesi->id
        );
        $a = $this->MainModel->update($tabel='obat', $obat,$id);

        if ($a) {
            $this->session->set_flashdata('success', 'Data Obat berhasil update!');
            redirect('Apotek/stokObat');
        }

        $this->session->set_flashdata('warning', 'Data Obat gagal update!');
        redirect('Apotek/stokObat');

    }

    public function deleteObat($id) {

        $data = array('is_active' => '0' );
        $delete = $this->MainModel->delete($table='obat',$data,$id);
        if($delete){
            $this->session->set_flashdata('success', 'Data Obat berhasil dihapus!');
            redirect('Apotek/stokObat');
        }
        $this->session->set_flashdata('warning', 'Data Obat gagal dihapus!');
        redirect('Apotek/stokObat');

    }

    public function settingPersen() {
        if ($this->input->post('submit') == 1) {
            $id =$this->input->post('id');
            $session = $this->session->userdata('logged_in');
            $persen = array(
                'prosentase' => $this->input->post('prosentase')

            );

            $update = $this->MainModel->update($tabel='prosentase_harga',$persen,$id);

            if($update) {
                $this->session->set_flashdata('success', 'Edit persen harga obat berhasil!');
                redirect('Apotek/stokObat','refresh');
            }
            else {
                $this->session->set_flashdata('warning', 'Edit persen harga obat gagal!');
                redirect('Apotek/stokObat','refresh');
            }
        }
        else {
            $data['persen'] = $this->ObatModel->getSettingpersen()->row();
            $this->template->view('master/apotek/persen_obat',$data);
        }
    }

    //---------------- END OBAT ----------------

    //---------------- PEMBELIAN ----------------

    public function pembelian() {
        $start_date = $this->input->get('from');
        $end_date = $this->input->get('to');
        $periode = ($start_date && $end_date) ? ['start' => $start_date, 'end' => $end_date] : '';

        $data['pembelian'] = $this->PembelianObatModel->getPembelianObat($periode)->result();

        $this->template->view('master/apotek/pembelian',$data);
    }

    public function tambahPembelianObat() {
        if ($this->input->post('submit') == 1) {
            $session = $this->session->userdata('logged_in');
            $pembelian = array(
                'no_faktur'         => $this->input->post('no_faktur'),
                'tgl_faktur'        => $this->input->post('tgl_faktur'),
                'tgl_jatuh_tempo'   => $this->input->post('tgl_jatuh_tempo'),
                'nama_distributor'  => $this->input->post('nama_distributor'),
                'total'             => $this->input->post('total'),
                'profit'            => $this->ObatModel->getSettingpersen()->row()->prosentase,
                'pajak_ppn'         => 10,
                'creator'           => $session->id
            );

            $error = 0;

            $id_pembelian = $this->MainModel->insert_id($tabel='pembelian_obat',$pembelian);
            if( !$id_pembelian ) $error++;

            $data_obat = array();

            foreach ($this->input->post('obat') as $key => $value) {
                $riwayat= array(
                    'id_obat' => $value['id_obat'],
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

                $insert_riwata = $this->MainModel->insert_id($tabel='riwayat_pembelian_obat',$riwayat);
                $data_obat[$insert_riwata]= $value;

                $id_item = $this->GudangObatModel->updateDataObat($value['id_obat'], $value['jumlah'] * -1); //dikali -1 karena di functionnya udah gitu

//                $this->GudangObatModel->updateMutasi(
//                    $id_item,
//                    $value['jumlah'],
//                    'Gudang',
//                    'Pembelian ID: '. $id_pembelian
//                );

                if( !$insert_riwata ) $error++;
            }

            if ($error == 0) {
                $update_pembelian = $this->MainModel->update($tabel='pembelian_obat',[ 'list_obat' => serialize($data_obat) ], $id_pembelian);
                if( !$update_pembelian ) $error++;
            }

            if($error == 0){
                $this->session->set_flashdata('success', 'Tambah pembelian obat berhasil!');
                redirect('Apotek/pembelian','refresh');
            }
            else{
                $this->session->set_flashdata('warning', 'Tambah pembelian obat gagal!');
                redirect('Apotek/pembelian','refresh');
            }

        }
        else {
            $data['persen'] = $this->ObatModel->getSettingpersen()->row();
            $data['obat'] = $this->ObatModel->listObat();
            $data['is_edit'] = false;
            $this->template->view('master/apotek/tambah_pembelian_obat', $data);
        }
    }

    public function editPembelianObat() {

        $id_pembelian = $this->uri->segment(3);

        if ($this->input->post('submit') == 1) {
            $sesi = $this->session->userdata('logged_in');
            $id = $this->input->post('id');
            $p = $this->PembelianObatModel->getPembelianObatyId($_POST['id_transaksi'])->row();

            $old_obat = unserialize($p->list_obat);
            $data_obat = array();
            $error = 0;

            foreach ( $old_obat as $key => $value) {
                if (isset( $_POST['obat']['row-'.$key] )) {
                    unset($_POST['obat']['row-'.$key]);
                    $data_obat[$key] = $value;
                }
                else {
                    $id_item = $this->GudangObatModel->updateStock($value['id_obat'], $value['tgl_kadaluwarsa'], (0 - $value['jumlah']));

                    $this->GudangObatModel->updateMutasi(
                        $id_item,
                        (0 - $value['jumlah']),
                        'Penyesuaian Data',
                        'Update pembelian ID: '. $p->id
                    );

                    $this->db->delete('riwayat_pembelian_obat', array('id' => $key));
                }
            }

            foreach ($_POST['obat'] as $key => $value) {
                $riwayat= array(
                    'id_obat' => $value['id_obat'],
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

                $insert_riwata = $this->MainModel->insert_id($tabel='riwayat_pembelian_obat',$riwayat);
                $data_obat[$insert_riwata]= $value;

                $id_item = $this->GudangObatModel->updateStock($value['id_obat'], $value['tgl_kadaluwarsa'], $value['jumlah']);

                $this->GudangObatModel->updateMutasi(
                    $id_item,
                    $value['jumlah'],
                    'Gudang',
                    'Pembelian ID: '. $p->id
                );

                if( !$insert_riwata ) $error++;
            }

            if ($error == 0) {
                $pembelian = array(
                    'no_faktur'         => $this->input->post('no_faktur'),
                    'tgl_faktur'        => $this->input->post('tgl_faktur'),
                    'tgl_jatuh_tempo'   => $this->input->post('tgl_jatuh_tempo'),
                    'nama_distributor'  => $this->input->post('nama_distributor'),
                    'total'             => $this->input->post('total'),
                    'list_obat'         => serialize($data_obat)
                );

                $update_pembelian = $this->MainModel->update($tabel='pembelian_obat',$pembelian, $p->id);
                if( !$update_pembelian ) $error++;
            }

            if ($error == 0) {
                $this->session->set_flashdata('success', 'Data Obat berhasil update!');
            }
            else {
                $this->session->set_flashdata('warning', 'Data Obat gagal update!');
            }

            redirect('Apotek/pembelian');
        }
        else {

            $p = $this->PembelianObatModel->getPembelianObatyId($id_pembelian)->row();
            $data['pembelian'] = $p;
            $data['persen'] = $this->ObatModel->getSettingpersen()->result();
            $data['obat'] = $this->ObatModel->listObat();
            $data['is_edit'] = true;

            $this->template->view('master/apotek/tambah_pembelian_obat', $data);
        }
    }

    public function deletePembelianObat() {

    }

    public function settingPersenPembelian() {
        if ($this->input->post('submit') == 1) {

            $update = $this->MainModel->update(
                $tabel='prosentase_harga',
                ['prosentase' => $this->input->post('id-1')],
                1
            );
            $update &= $this->MainModel->update(
                $tabel='prosentase_harga',
                ['prosentase' => $this->input->post('id-2')],
                2
            );
            $update &= $this->MainModel->update(
                $tabel='prosentase_harga',
                ['prosentase' => $this->input->post('id-3')],
                3
            );

            if($update) {
                $this->session->set_flashdata('success', 'Edit persen harga obat berhasil!');
                redirect('Apotek/pembelian','refresh');
            }
            else {
                $this->session->set_flashdata('warning', 'Edit persen harga obat gagal!');
                redirect('Apotek/pembelian','refresh');
            }
        }
        else {
            $data['persen'] = $this->ObatModel->getSettingpersen()->result();
            $data['is_pembelian'] = 1;
            $this->template->view('master/apotek/persen_obat',$data);
        }
    }

    //---------------- END PEMBELIAN ----------------

    //---------------- RETUR ----------------

    public function returObat() {
        $start_date = $this->input->get('from');
        $end_date = $this->input->get('to');
        $periode = ($start_date && $end_date) ? ['start' => $start_date, 'end' => $end_date] : '';

        $data['pembelian'] = $this->PembelianObatModel->getReturObat($periode)->result();

        $this->template->view('master/apotek/retur',$data);
    }

    public function tambahReturObat() {
        if ($this->input->post('submit') == 1) {
            $session = $this->session->userdata('logged_in');
            $pembelian = array(
                'no_faktur'         => $this->input->post('no_faktur'),
                'tgl_faktur'        => $this->input->post('tgl_faktur'),
                'tgl_jatuh_tempo'   => $this->input->post('tgl_jatuh_tempo'),
                'nama_distributor'  => $this->input->post('nama_distributor'),
                'total'             => $this->input->post('total'),
                'profit'            => $this->ObatModel->getSettingpersen()->row()->prosentase,
                'pajak_ppn'         => 10,
                'creator'           => $session->id
            );

            $error = 0;

            $id_retur = $this->MainModel->insert_id($tabel='retur_obat',$pembelian);

            $data_obat = array();

            foreach ($this->input->post('obat') as $key => $value) {
                $riwayat= array(
                    'id_obat' => $value['id_obat'],
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

                $insert_riwata = $this->MainModel->insert_id($tabel='riwayat_retur_obat',$riwayat);
                $data_obat[$insert_riwata]= $value;

                $id_item = $this->GudangObatModel->updateDataObat($value['id_obat'], $value['jumlah']);

//                $this->GudangObatModel->updateMutasi(
//                    $id_item,
//                    $value['jumlah'],
//                    'Gudang',
//                    'Pembelian ID: '. $id_pembelian
//                );

                if( !$insert_riwata ) $error++;
            }

            if ($error == 0) {
                $update_pembelian = $this->MainModel->update($tabel='retur_obat',[ 'list_obat' => serialize($data_obat) ], $id_retur);
                if( !$update_pembelian ) $error++;
            }

            if($error == 0){
                $this->session->set_flashdata('success', 'Tambah retur obat berhasil!');
                redirect('Apotek/returObat','refresh');
            }
            else{
                $this->session->set_flashdata('warning', 'Tambah retur obat gagal!');
                redirect('Apotek/returObat','refresh');
            }

        }
        else {
            $data['persen'] = $this->ObatModel->getSettingpersen()->result();
            $data['obat'] = $this->ObatModel->listObat();
            $data['is_edit'] = false;
            $this->template->view('master/apotek/tambah_retur_obat', $data);
        }
    }

    public function editReturObat() {

        $id_pembelian = $this->uri->segment(3);

        if ($this->input->post('submit') == 1) {
            $p = $this->PembelianObatModel->getReturObatyId($_POST['id_transaksi'])->row();

            $old_obat = unserialize($p->list_obat);
            $data_obat = array();
            $error = 0;

            foreach ( $old_obat as $key => $value) {
                if (isset( $_POST['obat']['row-'.$key] )) {
                    unset($_POST['obat']['row-'.$key]);
                    $data_obat[$key] = $value;
                }
                else {
//                    $id_item = $this->GudangObatModel->updateStock($value['id_obat'], $value['tgl_kadaluwarsa'], $value['jumlah']);
                    $id_item = $this->GudangObatModel->updateDataObat($value['id_obat'], $value['jumlah'] * -1);
//                    $this->GudangObatModel->updateMutasi(
//                        $id_item,
//                        (0 - $value['jumlah']),
//                        'Penyesuaian Data',
//                        'Update pembelian ID: '. $p->id
//                    );

                    $this->db->delete('riwayat_retur_obat', array('id' => $key));
                }
            }

            foreach ($_POST['obat'] as $key => $value) {
                $riwayat= array(
                    'id_obat' => $value['id_obat'],
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

                $insert_riwata = $this->MainModel->insert_id($tabel='riwayat_retur_obat',$riwayat);
                $data_obat[$insert_riwata]= $value;

//                $id_item = $this->GudangObatModel->updateStock($value['id_obat'], $value['tgl_kadaluwarsa'], $value['jumlah'] * -1);
                $id_item = $this->GudangObatModel->updateDataObat($value['id_obat'], $value['jumlah']);

//                $this->GudangObatModel->updateMutasi(
//                    $id_item,
//                    $value['jumlah'],
//                    'Gudang',
//                    'Pembelian ID: '. $p->id
//                );

                if( !$insert_riwata ) $error++;
            }

            if ($error == 0) {
                $pembelian = array(
                    'no_faktur'         => $this->input->post('no_faktur'),
                    'tgl_faktur'        => $this->input->post('tgl_faktur'),
                    'tgl_jatuh_tempo'   => $this->input->post('tgl_jatuh_tempo'),
                    'nama_distributor'  => $this->input->post('nama_distributor'),
                    'total'             => $this->input->post('total'),
                    'list_obat'         => serialize($data_obat)
                );

                $update_pembelian = $this->MainModel->update($tabel='retur_obat',$pembelian, $p->id);
                if( !$update_pembelian ) $error++;
            }

            if ($error == 0) {
                $this->session->set_flashdata('success', 'Data Obat berhasil update!');
            }
            else {
                $this->session->set_flashdata('warning', 'Data Obat gagal update!');
            }

            redirect('Apotek/returObat');
        }
        else {

            $p = $this->PembelianObatModel->getReturObatyId($id_pembelian)->row();
            $data['retur'] = $p;
            $data['persen'] = $this->ObatModel->getSettingpersen()->result();
            $data['obat'] = $this->ObatModel->listObat();
            $data['is_edit'] = true;

            $this->template->view('master/apotek/tambah_retur_obat', $data);
        }
    }

    //---------------- END RETUR ----------------

    //---------------- RESEP ----------------

    public function isi_soap()
    {
        $r = $this->MainModel->update('pemeriksaan', [
            'soap_apoteker' => json_encode([
                'subjective' => $this->input->post('subjective'),
                'objective' => $this->input->post('objective'),
                'analysis' => $this->input->post('analysis'),
                'planning' => $this->input->post('planning'),
            ])
        ], $this->input->post('isi_soap_id'));

        $this->session->set_flashdata('success', 'Berhasil isi SOAP perawat');
        redirect('Apotek/resep_n','refresh');
    }

    public function isi_telaah()
    {
        $r = $this->MainModel->update('pemeriksaan', [
            'telaah' => json_encode([
                'resep_lengkap' => $this->input->post('resep_lengkap'),
                'resep_lengkap_tl' => $this->input->post('resep_lengkap_tl'),
                'pasien_sesuai' => $this->input->post('pasien_sesuai'),
                'pasien_sesuai_tl' => $this->input->post('pasien_sesuai_tl'),
                'nama_obat' => $this->input->post('nama_obat'),
                'nama_obat_tl' => $this->input->post('nama_obat_tl'),
                'bentuk_sediaan' => $this->input->post('bentuk_sediaan'),
                'bentuk_sediaan_tl' => $this->input->post('bentuk_sediaan_tl'),
                'dosis' => $this->input->post('dosis'),
                'dosis_tl' => $this->input->post('dosis_tl'),
                'jumlah_obat' => $this->input->post('jumlah_obat'),
                'jumlah_obat_tl' => $this->input->post('jumlah_obat_tl'),
                'aturan_pakai' => $this->input->post('aturan_pakai'),
                'aturan_pakai_tl' => $this->input->post('aturan_pakai_tl'),
                'tepat_indikasi' => $this->input->post('tepat_indikasi'),
                'tepat_indikasi_tl' => $this->input->post('tepat_indikasi_tl'),
                'tepat_dosis' => $this->input->post('tepat_dosis'),
                'tepat_dosis_tl' => $this->input->post('tepat_dosis_tl'),
                'tepat_waktu_penggunaan' => $this->input->post('tepat_waktu_penggunaan'),
                'tepat_waktu_penggunaan_tl' => $this->input->post('tepat_waktu_penggunaan_tl'),
                'duplikasi_pengobatan' => $this->input->post('duplikasi_pengobatan'),
                'duplikasi_pengobatan_tl' => $this->input->post('duplikasi_pengobatan_tl'),
                'alergi' => $this->input->post('alergi'),
                'alergi_tl' => $this->input->post('alergi_tl'),
                'kontraindikasi' => $this->input->post('kontraindikasi'),
                'kontraindikasi_tl' => $this->input->post('kontraindikasi_tl'),
                'telaah_obat' => $this->input->post('telaah_obat'),
                'telaah_obat_tl' => $this->input->post('telaah_obat_tl'),
                'nama_obat_dengan_resep' => $this->input->post('nama_obat_dengan_resep'),
                'nama_obat_dengan_resep_tl' => $this->input->post('nama_obat_dengan_resep_tl'),
                'jumlah_dosis_dengan_resep' => $this->input->post('jumlah_dosis_dengan_resep'),
                'jumlah_dosis_dengan_resep_tl' => $this->input->post('jumlah_dosis_dengan_resep_tl'),
                'rute_dengan_resep' => $this->input->post('rute_dengan_resep'),
                'rute_dengan_resep_tl' => $this->input->post('rute_dengan_resep_tl'),
                'waktu_frekuensi_pemberian' => $this->input->post('waktu_frekuensi_pemberian'),
                'waktu_frekuensi_pemberian_tl' => $this->input->post('waktu_frekuensi_pemberian_tl'),
            ])
        ], $this->input->post('isi_telaah_id'));

        $this->session->set_flashdata('success', 'Berhasil isi Telaah Resep');
        redirect('Apotek/resep_n','refresh');
    }

    public function resep()
    {
        $data['listPendaftaran']    = $this->PemeriksaanModel->getListPemeriksaanSetelahPeriksa100()->result();
        $data['obat']               = $this->AdministrasiModel->getObatPemeriksaandetail();
        $data['racikan']            = $this->AdministrasiModel->getRacikanPemeriksaan();

        foreach ($data['listPendaftaran'] as &$v) {
            $v->racikans = $this->ObatRacikanModel->getRacikanByIdPemeriksaan($v->id)->result();
            foreach ($v->racikans as &$vv) {
                $vv->racikan = $this->ObatRacikanModel->getObatRacikanByIdDetailObatRacikan($vv->id)->result();
            }
        }

        $this->template->view('master/apotek/resep',$data);
    }

    public function cetak_resep($id)
    {
        $data['pemeriksaan'] = $this->PemeriksaanModel->getPemeriksaanById($id)->row();
        $racikans = $this->AdministrasiModel->getListRacikanByPemeriksaanId($data['pemeriksaan']->id)->result();
        foreach ($racikans as $k => $v) {
            $racikans[$k]->obat = $this->AdministrasiModel->getListObatByDetailObatRacikanPemeriksaanId($v->id)->result();
            foreach ($racikans[$k]->obat as $kk => $vv) {
                $racikans[$k]->total += $vv->jumlah_satuan * $vv->harga_jual;
            }
        }
        $data['racikan'] = $racikans;
        $data['obat'] = $this->AdministrasiModel->getObatPemeriksaanById($data['pemeriksaan']->id)->result();
        $data['klinik'] = $this->AdministrasiModel->getKlinik()->row();

        $this->load->view('master/apotek/cetak_resep', $data);
    }

    public function rekap_resep_ranap()
    {
        $data['list'] = $this->RawatInapModel->getSelesai();

        foreach ($data['list'] as &$ri) {
            $ri['obat'] = $this->db->query("
                SELECT o.nama, SUM(rro.jumlah) as jumlah, o.harga_jual as harga FROM ri_resep_obat rro
                JOIN obat o on o.id = rro.obat_id
                JOIN ri_resep rr ON rr.id = rro.ri_resep_id
                WHERE ri_resep_id IN (
                    SELECT id FROM ri_resep
                    WHERE rawat_inap_id = {$ri['id']}
                    AND jenis_ruangan_id = 1
                )
                GROUP BY o.id
            ")->result();

            $ri['racikans'] = $this->db->query("
                SELECT rror.id, rror.nama_racikan, rror.signa, rror.catatan FROM ri_resep_obat_racik rror
                JOIN ri_resep rr ON rr.id = rror.ri_resep_id
                WHERE ri_resep_id IN (
                    SELECT id FROM ri_resep
                    WHERE rawat_inap_id = {$ri['id']}
                )
            ")->result();

            foreach ($ri['racikans'] as &$or) {
                $or->obat = $this->db->query("
                    SELECT o.nama, o.harga_jual as harga, rrord.jumlah FROM ri_resep_obat_racik_detail rrord
                    JOIN obat o ON o.id = rrord.obat_id
                    WHERE ri_resep_obat_racik_id = {$or->id} 
                ")->result();
            }
        }

        $this->template->view('master/apotek/rekap_resep_ranap', $data);
    }

    public function rekap_resep_transfer($current_place_type)
    {
        $data['current_place_type'] = $current_place_type;

        $what = $current_place_type == 'OK' ? 'Ruang Operasi' : ($current_place_type == 'VK' ? 'Ruang Bersalin' : $current_place_type);
        $jenis_ruangan_id = $this->MainModel->select('jenis_ruangan', ['nama', $what])->row()->id;

        $what = $current_place_type == 'OK' ? 'ruang operasi' : ($current_place_type == 'VK' ? 'ruang bersalin' : $current_place_type);
        $data['list'] = $this->RawatInapModel->getSelesaiOfTransfer(strtolower($what));

        foreach ($data['list'] as &$ri) {
            $ri['obat'] = $this->db->query("
                SELECT o.nama, SUM(rro.jumlah) as jumlah, o.harga_jual as harga FROM ri_resep_obat rro
                JOIN obat o on o.id = rro.obat_id
                JOIN ri_resep rr ON rr.id = rro.ri_resep_id
                WHERE ri_resep_id IN (
                    SELECT id FROM ri_resep
                    WHERE rawat_inap_id = {$ri['id']}
                    AND transfer_id = {$ri['transfer_id']}
                    AND jenis_ruangan_id = $jenis_ruangan_id
                )
                GROUP BY o.id
            ")->result();

            $ri['racikans'] = $this->db->query("
                SELECT rror.id, rror.nama_racikan, rror.signa, rror.catatan FROM ri_resep_obat_racik rror
                JOIN ri_resep rr ON rr.id = rror.ri_resep_id
                WHERE ri_resep_id IN (
                    SELECT id FROM ri_resep
                    WHERE rawat_inap_id = {$ri['id']}
                )
            ")->result();

            foreach ($ri['racikans'] as &$or) {
                $or->obat = $this->db->query("
                    SELECT o.nama, o.harga_jual as harga, rrord.jumlah FROM ri_resep_obat_racik_detail rrord
                    JOIN obat o ON o.id = rrord.obat_id
                    WHERE ri_resep_obat_racik_id = {$or->id} 
                ")->result();
            }
        }

        $this->template->view('master/apotek/rekap_resep_ranap', $data);
    }

    public function cetak_soap($id)
    {
        $data['pemeriksaan'] = $this->AdministrasiModel->getPemeriksaanById($id)->row();

        if (!$data['pemeriksaan']->soap_apoteker) {
            $this->session->set_flashdata('warning', 'SOAP tidak diisi');
            redirect('apotek/resep');
        }

        $data['klinik'] = $this->AdministrasiModel->getKlinik()->row();
        $data['soap'] = json_decode($data['pemeriksaan']->soap_apoteker);

        $this->load->view('master/apotek/cetak_soap', $data);
    }

    public function cetak_telaah($id)
    {
        $data['pemeriksaan'] = $this->AdministrasiModel->getPemeriksaanById($id)->row();

        if (!$data['pemeriksaan']->telaah) {
            $this->session->set_flashdata('warning', 'Telaah tidak diisi');
            redirect('apotek/resep');
        }

        $data['klinik'] = $this->AdministrasiModel->getKlinik()->row();
        $data['telaah'] = json_decode($data['pemeriksaan']->telaah, true);
        $data['idx'] = [
            'resep_lengkap',
            'pasien_sesuai',
            'nama_obat',
            'bentuk_sediaan',
            'dosis',
            'jumlah_obat',
            'aturan_pakai',
            'tepat_indikasi',
            'tepat_dosis',
            'tepat_waktu_penggunaan',
            'duplikasi_pengobatan',
            'alergi',
            'kontraindikasi',
            'telaah_obat',
            'nama_obat_dengan_resep',
            'jumlah_dosis_dengan_resep',
            'rute_dengan_resep',
            'waktu_frekuensi_pemberian',
        ];

        $this->load->view('master/apotek/cetak_telaah', $data);
    }

    public function resep_n()
    {
//        $data['listPendaftaran']    = $this->PemeriksaanModel->getListPemeriksaanTanpaLabSudahInputObatAtauSudahBayar()->result();
        $data['listPendaftaran']    = $this->PemeriksaanModel->getListPemeriksaanTanpaLabSudahPeriksaAtauSudahBayar()->result();
        $data['obat']               = $this->AdministrasiModel->getObatPemeriksaandetail();
        $data['racikan']            = $this->AdministrasiModel->getRacikanPemeriksaan();

        foreach ($this->ObatLuarModel->getPenjualanSudahObat() as $v) {
            $o = [];

            if ($v->tipe == 'resep_luar') $nama = $v->nama_pasien;
            else if ($v->tipe == 'obat_internal') $nama = $v->nama_karyawan;
            else $nama = '';

            $o['obat_luar'] = true;
            $o['no_rm'] = 'Penj. Obat';
            $o['jaminan'] = $v->tipe;
            $o['nama_pasien'] = $nama;
            $o['nama_dokter'] = $v->nama_dokter ? $v->nama_dokter : '';
            $o['id'] = $v->id;

            $data['listPendaftaran'][] = (object) $o;
        }

        foreach ($data['listPendaftaran'] as &$v) {
            $v->racikans = $this->ObatRacikanModel->getRacikanByIdPemeriksaan($v->id)->result();
            foreach ($v->racikans as &$vv) {
                $vv->racikan = $this->ObatRacikanModel->getObatRacikanByIdDetailObatRacikan($vv->id)->result();
            }
        }

        $this->template->view('master/apotek/resep_n',$data);
    }

    public function resep_nota($id)
    {
        $data['pemeriksaan'] = $this->AdministrasiModel->getPemeriksaanById($id)->row();
        $data['tindakan'] = $this->AdministrasiModel->getTindakanById($id);
        $data['obat'] = $this->AdministrasiModel->getObatPemeriksaanById($id);
//        $data['racikan'] = $this->AdministrasiModel->getRacikanPemeriksaanById($id);

        $data['pemeriksaan']->racikans = $this->ObatRacikanModel->getRacikanByIdPemeriksaan($data['pemeriksaan']->id)->result();
        foreach ($data['pemeriksaan']->racikans as &$vv) {
            $vv->racikan = $this->ObatRacikanModel->getObatRacikanByIdDetailObatRacikan($vv->id)->result();
        }

        $this->template->view('master/apotek/resep_n_nota_like',$data);
    }

    public function cetak_etiket($dop_id)
    {
//         error_reporting(E_ALL);
//
//         // Display errors in output
//         ini_set('display_errors', 1);
        $dop = $this->db->query("SELECT * FROM detail_obat_pemeriksaan WHERE id = $dop_id")->row();
        $data['pemeriksaan'] = $this->AdministrasiModel->getPemeriksaanById($dop->pemeriksaan_id)->row();
        $data['obat'] = $this->ObatModel->getObatById($dop->obat_id)->row();
        $data['jumlah_satuan'] = $dop->jumlah_satuan;
        $data['signa'] = $dop->signa_obat;
        $this->load->view('master/apotek/cetak_etiket', $data);
    }

    public function cetak_etiket_obat_luar($dop_id)
    {
        $dop = $this->db->query("SELECT * FROM detail_penjualan_obat_luar WHERE id = $dop_id")->row();
        $data['penjualan'] = $this->db->query("SELECT * FROM penjualan_obat_luar WHERE id = $dop->penjualan_obat_luar_id")->row();
        $data['obat'] = $this->ObatModel->getObatById($dop->obat_id)->row();
        $data['jumlah_satuan'] = $dop->jumlah_satuan;
        $data['signa'] = $dop->signa_obat;
        $this->load->view('master/apotek/cetak_etiket_luar', $data);
    }

    public function resep_nota_obat_luar($id)
    {
        $data['penjualan'] = $this->ObatLuarModel->getPenjualanById($id);
        $data['obat'] = $this->ObatLuarModel->getDetailPenjualanObatLuarByIdPenjualan($id);
        $data['racikan'] = $this->ObatLuarModel->getDetailPenjualanObatRacikanLuarByIdPenjualan($id);

        foreach ($data['racikan'] as $k => $v) {
            $data['racikan'][$k]->obat = $this->ObatLuarModel->getListObatByDetailPenjualanObatRacikanLuarId($v->id);
            foreach ($data['racikan'][$k]->obat as $kk => $vv) {
                $data['racikan'][$k]->total += $vv->jumlah_satuan * $vv->harga_jual;
            }
        }

        $this->template->view('master/apotek/resep_n_nota_obat_luar_like',$data);
    }

    public function editResep($id, $to = '')
    {
        $data['to'] = $to;
        $data['pemeriksaan'] = $this->AdministrasiModel->getPemeriksaanById($id)->row();
        $data['s_tindakan'] = $this->AdministrasiModel->getTindakanById($id)->result();

        $data['obat_all'] = $this->ObatModel->listObat()->result();
        $data['bahan_all'] = $this->db->get_where('bahan_habis_pakai', ['is_active' => 1, 'jumlah >' => 0])->result();

        $data['obats'] = $this->AdministrasiModel->getObatPemeriksaanById($id)->result();
        $data['racikans'] = $this->ObatRacikanModel->getRacikanByIdPemeriksaan($data['pemeriksaan']->id)->result();
        $data['bahans'] = $this->AdministrasiModel->getBahanHabisPakaiPemeriksaanById($data['pemeriksaan']->id)->result();

        $category = 'umum';
        foreach ($this->config->item('poli') as $k => $v) {
            if (in_array($data['pemeriksaan']->kode, $v['kode'])) {
                $category = $k;
                break;
            }
        }

        $data['category'] = $category;
        $data['tindakan'] = $this->PemeriksaanModel->getTindakanByCategory($category);
        $data['tindakan_urologi'] = $this->PemeriksaanModel->getTindakanByCategory('urologi');
        $data['tindakan_gigi'] = $this->PemeriksaanModel->getTindakanByCategory('gigi');

        if ($category == 'laboratorium') {
            $data['jenis_layanan_lab'] = $this->JenisLayananLaboratoirumModel->get_all_children_and_paket();
            $data['selected_jenis_layanan_lab'] = $this->JenisLayananLaboratoirumModel->byIdPemeriksaan($id);
        }

        $data['pendaftaran'] = $this->PemeriksaanModel->getPendaftaranByIdPemeriksaan($id)->row_array();
        foreach ($data['racikans'] as &$vv) {
            $vv->racikan = $this->ObatRacikanModel->getObatRacikanByIdDetailObatRacikan($vv->id)->result();
        }

        $this->template->view('master/apotek/edit_resep',$data);
    }

    public function simpanEditResep($pemeriksaan_id)
    {
        $session = $this->session->userdata('logged_in');
        $pemeriksaan = $this->AdministrasiModel->getPemeriksaanById($pemeriksaan_id)->row();
        $pdf = $this->PemeriksaanModel->getPendaftaranByIdPemeriksaan($pemeriksaan_id)->row();
        $this->db->where('id', $pdf->id)->update('pendaftaran_pasien', ['tdk_diambil' => $this->input->post('tdk_diambil')]);

        $category = 'umum';
        foreach ($this->config->item('poli') as $k => $v) {
            if (in_array($pemeriksaan->kode, $v['kode'])) {
                $category = $k;
                break;
            }
        }

        $obat_pemeriksaan = $this
            ->DetailObatPemeriksaanModel
            ->getDetailObatByPemeriksaanId($pemeriksaan_id)
            ->result();
        $obatnya_obat_racikan = $this
            ->DetailObatRacikanPemeriksaanModel
            ->getAllObatOfObatRacikanByPemeriksaanId($pemeriksaan_id)
            ->result();
        $bahan_terpakai = $this
            ->DetailBahanPemeriksaanModel
            ->getDetailBahanByPemeriksaanId($pemeriksaan_id)
            ->result();

        $this->db->delete('detail_obat_pemeriksaan', array('pemeriksaan_id' => $pemeriksaan_id));
        $this->db->delete('detail_obat_racikan_pemeriksaan', array('pemeriksaan_id' => $pemeriksaan_id));
        $this->db->delete('detail_bahan_pemeriksaan', array('pemeriksaan_id' => $pemeriksaan_id));
        $this->db->delete('detail_tindakan_pemeriksaan', array('pemeriksaan_id' => $pemeriksaan_id));
        if ($category == 'laboratorium') {
            $this->db->delete('detail_tindakan_pemeriksaan_lab', array('pemeriksaan_id' => $pemeriksaan_id));
        }

        // --------------- OBAT ---------------- //

        $jumlah_satuan = $this->input->post('jumlah_satuan') ?? [];
        $signa_obat = $this->input->post('signa_obat') ?? [];
        $input_obat = $this->input->post('nama_obat') ?? [];
        $i = 0;

        $ob = array();
        foreach ($input_obat as $key => $value) {
            $obat = array(
                'pemeriksaan_id' => $pemeriksaan_id,
                'obat_id'        => $value,
                'jumlah_satuan'  => $jumlah_satuan[$i],
                'signa_obat'     => $signa_obat[$i],
                'creator'        => $session->id
            );

            if ($obat['obat_id'] != "") {
                $ob[] = $obat;
            }

            $this->MainModel->insert_id('detail_obat_pemeriksaan', $obat);

            foreach ($obat_pemeriksaan as $o) {
                if ($o->obat_id == $obat['obat_id']) {
                    $stok_lawas = $this->ObatModel->getObatById($o->obat_id)->row()->stok_obat;
                    $stok_baru = $stok_lawas - ($obat['jumlah_satuan'] - $o->jumlah_satuan);
//                    $this->MainModel->update('obat', ['stok_obat' => $stok_baru], $o->obat_id); // EDIT OBAT JUGA BELUM MEMPENGARUHI STOK
                    break;
                }
            }

            $i++;
        }

        // --------------- OBAT RACIKAN ---------------- //

        $ra = array();
        for ($n=1; $n <= 5; $n++) {

            $signa = $this->input->post('signa'.$n);
            $catatan = $this->input->post('catatan'.$n);
            $racikan = array(
                'pemeriksaan_id' => $pemeriksaan_id,
                'nama_racikan'   => 'racikan '.$n,
                'signa'          => $signa,
                'catatan'        => $catatan,
                'creator'        => $session->id

            );

            if ($signa != "") {
                $ra[] = $racikan;
                $j = 0;
                $detail_obat_racikan_pemeriksaan_id = $this->MainModel->insert_id('detail_obat_racikan_pemeriksaan',$racikan);
                $id_obat_racikan = $this->input->post('nama_obat_racikan'.$n);
                $jumlah_satuan = $this->input->post('jumlah_satuan_racikan'.$n);

                foreach ($id_obat_racikan as $key => $value) {
                    $obat_racikan = array(
                        'detail_obat_racikan_pemeriksaan_id'    => $detail_obat_racikan_pemeriksaan_id,
                        'obat_id'                               => $value,
                        'jumlah_satuan'                         => $jumlah_satuan[$j],
                        'creator'                               => $session->id
                    );

                    $this->MainModel->insert_id('obat_racikan', $obat_racikan);

                    foreach ($obatnya_obat_racikan as $o) {
                        if ($o->obat_id == $obat_racikan['obat_id']) {
                            $stok_lawas = $this->ObatModel->getObatById($o->obat_id)->row()->stok_obat;
                            $stok_baru = $stok_lawas - ($obat_racikan['jumlah_satuan'] - $o->jumlah_satuan);
//                            $this->MainModel->update('obat', ['stok_obat' => $stok_baru], $o->obat_id);  // EDIT OBAT JUGA BELUM MEMPENGARUHI STOK
                            break;
                        }
                    }

                    $j++;
                }
            }
        }

        // --------------- BAHAN ---------------- //

        $jumlah_satuan = $this->input->post('qty');
        $bahan_id = $this->input->post('bahan_id') ?? [];
        $i = 0;

        foreach ($bahan_id as $key => $value) {
            $bahan = array(
                'pemeriksaan_id' => $pemeriksaan_id,
                'bahan_id'       => $value,
                'jumlah'         => $jumlah_satuan[$i],
                'creator'        => $session->id
            );

            if ($bahan['bahan_id'] != "") {
                $bah[] = $bahan;
            }

            $this->MainModel->insert_id('detail_bahan_pemeriksaan', $bahan);

            foreach ($bahan_terpakai as $b) {
                if ($b->bahan_id == $bahan['bahan_id']) {
                    $stok_lawas = $this->BahanHabisPakaiModel->getBahanById($b->bahan_id)->row()->jumlah;
                    $stok_baru = $stok_lawas - ($bahan['jumlah'] - $b->jumlah);
//                    $this->MainModel->update('bahan_habis_pakai', ['jumlah' => $stok_baru], $b->bahan_id);  // EDIT OBAT JUGA BELUM MEMPENGARUHI STOK
                    break;
                }
            }

            $i++;
        }

        //------------------------ TINDAKAN --------------------------//

        $input_tindakan = $this->input->post('tindakan');

        if ($category == 'laboratorium') {
            foreach ($input_tindakan as $key => $value) {
                $tindakan = array(
                    'pemeriksaan_id' => $pemeriksaan_id,
                    'jenis_layanan_id' => $value,
                    'creator' => $session->id
                );
                $this->MainModel->insert_id('detail_tindakan_pemeriksaan_lab', $tindakan);
            }
        }
        else {
            foreach ($input_tindakan as $key => $value) {
                $tindakan = array(
                    'pemeriksaan_id' => $pemeriksaan_id,
                    'tarif_tindakan_id' => $value,
                    'creator' => $session->id
                );
                $this->MainModel->insert_id('detail_tindakan_pemeriksaan', $tindakan);
            }
        }

        if ($this->input->post('to')) {
            if ($this->input->post('to') == 'kasir_all') {
                $referred_from = $this->session->userdata('referred_from');
                redirect($referred_from, 'refresh');
            }
            else if ($this->input->post('to') == 'kasir') {
                redirect('Administrasi/nota/'.$pemeriksaan_id);
            }
        }
        else {
            redirect('Apotek/resep_nota/'.$pemeriksaan_id);
        }
    }

    public function sudahObat($id) {
        $session = $this->session->userdata('logged_in');
        $periksa = array(
            'apoteker_id' => $session->id,
            'status' => 'selesai'
        );
        $r = $this->MainModel->update('pemeriksaan',$periksa, $id);

        if ($r) {
            $this->session->set_flashdata('success', 'Obat sudah ok!');
        }
        else {
            $this->session->set_flashdata('warning', 'Terdapat kesalahan. Mohon coba lagi!');
        }

        if ($this->uri->segment(4)) redirect('apotek/resep_n');
        else redirect('apotek/resep');
    }

    public function sudahObatLuar($id) {
        $r = $this->MainModel->update('penjualan_obat_luar', ['progress' => 'selesai'], $id);

        if ($r) {
            $this->session->set_flashdata('success', 'Obat sudah ok!');
        }
        else {
            $this->session->set_flashdata('warning', 'Terdapat kesalahan. Mohon coba lagi!');
        }

        if ($this->uri->segment(4)) redirect('apotek/resep_n');
        else redirect('apotek/resep');
    }

    //---------------- END RESEP ----------------

    //---------------- OBAT LUAR ----------------

    public function resep_luar()
    {
        $this->load->model('DokterModel');

        $data['obat'] = $this->db->get_where('obat', ['is_active' => 1, 'stok_obat >' => 0])->result();
        $data['dokter'] = $this->DokterModel->listDokter()->result();

        $this->template->view('master/apotek/resep_luar', $data);
    }

    public function obat_bebas()
    {
        $data['obat'] = $this->db->get_where('obat', ['is_active' => 1, 'stok_obat >' => 0])->result();
        $this->template->view('master/apotek/obat_bebas', $data);
    }

    public function obat_internal()
    {
        $data['obat'] = $this->db->get_where('obat', ['is_active' => 1, 'stok_obat >' => 0])->result();
        $this->template->view('master/apotek/obat_internal', $data);
    }

    public function rekapitulasi_resep_luar()
    {
        $jenis = $this->input->get('jenis');
        $from = $this->input->get('from');
        $to = $this->input->get('to');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');

        $start_date = $end_date = date('Y-m-d');
        if ($jenis == 2) {
            $start_date = $from;
            $end_date = $to;
        }
        if ($jenis == 3) {
            $start_date = date("$tahun-$bulan-01");
            $end_date = date("$tahun-$bulan-t");
        }

        $data['jenis'] = $jenis;
        $data['from'] = $from;
        $data['to'] = $to;
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $data['penjualan'] = $this->ObatLuarModel->getPenjualanResepLuarSudahBayar(['start_date' => $start_date, 'end_date' => $end_date]);
        $data['obat'] = $this->ObatLuarModel->getDetailPenjualanObatLuar();
        $data['racikan'] = $this->ObatLuarModel->getRekapRacikan();

        $this->template->view('master/apotek/rekap_resep_luar', $data);
    }

    public function rekapitulasi_obat_bebas()
    {
        $jenis = $this->input->get('jenis');
        $from = $this->input->get('from');
        $to = $this->input->get('to');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');

        $start_date = $end_date = date('Y-m-d');
        if ($jenis == 2) {
            $start_date = $from;
            $end_date = $to;
        }
        if ($jenis == 3) {
            $start_date = date("$tahun-$bulan-01");
            $end_date = date("$tahun-$bulan-t");
        }

        $data['jenis'] = $jenis;
        $data['from'] = $from;
        $data['to'] = $to;
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $data['penjualan'] = $this->ObatLuarModel->getPenjualanObatBebasSudahBayar(['start_date' => $start_date, 'end_date' => $end_date]);
        $data['obat'] = $this->ObatLuarModel->getDetailPenjualanObatLuar();
        $data['racikan'] = $this->ObatLuarModel->getRekapRacikan();

        $this->template->view('master/apotek/rekap_obat_bebas', $data);
    }

    public function rekapitulasi_obat_internal()
    {
        $jenis = $this->input->get('jenis');
        $from = $this->input->get('from');
        $to = $this->input->get('to');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');

        $start_date = $end_date = date('Y-m-d');
        if ($jenis == 2) {
            $start_date = $from;
            $end_date = $to;
        }
        if ($jenis == 3) {
            $start_date = date("$tahun-$bulan-01");
            $end_date = date("$tahun-$bulan-t");
        }

        $data['jenis'] = $jenis;
        $data['from'] = $from;
        $data['to'] = $to;
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $data['penjualan'] = $this->ObatLuarModel->getPenjualanObatInternalSudahBayar(['start_date' => $start_date, 'end_date' => $end_date]);
        $data['obat'] = $this->ObatLuarModel->getDetailPenjualanObatLuar();
        $data['racikan'] = $this->ObatLuarModel->getRekapRacikan();

        $this->template->view('master/apotek/rekap_obat_internal', $data);
    }

    public function simpan_resep_luar()
    {
        $this->load->model('DokterModel');

        $session = $this->session->userdata('logged_in');
        $nama_pasien = $this->input->post('nama_pasien');
        $alamat = $this->input->post('alamat');
        $biaya_ongkir = $this->input->post('biaya_ongkir');
        $nama_dokter = $this->input->post('nama_dokter');

        $id = $this->MainModel->insert_id('penjualan_obat_luar', [
            'nama_pasien' => $nama_pasien,
            'alamat' => $alamat,
            'nama_dokter' => $nama_dokter,
            'tipe' => 'resep_luar',
            'biaya_ongkir' => $biaya_ongkir,
            'creator' => $session->id
        ]);

        $this->save_obat_luar($id, $session->id);

        redirect('Administrasi/listPasienSelesaiPeriksa');
    }

    public function simpan_obat_bebas()
    {
        $session = $this->session->userdata('logged_in');
        $id = $this->MainModel->insert_id('penjualan_obat_luar', [
            'tipe' => 'obat_bebas',
            'creator' => $session->id
        ]);
        $this->save_obat_luar($id, $session->id);

        redirect('Administrasi/listPasienSelesaiPeriksa');
    }

    public function simpan_obat_internal()
    {
        $session = $this->session->userdata('logged_in');
        $nama_karyawan = $this->input->post('nama_karyawan');

        $id = $this->MainModel->insert_id('penjualan_obat_luar', [
            'nama_karyawan' => $nama_karyawan,
            'tipe' => 'obat_internal',
            'creator' => $session->id
        ]);
        $this->save_obat_luar($id, $session->id);

        redirect('Administrasi/listPasienSelesaiPeriksa');
    }

    private function save_obat_luar($penjualan_obat_luar_id, $creator)
    {
        $jumlah_satuan = $this->input->post('jumlah_satuan');
        $signa_obat = $this->input->post('signa_obat');
        $input_obat = $this->input->post('nama_obat');
        $i = 0;
        foreach ($input_obat as $key => $value) {
            if ($value != "") {
                $this->MainModel->insert_id('detail_penjualan_obat_luar', [
                    'penjualan_obat_luar_id' => $penjualan_obat_luar_id,
                    'obat_id' => $value,
                    'jumlah_satuan' => $jumlah_satuan[$i],
                    'signa_obat' => $signa_obat[$i] ?? '',
                    'creator' => $creator
                ]);
            }

            $i++;
        }

        for ($n = 1; $n <= 9; $n++) {
            $signa = $this->input->post('signa' . $n);
            $catatan = $this->input->post('catatan' . $n);
            $jumlah_satuan = $this->input->post('jumlah_satuan_racikan' . $n);

            if ($signa != "") {
                $detail_penjualan_obat_racikan_luar_id = $this->MainModel->insert_id('detail_penjualan_obat_racikan_luar', [
                    'penjualan_obat_luar_id' => $penjualan_obat_luar_id,
                    'nama_racikan' => 'racikan ' . $n,
                    'signa' => $signa,
                    'catatan' => $catatan,
                    'creator' => $creator
                ]);

                $j = 0;
                foreach ($this->input->post('nama_obat_racikan'.$n) as $key => $value) {
                    if ($value != '') {
                        $this->MainModel->insert('obat_racikan_luar', [
                            'detail_penjualan_obat_racikan_luar_id' => $detail_penjualan_obat_racikan_luar_id,
                            'obat_id' => $value,
                            'jumlah_satuan' => $jumlah_satuan[$j],
                            'creator' => $creator
                        ]);
//                        $obat = $this->ObatModel->getObatById($value)->row();
//                        $stok = array('stok_obat' => ($obat->stok_obat) - $jumlah_satuan[$j]);
//                        $this->MainModel->update('obat', $stok, $value);
                    }

                    $j++;
                }
            }
        }
    }

    //---------------- END OBAT LUAR ----------------

}