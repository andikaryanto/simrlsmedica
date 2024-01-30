 <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 
 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Dokter
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Master</a></li>
        <li class="active">Data  Dokter</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Master</h3>&nbsp;&nbsp;
              <a  href="<?php  echo base_url(); ?>User/adduser"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></button></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                        <tr>
                            <th>No</th>                           
                            <th>Nama</th>                                                      
                            <th>Email</th>                                                      
                            <th>Username</th>                           
                            <th>Password</th>                           
                            <th>Telepon</th>                           
                        </tr>
                    </thead>
                 
                    <tbody>
                        <?php $no=1; foreach ($listDokter->result() as $row) { ?>
                  
                        <tr> 
                            <td> <?php echo $no; ?></td>
                          
                            <td> <?php echo ucwords($row->nama); ?></td>                           
                            <td> <?php echo $row->email; ?></td>
                            <td> <?php echo ucwords($row->username); ?></td>
                            <td> <?php echo $row->password_ori; ?></td>
                            <td> <?php echo $row->telepon; ?></td>
                            

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