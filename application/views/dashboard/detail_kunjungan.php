<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Detail Kunjungan
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#"><?=$title?></a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><?=$title?></h3>&nbsp;&nbsp;

                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Waktu Kunjungan</th>
                                <th>Nama Pasien</th>
                                <th>No RM</th>
                                <?=$id_poli == 20 ? '<th>Nama Dokter</th>' : ''?>
                                <th>Tipe Layanan</th>
                                <th>Diagnosis Jenis Penyakit</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            if ($ListPendaftaran) {
                                foreach ($ListPendaftaran as $row) { ?>
                                    <tr>
                                        <td> <?php echo $no; ?></td>
                                        <td> <?php echo DateIndo($row->waktu_pendaftaran); ?></td>
                                        <td> <?php echo ucwords($row->nama_pasien); ?></td>
                                        <td> <?php echo ucwords($row->no_rm); ?></td>
                                        <?=$id_poli == 20 ? '<td>'. ucwords($klinik->dpjp) . '</td>' : ''?>
                                        <td> <?php echo ucwords($row->tipe_layanan == 1 ? 'Home Visit' : 'On Site'); ?></td>
                                        <td>
                                            <table style="font-size: 14px; padding: 0px 5px;">
                                                <tbody>
                                                <?php
                                                if ($row->penyakit) {
                                                    foreach ($row->penyakit as $row1) { ?>
                                                        <tr>
                                                            <td style="padding: 0px 5px;"> <?php echo $row1->nama; ?></td>
                                                            <td style="padding: 0px 5px;"> <?php echo $row1->kode; ?></td>
                                                        </tr>
                                                    <?php }
                                                } ?>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php $no++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td bgcolor="lightblue" colspan="3"> Data Tidak ada</td>
                                </tr>
                            <?php } ?>
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
        $('#example1').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        });
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })


</script>
<script src="<?php echo base_url() ?>assets/bower_components/Flot/jquery.flot.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/Flot/jquery.flot.categories.js"></script>
