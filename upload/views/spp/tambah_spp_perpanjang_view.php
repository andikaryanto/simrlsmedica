  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">
<!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/select2/dist/css/select2.min.css">

 <div class="content-wrapper">


   
   <!-- Content Header (Page header) -->
      <section class="content-header">
      <h1>
        Pendaftaran Pasien Lama
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>Dashbord"><i class="fa fa-dashboard"></i> Dashbord</a></li>      
        <li class="active">Pendaftaran</li>
      </ol>
    </section>

    <!-- Main content -->
     <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Data Pasien</h3>
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
                    <h4><i class="icon fa fa-success"></i> Success!</h4>
                    <?php echo $success ?>
                </div>
            <?php } ?>   
            <div class="box-body"> 

              <!-- Date dd/mm/yyyy -->
             <form class="form-horizontal" method="post" action="<?php echo base_url()?>pendaftaran/pendaftaran_baru">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="nama" class="col-sm-4 control-label" >No RM</label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="no_rm" name="no_rm" placeholder="Masukkan no_rm pasien" onchange="return autofill();">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="nama" class="col-sm-4 control-label" >Nama</label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama pasien">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tanggal_lahir" class="col-sm-4 control-label">Tanggal Lahir</label>

                        <div class="col-sm-5">
                          <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tempat_lahir" class="col-sm-4 control-label">Tempat Lahir</label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="masukkan tempat lahir pasien">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="jenis_kelamin" class="col-sm-4 control-label">Jenis Kelamin</label>
                        <label class="radio-inline"><input type="radio" value="L" name="jenis_kelamin" id="jenis_kelamin" >Laki - laki</label>
                        <label class="radio-inline"><input type="radio" value="P" name="jenis_kelamin" id="jenis_kelamin" >Perempuan</label>                 
                      </div>
                      <div class="form-group">
                        <label for="alamat" class="col-sm-4 control-label">Alamat</label>

                        <div class="col-sm-8">
                          <textarea type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat pasien"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="telepon" class="col-sm-4 control-label">No. Telepon</label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Masukkan telepon pasien">
                        </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                  <label for="pekerjaan" class="col-sm-4 control-label">Pekerjaan</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="masukkan pekerjaan Pasien">
                  </div>
                </div>
                <div class="form-group">
                  <label for="penanggungjawab" class="col-sm-4 control-label">Penanggung Jawab</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="penanggungjawab" name="penanggungjawab" placeholder="Masukkan penanggung jawab dari pasien">
                  </div>
                </div>
                <div class="form-group">
                  <label for="asuhan" class="col-sm-4 control-label">Asuhan Keperawatan</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="asuhan" name="asuhan" placeholder="Masukkan asuhan Keperawatan">
                  </div>
                </div>
                <div class="form-group">
                  <label for="biopsikososial" class="col-sm-4 control-label">Bio Psiko Sosial</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="biopsikososial" name="biopsikososial" placeholder="Masukkan bio psiko sosial">
                  </div>
                </div>
                <div class="form-group">
                  <label for="jenis_pendaftaran" class="col-sm-4 control-label">Jenis Pendaftaran</label>

                  <div class="col-sm-8">
                    <select class="form-control" name="jenis_pendaftaran" >
                      <option value="">--Pilih Jenis Pendaftaran--</option>
                      <?php foreach ($jenis_pendaftaran->result() as $key => $value) {
                         ?>
                        <option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
                      <?php } ?> 
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputtext3" class="col-sm-4 control-label">Pilih Dokter</label>

                  <div class="col-sm-4">
                     <select class="form-control" name="dokter">
                      <option>-- Pilih Dokter --</option>
                      <?php foreach ($dokter->result() as $key => $value) {
                         ?>
                        <option value="<?php echo $value->id ?>"><?php echo $value->nama; ?></option>
                      <?php } ?> 
                      
                    </select>
                  </div>
                </div>
                  </div>                  
                </div>               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="submit" value="1" class="btn btn-primary btn-lg btn-flat pull-right">Daftar</button>
                <button type="reset" class="btn btn-default btn-lg btn-flat pull-right">Batal</button>
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
  <script src="<?php echo base_url() ?>assets/plugins/autocomplete/ajax.js"></script>
<script>
    function autofill(){
        var no_rm =document.getElementById('no_rm').value;
        $.ajax({
                       url:"<?php echo base_url();?>index.php/pendaftaran/cari",
                       data:'&no_rm='+no_rm,
                       success:function(data){
                           var hasil = JSON.parse(data);  
                           
          
      $.each(hasil, function(key,val){         
         document.getElementById('no_rm').value=val.no_rm;
         document.getElementById('nama').value=val.nama;
         document.getElementById('tanggal_lahir').value=val.tanggal_lahir;
         document.getElementById('tempat_lahir').value=val.tempat_lahir;
         document.getElementById('alamat').value=val.alamat;
         document.getElementById('jenis_kelamin').value=val.jenis_kelamin;  
         document.getElementById('pekerjaan').value=val.pekerjaan;  
         document.getElementById('telepon').value=val.telepon;  
                               
          
        });
      }
                   });
                  
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
