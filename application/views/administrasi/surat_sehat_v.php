  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 
 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
     <section class="content-header">
      <h1>
        Surat Sehat
      
      </h1>
       <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Surat Sehat </a></li>
        <li class="active"> Pasien</li>
      </ol>
    </section>

  

    <!-- Main content -->
    <section class="invoice col-md-6">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-user"></i> NO. RM <?php  echo $pemeriksaan->no_rm ?>
            <small class="pull-right"><strong>Tanggal: <?php  echo $pemeriksaan->waktu_pemeriksaan ?></strong></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
    <form enctype="multipart-data" method="POST" action="<?php echo base_url()?>Administrasi/bayar"> 
      <div class="row invoice-info">
        <div class="col-sm-12 invoice-col">
            <p>Dengan ini saya menerangkan bahwa</p>
          <table class="table">
            <tr>
              <td>Nama Pasien</td> <td>: </td><td><strong><?php  echo $pemeriksaan->nama_pasien ?></strong></td>
          </tr>
          <address>
          <tr><td>Alamat</td> <td>:</td> <td><?php  echo $pemeriksaan->alamat ?></td>  </tr>            
          <tr><td>Usia</td> <td>:</td> <td><?php  echo $pemeriksaan->usia ?></td>      </tr>            
          <tr><td>Telepon</td> <td>:</td> <td><?php  echo $pemeriksaan->telepon ?></td></tr>            
          <tr><td>Pekerjaan</td> <td>:</td> <td><?php  echo $pemeriksaan->pekerjaan ?></td></tr>            
                      
                  
                            
          </address>
        </table>
        </div>
      </div>
        <!-- /.col -->
       
        <!-- /.col -->
      
      <!-- /.row -->

      <!-- Table row -->
      <div class="row invoice-info">
        <div class="col-sm-12 invoice-col">
          <p>Pada pemeriksaan saya hari ini menyatakan dalam keadaan</p>
          <p><h2 style="text-align: center;">SEHAT</h2></p>
          <p>Untuk keperluan : .......................................
         
         <table class="table">
          
          <tr><td>Berat Badan</td> <td>:</td> <td><?php  echo $pemeriksaan->bb ?> Kg</td>  </tr>            
          <tr><td>Tinggi Badan</td> <td>:</td> <td><?php  echo $pemeriksaan->tb ?>cm</td>      </tr>            
          <tr><td>Tekanan Darah</td> <td>:</td> <td><?php  echo $pemeriksaan->td ?>mmHg</td></tr>            
          <tr><td>Gula Darah</td> <td>:</td> <td><?php  echo $pemeriksaan->tg ?></td></tr>            
                      
                  
                            
          
        </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="<?php echo base_url() ?>Administrasi/surat_sehat_print/<?php echo $pemeriksaan->id ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
         
         <!--  <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button> -->
        </div>
      </div>
    </form>  
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
    <!-- /.content -->

</div>

<script>

   function set_kembalian(){
            var total = parseInt($('#total').val());
            var bayar = parseInt($('#bayar').val());           
            var kembalian = bayar-total;       
                 $('#kembalian').val(kembalian);
       
    }

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