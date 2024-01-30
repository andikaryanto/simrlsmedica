  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 
 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data User User
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">User</a></li>
        <li class="active">Data User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data User</h3>&nbsp;&nbsp;
              <a  href="<?php  echo base_url(); ?>User/adduser"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></button></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Usename</th>
                            <th>Email</th>
                            <th>Nama Grup</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                            
                            
                           
                        </tr>
                    </thead>
                 
                
                 
                    <tbody>
                        <?php $no=1; foreach ($user->result() as $row) { ?>
                  
                        <tr> 
                            <td> <?php echo $no; ?></td>
                            <td> <?php echo ucwords($row->nama); ?></td>
                            <td> <?php echo ucwords($row->username); ?></td>                           
                            <td> <?php echo $row->email; ?></td>
                            <td> <?php echo ucwords($row->nama_grup); ?></td>                            
                            <td> <img width="60px" src="<?php echo base_url(); ?>assets/img/profil/<?php echo $row->foto; ?>" class="avatar img-square img-thumbnail" alt="avatar"></td>                            
                            <td>                                    
                              
                              <a  href="<?php  echo base_url(); ?>user/detailuser/<?php echo $row->id; ?>"> <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i>Detail</button></a>


                           
                               

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