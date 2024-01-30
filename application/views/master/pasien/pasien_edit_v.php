<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/select2/dist/css/select2.min.css">

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Edit Data Pasien
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>Dashbord"><i class="fa fa-dashboard"></i> Dashbord</a></li>
            <li class="active">Edit Data Pasien</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Data Pasien</h3>
                    </div>
                    <?php $warning = $this->session->flashdata('warning');
                    if (!empty($warning)) { ?>
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                            <?php echo $warning ?>
                        </div>
                    <?php } ?>
                    <?php $success = $this->session->flashdata('success');
                    if (!empty($success)) { ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Success!</h4>
                            <?php echo $success ?>
                        </div>
                    <?php } ?>
                    <div class="box-body">
                        <form class="form-horizontal" method="post"
                              action="<?php echo base_url() ?>Pasien/simpanUpdate">
                            <input type="hidden" name="to" value="<?=$to?>">
                            <input type="hidden" name="id_pendaftaran" value="<?=$id_pendaftaran?>">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama" class="col-sm-4 control-label">Nama</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="nama" name="nama"
                                                       value="<?php echo $pasien->nama; ?>"
                                                       placeholder="Masukkan nama pasien">
                                                <input type="hidden" class="form-control" id="nama" name="id"
                                                       value="<?php echo $pasien->id; ?>"
                                                       placeholder="Masukkan nama pasien">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama" class="col-sm-4 control-label">NIK</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="nik" name="nik"
                                                       value="<?php echo $pasien->nik; ?>"
                                                       placeholder="Masukkan NIK">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_lahir" class="col-sm-4 control-label">Tanggal
                                                Lahir</label>

                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" id="tanggal_lahir"
                                                       name="tanggal_lahir"
                                                       value="<?php echo $pasien->tanggal_lahir; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat_lahir" class="col-sm-4 control-label">Tempat
                                                Lahir</label>

                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="tempat_lahir"
                                                       value="<?php echo $pasien->tempat_lahir; ?>" name="tempat_lahir"
                                                       placeholder="masukkan tempat lahir pasien">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_kelamin" class="col-sm-4 control-label">Jenis
                                                Kelamin</label>
                                            <label class="radio-inline">
                                                <input type="radio"
                                                       value="L" <?php echo ($pasien->jk == 'L') ? 'checked' : ''; ?>
                                                       name="jenis_kelamin">Laki - laki</label>
                                            <label class="radio-inline">
                                                <input type="radio"
                                                       value="P" <?php echo ($pasien->jk == 'P') ? 'checked' : ''; ?>
                                                       name="jenis_kelamin">Perempuan</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat" class="col-sm-4 control-label">Alamat</label>

                                            <div class="col-sm-8">
                                                <textarea type="text" class="form-control" id="alamat" name="alamat"
                                                          placeholder="Masukkan alamat pasien"><?php echo $pasien->alamat; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat" class="col-sm-4 control-label">Alamat Domisili / Surat</label>

                                            <div class="col-sm-8">
                                                <textarea type="text" class="form-control" id="alamat_domisili" name="alamat_domisili"
                                                          placeholder="Masukkan alamat domisili pasien"><?php echo $pasien->alamat_domisili; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telepon" class="col-sm-4 control-label">No. Telepon</label>

                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="telepon" name="telepon"
                                                       value="<?php echo $pasien->telepon; ?>"
                                                       placeholder="Masukkan telepon pasien">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="agama" class="col-sm-4 control-label">Agama</label>
                                            <div class="col-sm-8">
                                                <select class="form-control abdush-select" name="agama">
                                                    <option value="">--Pilih Agama--</option>
                                                    <option value="Islam" <?=$pasien->agama == 'Islam' ? 'selected' : ''?>>Islam</option>
                                                    <option value="Kristen" <?=$pasien->agama == 'Kristen' ? 'selected' : ''?>>Kristen</option>
                                                    <option value="Katholik" <?=$pasien->agama == 'Katholik' ? 'selected' : ''?>>Katholik</option>
                                                    <option value="Hindu" <?=$pasien->agama == 'Hindu' ? 'selected' : ''?>>Hindu</option>
                                                    <option value="Buddha" <?=$pasien->agama == 'Buddha' ? 'selected' : ''?>>Buddha</option>
                                                    <option value="Konghucu" <?=$pasien->agama == 'Konghucu' ? 'selected' : ''?>>Konghucu</option>
                                                    <option value="lainnya" <?=$pasien->agama == 'lainnya' ? 'selected' : ''?>>lainnya</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="pekerjaan" class="col-sm-4 control-label">Tingkat Pendidikan</label>
                                            <div class="col-sm-8">
                                                <select class="form-control abdush-select" name="pendidikan">
                                                    <option value="">--Pilih Tingkat Pendidikan--</option>
                                                    <option value="Tidak Sekolah" <?=$pasien->pendidikan == 'Tidak Sekolah' ? 'selected' : ''?>>Tidak Sekolah</option>
                                                    <option value="SD" <?=$pasien->pendidikan == 'SD' ? 'selected' : ''?>>SD</option>
                                                    <option value="SMP" <?=$pasien->pendidikan == 'SMP' ? 'selected' : ''?>>SMP</option>
                                                    <option value="SMA" <?=$pasien->pendidikan == 'SMA' ? 'selected' : ''?>>SMA</option>
                                                    <option value="Sarjana S1" <?=$pasien->pendidikan == 'Sarjana S1' ? 'selected' : ''?>>Sarjana S1</option>
                                                    <option value="S2" <?=$pasien->pendidikan == 'S2' ? 'selected' : ''?>>S2</option>
                                                    <option value="S3" <?=$pasien->pendidikan == 'S3' ? 'selected' : ''?>>S3</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="pekerjaan" class="col-sm-4 control-label">Status Perkawinan</label>
                                            <div class="col-sm-8">
                                                <select class="form-control abdush-select" name="perkawinan">
                                                    <option value="">--Pilih Status Perkawinan--</option>
                                                    <option value="Sudah Menikah" <?=$pasien->perkawinan == 'Sudah Menikah' ? 'selected' : ''?>>Sudah Menikah</option>
                                                    <option value="Belum Menikah" <?=$pasien->perkawinan == 'Belum Menikah' ? 'selected' : ''?>>Belum Menikah</option>
                                                    <option value="Cerai" <?=$pasien->perkawinan == 'Cerai' ? 'selected' : ''?>>Cerai</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="pekerjaan" class="col-sm-4 control-label">Pekerjaan</label>

                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                                       value="<?php echo $pasien->pekerjaan; ?>"
                                                       placeholder="masukkan pekerjaan Pasien">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="penanggungjawab" class="col-sm-4 control-label">Penanggung
                                                Jawab</label>

                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="penanggungjawab"
                                                       name="penanggungjawab"
                                                       value="<?php echo $pasien->penanggungjawab; ?>"
                                                       placeholder="Masukkan penanggung jawab dari pasien">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputtext3" class="col-sm-4 control-label">Jenis Pendaftaran</label>
                                            <div class="col-sm-8">
                                                <select id="jaminan" class="abdush-select form-control" name="jaminan"
                                                        required>
                                                    <option value="">--Pilih Jenis Pendaftaran--</option>
                                                    <?php foreach ($jaminan as $key => $value) { ?>
                                                        <option value="<?= $key ?>" <?= $key == $pendaftaran->jaminan ? 'selected' : '' ?>><?= $value['label'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="nomor">
                                            <label for="asuhan" class="col-sm-4 control-label">No</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="no_jaminan"
                                                       placeholder="Nomor">
                                            </div>
                                        </div>

                                        <div class="form-group hidden">
                                            <label for="biopsikososial" class="col-sm-4 control-label">Bio Psiko
                                                Sosial</label>

                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="biopsikososial"
                                                       name="biopsikososial"
                                                       value="<?php echo $pasien->biopsikososial; ?>"
                                                       placeholder="Masukkan bio psiko sosial">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" name="submit" value="1"
                                        class="btn btn-primary btn-lg btn-flat pull-right">Simpan
                                </button>
                                <a href="<?php echo base_url() ?>Pasien"
                                   class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
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

    var timer = null;

    $(document).on('keyup', '#pencarian_kode', function (e) {
        clearTimeout(timer);
        timer = setTimeout(
            function () {
                if ($('#pencarian_kode').val() != '') {
                    var charCode = ( e.which ) ? e.which : event.keyCode;
                    if (charCode == 40) //arrow down
                    {
                        if ($('.form-group').find('div#hasil_pencarian li.autocomplete_active').length > 0) {
                            var selanjutnya = $('.form-group').find('div#hasil_pencarian li.autocomplete_active').next();
                            $('.form-group').find('div#hasil_pencarian li.autocomplete_active').removeClass('autocomplete_active');
                            selanjutnya.addClass('autocomplete_active');
                        } else {
                            $('.form-group').find('div#hasil_pencarian li:first').addClass('autocomplete_active');
                        }
                    }
                    else if (charCode == 38) //arrow up
                    {
                        if ($('.form-group').find('div#hasil_pencarian li.autocomplete_active').length > 0) {
                            var sebelumnya = $('.form-group').find('div#hasil_pencarian li.autocomplete_active').prev();
                            $('.form-group').find('div#hasil_pencarian li.autocomplete_active').removeClass('autocomplete_active');
                            sebelumnya.addClass('autocomplete_active');
                        } else {
                            $('.form-group').find('div#hasil_pencarian li:first').addClass('autocomplete_active');
                        }
                    }
                    else if (charCode == 13) // enter
                    {

                        var Kodenya = $('.form-group').find('div#hasil_pencarian li.autocomplete_active span#kodenya').html();
                        var Barangnya = $('.form-group').find('div#hasil_pencarian li.autocomplete_active span#barangnya').html();

                        $('#pencarian_kode').val(Barangnya);
                        $('#id_barang').val(Kodenya);

                        $('.form-group').find('div#hasil_pencarian').hide();

                    }
                    else {
                        var text = $('#FormSettingPenukaranPoin').find('div#hasil_pencarian').html();
                        autoComplete($('#pencarian_kode').width(), $('#pencarian_kode').val());
                    }
                } else {
                    $('#FormSettingPenukaranPoin').find('div#hasil_pencarian').hide();
                }
            }, 100);
    });

    function autoComplete(Lebar, KataKunci) {
        $('div#hasil_pencarian').hide();
        var Lebar = Lebar + 25;

        $.ajax({
            url: "<?php echo site_url('spp/ajax_kode'); ?>",
            type: "POST",
            cache: false,
            data: 'keyword=' + KataKunci,
            dataType: 'json',
            success: function (json) {
                if (json.status == 1) {
                    $('#FormSettingPenukaranPoin').find('div#hasil_pencarian').css({'width': Lebar + 'px'});
                    $('#FormSettingPenukaranPoin').find('div#hasil_pencarian').show('fast');
                    $('#FormSettingPenukaranPoin').find('div#hasil_pencarian').html(json.datanya);
                }
                if (json.status == 0) {
                    $('#FormSettingPenukaranPoin').find('div#hasil_pencarian').html('');
                }
            }
        });
    }

    $(document).on('click', '#daftar-autocomplete li', function () {
        $(this).parent().parent().parent().find('input').val($(this).find('span#kodenya').html());

        $('#FormSettingPenukaranPoin').find('#daftar-autocomplete').hide();
    });

    document.addEventListener('keydown', autoComplete);
</script>
<script>
    function TambahSuplier() {
        $.ajax({
            url: $('#FormSettingPenukaranPoin').attr('action'),
            type: "POST",
            cache: false,
            data: $('#FormSettingPenukaranPoin').serialize(),
            dataType: 'json',
            success: function (json) {
                if (json.status == 1) {
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('#ModalHeader').html('Sukses !');
                    $('#ModalContent').html(json.pesan);
                    $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                    $('#my-grid2').DataTable().ajax.reload(null, false);
                }
                else {
                    $('#ResponseInput').html(json.pesan);
                }
            }
        });
    }

    $(document).ready(function () {
        var Tombol = "<button type='button' class='btn btn-primary' id='SimpanSettingPenukaranPoin'>Simpan Data</button>";
        Tombol += "<button type='button' class='btn btn-default' data-dismiss='modal'>Tutup</button>";
        $('#ModalFooter').html(Tombol);

        $("#FormSettingPenukaranPoin").find('input[type=text],textarea,select').filter(':visible:first').focus();

        $('#SimpanSettingPenukaranPoin').click(function (e) {
            e.preventDefault();
            TambahSuplier();
        });

        $('#FormSettingPenukaranPoin').submit(function (e) {
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
    $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
    //Money Euro
    $('[data-mask]').inputmask()


    $(function () {
        const jaminan = '<?=$pendaftaran->jaminan?>';
        if (jaminan === 'umum') {
            $('#nomor').hide();
        }
        else {
            $('#nomor').show();
        }

        $('#jaminan').on('change', function (e) {
            if (this.value === 'umum') {
                $('#nomor').hide();
            }
            else {
                $('#nomor').show();
            }
        });
        $('#poli').on('change', function() {
            $('.requirable').prop('required', this.value != 19);
        });
    });

</script>
