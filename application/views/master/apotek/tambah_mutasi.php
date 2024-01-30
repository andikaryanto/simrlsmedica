<style media="screen">
.select2-container {
  width: 100% !important;
}
</style>
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tambah Mutasi
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>Dashbord"><i class="fa fa-dashboard"></i> Dashbord</a></li>
            <li class="active">Tambah Mutasi</li>
        </ol>
    </section>

    <!-- Main content -->
                  <form class="form-horizontal" method="post" action="<?php echo base_url()?>Apotek/tambahMutasiObat">
    <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"> Data Mutasi</h3>
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
                          <div class="form-group">
                            <label for="tanggal" class="col-sm-4 control-label">Tanggal</label>
                            <div class="col-sm-8">
                              <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?=date('Y-m-d')?>" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="pukul" class="col-sm-4 control-label">Pukul</label>
                            <div class="col-sm-8">
                              <input type="time" class="form-control" id="pukul" name="pukul" value="<?=date('H:i')?>" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="tujuan" class="col-sm-4 control-label">Tujuan</label>
                            <div class="col-sm-8">
                              <input type="text" maxlength="255" class="form-control" id="tujuan" name="tujuan" placeholder="Apotik" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="note" class="col-sm-4 control-label"  maxlength="255">Catatan</label>
                            <div class="col-sm-8">
                              <textarea name="note" class="form-control" id="note" rows="3" placeholder="catatan khusus"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="submit" value="1" class="btn btn-primary btn-lg btn-flat pull-right">Simpan</button>
                            <a href="<?php echo base_url() ?>Apotek/pembelian"  class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="box box-danger">
                        <div class="box-header">
                          <h3 class="box-title"> Data Barang</h3><!-- nama, kategori, nomor_batch, kadaluwarsa, distributor, harga_beli, harga_jual, stok_obat -->
                          <ul class="pagination pagination-sm no-margin pull-right">
                            <li>
                              <button id="tombol-tambah-obat" type="button" class="btn btn-sm btn-primary" name="button"><i class="fa fa-plus"></i> Tambah Obat</button>
                            </li>
                          </ul>
                        </div>
                        <div class="box-body no-padding">
                          <div class="table-responsive">
                            <table class="table table-striped table-obat">
                              <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>Item</th>
                                  <th>Expired</th>
                                  <th>Stok</th>
                                  <th class="text-right">Jml</th>
                                  <th class="text-right"></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr id="obat-kosong">
                                    <td colspan="6" class="text-center">Masukkan data obat disini</td>
                                </tr>
                              </tbody>

                            </table>

                          </div>
                    </div>
                </div>
            </div>
        <div class="modal fade" id="form-obat" role="dialog" aria-labelledby="formObat">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i class="fa fa-times-circle-o"></i> </button>
                <div class="row">
                    <div class="col-sm-2">
                      <h4 class="modal-title">Cari Obat</h4>
                    </div>
                    <div class="col-sm-6">
                        <select class="form-control" name="nama_obat" id="nama_obat" onchange="getObatData()">
                            <option value="">--Pilih Obat--</option>
                            <?php foreach ($obat->result() as $key => $value) { ?>
                                <option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
              </div>
              <div class="modal-body no-padding">
                <div class="teble-responsive">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <td>ID</td>
                        <td>Obat</td>
                        <td>Tgl Kedaluarsa</td>
                        <td class="text-right">Stok</td>
                        <td></td>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-close"></i> Batal</button>
                  
               </div>
            </div>
          </div>
        </div>
    </section>
    
          </form>
</div>

<!-- Select2 -->
<script src="<?= base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->

<script>

    var index = 0;
    var distributor = '';
    var obat = <?php echo json_encode($obat->result()); ?>;
    var temObat = [];

    function aGetFormData(form){
      var formData =form.serializeArray();
      var data =[];

      $.each(formData, function(i, item){
        data[item.name]= item.value;
      });

      return data;
    }

    function initModalTable(){
      var emptyRow =`
        <tr>
          <td colspan="5" class="text-center"> <i>Mohon pilih obat dulu.</i> </td>
        </tr>`;
      $('#form-obat table tbody').html(emptyRow);
    }

    function number_format(number, decimals, dec_point, thousands_point) {

        if (number == null || !isFinite(number)) {
            throw new TypeError("number is not valid");
        }

        if (!decimals) {
            var len = number.toString().split('.').length;
            decimals = len > 1 ? len : 0;
        }

        if (!dec_point) {
            dec_point = '.';
        }

        if (!thousands_point) {
            thousands_point = ',';
        }

        number = parseFloat(number).toFixed(decimals);

        number = number.replace(".", dec_point);

        var splitNum = number.split(dec_point);
        splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
        number = splitNum.join(dec_point);

        return number;
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

    $('#nama_obat').select2();

    function getObatData(){
      var selector = $('#nama_obat');
      var id_obat = selector.val();

      $('#form-obat .small-error').remove();
      $('#form-obat button, #nama_obat').prop('disabled', true);     
      selector.parent('div').append('<span class="small-loading"><i class="fa fa-spinner fa-pulse fa-fw"></i> Mengambil data...</span>') ;

      $.ajax({
        url: '<?php echo base_url()?>Apotek/getDataObatDiGudang',
        method: 'post',
        dataType: 'json',
        data: {
          id: id_obat
        },
        success: function(data){
          if (data.length > 0) {
            temObat = data;
            var rows = ``;
            $.each(data, function(key, value){
              var avaliable = $('.table-obat .row-obat[data-rowid="'+ value.id +'"]');

              var button = ( avaliable.length > 0 ? '<i class="text-warning">Sudah ditambahkan</i>' : `<button type="button" class="btn btn-sm btn-primary btn-select" data-rowid="` + key + `"><i class="fa fa-plus"></i> Tambahkan</button>` );

                rows = rows + `
                  <tr data-rowid="` + key + `">
                    <td>`+ value.id +`</td>
                    <td>
                      `+ value.nama +`<br>
                      <samll><i>BATCH: `+ value.nomor_batch +` | KAT: `+ value.kategori +`</i></small>
                    </td>
                    <td>`+ value.tanggal_kadaluwarsa +`</td>
                    <td>`+ value.jumlah +`</td>
                    <td class="text-right">`+ button +`</td>
                  </tr>
                `;

            });
            
            $('#form-obat table tbody').html(rows);

            $('#form-obat .btn-select').on('click', function(){
              var value = temObat[$(this).data('rowid')];

              var row = `
                <tr class="row-obat" data-rowid="` + value.id + `">
                  <td>
                    `+ value.id +`
                  </td>
                  <td>
                    <span class="name">`+ value.nama +`</span><br>
                    <samll><i>BATCH: `+ value.nomor_batch +` | KAT: `+ value.kategori +`</i></small>
                  </td>
                  <td>`+ value.tanggal_kadaluwarsa +`</td>
                  <td>`+ value.jumlah +`</td>
                  <td>
                    <input type="number" class="form-control" name="item[`+ value.id +`][jumlah]" max="`+ value.jumlah +`" required>
                  </td>
                  <td>
                    <button type="button" class="btn btn-sm btn-danger delete" data-rowid="` + value.id + `"> <i class="fa fa-trash"></i> </button>
                  </td>
                </tr>
              `;

              $('.table-obat tbody').append(row);
              initTableObat();
              initButtonDelete();

              $('#form-obat').modal('hide');
            });

          }
          else{
            selector.parent('div').append('<span class="small-error text-danger"><i class="fa fa-exclamation-circle"></i> Obat tersebut belum ada digudang.</span>') ;
            initModalTable();
          }
        },
        error: function(data){   
          selector.parent('div').append('<span class="small-error text-danger"><i class="fa fa-exclamation-circle"></i> ERROR['+ data.status +']: '+ data.statusText +'.</span>') ;
        },
        complete: function(data){
          $('#form-obat button, #nama_obat').prop('disabled', false);     
          $('#form-obat .small-loading').remove();
        }
      });
    }

    function initTableObat(){

        if($('.table-obat .row-obat').length > 0){
            $('#obat-kosong').remove();
        }
        else{
            var emptyRow=`
                <tr>
                    <td colspan="6" id="obat-kosong" class="text-center">Masukkan data obat disini</td>
                </tr>
                `;
            $( '.table-obat tbody' ).append(emptyRow);
        }
    }

    function initButtonDelete(){

      var deleteButton = $('.table-obat .row-obat .delete');

      deleteButton.each(function(e){
          $(this).off('click');
      });
      deleteButton.each(function(e){
          $(this).on('click', function(){
              var c = $(this).data('rowid');
              var currentRow = $('.table-obat .row-obat[data-rowid="'+ c +'"]');
              var name = currentRow.find('.name').text();
              var ask = confirm('Apakah anda yakin ingin menghapus?\n' + name);

              if (ask) {
                currentRow.remove();
                initTableObat();
              }
          });
      });

    }

    $(function(){
      var addButton = $('#tombol-tambah-obat');

      addButton.on('click', function(){
        $('#form-obat').modal({
          backdrop: 'static',
          show: true
        });
      });

      $('#form-obat').on('show.bs.modal', function (e) {
        initModalTable(); 
        $('#form-obat .small-error').remove(); 
        $('#form-obat .small-loading').remove();

      });

      $('#form-obat').on('hide.bs.modal', function (e) {
        $('#form-obat form').trigger("reset");
        $('#nama_obat').val('').trigger("change");
        $('#select2-nama_obat-container').text('--Pilih Obat--');
      });

      $('#form-obat form').on('submit', function(e){
        e.preventDefault();
        var formData = aGetFormData($(this));
        var subtotal = parseFloat(formData['stok_obat']) * parseFloat(formData['harga_beli']);
        var subtotalF =number_format(subtotal, 2, ',', '.');
        var total = parseFloat( $('#hiddenFormObat input[name="total"]').val() ) + subtotal;

        var rowCounter = $('#hiddenFormObat > input[name="lastIndex"]');
        var currentCount = parseInt( rowCounter.val() ) + 1;

        var theRow = `
          <tr class="row-obat" data-rowid="`+ currentCount +`">
            <td>
              <span class="name">`+ formData['name'] +`</span><br>
              <small><i>BATCH: `+ formData['nomor_batch'] +` | KAT: `+ formData['kategori'] +`</i></small>
            </td>
            <td>`+ formData['distributor'] +`</td>
            <td>`+ formData['tgl_kadaluwarsa'] +`</td>
            <td>
              BELI: `+ formData['harga_beli'] +`<br>
              <small><i>JUAL: `+ formData['harga_jual'] +`</i></small>
            </td>
            <td class="text-center">`+ formData['stok_obat'] +` `+ formData['satuan'] +`</td>
            <td class="text-right">Rp `+ subtotalF +`</td>
            <td class="text-right">
                <button type="button" class="btn btn-sm btn-danger delete" data-rowid="`+ currentCount +`"><i class="fa fa-trash"></i></button>
            </td>
          </tr>
        `;

        var theRowForm =`
            <div data-rowid="`+ currentCount +`">
                <input type="hidden" name="obat[row-`+ currentCount +`][id_obat]" value="`+ formData['nama_obat'] +`">
                <input type="hidden" name="obat[row-`+ currentCount +`][name]" value="`+ formData['name'] +`">
                <input type="hidden" name="obat[row-`+ currentCount +`][batch]" value="`+ formData['nomor_batch'] +`">
                <input type="hidden" name="obat[row-`+ currentCount +`][kategori]" value="`+ formData['kategori'] +`">
                <input type="hidden" name="obat[row-`+ currentCount +`][distributor]" value="`+ formData['distributor'] +`">
                <input type="hidden" name="obat[row-`+ currentCount +`][tgl_kadaluwarsa]" value="`+ formData['tgl_kadaluwarsa'] +`">
                <input type="hidden" name="obat[row-`+ currentCount +`][harga_beli]" value="`+ formData['harga_beli'] +`">
                <input type="hidden" name="obat[row-`+ currentCount +`][harga_jual]" value="`+ formData['harga_jual'] +`">
                <input type="hidden" name="obat[row-`+ currentCount +`][jumlah]" value="`+ formData['stok_obat'] +`">
                <input type="hidden" name="obat[row-`+ currentCount +`][satuan]" value="`+ formData['satuan'] +`">
                <input type="hidden" name="obat[row-`+ currentCount +`][subtotal]" value="`+ subtotal +`">
            </div>
        `;

        $( theRow ).insertBefore( '.table-obat .calculate' );
        $('#hiddenFormObat').append(theRowForm);

        initButtonDelete();

        $('#hiddenFormObat > input[name="lastIndex"]').val( currentCount );
        $('#hiddenFormObat > input[name="total"]').val( total );
        $('.table-obat .total').text('Rp '+ number_format(total, 2, ',', '.') );

        initTableObat();

        $('#form-obat').modal('hide');
      });

      <?php if ($is_edit) { ?>
        initButtonDelete();
      <?php } ?>
    });
</script>
