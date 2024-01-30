<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Laporan Resep Luar
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Laporan Resep Luar</a></li>
            <li class="active"> Pasien</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <h5><i class='fa fa-file-text-o fa-fw'></i> Laporan Resep Luar</h5>
                        <hr/>

                        <form class="form-horizontal" method="get" action="<?php echo base_url() ?>Laporan/obat_resep_luar">
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
                            <div class="col-xs-6">
                                <div class="box-header">
                                    <div class="col-sm-8">
                                        <h3 class="box-title">Data Resep Obat Luar</h3>&nbsp;&nbsp;
                                    </div>
                                    <div class="col-sm-2 pull-right">
                                        <form class="form-horizontal" method="post" action="<?php echo base_url()?>export/laporan/obat_resep_luar">
                                            <input type="hidden" name="from" value="<?php echo ($this->input->get('from')) ? $this->input->get('from') : '' ?>">
                                            <input type="hidden" name="to" value="<?php echo ($this->input->get('to')) ? $this->input->get('to') : '' ?>">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Export Excel</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- /.box-header -->
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
                                            <th>Jumlah</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $no = 1;
                                        if ($obat) {
                                            foreach ($obat as $row) { ?>

                                                <tr>
                                                    <td> <?php echo $no; ?></td>

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
                            <div class="col-xs-6">
                                <div class="box-header with-border">
                                    <i class="fa fa-bar-chart-o"></i>

                                    <h3 class="box-title">Diagram Resep Luar</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                                class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div id="bar-chart" style="height: 500px;"></div>
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
        $('#example1').DataTable();
        $('#example2').DataTable({
            'paging': false,
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
    var bar_data = {
        data: [<?php $i = 1; foreach ($obat as $key => $value): ?>["<?php echo $value->nama;?>",<?php echo $value->jumlah;?>]<?php echo (sizeof($obat) == $i) ? "" : "," ?><?php $i++; endforeach ?>],
        color: '#3c8dbc'
    };
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
