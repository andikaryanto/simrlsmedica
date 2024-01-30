<?php

function generateKodeBooking($length = 10)
{
    $characters = '0123456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    $CI =& get_instance();
    $ext = $CI->db->query("SELECT * FROM antrian WHERE kode_booking = '$randomString'")->row();
    if ($ext) {
        return generateKodeBooking();
    }

    return $randomString;
}

function generateKodeAntrian($jenis_pendaftaran_id, $due_date)
{
    $CI =& get_instance();
    $r = $CI->db->query("
        SELECT * FROM antrian 
        WHERE date(due_date) = '$due_date' 
        AND jenis_pendaftaran_id = $jenis_pendaftaran_id 
        ORDER BY id DESC
    ")->row();
    $num = $r == null ? 0 : (int) preg_replace("/[^0-9]/", "", $r->kode_antrian);
    $num = str_pad(++$num, 3, "0", STR_PAD_LEFT);

    $j = $CI->db->query("SELECT * FROM jenis_pendaftaran WHERE id = $jenis_pendaftaran_id")->row();
    return "$j->kode_antrian$num";
}