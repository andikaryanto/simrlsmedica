<?php
if ($is_edit) {
    $list_bahan = unserialize($pembelian->list_bahan);
}
?>

<style media="screen">
    .select2-container {
        width: 100% !important;
    }
</style>

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= ($is_edit ? 'Edit' : 'Tambah') ?> Data Retur Bahan Habis Pakai
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>Dashbord"><i class="fa fa-dashboard"></i> Dashbord</a></li>
            <li class="active">Tambah Retur Bahan Habis Pakai</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <form class="form-horizontal" method="post"
                      action="<?php echo base_url() ?>BahanHabisPakai/<?= ($is_edit ? 'editRetur/' . $pembelian->id : 'tambahRetur') ?>">
                    <input type="hidden" name="id_transaksi" value="<?= ($is_edit ? $pembelian->id : 0) ?>">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"> Data Retur Bahan Habis Pakai</h3>
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
                                <button type="button" onclick="history.back()"
                                   class="btn btn-default btn-lg btn-flat pull-right">Batal</button>
                            </div>
                        </div>
                    </div>
                    <div id="hiddenFormObat">
                        <?php
                        if ($is_edit) {
                            $lastid = 0;
                            foreach ($list_bahan as $key => $value) {
                                $lastid = $key;
                                ?>
                                <div data-rowid="<?= $key ?>">
                                    <input type="hidden" name="obat[row-<?= $key ?>][id_obat]"
                                           value="<?= $value['id_obat'] ?>">
                                    <input type="hidden" name="obat[row-<?= $key ?>][name]"
                                           value="<?= $value['name'] ?>">
                                    <input type="hidden" name="obat[row-<?= $key ?>][distributor]"
                                           value="<?= $value['distributor'] ?>">
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
                        <h3 class="box-title"> Bahan</h3>
                        <!-- nama, kategori, nomor_batch, kadaluwarsa, distributor, harga_beli, harga_jual, stok_obat -->
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li>
                                <button id="tombol-tambah-obat" type="button" class="btn btn-sm btn-primary"
                                        name="button"><i class="fa fa-plus"></i> Tambah Bahan
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="box-body no-padding">
                        <div class="table-responsive">
                            <table class="table table-striped table-obat">
                                <tr>
                                    <th>Bahan</th>
                                    <th>Distributor</th>
                                    <th>Expired</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Jml</th>
                                    <th class="text-right">Subtotal</th>
                                    <th class="text-right"></th>
                                </tr>
                                <?php if ($is_edit) {
                                    foreach ($list_bahan as $key => $value) { ?>

                                        <tr class="row-obat" data-rowid="<?= $key ?>">
                                            <td>
                                                <span class="name"><?= $value['name'] ?></span>
                                            </td>
                                            <td><?= $value['distributor'] ?></td>
                                            <td>
                                                Rp <?= number_format($value['harga_beli'], 2, ',', '.') ?>
                                            </td>
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
                                        <td colspan="7" class="text-center">Masukkan data bahan disini</td>
                                    </tr>
                                <?php } ?>
                                <tr class="calculate">
                                    <th colspan="5" class="text-right">Total</th>
                                    <td class="text-right total">
                                        Rp <?= ($is_edit ? number_format($pembelian->total, 2, ',', '.') : 0) ?></td>
                                    <td></td>
                                </tr>

                            </table>

                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="total_obat" id="total_obat" value="0"/>
                            <div id="btn_tambah_template" style="display:none;">
                                <div class="box-footer">
                                    <a id="tambah_obat" class="btn btn-primary btn-lg btn-flat pull-right">Tambah
                                        Bahan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="form-obat" role="dialog" aria-labelledby="formObat">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i
                                        class="fa fa-times-circle-o"></i></button>
                            <h4 class="modal-title">Form Bahan</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_obat" class="col-sm-4 control-label"
                                                   style="font-size: small">Nama Obat</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="nama_obat" id="nama_obat"
                                                        onchange="onObatSelected()">
                                                    <option value="">--Pilih Bahan--</option>
                                                    <?php foreach ($bahan as $key => $value) { ?>
                                                        <option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" name="name" id="name" value="0"/>
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
                                            <label for="stok_obat" class="col-sm-4 control-label" style="font-size: small">Jumlah</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="stok_obat" name="stok_obat"
                                                       required>
                                            </div>
                                            <input type="hidden" class="form-control" id="satuan" name="satuan"
                                                   value="item" placeholder="gr, ml, dll" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harga_beli" class="col-sm-4 control-label" style="font-size: small">Kategori Harga</label>
                                            <div class="col-sm-8" style="margin-top: 6px">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="is_umum" id="is_umum" value="1" checked>
                                                    <label class="form-check-label" for="flexRadioDefault1" style="font-weight: normal !important;">
                                                        Umum
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="is_bpjs" id="is_bpjs" value="1" checked>
                                                    <label class="form-check-label" for="flexRadioDefault1" style="font-weight: normal !important;">
                                                        BPJS
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="is_kecantikan" id="is_kecantikan" value="1" checked>
                                                    <label class="form-check-label" for="flexRadioDefault1" style="font-weight: normal !important;">
                                                        Kecantikan
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga_beli" class="col-sm-4 control-label" style="font-size: small">Harga Beli</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="harga_beli"
                                                       name="harga_beli" onkeyup="set_harga_jual()"
                                                       placeholder="Masukkan Harga Beli" required>
                                            </div>
                                        </div>
                                        <div class="form-group" id="c-umum">
                                            <label for="harga_jual" class="col-sm-4 control-label" style="font-size: small">Harga Jual Umum</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="harga_jual" name="harga_jual" placeholder="Masukkan Harga Jual Umum" required>
                                            </div>
                                        </div>
                                        <div class="form-group" id="c-bpjs">
                                            <label for="penanggungjawab" class="col-sm-4 control-label" style="font-size: small">Harga Jual BPJS</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="harga_jual_bpjs" name="harga_jual_bpjs" placeholder="Masukkan Harga Jual BPJS">
                                            </div>
                                        </div>
                                        <div class="form-group" id="c-kecantikan">
                                            <label for="penanggungjawab" class="col-sm-4 control-label" style="font-size: small">Harga Jual Kecantikan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="harga_jual_kecantikan" name="harga_jual_kecantikan" placeholder="Masukkan Harga Jual Kecantikan">
                                            </div>
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
    </section>

</div>

<!-- Select2 -->
<script src="<?= base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->

<script>

    var index = 0;
    var distributor = '';
    var obat = <?php echo json_encode($bahan); ?>;

    function set_distributor() {
        distributor = $('#distributor').val();
    }

    function onObatSelected() {
        for (var i = 0; i < obat.length; i++) {
            var val = $('#nama_obat').val();

            if (val == obat[i].id) {
                $('#name').val(obat[i].nama);
                $('#form-obat input[name="satuan"]').val(obat[i].satuan);
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

    const persen = <?=json_encode($persen);?>;
    function set_harga_jual() {
        persen.forEach(v => {
            if (parseInt(v.id) === 4) {
                set_harga_jual_($('#harga_jual'), v.prosentase || 0)
            }
            else if (parseInt(v.id) === 5) {
                set_harga_jual_($('#harga_jual_bpjs'), v.prosentase || 0)
            }
            else if (parseInt(v.id) === 6) {
                set_harga_jual_($('#harga_jual_kecantikan'), v.prosentase || 0)
            }
        })
    }

    function set_harga_jual_($harga_jual, persen) {
        const hb = parseInt($('#harga_beli').val()) || 0;
        const untung = hb * persen / 100;
        const harga_jual = hb + untung;

        $harga_jual.val(harga_jual);
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
            console.log('form data');
            console.log(formData);

            var subtotal = parseFloat(formData['stok_obat']) * parseFloat(formData['harga_beli']);
            var subtotalF = number_format(subtotal, 2, ',', '.');
            var total = parseFloat($('#hiddenFormObat input[name="total"]').val()) + subtotal;

            var rowCounter = $('#hiddenFormObat > input[name="lastIndex"]');
            var currentCount = parseInt(rowCounter.val()) + 1;

            var theRow = `
          <tr class="row-obat" data-rowid="` + currentCount + `">
            <td>
              <span class="name">` + formData['name'] + `</span><br>
            </td>
            <td>` + formData['distributor'] + `</td>
            <td>Rp ${formData['harga_beli']}</td>
            <td>
                ${formData['is_umum'] ? `
                    <span style="font-style: italic; font-size: 12px">Umum : </span>
                    <span>Rp ${formData['harga_jual']}</span>
                    <br>
                ` : ''}
                ${formData['is_bpjs'] ? `
                    <span style="font-style: italic; font-size: 12px">BPJS : </span>
                    <span>Rp ${formData['harga_jual_bpjs']}</span>
                    <br>
                ` : ''}
                ${formData['is_kecantikan'] ? `
                    <span style="font-style: italic; font-size: 12px">Kecantikan : </span>
                    <span>Rp ${formData['harga_jual_kecantikan']}</span>
                    <br>
                ` : ''}
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
                <input type="hidden" name="obat[row-` + currentCount + `][distributor]" value="` + formData['distributor'] + `">

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
