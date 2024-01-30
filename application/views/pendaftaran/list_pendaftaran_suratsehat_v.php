  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/autocomplete/style-gue.css">
 <style type="text/css">
  @import('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/css/bootstrap.min.css');


</style>
 
 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pendaftaran Pasien
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Pendaftaran</a></li>
        <li class="active"> Pendaftaran Pasien</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class='col-sm-12'>  
        <?php echo form_open('Pendaftaran/Pendaftaran_lama2', array('id' => 'FormStockOpname')); ?>        
          <div class="box box-primary">
             <div class="box-header with-border">
              <h3 class="box-title">Pendaftaran</h3>
            </div>
            <div class="box-body">
                    
                <div class="form-group">
                  <label for="cari" class="col-sm-1 control-label">Cari</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="pencarian_kode" id="pencarian_kode" placeholder="Masukkan Nama atau No RM" autocomplete="off">    
                    <input type="hidden" name="id_pasien" id='id_pasien'>
                    <div id='hasil_pencarian'></div>                
                  </div>
                  <div class="col-sm-2">
                     <a  href="<?php  echo base_url(); ?>pendaftaran/pendaftaran_baru"><button type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span></button> <b> Daftar Baru</b></a>
                  </div>
                </div>   
                <div class='row'>
                  <div class='col-sm-11' style="text-align: right;">
                    <button type='submit' class='btn btn-danger' >
                      <i class='fa fa-floppy-o'></i> Lanjut Daftar Periksa
                    </button>                        
                  </div>
                </div>          
            </div>


        
          <?php echo form_close(); ?>

          <br />
        </div>
      </div>
<!--         <div class="col-xs-12">
         <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Pendaftaran</h3>
            </div> -->
            <!-- /.box-header -->
            <!-- form start -->
           <!--  <form class="form-horizontal" id="FormStockOpname">
              <div class="box-body">
                <div class="form-group">
                  <label for="cari" class="col-sm-1 control-label">Cari</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="pencarian_kode" id="pencarian_kode" placeholder="Masukkan Nama atau No RM">    
                    <input type="hidden" name="kode_barang" id='id_pasien'>
                    <div id='hasil_pencarian'></div>                
                  </div>
                  <div class="col-sm-2">
                     <a  href="<?php  echo base_url(); ?>pendaftaran/pendaftaran_baru"><button type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span></button> <b> Daftar Baru</b></a>
                  </div>
                </div>               
              </div>                   
            </form>
          </div> -->
          <!-- /.box -->

        </div> 
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Antrian Pasien</h3>&nbsp;&nbsp;
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                        <tr>
                            <th>No</th>
                            <th>NO RM</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal Daftar</th>
                            <th>Jenis Pendaftaran</th>
                            <th>Nama Dokter</th>
                            <th>Asuhan Keperawatan</th>                                                  
                            <th>Status</th>
                           
                        </tr>
                    </thead>
                 
                
                 
                    <tbody>
                        <?php $no=1; foreach ($listPendaftaran->result() as $row) { ?>
                  
                        <tr> 
                            <td> <?php echo $no; ?></td>
                            <td> <?php echo $row->no_rm; ?></td>
                            <td> <?php echo ucwords($row->nama_pasien); ?></td>
                            <td> <?php echo $row->waktu_pendaftaran; ?></td>
                            <td> <?php echo ucwords($row->jenis_pendaftaran); ?></td>
                            <td> <?php echo ucwords($row->nama_dokter); ?></td>                           
                            <td> <?php echo ucwords($row->asuhan_keperawatan); ?></td>
                            <?php 
                            if ($row->status == 'antri') {
                              $warna = 'bg-blue';
                            }elseif ($row->status == 'diperiksa') {
                              $warna = 'bg-orange';
                            }else {
                               $warna = 'bg-green';
                            }
                          
                            ?>
                            <td> <span class="pull-right-container"><small class="label pull-right <?php echo $warna; ?> "><?php echo ucwords($row->status); ?></small></span></td>
                            
                            <!-- <td>                                    
                              
                              <a  href="<?php  echo base_url(); ?>pemeriksaan/periksa/<?php echo $row->id; ?>"> <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i>Periksa</button></a>


                           
                               

                            </td> -->
                           
                         
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
$('#pencarian_kode').keypress(function (event) {
    if (event.keyCode == 13) {
        event.preventDefault();
    }
});
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
          var No_rmnya = $('.form-group').find('div#hasil_pencarian li.autocomplete_active span#no_rmnya').html();
          var Namanya = $('.form-group').find('div#hasil_pencarian li.autocomplete_active span#namanya').html();
          if (Kodenya) {
             $('#pencarian_kode').val(No_rmnya+' - '+Namanya);
             $('#id_pasien').val(Kodenya);
          }else{
            alert('data tidak ada! Pilih pilihan yang ada sebelum di enter.');
          }
         

          $('.form-group').find('div#hasil_pencarian').hide();

        }
        else
        {
          var text = $('#FormStockOpname').find('div#hasil_pencarian').html();
          autoComplete($('#pencarian_kode').width(), $('#pencarian_kode').val());
        }
      }else
      {
        $('#FormStockOpname').find('div#hasil_pencarian').hide();
      }
    }, 100);
});
$(document).on('click', '#daftar-autocomplete li', function(){
  $(this).parent().parent().parent().find('#pencarian_kode').val($(this).find('span#no_rmnya').html()+' - '+$(this).find('span#namanya').html());
  $(this).parent().parent().parent().find('#id_pasien').val($(this).find('span#kodenya').html());

  $('.form-group').find('#daftar-autocomplete').hide();
});

function autoComplete(Lebar, KataKunci)
{
  $('div#hasil_pencarian').hide();
  var Lebar = Lebar + 25;

  $.ajax({
    url: "<?php echo site_url('pendaftaran/ajax_kode'); ?>",
    type: "POST",
    cache: false,
    data:'keyword='+KataKunci,
    dataType:'json',
    success: function(json){
      if(json.status == 1)
      {
        $('#FormStockOpname').find('div#hasil_pencarian').css({ 'width' : Lebar+'px' });
        $('#FormStockOpname').find('div#hasil_pencarian').show('fast');
        $('#FormStockOpname').find('div#hasil_pencarian').html(json.datanya);
      }
      if(json.status == 0)
      {
        $('#FormStockOpname').find('div#hasil_pencarian').html('');
      }
    }
  });
}

function cekbarcode(KataKunci, Indexnya)
{
  //alert(KataKunci+' '+Indexnya);
  var Registered = '';
  $('#TabelTransaksi tbody tr').each(function(){
    if(Indexnya !== $(this).index())
    {
      if($(this).find('td:nth-child(2)').find('#kode').val() !== '')
      {
        Registered += $(this).find('td:nth-child(2)').find('#kode').val() + ',';
      }
    }
  });
  var suplieridnya = $('#id_suplier').val();
  if(Registered !== ''){
    Registered = Registered.replace(/,\s*$/,"");
  }
  var pencarian_kode = $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(2)').find('#pencarian_kode');
  $.ajax({
    url: "<?php echo site_url('pembelian/cek-kode'); ?>",
    type: "POST",
    cache: false,
    data:'keyword=' + KataKunci,
    dataType:'json',
    success: function(json){
      if(json.status == 1)
      {
        call(1, KataKunci, Indexnya);
      }
      if(json.status == 0)
      {
        call(0, KataKunci, Indexnya);
      }
    }
  });
}
</script>