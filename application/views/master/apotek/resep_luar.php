<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/iCheck/all.css">

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Resep Luar
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Resep Luar</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form class="form-horizontal" method="post" action="<?= base_url() ?>apotek/simpan_resep_luar">
                <div class="col-md-6">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title"> Tambah Resep Luar </h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama_pasien" class="col-sm-2 control-label">Nama Pasien</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama_pasien" id="nama_pasien">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="alamat" id="alamat">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama_dokter" class="col-sm-2 control-label">Nama Dokter</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama_dokter" id="nama_dokter">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="submit" value="1" class="btn btn-primary btn-lg btn-flat pull-right">Simpan</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Obat</h3>
                        </div>
                        <div class="box-body">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Obat Satuan</a></li>
                                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Obat Racik</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <select id="obat-option">
                                                            <option value="">-- Pilih Obat --</option>
                                                            <?php foreach ($obat as $key => $value) { ?>
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
                                                                    <select name="obat_racikan<?= $i; ?>[]"
                                                                            id="obat-racik-option-<?= $i ?>">
                                                                        <option value="">-- Pilih Obat --</option>
                                                                        <?php foreach ($obat as $key => $value) { ?>
                                                                            <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>

                                                                <div class="col-sm-4">
                                                                    <button type="button" name="button" class="btn btn-sm btn-block btn-primary" id="button-add-obat-racik-<?= $i ?>"><i class="fa fa-plus"></i>
                                                                        Tambah obat
                                                                    </button>
                                                                    <input type="hidden" id="abdush-counter-<?= $i ?>" value="0">
                                                                </div>
                                                            </div>
                                                            <div class="form-area-obat-racik-<?= $i ?>" style="margin-top:15px;">
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
                                                                <input type="text" class="form-control" name="signa<?= $i; ?>" placeholder="signa">
                                                                <input type="text" class="form-control" name="catatan<?= $i; ?>" placeholder="catatan">
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<div id='ResponseInput'></div>

<script src="<?= base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript">
    $('.select2').select2()

    for (var i = 1; i < 9; i++) {
        function loadData(i) {

            var id = $('#obat' + i).val();
            var jumlah_satuan = $('#jumlah_satuan' + i).val();
            var urls = "<?= base_url(); ?>obat/getStokObat";
            var datax = {"id": id};

            $.ajax({
                type: 'GET',
                url: urls,
                data: datax,

                success: function (stok) {
                    if (parseInt(stok) < parseInt(jumlah_satuan)) {
                        alert('Stok obat tidak cukup. Silahkan kurangi jumlah atau ganti obat lain!');
                        $('#jumlah_satuan' + i).val('');
                    }


                }
            });
        }

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

<script src="<?= base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript">
    jQuery(function ($) {
        var obat = <?php echo json_encode($obat); ?>;
        $('#obat-option').select2();

        $('#button-add-obat').on('click', function (e) {
            var id_Obat = $('#obat-option').val();
            if (id_Obat == '') {
                alert('Anda belum memilih obat !');
            } else {
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
            init: function () {
                for (let i = 1; i < 9; i++) {
                    $(`#obat-racik-option-${i}`).select2();
                    $(`#button-add-obat-racik-${i}`).on('click', e => {
                        this.onBtnAddClick(i);
                    });
                }
            },
            onBtnAddClick: function (i) {
                let opt = $(`#obat-racik-option-${i}`);
                let id_Obat = opt.val();
                if (id_Obat === '') {
                    alert('Anda belum memilih obat !');
                } else {
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
