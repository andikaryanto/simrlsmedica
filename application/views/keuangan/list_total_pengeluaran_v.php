<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Pengeluaran
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Master</a></li>
            <li class="active">Data Pengeluaran</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Total Pengeluaran Tindakan</h3>&nbsp;&nbsp;
                        <!-- <a  href="<?php  echo base_url(); ?>Keuangan/tambah_Keuangan"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></button></a> -->
                    </div>
                    <!-- /.box-header -->
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
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Item</th>
                                <!-- <th>JM Dokter</th>
                                <th>JM Perawat</th>
                                <th>JM Lain</th>
                                <th>JM klinik</th>            -->
                                <th>Sub Total</th>

                                <th>Aksi</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $no=1;
                            /* $tarif_dokter_t =0;
                             $tarif_perawat_t =0;
                             $tarif_lain_t =0;
                             $klinik_t =0;
                             $grand_total =0;*/
                            $grandtotal_tindakan = 0;
                            foreach ($tindakan->result() as $row) { ?>

                                <tr>
                                    <td> <?php echo $no; ?></td>
                                    <td> Tindakan</td>
                                    <!-- <td> <?php //echo number_format($row->tarif_dokter,2,',','.'); ?></td>
                             <td> <?php //echo number_format($row->tarif_perawat,2,',','.'); ?></td> 
                             <td> <?php //echo number_format($row->tarif_lain,2,',','.'); ?></td> 
                             <td> <?php //echo number_format($row->klinik,2,',','.'); ?></td>  -->
                                    <td> <?php echo number_format(($total = $row->klinik+$row->tarif_lain+$row->tarif_dokter+$row->tarif_perawat),2,',','.'); ?></td>

                                    <td>
                                        <a  href="<?php  echo base_url(); ?>Keuangan/listPengeluaranTindakan"> <button type="button" class="btn btn-primary"><i class="fa fa-search"> Detail</i></button></a>

                                    </td>
                                </tr>


                                <?php
                                /* $tarif_dokter_t =$tarif_dokter_t + $row->tarif_dokter;
                                 $tarif_perawat_t =$tarif_perawat_t + $row->tarif_perawat;
                                 $tarif_lain_t =$tarif_lain_t + $row->tarif_lain;
                                 $klinik_t =$klinik_t + $row->klinik;
                                 $grand_total =$grand_total + $row->total;*/
                                $grandtotal_tindakan =$grandtotal_tindakan + $total;
                                $no++; } ?>
                            <?php $no=1;
                            $grandtotal_obat = 0;
                            foreach ($obat->result() as $row) { ?>

                                <tr>
                                    <td> <?php echo $no; ?></td>
                                    <td> Obat</td>
                                    <!-- <td> <?php //echo date('d-F-Y', strtotime($row->waktu_pemeriksaan)); ?></td>
                            <td> <?php //echo ucwords($row->nama); ?></td>                            
                            <td> <?php //echo $row->jumlah_satuan; ?></td> 
                            <td> <?php //echo number_format($row->harga_beli,2,',','.') ?></td>
                            <td> <?php //echo number_format( ($row->jumlah_satuan*$row->harga_beli),2,',','.'); ?></td> -->
                                    <td><?php echo number_format($row->subtotal,2,',','.'); ?></td>
                                    <td>
                                        <a  href="<?php echo base_url(); ?>Keuangan/listPengeluaranObat"> <button type="button" class="btn btn-primary"><i class="fa fa-search"> Detail</i></button></a>
                                    </td>
                                </tr>

                                <?php
                                $grandtotal_obat = $grandtotal_obat + $row->subtotal;
                                $no++; } ?>
                            <tr>
                                <td colspan="2"><strong>Grand Total</strong></td>

                                <td><strong><?php echo number_format($grandtotal_obat+$grandtotal_tindakan,2,',','.'); ?></strong></td>
                                <td></td>
                            </tr>

                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
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
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true
        })
    })
</script>