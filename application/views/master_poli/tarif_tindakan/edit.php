<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/select2/dist/css/select2.min.css">
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Data Tarif Tindakan
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>Dashbord"><i class="fa fa-dashboard"></i> Dashbord</a></li>
            <li class="active"><?=$title?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title"><?=$title?></h3>
                    </div>
                    <?php $warning = $this->session->flashdata('warning');
                    if (!empty($warning)){ ?>
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                            <?php echo $warning ?>
                        </div>
                    <?php } ?>
                    <?php $success = $this->session->flashdata('success');
                    if (!empty($success)){ ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Success!</h4>
                            <?php echo $success ?>
                        </div>
                    <?php } ?>
                    <div class="box-body">
                        <form class="form-horizontal" method="post" action="<?php echo base_url()?>MasterPoli/simpanUpdateTindakan">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="jenis" value="<?=$jenis?>">
                                        <input type="hidden" name="id" value="<?=$tarif_tindakan->id?>">
                                        <div class="form-group">
                                            <label for="nama" class="col-sm-4 control-label" >Nama Tindakan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="nama_tindakan" name="nama_tindakan" value="<?php echo $tarif_tindakan->nama ?>" onkeyup="set_tarifpasien()" placeholder="Masukkan nama_tindakan" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama" class="col-sm-4 control-label" >JM Perawat/Operator</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="tarif_perawat" name="tarif_perawat" value="<?php echo $tarif_tindakan->tarif_perawat ?>" onkeyup="set_tarifpasien()" placeholder="Masukkan JM perawat" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama" class="col-sm-4 control-label" >JM Dokter</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="tarif_dokter" name="tarif_dokter" value="<?php echo $tarif_tindakan->tarif_dokter ?>" onkeyup="set_tarifpasien()" placeholder="Masukkan jm dokter">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tarif_apoteker" class="col-sm-4 control-label" >JM Ass Operator</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="tarif_apoteker" name="tarif_apoteker" value="<?php echo $tarif_tindakan->tarif_apoteker ?>" onkeyup="set_tarifpasien()" placeholder="Masukkan jm apoteker">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama" class="col-sm-4 control-label" >Sarpras</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="tarif_lain" name="tarif_lain" value="<?php echo $tarif_tindakan->tarif_lain ?>" onkeyup="set_tarifpasien()" placeholder="Masukkan Jasa lain-lain " required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori" class="col-sm-4 control-label">Klinik</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="klinik" name="klinik" value="<?php echo $tarif_tindakan->klinik ?>" onkeyup="set_tarifpasien()" placeholder="Masukkan tarif untuk klinik" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori" class="col-sm-4 control-label">JM Admin</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="jm_admin" name="jm_admin" value="<?php echo $tarif_tindakan->jm_admin ?>" onkeyup="set_tarifpasien()" placeholder="Masukkan tarif untuk klinik" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori" class="col-sm-4 control-label">Pajak</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="pajak" name="pajak" value="<?php echo $tarif_tindakan->pajak ?>" onkeyup="set_tarifpasien()" placeholder="Masukkan tarif untuk klinik" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori" class="col-sm-4 control-label">Zakat</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="zakat" name="zakat" value="<?php echo $tarif_tindakan->zakat ?>" onkeyup="set_tarifpasien()" placeholder="Masukkan tarif untuk klinik" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori" class="col-sm-4 control-label">BHP</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="bhp" name="bhp" value="<?php echo $tarif_tindakan->bhp ?>" onkeyup="set_tarifpasien()" placeholder="Masukkan tarif untuk klinik" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat_lahir" class="col-sm-4 control-label">Total Tarif Pasien</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="tarif_pasien" name="tarif_pasien" value="<?php echo $tarif_tindakan->tarif_pasien ?>" placeholder="masukkan nama total tarif pasien" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" name="submit" value="1" class="btn btn-primary btn-lg btn-flat pull-right">Simpan</button>
                                <a href="<?=base_url()?>MasterPoli/listtariftindakan/<?=$jenis?>"  class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
                            </div>
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
        var tp = parseInt($('#tarif_perawat').val()) || 0;
        var td = parseInt($('#tarif_dokter').val()) || 0;
        var ta = parseInt($('#tarif_apoteker').val()) || 0;
        var tl = parseInt($('#tarif_lain').val()) || 0;
        var k = parseInt($('#klinik').val()) || 0;
        var jma = parseInt($('#jm_admin').val()) || 0;
        var pjk = parseInt($('#pajak').val()) || 0;
        var zkt = parseInt($('#zakat').val()) || 0;
        var bhp = parseInt($('#bhp').val()) || 0;

        var tarifpasien = tp+td+ta+tl+k+jma+pjk+zkt+bhp;
        $('#tarif_pasien').val(tarifpasien);
    }
</script>

<script type="text/javascript">
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()
</script>
