<?php
$meta = $pemeriksaan['meta'];
?>
<div class="form-group">
    <label for="riwayat_kehamilan" class="col-sm-3 control-label">Riwayat Kehamilan</label>
    <div class="col-sm-9">
        <textarea type="text" class="form-control" name="meta[riwayat_kehamilan]" id="riwayat_kehamilan" ><?=isset($meta) ? $meta['riwayat_kehamilan'] : ''?></textarea>
    </div>
</div>
<div class="form-group">
    <label for="riwayat_imunisasi" class="col-sm-3 control-label">Riwayat Imunisasi</label>
    <div class="col-sm-9">
        <textarea type="text" class="form-control" name="meta[riwayat_imunisasi]" id="riwayat_imunisasi" ><?=isset($meta) ? $meta['riwayat_imunisasi'] : ''?></textarea>
    </div>
</div>
<div class="form-group">
    <label for="pemeriksaa_DDST" class="col-sm-3 control-label">Pemeriksaan DDST</label>
    <div class="col-sm-9">
        <textarea type="text" class="form-control" name="meta[pemeriksaa_DDST]" id="pemeriksaa_DDST" ><?=isset($meta) ? $meta['pemeriksaa_DDST'] : ''?></textarea>
    </div>
</div>
<div class="form-group">
    <label for="riwayat_penyakit_lain" class="col-sm-3 control-label">Riwayat Penyakit Lain</label>
    <div class="col-sm-9">
        <textarea type="text" class="form-control" name="meta[riwayat_penyakit_lain]" id="riwayat_penyakit_lain" ><?=isset($meta) ? $meta['riwayat_penyakit_lain'] : ''?></textarea>
    </div>
</div>
<div class="form-group">
    <label for="riwayat_penyakit_keluarga" class="col-sm-3 control-label">Riwayat Penyakit Keluarga</label>
    <div class="col-sm-9">
        <textarea type="text" class="form-control" name="meta[riwayat_penyakit_keluarga]" id="riwayat_penyakit_keluarga" ><?=isset($meta) ? $meta['riwayat_penyakit_keluarga'] : ''?></textarea>
    </div>
</div>
