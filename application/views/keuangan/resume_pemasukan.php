<link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Resume Pemasukan
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Master</a></li>
            <li class="active">Resume Pemasukan</li>
        </ol>
    </section>

    <section class="content">
        <!--Jasa Medis-->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                    <form class="form-horizontal" method="get" action="<?php echo base_url()?>Keuangan/resume_pemasukan">
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
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Jasa Medis</h3>&nbsp;&nbsp;
                        <!-- <a  href="<?php  echo base_url(); ?>Keuangan/tambah_Keuangan"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></button></a> -->
                    </div>
                    <!-- /.box-header -->
                    <?php $warning = $this->session->flashdata('warning');
                    if (!empty($warning)){ ?>
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                            <?= $warning ?>
                        </div>
                    <?php } ?>
                    <?php $success = $this->session->flashdata('success');
                    if (!empty($success)){ ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Success!</h4>
                            <?= $success ?>
                        </div>
                    <?php } ?>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Pemasukan</th>
                                <th>Jumlah (Rp)</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no=1;
                            $subtotal =0;
                            foreach ($total_jasa_medis->result() as $row) { ?>
                                <tr>
                                    <td> <?= $no; ?></td>
                                    <td> <?= ucwords($row->jenis_pendaftaran); ?></td>
                                    <td align="right"> <?=  number_format($row->total,2,',','.'); ?></td>
                                    <td>
                                        <a href="<?= base_url().'Keuangan/listPemasukan?item='.$row->jenis_item.'&jp_id='.$row->jenis_pendaftaran_id.'&jp_name='.urlencode($row->jenis_pendaftaran).'&jpem='.urlencode('Jasa Medis'); ?> ">
                                        <button type="button" class="btn btn-primary pull-right"><i class="fa fa-search"> Detail</i></button></a>
                                    </td>
                                </tr>
                                <?php
                                $subtotal = $subtotal +$row->total;
                                $no++; } ?>
                            <tr >
                                <td colspan="2" align="right"><strong>Total Pemasukan Jasa Medis : </strong></td>
                                <td align="right"><strong><?= number_format($subtotal,2,',','.'); ?></strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--Penjualan Obat-->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title"> Penjualan Obat</h3>&nbsp;&nbsp;
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Pemasukan</th>
                                <th>Jumlah (Rp)</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no=1;
                            $subtotal =0;
                            foreach ($total_obat->result() as $row) { ?>
                                <tr>
                                    <td> <?= $no; ?></td>
                                    <td> <?= ucwords($row->jenis_pendaftaran); ?></td>
                                    <td align="right"> <?=  number_format($row->total,2,',','.'); ?></td>
                                    <td>
                                        <a href="<?= base_url().'Keuangan/listPemasukan?item='.$row->jenis_item.'&jp_id='.$row->jenis_pendaftaran_id.'&jp_name='.urlencode($row->jenis_pendaftaran).'&jpem='.urlencode('Penjualan Obat'); ?> ">
                                        <button type="button" class="btn btn-primary pull-right"><i class="fa fa-search"> Detail</i></button></a>
                                    </td>
                                </tr>
                                <?php
                                $subtotal = $subtotal +$row->total;
                                $no++; } ?>
                            <tr >
                                <td colspan="2" align="right"><strong>Total Pemasukan Penjualan Obat : </strong></td>
                                <td align="right"><strong><?= number_format($subtotal,2,',','.'); ?></strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--Penjualan Obat Racik-->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title"> Penjualan Obat Racik</h3>&nbsp;&nbsp;
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Pemasukan</th>
                                <th>Jumlah (Rp)</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no=1;
                            $subtotal =0;
                            foreach ($total_obat_racikan->result() as $row) { ?>
                                <tr>
                                    <td> <?= $no; ?></td>
                                    <td> <?= ucwords($row->jenis_pendaftaran); ?></td>
                                    <td align="right"> <?=  number_format($row->total,2,',','.'); ?></td>
                                    <td>
                                        <a href="<?= base_url().'Keuangan/listPemasukan?item='.$row->jenis_item.'&jp_id='.$row->jenis_pendaftaran_id.'&jp_name='.urlencode($row->jenis_pendaftaran).'&jpem='.urlencode('Penjualan Obat Racik'); ?> ">
                                        <button type="button" class="btn btn-primary pull-right"><i class="fa fa-search"> Detail</i></button></a>
                                    </td>
                                </tr>
                                <?php
                                $subtotal = $subtotal +$row->total;
                                $no++; } ?>
                            <tr >
                                <td colspan="2" align="right"><strong>Total Pemasukan Penjualan Obat Racik : </strong></td>
                                <td align="right"><strong><?= number_format($subtotal,2,',','.'); ?></strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--Penjualan Obat Non Pemeriksaan-->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title"> Penjualan Obat Non Pemeriksaan</h3>&nbsp;&nbsp;
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Pemasukan</th>
                                <th>Jumlah (Rp)</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no=1;
                            $subtotal =0;
                            foreach ($total_obat_resep_luar->result() as $row) { ?>
                                <tr>
                                    <td> <?= $no; ?></td>
                                    <td> <?= ucwords(str_replace('_', ' ', $row->tipe)); ?></td>
                                    <td align="right"> <?=  number_format($row->total,2,',','.'); ?></td>
                                    <td>
                                        <a href="<?= base_url().'Keuangan/listPemasukanObatLuar?tipe='.$row->tipe?> ">
                                            <button type="button" class="btn btn-primary pull-right"><i class="fa fa-search"> Detail</i></button></a>
                                    </td>
                                </tr>
                                <?php
                                $subtotal = $subtotal +$row->total;
                                $no++; } ?>
                            <tr >
                                <td colspan="2" align="right"><strong>Total Pemasukan Penjualan Obat : </strong></td>
                                <td align="right"><strong><?= number_format($subtotal,2,',','.'); ?></strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--Jasa Obat Racik-->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title"> Jasa Obat Racik</h3>&nbsp;&nbsp;
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Pemasukan</th>
                                <th>Jumlah (Rp)</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no=1;
                            $subtotal =0;
                            foreach ($total_jasa_racik->result() as $row) { ?>
                                <tr>
                                    <td> <?= $no; ?></td>
                                    <td> <?= ucwords($row->jenis_pendaftaran); ?></td>
                                    <td align="right"> <?=  number_format($row->total,2,',','.'); ?></td>
                                    <td>
                                        <a href="<?= base_url().'Keuangan/listPemasukan?item='.$row->jenis_item.'&jp_id='.$row->jenis_pendaftaran_id.'&jp_name='.urlencode($row->jenis_pendaftaran).'&jpem='.urlencode('Jasa Obat Racik'); ?> ">
                                        <button type="button" class="btn btn-primary pull-right"><i class="fa fa-search"> Detail</i></button></a>
                                    </td>
                                </tr>
                                <?php
                                $subtotal = $subtotal +$row->total;
                                $no++; } ?>
                            <tr >
                                <td colspan="2" align="right"><strong>Total Pemasukan Jasa Obat Racik : </strong></td>
                                <td align="right"><strong><?= number_format($subtotal,2,',','.'); ?></strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--Bahan Habis Pakai-->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title"> Bahan Habis Pakai</h3>&nbsp;&nbsp;
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Pemasukan</th>
                                <th>Jumlah (Rp)</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no=1;
                            $subtotal =0;
                            foreach ($total_bahan_habis_pakai->result() as $row) { ?>
                                <tr>
                                    <td> <?= $no; ?></td>
                                    <td> <?= ucwords($row->jenis_pendaftaran); ?></td>
                                    <td align="right"> <?=  number_format($row->total,2,',','.'); ?></td>
                                    <td>
                                        <a href="<?= base_url().'Keuangan/listPemasukan?item='.$row->jenis_item.'&jp_id='.$row->jenis_pendaftaran_id.'&jp_name='.urlencode($row->jenis_pendaftaran).'&jpem='.urlencode('Jasa Obat Racik'); ?> ">
                                            <button type="button" class="btn btn-primary pull-right"><i class="fa fa-search"> Detail</i></button></a>
                                    </td>
                                </tr>
                                <?php
                                $subtotal = $subtotal +$row->total;
                                $no++; } ?>
                            <tr >
                                <td colspan="2" align="right"><strong>Total Pemasukan Bahan Habis Pakai : </strong></td>
                                <td align="right"><strong><?= number_format($subtotal,2,',','.'); ?></strong></td>
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
