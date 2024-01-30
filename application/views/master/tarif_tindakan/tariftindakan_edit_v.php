  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">
<!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/select2/dist/css/select2.min.css">

 <div class="content-wrapper">


   
   <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Data Obat
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>Dashbord"><i class="fa fa-dashboard"></i> Dashbord</a></li>      
        <li class="active">Edit Data Obat</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Data Obat</h3>
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
           <form class="form-horizontal" method="post" action="<?php echo base_url()?>TarifTindakan/simpanUpdate">
              <div class="box-body">
               <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                        <label for="nama" class="col-sm-4 control-label" >Nama Tindakan</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="nama_tindakan" name="nama_tindakan" value="<?php echo $tarif_tindakan->nama ?>" placeholder="Masukkan nama_tindakan">
                          <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $tarif_tindakan->id ?>" placeholder="Masukkan nama_tindakan">
                        </div>
                      </div>

                    <div class="form-group">
                        <label for="nama" class="col-sm-4 control-label" >JM Perawat</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="tarif_perawat" name="tarif_perawat" value="<?php echo $tarif_tindakan->tarif_perawat ?>" onkeyup="set_tarifpasien()" placeholder="Masukkan JM perawat">
                        </div>
                      </div><div class="form-group">
                        <label for="nama" class="col-sm-4 control-label" >JM Dokter</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="tarif_dokter" name="tarif_dokter"  value="<?php echo $tarif_tindakan->tarif_dokter ?>" onkeyup="set_tarifpasien()" placeholder="Masukkan jm dokter">
                        </div>
                      </div><div class="form-group">
                        <label for="nama" class="col-sm-4 control-label" >Jasa lain-lain</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="tarif_lain" name="tarif_lain"  value="<?php echo $tarif_tindakan->tarif_lain ?>" onkeyup="set_tarifpasien()" placeholder="Masukkan Jasa lain-lain ">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="kategori" class="col-sm-4 control-label">Klinik</label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="klinik" name="klinik"  value="<?php echo $tarif_tindakan->klinik ?>" onkeyup="set_tarifpasien()" placeholder="Masukkan tarif untuk klinik">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tempat_lahir" class="col-sm-4 control-label">Total Tarif Pasien</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="tarif_pasien" name="tarif_pasien" value="<?php echo $tarif_tindakan->tarif_pasien ?>" placeholder="masukkan nama total tarif pasien">
                        </div>
                      </div>
                      
                     
                    </div>                              
                </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit"  name="submit" value="1" class="btn btn-primary btn-lg btn-flat pull-right">Simpan</button>
                  <a href="<?php echo base_url() ?>TarifTindakan"  class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
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
