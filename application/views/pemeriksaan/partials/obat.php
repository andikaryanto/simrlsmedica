<div class="col-sm-12 col-md-12 col-lg-5">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Obat</h3>
        </div>
        <div class="box-body">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Obat
                            Satuan</a></li>
                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Obat
                            Racik</a></li>
                    <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Bahan
                            Habis Pakai</a></li>
                    <?php /* ?> <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li> <?php */ ?>
                </ul>
                <div class="tab-content">
                    <!-- <div class="tab-pane active" id="tab_1x">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php for ($k = 1; $k < 11; $k++) { ?>

                                                        <div class="form-group">
                                                            <label for="obat">Obat <?= $k; ?></label>
                                                            <select class="form-control select2" name="nama_obat[]"
                                                                    id="obat<?= $k; ?>">
                                                                <option value="">Pilih Obat</option>
                                                                <?php foreach ($obat->result() as $key => $value) { ?>
                                                                    <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <input type="number" class="form-control"
                                                                   id="jumlah_satuan<?= $k; ?>"
                                                                   onchange="loadData(<?= $k; ?>);"
                                                                   name="jumlah_satuan[]" placeholder="Jumlah Satuan">
                                                            <input type="text" class="form-control" name="signa_obat[]"
                                                                   placeholder="signa">
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div> -->
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <select id="obat-option">
                                            <option value="">-- Pilih Obat --</option>
                                            <?php foreach ($obat1 as $key => $value) { ?>
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
                    <!-- /.tab-pane -->
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
                                                        <?php foreach ($obat1 as $key => $value) { ?>
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
                                                       id="signa-obat-racik-<?= $i; ?>"
                                                       name="signa<?= $i; ?>"
                                                       placeholder="signa">
                                                <input type="text"
                                                       class="form-control"
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
        <div class="box-footer">
            <button type="submit" name="submit" value="1"
                    class="btn btn-primary btn-lg btn-flat pull-right">Simpan
            </button>
            <a href="<?= base_url() ?>pemeriksaan/listpemeriksaanPasien"
               class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
        </div>
    </div>
</div>