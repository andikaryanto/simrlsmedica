<?php

function DateToIndo($date) {
    $BulanIndo = array("Januari", "Februari", "Maret", "April",
        "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember");
    $tgl = substr($date, 0, 2);
    $bulan = substr($date, 3, 2);
    $tahun = substr($date, 6, 4);
    $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
    $r = explode(' ', $date);
    return($result.' '.$r[1].' WIB');
}

?>

<html>
<head>
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <title>SEP</title>
    <style>
        .container {
            width: 400px;
            margin: auto;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <p style="padding: 0; margin: 0 0 0 16px"><b>FASKES TINGKAT LANJUT<br>KLINIK UTAMA SUKMA WIJAYA</b></p>
        <small><?=DateToIndo(date('d-m-Y H:i'))?></small>
        <hr>
        <p style="font-size: 30px"><?=$no?></p>
        <p>Front Office</p>
        <hr>
        <p><b>Sisa antrean: <?=$sisa?></b></p>
        <br>
        <small><i>*) Silakan mengambil nomor antrean baru,<br>jika nomor antrean terlewatkan.</i></small>
    </div>
    <script>
        $( document ).ready(function() {
            window.print();
        });
    </script>
</body>
</html>