<head>
    <title>Nota</title>
   
    
</head>
<style type="text/css">
  p {
      font-size:25px;
  }
</style>
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
$mpdf=new mPDF('c','A5-L','','',10,10,4,4,4,4); 

$mpdf->mirrorMargins = 10;  // Use different Odd/Even headers and footers and mirror margins
$tanggal = date("d-m-Y",strtotime($pemeriksaan->waktu_pemeriksaan));

$html=' 
      </style>
<table class="sakit" style="text-align: center;">
   <tr >
      <td width="19%"><img width="90px" style="padding-right:20px;"  src="'.base_url().'assets/img/klinik/'.$klinik->foto.'" class="user-image" alt="User Image"></td>l
      <td width="82%" style="text-align: center;">
         <p style="text-align: center;"><strong>'.strtoupper($klinik->nama).'</strong></p>
         <p style="text-align: center;"><strong>'.$klinik->alamat.'</strong></p>
         <p style="text-align: center;"><strong>Telp '.$klinik->telepon.'</strong></p>
        
      </td>
        
   </tr>
</table>
<hr />

<p style="text-align: center; padding-bottom: -15px;"><strong><u>SURAT KETERANGAN SAKIT</u></strong></p>
<p style="text-align: center; padding-bottom: -15px;"><strong>Nomor :_____________________</strong></p>
<p style="padding-bottom: -15px;">Yang bertanda tangan di bawah ini menerangkan bahwa :</p>
<p style="padding-left: 30px; padding-bottom: -15px;">Nama&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : '. $pemeriksaan->nama_pasien.'</p>
<p style="padding-left: 30px;  padding-bottom: -15px;">Umur&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : '. $pemeriksaan->usia.'</p>
<p style="padding-left: 30px;  padding-bottom: -15px;">Pekerjaan&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: '. $pemeriksaan->pekerjaan.'</p>
<p style="padding-left: 30px;  padding-bottom: -15px;">Alamat&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: '. $pemeriksaan->alamat.'</p>
<p>Oleh karena sakit, maka memerlukan istirahat selama :................................. (....................) hari, terhitung mulai tanggal ................................... sampai dengan tanggal .....................................</p> <p>Surat ini tidak berlaku untuk proses di pengadilan. Demikian surat ini dibuat untuk dipergunakan sebagai mana mestinya.</p>

<p style="padding-left: 510px; padding-bottom: -15px;">Yogyakarta, '.DateToIndo($tanggal).'</p>
<p style="padding-left: 510px;">&nbsp; Dokter yang memeriksa</p>
<p style="padding-left: 510px;">&nbsp;</p>

<p style="padding-left: 480px;">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( '. $pemeriksaan->nama_dokter.' )</p>
';
/*echo $html;*/
        


      /*  $html='
<style>
table.gridtable {
    font-family: Times New Roman;
    font-size:25px;
    color:#000000;
    border-width: 0px;
    border-collapse: collapse;
    
}
table.gridtableheader {
    font-family: Times New Roman;
    font-size:25px;
    color:#000000;
    border-width: 0px;
    border-collapse: collapse;
    
}
table.gridtable th {
    border-width: 1px;
    padding: 2px;
    border-style: solid;
    border-color: #666666;
    background-color: #dedede;
    font-weight:bold;
}
table.gridtable td {
    border-width: 1px;
    padding: 1px;
    border-style: solid;
    border-color: #666666;
    background-color: #ffffff;
}

table.gridtable2 {
    margin-top:20px;
    font-family: Times New Roman;
    font-size:10px;
    color:#333333;
    border-width: 1px;
    border-color: #666666;
    border-collapse: collapse;
    
}
table.gridtable2 th {
    border-width: 1px;
    padding: 2px;
    border-style: solid;
    border-color: #666666;
    background-color: #dedede;
    font-weight:bold;
}
table.gridtable2 td {
    border-width: 0px;
    padding: 0px;
    font-size:15px;
    border-style: solid;
    border-color: #666666;
    background-color: #ffffff;
}

</style>

<table width="700px" class="gridtableheader" border="0">
   <tr>
   <td  valign="top" align="Center"><div style="font-size:25px;"><strong>'.$klinik->nama.'<br></strong></div> </td>
    <br/>
   </tr>
   <tr>
   <td  valign="top" align="Center"><div style="font-size:15px;">'.$klinik->alamat.'</div> </td>
   </tr>
   <tr>
   <td  valign="top" align="Center"><div style="font-size:15px;">'.$klinik->telepon.'</div> </td>
   </tr>
   <tr>
   <td  valign="top" align="Center"><div style="font-size:15px;">'.$klinik->email.'<br></div> </td>
   </tr>

    <tr>
        <strong><td><hr size="10px"></td></strong>
        
    </tr>
</table>
<table width="700px" class="gridtableheader" border="0">
   <tr>
   <td align="Center"><div style="font-size:17px;"><strong>SURAT KETERANGAN SAKIT<br></strong></div> </td>
    
   </tr>
</table>
              
            <p>Dengan ini saya menerangkan bahwa</p>
          <table width="700px" class="gridtable2" border="0">
          <tr style="padding-left: 30px;"><td>Nama Pasien</td> <td>: </td><td><strong>'. $pemeriksaan->nama_pasien.'</strong></td></tr>       
          <tr style="padding-left: 30px;"><td>Alamat</td> <td>:</td> <td>'. $pemeriksaan->alamat.'</td></tr>            
          <tr style="padding-left: 30px;"><td>Usia</td> <td>:</td> <td>'. $pemeriksaan->usia.'</td></tr>            
          <tr style="padding-left: 30px;"><td>Telepon</td> <td>:</td> <td>'. $pemeriksaan->telepon.'</td></tr>            
          <tr style="padding-left: 30px;"><td>Pekerjaan</td> <td>:</td> <td>'. $pemeriksaan->pekerjaan.'</td></tr>            
        </table>    
     
           <p>Oleh karena SAKIT, perlu diberikan ISTIRAHAT selama .................... hari, terhitung mulai tanggal .............................s.d .................................</p>
          
          <p> Surat ini tidak berlaku dalam proses di pengadilan. Demikian surat keterangan ini dibuat dengan sebenarnya dan untuk dipergunakan semestinya.</p>
         
         
          <table align="right">        
            <tr>
              <td></td> 
              <td></td> 
              <td></td> 
              <td></td> 
              <td></td> 
              <td></td> 
              <td>Yogyakarta, '.$pemeriksaan->waktu_pemeriksaan.'</td> 
              <td></td> 
              <td></td>            
            </tr>
             <tr>
              <td></td> 
              <td></td> 
              <td></td> 
              <td></td> 
              <td></td> 
              <td></td> 
              <td>yang memeriksa,</td> 
              <td></td> 
              <td></td>            
            </tr>
          </table>  
            <p><h4 style="text-right: center;"></h4></p>
           <table align="right">        
            <tr>          
             <td></td> 
              <td></td> 
              <td></td> 
              <td></td> 
              <td></td> 
              <td></td> 
              <td>'.$pemeriksaan->nama_dokter.'</td> 
              <td></td> 
              <td></td>
            
            </tr>  
            <tr>        
              <td></td> 
              <td></td> 
              <td></td> 
              <td></td> 
              <td></td> 
              <td></td> 
              <td>NIP :.....................</td> 
              <td></td> 
              <td></td>
            
            </tr>          
        </table>';*/
       //echo $html;

$mpdf->WriteHTML($html);
//$mpdf->SetHTMLFooter($footer);
$mpdf->SetHTMLFooter($footer,'E');

//$mpdf->Output();
$mpdf->Output('filename.pdf','D');
//exit;
?>