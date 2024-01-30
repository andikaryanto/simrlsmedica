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

function isHd($pendaftaran) {
    return $pendaftaran['kode_daftar'] == 'PHD' || $pendaftaran['kode_daftar'] == 'BPJS-PHD';
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
        if (isset($data_poli[$value]) && in_array($kode_daftar, $data_poli[$value]['kode'])) return true;
    }

    return false;
}
?>
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
                <div class="col-sm-12 col-md-12 <?=isLab($pendaftaran) || isHd($pendaftaran) ? 'col-lg-12' : 'col-lg-7'?>">

                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title"> No. Rekam Medis : <?= $pendaftaran['no_rm']; ?> </h3>
                        </div>
                        <div class="box-body">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                        unit('td', 'TD')->val($pemeriksaan['td'])->required(!isLab($pendaftaran))->unit('mmHg')->build();
                                        unit('r', 'R')->val($pemeriksaan['r'])->required(!isLab($pendaftaran))->unit('K/Min')->build();
//                                        unit('bb', 'BB')->val($pemeriksaan['bb'])->required(!isLab($pendaftaran))->unit('Kg')->onkeyup('set_bmi()')->build();
                                        unit('n', 'N')->val($pemeriksaan['n'])->required(!isLab($pendaftaran))->unit('K/Min')->build();
                                        unit('s', 'S')->val($pemeriksaan['s'])->required(!isLab($pendaftaran))->unit("'0")->build();
//                                        unit('tb', 'TB')->val($pemeriksaan['tb'])->required(!isLab($pendaftaran))->unit("cm")->build();
                                        ?>
                                    </div>
                                </div>

                                <input type="hidden" class="form-control" name="pendaftaran_id" id="pendaftran_id"
                                       value="<?= $pendaftaran['id']; ?>">
                                <input type="hidden" class="form-control" name="dokter_id" id="dokter_id"
                                       value="<?= $pemeriksaan['dokter_id']; ?>">
                                <input type="hidden" class="form-control" name="kode_daftar" id="kode_daftar"
                                       value="<?= $pendaftaran['kode_daftar']; ?>">

                                <?php
//                                sm4('bmi', 'BMI')->val($pemeriksaan['bmi'])->build();
                                sm4('no_rm', 'No Rekam Medis')->val($pemeriksaan['no_rm'])->readonly()->build();
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-3"></label>
                                    <div class="col-sm-9">
                                        <span class="label <?= $jaminan[$pemeriksaan['jaminan']]['class'] ?>"><?= $jaminan[$pemeriksaan['jaminan']]['label'] ?></span>
                                        <?php if (!isset($jaminan[$pemeriksaan['jaminan']])) { ?>
                                            <span class="label label-warning">Umum</span>
                                        <?php } ?>
                                        <button type="button" name="button" class="btn btn-sm btn-primary btn-rekamedis"
                                                data-pasien_id="<?= $pendaftaran['pasien'] ?>"><i
                                                    class="fa fa-search"></i> Lihat Rekam Medis
                                        </button>
                                    </div>
                                </div>
                                <?php
                                sm4('nama_pasien', 'Nama Pasien')->val($pemeriksaan['nama_pasien'])->readonly()->build();
                                ?>
                                <div class="form-group">
                                    <label for="hasil_penunjang_laboratorium" class="col-sm-3 control-label">
                                        Kajian Perawat
                                    </label>
                                </div>

                                <!--                                form perawat-->
                                <div>
                                    <h4><strong>Alergi</strong></h4>
                                    <p>Apakah pasien mempunyai indikasi alergi ?</p>
                                    <div class="form-check" style="display: inline">
                                        <input class="form-check-input" type="radio" name="form[alergi]" value="ya" id="flexRadioDefault1" <?= isset($form['alergi']) && $form['alergi'] == 'ya' ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="flexRadioDefault1" style="font-weight: normal !important;">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check" style="display: inline; margin-left: 16px">
                                        <input class="form-check-input" type="radio" name="form[alergi]" value="tidak" id="flexRadioDefault2" <?= isset($form['alergi']) && $form['alergi'] == 'tidak' ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="flexRadioDefault2" style="font-weight: normal !important;">
                                            Tidak
                                        </label>
                                    </div>
                                    <?php sm9('form[alergi_detail]', 'Jika Ya, Jelaskan')->textarea()->val($form['alergi_detail'] ?? '')->build(); ?>
                                </div>
                                <div style="margin-top: 24px">
                                    <h4><strong>Nyeri</strong></h4>
                                    <p style="margin-bottom: 2px !important;">Skala Numerik</p>
                                    <div style="display: flex; width: 100%;">
                                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center">
                                            <p style="margin-bottom: 0 !important;">1</p>
                                            <input class="form-check-input" type="radio" name="form[nyeri]" value="1" style="margin-top: 0 !important;" <?= isset($form['nyeri']) && $form['nyeri'] == '1' ? 'checked' : '' ?>>
                                        </div>
                                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center">
                                            <p style="margin-bottom: 0 !important;">2</p>
                                            <input class="form-check-input" type="radio" name="form[nyeri]" value="2" style="margin-top: 0 !important;" <?= isset($form['nyeri']) && $form['nyeri'] == '2' ? 'checked' : '' ?>>
                                        </div>
                                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center">
                                            <p style="margin-bottom: 0 !important;">3</p>
                                            <input class="form-check-input" type="radio" name="form[nyeri]" value="3" style="margin-top: 0 !important;" <?= isset($form['nyeri']) && $form['nyeri'] == '3' ? 'checked' : '' ?>>
                                        </div>
                                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center">
                                            <p style="margin-bottom: 0 !important;">4</p>
                                            <input class="form-check-input" type="radio" name="form[nyeri]" value="4" style="margin-top: 0 !important;" <?= isset($form['nyeri']) && $form['nyeri'] == '4' ? 'checked' : '' ?>>
                                        </div>
                                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center">
                                            <p style="margin-bottom: 0 !important;">5</p>
                                            <input class="form-check-input" type="radio" name="form[nyeri]" value="5" style="margin-top: 0 !important;" <?= isset($form['nyeri']) && $form['nyeri'] == '5' ? 'checked' : '' ?>>
                                        </div>
                                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center">
                                            <p style="margin-bottom: 0 !important;">6</p>
                                            <input class="form-check-input" type="radio" name="form[nyeri]" value="6" style="margin-top: 0 !important;" <?= isset($form['nyeri']) && $form['nyeri'] == '6' ? 'checked' : '' ?>>
                                        </div>
                                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center">
                                            <p style="margin-bottom: 0 !important;">7</p>
                                            <input class="form-check-input" type="radio" name="form[nyeri]" value="7" style="margin-top: 0 !important;" <?= isset($form['nyeri']) && $form['nyeri'] == '7' ? 'checked' : '' ?>>
                                        </div>
                                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center">
                                            <p style="margin-bottom: 0 !important;">8</p>
                                            <input class="form-check-input" type="radio" name="form[nyeri]" value="8" style="margin-top: 0 !important;" <?= isset($form['nyeri']) && $form['nyeri'] == '8' ? 'checked' : '' ?>>
                                        </div>
                                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center">
                                            <p style="margin-bottom: 0 !important;">9</p>
                                            <input class="form-check-input" type="radio" name="form[nyeri]" value="9" style="margin-top: 0 !important;" <?= isset($form['nyeri']) && $form['nyeri'] == '9' ? 'checked' : '' ?>>
                                        </div>
                                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center">
                                            <p style="margin-bottom: 0 !important;">10</p>
                                            <input class="form-check-input" type="radio" name="form[nyeri]" value="10" style="margin-top: 0 !important;" <?= isset($form['nyeri']) && $form['nyeri'] == '10' ? 'checked' : '' ?>>
                                        </div>
                                    </div>
                                    <p style="margin-bottom: 2px !important; margin-top: 8px !important;">Wong Baker Faces</p>
                                    <div style="display: flex; flex-direction: column">
                                        <img src="<?php echo base_url(); ?>assets/img/wong.jpeg" alt="User Image">
                                        <div style="display: flex; flex: 1; margin-left: 6px; margin-right: 8px;">
                                            <input class="form-check-input" type="radio" name="form[wong]" value="0" style="margin-top: 0 !important; flex: 1" <?= isset($form['wong']) && $form['wong'] == '0' ? 'checked' : '' ?>>
                                            <input class="form-check-input" type="radio" name="form[wong]" value="2" style="margin-top: 0 !important; flex: 1" <?= isset($form['wong']) && $form['wong'] == '2' ? 'checked' : '' ?>>
                                            <input class="form-check-input" type="radio" name="form[wong]" value="4" style="margin-top: 0 !important; flex: 1" <?= isset($form['wong']) && $form['wong'] == '4' ? 'checked' : '' ?>>
                                            <input class="form-check-input" type="radio" name="form[wong]" value="6" style="margin-top: 0 !important; flex: 1" <?= isset($form['wong']) && $form['wong'] == '6' ? 'checked' : '' ?>>
                                            <input class="form-check-input" type="radio" name="form[wong]" value="8" style="margin-top: 0 !important; flex: 1" <?= isset($form['wong']) && $form['wong'] == '8' ? 'checked' : '' ?>>
                                            <input class="form-check-input" type="radio" name="form[wong]" value="10" style="margin-top: 0 !important; flex: 1" <?= isset($form['wong']) && $form['wong'] == '10' ? 'checked' : '' ?>>
                                        </div>
                                    </div>
                                </div>
                                <div style="margin-top: 24px">
                                    <h4><strong>Gizi</strong></h4>
                                    <div class="col-sm-10 form-group">
                                        <label for="td" class="col-sm-6 control-label">Tinggi Badan</label>
                                        <div class="input-group col-sm-4">
                                            <input type="text" class="form-control" name="form[tb]" id="form_tb" onkeyup="setImt()" autocomplete="off" value="<?=$form['tb'] ?? ''?>">
                                            <span class="input-group-addon">cm</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-10 form-group">
                                        <label for="td" class="col-sm-6 control-label">Berat Badan</label>
                                        <div class="input-group col-sm-4">
                                            <input type="text" class="form-control" name="form[bb]" id="form_bb" onkeyup="setImt()" autocomplete="off" value="<?=$form['bb'] ?? ''?>">
                                            <span class="input-group-addon">kg</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-10 form-group">
                                        <label for="td" class="col-sm-6 control-label">Indeks Massa Tubuh (IMT)</label>
                                        <div class="input-group col-sm-4">
                                            <input type="text" class="form-control" name="form[imt]" id="form_imt" autocomplete="off" value="<?=$form['imt'] ?? ''?>">
                                            <span class="input-group-addon">kg/m2</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div style="display: flex; flex-direction: column">
                                                <div style="display: flex">
                                                    <div class="checkbox" style="flex: 1">
                                                        <label>
                                                            <input type="radio" name="form[gizi]" value="underweight" id="underweight" <?=isset($form['gizi']) && $form['gizi'] == 'underweight' ? 'checked' : ''?>> Underweight ( < 18.5 )
                                                        </label>
                                                    </div>
                                                    <div class="checkbox" style="flex: 1">
                                                        <label>
                                                            <input type="radio" name="form[gizi]" value="overweight" id="overweight" <?=isset($form['gizi']) && $form['gizi'] == 'overweight' ? 'checked' : ''?>> Overweight (25 – 29.99)
                                                        </label>
                                                    </div>
                                                </div>
                                                <div style="display: flex">
                                                    <div class="checkbox" style="flex: 1">
                                                        <label>
                                                            <input type="radio" name="form[gizi]" value="normal" id="normal" <?=isset($form['gizi']) && $form['gizi'] == 'normal' ? 'checked' : ''?>> Normal ( 18.5 – 24.99)
                                                        </label>
                                                    </div>
                                                    <div class="checkbox" style="flex: 1">
                                                        <label>
                                                            <input type="radio" name="form[gizi]" value="obese" id="obese" <?=isset($form['gizi']) && $form['gizi'] == 'obese' ? 'checked' : ''?>> Obese (≥ 30)
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="margin-top: 24px">
                                    <h4><strong>SKRINING RESIKO JATUH</strong></h4>
                                    <div style="display: flex">
                                        <div>
                                            <p style="margin-bottom: 2px !important;">Cara berjalan pasien (salah satu/lebih)</p>
                                            <p style="margin-bottom: 2px !important;">a. Tidak seimbang/sempoyongan/limbung</p>
                                            <p style="margin-bottom: 2px !important;">b. Jalan dengan alat bantu (kruk, tripod, kursi roda, orang lain)</p>
                                        </div>
                                        <div style="margin-left: 26px">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="radio" name="form[skrining_resiko_jatuh]" value="ya" <?=isset($form['skrining_resiko_jatuh']) && $form['skrining_resiko_jatuh'] == 'ya' ? 'checked' : ''?>> Ya
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="radio" name="form[skrining_resiko_jatuh]" value="tidak" <?=isset($form['skrining_resiko_jatuh']) && $form['skrining_resiko_jatuh'] == 'tidak' ? 'checked' : ''?>> Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <p style="margin-bottom: 2px !important;">Ada keterbatasan gerak ?</p>
                                    <div class="checkbox" style="display: inline">
                                        <label>
                                            <input type="radio" name="form[skrining_keterbatasan_gerak]" value="ya" <?=isset($form['skrining_keterbatasan_gerak']) && $form['skrining_keterbatasan_gerak'] == 'ya' ? 'checked' : ''?>> Ya
                                        </label>
                                    </div>
                                    <div class="checkbox" style="display: inline">
                                        <label>
                                            <input type="radio" name="form[skrining_keterbatasan_gerak]" value="tidak" <?=isset($form['skrining_keterbatasan_gerak']) && $form['skrining_keterbatasan_gerak'] == 'tidak' ? 'checked' : ''?>> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>

                                <?php
                                sm9('status_fisik', 'Status Fisik')->textarea()->val($kajian_perawat['status_fisik'])->build();
                                sm9('psikososial', 'Psikososial')->textarea()->val($kajian_perawat['psikososial'])->build();
                                sm9('riwayat_kesehatan_pasien', 'Riwayat Kesehatan Pasien')->textarea()->val($kajian_perawat['riwayat_kesehatan_pasien'])->build();
                                sm9('riwayat_penggunaan_obat', 'Riwayat Penggunaan Obat')->textarea()->val($kajian_perawat['riwayat_penggunaan_obat'])->build();
                                ?>

                                <?php
                                sm9('diagnosa_perawat', 'Diagnosa Perawat')->textarea()->val($pemeriksaan['diagnosa_perawat'])->build();
                                sm9('keluhan_utama', 'Keluhan Utama')->textarea()->val($pemeriksaan['keluhan_utama'])->build();

                                sm9('amammesia', 'Anamnesis')->textarea()->build();
                                echo '<img src="'.base_url().'assets/img/manusia.jpeg'.'" alt="Mata OS">';
                                sm9('pemeriksaan_fisik', 'Pemeriksaan Fisik')->textarea()->build();

                                hasil_penunjang();
                                sm9('asuhan_keperawatan', 'Catatan Alergi/Lainnya')->textarea()->val($pemeriksaan['asuhan_keperawatan'])->build();

                                ?>
                                <input type="hidden" name="kode_daftar" value="<?= $pendaftaran['kode_daftar'] ?>">
                                <?php

                                $excap = array(
                                    'PE',
                                    'BPJS-PE',
                                    'P-Sirometri',
                                    'BPJS-P-Sirometri',
                                    'P-Laborat',
                                    'BPJS-P-Laborat'
                                );
                                if (in_array($pendaftaran['kode_daftar'], $excap)) {
                                    ?>
                                    <div class="form-group">
                                        <label for="diagnosis_jenis_penyakit_a" class="col-sm-3 control-label">Gejala Klinis</label>
                                        <div class="col-sm-9">
                                            <textarea id="diagnosis_jenis_penyakit_a" class="form-control"
                                                      name="diagnosis_jenis_penyakit" rows="3"
                                                      maxlength="265"></textarea>
                                        </div>
                                    </div>
                                    <?php
                                    if (isEkg($pendaftaran) || isSpirometri($pendaftaran)) {
                                        sel('diagnosis_jenis_penyakit[]', 'Jenis Layanan')
                                            ->placeholder('Pilih layanan untuk pasien')
                                            ->options($penyakit->result())
                                            ->display(function ($value) {
                                                return $value->kode . ' - ' . $value->nama;
                                            })
                                            ->build();
                                    }
                                    ?>
                                    <div class="form-group <?= $pendaftaran['kode_daftar'] == 'PE' || $pendaftaran['kode_daftar'] == 'P-Sirometri' ? 'hidden' : '' ?>">
                                        <label for="diagnosis" class="col-sm-3 control-label">Kesimpulan</label>
                                        <div class="col-sm-9">
                                            <textarea id="diagnosis" class="form-control" name="diagnosis" rows="3"
                                                      maxlength="265"></textarea>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    if (isLab($pendaftaran)) {
                                        sm9('diagnosis', 'Gejala Klinis')->textarea()->build();
                                        sel('diagnosis_jenis_penyakit[]', 'Jenis Layanan Laboratorium')
                                            ->placeholder('Pilih layanan untuk pasien')
                                            ->options($penyakit->result())
                                            ->display(function ($value) {
                                                return $value->kode . ' - ' . $value->nama;
                                            })
                                            ->build();
                                    }
                                    else {
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

                                        sm9('diagnosis', 'Diagnosis')->textarea()->val($pemeriksaan['diagnosis'])->build();
                                    }
                                }


                                if (isLab($pendaftaran)) {
                                    sm9('deskripsi_tindakan', 'Tata Laksana')->hide()->build();
                                }
                                else {
                                    sm9('deskripsi_tindakan', 'Tata Laksana')->textarea()->val($pemeriksaan['deskripsi_tindakan'])->build();
                                }

                                if (!in_array($pendaftaran['kode_daftar'], $excap)) {
                                    if (isLab($pendaftaran)) {
                                        sm9('saran_pemeriksaan', 'Rujukan')->hide()->build();
                                    }
                                    else {
                                        sm9('saran_pemeriksaan', 'Rujukan')->textarea()->val($pemeriksaan['saran_pemeriksaan'])->build();
                                    }
                                }

//                                sel('surat', 'Pilih Surat')
//                                    ->placeholder('Pilih Surat')
//                                    ->options([
//                                        (object) ['id' => '', 'value' => '--Pilih Surat--'],
//                                        (object) ['id' => 'sehat', 'value' => 'Surat Keterangan Sehat'],
//                                        (object) ['id' => 'sakit', 'value' => 'Surat Keterangan Sakit'],
//                                    ])
////                                    ->selectedOptionIds([$pemeriksaan['status_pasien']])
//                                    ->display(function ($v) { return $v->value; })
//                                    ->build();

                                sel('tindakan[]', 'Tarif / Tindakan')
                                    ->placeholder('Pilih tindakan untuk pasien')
                                    ->options($tindakan->result())
                                    ->display(function ($value) use (&$pendaftaran) {
                                        return $value->nama . " - Rp." . number_format($value->tarif_pasien, 2, ',', '.');
                                    })
                                    ->build();

                                sel('dokter_id', 'Nama Dokter Pemeriksa')
                                    ->placeholder('Pilih Dokter')
                                    ->options($dokter->result())
                                    ->display(function ($value) {
                                        return ucwords($value->nama);
                                    })
                                    ->single()
                                    ->selectedOptionIds($pemeriksaan['dokter_id'])
                                    ->required()
                                    ->build();
                                sel('detail_perawat_id[]', 'Perawat / Operator')
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
                                ?>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">File Dokumen</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="dokumen[]" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">File Dokumen</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="dokumen[]" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">File Dokumen</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="dokumen[]" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">File Dokumen</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="dokumen[]" class="form-control">
                                    </div>
                                </div>

                            </div>

                            <?php
                            $thelabs = array(
                                'PL',
                                'BPJS-PL',
                                'PE',
                                'BPJS-PE',
                                'P-Sirometri',
                                'BPJS-P-Sirometri',
                                'P-Laborat',
                                'BPJS-P-Laborat'
                            );
                            if (in_array($pendaftaran['kode_daftar'], $thelabs)): ?>
                                <div class="box-footer">
                                    <button type="submit" name="submit" value="1"
                                            class="btn btn-primary btn-lg btn-flat pull-right">Simpan
                                    </button>
                                    <a href="<?= base_url() ?>pemeriksaan/listpemeriksaanPasien"
                                       class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
                                </div>
                            <?php endif; ?>
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

<?php function renderLaborat() { ?>

    <br>
    <hr>
    <h4 class="box-title text-center"><strong>Hematologi</strong></h4>

    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Hemoglobin</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="hemoglobin" name="hemoglobin" value="">
            <span class="input-group-addon">P:13.0 - 16.0 | W:12.0 - 14.0</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">LED 1jam/2jam</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="led" name="led" value="">
            <span class="input-group-addon">P < 10 | W < 15</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Leukosit</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="leukosit" name="leukosit" value="">
            <span class="input-group-addon">5000-10000</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Hitung Jenis</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="hitung" name="hitung" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Eosinophyl</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="eosinophyl" name="eosinophyl" value="">
            <span class="input-group-addon">1-3 </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Basophyl</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="basophyl" name="basophyl" value="">
            <span class="input-group-addon">0-1</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Stab</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="stab" name="stab" value="">
            <span class="input-group-addon">2-6</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Segment</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="segment" name="segment" value="">
            <span class="input-group-addon">50-70</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Lymposit</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="lymposit" name="lymposit" value="">
            <span class="input-group-addon">20-40</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Monosit</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="monosit" name="monosit" value="">
            <span class="input-group-addon">2-8</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Sel Lainnya</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="sel_lainnya" name="sel_lainnya" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Eosinofil</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="eosinofil" name="eosinofil" value="">
            <span class="input-group-addon">50-300</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Erytrosit</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="eritrosit" name="eritrosit" value="">
            <span class="input-group-addon">P:4.5 - 5.5 | W:4.0 - 5.0</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Trombocyt</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="trombocyt" name="trombocyt" value="">
            <span class="input-group-addon">150.000 - 500.000</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Reticulocyt</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="reticulocyt" name="reticulocyt" value="">
            <span class="input-group-addon">0.5-1.5</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Hematacrit</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="hematacrit" name="hematacrit" value="">
            <span class="input-group-addon">P:40-48% | W:37-43% | A:31-47%</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">MCV</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="mcv" name="mcv" value="">
            <span class="input-group-addon">82-92</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">MCH</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="mch" name="mch" value="">
            <span class="input-group-addon">27-31</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">MCHC</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="mchc" name="mchc" value="">
            <span class="input-group-addon">32-36</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Waktu Pendarahan</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="waktu_pendarahan" name="waktu_pendarahan" value="">
            <span class="input-group-addon">1-3</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Waktu Pembekuan</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="waktu_pembekuan" name="waktu_pembekuan" value="">
            <span class="input-group-addon">10-15</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Waktu Prothombin</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="waktu_prothombin" name="waktu_prothombin" value="">
            <span class="input-group-addon">11-14</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Waktu Rekalsifikasi</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="waktu_rkalsifikasi" name="waktu_rekalsifikasi" value="">
            <span class="input-group-addon">100-250</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">PTT</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="ptt" name="ptt" value="">
            <span class="input-group-addon">30-40</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Thrombotes Owren</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="thrombotes_owren" name="thrombotes_owren" value="">
            <span class="input-group-addon">70-100</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Fibrinogen</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="fibrinogen" name="fibrinogen" value="">
            <span class="input-group-addon">200-400</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Retraksi Bekuan</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="retraksi_bekuan" name="retraksi_bekuan" value="">
            <span class="input-group-addon">40-60</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Retraksi Osmotik</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="retraksi_osmotik" name="retraksi_osmotik" value="">
            <span class="input-group-addon">0.40-0.30</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Malaria</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="malaria" name="malaria" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Plasmodium Falcifarum</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="plasmodium_falcifarum" name="plasmodium_falcifarum" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Plasmodium Vivax</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="plasmodium_vivax" name="plasmodium_vivax" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Prc Pembendungan</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="prc_pembendungan" name="prc_pembendungan" value="">
            <span class="input-group-addon">Pethecia < 10</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Darah Lengkap</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="darah_lengkap" name="darah_lengkap" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">RDW-CV</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="rdw_cv" name="rdw_cv" value="">
            <span class="input-group-addon">11.5-14.5</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">RDW-SD</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="rdw_sd" name="rdw_sd" value="">
            <span class="input-group-addon">35-56</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">MPV</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="mpv" name="mpv" value="">
            <span class="input-group-addon">7-11</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">PDW</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="pdw" name="pdw" value="">
            <span class="input-group-addon">15-17</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">PCT</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="pct" name="pct" value="">
            <span class="input-group-addon">0.108-0.282</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Limfosit</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="limfosit" name="limfosit" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Analisa HB (HPLC)</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="analisa_hb" name="analisa_hb" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Analisa HB (HPLC)</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="analisa_hb" name="analisa_hb" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">HbA2</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="hba2" name="hba2" value="">
            <span class="input-group-addon">2.0-3.6%</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">HbF</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="hbf" name="hbf" value="">
            <span class="input-group-addon">< 1%</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Ferritin</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="ferritin" name="ferritin" value="">
            <span class="input-group-addon">13-150</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">TIBC</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="tibc" name="tibc" value="">
            <span class="input-group-addon">260-389</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">PT</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="pt" name="pt" value="">
            <span class="input-group-addon">10.70-14.30</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">APTT</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="aptt" name="aptt" value="">
            <span class="input-group-addon">21.00-36.50</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">INR</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="inr" name="inr" value="">
            <span class="input-group-addon">0.8-1.2</span>
        </div>
    </div>

    <h4 class="box-title text-center"><strong>FUNGSI GINJAL</strong></h4>

    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Ureum Darah</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="ureum_darah" name="ureum_darah" value="">
            <span class="input-group-addon">10-50</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Ureum Urin</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="ureum_urin" name="ureum_urin" value="">
            <span class="input-group-addon">20-35</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Creatine Darah</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="creatine_darah" name="creatin_darah" value="">
            <span class="input-group-addon">0.7-1.7</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Creatine Urine</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="creatine_urine" name="creatin_urine" value="">
            <span class="input-group-addon">1-3</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Creatine Clearence</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="creatine_clearence" name="creatin_clearence" value="">
            <span class="input-group-addon">117+20</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Urea Clearence</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="urea_clearence" name="urea_clearence" value="">
            <span class="input-group-addon">70-100</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Alkali Reserve</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="alkali_reserve" name="alkali_reserve" value="">
            <span class="input-group-addon">24-31</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Fosfat Anorganik</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="fosfat_anorganik" name="fosfat_anorganik" value="">
            <span class="input-group-addon">2-4 (dewasa) | 5-6 (anak) </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Uric Acid</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="uric_acid" name="uric_acid" value="">
            <span class="input-group-addon">P:3.4-7.0 | W:2.4-5.7</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Serum Iron</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="serum_iron" name="serum_iron" value="">
            <span class="input-group-addon">P:53-167 | W:49-151</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">TIBC</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="tibc" name="tibc" value="">
            <span class="input-group-addon">280-400</span>
        </div>
    </div>

    <h4 class="box-title text-center"><strong>FUNGSI HATI</strong></h4>

    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Bilirudin Total</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="bilirudin_total" name="bilirudin_total" value="">
            <span class="input-group-addon">0.3-1.0</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Bilirudin Direk</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="bilirudin_direk" name="bilirudin_direk" value="">
            <span class="input-group-addon">sd 0.4</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Bilirudin Indirek</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="bilirudin_indirek" name="bilirudin_indirek" value="">
            <span class="input-group-addon">sd 0.6</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Protein Total</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="protein_total" name="protein_total" value="">
            <span class="input-group-addon">6.8 - 8.7</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Albumin</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="albumin" name="albumin" value="">
            <span class="input-group-addon">3.8 - 5.1</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">SGOT</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="sgot" name="sgot" value="">
            <span class="input-group-addon">P:s/d 37 | W:s/d 31</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">SGPT</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="sgpt" name="sgpt" value="">
            <span class="input-group-addon">P:s/d 40 | W:s/d 31</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Gamma GT</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="gamma_gt" name="gamma_gt" value="">
            <span class="input-group-addon">11-61</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Askali Fosfatase</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="askali_fosfatase" name="askali_fosfatase" value="">
            <span class="input-group-addon">34-114</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Chollinesterase (CHE)</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="chollinesterase" name="chollinesterase" value="">
            <span class="input-group-addon">4620-11500</span>
        </div>
    </div>

    <h4 class="box-title text-center"><strong>FUNGSI JANTUNG</strong></h4>

    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">CK</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="ck" name="ck" value="">
            <span class="input-group-addon">W:24-170</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">LDH</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="ldh" name="ldh" value="">
            <span class="input-group-addon"> <480 </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Ck-M8</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="ck_m8" name="ck_m8" value="">
            <span class="input-group-addon"> <25 </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Alpha HBDH</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="alpha_hbdh" name="alpha_hbdh" value="">
            <span class="input-group-addon">65-165</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Globulin</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="globulin" name="globulin" value="">
            <span class="input-group-addon">1.5-3.6</span>
        </div>
    </div>

    <h4 class="box-title text-center"><strong>GULA DARAH</strong></h4>

    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Gula Darah Puasa</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="gula_darah_puasa" name="gula_darah_puasa" value="">
            <span class="input-group-addon">70-100</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Reduksi</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="reduksi" name="reduksi" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Gula Darah 2 jam PP</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="gula_darah_2jam" name="gula_darah_2jam" value="">
            <span class="input-group-addon"> <=140 </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Reduksi</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="reduksi" name="reduksi" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Gula Darah Sewaktu</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="gula_darah_sewaktu" name="gula_darah_sewaktu" value="">
            <span class="input-group-addon"> <=180 </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">GTT:Puasa</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="gtt_puasa" name="gtt_puasa" value="">
            <span class="input-group-addon">70-100</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">GTT:1/2jam</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="gtt_1/2jam" name="gtt_1/2jam" value="">
            <span class="input-group-addon">110-170</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">GTT:1jam</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="gtt_1jam" name="gtt_1jam" value="">
            <span class="input-group-addon">120-170</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">GTT:1 1/2jam</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="gtt_11/2jam" name="gtt_11/2jam" value="">
            <span class="input-group-addon">100-140</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">GTT:2jam</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="gtt_2jam" name="gtt_2jam" value="">
            <span class="input-group-addon">20-120</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Hb A1-C</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="hb_A-1c" name="hb_A-1c" value="">
            <span class="input-group-addon">4.2-7.0</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">II</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="ii" name="ii" value="">
            <span class="input-group-addon">4-7</span>
        </div>
    </div>

    <h4 class="box-title text-center"><strong>PROFIL LEMAK</strong></h4>

    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Cholesterol Total</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="cholesterol_total" name="cholesterol_total" value="">
            <span class="input-group-addon">150-200</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">HDL Cholesterol</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="hdl_cholesterol" name="hdl_cholesterol" value="">
            <span class="input-group-addon">P:35-55 | W:45-65</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">LDL Cholesterol</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="ldl_cholesterol" name="ldl_cholesterol" value="">
            <span class="input-group-addon">100-130</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Triglycerida</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="triglycerida" name="triglycerida" value="">
            <span class="input-group-addon">40-155</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Lipid Total</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="lipid_total" name="lipid_total" value="">
            <span class="input-group-addon">600-1000</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Cholesterol LDL Direk</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="cholesterol_ldl_direk" name="cholesterol_ldl_direk" value="">
            <span class="input-group-addon"> <140 </span>
        </div>
    </div>

    <h4 class="box-title text-center"><strong>ELEKTROLIT dan GAS DARAH</strong></h4>

    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Natrium</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="natrium" name="natrium" value="">
            <span class="input-group-addon">135-147</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Kalium</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="kalium" name="kalium" value="">
            <span class="input-group-addon">3.5-5.5</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Chlorida</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="chlorida" name="chlorida" value="">
            <span class="input-group-addon">96-106</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Calsium</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="calsium" name="calsium" value="">
            <span class="input-group-addon">8.1-10.4</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Magnesium</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="magnesium" name="magnesium" value="">
            <span class="input-group-addon">1.58 - 2.55</span>
        </div>
    </div>

    <h4 class="box-title text-center"><strong> MIKROBIOLOGI</strong></h4>

    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Pengecatan Gram</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="pengecatan_gram" name="pengecatan_gram" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">BTA</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="bta" name="bta" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Mikroskopik Gonorhe</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="mikroskopik_gonore" name="mikroskopik_gonore" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Trikomonas</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="trikomonas" name="trikomonas" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Jamur</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="jamur" name="jamur" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Kultur dan Sensitifitas Tes</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="kultur_sensitivitas" name="kultur_sensitivitas" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Batang Gram-</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="batang_gram-" name="batang_gram-" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Batang Gram+</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="batang_gram+" name="batang_gram+" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Coccus Gram-</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="coccus_gram-" name="coccus_gram-" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Coccus Gram+</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="coccus_gram+" name="coccus_gram+" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Trichomonas</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="trichomonas" name="trichomonas" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Mikroskopik Candida</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="mikroskopik_candida" name="mikroskopik_candida" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>

    <h4 class="box-title text-center"><strong>SEROIMONOLOGI</strong></h4>

    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Widal</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="widal" name="widal" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Salmonela Typhi O</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="salmonela_typhi_O" name="salmonela_typhi_O" value="">
            <span class="input-group-addon">Negatif - </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Salmonela Typhi H</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="salmonela_typhi_h" name="salmonela_typhi_h" value="">
            <span class="input-group-addon">Negatif - </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Salmonela Paratyphi A-H</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="salmonela_paratyphi_a_h" name="salmonela_paratyphi_a_h"
                   value="">
            <span class="input-group-addon">Negatif - </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Salmonela Paratyphi AO</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="salmonela_paratyphi_ao" name="salmonela_paratyphi_ao" value="">
            <span class="input-group-addon">Negatif - </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Salmonela Paratyphi BO</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="salmonela_paratyphi_bo" name="salmonela_paratyphi_bo" value="">
            <span class="input-group-addon">Negatif - </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Salmonela Paratyphi CO</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="salmonela_paratyphi_co" name="salmonela_paratyphi_co" value="">
            <span class="input-group-addon">Negatif - </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Salmonela Paratyphi BH</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="salmonela_paratyphi_bh" name="salmonela_paratyphi_bh" value="">
            <span class="input-group-addon">Negatif - </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Salmonela Paratyphi CH</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="salmonela_paratyphi_ch" name="salmonela_paratyphi_ch" value="">
            <span class="input-group-addon">Negatif - </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">HBsAg</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="hbsag" name="hbsag" value="">
            <span class="input-group-addon">0.13</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">HIV</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="hiv" name="hiv" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">TPHA</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="tpha" name="tpha" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Rhematoid Factor</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="rhematoid_factor" name="hbsag" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Dengue Ig G</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="dengue_ig_g" name="dengue_ig_g" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Dengue Ig M</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="dengue_ig_m" name="dengue_ig_m" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Anti HBsAg</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="anti_hbsag" name="anti_hbsag" value="">
            <span class="input-group-addon">Negatif < 8 | Positif > 12</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Anti-HBc Total</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="antihbc_total" name="antihbc_total" value="">
            <span class="input-group-addon">Positif < 1.0 | Negatif => 1.40</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">HBc</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="hbc" name="hbc" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Anti TB Ig M</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="anti_tb_ig_m" name="anti_tb_ig_m" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Anti TB Ig G</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="anti_tb_ig_g" name="anti_tb_ig_g" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">HCV</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="hcv" name="hcv" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Anti HEV Ig M</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="anti_hev_ig_m" name="anti_hev_ig_m" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Anti HEV Ig G</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="anti_hev_ig_g" name="anti_hev_ig_g" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">HBeAg</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="hbeag" name="hbeag" value="">
            <span class="input-group-addon">Negativ < 0.10 | Positif => 0.10</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Anti HBe</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="anti_hbe" name="anti_hbe" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">VDRL</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="vdrl" name="vdrl" value="">
            <span class="input-group-addon">non reaktif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">ASTO</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="asto" name="asto" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>

    <h4 class="box-title text-center"><strong>CRP</strong></h4>

    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Titer Reumatoid Factor</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="titer_reumatoid_factor" name="titer_reumatoid_factor" value="">
            <span class="input-group-addon">Negatif: < 8</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Anti HAV IgM</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="anti_hav_igm" name="anti_hav_igm" value="">
            <span class="input-group-addon">Negatif < 0.4 | Positif =>0.5</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Anti HCV</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="anti_hcv" name="anti_hcv" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Toxoplasma Ig A</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="toxoplasma_ig_a" name="toxoplasma_ig_a" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Toxoplasma Ig G</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="toxoplasma_ig_g" name="toxoplasma_ig_g" value="">
            <span class="input-group-addon">Negatif < 4 | Positif => 8 </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Toxoplasma Ig G</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="toxoplasma_ig_g" name="toxoplasma_ig_g" value="">
            <span class="input-group-addon">Negatif < 4 | Positif => 8 </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Toxoplasma Ig M</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="toxoplasma_ig_m" name="toxoplasma_ig_m" value="">
            <span class="input-group-addon">Negatif < 0.55 | Positif => 0.65</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Rubella Ig G</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="rubella_ig_g" name="rubella_ig_g" value="">
            <span class="input-group-addon">Negatif < 10 | Positif => 15</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Rubella Ig M</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="rubella_ig_m" name="rubella_ig_m" value="">
            <span class="input-group-addon">Negatif < 0.80 | Positif => 1.20</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Anti CMV Ig G</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="anti_cmv_ig_g" name="anti_cmv_ig_g" value="">
            <span class="input-group-addon">Negatif < 4 | Positif => 6</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Anti CMV Ig M</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="anti_cmv_ig_m" name="anti_cmv_ig_m" value="">
            <span class="input-group-addon">Negatif < 0.7 | Positif => 0.9</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Anti HSV2 Ig G</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="anti_hsv2_ig_g" name="anti_hsv2_ig_g" value="">
            <span class="input-group-addon">Negatif < 0.8 | Positif => 1.1</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Anti HSV2 Ig M</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="anti_hsv2_ig_m" name="anti_hsv2_ig_m" value="">
            <span class="input-group-addon">Negatif < 0.8 | Positif => 1.1</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">TB ICT</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="tb_ict" name="tb_ict" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Tes Mantoux</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="tes_mantaoux" name="tes_mantoux" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Dengue NS1</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="dengue_ns1" name="dengue_ns1" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Anti HBsAg</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="anti_hbsag" name="anti_hbsag" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Chikungunya IgM</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="chikungunya_igm" name="chinkungunya_igm" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Salmonella IgG</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="salmonella_igg" name="salmonella_igg" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Salmonella IgM</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="salmonella_igm" name="salmonella_igm" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Serum Iron NS1</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="serum_iron" name="serum_iron" value="">
            <span class="input-group-addon">62-173</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">CA 125</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="ca_125" name="ca_125" value="">
            <span class="input-group-addon"> < 35 </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Leptospira_IgM</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="leptospora_igm" name="leptospora_igm" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">TPHA</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="tpha" name="tpha" value="">
            <span class="input-group-addon">Non Reaktif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">HBsAg</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="hbsag" name="hbsag" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">IgM Anti Salmonella Typhi</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="igm_anti_salmonella_typhi" name="igm_anti_salmonella_typhi"
                   value="">
            <span class="input-group-addon">Negatif <= 2 | Borderline:3</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Anti Hbs Titer</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="anti_hbs_titer" name="anti_hbs_titer" value="">
            <span class="input-group-addon">Negatif < 10 | Positif => 10</span>
        </div>
    </div>

    <h4 class="box-title text-center"><strong>URINALISA</strong></h4>

    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Urin Rutin</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="urin_rutin" name="urin_rutin" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Fisis Warna</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="fisis_warna" name="fisis_warna" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Kejernihan</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="kejernihan" name="kejernihan" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Bau</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="bau" name="bau" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Kimia PH</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="kimia_ph" name="kimia_ph" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Berat Jenis</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="berat_jenis" name="berat_jenis" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Protein</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="protein" name="protein" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Glukosa</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="glukosa" name="glukosa" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Urobillinogen</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="urobillinogen" name="urobillinogen" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Billirudin</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="billirudin" name="billirudin" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Keton</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="keton" name="keton" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Lekosit Esterase</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="lekosit_esterase" name="lekosit_esterase" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Nitrit</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="nitrit" name="nitrit" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Blood</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="blood" name="blood" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Sedimen Epitel</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="sedimen_epitel" name="sedimen_epitel" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Lekosit</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="lekosit" name="lekosit" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Erytrosit</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="erystrosit" name="erytrosit" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Silinder Granula</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="silinder_granula" name="silinder_granula" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Silinder Lekosit</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="silinder_lekosit" name="silinder_lekosit" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Kristal</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="kristal" name="kristal" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Bakteri</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="bakteri" name="bakteri" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Trikomonas</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="trikomonas" name="trikomonas" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Candida</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="candida" name="candida" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Silinder Eritrosit</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="silinder_eritrosit" name="silinder_eritrosit" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Silinder Hyalin</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="silinder_hyalin" name="silinder_hyalin" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>

    <h4 class="box-title text-center"><strong>FESES</strong></h4>

    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Warna</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="warnar" name="warna" value="">
            <span class="input-group-addon">Khas</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Bau</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="bau" name="bau" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Konsistensi</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="konsistensi" name="konsistensi" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Mikroskopis</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="mikroskopis" name="mikroskopis" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Telur Cacing</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="telur_cacing" name="telur_cacing" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Amuba</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="amuba" name="amuba" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Sisa Pencernaan</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="sisa_pencernaan" name="sisa_pencernaan" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Protein</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="Protein" name="protein" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Lemak</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="lemak" name="lemak" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Karbohidrat</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="karbohidrat" name="karbohidrat" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Bensidin Test</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="bensidin_test" name="bensidin_test" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>

    <h4 class="box-title text-center"><strong>SPERMATOZOA</strong></h4>

    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Metode</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="metode" name="metode" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Abstinensia</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="abstinensia" name="abstinensia" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Dikeluarkan Jam</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="dikeluarkan_jam" name="dikeluarkan_jam" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Diterima di lab jam</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="diterima_di_lab_jam" name="diterima_di_lab_jam" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Diperiksa jam</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="diperiksa_jam" name="diperiksa_jam" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">I MAKROSKOPIS</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="i_makroskopis" name="i_makroskopis" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Warna</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="warna" name="warna" value="">
            <span class="input-group-addon">Putih Abu-Abu</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Liquefaksi</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="liquefaksi" name="liquefaksi" value="">
            <span class="input-group-addon"> < 60 menit</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Konsistensi</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="konsistensi" name="konsistensi" value="">
            <span class="input-group-addon">Encer</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Bau</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="bau" name="bau" value="">
            <span class="input-group-addon">Khas</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Volume</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="volume" name="volume" value="">
            <span class="input-group-addon"> => 2ml</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">PH</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="ph" name="ph" value="">
            <span class="input-group-addon">7.2 - 7.8</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">II Mikroskopis</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="ii_mikroskopis" name="ii_mikroskopis" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Konsentrasi( x 10^6/ml)</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="konsentrasi" name="konsentrasi" value="">
            <span class="input-group-addon">=>20 x ( 10^6/ml)</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Motilitas(%)</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="motilitas" name="motilitas" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">A Linier Cepat</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="a_linier_cepat" name="a_linier_cepat" value="">
            <span class="input-group-addon">=>50% (A)+(B)</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">B Linier Lambat</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="b_linier_lambat" name="b_linier_lambat" value="">
            <span class="input-group-addon">atau</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">C Tidak Progressif</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="c_tidak_progressif" name="c_tidak_progressif" value="">
            <span class="input-group-addon">=>25%(A)</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">D Tidak Motil</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="d_tidak_motil" name="d_tidak_motil" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Viabilitas (%hidup)</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="viabilitas_(%hidup)" name="viabilitas_(%hidup)" value="">
            <span class="input-group-addon">=>75%</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Morfologi (%Normal)</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="morfologi_(%normal)" name="morfologi_(%normal)" value="">
            <span class="input-group-addon">=>30%</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Morfologi Abnormal(K,L,E, Cyt)</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="morfologi_abnormal" name="morfologi_abnormal" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Sel Bulat( x10^6/ml)</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="sel_bulat" name="sel_bulat" value="">
            <span class="input-group-addon">< 1x10^6/ml</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Sel Leukosit( x10^6/ml)</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="sel_leukosit" name="sel_leukosit" value="">
            <span class="input-group-addon">< 1x10^6/ml</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Aglutinasi</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="aglutinasi" name="aglutinasi" value="">
            <span class="input-group-addon">Tidak</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Fruktosa</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="fruktosa" name="fruktosa" value="">
            <span class="input-group-addon">> 13 u mol/ejakulat</span>
        </div>
    </div>

    <h4 class="box-title text-center"><strong>HORMON</strong></h4>

    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">T3</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="t3" name="t3" value="">
            <span class="input-group-addon">0.92-2.33</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">T4</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="t4" name="t4" value="">
            <span class="input-group-addon">60-120</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">TSH</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="tsh" name="tsh" value="">
            <span class="input-group-addon">Hipertiroid < 0.15 | Euthyroid 0.25 - 5</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">FT4</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="ft4" name="ft4" value="">
            <span class="input-group-addon">1.6-19.4</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Egfr</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="egfr" name="egfr" value="">
            <span class="input-group-addon">Normal =>90 | Ringan:60-89</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">TSHs</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="tshs" name="tshs" value="">
            <span class="input-group-addon">0.27 - 4.70</span>
        </div>
    </div>

    <h4 class="box-title text-center"><strong>PETANDA TUMOR</strong></h4>

    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">CEA</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="cea" name="cea" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">AFP</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="afp" name="afp" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">PSA</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="psa" name="psa" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">CEA</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="cea" name="cea" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    </div>

    <h4 class="box-title text-center"><strong>ADMINISTRASI</strong></h4>

    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Administrasi</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="administrasi" name="administrasi" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>

    <h4 class="box-title text-center"><strong>BAHAN</strong></h4>

    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Lancet</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="lancet" name="lancet" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Spuit 3cc</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="spuit_3cc" name="spuit_3cc" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Spuit 5cc</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="spuit_5cc" name="spuit_5cc" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Vacutainer</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="vacutainer" name="vacutainer" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Wing Needle</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="wing_needle" name="wing_needle" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Spuit 1cc</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="spuit_1cc" name="spuit_1cc" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Hand Scun</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="hand_scun" name="spuit_3cc" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>

    <h4 class="box-title text-center"><strong>NARKOBA</strong></h4>

    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Amphetamine</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="amphetamine" name="amphetamine" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Morphine</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="spuit_3cc" name="spuit_3cc" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">BZO (Benzodizepiner)</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="bzo_(benzodizepiner)" name="bzo_(benzodizepiner)" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">THC (Marijuana)</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="thc_(marijuana)" name="thc_(marijuana)" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">MET (Methamphetamine)</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="met_(methamphetamine)" name="met_(methamphetamine)" value="">
            <span class="input-group-addon">Negatif</span>
        </div>
    </div>

    <h4 class="box-title text-center"><strong>KEHAMILAN</strong></h4>

    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Tes Kehamilan</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="tes_kehamilan" name="tes_kehamilan" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>

    <h4 class="box-title text-center"><strong>GOLONGAN DARAH</strong></h4>

    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Rhesus</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="rhesus" name="rhesus" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputtext3" class="col-sm-3 control-label">Golongan Darah</label>
        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control" id="golongan_darah" name="golongan_darah" value="">
            <span class="input-group-addon"> </span>
        </div>
    </div>
<?php } ?>

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
