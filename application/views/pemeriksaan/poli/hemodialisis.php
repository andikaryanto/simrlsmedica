<style media="screen">
    .hd {
        border: 1px solid #eee;
        text-align: left;
    }

    .hd input {
        width: 100%;
        border: 0;
        border-bottom: 1px dotted #333;
        background-color: #fff0;
    }

    .hd input:focus {
        border-style: solid;
        outline: none !important;
    }

    #area-pemeriksaan{
        padding: 0;
        cursor: pointer;
    }

    #area-pemeriksaan .marker{
        width:40px;
        height:23px;
        text-align:right;
        position:absolute;
        color: red;
        font-weight: bold;
    }

    .italic {
        font-style: italic;
    }
    .bold {
        font-weight: bold !important;
    }
    .not-bold label {
        font-weight: normal;
    }
    .small-text {
        font-size: 12px;
    }

    [type="checkbox"] {
        vertical-align:middle;
    }
    .my-checkbox input {
        width: 14px;
        margin-top: 0;
        margin-bottom: 3px;
    }

    .inner-table {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    .inner-table td, .inner-table th {
        border: 1px solid #ddd;
        padding: 8px;
    }
    .inner-table tr:nth-child(even){background-color: #f2f2f2;}
    .inner-table th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }

    .tbl-resiko-jatuh td {
        padding: 4px;
    }

    .inline-input {
        display: inline-block !important;
    }
    .inline-input-next {
        display: inline-block !important;
        margin-left: 10px;
    }

    .tbl-terpadu {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    .tbl-terpadu td, .tbl-terpadu th {
        padding: 4px 4px !important;
        border: 1px solid #ddd;
        text-align: center !important;
        vertical-align: middle !important;
    }
    .tbl-terpadu tr:nth-child(even){background-color: #f6f6f6;}
    .tbl-terpadu th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
    .tbl-terpadu input, textarea {
        height: 100%;
        width: 40px;
        resize: none;
    }
    .tr-pre-hd td {
        height: 60px;
    }
    .tr-intra-hd td {
        height: 130px;
    }
    .tr-post-hd td {
        height: 100px;
    }
</style>

<script>
    let binded = [];
    let bindCheck = (check, text) => {
        $(`#${check}`).change(function () {
            let txt = $(`#${text}`);
            txt.prop('disabled', !this.checked);
            if (!this.checked) {
                txt.val('');
            }
        });
        binded.push({check, text});
    };
</script>

<div class="form-group">
    <label class="col-sm-3 control-label"></label>
</div>
<div class="col-sm-12">
    <div class="table-responsive">
        <table class="table table-striped hd">
            <tbody>
            <tr>
                <td colspan="3"><label class="control-label">1. KELUHAN UTAMA</label></td>
            </tr>
            <tr class="not-bold">
                <td></td>
                <td colspan="3">
                    <div class="form-check my-checkbox">
                        <input type="checkbox" class="form-check-input" id="sesak_napas" name="hd[keluhan_utama][sesak_napas]" <?=isset($hd['keluhan_utama']['sesak_napas']) ? 'checked' : ''?>>
                        <label class="form-check-label" for="sesak_napas">Sesak Napas</label>
                    </div>
                    <div class="form-check my-checkbox">
                        <input type="checkbox" class="form-check-input" id="mual_muntah" name="hd[keluhan_utama][mual_muntah]" <?=isset($hd['keluhan_utama']['mual_muntah']) ? 'checked' : ''?>>
                        <label class="form-check-label" for="mual_muntah">Mual, Muntah</label>
                    </div>
                    <div class="form-check my-checkbox">
                        <input type="checkbox" class="form-check-input" id="gatal" name="hd[keluhan_utama][gatal]" <?=isset($hd['keluhan_utama']['gatal']) ? 'checked' : ''?>>
                        <label class="form-check-label" for="gatal">Gatal</label>
                    </div>
                    <div class="form-check my-checkbox">
                        <input type="checkbox" class="form-check-input" id="nyeri" name="hd[keluhan_utama][nyeri]" <?=isset($hd['keluhan_utama']['nyeri']) ? 'checked' : ''?>>
                        <label class="form-check-label" for="nyeri">Nyeri</label>
                    </div>
                    <div class="form-check my-checkbox">
                        <input type="checkbox" class="form-check-input" id="cb_lain_lain">
                        <label class="form-check-label" for="cb_lain_lain">Lain-lain</label>
                        <input type="text" id="lain_lain" style="width: 200px; margin-left: 5px;" name="hd[keluhan_utama][lain_lain]" value="<?=isset($hd) ? $hd['keluhan_utama']['lain_lain'] : ''?>" disabled>
                    </div>
                </td>
            </tr>
            <script>
                bindCheck('cb_lain_lain', 'lain_lain');
            </script>
            <tr>
                <td colspan="3" class="not-bold">
                    <div class="row">
                        <div class="col-sm-8">
                            <img style="width: 100%;" src="<?=base_url().'assets/img/frm-hd.png'?>" alt="Status Lokalis"><br>
                            <div style="display: inline">
                                <span>Lokasi:</span>
                                <input type="text" style="width: 200px; margin-left: 5px;" name="hd[keluhan_utama][lokasi]" value="<?=isset($hd) ? $hd['keluhan_utama']['lokasi'] : ''?>">
                                <span style="margin-left: 10px;">Durasi:</span>
                                <input type="text" style="width: 200px; margin-left: 5px;" name="hd[keluhan_utama][durasi]" value="<?=isset($hd) ? $hd['keluhan_utama']['durasi'] : ''?>">
                            </div>
                        </div>
                        <div class="col-sm-4" style="margin-top: 10px;">
                            <span style="display: inline-block; width: 60px; font-weight: bold;">Ringan</span>0 - 3<br>
                            <span style="display: inline-block; width: 60px; font-weight: bold;">Sedang</span>4 - 6<br>
                            <span style="display: inline-block; width: 60px; font-weight: bold;">Berat</span>7 - 10<br>
                            <div style="padding-bottom: 10px;"></div>
                            <div class="form-check my-checkbox inline-input">
                                <input type="checkbox" class="form-check-input" id="akut" name="hd[keluhan_utama][akut]" <?=isset($hd['keluhan_utama']['akut']) ? 'checked' : ''?>>
                                <label class="form-check-label" for="akut">Akut</label>
                            </div>
                            <div class="form-check my-checkbox inline-input-next">
                                <input type="checkbox" class="form-check-input" id="kronik" name="hd[keluhan_utama][kronik]" <?=isset($hd['keluhan_utama']['kronik']) ? 'checked' : ''?>>
                                <label class="form-check-label" for="kronik">Kronik</label>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3"><label class="control-label">2. PEMERIKSAAN FISIK</label></td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="table-responsive">
                        <table class="table inner-table not-bold small-text">
                            <tr>
                                <td>Keadaan Umum</td>
                                <td>
                                    <div>
                                        <div class="form-check my-checkbox inline-input">
                                            <input type="checkbox" class="form-check-input" id="baik"
                                                   name="hd[pemeriksaan_fisik][keadaan_umum]"
                                                <?=isset($hd['pemeriksaan_fisik']['keadaan_umum']) ? 'checked' : ''?>
                                                   value="baik">
                                            <label class="form-check-label" for="baik">Baik</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="sedang"
                                                   name="hd[pemeriksaan_fisik][keadaan_umum]"
                                                <?=isset($hd['pemeriksaan_fisik']['keadaan_umum']) ? 'checked' : ''?>
                                                   value="sedang">
                                            <label class="form-check-label" for="sedang">Sedang</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="buruk"
                                                   name="hd[pemeriksaan_fisik][keadaan_umum]"
                                                <?=isset($hd['pemeriksaan_fisik']['keadaan_umum']) ? 'checked' : ''?>
                                                   value="buruk">
                                            <label class="form-check-label" for="buruk">Buruk</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="cb_keadaan_umum">
                                            <label class="form-check-label" for="cb_keadaan_umum">Lain-lain</label>
                                            <input type="text" id="txt_keadaan_umum" style="width: 200px; margin-left: 5px;"
                                                   disabled
                                                   name="hd[pemeriksaan_fisik][keadaan_umum]"
                                                   value="<?=isset($hd) ? $hd['pemeriksaan_fisik']['keadaan_umum'] : ''?>">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <script>
                                bindCheck('cb_keadaan_umum', 'txt_keadaan_umum');
                            </script>
                            <tr>
                                <td>Tekanan Darah</td>
                                <td>
                                    <div style="display: inline !important;">
                                        <input type="text" style="width: 100px; margin-left: 5px;" name="hd[pemeriksaan_fisik][tekanan_darah][mmHg]" value="<?=isset($hd) ? $hd['pemeriksaan_fisik']['tekanan_darah']['mmHg'] : ''?>">
                                        <span>mmHg</span>
                                        <span style="margin-left: 10px;">MAP:</span>
                                        <input type="text" style="width: 200px; margin-left: 5px;" name="hd[pemeriksaan_fisik][tekanan_darah][MAP]" value="<?=isset($hd) ? $hd['pemeriksaan_fisik']['tekanan_darah']['MAP'] : ''?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Nadi</td>
                                <td>
                                    <div>
                                        <div class="form-check my-checkbox inline-input">
                                            <input type="checkbox" class="form-check-input" id="reguler" name="hd[pemeriksaan_fisik][nadi][reguler]" <?=isset($hd['pemeriksaan_fisik']['nadi']['reguler']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="reguler">Reguler</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="ireguler" name="hd[pemeriksaan_fisik][nadi][ireguler]" <?=isset($hd['pemeriksaan_fisik']['nadi']['ireguler']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="ireguler">Ireguler</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <label class="form-check-label" for="cb_lain_lain1">Frek</label>
                                            <input type="text" id="lain_lain1" style="width: 100px; margin-left: 5px;"
                                                   name="hd[pemeriksaan_fisik][nadi][frek]"
                                                   value="<?=isset($hd) ? $hd['pemeriksaan_fisik']['nadi']['frek'] : ''?>">
                                            <label class="form-check-label" for="cb_lain_lain1">(x/mnt)</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Respirasi</td>
                                <td>
                                    <div>
                                        <div class="form-check my-checkbox inline-input">
                                            <input type="checkbox" class="form-check-input" id="edema_paru"
                                                   name="hd[pemeriksaan_fisik][respirasi][edema_paru]"
                                                <?=isset($hd['pemeriksaan_fisik']['respirasi']['edema_paru']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="edema_paru">Edema paru / Ronchi</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="kusmaul"
                                                   name="hd[pemeriksaan_fisik][respirasi][kusmaul]"
                                                <?=isset($hd['pemeriksaan_fisik']['respirasi']['kusmaul']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="kusmaul">Kusmaul</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="dispnea"
                                                   name="hd[pemeriksaan_fisik][respirasi][dispnea]"
                                                <?=isset($hd['pemeriksaan_fisik']['respirasi']['dispnea']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="dispnea">Dispnea</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="normal"
                                                   name="hd[pemeriksaan_fisik][respirasi][normal]"
                                                <?=isset($hd['pemeriksaan_fisik']['respirasi']['normal']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="normal">Normal</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="cb_resp_frek">
                                            <label class="form-check-label" for="frek">Frek</label>
                                            <input type="text" id="txt_resp_frek" style="width: 100px; margin-left: 5px;"
                                                   disabled
                                                   name="hd[pemeriksaan_fisik][respirasi][frek]"
                                                   value="<?=isset($hd) ? $hd['pemeriksaan_fisik']['respirasi']['frek'] : ''?>">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <script>
                                bindCheck('cb_resp_frek', 'txt_resp_frek');
                            </script>
                            <tr>
                                <td>Konjungtiva</td>
                                <td>
                                    <div>
                                        <div class="form-check my-checkbox inline-input">
                                            <input type="checkbox" class="form-check-input" id="tidak_anemis"
                                                   name="hd[pemeriksaan_fisik][konjungtiva][tidak_anemis]"
                                                <?=isset($hd['pemeriksaan_fisik']['konjungtiva']['tidak_anemis']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="tidak_anemis">Tidak anemis</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="anemis"
                                                   name="hd[pemeriksaan_fisik][konjungtiva][anemis]"
                                                <?=isset($hd['pemeriksaan_fisik']['konjungtiva']['anemis']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="anemis">Anemis</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="cb_konjung_lain">
                                            <label class="form-check-label" for="frek">Lain-lain</label>
                                            <input type="text" id="txt_konjung_lain" style="width: 200px; margin-left: 5px;"
                                                   disabled
                                                   name="hd[pemeriksaan_fisik][konjungtiva][lain_lain]"
                                                   value="<?=isset($hd) ? $hd['pemeriksaan_fisik']['konjungtiva']['lain_lain'] : ''?>">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <script>
                                bindCheck('cb_konjung_lain', 'txt_konjung_lain');
                            </script>
                            <tr>
                                <td>Ekstrimitas</td>
                                <td>
                                    <div>
                                        <div class="form-check my-checkbox inline-input">
                                            <input type="checkbox" class="form-check-input" id="tidak_edema"
                                                   name="hd[pemeriksaan_fisik][extrimitas][tidak_edema]"
                                                <?=isset($hd['pemeriksaan_fisik']['extrimitas']['tidak_edema']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="tidak_edema">Tidak edema/Tidak dehidrasi</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="dehidrasi"
                                                   name="hd[pemeriksaan_fisik][extrimitas][dehidrasi]"
                                                <?=isset($hd['pemeriksaan_fisik']['extrimitas']['dehidrasi']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="dehidrasi">Dehidrasi</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="oedema"
                                                   name="hd[pemeriksaan_fisik][extrimitas][oedema]"
                                                <?=isset($hd['pemeriksaan_fisik']['extrimitas']['oedema']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="oedema">Oedema</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="edema_anarsaka"
                                                   name="hd[pemeriksaan_fisik][extrimitas][edema_anarsaka]"
                                                <?=isset($hd['pemeriksaan_fisik']['extrimitas']['edema_anarsaka']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="edema_anarsaka">Edema anarsaka</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="pucat_dingin"
                                                   name="hd[pemeriksaan_fisik][extrimitas][pucat_dingin]"
                                                <?=isset($hd['pemeriksaan_fisik']['extrimitas']['pucat_dingin']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="pucat_dingin">Pucat & dingin</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Berat badan</td>
                                <td>
                                    <div>
                                        <div class="form-check my-checkbox inline-input">
                                            <label class="form-check-label bold">Pre HD</label>
                                            <input type="text" style="width: 50px; margin-left: 5px;"
                                                   name="hd[pemeriksaan_fisik][berat_badan][pre_hd]"
                                                   value="<?=isset($hd) ? $hd['pemeriksaan_fisik']['berat_badan']['pre_hd'] : ''?>">
                                            <label class="form-check-label italic">kg</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <label class="form-check-label bold">BB kering</label>
                                            <input type="text" style="width: 50px; margin-left: 5px;"
                                                   name="hd[pemeriksaan_fisik][berat_badan][bb_kering]"
                                                   value="<?=isset($hd) ? $hd['pemeriksaan_fisik']['berat_badan']['bb_kering'] : ''?>">
                                            <label class="form-check-label italic">kg</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <label class="form-check-label bold">BB HD y.l</label>
                                            <input type="text" style="width: 50px; margin-left: 5px;"
                                                   name="hd[pemeriksaan_fisik][berat_badan][bb_hd_yl]"
                                                   value="<?=isset($hd) ? $hd['pemeriksaan_fisik']['berat_badan']['bb_hd_yl'] : ''?>">
                                            <label class="form-check-label italic">kg</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <label class="form-check-label bold">Post HD</label>
                                            <input type="text" style="width: 50px; margin-left: 5px;"
                                                   name="hd[pemeriksaan_fisik][berat_badan][post_hd]"
                                                   value="<?=isset($hd) ? $hd['pemeriksaan_fisik']['berat_badan']['post_hd'] : ''?>">
                                            <label class="form-check-label italic">kg</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Akses Vaskular</td>
                                <td>
                                    <div>
                                        <div class="form-check my-checkbox inline-input">
                                            <input type="checkbox" class="form-check-input" id="av_fistula"
                                                   name="hd[pemeriksaan_fisik][akses_vaskular][av_fistula]"
                                                <?=isset($hd['pemeriksaan_fisik']['akses_vaskular']['av_fistula']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="av_fistula">AV-fistula</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next" style="margin-left: 30px !important;">
                                            <label class="form-check-label bold">HD karakter:</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="subclavia"
                                                   name="hd[pemeriksaan_fisik][akses_vaskular][subclavia]"
                                                <?=isset($hd['pemeriksaan_fisik']['akses_vaskular']['subclavia']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="subclavia">subclavia</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="jugular"
                                                   name="hd[pemeriksaan_fisik][akses_vaskular][jugular]"
                                                <?=isset($hd['pemeriksaan_fisik']['akses_vaskular']['jugular']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="jugular">jugular</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="femoral"
                                                   name="hd[pemeriksaan_fisik][akses_vaskular][femoral]"
                                                <?=isset($hd['pemeriksaan_fisik']['akses_vaskular']['femoral']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="femoral">femoral</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="cb_av_lain">
                                            <label class="form-check-label" for="lainnya">lainnya</label>
                                            <input type="text" id="txt_av_lain" style="width: 200px; margin-left: 5px;"
                                                   disabled
                                                   name="hd[pemeriksaan_fisik][akses_vaskular][lainnya]"
                                                   value="<?=isset($hd) ? $hd['pemeriksaan_fisik']['akses_vaskular']['lainnya'] : ''?>">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <script>
                                bindCheck('cb_av_lain', 'txt_av_lain');
                            </script>
                            <tr>
                                <td colspan="100%" style="margin: 0; padding: 0;">
                                    <div class="table-responsive">
                                        <table style="width: 100%" class="table tbl-resiko-jatuh">
                                            <tr>
                                                <td colspan="2">Resiko jatuh : berikan <strong>checklist</strong> pada kotak skor</td>
                                                <td></td>
                                                <td>Skor</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" rowspan="2">1. Riwayat jatuh yang baru atau dalam bulan terakhir</td>
                                                <td>Tidak</td>
                                                <td>
                                                    <div class="form-check my-checkbox inline-input-next">
                                                        <input type="checkbox" class="form-check-input" id="1tidak"
                                                               name="hd[pemeriksaan_fisik][resiko_jatuh][1tidak]"
                                                            <?=isset($hd['pemeriksaan_fisik']['resiko_jatuh']['1tidak']) ? 'checked' : ''?>>
                                                        <label class="form-check-label" for="1tidak">0</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ya</td>
                                                <td>
                                                    <div class="form-check my-checkbox inline-input-next">
                                                        <input type="checkbox" class="form-check-input" id="1ya"
                                                               name="hd[pemeriksaan_fisik][resiko_jatuh][1ya]"
                                                            <?=isset($hd['pemeriksaan_fisik']['resiko_jatuh']['1ya']) ? 'checked' : ''?>>
                                                        <label class="form-check-label" for="1ya">25</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" rowspan="2">2. Diagnosis medis sekunder > 1</td>
                                                <td>Tidak</td>
                                                <td>
                                                    <div class="form-check my-checkbox inline-input-next">
                                                        <input type="checkbox" class="form-check-input" id="2tidak"
                                                               name="hd[pemeriksaan_fisik][resiko_jatuh][2tidak]"
                                                            <?=isset($hd['pemeriksaan_fisik']['resiko_jatuh']['2tidak']) ? 'checked' : ''?>>
                                                        <label class="form-check-label" for="2tidak">0</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ya</td>
                                                <td>
                                                    <div class="form-check my-checkbox inline-input-next">
                                                        <input type="checkbox" class="form-check-input" id="2ya"
                                                               name="hd[pemeriksaan_fisik][resiko_jatuh][2ya]"
                                                            <?=isset($hd['pemeriksaan_fisik']['resiko_jatuh']['2ya']) ? 'checked' : ''?>>
                                                        <label class="form-check-label" for="2ya">15</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" rowspan="3">3. Alat bantu jalan</td>
                                                <td>Bed rest</td>
                                                <td>
                                                    <div class="form-check my-checkbox inline-input-next">
                                                        <input type="checkbox" class="form-check-input" id="bed_rest"
                                                               name="hd[pemeriksaan_fisik][resiko_jatuh][bed_rest]"
                                                            <?=isset($hd['pemeriksaan_fisik']['resiko_jatuh']['bed_rest']) ? 'checked' : ''?>>
                                                        <label class="form-check-label" for="bed_rest">0</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Penopang, tongkat</td>
                                                <td>
                                                    <div class="form-check my-checkbox inline-input-next">
                                                        <input type="checkbox" class="form-check-input" id="penopang_tongkat"
                                                               name="hd[pemeriksaan_fisik][resiko_jatuh][penopang_tongkat]"
                                                            <?=isset($hd['pemeriksaan_fisik']['resiko_jatuh']['penopang_tongkat']) ? 'checked' : ''?>>
                                                        <label class="form-check-label" for="penopang_tongkat">15</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Furnitur</td>
                                                <td>
                                                    <div class="form-check my-checkbox inline-input-next">
                                                        <input type="checkbox" class="form-check-input" id="furnitur"
                                                               name="hd[pemeriksaan_fisik][resiko_jatuh][furnitur]"
                                                            <?=isset($hd['pemeriksaan_fisik']['resiko_jatuh']['furnitur']) ? 'checked' : ''?>>
                                                        <label class="form-check-label" for="furnitur">30</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" rowspan="2">4. Memakai terapi heparin lock/ iv</td>
                                                <td>Tidak</td>
                                                <td>
                                                    <div class="form-check my-checkbox inline-input-next">
                                                        <input type="checkbox" class="form-check-input" id="4tidak"
                                                               name="hd[pemeriksaan_fisik][resiko_jatuh][4tidak]"
                                                            <?=isset($hd['pemeriksaan_fisik']['resiko_jatuh']['4tidak']) ? 'checked' : ''?>>
                                                        <label class="form-check-label" for="4tidak">0</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ya</td>
                                                <td>
                                                    <div class="form-check my-checkbox inline-input-next">
                                                        <input type="checkbox" class="form-check-input" id="4ya"
                                                               name="hd[pemeriksaan_fisik][resiko_jatuh][4ya]"
                                                            <?=isset($hd['pemeriksaan_fisik']['resiko_jatuh']['4ya']) ? 'checked' : ''?>>
                                                        <label class="form-check-label" for="4ya">20</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" rowspan="3">5. Cara berjalan / berpindah</td>
                                                <td>Normal/bedrest/imobilisasi</td>
                                                <td>
                                                    <div class="form-check my-checkbox inline-input-next">
                                                        <input type="checkbox" class="form-check-input" id="normal"
                                                               name="hd[pemeriksaan_fisik][resiko_jatuh][normal]"
                                                            <?=isset($hd['pemeriksaan_fisik']['resiko_jatuh']['normal']) ? 'checked' : ''?>>
                                                        <label class="form-check-label" for="normal">0</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Lemah</td>
                                                <td>
                                                    <div class="form-check my-checkbox inline-input-next">
                                                        <input type="checkbox" class="form-check-input" id="lemah"
                                                               name="hd[pemeriksaan_fisik][resiko_jatuh][lemah]"
                                                            <?=isset($hd['pemeriksaan_fisik']['resiko_jatuh']['lemah']) ? 'checked' : ''?>>
                                                        <label class="form-check-label" for="lemah">15</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Terganggu</td>
                                                <td>
                                                    <div class="form-check my-checkbox inline-input-next">
                                                        <input type="checkbox" class="form-check-input" id="terganggu"
                                                               name="hd[pemeriksaan_fisik][resiko_jatuh][terganggu]"
                                                            <?=isset($hd['pemeriksaan_fisik']['resiko_jatuh']['terganggu']) ? 'checked' : ''?>>
                                                        <label class="form-check-label" for="terganggu">30</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" rowspan="2">6. Status mental</td>
                                                <td>Orientasi sesuai kemampuan</td>
                                                <td>
                                                    <div class="form-check my-checkbox inline-input-next">
                                                        <input type="checkbox" class="form-check-input" id="orientasi"
                                                               name="hd[pemeriksaan_fisik][resiko_jatuh][orientasi]"
                                                            <?=isset($hd['pemeriksaan_fisik']['resiko_jatuh']['orientasi']) ? 'checked' : ''?>>
                                                        <label class="form-check-label" for="orientasi">0</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Lupa keterbatasan</td>
                                                <td>
                                                    <div class="form-check my-checkbox inline-input-next">
                                                        <input type="checkbox" class="form-check-input" id="lupa"
                                                               name="hd[pemeriksaan_fisik][resiko_jatuh][lupa]"
                                                            <?=isset($hd['pemeriksaan_fisik']['resiko_jatuh']['lupa']) ? 'checked' : ''?>>
                                                        <label class="form-check-label" for="lupa">15</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    Kesimpulan:
                                                    <div class="form-check my-checkbox inline-input-next" style="padding-top: 8px;">
                                                        <input type="radio" class="form-check-input" id="tidak_beresiko"
                                                               name="hd[pemeriksaan_fisik][resiko_jatuh][tidak_beresiko]"
                                                               value="<?=isset($hd) ? $hd['pemeriksaan_fisik']['resiko_jatuh']['tidak_beresiko'] : ''?>" checked>
                                                        <label class="form-check-label" for="tidak_beresiko">0-24 (tidak beresiko)</label>
                                                    </div>
                                                    <div class="form-check my-checkbox inline-input-next" style="padding-top: 8px;">
                                                        <input type="radio" class="form-check-input" id="resiko_rendah"
                                                               name="hd[pemeriksaan_fisik][resiko_jatuh][resiko_rendah]"
                                                               value="<?=isset($hd) ? $hd['pemeriksaan_fisik']['resiko_jatuh']['resiko_rendah'] : ''?>" disabled>
                                                        <label class="form-check-label" for="resiko_rendah">25-50 (resiko rendah)</label>
                                                    </div>
                                                    <div class="form-check my-checkbox inline-input-next" style="padding-top: 8px;">
                                                        <input type="radio" class="form-check-input" id="resiko_tinggi"
                                                               name="hd[pemeriksaan_fisik][resiko_jatuh][resiko_tinggi]"
                                                               value="<?=isset($hd) ? $hd['pemeriksaan_fisik']['resiko_jatuh']['resiko_tinggi'] : ''?>" disabled>
                                                        <label class="form-check-label" for="resiko_tinggi">> 51 (resiko tinggi)</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    Skor total
                                                    <input type="text" id="txt_resiko_jatuh_total" style="width: 40px; margin-left: 5px;"
                                                           name="hd[pemeriksaan_fisik][resiko_jatuh][skor_total]"
                                                           value="<?=isset($hd) ? $hd['pemeriksaan_fisik']['resiko_jatuh']['skor_total'] : ''?>" disabled>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3"><label class="control-label">3. PEMERIKSAAN PENUNJANG</label></td>
            </tr>
            <tr class="not-bold">
                <td></td>
                <td colspan="3">
                    <div class="form-check my-checkbox">
                        <label class="form-check-label" for="lab_rontgent_lain_lain">(Lab, Rontgent, Lain-lain):</label>
                        <input type="text" style="width: 300px; margin-left: 5px;" id="lab_rontgent_lain_lain" name="hd[pemeriksaan_penunjang][lab_rontgent_lain_lain]" value="<?=isset($hd) ? $hd['pemeriksaan_penunjang']['lab_rontgent_lain_lain'] : ''?>">
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3"><label class="control-label">4. GIZI (dikaji tiap 3-6 bulan sekali atau diulangi jika dianggap terjadi perburukan asupan gizi)</label></td>
            </tr>
            <tr class="not-bold">
                <td></td>
                <td colspan="3">
                    <div class="form-check my-checkbox inline-input">
                        <label class="form-check-label" for="sesak_napas">-Tanggal</label>
                        <input type="text" style="width: 100px; margin-left: 5px;" name="hd[gizi][tanggal]" value="<?=isset($hd) ? $hd['gizi']['tanggal'] : ''?>">
                    </div>
                    <div class="form-check my-checkbox inline-input-next">
                        <input type="checkbox" class="form-check-input" id="mis" name="hd[gizi][mis]" <?=isset($hd['gizi']['mis']) ? 'checked' : ''?>>
                        <label class="form-check-label" for="mis">MIS, </label>
                    </div>
                    <div class="form-check my-checkbox inline-input-next">
                        <label class="form-check-label" for="score_total">Score total:</label>
                        <input type="text" style="width: 100px; margin-left: 5px;" id="score_total" name="hd[gizi][score_total]" value="<?=isset($hd) ? $hd['gizi']['score_total'] : ''?>">
                    </div>
                    <div class="form-check my-checkbox inline-input-next">
                        <input type="checkbox" class="form-check-input" id="sga" name="hd[gizi][sga]" <?=isset($hd['gizi']['sga']) ? 'checked' : ''?>>
                        <label class="form-check-label" for="sga">SGA, </label>
                    </div>
                    <div class="form-check my-checkbox inline-input-next">
                        <label class="form-check-label" for="score_total2">Score total:</label>
                        <input type="text" style="width: 100px; margin-left: 5px;" id="score_total2" name="hd[gizi][score_total2]" value="<?=isset($hd) ? $hd['gizi']['score_total2'] : ''?>">
                    </div>
                </td>
            </tr>
            <tr class="not-bold">
                <td></td>
                <td colspan="3">
                    <div class="form-check my-checkbox inline-input">
                        <label class="form-check-label" for="sesak_napas">-Keimpulan:</label>
                        <input type="text" style="width: 200px; margin-left: 5px;" name="hd[gizi][tanggal]" value="<?=isset($hd) ? $hd['gizi']['tanggal'] : ''?>">
                    </div>
                    <div class="form-check my-checkbox inline-input-next">
                        <input type="checkbox" class="form-check-input" id="tanpa_malnutrisi" name="hd[gizi][tanpa_malnutrisi]" <?=isset($hd['gizi']['tanpa_malnutrisi']) ? 'checked' : ''?>>
                        <label class="form-check-label" for="tanpa_malnutrisi">Tanpa malnutrisi (<6), </label>
                    </div>
                    <div class="form-check my-checkbox inline-input-next">
                        <input type="checkbox" class="form-check-input" id="malnutrisi" name="hd[gizi][malnutrisi]" <?=isset($hd['gizi']['malnutrisi']) ? 'checked' : ''?>>
                        <label class="form-check-label" for="malnutrisi">Malnutrisi (>6)</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3"><label class="control-label">5. RIWAYAT PSIKOSOSIAL (dikaji saat kunjungan pertama atau kunjungan terakhir > 1 tahun)</label></td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="table-responsive">
                        <table class="table inner-table not-bold small-text">
                            <tr>
                                <td>
                                    <div>
                                        <div class="form-check my-checkbox inline-input">
                                            <label class="form-check-label">
                                                - Adakah keyakinan/tradisi/budaya yang berkaitan dengan pelayanan kesehatan yang akan diberikan
                                            </label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="adakah_tidak"
                                                   name="hd[riwayat_psiko][adakah][tidak]"
                                                <?=isset($hd['riwayat_psiko']['adakah']['tidak']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="adakah_tidak">Tidak</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="adakah_ya"
                                                   name="hd[riwayat_psiko][adakah][ya]"
                                                <?=isset($hd['riwayat_psiko']['adakah']['ya']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="adakah_ya">Ya</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <div class="form-check my-checkbox inline-input">
                                            <label class="form-check-label" style="width: 150px;">
                                                - Kendala komunikasi
                                            </label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="kendala_tidak_ada"
                                                   name="hd[riwayat_psiko][kendala][tidak_ada]"
                                                <?=isset($hd['riwayat_psiko']['kendala']['tidak_ada']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="kendala_tidak_ada">Tidak Ada</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="kendala_ada"
                                                   name="hd[riwayat_psiko][kendala][ada]"
                                                <?=isset($hd['riwayat_psiko']['kendala']['ada']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="kendala_ada">Ada,</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <label class="form-check-label" for="kendala_jelaskan">Jelaskan</label>
                                            <input type="text" style="width: 200px; margin-left: 5px;"
                                                   id="kendala_jelaskan"
                                                   name="hd[riwayat_psiko][kendala][jelaskan]"
                                                   value="<?=isset($hd) ? $hd['riwayat_psiko']['kendala']['jelaskan'] : ''?>">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <div class="form-check my-checkbox inline-input">
                                            <label class="form-check-label" style="width: 150px;">
                                                - Yang merawat di rumah
                                            </label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="yang_merawat_tidak_ada"
                                                   name="hd[riwayat_psiko][yang_merawat][tidak_ada]"
                                                <?=isset($hd['riwayat_psiko']['yang_merawat']['tidak_ada']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="yang_merawat_tidak_ada">Tidak Ada</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="yang_merawat_ada"
                                                   name="hd[riwayat_psiko][yang_merawat][ada]"
                                                <?=isset($hd['riwayat_psiko']['yang_merawat']['ada']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="yang_merawat_ada">Ada,</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <label class="form-check-label" for="yang_merawat_jelaskan">Jelaskan</label>
                                            <input type="text" style="width: 200px; margin-left: 5px;"
                                                   id="yang_merawat_jelaskan"
                                                   name="hd[riwayat_psiko][yang_merawat][jelaskan]"
                                                   value="<?=isset($hd) ? $hd['riwayat_psiko']['yang_merawat']['jelaskan'] : ''?>">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <div class="form-check my-checkbox inline-input">
                                            <label class="form-check-label" style="width: 150px;">
                                                - Kondisi saat ini
                                            </label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="kondisi_tenang"
                                                   name="hd[riwayat_psiko][kondisi][tenang]"
                                                <?=isset($hd['riwayat_psiko']['kondisi']['tenang']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="kondisi_tenang">Tenang</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="kondisi_gelisah"
                                                   name="hd[riwayat_psiko][kondisi][gelisah]"
                                                <?=isset($hd['riwayat_psiko']['kondisi']['gelisah']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="kondisi_gelisah">Gelisah</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="kondisi_takut"
                                                   name="hd[riwayat_psiko][kondisi][takut]"
                                                <?=isset($hd['riwayat_psiko']['kondisi']['takut']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="kondisi_takut">Takut terhadap tindakan</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="kondisi_marah"
                                                   name="hd[riwayat_psiko][kondisi][marah]"
                                                <?=isset($hd['riwayat_psiko']['kondisi']['marah']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="kondisi_marah">Marah</label>
                                        </div>
                                        <div class="form-check my-checkbox inline-input-next">
                                            <input type="checkbox" class="form-check-input" id="kondisi_tersinggung"
                                                   name="hd[riwayat_psiko][kondisi][tersinggung]"
                                                <?=isset($hd['riwayat_psiko']['kondisi']['tersinggung']) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="kondisi_tersinggung">Mudah tersinggung</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <table class="table table-striped hd">
            <tbody>
            <tr>
                <td colspan="2" style="overflow: hidden;">
                    <label class="control-label" style="width: 180px;">
                        <span style="float: left">DIAGNOSIS MEDIS: </span>
                    </label>
                    <input type="text" style="width: calc(100% - 190px); margin-left: 5px;" name="hd[diagnosis_medis]" value="<?=isset($hd) ? $hd['diagnosis_medis'] : ''?>">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label class="control-label" style="width: 180px;">
                        <span style="float: left">DIAGNOSIS KEPERAWATAN: </span>
                    </label>
                    <input type="text" style="width: calc(100% - 190px); margin-left: 5px;" name="hd[diagnosis_keperawatan]" value="<?=isset($hd) ? $hd['diagnosis_keperawatan'] : ''?>">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label class="control-label" style="width: 180px;">
                        <span style="float: left">DIAGNOSIS GIZI/PSIKOLOGI: </span>
                    </label>
                    <input type="text" style="width: calc(100% - 190px); margin-left: 5px;" name="hd[diagnosis_gizi]" value="<?=isset($hd) ? $hd['diagnosis_gizi'] : ''?>">
                </td>
            </tr>
            <tr class="bold">
                <td colspan="2"><u>INTERVENSI (rekapitulasi pre-intra dan post-HD):</u></td>
            </tr>
            <tr class="not-bold">
                <td>
                    <div class="form-check my-checkbox inline-input">
                        <input type="checkbox" class="form-check-input" id="int_monitor"
                               name="hd[intervensi][monitor]"
                            <?=isset($hd['intervensi']['monitor_bb']) ? 'checked' : ''?>>
                        <label class="form-check-label" for="int_monitor">Monitor berat badan, intake out put</label>
                    </div>
                </td>
                <td>
                    <div class="form-check my-checkbox inline-input">
                        <input type="checkbox" class="form-check-input" id="int_posisikan"
                               name="hd[intervensi][posisikan]"
                            <?=isset($hd['intervensi']['posisikan']) ? 'checked' : ''?>>
                        <label class="form-check-label" for="int_posisikan">Posisikan supinasi dengan elevasi kepala 30° dan elevasi khaki</label>
                    </div>
                </td>
            </tr>
            <tr class="not-bold">
                <td>
                    <div class="form-check my-checkbox inline-input">
                        <input type="checkbox" class="form-check-input" id="int_atur"
                               name="hd[intervensi][atur]"
                            <?=isset($hd['intervensi']['atur']) ? 'checked' : ''?>>
                        <label class="form-check-label" for="int_atur">Atur posisi pasien agar ventilasi adekuat</label>
                    </div>
                </td>
                <td>
                    <div class="form-check my-checkbox inline-input">
                        <input type="checkbox" class="form-check-input" id="int_penkes">
                        <label class="form-check-label" for="int_penkes">PENKES: diit, AV-Shunt,</label>
                        <input type="text" id="txt_int_penkes" style="width: 150px; margin-left: 5px;" name="hd[intervensi][penkes]" value="<?=isset($hd) ? $hd['intervensi']['penkes'] : ''?>" disabled>
                    </div>
                </td>
                <script>
                    bindCheck('int_penkes', 'txt_int_penkes');
                </script>
            </tr>
            <tr class="not-bold">
                <td>
                    <div class="form-check my-checkbox inline-input">
                        <input type="checkbox" class="form-check-input" id="int_berikan"
                               name="hd[intervensi][berikan]"
                            <?=isset($hd['intervensi']['berikan']) ? 'checked' : ''?>>
                        <label class="form-check-label" for="int_berikan">Berikan terapi oksigen sesuai kebutuhan</label>
                    </div>
                </td>
                <td>
                    <div class="form-check my-checkbox inline-input">
                        <input type="checkbox" class="form-check-input" id="int_monitor"
                               name="hd[intervensi][monitor]"
                            <?=isset($hd['intervensi']['monitor_tanda']) ? 'checked' : ''?>>
                        <label class="form-check-label" for="int_monitor">Monitor tanda dan gejala infeksi (lokal dan sistemik)</label>
                    </div>
                </td>
            </tr>
            <tr class="not-bold">
                <td>
                    <div class="form-check my-checkbox inline-input">
                        <input type="checkbox" class="form-check-input" id="int_observasi"
                               name="hd[intervensi][observasi]"
                            <?=isset($hd['intervensi']['observasi']) ? 'checked' : ''?>>
                        <label class="form-check-label" for="int_observasi">Observasi pasien (monitor vital sign) dan mesin</label>
                    </div>
                </td>
                <td>
                    <div class="form-check my-checkbox inline-input">
                        <input type="checkbox" class="form-check-input" id="int_ganti"
                               name="hd[intervensi][ganti]"
                            <?=isset($hd['intervensi']['ganti']) ? 'checked' : ''?>>
                        <label class="form-check-label" for="int_ganti">Ganti balutan luka sesuai dengan prosedur</label>
                    </div>
                </td>
            </tr>
            <tr class="not-bold">
                <td>
                    <div class="form-check my-checkbox inline-input">
                        <input type="checkbox" class="form-check-input" id="int_bila"
                               name="hd[intervensi][bila]"
                            <?=isset($hd['intervensi']['bila']) ? 'checked' : ''?>>
                        <label class="form-check-label" for="int_bila">Bila pasien mulai hipotensi, (mual, muntah, keringat dingin, pusing), kram, hipoglikemi berikan cairan sesuai SPO)</label>
                    </div>
                </td>
                <td>
                    <div class="form-check my-checkbox inline-input">
                        <input type="checkbox" class="form-check-input" id="int_monitor2"
                               name="hd[intervensi][monitor2]"
                            <?=isset($hd['intervensi']['monitor2']) ? 'checked' : ''?>>
                        <label class="form-check-label" for="int_monitor2">Monitor tanda dan gejala hipoglikemi</label>
                    </div>
                </td>
            </tr>
            <tr class="not-bold">
                <td>
                    <div class="form-check my-checkbox inline-input">
                        <input type="checkbox" class="form-check-input" id="int_hentikan"
                               name="hd[intervensi][hentikan]"
                            <?=isset($hd['intervensi']['hentikan']) ? 'checked' : ''?>>
                        <label class="form-check-label" for="int_hentikan">Hentikan HD sesuai indikasi</label>
                    </div>
                </td>
                <td>
                    <div class="form-check my-checkbox inline-input">
                        <input type="checkbox" class="form-check-input" id="int_lakukan"
                               name="hd[intervensi][lakukan]"
                            <?=isset($hd['intervensi']['lakukan']) ? 'checked' : ''?>>
                        <label class="form-check-label" for="int_lakukan">Lakukan teknik distraksi, relaksasi</label>
                    </div>
                </td>
            </tr>
            <tr class="not-bold">
                <td>
                    <div class="form-check my-checkbox inline-input">
                        <input type="checkbox" class="form-check-input" id="int_kaji"
                               name="hd[intervensi][kaji]"
                            <?=isset($hd['intervensi']['kaji']) ? 'checked' : ''?>>
                        <label class="form-check-label" for="int_kaji">Kaji kemampuan pasien mendapatkan nutrisi yang dibutuhkan</label>
                    </div>
                </td>
                <td>
                    <div class="form-check my-checkbox inline-input">
                        <input type="checkbox" class="form-check-input" id="int_lain">
                        <input type="text" id="txt_int_lain" style="width: 200px; margin-left: 5px;" name="hd[intervensi][lain]" value="<?=isset($hd) ? $hd['intervensi']['lain'] : ''?>" disabled>
                    </div>
                </td>
                <script>
                    bindCheck('int_lain', 'txt_int_lain');
                </script>
            </tr>
            <tr>
                <td class="bold" colspan="2">Intervensi kolaborasi:</td>
            </tr>
            <tr>
                <td colspan="2" class="not-bold">
                    <div>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="ik_program"
                                   name="hd[ik_program]"
                                <?=isset($hd['ik_program']) ? 'checked' : ''?>>
                            <label class="form-check-label" for="ik_program">Program HD</label>
                        </div>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="ik_tranfusi"
                                   name="hd[ik_tranfusi]"
                                <?=isset($hd['ik_tranfusi']) ? 'checked' : ''?>>
                            <label class="form-check-label" for="ik_tranfusi">Tranfusi darah</label>
                        </div>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="ik_kolab"
                                   name="hd[ik_kolab]"
                                <?=isset($hd['ik_kolab']) ? 'checked' : ''?>>
                            <label class="form-check-label" for="ik_kolab">Kolaborasi diit</label>
                        </div>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="ik_pemberian"
                                   name="hd[ik_pemberian]"
                                <?=isset($hd['ik_pemberian']) ? 'checked' : ''?>>
                            <label class="form-check-label" for="ik_pemberian">Pemberian Ca Gluconas</label>
                        </div>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="ik_pemberian_anti"
                                   name="hd[ik_pemberian_anti]"
                                <?=isset($hd['ik_pemberian_anti']) ? 'checked' : ''?>>
                            <label class="form-check-label" for="ik_pemberian_anti">Pemberian Antipiretik</label>
                        </div>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="ik_analgetik"
                                   name="hd[ik_analgetik]"
                                <?=isset($hd['ik_analgetik']) ? 'checked' : ''?>>
                            <label class="form-check-label" for="ik_analgetik">Analgetik</label>
                        </div>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="ik_pemberian_preparat"
                                   name="hd[ik_pemberian_preparat]"
                                <?=isset($hd['ik_pemberian_preparat']) ? 'checked' : ''?>>
                            <label class="form-check-label" for="ik_pemberian_preparat">Pemberian preparat besi</label>
                        </div>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="ik_pemberian_ery"
                                   name="hd[ik_pemberian_ery]"
                                <?=isset($hd['ik_pemberian_ery']) ? 'checked' : ''?>>
                            <label class="form-check-label" for="ik_pemberian_ery">Pemberian Erytropoetin</label>
                        </div>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="ik_obat"
                                   name="hd[ik_obat]"
                                <?=isset($hd['ik_obat']) ? 'checked' : ''?>>
                            <label class="form-check-label" for="ik_obat">Obat-obat emergensi</label>
                        </div>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="ik_pemberian_antibitotik"
                                   name="hd[ik_pemberian_antibitotik]"
                                <?=isset($hd['ik_pemberian_antibitotik']) ? 'checked' : ''?>>
                            <label class="form-check-label" for="ik_pemberian_antibitotik">Pemberian Antibiotik</label>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <table class="table table-striped hd">
            <tbody>
            <tr>
                <td>Resep HD: </td>
                <td class="not-bold">
                    <div>
                        <div class="form-check my-checkbox inline-input">
                            <input type="checkbox" class="form-check-input" id="inisiasi"
                                   name="hd[resep_hd][inisiasi]"
                                <?=isset($hd['resep_hd']['inisiasi']) ? 'checked' : ''?>
                                   value="inisiasi">
                            <label class="form-check-label" for="inisiasi">Inisiasi</label>
                        </div>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="rhd_akut"
                                   name="hd[resep_hd][akut]"
                                <?=isset($hd['resep_hd']['akut']) ? 'checked' : ''?>
                                   value="rhd_akut">
                            <label class="form-check-label" for="rhd_akut">Akut</label>
                        </div>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="rhd_rutin"
                                   name="hd[resep_hd][rutin]"
                                <?=isset($hd['resep_hd']['rutin']) ? 'checked' : ''?>
                                   value="rhd_rutin">
                            <label class="form-check-label" for="rhd_rutin">Rutin</label>
                        </div>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="pre_op"
                                   name="hd[resep_hd][pre_op]"
                                <?=isset($hd['resep_hd']['pre_op']) ? 'checked' : ''?>
                                   value="pre_op">
                            <label class="form-check-label" for="pre_op">Pre-Op</label>
                        </div>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="sled"
                                   name="hd[resep_hd][sled]"
                                <?=isset($hd['resep_hd']['sled']) ? 'checked' : ''?>
                                   value="sled">
                            <label class="form-check-label" for="sled">SLED</label>
                        </div>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="cb_hd_other">
                            <input type="text" id="txt_hd_other" style="width: 100px; margin-left: 5px;"
                                   disabled
                                   name="hd[resep_hd][other]"
                                   value="<?=isset($hd) ? $hd['resep_hd']['other'] : ''?>">
                        </div>
                        <script>
                            bindCheck('cb_hd_other', 'txt_hd_other');
                        </script>
                        <div class="form-check my-checkbox inline-input-next">
                            <label class="form-check-label" for="txt_hd_td">TD:</label>
                            <input type="text" id="txt_hd_td" style="width: 50px; margin-left: 5px;"
                                   name="hd[resep_hd][td]"
                                   value="<?=isset($hd) ? $hd['resep_hd']['td'] : ''?>">
                            <label class="form-check-label" for="txt_hd_td">jam</label>
                        </div>
                        <div class="form-check my-checkbox inline-input-next">
                            <label class="form-check-label" for="txt_hd_qb">QB:</label>
                            <input type="text" id="txt_hd_qb" style="width: 50px; margin-left: 5px;"
                                   name="hd[resep_hd][qb]"
                                   value="<?=isset($hd) ? $hd['resep_hd']['qb'] : ''?>">
                            <label class="form-check-label" for="txt_hd_qb">ml/mnt</label>
                        </div>
                        <div class="form-check my-checkbox inline-input-next">
                            <label class="form-check-label" for="txt_hd_qd">QD:</label>
                            <input type="text" id="txt_hd_qd" style="width: 50px; margin-left: 5px;"
                                   name="hd[resep_hd][qd]"
                                   value="<?=isset($hd) ? $hd['resep_hd']['qd'] : ''?>">
                            <label class="form-check-label" for="txt_hd_qd">ml/mnt</label>
                        </div>
                        <div class="form-check my-checkbox inline-input-next">
                            <label class="form-check-label" for="txt_hd_uf_goal">UF Goal:</label>
                            <input type="text" id="txt_hd_uf_goal" style="width: 50px; margin-left: 5px;"
                                   name="hd[resep_hd][uf_goal]"
                                   value="<?=isset($hd) ? $hd['resep_hd']['uf_goal'] : ''?>">
                            <label class="form-check-label" for="txt_hd_uf_goal">ml</label>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Prog. Profiling: </td>
                <td class="not-bold">
                    <div>
                        <div class="form-check my-checkbox inline-input">
                            <input type="checkbox" class="form-check-input" id="cb_pr_na">
                            <label class="form-check-label" for="cb_pr_na">Na:</label>
                            <input type="text" id="txt_pr_na" style="width: 100px; margin-left: 5px;"
                                   disabled
                                   name="hd[profiling][na]"
                                   value="<?=isset($hd) ? $hd['profiling']['na'] : ''?>">
                        </div>
                        <script>
                            bindCheck('cb_pr_na', 'txt_pr_na');
                        </script>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="cb_pr_uf">
                            <label class="form-check-label" for="cb_pr_uf">UF:</label>
                            <input type="text" id="txt_pr_uf" style="width: 100px; margin-left: 5px;"
                                   disabled
                                   name="hd[profiling][uf]"
                                   value="<?=isset($hd) ? $hd['profiling']['uf'] : ''?>">
                        </div>
                        <script>
                            bindCheck('cb_pr_uf', 'txt_pr_uf');
                        </script>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="cb_pr_bicarbonat">
                            <label class="form-check-label" for="cb_pr_bicarbonat">Bicarbonat:</label>
                            <input type="text" id="txt_pr_bicarbonat" style="width: 100px; margin-left: 5px;"
                                   disabled
                                   name="hd[profiling][bicarbonat]"
                                   value="<?=isset($hd) ? $hd['profiling']['bicarbonat'] : ''?>">
                        </div>
                        <script>
                            bindCheck('cb_pr_bicarbonat', 'txt_pr_bicarbonat');
                        </script>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Dialisat: </td>
                <td class="not-bold">
                    <div>
                        <div class="form-check my-checkbox inline-input">
                            <input type="checkbox" class="form-check-input" id="asetat"
                                   name="hd[dialisat][asetat]"
                                <?=isset($hd['dialisat']['asetat']) ? 'checked' : ''?>
                                   value="asetat">
                            <label class="form-check-label" for="asetat">Asetat</label>
                        </div>
                        <div class="form-check my-checkbox inline-input">
                            <input type="checkbox" class="form-check-input" id="dial_bicarbonat"
                                   name="hd[dialisat][dial_bicarbonat]"
                                <?=isset($hd['dialisat']['dial_bicarbonat']) ? 'checked' : ''?>
                                   value="dial_bicarbonat">
                            <label class="form-check-label" for="dial_bicarbonat">Bicarbonat</label>
                        </div>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="cb_dial_condactivity">
                            <label class="form-check-label" for="cb_dial_condactivity">Condactivity:</label>
                            <input type="text" id="txt_dial_condactivity" style="width: 100px; margin-left: 5px;"
                                   disabled
                                   name="hd[dialisat][bicarbonat]"
                                   value="<?=isset($hd) ? $hd['dialisat']['bicarbonat'] : ''?>">
                        </div>
                        <script>
                            bindCheck('cb_dial_condactivity', 'txt_dial_condactivity');
                        </script>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="cb_dial_temperatur">
                            <label class="form-check-label" for="cb_dial_temperatur">Temperatur:</label>
                            <input type="text" id="txt_dial_temperatur" style="width: 100px; margin-left: 5px;"
                                   disabled
                                   name="hd[dialisat][temperatur]"
                                   value="<?=isset($hd) ? $hd['dialisat']['temperatur'] : ''?>">
                        </div>
                        <script>
                            bindCheck('cb_dial_temperatur', 'txt_dial_temperatur');
                        </script>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Heparinisasi: </td>
                <td class="not-bold">
                    <div>
                        <div class="form-check my-checkbox inline-input">
                            <input type="checkbox" class="form-check-input" id="cb_ds_sirkulasi">
                            <label class="form-check-label" for="cb_ds_sirkulasi">Dosis sirkulasi</label>
                            <input type="text" id="txt_ds_sirkulasi" style="width: 100px; margin-left: 5px;"
                                   disabled
                                   name="hd[heparinisasi][ds_sirkulasi]"
                                   value="<?=isset($hd) ? $hd['heparinisasi']['ds_sirkulasi'] : ''?>">
                            <label class="form-check-label" for="txt_ds_sirkulasi">iu</label>
                        </div>
                        <script>
                            bindCheck('cb_ds_sirkulasi', 'txt_ds_sirkulasi');
                        </script>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="cb_ds_awal">
                            <label class="form-check-label" for="cb_ds_awal">Dosis awal</label>
                            <input type="text" id="txt_ds_awal" style="width: 100px; margin-left: 5px;"
                                   disabled
                                   name="hd[heparinisasi][ds_awal]"
                                   value="<?=isset($hd) ? $hd['heparinisasi']['ds_awal'] : ''?>">
                            <label class="form-check-label" for="txt_ds_awal">iu</label>
                        </div>
                        <script>
                            bindCheck('cb_ds_awal', 'txt_ds_awal');
                        </script>
                        <br>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="cb_ds_maintenance">
                            <label class="form-check-label" for="cb_ds_maintenance">Dosis maintenance:</label>
                        </div>
                        <br>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="cb_ds_continue">
                            <label class="form-check-label" for="cb_ds_continue">Continue</label>
                            <input type="text" id="txt_ds_continue" style="width: 100px; margin-left: 5px;"
                                   disabled
                                   name="hd[heparinisasi][ds_continue]"
                                   value="<?=isset($hd) ? $hd['heparinisasi']['ds_continue'] : ''?>">
                            <label class="form-check-label" for="txt_ds_continue">iu/jam</label>
                        </div>
                        <script>
                            bindCheck('cb_ds_continue', 'txt_ds_continue');
                        </script>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="cb_ds_intermitten">
                            <label class="form-check-label" for="cb_ds_intermitten">Intermitten</label>
                            <input type="text" id="txt_ds_intermitten" style="width: 100px; margin-left: 5px;"
                                   disabled
                                   name="hd[heparinisasi][ds_intermitten]"
                                   value="<?=isset($hd) ? $hd['heparinisasi']['ds_intermitten'] : ''?>">
                            <label class="form-check-label" for="txt_ds_intermitten">iu/jam</label>
                        </div>
                        <script>
                            bindCheck('cb_ds_intermitten', 'txt_ds_intermitten');
                        </script>
                        <br>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="cb_lmwh">
                            <label class="form-check-label" for="cb_lmwh">LMWH</label>
                            <input type="text" id="txt_cb_lmwh" style="width: 100px; margin-left: 5px;"
                                   disabled
                                   name="hd[heparinisasi][lmwh]"
                                   value="<?=isset($hd) ? $hd['heparinisasi']['lmwh'] : ''?>">
                        </div>
                        <script>
                            bindCheck('cb_lmwh', 'txt_cb_lmwh');
                        </script>
                        <br>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="cb_tanpa_heparin">
                            <label class="form-check-label" for="cb_tanpa_heparin">Tanpa Heparin, Penyebab:</label>
                            <input type="text" id="txt_cb_tanpa_heparin" style="width: 100px; margin-left: 5px;"
                                   disabled
                                   name="hd[heparinisasi][tanpa_heparin]"
                                   value="<?=isset($hd) ? $hd['heparinisasi']['tanpa_heparin'] : ''?>">
                        </div>
                        <script>
                            bindCheck('cb_tanpa_heparin', 'txt_cb_tanpa_heparin');
                        </script>
                        <br>
                        <div class="form-check my-checkbox inline-input-next">
                            <input type="checkbox" class="form-check-input" id="cb_prog_bilas">
                            <label class="form-check-label" for="cb_prog_bilas">Program bilas NaCl 0,9% 100 cc/jam/ ½ jam</label>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Catatan lain: </td>
                <td class="not-bold">
                    <div class="form-check my-checkbox inline-input">
                        <div class="form-group form-check my-checkbox inline-input-next">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text"
                                           class="form-control"
                                           name="hd[heparinisasi][catatan_lain]"
                                           id="hd_catatan_lain"
                                           style="width: 400px; margin-left: 5px;"
                                           value="<?=isset($hd) ? $hd['heparinisasi']['catatan_lain'] : ''?>">
                                </div>
                            </div>
<!--                            <input type="text" style="width: calc(100% - 190px); margin-left: 5px;" name="hd[diagnosis_medis]" value="--><?//=isset($hd) ? $hd['diagnosis_medis'] : ''?><!--">-->
<!--                            <textarea style="width: 100%;" class="form-control" name="hd[heparinisasi][catatan_lain]" rows="4">--><?//=isset($hd) ? $hd['heparinisasi']['catatan_lain'] : ''?><!--</textarea>-->
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <label class="control-label bold">TINDAKAN TERPADU</label>
        <table class="table tbl-terpadu" style="font-size: 10px;">
            <tr style="text-align:right">
                <th rowspan="2" style="font-size: 12px; line-height: 1;"><span>o<br>b<br>s<br>e<br>r<br>v<br>a<br>s<br>i</span></th>
                <th rowspan="2">Jam</th>
                <th rowspan="2">QB<br>(ml/mnt)</th>
                <th rowspan="2">UF Rate (ml)</th>
                <th rowspan="2">Tek. Drh (mmhg)</th>
                <th rowspan="2">Nadi (x/mnt)</th>
                <th rowspan="2">Suhu (°C)</th>
                <th rowspan="2">Resp (x/mnt)</th>
                <th colspan="4">Intake (cc)</th>
                <th>Output (cc)</th>
                <th rowspan="2">Kt/v</th>
                <th rowspan="2" style="word-break: keep-all; white-space: nowrap;">Keterangan Lain</th>
                <th rowspan="2">Paraf & Nama Jelas</th>
            </tr>
            <tr style="text-align:right">
                <th>NaCl 0,9%</th>
                <th>Dextrose 40%</th>
                <th>Makan / Minum</th>
                <th>Lain-lain</th>
                <th>UF volume</th>
            </tr>
            <tr class="tr-pre-hd">
                <td>PRE-HD</td>
                <td><textarea name="hd[terpadu][pre_hd][jam]"><?=isset($hd) ? $hd['terpadu']['pre_hd']['jam'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][pre_hd][qb]"><?=isset($hd) ? $hd['terpadu']['pre_hd']['qb'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][pre_hd][uf_rate]"><?=isset($hd) ? $hd['terpadu']['pre_hd']['uf_rate'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][pre_hd][tek_drh]"><?=isset($hd) ? $hd['terpadu']['pre_hd']['tek_drh'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][pre_hd][nadi]"><?=isset($hd) ? $hd['terpadu']['pre_hd']['nadi'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][pre_hd][suhu]"><?=isset($hd) ? $hd['terpadu']['pre_hd']['suhu'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][pre_hd][resp]"><?=isset($hd) ? $hd['terpadu']['pre_hd']['resp'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][pre_hd][nacl]"><?=isset($hd) ? $hd['terpadu']['pre_hd']['nacl'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][pre_hd][dextrose]"><?=isset($hd) ? $hd['terpadu']['pre_hd']['dextrose'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][pre_hd][makan_minum]"><?=isset($hd) ? $hd['terpadu']['pre_hd']['makan_minum'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][pre_hd][lain_lain]"><?=isset($hd) ? $hd['terpadu']['pre_hd']['lain_lain'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][pre_hd][uf]"><?=isset($hd) ? $hd['terpadu']['pre_hd']['uf'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][pre_hd][ktv]"><?=isset($hd) ? $hd['terpadu']['pre_hd']['ktv'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][pre_hd][ket_lain]" style="width: 100%"><?=isset($hd) ? $hd['terpadu']['pre_hd']['ket_lain'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][pre_hd][paraf]"><?=isset($hd) ? $hd['terpadu']['pre_hd']['paraf'] : ''?></textarea></td>
            </tr>
            <tr class="tr-intra-hd">
                <td>INTRA-HD</td>
                <td><textarea name="hd[terpadu][intra_hd][jam]"><?=isset($hd) ? $hd['terpadu']['intra_hd']['jam'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][intra_hd][qb]"><?=isset($hd) ? $hd['terpadu']['intra_hd']['qb'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][intra_hd][uf_rate]"><?=isset($hd) ? $hd['terpadu']['intra_hd']['uf_rate'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][intra_hd][tek_drh]"><?=isset($hd) ? $hd['terpadu']['intra_hd']['tek_drh'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][intra_hd][nadi]"><?=isset($hd) ? $hd['terpadu']['intra_hd']['nadi'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][intra_hd][suhu]"><?=isset($hd) ? $hd['terpadu']['intra_hd']['suhu'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][intra_hd][resp]"><?=isset($hd) ? $hd['terpadu']['intra_hd']['resp'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][intra_hd][nacl]"><?=isset($hd) ? $hd['terpadu']['intra_hd']['nacl'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][intra_hd][dextrose]"><?=isset($hd) ? $hd['terpadu']['intra_hd']['dextrose'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][intra_hd][makan_minum]"><?=isset($hd) ? $hd['terpadu']['intra_hd']['makan_minum'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][intra_hd][lain_lain]"><?=isset($hd) ? $hd['terpadu']['intra_hd']['lain_lain'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][intra_hd][uf]"><?=isset($hd) ? $hd['terpadu']['intra_hd']['uf'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][intra_hd][ktv]"><?=isset($hd) ? $hd['terpadu']['intra_hd']['ktv'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][intra_hd][ket_lain]" style="width: 100%"><?=isset($hd) ? $hd['terpadu']['intra_hd']['ket_lain'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][intra_hd][paraf]"><?=isset($hd) ? $hd['terpadu']['intra_hd']['paraf'] : ''?></textarea></td>
            </tr>
            <tr class="tr-post-hd">
                <td>POST-HD</td>
                <td><textarea name="hd[terpadu][post_hd][jam]"><?=isset($hd) ? $hd['terpadu']['post_hd']['jam'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][post_hd][qb]"><?=isset($hd) ? $hd['terpadu']['post_hd']['qb'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][post_hd][uf_rate]"><?=isset($hd) ? $hd['terpadu']['post_hd']['uf_rate'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][post_hd][tek_drh]"><?=isset($hd) ? $hd['terpadu']['post_hd']['tek_drh'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][post_hd][nadi]"><?=isset($hd) ? $hd['terpadu']['post_hd']['nadi'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][post_hd][suhu]"><?=isset($hd) ? $hd['terpadu']['post_hd']['suhu'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][post_hd][resp]"><?=isset($hd) ? $hd['terpadu']['post_hd']['resp'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][post_hd][nacl]"><?=isset($hd) ? $hd['terpadu']['post_hd']['nacl'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][post_hd][dextrose]"><?=isset($hd) ? $hd['terpadu']['post_hd']['dextrose'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][post_hd][makan_minum]"><?=isset($hd) ? $hd['terpadu']['post_hd']['makan_minum'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][post_hd][lain_lain]"><?=isset($hd) ? $hd['terpadu']['post_hd']['lain_lain'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][post_hd][uf]"><?=isset($hd) ? $hd['terpadu']['post_hd']['uf'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][post_hd][ktv]"><?=isset($hd) ? $hd['terpadu']['post_hd']['ktv'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][post_hd][ket_lain]" style="width: 100%"><?=isset($hd) ? $hd['terpadu']['post_hd']['ket_lain'] : ''?></textarea></td>
                <td><textarea name="hd[terpadu][post_hd][paraf]"><?=isset($hd) ? $hd['terpadu']['post_hd']['paraf'] : ''?></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="4">
                    Jumlah:<br>
                    <input type="text" name="hd[terpadu][jumlah_1]" value="<?=isset($hd) ? $hd['terpadu']['jumlah_1'] : ''?>" style="width: 100%">
                </td>
                <td>
                    Jumlah:<br>
                    <input type="text" name="hd[terpadu][jumlah_2]" value="<?=isset($hd) ? $hd['terpadu']['jumlah_2'] : ''?>">
                </td>
                <td></td>
                <td>
                    Balance:<br>
                    <input type="text" name="hd[terpadu][balance]" value="<?=isset($hd) ? $hd['terpadu']['balance'] : ''?>" style="width: 100%">
                </td>
                <td rowspan="2"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="7">
                    Total UF: <input type="text" name="hd[terpadu][total_uf]" value="<?=isset($hd) ? $hd['terpadu']['total_uf'] : ''?>" style="width: 80px"> ml
                </td>
            </tr>
        </table>
        <table class="table table-striped hd">
            <tbody>
            <tr>
                <td><label class="control-label">Penyulit selama HD:</label></td>
            </tr>
            <tr class="not-bold">
                <td>
                    <div class="form-check my-checkbox inline-input-next">
                        <input type="checkbox" class="form-check-input" id="masalah_akses"
                               name="hd[penyulit][masalah_akses]"
                            <?=isset($hd['penyulit']['masalah_akses']) ? 'checked' : ''?>
                               value="masalah_akses">
                        <label class="form-check-label" for="masalah_akses">Masalah Akses</label>
                    </div>
                    <div class="form-check my-checkbox inline-input-next">
                        <input type="checkbox" class="form-check-input" id="pendarahan"
                               name="hd[penyulit][pendarahan]"
                            <?=isset($hd['penyulit']['pendarahan']) ? 'checked' : ''?>
                               value="pendarahan">
                        <label class="form-check-label" for="pendarahan">Pendarahan</label>
                    </div>
                    <div class="form-check my-checkbox inline-input-next">
                        <input type="checkbox" class="form-check-input" id="first_use_syndrom"
                               name="hd[penyulit][first_use_syndrom]"
                            <?=isset($hd['penyulit']['first_use_syndrom']) ? 'checked' : ''?>
                               value="first_use_syndrom">
                        <label class="form-check-label" for="first_use_syndrom">First Use Syndrom</label>
                    </div>
                    <div class="form-check my-checkbox inline-input-next">
                        <input type="checkbox" class="form-check-input" id="sakit_kepala"
                               name="hd[penyulit][sakit_kepala]"
                            <?=isset($hd['penyulit']['sakit_kepala']) ? 'checked' : ''?>
                               value="sakit_kepala">
                        <label class="form-check-label" for="sakit_kepala">Sakit Kepala</label>
                    </div>
                    <div class="form-check my-checkbox inline-input-next">
                        <input type="checkbox" class="form-check-input" id="mual_muntah"
                               name="hd[penyulit][mual_muntah]"
                            <?=isset($hd['penyulit']['mual_muntah']) ? 'checked' : ''?>
                               value="mual_muntah">
                        <label class="form-check-label" for="mual_muntah">Mual & muntah</label>
                    </div>
                    <div class="form-check my-checkbox inline-input-next">
                        <input type="checkbox" class="form-check-input" id="kram_otot"
                               name="hd[penyulit][kram_otot]"
                            <?=isset($hd['penyulit']['kram_otot']) ? 'checked' : ''?>
                               value="kram_otot">
                        <label class="form-check-label" for="kram_otot">Kram otot</label>
                    </div>
                    <div class="form-check my-checkbox inline-input-next">
                        <input type="checkbox" class="form-check-input" id="hiperkalemia"
                               name="hd[penyulit][hiperkalemia]"
                            <?=isset($hd['penyulit']['hiperkalemia']) ? 'checked' : ''?>
                               value="hiperkalemia">
                        <label class="form-check-label" for="hiperkalemia">Hiperkalemia</label>
                    </div>
                    <div class="form-check my-checkbox inline-input-next">
                        <input type="checkbox" class="form-check-input" id="hipotensi"
                               name="hd[penyulit][hipotensi]"
                            <?=isset($hd['penyulit']['hipotensi']) ? 'checked' : ''?>
                               value="hipotensi">
                        <label class="form-check-label" for="hipotensi">Hipotensi</label>
                    </div>
                    <div class="form-check my-checkbox inline-input-next">
                        <input type="checkbox" class="form-check-input" id="hipertensi"
                               name="hd[penyulit][hipertensi]"
                            <?=isset($hd['penyulit']['hipertensi']) ? 'checked' : ''?>
                               value="hipertensi">
                        <label class="form-check-label" for="hipertensi">Hipertensi</label>
                    </div>
                    <div class="form-check my-checkbox inline-input-next">
                        <input type="checkbox" class="form-check-input" id="nyeri_dada"
                               name="hd[penyulit][nyeri_dada]"
                            <?=isset($hd['penyulit']['nyeri_dada']) ? 'checked' : ''?>
                               value="nyeri_dada">
                        <label class="form-check-label" for="nyeri_dada">Nyeri dada</label>
                    </div>
                    <div class="form-check my-checkbox inline-input-next">
                        <input type="checkbox" class="form-check-input" id="aritmia"
                               name="hd[penyulit][aritmia]"
                            <?=isset($hd['penyulit']['aritmia']) ? 'checked' : ''?>
                               value="aritmia">
                        <label class="form-check-label" for="aritmia">Aritmia</label>
                    </div>
                    <div class="form-check my-checkbox inline-input-next">
                        <input type="checkbox" class="form-check-input" id="gatal_gatal"
                               name="hd[penyulit][gatal_gatal]"
                            <?=isset($hd['penyulit']['gatal_gatal']) ? 'checked' : ''?>
                               value="gatal_gatal">
                        <label class="form-check-label" for="gatal_gatal">Gatal - gatal</label>
                    </div>
                    <div class="form-check my-checkbox inline-input-next">
                        <input type="checkbox" class="form-check-input" id="demam"
                               name="hd[penyulit][demam]"
                            <?=isset($hd['penyulit']['demam']) ? 'checked' : ''?>
                               value="demam">
                        <label class="form-check-label" for="demam">Demam</label>
                    </div>
                    <div class="form-check my-checkbox inline-input-next">
                        <input type="checkbox" class="form-check-input" id="menggigil"
                               name="hd[penyulit][menggigil]"
                            <?=isset($hd['penyulit']['menggigil']) ? 'checked' : ''?>
                               value="menggigil">
                        <label class="form-check-label" for="menggigil">Menggigil/dingin</label>
                    </div>
                    <div class="form-check my-checkbox inline-input-next">
                        <input type="checkbox" class="form-check-input" id="penyulit_lain">
                        <label class="form-check-label" for="penyulit_lain">Lain-lain</label>
                        <input type="text" id="txt_penyulit_lain" style="width: 200px; margin-left: 5px;"
                               disabled
                               name="hd[penyulit][penyulit_lain]"
                               value="<?=isset($hd) ? $hd['penyulit']['penyulit_lain'] : ''?>">
                    </div>
                </td>
            </tr>
            <script>
                bindCheck('penyulit_lain', 'txt_penyulit_lain');
            </script>
            <tr>
                <td><label class="control-label">EVALUASI:</label></td>
            </tr>
            <tr class="not-bold">
                <td>
                    <div class="form-check my-checkbox inline-input-next">
                        <input type="text" id="evaluasi" style="width: 400px; margin-left: 5px;"
                               name="hd[evaluasi]"
                               value="<?=isset($hd) ? $hd['evaluasi'] : ''?>">
                    </div>
                </td>
            </tr>
            <tr>
                <td><label class="control-label">Discharge Planning (gunakan form edukasi jika diperlukan):</label></td>
            </tr>
            <tr class="not-bold">
                <td>
                    <div class="form-check my-checkbox inline-input-next">
                        <input type="text" id="discharge" style="width: 400px; margin-left: 5px;"
                               name="hd[discharge]"
                               value="<?=isset($hd) ? $hd['discharge'] : ''?>">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<p style="color: rgba(0,0,0,0)">break</p>

<script type="text/javascript">
    let cbs = [
        $('#1tidak'),
        $('#1ya'),
        $('#2tidak'),
        $('#2ya'),
        $('#bed_rest'),
        $('#penopang_tongkat'),
        $('#furnitur'),
        $('#4tidak'),
        $('#4ya'),
        $('#normal'),
        $('#lemah'),
        $('#terganggu'),
        $('#orientasi'),
        $('#lupa')
    ];

    let countResikoJatuh = () => {
        let sum = cbs.filter(v => v.is(":checked"))
            .map(v => v.siblings('label').first().html())
            .map(v => parseInt(v))
            .reduce((a, b) => a + b, 0);

        $('#txt_resiko_jatuh_total').val(sum);

        $("#tidak_beresiko").prop("checked", sum < 25).prop("disabled", sum > 24);
        $("#resiko_rendah").prop("checked", sum >= 25 && sum <= 50).prop("disabled", sum < 25 || sum > 50);
        $("#resiko_tinggi").prop("checked", sum > 51).prop("disabled", sum < 51);
    };

    cbs.forEach(v => v.change(countResikoJatuh));

    $(function () {
        countResikoJatuh();

        binded.forEach(v => {
            let check = $(`#${v.check}`);
            let txt = $(`#${v.text}`);

            check.prop('checked', txt.val() !== '');
            txt.prop('disabled', !check.checked);
        });
    });
</script>
