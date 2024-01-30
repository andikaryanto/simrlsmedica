  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">
<!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/select2/dist/css/select2.min.css">

 <div class="content-wrapper">


   
   <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pemeriksaan Pasien
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>Dashbord"><i class="fa fa-dashboard"></i> Dashbord</a></li>      
        <li class="active">Pemeriksaan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-7">

          <div class="box box-danger">
            <div class="box-header">
              
              <h3 class="box-title"> No. Rekam Medis : <?php echo $pendaftaran['no_rm']; ?> </h3>
            </div>
            <div class="box-body">                 
              <!-- Date dd/mm/yyyy -->
             <form class="form-horizontal" method="post" action="<?php echo base_url()?>pemeriksaan/periksa/<?php echo $pendaftaran['pasien'] ?>">
              <div class="box-body">
                <div class="row" >
                    <div class="col-md-12">
                      <div class="col-sm-4 col-md-4 col-lg-4  form-group">
                  <label for="td" class="col-sm-3 control-label">TD</label>
                  <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                    <input type="text" class="form-control" name="td">
                    <span class="input-group-addon">mmHg</span>
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4  form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">R</label>
                  <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                    <input type="text" class="form-control" name="r">
                    <span class="input-group-addon">K/Min</span>
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4  form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">BB</label>
                  <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                    <input type="text" class="form-control" id="bb" name="bb" onkeyup="set_bmi()">
                    <span class="input-group-addon">Kg</span>
                  </div>
                </div>
               <div class="col-sm-4 col-md-4 col-lg-4  form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">N</label>
                  <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                    <input type="text" class="form-control" name="n">
                    <span class="input-group-addon">K/Min</span>
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4  form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">S</label>
                  <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                    <input type="text" class="form-control" id="s" name="s">
                    <span class="input-group-addon">'0</span>
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4  form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">TB</label>
                  <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                    <input type="text" class="form-control" id="tb" name="tb" onkeyup="set_bmi()">
                    <span class="input-group-addon">cm</span>
                  </div>
                </div>
               
                    </div>
                </div>
                
                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">BMI </label>
                  <div class="col-sm-4 col-md-4 col-sm-4 col-lg-4" >
                    <input type="text" class="form-control" name="bmi" id="bmi">
                    
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputtext3" class="col-sm-3 control-label">No Rekam Medis </label>

                  <div class="col-sm-4">
                      <input type="hidden" class="form-control" name="pendaftaran_id" id="pendaftran_id" value="<?php echo $pendaftaran['id']; ?>">

                      <input type="hidden" class="form-control" name="dokter_id" id="dokter_id" value="<?php echo $pendaftaran['dokter']; ?>" >
                    <input type="text" readonly class="form-control" id="inputtext3" name="no_rm" value="<?php echo $pendaftaran['no_rm']; ?>" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputtext3" class="col-sm-3 control-label">Nama Pasien </label>

                  <div class="col-sm-4">
                    <input type="text" readonly class="form-control" id="inputtext3" name="nama_pasien" value="<?php echo $pendaftaran['nama_pasien']; ?>" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputtext3" class="col-sm-3 control-label">Keluhan Utama </label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="inputtext3" name="keluhan_utama">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputtext3" class="col-sm-3 control-label">Amammesia</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputtext3" name="amammesia">
                  </div>
                </div>
               
                <div class="form-group">
                  <label for="inputtext3" class="col-sm-3 control-label">Pemeriksaan Fisik</label>

                  <div class="col-sm-9">
                    <textarea type="text" class="form-control" id="inputtext3" name="pemeriksaan_fisik" ></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputtext3" class="col-sm-3 control-label">Hasil Penunjang</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputtext3" name="hasil_penunjang" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputtext3" class="col-sm-3 control-label">Diagnosis</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputtext3" name="diagnosis" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputtext3" class="col-sm-3 control-label">Asuan Keperawatan</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="asuhan_keperawatan" name="asuhan_keperawatan"  value="<?php echo $pendaftaran['asuhan_keperawatan']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputtext3" class="col-sm-3 control-label">Diagnosis Jenis Penyakit</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputtext3" name="diagnosis_jenis_penyakit">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputtext3" class="col-sm-3 control-label">Diagnosis Banding</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputtext3" name="diagnosis_banding" >
                  </div>
                </div>
                <!-- <div class="form-group">
                  
                  <label for="inputtext3" class="col-sm-3 control-label">Tarif / Tindakan</label>
                  <div class="col-sm-4">
                    <select class="form-control" >
                     <option value="">--Pilih Tindakan--</option>
                      <?php foreach ($tindakan->result() as $key => $value) {
                         ?>
                        <option value="<?php echo $value->id; ?>"><?php echo $value->nama." - Rp.".number_format($value->tarif,2,',','.'); ?></option>
                      <?php } ?> 
                    </select>
                  </div>
                </div> -->

                <div class="form-group">
                  <label for="inputtext3" class="col-sm-3 control-label">Tarif / Tindakan</label>
                    <div class="checkbox col-sm-9">
                      <?php 

                      foreach ($tindakan->result() as $key => $value) {
                         ?>                 
                    
                        <label>
                          <input  type="checkbox" name="tindakan[]" value="<?php echo $value->id; ?>">
                        <?php echo $value->nama." - Rp.".number_format($value->tarif_pasien,2,',','.'); ?>
                        </label>
                    
                  
                      <?php } ?>
                    </div>
                </div>
                
                <div class="form-group">
                  <label for="inputtext3" class="col-sm-3 control-label">Deskripsi Tindakan</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputtext3" name="deskripsi_tindakan" >
                  </div>
                </div>
                 <div class="form-group">
                  <label for="inputtext3" class="col-sm-3 control-label">Saran Pemeriksaan</label>       

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputtext3" name="saran_pemeriksaan">
                  </div>
                </div>
               
              </div>
              <!-- /.box-body -->
              
              <!-- /.box-footer -->
            


            </div>
            <!-- /.box-body -->
          </div>

          <!-- /.box -->
        </div>
        <div class="col-md-5">
            <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title">Obat</h3>
                  </div>
                  <div class="box-body">
                    <div class="nav-tabs-custom">
                      <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Obat Satuan</a></li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Obat Racik</a></li>
                                 
                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                          <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label for="obat">Obat 1</label>
                                  <select class="form-control" name="nama_obat[]" >
                                    <option value="">--Pilih Obat--</option>
                                    <?php foreach ($obat->result() as $key => $value) {
                                       ?>
                                      <option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
                                    <?php } ?> 
                                  </select>
                                  <input type="number" class="form-control" name="jumlah_satuan[]" placeholder="Jumlah Satuan">
                                  <!-- <input type="text" class="form-control" name="jenis_obat[]" placeholder="Jenis"> -->
                                </div>
                                <div class="form-group">
                                  <label for="obat">Obat 2</label>
                                 <select class="form-control" name="nama_obat[]" >
                                    <option value="">--Pilih Obat--</option>
                                    <?php foreach ($obat->result() as $key => $value) {
                                       ?>
                                      <option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
                                    <?php } ?> 
                                  </select>
                                  <input type="number" class="form-control" name="jumlah_satuan[]" placeholder="Jumlah Satuan">
                                  <!-- <input type="text" class="form-control" name="jenis_obat[]" placeholder="Jenis"> -->
                                </div>
                                <div class="form-group">
                                  <label for="obat">Obat 3</label>
                                 <select class="form-control" name="nama_obat[]" >
                                    <option value="">--Pilih Obat--</option>
                                    <?php foreach ($obat->result() as $key => $value) {
                                       ?>
                                      <option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
                                    <?php } ?> 
                                  </select>
                                  <input type="number" class="form-control" name="jumlah_satuan[]" placeholder="Jumlah Satuan">
                                  <!-- <input type="text" class="form-control" name="jenis_obat[]" placeholder="Jenis"> -->
                                </div>
                                <div class="form-group">
                                  <label for="obat">Obat 4</label>
                                 <select class="form-control" name="nama_obat[]" >
                                    <option value="">--Pilih Obat--</option>
                                    <?php foreach ($obat->result() as $key => $value) {
                                       ?>
                                      <option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
                                    <?php } ?> 
                                  </select>
                                  <input type="number" class="form-control" name="jumlah_satuan[]" placeholder="Jumlah Satuan">
                                  <!-- <input type="text" class="form-control" name="jenis_obat[]" placeholder="Jenis"> -->
                                </div>
                                <div class="form-group">
                                  <label for="obat">Obat 5</label>
                                 <select class="form-control" name="nama_obat[]" >
                                    <option value="">--Pilih Obat--</option>
                                    <?php foreach ($obat->result() as $key => $value) {
                                       ?>
                                      <option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
                                    <?php } ?> 
                                  </select>
                                  <input type="number" class="form-control" name="jumlah_satuan[]" placeholder="Jumlah Satuan">
                                  <!-- <input type="text" class="form-control" name="jenis_obat[]" placeholder="Jenis"> -->
                                </div>
                                   
                            </div>
                          </div>
                              
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
     
                        </div>
                        <!-- /.tab-pane -->
                       
                        <!-- /.tab-pane -->
                      </div>
                      <!-- /.tab-content -->
                    </div>
                  </div>
                  <div class="box-footer">
                     <button type="submit" name="submit" value="1" class="btn btn-primary btn-lg btn-flat pull-right">Daftar</button>
                     <button type="reset" class="btn btn-default btn-lg btn-flat pull-right">Batal</button>
                  </div>
                </div>   
        </div>

        </form>
       
        <!-- /.col (right) -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>


  <div id='ResponseInput'></div>




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
<script type="text/javascript">
   function set_bmi(){
            var tb = $('#tb').val();
            var bb = $('#bb').val();
            var tbm = tb/100;
            
            
            var bmi = bb/(tbm*tbm);
            
       
                 $('#bmi').val(bmi.toFixed(2));
       
    }

</script>