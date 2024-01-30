<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ObatLuarModel extends CI_Model
{
    public function getPenjualanSudahObat()
    {
        return $this->db->where('progress !=', 'selesai')->get('penjualan_obat_luar')->result();
    }

    public function getPenjualanSudahBayar()
    {
        return $this->db
            ->select('pol.*, bol.total')
            ->join('bayar_obat_luar bol', 'pol.id = bol.penjualan_obat_luar_id')
            ->where('pol.progress', 'sudah_bayar')
            ->get('penjualan_obat_luar pol')
            ->result();
    }

    public function getPenjualanResepLuarSudahBayar($periode = '')
    {
        $this->db
            ->select('pol.*, bol.total, bol.jasa_racik')
            ->join('bayar_obat_luar bol', 'pol.id = bol.penjualan_obat_luar_id')
            ->where('pol.progress', 'sudah_bayar')
            ->where('pol.tipe', 'resep_luar');

        if ($periode == 'harian') {
            $this->db->where('DATE(pol.created_at) = CURDATE()', null, FALSE);
        }
        else if ($periode == 'bulanan') {
            $this->db->where('MONTH(pol.created_at) = MONTH(CURDATE())', null, FALSE);
        }
        else {
            $this->db->where("DATE(pol.created_at) = '$periode'", null, FALSE);
        }

        return $this->db
            ->get('penjualan_obat_luar pol')
            ->result();
    }

    public function getPenjualanObatBebasSudahBayar($periode = '')
    {
        $this->db
            ->select('pol.*, bol.total, bol.jasa_racik')
            ->join('bayar_obat_luar bol', 'pol.id = bol.penjualan_obat_luar_id')
            ->where('pol.progress', 'sudah_bayar')
            ->where('pol.tipe', 'obat_bebas');

        if ($periode == 'harian') {
            $this->db->where('DATE(pol.created_at) = CURDATE()', null, FALSE);
        }
        else if ($periode == 'bulanan') {
            $this->db->where('MONTH(pol.created_at) = MONTH(CURDATE())', null, FALSE);
        }
        else {
            $this->db->where("DATE(pol.created_at) = '$periode'", null, FALSE);
        }

        return $this->db
            ->get('penjualan_obat_luar pol')
            ->result();
    }

    public function getPenjualanObatInternalSudahBayar($periode = '')
    {
        $this->db
            ->select('pol.*, bol.total, bol.jasa_racik')
            ->join('bayar_obat_luar bol', 'pol.id = bol.penjualan_obat_luar_id')
            ->where('pol.progress', 'sudah_bayar')
            ->where('pol.tipe', 'obat_internal');

        if ($periode == 'harian') {
            $this->db->where('DATE(pol.created_at) = CURDATE()', null, FALSE);
        }
        else if ($periode == 'bulanan') {
            $this->db->where('MONTH(pol.created_at) = MONTH(CURDATE())', null, FALSE);
        }
        else {
            $this->db->where("DATE(pol.created_at) = '$periode'", null, FALSE);
        }

        return $this->db
            ->get('penjualan_obat_luar pol')
            ->result();
    }

    public function getPenjualanById($id)
    {
        return $this->db->where('id', $id)->get('penjualan_obat_luar')->row();
    }

    public function getPenjualanByIdBayar($id)
    {
        return $this->db
            ->select('pol.*, bol.diskon, bol.total, bol.bayar, bol.kembalian')
            ->join('bayar_obat_luar bol', 'bol.penjualan_obat_luar_id = pol.id')
            ->where('bol.id', $id)
            ->get('penjualan_obat_luar pol')
            ->row();
    }

    public function getDetailPenjualanObatLuar()
    {
        return $this->db
            ->select('dop.*, o.nama , o.harga_jual')
            ->join('obat o', 'o.id = dop.obat_id')
            ->get('detail_penjualan_obat_luar dop')
            ->result();
    }

    public function getDetailPenjualanObatRacikanLuar()
    {
        return $this->db
            ->get('detail_penjualan_obat_racikan_luar')
            ->result();
    }

    public function getRekapRacikan() {
        $sql = "
            SELECT id, nama_racikan, signa, sum(subtotal) as total, penjualan_obat_luar_id
            from (
                select dorp.*, ora.obat_id, ora.jumlah_satuan, o.nama, o.harga_jual, (ora.jumlah_satuan*o.harga_jual) 
                as subtotal 
                from detail_penjualan_obat_racikan_luar dorp 
                join obat_racikan_luar ora ON dorp.id = ora.detail_penjualan_obat_racikan_luar_id
                join obat o on o.id = ora.obat_id 
            ) 
            as AA 
            group by id, nama_racikan, signa
        ";
        return $this->db->query($sql)->result();
    }

    public function getDetailPenjualanObatLuarByIdPenjualan($id)
    {
        return $this->db
            ->select('dop.*, o.nama , o.harga_jual')
            ->join('obat o', 'o.id = dop.obat_id')
            ->where('dop.penjualan_obat_luar_id', $id)
            ->get('detail_penjualan_obat_luar dop')
            ->result();
    }

    public function getObatPemeriksaanById($id) {
        $this->db->select('dop.*, o.nama , o.harga_jual');
        $this->db->join('obat o', 'o.id = dop.obat_id');
        $this->db->where('dop.pemeriksaan_id', $id);
        $this->db->where('dop.is_active', '1');
        return $this->db->get('detail_obat_pemeriksaan dop');
    }

    public function getObatBayarByIdBayar($id) {

        return $this->db
            ->where('db.bayar_obat_luar_id', $id)
            ->where('db.jenis_item', 'obat')
            ->where('db.is_active', '1')
            ->get('detail_bayar_obat_luar db')
            ->result();
    }

    public function getListRacikanByIdPenjualanId($id) {
        $sql = "SELECT * FROM detail_penjualan_obat_racikan_luar WHERE penjualan_obat_luar_id = '$id'";
        return $this->db
            ->query($sql)
            ->result();
    }

    public function getDetailPenjualanObatRacikanLuarByIdPenjualan($id)
    {
        return $this->db
            ->where('dop.penjualan_obat_luar_id', $id)
            ->get('detail_penjualan_obat_racikan_luar dop')
            ->result();
    }

    public function getListObatByDetailPenjualanObatRacikanLuarId($id) {
        $sql = "
            SELECT o.*, ora.* FROM obat_racikan_luar ora 
            JOIN obat o 
            ON ora.obat_id = o.id 
            JOIN detail_penjualan_obat_racikan_luar dorp 
            ON ora.detail_penjualan_obat_racikan_luar_id = dorp.id 
            WHERE dorp.id = '$id'
            ";
        return $this->db->query($sql)->result();
    }

    public function getAllObatOfObatRacikanByPemeriksaanId($penjualan_id)
    {
        return $this->db->query("
            SELECT * FROM obat_racikan_luar ora 
            JOIN detail_penjualan_obat_racikan_luar dorp ON ora.detail_penjualan_obat_racikan_luar_id = dorp.id
            WHERE dorp.penjualan_obat_luar_id = '$penjualan_id'
        ");
    }
}
