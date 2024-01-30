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
                    <textarea type="text" class="form-control" name="<?= $this->name ?>" id="<?= $this->name ?>" value="<?= $this->value ?>" <?= $this->required ? 'required' : '' ?> <?= $this->readonly ? 'readonly' : '' ?>><?= $this->value ?></textarea>
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
                <select class="form-control select2" multiple="multiple" name="<?= $this->name ?>" data-placeholder="<?=$this->placeholder?>" style="width: 100%;" <?= $this->required ? 'required' : '' ?>>
                    <?php foreach ($this->options as $key => $value) { ?>
                        <option value="<?= $value->id; ?>"><?= call_user_func($this->optdisplay, $value) ?></option>
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
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-7">

                <div class="box box-danger">
                    <div class="box-header">

                        <h3 class="box-title"> No. Rekam Medis : <?= $pendaftaran['no_rm']; ?> </h3>
                    </div>
                    <div class="box-body">
                        <!-- Date dd/mm/yyyy -->
                        <form class="form-horizontal" method="post" action="<?= base_url()?>laporan/SimpanEditRekamMedis/<?= $pemeriksaan->id ?>">
                            <div class="box-body">

                                <input type="hidden" name="pasien_id" value="<?= $pasien_terpilih->id ?>">

                                <?php
                                sm9('keluhan_utama', 'Keluhan Utama')->val($pemeriksaan->keluhan_utama)->build();
                                if (isGigi($pendaftaran)) {
                                    odontogram();
                                    br();
                                    sm9('catatan_odontogram', 'Catatan Odontogram')->val($pemeriksaan->catatan_odontogram)->build();
                                }
                                else {
                                    sm9('amammesia', 'Anamnesis')->val($pemeriksaan->amammesia)->build();
                                    sm9('pemeriksaan_fisik', 'Pemeriksaan Fisik')->val($pemeriksaan->pemeriksaan_fisik)->textarea()->build();
                                }
                                sm9('asuhan_keperawatan', 'Catatan Alergi/Lainnya')->val($pemeriksaan->asuhan_keperawatan)->build();

                                ?>

                                <div class="form-group">
                                    <?php if($pendaftaran['kode_daftar'] == 'PL' || $pendaftaran['kode_daftar'] == 'BPJS-PL'): ?>
                                        <label for="inputtext3" class="col-sm-3 control-label">Jenis Layanan Laboratorium</label>
                                    <?php else: ?>
                                        <label for="inputtext3" class="col-sm-3 control-label">Diagnosis Jenis Penyakit</label>
                                    <?php endif; ?>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" multiple="multiple" name="diagnosis_jenis_penyakit[]" data-placeholder="Pilih penyakit untuk pasien" style="width: 100%;" required>
                                            <?php if($pendaftaran['kode_daftar'] == 'PG' || $pendaftaran['kode_daftar'] == 'BPJS-PG'): ?>
                                                <?php foreach ($penyakit_gigi->result() as $key => $value) { ?>
                                                    <?php foreach ($s_penyakit as $key1 => $value1): ?>
                                                        <option value="<?= $value->id; ?>" <?= $value->id == $value1->id_penyakit ? 'selected' : '' ?>><?= $value->kode; ?> - <?= $value->nama; ?></option>
                                                    <?php endforeach; ?>
                                                <?php } ?>
                                            <?php elseif($pendaftaran['kode_daftar'] == 'PL' || $pendaftaran['kode_daftar'] == 'BPJS-PL'): ?>
                                                <?php foreach ($layanan_laborat->result() as $key => $value) { ?>
                                                    <?php foreach ($s_penyakit as $key1 => $value1): ?>
                                                        <option value="<?= $value->id; ?>" <?= $value->id == $value1->id_penyakit ? 'selected' : '' ?>><?= $value->kode; ?> - <?= $value->nama; ?></option>
                                                    <?php endforeach; ?>
                                                <?php } ?>
                                            <?php else: ?>
                                                <?php foreach ($penyakit->result() as $key => $value): ?>
                                                    <?php foreach ($s_penyakit as $key1 => $value1): ?>
                                                        <option value="<?= $value->id; ?>" <?= $value->id == $value1->id_penyakit ? 'selected' : '' ?>><?= $value->kode; ?> - <?= $value->nama; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>

                                <?php
                                sm9('diagnosis', 'Diagnosis')->val($pemeriksaan->diagnosis)->required()->build();
                                ?>

                                <div class="form-group">
                                    <label for="inputtext3" class="col-sm-3 control-label">Tarif / Tindakan</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" multiple="multiple" name="tindakan[]" data-placeholder="Pilih tindakan untuk pasien"
                                                style="width: 100%;" required>
                                            <?php if($pendaftaran['kode_daftar'] == 'PG'): ?>
                                                <?php foreach ($tindakan_gigi->result() as $key => $value) { ?>
                                                    <?php foreach ($s_tindakan as $key1 => $value1): ?>
                                                        <option value="<?= $value->id; ?>" <?= $value->id == $value1->id_tarif_rindakan ? 'selected' : '' ?>><?= $value->nama." - Rp.".number_format($value->tarif_pasien,2,',','.'); ?></option>
                                                    <?php endforeach; ?>
                                                <?php } ?>
                                            <?php elseif($pendaftaran['kode_daftar'] == 'BPJS-PG'): ?>
                                                <?php foreach ($tindakan_gigi->result() as $key => $value) { ?>
                                                    <?php foreach ($s_tindakan as $key1 => $value1) : ?>
                                                        <option value="<?= $value->id; ?>" <?= $value->id == $value1->id_tarif_rindakan ? 'selected' : '' ?>><?= $value->nama." - Rp.0"; ?></option>
                                                    <?php endforeach; ?>
                                                <?php } ?>
                                            <?php elseif($pendaftaran['kode_daftar'] == 'PL'): ?>
                                                <?php foreach ($tindakan_laborat->result() as $key => $value) { ?>
                                                    <?php foreach ($s_tindakan as $key1 => $value1) : ?>
                                                        <option value="<?= $value->id; ?>" <?= $value->id == $value1->id_tarif_rindakan ? 'selected' : '' ?>><?= $value->nama." - Rp.".number_format($value->tarif_pasien,2,',','.'); ?></option>
                                                    <?php endforeach; ?>
                                                <?php } ?>
                                            <?php elseif($pendaftaran['kode_daftar'] == 'BPJS-PL'): ?>
                                                <?php foreach ($tindakan_laborat->result() as $key => $value) { ?>
                                                    <?php foreach ($s_tindakan as $key1 => $value1) : ?>
                                                        <option value="<?= $value->id; ?>" <?= $value->id == $value1->id_tarif_rindakan ? 'selected' : '' ?>><?= $value->nama." - Rp.0"; ?></option>
                                                    <?php endforeach; ?>
                                                <?php } ?>
                                            <?php elseif(strpos($pendaftaran['kode_daftar'], 'BPJS-') !== false): ?>
                                                <?php foreach ($tindakan->result() as $key => $value) { ?>
                                                    <?php foreach ($s_tindakan as $key1 => $value1) : ?>
                                                        <option value="<?= $value->id; ?>" <?= $value->id == $value1->id_tarif_rindakan ? 'selected' : '' ?>><?= $value->nama." - Rp.0"; ?></option>
                                                    <?php endforeach; ?>
                                                <?php } ?>
                                            <?php else: ?>
                                                <?php foreach ($tindakan->result() as $key => $value) { ?>
                                                    <?php foreach ($s_tindakan as $key1 => $value1) : ?>
                                                        <option value="<?= $value->id; ?>" <?= $value->id == $value1->id_tarif_rindakan ? 'selected' : '' ?>><?= $value->nama." - Rp.".number_format($value->tarif_pasien,2,',','.'); ?></option>
                                                    <?php endforeach; ?>
                                                <?php } ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <?php
                                sm9('deskripsi_tindakan', 'Deskripsi Tindakan')->val($pemeriksaan->deskripsi_tindakan)->build();
                                sm9('saran_pemeriksaan', 'Saran Pemeriksaan')->val($pemeriksaan->saran_pemeriksaan)->build();
                                ?>
                            </div>
                            <!-- /.box-body -->
                            <?php if($pendaftaran['kode_daftar'] == 'PL' || $pendaftaran['kode_daftar'] == 'BPJS-PL'): ?>
                                <div class="box-footer">
                                    <button type="submit" name="submit" value="1" class="btn btn-primary btn-lg btn-flat pull-right">Simpan</button>
                                    <a href="<?php echo base_url() ?>Laporan/RekamMedis/<?= $pasien_terpilih->id ?>" class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
                                </div>
                            <?php endif; ?>

                            <!-- /.box-footer -->



                    </div>
                    <!-- /.box-body -->
                </div>

                <!-- /.box -->
            </div>
            <?php if($pendaftaran['kode_daftar'] == 'PL' || $pendaftaran['kode_daftar'] == 'BPJS-PL'): ?>
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
