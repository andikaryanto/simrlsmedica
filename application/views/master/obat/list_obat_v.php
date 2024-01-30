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
              <h3 class="box-title">Data Master</h3>&nbsp;&nbsp;
              <a  href="<?php  echo base_url(); ?>Obat/tambah_obat"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></button></a>
               <a  href="<?php  echo base_url(); ?>Obat/setting_persen"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-cog"></span></button></a>
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
                            <th>Kode Obat</th>                                                      
                            <th>Nama </th>                                                      
                            <th>Jenis</th>                                                      
                            <th>Kategori</th>                           
                            <th>Nomor Batch</th>                           
                            <th>Kadaluwarsa</th>                           
                            <th>Distributor</th>                           
                            <th>Harga Beli</th>                           
                            <th>Harga Jual</th>                           
                            <th>Stok Obat</th>                           
                            <th>Aksi</th>                           
                        </tr>
                    </thead>
                 
                    <tbody>
                        <?php $no=1; foreach ($listObat->result() as $row) { ?>
                  
                        <tr> 
                            <td> <?php echo $no; ?></td>
                            <td> <?php echo $row->kode_obat; ?></td>
                          
                            <td> <?php echo ucwords($row->nama); ?></td>                           
                            <td> <?php echo ucwords($row->jenis); ?></td>                           
                            <td> <?php echo ucwords($row->kategori); ?></td>                           
                            
                           
                            <td> <?php echo $row->nomor_batch; ?></td>
                            <td> <?php echo $row->tanggal_kadaluwarsa; ?></td>
                            <td> <?php echo $row->distributor; ?></td>
                            <td>Rp <?php echo number_format($row->harga_beli,2,',','.'); ?></td>
                            <td>Rp <?php echo number_format($row->harga_jual,2,',','.'); ?></td>
                            
                            <td> <?php echo $row->stok_obat; ?></td>
                            

                            <td>                                    
                              
                              
                                <a  href="<?php  echo base_url(); ?>Obat/edit/<?php echo $row->id; ?>"> <button type="button" class="btn btn-warning"><i class="fa fa-pencil"> edit</i></button></a>
                              <a onclick="return confirm('Apakah Anda ingin menghapus data ini?');" href="<?php  echo base_url(); ?>Obat/delete_obat/<?php echo $row->id; ?>"> <button type="button" class="btn btn-danger"><i class="fa fa-trash"> delete</i></button></a>


                           
                               

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