<link rel="stylesheet"
      href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data List Pasien
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">List Pasien</a></li>
            <li class="active">Data List Pasien</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php foreach ($jenis_pendaftaran as $jp) : ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Pasien Belum Diperiksa - <?= $jp->jenis_pendaftaran ?></h3>&nbsp;&nbsp;

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
                                    <th>No Antrian</th>
                                    <th>NO RM</th>
                                    <th>Nama Pasien</th>
                                    <th>Alamat</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Jenis Layanan</th>
                                    <th>Pemeriksaan Awal</th>
                                    <th>Pemeriksaan Lanjutan</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1;
                                foreach ($jp->list as $row) { ?>
                                    <?php if (round((time() - strtotime($row->waktu_pemeriksaan)) / (60 * 60 * 24)) > 7) continue; ?>
                                    <tr>
                                        <td>
                                            <?php if ($row->kode_antrian) : ?>
                                                <?php echo $row->kode_antrian; ?>
                                                <?php if ($row->is_mobile_jkn) : ?>
                                                    <br>
                                                    <small>
                                                        <span class="label label-danger">Mobile JKN</span>
                                                        <?php if ($row->is_check_in) : ?>
                                                            <span class="label label-success">Check In</span>
                                                        <?php endif; ?>
                                                    </small>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php echo $no; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td style="width: 100px;">
                                            <span class="norm"><?php echo $row->no_rm; ?></span>
                                            <br>
                                            <small>
                                                <span class="label <?= $jaminan[$row->jaminan]['class'] ?>"><?= $jaminan[$row->jaminan]['label'] ?></span>
                                                <?php if (!isset($jaminan[$row->jaminan])) { ?>
                                                    <span class="label label-warning">Umum</span>
                                                <?php } ?>
                                            </small>
                                        </td>
                                        <td class="nama"> <?php echo ucwords($row->nama_pasien); ?></td>
                                        <td> <?php echo ucwords($row->alamat); ?></td>
                                        <td> <?php echo date('d-F-Y H:i', strtotime($row->waktu_pemeriksaan)); ?></td>
                                        <td> <?php echo ucwords($row->jenis_pendaftaran); ?></td>
                                        <td> <span class="pull-right-container"><small class="label pull-right <?=$row->sudah_periksa_perawat ? 'bg-green' : 'bg-primary'?>"><?php echo $row->sudah_periksa_perawat ? 'Sudah Diperiksa' : 'Belum Diperiksa' ?></small></span></td>
                                        <td> <span class="pull-right-container"><small class="label pull-right <?=$row->sudah_periksa_dokter ? 'bg-green' : 'bg-primary'?>"><?php echo $row->sudah_periksa_dokter ? 'Sudah Diperiksa' : 'Belum Diperiksa' ?></small></span></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-bars"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <button onclick="panggil(<?=$row->antrian_id?>, '<?=$row->kode_antrian?>', '<?=$row->jenis_pendaftaran?>')"
                                                            class=" btn btn-sm btn-block btn-success"
                                                            style="margin-bottom: 5px;">
                                                        <i class="fa fa-volume-up"></i> Panggil
                                                    </button>

                                                    <a href="<?php echo base_url(); ?>pemeriksaan/periksa/<?php echo $row->id; ?>"
                                                       class="btn btn-sm btn-block btn-warning"
                                                       style="margin-bottom: 5px;">
                                                        <i class="fa fa-pencil"></i> Periksa
                                                    </a>

                                                    <button type="button" class="btn btn-sm btn-primary btn-block btn-rekamedis"
                                                            data-pasien_id="<?= $row->pasien_id ?>"
                                                            style="margin-bottom: 5px;">
                                                        <i class="fa fa-search"></i> Rekam Medis
                                                    </button>

                                                    <a href="<?php echo base_url(); ?>pemeriksaan/hapus/<?php echo $row->id; ?>/<?php echo $row->pendaftaran_id; ?>"
                                                       onclick="return confirm('Yakin hapus data pemeriksaan ini?')"
                                                       class="btn btn-sm btn-block btn-danger" style="margin-bottom: 5px;">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $no++;
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" id="tess"></div>
            </div>
        <?php endforeach; ?>
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
    });

</script>
