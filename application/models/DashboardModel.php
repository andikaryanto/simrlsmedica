<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardModel extends CI_Model
{
    public function getTotalTransaksiBulanIniV2()
    {
        $q = " 
            select sum(total) as total 
            from bayar b
            join pemeriksaan p on b.pemeriksaan_id = p.id and p.is_active = 1
            JOIN pendaftaran_pasien pp ON pp.id = p.pendaftaran_id and pp.is_active = 1
            join pasien pas on pas.id = p.pasien_id and pas.is_active = 1
            JOIN user u ON u.id = pp.dokter AND u.is_active = '1' 
            where (p.status = 'selesai')
            AND MONTH(b.created_at) = MONTH(CURDATE()) AND YEAR(b.created_at) = YEAR(CURDATE())
        ";

        return $this->db->query($q);
    }

    public function getTotalTransaksiBulanIni()
    {
        $q = "
            SELECT tbl.jenis_item, SUM(tbl.total) as total, tbl.jaminan, tbl.created_at FROM (
                SELECT db.jenis_item, SUM(db.subtotal) as total, pp.jaminan, db.created_at
                FROM detail_bayar db
                JOIN bayar b ON db.bayar_id = b.id
                JOIN pemeriksaan p ON b.pemeriksaan_id = p.id
                JOIN pendaftaran_pasien pp ON p.pendaftaran_id = pp.id
                JOIN pasien pas ON pas.id = p.pasien_id AND pas.is_active = '1'
                WHERE db.is_active = '1'
                AND (p.status = 'selesai' OR p.status = 'bayar' OR p.status = 'sudah_bayar')
                AND MONTH(db.created_at) = MONTH(CURDATE()) AND YEAR(db.created_at) = YEAR(CURDATE())
                GROUP BY pp.jaminan
            ) tbl
        ";

        return $this->db->query($q);
    }

    public function getListTotalTransaksiBulanIni()
    {
        $q = " 
            SELECT SUM(tbl.total_bayar) as total_bayar, tbl.nama_jenis_pendaftaran, tbl.id_poli, tbl.jenis FROM (
                 SELECT SUM(b.total) AS total_bayar, jp.nama as nama_jenis_pendaftaran, jp.id as id_poli, 'poli' as jenis
                 FROM bayar b 
                 JOIN pemeriksaan p ON b.pemeriksaan_id = p.id
                 JOIN pendaftaran_pasien pp ON p.pendaftaran_id = pp.id
                 JOIN jenis_pendaftaran jp ON jp.id = pp.jenis_pendaftaran_id
                 JOIN pasien pas ON pas.id = pp.pasien AND pas.is_active = '1'
                 JOIN user u ON u.id = pp.dokter AND u.is_active = '1'
                 WHERE (p.status = 'selesai' OR p.status = 'bayar' OR p.status = 'sudah_bayar')
                 AND MONTH(b.created_at) = MONTH(CURDATE()) AND YEAR(b.created_at) = YEAR(CURDATE())
                 GROUP BY jp.id 
            ) tbl
            GROUP BY tbl.nama_jenis_pendaftaran
            ORDER BY total_bayar DESC
        ";

        return $this->db->query($q);
    }

    public function getKunjungan()
    {
        return $this->db
            ->select('day(pp.waktu_pendaftaran) tanggal, count(*) as jumlah')
            ->from('pendaftaran_pasien pp')
            ->join('pemeriksaan pem', 'pem.pendaftaran_id = pp.id')
            ->join('pasien p', 'p.id = pp.pasien and p.is_active = 1')
            ->where('month(pp.waktu_pendaftaran) = month(current_date())')
            ->where('year(pp.waktu_pendaftaran) = year(current_date())')
            ->where("(pem.status = 'sudah_bayar' OR pem.status = 'bayar' OR pem.status = 'selesai')")
            ->group_by('year(pp.waktu_pendaftaran), month(pp.waktu_pendaftaran), day(pp.waktu_pendaftaran)')
            ->order_by('tanggal')
            ->get();
    }

    public function getKunjunganHariIni()
    {
        return $this->db->select('*')
            ->from('pendaftaran_pasien pp')
            ->join('pasien p', 'p.id = pp.pasien and p.is_active = 1')
            ->join('pemeriksaan pem', 'pem.pendaftaran_id = pp.id')
            ->where('DATE(pp.created_at) = CURDATE()', null, false)
            ->where("(pem.status = 'sudah_bayar' OR pem.status = 'bayar' OR pem.status = 'selesai')")
            ->get();
    }

    public function getPenyakit()
    {
        // sekarang pake ini, soalnya x axis adalah penyakit
        return $this->db->query("
            select pen.nama, count(pen.id) as jumlah
            from detail_penyakit_pemeriksaan dpp
            join penyakit pen ON pen.id = dpp.penyakit_id and pen.is_active = 1
            join pemeriksaan p ON p.id = dpp.pemeriksaan_id and p.is_active = 1
            where month(p.waktu_pemeriksaan) = month(current_date())
            and year(p.waktu_pemeriksaan) = year(current_date())
            group by pen.id
            order by jumlah DESC 
        ");

        // dulu pake ini, soalnya x axis adalah tgl
//        return $this->db->query("
//            select pen.nama, day(p.waktu_pemeriksaan) tanggal
//            from detail_penyakit_pemeriksaan dpp
//            join penyakit pen ON pen.id = dpp.penyakit_id and pen.is_active = 1
//            join pemeriksaan p ON p.id = dpp.pemeriksaan_id and p.is_active = 1
//            where month(p.waktu_pemeriksaan) = month(current_date())
//            and year(p.waktu_pemeriksaan) = year(current_date())
//        ");
    }

    public function getLabaObatLuarByPendaftaran($periode = '') {

        $q = "
            SELECT SUM(db.subtotal) as total_bayar, pol.tipe as id_poli, pol.tipe as nama_jenis_pendaftaran
            FROM detail_bayar_obat_luar db
            JOIN bayar_obat_luar b ON db.bayar_obat_luar_id = b.id
            JOIN penjualan_obat_luar pol ON b.penjualan_obat_luar_id = pol.id
            WHERE db.is_active = '1'  
        ";

        if (is_array($periode)) {
            $q .= " AND db.created_at >= '{$periode['start']}' AND db.created_at <= '{$periode['end']}'";
        }
        else {
            $q .= ' AND MONTH(db.created_at) = MONTH(CURDATE()) AND YEAR(db.created_at) = YEAR(CURDATE())';
        }

        $q .= ' GROUP BY pol.tipe';

        return $this->db->query($q);
    }

    public function getPenjualanResepLuarSudahBayar($periode = '')
    {
        $this->db
            ->select('pol.*, bol.total, bol.jasa_racik')
            ->join('bayar_obat_luar bol', 'pol.id = bol.penjualan_obat_luar_id')
            ->where('pol.progress', 'sudah_bayar')
            ->where('pol.tipe', 'resep_luar');

        if (is_array($periode)) {
            $this->db->where('pol.created_at >=', $periode['start']);
            $this->db->where('pol.created_at <=', $periode['end'].' 23:59:59');
        }
        else {
            $this->db->where('MONTH(pol.created_at)', 'MONTH(CURDATE())', FALSE);
            $this->db->where('YEAR(pol.created_at)', 'YEAR(CURDATE())', FALSE);
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

        if (is_array($periode)) {
            $this->db->where('pol.created_at >=', $periode['start']);
            $this->db->where('pol.created_at <=', $periode['end'].' 23:59:59');
        }
        else {
            $this->db->where('MONTH(pol.created_at)', 'MONTH(CURDATE())', FALSE);
            $this->db->where('YEAR(pol.created_at)', 'YEAR(CURDATE())', FALSE);
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

        if (is_array($periode)) {
            $this->db->where('pol.created_at >=', $periode['start']);
            $this->db->where('pol.created_at <=', $periode['end'].' 23:59:59');
        }
        else {
            $this->db->where('MONTH(pol.created_at)', 'MONTH(CURDATE())', FALSE);
            $this->db->where('YEAR(pol.created_at)', 'YEAR(CURDATE())', FALSE);
        }

        return $this->db
            ->get('penjualan_obat_luar pol')
            ->result();
    }
}
