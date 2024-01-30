
<?php
ini_set("memory_limit","20000M");
$mpdf = new mPDF('c','A4','','');
$mpdf->mirrorMargins = 10;

$html = function ($layanan, $last) use ($klinik, $dokter, $pemeriksaan, $pendaftaran, $pemeriksa) {
    $hasil = json_decode($pemeriksaan['hasil_lab'], true);
    $rows = array_map(function ($v) use ($hasil) {
        return '
        <tr style="border:1px solid;">
            <td class="gridtable" style="border:1px solid;">'.$v->name.'</td>
            <td class="gridtable" style="border:1px solid;"><span id="'.$v->id.'">'.(isset($hasil[$v->id]) ? $hasil[$v->id] : '').'</span></td>
            <td class="gridtable" style="border:1px solid;">'.$v->satuan.'</td>
            <td class="gridtable" style="border:1px solid;">'.$v->normal_value.'</td>
        </tr>
        ';
    }, $layanan->children);

    $r =  implode(" ", $rows);
    $pagebreak = $last ? '' : '<pagebreak>';

    return '
<strong>'.$klinik->nama.'</strong><br>'.$klinik->alamat.'<br>'.$klinik->telepon.'
<hr style="margin: 6px;">

<div style=\'width: 99%; margin-left:1px; margin-right: 1px;\'>
    <div style=\'float: left; width: 50%\'>
        Penanggung jawab: '.$klinik->pj_lab.' <br/>
        Nomor #: '.str_pad($pemeriksaan['id'], 8, '0', STR_PAD_LEFT).'
        <br/><br/>
        <br/><br/>
        Tgl Permintaan: '.date('d-F-Y h:m', strtotime($pemeriksaan['waktu_pemeriksaan'])).' <br/>
        Tgl Pemeriksaan: '.date('d-F-Y h:m', strtotime($pemeriksaan['waktu_pemeriksaan'])).'
    </div>
    <div style=\'float: left; width: 50%\'>
        <div style="border-style: solid; border-width: 1px; padding: 8px;">
            Nama Dokter: <strong>'.$dokter->nama.'</strong> <br/>
            Alamat:
        </div>
        <div style="border-style: solid; border-width: 1px; padding: 8px;">
            Nama Pasien: <strong>'.$pemeriksaan['nama_pasien'].'</strong> <br/>
            Jenis Kelamin: <strong>'.($pendaftaran['jk'] == 'P' ? 'Perempuan' : 'Laki-laki').' '.$pendaftaran['usia'].'</strong> <br/>
            Alamat: <strong>'.$pendaftaran['alamat'].'</strong>
        </div>
    </div>
</div>
<div class="clear"></div>
<br/>
<table width="100%" cellpadding="3" cellspacing="0">
    <tr style="border:1px solid;">
        <th cellpadding="3" style="padding: 6px; text-align: center;">JENIS PEMERIKSAAN</th>
        <th cellpadding="3" style="padding: 6px; text-align: center;">HASIL</th>
        <th cellpadding="3" style="padding: 6px; text-align: center;">SATUAN</th>
        <th cellpadding="3" style="padding: 6px; text-align: center;">NILAI NORMAL</th>
    </tr>
    <tr style="border:1px solid;"><td class="gridtable" colspan="4" style="background-color: #DDDDDD !important; border:1px solid;">
    <strong style="font-size: 14px;">'.$layanan->name.'</strong>
    </td></tr>
    '.$r.'
</table>
<br>
<div style="float: left; width: 500px;">
    <strong>Catatan:</strong>
</div>
<div style="float: right;">
    <div style="text-align: left; width: 180px;">
        Pemeriksa:
        <br>
        <br>
        <br>
        <strong>'.$pemeriksa.'</strong>
    </div>
</div>
<div style="clear: left;"></div>
<div class="pagebreak"> </div>
'.$pagebreak;
}

?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <title>Cetak Nota</title>
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <style>
        * {
            box-sizing: border-box;
            font-size:12px;
        }
        .column {
            float: left;
            width: 50%;
            padding: 10px;
        }
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
        .clear {
            content: "";
            display: table;
            clear: both;
        }
        table {
            margin: 0 !important;
        }
        table.gridtable th {
            border-width: 1px;
            padding: 2px;
            border-style: solid;
            border-color: #666666;
            background-color: #dedede;
            font-weight:bold;
        }
        td.gridtable  {
            border-width: 2px;
            padding: 4px 10px;
            border-style: solid;
            border-color: #666666;
            background-color: #ffffff;
        }

        table.gridtable2 {
            margin-top: 20px;
            font-family: Sans Serif;
            font-size:12px;
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
        @media print {
            .pagebreak { page-break-before: always; } /* page-break-after works, as well */
        }
    </style>
</head>
<body>
<?php

$page = '';
foreach ($layanan as $k => $l) {
    foreach ($all_layanan as $al) {
        if ($l->jenis_layanan_id == $al->index) {
            $page .= $html($al, $k == sizeof($layanan) - 1);
            break;
        }
    }
}

echo $page;

//$mpdf->WriteHTML($page);
////$mpdf->SetHTMLFooter($footer);
//$mpdf->SetHTMLFooter($footer,'E');
//
////$mpdf->Output();
//$mpdf->Output('filename.pdf','D');

?>
</body>
</html>

<script>
    $( document ).ready(function() {
        window.print();
    });
</script>
