<?php
if ($is_edit) {
    $list_obat = unserialize($pembelian->list_obat);
}
?>

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
            <?= ($is_edit ? 'Edit' : 'Tambah') ?> Data Pembelian Obat
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>Dashbord"><i class="fa fa-dashboard"></i> Dashbord</a></li>
            <li class="active">Tambah Pembelian Obat</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <form class="form-horizontal" method="post"
                      action="<?php echo base_url() ?>Apotek/<?= ($is_edit ? 'editPembelianObat' : 'tambahPembelianObat') ?>">
                    <input type="hidden" name="id_transaksi" value="<?= ($is_edit ? $pembelian->id : 0) ?>">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"> Data Pembelian Obat</h3>
                        </div>

                        <?php $warning = $this->session->flashdata('warning');
                        if (!empty($warning)) { ?>
                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                                </button>
                                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                                <?php echo $warning ?>
                            </div>
                        <?php } ?>
                        <?php $success = $this->session->flashdata('success');
                        if (!empty($success)) { ?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                                </button>
                                <h4><i class="icon fa fa-check"></i> Success!</h4>
                                <?php echo $success ?>
                            </div>
                        <?php } ?>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="no_faktur" class="col-sm-12">No Faktur</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="no_faktur" name="no_faktur"
                                           placeholder="Masukkan No Faktur"
                                           value="<?= ($is_edit ? $pembelian->no_faktur : '') ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tgl_faktur" class="col-sm-12"> Tanggal Faktur</label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" id="tgl_faktur" name="tgl_faktur"
                                           placeholder="Masukkan Tanggal Faktur"
                                           value="<?= ($is_edit ? date('Y-m-d', strtotime($pembelian->tgl_faktur)) : '') ?>"
                                           required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tgl_jatuh_tempo" class="col-sm-12"> Tanggal Jatuh Tempo</label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" id="tgl_jatuh_tempo" name="tgl_jatuh_tempo"
                                           value="<?= ($is_edit ? date('Y-m-d', strtotime($pembelian->tgl_jatuh_tempo)) : '') ?>"
                                           placeholder="Masukkan Tanggal Jatuh Tempo" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama_distributor" class="col-sm-12">Nama Distributor</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nama_distributor"
                                           name="nama_distributor"
                                           value="<?= ($is_edit ? $pembelian->nama_distributor : '') ?>"
                                           onkeyup="set_distributor()" placeholder="Masukkan Nama Distributor" required>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" name="submit" value="1"
                                        class="btn btn-primary btn-lg btn-flat pull-right">Simpan
                                </button>
                                <a href="<?php echo base_url() ?>Apotek/pembelian"
                                   class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
                            </div>
                        </div>
                    </div>
                    <div id="hiddenFormObat">
                        <?php
                        if ($is_edit) {
                            $lastid = 0;
                            foreach ($list_obat as $key => $value) {
                                $lastid = $key;
                                ?>
                                <div data-rowid="<?= $key ?>">
                                    <input type="hidden" name="obat[row-<?= $key ?>][id_obat]"
                                           value="<?= $value['id_obat'] ?>">
                                    <input type="hidden" name="obat[row-<?= $key ?>][name]"
                                           value="<?= $value['name'] ?>">
                                    <input type="hidden" name="obat[row-<?= $key ?>][batch]"
                                           value="<?= $value['batch'] ?>">
                                    <input type="hidden" name="obat[row-<?= $key ?>][kategori]"
                                           value="<?= $value['kategori'] ?>">
                                    <input type="hidden" name="obat[row-<?= $key ?>][distributor]"
                                           value="<?= $value['distributor'] ?>">
                                    <input type="hidden" name="obat[row-<?= $key ?>][tgl_kadaluwarsa]"
                                           value="<?= $value['tgl_kadaluwarsa'] ?>">
                                    <input type="hidden" name="obat[row-<?= $key ?>][harga_beli]"
                                           value="<?= $value['harga_beli'] ?>">
                                    <input type="hidden" name="obat[row-<?= $key ?>][harga_jual]"
                                           value="<?= $value['harga_jual'] ?>">
                                    <input type="hidden" name="obat[row-<?= $key ?>][jumlah]"
                                           value="<?= $value['jumlah'] ?>">
                                    <input type="hidden" name="obat[row-<?= $key ?>][satuan]"
                                           value="<?= $value['satuan'] ?>">
                                    <input type="hidden" name="obat[row-<?= $key ?>][subtotal]"
                                           value="<?= $value['subtotal'] ?>">
                                </div>

                                <?php
                            }
                        }
                        ?>

                        <input type="hidden" name="lastIndex" value="<?= ($is_edit ? ($lastid + 1) : 0) ?>">
                        <input type="hidden" name="total" value="<?= ($is_edit ? $pembelian->total : 0) ?>">

                    </div>
                </form>
            </div>
            <div class="col-md-9">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title"> Obat</h3>
                        <!-- nama, kategori, nomor_batch, kadaluwarsa, distributor, harga_beli, harga_jual, stok_obat -->
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li>
                                <button id="tombol-tambah-obat" type="button" class="btn btn-sm btn-primary"
                                        name="button"><i class="fa fa-plus"></i> Tambah Obat
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="box-body no-padding">
                        <div class="table-responsive">
                            <table class="table table-striped table-obat">
                                <tr>
                                    <th>Obat</th>
                                    <th>Distributor</th>
                                    <th>Expired</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Jml</th>
                                    <th class="text-right">Subtotal</th>
                                    <th class="text-right"></th>
                                </tr>
                                <?php if ($is_edit) {
                                    foreach ($list_obat as $key => $value) { ?>

                                        <tr class="row-obat" data-rowid="<?= $key ?>">
                                            <td>
                                                <span class="name"><?= $value['name'] ?></span><br>
                                                <small><i>BATCH: <?= $value['batch'] ?> |
                                                        KAT: <?= $value['kategori'] ?></i></small>
                                            </td>
                                            <td><?= $value['distributor'] ?></td>
                                            <td><?= $value['tgl_kadaluwarsa'] ?></td>
                                            <td>Rp <?= number_format($value['harga_beli'], 2, ',', '.') ?></td>
                                            <td>
                                                <?php if ($value['is_umum']) : ?>
                                                    <span style="font-style: italic; font-size: 12px">Umum : </span>
                                                    <span>Rp <?php echo number_format($value['harga_jual'],2,',','.'); ?></span>
                                                    <br>
                                                <?php endif; ?>
                                                <?php if ($value['is_bpjs']) : ?>
                                                    <span style="font-style: italic; font-size: 12px">BPJS : </span>
                                                    <span>Rp <?php echo number_format($value['harga_jual_bpjs'],2,',','.'); ?></span>
                                                    <br>
                                                <?php endif; ?>
                                                <?php if ($value['is_kecantikan']) : ?>
                                                    <span style="font-style: italic; font-size: 12px">Kecantikan : </span>
                                                    <span>Rp <?php echo number_format($value['harga_jual_kecantikan'],2,',','.'); ?></span>
                                                    <br>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $value['jumlah'] ?> <?= $value['satuan'] ?></td>
                                            <td class="text-right">
                                                Rp <?= number_format($value['subtotal'], 2, ',', '.') ?></td>
                                            <td class="text-right">
                                                <button type="button" class="btn btn-sm btn-danger delete"
                                                        data-rowid="<?= $key ?>"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>

                                    <?php }
                                } else { ?>
                                    <tr id="obat-kosong">
                                        <td colspan="8" class="text-center">Masukkan data obat disini</td>
                                    </tr>
                                <?php } ?>
                                <tr class="calculate">
                                    <th colspan="6" class="text-right">Total</th>
                                    <td class="text-right total">
                                        Rp <?= number_format($pembelian->total ?? 0, 2, ',', '.') ?></td>
                                    <td></td>
                                </tr>

                            </table>

                        </div>
                        <div class="box-footer">
                            <span class="text-warning" style="font-size: small; font-style: italic; padding: 0 10px;">
                              <strong>Catatan:</strong> Apabila ada satu obat dengan tanggal kedaluarsa berbeda, harap ditulis dua kali berdasar tanggal kedaluarasa dan jumlahnya.
                                </p>
                          </span>

                            <input type="hidden" name="total_obat" id="total_obat" value="0"/>
                            <div id="btn_tambah_template" style="display:none;">
                                <div class="box-footer">
                                    <a id="tambah_obat" class="btn btn-primary btn-lg btn-flat pull-right">Tambah
                                        Obat</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>

<div class="modal fade" id="form-obat" role="dialog" aria-labelledby="formObat">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i
                            class="fa fa-times-circle-o"></i></button>
                <h4 class="modal-title">Form Obat</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_obat" class="col-sm-4 control-label" style="font-size: small">Nama Obat</label>
                                <div class="col-sm-7" style="padding-right: 0 !important;">
                                    <select class="form-control" name="nama_obat" id="nama_obat" onchange="onObatSelected()">
                                        <option value="">--Pilih Obat--</option>
                                        <?php foreach ($obat->result() as $key => $value) { ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <button type="button" id="b-new-obat" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <input type="hidden" name="name" id="name" value="0"/>
                            <input type="hidden" name="stok_lama" id="stok_lama" value="0"/>
                            <div class="form-group">
                                <label for="nomor_batch" class="col-sm-4 control-label"
                                       style="font-size: small">Nomor Batch</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nomor_batch"
                                           name="nomor_batch" placeholder="Masukkan Nomor Batch" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kategori" class="col-sm-4 control-label">Kategori</label>
                                <div class="col-sm-8">
                                    <select name="kategori" id="kategori" class="form-control">
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
                                <label for="distributor" class="col-sm-4 control-label"
                                       style="font-size: small">Distributor</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="distributor"
                                           name="distributor" placeholder="Masukkan Distributor" required
                                           value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tgl_kadaluwarsa" class="col-sm-4 control-label"
                                       style="font-size: small">Tgl Kadaluwarsa</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" id="tgl_kadaluwarsa"
                                           name="tgl_kadaluwarsa" placeholder="Masukkan Tanggal Kadaluwarsa"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="harga_beli" class="col-sm-4 control-label"
                                       style="font-size: small">Harga Beli</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="harga_beli"
                                           name="harga_beli" onkeyup="set_harga_jual()"
                                           placeholder="Masukkan Harga Beli" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stok_obat" class="col-sm-4 control-label"
                                       style="font-size: small">Margin</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="margin" name="margin" onkeyup="set_harga_jual()" placeholder="Masukkan Margin" required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="harga_jual" class="col-sm-4 control-label"
                                       style="font-size: small">Harga Jual</label>
                                <div class="col-sm-8" style="display: flex; align-items: center">
                                    <div style="flex: 1; margin-right: 8px">
                                        <input type="text" class="form-control" id="harga_jual"
                                               name="harga_jual" placeholder="Masukkan Harga Jual" required>
                                    </div>
                                    <i><s id="harga-real"></s></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stok_obat" class="col-sm-4 control-label"
                                       style="font-size: small">Jumlah</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="stok_obat" name="stok_obat"
                                           required>
                                </div>
                                <input type="hidden" class="form-control" id="satuan" name="satuan"
                                       value="item" placeholder="gr, ml, dll" required>
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-create-obat" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Buat Obat</h4>
            </div>
            <form method="post" role="form" id="form-create-obat">
                <input type="hidden" name="id" value="0">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6">
                                <label for="nama">Nama Obat</label>
                                <input type="text" class="form-control" name="nama" value="" required>
                            </div>
                            <div class="col-xs-6">
                                <label for="nama">Kode Barang</label>
                                <input type="text" class="form-control" name="kode_barang" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6">
                                <label for="kategori">Kategori</label>
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
                            <div class="col-xs-6">
                                <label for="satuan">Stok</label>
                                <input type="text" class="form-control" name="stok" value="0" required>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button id="b-save-obat" type="button" name="do_save" class="btn btn-primary" value="abdush"> <i class="fa fa-floppy-o"></i> Simpan</button>
                    <button type="button" name="do_cancel" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-close"></i> Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Select2 -->
<script src="<?= base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->

<script>

    var index = 0;
    var distributor = '';
    var obat = <?php echo json_encode($obat->result()); ?>;

    function set_distributor() {
        distributor = $('#distributor').val();
    }

    function onObatSelected() {
        for (var i = 0; i < obat.length; i++) {
            var val = $('#nama_obat').val();

            if (val == obat[i].id) {
                $('#nomor_batch').val(obat[i].nomor_batch);
                $('#kategori').val(obat[i].kategori);
                $('#name').val(obat[i].nama);
                $('#stok_lama').val(obat[i].stok_obat);

                $('#is_umum').prop('checked', parseInt(obat[i].is_umum) ? true : false).change()
                $('#is_bpjs').prop('checked', parseInt(obat[i].is_bpjs) ? true : false).change()
                $('#is_kecantikan').prop('checked', parseInt(obat[i].is_kecantikan) ? true : false).change()
                break;
            }
        }
    }

    function aGetFormData(form) {
        var formData = form.serializeArray();
        var data = [];

        $.each(formData, function (i, item) {
            data[item.name] = item.value;
        });

        return data;
    }

    function number_format(number, decimals, dec_point, thousands_point) {

        if (number == null || !isFinite(number)) {
            throw new TypeError("number is not valid");
        }

        if (!decimals) {
            var len = number.toString().split('.').length;
            decimals = len > 1 ? len : 0;
        }

        if (!dec_point) {
            dec_point = '.';
        }

        if (!thousands_point) {
            thousands_point = ',';
        }

        number = parseFloat(number).toFixed(decimals);

        number = number.replace(".", dec_point);

        var splitNum = number.split(dec_point);
        splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
        number = splitNum.join(dec_point);

        return number;
    }

    $(function () {
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
        var harga_jual_real = (hb + untung + ((hb + untung) * pjk / 100)) || 0
        var harga_bulat = harga_jual_real
        var kelipatan = 5000

        if (harga_jual_real % kelipatan > 0) {
            var remainder = harga_jual_real % kelipatan
            harga_bulat = (harga_jual_real - remainder) + kelipatan
        }

        // $('#harga-real').html(harga_jual_real);
        $('#harga_jual').val(harga_jual_real);
    }
</script>

<!-- InputMask -->
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<script type="text/javascript">

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
    //Money Euro
    $('[data-mask]').inputmask()

    $('#nama_obat').select2();

    function initTableObat() {

        if ($('.table-obat .row-obat').length > 0) {
            $('#obat-kosong').remove();
        } else {
            var emptyRow = `
                <tr>
                    <td colspan="7" id="obat-kosong" class="text-center">Masukkan data obat disini</td>
                </tr>
                `;
            $(emptyRow).insertBefore('.table-obat .calculate');
        }
    }

    function initButtonDelete() {

        var deleteButton = $('.table-obat .row-obat .delete');

        deleteButton.each(function (e) {
            $(this).off('click');
        });
        deleteButton.each(function (e) {
            $(this).on('click', function () {
                var c = $(this).data('rowid');
                var currentRow = $('.table-obat .row-obat[data-rowid="' + c + '"]');
                var name = currentRow.find('.name').text();
                var ask = confirm('Apakah anda yakin ingin menghapus?\n' + name);

                if (ask) {
                    var currentSubtotal = parseFloat($('input[name="obat[row-' + c + '][subtotal]"').val());
                    var currentTotal = parseFloat($('#hiddenFormObat input[name="total"]').val()) - currentSubtotal;

                    $('#hiddenFormObat > input[name="total"]').val(currentTotal);
                    $('.table-obat .total').text('Rp ' + number_format(currentTotal, 2, ',', '.'));

                    currentRow.remove();
                    $('#hiddenFormObat div[data-rowid="' + c + '"]').remove();
                    initTableObat();
                }
            });
        });

    }

    $(function () {
        var addButton = $('#tombol-tambah-obat');

        addButton.on('click', function () {
            $('#form-obat').modal({
                backdrop: 'static',
                show: true
            });
        });

        $('#form-obat').on('show.bs.modal', function (e) {
            $('#distributor').val($('#nama_distributor').val());
        });

        $('#form-obat').on('hide.bs.modal', function (e) {
            $('#form-obat form').trigger("reset");
            $('#nama_obat').val('').trigger("change");
            $('#select2-nama_obat-container').text('--Pilih Obat--');
        });

        $('#form-obat form').on('submit', function (e) {
            e.preventDefault();
            var formData = aGetFormData($(this));
            var subtotal = parseFloat(formData['stok_obat']) * parseFloat(formData['harga_beli']);
            var subtotalF = number_format(subtotal, 2, ',', '.');
            var total = parseFloat($('#hiddenFormObat input[name="total"]').val()) + subtotal;

            var rowCounter = $('#hiddenFormObat > input[name="lastIndex"]');
            var currentCount = parseInt(rowCounter.val()) + 1;

            var theRow = `
                <tr class="row-obat" data-rowid="` + currentCount + `">
                    <td>
                        <span class="name">` + formData['name'] + `</span><br>
                        <small><i>BATCH: ` + formData['nomor_batch'] + ` | KAT: ` + formData['kategori'] + `</i></small>
                    </td>
                    <td>` + formData['distributor'] + `</td>
                    <td>` + formData['tgl_kadaluwarsa'] + `</td>
                    <td>Rp ${formData['harga_beli']}</td>
                    <td>
                        <span>Rp ${formData['harga_jual']}</span>
                    </td>
                    <td class="text-center">` + formData['stok_obat'] + ` ` + formData['satuan'] + `</td>
                    <td class="text-right">Rp ` + subtotalF + `</td>
                    <td class="text-right">
                        <button type="button" class="btn btn-sm btn-danger delete" data-rowid="` + currentCount + `"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            `;

            var theRowForm = `
            <div data-rowid="` + currentCount + `">
                <input type="hidden" name="obat[row-` + currentCount + `][id_obat]" value="` + formData['nama_obat'] + `">
                <input type="hidden" name="obat[row-` + currentCount + `][name]" value="` + formData['name'] + `">
                <input type="hidden" name="obat[row-` + currentCount + `][batch]" value="` + formData['nomor_batch'] + `">
                <input type="hidden" name="obat[row-` + currentCount + `][kategori]" value="` + formData['kategori'] + `">
                <input type="hidden" name="obat[row-` + currentCount + `][distributor]" value="` + formData['distributor'] + `">
                <input type="hidden" name="obat[row-` + currentCount + `][tgl_kadaluwarsa]" value="` + formData['tgl_kadaluwarsa'] + `">

                <input type="hidden" name="obat[row-` + currentCount + `][is_umum]" value="` + (formData['is_umum'] || 0) + `">
                <input type="hidden" name="obat[row-` + currentCount + `][is_bpjs]" value="` + (formData['is_bpjs'] || 0) + `">
                <input type="hidden" name="obat[row-` + currentCount + `][is_kecantikan]" value="` + (formData['is_kecantikan'] || 0) + `">
                <input type="hidden" name="obat[row-` + currentCount + `][harga_beli]" value="` + formData['harga_beli'] + `">
                <input type="hidden" name="obat[row-` + currentCount + `][harga_jual]" value="` + formData['harga_jual'] + `">
                <input type="hidden" name="obat[row-` + currentCount + `][harga_jual_bpjs]" value="` + formData['harga_jual_bpjs'] + `">
                <input type="hidden" name="obat[row-` + currentCount + `][harga_jual_kecantikan]" value="` + formData['harga_jual_kecantikan'] + `">

                <input type="hidden" name="obat[row-` + currentCount + `][jumlah]" value="` + formData['stok_obat'] + `">
                <input type="hidden" name="obat[row-` + currentCount + `][satuan]" value="` + formData['satuan'] + `">
                <input type="hidden" name="obat[row-` + currentCount + `][subtotal]" value="` + subtotal + `">
            </div>
        `;

            $(theRow).insertBefore('.table-obat .calculate');
            $('#hiddenFormObat').append(theRowForm);

            initButtonDelete();

            $('#hiddenFormObat > input[name="lastIndex"]').val(currentCount);
            $('#hiddenFormObat > input[name="total"]').val(total);
            $('.table-obat .total').text('Rp ' + number_format(total, 2, ',', '.'));

            initTableObat();

            $('#form-obat').modal('hide');
        });

        <?php if ($is_edit) { ?>
        initButtonDelete();
        <?php } ?>
    });
</script>

<script>
    $(function () {
        $('#b-new-obat').click(function () {
            $('#modal-create-obat').modal('show')
        })

        $('#b-save-obat').click(function () {
            $.ajax({
                type: "POST",
                url: '<?=base_url()?>BahanHabisPakai/ajax_create_obat',
                data: $("#form-create-obat").serialize(),
                success: function(data) {
                    data = JSON.parse(data)
                    if (data.success) {
                        $('#modal-create-obat').modal('hide')
                        const new_obat = data.data;
                        obat.push(new_obat)

                        $('#nama_obat').append($('<option>', {
                            value: new_obat.id,
                            text: new_obat.nama,
                            selected: true
                        })).change();

                        $(':input','#form-create-obat')
                            .not(':button, :submit, :reset, :hidden')
                            .val('')
                            .prop('checked', false)
                            .prop('selected', false);
                    }
                    else {
                        alert("Gagal menambah data")
                        console.log(data)
                    }
                },
                error: function (e) {
                    console.log(e)
                    alert("Gagal menambah data")
                }
            });
        })
    })
</script>