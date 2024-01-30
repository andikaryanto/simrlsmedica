<?php

include BASEPATH.'../application/views/template/InputBuilder.php';

?>
<link rel="stylesheet"
      href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/autocomplete/style-gue.css">
<style type="text/css">
    @import('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/css/bootstrap.min.css');
</style>

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Permintaan Ke Radiologi
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>Dashbord"><i class="fa fa-dashboard"></i> Dashbord</a></li>
            <li class="active">Permintaan Ke Radiologi</li>
        </ol>
    </section>

    <!-- Main content -->
    <form class="form-horizontal" method="post" action="<?= base_url().'Permintaan/insert_radio' ?>">
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"> Permintaan Ke Radiologi</h3>
                        </div>
                        <input type="hidden" name="pendaftaran_id" value="<?=$pendaftaran->id?>">
                        <input type="hidden" name="pemeriksaan_id" value="<?=$pemeriksaan->id?>">
                        <input type="hidden" name="dokter_id" value="<?=$pendaftaran->dokter?>">
                        <input type="hidden" name="pasien_id" value="<?=$pendaftaran->pasien?>">
                        <input type="hidden" name="rawat_inap_id" value="<?=$rawat_inap_id?>">
                        <input type="hidden" name="from_igd" value="<?=$from_igd?>">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tujuan" class="col-sm-2 control-label">Pasien</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="pasien" value="<?=$pendaftaran->nama_pasien?>"
                                                   placeholder="Pasien" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tujuan" class="col-sm-2 control-label">No RM</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="<?=$pendaftaran->no_rm?>"
                                                   placeholder="Pasien" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tujuan" class="col-sm-2 control-label">Jenis Pasien</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="jaminan" value="<?=$pendaftaran->jaminan?>"
                                                   placeholder="Pasien" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tujuan" class="col-sm-2 control-label">Usia</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="<?=$pendaftaran->usia?>"
                                                   placeholder="Pasien" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tujuan" class="col-sm-2 control-label">Alamat</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="<?=$pendaftaran->alamat?>"
                                                   placeholder="Pasien" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                    sel('tindakan[]', 'Tindakan')
                                        ->placeholder('Pilih tindakan untuk pasien')
                                        ->options($tindakan->result())
                                        ->display(function ($value) use (&$pendaftaran) {
                                            return $value->nama . " - Rp." . number_format($value->tarif_pasien, 2, ',', '.');
                                        })
                                        ->build();
                                    ?>
                                    <div style="margin-top: 200px; display: flex">
                                        <div style="flex: 1"></div>
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Rujuk</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </form>
</div>

<!-- Select2 -->
<script src="<?= base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<!-- InputMask -->
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<script type="text/javascript">
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' });
    $('[data-mask]').inputmask();
    $('.select2').select2();

</script>