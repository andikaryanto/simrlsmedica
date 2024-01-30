<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InsentifModel extends CI_Model {

    public function DetailInsentifDokter($id, $dari, $sampai)
    {
        return $this->db->query("
                    SELECT ab.* FROM (
                        select 1 as table_id, p.waktu_pemeriksaan, tt.nama nama_tindakan, tt.tarif_dokter, u.nama nama_dokter, pas.nama nama_pasien, p.no_rm, p.jaminan tipe_pasien, jp.nama jenis_ruangan, pp.tipe_layanan
                        from detail_tindakan_pemeriksaan dtp
                        join pemeriksaan p on p.id = dtp.pemeriksaan_id
                        join pendaftaran_pasien pp on pp.id = p.pendaftaran_id 
                        join jenis_pendaftaran jp on jp.id = pp.jenis_pendaftaran_id
                        join pasien pas on pas.id = p.pasien_id and pas.is_active = 1
                        join user u on u.id = p.dokter_id
                        join tarif_tindakan tt on tt.id = dtp.tarif_tindakan_id
                        where dtp.is_active = 1
                        and p.dokter_id = {$id}
                        and (DATE(p.waktu_pemeriksaan) between '$dari' and '$sampai')
                    ) ab
                    ORDER BY ab.waktu_pemeriksaan
                ");
    }

    public function listInsentifDokter($dari = null, $sampai = null)
    {
        return $this->db->query("
                    select
                        u.id as dokter_id, u.nama, (
                            ifnull((
                                select sum(tt.tarif_dokter)
                                from detail_tindakan_pemeriksaan dtp
                                join pemeriksaan p on p.id = dtp.pemeriksaan_id
                                join tarif_tindakan tt on tt.id = dtp.tarif_tindakan_id
                                join pasien on pasien.id = p.pasien_id and pasien.is_active = 1
                                where dtp.is_active = 1
                                and p.dokter_id = u.id
                                group by p.dokter_id
                            ), 0)
                        ) as total_insentif
                    from user as u
                    join user_grup ug on ug.user_id = u.id
                    join grup g on ug.grup_id = g.id
                    where g.nama_grup = 'dokter' and u.is_active = 1
                    order by total_insentif desc
                ");
    }

    public function shiftDokter(){
       return $this->db->query("
      select b.*, u.nama from
        (select dokter_id, count(*) hari,(select insentif from insentif_shift where shift ='dokter') as shift, (count(*)*(select insentif from insentif_shift where shift ='dokter')) as jumlah from
            (SELECT YEAR(waktu_pemeriksaan) Y,MONTH(waktu_pemeriksaan) M,DAY(waktu_pemeriksaan) D, dokter_id from
                pemeriksaan  group by YEAR(waktu_pemeriksaan),MONTH(waktu_pemeriksaan),DAY(waktu_pemeriksaan), dokter_id) as A  group by dokter_id) as b JOIN user u ON b.dokter_id = u.id");

    }

    public function shiftPerawat(){
       return $this->db->query("select b.*, u.nama from
        (select perawat_id, count(*) hari, (select insentif from insentif_shift where shift ='perawat') as shift, (count(*)*(select insentif from insentif_shift where shift ='perawat')) as jumlah from
            (SELECT YEAR(waktu_pemeriksaan) Y,MONTH(waktu_pemeriksaan) M,DAY(waktu_pemeriksaan) D, perawat_id from
                pemeriksaan  group by YEAR(waktu_pemeriksaan),MONTH(waktu_pemeriksaan),DAY(waktu_pemeriksaan), perawat_id) as A  group by perawat_id) as b JOIN user u ON b.perawat_id = u.id");

    }

    public function shiftApoteker(){
       return $this->db->query("select b.*, u.nama from
        (select apoteker_id, count(*) hari, (select insentif from insentif_shift where shift ='apoteker') as shift, (count(*)*(select insentif from insentif_shift where shift ='apoteker')) as jumlah from
            (SELECT YEAR(waktu_pemeriksaan) Y,MONTH(waktu_pemeriksaan) M,DAY(waktu_pemeriksaan) D, apoteker_id from
                pemeriksaan  group by YEAR(waktu_pemeriksaan),MONTH(waktu_pemeriksaan),DAY(waktu_pemeriksaan), apoteker_id) as A  group by apoteker_id) as b JOIN user u ON b.apoteker_id = u.id");

    }

    public function listInsentifShiftDokter()
    {
          $this->db->select('p.dokter_id, u.nama');
          $this->db->join('pemeriksaan p', 'p.id = dtp.pemeriksaan_id');
          $this->db->join('user u', 'u.id = p.dokter_id');
          $this->db->where('dtp.is_active', 1);
          $this->db->group_by('p.dokter_id');
        return $this->db->get('detail_tindakan_pemeriksaan dtp');
    }

    public function DetailInsentifPerawat($id)
    {
          $this->db->select('dtp.*, p.waktu_pemeriksaan, tt.nama nama_tindakan, tt.tarif_perawat, u.nama nama_perawat');
          $this->db->join('pemeriksaan p', 'p.id = dtp.pemeriksaan_id');
          $this->db->join('user u', 'u.id = p.perawat_id');
          $this->db->join('tarif_tindakan tt', 'tt.id = dtp.tarif_tindakan_id');
          $this->db->where('dtp.is_active', 1);
          $this->db->where('p.perawat_id', $id);

        return $this->db->get('detail_tindakan_pemeriksaan dtp');
    }

    public function DetailInsentifApoteker($id)
    {
        return $this->db->select('pemeriksaan.waktu_pemeriksaan, pemeriksaan.no_rm, user.id, user.nama')
          ->from('pemeriksaan')
          ->join('user', 'user.id = pemeriksaan.apoteker_id', 'left')
          ->where([ 'pemeriksaan.is_active'=> 1, 'user.id'=>$id])
          ->get() ->result();
    }

    public function getInsentifResep()
    {
      return $this->db->select('insentif')
        ->from('insentif_shift')
        ->where(['shift'=>'resep'])
        ->get()->row()->insentif;
    }

    public function listInsentifApoteker()
    {
        return $this->db->select('
          pemeriksaan.apoteker_id AS the_apotek,
          (SELECT COUNT(*) FROM pemeriksaan WHERE apoteker_id= the_apotek) AS jml_resep,
          user.nama
          ')
          ->from('pemeriksaan')
          ->join('user', 'user.id = pemeriksaan.apoteker_id', 'left')
          ->where([
            'pemeriksaan.is_active'=> 1,
            ' pemeriksaan.apoteker_id >'=> 0
          ])
          ->group_by('pemeriksaan.apoteker_id')
          ->get()->result();

    }

    public function listInsentifPerawat()
    {
          $this->db->select('p.perawat_id, u.nama, sum(tt.tarif_perawat) total_insentif');
          $this->db->join('pemeriksaan p', 'p.id = dtp.pemeriksaan_id');
          $this->db->join('user u', 'u.id = p.perawat_id');
          $this->db->join('tarif_tindakan tt', 'tt.id = dtp.tarif_tindakan_id');
          $this->db->where('dtp.is_active', 1);
          $this->db->group_by('p.perawat_id');
        return $this->db->get('detail_tindakan_pemeriksaan dtp');
    }

     public function getObatById($id)
    {
         $this->db->where('is_active', 1);
         $this->db->where('id', $id);
        return $this->db->get('obat');
    }

     public function getSettingpersen()
    {
         $this->db->where('is_active', 1);
        return $this->db->get('prosentase_harga');
    }

    public function getUserById($id)
    {

         $this->db->select('u.*,ug.id as user_grup_id, ug.grup_id, g.nama_grup');
         $this->db->from('user u');
         $this->db->join('user_grup ug', 'ug.user_id = u.id');
         $this->db->join('grup g', 'ug.grup_id = g.id');
         $this->db->where('u.is_active', 1);
         $this->db->where('u.id', $id);

        return $this->db->get();
    }

    public function getGrup()
    {
         $this->db->where('is_active', 1);
        return $this->db->get('grup');
    }

    public function listShift()
    {

        return $this->db->get('insentif_shift');
    }
    public function listShiftById($id)
    {
                 $this->db->where('id', $id);
        return $this->db->get('insentif_shift');
    }





}
