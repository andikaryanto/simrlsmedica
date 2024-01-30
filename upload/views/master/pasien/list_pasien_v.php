 <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 
 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pasien
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Master</a></li>
        <li class="active">Data  Pasien</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Master</h3>&nbsp;&nbsp;
              <a  href="<?php  echo base_url(); ?>pendaftaran/pendaftaran_baru"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></button></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                        <tr>
                            <th>No</th>
                            <th>NO RM</th>
                            <th>Nama Pasien</th>                           
                            <th>Tempat Lahir</th>                           
                            <th>Tanggal Lahir</th>                           
                            <th>Usia</th>                           
                            <th>Jenis kelamin</th>                           
                            <th>Alamat</th>                           
                            <th>telepon</th>                           
                            <th>Pekerjaan</th>                           
                        </tr>
                    </thead>
                 
                    <tbody>
                        <?php $no=1; foreach ($listPendaftaran->result() as $row) { ?>
                  
                        <tr> 
                            <td> <?php echo $no; ?></td>
                            <td> <?php echo $row->no_rm; ?></td>
                            <td> <?php echo ucwords($row->nama); ?></td>
                            <td> <?php echo ucwords($row->tempat_lahir); ?></td>
                            <td> <?php echo $row->tanggal_lahir; ?></td>
                            <td> <?php echo ucwords($row->usia); ?></td>
                            <td> <?php echo ucwords($row->jk); ?></td>
                            <td> <?php echo ucwords($row->alamat); ?></td>
                            <td> <?php echo ucwords($row->telepon); ?></td>
                            <td> <?php echo ucwords($row->pekerjaan); ?></td>

                            <!-- <td>                                    
                              
                              <a  href="<?php  echo base_url(); ?>pemeriksaan/periksa/<?php echo $row->id; ?>"> <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i>Periksa</button></a>


                           
                               

                            </td> -->
                           
                         
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