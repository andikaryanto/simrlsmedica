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

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                        <span class="hidden-xs">Pendaftaran Online RLS Medica</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="content-wrapper" style="margin-left: 0 !important;">
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
    <section class="content">
        <div class="row">
            <div class='col-sm-12'>
                <?php echo form_open('DaftarOnline/lama', array('id' => 'FormStockOpname')); ?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pendaftaran Online Pasien</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <div class='row'>
                                <div class="col-sm-12">
                                    <a href="<?php echo base_url(); ?>DaftarOnline/baru">
                                        <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span><b> Pasien Baru</b></button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">Pendaftaran Pasien Lama</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <div class='row'>
                                <label for="cari" class="col-sm-1 control-label">Cari</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="pencarian_kode" id="pencarian_kode"
                                           placeholder="Masukkan Nama / No RM / NIK" autocomplete="off">
                                    <input type="hidden" name="id_pasien" id='id_pasien'>
                                    <div id='hasil_pencarian'></div>
                                </div>
                                <div class="col-sm-2">
                                    <button type='submit' class='btn btn-danger'>
                                        <i class='fa fa-floppy-o'></i> Lanjut Daftar Periksa
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    <br/>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Antrian Pasien</h3>&nbsp;&nbsp;
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pendaftaran</th>
                                <th>No Antrian</th>
                                <th>NO RM</th>
                                <th>Nama Pasien</th>
                                <th>Jenis Pendaftaran</th>
                                <th>Nama Dokter</th>
                                <th>Catatan Alergi / Lainnya</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($listPendaftaran->result() as $k => $row) : ?>
                                <?php if (date('Y-m-d', strtotime($row->waktu_pendaftaran)) == date('Y-m-d')) : ?>
                                    <tr>
                                        <td> <?php echo $k + 1; ?></td>
                                        <td> <?php echo date('d-F-Y', strtotime($row->waktu_pendaftaran)); ?></td>
                                        <td>
                                            <?php echo $row->kode_antrian; ?>
                                            <?php if ($row->is_mobile_jkn) : ?>
                                                <br>
                                                <small>
                                                    <span class="label label-danger">Mobile JKN</span>
                                                    <?php if ($row->is_check_in) : ?>
                                                        <span class="label label-success">Check In</span>
                                                    <?php endif; ?>
                                                </small>
                                            <?php endif; ?>
                                        </td>
                                        <td style="width: 100px;">
                                            <?php echo $row->no_rm; ?><br>
                                            <small>
                                                <span class="label <?= $jaminan[$row->jaminan]['class'] ?>"><?= $jaminan[$row->jaminan]['label'] ?></span>
                                                <?php if (!isset($jaminan[$row->jaminan])) { ?>
                                                    <span class="label label-warning">Umum</span>
                                                <?php } ?>
                                            </small>
                                        </td>
                                        <td>
                                            <?php echo ucwords($row->nama_pasien); ?>
                                        </td>
                                        <td> <?php echo ucwords($row->jenis_pendaftaran); ?></td>
                                        <td> <?php echo ucwords($row->nama_dokter); ?></td>
                                        <td> <?php echo ucwords($row->asuhan_keperawatan ?? ''); ?></td>
                                        <?php
                                        if ($row->status == 'antri') {
                                            $warna = 'bg-blue';
                                        } elseif ($row->status == 'diperiksa') {
                                            $warna = 'bg-orange';
                                        } else {
                                            $warna = 'bg-green';
                                        }
                                        ?>
                                        <td>
                                            <span class="pull-right-container"><small class="label pull-right <?php echo $warna; ?> "><?php echo ucwords($row->status); ?></small></span>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(function () {
        <?php $success = $this->session->flashdata('success');
        if (!empty($success)) { ?>
        Swal.fire({
            icon: 'success',
            title: '<?=$success?>',
        }).then((result) => {

        })
        <?php } ?>

        $('#example2').DataTable({
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            'paging': true,
            'lengthChange': true,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': true
        })
    })
</script>


<script>
    $('#pencarian_kode').keypress(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
        }
    });
</script>

<script type="text/javascript">
    var timer = null;
    $(document).on('keyup', '#pencarian_kode', function (e) {
        if($('#pencarian_kode').val().length > 0){
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
                            var No_rmnya = $('.form-group').find('div#hasil_pencarian li.autocomplete_active span#no_rmnya').html();
                            var Namanya = $('.form-group').find('div#hasil_pencarian li.autocomplete_active span#namanya').html();
                            if (Kodenya) {
                                $('#pencarian_kode').val(No_rmnya + ' - ' + Namanya);
                                $('#id_pasien').val(Kodenya);
                            } else {
                                alert('data tidak ada! Pilih pilihan yang ada sebelum di enter.');
                            }


                            $('.form-group').find('div#hasil_pencarian').hide();

                        }
                        else {
                            var text = $('#FormStockOpname').find('div#hasil_pencarian').html();
                            autoComplete($('#pencarian_kode').width(), $('#pencarian_kode').val());
                        }
                    } else {
                        $('#FormStockOpname').find('div#hasil_pencarian').hide();
                    }
                }, 100);
        }
    });
    $(document).on('click', '#daftar-autocomplete li', function () {
        $(this).parent().parent().parent().find('#pencarian_kode').val($(this).find('span#no_rmnya').html() + ' - ' + $(this).find('span#namanya').html());
        $(this).parent().parent().parent().find('#id_pasien').val($(this).find('span#kodenya').html());

        $('.form-group').find('#daftar-autocomplete').hide();
    });

    function autoComplete(Lebar, KataKunci) {
        $('div#hasil_pencarian').hide();
        var Lebar = Lebar + 25;

        $.ajax({
            url: "<?php echo site_url('pendaftaran/ajax_kode'); ?>",
            type: "POST",
            cache: false,
            data: 'keyword=' + KataKunci,
            dataType: 'json',
            success: function (json) {
                if (json.status == 1) {
                    $('#FormStockOpname').find('div#hasil_pencarian').css({'width': Lebar + 'px'});
                    $('#FormStockOpname').find('div#hasil_pencarian').show('fast');
                    $('#FormStockOpname').find('div#hasil_pencarian').html(json.datanya);
                }
                if (json.status == 0) {
                    $('#FormStockOpname').find('div#hasil_pencarian').html('');
                }
            }
        });
    }

    function cekbarcode(KataKunci, Indexnya) {
        //alert(KataKunci+' '+Indexnya);
        var Registered = '';
        $('#TabelTransaksi tbody tr').each(function () {
            if (Indexnya !== $(this).index()) {
                if ($(this).find('td:nth-child(2)').find('#kode').val() !== '') {
                    Registered += $(this).find('td:nth-child(2)').find('#kode').val() + ',';
                }
            }
        });
        var suplieridnya = $('#id_suplier').val();
        if (Registered !== '') {
            Registered = Registered.replace(/,\s*$/, "");
        }
        var pencarian_kode = $('#TabelTransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(2)').find('#pencarian_kode');
        $.ajax({
            url: "<?php echo site_url('pembelian/cek-kode'); ?>",
            type: "POST",
            cache: false,
            data: 'keyword=' + KataKunci,
            dataType: 'json',
            success: function (json) {
                if (json.status == 1) {
                    call(1, KataKunci, Indexnya);
                }
                if (json.status == 0) {
                    call(0, KataKunci, Indexnya);
                }
            }
        });
    }
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