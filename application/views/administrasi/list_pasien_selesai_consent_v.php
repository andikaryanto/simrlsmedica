<link rel="stylesheet"
      href="<?= base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pasien Surat Informed Consent
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">List Pasien Surat Informed Consent</a></li>
            <li class="active"> Pasien</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Pasien Surat Informed Consent</h3>&nbsp;&nbsp;
                    </div>
                    <!-- /.box-header -->
                    <?php $warning = $this->session->flashdata('warning');
                    if (!empty($warning)) { ?>
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                            <?= $warning ?>
                        </div>
                    <?php } ?>
                    <?php $success = $this->session->flashdata('success');
                    if (!empty($success)) { ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-success"></i> Success!</h4>
                            <?= $success ?>
                        </div>
                    <?php } ?>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Waktu Periksa</th>
                                <th>NO RM</th>
                                <th>Nama Pasien</th>
                                <th>Jenis Layanan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1;
                            foreach ($listPemeriksaan->result() as $row) { ?>
                                <tr>
                                    <td> <?= $no; ?></td>
                                    <td> <?= date('d-F-Y H:i', strtotime($row->waktu_pemeriksaan)); ?></td>
                                    <td> <?= $row->no_rm; ?></td>
                                    <td> <?= ucwords($row->nama_pasien); ?></td>
                                    <td> <?= ucwords($row->poli); ?></td>
                                    <td><span class="pull-right-container"><small class="label pull-right bg-green"><?= ucwords($row->status); ?></small></span></td>
                                    <td>
                                        <a href="<?= base_url(); ?>Administrasi/surat_consent/<?= $row->id; ?>">
                                            <button type="button" class="btn btn-primary"><i class="fa fa-print"></i>
                                                Cetak Surat
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