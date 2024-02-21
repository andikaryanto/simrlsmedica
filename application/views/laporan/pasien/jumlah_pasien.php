<link rel="stylesheet"
      href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Laporan Jumlah Pasien
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Laporan Jumlah Pasien</a></li>
            <li class="active"> Pasien</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <h5><i class='fa fa-file-text-o fa-fw'></i> Laporan Jumlah Pasien</h5>
                        <hr/>

                        <form class="form-horizontal" method="get"
                              action="<?php echo base_url() ?>Laporan/jumlahPasien">
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
                                            <label class="col-sm-4 control-label">Jenis Layanan</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="jenis_pendaftaran"
                                                        name="jenis_pendaftaran">
                                                    <option value="">-- Jenis Layanan --</option>
                                                    <?php
                                                    foreach ($jaminan as $key => $value) {
                                                        $pilih = ($value['id'] == $this->input->get('jenis_pendaftaran')) ? "selected" : "";
                                                        ?>
                                                        <option value="<?php echo $value['id'] ?>" <?php echo $pilih; ?>><?php echo ucwords($value['label']) ?></option>
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
            </div>
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="col-xs-12">
                            <div class="box-header with-border">
                                <h3 class="box-title">Data Laporan Jumlah Pasien</h3>&nbsp;&nbsp;
                            </div>
                            <div class="box-body">
                                <table id="printable_table" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no = 1;
                                    if ($jumlah_pasien) {
                                        foreach ($jumlah_pasien->result() as $row) {
                                            if ($row->nama == $tipe_pasien || $tipe_pasien == '') { ?>
                                                <tr>
                                                    <td> <?php echo $no++; ?></td>
                                                    <td> <?php echo $row->nama; ?></td>
                                                    <td> <?php echo $row->jumlah; ?></td>
                                                </tr>
                                            <?php }
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
                    </div>
                </div>
            </div>
            <div class="col-xs-12 <?=$jenis_pendaftaran ? '' : 'hidden'?>">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Laporan Jumlah Pasien</h3>&nbsp;&nbsp;
                    </div>
                    <div class="box-body">
                        <table id="" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Waktu Kunjungan</th>
                                <th>Nama Pasien</th>
                                <th>No RM</th>
                                <th>Nama Dokter</th>
                                <th>Diagnosis Jenis Penyakit</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            if ($list_jumlah_pasien) {
                                foreach ($list_jumlah_pasien as $row) { ?>
                                    <tr>
                                        <td> <?php echo $no; ?></td>
                                        <td> <?php echo DateIndo($row->waktu_pendaftaran); ?></td>
                                        <td> <?php echo ucwords($row->nama); ?></td>
                                        <td> <?php echo ucwords($row->no_rm); ?></td>
                                        <td> <?php echo ucwords($row->nama_dokter); ?></td>
                                        <td>
                                            <table style="font-size: 14px; padding: 0px 5px;">
                                                <tbody>
                                                <?php
                                                if ($row->penyakit) {
                                                    foreach ($row->penyakit as $row1) { ?>
                                                        <tr>
                                                            <td style="padding: 0px 5px;"> <?php echo $row1->nama; ?></td>
                                                            <td style="padding: 0px 5px;"> <?php echo $row1->kode; ?></td>
                                                        </tr>
                                                    <?php }
                                                } ?>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php $no++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td bgcolor="lightblue" colspan="6"> Data Tidak ada</td>
                                    <td style="display: none"></td>
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
            <div class="col-xs-12 <?=$tipe_pasien ? 'hidden' : ''?>">
                    <div class="box">
                        <div class="box-header with-border">
                            <i class="fa fa-bar-chart-o"></i>
                            <h3 class="box-title">Diagram Jumlah Pasien</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div id="bar-chart" style="height: 240px;"></div>
                        </div>
                    </div>
                </div>
        </div>
    </section>
</div>

<script>

  $(function () {
    $('#example1').DataTable()
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
    data: [<?php $i = 1; foreach ($jumlah_pasien->result() as $key => $value): ?>["<?php echo $value->nama;?>",<?php echo $value->jumlah;?>]<?php echo ($jumlah_pasien->num_rows() == $i) ? "" : "," ?><?php $i++; endforeach ?>],
    color: [
      '#74d075',
      '#dd8b66',
      '#756cbc',
      '#89e55c',
      '#db4d8b',
      '#c4ef63',
      '#c57ef1'
      ]
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