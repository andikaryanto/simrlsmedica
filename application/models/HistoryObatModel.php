<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HistoryObatModel extends CI_Model
{
    public function stokAwal($jenis, $tanggal, $bulan, $tahun)
    {
        $obats = $this->db->where('is_active', 1)->order_by('id', 'ASC')->get('obat')->result();

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

        foreach ($obats as $obat)
        {
            $history = $this->db->query("
                SELECT stok_lama 
                FROM history_obat
                WHERE obat_id = '{$obat->id}'
                AND $where_date
                ORDER BY created_at
                LIMIT 1
            ")->result();

            if ($history)
                $obat->stok_awal = $history[0]->stok_lama;
            else
                $obat->stok_awal = $obat->stok_obat;
        }

        return $obats;
    }

    public function stokAkhir($jenis, $tanggal, $bulan, $tahun)
    {
        $obats = $this->db->where('is_active', 1)->order_by('id', 'ASC')->get('obat')->result();

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

        foreach ($obats as $obat)
        {
            $history = $this->db->query("
                SELECT stok_baru
                FROM history_obat
                WHERE obat_id = '{$obat->id}'
                AND $where_date
                ORDER BY created_at
                LIMIT 1
            ")->result();

            if ($history)
                $obat->stok_akhir = $history[0]->stok_baru;
            else
                $obat->stok_akhir = $obat->stok_obat;
        }

        return $obats;
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

        $perObat = [];

        for ($a = 1; $a <= $endDay; $a++)
        {
            $perDay = $this->db->query("
                SELECT obat.*, 
                       IFNULL((
                           SELECT SUM(jumlah) FROM history_obat 
                           WHERE obat_id = obat.id 
                             AND jenis = 'masuk' 
                             AND DAY(created_at) = '$a'
                             AND MONTH(created_at) = '$bulan'
                             AND YEAR(created_at) = '$tahun'
                           ), 0) AS masuk, 
                       IFNULL((
                           SELECT SUM(jumlah) FROM history_obat 
                           WHERE obat_id = obat.id 
                             AND jenis = 'keluar'
                             AND DAY(created_at) = '$a'
                             AND MONTH(created_at) = '$bulan'
                             AND YEAR(created_at) = '$tahun'
                           ), 0) AS keluar 
                FROM obat
                WHERE is_active = '1'
                ORDER BY obat.id
             ")->result();

            foreach ($perDay as $i)
            {
                if (!isset($perObat[$i->id]))
                    $perObat[$i->id] = [];

                $perObat[$i->id][$a] = $i;
            }
        }

        $res = [];

        foreach ($perObat as $k => $v)
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

                if (!isset($row['obat']))
                {
                    $row['obat'] = $vv;

                    unset($row['obat']->masuk);
                    unset($row['obat']->keluar);
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