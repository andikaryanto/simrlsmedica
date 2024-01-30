  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">
<!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/select2/dist/css/select2.min.css">

 <div class="content-wrapper">


   
   <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail User
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>Dashbord"><i class="fa fa-dashboard"></i> Dashbord</a></li>      
        <li class="active">User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Data User</h3>
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
             <form class="form-horizontal" method="post" action="<?php echo base_url()?>User/simpan_adduser">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                        <label for="nama" class="col-sm-4 control-label" >Nama</label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="nama" name="nama" value=""  placeholder="Masukkan nama pasien">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="username" class="col-sm-4 control-label" >username</label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="username" name="username" value=""   placeholder="Masukkan username">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="email" class="col-sm-4 control-label" >email</label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="email" name="email" value=""   placeholder="Masukkan email">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="password" class="col-sm-4 control-label" >password</label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="password" name="password" value=""   placeholder="Masukkan password">
                        </div>
                      </div>
                     
                     
                     
                      <div class="form-group">
                        <label for="telepon" class="col-sm-4 control-label">No. Telepon</label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="telepon" name="telepon" value=""  placeholder="Masukkan telepon pasien">
                        </div>
                      </div>
                  </div>
                
               
                <div class="form-group">
                  <label for="inputtext3" class="col-sm-4 control-label">Pilih Jenis User</label>

                  <div class="col-sm-4">
                     <select class="form-control" name="nama_grup" >
                      <option></option>
                      <?php foreach ($grup as $key => $value) {
                        
                         ?>
                        <option value="<?php echo $value->id ?>" ><?php echo $value->nama_grup; ?></option>
                      <?php } ?> 
                      
                    </select>
                  </div>
                </div>
                
                  </div>                  
                </div>               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="submit" value="1" class="btn btn-primary btn-lg btn-flat pull-right">Simpan</button>
                <a href="<?php echo base_url() ?>Dashboard"  class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
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

var timer = null;

$(document).on('keyup', '#pencarian_kode', function(e){
  clearTimeout(timer);
  timer = setTimeout(
    function(){
      if($('#pencarian_kode').val()!='')
      {
        var charCode = ( e.which ) ? e.which : event.keyCode;
        if(charCode == 40) //arrow down
        {
          if ($('.form-group').find('div#hasil_pencarian li.autocomplete_active').length > 0) {
            var selanjutnya = $('.form-group').find('div#hasil_pencarian li.autocomplete_active').next();
            $('.form-group').find('div#hasil_pencarian li.autocomplete_active').removeClass('autocomplete_active');         
            selanjutnya.addClass('autocomplete_active');
          }else{
            $('.form-group').find('div#hasil_pencarian li:first').addClass('autocomplete_active');
          }         
        } 
        else if(charCode == 38) //arrow up
        {
          if ($('.form-group').find('div#hasil_pencarian li.autocomplete_active').length > 0) {
            var sebelumnya = $('.form-group').find('div#hasil_pencarian li.autocomplete_active').prev();
            $('.form-group').find('div#hasil_pencarian li.autocomplete_active').removeClass('autocomplete_active');         
            sebelumnya.addClass('autocomplete_active');
          }else{
            $('.form-group').find('div#hasil_pencarian li:first').addClass('autocomplete_active');
          }         
        }
        else if( charCode == 13) // enter
        {
          
          var Kodenya = $('.form-group').find('div#hasil_pencarian li.autocomplete_active span#kodenya').html();
          var Barangnya = $('.form-group').find('div#hasil_pencarian li.autocomplete_active span#barangnya').html();
          
          $('#pencarian_kode').val(Barangnya);
          $('#id_barang').val(Kodenya);

          $('.form-group').find('div#hasil_pencarian').hide();

        }
        else{
          var text = $('#FormSettingPenukaranPoin').find('div#hasil_pencarian').html();
          autoComplete($('#pencarian_kode').width(), $('#pencarian_kode').val());
        }
      }else{
        $('#FormSettingPenukaranPoin').find('div#hasil_pencarian').hide();
      }
    }, 100);
});

function autoComplete(Lebar, KataKunci)
{
  $('div#hasil_pencarian').hide();
  var Lebar = Lebar + 25;

  $.ajax({
    url: "<?php echo site_url('spp/ajax_kode'); ?>",
    type: "POST",
    cache: false,
    data:'keyword='+KataKunci,
    dataType:'json',
    success: function(json){
      if(json.status == 1)
      {
        $('#FormSettingPenukaranPoin').find('div#hasil_pencarian').css({ 'width' : Lebar+'px' });
        $('#FormSettingPenukaranPoin').find('div#hasil_pencarian').show('fast');
        $('#FormSettingPenukaranPoin').find('div#hasil_pencarian').html(json.datanya);
      }
      if(json.status == 0)
      {
        $('#FormSettingPenukaranPoin').find('div#hasil_pencarian').html('');
      }
    }
  });
}

$(document).on('click', '#daftar-autocomplete li', function(){
  $(this).parent().parent().parent().find('input').val($(this).find('span#kodenya').html());

  $('#FormSettingPenukaranPoin').find('#daftar-autocomplete').hide();
});

document.addEventListener('keydown', autoComplete);
</script>
<script>
function TambahSuplier()
{
  $.ajax({
    url: $('#FormSettingPenukaranPoin').attr('action'),
    type: "POST",
    cache: false,
    data: $('#FormSettingPenukaranPoin').serialize(),
    dataType:'json',
    success: function(json){
      if(json.status == 1){ 
        $('.modal-dialog').removeClass('modal-lg');
        $('.modal-dialog').addClass('modal-sm');
        $('#ModalHeader').html('Sukses !');
        $('#ModalContent').html(json.pesan);
        $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
        $('#my-grid2').DataTable().ajax.reload( null, false );
      }
      else {
        $('#ResponseInput').html(json.pesan);
      }
    }
  });
}

$(document).ready(function(){
  var Tombol = "<button type='button' class='btn btn-primary' id='SimpanSettingPenukaranPoin'>Simpan Data</button>";
  Tombol += "<button type='button' class='btn btn-default' data-dismiss='modal'>Tutup</button>";
  $('#ModalFooter').html(Tombol);

  $("#FormSettingPenukaranPoin").find('input[type=text],textarea,select').filter(':visible:first').focus();

  $('#SimpanSettingPenukaranPoin').click(function(e){
    e.preventDefault();
    TambahSuplier();
  });

  $('#FormSettingPenukaranPoin').submit(function(e){
    e.preventDefault();
    TambahSuplier();
  });
});
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
