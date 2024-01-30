<link rel="stylesheet"
      href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Laporan Performa Perawat
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Laporan Performa Perawat</a></li>
            <li class="active"> Perawat</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <h5><i class='fa fa-file-text-o fa-fw'></i> Laporan Performa Perawat</h5>
                        <hr/>

                        <form class="form-horizontal" method="get"
                              action="<?php echo base_url() ?>Laporan/performaPerawat">
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
                                            <label class="col-sm-4 control-label">Jenis Pendaftaran</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="jenis_pendaftaran"
                                                        name="jenis_pendaftaran">
                                                    <option value="">-- Jenis Pendaftaran --</option>
                                                    <?php
                                                    foreach ($listjenispendaftaran->result() as $key => $value) {
                                                        $pilih = ($value->id == $this->input->get('jenis_pendaftaran')) ? "selected" : "";
                                                        ?>
                                                        <option value="<?php echo $value->id ?>" <?php echo $pilih; ?>><?php echo ucwords($value->nama) ?></option>
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
                            <div class="col-xs-<?=$jenis_pendaftaran ? '6' : '12'?>">
                                <div class="box-header">
                                    <h3 class="box-title">Data Performa Perawat</h3>&nbsp;&nbsp;
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
                                            <th>Nama</th>
                                            <th>Poli</th>
                                            <th>Jumlah</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $no = 1;
                                        if ($performa_perawat) {
                                            foreach ($performa_perawat->result() as $row) { ?>
                                                <tr>
                                                    <td> <?php echo $no; ?></td>
                                                    <td> <?php echo $row->nama_perawat; ?></td>
                                                    <td> <?php echo $row->nama; ?></td>
                                                    <td> <?php echo $row->jumlah; ?></td>
                                                </tr>
                                                <?php $no++;
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
                            <div class="col-xs-6 <?=$jenis_pendaftaran ? '' : 'hidden'?>">
                                <div class="box-header with-border">
                                    <i class="fa fa-bar-chart-o"></i>

                                    <h3 class="box-title">Diagram Jumlah Performa Perawat</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                                class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div id="bar-chart" style="height: 400px;"></div>
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

<script type="text/javascript">
    /*
      * BAR CHART
      * ---------
      */

    var bar_data = {
        data: [<?php $i = 1; foreach ($performa_perawat->result() as $key => $value): ?>["<?php echo $value->nama_perawat;?>",<?php echo $value->jumlah;?>]<?php echo ($performa_perawat->num_rows() == $i) ? "" : "," ?><?php $i++; endforeach ?>],
        color: '#3c8dbc'
    }
    $.plot('#bar-chart', [bar_data], {
        grid: {
            borderWidth: 1,
            borderColor: '#f3f3f3',
            tickColor: '#f3f3f3'
        },
        series: {
            bars: {
                show: true,
                barWidth: 0.5,
                align: 'center'
            }
        },
        xaxis: {
            mode: 'categories',
            tickLength: 0
        }
    })
    /* END BAR CHART */
</script>
