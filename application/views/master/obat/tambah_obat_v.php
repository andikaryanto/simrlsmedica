  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">
<!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/select2/dist/css/select2.min.css">

 <div class="content-wrapper">


   
   <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Obat
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>Dashbord"><i class="fa fa-dashboard"></i> Dashbord</a></li>      
        <li class="active">Tambah Obat</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Tambah Obat</h3>
            </div>
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

              <!-- Date dd/mm/yyyy -->
             <form class="form-horizontal" method="post" action="<?php echo base_url()?>Obat/tambah_obat">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="nama" class="col-sm-4 control-label" >No urut</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="no_urut" name="no_urut" placeholder="Masukkan no_urut" required>
                        </div>
                      </div><div class="form-group">
                        <label for="nama" class="col-sm-4 control-label" >Kode Obat</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="kode_obat" name="kode_obat" placeholder="Masukkan kode_obat pasien" required>
                        </div>
                      </div><div class="form-group">
                        <label for="nama" class="col-sm-4 control-label" >Nama Obat</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama obat" required>
                        </div>
                      </div><div class="form-group">
                        <label for="nama" class="col-sm-4 control-label" >Nomor Batch</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="nomor_batch" name="nomor_batch" placeholder="Masukkan nomor_batch" required>
                        </div>
                      </div><div class="form-group">
                        <label for="nama" class="col-sm-4 control-label" >Jenis</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="jenis" name="jenis" placeholder="Masukkan jenis obat" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="kategori" class="col-sm-4 control-label">Kategori</label>

                        <div class="col-sm-5">
                          <input type="text" class="form-control" id="kategori" name="kategori" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tempat_lahir" class="col-sm-4 control-label">Distributor</label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="distributor" name="distributor" placeholder="masukkan nama distributor" required>
                        </div>
                      </div>
                      
                     
                      <div class="form-group">
                        <label for="Kadaluwarsa" class="col-sm-4 control-label"> Tanggal Kadaluwarsa</label>

                        <div class="col-sm-8">
                          <input type="date" class="form-control" id="tanggal_kadaluwarsa" name="tanggal_kadaluwarsa" placeholder="Masukkan Kadaluwarsa obat" required>
                        </div>
                      </div>
                  </div>                      
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="pekerjaan" class="col-sm-4 control-label">Harga Beli</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="harga_beli" name="harga_beli" onkeyup="set_harga_jual()" placeholder="masukkan harga_beli" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="penanggungjawab" class="col-sm-4 control-label">Harga Jual</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="harga_jual" name="harga_jual" onkeyup="set_harga_beli()" placeholder="Masukkan Harga Jual " required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="stok_obat" class="col-sm-4 control-label">Stok Obat</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="stok_obat" name="stok_obat" placeholder="Masukkan stok_obat" required>
                        </div>
                      </div>                                
                    </div>                              
                </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="submit" value="1" class="btn btn-primary btn-lg btn-flat pull-right">Simpan</button>
                  <a href="<?php echo base_url() ?>Obat"  class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
              </div>
              <!-- /.box-footer -->
            </form>


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
       
        <!-- /.col (right) -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>


  <div id='ResponseInput'></div>
<script type="text/javascript">
  function set_harga_jual(){
            var hb = parseInt($('#harga_beli').val());
            var persen = <?php echo $persen->prosentase; ?>;
            
           
            var untung = hb*persen/100;
           
            var harga_jual = hb+untung;

       
                 $('#harga_jual').val(harga_jual);
       
    }
     function set_harga_beli(){
            var hj = parseInt($('#harga_jual').val());
            var persen = <?php echo $persen->prosentase; ?>;
            var persentotal = parseInt(100)+parseInt(persen);
            var persen_untung = persen/persentotal;
           
           
            var untung = hj*persen_untung;
           
            var harga_beli = hj-untung;

       
                 $('#harga_beli').val(harga_beli);
       
    }


</script>



  <!-- InputMask -->
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<script type="text/javascript">
  //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()
</script>
