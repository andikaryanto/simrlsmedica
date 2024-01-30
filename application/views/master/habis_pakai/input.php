<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Input Bahan Habis Pakai
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Master</a></li>
            <li class="active">Input Bahan Habis Pakai</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="col-sm-8">
                            <h3 class="box-title">Input Bahan Habis Pakai</h3>&nbsp;&nbsp;
                            <a href="<?=base_url()?>BahanHabisPakai/tambahInput" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
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
                                <th>No</th>
                                <th>Tanggal Digunakan</th>
                                <th>BHP</th>
                                <th>Jumlah</th>
                                <th>Tanggal Update</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($input as $k => $row) { ?>
                                <tr>
                                    <td><?=$k + 1?></td>
                                    <td><?=date('d-F-Y', strtotime($row->tgl_digunakan))?></td>
                                    <td><?=$row->nama?></td>
                                    <td><?=$row->jumlah?> <?=$row->satuan?></td>
                                    <td><?=date('d-m-Y H:i', strtotime($row->created_at))?></td>
                                    <td class="text-right">
                                        <a href="<?=base_url()?>BahanHabisPakai/editInput/<?php echo $row->id; ?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                        <a onclick="return confirm('Apakah Anda ingin menghapus data ini?');"
                                           href="<?php echo base_url(); ?>BahanHabisPakai/deleteInput/<?php echo $row->id; ?>"
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
                            <div class="form-group">
                                <label for="pekerjaan">Kategori Harga</label>
                                <div>
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
                                        <input class="form-check-input" type="checkbox" name="is_kecantikan" id="is_kecantikan" value="1">
                                        <label class="form-check-label" for="flexRadioDefault1" style="font-weight: normal !important;">
                                            Kecantikan
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="satuan">Harga Beli</label>
                                <input type="text" class="form-control" name="harga_beli" id="harga_beli" value="" onkeyup="set_harga_jual()"
                                       required>
                            </div>
                            <div class="form-group" id="c-umum">
                                <label for="penanggungjawab">Harga Jual Umum</label>
                                <input type="text" class="form-control" id="harga_jual" name="harga_jual">
                            </div>
                            <div class="form-group" id="c-bpjs">
                                <label for="penanggungjawab">Harga Jual BPJS</label>
                                <input type="text" class="form-control" id="harga_jual_bpjs" name="harga_jual_bpjs">
                            </div>
                            <div class="form-group d-none" id="c-kecantikan">
                                <label for="penanggungjawab">Harga Jual Kecantikan</label>
                                <input type="text" class="form-control" id="harga_jual_kecantikan" name="harga_jual_kecantikan">
                            </div>
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

        if (is_umum)
            $('#form_bahan #c-umum').removeClass('d-none')
        else
            $('#form_bahan #c-umum').addClass('d-none')

        if (is_bpjs)
            $('#form_bahan #c-bpjs').removeClass('d-none')
        else
            $('#form_bahan #c-bpjs').addClass('d-none')

        if (is_kecantikan)
            $('#form_bahan #c-kecantikan').removeClass('d-none')
        else
            $('#form_bahan #c-kecantikan').addClass('d-none')

        $('#form_bahan .modal-title').text('Edit Bahan Habis Pakai');
        $('#form_bahan').modal('show');
        $('#form_bahan').on('shown.bs.modal', function () {
            $('#form_bahan').find('input[name="nama"]').focus();
        });
    }

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
