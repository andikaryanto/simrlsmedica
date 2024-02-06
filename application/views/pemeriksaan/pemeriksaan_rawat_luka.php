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
                                        <b>Wound Assesment Perdana Kusuma</b>
                                    </h4>
                                </div>
                                <div>
                                    <div class="form-group ">
                                        <label for="form[_warna]" class="col-sm-3 control-label">Warna</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control " name="form[_warna]" id="_warna" value="<?=$form['_warna'] ?? ''?>" onkeyup="setTotal_()" onchange="setTotal_()">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="form[_infeksi]" class="col-sm-3 control-label">Infeksi</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control " name="form[_infeksi]" id="_infeksi" value="<?=$form['_infeksi'] ?? ''?>" onkeyup="setTotal_()" onchange="setTotal_()">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="form[_eksudate]" class="col-sm-3 control-label">Eksudate</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control " name="form[_eksudate]" id="_eksudate" value="<?=$form['_eksudate'] ?? ''?>" onkeyup="setTotal_()" onchange="setTotal_()">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="form[_total]" class="col-sm-3 control-label">Total</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control " name="form[_total]" id="_total" value="<?=$form['_total'] ?? ''?>">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="form[_status]" class="col-sm-3 control-label">Status</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control " name="form[_status]" id="_status" value="<?=$form['_status'] ?? ''?>">
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th colspan="5" style="text-align: center">Skor Perdanakusuma II Penilaian Luka Kronik</th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th>INDIKATOR</th>
                                            <th>DESKRIPSI</th>
                                            <th>SKOR</th>
                                            <th>HASIL</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr style="background: #d1e1e8">
                                            <td rowspan="7" style="vertical-align: middle; width: 16px">
                                                <div style="writing-mode: tb-rl;">
                                                    <b>WARNA</b>
                                                </div>
                                            </td>
                                            <td>Hitam</td>
                                            <td>Nekrotik</td>
                                            <td>7</td>
                                            <td rowspan="7">
                                                <input type="number" id="warna" onkeyup="setTotal()" class="form-control" name="form[warna]" value="<?=$form['warna']?>">
                                            </td>
                                        </tr>
                                        <tr style="background: #d1e1e8">
                                            <td>Hitam-Kuning</td>
                                            <td>Nekrotik disertai Slough</td>
                                            <td>6</td>
                                        </tr>
                                        <tr style="background: #d1e1e8">
                                            <td>Kuning</td>
                                            <td>Slough</td>
                                            <td>5</td>
                                        </tr>
                                        <tr style="background: #d1e1e8">
                                            <td>Kuning-Merah</td>
                                            <td>Slough disertai Granulasi</td>
                                            <td>4</td>
                                        </tr>
                                        <tr style="background: #d1e1e8">
                                            <td>Merah</td>
                                            <td>Granulasi</td>
                                            <td>3</td>
                                        </tr>
                                        <tr style="background: #d1e1e8">
                                            <td>Merah-Pink</td>
                                            <td>Granulasi disertai Epitel</td>
                                            <td>2</td>
                                        </tr>
                                        <tr style="background: #d1e1e8">
                                            <td>Pink</td>
                                            <td>Epitel</td>
                                            <td>1</td>
                                        </tr>
                                        <tr style="background: #ecdcd5">
                                            <td rowspan="4" style="vertical-align: middle; width: 16px">
                                                <div style="writing-mode: tb-rl;">
                                                    <b>INFLAMASI</b>
                                                </div>
                                            </td>
                                            <td>Luka atau Pus</td>
                                            <td>Bengkak dan kemerahan yang nyata meluas dan merata di sekitar luka atau didapatkan pus/nanah dari luka</td>
                                            <td>4</td>
                                            <td rowspan="4">
                                                <input type="number" id="inflamasi" onkeyup="setTotal()" class="form-control" name="form[inflamasi]" value="<?=$form['inflamasi']?>">
                                            </td>
                                        </tr>
                                        <tr style="background: #ecdcd5">
                                            <td>Sedang</td>
                                            <td>Bengkak dan kemerahan tidak terlalu luas dan tidak merata di sekitar luka</td>
                                            <td>3</td>
                                        </tr>
                                        <tr style="background: #ecdcd5">
                                            <td>Ringan</td>
                                            <td>Ada kemerahan terbatas di tepi / pinggir luka</td>
                                            <td>2</td>
                                        </tr>
                                        <tr style="background: #ecdcd5">
                                            <td>Tidak Ada</td>
                                            <td>Tidak tampak ada kemerahan di kulit sekitar luka</td>
                                            <td>1</td>
                                        </tr>
                                        <tr style="background: #d6ecd5">
                                            <td rowspan="5" style="vertical-align: middle; width: 16px">
                                                <div style="writing-mode: tb-rl;">
                                                    <b>EKSUDATE</b>
                                                </div>
                                            </td>
                                            <td>Banyak</td>
                                            <td>Basah membanjiri luka dan sekitarnya/balutan jenuh dan basah tidak dapat menampung an tidak dapat bertahan lama</td>
                                            <td>5</td>
                                            <td rowspan="5">
                                                <input type="number" id="eksudate" onkeyup="setTotal()" class="form-control" name="form[eksudate]" value="<?=$form['eksudate']?>">
                                            </td>
                                        </tr>
                                        <tr style="background: #d6ecd5">
                                            <td>Sedang</td>
                                            <td>Basah tampak pada bed luka / balutan basah masih dapat menampung</td>
                                            <td>4</td>
                                        </tr>
                                        <tr style="background: #d6ecd5">
                                            <td>Sedikit</td>
                                            <td>Tampak agak basah memantulkan cahaya / balutan agak basah</td>
                                            <td>3</td>
                                        </tr>
                                        <tr style="background: #d6ecd5">
                                            <td>Kering</td>
                                            <td>Permukaan luka kering</td>
                                            <td>2</td>
                                        </tr>
                                        <tr style="background: #d6ecd5">
                                            <td>Lembab</td>
                                            <td>Tidak basah dan tidak kering</td>
                                            <td>1</td>
                                        </tr>
                                        <tr style="background: #ece7d5">
                                            <td colspan="4" style="text-align: right">
                                                <b style="padding-top: 4px">Total skor</b>
                                            </td>
                                            <td>
                                                <input type="number" id="total-skor" class="form-control" name="form[total_perdana]" value="<?=$form['total_perdana']?>">
                                            </td>
                                        </tr>
                                        <tr style="background: #d5daec">
                                            <td colspan="2" style="text-align: right">
                                                <b style="padding-top: 4px">Status</b>
                                            </td>
                                            <td colspan="3">
                                                <input type="text" id="status" class="form-control" name="form[status]" value="<?=$form['status']?>">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <h4 for="hasil_penunjang_laboratorium" class="col-sm-3 control-label">
                                        <b>Pengkajian Deteksi Vital</b>
                                    </h4>
                                </div>
                                <div>
                                    <?php sm9('form[td]', 'TD')->val($form['td'] ?? '')->build(); ?>
                                    <?php sm9('form[gda]', 'GDA')->val($form['gda'] ?? '')->build(); ?>
                                    <?php sm9('form[col]', 'COL')->val($form['col'] ?? '')->build(); ?>
                                    <?php sm9('form[au]', 'AU')->val($form['au'] ?? '')->build(); ?>
                                    <?php sm9('form[n]', 'N')->val($form['n'] ?? '')->build(); ?>
                                    <?php sm9('form[s]', 'S')->val($form['s'] ?? '')->build(); ?>
                                    <?php sm9('form[rr]', 'RR')->val($form['rr'] ?? '')->build(); ?>
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
                                        <label for="form[next]" class="col-sm-3 control-label">Perawatan Luka Selanjutnya</label>
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

    const setTotal = () => {
        const w = +$('#warna').val()
        const i = +$('#inflamasi').val()
        const e = +$('#eksudate').val()
        const total = w + i + e

        $('#total-skor').val(total)

        let status = ''
        if (total >= 10) {
            status = 'Berat'
        }
        else if (total >= 8) {
            status = 'Sedang'
        }
        else if (total >= 5) {
            status = 'Ringan'
        }
        else {
            status = 'Sembuh'
        }
        $('#status').val(status)
    }

    const setTotal_ = () => {
        const w = +$('#_warna').val() || 0
        const i = +$('#_infeksi').val() || 0
        const e = +$('#_eksudate').val() || 0
        const total = w + i + e

        $('#_total').val(total)

        let status = ''
        if (total >= 10) {
            status = 'Berat'
        }
        else if (total >= 8) {
            status = 'Sedang'
        }
        else if (total >= 5) {
            status = 'Ringan'
        }
        else {
            status = 'Sembuh'
        }
        $('#_status').val(status)
    }

</script>
