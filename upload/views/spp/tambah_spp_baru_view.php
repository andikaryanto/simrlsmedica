  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">
<!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/select2/dist/css/select2.min.css">

 <div class="content-wrapper">


   
   <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Advanced Form Elements
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">

          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Input masks</h3>
            </div>
            <div class="box-body">

              
              <!-- Date dd/mm/yyyy -->
            <form id="FormSettingPenukaranPoin" >
              <div class="form-group">
                <div class='input-group'>
                  <label>Kode Produk</label>
                  <input type='text' class='form-control' name='kode_barang' id='pencarian_kode' placeholder='Ketik Kode / Nama Barang' autocomplete="off">
                  <div id='hasil_pencarian'></div>
                </div>
              </div>
            </form>
              <div class="form-group col-md-6">
                <label>Date masks:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              

              <!-- phone mask -->
              <div class="form-group col-md-6">
                <label>US phone mask:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- phone mask -->
              <div class="form-group col-md-6">
                <label>Intl US phone mask:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control"
                         data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- IP mask -->
              <div class="form-group col-md-6">
                <label>IP mask:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <input type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

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
