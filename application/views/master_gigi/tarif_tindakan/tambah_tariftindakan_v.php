  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">
<!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/select2/dist/css/select2.min.css">

 <div class="content-wrapper">


   
   <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Tarif Tindakan
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>Dashbord"><i class="fa fa-dashboard"></i> Dashbord</a></li>      
        <li class="active">Tambah Tindakan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Tambah Tindakan</h3>
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
             <form class="form-horizontal" method="post" action="<?php echo base_url()?>mastergigi/tambah_TarifTindakan">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                        <label for="nama" class="col-sm-4 control-label" >Nama Tindakan</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="nama_tindakan" name="nama_tindakan" onkeyup="set_tarifpasien()" placeholder="Masukkan nama_tindakan" required>
                        </div>
                      </div>

                    <div class="form-group">
                        <label for="nama" class="col-sm-4 control-label" >JM Perawat</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="tarif_perawat" name="tarif_perawat" value="0" onkeyup="set_tarifpasien()" placeholder="Masukkan JM perawat" required>
                        </div>
                      </div><div class="form-group">
                        <label for="nama" class="col-sm-4 control-label" >JM Dokter</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="tarif_dokter" name="tarif_dokter"  value="0" onkeyup="set_tarifpasien()" placeholder="Masukkan jm dokter">
                        </div>
                      </div><div class="form-group">
                        <label for="nama" class="col-sm-4 control-label" >Jasa lain-lain</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="tarif_lain" name="tarif_lain"  value="0" onkeyup="set_tarifpasien()" placeholder="Masukkan Jasa lain-lain " required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="kategori" class="col-sm-4 control-label">Klinik</label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="klinik" name="klinik"  value="0" onkeyup="set_tarifpasien()" placeholder="Masukkan tarif untuk klinik" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tempat_lahir" class="col-sm-4 control-label">Total Tarif Pasien</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="tarif_pasien" name="tarif_pasien" placeholder="masukkan nama total tarif pasien" required>
                        </div>
                      </div>
                      
                     
                    </div>                              
                </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="submit" value="1" class="btn btn-primary btn-lg btn-flat pull-right">Simpan</button>
                  <a href="<?php echo base_url() ?>mastergigi/listtariftindakan"  class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
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
   function set_tarifpasien(){
            var tp = parseInt($('#tarif_perawat').val());
            var td = parseInt($('#tarif_dokter').val());
            var tl = parseInt($('#tarif_lain').val());
            var k = parseInt($('#klinik').val());
           
            var tarifpasien = tp+td+tl+k;
            
            
            
            
       
                 $('#tarif_pasien').val(tarifpasien);
       
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
