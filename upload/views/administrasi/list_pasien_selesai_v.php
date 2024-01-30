 <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 
 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data List Pasien 
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">List Pasien</a></li>
        <li class="active">Data List Pasien</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Pasien Sudah Diperiksa</h3>&nbsp;&nbsp;
             
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
                            <th>NO RM</th>
                            <th>Nama Pasien</th>                           
                            <th>Nama Dokter</th>
                            <th>Asuhan Keperawatan</th>                                                  
                            <th>Diagnosa</th>                                                  
                            <th>Diagnosa jenis penyakit</th>                                                                           
                            <th>Status</th>
                            <th>Aksi</th>
                            
                        </tr>
                    </thead>
                 
                
                 
                    <tbody>
                        <?php $no=1; foreach ($listPemeriksaan->result() as $row) { ?>
                  
                        <tr> 
                            <td> <?php echo $no; ?></td>
                            <td> <?php echo $row->no_rm; ?></td>
                            <td> <?php echo ucwords($row->nama_pasien); ?></td>                          
                            <td> <?php echo ucwords($row->nama_dokter); ?></td>                           
                            <td> <?php echo ucwords($row->asuhan_keperawatan); ?></td>                           
                            <td> <?php echo ucwords($row->diagnosis); ?></td>                           
                            <td> <?php echo ucwords($row->diagnosis_jenis_penyakit); ?></td>                             
                            <td><span class="fa fa-check" > Selesai</span></td>
                             <td> <a  href="<?php  echo base_url(); ?>Administrasi/pemberianObat/<?php echo $row->id; ?>"> <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i> Obat & Bayar</button></a></td>
                            
                           
                           
                         
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