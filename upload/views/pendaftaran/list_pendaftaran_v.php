 <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 
 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pendaftaran Pasien
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Pendaftaran</a></li>
        <li class="active">Data Pendaftaran Pasien</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Pendaftaran</h3>&nbsp;&nbsp;
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
                            <th>Tanggal Daftar</th>
                            <th>Jenis Pendaftaran</th>
                            <th>Nama Dokter</th>
                            <th>Asuhan Keperawatan</th>                                                  
                            <th>Status</th>
                           
                        </tr>
                    </thead>
                 
                
                 
                    <tbody>
                        <?php $no=1; foreach ($listPendaftaran->result() as $row) { ?>
                  
                        <tr> 
                            <td> <?php echo $no; ?></td>
                            <td> <?php echo $row->no_rm; ?></td>
                            <td> <?php echo ucwords($row->nama_pasien); ?></td>
                            <td> <?php echo $row->waktu_pendaftaran; ?></td>
                            <td> <?php echo ucwords($row->jenis_pendaftaran); ?></td>
                            <td> <?php echo ucwords($row->nama_dokter); ?></td>                           
                            <td> <?php echo ucwords($row->asuhan_keperawatan); ?></td>
                            <td> <?php echo ucwords($row->status); ?></td>
                            
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