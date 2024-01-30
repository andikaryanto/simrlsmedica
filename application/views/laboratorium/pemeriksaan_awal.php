<?php

function isGigi($pendaftaran) {
    return $pendaftaran['kode_daftar'] == 'PG' || $pendaftaran['kode_daftar'] == 'BPJS-PG';
}

function isLab($pendaftaran) {
    return $pendaftaran['kode_daftar'] == 'PL' || $pendaftaran['kode_daftar'] == 'BPJS-PL';
}

function isEkg($pendaftaran) {
    return $pendaftaran['kode_daftar'] == 'PE';
}

function isSpirometri($pendaftaran) {
    return $pendaftaran['kode_daftar'] == 'P-Sirometri';
}

function isBpjs($pendaftaran) {
    return strpos($pendaftaran['kode_daftar'], 'BPJS') !== false;
}

function getKodePoli($kode_daftar = '', $data_poli) {
    foreach ($data_poli as $key => $value) {
        if (in_array($kode_daftar, $value['kode'])) return $key;
    }

    //kalau gak ada ketentuan jadinya umum
    return 'umum';
}

function isPendukung($kode_daftar = '', $data_poli) {
    foreach (['ekg', 'spirometri', 'pemeriksaan-laborat'] as $value) {
        if (in_array($kode_daftar, $data_poli[$value]['kode'])) return true;
    }

    return false;
}

$data_poli = $this->config->item('poli');;
$kode_poli = getKodePoli($pendaftaran['kode_daftar'], $data_poli);
$isDataPendukung = isPendukung($pendaftaran['kode_daftar'], $data_poli);

include BASEPATH.'../application/views/template/InputBuilder.php';

?>

<style media="screen">
    .select2-container {
        width: 100% !important;
    }
</style>
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/iCheck/all.css">
<form class="form-horizontal" method="post" action="<?= base_url() ?>laboratorium/periksaAwal/<?= $pemeriksaan['id'] ?>">
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Pemeriksaan Pasien
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= base_url() ?>Dashbord"><i class="fa fa-dashboard"></i> Dashbord</a></li>
                <li class="active">Pemeriksaan</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-7">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title"> No. Rekam Medis : <?= $pendaftaran['no_rm']; ?> </h3>
                        </div>
                        <div class="box-body">
                            <div class="box-body">

                                <input type="hidden" class="form-control" name="pendaftaran_id" id="pendaftran_id" value="<?= $pemeriksaan['id']; ?>">
                                <input type="hidden" class="form-control" name="dokter_id" id="dokter_id" value="<?= $pemeriksaan['dokter_id']; ?>">
                                <input type="hidden" class="form-control" name="kode_daftar" id="kode_daftar" value="<?= $pendaftaran['kode_daftar']; ?>">
                                <input type="hidden" name="kode_daftar" value="<?= $pendaftaran['kode_daftar'] ?>">

                                <?php sm4('no_rm', 'No Rekam Medis')->val($pemeriksaan['no_rm'])->readonly()->build(); ?>
                                <div class="form-group">
                                    <label class="col-sm-3"></label>
                                    <div class="col-sm-9">
                                        <span class="label <?= $jaminan[$pemeriksaan['jaminan']]['class'] ?>"><?= $jaminan[$pemeriksaan['jaminan']]['label'] ?></span>
                                        <?php if (!isset($jaminan[$pemeriksaan['jaminan']])) { ?>
                                            <span class="label label-warning">Umum</span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php
                                sm4('nama_pasien', 'Nama Pasien')->val($pemeriksaan['nama_pasien'])->readonly()->build();
                                sel('tindakan[]', 'Tarif / Layanan')
                                    ->placeholder('Pilih tindakan untuk pasien')
                                    ->selectedOptionIds(array_map(function ($v) { return $v->child_id; }, $selected_jenis_layanan_lab))
                                    ->options($jenis_layanan_lab->result())
                                    ->display(function ($value) use (&$pendaftaran) {
                                        return $value->is_paket ?
                                            $value->nama . " - Rp." . number_format($value->tarif_pasien, 2, ',', '.') :
                                            $value->parent_nama . ' - ' . $value->nama . " - Rp." . number_format($value->tarif_pasien, 2, ',', '.');
                                    })
                                    ->build();
                                ?>
                            </div>
                            <div class="box-footer">
                                <button type="submit" name="submit" value="1"
                                        class="btn btn-primary btn-lg btn-flat pull-right">Simpan
                                </button>
                                <a href="<?= base_url() ?>pemeriksaan/listpemeriksaanPasien"
                                   class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-5">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Bahan Habis Pakai</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <select id="bahan-option">
                                                <option value="">-- Pilih Bahan --</option>
                                                <?php foreach ($bahan as $key => $value) { ?>
                                                    <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-sm-4">
                                            <button type="button" name="button"
                                                    class="btn btn-sm btn-block btn-primary"
                                                    id="button-add-bahan"><i class="fa fa-plus"></i>
                                                Tambah Bahan
                                            </button>
                                            <input type="hidden" id="abdush-counter2" value="0">
                                        </div>

                                    </div>

                                    <div class="form-area" style="margin-top:15px;">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>Nama Bahan</th>
                                                <th>Stok</th>
                                                <th>Jml</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</form>

<div id='ResponseInput'></div>

<!-- Select2 -->
<script src="<?= base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->

<script type="text/javascript">
    $('.select2').select2();

    function loadData(i) {
        var id = $('#obat' + i).val();
        var jumlah_satuan = $('#jumlah_satuan' + i).val();
        var stok = $('#stok' + i).val();
        var urls = "<?= base_url(); ?>obat/getStokObat";
        var datax = {"id": id};

        if (parseInt(stok) < parseInt(jumlah_satuan)) {
            alert('Stok obat tidak cukup. Silahkan kurangi jumlah atau ganti obat lain!');
            $('#jumlah_satuan' + i).val('');
        }
    }

    for (var i = 1; i < 11; i++) {
        for (var j = 1; j < 3; j++) {
            function loadDataRacikan(i, j) {
                var ij = (i.toString() + j.toString());


                var id = $('#obat_racikan' + ij).val();
                var jumlah_satuan = $('#jumlah_satuan' + ij).val();
                var urls = "<?= base_url(); ?>obat/getStokObat";
                var datax = {"id": id};

                $.ajax({
                    type: 'GET',
                    url: urls,
                    data: datax,

                    success: function (stok) {
                        if (parseInt(stok) < parseInt(jumlah_satuan)) {
                            alert('Stok obat tidak cukup. Silahkan kurangi jumlah atau ganti obat lain!');
                            $('#jumlah_satuan' + ij).val('');
                        }


                    }
                });
            }
        }
    }

</script>

<script type="text/javascript">
    jQuery(function ($) {
        var bahan = <?php echo json_encode($bahan); ?>;
        $('#bahan-option').select2();

        var obat = <?php echo json_encode($obat1); ?>;
        $('#obat-option').select2();

        $('#button-add-bahan').on('click', function (e) {
            var id_bahan = $('#bahan-option').val();
            if (id_bahan == '') {
                alert('Anda belum memilih bahan habis pakai !');
            }
            else {
                var theBahan = {};
                var counter = parseInt($('#abdush-counter2').val());
                $.each(bahan, function (i, v) {
                    if (v.id == id_bahan) {
                        theBahan = v;
                        return;
                    }
                });

                var html = `
                <tr>
                  <td>
                    ` + theBahan.nama + `
                    <input type="hidden" name="id[]" value="` + theBahan.id + `">
                  </td>
                  <td>` + theBahan.jumlah + ` ` + theBahan.satuan + `</td>
                  <td>
                    <input style="width:65px;" type="text" class="form-control" name="qty[]" id="bahan[` + counter + `][qty]">
                  </td>
                  <td>
                    <button class="btn btn-sm btn-danger btn-delete-row" type="button"> <i class="fa fa-trash"></i> </button>
                  </td>
                </tr>`;

                $('.form-area tbody').append(html);
                $('#abdush-counter').val(counter + 1);
                $('input[name="bahan[' + counter + '][qty]"]').focus();

                $('.btn-delete-row').unbind('click');
                $('.btn-delete-row').each(function () {
                    $(this).on('click', function () {
                        $(this).parents('tr').remove();
                    });
                });
            }

            $('#bahan-option').val('').trigger('change');
        });

        $('#button-add-obat').on('click', function (e) {
            var id_Obat = $('#obat-option').val();
            if (id_Obat == '') {
                alert('Anda belum memilih obat !');
            }
            else {
                var theObat = {};
                var counter = parseInt($('#abdush-counter2').val());
                $.each(obat, function (i, v) {
                    if (v.id == id_Obat) {
                        theObat = v;
                        return;
                    }
                });

                var html = `
                <tr>
                  <td>
                    ` + theObat.nama + `
                    <input type="hidden" name="nama_obat[]" value="` + theObat.id + `">
                  </td>
                  <td>` + theObat.stok_obat + ` item </td>
                  <input type="hidden" id="stok` + counter + `" value="` + theObat.stok_obat + `">
                  <td>
                    <input style="width:65px;" type="text" class="form-control" onchange="loadData(` + counter + `);" name="jumlah_satuan[]" id="jumlah_satuan` + counter + `">
                  </td>
                  <td>
                    <input style="width:100px;" type="text" class="form-control"  name="signa_obat[]" id="signa_obat` + counter + `">
                  </td>
                  <td>
                    <button class="btn btn-sm btn-danger btn-delete-row" type="button"> <i class="fa fa-trash"></i> </button>
                  </td>
                </tr>

                `;

                $('.form-area-obat tbody').append(html);
                $('#abdush-counter2').val(counter + 1);
                $('input[id="jumlah_satuan' + counter + '"]').focus();

                $('.btn-delete-row').unbind('click');
                $('.btn-delete-row').each(function () {
                    $(this).on('click', function () {
                        $(this).parents('tr').remove();
                    });
                });
            }

            $('#obat-option').val('').trigger('change');
        });

        let initializer = {
            init: function() {
                for (let i = 1; i < 9; i++) {
                    $(`#obat-racik-option-${i}`).select2();
                    $(`#button-add-obat-racik-${i}`).on('click', e => {
                        this.onBtnAddClick(i);
                    });
                }
            },
            onBtnAddClick: function(i) {
                let opt = $(`#obat-racik-option-${i}`);
                let id_Obat = opt.val();
                if (id_Obat === '') {
                    alert('Anda belum memilih obat !');
                }
                else {
                    let theObat = {};
                    let counter = parseInt($(`#abdush-counter-${i}`).val());
                    $.each(obat, function (i, v) {
                        if (v.id === id_Obat) {
                            theObat = v;
                            return;
                        }
                    });

                    $(`.form-area-obat-racik-${i} tbody`).append(this.getTableRow(i, theObat, counter));
                    $(`#abdush-counter-${i}`).val(counter + 1);
                    $('input[id="jumlah_satuan_racik' + counter + '"]').focus();

                    $('.btn-delete-row').unbind('click');
                    $('.btn-delete-row').each(function () {
                        $(this).on('click', function () {
                            $(this).parents('tr').remove();
                        });
                    });
                }
                opt.val('').trigger('change');
            },
            getTableRow: (i, obat, counter) => (`
                <tr>
                  <td>
                    ` + obat.nama + `
                    <input type="hidden" name="nama_obat_racikan${i}[]" value="` + obat.id + `">
                  </td>
                  <td>` + obat.stok_obat + ` item </td>
                  <input type="hidden" id="stok` + counter + `" value="` + obat.stok_obat + `">
                  <td>
                    <input style="width:65px;" type="text" class="form-control" onchange="loadData(` + counter + `);" name="jumlah_satuan_racikan${i}[]" id="jumlah_satuan_racikan${i}` + counter + `">
                  </td>
                  <td>
                    <button class="btn btn-sm btn-danger btn-delete-row" type="button"> <i class="fa fa-trash"></i> </button>
                  </td>
                </tr>
            `)
        };

        initializer.init();
    });
</script>
