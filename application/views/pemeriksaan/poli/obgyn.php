<?php
$res = unserialize($pemeriksaan['meta']);
?>

<div class="form-group">
  <label for="hpht" class="col-sm-3 control-label">HPHT</label>
  <div class="col-sm-9">
    <textarea type="text" class="form-control" name="meta[hpht]" id="hpht" ><?=$res['hpht']?></textarea>
  </div>
</div>
<div class="form-group">
  <label for="hpl" class="col-sm-3 control-label">HPL</label>
  <div class="col-sm-9">
    <textarea type="text" class="form-control" name="meta[hpl]" id="hpl" ><?=$res['hpl']?></textarea>
  </div>
</div>
<div class="form-group">
  <label for="g_p_a" class="col-sm-3 control-label">G/P/A</label>
  <div class="col-sm-9">
    <textarea type="text" class="form-control" name="meta[g_p_a]" id="g_p_a" ><?=$res['g_p_a']?></textarea>
  </div>
</div>
<div class="form-group">
  <label for="uk" class="col-sm-3 control-label">UK</label>
  <div class="col-sm-9">
    <textarea type="text" class="form-control" name="meta[uk]" id="uk" ><?=$res['uk']?></textarea>
  </div>
</div>
<div class="form-group">
  <label for="abdomen" class="col-sm-3 control-label">Abdomen</label>
  <div class="col-sm-9">
    <textarea type="text" class="form-control" name="meta[abdomen]" id="abdomen" ><?=$res['abdomen']?></textarea>
  </div>
</div>
<div class="form-group">
  <label for="auskultasi" class="col-sm-3 control-label">Auskultasi</label>
  <div class="col-sm-9">
    <textarea type="text" class="form-control" name="meta[auskultasi]" id="auskultasi" ><?=$res['auskultasi']?></textarea>
  </div>
</div>
