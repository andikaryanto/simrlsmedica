<link rel="stylesheet"
      href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Laporan Rata - Rata Kunjungan
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Laporan Rata - Rata Kunjungan </a></li>
            <li class="active">Rata - Rata Kunjungan</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <h5><i class='fa fa-file-text-o fa-fw'></i> Laporan Rata - Rata Kunjungan </h5>
                        <hr/>
                        <form class="form-horizontal" method="get" action="<?php echo base_url() ?>Laporan/rata2Kunjungan">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Dari Tanggal</label>
                                            <div class="col-sm-8">
                                                <input type='date' name='from' class='form-control' id='tanggal_dari'
                                                       value="<?php echo ($this->input->get('from')) ? $this->input->get('from') : date('Y-m-d') ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Sampai Tanggal</label>
                                            <div class="col-sm-8">
                                                <input type='date' name='to' class='form-control' id='tanggal_sampai'
                                                       value="<?php echo ($this->input->get('to')) ? $this->input->get('to') : date('Y-m-d') ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Tipe Pasien</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="tipe_pasien"
                                                        name="tipe_pasien">
                                                    <option value="">-- Tipe Pasien --</option>
                                                    <?php
                                                    foreach ($jaminan as $key => $value) {
                                                        $pilih = ($key == $this->input->get('tipe_pasien')) ? "selected" : "";
                                                        ?>
                                                        <option value="<?php echo $key ?>" <?php echo $pilih; ?>><?php echo ucwords($value['label']) ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="col-sm-3">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col-sm-4"></div>
                                            <div class="col-sm-8">
                                                <button type="submit" class="btn btn-primary" style='margin-left: 0px;'>
                                                    Tampilkan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="col-xs-<?=$jenis_pendaftaran ? '12' : '6'?>">
                                <div class="box-header">
                                    <h3 class="box-title">Data Laporan Jumlah Pasien Baru</h3>&nbsp;&nbsp;
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
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Keterangan</th>
                                            <th>Rata-rata</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $no = 1;
                                        if ($res) {
                                            foreach ($res as $row) {
                                                if ($row['nama'] == $tipe_pasien || $tipe_pasien == '') { ?>
                                                    <tr>
                                                        <td> <?php echo $no; ?></td>
                                                        <td> <?php echo $row['nama']; ?></td>
                                                        <td> <?php echo $row['rata_rata']; ?></td>
                                                    </tr>
                                                <?php }
                                                $no++;
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td bgcolor="lightblue" colspan="3"> Data Tidak ada</td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-xs-6 <?=$jenis_pendaftaran ? 'hidden' : ''?>">
                                <div class="box-header with-border">
                                    <i class="fa fa-bar-chart-o"></i>

                                    <h3 class="box-title">Diagram Jumlah Pasien Baru</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                                class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <canvas id="myChart1" width="100%"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>

    $(function () {
        $('#example1').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        });
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })


</script>
<script src="<?php echo base_url() ?>assets/bower_components/Flot/jquery.flot.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/Flot/jquery.flot.categories.js"></script>

<?php
$label = array();
$data = array();
foreach ($res as $item) {
    $label[] = $item['nama'];
    $data[] = (int)$item['rata_rata'];
}
?>

<script type="text/javascript">
    var ctx1 = document.getElementById('myChart1').getContext('2d');
    console.log(<?=json_encode($label)?>);
    console.log(<?=json_encode($data)?>);
    var myChart1 = new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: <?=json_encode($label)?>,
            datasets: [{
                label: '# of Votes',
                data: <?=json_encode($data)?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.9)',
                    'rgba(54, 162, 235, 0.9)',
                    'rgba(255, 206, 86, 0.9)',
                    'rgba(75, 192, 192, 0.9)',
                    'rgba(153, 102, 255, 0.9)',
                    'rgba(255, 159, 64, 0.9)',
                    'rgba(125,255,140,0.9)',
                    'rgba(255,79,74,0.9)',
                    'rgba(127,142,255,0.9)',
                    'rgba(21,255,228,0.9)',
                    'rgba(75,140,46,0.9)',
                    'rgba(248,129,255,0.9)',
                    'rgba(63,58,149,0.9)',
                    'rgba(148,159,46,0.9)',
                    'rgba(255,95,42,0.9)',
                    'rgba(182,255,218,0.9)',
                    'rgba(117,13,132,0.9)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 0)',
                    'rgba(54, 162, 235, 0)',
                    'rgba(255, 206, 86, 0)',
                    'rgba(75, 192, 192, 0)',
                    'rgba(153, 102, 255, 0)',
                    'rgba(255, 159, 64, 0)',
                    'rgba(125,255,140,0)',
                    'rgba(255,79,74,0)',
                    'rgba(127,142,255,0)',
                    'rgba(21,255,228,0)',
                    'rgba(75,140,46,0)',
                    'rgba(248,129,255,0)',
                    'rgba(63,58,149,0)',
                    'rgba(148,159,46,0)',
                    'rgba(255,95,42,0)',
                    'rgba(182,255,218,0)',
                    'rgba(117,13,132,0)'
                ],
                borderWidth: 1
            }]
        }
    });
</script>
