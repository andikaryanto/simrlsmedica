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
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-user"></i> NO. RM <?php  echo $pemeriksaan->no_rm ?>
                    <small class="pull-right"><strong>Tanggal: <?php  echo $pemeriksaan->waktu_pemeriksaan ?></strong></small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <form enctype="multipart-data" method="POST" action="<?php echo base_url()?>Administrasi/nota_print">
            <input type="hidden" value="<?php  echo $pemeriksaan->id ?>" name="pemeriksaan_id">
            <div class="row invoice-info">
                <div class="col-sm-12 invoice-col">
                    Nama Pasien : <strong><?php  echo $pemeriksaan->nama_pasien ?></strong>
                    <address>
                        Alamat : <?php  echo $pemeriksaan->alamat ?><br>
                        Usia: <?php  echo $pemeriksaan->usia ?><br>
                        Telepon: <?php  echo $pemeriksaan->telepon ?><br>

                    </address>
                </div>
                <!-- /.col -->

                <!-- /.col -->

                <!-- /.row -->

                <!-- Table row -->
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
                            if (strpos($pemeriksaan->kode, 'BPJS-') !== false) {
                                $obat = array_map(function (&$v) {
                                    $v->harga_jual = 0;
                                    return $v;
                                }, $obat->result());
                            }
                            else {
                                $obat = $obat->result();
                            }
                            foreach ($obat as $key => $value) { ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $value->nama ?><input type="hidden" name="nama_obat[]" value="<?php echo $value->nama ?>" ></td>
                                    <td><?php echo $value->jumlah_satuan ?><input type="hidden" name="jumlah_satuan[]" value="<?php echo $value->jumlah_satuan ?>" ></td>
                                    <td><?php echo $value->signa_obat ?><input type="hidden" name="signa[]" value="<?php echo $value->signa_obat ?>" ></td>
                                    <td>
                                        <a href="<?=base_url()?>Apotek/cetak_etiket/<?=$value->id?>" target="_blank" class="btn btn-sm btn-success">Cetak</a>
                                    </td>
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
                            foreach ($pemeriksaan->racikans as $key => $value) { ?>
                                <tr>
                                    <td></td>
                                    <td><?=$value->nama_racikan?></td>
                                    <td></td>
                                    <td><?=$value->signa?></td>
                                    <td><?=$value->catatan?></td>
                                </tr>
                                <?php foreach ($value->racikan as $v) { ?>
                                    <tr>
                                        <td></td>
                                        <td><?= $v->nama ?><input type="hidden" name="nama_obat_racikan[]" value="<?= $v->nama ?>" ></td>
                                        <td><?= $v->jumlah_satuan ?><input type="hidden" name="jumlah_satuan_racikan[]" value="<?= $v->jumlah_satuan ?>" ></td>
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
                    <div class="col-xs-12" style="display: flex; flex-direction: row-reverse">
                        <a href="<?= base_url().'Apotek/sudahObat/'.$pemeriksaan->id.'/1' ?>" class="btn btn-success pull-right btn-space"><i class="fa fa-check"></i> Obat Ok</a>
                        <div style="width: 4px"></div>
                        <a href="<?= base_url() ?>Apotek/editResep/<?php echo $pemeriksaan->id ?>" class="btn btn-warning pull-right btn-space"><i class="fa fa-pencil"></i> Edit</a>
                        <div style="width: 8px"></div>
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
