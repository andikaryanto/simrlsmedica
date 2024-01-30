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
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Rekapitulasi Obat Bebas</h3>&nbsp;&nbsp;
                    </div>
                    <form class="form-horizontal" method="get" action="<?php echo base_url()?>apotek/rekapitulasi_obat_bebas">

                        <div class="row">
                            <div class="col-sm-4">
                                <div style="margin: 5px 10px">
                                    <label class="control-label">Waktu</label>
                                    <select class="form-control" id="jenis" name="jenis">
                                        <option value="1" <?php if (isset($jenis) && $jenis == "1") echo 'selected'?>>Hari Ini</option>
                                        <option value="2" <?php if (isset($jenis) && $jenis == "2") echo 'selected'?>>Pilih Tanggal</option>
                                        <option value="3" <?php if (isset($jenis) && $jenis == "3") echo 'selected'?>>Pilih Bulan dan Tahun</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="jenis-2" style="display: none">
                            <div class="col-sm-4">
                                <div style="margin: 5px 10px">
                                    <label class="control-label">Dari Tanggal</label>
                                    <input type='date' name='from' class='form-control' id='tanggal_dari' value="<?php echo ($this->input->get('from')) ? $this->input->get('from') : date('Y-m-01') ?>">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div style="margin: 5px 10px">
                                    <label class="control-label">Sampai Tanggal</label>
                                    <input type='date' name='to' class='form-control' id='tanggal_sampai' value="<?php echo ($this->input->get('to')) ? $this->input->get('to') : date('Y-m-d') ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row" id="jenis-3" style="display: none">
                            <div class="col-sm-4">
                                <div style="margin: 5px 10px">
                                    <label class="control-label">Bulan</label>
                                    <select class="form-control" id="bulan" name="bulan">
                                        <option value="01" <?php if (isset($bulan) && $bulan == "01") echo 'selected'?>>Januari</option>
                                        <option value="02" <?php if (isset($bulan) && $bulan == "02") echo 'selected'?>>Februari</option>
                                        <option value="03" <?php if (isset($bulan) && $bulan == "03") echo 'selected'?>>Maret</option>
                                        <option value="04" <?php if (isset($bulan) && $bulan == "04") echo 'selected'?>>April</option>
                                        <option value="05" <?php if (isset($bulan) && $bulan == "05") echo 'selected'?>>Mei</option>
                                        <option value="06" <?php if (isset($bulan) && $bulan == "06") echo 'selected'?>>Juni</option>
                                        <option value="07" <?php if (isset($bulan) && $bulan == "07") echo 'selected'?>>Juli</option>
                                        <option value="08" <?php if (isset($bulan) && $bulan == "08") echo 'selected'?>>Agustus</option>
                                        <option value="09" <?php if (isset($bulan) && $bulan == "09") echo 'selected'?>>September</option>
                                        <option value="10" <?php if (isset($bulan) && $bulan == "10") echo 'selected'?>>Oktober</option>
                                        <option value="11" <?php if (isset($bulan) && $bulan == "11") echo 'selected'?>>November</option>
                                        <option value="12" <?php if (isset($bulan) && $bulan == "12") echo 'selected'?>>Desember</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div style="margin: 5px 10px">
                                    <label class="control-label">Tahun</label>
                                    <select class="form-control" id="tahun" name="tahun">
                                        <?php $year = intval(date('Y')); for ($a = $year; $a > $year - 5; $a--) { ?>
                                            <option value="<?php echo $a?>" <?php if (isset($bulan) && $bulan == $a) echo 'selected'?>><?php echo $a?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class='row'>
                            <div class="col-sm-3">
                                <div style="margin: 15px 10px">
                                    <div class="form-group">
                                        <div class="col-sm-7">
                                            <button type="submit" class="btn btn-primary" style='margin-left: 0px;'>Tampilkan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
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
                        <table id="printable_table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Obat</th>
                                <th>Obat</th>
                                <th>Obat Racikan</th>
                                <th>Jasa Racik</th>
                                <th>Total Bayar</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no=1; foreach ($penjualan as $row) { ?>
                                <tr>
                                    <td> <?php echo $no; ?></td>
                                    <td> <?php echo $row->nama_obat; ?></td>
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
                                    <td>
                                        <span class="pull-right-container">
                                            <small class="label pull-right bg-green">
                                            <?php
                                            echo ucwords(ucwords(str_replace('_', ' ', $row->progress)));
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

<script src="<?= base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>

<script>
    $(function () {
        $('.select2').select2();

        const jenis = <?=isset($jenis) ? $jenis : -100?>;
        if (jenis === 2) {
            $('#jenis-2').css('display', 'block')
        }
        else if (jenis === 3) {
            $('#jenis-3').css('display', 'block')
        }

        $("#jenis").change(function () {

            $('#jenis-2').css('display', 'none')
            $('#jenis-3').css('display', 'none')

            if ($(this).val() === '2') {
                $('#jenis-2').css('display', 'block')
            }
            else if ($(this).val() === '3') {
                $('#jenis-3').css('display', 'block')
            }
        })
    })
</script>
