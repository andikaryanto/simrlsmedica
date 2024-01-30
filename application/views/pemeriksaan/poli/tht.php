<style media="screen">
.pemeriksaan-tht {
  border: 1px solid #eee;
}
.pemeriksaan-tht input {
    width: 100%;
    border: 0;
    border-bottom: 1px dotted #333;
    background-color: #fff0;
}

.pemeriksaan-tht input:focus {
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
</style>

<!--
a: 3: {
  s: 7: "telimga";a: 2: {
    s: 3: "mae";s: 3: "MAE";s: 2: "mt";s: 2: "MT";
  }s: 6: "hidung";a: 2: {
    s: 10: "cavum_nasi";s: 10: "Cavum nasi";s: 5: "konka";s: 5: "Konka";
  }s: 11: "tenggorokan";a: 2: {
    s: 6: "faring";s: 6: "Faring";s: 6: "tonsil";s: 6: "Tonsil";
  }
}

{
    telimga: {
        mae: "MAE",
        mt: "MT"
    },
    hidung: {
        cavum_nasi: "Cavum nasi",
        konka: "Konka"
    },
    tenggorokan: {
        faring: "Faring",
        tonsil: "Tonsil"
    }
}
-->

<?php
$tht_result = unserialize($pemeriksaan['meta']);
?>

<div class="form-group">
  <label class="col-sm-3 control-label">Status Lokalis</label>
</div>
<div class="table-responsive">
  <table class="table table-striped pemeriksaan-tht">
    <tbody>
    <tr>
      <td colspan="3" class="text-center">
        <img style="height:160px;" src="<?=base_url().'assets/img/telinga.png'?>" alt="Status Lokalis">
      </td>
    </tr>
    <tr>
      <td rowspan="2" style="width: 100px;">Telinga</td>
      <td>a. MAE</td>
      <td> <input type="text" name="meta[telimga][mae]" value="<?=isset($tht_result) ? $tht_result['telimga']['mae'] : ''?>"> </td>
    </tr>
    <tr>
      <td>b. MT</td>
      <td> <input type="text" name="meta[telimga][mt]" value="<?=isset($tht_result) ? $tht_result['telimga']['mt'] : ''?>"> </td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" class="text-center">
        <img style="height:160px;" src="<?=base_url().'assets/img/hidung.png'?>" alt="Status Lokalis">
      </td>
    </tr>
    <tr>
      <td rowspan="2">Hidung</td>
      <td>a. Cavum nasi</td>
      <td> <input type="text" name="meta[hidung][cavum_nasi]" value="<?=isset($tht_result) ? $tht_result['hidung']['cavum_nasi'] : ''?>"> </td>
    </tr>
    <tr>
      <td>b. Konka</td>
      <td> <input type="text" name="meta[hidung][konka]" value="<?=isset($tht_result) ? $tht_result['hidung']['konka'] : ''?>"> </td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" class="text-center">
        <img style="height:160px;" src="<?=base_url().'assets/img/tenggorokan.png'?>" alt="Status Lokalis">
      </td>
    </tr>
    <tr>
      <td rowspan="2">Tenggorokan</td>
      <td>a. Faring</td>
      <td> <input type="text" name="meta[tenggorokan][faring]" value="<?=isset($tht_result) ? $tht_result['tenggorokan']['faring'] : ''?>"> </td>
    </tr>
    <tr>
      <td>b. Tonsil</td>
      <td> <input type="text" name="meta[tenggorokan][tonsil]" value="<?=isset($tht_result) ? $tht_result['tenggorokan']['tonsil'] : ''?>"> </td>
    </tr>
    </tbody>
  </table>
</div>

<script type="text/javascript">
  $(function(){

  });
</script>
