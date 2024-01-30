<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Stok Bahan Habis Pakai
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Master</a></li>
            <li class="active">Data Stok Bahan Habis Pakai</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="col-sm-8">
                            <h3 class="box-title">Data Master</h3>&nbsp;&nbsp;
                            <button type="button" class="btn btn-primary" id="add_bahan"><span
                                        class="glyphicon glyphicon-plus"></span></button>
                        </div>
                        <div class="col-sm-2 pull-right">
                            <form class="form-horizontal" method="post"
                                  action="<?php echo base_url() ?>export/bhp/stok">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Export Excel
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-header -->
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
                        <table id="example2" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Nama</th>
                                <th class="text-right">Harga Beli</th>
                                <th class="text-right">Harga Jual</th>
                                <th>Stok</th>
                                <th>Tgl. Update</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($bahan as $row) { ?>

                                <tr id="row-<?= $row->id ?>">
                                    <td class="nama" data-nama="<?= $row->nama; ?>">
                                        <?php echo $row->nama; ?><br>
                                    </td>
                                    <td class="text-right">Rp <?= number_format($row->harga_beli, 2, ',', '.') ?></td>
                                    <td class="text-right">
                                        <span>Rp <?php echo number_format($row->harga_jual,2,',','.'); ?></span>
                                    </td>
                                    <td>
                                        <?php echo $row->jumlah; ?>
                                        <span class="jumlah" style="display: none" data-jumlah="<?php echo $row->jumlah; ?>"></span>
                                        <span class="satuan" data-satuan="<?= $row->satuan ?>"><?= $row->satuan ?></span>
                                        <span class="kode_barang" data-kode_barang="<?= $row->kode_barang ?>" style="display: none"></span>
                                        <span class="harga_beli" data-harga_beli="<?= $row->harga_beli ?>" style="display: none"></span>
                                        <span class="margin" data-margin="<?= $row->margin ?>" style="display: none"></span>
                                        <span class="harga_jual" data-harga_jual="<?= $row->harga_jual ?>" style="display: none"></span>
                                        <span class="harga_jual_bpjs" data-harga_jual_bpjs="<?= $row->harga_jual_bpjs ?>" style="display: none"></span>
                                        <span class="harga_jual_kecantikan" data-harga_jual_kecantikan="<?= $row->harga_jual_kecantikan ?>" style="display: none"></span>
                                        <span class="is_umum" data-is_umum="<?= $row->is_umum ?>" style="display: none"></span>
                                        <span class="is_bpjs" data-is_bpjs="<?= $row->is_bpjs ?>" style="display: none"></span>
                                        <span class="is_kecantikan" data-is_kecantikan="<?= $row->is_kecantikan ?>" style="display: none"></span>
                                    </td>
                                    <td><?= ($row->updated_at ? date('d M Y, H:i', strtotime($row->updated_at)) : date('d M Y, H:i', strtotime($row->created_at))) ?></td>
                                    <td class="text-right">
                                        <button type="button" value="<?= $row->id ?>" class="btn btn-sm btn-success" onclick="edit_bahan(<?= $row->id ?>)"><i class="fa fa-edit"></i></button>
                                        <a onclick="return confirm('Apakah Anda ingin menghapus data ini?');"
                                           href="<?php echo base_url(); ?>BahanHabisPakai/delete/<?php echo $row->id; ?>"
                                           class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="form_bahan" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"></h4>
            </div>
            <form method="post" role="form">
                <input type="hidden" name="id" value="0">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="nama">Nama Barang Habis Pakai</label>
                                <input type="text" class="form-control" name="nama" id="nama" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Kode Barang</label>
                                <input type="text" class="form-control" name="kode_barang" id="kode_barang" value="">
                            </div>
                            <div class="form-group">
                                <label for="satuan">Stok</label>
                                <input type="text" class="form-control" name="stok" id="stok" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text" class="form-control" name="satuan" id="satuan" value="" required>
                            </div>
                        </div>
                        <div class="col-xs-6">
<!--                            <div class="form-group">-->
<!--                                <label for="pekerjaan">Kategori Harga</label>-->
<!--                                <div>-->
<!--                                    <div class="form-check">-->
<!--                                        <input class="form-check-input" type="checkbox" name="is_umum" id="is_umum" value="1" checked>-->
<!--                                        <label class="form-check-label" for="flexRadioDefault1" style="font-weight: normal !important;">-->
<!--                                            Umum-->
<!--                                        </label>-->
<!--                                    </div>-->
<!--                                    <div class="form-check">-->
<!--                                        <input class="form-check-input" type="checkbox" name="is_bpjs" id="is_bpjs" value="1" checked>-->
<!--                                        <label class="form-check-label" for="flexRadioDefault1" style="font-weight: normal !important;">-->
<!--                                            BPJS-->
<!--                                        </label>-->
<!--                                    </div>-->
<!--                                    <div class="form-check">-->
<!--                                        <input class="form-check-input" type="checkbox" name="is_kecantikan" id="is_kecantikan" value="1">-->
<!--                                        <label class="form-check-label" for="flexRadioDefault1" style="font-weight: normal !important;">-->
<!--                                            Kecantikan-->
<!--                                        </label>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            <div class="form-group">
                                <label for="satuan">Harga Beli</label>
                                <input type="text" class="form-control" name="harga_beli" id="harga_beli" value="" onkeyup="set_harga_jual()"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="satuan">Margin</label>
                                <input type="text" class="form-control" name="margin" id="margin" value="" required onkeyup="set_harga_jual()">
                            </div>
                            <div class="form-group" id="c-umum">
                                <label for="penanggungjawab">Harga Jual Umum</label>
                                <input type="text" class="form-control" id="harga_jual" name="harga_jual">
                            </div>
<!--                            <div class="form-group" id="c-bpjs">-->
<!--                                <label for="penanggungjawab">Harga Jual BPJS</label>-->
<!--                                <input type="text" class="form-control" id="harga_jual_bpjs" name="harga_jual_bpjs">-->
<!--                            </div>-->
<!--                            <div class="form-group d-none" id="c-kecantikan">-->
<!--                                <label for="penanggungjawab">Harga Jual Kecantikan</label>-->
<!--                                <input type="text" class="form-control" id="harga_jual_kecantikan" name="harga_jual_kecantikan">-->
<!--                            </div>-->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="do_save" class="btn btn-primary" value="abdush"><i
                                class="fa fa-floppy-o"></i> Simpan
                    </button>
                    <button type="button" name="do_cancel" class="btn btn-danger" data-dismiss="modal"><i
                                class="fa fa-close"></i> Batal
                    </button>

                </div>
            </form>

        </div>
    </div>
</div>

<script>
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

    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true
        });

        $('#add_bahan').on('click', function () {
            $('#form_bahan input[name="id"]').val(0);
            $('#form_bahan input[name="nama"]').val('');
            $('#form_bahan input[name="kode_barang"]').val('');
            $('#form_bahan input[name="harga_beli"]').val('');

            $('#form_bahan input[name="harga_jual"]').val('');
            $('#form_bahan input[name="harga_jual_bpjs"]').val('');
            $('#form_bahan input[name="harga_jual_kecantikan"]').val('');
            $('#form_bahan #is_umum').prop('checked', true);
            $('#form_bahan #is_bpjs').prop('checked', true);
            $('#form_bahan #is_kecantikan').prop('checked', false);

            $('#form_bahan input[name="satuan"]').val('');
            $('#form_bahan input[name="stok"]').val('');
            $('#form_bahan .modal-title').text('Tambah Bahan Habis Pakai');
            $('#form_bahan').modal('show');
            $('#form_bahan').on('shown.bs.modal', function () {
                $('#form_bahan').find('input[name="nama"]').focus();
            });
        });
    })

    const edit_bahan = (id) => {
        var nama = $('#row-' + id).find('.nama').data('nama');
        var satuan = $('#row-' + id).find('.satuan').data('satuan');
        var jumlah = $('#row-' + id).find('.jumlah').data('jumlah');
        var kode_barang = $('#row-' + id).find('.kode_barang').data('kode_barang');

        var harga_beli = $('#row-' + id).find('.harga_beli').data('harga_beli');
        var margin = $('#row-' + id).find('.margin').data('margin');
        var harga_jual = $('#row-' + id).find('.harga_jual').data('harga_jual');
        var harga_jual_bpjs = $('#row-' + id).find('.harga_jual_bpjs').data('harga_jual_bpjs');
        var harga_jual_kecantikan = $('#row-' + id).find('.harga_jual_kecantikan').data('harga_jual_kecantikan');
        var is_umum = parseInt($('#row-' + id).find('.is_umum').data('is_umum')) || 0;
        var is_bpjs = parseInt($('#row-' + id).find('.is_bpjs').data('is_bpjs')) || 0;
        var is_kecantikan = parseInt($('#row-' + id).find('.is_kecantikan').data('is_kecantikan')) || 0;

        $('#form_bahan input[name="id"]').val(id);
        $('#form_bahan input[name="nama"]').val(nama);
        $('#form_bahan input[name="kode_barang"]').val(kode_barang);
        $('#form_bahan input[name="satuan"]').val(satuan);
        $('#form_bahan input[name="stok"]').val(jumlah);
        $('#form_bahan input[name="harga_beli"]').val(harga_beli);

        $('#form_bahan input[name="harga_jual"]').val(harga_jual);
        $('#form_bahan input[name="harga_jual_bpjs"]').val(harga_jual_bpjs);
        $('#form_bahan input[name="harga_jual_kecantikan"]').val(harga_jual_kecantikan);
        $('#form_bahan #is_umum').prop('checked', is_umum ? true : false);
        $('#form_bahan #is_bpjs').prop('checked', is_bpjs ? true : false);
        $('#form_bahan #is_kecantikan').prop('checked', is_kecantikan ? true : false);

        $('#form_bahan #c-umum').removeClass('d-none')
        $('#form_bahan #margin').val(margin)

        $('#form_bahan .modal-title').text('Edit Bahan Habis Pakai');
        $('#form_bahan').modal('show');
        $('#form_bahan').on('shown.bs.modal', function () {
            $('#form_bahan').find('input[name="nama"]').focus();
        });
    }

    function set_harga_jual() {
        const hb = parseInt($('#harga_beli').val()) || 0;
        var persen = parseFloat($('#margin').val().replaceAll(',', '.')) || 0.0;
        const untung = hb * persen / 100;
        const harga_jual = hb + untung;

        $('#harga_jual').val(harga_jual);
    }

</script>
