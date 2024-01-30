<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/morris.js/morris.css">

<div class="content-wrapper">
    <section class="content-header">
        <h1 style="margin-top: 20px;">
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb" style="margin-top: 10px;">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <section class="box-body" style="margin: 0px 10px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <span class="info-box-text">Kunjungan Pasien Hari Ini</span>
                                <span class="info-box-number"><?= $pasien_hari_ini ?></span>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person"></i>
                            </div>
                            <a href="<?= base_url() . 'Dashboard/pasienHariIni' ?>" class="small-box-footer">Detail <i
                                        class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <span class="info-box-text">Pasien Baru</span>
                                <span class="info-box-number"><?= $pasien_baru_hari_ini ?></span>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="<?= base_url() . 'Dashboard/pasienBaru' ?>" class="small-box-footer">Detail <i
                                        class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <span class="info-box-text">Total Kunjungan Pasien</span>
                                <span class="info-box-number"><?= $total_pasien ?></span>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="<?= base_url() . 'Dashboard/totalPasien' ?>" class="small-box-footer">Detail <i
                                        class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-purple">
                            <div class="inner">
                                <span class="info-box-text">Insentif</span>
                                <span class="info-box-number"><?= 0 ?></span>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">Detail <i
                                        class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-maroon">
                            <div class="inner">
                                <span class="info-box-text">Total Piutang Bulan Ini</span>
                                <span class="info-box-number"><?= 'Rp ' . number_format($laba, 2, ',', '.') ?></span>
                            </div>
                            <div class="icon">
                                <i class="ion ion-calculator"></i>
                            </div>
                            <a href="<?= base_url() . 'Keuangan/listTotalPiutang' ?>" class="small-box-footer">Detail <i
                                        class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <span class="info-box-text">Total Transaksi</span>
                                <span class="info-box-number"><?= 'Rp ' . number_format($total_transaksi, 2, ',', '.') ?></span>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="<?= base_url() . 'Dashboard/totalTransaksi' ?>" class="small-box-footer">Detail <i
                                        class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Kunjungan Pasien Tiap Hari</h3>&nbsp;&nbsp;
                            </div>
                            <div class="box-body">
                                <canvas id="chart-kunjungan"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="box box-success">
                            <div class="box-header">
                                <h3 class="box-title">Jenis Penyakit Yang Ditangani</h3>&nbsp;&nbsp;
                            </div>
                            <div class="box-body">
                                <canvas id="chart-penyakit"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-danger">
                            <div class="box-header">
                                <h3 class="box-title">Pembelian Obat</h3>&nbsp;&nbsp;
                            </div>
                            <div class="box-body">
                                <table id="example1" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>No Faktur</th>
                                        <th>Tgl Faktur</th>
                                        <th>Tgl Jatuh Tempo</th>
                                        <th>Nama Distributor</th>
                                        <th>Profit (%)</th>
                                        <th>Total</th>
                                        <th>Tgl Dibuat</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($pembelian as $row) { ?>
                                        <tr>
                                            <td> <?php echo $row->id; ?></td>
                                            <td> <?php echo ucwords($row->no_faktur); ?></td>
                                            <td><?= date('d M Y', strtotime($row->tgl_faktur)) ?></td>
                                            <td><?= date('d M Y', strtotime($row->tgl_jatuh_tempo)) ?></td>
                                            <td> <?php echo ucwords($row->nama_distributor); ?></td>
                                            <td> <?php echo $row->profit . '%'; ?></td>
                                            <td>Rp <?= number_format($row->total, 0, ',', '.') ?></td>
                                            <td>
                                                <?= date('d M Y', strtotime($row->created_at)) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Obat Kadaluarsa</h3>&nbsp;&nbsp;
                            </div>
                            <div class="box-body">
                                <table id="example2" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Obat</th>
                                        <th>Tgl Kedaluarsa</th>
                                        <th>Jumlah</th>
                                        <th>Update</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($obat_kedaluarsa as $key => $value) { ?>
                                        <tr>
                                            <td><?= $value->id ?></td>
                                            <td>
                                                <?= $value->nama ?><br>
                                                <small><i>BATCH: <?= $value->nomor_batch ?> |
                                                        KAT: <?= $value->kategori ?></i></small>
                                            </td>
                                            <td><?= date('d M Y', strtotime($value->tanggal_kadaluwarsa)) ?></td>
                                            <td><?= $value->jumlah ?></td>
                                            <td><?= ($value->updated_at ? date('d M Y', strtotime($value->updated_at)) : '-') ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
    $(function () {
        let dt = {
            'pageLength': 5,
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true
        };
        $('#example1').DataTable(dt);
        $('#example2').DataTable(dt);

        //chart

        // ################## CHART HELPER ##################

        function getRandomColor(transparent = false) {
            var letters = '0123456789ABCDEF'.split('');
            var color = transparent ? '#55' : '#';
            for (var i = 0; i < 6; i++ ) {
                let n = letters[Math.floor(Math.random() * 16)];
                if (!isNaN(n) && parseInt(n) < 5) {
                    n = parseInt(n) + 5;
                }
                color += n;
            }
            return color;
        }
        function solidToTransparent(color) {
            return '#55' + color.replace('#', '');
        }
        function getDays() {
            let d = new Date();
            let lastDay = new Date(d.getFullYear(), d.getMonth() + 1, 0).getDate();
            let today = new Date().getDate();

            let list = [];
            for (let i = 1; i <= lastDay; i++) {
                list.push(i);
            }
            return list;
        }

        // ################## KUNJUNGAN ##################
        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        let k = <?=json_encode($chart_kunjungan);?>;
        let data = getDays().map(v => {
            let f = k.find(k => parseInt(k.tanggal) === v);
            return f ? f.jumlah : 0;
        });
        const d = new Date();
        new Chart(document.getElementById('chart-kunjungan').getContext('2d'), {
            type: 'line',
            data: {
                labels: getDays(),
                datasets: [{
                    label: 'Kunjungan bulan ' + monthNames[d.getMonth()],
                    pointRadius: 2,
                    borderWidth: 2,
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255,99,132,0.1)',
                    data: data
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            userCallback: function(label, index, labels) {
                                if (Math.floor(label) === label) {
                                    return label;
                                }
                            },
                        }
                    }],
                }
            }
        });

        // ################## PENYAKIT ##################

        let p = <?=json_encode($chart_penyakit);?>;
        let solids = ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'];
        let trans = ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'];
        let borderColor = p.map((v, k) => solids[k % 6]);
        let backgroundColor = p.map((v, k) => trans[k % 6]);

        new Chart(document.getElementById('chart-penyakit').getContext('2d'), {
            type: 'bar',
            data: {
                labels: p.map(v => v.nama.substring(0, 15) + (v.nama.length > 15 ? '...' : '')),
                datasets: [{
                    data: p.map(v => v.jumlah),
                    backgroundColor: backgroundColor,
                    borderColor: borderColor,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                legend: {
                    display: false,
                    position: 'bottom',
                    labels: {
                        boxWidth: 10,
                        boxHeight: 5
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            userCallback: function(label, index, labels) {
                                if (Math.floor(label) === label) {
                                    return label;
                                }
                            }
                        }
                    }]
                }
            }
        });
        // let namas = [...new Set(p.map(item => item.nama))];
        // let datasets = namas.map(n => ({
        //     label: n.trim(),
        //     pointRadius: 1.5,
        //     borderWidth: 1.5,
        //     borderColor: getRandomColor(),
        //     backgroundColor: 'rgba(10,140,255,0)',
        //     data: getDays().map(t => p.filter(f => f.nama === n && parseInt(f.tanggal) === t).length)
        // }));
        // new Chart(document.getElementById('chart-penyakit').getContext('2d'), {
        //     type: 'line',
        //     data: {
        //         labels: getDays(),
        //         datasets: datasets
        //     },
        //     options: {
        //         responsive: true,
        //         legend: {
        //             display: false,
        //             position: 'bottom',
        //             labels: {
        //                 boxWidth: 10,
        //                 boxHeight: 5
        //             }
        //         },
        //         scales: {
        //             yAxes: [{
        //                 ticks: {
        //                     beginAtZero: true,
        //                     userCallback: function(label, index, labels) {
        //                         if (Math.floor(label) === label) {
        //                             return label;
        //                         }
        //                     },
        //                 }
        //             }],
        //         },
        //     }
        // });

        // ################## OBAT ##################

        // new Chart(document.getElementById('chart-obat').getContext('2d'), {
        //     type: 'line',
        //     data: {
        //         labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        //         datasets: [{
        //             label: 'Resep Internal',
        //             pointRadius: 1.5,
        //             borderWidth: 1.5,
        //             borderColor: 'rgb(64,140,255)',
        //             backgroundColor: 'rgba(10,140,255,0)',
        //             data: [10, 67, 40, 42, 8, 30, 23]
        //         }, {
        //             label: 'Resep Luar',
        //             pointRadius: 1.5,
        //             borderWidth: 1.5,
        //             borderColor: 'rgb(45,197,101)',
        //             backgroundColor: 'rgba(45,197,101,0)',
        //             data: [0, 10, 5, 2, 20, 30, 45]
        //         }, {
        //             label: 'Obat Bebas',
        //             pointRadius: 1.5,
        //             borderWidth: 1.5,
        //             borderColor: 'rgb(255, 99, 132)',
        //             backgroundColor: 'rgba(255,99,132,0)',
        //             data: [44, 12, 10, 23, 2, 13, 5]
        //         }, {
        //             label: 'Obat Internal',
        //             pointRadius: 1.5,
        //             borderWidth: 1.5,
        //             borderColor: 'rgb(255,165,79)',
        //             backgroundColor: 'rgba(255,165,79,0)',
        //             data: [30, 1, 9, 8, 61, 53, 60]
        //         }]
        //     },
        //     options: {}
        // });
        // new Chart(document.getElementById('chart-penyakit').getContext('2d'), {
        //     type: 'bar',
        //     data: {
        //         labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        //         datasets: [{
        //             label: 'Penyakit bulan April',
        //             borderWidth: 2,
        //             barPercentage: 0.5,
        //             barThickness: 6,
        //             maxBarThickness: 8,
        //             data: [33, 10, 5, 2, 20, 30, 45],
        //             borderColor: [getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor()],
        //             backgroundColor: [getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor()]
        //         }]
        //     },
        //     options: {}
        // });

    })
</script>
