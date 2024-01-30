<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?=$title?>
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Master</a></li>
            <li class="active"><?=$title?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Master Tarif Dan Layanan <?=$parent->nama?></h3>&nbsp;&nbsp;
                        <a  href="<?=base_url()?>Laboratorium/tambahTarifDanLayanan/<?=$parent->id?>"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></button></a>
                    </div>

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
                                <th>Nama Layanan</th>
                                <th>Nilai Rujukan</th>
                                <th>Satuan</th>
                                <th>JM Owner</th>
                                <th>JM Klinik</th>
                                <th>JM Karyawan</th>
                                <th>Sarpras</th>
                                <th>JM Dokter / Operator</th>
                                <th>JM Perawat / Asisten</th>
                                <th>JM Analis</th>
                                <th>JM Apoteker</th>
                                <th>Total Tarif</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no=1; foreach ($jenis_layanan_lab->result() as $row) { ?>
                                <tr>
                                    <td> <?php echo $no; ?></td>
                                    <td> <?php echo ucwords($row->nama); ?></td>
                                    <td> <?php echo $row->nilai_rujukan; ?></td>
                                    <td> <?php echo $row->satuan; ?></td>
                                    <td class="text-right">Rp <?php echo number_format($row->tarif_owner,2,',','.'); ?></td>
                                    <td class="text-right">Rp <?php echo number_format($row->klinik,2,',','.'); ?></td>
                                    <td class="text-right">Rp <?php echo number_format($row->tarif_karyawan,2,',','.'); ?></td>
                                    <td class="text-right">Rp <?php echo number_format($row->tarif_lain,2,',','.'); ?></td>
                                    <td class="text-right">Rp <?php echo number_format($row->tarif_dokter,2,',','.'); ?></td>
                                    <td class="text-right">Rp <?php echo number_format($row->tarif_perawat,2,',','.'); ?></td>
                                    <td class="text-right">Rp <?php echo number_format($row->tarif_analis,2,',','.'); ?></td>
                                    <td class="text-right">Rp <?php echo number_format($row->tarif_apoteker,2,',','.'); ?></td>
                                    <td>Rp <?php echo number_format($row->tarif_pasien,2,',','.'); ?></td>
                                    <td>
                                        <a href="<?php  echo base_url(); ?>Laboratorium/editTarifDanLayanan/<?php echo $row->id; ?>">
                                            <button type="button" class="btn btn-warning btn-block"><i class="fa fa-pencil"> edit</i></button>
                                        </a>
                                        <div style="height: 4px"></div>
                                        <a onclick="return confirm('Apakah Anda ingin menghapus data ini?');" href="<?php  echo base_url(); ?>Laboratorium/deleteTarifDanLayanan/<?php echo $row->id; ?>">
                                            <button type="button" class="btn btn-danger btn-block"><i class="fa fa-trash"> delete</i></button>
                                        </a>
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
            'paging'      : true,
            'lengthChange': false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
    })
</script>
