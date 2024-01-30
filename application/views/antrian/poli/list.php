<link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/autocomplete/style-gue.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Antrian Poli
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"> Antrian Poli</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-sm-12 col-md-5 col-lg-4">
                <div class="box box-success">
                    <div class="box-header text-center">
                        <h4>Antrian Poli</h4>
                        <hr>
                        <div style="height: 40px"></div>
                        <h3>Antrian Dipanggil</h3>
                        <h1 style="font-size: 49px" id="ant-kode"><b><?=$last_called->kode_antrian?></b></h1>
                        <h4 style="margin-top: 40px" id="ant-poli"><b><?=$last_called->nama_poli?></b></h4>
                        <?php if ($last_called->nama_dokter) : ?>
                            <h4 style="margin-top: 8px" id="ant-dokter"><b><?=$last_called->nama_dokter?></b></h4>
                        <?php endif; ?>
                        <div style="height: 40px"></div>
                        <hr>
                        <h5 id="ant-pasien"><b><?=$last_called->nama_pasien?></b><?=$last_called->no_rm ? " <i>($last_called->no_rm)</i>" : ''?></h5>
                        <h5 id="ant-nik"><b>NIK :</b> <?=$last_called->nik ?? '-'?></h5>
                    </div>
                    <div class="box-footer text-center">
                        <button class="btn btn-success btn-sm" onclick="recall()">
                            <i class="fa fa-volume-up"></i> Panggil Ulang
                        </button>
                        <button onclick="tdk_hadir()" class="btn btn-danger btn-sm" id="b-tdk-hadir" data-url="<?=base_url()?>/AntrianPoli/tidak_hadir/<?=$last_called->id?>">
                            <i class="fa fa-close"></i> Tidak Hadir / Hapus Antrian
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-7 col-lg-8">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">Daftar Antrian Poli</h3>
                    </div>
                    <div class="box-body">
                        <table class="example2 table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Poli</th>
                                <th>Antrian Terpanggil</th>
                                <th>Sisa Antrian</th>
                                <th>Total Antrian</th>
<!--                                <th>Sisa Kuota Non JKN</th>-->
<!--                                <th>Sisa Kuota JKN</th>-->
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($jenis_pendaftaran as $k => $v) : ?>
                                <tr>
                                    <td><?=$k + 1?></td>
                                    <td><?=$v->nama?></td>
                                    <td id="ant-<?=$v->id?>-kode"><?=$v->last->kode_antrian?></td>
                                    <td><?=$v->sisa_antrian?></td>
                                    <td><?=$v->total_antrian?></td>
<!--                                    <td>--><?//=$v->sisa_kuota_non_jkn?><!--/--><?//=$v->kuota_non_jkn?><!--</td>-->
<!--                                    <td>--><?//=$v->sisa_kuota_jkn?><!--/--><?//=$v->kuota_jkn?><!--</td>-->
                                    <td>
                                        <button class="btn btn-sm btn-success" onclick="panggil(<?=$v->id?>)" <?=$v->can_call_next ? '' : 'disabled'?>>
                                            <i class="fa fa-volume-up"></i> Panggil Selanjutnya
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box box-success">
                    <div class="box-body">
                        <table class="example2 table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Waktu Ambil Antrian</th>
                                <th>No Antrian</th>
                                <th>Pasien</th>
                                <th>Poli</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($list as $k => $v) : ?>
                            <tr>
                                <td><?=$k + 1?></td>
                                <td><?=date('d-M-Y H:i', strtotime($v->created_at))?></td>
                                <td><?=$v->kode_antrian?></td>
                                <td><?=$v->nama_pasien?></td>
                                <td><?=$v->nama_poli?><br><?=$v->nama_dokter?></td>
                                <td>
                                    <!--
                                    <?php if ($k == 0) : ?>
                                        <button class="btn btn-sm btn-success" onclick="layani(<?=$v->id?>)">
                                            <i class="fa fa-volume-up"></i> Panggil
                                        </button>
                                    <?php endif; ?>
                                    -->
<!--                                    <a target="_blank" href="--><?//=base_url()?><!--/AntrianFrontOffice/print/--><?//=$v->no_antrian?><!--" class="btn btn-sm btn-primary">-->
<!--                                        <i class="fa fa-print"></i> Print-->
<!--                                    </a>-->
                                    <a href="<?=base_url()?>/AntrianPoli/tidak_hadir/<?=$v->id?>"
                                       onclick="return confirm('Yakin hapus no antrian <?=$v->no_antrian?>?')"
                                       class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash-o"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    const jenis_pendaftaran = <?=json_encode($jenis_pendaftaran)?>;

    let speech = new SpeechSynthesisUtterance();
    speech.lang = "id";
    speech.rate = 0.8

    $(function () {
        let kode = '<?=$last_called->kode_antrian ?? ''?>'.split('-')
        kode = `${kode[0]}...${kode[1].split('').join('..')}`
        speech.text = `Nomor antrian.... ${kode}.... Silahkan ke <?=$last_called->nama_poli?>`
    })

    function panggil(id) {
        const v = jenis_pendaftaran.find(v => +v.id === +id)
        if (v && v.next) {
            const n = v.next
            let kode = n.kode_antrian.split('-')
            kode = `${kode[0]}...${kode[1].split('').join('..')}`
            speech.text = `Nomor antrian.... ${kode}.... Silahkan ke ${n.nama_poli}`
            window.speechSynthesis.speak(speech)

            $(`#ant-${id}-kode`).html(n.kode_antrian)
            $('#ant-kode').html(`<b>${n.kode_antrian}</b>`)
            $('#ant-poli').html(`<b>${n.nama_poli}</b>`)
            $('#ant-dokter').html(`<b>${n.nama_dokter}</b>`)
            $('#ant-pasien').html(`<b>${n.nama_pasien}</b> ${n.no_rm ? `<i>(${n.no_rm})</i>` : ''}`)
            $('#ant-nik').html(`<b>NIK :</b> ${n.nik ?? ''}`)
            $('#b-tdk-hadir').data('url', `<?=base_url()?>/AntrianPoli/tidak_hadir/${n.id}`)

            $.ajax({url: `<?=base_url()?>/AntrianPoli/call_next/${n.id}`}).done(function() { })
        }
    }

    function recall() {
        window.speechSynthesis.speak(speech)
    }

    function tdk_hadir() {
        const url = $('#b-tdk-hadir').data('url')
        window.open(url, "_self")
    }

    $(function () {
        $('.example2').DataTable({
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

<script>
    $(function () {
        <?php $warning = $this->session->flashdata('warning');
        if (!empty($warning)) { ?>
        Swal.fire({
            icon: 'error',
            title: '<?=$warning?>',
        })
        <?php } ?>

        <?php $success = $this->session->flashdata('success');
        if (!empty($success)) { ?>
        Swal.fire({
            icon: 'success',
            title: '<?=$success?>',
        })
        <?php } ?>

        <?php $print = $this->session->flashdata('print');
        if (!empty($print)) { ?>
            window.open('<?=base_url()?>/AntrianFrontOffice/print/<?=$this->session->flashdata('nomor')?>', '_blank').focus();
        <?php } ?>
    })
</script>
