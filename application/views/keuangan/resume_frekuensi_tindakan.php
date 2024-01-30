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
            Resume Frekuensi Tindakan
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Master</a></li>
            <li class="active">Resume Frekuensi Tindakan</li>
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
                        <form class="form-horizontal" method="get" action="<?= base_url()?>Keuangan/resume_frekuensi_tindakan">

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
                                        <input type='date' name='from' class='form-control' id='tanggal_dari' value="<?= ($this->input->get('from')) ? $this->input->get('from') : date('Y-m-01') ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div style="margin: 5px 10px">
                                        <label class="control-label">Sampai Tanggal</label>
                                        <input type='date' name='to' class='form-control' id='tanggal_sampai' value="<?= ($this->input->get('to')) ? $this->input->get('to') : date('Y-m-d') ?>">
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
                                                <option value="<?= $a?>" <?php if (isset($bulan) && $bulan == $a) echo 'selected'?>><?= $a?></option>
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
                                            <?php foreach ($jenis_pendaftaran_all->result() as $key => $value) {
                                                ?>
                                                <option value="<?= $value->id ?>" <?=$poli == $value->id ? 'selected' : ''?>><?= $value->nama ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
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
                    <div class="box-body">
                        <div class="col-xs-6">
                            <div class="box-header">
                                <h3 class="box-title">Resume Frekuensi Tindakan</h3>&nbsp;&nbsp;
                            </div>
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Tindakan</th>
                                        <th>Frekuensi</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if ($list) : ?>
                                        <?php foreach ($list->result() as$k => $row) : ?>
                                            <tr>
                                                <td> <?= $k + 1; ?></td>
                                                <td> <?= $row->nama; ?></td>
                                                <td> <?= $row->frekuensi; ?></td>
                                                <td>
                                                    <button onclick="open_(<?= $row->id; ?>)" class="btn btn-sm btn-success"><i class="fa fa-arrows"></i> Detail</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td bgcolor="lightblue" colspan="4"> Data Tidak ada</td>
                                        </tr>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="box-header with-border">
                                <i class="fa fa-bar-chart-o"></i>

                                <h3 class="box-title">Diagram Resume Frekuensi Tindakan</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                                class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div id="bar-chart" style="height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<script src="<?= base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>

<script src="<?php echo base_url() ?>assets/bower_components/Flot/jquery.flot.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/Flot/jquery.flot.categories.js"></script>

<script>
    function open_(id) {
        window.open(window.location.href.replace('resume_frekuensi_tindakan', `detail_resume_frekuensi_tindakan/${id}`),"_self")
    }

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

    $(function () {
        $('#example2').DataTable({
            "pageLength": 20
        })

        const d = <?=json_encode($list->result());?>.slice(0, 10);
        const bar_data = {
            data: d.map(v => ([v.nama, v.frekuensi])),
            color: '#3cbc58'
        }
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
    })
</script>
