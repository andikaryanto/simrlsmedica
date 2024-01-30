<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrasi extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('template');
        $this->load->Model('AdministrasiModel');
        $this->load->Model('PemeriksaanModel');
        $this->load->Model('MainModel');
        $this->load->Model('KlinikModel');
        $this->load->Model('ObatLuarModel');

        $this->load->Model('DetailObatPemeriksaanModel');
        $this->load->Model('DetailObatRacikanPemeriksaanModel');
        $this->load->Model('DetailBahanPemeriksaanModel');
        $this->load->Model('ObatModel');
        $this->load->Model('BahanHabisPakaiModel');
        $this->load->Model('PerawatModel');
        $this->load->Model('UserModel');

        $this->load->helper(array('file', 'php_with_mpdf_helper'));
        $this->load->helper(array('file', 'mpdf', 'usia'));
    }

    public function index() {
        redirect('Administrasi/listPasienSelesaiPeriksa');
    }

    public function listPasienSelesaiPeriksa() {
        $data['listPemeriksaan'] = $this->PemeriksaanModel->getListPemeriksaanSudahPeriksaAtauSudahObatAtauSudahBayar()->result();
        $data['tindakan'] = $this->AdministrasiModel->getTindakandetail();
        $data['obat'] = $this->AdministrasiModel->getObatPemeriksaandetail();
        $data['racikan'] = $this->AdministrasiModel->getRacikanPemeriksaan();
        $data['penyakit'] = $this->AdministrasiModel->getPenyakitPemeriksaandetail();
        $data['jaminan'] = $this->config->item('pendaftaran');
        $data['obat_luar'] = $this->ObatLuarModel->getDetailPenjualanObatLuar();
        $data['racikan_luar'] = $this->ObatLuarModel->getDetailPenjualanObatRacikanLuar();
        $obj = [
            "id" => "", "pendaftaran_id" => "", "dokter_id" => "", "pasien_id" => "", "perawat_id" => "",
            "apoteker_id" => "", "waktu_pemeriksaan" => "", "no_rm" => "", "nama_pasien" => "",
            "td" => "-", "n" => "-", "r" => "-", "s" => "-", "bb" => "", "tb" => "", "bmi" => "",
            "keluhan_utama" => "", "amammesia" => "", "diagnosis" => "", "pemeriksaan_fisik" => "",
            "hasil_penunjang" => "", "diagnosis_jenis_penyakit" => "", "diagnosis_banding" => "",
            "tindakan" => "", "deskripsi_tindakan" => "", "saran_pemeriksaan" => "", "diagnosa_perawat" => "",
            "asuhan_keperawatan" => "", "penanggungjawab" => "", "catatan_odontogram" => "",
            "meta" => "", "status" => "", "is_bpjs" => "", "jaminan" => "", "hasil_lab" => "",
            "is_active" => "", "created_at" => "", "updated_at" => "", "creator" => "", "jk" => "",
            "usia" => "", "nama_dokter" => ""
        ];

        foreach ($this->ObatLuarModel->getPenjualanSudahObat() as $v) {
            $o = $obj;

            if ($v->tipe == 'resep_luar') $nama = $v->nama_pasien;
            else if ($v->tipe == 'obat_internal') $nama = $v->nama_karyawan;
            else $nama = '';

            $o['obat_luar'] = true;
            $o['no_rm'] = 'Penj. Obat';
            $o['jaminan'] = $v->tipe;
            $o['status'] = $v->progress;
            $o['nama_pasien'] = $nama;
            $o['nama_dokter'] = $v->nama_dokter ? $v->nama_dokter : '';
            $o['id'] = $v->id;

            $data['listPemeriksaan'][] = (object) $o;
        }

        $this->template->view('administrasi/list_pasien_selesai_v', $data);
    }

    public function listPasienSelesaiPeriksa_sakit() {
        $data['klinik'] = $this->UserModel->getKlinik()->row();
        $data['listPemeriksaan'] = $this->PemeriksaanModel->getListPemeriksaan_sakit();
        $this->template->view('administrasi/list_pasien_selesai_sakit_v', $data);
    }

    public function listPasienSelesai_sehat() {
        $data['klinik'] = $this->UserModel->getKlinik()->row();
        $data['listPemeriksaan'] = $this->PemeriksaanModel->getListPemeriksaan_sehat();
        $this->template->view('administrasi/list_pasien_sehat_v', $data);
    }

    public function listPasienSelesaiPeriksa_consent() {
        $data['listPemeriksaan'] = $this->PemeriksaanModel->getListPemeriksaan_consent();
        $this->template->view('administrasi/list_pasien_selesai_consent_v', $data);
    }

    public function pemberianObat($id) {
        $data['pemeriksaan'] = $this->AdministrasiModel->getPemeriksaanById($id);
        $this->template->view('administrasi/pemberian_obat_v', $data);
    }

    public function nota($id) {
        $data['pemeriksaan'] = $this->AdministrasiModel->getPemeriksaanById($id)->row();
        $data['obat'] = $this->AdministrasiModel->getObatPemeriksaanById($id);
        $data['obat_sunat'] = $this->AdministrasiModel->getObatSunatPemeriksaanById($id);
        $data['bahan'] = $this->AdministrasiModel->getBahanHabisPakaiPemeriksaanById($id);

        if ($data['pemeriksaan']->jenis_pendaftaran_id == '19')
            $data['tindakan'] = $this->AdministrasiModel->getTindakanLabByIdPemeriksaan($id);
        else
            $data['tindakan'] = $this->AdministrasiModel->getTindakanById($id);

        $racikans = $this->AdministrasiModel->getListRacikanByPemeriksaanId($id)->result();
        foreach ($racikans as $k => $v) {
            $racikans[$k]->obat = $this->AdministrasiModel->getListObatByDetailObatRacikanPemeriksaanId($v->id)->result();
            foreach ($racikans[$k]->obat as $kk => $vv) {
                $racikans[$k]->total += $vv->jumlah_satuan * $vv->harga_jual;
            }
        }
        $data['racikan'] = $racikans;

        $this->template->view('administrasi/nota_v', $data);
    }

    public function nota_obat_luar($id)
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

        $this->template->view('administrasi/nota_obat_luar_v', $data);
    }

    public function edit_obat_luar($id)
    {
        $data['penjualan'] = $this->ObatLuarModel->getPenjualanById($id);
        $data['obat_all'] = $this->ObatModel->listObat()->result();
        $data['obats'] = $this->ObatLuarModel->getDetailPenjualanObatLuarByIdPenjualan($id);
        $data['racikans'] = $this->ObatLuarModel->getDetailPenjualanObatRacikanLuarByIdPenjualan($id);
        $data['goto_apotek'] = $this->uri->segment(4) ? 1 : 0;

        foreach ($data['racikans'] as $k => $v) {
            $data['racikans'][$k]->obat = $this->ObatLuarModel->getListObatByDetailPenjualanObatRacikanLuarId($v->id);
            foreach ($data['racikans'][$k]->obat as $kk => $vv) {
                $data['racikans'][$k]->total += $vv->jumlah_satuan * $vv->harga_jual;
            }
        }

        $this->template->view('administrasi/edit_obat_luar_v', $data);
    }

    public function simpan_edit_obat_luar($penjualan_id)
    {
        $session = $this->session->userdata('logged_in');

//        $obat_pemeriksaan = $this
//            ->ObatLuarModel
//            ->getDetailPenjualanObatLuarByIdPenjualan($penjualan_id);
//        $obatnya_obat_racikan = $this
//            ->ObatLuarModel
//            ->getAllObatOfObatRacikanByPemeriksaanId($penjualan_id)
//            ->result();

        $this->db->delete('detail_penjualan_obat_luar', array('penjualan_obat_luar_id' => $penjualan_id));
        $this->db->delete('detail_penjualan_obat_racikan_luar', array('penjualan_obat_luar_id' => $penjualan_id));

        // --------------- OBAT ---------------- //

        $jumlah_satuan = $this->input->post('jumlah_satuan');
        $signa_obat = $this->input->post('signa_obat');
        $input_obat = $this->input->post('nama_obat');
        $i = 0;

        $ob = array();
        foreach ($input_obat as $key => $value) {
            $obat = array(
                'penjualan_obat_luar_id' => $penjualan_id,
                'obat_id'        => $value,
                'jumlah_satuan'  => $jumlah_satuan[$i],
                'signa_obat'     => $signa_obat[$i],
                'creator'        => $session->id
            );

            if ($obat['obat_id'] != "") {
                $ob[] = $obat;
            }

            $this->MainModel->insert_id('detail_penjualan_obat_luar', $obat);
            $i++;
        }

        // --------------- OBAT RACIKAN ---------------- //

        $ra = array();
        for ($n=1; $n <= 5; $n++) {
            $signa = $this->input->post('signa'.$n);
            $catatan = $this->input->post('catatan'.$n);
            $racikan = array(
                'penjualan_obat_luar_id' => $penjualan_id,
                'nama_racikan'   => 'racikan '.$n,
                'signa'          => $signa,
                'catatan'        => $catatan,
                'creator'        => $session->id
            );

            if ($signa != "") {
                $ra[] = $racikan;
                $j = 0;
                $detail_penjualan_obat_racikan_luar_id = $this->MainModel->insert_id('detail_penjualan_obat_racikan_luar',$racikan);
                $id_obat_racikan = $this->input->post('nama_obat_racikan'.$n);
                $jumlah_satuan = $this->input->post('jumlah_satuan_racikan'.$n);

                foreach ($id_obat_racikan as $key => $value) {
                    $obat_racikan = array(
                        'detail_penjualan_obat_racikan_luar_id' => $detail_penjualan_obat_racikan_luar_id,
                        'obat_id'                               => $value,
                        'jumlah_satuan'                         => $jumlah_satuan[$j],
                        'creator'                               => $session->id
                    );

                    $this->MainModel->insert_id('obat_racikan_luar', $obat_racikan);
                    $j++;
                }
            }
        }

        if ($this->input->post('goto_apotek')) {
            redirect('Apotek/resep_nota_obat_luar/'.$penjualan_id);
        }
        else {
            redirect('Administrasi/listPasienSelesaiPeriksa');
        }
    }

    public function nota_submit() {
        $session = $this->session->userdata('logged_in');
        $bayar = array(
            'pemeriksaan_id' => $this->input->post('pemeriksaan_id'),
            'jasa_racik' => $this->input->post('jasa_racik'),
            'diskon' => $this->input->post('diskon'),
            'total' => $this->input->post('total'),
            'bayar' => $this->input->post('bayar'),
            'kembalian' => $this->input->post('kembalian'),
            'creator' => $session->id
        );

        $id_bayar = $this->MainModel->insert_id('bayar', $bayar);
        $nama_tindakan = $this->input->post('nama_tindakan') ?? [];
        $tarif_pasien = $this->input->post('tarif_pasien');
        $i = 0;

        if (!$id_bayar) {
            echo json_encode('err');die();
        }

        foreach ($nama_tindakan as $key => $value) {
            $tindakan = array(
                'bayar_id' => $id_bayar,
                'item' => $nama_tindakan[$i],
                'jenis_item' => 'tindakan',
                'jumlah' => 1,
                'harga' => $tarif_pasien[$i],
                'subtotal' => $tarif_pasien[$i],
                'creator' => $session->id,
            );
            $this->MainModel->insert('detail_bayar', $tindakan);
            $i++;
        }

        $nama_racikan = $this->input->post('nama_racikan') ?? [];
        $total_racikan = $this->input->post('total_racikan');
        $k = 0;
        foreach ($nama_racikan as $key => $value) {
            $racikan = array(
                'bayar_id' => $id_bayar,
                'item' => $value,
                'jenis_item' => 'obat racikan',
                'jumlah' => 1,
                'harga' => '',
                'subtotal' => $total_racikan[$k],
                'creator' => $session->id,
            );
            $this->MainModel->insert('detail_bayar', $racikan);
            $k++;
        }

        $nama_obat = $this->input->post('nama_obat');
        $jumlah_satuan = $this->input->post('jumlah_satuan');
        $harga_jual = $this->input->post('harga_jual');
        $subtotal = $this->input->post('subtotal_obat');
        $j = 0;
        foreach ($nama_obat as $key => $value) {
            $obat = array(
                'bayar_id' => $id_bayar,
                'item' => $nama_obat[$j],
                'jenis_item' => 'obat',
                'jumlah' => $jumlah_satuan[$j],
                'harga' => $harga_jual[$j],
                'subtotal' => $subtotal[$j],
                'creator' => $session->id,

            );
            $this->MainModel->insert('detail_bayar', $obat);
            $j++;
        }

        $nama_obat = $this->input->post('nama_obat_sunat');
        $jumlah_satuan = $this->input->post('jumlah_satuan_sunat');
        $harga_jual = $this->input->post('harga_jual_sunat');
        $subtotal = $this->input->post('subtotal_obat_sunat');
        $j = 0;
        foreach ($nama_obat as $key => $value) {
            $obat = array(
                'bayar_id' => $id_bayar,
                'item' => $nama_obat[$j],
                'jenis_item' => 'obat operasi/sunat',
                'jumlah' => $jumlah_satuan[$j],
                'harga' => $harga_jual[$j],
                'subtotal' => $subtotal[$j],
                'creator' => $session->id,

            );
            $this->MainModel->insert('detail_bayar', $obat);
            $j++;
        }

        $nama_bahan = $this->input->post('nama_bahan') ?? [];
        $jumlah_satuan_bahan = $this->input->post('jumlah_satuan_bahan');
        $harga_jual_bahan = $this->input->post('harga_jual_bahan');
        $subtotal_bahan = $this->input->post('subtotal_bahan');
        $b = 0;

        foreach ($nama_bahan as $key => $value) {
            $bahan = array(
                'bayar_id' => $id_bayar,
                'item' => $nama_bahan[$b],
                'jenis_item' => 'bahan habis pakai',
                'jumlah' => $jumlah_satuan_bahan[$b],
                'harga' => $harga_jual_bahan[$b],
                'subtotal' => $subtotal_bahan[$b],
                'creator' => $session->id,
            );
            $this->MainModel->insert('detail_bayar', $bahan);
            $b++;
        }

        if ($this->input->post('jasa_racik')) {
            $jasa_racik = array(
                'bayar_id' => $id_bayar,
                'item' => 'Jasa Racik',
                'jenis_item' => 'jasa racik',
                'jumlah' => 0,
                'harga' => $this->input->post('jasa_racik'),
                'subtotal' => $this->input->post('jasa_racik'),
                'creator' => $session->id,

            );
            $this->MainModel->insert('detail_bayar', $jasa_racik);
        }

        $id = $this->input->post('pemeriksaan_id');
        $this->MainModel->update('pemeriksaan', ['status' => 'sudah_bayar'], $id);

        $data['pemeriksaan'] = $this->AdministrasiModel->getPemeriksaanById($id)->row();
        $data['tindakan'] = $this->AdministrasiModel->getTindakanById($id);
        $data['obat'] = $this->AdministrasiModel->getObatPemeriksaanById($id);
        $data['obat_sunat'] = $this->AdministrasiModel->getObatSunatPemeriksaanById($id);
        $data['bahan'] = $this->AdministrasiModel->getBahanHabisPakaiPemeriksaanById($id);
        $data['id_bayar'] = $id_bayar;
        $data['pembayaran'] = $this->AdministrasiModel->getBayarById($id_bayar);

        $racikans = $this->AdministrasiModel->getListRacikanByPemeriksaanId($id)->result();
        foreach ($racikans as $k => $v) {
            $racikans[$k]->obat = $this->AdministrasiModel->getListObatByDetailObatRacikanPemeriksaanId($v->id)->result();
            foreach ($racikans[$k]->obat as $kk => $vv) {
                $racikans[$k]->total += $vv->jumlah_satuan * $vv->harga_jual;
            }
        }

        // ############################## MASALAH PENGUPDATEAN STOK OBAT DAN BAHAN HABIS PAKAI ##############################

        $pemeriksaan_id = $this->input->post('pemeriksaan_id');
        $obat_pemeriksaan = $this
            ->DetailObatPemeriksaanModel
            ->getDetailObatByPemeriksaanId($pemeriksaan_id)
            ->result();

        foreach ($obat_pemeriksaan as $o) {
            $stok_lawas = $this->ObatModel->getObatById($o->obat_id)->row()->stok_obat;
            $stok_baru = $stok_lawas - $o->jumlah_satuan;
            $this->MainModel->update('obat', ['stok_obat' => $stok_baru], $o->obat_id);
        }

        $obatnya_obat_racikan = $this
            ->DetailObatRacikanPemeriksaanModel
            ->getAllObatOfObatRacikanByPemeriksaanId($pemeriksaan_id)
            ->result();

        foreach ($obatnya_obat_racikan as $o) {
            $stok_lawas = $this->ObatModel->getObatById($o->obat_id)->row()->stok_obat;
            $stok_baru = $stok_lawas - $o->jumlah_satuan;
            $this->MainModel->update('obat', ['stok_obat' => $stok_baru], $o->obat_id);
        }

        $bahan_terpakai = $this
            ->DetailBahanPemeriksaanModel
            ->getDetailBahanByPemeriksaanId($pemeriksaan_id)
            ->result();

        foreach ($bahan_terpakai as $b) {
            $stok_lawas = $this->BahanHabisPakaiModel->getBahanById($b->bahan_id)->row()->jumlah;
            $stok_baru = $stok_lawas - $b->jumlah;
            $this->MainModel->update('bahan_habis_pakai', ['jumlah' => $stok_baru], $b->bahan_id);
        }

        // ############################## END MASALAH PENGUPDATEAN STOK OBAT DAN BAHAN HABIS PAKAI ##############################

        $data['racikan'] = $racikans;
        $bayar['jumlah'] = $this->input->post('jumlah');
        $data['pembayaran_result'] = $bayar;

        $this->session->set_flashdata('success', 'Submit pembayaran berhasil');
        $this->template->view('administrasi/nota_v', $data);
    }

    public function nota_obat_luar_submit() {
        $session = $this->session->userdata('logged_in');
        $bayar = [
            'penjualan_obat_luar_id' => $this->input->post('penjualan_id'),
            'jasa_racik' => $this->input->post('jasa_racik'),
            'diskon' => $this->input->post('diskon'),
            'total' => $this->input->post('total'),
            'bayar' => $this->input->post('bayar'),
            'kembalian' => $this->input->post('kembalian'),
            'creator' => $session->id
        ];
        $id_bayar = $this->MainModel->insert_id('bayar_obat_luar', $bayar);

        $nama_racikan = $this->input->post('nama_racikan');
        $total_racikan = $this->input->post('total_racikan');
        $k = 0;
        foreach ($nama_racikan as $key => $value) {
            $this->MainModel->insert('detail_bayar_obat_luar', [
                'bayar_obat_luar_id' => $id_bayar,
                'item' => $value,
                'jenis_item' => 'obat racikan',
                'jumlah' => 1,
                'harga' => '',
                'subtotal' => $total_racikan[$k],
                'creator' => $session->id
            ]);
            $k++;
        }

        $nama_obat = $this->input->post('nama_obat');
        $jumlah_satuan = $this->input->post('jumlah_satuan');
        $harga_jual = $this->input->post('harga_jual');
        $subtotal = $this->input->post('subtotal_obat');
        $j = 0;
        foreach ($nama_obat as $key => $value) {
            $this->MainModel->insert('detail_bayar_obat_luar', [
                'bayar_obat_luar_id' => $id_bayar,
                'item' => $nama_obat[$j],
                'jenis_item' => 'obat',
                'jumlah' => $jumlah_satuan[$j],
                'harga' => $harga_jual[$j],
                'subtotal' => $subtotal[$j],
                'creator' => $session->id
            ]);
            $j++;
        }

        if ($this->input->post('jasa_racik')) {
            $jasa_racik = array(
                'bayar_obat_luar_id' => $id_bayar,
                'item' => 'Jasa Racik',
                'jenis_item' => 'jasa racik',
                'jumlah' => 0,
                'harga' => $this->input->post('jasa_racik'),
                'subtotal' => $this->input->post('jasa_racik'),
                'creator' => $session->id,

            );
            $this->MainModel->insert('detail_bayar_obat_luar', $jasa_racik);
        }

        // done inserting and updating. redirecting...

        $id = $this->input->post('penjualan_id'); // id = penjualan_obat_luar_id
        $this->MainModel->update('penjualan_obat_luar', ['progress' => 'sudah_bayar'], $id);

        // ############################## MASALAH PENGUPDATEAN STOK OBAT OF OBAT LUAR ##############################

        $obats = $this
            ->ObatLuarModel
            ->getDetailPenjualanObatLuarByIdPenjualan($id);

        foreach ($obats as $o) {
            $stok_lawas = $this->ObatModel->getObatById($o->obat_id)->row()->stok_obat;
            $stok_baru = $stok_lawas - $o->jumlah_satuan;
            $this->MainModel->update('obat', ['stok_obat' => $stok_baru], $o->obat_id);
        }

        $obat_racikans = $this
            ->ObatLuarModel
            ->getAllObatOfObatRacikanByPemeriksaanId($id)
            ->result();

        foreach ($obat_racikans as $o) {
            $stok_lawas = $this->ObatModel->getObatById($o->obat_id)->row()->stok_obat;
            $stok_baru = $stok_lawas - $o->jumlah_satuan;
            $this->MainModel->update('obat', ['stok_obat' => $stok_baru], $o->obat_id);
        }

        // ############################## END MASALAH PENGUPDATEAN STOK OBAT OF OBAT LUAR ##############################

        $data['id_bayar'] = $id_bayar;
        $data['pembayaran'] = $this->AdministrasiModel->getBayarById($id_bayar); // INI

        $data['penjualan'] = $this->ObatLuarModel->getPenjualanById($id);
        $data['obat'] = $this->ObatLuarModel->getDetailPenjualanObatLuarByIdPenjualan($id);
        $data['racikan'] = $this->ObatLuarModel->getDetailPenjualanObatRacikanLuarByIdPenjualan($id);

        foreach ($data['racikan'] as $k => $detail_penjualan_obat_racikan_luar) {
            $data['racikan'][$k]->obat = $this->ObatLuarModel->getListObatByDetailPenjualanObatRacikanLuarId($detail_penjualan_obat_racikan_luar->id);
            foreach ($data['racikan'][$k]->obat as $kk => $vv) {
                $data['racikan'][$k]->total += $vv->jumlah_satuan * $vv->harga_jual;
            }
        }

        $bayar['jumlah'] = $this->input->post('jumlah');
        $data['pembayaran_result'] = $bayar;

        $this->session->set_flashdata('success', 'Submit pembayaran berhasil');
        $this->template->view('administrasi/nota_obat_luar_v', $data);
    }

    public function nota_print($id_bayar) {
        $data['pemeriksaan'] = $this->AdministrasiModel->getBayarById($id_bayar)->row();
        $data['tindakan'] = $this->AdministrasiModel->getTindakanBayarById($id_bayar);
        $data['obat'] = $this->AdministrasiModel->getObatBayarById($id_bayar);
        $data['obat_sunat'] = $this->AdministrasiModel->getObatSunatBayarById($id_bayar);
        $data['klinik'] = $this->AdministrasiModel->getKlinik()->row();
        $data['bahan'] = $this->AdministrasiModel->getBahanBayarById($id_bayar);
        $data['jasa_racik'] = $this->AdministrasiModel->getJasaRacikBayarById($id_bayar)->row()->harga;

        $racikans = $this->AdministrasiModel->getListRacikanByPemeriksaanId($data['pemeriksaan']->id)->result();
        foreach ($racikans as $k => $v) {
            $racikans[$k]->obat = $this->AdministrasiModel->getListObatByDetailObatRacikanPemeriksaanId($v->id)->result();
            foreach ($racikans[$k]->obat as $kk => $vv) {
                $racikans[$k]->total += $vv->jumlah_satuan * $vv->harga_jual;
            }
        }
        $data['racikan'] = $racikans;
        $data['klinik'] = $this->KlinikModel->getKlinik();
        $data['id_bayar'] = $id_bayar;

        $this->load->view('administrasi/nota_print', $data);
    }

    public function nota_obat_luar_print($id_bayar) {
        $data['penjualan'] = $this->ObatLuarModel->getPenjualanByIdBayar($id_bayar);
        $data['klinik'] = $this->KlinikModel->getKlinik();
        $data['obat'] = $this->ObatLuarModel->getObatBayarByIdBayar($id_bayar);
        $data['racikan'] = $this->ObatLuarModel->getListRacikanByIdPenjualanId($data['penjualan']->id);

        foreach ($data['racikan'] as $k => $detail_penjualan_obat_racikan_luar) {
            $data['racikan'][$k]->obat = $this->ObatLuarModel->getListObatByDetailPenjualanObatRacikanLuarId($detail_penjualan_obat_racikan_luar->id);
            foreach ($data['racikan'][$k]->obat as $kk => $vv) {
                $data['racikan'][$k]->total += $vv->jumlah_satuan * $vv->harga_jual;
            }
        }
//        die(json_encode($data['penjualan']->id));
//        die(json_encode($data));
        $data['id_bayar'] = $id_bayar;

        $this->load->view('administrasi/nota_obat_luar_print', $data);
    }

    public function surat_sehat($id) {
        $data['pemeriksaan'] = $this->AdministrasiModel->getPemeriksaanById($id)->row();
        $data['tindakan'] = $this->AdministrasiModel->getTindakanById($id);
        $data['obat'] = $this->AdministrasiModel->getObatPemeriksaanById($id);
        //print_r($data['tindakan']);die();
        $this->template->view('administrasi/surat_sehat_v', $data);
    }

    function getRomawi($bln) {
        switch ($bln) {
            case 1:
                return "I";
            case 2:
                return "II";
            case 3:
                return "III";
            case 4:
                return "IV";
            case 5:
                return "V";
            case 6:
                return "VI";
            case 7:
                return "VII";
            case 8:
                return "VIII";
            case 9:
                return "IX";
            case 10:
                return "X";
            case 11:
                return "XI";
            case 12:
                return "XII";
        }
        return '';
    }

    private function getNomorSurat($data, $id, $ss)
    {
        $ke = '01';
        $bulan = date('m', strtotime($data['pemeriksaan']->waktu_pemeriksaan));
        $tahun = date('Y', strtotime($data['pemeriksaan']->waktu_pemeriksaan));
        $pem_month = $this->db->query("SELECT * FROM pemeriksaan WHERE year(waktu_pemeriksaan) = '$tahun' and month(waktu_pemeriksaan) = '$bulan' ORDER BY id")->result();
        foreach ($pem_month as $k => $v) {
            if ($v->id == $id) {
                $ke = str_pad(($k + 1) . '', 2, '0', STR_PAD_LEFT);
                break;
            }
        }
        $bulan = $this->getRomawi((int) date('m', strtotime($data['pemeriksaan']->waktu_pemeriksaan)));
        $tahun = date('Y', strtotime($data['pemeriksaan']->waktu_pemeriksaan));
        return "$ke/KN/$ss/$bulan/$tahun";
    }

    public function surat_sehat_print($id) {
        $data['pendaftaran'] = $this->PemeriksaanModel->getPendaftaranByIdPemeriksaan($id)->row();
        $data['pemeriksaan'] = $this->AdministrasiModel->getPemeriksaanById($id)->row();
        $data['tindakan'] = $this->AdministrasiModel->getTindakanById($id);
        $data['obat'] = $this->AdministrasiModel->getObatPemeriksaanById($id);
        $data['klinik'] = $this->AdministrasiModel->getKlinik()->row();
        $data['nomor'] = $this->getNomorSurat($data, $id, 'SH');
        $data['usia'] = get_usia($data['pemeriksaan']->tanggal_lahir);

        $this->load->view('administrasi/surat_sehat_print_new', $data);
    }

    public function surat_consent($id) {
        $data['pendaftaran'] = $this->PemeriksaanModel->getPendaftaranByIdPemeriksaan($id)->row_array();
        $data['pemeriksaan'] = $this->AdministrasiModel->getPemeriksaanById($id)->row();
        $data['pasien'] = $this->db->query("SELECT * FROM pasien WHERE id = {$data['pemeriksaan']->pasien_id}")->row();
        $data['tindakan'] = $this->AdministrasiModel->getTindakanById($id);
        $data['obat'] = $this->AdministrasiModel->getObatPemeriksaanById($id);
        $data['klinik'] = $this->AdministrasiModel->getKlinik()->row();
        $data['listPerawat'] = $this->PerawatModel->listPerawat();

        $this->template->view('administrasi/surat_consent_v', $data);
    }

    public function surat_consent_print($id) {
        $data['pemeriksaan'] = $this->AdministrasiModel->getPemeriksaanById($id)->row();
        $data['pasien'] = $this->db->query("SELECT * FROM pasien WHERE id = {$data['pemeriksaan']->pasien_id}")->row();
        $data['tindakan'] = $this->AdministrasiModel->getTindakanById($id);
        $data['obat'] = $this->AdministrasiModel->getObatPemeriksaanById($id);
        $data['klinik'] = $this->AdministrasiModel->getKlinik()->row();
        $data['yth'] = $this->input->post('yth');
        $data['dokter'] = $this->input->post('dokter');
        $data['di'] = $this->input->post('di');
        $data['keluhan'] = $this->input->post('keluhan');
        $data['diagnosa'] = $this->input->post('diagnosa');
        $data['terapi'] = $this->input->post('terapi');
        $data['informed'] = (object) $this->input->post('informed');

        $this->load->view('administrasi/surat_consent_print_new', $data);
    }

    public function surat_sakit($id) {
        $data['pemeriksaan'] = $this->AdministrasiModel->getPemeriksaanById($id)->row();
        /*$data['tindakan'] = $this->AdministrasiModel->getTindakanById($id)->row();
        $data['obat'] = $this->AdministrasiModel->getObatPemeriksaanById($id)->row();
        print_r($data['obat']);die();		*/
        $this->template->view('administrasi/surat_sakit_v', $data);
    }

    public function surat_sakit_print($id) {
        $data['pemeriksaan'] = $this->AdministrasiModel->getPemeriksaanById($id)->row();
        $data['tindakan'] = $this->AdministrasiModel->getTindakanById($id);
        $data['obat'] = $this->AdministrasiModel->getObatPemeriksaanById($id);
        $data['klinik'] = $this->AdministrasiModel->getKlinik()->row();
        $data['nomor'] = $this->getNomorSurat($data, $id, 'SS');
        $data['usia'] = get_usia($data['pemeriksaan']->tanggal_lahir);

        $this->load->view('administrasi/surat_sakit_print_new', $data);
    }

    public function rekapitulasi() {

        if ($this->input->get('tgl')) {
            $data['listPemeriksaan'] = $this->PemeriksaanModel->getListPemeriksaanSelesai($this->input->get('tgl'));
            $data['tgl'] = $this->input->get('tgl');
        }
        else {
            $data['listPemeriksaan'] = $this->PemeriksaanModel->getListPemeriksaanSelesai('harian');
        }

        $data['tindakan'] = $this->AdministrasiModel->getTindakandetail();
        $data['obat'] = $this->AdministrasiModel->getObatPemeriksaandetail();
        $data['racikan'] = $this->AdministrasiModel->getRacikanPemeriksaan();
        $data['penyakit'] = $this->AdministrasiModel->getPenyakitPemeriksaandetail();
        $data['jaminan'] = $this->config->item('pendaftaran');


        $this->template->view('administrasi/rekapitulasi', $data);
    }
}

