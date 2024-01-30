<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/select2/dist/css/select2.min.css">
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Data Tarif Dan Layanan
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>Dashbord"><i class="fa fa-dashboard"></i> Dashbord</a></li>
            <li class="active">Tarif Dan Layanan</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Tarif Dan Layanan</h3>
                    </div>
                    <?php $warning = $this->session->flashdata('warning');
                    if (!empty($warning)) { ?>
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                            <?php echo $warning ?>
                        </div>
                    <?php } ?>
                    <?php $success = $this->session->flashdata('success');
                    if (!empty($success)) { ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Success!</h4>
                            <?php echo $success ?>
                        </div>
                    <?php } ?>
                    <div class="box-body">
                        <form class="form-horizontal" method="post"
                              action="<?php echo base_url() ?>Laboratorium/simpanTarifDanLayanan">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="parent_id" value="0">
                                        <input type="hidden" name="id" value="<?= isset($jenis_layanan_lab) ? $jenis_layanan_lab->id : '' ?>">
                                        <div class="form-group">
                                            <label for="nama" class="col-sm-4 control-label" >Nama Tindakan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="nama_tindakan" name="nama_tindakan" placeholder="Masukkan nama tindakan" required value="<?=isset($jenis_layanan_lab) ? $jenis_layanan_lab->nama : '' ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama" class="col-sm-4 control-label">Paket</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="is_paket" id="is_paket">
                                                    <option value="0" <?=isset($jenis_layanan_lab) && $jenis_layanan_lab->is_paket == 0 ? 'selected' : ''?>>Tidak</option>
                                                    <option value="1" <?=isset($jenis_layanan_lab) && $jenis_layanan_lab->is_paket == 1 ? 'selected' : ''?>>Iya</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group for-paket">
                                            <label for="nama" class="col-sm-4 control-label" >JM Owner</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="tarif_owner" name="tarif_owner" value="<?php echo $jenis_layanan_lab->tarif_owner ?>" onkeyup="set_tarifpasien()" placeholder="Masukkan JM Owner">
                                            </div>
                                        </div>
                                        <div class="form-group for-paket">
                                            <label for="kategori" class="col-sm-4 control-label">JM Klinik</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="klinik" name="klinik" value="<?php echo $jenis_layanan_lab->klinik ?>" onkeyup="set_tarifpasien()" placeholder="Masukkan tarif untuk klinik">
                                            </div>
                                        </div>
                                        <div class="form-group for-paket">
                                            <label for="tarif_apoteker" class="col-sm-4 control-label" >JM Karyawan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="tarif_karyawan" name="tarif_karyawan" value="<?php echo $jenis_layanan_lab->tarif_karyawan ?>" onkeyup="set_tarifpasien()" placeholder="Masukkan JM Karyawan">
                                            </div>
                                        </div>
                                        <div class="form-group for-paket">
                                            <label for="nama" class="col-sm-4 control-label" >Sarpras</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="tarif_lain" name="tarif_lain" value="<?php echo $jenis_layanan_lab->tarif_lain ?>" onkeyup="set_tarifpasien()" placeholder="Masukkan Sarpras">
                                            </div>
                                        </div>
                                        <div class="form-group for-paket">
                                            <label for="nama" class="col-sm-4 control-label" >JM Dokter/Operator</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="tarif_dokter" name="tarif_dokter" value="<?php echo $jenis_layanan_lab->tarif_dokter ?>" onkeyup="set_tarifpasien()" placeholder="Masukkan JM Dokter/Operator">
                                            </div>
                                        </div>
                                        <div class="form-group for-paket">
                                            <label for="nama" class="col-sm-4 control-label" >JM Perawat/Asisten</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="tarif_perawat" name="tarif_perawat" value="<?php echo $jenis_layanan_lab->tarif_perawat ?>" onkeyup="set_tarifpasien()" placeholder="Masukkan JM Perawat/Asisten">
                                            </div>
                                        </div>
                                        <div class="form-group for-paket">
                                            <label for="nama" class="col-sm-4 control-label" >JM Analis</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="tarif_analis" name="tarif_analis" value="<?php echo $jenis_layanan_lab->tarif_analis ?>" onkeyup="set_tarifpasien()" placeholder="Masukkan JM Analis">
                                            </div>
                                        </div>
                                        <div class="form-group for-paket">
                                            <label for="tarif_apoteker" class="col-sm-4 control-label" >JM Apoteker</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="tarif_apoteker" name="tarif_apoteker" value="<?php echo $jenis_layanan_lab->tarif_apoteker ?>" onkeyup="set_tarifpasien()" placeholder="Masukkan JM Apoteker">
                                            </div>
                                        </div>
                                        <div class="form-group for-paket">
                                            <label for="tempat_lahir" class="col-sm-4 control-label">Total Tarif Pasien</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="tarif_pasien" name="tarif_pasien" placeholder="masukkan nama total tarif pasien"  value="<?=isset($jenis_layanan_lab) ? $jenis_layanan_lab->tarif_pasien : 0 ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" name="submit" value="1" class="btn btn-primary btn-lg btn-flat pull-right">Simpan
                                </button>
                                <a href="<?= base_url() ?>Laboratorium/tarifDanLayanan" class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div id='ResponseInput'></div>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<script type="text/javascript">
    function set_tarifpasien() {
        const to = parseInt($('#tarif_owner').val()) || 0;
        const k = parseInt($('#klinik').val()) || 0;
        const tk = parseInt($('#tarif_karyawan').val()) || 0;
        const tl = parseInt($('#tarif_lain').val()) || 0;
        const td = parseInt($('#tarif_dokter').val()) || 0;
        const tp = parseInt($('#tarif_perawat').val()) || 0;
        const tan = parseInt($('#tarif_analis').val()) || 0;
        const ta = parseInt($('#tarif_apoteker').val()) || 0;
        const tak = parseInt($('#tarif_asisten_khitan').val()) || 0;
        const tarifpasien = tp+td+ta+tl+k+tak+to+tk+tan;

        $('#tarif_pasien').val(tarifpasien);
    }
</script>

<script type="text/javascript">
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
    //Money Euro
    $('[data-mask]').inputmask()
</script>

<script>
    $(function () {
        const is_paket = <?=isset($jenis_layanan_lab) && $jenis_layanan_lab->is_paket == 1 ? 1 : 0?>;
        if (!is_paket)
            $('.for-paket').hide()

        $('#is_paket').change(function () {
            if ($(this).val() === '1') {
                $('.for-paket').show()
            }
            else {
                $('.for-paket').hide()
            }
        })
    })
</script>