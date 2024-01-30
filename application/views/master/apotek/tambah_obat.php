<?php
include BASEPATH.'../application/views/template/InputBuilder.php';
?>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">
<style media="screen">
    .select2-container {
        width: 100% !important;
    }
</style>
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Obat
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>Dashbord"><i class="fa fa-dashboard"></i> Dashbord</a></li>
            <li class="active">Tambah Obat</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Tambah Obat</h3>
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

                        <!-- Date dd/mm/yyyy -->
                        <form class="form-horizontal" method="post" action="<?php echo base_url()?>Apotek/tambahObat">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" class="form-control" id="no_urut" name="no_urut" placeholder="Masukkan no_urut">
                                        <input type="hidden" class="form-control" id="kode_obat" name="kode_obat" placeholder="Masukkan kode_obat pasien">
                                        <input type="hidden" class="form-control" id="jenis" name="jenis" placeholder="Masukkan jenis obat">
                                        <div class="form-group">
                                            <label for="nama" class="col-sm-4 control-label" >Nama Obat</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama obat" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama" class="col-sm-4 control-label" >Nomor Batch</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="nomor_batch" name="nomor_batch" placeholder="Masukkan nomor batch" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori" class="col-sm-4 control-label">Kategori</label>
                                            <div class="col-sm-8">
                                                <select name="kategori" class="form-control">
                                                    <option value="Obat Bebas Terbatas">Obat Bebas Terbatas</option>
                                                    <option value="Obat Bebas">Obat Bebas</option>
                                                    <option value="Obat Keras">Obat Keras</option>
                                                    <option value="Obat Wajib Apotek (OWA)">Obat Wajib Apotek (OWA)</option>
                                                    <option value="Obat Golongan Narkotika">Obat Golongan Narkotika</option>
                                                    <option value="Obat Psikotropika">Obat Psikotropika</option>
                                                    <option value="Obat Herbal">Obat Herbal</option>
                                                    <option value="INA CBG's">INA CBG's</option>
                                                    <option value="INA CBG's Non Tagihan">INA CBG's Non Tagihan</option>
                                                    <option value="Kronis">Kronis</option>
                                                    <option value="Gas Medik">Gas Medik</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat_lahir" class="col-sm-4 control-label">Kode Barang</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="kode_barang" name="kode_barang" placeholder="masukkan kode barang">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat_lahir" class="col-sm-4 control-label">Distributor</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="distributor" name="distributor" placeholder="masukkan nama distributor" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Kadaluwarsa" class="col-sm-4 control-label"> Tanggal Kadaluwarsa</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" id="tanggal_kadaluwarsa" name="tanggal_kadaluwarsa" placeholder="Masukkan Kadaluwarsa obat" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pekerjaan" class="col-sm-4 control-label">Harga Beli</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="harga_beli" name="harga_beli" onkeyup="set_harga_jual()" placeholder="masukkan harga beli" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="stok_obat" class="col-sm-4 control-label">Margin</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="margin" name="margin" placeholder="Masukkan margin" onkeyup="set_harga_jual()" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="penanggungjawab" class="col-sm-4 control-label">Harga Jual</label>
                                            <div class="col-sm-8" style="display: flex; align-items: center">
                                                <div style="flex: 1; margin-right: 8px">
                                                    <input type="text" class="form-control" id="harga_jual"
                                                           name="harga_jual" placeholder="Masukkan Harga Jual" required>
                                                </div>
                                                <i><s id="harga-real"></s></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="stok_obat" class="col-sm-4 control-label">Stok Obat</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="stok_obat" name="stok_obat" placeholder="Masukkan stok obat" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" name="submit" value="1" class="btn btn-primary btn-lg btn-flat pull-right">Simpan</button>
                                    <a href="<?php echo base_url() ?>Apotek/stokObat"  class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
                                </div>
                                <!-- /.box-footer -->
                        </form>


                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <!-- /.col (right) -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>


<div id='ResponseInput'></div>

<script src="<?= base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>

<script type="text/javascript">

    $(function () {
        $('.select2').select2()

        $('#is_umum').change(function () {
            if (this.checked)
                $('#c-umum').removeClass('d-none')
            else
                $('#c-umum').addClass('d-none')
        })
        $('#is_bpjs').change(function () {
            if (this.checked)
                $('#c-bpjs').removeClass('d-none')
            else
                $('#c-bpjs').addClass('d-none')
        })
        $('#is_kecantikan').change(function () {
            if (this.checked)
                $('#c-kecantikan').removeClass('d-none')
            else
                $('#c-kecantikan').addClass('d-none')
        })
    })

    function set_harga_jual() {
        var hb = +$('#harga_beli').val() || 0;
        var persen = parseFloat($('#margin').val().replaceAll(',', '.')) || 0.0;
        var pjk = 0;
        var untung = hb * persen / 100;
        var harga_jual_real = hb + untung + ((hb + untung) * pjk / 100)
        var harga_bulat = harga_jual_real || 0
        var kelipatan = 5000

        if (harga_jual_real % kelipatan > 0) {
            var remainder = harga_jual_real % kelipatan
            harga_bulat = (harga_jual_real - remainder) + kelipatan
        }

        // $('#harga-real').html(harga_jual_real);
        $('#harga_jual').val(harga_jual_real);
    }
    
</script>
