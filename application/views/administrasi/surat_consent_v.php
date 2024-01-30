<link rel="stylesheet"
      href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Surat Keterangan Informed Consent
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Surat Sehat </a></li>
            <li class="active"> Pasien</li>
        </ol>
    </section>
    <section class="invoice col-md-8">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-user"></i> NO. RM <?php echo $pemeriksaan->no_rm ?>
                    <small class="pull-right"><strong>Tanggal: <?php echo $pemeriksaan->waktu_pemeriksaan ?></strong></small>
                </h2>
            </div>
        </div>
        <form enctype="multipart-data" method="POST" action="<?php echo base_url() ?>Administrasi/surat_consent_print/<?php echo $pemeriksaan->id ?>">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="text-center"><b>INFORMED CONSENT</b></h4>
                    <p>Saya yang bertanda tangan di bawah ini :</p>
                    <table class="table">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><input type="text" name="informed[nama]" id="faco_nama" class="form-control" value="<?=isset($informed) ? $informed->nama : $pasien->nama?>"></td>
                        </tr>
                        <tr>
                            <td>Umur / Tgl Lahir</td>
                            <td>:</td>
                            <td><input type="text" name="informed[umur_tgl_lahir]" id="faco_umur_tgl_lahir" class="form-control" value="<?=isset($informed) ? $informed->umur_tgl_lahir : $pasien->usia . ' / ' . $pasien->tanggal_lahir?>"></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><input type="text" name="informed[alamat]" id="faco_alamat" class="form-control" value="<?=isset($informed) ? $informed->alamat : $pasien->alamat?>"></td>
                        </tr>
                        <tr>
                            <td>Tlp / Hp</td>
                            <td>:</td>
                            <td><input type="text" name="informed[telp]" id="faco_telp" class="form-control" value="<?=isset($informed) ? $informed->telp : $pasien->telepon?>"></td>
                        </tr>
                    </table>
                    <p style="margin-left: 10px">
                        Adalah <br>
                        <span style="margin-top: 2px; margin-right: 4px"><input type="radio" name="informed[dari]" value="1" <?=isset($informed) ? ($informed->dari == 1 ? 'checked' : '') : 'checked'?>><label>saya sendiri</label></span><br>
                        <span style="margin-top: 2px; margin-right: 4px"><input type="radio" name="informed[dari]" value="2" <?=isset($informed) ? ($informed->dari == 2 ? 'checked' : '') : ''?>><label>suami</label></span><br>
                        <span style="margin-top: 2px; margin-right: 4px"><input type="radio" name="informed[dari]" value="3" <?=isset($informed) ? ($informed->dari == 3 ? 'checked' : '') : ''?>><label>orang tua</label></span><br>
                        <span style="margin-top: 2px; margin-right: 4px"><input type="radio" name="informed[dari]" value="4" <?=isset($informed) ? ($informed->dari == 4 ? 'checked' : '') : ''?>><label>kakak</label></span><br>
                        <span style="margin-top: 2px; margin-right: 4px"><input type="radio" name="informed[dari]" value="5" <?=isset($informed) ? ($informed->dari == 5 ? 'checked' : '') : ''?>><label>adik</label></span><br>
                        dari pasien:
                    </p>
                    <table class="table">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><input type="text" class="form-control" value="<?=$pasien->nama?>" required></td>
                        </tr>
                        <tr>
                            <td>Umur / Tgl Lahir</td>
                            <td>:</td>
                            <td><input type="text" class="form-control" value="<?=$pasien->usia?> / <?=$pasien->tanggal_lahir?>" required></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><input type="text" class="form-control" value="<?=$pasien->alamat?>" required></td>
                        </tr>
                        <tr>
                            <td>Tlp / Hp</td>
                            <td>:</td>
                            <td><input type="text" class="form-control" value="<?=$pasien->telepon?>" required></td>
                        </tr>
                    </table>
                    <p style="margin-left: 10px">
                        Dengan ini menyatakan telah
                        <span style="margin-top: 2px; margin-right: 4px; margin-left: 4px"><input type="radio" name="informed[setuju]" value="1" <?=isset($informed) ? ($informed->setuju == 1 ? 'checked' : '') : 'checked'?>><label>Menyetujui</label></span>
                        <span style="margin-top: 2px; margin-right: 4px; margin-left: 4px"><input type="radio" name="informed[setuju]" value="0" <?=isset($informed) ? ($informed->setuju == 0 ? 'checked' : '') : ''?>><label>Menolak</label></span>
                        untuk melakukan Tindakan Medis
<!--                        <input type="text" class="form-control" name="informed[tindakan]" value="--><?php //=isset($informed) ? $informed->tindakan : ''?><!--">-->
                        <span style="margin-top: 2px; margin-right: 4px; margin-left: 4px"><input type="radio" name="informed[tindakan]" value="1" <?=isset($informed) ? ($informed->tindakan == 1 ? 'checked' : '') : 'checked'?>><label>Perawatan Luka</label></span>
                        <span style="margin-top: 2px; margin-right: 4px; margin-left: 4px"><input type="radio" name="informed[tindakan]" value="2" <?=isset($informed) ? ($informed->tindakan == 2 ? 'checked' : '') : ''?>><label>Jahit (Hecting)</label></span>
                        <span style="margin-top: 2px; margin-right: 4px; margin-left: 4px"><input type="radio" name="informed[tindakan]" value="3" <?=isset($informed) ? ($informed->tindakan == 3 ? 'checked' : '') : ''?>><label>Pemasangan Infus</label></span>
                        <span style="margin-top: 2px; margin-right: 4px; margin-left: 4px"><input type="radio" name="informed[tindakan]" value="4" <?=isset($informed) ? ($informed->tindakan == 4 ? 'checked' : '') : ''?>><label>Injeksi</label></span>
                        <span style="margin-top: 2px; margin-right: 4px; margin-left: 4px"><input type="radio" name="informed[tindakan]" value="5" <?=isset($informed) ? ($informed->tindakan == 5 ? 'checked' : '') : ''?>><label>Rujuk Inap</label></span>
                        <span style="margin-top: 2px; margin-right: 4px; margin-left: 4px"><input type="radio" name="informed[tindakan]" value="6" <?=isset($informed) ? ($informed->tindakan == 6 ? 'checked' : '') : ''?>><label>Sunat</label></span>.
                        Pernyataan ini dibuat dengan kesadaran penuh setelah penjelasan sepenuhnya dari dokter/perawat tentang apa yang dimaksud dan tujuan tindakan tersebut beserta kemungkinan pemberian tindakan di atas.
                    </p>
                    <table style="width: 100%">
                        <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center">Sidoarjo, <?=DateIndo(date('Y-m-d'))?></td>
                        </tr>
                        <tr>
                            <td class="text-center">Petugas</td>
                            <td></td>
                            <td></td>
                            <td class="text-center">Yang memberi pernyataan</td>
                        </tr>
                        <tr>
                            <td class="text-center"></td>
                            <td></td>
                            <td></td>
                            <td class="text-center"></td>
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
                            <td class="text-center"><input type="text" class="form-control" name="informed[ttd]" value="<?=isset($informed) ? $informed->ttd : ''?>"></td>
                            <td></td>
                            <td></td>
                            <td class="text-center"><?=isset($informed) ? $informed->nama : '(..............................................)'?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row no-print" style="margin-top: 20px">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                </div>
            </div>
        </form>
    </section>
    <div class="clearfix"></div>
</div>

<script>
    $(function () {
        const pasien = <?=json_encode($pasien)?>;
        $('input[type=radio][name="informed[dari]"]').change(function() {
            if ($(this).val() === '1') {
                $('#faco_nama').val(pasien.nama)
                $('#faco_jk').val(pasien.jk === 'L' ? 'Laki-laki' : 'Perempuan')
                $('#faco_umur_tgl_lahir').val(`${pasien.usia} / ${pasien.tanggal_lahir}`)
                $('#faco_alamat').val(pasien.alamat)
                $('#faco_telp').val(pasien.telepon)
            }
            else {
                $('#faco_nama').val('')
                $('#faco_jk').val('')
                $('#faco_umur_tgl_lahir').val('')
                $('#faco_alamat').val('')
                $('#faco_telp').val('')
            }
        })
    })
</script>