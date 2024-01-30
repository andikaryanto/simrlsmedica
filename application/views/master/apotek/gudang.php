<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Gudang Obat
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Master</a></li>
            <li class="active">Data Gudang</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Obat Ok</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Obat Kedaluarsa</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active no-padding" id="tab_1">
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col-xs-12 pull-right">
                                        <form class="form-horizontal pull-right" method="post" action="<?php echo base_url() ?>export/apotek/gudang/obat_ok">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Export Excel</button>
                                        </form>
                                    </div>
                                </div>
                                <br>
                                <table id="example1" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Obat</th>
                                        <th>Tgl Kedaluarsa</th>
                                        <th>Jumlah</th>
                                        <th>Update</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($obat_ok as $key => $value) { ?>
                                        <tr>
                                            <td><?= $value->id ?></td>
                                            <td>
                                                <?= $value->nama ?><br>
                                                <small><i>BATCH: <?= $value->nomor_batch ?> |
                                                        KAT: <?= $value->kategori ?></i></small>
                                            </td>
                                            <td><?= date('d M Y', strtotime($value->tanggal_kadaluwarsa)) ?></td>
                                            <td><?= $value->jumlah ?></td>
                                            <td><?= ($value->updated_at ? date('d M Y', strtotime($value->updated_at)) : '-') ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col-xs-12 pull-right">
                                        <form class="form-horizontal pull-right" method="post" action="<?php echo base_url() ?>export/apotek/gudang/obat_kedaluarsa">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Export Excel</button>
                                        </form>
                                    </div>
                                </div>
                                <br>
                                <table id="example2" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Obat</th>
                                        <th>Tgl Kedaluarsa</th>
                                        <th>Jumlah</th>
                                        <th>Update</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($obat_kedaluarsa as $key => $value) { ?>
                                        <tr>
                                            <td><?= $value->id ?></td>
                                            <td>
                                                <?= $value->nama ?><br>
                                                <small><i>BATCH: <?= $value->nomor_batch ?> |
                                                        KAT: <?= $value->kategori ?></i></small>
                                            </td>
                                            <td><?= date('d M Y', strtotime($value->tanggal_kadaluwarsa)) ?></td>
                                            <td><?= $value->jumlah ?></td>
                                            <td><?= ($value->updated_at ? date('d M Y', strtotime($value->updated_at)) : '-') ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->

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
