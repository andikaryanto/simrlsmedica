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
<head></head>
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

<p style="text-align: center; padding-bottom: -15px;"><strong><u>SURAT KETERANGAN SAKIT</u></strong></p>
<p style="text-align: center; padding-bottom: -15px;"><strong>Nomor : <?=$nomor?></strong></p>

<p style="padding-bottom: -15px;">Yang bertanda tangan di bawah ini menerangkan bahwa :</p>
<p style="padding-left: 30px; padding-bottom: -15px;">Nama&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : <?= $pemeriksaan->nama_pasien?></p>
<p style="padding-left: 30px;  padding-bottom: -15px;">Umur&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : <?= $usia?></p>
<p style="padding-left: 30px; padding-bottom: -17px;">Jenis Kelamin &nbsp;: <?= $pemeriksaan->jk == 'L' ? 'Laki-Laki' : 'Perempuan'?></p>
<p style="padding-left: 30px;  padding-bottom: -15px;">Pekerjaan&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: <?= $pemeriksaan->pekerjaan?></p>
<p style="padding-left: 30px;  padding-bottom: -15px;">Alamat&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: <?= $pemeriksaan->alamat?></p>
<p>Oleh karena sakit, maka memerlukan istirahat selama :................................. hari, terhitung mulai dari ................................... s/d .....................................</p>
<p>Harap yang berkepentingan maklum.</p>
<p>Terimakasih</p>

<p style="padding-left: 400px; padding-bottom: -15px;padding-top: -20px;"><?=$klinik->kota?>, <?=DateToIndo(date('d-m-Y'))?></p>
<p style="padding-left: 400px;">Dokter Pemeriksa,</p>
<p style="padding-left: 400px;">&nbsp;</p>
<p style="padding-left: 400px;">&nbsp;</p>
<p style="padding-left: 400px;"><?= $klinik->dpjp?> </p>
<p style="padding-left: 400px;">SIP: <?= $pemeriksaan->sip?></p>
</body>
</html>

<script>
    window.print()
</script>