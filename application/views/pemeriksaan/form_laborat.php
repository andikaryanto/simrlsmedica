<?php
$hasil_lab = json_decode($pemeriksaan['hasil_lab'], true);
?>

<style>
    .padding-sm {
        padding: 5px !important;
    }
</style>

<br>

<div class="row">
    <div class="box box-success">
        <div class="box-body">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_1" data-toggle="tab" class="padding-sm">
                                <span style="font-size: 14px;">Hematologi</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_2" data-toggle="tab" class="padding-sm">
                                <span style="font-size: 14px;">Fungsi Ginjal</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_3" data-toggle="tab" class="padding-sm">
                                <span style="font-size: 14px;">Fungsi Hati</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_4" data-toggle="tab" class="padding-sm">
                                <span style="font-size: 14px;">Fungsi Jantung</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_5" data-toggle="tab" class="padding-sm">
                                <span style="font-size: 14px;">Gula Darah</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_6" data-toggle="tab" class="padding-sm">
                                <span style="font-size: 14px;">Profil Lemak</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_7" data-toggle="tab" class="padding-sm">
                                <span style="font-size: 14px;">Elektrolit dan Gas Darah</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_8" data-toggle="tab" class="padding-sm">
                                <span style="font-size: 14px;">Mikrobiologi</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_9" data-toggle="tab" class="padding-sm">
                                <span style="font-size: 14px;">Seriomonologi</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_10" data-toggle="tab" class="padding-sm">
                                <span style="font-size: 14px;">CRP</span>
                            </a>
                        </li>
                        <!-- SEPULUH-->
                        <li>
                            <a href="#tab_11" data-toggle="tab" class="padding-sm">
                                <span style="font-size: 14px;">Urinalisa</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_12" data-toggle="tab" class="padding-sm">
                                <span style="font-size: 14px;">Feses</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_13" data-toggle="tab" class="padding-sm">
                                <span style="font-size: 14px;">Spermatozoa</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_14" data-toggle="tab" class="padding-sm">
                                <span style="font-size: 14px;">Hormon</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_15" data-toggle="tab" class="padding-sm">
                                <span style="font-size: 14px;">Petanda Tumor</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_16" data-toggle="tab" class="padding-sm">
                                <span style="font-size: 14px;">Administrasi</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_17" data-toggle="tab" class="padding-sm">
                                <span style="font-size: 14px;">Bahan</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_18" data-toggle="tab" class="padding-sm">
                                <span style="font-size: 14px;">Narkoba</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_19" data-toggle="tab" class="padding-sm">
                                <span style="font-size: 14px;">Kehamilan</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_20" data-toggle="tab" class="padding-sm">
                                <span style="font-size: 14px;">Golongan Darah</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">

                            <h4 class="box-title text-center"><strong>Hematologi</strong></h4>

                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Hemoglobin</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="hemoglobin" name="hemoglobin" value="<?=isset($hasil_lab['hemoglobin']) ? $hasil_lab['hemoglobin'] : ''?>">
                                    <span class="input-group-addon">P:13.0 - 16.0 | W:12.0 - 14.0</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">LED 1jam/2jam</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="led" name="led" value="<?=isset($hasil_lab['led']) ? $hasil_lab['led'] : ''?>">
                                    <span class="input-group-addon">P < 10 | W < 15</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Leukosit</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="leukosit" name="leukosit" value="<?=isset($hasil_lab['leukosit']) ? $hasil_lab['leukosit'] : ''?>">
                                    <span class="input-group-addon">5000-10000</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Hitung Jenis</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="hitung" name="hitung" value="<?=isset($hasil_lab['hitung']) ? $hasil_lab['hitung'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Eosinophyl</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="eosinophyl" name="eosinophyl" value="<?=isset($hasil_lab['eosinophyl']) ? $hasil_lab['eosinophyl'] : ''?>">
                                    <span class="input-group-addon">1-3 </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Basophyl</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="basophyl" name="basophyl" value="<?=isset($hasil_lab['basophyl']) ? $hasil_lab['basophyl'] : ''?>">
                                    <span class="input-group-addon">0-1</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Stab</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="stab" name="stab" value="<?=isset($hasil_lab['stab']) ? $hasil_lab['stab'] : ''?>">
                                    <span class="input-group-addon">2-6</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Segment</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="segment" name="segment" value="<?=isset($hasil_lab['segment']) ? $hasil_lab['segment'] : ''?>">
                                    <span class="input-group-addon">50-70</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Lymposit</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="lymposit" name="lymposit" value="<?=isset($hasil_lab['lymposit']) ? $hasil_lab['lymposit'] : ''?>">
                                    <span class="input-group-addon">20-40</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Monosit</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="monosit" name="monosit" value="<?=isset($hasil_lab['monosit']) ? $hasil_lab['monosit'] : ''?>">
                                    <span class="input-group-addon">2-8</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Sel Lainnya</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="sel_lainnya" name="sel_lainnya" value="<?=isset($hasil_lab['sel_lainnya']) ? $hasil_lab['sel_lainnya'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Eosinofil</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="eosinofil" name="eosinofil" value="<?=isset($hasil_lab['eosinofil']) ? $hasil_lab['eosinofil'] : ''?>">
                                    <span class="input-group-addon">50-300</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Erytrosit</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="eritrosit" name="eritrosit" value="<?=isset($hasil_lab['eritrosit']) ? $hasil_lab['eritrosit'] : ''?>">
                                    <span class="input-group-addon">P:4.5 - 5.5 | W:4.0 - 5.0</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Trombocyt</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="trombocyt" name="trombocyt" value="<?=isset($hasil_lab['trombocyt']) ? $hasil_lab['trombocyt'] : ''?>">
                                    <span class="input-group-addon">150.000 - 500.000</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Reticulocyt</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="reticulocyt" name="reticulocyt" value="<?=isset($hasil_lab['reticulocyt']) ? $hasil_lab['reticulocyt'] : ''?>">
                                    <span class="input-group-addon">0.5-1.5</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Hematacrit</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="hematacrit" name="hematacrit" value="<?=isset($hasil_lab['hematacrit']) ? $hasil_lab['hematacrit'] : ''?>">
                                    <span class="input-group-addon">P:40-48% | W:37-43% | A:31-47%</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">MCV</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="mcv" name="mcv" value="<?=isset($hasil_lab['mcv']) ? $hasil_lab['mcv'] : ''?>">
                                    <span class="input-group-addon">82-92</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">MCH</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="mch" name="mch" value="<?=isset($hasil_lab['mch']) ? $hasil_lab['mch'] : ''?>">
                                    <span class="input-group-addon">27-31</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">MCHC</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="mchc" name="mchc" value="<?=isset($hasil_lab['mchc']) ? $hasil_lab['mchc'] : ''?>">
                                    <span class="input-group-addon">32-36</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Waktu Pendarahan</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="waktu_pendarahan" name="waktu_pendarahan" value="<?=isset($hasil_lab['waktu_pendarahan']) ? $hasil_lab['waktu_pendarahan'] : ''?>">
                                    <span class="input-group-addon">1-3</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Waktu Pembekuan</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="waktu_pembekuan" name="waktu_pembekuan" value="<?=isset($hasil_lab['waktu_pembekuan']) ? $hasil_lab['waktu_pembekuan'] : ''?>">
                                    <span class="input-group-addon">10-15</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Waktu Prothombin</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="waktu_prothombin" name="waktu_prothombin" value="<?=isset($hasil_lab['waktu_prothombin']) ? $hasil_lab['waktu_prothombin'] : ''?>">
                                    <span class="input-group-addon">11-14</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Waktu Rekalsifikasi</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="waktu_rkalsifikasi" name="waktu_rekalsifikasi" value="<?=isset($hasil_lab['waktu_rekalsifikasi']) ? $hasil_lab['waktu_rekalsifikasi'] : ''?>">
                                    <span class="input-group-addon">100-250</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">PTT</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="ptt" name="ptt" value="<?=isset($hasil_lab['ptt']) ? $hasil_lab['ptt'] : ''?>">
                                    <span class="input-group-addon">30-40</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Thrombotes Owren</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="thrombotes_owren" name="thrombotes_owren" value="<?=isset($hasil_lab['thrombotes_owren']) ? $hasil_lab['thrombotes_owren'] : ''?>">
                                    <span class="input-group-addon">70-100</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Fibrinogen</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="fibrinogen" name="fibrinogen" value="<?=isset($hasil_lab['fibrinogen']) ? $hasil_lab['fibrinogen'] : ''?>">
                                    <span class="input-group-addon">200-400</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Retraksi Bekuan</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="retraksi_bekuan" name="retraksi_bekuan" value="<?=isset($hasil_lab['retraksi_bekuan']) ? $hasil_lab['retraksi_bekuan'] : ''?>">
                                    <span class="input-group-addon">40-60</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Retraksi Osmotik</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="retraksi_osmotik" name="retraksi_osmotik" value="<?=isset($hasil_lab['retraksi_osmotik']) ? $hasil_lab['retraksi_osmotik'] : ''?>">
                                    <span class="input-group-addon">0.40-0.30</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Malaria</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="malaria" name="malaria" value="<?=isset($hasil_lab['malaria']) ? $hasil_lab['malaria'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Plasmodium Falcifarum</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="plasmodium_falcifarum" name="plasmodium_falcifarum" value="<?=isset($hasil_lab['plasmodium_falcifarum']) ? $hasil_lab['plasmodium_falcifarum'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Plasmodium Vivax</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="plasmodium_vivax" name="plasmodium_vivax" value="<?=isset($hasil_lab['plasmodium_vivax']) ? $hasil_lab['plasmodium_vivax'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Prc Pembendungan</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="prc_pembendungan" name="prc_pembendungan" value="<?=isset($hasil_lab['prc_pembendungan']) ? $hasil_lab['prc_pembendungan'] : ''?>">
                                    <span class="input-group-addon">Pethecia < 10</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Darah Lengkap</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="darah_lengkap" name="darah_lengkap" value="<?=isset($hasil_lab['darah_lengkap']) ? $hasil_lab['darah_lengkap'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">RDW-CV</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="rdw_cv" name="rdw_cv" value="<?=isset($hasil_lab['rdw_cv']) ? $hasil_lab['rdw_cv'] : ''?>">
                                    <span class="input-group-addon">11.5-14.5</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">RDW-SD</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="rdw_sd" name="rdw_sd" value="<?=isset($hasil_lab['rdw_sd']) ? $hasil_lab['rdw_sd'] : ''?>">
                                    <span class="input-group-addon">35-56</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">MPV</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="mpv" name="mpv" value="<?=isset($hasil_lab['mpv']) ? $hasil_lab['mpv'] : ''?>">
                                    <span class="input-group-addon">7-11</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">PDW</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="pdw" name="pdw" value="<?=isset($hasil_lab['pdw']) ? $hasil_lab['pdw'] : ''?>">
                                    <span class="input-group-addon">15-17</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">PCT</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="pct" name="pct" value="<?=isset($hasil_lab['pct']) ? $hasil_lab['pct'] : ''?>">
                                    <span class="input-group-addon">0.108-0.282</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Limfosit</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="limfosit" name="limfosit" value="<?=isset($hasil_lab['limfosit']) ? $hasil_lab['limfosit'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Analisa HB (HPLC)</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="analisa_hb" name="analisa_hb" value="<?=isset($hasil_lab['analisa_hb']) ? $hasil_lab['analisa_hb'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Analisa HB (HPLC)</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="analisa_hb" name="analisa_hb" value="<?=isset($hasil_lab['analisa_hb']) ? $hasil_lab['analisa_hb'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">HbA2</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="hba2" name="hba2" value="<?=isset($hasil_lab['hba2']) ? $hasil_lab['hba2'] : ''?>">
                                    <span class="input-group-addon">2.0-3.6%</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">HbF</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="hbf" name="hbf" value="<?=isset($hasil_lab['hbf']) ? $hasil_lab['hbf'] : ''?>">
                                    <span class="input-group-addon">< 1%</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Ferritin</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="ferritin" name="ferritin" value="<?=isset($hasil_lab['ferritin']) ? $hasil_lab['ferritin'] : ''?>">
                                    <span class="input-group-addon">13-150</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">TIBC</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="tibc" name="tibc" value="<?=isset($hasil_lab['tibc']) ? $hasil_lab['tibc'] : ''?>">
                                    <span class="input-group-addon">260-389</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">PT</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="pt" name="pt" value="<?=isset($hasil_lab['pt']) ? $hasil_lab['pt'] : ''?>">
                                    <span class="input-group-addon">10.70-14.30</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">APTT</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="aptt" name="aptt" value="<?=isset($hasil_lab['aptt']) ? $hasil_lab['aptt'] : ''?>">
                                    <span class="input-group-addon">21.00-36.50</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">INR</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="inr" name="inr" value="<?=isset($hasil_lab['inr']) ? $hasil_lab['inr'] : ''?>">
                                    <span class="input-group-addon">0.8-1.2</span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_2">

                            <h4 class="box-title text-center"><strong>FUNGSI GINJAL</strong></h4>

                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Ureum Darah</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="ureum_darah" name="ureum_darah" value="<?=isset($hasil_lab['ureum_darah']) ? $hasil_lab['ureum_darah'] : ''?>">
                                    <span class="input-group-addon">10-50</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Ureum Urin</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="ureum_urin" name="ureum_urin" value="<?=isset($hasil_lab['ureum_urin']) ? $hasil_lab['ureum_urin'] : ''?>">
                                    <span class="input-group-addon">20-35</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Creatine Darah</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="creatine_darah" name="creatin_darah" value="<?=isset($hasil_lab['creatin_darah']) ? $hasil_lab['creatin_darah'] : ''?>">
                                    <span class="input-group-addon">0.7-1.7</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Creatine Urine</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="creatine_urine" name="creatin_urine" value="<?=isset($hasil_lab['creatin_urine']) ? $hasil_lab['creatin_urine'] : ''?>">
                                    <span class="input-group-addon">1-3</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Creatine Clearence</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="creatine_clearence" name="creatin_clearence" value="<?=isset($hasil_lab['creatin_clearence']) ? $hasil_lab['creatin_clearence'] : ''?>">
                                    <span class="input-group-addon">117+20</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Urea Clearence</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="urea_clearence" name="urea_clearence" value="<?=isset($hasil_lab['urea_clearence']) ? $hasil_lab['urea_clearence'] : ''?>">
                                    <span class="input-group-addon">70-100</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Alkali Reserve</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="alkali_reserve" name="alkali_reserve" value="<?=isset($hasil_lab['alkali_reserve']) ? $hasil_lab['alkali_reserve'] : ''?>">
                                    <span class="input-group-addon">24-31</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Fosfat Anorganik</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="fosfat_anorganik" name="fosfat_anorganik" value="<?=isset($hasil_lab['fosfat_anorganik']) ? $hasil_lab['fosfat_anorganik'] : ''?>">
                                    <span class="input-group-addon">2-4 (dewasa) | 5-6 (anak) </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Uric Acid</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="uric_acid" name="uric_acid" value="<?=isset($hasil_lab['uric_acid']) ? $hasil_lab['uric_acid'] : ''?>">
                                    <span class="input-group-addon">P:3.4-7.0 | W:2.4-5.7</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">Serum Iron</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="serum_iron" name="serum_iron" value="<?=isset($hasil_lab['serum_iron']) ? $hasil_lab['serum_iron'] : ''?>">
                                    <span class="input-group-addon">P:53-167 | W:49-151</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-2 control-label">TIBC</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="tibc" name="tibc" value="<?=isset($hasil_lab['tibc']) ? $hasil_lab['tibc'] : ''?>">
                                    <span class="input-group-addon">280-400</span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_3">

                            <h4 class="box-title text-center"><strong>FUNGSI HATI</strong></h4>

                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Bilirudin Total</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="bilirudin_total" name="bilirudin_total" value="<?=isset($hasil_lab['bilirudin_total']) ? $hasil_lab['bilirudin_total'] : ''?>">
                                    <span class="input-group-addon">0.3-1.0</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Bilirudin Direk</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="bilirudin_direk" name="bilirudin_direk" value="<?=isset($hasil_lab['bilirudin_direk']) ? $hasil_lab['bilirudin_direk'] : ''?>">
                                    <span class="input-group-addon">sd 0.4</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Bilirudin Indirek</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="bilirudin_indirek" name="bilirudin_indirek" value="<?=isset($hasil_lab['bilirudin_indirek']) ? $hasil_lab['bilirudin_indirek'] : ''?>">
                                    <span class="input-group-addon">sd 0.6</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Protein Total</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="protein_total" name="protein_total" value="<?=isset($hasil_lab['protein_total']) ? $hasil_lab['protein_total'] : ''?>">
                                    <span class="input-group-addon">6.8 - 8.7</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Albumin</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="albumin" name="albumin" value="<?=isset($hasil_lab['albumin']) ? $hasil_lab['albumin'] : ''?>">
                                    <span class="input-group-addon">3.8 - 5.1</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">SGOT</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="sgot" name="sgot" value="<?=isset($hasil_lab['sgot']) ? $hasil_lab['sgot'] : ''?>">
                                    <span class="input-group-addon">P:s/d 37 | W:s/d 31</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">SGPT</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="sgpt" name="sgpt" value="<?=isset($hasil_lab['sgpt']) ? $hasil_lab['sgpt'] : ''?>">
                                    <span class="input-group-addon">P:s/d 40 | W:s/d 31</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Gamma GT</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="gamma_gt" name="gamma_gt" value="<?=isset($hasil_lab['gamma_gt']) ? $hasil_lab['gamma_gt'] : ''?>">
                                    <span class="input-group-addon">11-61</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Askali Fosfatase</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="askali_fosfatase" name="askali_fosfatase" value="<?=isset($hasil_lab['askali_fosfatase']) ? $hasil_lab['askali_fosfatase'] : ''?>">
                                    <span class="input-group-addon">34-114</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Chollinesterase (CHE)</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="chollinesterase" name="chollinesterase" value="<?=isset($hasil_lab['chollinesterase']) ? $hasil_lab['chollinesterase'] : ''?>">
                                    <span class="input-group-addon">4620-11500</span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_4">

                            <h4 class="box-title text-center"><strong>FUNGSI JANTUNG</strong></h4>

                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">CK</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="ck" name="ck" value="<?=isset($hasil_lab['ck']) ? $hasil_lab['ck'] : ''?>">
                                    <span class="input-group-addon">W:24-170</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">LDH</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="ldh" name="ldh" value="<?=isset($hasil_lab['ldh']) ? $hasil_lab['ldh'] : ''?>">
                                    <span class="input-group-addon"> <480 </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Ck-M8</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="ck_m8" name="ck_m8" value="<?=isset($hasil_lab['ck_m8']) ? $hasil_lab['ck_m8'] : ''?>">
                                    <span class="input-group-addon"> <25 </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Alpha HBDH</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="alpha_hbdh" name="alpha_hbdh" value="<?=isset($hasil_lab['alpha_hbdh']) ? $hasil_lab['alpha_hbdh'] : ''?>">
                                    <span class="input-group-addon">65-165</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Globulin</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="globulin" name="globulin" value="<?=isset($hasil_lab['globulin']) ? $hasil_lab['globulin'] : ''?>">
                                    <span class="input-group-addon">1.5-3.6</span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_5">

                            <h4 class="box-title text-center"><strong>GULA DARAH</strong></h4>

                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Gula Darah Puasa</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="gula_darah_puasa" name="gula_darah_puasa" value="<?=isset($hasil_lab['gula_darah_puasa']) ? $hasil_lab['gula_darah_puasa'] : ''?>">
                                    <span class="input-group-addon">70-100</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Reduksi</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="reduksi" name="reduksi" value="<?=isset($hasil_lab['reduksi']) ? $hasil_lab['reduksi'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Gula Darah 2 jam PP</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="gula_darah_2jam" name="gula_darah_2jam" value="<?=isset($hasil_lab['gula_darah_2jam']) ? $hasil_lab['gula_darah_2jam'] : ''?>">
                                    <span class="input-group-addon"> <=140 </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Reduksi</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="reduksi_2" name="reduksi_2" value="<?=isset($hasil_lab['reduksi_2']) ? $hasil_lab['reduksi_2'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Gula Darah Sewaktu</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="gula_darah_sewaktu" name="gula_darah_sewaktu" value="<?=isset($hasil_lab['gula_darah_sewaktu']) ? $hasil_lab['gula_darah_sewaktu'] : ''?>">
                                    <span class="input-group-addon"> <=180 </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">GTT:Puasa</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="gtt_puasa" name="gtt_puasa" value="<?=isset($hasil_lab['gtt_puasa']) ? $hasil_lab['gtt_puasa'] : ''?>">
                                    <span class="input-group-addon">70-100</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">GTT:1/2jam</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="gtt_1/2jam" name="gtt_1/2jam" value="<?=isset($hasil_lab['gtt_1/2jam']) ? $hasil_lab['gtt_1/2jam'] : ''?>">
                                    <span class="input-group-addon">110-170</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">GTT:1jam</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="gtt_1jam" name="gtt_1jam" value="<?=isset($hasil_lab['gtt_1jam']) ? $hasil_lab['gtt_1jam'] : ''?>">
                                    <span class="input-group-addon">120-170</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">GTT:1 1/2jam</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="gtt_11/2jam" name="gtt_11/2jam" value="<?=isset($hasil_lab['gtt_11/2jam']) ? $hasil_lab['gtt_11/2jam'] : ''?>">
                                    <span class="input-group-addon">100-140</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">GTT:2jam</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="gtt_2jam" name="gtt_2jam" value="<?=isset($hasil_lab['gtt_2jam']) ? $hasil_lab['gtt_2jam'] : ''?>">
                                    <span class="input-group-addon">20-120</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Hb A1-C</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="hb_A-1c" name="hb_A-1c" value="<?=isset($hasil_lab['hb_A-1c']) ? $hasil_lab['hb_A-1c'] : ''?>">
                                    <span class="input-group-addon">4.2-7.0</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">II</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="ii" name="ii" value="<?=isset($hasil_lab['ii']) ? $hasil_lab['ii'] : ''?>">
                                    <span class="input-group-addon">4-7</span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_6">

                            <h4 class="box-title text-center"><strong>PROFIL LEMAK</strong></h4>

                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Cholesterol Total</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="cholesterol_total" name="cholesterol_total" value="<?=isset($hasil_lab['cholesterol_total']) ? $hasil_lab['cholesterol_total'] : ''?>">
                                    <span class="input-group-addon">150-200</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">HDL Cholesterol</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="hdl_cholesterol" name="hdl_cholesterol" value="<?=isset($hasil_lab['hdl_cholesterol']) ? $hasil_lab['hdl_cholesterol'] : ''?>">
                                    <span class="input-group-addon">P:35-55 | W:45-65</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">LDL Cholesterol</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="ldl_cholesterol" name="ldl_cholesterol" value="<?=isset($hasil_lab['ldl_cholesterol']) ? $hasil_lab['ldl_cholesterol'] : ''?>">
                                    <span class="input-group-addon">100-130</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Triglycerida</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="triglycerida" name="triglycerida" value="<?=isset($hasil_lab['triglycerida']) ? $hasil_lab['triglycerida'] : ''?>">
                                    <span class="input-group-addon">40-155</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Lipid Total</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="lipid_total" name="lipid_total" value="<?=isset($hasil_lab['lipid_total']) ? $hasil_lab['lipid_total'] : ''?>">
                                    <span class="input-group-addon">600-1000</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Cholesterol LDL Direk</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="cholesterol_ldl_direk" name="cholesterol_ldl_direk" value="<?=isset($hasil_lab['cholesterol_ldl_direk']) ? $hasil_lab['cholesterol_ldl_direk'] : ''?>">
                                    <span class="input-group-addon"> <140 </span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_7">

                            <h4 class="box-title text-center"><strong>ELEKTROLIT dan GAS DARAH</strong></h4>

                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Natrium</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="natrium" name="natrium" value="<?=isset($hasil_lab['natrium']) ? $hasil_lab['natrium'] : ''?>">
                                    <span class="input-group-addon">135-147</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Kalium</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="kalium" name="kalium" value="<?=isset($hasil_lab['kalium']) ? $hasil_lab['kalium'] : ''?>">
                                    <span class="input-group-addon">3.5-5.5</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Chlorida</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="chlorida" name="chlorida" value="<?=isset($hasil_lab['chlorida']) ? $hasil_lab['chlorida'] : ''?>">
                                    <span class="input-group-addon">96-106</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Calsium</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="calsium" name="calsium" value="<?=isset($hasil_lab['calsium']) ? $hasil_lab['calsium'] : ''?>">
                                    <span class="input-group-addon">8.1-10.4</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Magnesium</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="magnesium" name="magnesium" value="<?=isset($hasil_lab['magnesium']) ? $hasil_lab['magnesium'] : ''?>">
                                    <span class="input-group-addon">1.58 - 2.55</span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_8">

                            <h4 class="box-title text-center"><strong> MIKROBIOLOGI</strong></h4>

                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Pengecatan Gram</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="pengecatan_gram" name="pengecatan_gram" value="<?=isset($hasil_lab['pengecatan_gram']) ? $hasil_lab['pengecatan_gram'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">BTA</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="bta" name="bta" value="<?=isset($hasil_lab['bta']) ? $hasil_lab['bta'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Mikroskopik Gonorhe</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="mikroskopik_gonore" name="mikroskopik_gonore" value="<?=isset($hasil_lab['mikroskopik_gonore']) ? $hasil_lab['mikroskopik_gonore'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Trikomonas</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="trikomonas" name="trikomonas" value="<?=isset($hasil_lab['trikomonas']) ? $hasil_lab['trikomonas'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Jamur</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="jamur" name="jamur" value="<?=isset($hasil_lab['jamur']) ? $hasil_lab['jamur'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Kultur dan Sensitifitas Tes</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="kultur_sensitivitas" name="kultur_sensitivitas" value="<?=isset($hasil_lab['kultur_sensitivitas']) ? $hasil_lab['kultur_sensitivitas'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Batang Gram-</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="batang_gram-" name="batang_gram-" value="<?=isset($hasil_lab['batang_gram-']) ? $hasil_lab['batang_gram-'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Batang Gram+</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="batang_gram+" name="batang_gram+" value="<?=isset($hasil_lab['batang_gram+']) ? $hasil_lab['batang_gram+'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Coccus Gram-</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="coccus_gram-" name="coccus_gram-" value="<?=isset($hasil_lab['coccus_gram-']) ? $hasil_lab['coccus_gram-'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Coccus Gram+</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="coccus_gram+" name="coccus_gram+" value="<?=isset($hasil_lab['coccus_gram+']) ? $hasil_lab['coccus_gram+'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Trichomonas</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="trichomonas" name="trichomonas" value="<?=isset($hasil_lab['trichomonas']) ? $hasil_lab['trichomonas'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Mikroskopik Candida</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="mikroskopik_candida" name="mikroskopik_candida" value="<?=isset($hasil_lab['mikroskopik_candida']) ? $hasil_lab['mikroskopik_candida'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_9">

                            <h4 class="box-title text-center"><strong>SEROIMONOLOGI</strong></h4>

                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Widal</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="widal" name="widal" value="<?=isset($hasil_lab['widal']) ? $hasil_lab['widal'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Salmonela Typhi O</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="salmonela_typhi_O" name="salmonela_typhi_O" value="<?=isset($hasil_lab['salmonela_typhi_O']) ? $hasil_lab['salmonela_typhi_O'] : ''?>">
                                    <span class="input-group-addon">Negatif - </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Salmonela Typhi H</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="salmonela_typhi_h" name="salmonela_typhi_h" value="<?=isset($hasil_lab['salmonela_typhi_h']) ? $hasil_lab['salmonela_typhi_h'] : ''?>">
                                    <span class="input-group-addon">Negatif - </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Salmonela Paratyphi A-H</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="salmonela_paratyphi_a_h" name="salmonela_paratyphi_a_h" value="<?=isset($hasil_lab['salmonela_paratyphi_a_h']) ? $hasil_lab['salmonela_paratyphi_a_h'] : ''?>"
                                    >
                                    <span class="input-group-addon">Negatif - </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Salmonela Paratyphi AO</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="salmonela_paratyphi_ao" name="salmonela_paratyphi_ao" value="<?=isset($hasil_lab['salmonela_paratyphi_ao']) ? $hasil_lab['salmonela_paratyphi_ao'] : ''?>">
                                    <span class="input-group-addon">Negatif - </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Salmonela Paratyphi BO</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="salmonela_paratyphi_bo" name="salmonela_paratyphi_bo" value="<?=isset($hasil_lab['salmonela_paratyphi_bo']) ? $hasil_lab['salmonela_paratyphi_bo'] : ''?>">
                                    <span class="input-group-addon">Negatif - </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Salmonela Paratyphi CO</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="salmonela_paratyphi_co" name="salmonela_paratyphi_co" value="<?=isset($hasil_lab['salmonela_paratyphi_co']) ? $hasil_lab['salmonela_paratyphi_co'] : ''?>">
                                    <span class="input-group-addon">Negatif - </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Salmonela Paratyphi BH</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="salmonela_paratyphi_bh" name="salmonela_paratyphi_bh" value="<?=isset($hasil_lab['salmonela_paratyphi_bh']) ? $hasil_lab['salmonela_paratyphi_bh'] : ''?>">
                                    <span class="input-group-addon">Negatif - </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Salmonela Paratyphi CH</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="salmonela_paratyphi_ch" name="salmonela_paratyphi_ch" value="<?=isset($hasil_lab['salmonela_paratyphi_ch']) ? $hasil_lab['salmonela_paratyphi_ch'] : ''?>">
                                    <span class="input-group-addon">Negatif - </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">HBsAg</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="hbsag" name="hbsag" value="<?=isset($hasil_lab['hbsag']) ? $hasil_lab['hbsag'] : ''?>">
                                    <span class="input-group-addon">0.13</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">HIV</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="hiv" name="hiv" value="<?=isset($hasil_lab['hiv']) ? $hasil_lab['hiv'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">TPHA</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="tpha" name="tpha" value="<?=isset($hasil_lab['tpha']) ? $hasil_lab['tpha'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Rhematoid Factor</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="rhematoid_factor" name="hbsag" value="<?=isset($hasil_lab['hbsag']) ? $hasil_lab['hbsag'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Dengue Ig G</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="dengue_ig_g" name="dengue_ig_g" value="<?=isset($hasil_lab['dengue_ig_g']) ? $hasil_lab['dengue_ig_g'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Dengue Ig M</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="dengue_ig_m" name="dengue_ig_m" value="<?=isset($hasil_lab['dengue_ig_m']) ? $hasil_lab['dengue_ig_m'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Anti HBsAg</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="anti_hbsag" name="anti_hbsag" value="<?=isset($hasil_lab['anti_hbsag']) ? $hasil_lab['anti_hbsag'] : ''?>">
                                    <span class="input-group-addon">Negatif < 8 | Positif > 12</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Anti-HBc Total</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="antihbc_total" name="antihbc_total" value="<?=isset($hasil_lab['antihbc_total']) ? $hasil_lab['antihbc_total'] : ''?>">
                                    <span class="input-group-addon">Positif < 1.0 | Negatif => 1.40</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">HBc</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="hbc" name="hbc" value="<?=isset($hasil_lab['hbc']) ? $hasil_lab['hbc'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Anti TB Ig M</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="anti_tb_ig_m" name="anti_tb_ig_m" value="<?=isset($hasil_lab['anti_tb_ig_m']) ? $hasil_lab['anti_tb_ig_m'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Anti TB Ig G</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="anti_tb_ig_g" name="anti_tb_ig_g" value="<?=isset($hasil_lab['anti_tb_ig_g']) ? $hasil_lab['anti_tb_ig_g'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">HCV</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="hcv" name="hcv" value="<?=isset($hasil_lab['hcv']) ? $hasil_lab['hcv'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Anti HEV Ig M</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="anti_hev_ig_m" name="anti_hev_ig_m" value="<?=isset($hasil_lab['anti_hev_ig_m']) ? $hasil_lab['anti_hev_ig_m'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Anti HEV Ig G</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="anti_hev_ig_g" name="anti_hev_ig_g" value="<?=isset($hasil_lab['anti_hev_ig_g']) ? $hasil_lab['anti_hev_ig_g'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">HBeAg</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="hbeag" name="hbeag" value="<?=isset($hasil_lab['hbeag']) ? $hasil_lab['hbeag'] : ''?>">
                                    <span class="input-group-addon">Negativ < 0.10 | Positif => 0.10</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Anti HBe</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="anti_hbe" name="anti_hbe" value="<?=isset($hasil_lab['anti_hbe']) ? $hasil_lab['anti_hbe'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">VDRL</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="vdrl" name="vdrl" value="<?=isset($hasil_lab['vdrl']) ? $hasil_lab['vdrl'] : ''?>">
                                    <span class="input-group-addon">non reaktif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">ASTO</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="asto" name="asto" value="<?=isset($hasil_lab['asto']) ? $hasil_lab['asto'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_10">

                            <h4 class="box-title text-center"><strong>CRP</strong></h4>

                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Titer Reumatoid Factor</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="titer_reumatoid_factor" name="titer_reumatoid_factor" value="<?=isset($hasil_lab['titer_reumatoid_factor']) ? $hasil_lab['titer_reumatoid_factor'] : ''?>">
                                    <span class="input-group-addon">Negatif: < 8</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Anti HAV IgM</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="anti_hav_igm" name="anti_hav_igm" value="<?=isset($hasil_lab['anti_hav_igm']) ? $hasil_lab['anti_hav_igm'] : ''?>">
                                    <span class="input-group-addon">Negatif < 0.4 | Positif =>0.5</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Anti HCV</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="anti_hcv" name="anti_hcv" value="<?=isset($hasil_lab['anti_hcv']) ? $hasil_lab['anti_hcv'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Toxoplasma Ig A</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="toxoplasma_ig_a" name="toxoplasma_ig_a" value="<?=isset($hasil_lab['toxoplasma_ig_a']) ? $hasil_lab['toxoplasma_ig_a'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Toxoplasma Ig G</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="toxoplasma_ig_g" name="toxoplasma_ig_g" value="<?=isset($hasil_lab['toxoplasma_ig_g']) ? $hasil_lab['toxoplasma_ig_g'] : ''?>">
                                    <span class="input-group-addon">Negatif < 4 | Positif => 8 </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Toxoplasma Ig G</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="toxoplasma_ig_g" name="toxoplasma_ig_g" value="<?=isset($hasil_lab['toxoplasma_ig_g']) ? $hasil_lab['toxoplasma_ig_g'] : ''?>">
                                    <span class="input-group-addon">Negatif < 4 | Positif => 8 </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Toxoplasma Ig M</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="toxoplasma_ig_m" name="toxoplasma_ig_m" value="<?=isset($hasil_lab['toxoplasma_ig_m']) ? $hasil_lab['toxoplasma_ig_m'] : ''?>">
                                    <span class="input-group-addon">Negatif < 0.55 | Positif => 0.65</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Rubella Ig G</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="rubella_ig_g" name="rubella_ig_g" value="<?=isset($hasil_lab['rubella_ig_g']) ? $hasil_lab['rubella_ig_g'] : ''?>">
                                    <span class="input-group-addon">Negatif < 10 | Positif => 15</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Rubella Ig M</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="rubella_ig_m" name="rubella_ig_m" value="<?=isset($hasil_lab['rubella_ig_m']) ? $hasil_lab['rubella_ig_m'] : ''?>">
                                    <span class="input-group-addon">Negatif < 0.80 | Positif => 1.20</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Anti CMV Ig G</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="anti_cmv_ig_g" name="anti_cmv_ig_g" value="<?=isset($hasil_lab['anti_cmv_ig_g']) ? $hasil_lab['anti_cmv_ig_g'] : ''?>">
                                    <span class="input-group-addon">Negatif < 4 | Positif => 6</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Anti CMV Ig M</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="anti_cmv_ig_m" name="anti_cmv_ig_m" value="<?=isset($hasil_lab['anti_cmv_ig_m']) ? $hasil_lab['anti_cmv_ig_m'] : ''?>">
                                    <span class="input-group-addon">Negatif < 0.7 | Positif => 0.9</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Anti HSV2 Ig G</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="anti_hsv2_ig_g" name="anti_hsv2_ig_g" value="<?=isset($hasil_lab['anti_hsv2_ig_g']) ? $hasil_lab['anti_hsv2_ig_g'] : ''?>">
                                    <span class="input-group-addon">Negatif < 0.8 | Positif => 1.1</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Anti HSV2 Ig M</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="anti_hsv2_ig_m" name="anti_hsv2_ig_m" value="<?=isset($hasil_lab['anti_hsv2_ig_m']) ? $hasil_lab['anti_hsv2_ig_m'] : ''?>">
                                    <span class="input-group-addon">Negatif < 0.8 | Positif => 1.1</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">TB ICT</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="tb_ict" name="tb_ict" value="<?=isset($hasil_lab['tb_ict']) ? $hasil_lab['tb_ict'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Tes Mantoux</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="tes_mantaoux" name="tes_mantoux" value="<?=isset($hasil_lab['tes_mantoux']) ? $hasil_lab['tes_mantoux'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Dengue NS1</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="dengue_ns1" name="dengue_ns1" value="<?=isset($hasil_lab['dengue_ns1']) ? $hasil_lab['dengue_ns1'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Anti HBsAg</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="anti_hbsag" name="anti_hbsag" value="<?=isset($hasil_lab['anti_hbsag']) ? $hasil_lab['anti_hbsag'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Chikungunya IgM</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="chikungunya_igm" name="chinkungunya_igm" value="<?=isset($hasil_lab['chinkungunya_igm']) ? $hasil_lab['chinkungunya_igm'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Salmonella IgG</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="salmonella_igg" name="salmonella_igg" value="<?=isset($hasil_lab['salmonella_igg']) ? $hasil_lab['salmonella_igg'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Salmonella IgM</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="salmonella_igm" name="salmonella_igm" value="<?=isset($hasil_lab['salmonella_igm']) ? $hasil_lab['salmonella_igm'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Serum Iron NS1</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="serum_iron" name="serum_iron" value="<?=isset($hasil_lab['serum_iron']) ? $hasil_lab['serum_iron'] : ''?>">
                                    <span class="input-group-addon">62-173</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">CA 125</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="ca_125" name="ca_125" value="<?=isset($hasil_lab['ca_125']) ? $hasil_lab['ca_125'] : ''?>">
                                    <span class="input-group-addon"> < 35 </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Leptospira_IgM</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="leptospora_igm" name="leptospora_igm" value="<?=isset($hasil_lab['leptospora_igm']) ? $hasil_lab['leptospora_igm'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">TPHA</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="tpha" name="tpha" value="<?=isset($hasil_lab['tpha']) ? $hasil_lab['tpha'] : ''?>">
                                    <span class="input-group-addon">Non Reaktif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">HBsAg</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="hbsag" name="hbsag" value="<?=isset($hasil_lab['hbsag']) ? $hasil_lab['hbsag'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">IgM Anti Salmonella Typhi</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="igm_anti_salmonella_typhi" name="igm_anti_salmonella_typhi" value="<?=isset($hasil_lab['igm_anti_salmonella_typhi']) ? $hasil_lab['igm_anti_salmonella_typhi'] : ''?>"
                                    >
                                    <span class="input-group-addon">Negatif <= 2 | Borderline:3</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Anti Hbs Titer</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="anti_hbs_titer" name="anti_hbs_titer" value="<?=isset($hasil_lab['anti_hbs_titer']) ? $hasil_lab['anti_hbs_titer'] : ''?>">
                                    <span class="input-group-addon">Negatif < 10 | Positif => 10</span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_11">

                            <h4 class="box-title text-center"><strong>URINALISA</strong></h4>

                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Urin Rutin</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="urin_rutin" name="urin_rutin" value="<?=isset($hasil_lab['urin_rutin']) ? $hasil_lab['urin_rutin'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Fisis Warna</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="fisis_warna" name="fisis_warna" value="<?=isset($hasil_lab['fisis_warna']) ? $hasil_lab['fisis_warna'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Kejernihan</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="kejernihan" name="kejernihan" value="<?=isset($hasil_lab['kejernihan']) ? $hasil_lab['kejernihan'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Bau</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="bau" name="bau" value="<?=isset($hasil_lab['bau']) ? $hasil_lab['bau'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Kimia PH</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="kimia_ph" name="kimia_ph" value="<?=isset($hasil_lab['kimia_ph']) ? $hasil_lab['kimia_ph'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Berat Jenis</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="berat_jenis" name="berat_jenis" value="<?=isset($hasil_lab['berat_jenis']) ? $hasil_lab['berat_jenis'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Protein</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="protein" name="protein" value="<?=isset($hasil_lab['protein']) ? $hasil_lab['protein'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Glukosa</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="glukosa" name="glukosa" value="<?=isset($hasil_lab['glukosa']) ? $hasil_lab['glukosa'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Urobillinogen</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="urobillinogen" name="urobillinogen" value="<?=isset($hasil_lab['urobillinogen']) ? $hasil_lab['urobillinogen'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Billirudin</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="billirudin" name="billirudin" value="<?=isset($hasil_lab['billirudin']) ? $hasil_lab['billirudin'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Keton</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="keton" name="keton" value="<?=isset($hasil_lab['keton']) ? $hasil_lab['keton'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Lekosit Esterase</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="lekosit_esterase" name="lekosit_esterase" value="<?=isset($hasil_lab['lekosit_esterase']) ? $hasil_lab['lekosit_esterase'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Nitrit</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="nitrit" name="nitrit" value="<?=isset($hasil_lab['nitrit']) ? $hasil_lab['nitrit'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Blood</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="blood" name="blood" value="<?=isset($hasil_lab['blood']) ? $hasil_lab['blood'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Sedimen Epitel</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="sedimen_epitel" name="sedimen_epitel" value="<?=isset($hasil_lab['sedimen_epitel']) ? $hasil_lab['sedimen_epitel'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Lekosit</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="lekosit" name="lekosit" value="<?=isset($hasil_lab['lekosit']) ? $hasil_lab['lekosit'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Erytrosit</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="erystrosit" name="erytrosit" value="<?=isset($hasil_lab['erytrosit']) ? $hasil_lab['erytrosit'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Silinder Granula</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="silinder_granula" name="silinder_granula" value="<?=isset($hasil_lab['silinder_granula']) ? $hasil_lab['silinder_granula'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Silinder Lekosit</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="silinder_lekosit" name="silinder_lekosit" value="<?=isset($hasil_lab['silinder_lekosit']) ? $hasil_lab['silinder_lekosit'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Kristal</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="kristal" name="kristal" value="<?=isset($hasil_lab['kristal']) ? $hasil_lab['kristal'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Bakteri</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="bakteri" name="bakteri" value="<?=isset($hasil_lab['bakteri']) ? $hasil_lab['bakteri'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Trikomonas</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="trikomonas" name="trikomonas" value="<?=isset($hasil_lab['trikomonas']) ? $hasil_lab['trikomonas'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Candida</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="candida" name="candida" value="<?=isset($hasil_lab['candida']) ? $hasil_lab['candida'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Silinder Eritrosit</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="silinder_eritrosit" name="silinder_eritrosit" value="<?=isset($hasil_lab['silinder_eritrosit']) ? $hasil_lab['silinder_eritrosit'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Silinder Hyalin</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="silinder_hyalin" name="silinder_hyalin" value="<?=isset($hasil_lab['silinder_hyalin']) ? $hasil_lab['silinder_hyalin'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_12">

                            <h4 class="box-title text-center"><strong>FESES</strong></h4>

                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Warna</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="warnar" name="warna" value="<?=isset($hasil_lab['warna']) ? $hasil_lab['warna'] : ''?>">
                                    <span class="input-group-addon">Khas</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Bau</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="bau" name="bau" value="<?=isset($hasil_lab['bau']) ? $hasil_lab['bau'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Konsistensi</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="konsistensi" name="konsistensi" value="<?=isset($hasil_lab['konsistensi']) ? $hasil_lab['konsistensi'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Mikroskopis</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="mikroskopis" name="mikroskopis" value="<?=isset($hasil_lab['mikroskopis']) ? $hasil_lab['mikroskopis'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Telur Cacing</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="telur_cacing" name="telur_cacing" value="<?=isset($hasil_lab['telur_cacing']) ? $hasil_lab['telur_cacing'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Amuba</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="amuba" name="amuba" value="<?=isset($hasil_lab['amuba']) ? $hasil_lab['amuba'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Sisa Pencernaan</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="sisa_pencernaan" name="sisa_pencernaan" value="<?=isset($hasil_lab['sisa_pencernaan']) ? $hasil_lab['sisa_pencernaan'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Protein</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="Protein" name="protein" value="<?=isset($hasil_lab['protein']) ? $hasil_lab['protein'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Lemak</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="lemak" name="lemak" value="<?=isset($hasil_lab['lemak']) ? $hasil_lab['lemak'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Karbohidrat</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="karbohidrat" name="karbohidrat" value="<?=isset($hasil_lab['karbohidrat']) ? $hasil_lab['karbohidrat'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Bensidin Test</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="bensidin_test" name="bensidin_test" value="<?=isset($hasil_lab['bensidin_test']) ? $hasil_lab['bensidin_test'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_13">

                            <h4 class="box-title text-center"><strong>SPERMATOZOA</strong></h4>

                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Metode</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="metode" name="metode" value="<?=isset($hasil_lab['metode']) ? $hasil_lab['metode'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Abstinensia</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="abstinensia" name="abstinensia" value="<?=isset($hasil_lab['abstinensia']) ? $hasil_lab['abstinensia'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Dikeluarkan Jam</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="dikeluarkan_jam" name="dikeluarkan_jam" value="<?=isset($hasil_lab['dikeluarkan_jam']) ? $hasil_lab['dikeluarkan_jam'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Diterima di lab jam</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="diterima_di_lab_jam" name="diterima_di_lab_jam" value="<?=isset($hasil_lab['diterima_di_lab_jam']) ? $hasil_lab['diterima_di_lab_jam'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Diperiksa jam</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="diperiksa_jam" name="diperiksa_jam" value="<?=isset($hasil_lab['diperiksa_jam']) ? $hasil_lab['diperiksa_jam'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">I MAKROSKOPIS</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="i_makroskopis" name="i_makroskopis" value="<?=isset($hasil_lab['i_makroskopis']) ? $hasil_lab['i_makroskopis'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Warna</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="warna" name="warna" value="<?=isset($hasil_lab['warna']) ? $hasil_lab['warna'] : ''?>">
                                    <span class="input-group-addon">Putih Abu-Abu</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Liquefaksi</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="liquefaksi" name="liquefaksi" value="<?=isset($hasil_lab['liquefaksi']) ? $hasil_lab['liquefaksi'] : ''?>">
                                    <span class="input-group-addon"> < 60 menit</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Konsistensi</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="konsistensi" name="konsistensi" value="<?=isset($hasil_lab['konsistensi']) ? $hasil_lab['konsistensi'] : ''?>">
                                    <span class="input-group-addon">Encer</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Bau</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="bau" name="bau" value="<?=isset($hasil_lab['bau']) ? $hasil_lab['bau'] : ''?>">
                                    <span class="input-group-addon">Khas</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Volume</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="volume" name="volume" value="<?=isset($hasil_lab['volume']) ? $hasil_lab['volume'] : ''?>">
                                    <span class="input-group-addon"> => 2ml</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">PH</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="ph" name="ph" value="<?=isset($hasil_lab['ph']) ? $hasil_lab['ph'] : ''?>">
                                    <span class="input-group-addon">7.2 - 7.8</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">II Mikroskopis</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="ii_mikroskopis" name="ii_mikroskopis" value="<?=isset($hasil_lab['ii_mikroskopis']) ? $hasil_lab['ii_mikroskopis'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Konsentrasi( x 10^6/ml)</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="konsentrasi" name="konsentrasi" value="<?=isset($hasil_lab['konsentrasi']) ? $hasil_lab['konsentrasi'] : ''?>">
                                    <span class="input-group-addon">=>20 x ( 10^6/ml)</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Motilitas(%)</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="motilitas" name="motilitas" value="<?=isset($hasil_lab['motilitas']) ? $hasil_lab['motilitas'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">A Linier Cepat</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="a_linier_cepat" name="a_linier_cepat" value="<?=isset($hasil_lab['a_linier_cepat']) ? $hasil_lab['a_linier_cepat'] : ''?>">
                                    <span class="input-group-addon">=>50% (A)+(B)</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">B Linier Lambat</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="b_linier_lambat" name="b_linier_lambat" value="<?=isset($hasil_lab['b_linier_lambat']) ? $hasil_lab['b_linier_lambat'] : ''?>">
                                    <span class="input-group-addon">atau</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">C Tidak Progressif</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="c_tidak_progressif" name="c_tidak_progressif" value="<?=isset($hasil_lab['c_tidak_progressif']) ? $hasil_lab['c_tidak_progressif'] : ''?>">
                                    <span class="input-group-addon">=>25%(A)</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">D Tidak Motil</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="d_tidak_motil" name="d_tidak_motil" value="<?=isset($hasil_lab['d_tidak_motil']) ? $hasil_lab['d_tidak_motil'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Viabilitas (%hidup)</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="viabilitas_(%hidup)" name="viabilitas_(%hidup)" value="<?=isset($hasil_lab['viabilitas_(%hidup)']) ? $hasil_lab['viabilitas_(%hidup)'] : ''?>">
                                    <span class="input-group-addon">=>75%</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Morfologi (%Normal)</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="morfologi_(%normal)" name="morfologi_(%normal)" value="<?=isset($hasil_lab['morfologi_(%normal)']) ? $hasil_lab['morfologi_(%normal)'] : ''?>">
                                    <span class="input-group-addon">=>30%</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Morfologi Abnormal(K,L,E, Cyt)</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="morfologi_abnormal" name="morfologi_abnormal" value="<?=isset($hasil_lab['morfologi_abnormal']) ? $hasil_lab['morfologi_abnormal'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Sel Bulat( x10^6/ml)</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="sel_bulat" name="sel_bulat" value="<?=isset($hasil_lab['sel_bulat']) ? $hasil_lab['sel_bulat'] : ''?>">
                                    <span class="input-group-addon">< 1x10^6/ml</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Sel Leukosit( x10^6/ml)</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="sel_leukosit" name="sel_leukosit" value="<?=isset($hasil_lab['sel_leukosit']) ? $hasil_lab['sel_leukosit'] : ''?>">
                                    <span class="input-group-addon">< 1x10^6/ml</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Aglutinasi</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="aglutinasi" name="aglutinasi" value="<?=isset($hasil_lab['aglutinasi']) ? $hasil_lab['aglutinasi'] : ''?>">
                                    <span class="input-group-addon">Tidak</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Fruktosa</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="fruktosa" name="fruktosa" value="<?=isset($hasil_lab['fruktosa']) ? $hasil_lab['fruktosa'] : ''?>">
                                    <span class="input-group-addon">> 13 u mol/ejakulat</span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_14">

                            <h4 class="box-title text-center"><strong>HORMON</strong></h4>

                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">T3</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="t3" name="t3" value="<?=isset($hasil_lab['t3']) ? $hasil_lab['t3'] : ''?>">
                                    <span class="input-group-addon">0.92-2.33</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">T4</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="t4" name="t4" value="<?=isset($hasil_lab['t4']) ? $hasil_lab['t4'] : ''?>">
                                    <span class="input-group-addon">60-120</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">TSH</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="tsh" name="tsh" value="<?=isset($hasil_lab['tsh']) ? $hasil_lab['tsh'] : ''?>">
                                    <span class="input-group-addon">Hipertiroid < 0.15 | Euthyroid 0.25 - 5</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">FT4</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="ft4" name="ft4" value="<?=isset($hasil_lab['ft4']) ? $hasil_lab['ft4'] : ''?>">
                                    <span class="input-group-addon">1.6-19.4</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Egfr</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="egfr" name="egfr" value="<?=isset($hasil_lab['egfr']) ? $hasil_lab['egfr'] : ''?>">
                                    <span class="input-group-addon">Normal =>90 | Ringan:60-89</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">TSHs</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="tshs" name="tshs" value="<?=isset($hasil_lab['tshs']) ? $hasil_lab['tshs'] : ''?>">
                                    <span class="input-group-addon">0.27 - 4.70</span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_15">

                            <h4 class="box-title text-center"><strong>PETANDA TUMOR</strong></h4>

                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">CEA</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="cea" name="cea" value="<?=isset($hasil_lab['cea']) ? $hasil_lab['cea'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">AFP</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="afp" name="afp" value="<?=isset($hasil_lab['afp']) ? $hasil_lab['afp'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">PSA</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="psa" name="psa" value="<?=isset($hasil_lab['psa']) ? $hasil_lab['psa'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">CEA</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="cea" name="cea" value="<?=isset($hasil_lab['cea']) ? $hasil_lab['cea'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_16">

                            <h4 class="box-title text-center"><strong>ADMINISTRASI</strong></h4>

                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Administrasi</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="administrasi" name="administrasi" value="<?=isset($hasil_lab['administrasi']) ? $hasil_lab['administrasi'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_17">

                            <h4 class="box-title text-center"><strong>BAHAN</strong></h4>

                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Lancet</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="lancet" name="lancet" value="<?=isset($hasil_lab['lancet']) ? $hasil_lab['lancet'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Spuit 3cc</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="spuit_3cc" name="spuit_3cc" value="<?=isset($hasil_lab['spuit_3cc']) ? $hasil_lab['spuit_3cc'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Spuit 5cc</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="spuit_5cc" name="spuit_5cc" value="<?=isset($hasil_lab['spuit_5cc']) ? $hasil_lab['spuit_5cc'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Vacutainer</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="vacutainer" name="vacutainer" value="<?=isset($hasil_lab['vacutainer']) ? $hasil_lab['vacutainer'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Wing Needle</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="wing_needle" name="wing_needle" value="<?=isset($hasil_lab['wing_needle']) ? $hasil_lab['wing_needle'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Spuit 1cc</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="spuit_1cc" name="spuit_1cc" value="<?=isset($hasil_lab['spuit_1cc']) ? $hasil_lab['spuit_1cc'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Hand Scun</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="hand_scun" name="spuit_3cc" value="<?=isset($hasil_lab['spuit_3cc']) ? $hasil_lab['spuit_3cc'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_18">

                            <h4 class="box-title text-center"><strong>NARKOBA</strong></h4>

                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Amphetamine</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="amphetamine" name="amphetamine" value="<?=isset($hasil_lab['amphetamine']) ? $hasil_lab['amphetamine'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Morphine</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="spuit_3cc" name="spuit_3cc" value="<?=isset($hasil_lab['spuit_3cc']) ? $hasil_lab['spuit_3cc'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">BZO (Benzodizepiner)</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="bzo_(benzodizepiner)" name="bzo_(benzodizepiner)" value="<?=isset($hasil_lab['bzo_(benzodizepiner)']) ? $hasil_lab['bzo_(benzodizepiner)'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">THC (Marijuana)</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="thc_(marijuana)" name="thc_(marijuana)" value="<?=isset($hasil_lab['thc_(marijuana)']) ? $hasil_lab['thc_(marijuana)'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">MET (Methamphetamine)</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="met_(methamphetamine)" name="met_(methamphetamine)" value="<?=isset($hasil_lab['met_(methamphetamine)']) ? $hasil_lab['met_(methamphetamine)'] : ''?>">
                                    <span class="input-group-addon">Negatif</span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_19">

                            <h4 class="box-title text-center"><strong>KEHAMILAN</strong></h4>

                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Tes Kehamilan</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="tes_kehamilan" name="tes_kehamilan" value="<?=isset($hasil_lab['tes_kehamilan']) ? $hasil_lab['tes_kehamilan'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_20">

                            <h4 class="box-title text-center"><strong>GOLONGAN DARAH</strong></h4>

                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Rhesus</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="rhesus" name="rhesus" value="<?=isset($hasil_lab['rhesus']) ? $hasil_lab['rhesus'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtext3" class="col-sm-3 control-label">Golongan Darah</label>
                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                    <input type="text" class="form-control" id="golongan_darah" name="golongan_darah" value="<?=isset($hasil_lab['golongan_darah']) ? $hasil_lab['golongan_darah'] : ''?>">
                                    <span class="input-group-addon"> </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<style>-->
<!--    .padding-sm {-->
<!--        padding: 5px !important;-->
<!--    }-->
<!--</style>-->
<!---->
<!--<br>-->
<!---->
<!--<div class="row">-->
<!--    <div class="box box-success">-->
<!--        <div class="box-body">-->
<!--            <div class="col-xs-12">-->
<!--                <div class="nav-tabs-custom">-->
<!--                    <ul class="nav nav-tabs">-->
<!--                        <li class="active">-->
<!--                            <a href="#tab_1" data-toggle="tab" class="padding-sm">-->
<!--                                <span style="font-size: 14px;">Hematologi</span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#tab_2" data-toggle="tab" class="padding-sm">-->
<!--                                <span style="font-size: 14px;">Fungsi Ginjal</span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#tab_3" data-toggle="tab" class="padding-sm">-->
<!--                                <span style="font-size: 14px;">Fungsi Hati</span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#tab_4" data-toggle="tab" class="padding-sm">-->
<!--                                <span style="font-size: 14px;">Fungsi Jantung</span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#tab_5" data-toggle="tab" class="padding-sm">-->
<!--                                <span style="font-size: 14px;">Gula Darah</span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#tab_6" data-toggle="tab" class="padding-sm">-->
<!--                                <span style="font-size: 14px;">Profil Lemak</span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#tab_7" data-toggle="tab" class="padding-sm">-->
<!--                                <span style="font-size: 14px;">Elektrolit dan Gas Darah</span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#tab_8" data-toggle="tab" class="padding-sm">-->
<!--                                <span style="font-size: 14px;">Mikrobiologi</span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#tab_9" data-toggle="tab" class="padding-sm">-->
<!--                                <span style="font-size: 14px;">Seriomonologi</span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#tab_10" data-toggle="tab" class="padding-sm">-->
<!--                                <span style="font-size: 14px;">CRP</span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <!-- SEPULUH-->-->
<!--                        <li>-->
<!--                            <a href="#tab_11" data-toggle="tab" class="padding-sm">-->
<!--                                <span style="font-size: 14px;">Urinalisa</span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#tab_12" data-toggle="tab" class="padding-sm">-->
<!--                                <span style="font-size: 14px;">Feses</span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#tab_13" data-toggle="tab" class="padding-sm">-->
<!--                                <span style="font-size: 14px;">Spermatozoa</span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#tab_14" data-toggle="tab" class="padding-sm">-->
<!--                                <span style="font-size: 14px;">Hormon</span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#tab_15" data-toggle="tab" class="padding-sm">-->
<!--                                <span style="font-size: 14px;">Petanda Tumor</span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#tab_16" data-toggle="tab" class="padding-sm">-->
<!--                                <span style="font-size: 14px;">Administrasi</span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#tab_17" data-toggle="tab" class="padding-sm">-->
<!--                                <span style="font-size: 14px;">Bahan</span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#tab_18" data-toggle="tab" class="padding-sm">-->
<!--                                <span style="font-size: 14px;">Narkoba</span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#tab_19" data-toggle="tab" class="padding-sm">-->
<!--                                <span style="font-size: 14px;">Kehamilan</span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#tab_20" data-toggle="tab" class="padding-sm">-->
<!--                                <span style="font-size: 14px;">Golongan Darah</span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                    <div class="tab-content">-->
<!--                        <div class="tab-pane active" id="tab_1">-->
<!---->
<!--                            <h4 class="box-title text-center"><strong>Hematologi</strong></h4>-->
<!---->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Hemoglobin</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="hemoglobin" name="hemoglobin" value="">-->
<!--                                    <span class="input-group-addon">P:13.0 - 16.0 | W:12.0 - 14.0</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">LED 1jam/2jam</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="led" name="led" value="">-->
<!--                                    <span class="input-group-addon">P < 10 | W < 15</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Leukosit</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="leukosit" name="leukosit" value="">-->
<!--                                    <span class="input-group-addon">5000-10000</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Hitung Jenis</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="hitung" name="hitung" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Eosinophyl</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="eosinophyl" name="eosinophyl" value="">-->
<!--                                    <span class="input-group-addon">1-3 </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Basophyl</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="basophyl" name="basophyl" value="">-->
<!--                                    <span class="input-group-addon">0-1</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Stab</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="stab" name="stab" value="">-->
<!--                                    <span class="input-group-addon">2-6</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Segment</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="segment" name="segment" value="">-->
<!--                                    <span class="input-group-addon">50-70</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Lymposit</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="lymposit" name="lymposit" value="">-->
<!--                                    <span class="input-group-addon">20-40</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Monosit</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="monosit" name="monosit" value="">-->
<!--                                    <span class="input-group-addon">2-8</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Sel Lainnya</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="sel_lainnya" name="sel_lainnya" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Eosinofil</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="eosinofil" name="eosinofil" value="">-->
<!--                                    <span class="input-group-addon">50-300</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Erytrosit</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="eritrosit" name="eritrosit" value="">-->
<!--                                    <span class="input-group-addon">P:4.5 - 5.5 | W:4.0 - 5.0</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Trombocyt</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="trombocyt" name="trombocyt" value="">-->
<!--                                    <span class="input-group-addon">150.000 - 500.000</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Reticulocyt</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="reticulocyt" name="reticulocyt" value="">-->
<!--                                    <span class="input-group-addon">0.5-1.5</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Hematacrit</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="hematacrit" name="hematacrit" value="">-->
<!--                                    <span class="input-group-addon">P:40-48% | W:37-43% | A:31-47%</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">MCV</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="mcv" name="mcv" value="">-->
<!--                                    <span class="input-group-addon">82-92</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">MCH</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="mch" name="mch" value="">-->
<!--                                    <span class="input-group-addon">27-31</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">MCHC</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="mchc" name="mchc" value="">-->
<!--                                    <span class="input-group-addon">32-36</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Waktu Pendarahan</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="waktu_pendarahan" name="waktu_pendarahan" value="">-->
<!--                                    <span class="input-group-addon">1-3</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Waktu Pembekuan</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="waktu_pembekuan" name="waktu_pembekuan" value="">-->
<!--                                    <span class="input-group-addon">10-15</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Waktu Prothombin</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="waktu_prothombin" name="waktu_prothombin" value="">-->
<!--                                    <span class="input-group-addon">11-14</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Waktu Rekalsifikasi</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="waktu_rkalsifikasi" name="waktu_rekalsifikasi" value="">-->
<!--                                    <span class="input-group-addon">100-250</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">PTT</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="ptt" name="ptt" value="">-->
<!--                                    <span class="input-group-addon">30-40</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Thrombotes Owren</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="thrombotes_owren" name="thrombotes_owren" value="">-->
<!--                                    <span class="input-group-addon">70-100</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Fibrinogen</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="fibrinogen" name="fibrinogen" value="">-->
<!--                                    <span class="input-group-addon">200-400</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Retraksi Bekuan</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="retraksi_bekuan" name="retraksi_bekuan" value="">-->
<!--                                    <span class="input-group-addon">40-60</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Retraksi Osmotik</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="retraksi_osmotik" name="retraksi_osmotik" value="">-->
<!--                                    <span class="input-group-addon">0.40-0.30</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Malaria</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="malaria" name="malaria" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Plasmodium Falcifarum</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="plasmodium_falcifarum" name="plasmodium_falcifarum" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Plasmodium Vivax</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="plasmodium_vivax" name="plasmodium_vivax" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Prc Pembendungan</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="prc_pembendungan" name="prc_pembendungan" value="">-->
<!--                                    <span class="input-group-addon">Pethecia < 10</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Darah Lengkap</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="darah_lengkap" name="darah_lengkap" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">RDW-CV</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="rdw_cv" name="rdw_cv" value="">-->
<!--                                    <span class="input-group-addon">11.5-14.5</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">RDW-SD</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="rdw_sd" name="rdw_sd" value="">-->
<!--                                    <span class="input-group-addon">35-56</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">MPV</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="mpv" name="mpv" value="">-->
<!--                                    <span class="input-group-addon">7-11</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">PDW</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="pdw" name="pdw" value="">-->
<!--                                    <span class="input-group-addon">15-17</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">PCT</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="pct" name="pct" value="">-->
<!--                                    <span class="input-group-addon">0.108-0.282</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Limfosit</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="limfosit" name="limfosit" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Analisa HB (HPLC)</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="analisa_hb" name="analisa_hb" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Analisa HB (HPLC)</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="analisa_hb" name="analisa_hb" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">HbA2</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="hba2" name="hba2" value="">-->
<!--                                    <span class="input-group-addon">2.0-3.6%</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">HbF</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="hbf" name="hbf" value="">-->
<!--                                    <span class="input-group-addon">< 1%</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Ferritin</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="ferritin" name="ferritin" value="">-->
<!--                                    <span class="input-group-addon">13-150</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">TIBC</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="tibc" name="tibc" value="">-->
<!--                                    <span class="input-group-addon">260-389</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">PT</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="pt" name="pt" value="">-->
<!--                                    <span class="input-group-addon">10.70-14.30</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">APTT</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="aptt" name="aptt" value="">-->
<!--                                    <span class="input-group-addon">21.00-36.50</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">INR</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="inr" name="inr" value="">-->
<!--                                    <span class="input-group-addon">0.8-1.2</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="tab-pane" id="tab_2">-->
<!---->
<!--                            <h4 class="box-title text-center"><strong>FUNGSI GINJAL</strong></h4>-->
<!---->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Ureum Darah</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="ureum_darah" name="ureum_darah" value="">-->
<!--                                    <span class="input-group-addon">10-50</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Ureum Urin</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="ureum_urin" name="ureum_urin" value="">-->
<!--                                    <span class="input-group-addon">20-35</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Creatine Darah</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="creatine_darah" name="creatin_darah" value="">-->
<!--                                    <span class="input-group-addon">0.7-1.7</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Creatine Urine</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="creatine_urine" name="creatin_urine" value="">-->
<!--                                    <span class="input-group-addon">1-3</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Creatine Clearence</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="creatine_clearence" name="creatin_clearence" value="">-->
<!--                                    <span class="input-group-addon">117+20</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Urea Clearence</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="urea_clearence" name="urea_clearence" value="">-->
<!--                                    <span class="input-group-addon">70-100</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Alkali Reserve</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="alkali_reserve" name="alkali_reserve" value="">-->
<!--                                    <span class="input-group-addon">24-31</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Fosfat Anorganik</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="fosfat_anorganik" name="fosfat_anorganik" value="">-->
<!--                                    <span class="input-group-addon">2-4 (dewasa) | 5-6 (anak) </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Uric Acid</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="uric_acid" name="uric_acid" value="">-->
<!--                                    <span class="input-group-addon">P:3.4-7.0 | W:2.4-5.7</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">Serum Iron</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="serum_iron" name="serum_iron" value="">-->
<!--                                    <span class="input-group-addon">P:53-167 | W:49-151</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-2 control-label">TIBC</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="tibc" name="tibc" value="">-->
<!--                                    <span class="input-group-addon">280-400</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="tab-pane" id="tab_3">-->
<!---->
<!--                            <h4 class="box-title text-center"><strong>FUNGSI HATI</strong></h4>-->
<!---->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Bilirudin Total</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="bilirudin_total" name="bilirudin_total" value="">-->
<!--                                    <span class="input-group-addon">0.3-1.0</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Bilirudin Direk</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="bilirudin_direk" name="bilirudin_direk" value="">-->
<!--                                    <span class="input-group-addon">sd 0.4</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Bilirudin Indirek</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="bilirudin_indirek" name="bilirudin_indirek" value="">-->
<!--                                    <span class="input-group-addon">sd 0.6</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Protein Total</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="protein_total" name="protein_total" value="">-->
<!--                                    <span class="input-group-addon">6.8 - 8.7</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Albumin</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="albumin" name="albumin" value="">-->
<!--                                    <span class="input-group-addon">3.8 - 5.1</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">SGOT</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="sgot" name="sgot" value="">-->
<!--                                    <span class="input-group-addon">P:s/d 37 | W:s/d 31</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">SGPT</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="sgpt" name="sgpt" value="">-->
<!--                                    <span class="input-group-addon">P:s/d 40 | W:s/d 31</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Gamma GT</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="gamma_gt" name="gamma_gt" value="">-->
<!--                                    <span class="input-group-addon">11-61</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Askali Fosfatase</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="askali_fosfatase" name="askali_fosfatase" value="">-->
<!--                                    <span class="input-group-addon">34-114</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Chollinesterase (CHE)</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="chollinesterase" name="chollinesterase" value="">-->
<!--                                    <span class="input-group-addon">4620-11500</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="tab-pane" id="tab_4">-->
<!---->
<!--                            <h4 class="box-title text-center"><strong>FUNGSI JANTUNG</strong></h4>-->
<!---->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">CK</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="ck" name="ck" value="">-->
<!--                                    <span class="input-group-addon">W:24-170</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">LDH</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="ldh" name="ldh" value="">-->
<!--                                    <span class="input-group-addon"> <480 </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Ck-M8</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="ck_m8" name="ck_m8" value="">-->
<!--                                    <span class="input-group-addon"> <25 </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Alpha HBDH</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="alpha_hbdh" name="alpha_hbdh" value="">-->
<!--                                    <span class="input-group-addon">65-165</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Globulin</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="globulin" name="globulin" value="">-->
<!--                                    <span class="input-group-addon">1.5-3.6</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="tab-pane" id="tab_5">-->
<!---->
<!--                            <h4 class="box-title text-center"><strong>GULA DARAH</strong></h4>-->
<!---->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Gula Darah Puasa</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="gula_darah_puasa" name="gula_darah_puasa" value="">-->
<!--                                    <span class="input-group-addon">70-100</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Reduksi</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="reduksi" name="reduksi" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Gula Darah 2 jam PP</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="gula_darah_2jam" name="gula_darah_2jam" value="">-->
<!--                                    <span class="input-group-addon"> <=140 </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Reduksi</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="reduksi_2" name="reduksi_2" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Gula Darah Sewaktu</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="gula_darah_sewaktu" name="gula_darah_sewaktu" value="">-->
<!--                                    <span class="input-group-addon"> <=180 </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">GTT:Puasa</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="gtt_puasa" name="gtt_puasa" value="">-->
<!--                                    <span class="input-group-addon">70-100</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">GTT:1/2jam</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="gtt_1/2jam" name="gtt_1/2jam" value="">-->
<!--                                    <span class="input-group-addon">110-170</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">GTT:1jam</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="gtt_1jam" name="gtt_1jam" value="">-->
<!--                                    <span class="input-group-addon">120-170</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">GTT:1 1/2jam</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="gtt_11/2jam" name="gtt_11/2jam" value="">-->
<!--                                    <span class="input-group-addon">100-140</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">GTT:2jam</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="gtt_2jam" name="gtt_2jam" value="">-->
<!--                                    <span class="input-group-addon">20-120</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Hb A1-C</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="hb_A-1c" name="hb_A-1c" value="">-->
<!--                                    <span class="input-group-addon">4.2-7.0</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">II</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="ii" name="ii" value="">-->
<!--                                    <span class="input-group-addon">4-7</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="tab-pane" id="tab_6">-->
<!---->
<!--                            <h4 class="box-title text-center"><strong>PROFIL LEMAK</strong></h4>-->
<!---->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Cholesterol Total</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="cholesterol_total" name="cholesterol_total" value="">-->
<!--                                    <span class="input-group-addon">150-200</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">HDL Cholesterol</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="hdl_cholesterol" name="hdl_cholesterol" value="">-->
<!--                                    <span class="input-group-addon">P:35-55 | W:45-65</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">LDL Cholesterol</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="ldl_cholesterol" name="ldl_cholesterol" value="">-->
<!--                                    <span class="input-group-addon">100-130</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Triglycerida</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="triglycerida" name="triglycerida" value="">-->
<!--                                    <span class="input-group-addon">40-155</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Lipid Total</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="lipid_total" name="lipid_total" value="">-->
<!--                                    <span class="input-group-addon">600-1000</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Cholesterol LDL Direk</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="cholesterol_ldl_direk" name="cholesterol_ldl_direk" value="">-->
<!--                                    <span class="input-group-addon"> <140 </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="tab-pane" id="tab_7">-->
<!---->
<!--                            <h4 class="box-title text-center"><strong>ELEKTROLIT dan GAS DARAH</strong></h4>-->
<!---->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Natrium</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="natrium" name="natrium" value="">-->
<!--                                    <span class="input-group-addon">135-147</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Kalium</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="kalium" name="kalium" value="">-->
<!--                                    <span class="input-group-addon">3.5-5.5</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Chlorida</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="chlorida" name="chlorida" value="">-->
<!--                                    <span class="input-group-addon">96-106</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Calsium</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="calsium" name="calsium" value="">-->
<!--                                    <span class="input-group-addon">8.1-10.4</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Magnesium</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="magnesium" name="magnesium" value="">-->
<!--                                    <span class="input-group-addon">1.58 - 2.55</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="tab-pane" id="tab_8">-->
<!---->
<!--                            <h4 class="box-title text-center"><strong> MIKROBIOLOGI</strong></h4>-->
<!---->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Pengecatan Gram</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="pengecatan_gram" name="pengecatan_gram" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">BTA</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="bta" name="bta" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Mikroskopik Gonorhe</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="mikroskopik_gonore" name="mikroskopik_gonore" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Trikomonas</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="trikomonas" name="trikomonas" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Jamur</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="jamur" name="jamur" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Kultur dan Sensitifitas Tes</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="kultur_sensitivitas" name="kultur_sensitivitas" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Batang Gram-</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="batang_gram-" name="batang_gram-" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Batang Gram+</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="batang_gram+" name="batang_gram+" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Coccus Gram-</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="coccus_gram-" name="coccus_gram-" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Coccus Gram+</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="coccus_gram+" name="coccus_gram+" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Trichomonas</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="trichomonas" name="trichomonas" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Mikroskopik Candida</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="mikroskopik_candida" name="mikroskopik_candida" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="tab-pane" id="tab_9">-->
<!---->
<!--                            <h4 class="box-title text-center"><strong>SEROIMONOLOGI</strong></h4>-->
<!---->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Widal</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="widal" name="widal" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Salmonela Typhi O</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="salmonela_typhi_O" name="salmonela_typhi_O" value="">-->
<!--                                    <span class="input-group-addon">Negatif - </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Salmonela Typhi H</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="salmonela_typhi_h" name="salmonela_typhi_h" value="">-->
<!--                                    <span class="input-group-addon">Negatif - </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Salmonela Paratyphi A-H</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="salmonela_paratyphi_a_h" name="salmonela_paratyphi_a_h"-->
<!--                                           value="">-->
<!--                                    <span class="input-group-addon">Negatif - </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Salmonela Paratyphi AO</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="salmonela_paratyphi_ao" name="salmonela_paratyphi_ao" value="">-->
<!--                                    <span class="input-group-addon">Negatif - </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Salmonela Paratyphi BO</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="salmonela_paratyphi_bo" name="salmonela_paratyphi_bo" value="">-->
<!--                                    <span class="input-group-addon">Negatif - </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Salmonela Paratyphi CO</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="salmonela_paratyphi_co" name="salmonela_paratyphi_co" value="">-->
<!--                                    <span class="input-group-addon">Negatif - </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Salmonela Paratyphi BH</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="salmonela_paratyphi_bh" name="salmonela_paratyphi_bh" value="">-->
<!--                                    <span class="input-group-addon">Negatif - </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Salmonela Paratyphi CH</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="salmonela_paratyphi_ch" name="salmonela_paratyphi_ch" value="">-->
<!--                                    <span class="input-group-addon">Negatif - </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">HBsAg</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="hbsag" name="hbsag" value="">-->
<!--                                    <span class="input-group-addon">0.13</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">HIV</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="hiv" name="hiv" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">TPHA</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="tpha" name="tpha" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Rhematoid Factor</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="rhematoid_factor" name="hbsag" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Dengue Ig G</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="dengue_ig_g" name="dengue_ig_g" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Dengue Ig M</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="dengue_ig_m" name="dengue_ig_m" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Anti HBsAg</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="anti_hbsag" name="anti_hbsag" value="">-->
<!--                                    <span class="input-group-addon">Negatif < 8 | Positif > 12</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Anti-HBc Total</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="antihbc_total" name="antihbc_total" value="">-->
<!--                                    <span class="input-group-addon">Positif < 1.0 | Negatif => 1.40</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">HBc</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="hbc" name="hbc" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Anti TB Ig M</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="anti_tb_ig_m" name="anti_tb_ig_m" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Anti TB Ig G</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="anti_tb_ig_g" name="anti_tb_ig_g" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">HCV</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="hcv" name="hcv" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Anti HEV Ig M</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="anti_hev_ig_m" name="anti_hev_ig_m" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Anti HEV Ig G</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="anti_hev_ig_g" name="anti_hev_ig_g" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">HBeAg</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="hbeag" name="hbeag" value="">-->
<!--                                    <span class="input-group-addon">Negativ < 0.10 | Positif => 0.10</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Anti HBe</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="anti_hbe" name="anti_hbe" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">VDRL</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="vdrl" name="vdrl" value="">-->
<!--                                    <span class="input-group-addon">non reaktif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">ASTO</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="asto" name="asto" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="tab-pane" id="tab_10">-->
<!---->
<!--                            <h4 class="box-title text-center"><strong>CRP</strong></h4>-->
<!---->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Titer Reumatoid Factor</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="titer_reumatoid_factor" name="titer_reumatoid_factor" value="">-->
<!--                                    <span class="input-group-addon">Negatif: < 8</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Anti HAV IgM</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="anti_hav_igm" name="anti_hav_igm" value="">-->
<!--                                    <span class="input-group-addon">Negatif < 0.4 | Positif =>0.5</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Anti HCV</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="anti_hcv" name="anti_hcv" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Toxoplasma Ig A</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="toxoplasma_ig_a" name="toxoplasma_ig_a" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Toxoplasma Ig G</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="toxoplasma_ig_g" name="toxoplasma_ig_g" value="">-->
<!--                                    <span class="input-group-addon">Negatif < 4 | Positif => 8 </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Toxoplasma Ig G</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="toxoplasma_ig_g" name="toxoplasma_ig_g" value="">-->
<!--                                    <span class="input-group-addon">Negatif < 4 | Positif => 8 </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Toxoplasma Ig M</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="toxoplasma_ig_m" name="toxoplasma_ig_m" value="">-->
<!--                                    <span class="input-group-addon">Negatif < 0.55 | Positif => 0.65</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Rubella Ig G</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="rubella_ig_g" name="rubella_ig_g" value="">-->
<!--                                    <span class="input-group-addon">Negatif < 10 | Positif => 15</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Rubella Ig M</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="rubella_ig_m" name="rubella_ig_m" value="">-->
<!--                                    <span class="input-group-addon">Negatif < 0.80 | Positif => 1.20</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Anti CMV Ig G</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="anti_cmv_ig_g" name="anti_cmv_ig_g" value="">-->
<!--                                    <span class="input-group-addon">Negatif < 4 | Positif => 6</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Anti CMV Ig M</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="anti_cmv_ig_m" name="anti_cmv_ig_m" value="">-->
<!--                                    <span class="input-group-addon">Negatif < 0.7 | Positif => 0.9</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Anti HSV2 Ig G</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="anti_hsv2_ig_g" name="anti_hsv2_ig_g" value="">-->
<!--                                    <span class="input-group-addon">Negatif < 0.8 | Positif => 1.1</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Anti HSV2 Ig M</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="anti_hsv2_ig_m" name="anti_hsv2_ig_m" value="">-->
<!--                                    <span class="input-group-addon">Negatif < 0.8 | Positif => 1.1</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">TB ICT</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="tb_ict" name="tb_ict" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Tes Mantoux</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="tes_mantaoux" name="tes_mantoux" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Dengue NS1</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="dengue_ns1" name="dengue_ns1" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Anti HBsAg</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="anti_hbsag" name="anti_hbsag" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Chikungunya IgM</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="chikungunya_igm" name="chinkungunya_igm" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Salmonella IgG</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="salmonella_igg" name="salmonella_igg" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Salmonella IgM</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="salmonella_igm" name="salmonella_igm" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Serum Iron NS1</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="serum_iron" name="serum_iron" value="">-->
<!--                                    <span class="input-group-addon">62-173</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">CA 125</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="ca_125" name="ca_125" value="">-->
<!--                                    <span class="input-group-addon"> < 35 </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Leptospira_IgM</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="leptospora_igm" name="leptospora_igm" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">TPHA</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="tpha" name="tpha" value="">-->
<!--                                    <span class="input-group-addon">Non Reaktif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">HBsAg</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="hbsag" name="hbsag" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">IgM Anti Salmonella Typhi</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="igm_anti_salmonella_typhi" name="igm_anti_salmonella_typhi"-->
<!--                                           value="">-->
<!--                                    <span class="input-group-addon">Negatif <= 2 | Borderline:3</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Anti Hbs Titer</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="anti_hbs_titer" name="anti_hbs_titer" value="">-->
<!--                                    <span class="input-group-addon">Negatif < 10 | Positif => 10</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="tab-pane" id="tab_11">-->
<!---->
<!--                            <h4 class="box-title text-center"><strong>URINALISA</strong></h4>-->
<!---->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Urin Rutin</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="urin_rutin" name="urin_rutin" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Fisis Warna</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="fisis_warna" name="fisis_warna" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Kejernihan</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="kejernihan" name="kejernihan" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Bau</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="bau" name="bau" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Kimia PH</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="kimia_ph" name="kimia_ph" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Berat Jenis</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="berat_jenis" name="berat_jenis" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Protein</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="protein" name="protein" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Glukosa</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="glukosa" name="glukosa" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Urobillinogen</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="urobillinogen" name="urobillinogen" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Billirudin</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="billirudin" name="billirudin" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Keton</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="keton" name="keton" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Lekosit Esterase</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="lekosit_esterase" name="lekosit_esterase" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Nitrit</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="nitrit" name="nitrit" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Blood</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="blood" name="blood" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Sedimen Epitel</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="sedimen_epitel" name="sedimen_epitel" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Lekosit</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="lekosit" name="lekosit" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Erytrosit</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="erystrosit" name="erytrosit" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Silinder Granula</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="silinder_granula" name="silinder_granula" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Silinder Lekosit</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="silinder_lekosit" name="silinder_lekosit" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Kristal</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="kristal" name="kristal" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Bakteri</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="bakteri" name="bakteri" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Trikomonas</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="trikomonas" name="trikomonas" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Candida</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="candida" name="candida" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Silinder Eritrosit</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="silinder_eritrosit" name="silinder_eritrosit" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Silinder Hyalin</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="silinder_hyalin" name="silinder_hyalin" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="tab-pane" id="tab_12">-->
<!---->
<!--                            <h4 class="box-title text-center"><strong>FESES</strong></h4>-->
<!---->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Warna</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="warnar" name="warna" value="">-->
<!--                                    <span class="input-group-addon">Khas</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Bau</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="bau" name="bau" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Konsistensi</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="konsistensi" name="konsistensi" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Mikroskopis</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="mikroskopis" name="mikroskopis" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Telur Cacing</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="telur_cacing" name="telur_cacing" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Amuba</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="amuba" name="amuba" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Sisa Pencernaan</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="sisa_pencernaan" name="sisa_pencernaan" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Protein</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="Protein" name="protein" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Lemak</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="lemak" name="lemak" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Karbohidrat</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="karbohidrat" name="karbohidrat" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Bensidin Test</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="bensidin_test" name="bensidin_test" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="tab-pane" id="tab_13">-->
<!---->
<!--                            <h4 class="box-title text-center"><strong>SPERMATOZOA</strong></h4>-->
<!---->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Metode</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="metode" name="metode" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Abstinensia</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="abstinensia" name="abstinensia" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Dikeluarkan Jam</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="dikeluarkan_jam" name="dikeluarkan_jam" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Diterima di lab jam</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="diterima_di_lab_jam" name="diterima_di_lab_jam" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Diperiksa jam</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="diperiksa_jam" name="diperiksa_jam" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">I MAKROSKOPIS</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="i_makroskopis" name="i_makroskopis" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Warna</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="warna" name="warna" value="">-->
<!--                                    <span class="input-group-addon">Putih Abu-Abu</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Liquefaksi</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="liquefaksi" name="liquefaksi" value="">-->
<!--                                    <span class="input-group-addon"> < 60 menit</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Konsistensi</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="konsistensi" name="konsistensi" value="">-->
<!--                                    <span class="input-group-addon">Encer</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Bau</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="bau" name="bau" value="">-->
<!--                                    <span class="input-group-addon">Khas</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Volume</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="volume" name="volume" value="">-->
<!--                                    <span class="input-group-addon"> => 2ml</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">PH</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="ph" name="ph" value="">-->
<!--                                    <span class="input-group-addon">7.2 - 7.8</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">II Mikroskopis</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="ii_mikroskopis" name="ii_mikroskopis" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Konsentrasi( x 10^6/ml)</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="konsentrasi" name="konsentrasi" value="">-->
<!--                                    <span class="input-group-addon">=>20 x ( 10^6/ml)</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Motilitas(%)</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="motilitas" name="motilitas" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">A Linier Cepat</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="a_linier_cepat" name="a_linier_cepat" value="">-->
<!--                                    <span class="input-group-addon">=>50% (A)+(B)</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">B Linier Lambat</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="b_linier_lambat" name="b_linier_lambat" value="">-->
<!--                                    <span class="input-group-addon">atau</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">C Tidak Progressif</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="c_tidak_progressif" name="c_tidak_progressif" value="">-->
<!--                                    <span class="input-group-addon">=>25%(A)</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">D Tidak Motil</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="d_tidak_motil" name="d_tidak_motil" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Viabilitas (%hidup)</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="viabilitas_(%hidup)" name="viabilitas_(%hidup)" value="">-->
<!--                                    <span class="input-group-addon">=>75%</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Morfologi (%Normal)</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="morfologi_(%normal)" name="morfologi_(%normal)" value="">-->
<!--                                    <span class="input-group-addon">=>30%</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Morfologi Abnormal(K,L,E, Cyt)</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="morfologi_abnormal" name="morfologi_abnormal" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Sel Bulat( x10^6/ml)</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="sel_bulat" name="sel_bulat" value="">-->
<!--                                    <span class="input-group-addon">< 1x10^6/ml</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Sel Leukosit( x10^6/ml)</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="sel_leukosit" name="sel_leukosit" value="">-->
<!--                                    <span class="input-group-addon">< 1x10^6/ml</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Aglutinasi</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="aglutinasi" name="aglutinasi" value="">-->
<!--                                    <span class="input-group-addon">Tidak</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Fruktosa</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="fruktosa" name="fruktosa" value="">-->
<!--                                    <span class="input-group-addon">> 13 u mol/ejakulat</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="tab-pane" id="tab_14">-->
<!---->
<!--                            <h4 class="box-title text-center"><strong>HORMON</strong></h4>-->
<!---->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">T3</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="t3" name="t3" value="">-->
<!--                                    <span class="input-group-addon">0.92-2.33</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">T4</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="t4" name="t4" value="">-->
<!--                                    <span class="input-group-addon">60-120</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">TSH</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="tsh" name="tsh" value="">-->
<!--                                    <span class="input-group-addon">Hipertiroid < 0.15 | Euthyroid 0.25 - 5</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">FT4</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="ft4" name="ft4" value="">-->
<!--                                    <span class="input-group-addon">1.6-19.4</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Egfr</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="egfr" name="egfr" value="">-->
<!--                                    <span class="input-group-addon">Normal =>90 | Ringan:60-89</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">TSHs</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="tshs" name="tshs" value="">-->
<!--                                    <span class="input-group-addon">0.27 - 4.70</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="tab-pane" id="tab_15">-->
<!---->
<!--                            <h4 class="box-title text-center"><strong>PETANDA TUMOR</strong></h4>-->
<!---->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">CEA</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="cea" name="cea" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">AFP</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="afp" name="afp" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">PSA</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="psa" name="psa" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">CEA</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="cea" name="cea" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="tab-pane" id="tab_16">-->
<!---->
<!--                            <h4 class="box-title text-center"><strong>ADMINISTRASI</strong></h4>-->
<!---->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Administrasi</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="administrasi" name="administrasi" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="tab-pane" id="tab_17">-->
<!---->
<!--                            <h4 class="box-title text-center"><strong>BAHAN</strong></h4>-->
<!---->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Lancet</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="lancet" name="lancet" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Spuit 3cc</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="spuit_3cc" name="spuit_3cc" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Spuit 5cc</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="spuit_5cc" name="spuit_5cc" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Vacutainer</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="vacutainer" name="vacutainer" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Wing Needle</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="wing_needle" name="wing_needle" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Spuit 1cc</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="spuit_1cc" name="spuit_1cc" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Hand Scun</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="hand_scun" name="spuit_3cc" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="tab-pane" id="tab_18">-->
<!---->
<!--                            <h4 class="box-title text-center"><strong>NARKOBA</strong></h4>-->
<!---->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Amphetamine</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="amphetamine" name="amphetamine" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Morphine</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="spuit_3cc" name="spuit_3cc" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">BZO (Benzodizepiner)</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="bzo_(benzodizepiner)" name="bzo_(benzodizepiner)" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">THC (Marijuana)</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="thc_(marijuana)" name="thc_(marijuana)" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">MET (Methamphetamine)</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="met_(methamphetamine)" name="met_(methamphetamine)" value="">-->
<!--                                    <span class="input-group-addon">Negatif</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="tab-pane" id="tab_19">-->
<!---->
<!--                            <h4 class="box-title text-center"><strong>KEHAMILAN</strong></h4>-->
<!---->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Tes Kehamilan</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="tes_kehamilan" name="tes_kehamilan" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="tab-pane" id="tab_20">-->
<!---->
<!--                            <h4 class="box-title text-center"><strong>GOLONGAN DARAH</strong></h4>-->
<!---->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Rhesus</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="rhesus" name="rhesus" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="inputtext3" class="col-sm-3 control-label">Golongan Darah</label>-->
<!--                                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">-->
<!--                                    <input type="text" class="form-control" id="golongan_darah" name="golongan_darah" value="">-->
<!--                                    <span class="input-group-addon"> </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
