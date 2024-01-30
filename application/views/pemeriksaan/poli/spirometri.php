<style media="screen">
[for="deskripsi_tindakan"], #deskripsi_tindakan{
  display: none;
}
</style>
<?php
$meta = $pemeriksaan['meta'];
?>
<div class="form-group">
    <label class="col-sm-3 control-label">Perokok</label>
    <div class="col-sm-9">
        <input type="radio" name="meta[perokok]" <?=isset($meta) && $meta['perokok'] == 'Ya' ? 'checked' : ''?> id="perokok_ya" value="Ya"> <label for="perokok_ya">Ya</label>
        &nbsp;&nbsp;
        <input type="radio" name="meta[perokok]" <?=isset($meta) && $meta['perokok'] == 'Tidak' ? 'checked' : ''?> id="perokok_tidak" value="Tidak">  <label for="perokok_tidak">Tidak</label>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Hasil</label>
</div>
<div class="form-group">
    <label for="vc" class="col-sm-3 control-label">VC</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" name="meta[vc]" value="<?=isset($meta) ? $meta['vc'] : ''?>" id="vc">
    </div>
</div>
<div class="form-group">
    <label for="pvc" class="col-sm-3 control-label">PVC</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" name="meta[pvc]" value="<?=isset($meta) ? $meta['pvc'] : ''?>" id="pvc">
    </div>
</div>
<div class="form-group">
    <label for="fev1" class="col-sm-3 control-label">FEV<sub>1</sub> </label>
    <div class="col-sm-9">
        <input type="text" class="form-control" name="meta[fev1]" value="<?=isset($meta) ? $meta['fev1'] : ''?>" id="fev1">
    </div>
</div>
<div class="form-group">
    <label for="fev1_kvp" class="col-sm-3 control-label">FEV<sub>1</sub> / KVP </label>
    <div class="col-sm-9">
        <input type="text" class="form-control" name="meta[fev1_kvp]" value="<?=isset($meta) ? $meta['fev1_kvp'] : ''?>" id="fev1_kvp">
    </div>
</div>

<script type="text/javascript">
  $(function(){
    $('[for="diagnosis"]').text('Kesimpulan');
  });
</script>
