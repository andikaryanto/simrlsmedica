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
        <div>Rekam Medis Poli Umum</div>
        <div style="display: flex; flex: 1"></div>
    </div>
</div>
<div style="width: 100%; display: flex; flex-direction: column; font-size: 12px; line-height: 120%; margin-top: 10px">
    <div class="flex">
        <div class="flex f1 b" style="align-items: center; justify-content: center">
            <h2 class="f1" style="text-align: center">PENGKAJIAN AWAL PASIEN POLI UMUM</h2>
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
                    <div style="width: 110px">Tgl Lahir/Umur</div>: <?=date('d-F-Y', strtotime($pasien['tanggal_lahir']))?> / <?=$pasien['usia']?>
                </div>
                <div class="horizontal">
                    <div class="horizontal f1">
                        <div style="width: 110px">Jenis Kelamin</div>: <?=$pasien['jk']?>
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
                    <div style="width: 110px">Nama DPJP</div>: <?=$klinik->dpjp?>
                </div>
                <div class="horizontal">
                    <div style="width: 110px">Nama PPJP</div>: <?=$klinik->ppjp?>
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
            <td style="width: 25%">
                <strong>TD :</strong>
                <?=$pemeriksaan['td']?>
            </td>
            <td style="width: 25%">
                <strong>N :</strong>
                <?=$pemeriksaan['n']?>
            </td>
            <td style="width: 25%">
                <strong>R :</strong>
                <?=$pemeriksaan['r']?>
            </td>
            <td style="width: 25%">
                <strong>BMI :</strong>
                <?=$pemeriksaan['bmi']?>
            </td>
        </tr>
        <tr>
            <td style="width: 25%">
                <strong>S :</strong>
                <?=$pemeriksaan['s']?>
            </td>
            <td style="width: 25%">
                <strong>BB :</strong>
                <?=$pemeriksaan['bb']?>
            </td>
            <td style="width: 25%">
                <strong>TB :</strong>
                <?=$pemeriksaan['tb']?>
            </td>
        </tr>
    </table>
        <table style="margin-top: 0; font-size: 12px;">
            <tr style="background-color: #eeeeee">
                <td>
                    <u><strong style="font-size: 16px">A. KAJIAN PERAWAT</strong></u>
                </td>
            </tr>
            <tr>
                <td>
                    <u><strong>ALERGI</strong></u>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Apakah pasien mempunyai indikasi alergi ? : </strong>
                    <?=$form['alergi'] ?? ''?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Jika Ya, Jelaskan : </strong>
                    <?=$form['alergi_detail'] ?? ''?>
                </td>
            </tr>
            <tr>
                <td>
                    <u><strong>NYERI</strong></u>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Skala Numerik : </strong>
                    <?=$form['nyeri'] ?? ''?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Wong Baker Faces : </strong>
                    <div style="display: flex; flex-direction: column; max-width: 400px">
                        <img src="<?php echo base_url(); ?>assets/img/wong.jpeg" alt="User Image">
                        <div style="display: flex; flex: 1; margin-left: 6px; margin-right: 8px;">
                            <input class="form-check-input" type="radio" name="form[wong]" value="0" style="margin-top: 0 !important; flex: 1" <?= isset($form['wong']) && $form['wong'] == '0' ? 'checked' : '' ?>>
                            <input class="form-check-input" type="radio" name="form[wong]" value="2" style="margin-top: 0 !important; flex: 1" <?= isset($form['wong']) && $form['wong'] == '2' ? 'checked' : '' ?>>
                            <input class="form-check-input" type="radio" name="form[wong]" value="4" style="margin-top: 0 !important; flex: 1" <?= isset($form['wong']) && $form['wong'] == '4' ? 'checked' : '' ?>>
                            <input class="form-check-input" type="radio" name="form[wong]" value="6" style="margin-top: 0 !important; flex: 1" <?= isset($form['wong']) && $form['wong'] == '6' ? 'checked' : '' ?>>
                            <input class="form-check-input" type="radio" name="form[wong]" value="8" style="margin-top: 0 !important; flex: 1" <?= isset($form['wong']) && $form['wong'] == '8' ? 'checked' : '' ?>>
                            <input class="form-check-input" type="radio" name="form[wong]" value="10" style="margin-top: 0 !important; flex: 1" <?= isset($form['wong']) && $form['wong'] == '10' ? 'checked' : '' ?>>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <u><strong>GIZI</strong></u>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Tinggi Badan : </strong>
                    <?=$form['tb'] ?? ''?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Berat Badan : </strong>
                    <?=$form['bb'] ?? ''?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Indeks Massa Tubuh (IMT) : </strong>
                    <?=$form['imt'] ?? ''?> <?=$form['gizi'] ?? ''?>
                </td>
            </tr>
            <tr>
                <td>
                    <u><strong>SKRINING RESIKO JATUH</strong></u>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Tidak seimbang/sempoyongan/limbung : </strong>
                    <?=$form['skrining_resiko_jatuh'] ?? ''?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Ada keterbatasan gerak ? : </strong>
                    <?=$form['skrining_keterbatasan_gerak'] ?? ''?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Status Fisik :</strong>
                    <?=$kajian_perawat['status_fisik']?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Psikososial :</strong>
                    <?=$kajian_perawat['psikososial']?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Riwayat Kesehatan Pasien :</strong>
                    <?=$kajian_perawat['riwayat_kesehatan_pasien']?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Riwayat Penggunaan Obat :</strong>
                    <?=$kajian_perawat['riwayat_penggunaan_obat']?>
                </td>
            </tr>
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
            <tr>
                <td>
                    <strong>Catatan Alergi/Lainnya :</strong>
                    <?=$pemeriksaan['asuhan_keperawatan']?>
                </td>
            </tr>
            <tr style="background-color: #eeeeee">
                <td>
                    <u><strong style="font-size: 16px">B. PEMERIKSAAN DOKTER</strong></u>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Anamnesis :</strong>
                    <?=$pemeriksaan['amammesia']?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Pemeriksaan Fisik :</strong>
                    <?=$pemeriksaan['pemeriksaan_fisik']?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Diagnosis Jenis Penyakit :</strong>
                    <?=implode(', ', array_map(function ($v) { return $v->nama; }, $penyakit))?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Diagnosis :</strong>
                    <?=$pemeriksaan['diagnosis']?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Tarif / Tindakan :</strong>
                    <?=implode(', ', array_map(function ($v) { return $v->nama; }, $tindakan))?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Tata Laksana :</strong>
                    <?=$pemeriksaan['deskripsi_tindakan']?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Rujukan :</strong>
                    <?=$pemeriksaan['saran_pemeriksaan']?>
                </td>
            </tr>
            <tr style="background-color: #eeeeee">
                <td>
                    <u><strong style="font-size: 16px">C. APOTEKER</strong></u>
                </td>
            </tr>
            <tr>
                <td>
                    <u><strong>SOAP</strong></u>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>S :</strong>
                    <?=$form['soap']['s'] ?? ''?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>O :</strong>
                    <?=$form['soap']['o'] ?? ''?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>A :</strong>
                    <?=$form['soap']['a'] ?? ''?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>P :</strong>
                    <?=$form['soap']['p'] ?? ''?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Obat :</strong>
                    <br>
                    <table style="border:none; font-size: 12px; line-height: 120%; max-width:100%; white-space:nowrap;">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Signa</th>
                            <th>Jumlah</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($obat_periksa as $v) : ?>
                            <tr>
                                <td><?=$v->nama?></td>
                                <td><?=$v->signa_obat?></td>
                                <td><?=$v->jumlah_satuan?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Obat Racikan :</strong>
                    <br>
                    <table style="border:none; font-size: 12px; line-height: 120%; max-width:100%; white-space:nowrap;">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th style="width: 10%">Signa</th>
                            <th style="width: 50%">Obat</th>
                            <th>Catatan</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($obat_racikan_periksa as $v) : ?>
                            <tr>
                                <td><?=$v->nama_racikan?></td>
                                <td><?=$v->signa?></td>
                                <td>
                                    <table style="font-size: 12px; line-height: 120%; max-width:100%; white-space:nowrap; border: none">
                                        <tbody>
                                        <?php foreach ($v->obat as $r) : ?>
                                            <tr style="border: none">
                                                <td style="border: none"><?=$r->nama?></td>
                                                <td style="border: none"><?=$r->jumlah_satuan?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </td>
                                <td><?=$v->catatan?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <u><strong style="text-transform: uppercase">telaah resep</strong></u>
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
                </td>
            </tr>
        </table>

        <table style="margin-top: 0; font-size: 12px; line-height: 120%; transform: translateY(-1px)">
            <tr>
                <td style="width: 33.33%">
                    <p><?=$klinik->kota?>, <?=date('d/m/Y', strtotime($pemeriksaan['waktu_pemeriksaan']))?> Jam <?=date('H:i', strtotime($pemeriksaan['waktu_pemeriksaan']))?>
                    <p style="text-align: center">Tanda Tangan DPJP</p>
                    <br>
                    <br>
                    <br>
                </td>
                <td style="width: 33.33%">
                    <p><?=$klinik->kota?>, <?=date('d/m/Y', strtotime($pemeriksaan['waktu_pemeriksaan']))?> Jam <?=date('H:i', strtotime($pemeriksaan['waktu_pemeriksaan']))?>
                    <p style="text-align: center">Tanda Tangan Apoteker</p>
                    <br>
                    <br>
                    <br>
                </td>
                <td style="width: 33.33%">
                    <p><?=$klinik->kota?>, <?=date('d/m/Y', strtotime($pemeriksaan['waktu_pemeriksaan']))?> Jam <?=date('H:i', strtotime($pemeriksaan['waktu_pemeriksaan']))?>
                    <p style="text-align: center">Tanda Tangan Perawat</p>
                    <br>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="width: 33.33%">
                    <p>Nama : <?=$klinik->dpjp?></p>
                </td>
                <td style="width: 33.33%">
                    <p>Nama : <?=$klinik->apoteker?></p>
                </td>
                <td style="width: 33.33%">
                    <p>Nama : <?=$klinik->ppjp?></p>
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
