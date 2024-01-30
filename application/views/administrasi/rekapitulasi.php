<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Rekapitulasi Billing
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Billing</a></li>
            <li class="active"> Rekapitulasi</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Rekapitulasi Billing</h3>&nbsp;&nbsp;
                    </div>
                    <form class="form-horizontal" method="get" action="<?php echo base_url()?>Administrasi/rekapitulasi">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-7">
                                            <label class="control-label">Tanggal</label>
                                            <input type='date' name='tgl' class='form-control' id='tgl' value="<?php echo ($this->input->get('tgl'))?$this->input->get('tgl'):date('Y-m-d') ?>">
                                            <br>
                                            <button type="submit" class="btn btn-primary" style='margin-left: 0px;'>Tampilkan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
                                <th>Nama Pasien</th>
                                <th>Tipe Layanan</th>
                                <th>Jenis Layanan</th>
                                <th>Jasa Medis</th>
                                <th>Obat</th>
                                <th>Obat Racikan</th>
                                <th>Total Bayar</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no=1; foreach ($listPemeriksaan->result() as $row) { ?>
                                <tr>
                                    <td> <?php echo $no; ?></td>
                                    <td> <?php echo ucwords($row->nama_pasien); ?></td>
                                    <td> <?php echo isset($jaminan[$row->jaminan]) ? ucwords($jaminan[$row->jaminan]['label']) : ucwords('Umum'); ?></td>
                                    <td> <?php echo $row->tipe_layanan == 1 ? 'Home Visit' : 'On Site'; ?></td>
                                    <td> <?php echo ucwords($row->nama_jenis_pendaftaran); ?></td>
                                    <td>
                                        <?php $harga = 0; ?>
                                        <?php if($tindakan) : ?>
                                            <?php foreach ($tindakan->result() as $row3) : ?>
                                                <?php if($row->id == $row3->pemeriksaan_id) : ?>
                                                    <?php $harga += $row3->tarif_pasien; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?= 'Rp '.number_format($harga,2,',','.') ?>
                                    </td>
                                    <td>
                                        <?php $harga2 = 0; ?>
                                        <?php if($obat) : ?>
                                            <?php foreach ($obat->result() as $row2) : ?>
                                                <?php if($row->id == $row2->pemeriksaan_id) : ?>
                                                    <?php $harga2 += $row2->harga_jual * $row2->jumlah_satuan; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?= 'Rp '.number_format($harga2,2,',','.') ?>
                                    </td>
                                    <td>
                                        <?php $harga3 = 0; ?>
                                        <?php if($racikan) : ?>
                                            <?php foreach ($racikan->result() as $row2) : ?>
                                                <?php if($row->id == $row2->pemeriksaan_id) : ?>
                                                    <?php $harga3 += $row2->total; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?= 'Rp '.number_format($harga3,2,',','.') ?>
                                    </td>
                                    <td><?='Rp '.number_format($row->total_bayar,2,',','.')?></td>
                                    <td>
                                        <span class="pull-right-container">
                                            <small class="label pull-right bg-green">
                                            <?php
                                            echo ucwords($row->status);
                                            ?>
                                            </small>
                                        </span>
                                    </td>
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