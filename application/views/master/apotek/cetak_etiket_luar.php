<html>
<head>
    <title>Cetak Etiket</title>
    <style>
        .vertical {
            display: flex;
            flex-direction: column;
        }
        .horizontal {
            display: flex;
            flex-direction: row;
        }
        .spacer {
            flex: 1;
        }
    </style>
</head>
<body>
    <div class="vertical" style="width: 300px">
        <div class="horizontal">
            No. ___________
            <div class="spacer"></div>
            Tgl: <?=date('d-m-Y')?>
        </div>
        <div>
            Nama: <?=$penjualan->nama_pasien ?? ''?>
        </div>
        <div>
            Alamat: <?=$penjualan->alamat ?? ''?>
        </div>
        <div>
            Nama Dokter: <?=$penjualan->nama_dokter ?? ''?>
        </div>

        <div class="horizontal">
            <b>Obat: <?=$obat->nama?></b>
            <div class="spacer"></div>
            <?=$jumlah_satuan?> TAB
        </div>
        <span>ED : <?=$obat->tanggal_kadaluwarsa != '0000-00-00' ? date('d-m-Y', strtotime($obat->tanggal_kadaluwarsa)) : ''?></span>
        <span><?=$signa?></span>
    </div>
<script>
    window.onload = function() { window.print(); }
</script>
</body>
</html>