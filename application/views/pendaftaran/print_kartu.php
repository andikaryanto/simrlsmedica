<html>
<head>
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <title>Cetak Kartu</title>
    <style>
        .container {
            width: 550px;
            margin: auto;
        }
    </style>
</head>
<body>
<div class="container">
    <div style="display: flex; flex-direction: row">
        <img src="<?=base_url('/assets/img/klinik/'.$klinik->foto)?>" width="40" height="40" style="margin-right: 10px">
        <p style="padding: 0; margin: 0">
            <b>KARTU IDENTITAS PASIEN<br><?=$klinik->nama?></b><br>
            <small><?=$klinik->alamat?> No. Telp: <?=$klinik->telepon?> Email: <?=$klinik->email?></small>
        </p>
    </div>
    <hr>
    <br>
    <div style="display: flex; flex-direction: row; margin-top: 8px">
        <span style="width: 100px">NO. RM</span> : <span><?=$pasien->no_rm?></span>
    </div>
    <div style="display: flex; flex-direction: row; margin-top: 8px">
        <span style="width: 100px">NAMA</span> : <span><?=$pasien->nama?></span>
    </div>
    <div style="display: flex; flex-direction: row; margin-top: 8px">
        <span style="width: 100px">ALAMAT</span> : <span><?=$pasien->alamat?></span>
    </div>
    <div style="display: flex; flex-direction: row; margin-top: 8px">
        <span style="width: 100px">NIK</span> : <span><?=$pasien->nik?></span>
    </div>
    <br>
    <br>
    <br>
    <div style="text-align: center">
        <small><i>"Kesembuhan dan Kepuasan Anda Prioritas Kami"</i></small>
    </div>
</div>
<script>
    $( document ).ready(function() {
        window.print();
    });
</script>
</body>
</html>