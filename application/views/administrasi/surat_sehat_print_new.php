<?php
function DateToIndo($date) {
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

</head>
<body>
<div style="display: flex; width: 100%">
    <div style="width: 100px">
        <img height="70" src="<?=base_url()?>assets/img/klinik/<?=$klinik->foto?>" alt="User Image">
    </div>
    <div style="flex: 1; text-align: center; margin-top: 6px">
        <span><strong><?=strtoupper($klinik->nama)?></strong></span>
        <br>
        <span><strong><?=$klinik->alamat?></strong></span>
        <br>
        <span><strong>Telp <?=$klinik->telepon?></strong></span>
    </div>
    <div style="width: 100px"></div>
</div>
<hr style="padding-bottom: -20px;"></hr>

<p style="text-align: center; padding-bottom: -20px; padding-to: -20px;"><strong><u>SURAT KETERANGAN SEHAT</u></strong></p>
<p style="text-align: center; padding-bottom: -15px;">NOMOR: <?=$nomor?></p>

<p style="padding-bottom: -15px;">Yang bertanda tangan di bawah ini :</p>
<p style="padding-left: 30px; padding-bottom: -17px;">Nama&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : <?= $klinik->dpjp?></p>
<p style="padding-left: 30px; padding-bottom: -17px;">Dokter di&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: <?= strtoupper($klinik->nama)?></p>

<p style="padding-bottom: -15px;">Dengan ini saya menerangkan bahwa :</p>
<p style="padding-left: 30px; padding-bottom: -17px;">Nama&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : <?= $pemeriksaan->nama_pasien?></p>
<p style="padding-left: 30px; padding-bottom: -17px;">Umur&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : <?= $usia?></p>
<p style="padding-left: 30px; padding-bottom: -17px;">Jenis Kelamin &nbsp;: <?= $pemeriksaan->jk == 'L' ? 'Laki-Laki' : 'Perempuan'?></p>
<p style="padding-left: 30px; padding-bottom: -17px;">Alamat&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: <?= $pemeriksaan->alamat?></p>

<p>Berdasarkan pemeriksaan saya hari ini menyatakan dalam keadaan</p>
<p><h3 style="text-align: center; padding-bottom: -35px; padding-top: -35px;">SEHAT / TIDAK SEHAT</h3></p>
<p style="padding-bottom: -15px;">Untuk keperluan : ....................................................</p>

<table style="padding:-5px">

    <tr>
        <td>Berat Badan</td>
        <td>:</td>
        <td><?= $pemeriksaan->bb ?: $pendaftaran->bb?> Kg</td>
    </tr>
    <tr>
        <td>Tinggi Badan</td>
        <td>:</td>
        <td><?= $pemeriksaan->tb ?: $pendaftaran->tb?> Cm</td>
    </tr>
    <tr>
        <td>Tekanan Darah</td>
        <td>:</td>
        <td><?= $pemeriksaan->td?> mmHg</td>
    </tr>
    <tr>
        <td>Nadi</td>
        <td>:</td>
        <td><?= $pemeriksaan->n?> */menit</td>
    </tr>
    <tr>
        <td>Penglihatan</td>
        <td>:</td>
        <td></td>
    </tr>
    <tr>
        <td>Pendengaran</td>
        <td>:</td>
        <td></td>
    </tr>
</table>

<p style="padding-left: 400px; padding-bottom: -15px;padding-top: -20px;"><?=$klinik->kota?>, <?=DateToIndo(date('d-m-Y'))?></p>
<p style="padding-left: 400px;">Yang memeriksa,</p>
<p style="padding-left: 400px;">&nbsp;</p>
<p style="padding-left: 400px;">&nbsp;</p>
<p style="padding-left: 400px;"><?= $pemeriksaan->nama_dokter?> </p>
<p style="padding-left: 400px;">SIP: <?= $pemeriksaan->sip?></p>
</body>
</html>

<script>
    window.print()
</script>