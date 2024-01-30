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
        if (isset($data_poli[$value]['kode'])) {
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

    public function required($b = true) {
        $this->required = $b;
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
            return $this->buildSelect($this->hide);
        } else if ($this->united) {
            return $this->buildUnited($this->hide);
        } else {
            return $this->buildTypeText($this->hide);
        }
    }

    public function buildTypeText($hide) {
        $rea = $this->readonly ? ' readonly ' : '';
        $req = $this->required ? ' required ' : '';
        $hid = $hide ? ' hidden ' : '';

        $r = '
        <div class="form-group '.$hid.'">
            <label for="'.$this->name.'" class="col-sm-3 control-label">'.$this->label.'</label>
            <div class="col-sm-'.$this->sm.'">';
        if ($this->textarea) : $r .= '
                    <textarea type="text" class="form-control" name="'.$this->name.'" id="'.$this->name.'"
                              value="'.$this->value.'" '.$req.' '.$rea.'></textarea>';
        else : $r .= '
                    <input type="text" class="form-control" name="'.$this->name.'" id="'.$this->name.'"
                           value="'.$this->value.'" '.$req.' '.$rea.'>';
        endif; $r .= '
            </div>
        </div>';
        return $r;
    }

    public function buildSelect($hide) {
        $rea = $this->readonly ? 'disabled="disabled"' : '';
        $req = $this->required ? ' required ' : '';
        $hid = $hide ? ' hidden ' : '';

        $r = '';
        if ($this->name == "tindakan[]") {
            $r .= '
            <div class="form-group '.$hid.'">
                <label for="'.$this->name.'" class="col-sm-3 control-label">'.$this->label.'</label>
                <div class="opt col-sm-'.$this->sm.'">
                    <select class="form-control select2" multiple="multiple" name="'.$this->name.'"
                            data-placeholder="'.$this->placeholder.'"
                            style="width: 100%;"
                        '.$req.'
                        '.$rea.'>';
            foreach ($this->options as $key => $value) {
                $select = ($value->nama == "Administrasi" || in_array($value->id, $this->selectedOptIds)) ? 'selected' : '';
                $r .= '<option value="'.$value->id.'" '.$select.' >'.call_user_func($this->optdisplay, $value).'</option>';
            } $r .= '
                    </select>
                </div>
            </div>';
        } else { $r .= '
            <div class="form-group '.$hid.'">
                <label for="'.$this->name.'" class="col-sm-3 control-label">'.$this->label.'</label>
                <div class="opt col-sm-'.$this->sm.'">
                    <select class="form-control select2" multiple="multiple" name="'.$this->name.'"
                            data-placeholder="'.$this->placeholder.'"
                            style="width: 100%;"
                        '.$req.'
                        '.$rea.'>';
            foreach ($this->options as $key => $value) {
                $select = (in_array($value->id, $this->selectedOptIds)) ? 'selected' : '';
                $r .= '<option value="'.$value->id.'" '.$select.' >'.call_user_func($this->optdisplay, $value).'</option>';
            } $r .= '
                    </select>
                </div>
            </div>';
        }
        return $r;
    }

    public function buildUnited($hide) {
        $h = $hide ? ' hidden ' : '';
        $req = $this->required ? ' required ' : '';
        $rea = $this->readonly ? ' readonly ' : '';
        $hid = $hide ? ' hidden ' : '';
        $onk = isset($this->onkeyup) && $this->onkeyup != '' ? 'onkeyup=' . $this->onkeyup : '';
        return '
        <div class="col-sm-6 col-md-6 col-lg-6 form-group '.$h.'">
            <label for="'.$this->name.'" class="col-sm-3 control-label">'.$this->label.'</label>
            <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                <input
                    type="text"
                    class="form-control"
                    id="'.$this->name.'"
                    name="'.$this->name.'"
                    value="'.$this->value.'"
                    '.$req.'
                    '.$rea.'
                >
                <span class="input-group-addon">'.$this->unit.'</span>
            </div>
        </div>';
    }
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
    $src = base_url() . '/assets/img/odontogram.png';
    return '<center><img src="' . $src . '" width="400px;"></center>';
}

function br() {
    return '<br>';
}
//hasil_penunjang: "{"laboratorium":"Laboratorium","ekg":"EKG","spirometri":"Spirometri"}",

function hasil_penunjang($pemeriksaan) {
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

<?php
$html = '
<link rel="stylesheet" href="'.base_url().'assets/plugins/iCheck/all.css">
<form class="form-horizontal" method="post" action="'.base_url().'pemeriksaan/periksa/'.$pemeriksaan['id'].'">
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Pemeriksaan Pasien
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="'.base_url().'Dashbord"><i class="fa fa-dashboard"></i> Dashbord</a></li>
                <li class="active">Pemeriksaan</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-7'.'">

                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title"> No. Rekam Medis : '.$pendaftaran['no_rm'].' </h3>
                        </div>
                        <div class="box-body">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        '.
    unit('td', 'TD')->val($pemeriksaan['td'])->required(!isLab($pendaftaran))->unit('mmHg')->readonly()->build().
    unit('r', 'R')->val($pemeriksaan['r'])->required(!isLab($pendaftaran))->unit('K/Min')->readonly()->build().
    unit('bb', 'BB')->val($pemeriksaan['bb'])->required(!isLab($pendaftaran))->unit('Kg')->onkeyup('set_bmi()')->readonly()->build().
    unit('n', 'N')->val($pemeriksaan['n'])->required(!isLab($pendaftaran))->unit('K/Min')->readonly()->build().
    unit('s', 'S')->val($pemeriksaan['s'])->required(!isLab($pendaftaran))->unit("'0")->readonly()->build().
    unit('tb', 'TB')->val($pemeriksaan['tb'])->required(!isLab($pendaftaran))->unit("cm")->readonly()->build()
    .'
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" name="pendaftaran_id" id="pendaftran_id"
                                       value="'.$pemeriksaan['id'].'">
                                <input type="hidden" class="form-control" name="dokter_id" id="dokter_id"
                                       value="'.$pemeriksaan['dokter_id'].'">
                                <input type="hidden" class="form-control" name="kode_daftar" id="kode_daftar"
                                       value="'.$pendaftaran['kode_daftar'].'">
                                '.
    sm4('bmi', 'BMI')->val($pemeriksaan['bmi'])->readonly()->build().
    sm4('no_rm', 'No Rekam Medis')->val($pemeriksaan['no_rm'])->readonly()->build()
    .'
                                <div class="form-group">
                                    <label class="col-sm-3"></label>
                                    <div class="col-sm-9">
                                        <span class="label '.$jaminan[$pemeriksaan['jaminan']]['class'].'">'.$jaminan[$pemeriksaan['jaminan']]['label'].'</span>';

if (!isset($jaminan[$pemeriksaan['jaminan']])) {
    $html .= '<span class="label label-warning">Umum</span>';
}

$html .= '
                                    </div>
                                </div>
                                '.
    sm4('nama_dokter', 'Nama Dokter')->val($pendaftaran['nama_dokter'])->readonly()->build().
    sm4('nama_pasien', 'Nama Pasien')->val($pemeriksaan['nama_pasien'])->readonly()->build();

if (isLab($pendaftaran)) {
    $html .= $this->load->view('pemeriksaan/form_laborat');
} elseif ($isDataPendukung) {
    $html .= $this->load->view('pemeriksaan/poli/' . $kode_poli, []);
} else {
    $html .=
        sm9('diagnosa_perawat', 'Diagnosa Perawat')->val($pemeriksaan['diagnosa_perawat'])->readonly()->build().
        sm9('keluhan_utama', 'Keluhan Utama')->val($pemeriksaan['keluhan_utama'])->readonly()->build();

    switch ($kode_poli) {
        case 'gigi':
            $html .= odontogram();
            $html .= br();
            $html .= sm9('catatan_odontogram', 'Catatan Odontogram')->val($pemeriksaan['keluhan_utama'])->readonly()->build();
            break;

        case 'mata':
            $html .= sm9('amammesia', 'Anamnesis')->val($pemeriksaan['amammesia'])->readonly()->build();
            $html .= $this->load->view('pemeriksaan/poli/mata', '', true);
            break;

        case 'kulit':
            $html .= sm9('amammesia', 'Anamnesis')->val($pemeriksaan['amammesia'])->readonly()->build();
            $html .= $this->load->view('pemeriksaan/poli/kulit', '', true);
            break;

        case 'tht':
            $html .= sm9('amammesia', 'Anamnesis')->val($pemeriksaan['amammesia'])->readonly()->build();
            $html .= $this->load->view('pemeriksaan/poli/tht', '', true);
            break;

        case 'anak':
            $html .= sm9('amammesia', 'Anamnesis')->val($pemeriksaan['amammesia'])->readonly()->build();
            $html .= $this->load->view('pemeriksaan/poli/anak', '', true);
            break;

        case 'obgyn':
            $html .= sm9('amammesia', 'Anamnesis')->val($pemeriksaan['amammesia'])->readonly()->build();
            $html .= $this->load->view('pemeriksaan/poli/obgyn', '', true);
            break;

        case 'jiwa':
            $html .= sm9('amammesia', 'Anamnesis')->val($pemeriksaan['amammesia'])->readonly()->build();
            $html .= $this->load->view('pemeriksaan/poli/jiwa', '', true);
            break;

        case 'syaraf':
            $html .= sm9('amammesia', 'Anamnesis')->val($pemeriksaan['amammesia'])->readonly()->build();
            $html .= $this->load->view('pemeriksaan/poli/syaraf', '', true);
            break;

        default:
            $html .= sm9('amammesia', 'Anamnesis')->val($pemeriksaan['amammesia'])->readonly()->build();
            $html .= sm9('pemeriksaan_fisik', 'Pemeriksaan Fisik')->textarea()->val($pemeriksaan['pemeriksaan_fisik'])->readonly()->build();
            break;
    }

//                                    $html .= hasil_penunjang($pemeriksaan);
    $html .= sm9('asuhan_keperawatan', 'Catatan Alergi/Lainnya')->val($pemeriksaan['asuhan_keperawatan'])->readonly()->build();
}

$html .= '<input type="hidden" name="kode_daftar" value="'.$pendaftaran['kode_daftar'].'">';

$excap = array(
    'PE',
    'BPJS-PE',
    'P-Sirometri',
    'BPJS-P-Sirometri',
    'P-Laborat',
    'BPJS-P-Laborat'
);
if (in_array($pendaftaran['kode_daftar'], $excap)) {
    $html .= '
                                    <div class="form-group">
                                        <label for="diagnosis_jenis_penyakit_a" class="col-sm-3 control-label">Gejala Klinis</label>
                                        <div class="col-sm-9">
                                            <textarea id="diagnosis_jenis_penyakit_a" class="form-control"
                                                      name="diagnosis_jenis_penyakit" rows="3"
                                                      maxlength="265"></textarea>
                                        </div>
                                    </div>';

    if (isEkg($pendaftaran) || isSpirometri($pendaftaran)) {
        $html .= sel('diagnosis_jenis_penyakit[]', 'Jenis Layanan')
            ->placeholder('Pilih layanan untuk pasien')
            ->options($all_penyakit)
            ->selectedOptions($penyakit)
            ->display(function ($value) {
                return $value->kode . ' - ' . $value->nama;
            })
            ->readonly()
            ->build();
    }
    $hd = $pendaftaran['kode_daftar'] == 'PE' || $pendaftaran['kode_daftar'] == 'P-Sirometri' ? 'hidden' : '';
    $html .= '
                                    <div class="form-group '.$hd.'">
                                        <label for="diagnosis" class="col-sm-3 control-label">Kesimpulan</label>
                                        <div class="col-sm-9">
                                            <textarea id="diagnosis" class="form-control" name="diagnosis" rows="3"
                                                      maxlength="265"></textarea>
                                        </div>
                                    </div>';

} else {
    $html .= sel('diagnosis_jenis_penyakit[]', 'Diagnosis Jenis Penyakit')
        ->placeholder('Pilih penyakit untuk pasien')
        ->options($all_penyakit)
        ->selectedOptions($penyakit)
        ->display(function ($value) {
            return $value->kode . ' - ' . $value->nama;
        })
        ->readonly()
        ->build();

    $html .= sm9('diagnosis', 'Diagnosis')->val($pemeriksaan['diagnosis'])->readonly()->build();
}

$html .= sel('tindakan[]', 'Tarif / Tindakan')
    ->placeholder('Pilih tindakan untuk pasien')
    ->options($tindakan)
    ->selectedOptions($tindakan)
    ->display(function ($value) use (&$pendaftaran) {
        return $value->nama . " - Rp." . number_format($value->tarif_pasien, 2, ',', '.');
    })
    ->readonly()
    ->build();


if (isLab($pendaftaran)) {
    $html .= sm9('deskripsi_tindakan', 'Tata Laksana')->hide()->val($pemeriksaan['deskripsi_tindakan'])->readonly()->build();
}
else {
    $html .= sm9('deskripsi_tindakan', 'Tata Laksana')->val($pemeriksaan['deskripsi_tindakan'])->readonly()->build();
}

if (!in_array($pendaftaran['kode_daftar'], $excap)) {
    if (isLab($pendaftaran)) {
        $html .= sm9('saran_pemeriksaan', 'Rujukan')->hide()->val($pemeriksaan['saran_pemeriksaan'])->readonly()->build();
    }
    else {
        $html .= sm9('saran_pemeriksaan', 'Rujukan')->val($pemeriksaan['saran_pemeriksaan'])->readonly()->build();
    }
}

$html .= '
                            </div>
                        </div>
                    </div>
                </div>
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
                                <tbody>';
$no=1; foreach ($obat_periksa as $row) { $html .= '
                                    <tr>
                                        <td> '. $no.'</td>
                                        <td> '. ucwords($row->nama).'</td>
                                        <td> '. ucwords($row->jumlah_satuan).'</td>
                                        <td> '. ucwords($row->signa_obat).'</td>
                                    </tr>';
    $no++; } $html .= '
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
                                <tbody>';
$no=1; foreach ($obat_racikan_periksa as $row) { $html .= '
                                    <tr>
                                        <td> '. $no.'</td>
                                        <td> '. ucwords($row->nama_racikan).'</td>
                                        <td>
                                            <table class="bor">
                                                <thead class="bor">
                                                <tr>
                                                    <th class="bor">Nama</th>
                                                    <th class="bor">Jumlah</th>
                                                </tr>
                                                </thead>
                                                <tbody class="bor">';
    foreach ($row->obat as $v) : $html .= '
                                                    <tr>
                                                        <td class="bor">'.$v->nama.'</td>
                                                        <td class="bor">'.$v->jumlah_satuan.'</td>
                                                    </tr>';
    endforeach; $html .= '
                                                </tbody>
                                            </table>
                                        </td>
                                        <td> '. ucwords($row->signa).'</td>
                                        <td> '. ucwords($row->catatan).'</td>
                                    </tr>';
    $no++; } $html .= '
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</form>

<div id="ResponseInput"></div>

<script src="'.base_url().'assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript">
    $(".select2").select2();

    function set_bmi() {
        var tb = $("#tb").val();
        var bb = $("#bb").val();
        var tbm = tb / 100;
        var bmi = bb / (tbm * tbm);

        $("#bmi").val(bmi.toFixed(2));
    }

    function loadData(i) {
        var id = $("#obat" + i).val();
        var jumlah_satuan = $("#jumlah_satuan" + i).val();
        var stok = $("#stok" + i).val();
        var urls = "<?= base_url(); ?>obat/getStokObat";
        var datax = {"id": id};

        if (parseInt(stok) < parseInt(jumlah_satuan)) {
            alert("Stok obat tidak cukup. Silahkan kurangi jumlah atau ganti obat lain!");
            $("#jumlah_satuan" + i).val("");
        }
    }

    for (var i = 1; i < 11; i++) {
        for (var j = 1; j < 3; j++) {
            function loadDataRacikan(i, j) {
                var ij = (i.toString() + j.toString());


                var id = $("#obat_racikan" + ij).val();
                var jumlah_satuan = $("#jumlah_satuan" + ij).val();
                var urls = "<?= base_url(); ?>obat/getStokObat";
                var datax = {"id": id};

                $.ajax({
                    type: "GET",
                    url: urls,
                    data: datax,

                    success: function (stok) {
                        if (parseInt(stok) < parseInt(jumlah_satuan)) {
                            alert("Stok obat tidak cukup. Silahkan kurangi jumlah atau ganti obat lain!");
                            $("#jumlah_satuan" + ij).val("");
                        }


                    }
                });
            }
        }
    }

</script>
'; ?>

<?php $all_html = ' 
<!DOCTYPE html>
<html>
'.$head.'
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    '.$html.'
    <div class="control-sidebar-bg"></div>
</div>
'.$footer_js.'
</body>
</html>
';

echo $all_html;
?>

<script>
  $( document ).ready(function() {
    window.print();
  });
</script>
