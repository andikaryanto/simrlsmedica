<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HistoryBahanHabisPakaiModel extends CI_Model
{
    public function stokAwal($jenis, $tanggal, $bulan, $tahun)
    {
        $bhps = $this->db->where('is_active', 1)->order_by('id', 'ASC')->get('bahan_habis_pakai')->result();

        $where_date = '1';
        if ($jenis == 1) {
            $where_date = "DATE(created_at) = CURDATE()";
        }
        else if ($jenis == 2) {
            $where_date = "DATE(created_at) >= '$tanggal'";
        }
        else if ($jenis == 3) {
            $startDate = $tahun . '-' . str_pad($bulan, 2, '0', STR_PAD_LEFT) . '-01';
            $where_date = "DATE(created_at) >= '$startDate'";
        }

        foreach ($bhps as $bhp)
        {
            $history = $this->db->query("
                SELECT stok_lama 
                FROM history_bahan_habis_pakai
                WHERE bahan_habis_pakai_id = '{$bhp->id}'
                AND $where_date
                ORDER BY created_at
                LIMIT 1
            ")->result();

            if ($history)
                $bhp->stok_awal = $history[0]->stok_lama;
            else
                $bhp->stok_awal = $bhp->jumlah;
        }

        return $bhps;
    }

    public function stokAkhir($jenis, $tanggal, $bulan, $tahun)
    {
        $bhps = $this->db->where('is_active', 1)->order_by('id', 'ASC')->get('bahan_habis_pakai')->result();

        $where_date = '1';
        if ($jenis == 1) {
            $tanggal = date('Y-m-d');
            $where_date = "DATE(created_at) > '$tanggal'";
        }
        else if ($jenis == 2) {
            $where_date = "DATE(created_at) > '$tanggal'";
        }
        else if ($jenis == 3) {
            $days = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
            $endDate = $tahun . '-' . str_pad($bulan, 2, '0', STR_PAD_LEFT) . '-' . str_pad($days, 2, '0', STR_PAD_LEFT);
            $where_date = "DATE(created_at) > '$endDate'";
        }

        foreach ($bhps as $bhp)
        {
            $history = $this->db->query("
                SELECT stok_baru
                FROM history_bahan_habis_pakai
                WHERE bahan_habis_pakai_id = '{$bhp->id}'
                AND $where_date
                ORDER BY created_at
                LIMIT 1
            ")->result();

            if ($history)
                $bhp->stok_akhir = $history[0]->stok_baru;
            else
                $bhp->stok_akhir = $bhp->jumlah;
        }

        return $bhps;
    }

    public function riwayat($bulan, $tahun)
    {
        $days = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        $curDay = intval(date('d'));
        $curMonth = intval(date('m'));
        $curYear = intval(date('Y'));

        if ($tahun < $curYear || ($tahun == $curYear && $bulan < $curMonth))
            $endDay = $days;
        else if ($tahun > $curYear || ($tahun == $curYear && $bulan > $curMonth))
            $endDay = 1;
        else
            $endDay = $curDay;

        $perBhp = [];

        for ($a = 1; $a <= $endDay; $a++)
        {
            $perDay = $this->db->query("
                SELECT bahan_habis_pakai.*, 
                       IFNULL((
                           SELECT SUM(jumlah) FROM history_bahan_habis_pakai 
                           WHERE bahan_habis_pakai_id = bahan_habis_pakai.id 
                             AND jenis = 'masuk' 
                             AND DAY(created_at) = '$a'
                             AND MONTH(created_at) = '$bulan'
                             AND YEAR(created_at) = '$tahun'
                           ), 0) AS masuk, 
                       IFNULL((
                           SELECT SUM(jumlah) FROM history_bahan_habis_pakai
                           WHERE bahan_habis_pakai_id = bahan_habis_pakai.id 
                             AND jenis = 'keluar'
                             AND DAY(created_at) = '$a'
                             AND MONTH(created_at) = '$bulan'
                             AND YEAR(created_at) = '$tahun'
                           ), 0) AS keluar 
                FROM bahan_habis_pakai
                WHERE is_active = '1'
                ORDER BY bahan_habis_pakai.id
             ")->result();

            foreach ($perDay as $i)
            {
                if (!isset($perBhp[$i->id]))
                    $perBhp[$i->id] = [];

                $perBhp[$i->id][$a] = $i;
            }
        }

        $res = [];

        foreach ($perBhp as $k => $v)
        {
            $row = [];

            foreach ($v as $kk => $vv)
            {
                if (!isset($row['history']))
                    $row['history'] = [];

                $row['history'][$kk] = [
                    'masuk' => $vv->masuk,
                    'keluar' => $vv->keluar,
                ];

                if (!isset($row['bahan_habis_pakai']))
                {
                    $row['bahan_habis_pakai'] = $vv;

                    unset($row['bahan_habis_pakai']->masuk);
                    unset($row['bahan_habis_pakai']->keluar);
                }
            }

            $res[] = $row;
        }

        return [
            'jumlah_hari' => $endDay,
            'hari_akhir' => $days,
            'data' => $res
        ];
    }
}