<?php
include BASEPATH.'../application/views/template/InputBuilder.php';
?>

<style media="screen">
    .select2-container {
        width: 100% !important;
    }
</style>
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/iCheck/all.css">
<form class="form-horizontal" method="post" action="<?= base_url() ?>pemeriksaan/periksa/<?= $pemeriksaan['id'] ?>" enctype="multipart/form-data">
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
                                <input type="hidden" class="form-control" name="pendaftaran_id" id="pendaftran_id"
                                       value="<?= $pendaftaran['id']; ?>">
                                <input type="hidden" class="form-control" name="dokter_id" id="dokter_id"
                                       value="<?= $pemeriksaan['dokter_id']; ?>">
                                <input type="hidden" class="form-control" name="kode_daftar" id="kode_daftar"
                                       value="<?= $pendaftaran['kode_daftar']; ?>">

                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <?php
                                        sm9('no_rm', 'No Rekam Medis')->val($pemeriksaan['no_rm'])->readonly()->build();
                                        sm9('nama_pasien', 'Nama Pasien')->val($pemeriksaan['nama_pasien'])->readonly()->build();
                                        sm9('jk', 'Jenis Kelamin')->val($pasien['jk'])->readonly()->build();
                                        ?>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <?php
                                        sm9('usia', 'Usia')->val($pasien['usia'])->readonly()->build();
                                        sm9('wali_band', 'Nama Orang Tua/Wali')->val($pendaftaran['penanggungjawab'])->readonly()->build();
                                        sm9('alamat', 'Alamat')->val($pasien['alamat'])->readonly()->build();
                                        ?>
                                    </div>
                                </div>

                                <hr>
                                <div class="form-group">
                                    <h4 for="hasil_penunjang_laboratorium" class="col-sm-3 control-label">
                                        <b>Anamnesa</b>
                                    </h4>
                                </div>
                                <div>
                                    <?php sm9('form[riwayat_alergi]', 'Riwayat Alergi')->textarea()->val($form['riwayat_alergi'] ?? '')->build(); ?>
                                    <?php sm9('form[riwayat_pendarahan]', 'Riwayat Pendarahan')->textarea()->val($form['riwayat_pendarahan'] ?? '')->build(); ?>
                                    <?php sm9('form[penyakit_bawaan]', 'Penyakit Bawaan')->textarea()->val($form['penyakit_bawaan'] ?? '')->build(); ?>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <h4 for="hasil_penunjang_laboratorium" class="col-sm-3 control-label">
                                        <b>Status Vitalis</b>
                                    </h4>
                                </div>
                                <div>
                                    <div class="orm-group">
                                        <label for="td" class="col-sm-3 control-label">RR</label>
                                        <div class="input-group col-sm-9">
                                            <input type="text" class="form-control" name="form[rr]" autocomplete="off" value="<?=$form['rr'] ?? ''?>">
                                            <span class="input-group-addon">x/mnt</span>
                                        </div>
                                    </div>
                                    <div class="orm-group" style="margin-top: 14px">
                                        <label for="td" class="col-sm-3 control-label">HR</label>
                                        <div class="input-group col-sm-9">
                                            <input type="text" class="form-control" name="form[hr]" autocomplete="off" value="<?=$form['hr'] ?? ''?>">
                                            <span class="input-group-addon">x/mnt</span>
                                        </div>
                                    </div>
                                    <div class="orm-group" style="margin-top: 14px">
                                        <label for="td" class="col-sm-3 control-label">BP</label>
                                        <div class="input-group col-sm-9">
                                            <input type="text" class="form-control" name="form[bp]" autocomplete="off" value="<?=$form['bp'] ?? ''?>">
                                            <span class="input-group-addon">mmHg</span>
                                        </div>
                                    </div>
                                    <div class="orm-group" style="margin-top: 14px">
                                        <label for="td" class="col-sm-3 control-label">Temp</label>
                                        <div class="input-group col-sm-9">
                                            <input type="text" class="form-control" name="form[temp]" autocomplete="off" value="<?=$form['temp'] ?? ''?>">
                                            <span class="input-group-addon">Celcius</span>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <h4 for="hasil_penunjang_laboratorium" class="col-sm-3 control-label">
                                        <b>Status Lokasi : Regio Genittala</b>
                                    </h4>
                                </div>
                                <div>
                                    <?php
                                    sel('form[bagian][]', 'Bagian')
                                        ->placeholder('Pilih Bagian')
                                        ->options([
                                            (object) ['nama' => 'Hipospapadia', 'id' => 'Hipospapadia'],
                                            (object) ['nama' => 'Epispadia', 'id' => 'Epispadia'],
                                            (object) ['nama' => 'Korde', 'id' => 'Korde'],
                                            (object) ['nama' => 'Meglouretra', 'id' => 'Meglouretra'],
                                            (object) ['nama' => 'Webbed Penis', 'id' => 'Webbed Penis'],
                                            (object) ['nama' => 'Fimosis', 'id' => 'Fimosis'],
                                            (object) ['nama' => 'Gemuk', 'id' => 'Gemuk'],
                                            (object) ['nama' => 'Perbaikan', 'id' => 'Perbaikan'],
                                            (object) ['nama' => 'Normal', 'id' => 'Normal'],
                                        ])
                                        ->display(function ($value) {
                                            return $value->nama;
                                        })
                                        ->build();
                                    sm9('form[regio_desc]', 'Deskripsi')->textarea()->val($form['regio_desc'] ?? '')->build();
                                    ?>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <h4 for="hasil_penunjang_laboratorium" class="col-sm-3 control-label">
                                        <b>Laporan Operasi</b>
                                    </h4>
                                </div>
                                <div>
                                    <?php
                                    sel('form[anastesi][]', 'Anastesi')
                                        ->placeholder('Pilih Anastesi')
                                        ->options([
                                            (object) ['nama' => 'Blok Nerve', 'id' => 'Blok Nerve'],
                                            (object) ['nama' => 'Ring Blok', 'id' => 'Ring Blok'],
                                            (object) ['nama' => 'Kombinasi', 'id' => 'Kombinasi'],
                                        ])
                                        ->display(function ($value) {
                                            return $value->nama;
                                        })
                                        ->build();
                                    ?>
                                    <label class="col-sm-3 control-label" style="padding-right: 25px">Obat</label>
                                    <div class="col-sm-9">
                                        <?php $this->load->view('pemeriksaan/partials/sunat_obat'); ?>
                                    </div>
                                    <?php
                                    sel('form[technique][]', 'Teknik Operasi')
                                        ->placeholder('Pilih Teknik Operasi')
                                        ->options([
                                            (object) ['nama' => 'Sirkumsisi', 'id' => 'Sirkumsisi'],
                                            (object) ['nama' => 'Dorsumsisi', 'id' => 'Dorsumsisi'],
                                            (object) ['nama' => 'Klasik', 'id' => 'Klasik'],
                                            (object) ['nama' => 'Sunat Bipolar Premium', 'id' => 'Sunat Bipolar Premium'],
                                            (object) ['nama' => 'Sunat Klamp', 'id' => 'Sunat Klamp'],
                                            (object) ['nama' => 'Sunat Esu Sealer', 'id' => 'Sunat Esu Sealer'],
                                            (object) ['nama' => 'Sunat Stapler', 'id' => 'Sunat Stapler'],
                                            (object) ['nama' => 'Cauter', 'id' => 'Cauter'],
                                            (object) ['nama' => 'Jahit', 'id' => 'Jahit'],
                                            (object) ['nama' => 'Lem', 'id' => 'Lem'],
                                        ])
                                        ->display(function ($value) {
                                            return $value->nama;
                                        })
                                        ->build();
                                    sm9('form[tipe_jahitan]', 'Tipe Jahitan')->textarea()->val($form['tipe_jahitan'] ?? '')->build();
                                    ?>
                                    <div class="form-group ">
                                        <label for="form[jumlah_jahitan]" class="col-sm-3 control-label">Jumlah Jahitan</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="form[jumlah_jahitan]" class="form-control col-sm-9">
                                        </div>
                                    </div>
                                    <div class="orm-group" style="margin-top: 14px">
                                        <label for="td" class="col-sm-3 control-label">Perdarahan</label>
                                        <div class="input-group col-sm-9">
                                            <input type="number" class="form-control" name="form[pendarahan]" autocomplete="off" value="<?=$form['pendarahan'] ?? ''?>">
                                            <span class="input-group-addon">ml</span>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <h4 for="hasil_penunjang_laboratorium" class="col-sm-3 control-label">
                                        <b>POST OPERASI</b>
                                    </h4>
                                </div>
                                <div>
                                    <?php
                                    sm9('form[perawatan_di_rumah]', 'Perawatan Di Rumah')->textarea()->val($form['perawatan_di_rumah'] ?? '')->build();
                                    sm9('form[Catatan_post]', 'Catatan')->textarea()->val($form['Catatan_post'] ?? '')->build();
                                    ?>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <h4 for="hasil_penunjang_laboratorium" class="col-sm-3 control-label">
                                        <b>Jadwal Perawatan</b>
                                    </h4>
                                </div>                                
                                <?php
                                sel('diagnosis_jenis_penyakit[]', 'Diagnosis Jenis Penyakit')
                                     ->placeholder('Pilih penyakit untuk pasien')
                                     ->options($penyakit->result())
                                     ->display(function ($value) {
                                         return $value->kode . ' - ' . $value->nama;
                                     })
                                     ->selectedOptionIds(array_map(function ($v) {
                                         return $v->penyakit_id;
                                     }, $penyakit_pasien->result()))
                                     ->build();
                                ?>
                                <div>
                                    <div class="form-group ">
                                        <label for="form[next]" class="col-sm-3 control-label">Perawatan Selanjutnya</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control " name="form[next]" id="" value="<?=$form['next'] ?? ''?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_pendaftaran" class="col-sm-3 control-label">Tipe Layanan</label>

                                    <div class="col-sm-9">
                                        <select class="form-control abdush-select" name="form[tipe_layanan]" id="tipe_layanan" required>
                                            <option value="">--Pilih Tipe Layanan--</option>
                                            <option value="1" <?=$form['tipe_layanan'] == '1' ? 'selected' : ''?>>Home Visit</option>
                                            <option value="2" <?=$form['tipe_layanan'] == '2' ? 'selected' : ''?>>On Site</option>
                                        </select>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <h4 for="hasil_penunjang_laboratorium" class="col-sm-3 control-label">
                                        <b>Administrasi</b>
                                    </h4>
                                </div>
                                <?php
                                sel('tindakan[]', 'Tarif / Tindakan')
                                    ->placeholder('Pilih tindakan untuk pasien')
                                    ->options($tindakan->result())
                                    ->display(function ($value) use (&$pendaftaran) {
                                        return $value->nama . " - Rp." . number_format($value->tarif_pasien, 2, ',', '.');
                                    })
                                    ->build();
                                sel('operator[]', 'Perawat / Operator')
                                    ->placeholder('Pilih Perawat / Operator')
                                    ->options($listPerawat->result())
                                    ->display(function ($value) {
                                        return ucwords($value->nama);
                                    })
                                    ->selectedOptionIds(explode(',', $pemeriksaan['detail_perawat_id'] ?? ''))
                                    ->build();
                                sel('asisten_operator[]', 'Assisten Operator')
                                    ->placeholder('Pilih Assisten Operator')
                                    ->options($listPerawat->result())
                                    ->display(function ($value) {
                                        return ucwords($value->nama);
                                    })
                                    ->selectedOptionIds(explode(',', $pemeriksaan['detail_perawat_id'] ?? ''))
                                    ->build();
                                sel('admin[]', 'Admin')
                                    ->placeholder('Pilih Admin')
                                    ->options($listFrontOffice->result())
                                    ->display(function ($value) {
                                        return ucwords($value->nama);
                                    })
                                    ->selectedOptionIds(explode(',', $pemeriksaan['detail_perawat_id'] ?? ''))
                                    ->build();
                                sel('dokter_id', 'Dokter')
                                    ->placeholder('Pilih Dokter')
                                    ->options($dokter->result())
                                    ->display(function ($value) {
                                        return ucwords($value->nama);
                                    })
                                    ->single()
                                    ->selectedOptionIds($pemeriksaan['dokter_id'])
                                    ->required()
                                    ->build();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $this->load->view('pemeriksaan/partials/obat'); ?>
<!--                --><?php //$this->load->view('pemeriksaan/partials/side_2'); ?>
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

    function set_bmi() {
        var tb = $('#tb').val();
        var bb = $('#bb').val();
        var tbm = tb / 100;
        var bmi = bb / (tbm * tbm);

        $('#bmi').val(bmi.toFixed(2));
    }

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
            checkHasObat: function(i) {
                let rowCount = $(`.form-area-obat-racik-${i} >table >tbody >tr`).length;
                if (rowCount === 0) {
                    $(`#signa-obat-racik-${i}`).prop('required',false);
                }
            },
            onBtnAddClick: function(i) {
                let that = this;
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
                    $(`#signa-obat-racik-${i}`).prop('required',true);
                    $(`#abdush-counter-${i}`).val(counter + 1);
                    $('input[id="jumlah_satuan_racik' + counter + '"]').focus();

                    $('.btn-delete-row').unbind('click');
                    $('.btn-delete-row').each(function () {
                        $(this).on('click', function () {
                            $(this).parents('tr').remove();
                            that.checkHasObat(i);
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

    function setImt() {
        const tb = (parseInt($('#form_tb').val() || '0') ?? 0) / 100
        const bb = parseInt($('#form_bb').val() || '0') ?? 0
        const imt = bb / (tb * tb)

        $('#form_imt').val(imt.toFixed(2))

        $('#underweight').prop('checked', imt < 18.5)
        $('#normal').prop('checked', imt >= 18.5 && imt <= 24.99)
        $('#overweight').prop('checked', imt >= 25 && imt <= 29.99)
        $('#obese').prop('checked', imt >= 30)
    }

</script>
