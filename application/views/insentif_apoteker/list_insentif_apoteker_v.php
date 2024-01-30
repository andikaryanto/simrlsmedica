  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data List insentif Apoteker
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">List insentif Apoteker</a></li>
        <li class="active">Data List insentif Apoteker</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data List Insentif Apoteker</h3>&nbsp;&nbsp;

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
                            <th>Nama Apoteker</th>
                            <th>Jml Resep</th>
                            <th>Insentif</th>
                            <th>Total Insentif</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>



                    <tbody>
                        <?php $no=1; foreach ($listInsentif as $row) { ?>

                        <tr>
                            <td> <?php echo $no; ?></td>
                            <td> <?php echo $row->nama; ?></td>
                            <td><?=$row->jml_resep?></td>
                            <td><?=number_format($insentif_resep, 2, ',','.')?></td>
                            <td> <?php echo number_format(($row->jml_resep * $insentif_resep),2,',','.'); ?></td>
                            <td>

                            <a  href="<?php  echo base_url(); ?>Insentif/DetailInsentifApoteker/<?php echo $row->the_apotek; ?>"> <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i>Detail</button></a>





                            </td>


                        </tr>

                       <?php $no++; } ?>


                    </tbody>

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->



          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data List Insentif Shift Apoteker</h3>&nbsp;&nbsp;

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
                    <h4><i class="icon fa fa-success"></i> Success!</h4>
                    <?php echo $success ?>
                </div>
            <?php } ?>
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Apoteker</th>

                            <th>Jumlah Hari</th>
                            <th>Insentif Shift /Hari</th>
                            <th>Total Insentif Shift</th>
                           <!--  <th>Aksi</th> -->
                        </tr>
                    </thead>



                    <tbody>
                        <?php $no=1; foreach ($listshift->result() as $row) { ?>

                        <tr>
                            <td> <?php echo $no; ?></td>
                            <td> <?php echo ucwords($row->nama); ?></td>
                            <td> <?php echo ucwords($row->hari); ?></td>
                            <td>Rp <?php echo number_format($row->shift,2,',','.'); ?></td>
                            <td>Rp <?php echo number_format($row->jumlah,2,',','.'); ?></td>
                            <td>

                          <!--   <a  href="<?php  echo base_url(); ?>Insentif/DetailInsentifDokter/<?php echo $row->dokter_id; ?>"> <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i>Detail</button></a> -->





                            </td>


                        </tr>

                       <?php $no++; } ?>


                    </tbody>

              </table>
            </div>
            <!-- /.box-body -->
          </div>




        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

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
