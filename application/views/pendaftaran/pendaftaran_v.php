<?php
$u = $this->session->userdata('logged_in');
?>

<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Pendaftaran Pasien
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>Dashbord"><i class="fa fa-dashboard"></i> Dashbord</a></li>
            <li class="active">Pendaftaran</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form class="form-horizontal" method="post" action="<?php echo base_url() ?>pendaftaran/pendaftaran_baru">
                <input type="hidden" name="id_antrian" value="<?=$id_antrian?>">
                <div class="col-md-12">

                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title">Data Pasien</h3>
                        </div>
                        <?php $warning = $this->session->flashdata('warning');
                        if (!empty($warning)) { ?>
                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                                </button>
                                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                                <?php echo $warning ?>
                            </div>
                        <?php } ?>
                        <?php $success = $this->session->flashdata('success');
                        if (!empty($success)) { ?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                                </button>
                                <h4><i class="icon fa fa-check"></i> Success!</h4>
                                <?php echo $success ?>
                            </div>
                        <?php } ?>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="norm" class="col-sm-4 control-label">No RM</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="no_rm" name="no_rm"
                                                   placeholder="Masukkan no_rm pasien" value="<?= $no_rm_auto ?>"
                                                   required readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama" class="col-sm-4 control-label">Nama</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="nama" name="nama"
                                                   placeholder="Masukkan nama pasien" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama" class="col-sm-4 control-label">NIK</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="nik" name="nik"
                                                   placeholder="Masukkan NIK pasien" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_lahir" class="col-sm-4 control-label">Tanggal Lahir</label>
                                        <div class="col-sm-5">
                                            <input type="date" class="form-control" id="tanggal_lahir"
                                                   name="tanggal_lahir" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tempat_lahir" class="col-sm-4 control-label">Tempat Lahir</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="tempat_lahir"
                                                   name="tempat_lahir" placeholder="masukkan tempat lahir pasien"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_kelamin" class="col-sm-4 control-label">Jenis Kelamin</label>
                                        <div class="col-sm-8">
                                            <label class="radio-inline"><input type="radio" value="L"
                                                                               name="jenis_kelamin" required>Laki - laki</label>
                                            <label class="radio-inline"><input type="radio" value="P"
                                                                               name="jenis_kelamin"
                                                                               required>Perempuan</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Alamat Sesuai KTP</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="provinsi_ktp" class="col-sm-4 control-label">Provinsi</label>
                                        <div class="col-sm-8">
                                            <select id="provinsi_ktp" name="provinsi_ktp" class="form-control select2">
                                                <option>--Pilih Provinsi--</option>
                                                <?php foreach ($provinces as $v) : ?>
                                                    <option value="<?=$v->id?>"><?=$v->name?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="kabupaten_ktp" class="col-sm-4 control-label">Kabupaten</label>
                                        <div class="col-sm-8">
                                            <select id="kabupaten_ktp" name="kabupaten_ktp" class="form-control select2">
                                                <option>--Pilih Kabupaten--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="kecamatan_ktp" class="col-sm-4 control-label">Kecamatan</label>
                                        <div class="col-sm-8">
                                            <select id="kecamatan_ktp" name="kecamatan_ktp" class="form-control select2">
                                                <option>--Pilih Kecamatan--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="desa_ktp" class="col-sm-4 control-label">Desa</label>
                                        <div class="col-sm-8">
                                            <select id="desa_ktp" name="desa_ktp" class="form-control select2">
                                                <option>--Pilih Desa--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat" class="col-sm-4 control-label">Alamat Lengkap</label>
                                        <div class="col-sm-8">
                                            <textarea type="text" class="form-control" id="alamat" name="alamat"
                                                      placeholder="Masukkan alamat pasien" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div style="display: flex">
                                            <label class="col-sm-4 control-label">Alamat Domisili / Surat</label>
                                            <div style="flex: 1"></div>
                                            <button type="button" class="btn btn-sm btn-success" style="margin-right: 18px" id="btn-sama">
                                                <i class="fa fa-arrow-down"></i> Sama
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="provinsi_ktp" class="col-sm-4 control-label">Provinsi</label>
                                        <div class="col-sm-8">
                                            <select id="provinsi_domisili" name="provinsi_domisili" class="form-control select2">
                                                <option>--Pilih Provinsi--</option>
                                                <?php foreach ($provinces as $v) : ?>
                                                    <option value="<?=$v->id?>"><?=$v->name?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="kabupaten_domisili" class="col-sm-4 control-label">Kabupaten</label>
                                        <div class="col-sm-8">
                                            <select id="kabupaten_domisili" name="kabupaten_domisili" class="form-control select2">
                                                <option>--Pilih Kabupaten--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="kecamatan_domisili" class="col-sm-4 control-label">Kecamatan</label>
                                        <div class="col-sm-8">
                                            <select id="kecamatan_domisili" name="kecamatan_domisili" class="form-control select2">
                                                <option>--Pilih Kecamatan--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="desa_domisili" class="col-sm-4 control-label">Desa</label>
                                        <div class="col-sm-8">
                                            <select id="desa_domisili" name="desa_domisili" class="form-control select2">
                                                <option>--Pilih Desa--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat" class="col-sm-4 control-label">Alamat Lengkap</label>
                                        <div class="col-sm-8">
                                            <textarea type="text" class="form-control" id="alamat_domisili" name="alamat_domisili"
                                                      placeholder="Masukkan alamat domisili pasien" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telepon" class="col-sm-4 control-label">No. Telepon</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="telepon" name="telepon"
                                                   placeholder="Masukkan telepon pasien" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="agama" class="col-sm-4 control-label">Agama</label>
                                        <div class="col-sm-8">
                                            <select class="form-control abdush-select" name="agama">
                                                <option value="">--Pilih Agama--</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Katholik">Katholik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Buddha">Buddha</option>
                                                <option value="Konghucu">Konghucu</option>
                                                <option value="lainnya">lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="pekerjaan" class="col-sm-4 control-label">Tingkat Pendidikan</label>
                                        <div class="col-sm-8">
                                            <select class="form-control abdush-select" name="pendidikan">
                                                <option value="">--Pilih Tingkat Pendidikan--</option>
                                                <option value="Tidak Sekolah">Tidak Sekolah</option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="Sarjana S1">Sarjana S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="pekerjaan" class="col-sm-4 control-label">Status Perkawinan</label>
                                        <div class="col-sm-8">
                                            <select class="form-control abdush-select" name="perkawinan">
                                                <option value="">--Pilih Status Perkawinan--</option>
                                                <option value="Sudah Menikah">Sudah Menikah</option>
                                                <option value="Belum Menikah">Belum Menikah</option>
                                                <option value="Cerai">Cerai</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="pekerjaan" class="col-sm-4 control-label">Pekerjaan</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                                   placeholder="masukkan pekerjaan Pasien" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="penanggungjawab" class="col-sm-4 control-label">Penanggung
                                            Jawab</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="penanggungjawab"
                                                   name="penanggungjawab"
                                                   placeholder="Masukkan penanggung jawab dari pasien">
                                        </div>
                                    </div>
                                    <div class="form-group hidden">
                                        <label for="asuhan" class="col-sm-4 control-label">Catatan
                                            Alergi/Lainnya</label>
                                        <!-- 'Asuhan Keperawatan' diganti 'Catatan Alergi/Lainnya' -->

                                        <div class="col-sm-8">
                                            <input type="hidden" class="form-control" id="asuhan" name="asuhan"
                                                   placeholder="Masukkan Catatan Alergi/Lainnya" required>
                                        </div>
                                    </div>
                                    <!-- 'Bio Psiko Sosial' dihapus -->
                                    <input type="hidden" class="form-control" id="biopsikososial" name="biopsikososial"
                                           placeholder="Masukkan bio psiko sosial" value="">
                                    <div class="form-group">
                                        <label for="jenis_pendaftaran" class="col-sm-4 control-label">Tipe Layanan</label>

                                        <div class="col-sm-8">
                                            <select class="form-control abdush-select" name="tipe_layanan" id="tipe_layanan" required>
                                                <option value="">--Pilih Tipe Layanan--</option>
                                                <option value="1">Home Visit</option>
                                                <option value="2">On Site</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="jenis_pendaftaran" class="col-sm-4 control-label">Jenis Layanan</label>

                                        <div class="col-sm-8">
                                            <select class="form-control abdush-select" name="jenis_pendaftaran" id="poli" required>
                                                <option value="">--Pilih Jenis Layanan--</option>
                                                <?php foreach ($jenis_pendaftaran->result() as $key => $value) {
                                                    ?>
                                                    <option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_pendaftaran" class="col-sm-4 control-label">Pilih Surat</label>
                                        <div class="col-sm-8">
                                            <select class="form-control abdush-select" name="surat">
                                                <option value="">--Pilih Surat (Opsional)--</option>
                                                <option value="sehat">Surat Keterangan Sehat</option>
                                                <option value="sakit">Surat Keterangan Sakit</option>
                                                <option value="consent">Surat Informed Consent</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_pendaftaran" class="col-sm-4 control-label">Sifat Kunjungan</label>
                                        <div class="col-sm-8">
                                            <select class="form-control abdush-select" name="sifat" required id="sifat">
                                                <option value="">--Pilih Sifat Kunjungan--</option>
                                                <option value="1">Rujukan</option>
                                                <option value="2">Non Rujukan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="rujukan">
                                        <label for="rujukan" class="col-sm-4 control-label">Rujukan</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="rujukan"
                                                   placeholder="Rujukan">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputtext3" class="col-sm-4 control-label">Jenis Pendaftaran</label>
                                        <div class="col-sm-8">
                                            <select id="jaminan" class="abdush-select form-control" name="jaminan"
                                                    required>
                                                <option value="">--Pilih Jenis Pendaftaran--</option>
                                                <?php foreach ($jaminan as $key => $value) { ?>
                                                    <option value="<?= $key ?>" <?= $key == 'umum' ? 'selected' : '' ?>><?= $value['label'] ?></option>
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
                                    <div class="form-group" style="display: none">
                                        <label for="inputtext3" class="col-sm-4 control-label">Pilih Dokter</label>
                                        <div class="col-sm-8">
                                            <input type="hidden" name="dokter" value="1">
                                            <select class="form-control abdush-select">
                                                <option value="" selected>-- Pilih Dokter --</option>
                                                <?php foreach ($dokter->result() as $key => $value) {
                                                    ?>
                                                    <option value="<?php echo $value->id ?>"><?php echo $value->nama; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_lahir" class="col-sm-4 control-label">Tanggal Pendaftaran</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" id="due_date" name="due_date" required value="<?=date('Y-m-d')?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="submit" value="1"
                                    class="btn btn-primary btn-lg btn-flat pull-right">Daftar
                            </button>
                            <a href="<?php echo base_url() ?>pendaftaran/listPendaftaranPasien"
                               class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
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
<!-- InputMask -->
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<script type="text/javascript">

    function set_bmi() {
        var tb = $('#tb').val();
        var bb = $('#bb').val();
        var tbm = tb / 100;
        var bmi = bb / (tbm * tbm);

        $('#bmi').val(bmi.toFixed(2));
    }

    $(function () {
        $('#nomor').hide();
        $('#jaminan').on('change', function (e) {
            if (this.value === 'umum' || this.value === '') {
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

    $(function () {
        $('.select2').select2();

        const getVillages = (district_id, $select) => {
            $.get(`<?=base_url() . 'Pendaftaran/villages/'?>${district_id}`, function(res) {
                JSON.parse(res).forEach(v => {
                    $select.append(`<option value="${v.id}">${v.name}</option>`)
                })
            })
        }

        const regencies = <?=json_encode($regencies)?>;
        const districts = <?=json_encode($districts)?>;

        $('#provinsi_ktp').change(function () {
            $('#kabupaten_ktp').empty().append(`<option>--Pilih Kabupaten--</option>`)
            regencies.filter(v => parseInt(v.province_id) === parseInt($(this).val())).forEach(v => {
                $('#kabupaten_ktp').append(`<option value="${v.id}">${v.name}</option>`)
            })
        })
        $('#kabupaten_ktp').change(function () {
            $('#kecamatan_ktp').empty().append(`<option>--Pilih Kecamatan--</option>`)
            districts.filter(v => parseInt(v.regency_id) === parseInt($(this).val())).forEach(v => {
                $('#kecamatan_ktp').append(`<option value="${v.id}">${v.name}</option>`)
            })
        })
        $('#kecamatan_ktp').change(function () {
            $('#desa_ktp').empty().append(`<option>--Pilih Desa--</option>`)
            getVillages($(this).val(), $('#desa_ktp'))
        })

        $('#provinsi_domisili').change(function () {
            $('#kabupaten_domisili').empty().append(`<option>--Pilih Kabupaten--</option>`)
            regencies.filter(v => parseInt(v.province_id) === parseInt($(this).val())).forEach(v => {
                $('#kabupaten_domisili').append(`<option value="${v.id}">${v.name}</option>`)
            })
        })
        $('#kabupaten_domisili').change(function () {
            $('#kecamatan_domisili').empty().append(`<option>--Pilih Kecamatan--</option>`)
            districts.filter(v => parseInt(v.regency_id) === parseInt($(this).val())).forEach(v => {
                $('#kecamatan_domisili').append(`<option value="${v.id}">${v.name}</option>`)
            })
        })
        $('#kecamatan_domisili').change(function () {
            $('#desa_domisili').empty().append(`<option>--Pilih Desa--</option>`)
            getVillages($(this).val(), $('#desa_domisili'))
        })

        $('#btn-sama').click(function () {
            $('#provinsi_domisili').val($('#provinsi_ktp').val()).change()
            $('#kabupaten_domisili').val($('#kabupaten_ktp').val()).change()
            $('#kecamatan_domisili').val($('#kecamatan_ktp').val()).change()

            $('#desa_domisili').empty().append($("#desa_ktp > option").clone());
            $('#desa_domisili').val($('#desa_ktp').val()).change()
            $('#alamat_domisili').val($('#alamat').val())
        })

        $('#rujukan').hide();
        $('#sifat').on('change', function (e) {
            if (this.value === '1') {
                $('#rujukan').show();
            }
            else {
                $('#rujukan').hide();
            }
        });
    })

</script>
