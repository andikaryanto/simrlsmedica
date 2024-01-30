<link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Penjualan Obat Global
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Master</a></li>
            <li class="active">Penjualan Obat Global</li>
        </ol>
    </section>

    <section class="content">
        <!--Jasa Medis-->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <form class="form-horizontal" method="get" action="<?php echo base_url()?>Keuangan/penjualan_obat_global">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Dari Tanggal</label>
                                            <div class="col-sm-8">
                                                <input type='date' name='from' class='form-control' id='tanggal_dari' value="<?php echo ($this->input->get('from')) ? $this->input->get('from') : date('Y-m-01') ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Sampai Tanggal</label>
                                            <div class="col-sm-8">
                                                <input type='date' name='to' class='form-control' id='tanggal_sampai' value="<?php echo ($this->input->get('to')) ? $this->input->get('to') : date('Y-m-d') ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="col-sm-3">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col-sm-4"></div>
                                            <div class="col-sm-8">
                                                <button type="submit" class="btn btn-primary" style='margin-left: 0px;'>Tampilkan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <div class="col-sm-8">
                            <h3 class="box-title"> Penjualan Obat Global</h3>&nbsp;&nbsp;
                        </div>
                        <div class="col-sm-2 pull-right">
                            <form class="form-horizontal" method="post" action="<?php echo base_url()?>export/laporan/penjualan_obat_global">
                                <input type="hidden" name="from" value="<?php echo ($this->input->get('from')) ? $this->input->get('from') : '' ?>">
                                <input type="hidden" name="to" value="<?php echo ($this->input->get('to')) ? $this->input->get('to') : '' ?>">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Export Excel</button>
                            </form>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Item </th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Sub Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; $total = 0; foreach ($detail as $row) { ?>
                                <tr>
                                    <td> <?php echo $no++; ?></td>
                                    <td> <?php echo ucwords($row->nama_obat); ?></td>
                                    <td> <?php echo $row->jumlah; ?></td>
                                    <td> <?php echo $row->harga; ?></td>
                                    <td class="text-right">
                                        <?php
                                        $subtotal = $row->jumlah * $row->harga;
                                        $total += $subtotal;
                                        echo $subtotal;
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="4" align="right"><strong>Total Pemasukan : </strong></td>
                                <td align="right"><strong><?= number_format($total,2,',','.'); ?></strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true
        })
    })
</script>
