<link rel="stylesheet"
      href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Laporan Pasien Top 20
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Laporan Jumlah Pasien Top 20 </a></li>
            <li class="active"> Pasien Top 20</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <h5><i class='fa fa-file-text-o fa-fw'></i> Laporan Jumlah Pasien Top 20 </h5>
                        <hr/>

                        <form class="form-horizontal" method="get"
                              action="<?php echo base_url() ?>Laporan/jumlahPasien20">
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
                        </from>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Laporan Jumlah Pasien</h3>&nbsp;&nbsp;
                        </div>
                        <div class="box-body">
                            <table id="printable_table" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pasien</th>
                                    <th>No RM</th>
                                    <th>Tipe Pasien</th>
                                    <th>Total Kunjungan</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $no = 1;
                                if ($list_jumlah_pasien20) {
                                    foreach ($list_jumlah_pasien20 as $row) { ?>
                                        <tr>
                                            <td> <?php echo $no; ?></td>
                                            <td> <?php echo ucwords($row->nama); ?></td>
                                            <td> <?php echo ucwords($row->no_rm); ?></td>
                                            <td> <?php echo ucwords($row->jaminan); ?></td>
                                            <td> <?php echo ucwords($row->total); ?></td>
                                        </tr>
                                        <?php $no++;
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td bgcolor="lightblue" colspan="5"> Data Tidak ada</td>
                                        <td style="display: none"></td>
                                        <td style="display: none"></td>
                                        <td style="display: none"></td>
                                        <td style="display: none"></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
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
