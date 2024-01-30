<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Smart Clinic</title>
    <link rel="icon" href="<?=base_url()?>/assets/img/profil/logo.png" type="image/gif">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/select2/dist/css/select2.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css">

    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- Javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/2.3.0/mustache.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>

    <style>
        @media (min-width: 1px) {
            .modal-xl {
                width: 90% !important;
                max-width:768px !important;
            }
        }

        @media (min-width: 768px) {
            .modal-xl {
                width: 90% !important;
                max-width:1400px !important;
            }
        }

        .btn-group .dropdown-menu {
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 10px;
            box-shadow: 0 4px 3px 0 rgba(0, 0, 0, 0.1);
            left: -80px;
        }

        body {
            min-height: 100% !important;
            background-color: #ecf0f5 !important;
        }

        * {
            font-size: 100% !important;
        }

    </style>
</head>
<body style="height: 100% !important;" class="skin-blue">
<link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/autocomplete/style-gue.css">

<header class="main-header">
    <nav class="navbar navbar-static-top" style="margin-left: 0 !important;">
        <div class="navbar-custom-menu" style="float: left">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="https://pmibanyumasku.simklinik.net/assets/img/profil/logo_PMI.png" onerror="this.onerror=null;this.src='https://sim.sukmawijaya.com/assets/img/logo.png';" class="user-image" alt="User Image">
                        <span class="hidden-xs">Pendaftaran Online RLS Medika</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="content-wrapper" style="margin-left: 0 !important;">
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
            <form class="form-horizontal" method="post" action="<?php echo base_url() ?>DaftarOnline/baru">
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
                                                   value="<?=$no_rm_auto?>"
                                                   placeholder="Masukkan no_rm pasien"
                                                   readonly required>
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
                                                   placeholder="Masukkan nik pasien">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_lahir" class="col-sm-4 control-label">Tanggal Lahir</label>
                                        <div class="col-sm-8">
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
                                        <label class="col-sm-4 control-label">Alamat Domisili / Surat</label>
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
                                        <label for="pekerjaan" class="col-sm-4 control-label">Pekerjaan</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                                   placeholder="masukkan pekerjaan Pasien" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="agama" class="col-sm-4 control-label">Agama</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="agama" name="agama"
                                                   placeholder="masukkan agama Pasien" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tingkat_pendidikan" class="col-sm-4 control-label">Tingkat Pendidikan</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="tingkat_pendidikan" name="tingkat_pendidikan"
                                                   placeholder="masukkan tingkat pendidikan Pasien" required>
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
                                        <label for="jenis_pendaftaran" class="col-sm-4 control-label">Poli</label>

                                        <div class="col-sm-8">
                                            <select class="form-control abdush-select" name="jenis_pendaftaran" id="poli"
                                                    required>
                                                <option value="">--Pilih Poli--</option>
                                                <?php foreach ($jenis_pendaftaran->result() as $key => $value) {
                                                    ?>
                                                    <option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputtext3" class="col-sm-4 control-label">Jenis Pendaftaran</label>
                                        <div class="col-sm-8">
                                            <select id="jaminan" class="abdush-select form-control" name="jaminan"
                                                    required readonly disabled>
                                                <option value="">--Pilih Jenis Pendaftaran--</option>
                                                <?php foreach ($jaminan as $key => $value) { ?>
                                                    <option value="<?= $key ?>" <?= $key == 'umum' ? 'selected' : '' ?>><?= $value['label'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="nomor" style="display: none">
                                        <label for="asuhan" class="col-sm-4 control-label">No Kartu</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="no_jaminan" id="no_jaminan"
                                                   placeholder="Nomor Kartu">
                                        </div>
                                    </div>
                                    <div class="form-group" id="c-no-rujukan" style="display: none">
                                        <label for="asuhan" class="col-sm-4 control-label">No Rujukan</label>
                                        <div class="col-sm-8" style="display: flex">
                                            <input type="text" class="form-control" name="nomor_rujukan" id="nomor_rujukan" placeholder="Nomor Rujukan" style="flex: 1; margin-right: 8px">
                                            <button type="button" class="btn btn-sm btn-success" id="b-cari-rujukan">Cari Rujukan</button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputtext3" class="col-sm-4 control-label">Pilih Dokter</label>
                                        <div class="col-sm-8">
                                            <select class="form-control abdush-select" name="dokter" required>
                                                <option value="" selected>-- Pilih Dokter --</option>
                                                <?php foreach ($dokter->result() as $key => $value) {
                                                    ?>
                                                    <option value="<?php echo $value->id ?>"><?php echo $value->nama; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_kelamin" class="col-sm-4 control-label">Jenis Kunjungan</label>
                                        <div class="col-sm-8">
                                            <label class="radio-inline">
                                                <input type="radio" value="1" name="jenis_kunjungan" checked>Rujukan FKTP
                                            </label>
                                            <!--                                            <label class="radio-inline">-->
                                            <!--                                                <input type="radio" value="2" name="jenis_kunjungan">Rujukan Internal-->
                                            <!--                                            </label>-->
                                            <!--                                            <label class="radio-inline">-->
                                            <!--                                                <input type="radio" value="3" name="jenis_kunjungan">Kontrol-->
                                            <!--                                            </label>-->
                                            <label class="radio-inline">
                                                <input type="radio" value="4" name="jenis_kunjungan">Rujukan Antar RS
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="submit" value="1"
                                    class="btn btn-primary btn-lg btn-flat pull-right">Daftar
                            </button>
                            <a href="<?php echo base_url() ?>DaftarOnline"
                               class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<script>

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

    })

</script>

<script src="<?php echo base_url() ?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url() ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- Morris.js charts -->
<!-- <script src="<?php echo base_url() ?>assets/bower_components/morris.js/morris.min.js"></script> -->
<!-- Sparkline -->
<script src="<?php echo base_url() ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url() ?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url() ?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url() ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) --><!--
<script src="<?php echo base_url() ?>assets/dist/js/pages/dashboard.js"></script>
 --><!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>

</body>
</html>