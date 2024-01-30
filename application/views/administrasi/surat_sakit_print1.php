<?php

function DateToIndo($date) {
$BulanIndo = array("Januari", "Februari", "Maret", "April",
"Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
"November", "Desember");

// memisahkan format tahun menggunakan substring
$tgl = substr($date, 0, 2);

// memisahkan format bulan menggunakan substring
$bulan = substr($date, 3, 2);

// memisahkan format tanggal menggunakan substring
$tahun = substr($date, 6, 4);

$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;

return($result);
}

ini_set("memory_limit","20000M");
//$mpdf=new mPDF('c','A4','','',15,15,10,5,5,5); 
$mpdf=new mPDF('c','A5-P','','',12,12,10,5,5,5); 

$mpdf->mirrorMargins = 10;  // Use different Odd/Even headers and footers and mirror margins
$tanggal = date("d-m-Y",strtotime($pemeriksaan->waktu_pemeriksaan));

$html='
<table style="text-align: center;">
   <tr >
      <td><img width="110px" style="padding-right:20px; padding-left:20px;"  src="'.base_url().'assets/img/klinik/'.$klinik->foto.'" class="user-image" alt="User Image"></td>l
      <td>
         <p><strong>'.strtoupper($klinik->nama).'</strong></p>
         <p><strong>'.$klinik->alamat.'</strong></p>
         <p><strong>Telp '.$klinik->telepon.'</strong></p>
        
      </td>
      <td>&nbsp; &nbsp; &nbsp;</td>
   </tr>
</table>
<hr />

<p style="text-align: center;"><strong><u>SURAT KETERANGAN SAKIT</u></strong></p>
<p style="text-align: center;"><strong><u>Nomor : </u></strong></p>
<p>Yang bertanda tangan di bawah ini menerangkan bahwa :</p>
<p style="padding-left: 30px;">Nama&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : '. $pemeriksaan->nama_pasien.'</p>
<p style="padding-left: 30px;">Umur&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : '. $pemeriksaan->usia.'</p>
<p style="padding-left: 30px;">Pekerjaan&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: '. $pemeriksaan->pekerjaan.'</p>
<p style="padding-left: 30px;">Alamat&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: '. $pemeriksaan->alamat.'</p>
<p style="padding-left: 30px;">&nbsp;</p>
<p>Oleh karena sakit, maka memerlukan istirahat selama :................................. (....................) hari, terhitung mulai tanggal ................................... sampai dengan tanggal .....................................</p>
<p>Harap menjadi maklum.</p>
<p style="padding-left: 510px;">Yogyakarta, '.DateToIndo($tanggal).'</p>
<p style="padding-left: 510px;">&nbsp; Dokter yang memeriksa</p>
<p style="padding-left: 510px;">&nbsp;</p>
<p style="padding-left: 510px;">&nbsp;</p>
<p style="padding-left: 480px;">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( '. $pemeriksaan->nama_dokter.' )</p>

<p>&nbsp;</p>
<p>&nbsp;</p>';
echo $html;