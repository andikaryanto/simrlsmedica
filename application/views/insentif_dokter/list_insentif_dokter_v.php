<link rel="stylesheet"
      href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data List insentif Dokter
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">List insentif Dokter</a></li>
            <li class="active">Data List insentif Dokter</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-body">
                        <h5><i class='fa fa-file-text-o fa-fw'></i> Insentif Dokter</h5>
                        <hr/>

                        <form class="form-horizontal" method="get" action="<?php echo base_url() ?>Insentif/listInsentifDokter">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Dari Tanggal</label>
                                            <div class="col-sm-8">
                                                <input type='date' name='from' class='form-control' id='tanggal_dari'
                                                       value="<?php echo ($this->input->get('from')) ? $this->input->get('from') : date('Y-m-01') ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Sampai Tanggal</label>
                                            <div class="col-sm-8">
                                                <input type='date' name='to' class='form-control' id='tanggal_sampai'
                                                       value="<?php echo ($this->input->get('to')) ? $this->input->get('to') : date('Y-m-d') ?>">
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
                                                <button type="submit" class="btn btn-primary" style='margin-left: 0px;'>
                                                    Tampilkan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data List Insentif Dokter</h3>&nbsp;&nbsp;

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
                            <h4><i class="icon fa fa-success"></i> Success!</h4>
                            <?php echo $success ?>
                        </div>
                    <?php } ?>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Dokter</th>
                                <th>Total Insentif</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1;
                            foreach ($listInsentif->result() as $row) { ?>
                                <tr>
                                    <td> <?php echo $no; ?></td>
                                    <td> <?php echo ucwords($row->nama); ?></td>
                                    <td>Rp <?php echo number_format($row->total_insentif, 2, ',', '.'); ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>Insentif/DetailInsentifDokter/<?php echo $row->dokter_id; ?>?jenis_pendaftaran=<?php echo $jenis; ?>&from=<?php echo $from; ?>&to=<?php echo $to; ?>">
                                            <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i>Detail
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                <?php $no++;
                            } ?>
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
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true
        })
    })
</script>