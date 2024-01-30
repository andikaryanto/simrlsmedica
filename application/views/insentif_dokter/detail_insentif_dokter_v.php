<link rel="stylesheet"
      href="<?= base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

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
                    <div class="box-header">
                        <h3 class="box-title">Data List Insentif Dokter</h3>&nbsp;&nbsp;

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
                        <table id="printable_table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl Pemeriksaan</th>
                                <th>Nama Dokter</th>
                                <th>Pasien</th>
                                <th>Tipe Layanan</th>
                                <th>Jenis Layanan</th>
                                <th>Nama Tindakan</th>
                                <th>Insentif</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1;
                            foreach ($listInsentif->result() as $row) { ?>
                                <tr>
                                    <td> <?= $no; ?></td>
                                    <td> <?= $row->waktu_pemeriksaan; ?></td>
                                    <td> <?= ucwords($row->nama_dokter); ?></td>
                                    <td>
                                        <?= ucwords($row->nama_pasien); ?><br>
                                        <small style="font-style: italic"><?=$row->no_rm?></small>
                                    </td>
                                    <td><?= $row->tipe_layanan == '1' ? 'Home Visit' : 'On Site' ?></td>
                                    <td><?= $row->jenis_ruangan; ?></td>
                                    <td> <?= ucwords($row->nama_tindakan); ?></td>
                                    <td>Rp <?= number_format($row->tarif_dokter, 2, ',', '.'); ?></td>
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
        // $('#example1').DataTable()
        // $('#example2').DataTable({
        //   rowReorder: {
        //         selector: 'td:nth-child(2)'
        //   },
        //   'paging'      : true,
        //   'lengthChange': true,
        //   'searching'   : true,
        //   'ordering'    : true,
        //   'info'        : true,
        //   'autoWidth'   : true
        // })
    })
</script>