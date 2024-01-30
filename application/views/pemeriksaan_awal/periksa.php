<?php

function isGigi($pendaftaran) {
    return $pendaftaran['kode_daftar'] == 'PG' || $pendaftaran['kode_daftar'] == 'BPJS-PG';
}

function isLab($pendaftaran) {
    return $pendaftaran['kode_daftar'] == 'PL' || $pendaftaran['kode_daftar'] == 'BPJS-PL';
}

function isBpjs($pendaftaran) {
    return strpos($pendaftaran, 'BPJS') !== false;
}

class InputBuilder {

    var $name;
    var $label;
    var $value = '';
    var $sm = 9;
    var $placeholder = '';
    var $unit = '';
    var $options;
    var $selectedOptIds = [];

    var $optdisplay;
    var $onkeyup;

    var $united = false;
    var $textarea = false;
    var $select = false;
    var $required = false;
    var $readonly = false;

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

    public function selectedOptionIds($v) {
        $this->selectedOptIds = $v;
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

    public function build() {
        if ($this->select) {
            $this->buildSelect();
        }
        else if ($this->united) {
            $this->buildUnited();
        }
        else {
            $this->buildTypeText();
        }
    }

    public function buildTypeText() { ?>
        <div class="form-group">
            <label for="<?= $this->name ?>" class="col-sm-3 control-label"><?= $this->label ?></label>
            <div class="col-sm-<?=$this->sm?>">
                <?php if ($this->textarea) : ?>
                    <textarea class="form-control" name="<?= $this->name ?>" id="<?= $this->name ?>" <?= $this->required ? 'required' : '' ?> <?= $this->readonly ? 'readonly' : '' ?>><?= $this->value ?></textarea>
                <?php else : ?>
                    <input type="text" class="form-control" name="<?= $this->name ?>" id="<?= $this->name ?>" value="<?= $this->value ?>" <?= $this->required ? 'required' : '' ?> <?= $this->readonly ? 'readonly' : '' ?>>
                <?php endif; ?>
            </div>
        </div>
    <?php }

    public function buildSelect() { ?>
        <div class="form-group">
            <label for="<?= $this->name ?>" class="col-sm-3 control-label"><?= $this->label ?></label>
            <div class="col-sm-<?=$this->sm?>">
                <select
                        class="form-control select2"
                        multiple="multiple"
                        name="<?= $this->name ?>"
                        data-placeholder="<?=$this->placeholder?>"
                        style="width: 100%;"
                        <?= $this->required ? 'required' : '' ?>
                >
                    <?php foreach ($this->options as $key => $value) {
                        $select = (($value->nama == "Administrasi" && !$this->unselect_administrasi) || in_array($value->id, $this->selectedOptIds)) ? 'selected' : ''; ?>
                        <option value="<?= $value->id; ?>" <?php echo $select; ?>><?= call_user_func($this->optdisplay, $value) ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    <?php }

    public function buildUnited() { ?>
        <div class="col-sm-4 col-md-4 col-lg-4 form-group">
            <label for="<?=$this->name?>" class="col-sm-3 control-label"><?= $this->label ?></label>
            <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                <input
                    type="text"
                    class="form-control"
                    id="<?= $this->name ?>"
                    name="<?= $this->name ?>"
                    value="<?= $this->value ?>"
                    <?= $this->required ? 'required' : '' ?>
                    <?= $this->readonly ? 'readonly' : '' ?>
                    <?= isset($this->onkeyup) && $this->onkeyup != '' ? 'onkeyup='.$this->onkeyup : '' ?>
                >
                <span class="input-group-addon"><?=$this->unit?></span>
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
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-lg-7">
                <div class="box box-danger">
                    <div class="box-header">
                    </div>
                    <div class="box-body">
                        <form class="form-horizontal" method="post" action="<?= base_url()?>PemeriksaanAwal/simpanPeriksa/<?= $pendaftaran['pasien'] ?>">
                            <div class="box-body">
                              <input type="hidden" name="is_bpjs" value="<?=$pendaftaran['is_bpjs']?>">
                              <input type="hidden" name="jaminan" value="<?=$pendaftaran['jaminan']?>">
                                <div class="row" >
                                    <div class="col-md-12">
                                        <?php
                                        sm4('no_rm', 'No Rekam Medis')->val($pendaftaran['no_rm'])->readonly()->build();
                                        ?>
                                        <div class="form-group">
                                          <label class="col-sm-3"></label>
                                          <div class="col-sm-9">
                                            <span class="label <?=$jaminan[$pendaftaran['jaminan']]['class']?>"><?=$jaminan[$pendaftaran['jaminan']]['label']?></span>
                                            <?php if (!isset($jaminan[$pendaftaran['jaminan']])) { ?>
                                            <span class="label label-warning">Umum</span>
                                            <?php } ?>

                                          </div>
                                        </div>
                                        <?php
                                        sm4('nama_pasien', 'Nama Pasien')->val($pendaftaran['nama_pasien'])->readonly()->build();
                                        sm4('usia', 'Usia')->val($pendaftaran['usia'])->readonly()->build();
                                        sm4('alamat', 'Alamat')->val($pendaftaran['alamat'])->readonly()->build();
//                                        sm4('bmi', 'BMI')->val($pendaftaran['bmi'])->build();
                                        ?>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="row" >
                                        <div class="col-md-12">
                                            <?php
                                            unit('td', 'TD')->val($pemeriksaan['td'])->required()->unit('mmHg')->build();
                                            unit('r', 'R')->val($pemeriksaan['r'])->required()->unit('K/Min')->build();
//                                            unit('bb', 'BB')->val($pendaftaran['bb'])->required()->unit('Kg')->onkeyup('set_bmi()')->build();
                                            unit('n', 'N')->val($pemeriksaan['n'])->required()->unit('K/Min')->build();
                                            unit('s', 'S')->val($pemeriksaan['s'])->required()->unit("'0")->build();
//                                            unit('tb', 'TB')->val($pendaftaran['tb'])->required()->unit("cm")->onkeyup('set_bmi()')->build();
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="row" >
                                        <div class="col-md-12">
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
                                            <br>
                                            <?php
                                            sm9('diagnosa_perawat', 'Diagnosa Perawat')->textarea()->val($pemeriksaan['diagnosa_perawat'])->required()->build();
                                            sm9('asuhan_keperawatan', 'Catatan Alergi/Lainnya')->textarea()->val($pemeriksaan['asuhan_keperawatan'])->required()->build();
                                            sm9('keluhan_utama', 'Keluhan Utama')->textarea()->val($pemeriksaan['keluhan_utama'])->required()->build();
                                            sel('perawat[]', 'Perawat')
                                                ->placeholder('Pilih perawat')
                                                ->options($listPerawat->result())
                                                ->display(function ($value) {
                                                    return ucwords($value->nama);
                                                })
                                                ->selectedOptionIds(explode(',', $pemeriksaan['detail_perawat_id'] ?? ''))
//                                                ->selectedOptionIds(explode(',', $pemeriksaan['detail_perawat_id'] ?? ''))
                                                ->build();
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" class="form-control" name="pendaftaran_id" id="pendaftaran_id" value="<?= $pendaftaran['id']; ?>">
                                <input type="hidden" class="form-control" name="pemeriksaan_id" id="pemeriksaan_id" value="<?= $pendaftaran['pemeriksaan_id']; ?>">
                                <input type="hidden" class="form-control" name="dokter_id" id="dokter_id" value="<?= $pendaftaran['dokter']; ?>" >

                            </div>
                            <div class="box-footer">
                                <button type="submit" name="submit" value="1" class="btn btn-primary btn-lg btn-flat pull-right">Simpan</button>
                                <a href="<?php echo base_url() ?>PemeriksaanAwal/" class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    $(function () {
        $('.select2').select2()
    })

    function set_bmi() {
        var tb = $('#tb').val();
        var bb = $('#bb').val();
        var tbm = tb / 100;
        var bmi = bb / (tbm * tbm);

        $('#bmi').val(bmi.toFixed(2));
    }

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
