<link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<style>
    hr {
        margin-top: 0 !important;
        margin-bottom: 15px !important;
    }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Resume Pemasukan
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Master</a></li>
            <li class="active">Resume Pemasukan</li>
        </ol>
    </section>

    <section class="content">
        <!--Jasa Medis-->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Filter</h3>&nbsp;&nbsp;
                    </div>
                    <div class="box-body">
                        <form class="form-horizontal" method="get" action="<?php echo base_url()?>Keuangan/resume_pemasukan_">

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

                            <div class="row">
                                <div class="col-sm-4">
                                    <div style="margin: 5px 10px">
                                        <label class="control-label">Poli</label>
                                        <select class="form-control" id="poli" name="poli">
                                            <option value="">--Semua Poli--</option>
                                            <?php foreach ($jenis_pendaftaran_all as $key => $value) {
                                                ?>
                                                <option value="<?php echo $value->id ?>" <?=$poli == $value->id ? 'selected' : ''?>><?php echo $value->nama ?></option>
                                            <?php } ?>
                                            <option value="konsumsi" <?=$poli == 'konsumsi' ? 'selected' : ''?>>Konsumsi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row no-konsumsi">
                                <div class="col-sm-4">
                                    <div style="margin: 5px 10px">
                                        <label id="lbl-tdk" class="control-label">Tindakan</label>
                                        <select class="form-control select2" id="tindakan" name="tindakan[]" multiple data-placeholder="--Semua Tindakan--">
                                            <?php
                                            $the_tindakan = $tindakan_lab_all_merge;
                                            if ($poli) {
                                                if ($poli == 62)
                                                    $the_tindakan = $tindakan_lab_all;
                                                else
                                                    $the_tindakan = $tindakan_all;
                                            }
                                            ?>
                                            <?php foreach ($the_tindakan as $key => $value) { ?>
                                                <?php
                                                $ada = false;
                                                foreach ($tindakan as $v) {
                                                    if ($v == $value->id) {
                                                        $ada = true;
                                                        break;
                                                    }
                                                }
                                                ?>
                                                <option value="<?php echo $value->id ?>" <?=$ada ? 'selected' : ''?>><?php echo $value->nama ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row no-konsumsi">
                                <div class="col-sm-4">
                                    <div style="margin: 5px 10px">
                                        <label class="control-label">Jenis Pendaftaran</label>
                                        <select class="form-control" id="jenis_pendaftaran" name="jenis_pendaftaran">
                                            <option value="">--Semua Jenis Pendaftaran--</option>
                                            <?php foreach ($jaminan as $key => $value) { ?>
                                                <option value="<?= $key ?>" <?=$jenis_pendaftaran == $key ? 'selected' : ''?>><?= $value['label'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row no-konsumsi">
                                <div class="col-sm-4">
                                    <div style="margin: 5px 10px">
                                        <label class="control-label">Dokter</label>
                                        <select class="form-control" id="dokter" name="dokter">
                                            <option value="">--Semua Dokter--</option>
                                            <?php foreach ($dokter_all->result() as $key => $value) { ?>
                                                <option value="<?php echo $value->id ?>" <?=$dokter == $value->id ? 'selected' : ''?>><?php echo $value->nama?></option>
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
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Jasa Medis</h3>&nbsp;&nbsp;
                    </div>
                    <div class="box-header">
                        <div class="panel panel-danger">
                            <div class="panel-heading"><h4><b>DISCLAIMER</b></h4></div>
                            <div class="panel-body">DATA YANG DITAMPILKAN TIDAK TERMASUK DISKON YANG DIBERIKAN.</div>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="printable_table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl Bayar</th>
                                <th>Pasien</th>
                                <th>Jenis Dftr</th>
                                <th>Dokter</th>
                                <th>Poli</th>
                                <th>Item</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Sub Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no=1;
                            $subtotal = 0;
                            foreach ($jasa_medis as $row) { ?>
                                <tr>
                                    <td><?=$no?></td>
                                    <td><?=date('d-M-Y H:i', strtotime($row->created_at))?></td>
                                    <td><?=ucwords($row->nama_pasien)?></td>
                                    <td><?=$jaminan[$row->jaminan]['label']?></td>
                                    <td><?=ucwords($row->nama_dokter)?></td>
                                    <td><?=ucwords($row->nama_poli)?></td>
                                    <td><?=ucwords($row->item)?></td>
                                    <td><?=$row->jumlah?></td>
                                    <td align="right"><?= number_format($row->harga,2,',','.')?></td>
                                    <td align="right"><?= number_format($row->subtotal,2,',','.')?></td>
                                </tr>
                                <?php
                                $subtotal = $subtotal + $row->subtotal;
                                $no++; } ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="9" align="right"><strong>Total Pemasukan Jasa Medis : </strong></td>
                                <td align="right"><strong><?= number_format($subtotal,2,',','.')?></strong></td>
                            </tr>
                            </tfoot>
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

        const tindakan_all = <?=json_encode($tindakan_all)?>;
        const tindakan_lab_all = <?=json_encode($tindakan_lab_all)?>;
        const tindakan_lab_all_merge = <?=json_encode($tindakan_lab_all_merge)?>;
        const kode_poli = <?=json_encode($kode_poli);?>;
        const jenis_pendaftaran = <?=json_encode($jenis_pendaftaran_all);?>;
        const get_kategori = kode => {
            for (const key in kode_poli) {
                for (const kode_ of kode_poli[key].kode) {
                    if (kode_ === kode) {
                        return key
                    }
                }
            }
        }

        if ('<?=$poli?>' === 'konsumsi') {
            $('.no-konsumsi').css('display', 'none')
        }

        $('#poli').change(function () {
            $('#lbl-tdk').html(`Tindakan <i>Sedang memuat...</i>`)
            $('.no-konsumsi').css('display', 'block')
            $('#tindakan').find('option').remove()

            if ($(this).val()) {
                if ($(this).val() === 'konsumsi') {
                    $('.no-konsumsi').css('display', 'none')
                }
                else if (parseInt($(this).val()) === 62) {
                    tindakan_lab_all.forEach(v => $('#tindakan').append(`<option value="${v.id}">${v.nama}</option>`))
                }
                else if ($(this).val().startsWith('ri-')) {
                    const kode = jenis_pendaftaran.find(v => v.id === $(this).val()).kode ?? ''
                    tindakan_all
                        .filter(v => v.category === kode)
                        .forEach(v => $('#tindakan').append(`<option value="${v.id}">${v.nama}</option>`))
                }
                else {
                    const kode = jenis_pendaftaran.find(v => parseInt(v.id) === parseInt($(this).val())).kode ?? ''
                    let cat = get_kategori(kode)
                    if (cat) {
                        tindakan_all
                            .filter(v => v.category === cat)
                            .forEach(v => $('#tindakan').append(`<option value="${v.id}">${v.nama}</option>`))
                    }
                }
            }
            else {
                tindakan_lab_all_merge.forEach(v => $('#tindakan').append(`<option value="${v.id}">${v.nama}</option>`))
            }

            $('#lbl-tdk').html(`Tindakan`)
        })
    })

    $(function () {
        $('#example1').DataTable()
        // $('#example2').DataTable({
        //     rowReorder: {
        //         selector: 'td:nth-child(2)'
        //     },
        //     'paging'      : true,
        //     'lengthChange': true,
        //     'searching'   : true,
        //     'ordering'    : true,
        //     'info'        : true,
        //     'autoWidth'   : true
        // })
    })
</script>
