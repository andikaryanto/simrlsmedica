<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Total Transaksi
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Master</a></li>
            <li class="active">Total Transaksi</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <td colspan="3" class="bg-primary text-white" align="center"><strong> Total Transaksi </strong></td>
                            </tr>
                            <tr>
                                <th>Poli</th>
                                <th>Sub Total</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $total = 0;
                            foreach ($list as $row) { ?>
                                <tr>
                                    <td> <?php echo ucwords($row->nama_jenis_pendaftaran); ?></td>
                                    <td> <?php echo 'Rp '.number_format($row->total_bayar,2,',','.'); ?></td>
                                    <td>
                                        <a href="<?php  echo base_url(); ?>Dashboard/totalTransaksi/<?php echo $row->id_poli; ?>">
                                            <button type="button" class="btn btn-primary"><i class="fa fa-arrows"></i> Detail</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            $total += $row->total_bayar;
                            }
                            foreach ($list_obat_luar as $row) { ?>
                                <tr>
                                    <td> <?php echo ucwords(str_replace("_", " ", $row->nama_jenis_pendaftaran)); ?></td>
                                    <td> <?php echo 'Rp '.number_format($row->total_bayar,2,',','.'); ?></td>
                                    <td>
                                        <a href="<?php  echo base_url(); ?>Dashboard/totalTransaksi/<?php echo $row->id_poli; ?>">
                                            <button type="button" class="btn btn-primary"><i class="fa fa-arrows"></i> Detail</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            $total += $row->total_bayar;
                            }
                            ?>
                            <tr>
                                <td><strong>Total</strong></td>
                                <td colspan="2"><strong><?php echo 'Rp '.number_format($total,2,',','.'); ?></strong></td>
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
