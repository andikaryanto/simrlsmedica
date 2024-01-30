<style media="screen">
.pemeriksaan-lab {
  border: 1px solid #eee;
}
.pemeriksaan-lab input {
    width: 100%;
    border: 0;
    border-bottom: 1px dotted #333;
    background-color: #fff0;
}

.pemeriksaan-lab input:focus {
    border-style: solid;
    outline: none !important;
}
[for="deskripsi_tindakan"], #deskripsi_tindakan{
  display: none;
}
</style>
<?php
$meta = $pemeriksaan['meta'];
?>
<div class="table-responsive">
    <table class="table table-striped pemeriksaan-lab">
        <tbody>
        <tr>
            <td colspan="7" class="text-center"> <strong>HASIL PEMERIKSAAN EKG</strong> </td>
        </tr>
        <tr>
            <td> <label for="laju_jantung">Laju Jantung</label> </td>
            <td>:</td>
            <td colspan="5">
                <input type="text" name="meta[laju_jantung]" value="<?=isset($meta) ? $meta['laju_jantung'] : ''?>" id="laju_jantung">
            </td>
        </tr>
        <tr>
            <td> <label for="laju_jantung">Irama</label> </td>
            <td>:</td>
            <td colspan="5">
                <input type="text" name="meta[irama]" value="<?=isset($meta) ? $meta['irama'] : ''?>" id="irama">
            </td>
        </tr>
        <tr>
            <td> <label for="sumbu_posisi">Sumbu & Posisi</label> </td>
            <td>:</td>
            <td colspan="5">
                <input type="text" name="meta[sumbu_posisi]" value="<?=isset($meta) ? $meta['sumbu_posisi'] : ''?>" id="sumbu_posisi">
            </td>
        </tr>
        <tr>
            <td> <label for="zona_transisi">Zona Transisi</label> </td>
            <td>:</td>
            <td colspan="5">
                <input type="text" name="meta[zona_transisi]" value="<?=isset($meta) ? $meta['zona_transisi'] : ''?>" id="zona_transisi">
            </td>
        </tr>
        <tr>
            <td> <label for="rotasi">Rotasi</label> </td>
            <td>:</td>
            <td colspan="5">
                <input type="text" name="meta[rotasi]" value="<?=isset($meta) ? $meta['rotasi'] : ''?>" id="rotasi">
            </td>
        </tr>
        <tr>
            <td> <label for="gelombang_p">Gelombang P</label> </td>
            <td>:</td>
            <td>
                <input type="text" name="meta[gelombang_p]" value="<?=isset($meta) ? $meta['gelombang_p'] : ''?>" id="gelombang_p">
            </td>
            <td style="width: 100px;"> <label for="interval_pr">Interval PR</label> </td>
            <td>:</td>
            <td style="width: 100px;">
                <input type="text" name="meta[interval_pr]" value="<?=isset($meta) ? $meta['interval_pr'] : ''?>" id="interval_pr">
            </td>
            <td class="text-right" style="width: 60px;">/detik</td>
        </tr>
        <tr>
            <td> <label for="gelombang_q">Gelombang Q</label> </td>
            <td>:</td>
            <td>
                <input type="text" name="meta[gelombang_q]" value="<?=isset($meta) ? $meta['gelombang_q'] : ''?>" id="gelombang_q">
            </td>
            <td> <label for="interval_qt">Interval QT</label> </td>
            <td>:</td>
            <td>
                <input type="text" name="meta[interval_qt]" value="<?=isset($meta) ? $meta['interval_qt'] : ''?>" id="interval_qt">
            </td>
            <td class="text-right">/detik</td>
        </tr>
        <tr>
            <td> <label for="komplek_qrs">Komplek QRS</label> </td>
            <td>:</td>
            <td>
                <input type="text" name="meta[komplek_qrs]" value="<?=isset($meta) ? $meta['komplek_qrs'] : ''?>" id="komplek_qrs">
            </td>
            <td> <label for="segmen_st">Segmen S-T</label> </td>
            <td>:</td>
            <td colspan="2">
                <input type="text" name="meta[segmen_st]" value="<?=isset($meta) ? $meta['segmen_st'] : ''?>" id="segmen_st">
            </td>
        </tr>
        <tr>
            <td> <label for="gelombang_t">Gelombang T</label> </td>
            <td>:</td>
            <td>
                <input type="text" name="meta[gelombang_t]" value="<?=isset($meta) ? $meta['gelombang_t'] : ''?>" id="gelombang_t">
            </td>
            <td> <label for="gelombang_u">Gelombang U</label> </td>
            <td>:</td>
            <td colspan="2">
                <input type="text" name="meta[gelombang_u]" value="<?=isset($meta) ? $meta['gelombang_u'] : ''?>" id="gelombang_u">
            </td>
        </tr>
        <tr>
            <td> <label for="plain_lain">Lain-lain</label> </td>
            <td>:</td>
            <td colspan="5">
                <input type="text" name="meta[plain_lain]" value="<?=isset($meta) ? $meta['plain_lain'] : ''?>" id="plain_lain">
            </td>
        </tr>
        </tbody>
    </table>
</div>

<script type="text/javascript">
  $(function(){
    $('[for="diagnosis"]').text('Kesimpulan');
  });
</script>
