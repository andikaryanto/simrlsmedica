  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">
<!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/select2/dist/css/select2.min.css">

 <div class="content-wrapper">


   
   <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Persen Harga Jual Obat
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>Dashbord"><i class="fa fa-dashboard"></i> Dashbord</a></li>      
        <li class="active">Edit Persen Harga Jual Obat</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Persen Harga Jual Obat</h3>
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
           <form class="form-horizontal" method="post" action="<?php echo base_url()?>Obat/setting_persen">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                      
                      <div class="form-group">
                        <label for="stok_obat" class="col-sm-4 control-label">Untung Harga Jual (%)</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="prosentase" value="<?php echo $persen->prosentase; ?>" name="prosentase" placeholder="Masukkan prosentase"> 
                            <input type="hidden" class="form-control" id="prosentase" value="<?php echo $persen->id; ?>" name="id" placeholder="Masukkan prosentase"> 
                        </div>
                      </div>                                
                    </div>                              
                </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit"  name="submit" value="1" class="btn btn-primary btn-lg btn-flat pull-right">Simpan</button>
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
           
           
            var untung = hb*2/10;
           
            var harga_jual = hb+untung;

       
                 $('#harga_jual').val(harga_jual);
       
    }
     function set_harga_beli(){
            var hj = parseInt($('#harga_jual').val());
           
           
            var untung = hj*0.1666666666666667;
           
            var harga_beli = hj-untung;

       
                 $('#harga_beli').val(harga_beli);
       
    }


</script>