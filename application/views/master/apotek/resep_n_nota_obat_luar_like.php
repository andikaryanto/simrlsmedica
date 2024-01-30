<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Resep
            <small>#007612</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Kwitansi Pembayaran </a></li>
            <li class="active"> Pasien</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="invoice col-md-7">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-user"></i> Penjualan <?= ucwords(str_replace('_', ' ', $penjualan->tipe)); ?>
                    <small class="pull-right"><strong>Tanggal: <?= $penjualan->created_at ?></strong>
                    </small>
                </h2>
            </div>
        </div>
        <form enctype="multipart-data" method="POST" action="<?php echo base_url()?>Administrasi/nota_print">
            <input type="hidden" value="<?= $penjualan->id ?>" name="penjualan_id">
            <div class="row invoice-info">
                <div class="col-sm-12 invoice-col">
                    <?php if ($penjualan->tipe == 'resep_luar') : ?>
                        Nama Pasien: <strong><?= $penjualan->nama_pasien ?></strong><br>
                        Alamat: <strong><?= $penjualan->alamat ?></strong><br>
                        Nama Dokter: <strong><?= $penjualan->nama_dokter ?></strong><br>
                    <?php elseif ($penjualan->tipe == 'obat_internal') : ?>
                        Nama Karyawan: <strong><?= $penjualan->nama_karyawan ?></strong><br>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td colspan="7"><strong>OBAT SATUAN</strong></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><strong>Nama Obat</strong></td>
                                <td><strong>Jumlah</strong></td>
                                <td><strong>Signa</strong></td>
                                <td></td>
                            </tr>
                            <?php
                            $total_obat = 0;
                            foreach ($obat as $key => $value) { ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $value->nama ?></td>
                                    <td><?php echo $value->jumlah_satuan ?></td>
                                    <td><?php echo $value->signa_obat ?></td>
                                    <td>
                                        <a href="<?=base_url()?>Apotek/cetak_etiket_obat_luar/<?=$value->id?>" target="_blank" class="btn btn-sm btn-success">Cetak</a>
                                    </td>
                                    <td></td>
                                </tr>
                                <?php $total_obat += ($value->harga_jual*$value->jumlah_satuan);
                            } ?>
                            <tr>
                                <td colspan="7"><strong>OBAT RACIK</strong></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><strong>Nama Obat</strong></td>
                                <td><strong>Jumlah</strong></td>
                                <td><strong>Signa</strong></td>
                                <td><strong>Catatan</strong></td>
                            </tr>
                            <?php
                            $total_obatracik = 0;
                            foreach ($racikan as $key => $value) { ?>
                                <tr>
                                    <td></td>
                                    <td><?=$value->nama_racikan?></td>
                                    <td></td>
                                    <td><?=$value->signa?></td>
                                    <td><?=$value->catatan?></td>
                                </tr>
                                <?php foreach ($value->obat as $v) { ?>
                                    <tr>
                                        <td></td>
                                        <td><?= $v->nama ?></td>
                                        <td><?= $v->jumlah_satuan ?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                    $total_obatracik += ($v->harga_jual);
                                }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row no-print">
                    <div class="col-xs-12">
                        <a href="<?= base_url() ?>Administrasi/edit_obat_luar/<?php echo $penjualan->id ?>/1" class="btn btn-warning pull-right btn-space"><i class="fa fa-pencil"></i> Edit</a>
                        <a href="<?= base_url().'Apotek/sudahObatLuar/'.$penjualan->id.'/1' ?>" class="btn btn-success pull-right btn-space"><i class="fa fa-check"></i> Obat Ok</a>
                    </div>
                </div>
        </form>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
</div>
<!-- /.content -->

</div>

<script>

    function set_kembalian(){
        var total = parseInt($('#total').val());
        var bayar = parseInt($('#bayar').val());
        var kembalian = bayar-total;
        $('#kembalian').val(kembalian);

    }

    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
    })
</script>
