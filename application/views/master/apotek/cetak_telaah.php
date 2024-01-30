<html>
<head>
    <style>
        table, td, th {
            border: 1px solid;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        .no {
            border: 1px solid transparent !important;
        }
    </style>
</head>
<body onload="window.print()">
<div style="text-align: center; width: 500px;">
    <strong style="font-size: 20px"><u><?=$klinik->nama?></u></strong><br>
    <small><?=$klinik->alamat?></small><br>
    <small><?=$klinik->telepon?></small><br>
    <hr style="width: 500px;">
    <strong style="font-size: 20px"><u>TELAAH RESEP</u></strong><br>
    <br>
    <table class="no">
        <tr class="no">
            <td class="no">Nama / RM</td>
            <td class="no">:</td>
            <td class="no"><?=$pemeriksaan->nama_pasien?> / <?=$pemeriksaan->no_rm?></td>
        </tr>
        <tr class="no">
            <td class="no">Jenis Kelamin</td>
            <td class="no">:</td>
            <td class="no"><?=$pemeriksaan->jk?></td>
        </tr>
        <tr class="no">
            <td class="no">Berat Badan / Tinggi Badan</td>
            <td class="no">:</td>
            <td class="no"><?=$pemeriksaan->bb?> / <?=$pemeriksaan->tb?></td>
        </tr>
    </table>
</div>
<div style="width: 500px;">
    <br>
    <table>
        <thead>
        <tr>
            <th>INDIKATOR</th>
            <th>YA</th>
            <th>TIDAK</th>
            <th>TINDAK LANJUT</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($idx as $k => $v) : ?>
            <?php if ($k == 0) : ?>
                <tr>
                    <td colspan="4" style="text-align: center">Persyaratan Administrasi</td>
                </tr>
            <?php endif; ?>
            <?php if ($k == 2) : ?>
                <tr>
                    <td colspan="4" style="text-align: center">Persyaratan Farmasetik</td>
                </tr>
            <?php endif; ?>
            <?php if ($k == 7) : ?>
                <tr>
                    <td colspan="4" style="text-align: center">Persyaratan Klinis</td>
                </tr>
            <?php endif; ?>
            <?php if ($k == 13) : ?>
                <tr>
                    <td colspan="3" style="text-align: center"></td>
                    <td style="text-align: center">
                        Nama dan TTD Penelaah
                        <br>
                        <br>
                        <br>
                        (....................................)
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center">Telaah Obat Sebelum Diserahkan kepada Pasien</td>
                </tr>
            <?php endif; ?>
            <tr>
                <td><?=ucwords(str_replace('_', ' ', $v))?></td>
                <td><?=$telaah[$v] == 1 ? 'Ya' : ''?></td>
                <td><?=$telaah[$v] == 2 ? 'Tidak' : ''?></td>
                <td><?=$telaah["{$v}_tl"]?></td>
            </tr>
        <?php endforeach; ?>
        <tr class="no">
            <td colspan="3" style="text-align: center" class="no"></td>
            <td style="text-align: center" class="no">
                Nama dan TTD Penelaah
                <br>
                <br>
                <br>
                (....................................)
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>