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
                        <form class="form-horizontal" method="post" action="<?php echo base_url()?>Apotek/simpanUpdate">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" class="form-control" id="id" value="<?php echo $obat->id; ?>" name="id" placeholder="Masukkan id">
                                        <input type="hidden" class="form-control" id="no_urut" name="no_urut" placeholder="Masukkan no_urut">
                                        <input type="hidden" class="form-control" id="kode_obat" name="kode_obat" placeholder="Masukkan kode_obat pasien">
                                        <input type="hidden" class="form-control" id="jenis" name="jenis" placeholder="Masukkan jenis obat">
                                        <div class="form-group">
                                            <label for="nama" class="col-sm-4 control-label" >Nama Obat</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="nama" value="<?php echo $obat->nama; ?>" name="nama" placeholder="Masukkan nama obat">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama" class="col-sm-4 control-label" >Nomor Batch</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="nomor_batch" value="<?php echo $obat->nomor_batch; ?>" name="nomor_batch" placeholder="Masukkan nomor_batch">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori" class="col-sm-4 control-label">Kategori</label>
                                            <div class="col-sm-8">
                                                <select name="kategori" class="form-control">
                                                    <option value="Obat Bebas Terbatas" <?=$obat->kategori == 'Obat Bebas Terbatas' ? 'selected' : ''?>>Obat Bebas Terbatas</option>
                                                    <option value="Obat Bebas" <?=$obat->kategori == 'Obat Bebas' ? 'selected' : ''?>>Obat Bebas</option>
                                                    <option value="Obat Keras" <?=$obat->kategori == 'Obat Keras' ? 'selected' : ''?>>Obat Keras</option>
                                                    <option value="Obat Wajib Apotek (OWA)" <?=$obat->kategori == 'Obat Wajib Apotek (OWA)' ? 'selected' : ''?>>Obat Wajib Apotek (OWA)</option>
                                                    <option value="Obat Golongan Narkotika" <?=$obat->kategori == 'Obat Golongan Narkotika' ? 'selected' : ''?>>Obat Golongan Narkotika</option>
                                                    <option value="Obat Psikotropika" <?=$obat->kategori == 'Obat Psikotropika' ? 'selected' : ''?>>Obat Psikotropika</option>
                                                    <option value="Obat Herbal" <?=$obat->kategori == 'Obat Herbal' ? 'selected' : ''?>>Obat Herbal</option>
                                                    <option value="INA CBG's" <?=$obat->kategori == "INA CBG's" ? 'selected' : ''?>>INA CBG's</option>
                                                    <option value="INA CBG's Non Tagihan" <?=$obat->kategori == "INA CBG's Non Tagihan" ? 'selected' : ''?>>INA CBG's Non Tagihan</option>
                                                    <option value="Kronis" <?=$obat->kategori == 'Kronis' ? 'selected' : ''?>>Kronis</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat_lahir" class="col-sm-4 control-label">Kode Barang</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="kode_barang" value="<?php echo $obat->kode_barang; ?>" name="kode_barang" placeholder="masukkan kode barang">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat_lahir" class="col-sm-4 control-label">Distributor</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="distributor" value="<?php echo $obat->distributor; ?>" name="distributor" placeholder="masukkan nama distributor">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Kadaluwarsa" class="col-sm-4 control-label"> Tanggal Kadaluwarsa</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" id="tanggal_kadaluwarsa" value="<?php echo $obat->tanggal_kadaluwarsa; ?>" name="tanggal_kadaluwarsa" placeholder="Masukkan Kadaluwarsa obat">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="stok_obat" class="col-sm-4 control-label">Stok Obat</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="stok_obat" value="<?php echo $obat->stok_obat; ?>" name="stok_obat" placeholder="Masukkan stok_obat">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pekerjaan" class="col-sm-4 control-label">Kategori Harga</label>
                                            <div class="col-sm-8" style="margin-top: 6px">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="is_umum" id="is_umum" value="1" <?=$obat->is_umum ? 'checked' : ''?>>
                                                    <label class="form-check-label" for="flexRadioDefault1" style="font-weight: normal !important;">
                                                        Umum
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="is_bpjs" id="is_bpjs" value="1" <?=$obat->is_bpjs ? 'checked' : ''?>>
                                                    <label class="form-check-label" for="flexRadioDefault1" style="font-weight: normal !important;">
                                                        BPJS
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="is_kecantikan" id="is_kecantikan" value="1" <?=$obat->is_kecantikan ? 'checked' : ''?>>
                                                    <label class="form-check-label" for="flexRadioDefault1" style="font-weight: normal !important;">
                                                        Kecantikan
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="pekerjaan" class="col-sm-4 control-label">Harga Beli</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="harga_beli" value="<?php echo $obat->harga_beli; ?>" name="harga_beli" onkeyup="set_harga_jual()" placeholder="masukkan Harga Beli">
                                            </div>
                                        </div>
                                        <div class="form-group <?=$obat->is_umum ? '' : 'd-none'?>" id="c-umum">
                                            <label for="penanggungjawab" class="col-sm-4 control-label">Harga Jual Umum</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="harga_jual" value="<?php echo $obat->harga_jual; ?>" name="harga_jual" placeholder="Masukkan Harga Jual Umum">
                                            </div>
                                        </div>
                                        <div class="form-group <?=$obat->is_bpjs ? '' : 'd-none'?>" id="c-bpjs">
                                            <label for="penanggungjawab" class="col-sm-4 control-label">Harga Jual BPJS</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="harga_jual_bpjs" name="harga_jual_bpjs" placeholder="Masukkan Harga Jual BPJS" value="<?php echo $obat->harga_jual_bpjs; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group <?=$obat->is_kecantikan ? '' : 'd-none'?>" id="c-kecantikan">
                                            <label for="penanggungjawab" class="col-sm-4 control-label">Harga Jual Kecantikan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="harga_jual_kecantikan" name="harga_jual_kecantikan" placeholder="Masukkan Harga Jual Kecantikan" value="<?php echo $obat->harga_jual_kecantikan; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit"  name="submit" value="1" class="btn btn-primary btn-lg btn-flat pull-right">Simpan</button>
                                    <a href="<?php echo base_url() ?>Apotek/stokObat"  class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<div id='ResponseInput'></div>
<script type="text/javascript">

    $(function () {
        $('.select2').select2()

        $('#is_umum').change(function () {
            if (this.checked)
                $('#c-umum').removeClass('d-none')
            else
                $('#c-umum').addClass('d-none')
        })
        $('#is_bpjs').change(function () {
            if (this.checked)
                $('#c-bpjs').removeClass('d-none')
            else
                $('#c-bpjs').addClass('d-none')
        })
        $('#is_kecantikan').change(function () {
            if (this.checked)
                $('#c-kecantikan').removeClass('d-none')
            else
                $('#c-kecantikan').addClass('d-none')
        })
    })

    const persen = <?=json_encode($persen);?>;
    function set_harga_jual() {
        persen.forEach(v => {
            if (parseInt(v.id) === 1) {
                set_harga_jual_($('#harga_jual'), v.prosentase || 0)
            }
            else if (parseInt(v.id) === 2) {
                set_harga_jual_($('#harga_jual_bpjs'), v.prosentase || 0)
            }
            else if (parseInt(v.id) === 3) {
                set_harga_jual_($('#harga_jual_kecantikan'), v.prosentase || 0)
            }
        })
    }

    function set_harga_jual_($harga_jual, persen) {
        const hb = parseInt($('#harga_beli').val()) || 0;
        const untung = hb * persen / 100;
        const harga_jual = hb + untung;

        $harga_jual.val(harga_jual);
    }

</script>