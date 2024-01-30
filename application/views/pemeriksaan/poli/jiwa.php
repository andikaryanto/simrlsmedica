<?php
$meta = $pemeriksaan['meta'];
?>
<div class="form-group">
    <label for="status_neurologi" class="col-sm-3 control-label">Status neurologi</label>
    <div class="col-sm-9">
        <textarea type="text" class="form-control" name="meta[status_neurologi]" id="status_neurologi" ><?=isset($meta) ? $meta['status_neurologi'] : ''?></textarea>
    </div>
</div>
<div class="form-group">
    <label for="psikiatri" class="col-sm-3 control-label">Psikiatri</label>
    <div class="col-sm-9">
        <textarea type="text" class="form-control" name="meta[psikiatri]" id="psikiatri" ><?=isset($meta) ? $meta['psikiatri'] : ''?></textarea>
    </div>
</div>
