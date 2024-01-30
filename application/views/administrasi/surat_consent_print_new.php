<?php
function DateIndo($date) {
    $BulanIndo = array("Januari", "Februari", "Maret", "April",
        "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember");

    $tgl = substr($date, 0, 2);
    $bulan = substr($date, 3, 2);
    $tahun = substr($date, 6, 4);
    $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;

    return($result);
}
?>
<html>
<head>
    <style>
        table.bor {
            width: 100%;
            border-collapse: collapse;
        }
        table.bor, .bor tr td, .bor tr th {
            border: 1px solid;
        }
        .bor td {
            padding: 10px;
        }

        p {
            margin-top: 8px !important;
            margin-bottom: 8px !important;
            line-height: 180% !important;
        }

        body{
            -webkit-print-color-adjust:exact !important;
            print-color-adjust:exact !important;
        }

        @media print {
            .pagebreak { page-break-before: always; } /* page-break-after works, as well */
        }
    </style>
</head>
<body>

<div>
    <div style="display: flex">
        <div style="display: flex; flex: 1; align-items: center; justify-content: center">
            <img src="<?php echo base_url(); ?>assets/img/klinik/<?php echo $klinik->foto; ?>" height="40px">
            <div style="text-align: center; margin-left: 5px; margin-top: 5px">
                <small><?=$klinik->nama?></small><br>
                <small style="font-size: 11px"><?=$klinik->alamat?></small>
            </div>
        </div>
    </div>
</div>
<p style="text-align: center; padding-bottom: -20px; margin-top: 40px;"><strong>INFORMED CONSENT</strong></p>

<p style="">Saya yang bertanda tangan di bawah ini :</p>
<p style="padding-left: 30px;">Nama&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : <?= $informed->nama?></p>
<p style="padding-left: 30px;">Umur / Tgl Lahir &nbsp;: <?= $informed->umur_tgl_lahir?></p>
<p style="padding-left: 30px;">Alamat &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: <?= $informed->alamat?></p>
<p style="padding-left: 30px;">Telp &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;: <?= $informed->telp?></p>

<p style="padding-bottom: -15px;">
    Adalah
    <?php
    if ($informed->dari == 1) {
        echo 'saya sendiri';
    }
    else if ($informed->dari == 2) {
        echo 'suami';
    }
    else if ($informed->dari == 3) {
        echo 'orang tua';
    }
    else if ($informed->dari == 4) {
        echo 'kakak';
    }
    else if ($informed->dari == 5) {
        echo 'adik';
    }
    ?>
    dari pasien:
</p>
<p style="padding-left: 30px;">Nama&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : <?= $pasien->nama?></p>
<p style="padding-left: 30px;">Umur / Tgl Lahir &nbsp;: <?=$pasien->usia?> / <?=$pasien->tanggal_lahir?></p>
<p style="padding-left: 30px;">Alamat &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: <?= $pasien->alamat?></p>
<p style="padding-left: 30px;">Telp &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;: <?= $pasien->telepon?></p>

<p>
    Dengan ini menyatakan <b><?=$informed->setuju == 1 ? 'SETUJU' : 'MENOLAK'?></b>
    untuk dilakukan Tindakan Medis berupa <b>"<?php
        if ($informed->tindakan == 1) {
            echo 'Perawatan Luka';
        }
        else if ($informed->tindakan == 2) {
            echo 'Jahit (Hecting)';
        }
        else if ($informed->tindakan == 3) {
            echo 'Pemasangan Infus';
        }
        else if ($informed->tindakan == 4) {
            echo 'Injeksi';
        }
        else if ($informed->tindakan == 5) {
            echo 'Rujuk Inap';
        }
        else if ($informed->tindakan == 6) {
            echo 'Sunat';
        }
        ?>"</b>.
</p>
<p>
    Pernyataan ini dibuat dengan kesadaran penuh setelah penjelasan sepenuhnya dari dokter/perawat tentang apa yang dimaksud dan tujuan tindakan tersebut beserta kemungkinan pemberian tindakan di atas.
</p>

<table style="width: 100%; margin-top: 40px">
    <tbody>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: center">Yogyakarta, <?=DateIndo(date('Y-m-d'))?></td>
    </tr>
    <tr>
        <td style="text-align: center">Petugas</td>
        <td></td>
        <td></td>
        <td style="text-align: center">Yang membuat pernyataan,</td>
    </tr>
    <tr>
        <td style="text-align: center"></td>
        <td></td>
        <td></td>
        <td style="text-align: center"></td>
    </tr>
    <tr>
        <td><br></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td><br></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td><br></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td style="text-align: center"><?=$informed->ttd ?: '(..............................................)'?></td>
        <td></td>
        <td></td>
        <td style="text-align: center"><?=$informed ? $informed->nama : '(..............................................)'?></td>
    </tr>
    </tbody>
</table>

</body>
</html>

<script>
    window.print()
</script>