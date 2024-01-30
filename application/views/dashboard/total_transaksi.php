<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?=$title?>
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Billing</a></li>
            <li class="active"> <?=$title?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <form class="form-horizontal" method="get" action="<?php echo base_url()."Dashboard/totalTransaksi/$id_poli" ?>">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Dari Tanggal</label>
                                            <div class="col-sm-8">
                                                <input type='date' name='from' class='form-control' id='tanggal_dari'
                                                       min="<?=date("Y-m").'-01'?>" max="<?=date("Y-m-t")?>"
                                                       value="<?php echo ($this->input->get('from')) ? $this->input->get('from') : date('Y-m-01') ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Sampai Tanggal</label>
                                            <div class="col-sm-8">
                                                <input type='date' name='to' class='form-control' id='tanggal_sampai'
                                                       min="<?=date("Y-m").'-01'?>" max="<?=date("Y-m-t")?>"
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
                                                <button type="submit" class="btn btn-primary" style='margin-left: 0px;'>Tampilkan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title"><?=$title?></h3>&nbsp;&nbsp;

                    </div>
                    <!-- /.box-header -->
                    <?php $warning = $this->session->flashdata('warning');
                    if (!empty($warning)){ ?>
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                            <?php echo $warning ?>
                        </div>
                    <?php } ?>
                    <?php $success = $this->session->flashdata('success');
                    if (!empty($success)){ ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-success"></i> Success!</h4>
                            <?php echo $success ?>
                        </div>
                    <?php } ?>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>NO RM</th>
                                <th>Tgl Periksa</th>
                                <th>Nama Pasien</th>
                                <th>Jenis Pendaftaran</th>
                                <th>Poli</th>
                                <th>Jasa Medis</th>
                                <th>Obat</th>
                                <th>Obat Racikan</th>
                                <th>Jasa Racik</th>
                                <th>Bahan Habis Pakai</th>
                                <th>Total Bayar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $t = 0; $no=1; foreach ($list as $row) { ?>
                                <tr>
                                    <td> <?php echo $no; ?></td>
                                    <td style="width: 100px;">
                                      <?php echo $row->no_rm; ?><br>
                                      <small>
                                        <span class="label <?=$jaminan[$row->jaminan]['class']?>"><?=$jaminan[$row->jaminan]['label']?></span>
                                        <?php if (!isset($jaminan[$row->jaminan])) { ?>
                                        <span class="label label-warning">Umum</span>
                                        <?php } ?>
                                      </small>
                                    </td>
                                    <td> <?php echo $row->waktu_pemeriksaan; ?></td>
                                    <td> <?php echo ucwords($row->nama_pasien); ?></td>
                                    <td> <?php echo isset($jaminan[$row->jaminan]) ? ucwords($jaminan[$row->jaminan]['label']) : ucwords('Umum'); ?></td>
                                    <td> <?php echo ucwords($row->nama_jenis_pendaftaran); ?></td>
                                    <td> <?= 'Rp '.number_format($row->biaya_tindakan,2,',','.') ?></td>
                                    <td> <?= 'Rp '.number_format($row->biaya_obat,2,',','.') ?></td>
                                    <td> <?= 'Rp '.number_format($row->biaya_obat_racikan,2,',','.') ?></td>
                                    <td> <?= 'Rp '.number_format($row->biaya_jasa_racik,2,',','.') ?></td>
                                    <td> <?= 'Rp '.number_format($row->biaya_bahan_habis_pakai,2,',','.') ?></td>
                                    <td> <?='Rp '.number_format($row->total_bayar,2,',','.')?></td>
                                </tr>
                                <?php $t += $row->total_bayar; $no++; } ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Total</th>
                                <th> <?='Rp '.number_format($t,2,',','.')?></th>
                            </tr>
                            </tfoot>
                        </table>
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
    })
</script>
