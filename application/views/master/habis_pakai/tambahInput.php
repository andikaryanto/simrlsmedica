<style media="screen">
    .select2-container {
        width: 100% !important;
    }
</style>
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tambah Input Bahan Habis Pakai
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>Dashbord"><i class="fa fa-dashboard"></i> Dashbord</a></li>
            <li class="active">Tambah Input Bahan Habis Pakai</li>
        </ol>
    </section>

    <!-- Main content -->
    <form class="form-horizontal" method="post" action="<?php echo base_url()?>BahanHabisPakai/tambahInput">
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"> Data Input</h3>
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
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="tanggal" class="col-sm-4 control-label">Tanggal Digunakan</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="tgl_digunakan" value="<?=date('Y-m-d')?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pukul" class="col-sm-4 control-label">BHP</label>
                                <div class="col-sm-8">
                                    <select name="bahan_id" id="bahan_id" class="form-control" required>
                                        <option value="">--Pilih Bahan--</option>
                                        <?php foreach ($bahan as $v) : ?>
                                            <option value="<?=$v->id?>" data-satuan="<?=$v->satuan?>" data-jumlah="<?=$v->jumlah?>"><?=$v->nama?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tujuan" class="col-sm-4 control-label">Jumlah</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Masukkan Jumlah" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tujuan" class="col-sm-4 control-label">Satuan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Masukkan Satuan" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="submit" value="1" class="btn btn-primary btn-lg btn-flat pull-right">Simpan</button>
                            <button type="button" onclick="history.back()" class="btn btn-default btn-lg btn-flat pull-right">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</div>

<script>
    $(function () {
        let cur_jum = 0
        $('#bahan_id').change(function () {
            $('#satuan').val($(this).find(':selected').data('satuan'))
            cur_jum = $(this).find(':selected').data('jumlah')
            $('#jumlah').val('')
        })
        $('#jumlah').keyup(function () {
            if ($('#bahan_id').val() && +$(this).val() > cur_jum) {
                alert('Jumlah melebihi stok bahan')
            }
        })
    })
</script>

<!-- Select2 -->
<script src="<?= base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->

<!-- InputMask -->
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
