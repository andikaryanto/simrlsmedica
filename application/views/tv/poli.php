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
            font-size: 102% !important;
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
                        <span class="hidden-xs">Antrian Poli Klinik Rajal</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="content-wrapper" style="margin-left: 0 !important;">
    <section class="content">
        <div class="row" id="v-init">
            <div class="col-sm-12" style="margin-left: auto; margin-right: auto">
                <div class="box box-success">
                    <div class="box-header text-center" style="margin-top: 50px; padding-bottom: 50px">
                        <img src="https://pmibanyumasku.simklinik.net/assets/img/profil/logo_PMI.png" onerror="this.onerror=null;this.src='https://sim.sukmawijaya.com/assets/img/logo.png';" width="100">
                        <h4>Antrian Poli Klinik Rajal</h4>
                        <button class="btn btn-success" style="margin-top: 50px" onclick="start_antrian()">Mulai</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="v-antrian" style="display: none">
            <div class="col-sm-12 col-md-5 col-lg-4">
                <div class="box box-success">
                    <div class="box-header text-center">
                        <h4>Antrian Poli</h4>
                        <hr>
                        <div style="height: 40px"></div>
                        <h3>Antrian Dipanggil</h3>
                        <h1><b id="ant-kode" style="font-size: 80px !important;"><?=$last_called->kode_antrian ?? ''?></b></h1>
                        <h4 style="margin-top: 40px" id="ant-poli"><b><?=$last_called->nama_poli ?? ''?></b></h4>
                        <?php if ($last_called && $last_called->nama_dokter) : ?>
                            <h4 style="margin-top: 8px" id="ant-dokter"><b><?=$last_called->nama_dokter ?? ''?></b></h4>
                        <?php endif; ?>
                        <div style="height: 40px"></div>
                        <hr>
                        <h5 id="ant-pasien"><b><?=$last_called->nama_pasien ?? ''?></b><?=$last_called && $last_called->no_rm ? " <i>($last_called->no_rm)</i>" : ''?></h5>
                        <h5 id="ant-nik"><b>NIK :</b> <?=$last_called->nik ?? '-'?></h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-7 col-lg-8">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">Daftar Antrian Poli</h3>
                    </div>
                    <div class="box-body">
                        <table class="example2 table table-bordered table-hover" id="t1">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Poli</th>
                                <th>Antrian Terpanggil</th>
                                <th>Sisa Antrian</th>
                                <th>Total Antrian</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($jenis_pendaftaran as $k => $v) : ?>
                                <tr>
                                    <td><?=$k + 1?></td>
                                    <td><?=$v->nama?></td>
                                    <td id="ant-<?=$v->id?>-kode"><?=$v->last->kode_antrian ?? ''?></td>
                                    <td><?=$v->sisa_antrian?></td>
                                    <td><?=$v->total_antrian?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box box-success">
                    <div class="box-body">
                        <table class="example2 table table-bordered table-hover" id="t2">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Waktu Ambil Antrian</th>
                                <th>No Antrian</th>
                                <th>Poli</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($list as $k => $v) : ?>
                                <tr>
                                    <td><?=$k + 1?></td>
                                    <td><?=date('d-M-Y H:i', strtotime($v->created_at))?></td>
                                    <td><?=$v->kode_antrian?></td>
                                    <td><?=$v->nama_poli?><br><?=$v->nama_dokter?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://cdn.socket.io/4.5.4/socket.io.min.js"></script>

<script>
    function start_antrian() {
        $('#v-init').hide()
        $('#v-antrian').show()
    }

    $(function () {
        $('.example2').DataTable({
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true
        })
        $('.example3').DataTable({
            'paging'      : false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : false,
            'autoWidth'   : true
        })

    })

    const jenis_pendaftaran = <?=json_encode($jenis_pendaftaran)?>;

    let speech = new SpeechSynthesisUtterance();
    speech.lang = "id";
    speech.rate = 0.8

    $(function () {
        let kode = '<?=$last_called ? $last_called->kode_antrian : ""?>'.split('').join(' ... ')
        speech.text = `Nomor antrian.... ${kode}.... Silahkan ke <?=$last_called->nama_poli?>`
    })

    function panggil(id) {
        const v = jenis_pendaftaran.find(v => +v.id === +id)
        if (v && v.next) {
            const n = v.next
            const kode = n.kode_antrian.split('').join('.')
            speech.text = `Nomor antrian.... ${kode}.... Silahkan ke ${n.nama_poli}`
            window.speechSynthesis.speak(speech)

            $(`#ant-${id}-kode`).html(n.kode_antrian)
            $('#ant-kode').html(`<b>${n.kode_antrian}</b>`)
            $('#ant-poli').html(`<b>${n.nama_poli}</b>`)
            $('#ant-dokter').html(`<b>${n.nama_dokter}</b>`)
            $('#ant-pasien').html(`<b>${n.nama_pasien}</b> ${n.no_rm ? `<i>(${n.no_rm})</i>` : ''}`)
            $('#ant-nik').html(`<b>NIK :</b> ${n.nik ?? ''}`)
            $('#b-tdk-hadir').data('url', `<?=base_url()?>/AntrianPoli/tidak_hadir/${n.id}`)

            $.ajax({url: `<?=base_url()?>/TV/data_poli/1`}).done(function(data) {
                console.log(data)
            })
        }
    }

    function recall() {
        window.speechSynthesis.speak(speech)
    }

    function toIndoDateName(date, withTime = false) {
        const t = date.split(/[- :]/);
        let d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]),
            month = d.getMonth(),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (day.length < 2)
            day = '0' + day;

        const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
        function addZeroBefore(n) {
            return (n < 10 ? '0' : '') + n;
        }
        const time = withTime ? ` ${addZeroBefore(d.getHours())}:${addZeroBefore(d.getMinutes())}` : ''

        return `${day}-${months[month]}-${year}${time}`;
    }

    // START SOCKET STUFF

    const audio = new Audio('<?=base_url()?>/assets/sounds/perawat.wav');
    let t1, t2
    let lastData = ''

    $(function () {
        let socket = io("https://socket.pmibanyumasku.simklinik.net/", {
            // transports: ["websocket"],
            // forceNew: true
        });
        // audio.play();

        socket.on("connect", () => {
            console.log(`connected: ${socket.id}`);
        });
        socket.on("disconnect", () => {
            console.log(socket.id);
        });
        socket.on('connect_failed', function (data) {
            console.log(data || 'connect_failed');
        });
        socket.on('connect_error', function (data) {
            console.log(data || 'connect_error');
        });
        socket.on('refresh', function(msg) {
            window.location.reload()
        });
        socket.on('call', function(msg) {
            const {
                jenis_pendaftaran_id,
                antrian_id,
                kode_antrian,
                nama_poli,
                nama_dokter,
                nama_pasien,
                no_rm,
                nik,
            } = msg
            const kode = kode_antrian.split('').join(' ... ')
            speech.text = `Nomor antrian.... ${kode} ..... atas nama ${nama_pasien.replaceAll('.', '').toLowerCase().replaceAll('tn ', '').replaceAll('ny ', '').replaceAll('an ', '').replaceAll('sdr ', '')} .... Silahkan ke ${nama_poli}`
            window.speechSynthesis.speak(speech)

            $(`#ant-${jenis_pendaftaran_id}-kode`).html(kode_antrian)
            $('#ant-kode').html(`${kode_antrian}`)
            $('#ant-poli').html(`<b>${nama_poli}</b>`)
            $('#ant-dokter').html(`<b>${nama_dokter}</b>`)
            $('#ant-pasien').html(`<b>${nama_pasien}</b> ${no_rm ? `<i>(${no_rm})</i>` : ''}`)
            $('#ant-nik').html(`<b>NIK :</b> ${nik ?? ''}`)

            $.ajax({url: `<?=base_url()?>/TV/data_poli/1`}).done(function(r) {
                const data = JSON.parse(r)

                $('#t1 tbody').empty()
                data.jenis_pendaftaran.forEach((v, k) => {
                    $('#t1 tbody').append(`
                        <tr>
                            <td>${k + 1}</td>
                            <td>${v.nama}</td>
                            <td id="ant-${v.id}-kode">${v.last ? v.last.kode_antrian : ''}</td>
                            <td>${v.sisa_antrian}</td>
                            <td>${v.total_antrian}</td>
                        </tr>
                    `)
                })

                $('#t2 tbody').empty()
                data.list.forEach((v, k) => {
                    $('#t2 tbody').append(`
                        <tr>
                            <td>${k + 1}</td>
                            <td>${toIndoDateName(v.created_at, true)}</td>
                            <td>${v.kode_antrian}</td>
                            <td>${v.nama_poli}<br>${v.nama_dokter}</td>
                        </tr>
                    `)
                })
            })
        });
    })

    console.log(`last refresh: ${new Date()}`)

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