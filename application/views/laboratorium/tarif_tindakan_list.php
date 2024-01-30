<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?=$title ?? ''?>
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Master</a></li>
            <li class="active"><?=$title ?? ''?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Master</h3>&nbsp;&nbsp;
                        <a  href="<?=base_url()?>Laboratorium/tambahTarifDanLayanan"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></button></a>
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
                                <th>Harga Paket</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no=1; foreach ($jenis_layanan_lab->result() as $row) { ?>
                                <tr>
                                    <td> <?php echo $no; ?></td>
                                    <td>
                                        <?php echo ucwords($row->nama); ?>
                                        <?php if ($row->is_paket) : ?>
                                            <span class="pull-right-container">
                                                <small class="label pull-right bg-primary text-uppercase">Paket</small>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $row->is_paket ? 'Rp '.number_format($row->tarif_pasien,2,',','.') : ''?></td>
                                    <td>
                                        <a href="<?=base_url()?>Laboratorium/tarifDanLayanan/<?=$row->id?>">
                                            <button type="button" class="btn btn-success"><i class="fa fa-eye"></i></button>
                                        </a>
                                        <a href="<?=base_url()?>Laboratorium/editTarifDanLayanan/<?=$row->id?>/1">
                                            <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                        </a>
                                        <a href="<?=base_url()?>Laboratorium/deleteTarifDanLayanan/<?=$row->id?>" onclick="return confirm('Apakah Anda ingin menghapus data ini?');">
                                            <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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
