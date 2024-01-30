<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Rekapitulasi Obat Bebas
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Billing</a></li>
            <li class="active"> Rekapitulasi Obat Bebas</li>
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
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Rekapitulasi Obat Bebas</h3>&nbsp;&nbsp;
                    </div>
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
                                <th>Tgl Pembelian</th>
                                <th>Obat</th>
                                <th>Obat Racikan</th>
                                <th>Jasa Racik</th>
                                <th>Total Bayar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no=1; foreach ($list as $row) { ?>
                                <tr>
                                    <td> <?php echo $no; ?></td>
                                    <td> <?php echo $row->created_at; ?></td>
                                    <td>
                                        <?php $harga2 = 0; ?>
                                        <?php if($obat) : ?>
                                            <?php foreach ($obat as $row2) : ?>
                                                <?php if($row->id == $row2->penjualan_obat_luar_id) : ?>
                                                    <?php $harga2 += $row2->harga_jual * $row2->jumlah_satuan; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?= 'Rp '.number_format($harga2,2,',','.') ?>
                                    </td>
                                    <td>
                                        <?php $harga3 = 0; ?>
                                        <?php if($racikan) : ?>
                                            <?php foreach ($racikan as $row2) : ?>
                                                <?php if($row->id == $row2->penjualan_obat_luar_id) : ?>
                                                    <?php $harga3 += $row2->total; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?= 'Rp '.number_format($harga3,2,',','.') ?>
                                    </td>
                                    <td><?='Rp '.number_format($row->jasa_racik,2,',','.')?></td>
                                    <td><?='Rp '.number_format($row->total,2,',','.')?></td>
                                </tr>
                                <?php $no++; } ?>
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
