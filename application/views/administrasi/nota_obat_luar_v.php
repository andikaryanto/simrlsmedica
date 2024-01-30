<link rel="stylesheet"
      href="<?= base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Kwitansi
            <small>#007612</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Kwitansi Pembayaran </a></li>
            <li class="active"> Pasien</li>
        </ol>
    </section>
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
    <section class="invoice col-md-6">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-user"></i> Penjualan <?= ucwords(str_replace('_', ' ', $penjualan->tipe)); ?>
                    <small class="pull-right"><strong>Tanggal: <?= $penjualan->created_at ?></strong>
                    </small>
                </h2>
            </div>
        </div>
        <form enctype="multipart-data" method="POST" action="<?= base_url() ?>Administrasi/nota_obat_luar_submit">
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
                                <td><strong>OBAT</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php
                            $total_obat = 0;
                            foreach ($obat as $key => $value) { ?>
                                <tr>
                                    <td></td>
                                    <td><?= $value->nama ?><input type="hidden" name="nama_obat[]" value="<?= $value->nama ?>"></td>
                                    <td><?= $value->jumlah_satuan ?><input type="hidden" name="jumlah_satuan[]" value="<?= $value->jumlah_satuan ?>"></td>
                                    <td align="right"><?= number_format($value->harga_jual, 2, ',', '.'); ?>
                                        <input type="hidden" name="harga_jual[]" value="<?= $value->harga_jual ?>">
                                    </td>
                                    <td align="right"><?= number_format($value->harga_jual * $value->jumlah_satuan, 2, ',', '.'); ?>
                                        <input type="hidden" name="subtotal_obat[]" value="<?= $value->harga_jual * $value->jumlah_satuan; ?>">
                                    </td>
                                </tr>
                                <?php $total_obat += ($value->harga_jual * $value->jumlah_satuan);
                            } ?>
                            <tr>
                                <td><strong>OBAT RACIK</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php
                            $total_obatracik = 0;
                            foreach ($racikan as $key => $value) { ?>
                                <tr>
                                    <td><?= $value->nama_racikan ?><input type="hidden" name="nama_racikan[]" value="<?= $value->nama_racikan ?>"></td>
                                    <td><?= 'Signa: '.$value->signa ?></td>
                                    <td></td>
                                    <td></td>
                                    <td align="right"><?= number_format($value->total, 2, ',', '.'); ?>
                                        <input type="hidden" name="total_racikan[]" value="<?= $value->total; ?>">
                                    </td>
                                </tr>
                                <?php foreach ($value->obat as $k => $v) { ?>
                                    <tr>
                                        <td></td>
                                        <td><?= $v->nama ?></td>
                                        <td><?= $v->jumlah_satuan ?></td>
                                        <td align="right"><?= number_format($v->harga_jual, 2, ',', '.'); ?></td>
                                        <td align="right"><?= number_format($v->harga_jual * $v->jumlah_satuan, 2, ',', '.'); ?></td>
                                    </tr>
                                <?php } ?>
                                <?php $total_obatracik += ($value->total); ?>
                            <?php } ?>
                            <tr>
                                <td><strong>JUMLAH<strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <!-- <td align="right"><strong><?php // echo number_format($total_tindakan + $total_obat+ $total_obatracik,2,',','.'); ?></strong></td> -->
                                    <input type="text" style="text-align: right;" autocomplete="off"
                                           class="form-control" id="jumlah" name="jumlah"
                                           value="<?php
                                           if ($pembayaran_result) echo $pembayaran_result['jumlah'];
                                           else echo $total_tindakan + $total_obat + $total_obatracik + $total_bahan;
                                           ?>"
                                           readonly>
                                    <input type="hidden" id="tindakan_n_obat_n_obat_racik"
                                           name="tindakan_n_obat_n_obat_racik"
                                           value="<?php
                                           if ($pembayaran_result) echo $pembayaran_result['jumlah'];
                                           else echo $total_tindakan + $total_obat + $total_obatracik + $total_bahan;
                                           ?>">
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Diskon<strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td align="right"><input type="text" style="text-align: right;" autocomplete="off"
                                                         class="form-control" id="diskon" name="diskon"
                                        <?= $pembayaran_result ? ' value="'.$pembayaran_result['diskon'].'" readonly ' : '' ?>
                                                         onkeyup="set_total();"></td>
                            </tr>
                            <tr>
                                <td><strong>TOTAL<strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td align="right"><input type="text" style="text-align: right;" autocomplete="off"
                                        <?= $pembayaran_result ? ' value="'.$pembayaran_result['total'].'" readonly ' : '' ?>
                                                         class="form-control" id="total" name="total"></td>
                            </tr>
                            <tr>
                                <td><strong>Bayar<strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td align="right"><input type="text" style="text-align: right;" autocomplete="off"
                                                         class="form-control" id="bayar" name="bayar"
                                        <?= $pembayaran_result ? ' value="'.$pembayaran_result['bayar'].'" readonly ' : '' ?>
                                                         onkeyup="set_kembalian();"></td>
                            </tr>
                            <tr>
                                <td><strong>Kembalian<strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td align="right"><input style="text-align: right;" type="text" class="form-control"
                                        <?= $pembayaran_result ? ' value="'.$pembayaran_result['kembalian'].'" readonly ' : '' ?>
                                                         id="kembalian" name="kembalian"></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row no-print">
                    <div class="col-xs-12">
                        <a href="<?=base_url().'Administrasi/listPasienSelesaiPeriksa/'?>" class="btn btn-default" style="margin: 3px;">
                            <i class="fa fa-back"></i>
                            Kembali
                        </a>
                        <button type="submit" class="btn <?=$id_bayar ? 'btn-disabled' : 'btn-success'?> pull-right" style="margin: 3px;" <?=$id_bayar ? 'disabled' : ''?>>
                            <i class="fa fa-credit-card"></i>
                            Submit Pembayaran
                        </button>
                        <a id="bprint" <?= $id_bayar ? 'href="'.base_url().'Administrasi/nota_obat_luar_print/'.$id_bayar.'"' : '' ?>
                           class="btn <?=$id_bayar ? 'btn-primary' : 'btn-disabled'?> pull-right"
                           style="margin: 3px;"
                           target="_blank"
                           rel="noopener noreferrer">
                            <i class="fa fa-print"></i>
                            Cetak Pembayaran
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <div class="clearfix"></div>
</div>

<script>

    $(function () {
        set_total();

        $('#bprint').on('click', function (e) {
            var id = <?=$id_bayar ? 1 : 0?>;
            if (!id) {
                e.preventDefault();
                alert('Silahkan submit pembayaran terlebih dahulu');
            }
        });
    });

    function set_jumlah() {
        var jasa_racik = parseInt($('#jasa_racik').val());
        if (isNaN(jasa_racik)) {
            jasa_racik = 0;
        }
        var tindakan_n_obat_n_obat_racik = parseInt($('#tindakan_n_obat_n_obat_racik').val());
        if (isNaN(tindakan_n_obat_n_obat_racik)) {
            jumlah = 0;
        }
        $('#jumlah').val(jasa_racik + tindakan_n_obat_n_obat_racik);
        set_total();
    }

    function set_total() {
        var jumlah = parseInt($('#jumlah').val());
        if (isNaN(jumlah)) {
            jumlah = 0;
        }
        var diskon = parseInt($('#diskon').val());
        if (isNaN(diskon)) {
            diskon = 0;
        }
        var total = jumlah - diskon;
        $('#total').val(total);

        set_kembalian();
    }

    function set_kembalian() {
        var total = parseInt($('#total').val());
        var bayar = parseInt($('#bayar').val());
        var kembalian = bayar - total;

        if (!isNaN(kembalian)) {
            $('#kembalian').val(kembalian);
        }
    }

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