<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Pengeluaran
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Master</a></li>
            <li class="active">Data Pengeluaran</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Insentif Dokter</h3>&nbsp;&nbsp;
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
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Dokter</th>
                                    <!-- <th>Jumlah Hari</th>     
                                    <th>Insentif Shift /Hari</th>                     -->
                                    <th>Total Insentif Shift</th>                            
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; $grandtotal_tindakan = 0; foreach ($dokter->result() as $row) { ?>
                                <tr> 
                                    <td> <?php echo $no; ?></td>
                                    <td> <?php echo ucwords($row->nama); ?></td>                             
                                    <!-- <td> <?php echo ucwords($row->hari); ?></td>                             
                                    <td>Rp <?php echo number_format($row->shift,2,',','.'); ?></td>                                 -->
                                    <td>Rp <?php echo number_format($row->total_insentif,2,',','.'); ?></td>                                
                                    <td>
                                        <a href="<?php  echo base_url(); ?>Insentif/DetailInsentifDokter/<?php echo $row->dokter_id; ?>"> <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i>Detail</button></a>
                                    </td>
                                </tr>   
                            <?php $grandtotal_tindakan += $row->total_insentif; 
                        
                                $no++;
                            } ?>
                                <tr >
                                    <td colspan="4" align="right"><strong>Total Insentif Dokter : </strong></td>
                                    <td><strong><?= number_format($grandtotal_tindakan,2,',','.'); ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title">Insentif Perawat</h3>&nbsp;&nbsp;
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
                                    <th>Nama Perawat</th>
                                    <!-- <th>Jumlah Hari</th>     
                                    <th>Insentif Shift /Hari</th>                     -->
                                    <th>Total Insentif Shift</th>                            
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; $grandtotal_tindakan = 0; foreach ($perawat->result() as $row) { ?>
                                <tr> 
                                    <td> <?php echo $no; ?></td>
                                    <td> <?php echo ucwords($row->nama); ?></td>                             
                                    <!-- <td> <?php echo ucwords($row->hari); ?></td>                             
                                    <td>Rp <?php echo number_format($row->shift,2,',','.'); ?></td>                                 -->
                                    <td>Rp <?php echo number_format($row->total_insentif,2,',','.'); ?></td>                                
                                    <td>
                                        <a href="<?php  echo base_url(); ?>Insentif/DetailInsentifDokter/<?php echo $row->perawat_id; ?>"> <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i>Detail</button></a>
                                    </td>
                                </tr>   
                            <?php $grandtotal_tindakan += $row->total_insentif; 
                                $no++;
                            } ?>
                                <tr >
                                    <td colspan="4" align="right"><strong>Total Insentif Perawat : </strong></td>
                                    <td><strong><?= number_format($grandtotal_tindakan,2,',','.'); ?></strong></td>
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
        val d = {
            'paging'      : false,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : false,
            'autoWidth'   : true
        };
        
        $('#example1').DataTable(d);
        $('#example2').DataTable(d);
        $('#example3').DataTable(d);
    })
</script>