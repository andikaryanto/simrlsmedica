<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *Handle database gudang
 * @author Abdush
 */
class GudangBahanModel extends CI_Model {

    function __construct() {
        // do noting
    }

    public function checkAvaliableItem($id_bahan) {
        $this->db->where([
            'id_bahan' => $id_bahan
        ]);
        $data = $this->db->get('gudang_bahan')->row();

        return $data;
    }

    public function updateStock($id_bahan, $stock) {
        $session = $this->session->userdata('logged_in');
        $old_data = $this->checkAvaliableItem($id_bahan);

        $id_item = 0;

        if ($old_data) {
            $new_stock = $old_data->jumlah + $stock;
            $this->db->where('id', $old_data->id);
            $this->db->update('gudang_bahan', ['jumlah' => $new_stock]);
            $id_item = $old_data->id;
        } else {
            $this->db->insert('gudang_bahan', [
                'id_bahan' => $id_bahan,
                'jumlah' => $stock,
                'creator' => $session->id
            ]);

            $id_item = $this->db->insert_id();
        }

        $this->updateDataObat($id_bahan, false);
        return $id_item;
    }

    public function updateStockByID($id, $stock) {
        $session = $this->session->userdata('logged_in');

        $this->db->where([
            'id' => $id
        ]);
        $old_data = $this->db->get('gudang_bahan')->row();

        $new_stock = $old_data->jumlah + $stock;
        $this->db->where('id', $old_data->id);
        $this->db->update('gudang_bahan', ['jumlah' => $new_stock]);
        $id_item = $old_data->id;
        $this->updateDataObat($old_data->id_bahan,$stock);
        return $id_item;
    }

    public function updateDataObat($id_bahan, $update_stock) {
        $last_price = $this->db
            ->select(' id_bahan, harga_beli, harga_jual')
            ->from('riwayat_pembelian_bahan')
            ->where('id_bahan', $id_bahan)
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get()->row();

        $stock = $this->db
            ->select_sum('jumlah')
            ->from('gudang_bahan')
            ->where([
                'id_bahan' => $id_bahan
            ])
            ->get()->row();
        $old_bahan = $this->db
              ->from('bahan_habis_pakai')
              ->where([ 'id' => $id_bahan ])
              ->get()->row();

        $data = [
            'harga_beli' => $last_price->harga_beli,
            'harga_jual' => $last_price->harga_jual
        ];

        if ($update_stock) {
            $data['jumlah'] = $old_bahan->jumlah - $update_stock;
        }

        $this->db->where('id', $id_bahan);
        $this->db->update('bahan_habis_pakai', $data);
    }

    public function getObat() {
        $data = $this->db
            ->select('
          gudang_bahan.id,
	        gudang_bahan.id_bahan,
          gudang_bahan.jumlah,
          gudang_bahan.updated_at,
          bahan_habis_pakai.nama,
          bahan_habis_pakai.satuan
      ')
            ->from('gudang_bahan')
            ->join('bahan_habis_pakai', 'gudang_bahan.id_bahan = bahan_habis_pakai.id', 'left')
            ->get()->result();

        return $data;
    }

    public function updateMutasi($id_item, $jumlah, $tujuan, $note, $tanggal = false) {
        $session = $this->session->userdata('logged_in');

        $data = [
            'id_item' => $id_item,
            'jumlah' => $jumlah,
            'tujuan' => $tujuan,
            'note' => $note,
            'creator' => $session->id
        ];

        if ($tanggal) $data['created_at'] = $tanggal;
        $this->db->insert('mutasi_bahan', $data);

        return $this->db->insert_id();
    }

    public function getMutasi() {
        $data = $this->db
            ->select('
                mutasi_bahan.id,
                mutasi_bahan.id_item,
                mutasi_bahan.jumlah,
                mutasi_bahan.tujuan,
                mutasi_bahan.note,
                mutasi_bahan.created_at,
                gudang_bahan.id_bahan,
                bahan_habis_pakai.nama,
                bahan_habis_pakai.satuan
              ')
            ->from('mutasi_bahan')
            ->join('gudang_bahan', 'mutasi_bahan.id_item = gudang_bahan.id', 'left')
            ->join('bahan_habis_pakai', 'gudang_bahan.id_bahan = bahan_habis_pakai.id', 'left')
            ->order_by('mutasi_bahan.id', 'DESC')
            ->get()->result();

        return $data;
    }

    public function getObatOnGudang($id) {
        $data = $this->db
            ->select('
          gudang_bahan.id,
          gudang_bahan.id_bahan,
          gudang_bahan.jumlah,
          gudang_bahan.updated_at,
          bahan_habis_pakai.nama,
          bahan_habis_pakai.satuan
      ')
            ->from('gudang_bahan')
            ->join('bahan_habis_pakai', 'gudang_bahan.id_bahan = bahan_habis_pakai.id', 'left')
            ->where('gudang_bahan.id_bahan', $id)
            ->get()->result();

        return $data;
    }

}


?>
