<style media="screen">
.pemeriksaan-syaraf {
  border: 1px solid #eee;
}
.pemeriksaan-syaraf input {
    width: 100%;
    border: 0;
    border-bottom: 1px dotted #333;
    background-color: #fff0;
}

.pemeriksaan-syaraf input:focus {
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
<?php
$meta = $pemeriksaan['meta'];
?>
<div class="form-group">
    <label class="col-sm-3 control-label">Pemeriksaan fisik</label>
</div>
<div class="table-responsive">
    <table class="table table-striped pemeriksaan-syaraf">
        <tbody>
        <tr>
            <td style="width: 135px;">a. Status Internis</td>
            <td> <input type="text" name="meta[status_internis]" value="<?=isset($meta) ? $meta['status_internis'] : ''?>"> </td>
        </tr>
        <tr>
            <td>b. Status Psikiatri</td>
            <td> <input type="text" name="meta[status_psikiatri]" value="<?=isset($meta) ? $meta['status_psikiatri'] : ''?>"> </td>
        </tr>
        <tr>
            <td>b. Status Neurologis</td>
            <td> <input type="text" name="meta[status_neurologis]" value="<?=isset($meta) ? $meta['status_neurologis'] : ''?>"> </td>
        </tr>
        </tbody>
    </table>
</div>
