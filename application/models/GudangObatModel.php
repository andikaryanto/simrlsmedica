<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *Handle database gudang
 *@author Abdush
 */
class GudangObatModel extends CI_Model
{

  function __construct()
  {
    // do noting
  }

  public function checkAvaliableItem($id_obat, $tgl_kedaluarsa)
  {
      $this->db->where([
        'id_obat' => $id_obat,
        'tanggal_kadaluwarsa' => $tgl_kedaluarsa
      ]);
      $data = $this->db->get('gudang_obat')->row();

      return $data;
  }

  public function updateStock($id_obat, $tgl_kedaluarsa, $stock)
  {
    $session = $this->session->userdata('logged_in');
    $old_data = $this->checkAvaliableItem($id_obat, $tgl_kedaluarsa);

    $id_item = 0;

    if ($old_data) {
      $new_stock = $old_data->jumlah + $stock;
      $this->db->where('id', $old_data->id);
      $this->db->update('gudang_obat', ['jumlah'=>$new_stock]);
      $id_item = $old_data->id;
    }
    else{
      $this->db->insert('gudang_obat', [
        'id_obat' => $id_obat,
        'tanggal_kadaluwarsa' =>  $tgl_kedaluarsa,
        'jumlah' => $stock,
        'creator' => $session->id
      ]);

      $id_item = $this->db->insert_id();
    }

    $this->updateDataObat($id_obat, false);
    return $id_item;
  }

  public function updateStockByID($id, $stock)
  {
    $session = $this->session->userdata('logged_in');
    
    $this->db->where([
        'id' => $id
      ]);
    $old_data = $this->db->get('gudang_obat')->row();

    $new_stock = $old_data->jumlah + $stock;
    $this->db->where('id', $old_data->id);
    $this->db->update('gudang_obat', ['jumlah'=>$new_stock]);
    $id_item = $old_data->id;
    $this->updateDataObat($old_data->id_obat, $stock);
    return $id_item;
  }

  public function updateDataObat($id_obat, $update_stok_obat)
  {
    $last_price = $this->db
      ->select(' id_obat, harga_beli, harga_jual')
      ->from('riwayat_pembelian_obat')
      ->where('id_obat', $id_obat)
      ->order_by('id', 'DESC')
      ->limit(1)
      ->get()->row();

    $stock = $this->db
      ->select_sum('jumlah')
      ->from('gudang_obat')
      ->where([
        'id_obat' => $id_obat,
        'gudang_obat.tanggal_kadaluwarsa >=' => date('Y-m-d')
      ])
      ->get()->row();

    $old_obat = $this->db
      ->from('obat')
      ->where([ 'id' => $id_obat ])
      ->get()->row();

    $data = [
      'harga_beli' => $last_price->harga_beli,
      'harga_jual' => $last_price->harga_jual
    ];
    
    if ($update_stok_obat) {
        $data['stok_obat'] = $old_obat->stok_obat - $update_stok_obat;
    }

    $this->db->where('id', $id_obat);
    $this->db->update('obat', $data);
  }

  public function getObat($ok = true)
  {
    $div = ($ok ? '>=' : '<');
    $data = $this->db
      ->select('
          gudang_obat.id,
	        gudang_obat.id_obat,
          gudang_obat.tanggal_kadaluwarsa,
          gudang_obat.jumlah,
          gudang_obat.updated_at,
          obat.nama,
          obat.jenis,
          obat.kategori,
          obat.nomor_batch
      ')
      ->from('gudang_obat')
      ->join('obat', 'gudang_obat.id_obat = obat.id', 'left')
      ->where('gudang_obat.tanggal_kadaluwarsa '. $div, date('Y-m-d'))
      ->get()->result();

    return $data;
  }

  public function updateMutasi($id_item, $jumlah, $tujuan, $note, $tanggal = false){
    $session = $this->session->userdata('logged_in');

    $data = [
      'id_item' => $id_item,
      'jumlah' => $jumlah,
      'tujuan' => $tujuan,
      'note' => $note,
      'creator' => $session->id
    ];

    if ($tanggal) $data['created_at'] = $tanggal;
    $this->db->insert('mutasi_obat', $data);

    return $this->db->insert_id();
  }

  public function getMutasi(){
    $data = $this->db
      ->select('
        mutasi_obat.id,
        mutasi_obat.id_item,
        mutasi_obat.jumlah,
        mutasi_obat.tujuan,
        mutasi_obat.note,
        mutasi_obat.created_at,
        gudang_obat.id_obat,
        gudang_obat.tanggal_kadaluwarsa,
        obat.nama,
        obat.kategori,
        obat.nomor_batch
      ')
      ->from('mutasi_obat')
      ->join('gudang_obat', 'mutasi_obat.id_item = gudang_obat.id', 'left')
      ->join('obat', 'gudang_obat.id_obat = obat.id', 'left')
      ->order_by('mutasi_obat.id', 'DESC')
      ->get()->result();

    return $data;
  }

  public function getObatOnGudang($id)
  {
    $data = $this->db
      ->select('
          gudang_obat.id,
          gudang_obat.id_obat,
          gudang_obat.tanggal_kadaluwarsa,
          gudang_obat.jumlah,
          gudang_obat.updated_at,
          obat.nama,
          obat.jenis,
          obat.kategori,
          obat.nomor_batch
      ')
      ->from('gudang_obat')
      ->join('obat', 'gudang_obat.id_obat = obat.id', 'left')
      ->where('gudang_obat.id_obat', $id)
      ->get()->result();

    return $data;
  }

}


?>
