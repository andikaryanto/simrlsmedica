
<?php

function DateIndo($date)
{
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl = substr($date, 8, 2);
    $result = $tgl . " " . $BulanIndo[(int)$bulan - 1] . " " . $tahun;

    return ($result);
}

ini_set("memory_limit","20000M");
//$mpdf=new mPDF('c','A5','','',2,2,2,2,2,2);
$mpdf=new mPDF('c','A5','','',2,2,2,2,2,2);

$mpdf->mirrorMargins = 10;  // Use different Odd/Even headers and footers and mirror margins

$nomor = $pemeriksaan->jaminan == 'umum' ?
    '' :
    '<tr><td>Nomor :</td><td>'.$pemeriksaan->no_jaminan.'</td></tr>';

$html='
    
<div style="text-align: center; width: 380px;">
    <strong style="font-size: 20px"><u>dr R. Haryo Sarodja, SpM(K)</u></strong>
    <br>Spesialis Mata<br>No. SIP: 503/0490/dr.Sp/XII/2021
</div>
<br>
<small>'.$klinik->alamat.'</small><br>
<small>'.$klinik->telepon.'</small><br>
<div style="text-align: center; width: 380px;">
    <hr style="width: 380px;">
    <div style="width: 100%; text-align: right">
        <small>Yogyakarta, '.DateIndo(date('Y-m-d')).'</small>
    </div>
</div>
<br>
<table width="380px" class="gridtableheader" border="0">';

// ######################### OBAT ##########################

$html.='
<tr><td colspan="4"></td></tr>
<tr>             
    <td><strong>OBAT</strong></td>
    <td></td>
    <td></td>
    <td></td>
</tr>';

foreach ($obat as $key => $value) {
$html .=
'<tr>
    <td></td>
    <td>'.$value->nama.'</td>
    <td>'.$value->signa_obat.'</td>
    <td width="10%">'.$value->jumlah_satuan.'</td>
 </tr>';}

// ######################### OBAT RACIK ##########################

$html.= '
<tr><td colspan="4"><br></td></tr>
<tr>             
    <td><strong>OBAT RACIK</strong></td>
    <td></td>
    <td></td>
    <td></td>
</tr>';

foreach ($racikan as $key => $value) {
    $html .=
    '<tr>
        <td>'.$value->nama_racikan.'</td>
        <td>Signa: '.$value->signa.'</td>
        <td></td>
        <td></td>
    </tr>';

    foreach ($value->obat as $k => $v) {
        $html .=
        '<tr>
            <td></td>
            <td colspan="2">'.$v->nama.'</td>
            <td>'.$v->jumlah_satuan.'</td>
        </tr>';
    }
}

// ######################### END ##########################

$html.='
    </tbody>
  </table>
  
<br>
<br>
<div style="text-align: left;">
    <small><i>*Obat tidak bisa dikembalikan</i></small>
</div>

<br>
<div style="text-align: center; width: 380px;">
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
            font-family: Sans Serif;
            font-size:16px;
            color:#000000;
            border-width: 2px;
            border-collapse: collapse;

        }
        table.gridtableheader {
            font-family: Sans Serif;
            font-size:14px;
            color:#000000;
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
            font-family: Sans Serif;
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
