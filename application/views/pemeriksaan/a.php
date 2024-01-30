  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">
<!-- Select2 -->


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
                         
                              
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <div class="row-fluid">
                              <div class="span6">
                                  <form action="index.php" method="post">
                                      <table class="table table-striped">
                                          <thead>
                                              <tr>
                                                  <th width="300px">Nama Obat</th>
                                                  <th width="100px">Jumlah Satuan</th>
                                                  <th width="80px"></th>
                                              </tr>
                                          </thead>
                                          <!--elemet sebagai target append-->
                                          <tbody id="itemlist">
                                              <tr>
                                                  <td> <select class="form-control" name="nama_obat[]" >
                                    <option value="">--Pilih Obat--</option>
                                    <?php foreach ($obat as $key => $value) {
                                       ?>
                                      <option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
                                    <?php } ?> 
                                  </select></td>
                                                  <td><input name="jumlah_input[0]" class="form-control" /></td>
                                                  <td></td>
                                              </tr>
                                          </tbody>
                                          <tfoot>
                                              <tr>
                                                  <td></td>
                                                  <td></td>
                                                  <td>
                                                      <button class="btn btn-default" onclick="additem(); return false"><i class="fa fa-plus"></i></button>
                                                     
                                                  </td>
                                              </tr>
                                          </tfoot>
                                      </table>
                                  </form>
                              </div>
                              
                          </div>
                        </div>
                        <!-- /.tab-pane -->
                       
                        <!-- /.tab-pane -->
                      </div>
                      <!-- /.tab-content -->
                    </div>
                  </div>
                  <div class="box-footer">
                     <button type="submit" name="submit" value="1" class="btn btn-primary btn-lg btn-flat pull-right">Simpan</button>
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




 <!-- Select2 -->
<script src="<?php echo base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->




  <script>
            var i = 1;
            function additem() {
//                menentukan target append
                var itemlist = document.getElementById('itemlist');
//                membuat element
                var row = document.createElement('tr');
                var jenis = document.createElement('td');
                var jumlah = document.createElement('td');
                var aksi = document.createElement('td');
//                meng append element
                itemlist.appendChild(row);
                row.appendChild(jenis);
                row.appendChild(jumlah);
                row.appendChild(aksi);

//                membuat element input
                var jenis_input = document.createElement('select');
                jenis_input.setAttribute('name', 'jenis_input[' + i + ']');
                jenis_input.setAttribute('class', 'form-control');

/*
                var option = document.createElement('option');
                option.setAttribute('value','a');
                option.innerHTML = 'a';*/

                
                var data = array(<?php $i = 1; foreach ($id as $key => $value): ?><?php echo $value->id;?><?php echo (count($id) == $i)? "":"," ?><?php $i++; endforeach ?>);
              /*  const artists = ['michael', 'elvis'];
                const newArtists = ['justin', 'charlie'];

                Array.prototype.push.apply(artists, newArtists);*/

                for(var i = 0; i < data.length; i++) {
                    var opt = data[i];
                    jenis_input.innerHTML += "<option value=\"" + opt + "\">" + opt + "</option>";
                }

                jenis_input.appendChild(option);


                var jumlah_input = document.createElement('input');
                jumlah_input.setAttribute('name', 'jumlah_input[' + i + ']');
                jumlah_input.setAttribute('class', 'form-control');
                var hapus = document.createElement('span');
//                
//                meng append element input
                jenis.appendChild(jenis_input);
                jumlah.appendChild(jumlah_input);
                aksi.appendChild(hapus);
                hapus.innerHTML = '<button class="btn btn-default"><i class="fa fa-trash"></i></button>';
//                membuat aksi delete element
                hapus.onclick = function () {
                    row.parentNode.removeChild(row);
                };
                i++;
            }
        </script>