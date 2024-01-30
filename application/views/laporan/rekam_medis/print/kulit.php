<?php
include BASEPATH.'../application/views/template/InputBuilder.php';
$blank = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
?>
<html lang="en">
<head>
    <style>
        .flex {
            display: flex;
        }
        .flex-column {
            display: flex;
            flex-direction: column;
        }
        .horizontal {
            display: flex;
        }
        .vertical {
            display: flex;
            flex-direction: column;
        }
        .f1 {
            flex: 1;
        }
        .f2 {
            flex: 2;
        }
        .justify-content-center {
            justify-content: center
        }
        .align-items-stretch  {
            align-items: stretch
        }
        .align-items-center  {
            align-items: center
        }
        .bt {
            border-top: 1px solid #666666;
        }
        .bb {
            border-bottom: 1px solid #666666;
        }
        .bl {
            border-left: 1px solid #666666;
        }
        .br {
            border-right: 1px solid #666666;
        }
        .b {
            border: 1px solid #666666;
        }
        .padding {
            padding: 5px 10px;
        }
        table, td, th {
            border: 1px solid #666666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            overflow-wrap: break-word;
            page-break-inside:auto
        }
        td {
            padding: 4px;
        }
        tr    { page-break-inside:avoid; page-break-after:auto }
        .vert {
            -ms-transform: rotate(-90deg)
            transform: rotate(-90deg)
            -webkit-transform: rotate(-90deg);
        }
        input[type=text] {
            outline: 0;
            border:0;
            border-bottom: 1px dotted #666666;
        }
        body {
            -webkit-print-color-adjust: exact !important;
        }
        .isian {
            color: #666666;
            display: inline-block;
            min-width: 15px;
            border-bottom: 1px dotted #aaaaaa;
            font-size: 12px;
            padding-left: 4px;
            padding-right: 4px;
        }
        p {
            margin: 4px 0;
        }
        input[type="radio"] {
            -ms-transform: scale(.8); /* IE 9 */
            -webkit-transform: scale(.8); /* Chrome, Safari, Opera */
            transform: scale(.8) translateY(3px);
        }
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=MonteCarlo">
    <title>Print</title>
</head>
<body>
<div>
    <div style="display: flex">
        <div style="display: flex; flex: 1">
            <img src="<?php echo base_url(); ?>assets/img/klinik/<?php echo $klinik->foto; ?>" width="70px" height="30px">
            <div style="text-align: center; margin-left: 5px; margin-top: 5px">
                <small><?=$klinik->nama?></small><br>
                <small style="font-size: 11px"><?=$klinik->alamat?></small>
            </div>
        </div>
        <div>Rekam Medis Poli Kulit</div>
        <div style="display: flex; flex: 1"></div>
    </div>
</div>
<div style="width: 100%; display: flex; flex-direction: column; font-size: 12px; line-height: 120%; margin-top: 10px">
    <div class="flex">
        <div class="flex f1 b" style="align-items: center; justify-content: center">
            <h2 class="f1" style="text-align: center">PENGKAJIAN AWAL PASIEN POLI KULIT</h2>
        </div>
        <div class="flex f1 bt br bb vertical" style="align-items: stretch">
            <div class="vertical padding">
                <div class="horizontal">
                    <div style="width: 110px">Nama</div>: <?=$pemeriksaan['nama_pasien']?>
                </div>
                <div class="horizontal">
                    <div style="width: 110px">No RM</div>: <?=$pemeriksaan['no_rm']?>
                </div>
            </div>
            <div class="vertical bt padding">
                <div class="horizontal">
                    <div style="width: 110px">Tgl Lahir/Umur</div>: <?=date('d-F-Y', strtotime($pemeriksaan['tanggal_lahir']))?> / <?=$pemeriksaan['usia']?>
                </div>
                <div class="horizontal">
                    <div class="horizontal f1">
                        <div style="width: 110px">Jenis Kelamin</div>: <?=$pemeriksaan['jk']?>
                    </div>
                    <div class="horizontal f1">
                        <div style="width: 50px">Ruang</div>:
                    </div>
                </div>
                <div class="horizontal">
                    <div class="horizontal f1">
                        <div style="width: 110px">No Register</div>:
                    </div>
                    <div class="horizontal f1">
                        <div style="width: 50px">Kelas</div>:
                    </div>
                </div>
                <div class="horizontal">
                    <div style="width: 110px">Tanggal Masuk</div>: <?=date('d-F-Y', strtotime($pemeriksaan['created_at']))?>
                </div>
                <div class="horizontal">
                    <div style="width: 110px">Nama DPJP</div>:
                </div>
                <div class="horizontal">
                    <div style="width: 110px">Nama PPJP</div>:
                </div>
            </div>
            <div class="vertical bt padding align-items-center">
                (Tempelkan stiker identitas pasien jika tersedia)
            </div>
        </div>
    </div>

    <div>
        <table style="margin-top: 0; font-size: 12px;">
            <tr>
                <td>
                    <strong>Diagnosa Perawat :</strong>
                    <?=$pemeriksaan['diagnosa_perawat']?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Keluhan Utama :</strong>
                    <?=$pemeriksaan['keluhan_utama']?>
                </td>
            </tr>

        </table>

        <table style="margin-top: 0; font-size: 12px; line-height: 120%; transform: translateY(-1px)">
            <tr>
                <td style="width: 33.33%">
                    <p>Yogyakarta, <span style="color: #aaaaaa">.............................</span> Jam <span style="color: #aaaaaa">.........</span></p>
                    <p style="text-align: center">Tanda Tangan DPJP</p>
                    <br>
                    <br>
                    <br>
                </td>
                <td style="width: 33.33%">
                    <p>Yogyakarta, <span style="color: #aaaaaa">.............................</span> Jam <span style="color: #aaaaaa">.........</span></p>
                    <p style="text-align: center">Tanda Tangan Dokter Umum (bila ada)</p>
                    <br>
                    <br>
                    <br>
                </td>
                <td style="width: 33.33%">
                    <p>Yogyakarta, <span style="color: #aaaaaa">.............................</span> Jam <span style="color: #aaaaaa">.........</span></p>
                    <p style="text-align: center">Tanda Tangan Perawat</p>
                    <br>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="width: 33.33%">
                    <p>Nama : </p>
                </td>
                <td style="width: 33.33%">
                    <p>Nama : </p>
                </td>
                <td style="width: 33.33%">
                    <p>Nama : </p>
                </td>
            </tr>
        </table>
        <small><?=$klinik->alamat?></small><br>
        <small>Telp: <?=$klinik->telepon?> &nbsp;&nbsp; Email: <?=$klinik->email?></small>
    </div>
</div>
</body>
</html>

<script>
    window.print()
</script>
