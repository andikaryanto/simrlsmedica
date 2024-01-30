
<?php
ini_set("memory_limit","20000M");
//$mpdf=new mPDF('c','A5','','',2,2,2,2,2,2);
$mpdf=new mPDF('c','A5','','',2,2,2,2,2,2);

$mpdf->mirrorMargins = 10;  // Use different Odd/Even headers and footers and mirror margins

if ($penjualan->tipe == 'resep_luar') :
    $nama = '
    <tr><td>Nama Pasien :</td><td>'.$penjualan->nama_pasien.'</td></tr>
    <tr><td>Alamat :</td><td>'.$penjualan->alamat.'</td></tr>
    <tr><td>Nama Dokter :</td><td>'.$penjualan->nama_dokter.'</td></tr>
    ';
elseif ($penjualan->tipe == 'obat_internal') :
    $nama = '
    <tr><td>Nama Karyawan :</td><td>'.$penjualan->nama_karyawan.'</td></tr>
    ';
else :
    $nama = '';
endif;

$html='
    
<div style="text-align: center; width: 350px;">
    <strong>'.$klinik->nama.'</strong><br>'.$klinik->alamat.'<br>'.$klinik->telepon.'
<hr style="width: 350px;">
</div>
<br>
    
<table width="350px" class="gridtableheader" border="0">
    <tr><td>Penjualan '.ucwords(str_replace('_', ' ', $penjualan->tipe)).'</td></tr>
    <tr><td>No. Nota :</td><td>'.$id_bayar.'</td></tr>
    <tr><td>Tanggal Periksa :</td><td>'.$penjualan->created_at.'</td></tr>'
    .$nama.
    '</tr>
</table>
    <br>
<table width="350px" class="gridtableheader" border="0">
    <tr>
    <td><strong> TARIF</strong></td>
    <td></td>
    <td></td>
    </tr>
    <tr>
    <th></th>
    </tr>
    </thead>
    <tbody>';

// ######################### OBAT ##########################

$html.='
<tr><td colspan="5"><hr></td></tr>
<tr>             
    <td><strong>OBAT</strong></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>';

foreach ($obat as $key => $value) {
    $html .=
        '<tr>
    <td width="5%"></td>
    <td>'.$value->item.'</td>
    <td width="10%">'.$value->jumlah.'</td>
    <td>'.number_format($value->harga).'</td>
    <td align="right">'.number_format($value->subtotal).'</td>
 </tr>';}

// ######################### OBAT RACIK ##########################

$html.= '
<tr><td colspan="5"><hr></td></tr>
<tr>             
    <td><strong>OBAT RACIK</strong></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>';

foreach ($racikan as $key => $value) {
    $html .=
        '<tr>
    <td width="5%">'.$value->nama_racikan.'</td>
    <td>Signa: '.$value->signa.'</td>
    <td width="10%"></td>
    <td></td>
    <td align="right">'.number_format($value->total).'</td>
</tr>';

    foreach ($value->obat as $k => $v) {
        $html .=
            '<tr>
        <td></td>
        <td>'.$v->nama.'</td>
        <td>'.$v->jumlah_satuan.'</td>
        <td align="right">'.number_format($v->harga_jual).'</td>
        <td align="right">'.number_format($v->harga_jual * $v->jumlah_satuan).'</td>
    </tr>';
    }
}

// ######################### END ##########################

$html.='
      <tr style="height: 10px;"><td></td><td></td></tr>
       <tr>
         <td colspan="3" align="right">Diskon</td>
         <td colspan="2" align="right">'.number_format($penjualan->diskon).'</td>
       </tr> 
       <tr>
         <td colspan="3" align="right">Total</td>
         <td colspan="2" align="right">'.number_format($penjualan->total).'</td>
       </tr>   
       <tr>
         <td colspan="3" align="right">Bayar</td>
         <td colspan="2" align="right">'.number_format($penjualan->bayar).'</td>
       </tr> 
        <tr>
         <td colspan="3" align="right">Kembalian</td>
         <td colspan="2" align="right">'.number_format($penjualan->kembalian).'</td>
       </tr>
    </tbody>
  </table>
  
<br>
<div style="text-align: center; width: 350px;">
    Terimakasih atas kunjungan anda<br>
    SEMOGA LEKAS SEMBUH
</div>
       ';

//$mpdf->WriteHTML($html);
////$mpdf->SetHTMLFooter($footer);
//$mpdf->SetHTMLFooter($footer,'E');
//
////$mpdf->Output();
//$mpdf->Output('filename.pdf','D');


?>

<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Cetak Nota</title>
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <style>
        table.gridtable {
            font-family: Arial;
            font-size:16px;
            color:#000000;
            border-width: 2px;
            border-collapse: collapse;

        }
        table.gridtableheader {
            font-family: Arial;
            font-size:14px;
            color:#000000;
            border-width: 2px;
            border-collapse: collapse;

        }
        table.gridtable th {
            border-width: 2px;
            padding: 2px;
            border-style: solid;
            border-color: #666666;
            background-color: #dedede;
            font-weight:bold;
        }
        table.gridtable td {
            border-width: 2px;
            padding: 2px;
            border-style: solid;
            border-color: #666666;
            background-color: #ffffff;
        }

        table.gridtable2 {
            margin-top: 20px;
            font-family: Arial;
            font-size:14px;
            color:#333333;
            border-width: 2px;
            border-color: #666666;
            border-collapse: collapse;

        }
        table.gridtable2 th {
            border-width: 2px;
            padding: 2px;
            border-style: solid;
            border-color: #666666;
            background-color: #dedede;
            font-weight:bold;
        }
        table.gridtable2 td {
            border-width: 2px;
            padding: 2px;
            font-size:12px;
            border-style: solid;
            border-color: #666666;
            background-color: #ffffff;
        }

    </style>
</head>
<body>
<?= $html ?>
</body>
</html>

<script>
    $( document ).ready(function() {
        window.print();
    });
</script>
