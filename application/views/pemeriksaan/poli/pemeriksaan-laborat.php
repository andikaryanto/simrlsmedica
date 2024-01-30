<style media="screen">
  .pemeriksaan-lab label{
    font-weight: normal;
  }

  .pemeriksaan-lab input[type="text"] {
      width: 100%;
      border: 0;
      border-bottom: 1px dotted #333;
      background-color: #fff0;
  }

  .pemeriksaan-lab input[type="text"]:focus {
      border-style: solid;
      outline: none !important;
  }

  [for="deskripsi_tindakan"], #deskripsi_tindakan{
    display: none;
  }
</style>
<table class="table table-striped pemeriksaan-lab">
  <tbody>
    <tr>
      <td> <strong>URINE</strong> </td>
      <td> <strong>HEMATOLOGI</strong> </td>
      <td> <strong> <u>Fungsi Hari</u> </strong> </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[urin][]" value="Urin Lengkap" id="urin-lengkap">
        <label for="urin-lengkap">Urin Lengkap</label>
      </td>
      <td>
        <input type="checkbox" name="meta[darah][]" value="Darah Lengkap" id="darah-lengkap">
        <label for="darah-lengkap">Darah Lengkap</label>
      </td>
      <td>
        <input type="checkbox" name="meta[hati][]" value="Albumin" id="hati-albumin">
        <label for="hati-albumin">Albumin</label>
      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[urin][]" value="Urin Rutin" id="urin-rutin">
        <label for="urin-rutin">Urin Rutin</label>
      </td>
      <td>
        <input type="checkbox" name="meta[darah][]" value="Darah Rutin" id="darah-rutin">
        <label for="darah-rutin">Darah Rutin</label>
      </td>
      <td>
        <input type="checkbox" name="meta[hati][]" value="Glubumin" id="hati-glubumin">
        <label for="hati-glubumin">Glubumin</label>
      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[urin][]" value="Glukosa" id="urin-glukosa">
        <label for="urin-glukosa">Glukosa</label>
      </td>
      <td>
        <input type="checkbox" name="meta[darah][]" value="Hemoglobin" id="darah-hemoglobin">
        <label for="darah-hemoglobin">Hemoglobin</label>
      </td>
      <td>
        <input type="checkbox" name="meta[hati][]" value="Total Protein" id="hati-total-protein">
        <label for="hati-total-protein">Total Protein</label>
      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[urin][]" value="Protein" id="urin-protein">
        <label for="urin-protein">Protein</label>
      </td>
      <td>
        <input type="checkbox" name="meta[darah][]" value="Leukosit" id="darah-leukosit">
        <label for="darah-leukosit">Leukosit</label>
      </td>
      <td>
        <input type="checkbox" name="meta[hati][]" value="Bilirubin Total" id="hati-bilirubin-total">
        <label for="hati-bilirubin-total">Bilirubin Total</label>
      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[urin][]" value="Sedimen" id="urin-sedimen">
        <label for="urin-sedimen">Sedimen</label>
      </td>
      <td>
        <input type="checkbox" name="meta[darah][]" value="Hitung Jenis Leukosit" id="darah-hitung-jenis-leukosit">
        <label for="darah-hitung-jenis-leukosit">Hitung Jenis Leukosit</label>
      </td>
      <td>
        <input type="checkbox" name="meta[hati][]" value="Bilirubin Direk" id="hati-bilirubin-direk">
        <label for="hati-bilirubin-direk">Bilirubin Direk</label>
      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[urin][]" value="Esbach**" id="urin-esbach">
        <label for="urin-esbach">Esbach**</label>
      </td>
      <td>
        <input type="checkbox" name="meta[darah][]" value="Laju Endap Darah" id="darah-laju-endap-arah">
        <label for="darah-laju-endap-arah">Laju Endap Darah</label>
      </td>
      <td>
        <input type="checkbox" name="meta[hati][]" value="Bilirubin Indirek" id="hati-bilirubin-indirek">
        <label for="hati-bilirubin-indirek">Bilirubin Indirek</label>
      </td>
    </tr>
    <tr>
      <td>

      </td>
      <td>
        <input type="checkbox" name="meta[darah][]" value="Eritrosit" id="darah-eritrosit">
        <label for="darah-eritrosit">Eritrosit</label>
      </td>
      <td>
        <input type="checkbox" name="meta[hati][]" value="Iterus Indeks" id="hati-iterus-indeks">
        <label for="hati-iterus-indeks">Iterus Indeks</label>
      </td>
    </tr>
    <tr>
      <td>
        <strong>FAESES</strong>
      </td>
      <td>
        <input type="checkbox" name="meta[darah][]" value="Jumlah Trombosit" id="darah-jumlah-trombosit">
        <label for="darah-jumlah-trombosit">Jumlah Trombosit</label>
      </td>
      <td>
        <input type="checkbox" name="meta[hati][]" value="Alkali Fosfatase" id="hati-alkali-fosfatase">
        <label for="hati-alkali-fosfatase">Alkali Fosfatase</label>
      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[faeses][]" value="Faeses Rutin" id="faeses-faeses-rutin">
        <label for="faeses-faeses-rutin">Faeses Rutin</label>
      </td>
      <td>
        <input type="checkbox" name="meta[darah][]" value="Hematrokit" id="darah-hematrokit">
        <label for="darah-hematrokit">Hematrokit</label>
      </td>
      <td>
        <input type="checkbox" name="meta[hati][]" value="GPT (ALT)" id="hati-gpt-alt">
        <label for="hati-gpt-alt">GPT (ALT)</label>
      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[faeses][]" value="Benzidi" id="faeses-benzidi">
        <label for="faeses-benzidi">Benzidi</label>
      </td>
      <td>
        <input type="checkbox" name="meta[darah][]" value="Waktu Pendarahan" id="darah-waktu-pendarahan">
        <label for="darah-waktu-pendarahan">Waktu Pendarahan</label>
      </td>
      <td>
        <input type="checkbox" name="meta[hati][]" value="GOT (AST)" id="hati-got-ast">
        <label for="hati-got-ast">GOT (AST)</label>
      </td>
    </tr>
    <tr>
      <td>

      </td>
      <td>
        <input type="checkbox" name="meta[darah][]" value="Waktu Pembekuan" id="darah-waktu-pembekuan">
        <label for="darah-waktu-pembekuan">Waktu Pembekuan</label>
      </td>
      <td>
        <input type="checkbox" name="meta[hati][]" value="Gamma GT" id="hati-gamma-gt">
        <label for="hati-gamma-gt">Gamma GT</label>
      </td>
    </tr>
    <tr>
      <td>
        <strong>BIOLOGIS</strong>
      </td>
      <td>
        <input type="checkbox" name="meta[darah][]" value="Gambaran Darah Tepi" id="darah-gambaran-darah-tepi">
        <label for="darah-gambaran-darah-tepi">Gambaran Darah Tepi</label>
      </td>
      <td>
        <input type="checkbox" name="meta[hati][]" value="Cholinesteruse" id="hati-cholinesteruse">
        <label for="hati-cholinesteruse">Cholinesteruse</label>
      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[biologis][]" value="Tes Kehamilan" id="biologis-tes-kehamilan">
        <label for="biologis-tes-kehamilan">Tes Kehamilan</label>
      </td>
      <td>
        <input type="checkbox" name="meta[darah][]" value="Retikulosit" id="darah-retikulosit">
        <label for="darah-retikulosit">Retikulosit</label>
      </td>
      <td>

      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[biologis][]" value="Analisa Sperma" id="biologis-analisa-sperma">
        <label for="biologis-analisa-sperma">Analisa Sperma</label>
      </td>
      <td>
        <input type="checkbox" name="meta[darah][]" value="MCV/MCH/MCHC" id="darah-mcv-mch-mchc">
        <label for="darah-mcv-mch-mchc">MCV/MCH/MCHC</label>
      </td>
      <td>
        <strong> <u>Fungsi Ginjal</u> </strong>
      </td>
    </tr>
    <tr>
      <td>

      </td>
      <td>
        <input type="checkbox" name="meta[darah][]" value="Golongan Darah" id="darah-golongan-darah">
        <label for="darah-golongan-darah">Golongan Darah</label>
      </td>
      <td>
        <input type="checkbox" name="meta[ginjal][]" value="Ureum" id="ginjal-ureum">
        <label for="ginjal-ureum">Ureum</label>
      </td>
    </tr>
    <tr>
      <td>

      </td>
      <td>
        <input type="checkbox" name="meta[darah][]" value="Malaria" id="darah-malaria">
        <label for="darah-malaria">Malaria</label>
      </td>
      <td>
        <input type="checkbox" name="meta[ginjal][]" value="Kreatinin" id="ginjal-kreatinin">
        <label for="ginjal-kreatinin">Kreatinin</label>
      </td>
    </tr>
    <tr>
      <td>
        <strong>SEROLOGIS</strong>
      </td>
      <td>

      </td>
      <td>
        <input type="checkbox" name="meta[ginjal][]" value="Asam Urat" id="ginjal-asam-urat">
        <label for="ginjal-asam-urat">Asam Urat*</label>
      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[serologis][]" value="Widal" id="serologis-widal">
        <label for="serologis-widal">Widal</label>
      </td>
      <td>
        <strong>KIMIA KLINIK</strong>
      </td>
      <td>

      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[serologis][]" value="VDRL" id="serologis-vdrl">
        <label for="serologis-vdrl">VDRL</label>
      </td>
      <td>

      </td>
      <td>
        <strong> <u>Fungsi Jantung</u> </strong>
      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[serologis][]" value="Rheumatoid Factor" id="serologis-rheumatoid-factor">
        <label for="serologis-rheumatoid-factor">Rheumatoid Factor</label>
      </td>
      <td>
        <strong> <u>Gula Darah</u> </strong>
      </td>
      <td>
        <input type="checkbox" name="meta[jantung][]" value="CK" id="jantung-ck">
        <label for="jantung-ck">CK</label>
      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[serologis][]" value="ASTO" id="serologis-asto">
        <label for="serologis-asto">ASTO</label>
      </td>
      <td>
        <input type="checkbox" name="meta[gula_darah][]" value="Glukosa Puasa*" id="gula_darah-glukosa-puasa">
        <label for="gula_darah-glukosa-puasa">Glukosa Puasa*</label>
      </td>
      <td>
        <input type="checkbox" name="meta[jantung][]" value="CK-MB" id="jantung-ck-mb">
        <label for="jantung-ck-mb">CK-MB</label>
      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[serologis][]" value="CRP" id="serologis-crp">
        <label for="serologis-crp">CRP</label>
      </td>
      <td>
        <input type="checkbox" name="meta[gula_darah][]" value="Glukosa 2 Jam PP" id="gula_darah-glukosa-2-jam-pp">
        <label for="gula_darah-glukosa-2-jam-pp">Glukosa 2 Jam PP</label>
      </td>
      <td>
        <input type="checkbox" name="meta[jantung][]" value="LDH" id="jantung-ldh">
        <label for="jantung-ldh">LDH</label>
      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[serologis][]" value="HBsAg" id="serologis-hbsag">
        <label for="serologis-hbsag">HBsAg</label>
      </td>
      <td>
        <input type="checkbox" name="meta[gula_darah][]" value="Glukosa Sewaktu" id="gula_darah-glukosa-sewaktu">
        <label for="gula_darah-glukosa-sewaktu">Glukosa Sewaktu</label>
      </td>
      <td>
        <input type="checkbox" name="meta[jantung][]" value="GOT" id="jantung-got">
        <label for="jantung-got">GOT</label>
      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[serologis][]" value="HBcAg" id="serologis-hbcag">
        <label for="serologis-hbcag">HBcAg</label>
      </td>
      <td>
        <input type="checkbox" name="meta[gula_darah][]" value="Glukosa Tes Toleransi*" id="gula_darah-glukosa-toleransi">
        <label for="gula_darah-glukosa-toleransi">Glukosa Tes Toleransi*</label>
      </td>
      <td>

      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[serologis][]" value="Anti - HBs" id="serologis-antihbs">
        <label for="serologis-antihbs">Anti - HBs</label>
      </td>
      <td>
        <input type="checkbox" name="meta[gula_darah][]" value="HbALc" id="gula_darah-hbalc">
        <label for="gula_darah-hbalc">HbALc</label>
      </td>
      <td>
        <strong> <u>Elektrolit</u> </strong>
      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[serologis][]" value="Anti - HBc" id="serologis-antihbc">
        <label for="serologis-antihbc">Anti - HBc</label>
      </td>
      <td>

      </td>
      <td>
        <input type="checkbox" name="meta[elektrolit][]" value="Kalium" id="elektrolit-kalium">
        <label for="elektrolit-kalium">Kalium</label>
      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[serologis][]" value="Anti - HCV" id="serologis-antihcv">
        <label for="serologis-antihcv">Anti - HCV</label>
      </td>
      <td>
        <strong> <u>Lemak</u> </strong>
      </td>
      <td>
        <input type="checkbox" name="meta[elektrolit][]" value="Calcium" id="elektrolit-calcium">
        <label for="elektrolit-calcium">Calcium</label>
      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[serologis][]" value="Anti - HIV" id="serologis-antihiv">
        <label for="serologis-antihiv">Anti - HIV</label>
      </td>
      <td>
        <input type="checkbox" name="meta[lemak][]" value="Cholesterol" id="lemak-cholesterol">
        <label for="lemak-cholesterol">Cholesterol</label>
      </td>
      <td>
        <input type="checkbox" name="meta[elektrolit][]" value="Natrium" id="elektrolit-natrium">
        <label for="elektrolit-natrium">Natrium</label>
      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[serologis][]" value="Anti - HAV IgM" id="serologis-havigm">
        <label for="serologis-havigm">Anti - HAV IgM</label>
      </td>
      <td>
        <input type="checkbox" name="meta[lemak][]" value="Trigliserida*" id="lemak-trigliserida">
        <label for="lemak-trigliserida">Trigliserida*</label>
      </td>
      <td>
        <input type="checkbox" name="meta[elektrolit][]" value="Chlorida" id="elektrolit-chlorida">
        <label for="elektrolit-chlorida">Chlorida</label>
      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[serologis][]" value="Anti - DHF IgM + IgG" id="serologis-dhfigmigg">
        <label for="serologis-dhfigmigg">Anti - DHF IgM + IgG</label>
      </td>
      <td>
        <input type="checkbox" name="meta[lemak][]" value="Cholesterol HDL" id="lemak-cholesterolhdl">
        <label for="lemak-cholesterolhdl">Cholesterol HDL</label>
      </td>
      <td>

      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="meta[serologis][]" value="Anti - TB IgG" id="serologis-tbigg">
        <label for="serologis-tbigg">Anti - TB IgG</label>
      </td>
      <td>
        <input type="checkbox" name="meta[lemak][]" value="Cholesterol LDL" id="lemak-cholesterolldl">
        <label for="lemak-cholesterolldl">Cholesterol LDL</label>
      </td>
      <td>
        <strong>BAKTERIOSKOPIS</strong>
      </td>
    </tr>
    <tr>
      <td>

      </td>
      <td>

      </td>
      <td>
        <input type="checkbox" name="meta[bakteri][]" value="Sputum" id="bakteri-sputum">
        <label for="bakteri-sputum">Sputum</label>
      </td>
    </tr>
    <tr>
      <td>
        <strong><i>**Urine 24 Jam</i></strong>
      </td>
      <td>
        <strong><i>*Puasa 10 - 12 Jam</i></strong>
      </td>
      <td>
        <input type="checkbox" name="meta[bakteri][]" value="Sekreta Urethra" id="bakteri-sekretauretra">
        <label for="bakteri-sekretauretra">Sekreta Urethra</label>
      </td>
    </tr>
    <tr>
      <td>

      </td>
      <td>

      </td>
      <td>
        <input type="checkbox" name="meta[bakteri][]" value="Sekreta Vagina" id="bakteri-sekretavagina">
        <label for="bakteri-sekretavagina">Sekreta Vagina</label>
      </td>
    </tr>
    <tr>
      <td colspan="3"> <strong> Lain - Lain: </strong> </td>
    </tr>
  </tbody>
</table>

<table class="table table-striped pemeriksaan-lab" style="margin-bottom:15px;">
  <tbody>
    <?php for ($i=1; $i <= 5; $i++) { ?>
      <tr>
        <td style="width: 35px;">
          <input type="checkbox" name="meta[lain_lain][]" value="<?=$i?>">
        </td>
        <td><input type="text" name="meta[lain_lain_label][<?=$i?>]" value=""> </td>
      </tr>
    <?php } ?>
    <tr>
      <td colspan="2"> <strong>Hasil:</strong> </td>
    </tr>
    <tr>
      <td style="width: 35px;">
        <input type="checkbox" name="meta[hasil][]" value="Diantar Ke Klinik" id="hasil-diantarkeklinik">
      </td>
      <td>
        <label for="hasil-diantarkeklinik">Diantar Ke Klinik</label>
      </td>
    </tr>
    <tr>
      <td style="width: 35px;">
        <input type="checkbox" name="meta[hasil][]" value="Diantar Ke Dokter" id="hasil-diantarkedikter">
      </td>
      <td>
        <label for="hasil-diantarkedikter">Diantar Ke Dokter</label>
      </td>
    </tr>
    <tr>
      <td style="width: 35px;">
        <input type="checkbox" name="meta[hasil][]" value="Diambil Sendiri" id="hasil-diambilsendiri">
      </td>
      <td>
        <label for="hasil-diambilsendiri">Diambil Sendiri</label>
      </td>
    </tr>
  </tbody>
</table>

<script type="text/javascript">
  $(function(){
    $('[for="diagnosis"]').text('Kesimpulan');
  });
</script>
