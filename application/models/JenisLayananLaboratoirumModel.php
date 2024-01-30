<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JenisLayananLaboratoirumModel extends CI_Model
{
    public function all()
    {
        return $this->db->where('is_active', '1')->get('jenis_layanan_laboratorium');
    }

    public function get_parents()
    {
        return $this->db->where('is_active', '1')->where('parent_id IS NULL', null, false)->get('jenis_layanan_laboratorium');
    }

    public function get_children_of($parent_id)
    {
        return $this->db->where('is_active', '1')->where('parent_id', $parent_id)->get('jenis_layanan_laboratorium');
    }

    public function get_all_children()
    {
        return $this->db
            ->query('
                SELECT parent.nama as parent_nama, child.* FROM jenis_layanan_laboratorium child 
                JOIN jenis_layanan_laboratorium parent ON child.parent_id = parent.id
                WHERE child.is_active = 1 
                AND child.parent_id IS NOT NULL
            ');
    }

    public function get_all_children_and_paket()
    {
        return $this->db
            ->query("
                SELECT parent.nama as parent_nama, child.*, 0 as is_paket
                FROM jenis_layanan_laboratorium child 
                JOIN jenis_layanan_laboratorium parent ON child.parent_id = parent.id
                WHERE child.is_active = 1 
                AND parent.is_active = 1
                AND child.parent_id IS NOT NULL
                AND parent.is_paket = 0
                UNION ALL 
                SELECT '' as parent_nama, parent.*, 1 as is_paket
                FROM jenis_layanan_laboratorium parent
                WHERE parent.is_active = 1
                AND parent.is_paket = 1
            ");
    }

    public function byId($id)
    {
        return $this->db->where('id', $id)->where('is_active', '1')->get('jenis_layanan_laboratorium')->row();
    }

    public function byIdPemeriksaan($id)
    {
        $all = $this->db->query("SELECT l.* FROM detail_tindakan_pemeriksaan_lab dtpl JOIN jenis_layanan_laboratorium l ON dtpl.jenis_layanan_id = l.id WHERE dtpl.pemeriksaan_id = $id")->result();
        $result = [];

        $q = [];
        $b = [];

        foreach ($all as $a) {
            if ($a->is_paket) {
                $r = $this->db->query("
                    SELECT parent.nama as nama_layanan, parent.id as parent_id, parent.id as selected_id, parent.nama as parent_name, 1 as is_paket
                    FROM detail_tindakan_pemeriksaan_lab dtpl
                    JOIN jenis_layanan_laboratorium parent ON dtpl.jenis_layanan_id = parent.id
                    WHERE dtpl.pemeriksaan_id = $id
                    AND parent.is_paket = 1
                ")->result();
            }
            else {
                $r = $this->db
                    ->where('child.id', $a->id)
                    ->where('dtpl.pemeriksaan_id', $id)
                    ->join('jenis_layanan_laboratorium child', 'dtpl.jenis_layanan_id = child.id')
                    ->join('jenis_layanan_laboratorium parent', 'child.parent_id = parent.id')
                    ->select('child.nama as nama_layanan, child.id as child_id, parent.id as parent_id, child.id as selected_id, parent.nama as parent_name, 0 as is_paket')
                    ->get('detail_tindakan_pemeriksaan_lab dtpl')
                    ->result();
            }

            $result = array_merge($result, $r);
        }

        return $result;

//        return $this->db
//            ->where('dtpl.pemeriksaan_id', $id)
//            ->join('jenis_layanan_laboratorium child', 'dtpl.jenis_layanan_id = child.id')
//            ->join('jenis_layanan_laboratorium parent', 'child.parent_id = parent.id')
//            ->select('child.nama as nama_layanan, child.id as child_id, parent.id as parent_id, parent.nama as parent_name')
//            ->get('detail_tindakan_pemeriksaan_lab dtpl')
//            ->result();
    }

    public function byIdPemeriksaanAndIdparent($id, $parent_id)
    {
        return $this->db
            ->where('dtpl.pemeriksaan_id', $id)
            ->where('child.parent_id', $parent_id)
            ->join('jenis_layanan_laboratorium child', 'dtpl.jenis_layanan_id = child.id')
            ->select('child.*')
            ->get('detail_tindakan_pemeriksaan_lab dtpl')
            ->result();
    }

    public function byIdPemeriksaanAndIdparentPaket($id, $parent_id)
    {
        return $this->db
            ->where('dtpl.pemeriksaan_id', $id)
            ->where('child.parent_id', $parent_id)
            ->join('jenis_layanan_laboratorium parent', 'dtpl.jenis_layanan_id = parent.id')
            ->join('jenis_layanan_laboratorium child', 'parent.id = child.parent_id')
            ->select('child.*')
            ->get('detail_tindakan_pemeriksaan_lab dtpl')
            ->result();
    }
}
