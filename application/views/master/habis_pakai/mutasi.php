<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Mutasi Bahan Habis Pakai
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Master</a></li>
            <li class="active">Data Mutasi Bahan Habis Pakai</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-header">
                        <div class="col-sm-8">
                            <h3 class="box-title">Data Master</h3>&nbsp;&nbsp;
                            <a href="<?php echo base_url(); ?>BahanHabisPakai/tambahMutasi" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Mutasi</a>
                        </div>
                        <div class="col-sm-2 pull-right">
                            <form class="form-horizontal" method="post" action="<?php echo base_url()?>export/bhp/mutasi">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Export Excel</button>
                            </form>
                        </div>
                    </div>
                    <div class="box-body">

                        <div class="modal fade" id="form-tambah-mutasi" data-backdrop="static" role="dialog"
                             aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Mutasi Obat Dari Gudang</h4>
                                    </div>

                                    <form class="form-horizontal">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="tanggal"
                                                               class="col-sm-4 control-label">Tanggal</label>
                                                        <div class="col-sm-8">
                                                            <input type="date" class="form-control" id="tanggal"
                                                                   name="tanggal" value="<?= date('Y-m-d') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pukul" class="col-sm-4 control-label">Pukul</label>
                                                        <div class="col-sm-8">
                                                            <input type="time" class="form-control" id="pukul"
                                                                   name="pukul" value="<?= date('H:i') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tujuan"
                                                               class="col-sm-4 control-label">Tujuan</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" maxlength="255" class="form-control"
                                                                   id="tujuan" name="tujuan" placeholder="Apotik"
                                                                   required>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>
                                                Simpan
                                            </button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal"
                                                    aria-label="Close"><i class="fa fa-close"></i> Batal
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="example1" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th colspan="2">Tanggal</th>
                                    <th>Item</th>
                                    <th>Kedaluarsa</th>
                                    <th>Jml</th>
                                    <th>Tujuan</th>
                                    <th>Keterangan</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($mutasi as $key => $value) { ?>
                                    <tr>
                                        <td><?= $value->id ?></td>
                                        <td>
                                            <?= date('d M Y', strtotime($value->created_at)) ?><br>
                                            <small><i>PUKUL: <?= date('H:i', strtotime($value->created_at)) ?></i>
                                            </small>
                                        </td>
                                        <td><?= ($value->jumlah < 0 ? '<span class="label label-warning">Keluar</span>' : '<span class="label label-success">Masuk</span>') ?></td>
                                        <td>
                                            <?= $value->nama ?>
                                        </td>
                                        <td><?= date('d M Y', strtotime($value->tanggal_kadaluwarsa)) ?></td>
                                        <td><?= ($value->jumlah < 0 ? (-1 * $value->jumlah) : $value->jumlah) ?> <?= $value->satuan ?></td>
                                        <td><?= $value->tujuan ?></td>
                                        <td>
                                            <small><?= $value->note ?></small>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>


            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>

<script>
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
        })
    })
</script>
