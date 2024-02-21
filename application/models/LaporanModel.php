<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanModel extends CI_Model {


    public function getListPendaftaran_antri()
    {
                $this->db->select('pp.*, p.nama nama_pasien, p.jk, p.usia, u.nama nama_dokter, jp.nama jenis_pendaftaran' );
                $this->db->from('pendaftaran_pasien pp');
                $this->db->join('pasien p', 'p.id = pp.pasien and p.is_active = 1');
                $this->db->join('user u', 'u.id = pp.dokter and u.is_active = 1');
                $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id and jp.is_active = 1');
                $this->db->where('pp.is_active', '1' );
                $this->db->where('pp.status', 'antri' );
        return  $this->db->get();
    }

    public function getPemeriksaanSudahPeriksaByIdPemeriksaan($id)
    {
        return $this->db
            ->select('pem.*, p.nama as nama_pasien, p.jk, p.usia, p.alamat, p.telepon, p.pekerjaan, u.nama nama_dokter' )
            ->from('pemeriksaan pem')
            ->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1')
            ->join('user u', 'u.id = pem.dokter_id and u.is_active = 1')
            ->join('pendaftaran_pasien pp', 'pp.id = pem.pendaftaran_id')
            ->where('pem.is_active', '1' )
            ->where('pem.id', $id )
            ->where("(pem.status = 'bayar' OR pem.status = 'selesai' OR pem.status = 'sudah_periksa')")
            ->limit(500)
            ->get();
    }

    public function getPendaftaranById($id)
    {
               $this->db->select('pp.*, p.nama nama_pasien, p.jk, p.usia, u.nama nama_dokter, jp.nama jenis_pendaftaran' );
                $this->db->from('pendaftaran_pasien pp');
                $this->db->join('pasien p', 'p.id = pp.pasien and p.is_active = 1');
                $this->db->join('user u', 'u.id = pp.dokter and u.is_active = 1');
                $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id and jp.is_active = 1');
                $this->db->where('pp.is_active', '1' );
                $this->db->where('pp.id', $id );

        return $this->db->get();
    }


    public function getJenisPendaftaran()
    {
                $this->db->where('is_active', '1' );
                $this->db->where('status', '1' );
        return  $this->db->get('jenis_pendaftaran');
    }

    public function getListPendaftaran($start_date,$end_date,$tipe_pasien)
    {
        $this->db->select('pp.*, p.id pasien_id, pem.id as pemeriksaan_id, p.nama nama_pasien, p.no_rm, p.jk, p.usia, p.alamat, u.nama nama_dokter, jp.id as jenis_pendaftaran_id, jp.nama jenis_pendaftaran' );
        $this->db->from('pendaftaran_pasien pp');
        $this->db->join('pasien p', 'p.id = pp.pasien and p.is_active = 1');
        $this->db->join('user u', 'u.id = pp.dokter and u.is_active = 1');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id and jp.is_active = 1');
        $this->db->join('pemeriksaan pem', 'pp.id = pem.pendaftaran_id');
        $this->db->where('pp.is_active', '1' );
        $this->db->where('pp.waktu_pendaftaran >=', $start_date );
        $this->db->where('pp.waktu_pendaftaran <=', $end_date );
        if ($tipe_pasien) $this->db->where('pp.jaminan', $tipe_pasien );
        return $this->db->get();
    }

    public function getListPendaftaranByJenis($start_date,$end_date, $jenis_pendaftaran)
    {
        $this->db->select('pp.*, p.id pasien_id, pem.id as pemeriksaan_id, p.nama nama_pasien, p.no_rm, p.jk, p.usia, p.alamat, u.nama nama_dokter, jp.id as jenis_pendaftaran_id, jp.nama jenis_pendaftaran' );
        $this->db->from('pendaftaran_pasien pp');
        $this->db->join('pasien p', 'p.id = pp.pasien and p.is_active = 1');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id and jp.is_active = 1');
        $this->db->join('pemeriksaan pem', 'pp.id = pem.pendaftaran_id');
        $this->db->join('user u', 'u.id = pem.dokter_id and u.is_active = 1');
        $this->db->where('pp.is_active', '1' );
        $this->db->where('pp.waktu_pendaftaran >=', $start_date );
        $this->db->where('pp.waktu_pendaftaran <=', $end_date );
        if ($jenis_pendaftaran) 
            $this->db->where('jp.id', $jenis_pendaftaran);
        return $this->db->get();
    }

    public function getKunjunganPasien($start_date,$end_date, $jenis_pendaftaran = null)
    {
        $this->db->select('jp.id, jp.nama as nama, count(pp.jaminan) as jumlah' );
        $this->db->from('pendaftaran_pasien pp');
        $this->db->join('pasien p', 'p.id = pp.pasien and p.is_active = 1');
        $this->db->join('user u', 'u.id = pp.dokter and u.is_active = 1');
        $this->db->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id and jp.is_active = 1');
        $this->db->where('pp.is_active', '1' );
        $this->db->where('pp.waktu_pendaftaran >=', $start_date );
        $this->db->where('pp.waktu_pendaftaran <=', $end_date );

        if ($jenis_pendaftaran) 
        $this->db->where('jp.id', $jenis_pendaftaran);

        $this->db->group_by('jp.id');
        return  $this->db->get();
    }

    public function getJumlahPasien($start_date,$end_date)
    {
        return  $this->db->query("
            SELECT count(distinct pp.pasien) as jumlah, pp.jaminan as nama, jp.id as id_jp from jenis_pendaftaran jp 
            join pendaftaran_pasien pp ON jp.id = pp.jenis_pendaftaran_id 
            WHERE jp.is_active = 1 AND jp.status = 1 AND pp.waktu_pendaftaran >= '$start_date' AND pp.waktu_pendaftaran <= '$end_date' 
            group by pp.jaminan");
    }

    public function getJumlahPasien_backup($start_date,$end_date)
    {
        return  $this->db->query("SELECT count(p.id) jumlah, jp.nama, jp.id as id_jp
                                from pasien p 
                                join pendaftaran_pasien pp ON pp.pasien = p.id  AND pp.is_active = 1
                                join jenis_pendaftaran jp ON jp.id = pp.jenis_pendaftaran_id AND jp.is_active = 1 AND jp.status = 1
                                WHERE pp.waktu_pendaftaran >= '$start_date'  AND pp.waktu_pendaftaran <= '$end_date' 
                                group by pp.pasien, jp.id");
    }

    public function listJumlahPasien($start_date,$end_date,$tipe_pasien)
    {
        $w = $tipe_pasien ? " AND pp.jaminan = '$tipe_pasien'" : '';
        return  $this->db->query("SELECT p.*, pp.jaminan, pp.waktu_pendaftaran , p.no_rm, u.nama as nama_dokter, p.id as pasien_id, pem.id as pemeriksaan_id
                                from pasien p 
                                join pendaftaran_pasien pp ON pp.pasien = p.id  AND pp.is_active = '1'
                                JOIN pemeriksaan pem ON pem.pendaftaran_id = pp.id
                                join jenis_pendaftaran jp ON jp.id = pp.jenis_pendaftaran_id AND jp.is_active = '1' AND jp.status = 1
                                join user u ON u.id = pp.dokter AND u.is_active = '1'
                                WHERE pp.waktu_pendaftaran >= '$start_date' AND pp.waktu_pendaftaran <= '$end_date' $w");
    }

    public function listJumlahPasienBaru($start_date,$end_date,$tipe_pasien)
    {
        $w = $tipe_pasien ? " AND pp.jaminan = '$tipe_pasien'" : '';
        return  $this->db->query("SELECT p.*, pp.jaminan, jp.nama as nama_jenis_pendaftaran, pp.waktu_pendaftaran , p.no_rm, u.nama as nama_dokter, p.usia, p.alamat, p.id as pasien_id
                                from pasien p 
                                join pendaftaran_pasien pp ON pp.pasien = p.id  AND pp.is_active = '1'
                                join jenis_pendaftaran jp ON jp.id = pp.jenis_pendaftaran_id AND jp.is_active = '1' AND jp.status = 1
                                join user u ON u.id = pp.dokter AND u.is_active = '1'
                                WHERE pp.waktu_pendaftaran >= '$start_date' AND pp.waktu_pendaftaran <= '$end_date' $w
                                AND p.created_at >= '$start_date' AND p.created_at <= '$end_date'");
    }

    public function jumlahPasienBaru($start_date,$end_date)
    {
        return  $this->db->query(" 
            SELECT count(distinct pp.pasien) as jumlah, pp.jaminan as nama, jp.id as id_jp from jenis_pendaftaran jp 
            join pendaftaran_pasien pp ON jp.id = pp.jenis_pendaftaran_id 
            join pasien p on pp.pasien = p.id 
            WHERE jp.is_active = 1 AND jp.status = 1 AND pp.waktu_pendaftaran >= '$start_date' AND pp.waktu_pendaftaran <= '$end_date'
            AND p.created_at >= '$start_date' AND p.created_at <= '$end_date'
            group by pp.jaminan");
    }

    public function listJumlahPasien20($start_date,$end_date,$jenis_pendaftaran)
    {
        return  $this->db->query("
            SELECT COUNT(pp.pasien) as total, p.nama, p.no_rm, p.usia, p.alamat, pp.jaminan
            FROM pendaftaran_pasien pp 
            JOIN pasien p ON p.id = pp.pasien AND p.is_active = '1'
            WHERE pp.waktu_pendaftaran >='".$start_date."' AND pp.waktu_pendaftaran <='".$end_date."'
            AND pp.jenis_pendaftaran_id = '$jenis_pendaftaran'
            GROUP BY pp.pasien
            ORDER BY total DESC
            LIMIT 20
        ");
//        return  $this->db->query("SELECT * FROM (SELECT p.*, count(pp.pasien) as jumlah,pp.waktu_pendaftaran, pp.jenis_pendaftaran_id,jp.nama as nama_jenis_pendaftaran
//                                from pasien p
//                                join pendaftaran_pasien pp ON pp.pasien = p.id  AND pp.is_active = '1'
//                                join jenis_pendaftaran jp ON jp.id = pp.jenis_pendaftaran_id AND jp.is_active = '1' AND jp.status = 1
//                                WHERE pp.waktu_pendaftaran >='".$start_date."' AND pp.waktu_pendaftaran <='".$end_date."'
//                                group by pp.pasien) as A WHERE jenis_pendaftaran_id =".$jenis_pendaftaran." order by jumlah DESC");
    }

    public function jumlahPasien20($start_date,$end_date)
    {
        return  $this->db->query("SELECT p.*, count(pp.pasien) as jumlah, jp.nama as nama_jenis_pendaftaran 
                                from pendaftaran_pasien pp 
                                join pasien p ON pp.pasien = p.id  AND p.is_active = '1'
                                join jenis_pendaftaran jp ON jp.id = pp.jenis_pendaftaran_id AND jp.is_active = '1' AND jp.status = 1
                                WHERE pp.waktu_pendaftaran >='".$start_date."' AND pp.waktu_pendaftaran <='".$end_date."'
                                group by pp.pasien order by count(pp.pasien) DESC");

    }

    public function getRataKunjungan($start_date,$end_date)
    {
        return  $this->db->query("
            SELECT year(pp.waktu_pendaftaran) tahun ,month(pp.waktu_pendaftaran) bulan ,day(pp.waktu_pendaftaran) tanggal, count(jp.nama) as jumlah, pp.jaminan nama, jp.id
            from pendaftaran_pasien pp
            join pasien p ON pp.pasien = p.id  AND pp.is_active = 1
            join jenis_pendaftaran jp ON jp.id = pp.jenis_pendaftaran_id AND jp.is_active = 1 AND jp.status = 1
            WHERE pp.waktu_pendaftaran >='".$start_date."' AND pp.waktu_pendaftaran <='".$end_date."'
            group by year(pp.waktu_pendaftaran),month(pp.waktu_pendaftaran),day(pp.waktu_pendaftaran)
        ");
    }

    public function getRataPasien($start_date,$end_date)
    {
        return  $this->db->query("
            SELECT year(pp.waktu_pendaftaran) tahun ,month(pp.waktu_pendaftaran) bulan ,day(pp.waktu_pendaftaran) tanggal, count(jp.nama) as jumlah, pp.jaminan nama, jp.id
            from pendaftaran_pasien pp
            join pasien p ON pp.pasien = p.id  AND pp.is_active = 1
            join jenis_pendaftaran jp ON jp.id = pp.jenis_pendaftaran_id AND jp.is_active = 1 AND jp.status = 1
            WHERE pp.waktu_pendaftaran >='".$start_date."' AND pp.waktu_pendaftaran <='".$end_date."'
            group by pp.pasien, year(pp.waktu_pendaftaran), month(pp.waktu_pendaftaran), day(pp.waktu_pendaftaran)
        ");
    }

    public function listRataKunjungan($start_date,$end_date)
    {
        return  $this->db->query("SELECT year(pp.waktu_pendaftaran) tahun ,month(pp.waktu_pendaftaran) bulan ,day(pp.waktu_pendaftaran) tanggal, p.*,pp.waktu_pendaftaran
                                from pasien p 
                                join pendaftaran_pasien pp ON pp.pasien = p.id  AND pp.is_active = 1
                                join jenis_pendaftaran jp ON jp.id = pp.jenis_pendaftaran_id AND jp.is_active = 1 AND jp.status = 1
                                WHERE pp.waktu_pendaftaran >='".$start_date."' AND pp.waktu_pendaftaran <='".$end_date."'
                               ");

    }

    public function getPerformaDokter($start_date, $end_date, $jenis_pendaftaran)
    {
        $w = $jenis_pendaftaran ? " AND pp.jenis_pendaftaran_id = '$jenis_pendaftaran' " : '';
        return  $this->db->query("
            select u.nama nama_dokter, jp.nama, count(*) jumlah 
            FROM pemeriksaan p 
            join user u ON u.id = p.dokter_id  AND u.is_active = 1
            join pendaftaran_pasien pp ON p.pendaftaran_id = pp.id  AND pp.is_active = 1
            join jenis_pendaftaran jp ON jp.id = pp.jenis_pendaftaran_id AND jp.is_active = 1 AND jp.status = 1
            WHERE p.waktu_pemeriksaan >='$start_date' AND p.waktu_pemeriksaan <='$end_date' $w
            GROUP BY u.id
       ");
    }

    public function getPerformaDokter2($jenis_pendaftaran)
    {
        $w = $jenis_pendaftaran ? " WHERE pp.jenis_pendaftaran_id = '$jenis_pendaftaran' " : '';
        return  $this->db->query("
            select u.nama nama_dokter, jp.nama, count(*) jumlah 
            FROM pemeriksaan p 
            join user u ON u.id = p.dokter_id  AND u.is_active = 1
            join pendaftaran_pasien pp ON p.pendaftaran_id = pp.id  AND pp.is_active = 1
            join jenis_pendaftaran jp ON jp.id = pp.jenis_pendaftaran_id AND jp.is_active = 1 AND jp.status = 1
            $w
            GROUP BY u.id
       ");
    }

    public function getPerformaPerawat($start_date, $end_date, $jenis_pendaftaran)
    {
        $w = $jenis_pendaftaran ? " AND pp.jenis_pendaftaran_id = '$jenis_pendaftaran' " : '';
        return  $this->db->query("
            select u.nama nama_perawat, jp.nama, count(*) jumlah 
            FROM pemeriksaan p 
            join user u ON u.id = p.perawat_id  AND u.is_active = 1
            join pendaftaran_pasien pp ON p.pendaftaran_id = pp.id  AND pp.is_active = 1
            join jenis_pendaftaran jp ON jp.id = pp.jenis_pendaftaran_id AND jp.is_active = 1 AND jp.status = 1
            WHERE p.waktu_pemeriksaan >='$start_date' AND p.waktu_pemeriksaan <='$end_date' $w
            GROUP BY u.id
       ");
    }

    public function getPerformaPerawat2($jenis_pendaftaran)
    {
        $w = $jenis_pendaftaran ? " WHERE pp.jenis_pendaftaran_id = '$jenis_pendaftaran' " : '';
        return  $this->db->query("
            select u.nama nama_perawat, jp.nama, count(*) jumlah 
            FROM pemeriksaan p 
            join user u ON u.id = p.perawat_id  AND u.is_active = 1
            join pendaftaran_pasien pp ON p.pendaftaran_id = pp.id  AND pp.is_active = 1
            join jenis_pendaftaran jp ON jp.id = pp.jenis_pendaftaran_id AND jp.is_active = 1 AND jp.status = 1
            $w
            GROUP BY u.id
       ");
    }

    public function listDokter()
    {

         $this->db->select('u.*,ug.id user_grup_id, g.nama_grup');
         $this->db->from('user u');
         $this->db->join('user_grup ug', 'ug.user_id = u.id');
         $this->db->join('grup g', 'ug.grup_id = g.id');
         $this->db->where('u.is_active', 1);
         $this->db->where('g.nama_grup', 'dokter');

        return $this->db->get();
    }

    public function getObatPemeriksaan($start_date, $end_date, $jenis_pendaftaran)
    {
        $jp = $jenis_pendaftaran ? " AND pp.jenis_pendaftaran_id = '$jenis_pendaftaran'" : "";
        return $this->db->query("
            select obat_id, nama, sum(jumlah_satuan) jumlah from (
                select dop.*, o.nama, o.harga_jual from detail_obat_pemeriksaan dop 
                join obat o ON o.id = dop.obat_id 
                join pemeriksaan p ON p.id = dop.pemeriksaan_id and p.is_active = 1
                join pendaftaran_pasien pp ON pp.id = p.pendaftaran_id and p.is_active = 1
                WHERE p.waktu_pemeriksaan >='".$start_date."' AND p.waktu_pemeriksaan <='".$end_date." 23:59:59' $jp
                and dop.is_active = 1
            ) as A group by obat_id
        ");
    }

    public function getObatRacikanPemeriksaan($start_date, $end_date, $jenis_pendaftaran)
    {
        $jp = $jenis_pendaftaran ? " AND pp.jenis_pendaftaran_id = '$jenis_pendaftaran'" : "";
        return $this->db->query("
            select obat_id, nama, sum(jumlah_satuan) jumlah from (
                select dorp.*, o.id obat_id, o.nama, o.harga_jual, ora.jumlah_satuan from detail_obat_racikan_pemeriksaan dorp 
                join obat_racikan ora ON ora.detail_obat_racikan_pemeriksaan_id = dorp.id and ora.is_active = 1
                join obat o ON o.id = ora.obat_id
                join pemeriksaan p ON p.id = dorp.pemeriksaan_id and p.is_active = 1
                join pendaftaran_pasien pp ON pp.id = p.pendaftaran_id and p.is_active = 1
                WHERE p.waktu_pemeriksaan >='".$start_date."' AND p.waktu_pemeriksaan <='".$end_date." 23:59:59' $jp
                and dorp.is_active = 1
            ) as A group by obat_id
        ");
    }

    public function getObatResepLuar($start_date, $end_date)
    {
        return $this->db->query("
            select obat_id, nama, sum(jumlah_satuan) jumlah from (
                select dop.*, o.nama, o.harga_jual from detail_penjualan_obat_luar dop 
                join obat o ON o.id = dop.obat_id 
                join penjualan_obat_luar pol ON pol.id = dop.penjualan_obat_luar_id
                WHERE pol.created_at >='".$start_date."' AND pol.created_at <='".$end_date." 23:59:59' 
                and dop.is_active = 1 
                and pol.tipe = 'resep_luar'
            ) as A group by obat_id
        ");
    }

    public function getObatRacikResepLuar($start_date, $end_date)
    {
        return $this->db->query("
            select obat_id, nama, sum(jumlah_satuan) jumlah from (
                select dorp.*, ora.obat_id, ora.jumlah_satuan, o.nama, o.harga_jual from detail_penjualan_obat_racikan_luar dorp 
                join obat_racikan_luar ora ON ora.detail_penjualan_obat_racikan_luar_id = dorp.id and ora.is_active = 1
                join obat o ON o.id = ora.obat_id
                join penjualan_obat_luar pol ON pol.id = dorp.penjualan_obat_luar_id
                WHERE pol.created_at >='".$start_date."' AND pol.created_at <='".$end_date." 23:59:59' 
                and dorp.is_active = 1
                and pol.tipe = 'resep_luar'
            ) as A group by obat_id
        ");
    }

    public function getObatObatBebas($start_date, $end_date)
    {
        return $this->db->query("
            select obat_id, nama, sum(jumlah_satuan) jumlah from (
                select dop.*, o.nama, o.harga_jual from detail_penjualan_obat_luar dop 
                join obat o ON o.id = dop.obat_id 
                join penjualan_obat_luar pol ON pol.id = dop.penjualan_obat_luar_id
                WHERE pol.created_at >='".$start_date."' AND pol.created_at <='".$end_date." 23:59:59' 
                and dop.is_active = 1 
                and pol.tipe = 'obat_bebas'
            ) as A group by obat_id
        ");
    }

    public function getObatRacikObatBebas($start_date, $end_date)
    {
        return $this->db->query("
            select obat_id, nama, sum(jumlah_satuan) jumlah from (
                select dorp.*, ora.obat_id, ora.jumlah_satuan, o.nama, o.harga_jual from detail_penjualan_obat_racikan_luar dorp 
                join obat_racikan_luar ora ON ora.detail_penjualan_obat_racikan_luar_id = dorp.id and ora.is_active = 1
                join obat o ON o.id = ora.obat_id
                join penjualan_obat_luar pol ON pol.id = dorp.penjualan_obat_luar_id
                WHERE pol.created_at >='".$start_date."' AND pol.created_at <='".$end_date." 23:59:59' 
                and dorp.is_active = 1
                and pol.tipe = 'obat_bebas'
            ) as A group by obat_id
        ");
    }

    public function getObatObatInternal($start_date, $end_date)
    {
        return $this->db->query("
            select obat_id, nama, sum(jumlah_satuan) jumlah from (
                select dop.*, o.nama, o.harga_jual from detail_penjualan_obat_luar dop 
                join obat o ON o.id = dop.obat_id 
                join penjualan_obat_luar pol ON pol.id = dop.penjualan_obat_luar_id
                WHERE pol.created_at >='".$start_date."' AND pol.created_at <='".$end_date." 23:59:59' 
                and dop.is_active = 1 
                and pol.tipe = 'obat_internal'
            ) as A group by obat_id
        ");
    }

    public function getObatRacikObatInternal($start_date, $end_date)
    {
        return $this->db->query("
            select obat_id, nama, sum(jumlah_satuan) jumlah from (
                select dorp.*, ora.obat_id, ora.jumlah_satuan, o.nama, o.harga_jual from detail_penjualan_obat_racikan_luar dorp 
                join obat_racikan_luar ora ON ora.detail_penjualan_obat_racikan_luar_id = dorp.id and ora.is_active = 1
                join obat o ON o.id = ora.obat_id
                join penjualan_obat_luar pol ON pol.id = dorp.penjualan_obat_luar_id
                WHERE pol.created_at >='".$start_date."' AND pol.created_at <='".$end_date." 23:59:59' 
                and dorp.is_active = 1
                and pol.tipe = 'obat_internal'
            ) as A group by obat_id
        ");
    }

    public function getObatPemeriksaan2()
    {
            /*    $this->db->select('dop.*, o.nama , o.harga_jual' );
                $this->db->join('obat o', 'o.id = dop.obat_id');
                $this->db->where('dop.is_active', '1' );
        return  $this->db->get('detail_obat_pemeriksaan dop');*/
        return $this->db->query("select nama, sum(jumlah_satuan) jumlah from (select dop.*, o.nama, o.harga_jual from detail_obat_pemeriksaan dop 
                                    join obat o ON o.id = dop.obat_id 
                                    and dop.is_active =1) as A group by obat_id");
    }

    public function getPenyakitPemeriksaan($start_date, $end_date, $jenis_pendaftaran)
    {
        $jp = $jenis_pendaftaran ? " AND pp.jenis_pendaftaran_id = '$jenis_pendaftaran'" : "";
        return $this->db->query("
            select nama, count(penyakit_id) jumlah from (select dpp.*, pen.nama from detail_penyakit_pemeriksaan dpp 
            join penyakit pen ON pen.id = dpp.penyakit_id and pen.is_active = 1 
            join pemeriksaan p ON p.id = dpp.pemeriksaan_id and p.is_active = 1
            join pendaftaran_pasien pp ON pp.id = p.pendaftaran_id and p.is_active = 1
            WHERE p.waktu_pemeriksaan >='".$start_date."' AND p.waktu_pemeriksaan <='".$end_date."' $jp
            and dpp.is_active = 1) 
            as A 
            group by penyakit_id
            ORDER BY jumlah DESC
        ");
    }

    public function getPenyakitPemeriksaan2()
    {
            /*    $this->db->select('dpp.*, pen.nama ' );
                $this->db->join('penyakit o', 'pen.id = dpp.penyakit_id and pen.is_active = 1');
                $this->db->where('dpp.is_active', '1' );
        return  $this->db->get('detail_penyakit_pemeriksaan dpp');*/
        return $this->db->query("select nama, count(penyakit_id) jumlah from (select dpp.*, pen.nama from detail_penyakit_pemeriksaan dpp 
                                    join penyakit pen ON pen.id = dpp.penyakit_id and pen.is_active = 1 
                                    and dpp.is_active =1) as A group by penyakit_id");
    }

    public function getPasienPemeriksaan($start_date,$end_date){
         /*return  $this->db->query("SELECT * from pasien p
                                    join pemeriksaan pem ON p.id = pem.pasien_id and pem.is_active = 1
                                     WHERE pem.waktu_pemeriksaan >='".$start_date."' AND pem.waktu_pemeriksaan <='".$end_date."'
                               ");*/
    }

    public function getPasienPemeriksaan2(){
         return  $this->db->query("SELECT * from pasien where is_active = 1 ORDER BY id DESC LIMIT 300");

    }

    public function getPemeriksaanBayarById($id)
    {
        return $this->db
            ->select('pem.*, p.nama as nama_pasien, p.jk, p.usia,p.alamat, p.telepon, p.pekerjaan, u.nama as nama_dokter, jp.nama as nama_jenis_pendaftaran, jp.kode as kode_pendaftaran, pp.tipe_layanan' )
            ->from('pemeriksaan pem')
            ->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1')
            ->join('user u', 'u.id = pem.dokter_id and u.is_active = 1')
            ->join('pendaftaran_pasien pp', 'pp.id = pem.pendaftaran_id')
            ->join('jenis_pendaftaran jp', 'jp.id = pp.jenis_pendaftaran_id')
            ->where('pem.is_active', '1' )
            ->where('pem.pasien_id', $id )
            ->where("(pem.status = 'bayar' OR pem.status = 'selesai')")
            ->limit(500)
            ->get();
    }

    public function getPemeriksaanBayarByIdPemeriksaan($id)
    {
        return $this->db
            ->select('pem.*, p.nama as nama_pasien, p.jk, p.usia,p.alamat, p.telepon, p.pekerjaan, u.nama nama_dokter' )
            ->from('pemeriksaan pem')
            ->join('pasien p', 'p.id = pem.pasien_id and p.is_active = 1')
            ->join('user u', 'u.id = pem.dokter_id and u.is_active = 1')
            ->join('pendaftaran_pasien pp', 'pp.id = pem.pendaftaran_id')
            ->where('pem.is_active', '1' )
            ->where('pem.id', $id )
            ->where("(pem.status = 'bayar' OR pem.status = 'selesai')")
            ->limit(500)
            ->get();
    }

    public function getTindakanById($id)
    {
                $this->db->select('dtp.*, td.nama , td.tarif_pasien' );
                $this->db->join('tarif_tindakan td', 'td.id = dtp.tarif_tindakan_id and td.is_active = 1');
                $this->db->join('pemeriksaan pem', 'pem.id = dtp.pemeriksaan_id and dtp.is_active = 1');
                $this->db->where('pem.pasien_id', $id );
                $this->db->where('dtp.is_active', '1' );
        return  $this->db->get('detail_tindakan_pemeriksaan dtp');
    }

    public function getObatPemeriksaanById($id)
    {
                $this->db->select('dop.*, o.nama , o.harga_jual' );
                $this->db->join('obat o', 'o.id = dop.obat_id');
                $this->db->join('pemeriksaan pem', 'pem.id = dop.pemeriksaan_id and pem.is_active = 1');
                $this->db->where('pem.pasien_id', $id );
                $this->db->where('dop.is_active', '1' );
        return  $this->db->get('detail_obat_pemeriksaan dop');
    }

    public function getPenyakitPemeriksaanById($id)
    {
                $this->db->select('dpp.*, pen.nama , pen.kode' );
                $this->db->join('penyakit pen', 'pen.id = dpp.penyakit_id and pen.is_active = 1');
                $this->db->join('pemeriksaan pem', 'pem.id = dpp.pemeriksaan_id and pem.is_active = 1');
                $this->db->where('pem.pasien_id', $id );
                $this->db->where('dpp.is_active', '1' );
        return  $this->db->get('detail_penyakit_pemeriksaan dpp');
    }

    public function getRacikanPemeriksaanById($id)
    {
                $sql = "SELECT id,nama_racikan, signa, sum(subtotal) as total from
                        (select dorp.*, ora.obat_id, ora.jumlah_satuan, o.nama, o.harga_jual, (ora.jumlah_satuan*o.harga_jual) as subtotal from detail_obat_racikan_pemeriksaan dorp 
                        join obat_racikan ora ON dorp.id = ora.detail_obat_racikan_pemeriksaan_id
                        join obat o on o.id = ora.obat_id where dorp.pemeriksaan_id = $id ) as AA group by id,nama_racikan,signa
                                    ";
        return $this->db->query($sql);
    }

      public function getRacikanPemeriksaan()
    {
                $sql = "SELECT id, pemeriksaan_id, nama_racikan, signa, sum(subtotal) as total from
(select dorp.*, ora.obat_id, ora.jumlah_satuan, o.nama, o.harga_jual, (ora.jumlah_satuan*o.harga_jual) as subtotal from detail_obat_racikan_pemeriksaan dorp 
join obat_racikan ora ON dorp.id = ora.detail_obat_racikan_pemeriksaan_id
join obat o on o.id = ora.obat_id 
join pemeriksaan pem ON pem.id = dorp.pemeriksaan_id  ) as AA group by id,pemeriksaan_id,nama_racikan,signa
            ";
        return $this->db->query($sql);
    }

    // ---------------- BY ID PEMERIKSAAN ---------------

    public function getTindakanByIdPemeriksaan($id) {
        $this->db->select('dtp.*, td.id as id_tarif_rindakan, td.nama , td.tarif_pasien' );
        $this->db->join('tarif_tindakan td', 'td.id = dtp.tarif_tindakan_id and td.is_active = 1');
        $this->db->join('pemeriksaan pem', 'pem.id = dtp.pemeriksaan_id and dtp.is_active = 1');
        $this->db->where('pem.id', $id );
        $this->db->where('dtp.is_active', '1' );
        return  $this->db->get('detail_tindakan_pemeriksaan dtp');
    }

    public function getObatPemeriksaanByIdPemeriksaan($id) {
        $this->db->select('dop.*, o.nama , o.harga_jual, o.id' );
        $this->db->join('obat o', 'o.id = dop.obat_id');
        $this->db->join('pemeriksaan pem', 'pem.id = dop.pemeriksaan_id and pem.is_active = 1');
        $this->db->where('pem.id', $id );
        $this->db->where('dop.is_active', '1' );
        return  $this->db->get('detail_obat_pemeriksaan dop');
    }

    public function getPenyakitPemeriksaanByIdPemeriksaan($id) {
        $this->db->select('dpp.*, pen.id as id_penyakit, pen.nama , pen.kode, pen.id' );
        $this->db->join('penyakit pen', 'pen.id = dpp.penyakit_id and pen.is_active = 1');
        $this->db->join('pemeriksaan pem', 'pem.id = dpp.pemeriksaan_id and pem.is_active = 1');
        $this->db->where('pem.id', $id );
        $this->db->where('dpp.is_active', '1' );
        return  $this->db->get('detail_penyakit_pemeriksaan dpp');
    }

    public function getSimplePenyakitPemeriksaanByIdPemeriksaan($id) {
        $this->db->select('dpp.pemeriksaan_id, pen.nama , pen.kode' );
        $this->db->join('penyakit pen', 'pen.id = dpp.penyakit_id and pen.is_active = 1');
        $this->db->join('pemeriksaan pem', 'pem.id = dpp.pemeriksaan_id and pem.is_active = 1');
        $this->db->where('pem.id', $id );
        $this->db->where('dpp.is_active', '1' );
        return  $this->db->get('detail_penyakit_pemeriksaan dpp');
    }
}
