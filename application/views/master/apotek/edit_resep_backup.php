<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/iCheck/all.css">

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Edit Resep
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
                    <div class="box-header">
                        <h3 class="box-title"> No. Rekam Medis : <?= $pemeriksaan->no_rm; ?> </h3>
                    </div>
                    <div class="box-body">
                        <form class="form-horizontal" method="post" action="<?= base_url()?>Apotek/simpanEditResep/<?= $pemeriksaan->id ?>">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="box-body">
                                            <?php for ($k=1; $k < 9; $k++) { ?>
                                                <div class="form-group">
                                                    <label for="obat">Obat <?= $k; ?></label>
                                                    <select class="form-control select2" name="nama_obat[]" id="obat<?= $k; ?>" >
                                                        <option value="">--Pilih Obat--</option>
                                                        <?php foreach ($obat_all as $key => $value) {
                                                            $is_selected = '';
                                                            foreach ($obats as $o) {
                                                                if (isset($obats[$k - 1]) && $value->id == $obats[$k - 1]->obat_id)  {
                                                                    $is_selected = 'selected';
                                                                }
                                                            } ?>
                                                            <option value="<?= $value->id ?>" <?= $is_selected ?>><?= $value->nama ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <input type="number" class="form-control" id="jumlah_satuan<?= $k; ?>" onchange="loadData(<?= $k; ?>);" name="jumlah_satuan[]" placeholder="Jumlah Satuan" value="<?= isset($obats[$k - 1]) ? $obats[$k - 1]->jumlah_satuan : '' ?>">
                                                    <input type="text" class="form-control" name="signa_obat[]" placeholder="signa"value="<?= isset($obats[$k - 1]) ? $obats[$k - 1]->signa_obat : '' ?>">
                                                </div>
                                            <?php } ?>
                                            <div class="form-group">
                                                <label for="inputtext3" >Tarif / Tindakan</label>
                                                <select class="form-control select2" multiple="multiple" name="tindakan[]" data-placeholder="Pilih tindakan untuk pasien"
                                                        style="width: 100%;" required>
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
                                                    <?php elseif($pendaftaran['kode_daftar'] == 'PL'): ?>
                                                        <?php foreach ($tindakan_laborat->result() as $key => $value) { ?>
                                                            <?php foreach ($s_tindakan as $key1 => $value1) :
                                                                ?><?php $pilih = ($value->id == $value1->tarif_tindakan_id) ? 'selected' : '' ?>
                                                                <option value="<?= $value->id; ?>" <?php echo $pilih; ?> ><?= $value->nama." - Rp.".number_format($value->tarif_pasien,2,',','.'); ?></option>
                                                            <?php endforeach; ?>
                                                        <?php } ?>
                                                    <?php elseif($pendaftaran['kode_daftar'] == 'BPJS-PL'): ?>
                                                        <?php foreach ($tindakan_laborat->result() as $key => $value) { ?>
                                                            <?php foreach ($s_tindakan as $key1 => $value1) :
                                                                ?><?php $pilih = ($value->id == $value1->tarif_tindakan_id) ? 'selected' : '' ?>
                                                                <option value="<?= $value->id; ?>" <?php echo $pilih; ?> ><?= $value->nama." - Rp.".number_format($value->tarif_pasien,2,',','.'); ?></option>
                                                            <?php endforeach; ?>
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
                                                        <?php foreach ($tindakan_all->result() as $key => $value) { ?>
                                                            <?php foreach ($s_tindakan as $key1 => $value1) :
                                                                ?><?php $pilih = ($value->id == $value1->tarif_tindakan_id) ? 'selected' : '' ?>
                                                                <option value="<?= $value->id; ?>" <?php echo $pilih; ?> ><?= $value->nama." - Rp.".number_format($value->tarif_pasien,2,',','.'); ?></option>
                                                            <?php endforeach; ?>
                                                        <?php } ?>
                                                    <?php endif; ?>
                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="box-body">
                                            <?php for ($i=1; $i < 9; $i++) {
                                                $ada = false;
                                                $racikan = null;
                                                foreach ($racikans as $r) {
                                                    if ($r->nama_racikan == 'racikan '.$i) {
                                                        $ada = true;
                                                        $racikan = $r;
                                                        break;
                                                    }
                                                }
                                                ?>
                                                <div class="form-group">
                                                    <label for="obat">Racikan <?= $i; ?></label>
                                                    <table>
                                                        <tr>
                                                            <?php for ($j=1; $j < 5; $j++) { ?>
                                                                <td>
                                                                    <select class="form-control select2" style="width: 100%" name="obat_racikan<?= $i; ?>[]" id="obat_racikan<?= $i.$j; ?>" >
                                                                        <option value="">--Pilih Obat--</option>
                                                                        <?php foreach ($obat_all as $key => $value) {
                                                                            if ($racikan != null) {
                                                                                $same_id = $racikan->racikan[$j - 1]->obat_id == $value->id;
                                                                            }
                                                                            ?>
                                                                            <option value="<?= $value->id ?>" <?= ($ada && $same_id) ? 'selected' : '' ?>><?= $value->nama ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <input type="number" class="form-control" name="jumlah_satuan<?= $i; ?>[]" id="jumlah_satuan<?= $i.$j; ?>" value="<?= ($ada) ? $racikan->racikan[$j - 1]->jumlah_satuan : '' ?>" onchange="loadDataRacikan(<?= $i; ?>,<?= $j; ?>);"  placeholder="Jumlah Satuan" onchange="loadDataRacikan(<?= $i; ?>)">
                                                                </td>
                                                            <?php } ?>
                                                        </tr>
                                                        <tr><td><div style="height: 5px"></div></td></tr>
                                                        <tr><td colspan="4"> <input type="text" class="form-control" name="signa<?= $i; ?>" placeholder="signa" value="<?= ($ada) ? $racikan->signa : '' ?>"></td></tr>
                                                        <tr><td colspan="4"> <input type="text" class="form-control" name="catatan<?= $i; ?>" placeholder="catatan" value="<?= ($ada) ? $racikan->catatan : '' ?>"></td></tr>
                                                    </table>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" name="submit" value="1" class="btn btn-primary btn-lg btn-flat pull-right">Simpan</button>
                                <a href="<?=base_url()?>pemeriksaan/listpemeriksaanPasien" class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <br>
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
        for (var j = 1; j < 5 ; j++) {
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
