<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KeuanganModel extends CI_Model {

    public function getListLabatindakan()
    {
        $this->db->where('is_active', '1');
        $this->db->where('jenis_item', 'tindakan');

        return $this->db->get('detail_bayar');
    }

    public function getListPemasukanDetail_OLD($item)
    {
        $this->db->where('is_active', '1');
        $this->db->where('jenis_item', $item);

        return $this->db->get('detail_bayar');
    }

    public function getListPemasukanDetail($item, $jenis_pendaftaran_id, $periode = 'harian')
    {
        $q = "
            SELECT db.* 
            FROM detail_bayar db
            JOIN bayar b ON db.bayar_id = b.id
            JOIN pemeriksaan p ON b.pemeriksaan_id = p.id
            JOIN pendaftaran_pasien pp ON p.pendaftaran_id = pp.id
            WHERE pp.jenis_pendaftaran_id = '$jenis_pendaftaran_id'
            AND db.jenis_item = '$item'
        ";

        if ($periode == 'harian') {
            // $q .= ' AND DATE(db.created_at) = CURDATE()';
        }
        else if (is_array($periode)) {
            // $q .= ' AND MONTH(db.created_at) = MONTH(CURDATE()) AND YEAR(db.created_at) = YEAR(CURDATE())';
            $q .= " AND db.created_at >= '{$periode['start']}' AND db.created_at <= '{$periode['end']}'";
        }
        else {
            $q .= ' AND MONTH(db.created_at) = MONTH(CURDATE()) AND YEAR(db.created_at) = YEAR(CURDATE())';
        }

        return $this->db->query($q);
    }

    public function getListPemasukanObatLuarDetail($tipe = 'all', $periode = 'harian')
    {
        $q = "
            SELECT db.* 
            FROM detail_bayar_obat_luar db
            JOIN bayar_obat_luar b ON db.bayar_obat_luar_id = b.id
            JOIN penjualan_obat_luar pol ON b.penjualan_obat_luar_id = pol.id
        ";

        if ($tipe == 'all') {
            $q .= "WHERE 1 ";
        }
        else {
            $q .= "WHERE pol.tipe = '$tipe' ";
        }

        if ($periode == 'harian') {
            // $q .= ' AND DATE(db.created_at) = CURDATE()';
        }
        else if (is_array($periode)) {
            // $q .= ' AND MONTH(db.created_at) = MONTH(CURDATE()) AND YEAR(db.created_at) = YEAR(CURDATE())';
            $q .= " AND db.created_at >= '{$periode['start']}' AND db.created_at <= '{$periode['end']}'";
        }
        else {
            $q .= ' AND MONTH(db.created_at) = MONTH(CURDATE()) AND YEAR(db.created_at) = YEAR(CURDATE())';
        }

        return $this->db->query($q);
    }

    public function getTotallabaTindakan() {
        return $this->db->query("SELECT jenis_item, sum(subtotal) as total from detail_bayar where is_active = '1' group by jenis_item");
    }

    public function getLabaByLayanan($periode = 'harian') {

        if ($periode == 'harian') {
            $time = '';
        }
        else if (is_array($periode)) {
            $time = " AND db.created_at >= '{$periode['start']} 00:00:00' AND db.created_at <= '{$periode['end']} 23:59:59'";
        }
        else {
            $time = ' AND MONTH(db.created_at) = MONTH(CURDATE()) AND YEAR(db.created_at) = YEAR(CURDATE())';
        }

        $qq = "
            SELECT tbl.jenis_item, SUM(tbl.total) as total, tbl.jaminan, tbl.created_at FROM (
                    SELECT db.jenis_item, SUM(db.subtotal) as total, pp.jaminan, db.created_at
                    FROM detail_bayar db
                    JOIN bayar b ON db.bayar_id = b.id
                    JOIN pemeriksaan p ON b.pemeriksaan_id = p.id
                    JOIN pendaftaran_pasien pp ON p.pendaftaran_id = pp.id
                    JOIN pasien pas ON pas.id = p.pasien_id AND pas.is_active = '1'
                    WHERE db.is_active = '1'
                    AND pp.jaminan <> ''
                    AND pp.jaminan <> 'Umum'
                    AND p.status = 'selesai'
                    $time
                    GROUP BY pp.jaminan
            ) tbl
            GROUP BY tbl.jaminan
        ";

        return $this->db->query($qq);
    }

    public function getListPiutangByJaminan($periode, $jaminan = 'umum')
    {
        if ($periode == 'harian') {
            $time = '';
        }
        else if (is_array($periode)) {
            $time = " AND db.created_at >= '{$periode['start']} 00:00:00' AND db.created_at <= '{$periode['end']} 23:59:59'";
        }
        else {
            $time = ' AND MONTH(db.created_at) = MONTH(CURDATE()) AND YEAR(db.created_at) = YEAR(CURDATE())';
        }

        $q = "
            SELECT * FROM (
                    SELECT 1 as table_id, db.jenis_item, db.item, db.jumlah, db.harga, db.subtotal, 
                    p.waktu_pemeriksaan, pas.nama nama_pasien, pas.no_rm, u.nama nama_dokter, jp.nama ruangan 
                    FROM detail_bayar db JOIN bayar b ON db.bayar_id = b.id 
                    JOIN pemeriksaan p ON b.pemeriksaan_id = p.id 
                    JOIN pendaftaran_pasien pp ON p.pendaftaran_id = pp.id 
                    JOIN jenis_pendaftaran jp ON jp.id = pp.jenis_pendaftaran_id
                    JOIN pasien pas ON pas.id = p.pasien_id AND pas.is_active = '1'
                    join user u on u.id = p.dokter_id
                    WHERE db.is_active = '1' AND pp.jaminan = '$jaminan'   
                    AND p.status = 'selesai'
                    $time
            ) tbl
            order by tbl.waktu_pemeriksaan
        ";

        return $this->db->query($q);
    }

    public function getLabaByPendaftaran($jenis_pemasukan, $periode = 'harian') {

        $q = "
            SELECT db.jenis_item, SUM(db.subtotal) as total, jp.id as jenis_pendaftaran_id, jp.nama as jenis_pendaftaran
            FROM detail_bayar db
            JOIN bayar b ON db.bayar_id = b.id
            JOIN pemeriksaan p ON b.pemeriksaan_id = p.id
            JOIN pendaftaran_pasien pp ON p.pendaftaran_id = pp.id
            JOIN jenis_pendaftaran jp ON pp.jenis_pendaftaran_id = jp.id
            WHERE db.is_active = '1' AND db.jenis_item = '$jenis_pemasukan' 
        ";

        if ($periode == 'harian') {
            // $q .= ' AND DATE(db.created_at) = CURDATE()';
        }
        else if (is_array($periode)) {
            // $q .= ' AND MONTH(db.created_at) = MONTH(CURDATE()) AND YEAR(db.created_at) = YEAR(CURDATE())';
            $q .= " AND db.created_at >= '{$periode['start']}' AND db.created_at <= '{$periode['end']}'";
        }
        else {
            $q .= ' AND MONTH(db.created_at) = MONTH(CURDATE()) AND YEAR(db.created_at) = YEAR(CURDATE())';
        }
        // echo json_encode($q);die();

        $q .= ' GROUP BY jp.id';

        return $this->db->query($q);
    }

    public function getLabaObatLuarByPendaftaran($periode = 'harian') {

        $q = "
            SELECT db.jenis_item, SUM(db.subtotal) as total, pol.tipe
            FROM detail_bayar_obat_luar db
            JOIN bayar_obat_luar b ON db.bayar_obat_luar_id = b.id
            JOIN penjualan_obat_luar pol ON b.penjualan_obat_luar_id = pol.id
            WHERE db.is_active = '1'  
        ";

        if ($periode == 'harian') {
            // $q .= ' AND DATE(db.created_at) = CURDATE()';
        }
        else if (is_array($periode)) {
            // $q .= ' AND MONTH(db.created_at) = MONTH(CURDATE()) AND YEAR(db.created_at) = YEAR(CURDATE())';
            $q .= " AND db.created_at >= '{$periode['start']}' AND db.created_at <= '{$periode['end']}'";
        }
        else {
            $q .= ' AND MONTH(db.created_at) = MONTH(CURDATE()) AND YEAR(db.created_at) = YEAR(CURDATE())';
        }
//         echo json_encode($q);die();

        $q .= ' GROUP BY pol.tipe';

        return $this->db->query($q);
    }

    public function getListLabaobat()
    {
        $this->db->where('is_active', '1' );
        $this->db->where('jenis_item', 'obat' );

        return $this->db->get('detail_bayar');
    }

    public function getListPengeluarantindakan()
    {
        $this->db->select('db.*,' );
        $this->db->from('detail_bayar db');
        $this->db->join('bayar b', 'b.id = db.bayar_id');
        $this->db->join('pemeriksaan pem', 'pem.id = b.pemeriksaan_id');
        $this->db->where('is_active', '1' );
        $this->db->where('jenis_item', 'tindakan' );
        return $this->db->get('detail_bayar db');
    }

    public function getListPengeluaranobat()
    {
        $this->db->where('is_active', '1' );
        $this->db->where('jenis_item', 'obat' );
        return $this->db->get('detail_bayar');
    }

    public function getTindakanPemeriksaan()
    {
                $this->db->select('dtp.*, td.nama , td.tarif_perawat, td.tarif_dokter, td.tarif_lain,  td.klinik,pem.waktu_pemeriksaan' );
                $this->db->join('tarif_tindakan td', 'td.id = dtp.tarif_tindakan_id and td.is_active = 1');
                $this->db->join('pemeriksaan pem', 'pem.id = dtp.pemeriksaan_id and pem.is_active = 1');
                $this->db->where('dtp.is_active', '1' );
                $this->db->order_by('dtp.pemeriksaan_id', 'ASC' );
        return  $this->db->get('detail_tindakan_pemeriksaan dtp');
    }

     public function getTotalTindakan()
    {
                $this->db->select('sum(td.tarif_perawat) tarif_perawat, sum(td.tarif_dokter) tarif_dokter, sum(td.tarif_lain) tarif_lain,  sum(td.klinik) klinik' );
                $this->db->join('tarif_tindakan td', 'td.id = dtp.tarif_tindakan_id and td.is_active = 1');
                $this->db->join('pemeriksaan pem', 'pem.id = dtp.pemeriksaan_id and pem.is_active = 1');
                $this->db->where('dtp.is_active', '1' );
                $this->db->group_by('dtp.is_active');
                $this->db->order_by('dtp.pemeriksaan_id', 'ASC' );
        return  $this->db->get('detail_tindakan_pemeriksaan dtp');
    }

    public function getObatPemeriksaan()
    {
                $this->db->select('dop.*, o.nama , o.harga_jual, o.harga_beli, pem.waktu_pemeriksaan' );
                $this->db->join('obat o', 'o.id = dop.obat_id');
                $this->db->join('pemeriksaan pem', 'pem.id = dop.pemeriksaan_id and pem.is_active = 1');
                $this->db->where('dop.is_active', '1' );
                $this->db->order_by('dop.pemeriksaan_id', 'ASC' );
        return  $this->db->get('detail_obat_pemeriksaan dop');
    }

    public function getTotalObatPemeriksaan()
    {
                $this->db->select('sum(dop.jumlah_satuan * o.harga_beli ) as subtotal' );
                $this->db->join('obat o', 'o.id = dop.obat_id');
                $this->db->join('pemeriksaan pem', 'pem.id = dop.pemeriksaan_id and pem.is_active = 1');
                $this->db->where('dop.is_active', '1' );
                $this->db->group_by('dop.is_active');
        return  $this->db->get('detail_obat_pemeriksaan dop');
    }

    public function getListPemasukanTindakan($start_date, $end_date, $jenis_pendaftaran_id, $tindakan_ids, $jaminan, $dokter)
    {
        $res = [];

        if (!$jenis_pendaftaran_id || is_numeric($jenis_pendaftaran_id)) {
            $t = join(',', $tindakan_ids);
            $tindakan_filter = count($tindakan_ids) ? "AND db.item_id IN($t)" : '';

            $jenis_pendaftaran_filter = $jenis_pendaftaran_id ? "AND pp.jenis_pendaftaran_id = '$jenis_pendaftaran_id'" : '';
            $jaminan_filter = $jaminan ? "AND pp.jaminan = '$jaminan'" : '';
            $dokter_filter = $dokter ? "AND p.dokter_id = $dokter" : '';

            $r = $this->db
                ->query("
                    SELECT db.*, b.created_at, pas.nama as nama_pasien, u.nama as nama_dokter, jp.nama as nama_poli, pp.jaminan
                    FROM detail_bayar db
                    JOIN bayar b ON db.bayar_id = b.id
                    JOIN pemeriksaan p ON b.pemeriksaan_id = p.id
                    JOIN pendaftaran_pasien pp ON p.pendaftaran_id = pp.id
                    JOIN pasien pas ON pas.id = pp.pasien and pas.is_active = 1
                    JOIN user u ON u.id = p.dokter_id and u.is_active = 1
                    JOIN jenis_pendaftaran jp ON jp.id = pp.jenis_pendaftaran_id
                    WHERE db.jenis_item = 'tindakan'
                    AND b.created_at >= '$start_date 00:00:00'
                    AND b.created_at <= '$end_date 23:59:59'
                    AND p.status = 'selesai'
                    $jenis_pendaftaran_filter
                    $tindakan_filter
                    $jaminan_filter
                    $dokter_filter
                    ORDER BY b.created_at
                ")
                ->result();

            $res = array_merge($res, $r);
        }

        if (!$jenis_pendaftaran_id) {
            usort($res, function ($a, $b) {
                return strtotime($a->created_at) <=> strtotime($b->created_at);
            });
        }

        return $res;
    }

    public function getFrekuensiTindakan($start_date, $end_date, $jenis_pendaftaran_id, $jaminan)
    {
        $jenis_pendaftaran_filter = $jenis_pendaftaran_id ? "AND pp.jenis_pendaftaran_id = '$jenis_pendaftaran_id'" : '';
        $jaminan_filter = $jaminan ? "AND pp.jaminan = '$jaminan'" : '';

        $q = "
            SELECT db.item_id as id, db.item as nama, count(db.item_id) as frekuensi,
                IF(TIME(db.created_at) >= '08:00:00' AND TIME(db.created_at) < '18:00:00', 'Shift I', 'Shift II') as shift
            FROM detail_bayar db
            JOIN bayar b ON db.bayar_id = b.id
            JOIN pemeriksaan p ON b.pemeriksaan_id = p.id
            JOIN pendaftaran_pasien pp ON p.pendaftaran_id = pp.id
            JOIN jenis_pendaftaran jp ON jp.id = pp.jenis_pendaftaran_id
            WHERE db.jenis_item = 'tindakan'
            AND db.created_at >= '$start_date 00:00:00'
            AND db.created_at <= '$end_date 23:59:59'
            AND p.status = 'selesai'
            $jenis_pendaftaran_filter
            $jaminan_filter
            GROUP BY db.item_id HAVING count(db.item_id) > 0 
            ORDER BY frekuensi DESC 
        ";

        return $this->db->query($q);
    }

}
