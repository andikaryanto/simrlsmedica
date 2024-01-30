 <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 
 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Tarif Tindakan
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Master</a></li>
        <li class="active">Data tarif Tindakan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Master</h3>&nbsp;&nbsp;
              <a  href="<?php  echo base_url(); ?>masterlaborat/tambah_TarifTindakan"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></button></a>
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
                                                                       
                            <th>Nama Tindakan</th>                                                      
                            <th>JM Perawat</th>                                                      
                            <th>JM Dokter</th>                           
                            <th>Jasa Lain2</th>                           
                            <th>Klinik</th>                           
                            <th>Total Tarif</th>                                           
                            <th>Aksi</th>                           
                        </tr>
                    </thead>
                 
                    <tbody>
                        <?php $no=1; foreach ($tarif_tindakan->result() as $row) { ?>
                  
                        <tr> 
                            <td> <?php echo $no; ?></td>                                               
                            <td> <?php echo ucwords($row->nama); ?></td> 
                            <td>Rp <?php echo number_format($row->tarif_perawat,2,',','.'); ?></td>                          
                            <td>Rp <?php echo number_format($row->tarif_dokter,2,',','.'); ?></td>                          
                            <td>Rp <?php echo number_format($row->tarif_lain,2,',','.'); ?></td>                          
                            <td>Rp <?php echo number_format($row->klinik,2,',','.'); ?></td>                          
                            <td>Rp <?php echo number_format($row->tarif_pasien,2,',','.'); ?></td>                          
                                   
                            
                     
                          
                            

                            <td>                                    
                              
                              
                                <a  href="<?php  echo base_url(); ?>masterlaborat/edit_tindakan/<?php echo $row->id; ?>"> <button type="button" class="btn btn-warning"><i class="fa fa-pencil"> edit</i></button></a>
                              <a onclick="return confirm('Apakah Anda ingin menghapus data ini?');" href="<?php  echo base_url(); ?>masterlaborat/delete_TarifTindakan/<?php echo $row->id; ?>"> <button type="button" class="btn btn-danger"><i class="fa fa-trash"> delete</i></button></a>


                           
                               

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