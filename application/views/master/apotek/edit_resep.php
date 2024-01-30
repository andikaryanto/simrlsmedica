<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/iCheck/all.css">
<style media="screen">
    .select2-container {
        width: 100% !important;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Edit Resep, BHP, & Tindakan
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>Dashbord"><i class="fa fa-dashboard"></i> Dashbord</a></li>
            <li class="active">Pemeriksaan</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <form class="form-horizontal" method="post" action="<?= base_url()?>Apotek/simpanEditResep/<?= $pemeriksaan->id ?>">
                        <input type="hidden" name="to" value="<?=$to?>">
                        <div class="box-header">
                            <h3 class="box-title"> No. Rekam Medis : <?= $pemeriksaan->no_rm; ?> </h3>
                        </div>
                        <div class="box-body">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_1" data-toggle="tab" aria-expanded="true">Obat Satuan</a>
                                    </li>
                                    <li class="">
                                        <a href="#tab_2" data-toggle="tab" aria-expanded="false">Obat Racik</a>
                                    </li>
                                    <li class="">
                                        <a href="#tab_3" data-toggle="tab" aria-expanded="false">Bahan Habis Pakai</a>
                                    </li>
                                    <li class="">
                                        <a href="#tab_4" data-toggle="tab" aria-expanded="false">Tarif / Tindakan</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <select id="obat-option">
                                                            <option value="">-- Pilih Obat --</option>
                                                            <?php foreach ($obat_all as $key => $value) { ?>
                                                                <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <button type="button" name="button"
                                                                class="btn btn-sm btn-block btn-primary"
                                                                id="button-add-obat"><i class="fa fa-plus"></i>
                                                            Tambah obat
                                                        </button>
                                                        <input type="hidden" id="abdush-counter2" value="0">
                                                    </div>
                                                </div>
                                                <div class="form-area-obat" style="margin-top:15px;">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>Nama</th>
                                                            <th>Stok Obat</th>
                                                            <th>Jml</th>
                                                            <th>Signa</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="checkbox" name="tdk_diambil" <?=$pendaftaran['tdk_diambil'] ? 'checked' : ''?> value="1"><label> Obat tidak diambil</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_2">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php for ($i = 1; $i < 9; $i++) { ?>
                                                    <div class="row ">
                                                        <div class="col-md-12">
                                                            <div style="margin-top: 20px;">
                                                                <label for="obat">Racikan <?= $i; ?></label>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-8">
                                                                    <select name="obat_racikan<?= $i; ?>[]" id="obat-racik-option-<?=$i?>">
                                                                        <option value="">-- Pilih Obat --</option>
                                                                        <?php foreach ($obat_all as $key => $value) { ?>
                                                                            <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <button type="button" name="button"
                                                                            class="btn btn-sm btn-block btn-primary"
                                                                            id="button-add-obat-racik-<?=$i?>"><i class="fa fa-plus"></i>
                                                                        Tambah obat
                                                                    </button>
                                                                    <input type="hidden" id="abdush-counter-<?=$i?>" value="0">
                                                                </div>
                                                            </div>
                                                            <div class="form-area-obat-racik-<?=$i?>" style="margin-top:15px;">
                                                                <table class="table table-striped table-hover">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Nama</th>
                                                                        <th>Stok Obat</th>
                                                                        <th>Jml</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                                <input type="text"
                                                                       class="form-control"
                                                                       id="signa<?= $i; ?>"
                                                                       name="signa<?= $i; ?>"
                                                                       placeholder="signa">
                                                                <input type="text"
                                                                       class="form-control"
                                                                       id="catatan<?= $i; ?>"
                                                                       name="catatan<?= $i; ?>"
                                                                       placeholder="catatan">
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <select id="bahan-option">
                                                            <option value="">-- Pilih Bahan --</option>
                                                            <?php foreach ($bahan_all as $key => $value) { ?>
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
                                                        <input type="hidden" id="abdush-counter-bahan" value="0">
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
                                    <div class="tab-pane" id="tab_4">
                                        <div class="row" style="margin: 8px !important;">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="inputtext3" >Tarif / Tindakan</label>
                                                    <select class="form-control select2" multiple="multiple" name="tindakan[]" data-placeholder="Pilih tindakan untuk pasien"
                                                            style="width: 100%;">
                                                        <?php if($pendaftaran['kode_daftar'] == 'PG'): ?>
                                                            <?php foreach ($tindakan_gigi->result() as $key => $value) { ?>
                                                                <?php foreach ($s_tindakan as $key1 => $value1) :
                                                                    ?><?php $pilih = ($value->id == $value1->tarif_tindakan_id) ? 'selected' : '' ?>
                                                                    <option value="<?= $value->id; ?>" <?php echo $pilih; ?> ><?= $value->nama." - Rp.".number_format($value->tarif_pasien,2,',','.'); ?></option>
                                                                <?php endforeach; ?>
                                                            <?php } ?>
                                                        <?php elseif($pendaftaran['kode_daftar'] == 'BPJS-PG'): ?>
                                                            <?php foreach ($tindakan_gigi->result() as $key => $value) { ?>
                                                                <?php foreach ($s_tindakan as $key1 => $value1) :
                                                                    ?><?php $pilih = ($value->id == $value1->tarif_tindakan_id) ? 'selected' : '' ?>
                                                                    <option value="<?= $value->id; ?>" <?php echo $pilih; ?> ><?= $value->nama." - Rp.".number_format($value->tarif_pasien,2,',','.'); ?></option>
                                                                <?php endforeach; ?>
                                                            <?php } ?>
                                                        <?php elseif($category == 'laboratorium'): ?>
                                                            <?php foreach ($jenis_layanan_lab->result() as $key => $value) {
                                                                $pilih = '';
                                                                foreach ($selected_jenis_layanan_lab as $key1 => $value1) {
                                                                    if ($value->id == $value1->selected_id) {
                                                                        $pilih = 'selected';
                                                                        break;
                                                                    }
                                                                } ?>
                                                                <option value="<?= $value->id; ?>" <?php echo $pilih; ?> ><?= $value->nama." - Rp.".number_format($value->tarif_pasien,2,',','.'); ?></option>
                                                            <?php } ?>
                                                        <?php elseif(strpos($pendaftaran['kode_daftar'], 'BPJS-') !== false): ?>
                                                            <?php foreach ($tindakan->result() as $key => $value) { ?>
                                                                <?php foreach ($s_tindakan as $key1 => $value1) :
                                                                    ?><?php $pilih = ($value->id == $value1->tarif_tindakan_id) ? 'selected' : '' ?>
                                                                    <option value="<?= $value->id; ?>" <?php echo $pilih; ?> ><?= $value->nama." - Rp.".number_format($value->tarif_pasien,2,',','.'); ?></option>
                                                                <?php endforeach; ?>
                                                            <?php } ?>
                                                        <?php elseif(strpos($pendaftaran['kode_daftar'], 'PU') !== false): ?>
                                                            <?php foreach ($tindakan_urologi->result() as $key => $value) { ?>
                                                                <?php foreach ($s_tindakan as $key1 => $value1) :
                                                                    ?><?php $pilih = ($value->id == $value1->tarif_tindakan_id) ? 'selected' : '' ?>
                                                                    <option value="<?= $value->id; ?>" <?php echo $pilih; ?> ><?= $value->nama." - Rp.".number_format($value->tarif_pasien,2,',','.'); ?></option>
                                                                <?php endforeach; ?>
                                                            <?php } ?>
                                                        <?php else: ?>
                                                            <?php foreach ($tindakan->result() as $key => $value) {
                                                                $pilih = '';
                                                                foreach ($s_tindakan as $key1 => $value1) {
                                                                    if ($value->id == $value1->tarif_tindakan_id) {
                                                                        $pilih = 'selected';
                                                                        break;
                                                                    }
                                                                } ?>
                                                                <option value="<?= $value->id; ?>" <?php echo $pilih; ?> ><?= $value->nama." - Rp.".number_format($value->tarif_pasien,2,',','.'); ?></option>
                                                            <?php } ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="submit" value="1" class="btn btn-primary btn-lg btn-flat pull-right">Simpan</button>
                            <a onclick="window.history.go(-1); return false;" href="#" class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
            <br>
        </div>
    </section>
</div>

<div id='ResponseInput'></div>

<script>
    function cekObat(i) {
        var jumlah_satuan = $('#jumlah_satuan' + i).val();
        var stok = $('#stok' + i).val();

        if (parseInt(stok) < parseInt(jumlah_satuan)) {
            alert('Stok obat tidak cukup. Silahkan kurangi jumlah atau ganti obat lain!');
            $('#jumlah_satuan' + i).val('');
        }
    }
    function cekObatRacik(i, j) {
        var jumlah_satuan = $('#jumlah_satuan_racikan' + i + j).val();
        var stok = $('#stok' + i + j).val();

        if (parseInt(stok) < parseInt(jumlah_satuan)) {
            alert('Stok obat tidak cukup. Silahkan kurangi jumlah atau ganti obat lain!');
            $('#jumlah_satuan_racikan' + i + j).val('');
        }
    }
    function cekBahan(i) {
        var jumlah_satuan = $(`#bahan\\[${i}\\]\\[qty\\]`).val();
        var stok = $('#stok_bahan' + i).val();
        console.log(jumlah_satuan);
        console.log(stok);

        if (parseInt(stok) < parseInt(jumlah_satuan)) {
            alert('Stok bahan tidak cukup. Silahkan kurangi jumlah atau ganti bahan lain!');
            $(`#bahan\\[${i}\\]\\[qty\\]`).val('');
        }
    }
</script>

<script src="<?= base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>

<script type="text/javascript">
    let bahan_all = <?php echo json_encode($bahan_all); ?>;
    let obat_all = <?php echo json_encode($obat_all); ?>;
    let obat = <?php echo json_encode($obats); ?>;
    let racikan = <?php echo json_encode($racikans); ?>;
    let bahan = <?php echo json_encode($bahans); ?>;

    $('.select2').select2();
    $('#obat-option').select2();
    $('#bahan-option').select2();

    let renderBahan = (theBahan, counter, jumlah = '') => `
        <tr>
            <td>
            ${theBahan.nama}
                <input type="hidden" name="bahan_id[]" value="${theBahan.id}">
            </td>
            <td>${theBahan.jumlah} ${theBahan.satuan}</td>
            <input type="hidden" id="stok_bahan${counter}" value="${theBahan.jumlah}">
            <td>
                <input style="width:65px;"
                    type="text"
                    class="form-control"
                    onchange="cekBahan(${counter});"
                    name="qty[]"
                    id="bahan[${counter}][qty]"
                    value=${jumlah}>
            </td>
            <td>
                <button class="btn btn-sm btn-danger btn-delete-row" type="button"> <i class="fa fa-trash"></i> </button>
            </td>
        </tr>
    `;
    let renderObat = (theObat, counter, jumlah = '', signa = '') => `
        <tr>
          <td>
            ${theObat.nama}
            <input type="hidden" name="nama_obat[]" value="${theObat.id}">
          </td>
          <td>${theObat.stok_obat} item </td>
          <input type="hidden" id="stok${counter}" value="${theObat.stok_obat}">
          <td>
            <input style="width:65px;"
                type="text"
                class="form-control"
                onchange="cekObat(${counter});"
                name="jumlah_satuan[]"
                id="jumlah_satuan${counter}"
                value="${jumlah}">
          </td>
          <td>
            <input style="width:100px;"
                type="text"
                class="form-control"
                name="signa_obat[]"
                id="signa_obat${counter}"
                value="${signa}">
          </td>
          <td>
            <button class="btn btn-sm btn-danger btn-delete-row" type="button"> <i class="fa fa-trash"></i> </button>
          </td>
        </tr>
    `;
    let renderObatRacik = (i, obat, counter, jumlah = '') => `
        <tr>
          <td>
            ${obat.nama}
            <input type="hidden" name="nama_obat_racikan${i}[]" value="${obat.id}">
          </td>
          <td>${obat.stok_obat} item </td>
          <input type="hidden" id="stok${i}${counter}" value="${obat.stok_obat}">
          <td>
            <input style="width:65px;"
                type="text"
                class="form-control"
                onchange="cekObatRacik(${i},${counter});"
                name="jumlah_satuan_racikan${i}[]"
                id="jumlah_satuan_racikan${i}${counter}"
                value="${jumlah}">
          </td>
          <td>
            <button class="btn btn-sm btn-danger btn-delete-row" type="button"> <i class="fa fa-trash"></i> </button>
          </td>
        </tr>
    `;

    let addBahanView = (id_bahan, jumlah = '') => {
        let counter = parseInt($('#abdush-counter-bahan').val());
        let theBahan = bahan_all.find(v => v.id === id_bahan);

        $('.form-area tbody').append(renderBahan(theBahan, counter, jumlah));
        $('#abdush-counter').val(counter + 1);
        $('input[name="bahan[' + counter + '][qty]"]').focus();

        $('.btn-delete-row').unbind('click');
        $('.btn-delete-row').each(function () {
            $(this).on('click', function () {
                $(this).parents('tr').remove();
            });
        });
    };
    let addObatView = (id_Obat, jumlah = '', signa = '') => {
        let counter = parseInt($('#abdush-counter2').val());
        let theObat = obat_all.find(v => v.id === id_Obat);

        $('.form-area-obat tbody').append(renderObat(theObat, counter, jumlah, signa));
        $('#abdush-counter2').val(counter + 1);
        $('input[id="jumlah_satuan' + counter + '"]').focus();

        $('.btn-delete-row').unbind('click');
        $('.btn-delete-row').each(function () {
            $(this).on('click', function () {
                $(this).parents('tr').remove();
            });
        });
    };
    let addObatRacikView = (id_obat, i, jumlah = '') => {
        let counter = parseInt($(`#abdush-counter-${i}`).val());
        let theObat = obat_all.find(v => v.id === id_obat);

        $(`.form-area-obat-racik-${i} tbody`).append(renderObatRacik(i, theObat, counter, jumlah));
        $(`#abdush-counter-${i}`).val(counter + 1);
        $('input[id="jumlah_satuan_racik' + counter + '"]').focus();

        $('.btn-delete-row').unbind('click');
        $('.btn-delete-row').each(function () {
            $(this).on('click', function () {
                $(this).parents('tr').remove();
            });
        });
    };

    obat.forEach(v => {
        addObatView(v.obat_id, v.jumlah_satuan, v.signa_obat);
    });
    bahan.forEach(v => {
        addBahanView(v.bahan_id, v.jumlah);
    });
    racikan.forEach((v, k) => {
        v.racikan.forEach((vv, kk) => {
            addObatRacikView(vv.obat_id, k + 1, vv.jumlah_satuan);
        });
        $(`#signa${k + 1}`).val(v.signa);
        $(`#catatan${k + 1}`).val(v.catatan);
    });

    $('#button-add-obat').on('click', function (e) {
        var id_Obat = $('#obat-option').val();
        if (id_Obat === '') {
            alert('Anda belum memilih obat !');
        }
        else {
            addObatView(id_Obat);
        }
        $('#obat-option').val('').trigger('change');
    });
    $('#button-add-bahan').on('click', function (e) {
        var id_bahan = $('#bahan-option').val();
        if (id_bahan === '') {
            alert('Anda belum memilih bahan habis pakai !');
        }
        else {
            addBahanView(id_bahan);
        }
        $('#bahan-option').val('').trigger('change');
    });

    let racikInitializer = {
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
                addObatRacikView(id_Obat, i);
            }
            opt.val('').trigger('change');
        }
    };

    racikInitializer.init();
</script>
