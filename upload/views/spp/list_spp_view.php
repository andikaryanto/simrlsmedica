 <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 
 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data SPP
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">SPP</a></li>
        <li class="active">Data SPP</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data SPP</h3>&nbsp;&nbsp;
              <a  href="<?php  echo base_url(); ?>spp/tambahspp_baru"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></button></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                        <tr>
                            <th>No</th>
                            <th>Badan Hukum</th>
                            <th>Nama Usaha</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>No Client</th>
                            <th>No Aplikasi</th>
                            <th>No Referensi</th>
                            <th>Jatuh Tempo</th>
                            <th>Tagihan BHP</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                 
                
                 
                    <tbody>
                        <?php $no=1; foreach ($spp->result() as $row) { ?>
                  
                        <tr> 
                            <td> <?php echo $no; ?></td>
                            <td> <?php echo $row->badan_hukum; ?></td>
                            <td> <?php echo $row->nama_usaha; ?></td>
                            <td> <?php echo $row->alamat; ?></td>
                            <td> <?php echo $row->tlp; ?></td>
                            <td> <?php echo $row->no_client; ?></td>
                            <td> <?php echo $row->no_aplikasi; ?></td>
                            <td> <?php echo $row->no_referensi; ?></td>
                            <td> <?php echo $row->jatuh_tempo; ?></td>
                            <td> <?php echo 'Rp ' . number_format( $row->tagihan_bhp, 0 , '' , '.' ) . ',-'; ?></td>
                            <td> <?php echo $row->status; ?></td>
                            <td>                                    
                              <a  href="<?php  echo base_url(); ?>Spp/deleteSpp/<?php echo $row->id; ?>"> <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                              <a  href="<?php  echo base_url(); ?>Spp/editSpp/<?php echo $row->id; ?>"> <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>


                           
                               

                            </td>
                           
                         
                        </tr>   

                       <?php $no++; } ?>
                                     

                    </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

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
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>