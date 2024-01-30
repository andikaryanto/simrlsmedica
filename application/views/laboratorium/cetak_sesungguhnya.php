<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $pasien->nama ?></title>
    <link rel="icon" href="<?=base_url()?>/assets/img/profil/logo.png" type="image/gif">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/v4-shims.css">
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

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/toast-alert/toastr.css">
    <script src="<?php echo base_url(); ?>assets/bower_components/toast-alert/toastr.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/school-custom.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/style-main.css">

    <style>
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding: 3px !important;
        }
        td, .small-text {
            font-size: 12px !important;
        }

        @media print {
            .break {page-break-after: always;}
        }
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=MonteCarlo">
</head>
<body>
<section class="invoice">

    <div class="row">
        <div class="col-sm-12" style="display: flex; flex-direction: row;">
            <div style="display: flex; flex: 1">
                <img src="<?php echo base_url(); ?>assets/img/klinik/<?php echo $klinik->foto; ?>" width="40" height="40">
                <div style="text-align: center; margin-left: 20px; margin-top: 5px">
                    <small><?=$klinik->nama?></small><br>
                    <small style="font-size: 11px"><?php echo $klinik->alamat; ?></small>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="row invoice-info">
        <div class="col-sm-12 invoice-col" style="width: 100%">
            <h3 style="text-align: center; margin-top: 0px !important;"><u><strong>LAPORAN HASIL PEMERIKSAAN LABORATORIUM</strong></u></h3>
            <p><strong>Penanggung Jawab : <?= $klinik->pj_lab ?? '' ?></strong></p>
        </div>
        <div class="col-sm-3 invoice-col" style="width: 35%">
            Tanggal: <strong><?= date_format(date_create($pemeriksaan['created_at']), "d-m-Y") ?></strong><br>
            No. Registrasi: <strong><?= $no_reg ?? '' ?></strong><br>
            Pembayaran: <strong></strong><br>
            Pengirim: <strong><?=$pengirim?></strong><br>
        </div>
        <div class="col-sm-4 invoice-col" style="width: 35%">
            No. RM: <strong><?= $pasien->no_rm ?></strong><br>
            Nama Pasien: <strong><?= $pasien->nama ?></strong><br>
            Usia: <strong><?= $pasien->usia ?></strong><br>
            Alamat: <strong><?= $pasien->alamat ?></strong><br>
        </div>
        <div class="col-sm-3 invoice-col" style="width: 30%">
            <strong>Tgl Ambil Spesimen: <?=$meta && isset($meta['tgl_ambil_spesimen']) ? date('d-F-Y H:i:s', strtotime($meta['tgl_ambil_spesimen'])) : ''?></strong><br>
            <br>
            <strong>Tgl Hasil Pemeriksaan: <?=$meta && isset($meta['tgl_hasil_pemeriksaan']) ? date('d-F-Y H:i:s', strtotime($meta['tgl_hasil_pemeriksaan'])) : ''?></strong><br>
            <br>
        </div>
        <div class="col-xs-12">
            <div class="row" style="margin-top: 12px">
                <div class="col-sm-12">
                    <table class="table">
                        <tr>
                            <th>Jenis Pemeriksaan</th>
                            <th width="100">Hasil</th>
                            <th width="100">Nilai Rujukan</th>
                            <th width="120">Satuan</th>
                            <th width="120">Metode Periksa</th>
                        </tr>
                        <?php foreach (json_decode($pemeriksaan['hasil_lab']) as $k => $l) : ?>
                            <tr>
                                <td colspan="5"><strong><?=$l->nama?></strong></td>
                            </tr>
                            <?php foreach ($l->children as $kk => $c) : ?>
                                <tr>
                                    <td><?=$c->nama?></td>
                                    <td><?=$c->result?></td>
                                    <td><?=$c->nilai_rujukan?></td>
                                    <td><?=$c->satuan?></td>
                                    <td></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12" style="display: flex; flex-direction: row; margin-top: 150px">
                    <div>
                        <small style="margin-top: 30px"><strong>Catatan / Kesan :</strong></small><br>
                        <br>
                        <small><strong>Rekomendasi :</strong></small><br>
                        <br>
                        <small><strong>Diverifikasi Oleh :</strong></small><br>
                    </div>
                    <div style="flex: 1"></div>
                    <div style="display: flex; flex-direction: column; align-items: center; margin-right: 30px;">
                        <p><?=$klinik->kabupaten ?? 'Sleman'?>, <?= date("d/m/Y") ?></p>
                        <p>Pemeriksa</p>
                        <br>
                        <br>
                        <br>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
</body>
</html>

<script>
    window.print()
</script>