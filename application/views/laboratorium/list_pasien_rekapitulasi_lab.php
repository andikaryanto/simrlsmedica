<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data List Pasien
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Laboratorium</a></li>
            <li class="active">Data Rekapitulasi Laboratorium</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Rekapitulasi Laboratorium</h3>&nbsp;&nbsp;

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
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Periksa</th>
                                <th>NO RM</th>
                                <th>Nama Pasien</th>
                                <th>Nama Petugas</th>
                                <th>Jenis Layanan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no=1; foreach ($listPemeriksaan as $row) { ?>
                                <tr>
                                    <td> <?php echo $no; ?></td>
                                    <td> <?php echo date('d-F-Y H:i', strtotime($row->waktu_pemeriksaan)); ?></td>
                                    <td style="width: 100px;">
                                        <?php echo $row->no_rm; ?><br>
                                        <small>
                                            <span class="label <?=$jaminan[$row->jaminan]['class']?>"><?=$jaminan[$row->jaminan]['label']?></span>
                                            <?php if (!isset($jaminan[$row->jaminan])) { ?>
                                                <span class="label label-warning">Umum</span>
                                            <?php } ?>
                                        </small>
                                    </td>
                                    <td> <?php echo ucwords($row->nama_pasien); ?></td>
                                    <td> <?php echo ucwords($row->nama_dokter); ?></td>
                                    <td>
                                        <table style="padding: 0px 5px;">
                                            <tbody>
                                            <?php foreach ($row->layanan as $l) { ?>
                                                <tr>
                                                    <td><?=$l->nama_layanan?></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td> <span class="pull-right-container text-uppercase"><small class="label pull-right bg-green"><?php echo ucwords(str_replace('_', ' ', $row->status)); ?></small></span></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>laboratorium/detail/<?php echo $row->id; ?>" class="btn btn-sm btn-block btn-success" style="margin-bottom: 5px;" ><i class="fa fa-arrows"></i> Detail</a>
                                        <a href="<?php echo base_url(); ?>laboratorium/cetak/<?php echo $row->id; ?>"
                                           class="btn btn-sm btn-block btn-primary"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           style="margin-bottom: 5px;" >
                                            <i class="fa fa-print"></i> Cetak
                                        </a>
                                        <!--                                        <a href="--><?php //echo base_url(); ?><!--laboratorium/unduh/--><?php //echo $row->id; ?><!--" class="btn btn-sm btn-block btn-warning" style="margin-bottom: 5px;" ><i class="fa fa-download"></i> Unduh</a>-->
                                    </td>
                                </tr>
                                <?php $no++; } ?>
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
