<?php

function isGigi($pendaftaran) {
    return $pendaftaran['kode_daftar'] == 'PG' || $pendaftaran['kode_daftar'] == 'BPJS-PG';
}

function isLab($pendaftaran) {
    return $pendaftaran['kode_daftar'] == 'PL' || $pendaftaran['kode_daftar'] == 'BPJS-PL';
}

function isHd($pendaftaran) {
    return $pendaftaran['kode_daftar'] == 'PHD' || $pendaftaran['kode_daftar'] == 'BPJS-PHD';
}

function isEkg($pendaftaran) {
    return $pendaftaran['kode_daftar'] == 'PE';
}

function isSpirometri($pendaftaran) {
    return $pendaftaran['kode_daftar'] == 'P-Sirometri';
}

function isBpjs($pendaftaran) {
    return strpos($pendaftaran, 'BPJS') !== false;
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
        if (isset($data_poli[$value]) && $data_poli[$value]['kode']) {
            if (in_array($kode_daftar, $data_poli[$value]['kode'])) return true;
        }
    }

    return false;
}

$data_poli = $this->config->item('poli');;
$kode_poli = getKodePoli($pendaftaran['kode_daftar'], $data_poli);
$isDataPendukung = isPendukung($pendaftaran['kode_daftar'], $data_poli);

class InputBuilder {

    var $name;
    var $label;
    var $value = '';
    var $sm = 9;
    var $placeholder = '';
    var $unit = '';
    var $options;
    var $selectedOptIds;

    var $optdisplay;
    var $onkeyup;

    var $united = false;
    var $textarea = false;
    var $select = false;
    var $required = false;
    var $readonly = false;
    var $hide = false;

    function __construct($name, $label, $sm) {
        $this->name = $name;
        $this->label = $label;
        $this->sm = $sm;
    }

    public function val($v) {
        $this->value = $v;
        return $this;
    }

    public function placeholder($v) {
        $this->placeholder = $v;
        return $this;
    }

    public function unit($v) {
        $this->unit = $v;
        return $this;
    }

    public function united() {
        $this->united = true;
        return $this;
    }

    public function textarea() {
        $this->textarea = true;
        return $this;
    }

    public function select() {
        $this->select = true;
        return $this;
    }

    public function options($v) {
        $this->options = $v;
        return $this;
    }

    public function selectedOptions($v) {
        $this->selectedOptIds = array_map(function ($d) { return $d->id; }, $v);
        return $this;
    }

    public function display($v) {
        $this->optdisplay = $v;
        return $this;
    }

    public function onkeyup($v) {
        $this->onkeyup = $v;
        return $this;
    }

    public function required() {
        $this->required = true;
        return $this;
    }

    public function readonly() {
        $this->readonly = true;
        return $this;
    }

    public function hide() {
        $this->hide = true;
        return $this;
    }

    public function build() {
        if ($this->select) {
            $this->buildSelect($this->hide);
        }
        else if ($this->united) {
            $this->buildUnited($this->hide);
        }
        else {
            $this->buildTypeText($this->hide);
        }
    }

    public function buildTypeText($hide) { ?>
        <div class="form-group <?=$hide ? 'hidden' : ''?>">
            <label for="<?= $this->name ?>" class="col-sm-3 control-label"><?= $this->label ?></label>
            <div class="col-sm-<?= $this->sm ?>">
                <?php if ($this->textarea) : ?>
                    <textarea type="text" class="form-control" name="<?= $this->name ?>" id="<?= $this->name ?>"
                              <?= $this->required ? 'required' : '' ?> <?= $this->readonly ? 'readonly' : '' ?>><?= $this->value ?></textarea>
                <?php else : ?>
                    <input type="text" class="form-control" name="<?= $this->name ?>" id="<?= $this->name ?>"
                           value="<?= $this->value ?>" <?= $this->required ? 'required' : '' ?> <?= $this->readonly ? 'readonly' : '' ?>>
                <?php endif; ?>
            </div>
        </div>
    <?php }

    public function buildSelect($hide) {
        if ($this->name == "tindakan[]"){ ?>
            <div class="form-group <?=$hide ? 'hidden' : ''?>">
                <label for="<?= $this->name ?>" class="col-sm-3 control-label"><?= $this->label ?></label>
                <div class="col-sm-<?= $this->sm ?>">
                    <select class="form-control select2" multiple="multiple" name="<?= $this->name ?>"
                            data-placeholder="<?= $this->placeholder ?>"
                            style="width: 100%;"
                        <?= $this->required ? 'required' : '' ?>
                        <?= $this->readonly ? 'disabled="disabled"' : '' ?>>
                        <?php foreach ($this->options as $key => $value) {
                            $select = ($value->nama == "Administrasi" || in_array($value->id, $this->selectedOptIds)) ? 'selected' : ''; ?>
                            <option value="<?= $value->id; ?>" <?php echo $select; ?> ><?= call_user_func($this->optdisplay, $value) ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        <?php   } else { ?>
            <div class="form-group <?=$hide ? 'hidden' : ''?>">
                <label for="<?= $this->name ?>" class="col-sm-3 control-label"><?= $this->label ?></label>
                <div class="col-sm-<?= $this->sm ?>">
                    <select class="form-control select2" multiple="multiple" name="<?= $this->name ?>"
                            data-placeholder="<?= $this->placeholder ?>"
                            style="width: 100%;"
                        <?= $this->required ? 'required' : '' ?>
                        <?= $this->readonly ? 'disabled="disabled"' : '' ?>>
                        <?php foreach ($this->options as $key => $value) {
                            $select = (in_array($value->id, $this->selectedOptIds)) ? 'selected' : ''; ?>
                            <option value="<?= $value->id; ?>" <?php echo $select; ?> ><?= call_user_func($this->optdisplay, $value) ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <?php
        }
    }

    public function buildUnited($hide) { ?>
        <div class="col-sm-6 col-md-6 col-lg-6 form-group <?=$hide ? 'hidden' : ''?>">
            <label for="<?= $this->name ?>" class="col-sm-3 control-label"><?= $this->label ?></label>
            <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                <input
                    type="text"
                    class="form-control"
                    id="<?= $this->name ?>"
                    name="<?= $this->name ?>"
                    value="<?= $this->value ?>"
                    <?= $this->required ? 'required' : '' ?>
                    <?= $this->readonly ? 'readonly' : '' ?>
                    <?= isset($this->onkeyup) && $this->onkeyup != '' ? 'onkeyup=' . $this->onkeyup : '' ?>
                >
                <span class="input-group-addon"><?= $this->unit ?></span>
            </div>
        </div>
    <?php }
}

function unit($name, $label) {
    $i = new InputBuilder($name, $label, 9);
    $i->united();
    return $i;
}

function sel($name, $label) {
    $i = new InputBuilder($name, $label, 9);
    $i->select();
    return $i;
}

function sm4($name, $label) {
    return new InputBuilder($name, $label, 4);
}

function sm9($name, $label) {
    return new InputBuilder($name, $label, 9);
}

function odontogram() {
    $src = base_url().'/assets/img/odontogram.png';
    echo '<center><img src="'.$src.'" width="400px;"></center>';
}

function br() {
    echo '<br>';
}

function hasil_penunjang($pemeriksaan) {
    if ($pemeriksaan['hasil_penunjang'] == 'null') {
        return '';
    }
    $hasil_penunjang = json_decode($pemeriksaan['hasil_penunjang']);
    return '
    <div class="form-group">
        <label for="hasil_penunjang_laboratorium" class="col-sm-3 control-label">
            Hasil Penunjang
        </label>
    </div>
    <div class="form-group">
        <label for="hasil_penunjang_laboratorium" class="col-sm-3 control-label">
            Laboratorium
        </label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="hasil_penunjang_laboratorium" id="hasil_penunjang_laboratorium" value="'.$hasil_penunjang->laboratorium.'" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="hasil_penunjang_laboratorium" class="col-sm-3 control-label">
            EKG
        </label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="hasil_penunjang_ekg" id="hasil_penunjang_ekg" value="'.$hasil_penunjang->ekg.'" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="hasil_penunjang_laboratorium" class="col-sm-3 control-label">
            Spirometri
        </label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="hasil_penunjang_spirometri" id="hasil_penunjang_spirometri" value="'.$hasil_penunjang->spirometri.'" readonly>
        </div>
    </div>
    ';
} ?>

?>

<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/iCheck/all.css">

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
            <div class="col-md-7">

                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title"> No. Rekam Medis : <?= $pendaftaran['no_rm']; ?> </h3>
                    </div>
                    <div class="box-body">
                        <form class="form-horizontal" method="post" action="<?= base_url()?>laporan/SimpanEditRekamMedis/<?= $pemeriksaan['id'] ?>" enctype="multipart/form-data">
                            <input type="hidden" name="pendaftaran_id" id="pendaftran_id" value="<?= $pemeriksaan['pendaftaran_id']; ?>">
                            <input type="hidden" name="to" value="<?=$to?>">
                            <div class="box-body">

                                <input type="hidden" name="pasien_id" value="<?= $pasien_terpilih->id ?>">
                                <input type="hidden" name="kode_daftar" value="<?= $pendaftaran['kode_daftar'] ?>">

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
                                sm9('status_fisik', 'Status Fisik')->val($kajian_perawat['status_fisik'])->build();
                                sm9('psikososial', 'Psikososial')->val($kajian_perawat['psikososial'])->build();
                                sm9('riwayat_kesehatan_pasien', 'Riwayat Kesehatan Pasien')->val($kajian_perawat['riwayat_kesehatan_pasien'])->build();
                                sm9('riwayat_penggunaan_obat', 'Riwayat Penggunaan Obat')->val($kajian_perawat['riwayat_penggunaan_obat'])->build();
                                ?>
                                <br>

                                <?php

                                if (isLab($pendaftaran)) {
                                    $this->load->view('pemeriksaan/form_laborat');
//                                    renderLaborat();
                                } elseif ($isDataPendukung) {
                                    $this->load->view('pemeriksaan/poli/' . $kode_poli, []);
                                } else {
                                    sm9('diagnosa_perawat', 'Diagnosa Perawat')->val($pemeriksaan['diagnosa_perawat'])->build();
                                    sm9('keluhan_utama', 'Keluhan Utama')->val($pemeriksaan['keluhan_utama'])->build();

                                    switch ($kode_poli) {
                                        case 'gigi':
                                            odontogram();
                                            br();
                                            sm9('catatan_odontogram', 'Catatan Odontogram')->val($pemeriksaan['catatan_odontogram'])->build();
                                            break;

                                        case 'mata':
                                            sm9('amammesia', 'Anamnesis')->val($pemeriksaan['amammesia'])->build();
                                            $this->load->view('pemeriksaan/poli/mata', []);
                                            break;

                                        case 'kulit':
                                            sm9('amammesia', 'Anamnesis')->val($pemeriksaan['amammesia'])->build();
                                            $this->load->view('pemeriksaan/poli/kulit', []);
                                            break;

                                        case 'tht':
                                            sm9('amammesia', 'Anamnesis')->val($pemeriksaan['amammesia'])->build();
                                            $this->load->view('pemeriksaan/poli/tht', []);
                                            break;

                                        case 'anak':
                                            sm9('amammesia', 'Anamnesis')->val($pemeriksaan['amammesia'])->build();
                                            $this->load->view('pemeriksaan/poli/anak', []);
                                            break;

                                        case 'obgyn':
                                            sm9('amammesia', 'Anamnesis')->val($pemeriksaan['amammesia'])->build();
                                            $this->load->view('pemeriksaan/poli/obgyn', []);
                                            break;

                                        case 'jiwa':
                                            sm9('amammesia', 'Anamnesis')->val($pemeriksaan['amammesia'])->build();
                                            $this->load->view('pemeriksaan/poli/jiwa', []);
                                            break;

                                        case 'syaraf':
                                            sm9('amammesia', 'Anamnesis')->val($pemeriksaan['amammesia'])->build();
                                            $this->load->view('pemeriksaan/poli/syaraf', []);
                                            break;

                                        case 'hd':
                                            sm9('amammesia', 'Anamnesis')->build();
                                            $this->load->view('pemeriksaan/poli/hemodialisis', []);
                                            break;

                                        default:
                                            sm9('amammesia', 'Anamnesis')->val($pemeriksaan['amammesia'])->build();
                                            echo '<img src="'.base_url().'assets/img/manusia.jpeg'.'" alt="Mata OS">';
                                            sm9('pemeriksaan_fisik', 'Pemeriksaan Fisik')->val($pemeriksaan['pemeriksaan_fisik'])->textarea()->build();
                                            break;
                                    }

                                    hasil_penunjang($pemeriksaan);
                                    sm9('asuhan_keperawatan', 'Catatan Alergi/Lainnya')->val($pemeriksaan['asuhan_keperawatan'])->build();
                                }

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
                                            ->options($all_penyakit)
                                            ->selectedOptions($penyakit)
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
                                    sel('diagnosis_jenis_penyakit[]', 'Diagnosis Jenis Penyakit')
                                        ->placeholder('Pilih penyakit untuk pasien')
                                        ->options($penyakit)
                                        ->selectedOptions($s_penyakit)
                                        ->display(function ($value) {
                                            return $value->kode . ' - ' . $value->nama;
                                        })

                                        ->build();

                                    sm9('diagnosis', 'Diagnosis')->val($pemeriksaan['diagnosis'])->build();
                                }

                                sel('tindakan[]', 'Tarif / Tindakan')
                                    ->placeholder('Pilih tindakan untuk pasien')
                                    ->options($tindakan)
                                    ->selectedOptions(array_map(function ($v) {
                                        $v->id = $v->tarif_tindakan_id;
                                        return $v;
                                    }, $s_tindakan))
                                    ->display(function ($value) use (&$pendaftaran) {
                                        return $value->nama . " - Rp." . number_format($value->tarif_pasien, 2, ',', '.');
                                    })

                                    ->build();


                                if (isLab($pendaftaran)) {
                                    sm9('deskripsi_tindakan', 'Tata Laksana')->hide()->val($pemeriksaan['deskripsi_tindakan'])->build();
                                }
                                else {
                                    sm9('deskripsi_tindakan', 'Tata Laksana')->val($pemeriksaan['deskripsi_tindakan'])->build();
                                }

                                if (!in_array($pendaftaran['kode_daftar'], $excap)) {
                                    if (isLab($pendaftaran)) {
                                        sm9('saran_pemeriksaan', 'Rujukan')->hide()->val($pemeriksaan['saran_pemeriksaan'])->build();
                                    }
                                    else {
                                        sm9('saran_pemeriksaan', 'Rujukan')->val($pemeriksaan['saran_pemeriksaan'])->build();
                                    }
                                }
                                ?>

                            </div>

                            <?php foreach ([0,1,2,3] as $k) : ?>
                                <?php $v = $dokumen[$k] ?? null; ?>
                                <?php if ($v) : ?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" style="padding-top: 0 !important;">File Dokumen</label>
                                        <div class="col-sm-9">
                                            <a target="_blank" href="<?=base_url()."upload/$v->dokumen"?>">
                                                <?php if (strpos($v->type, 'image') !== false) : ?>
                                                    <img src="<?=base_url()."upload/$v->dokumen"?>" style="width: 70px; height: 70px; object-fit: cover">
                                                <?php else : ?>
                                                    <?=$v->dokumen?>
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">File Dokumen</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="dokumen[]" class="form-control">
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

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
                <br>
            <?php else: ?>
                <div class="col-sm-12 col-md-12 col-lg-5">
                    <div class="box box-primary">
                        <div class="box-body">
                            <h4 class="box-title">Obat</h4>
                            <table id="example2" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama </th>
                                    <th>Jumlah</th>
                                    <th>Signa</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no=1; foreach ($obat_periksa as $row) { ?>
                                    <tr>
                                        <td> <?php echo $no; ?></td>
                                        <td> <?php echo ucwords($row->nama); ?></td>
                                        <td> <?php echo ucwords($row->jumlah_satuan); ?></td>
                                        <td> <?php echo ucwords($row->signa_obat); ?></td>
                                    </tr>
                                    <?php $no++; } ?>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="box-body">
                            <h4 class="box-title">Obat Racik</h4>
                            <table id="example2" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama </th>
                                    <th>Obat</th>
                                    <th>Signa</th>
                                    <th>Catatan</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no=1; foreach ($obat_racikan_periksa as $row) { ?>
                                    <tr>
                                        <td> <?php echo $no; ?></td>
                                        <td> <?php echo ucwords($row->nama_racikan); ?></td>
                                        <td>
                                            <table class="bor">
                                                <thead class="bor">
                                                <tr>
                                                    <th class="bor">Nama</th>
                                                    <th class="bor">Jumlah</th>
                                                </tr>
                                                </thead>
                                                <tbody class="bor">
                                                <?php foreach ($row->obat as $v) : ?>
                                                    <tr>
                                                        <td class="bor"><?=$v->nama?></td>
                                                        <td class="bor"><?=$v->jumlah_satuan?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td> <?php echo ucwords($row->signa); ?></td>
                                        <td> <?php echo ucwords($row->catatan); ?></td>
                                    </tr>
                                    <?php $no++; } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="submit" value="1"
                                    class="btn btn-primary btn-lg btn-flat pull-right">Simpan
                            </button>
                            <a href="<?= base_url() ?>Laporan/RekamMedis/<?=$pasien_terpilih->id?>"
                               class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            </form>
        </div>
    </section>
</div>


<div id='ResponseInput'></div>




<!-- Select2 -->
<script src="<?= base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->




<script type="text/javascript">


    $('.select2').select2()


    function set_bmi(){
        var tb = $('#tb').val();
        var bb = $('#bb').val();
        var tbm = tb/100;


        var bmi = bb/(tbm*tbm);


        $('#bmi').val(bmi.toFixed(2));

    }


    for (var i = 1; i < 9 ; i++) {
        function loadData(i) {

            var id = $('#obat'+i).val();
            var jumlah_satuan = $('#jumlah_satuan'+i).val();
            var urls = "<?= base_url(); ?>obat/getStokObat";
            var datax = {"id": id};

            $.ajax({
                type: 'GET',
                url: urls,
                data: datax,

                success: function (stok) {
                    if (parseInt(stok) < parseInt(jumlah_satuan)) {
                        alert('Stok obat tidak cukup. Silahkan kurangi jumlah atau ganti obat lain!');
                        $('#jumlah_satuan'+i).val('');
                    }


                }
            });
        }
        for (var j = 1; j < 3 ; j++) {
            function loadDataRacikan(i,j) {
                var ij = (i.toString()+j.toString());


                var id = $('#obat_racikan'+ij).val();
                var jumlah_satuan = $('#jumlah_satuan'+ij).val();
                var urls = "<?= base_url(); ?>obat/getStokObat";
                var datax = {"id": id};

                $.ajax({
                    type: 'GET',
                    url: urls,
                    data: datax,

                    success: function (stok) {
                        if (parseInt(stok) < parseInt(jumlah_satuan)) {
                            alert('Stok obat tidak cukup. Silahkan kurangi jumlah atau ganti obat lain!');
                            $('#jumlah_satuan'+ij).val('');
                        }


                    }
                });
            }
        }
    }

</script>

<script src="<?= base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
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
