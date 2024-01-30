<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Data Pembelian Bahan Habis Pakai
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Master</a></li>
            <li class="active">Data Pembelian Bahan Habis Pakai</li>
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
                            <a href="<?php echo base_url(); ?>BahanHabisPakai/tambahPembelian">
                                <button type="button" class="btn btn-primary"><span
                                            class="glyphicon glyphicon-plus"></span></button>
                            </a>
<!--                            <a href="--><?php //echo base_url(); ?><!--BahanHabisPakai/settingPersenPembelian">-->
<!--                                <button type="button" class="btn btn-success"><span-->
<!--                                            class="glyphicon glyphicon-cog"></span></button>-->
<!--                            </a>-->
                        </div>
                        <div class="col-sm-2 pull-right">
                            <form class="form-horizontal" method="post"
                                  action="<?php echo base_url() ?>export/bhp/pembelian">
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
                                <th>ID</th>
                                <th>No Faktur</th>
                                <th>Tgl Faktur</th>
                                <th>Tgl Jatuh Tempo</th>
                                <th>Nama Distributor</th>
                                <th>Profit (%)</th>
                                <th class="text-right">Total</th>
                                <th>Tgl Dibuat</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($pemebelian as $row) { ?>

                                <tr>
                                    <td> <?php echo $row->id; ?></td>
                                    <td> <?php echo ucwords($row->no_faktur); ?></td>
                                    <td><?= date('d M Y', strtotime($row->tgl_faktur)) ?></td>
                                    <td><?= date('d M Y', strtotime($row->tgl_jatuh_tempo)) ?></td>
                                    <td> <?php echo ucwords($row->nama_distributor); ?></td>
                                    <td> <?php echo $row->profit . '%'; ?></td>
                                    <td class="text-right">Rp <?= number_format($row->total, 2, ',', '.') ?></td>
                                    <td>
                                        <?= date('d M Y', strtotime($row->created_at)) ?>
                                        <div class="modal fade" id="list-obat-<?= $row->id ?>" tabindex="-1"
                                             role="dialog" aria-labelledby="lostObat<?= $row->id ?>">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">NO.
                                                            FAKTUR: <?php echo ucwords($row->no_faktur); ?>
                                                            <small>[TGL: <?= date('d M Y', strtotime($row->tgl_faktur)) ?>
                                                                ]</small></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped">
                                                                <tr>
                                                                    <th>Obat</th>
                                                                    <th>Distributor</th>
                                                                    <th>Harga Beli</th>
                                                                    <th>Harga Jual</th>
                                                                    <th>Jml</th>
                                                                    <th class="text-right">Subtotal</th>
                                                                </tr>
                                                                <?php foreach (unserialize($row->list_bahan) as $key => $value) { ?>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="name"><?= $value['name'] ?></span><br>
                                                                        </td>
                                                                        <td><?= $value['distributor'] ?></td>
                                                                        <td>
                                                                            Rp <?= number_format($value['harga_beli'], 2, ',', '.') ?>
                                                                        </td>
                                                                        <td>
                                                                            <span>Rp <?php echo number_format($value['harga_jual'],2,',','.'); ?></span>
                                                                        </td>
                                                                        <td><?= $value['jumlah'] ?> <?= $value['satuan'] ?></td>
                                                                        <td class="text-right">
                                                                            Rp <?= number_format($value['subtotal'], 2, ',', '.') ?></td>
                                                                    </tr>

                                                                <?php } ?>

                                                                <tr class="calculate">
                                                                    <th colspan="5" class="text-right">Total</th>
                                                                    <th class="text-right total">
                                                                        Rp <?= number_format($row->total, 2, ',', '.') ?></th>
                                                                </tr>

                                                            </table>
                                                            <p class="text-right">
                                                                <a href="<?= base_url() . 'BahanHabisPakai/editPembelian/' . $row->id ?>"
                                                                   class="btn btn-success"> <i class="fa fa-edit"></i>
                                                                    Edit</a>
                                                                <button type="button" class="btn btn-danger"
                                                                        data-dismiss="modal" aria-label="Close"><i
                                                                            class="fa fa-close"></i> Batal
                                                                </button>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <button type="button" class="btn btn-sm btn-info"
                                                onclick="openModal(<?= $row->id ?>)"><i class="fa fa-th-list"></i>
                                        </button>
                                        <a href="<?= base_url() . 'BahanHabisPakai/editPembelian/' . $row->id ?>"
                                           class="btn btn-sm btn-success"> <i class="fa fa-edit"></i> </a>
                                    </td>
                                </tr>

                            <?php } ?>


                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<script>
    function openModal(id) {
        $(`#list-obat-${id}`).modal('show')
    }

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
