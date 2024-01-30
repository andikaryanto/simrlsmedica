<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Stok Obat
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Master</a></li>
            <li class="active">Data Stok Obat</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="col-sm-8">
                            <h3 class="box-title">Data Master</h3>&nbsp;&nbsp;
                            <a  href="<?php  echo base_url(); ?>Apotek/tambahObat"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></button></a>
                        </div>
                        <div class="col-sm-2 pull-right">
                            <form class="form-horizontal" method="post" action="<?php echo base_url()?>export/apotek/stokObat">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Export Excel</button>
                            </form>
                        </div>
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
                        <table id="example2" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Nama </th>
                                <th>Distributor</th>
                                <th class="text-right">Harga Beli</th>
                                <th class="text-right">Harga Jual</th>
                                <th>Stok Obat</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($listObat->result() as $row) { ?>
                                <tr>
                                    <td>
                                      <?php echo ucwords($row->nama); ?><br>
                                      <small> <i>BATCH: <?php echo $row->nomor_batch; ?> | KAT: <?php echo ucwords($row->kategori); ?></i> </small>
                                    </td>
                                    <td> <?php echo $row->distributor; ?></td>
                                    <td class="text-right">Rp <?php echo number_format($row->harga_beli,2,',','.'); ?></td>
                                    <td class="text-right">
                                        <span>Rp <?php echo number_format($row->harga_jual,2,',','.'); ?></span>
                                    </td>
                                    <td> <?php echo $row->stok_obat; ?></td>
                                    <td class="text-right">
                                        <a href="<?php  echo base_url(); ?>Apotek/editObat/<?php echo $row->id; ?>" class="btn btn-sm btn-success"> <i class="fa fa-edit"></i></a>
                                        <a onclick="return confirm('Apakah Anda ingin menghapus data ini?');" href="<?php  echo base_url(); ?>Apotek/deleteObat/<?php echo $row->id; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
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
