
<?php
ini_set("memory_limit","20000M");
$mpdf = new mPDF('c','A4','','');
$mpdf->mirrorMargins = 10;
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <title>Cetak Hasil Laboratorium</title>
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
            border-width: 1px;
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
            border-width: 1px;
            padding: 2px;
            font-size:12px;
            border-style: solid;
            border-color: #666666;
            background-color: #ffffff;
        }

        .column {
            float: left;
            width: 50%;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        @media print {
            .pagebreak { page-break-before: always; } /* page-break-after works, as well */
        }
    </style>
</head>
<body>

<strong><?=$klinik->nama?></strong><br><?=$klinik->alamat?><br><?=$klinik->telepon?>
<hr style="margin: 6px;">

<div style="width: 99%; margin-left:1px; margin-right: 1px;">
    <div style="float: left; width: 50%">
        Penanggung jawab: <?=$klinik->pj_lab?> <br/>
        Nomor #: <?=str_pad($pemeriksaan['id'], 8, '0', STR_PAD_LEFT)?>
        <br/><br/>
        <br/><br/>
        Tgl Permintaan: <?=date('d-F-Y h:m', strtotime($pemeriksaan['waktu_pemeriksaan']))?> <br/>
        Tgl Pemeriksaan: <?=date('d-F-Y h:m', strtotime($pemeriksaan['waktu_pemeriksaan']))?>
    </div>
    <div style="float: left; width: 50%">
        <div style="border-style: solid; border-width: 1px; padding: 8px;">
            Nama Dokter: <strong><?=$dokter->nama?></strong> <br/>
            Alamat:
        </div>
        <div style="border-style: solid; border-width: 1px; padding: 8px;">
            Nama Pasien: <strong><?=$pemeriksaan['nama_pasien']?></strong> <br/>
            Jenis Kelamin: <strong><?=($pendaftaran['jk'] == 'P' ? 'Perempuan' : 'Laki-laki')?> <?=$pendaftaran['usia']?></strong> <br/>
            Alamat: <strong><?=$pendaftaran['alamat']?></strong>
        </div>
    </div>
</div>
<div class="clear"></div>

<br>
<br>

<div class="row">
    <div class="column">
        <table class="table gridtable">
            <?php foreach ($all_layanan_1 as $l) : ?>
                <?php if (isset($l->title)) : ?>
                    <tr>
                        <td colspan="3" style="text-align: center; font-weight: bold"><?=$l->title?></td>
                    </tr>
                <?php elseif (isset($l->name)) : ?>
                    <tr>
                        <td><?=$l->label?></td>
                        <td><?=$hasil_lab[$l->name]?></td>
                        <td style="text-align: right"><?=$l->param?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="column">
        <table class="table gridtable">
            <?php foreach ($all_layanan_2 as $l) : ?>
                <?php if (isset($l->title)) : ?>
                    <tr>
                        <td colspan="3" style="text-align: center; font-weight: bold"><?=$l->title?></td>
                    </tr>
                <?php elseif (isset($l->name)) : ?>
                    <tr>
                        <td><?=$l->label?></td>
                        <td><?=$hasil_lab[$l->name]?></td>
                        <td style="text-align: right"><?=$l->param?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    </div>
</div>


<br>
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
        <strong><?=$pemeriksa?></strong>
    </div>
</div>
<div style="clear: left;"></div>

</body>
</html>

<script>
    $( document ).ready(function() {
        window.print();
    });
</script>
