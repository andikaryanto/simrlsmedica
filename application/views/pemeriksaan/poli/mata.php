<?php
$meta = unserialize($pemeriksaan['meta']);
?>

<style media="screen">
.pemeriksaan-mata {
  border: 1px solid #eee;
}
.pemeriksaan-mata input {
    width: 100%;
    border: 0;
    border-bottom: 1px dotted #333;
    background-color: #fff0;
}

.pemeriksaan-mata input:focus {
    border-style: solid;
    outline: none !important;
}
</style>
<div class="form-group">
    <label class="col-sm-3 control-label">Pemeriksaan Fisik</label>
</div>
<div class="table-responsive">
    <table class="table table-striped pemeriksaan-mata">
        <tr>
            <td class="text-center">
                <img src="<?=base_url().'assets/img/mata-od.png'?>" alt="Mata OD">
            </td>
            <td></td>
            <td class="text-center">
                <img src="<?=base_url().'assets/img/mata-os.png'?>" alt="Mata OS">
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="meta[visus][od]" value="<?=isset($meta) ? $meta['visus']['od'] : ''?>">
            </td>
            <td class="text-center">Visus</td>
            <td>
                <input type="text" name="meta[visus][os]" value="<?=isset($meta) ? $meta['visus']['os'] : ''?>">
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="meta[koreksi][od]" value="<?=isset($meta) ? $meta['koreksi']['od'] : ''?>">
            </td>
            <td class="text-center">Koreksi</td>
            <td>
                <input type="text" name="meta[koreksi][os]" value="<?=isset($meta) ? $meta['koreksi']['os'] : ''?>">
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="meta[adisi][od]" value="<?=isset($meta) ? $meta['adisi']['od'] : ''?>">
            </td>
            <td class="text-center">Adisi</td>
            <td>
                <input type="text" name="meta[adisi][os]" value="<?=isset($meta) ? $meta['adisi']['os'] : ''?>">
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="meta[gerakan_bola_mata][od]" value="<?=isset($meta) ? $meta['gerakan_bola_mata']['od'] : ''?>">
            </td>
            <td class="text-center">Gerakan Bola Mata</td>
            <td>
                <input type="text" name="meta[gerakan_bola_mata][os]" value="<?=isset($meta) ? $meta['gerakan_bola_mata']['os'] : ''?>">
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="meta[kedudukan][od]" value="<?=isset($meta) ? $meta['kedudukan']['od'] : ''?>">
            </td>
            <td class="text-center">Kedudukan</td>
            <td>
                <input type="text" name="meta[kedudukan][os]" value="<?=isset($meta) ? $meta['kedudukan']['os'] : ''?>">
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="meta[palpebra][od]" value="<?=isset($meta) ? $meta['palpebra']['od'] : ''?>">
            </td>
            <td class="text-center">Palpebra</td>
            <td>
                <input type="text" name="meta[palpebra][os]" value="<?=isset($meta) ? $meta['palpebra']['os'] : ''?>">
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="meta[conjunctiva][od]" value="<?=isset($meta) ? $meta['conjunctiva']['od'] : ''?>">
            </td>
            <td class="text-center">Conjunctiva</td>
            <td>
                <input type="text" name="meta[conjunctiva][os]" value="<?=isset($meta) ? $meta['conjunctiva']['os'] : ''?>">
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="meta[cornea][od]" value="<?=isset($meta) ? $meta['cornea']['od'] : ''?>">
            </td>
            <td class="text-center">Cornea</td>
            <td>
                <input type="text" name="meta[cornea][os]" value="<?=isset($meta) ? $meta['cornea']['os'] : ''?>">
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="meta[coa][od]" value="<?=isset($meta) ? $meta['coa']['od'] : ''?>">
            </td>
            <td class="text-center">COA</td>
            <td>
                <input type="text" name="meta[coa][os]" value="<?=isset($meta) ? $meta['coa']['os'] : ''?>">
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="meta[pupil][od]" value="<?=isset($meta) ? $meta['pupil']['od'] : ''?>">
            </td>
            <td class="text-center">Pupil</td>
            <td>
                <input type="text" name="meta[pupil][os]" value="<?=isset($meta) ? $meta['pupil']['os'] : ''?>">
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="meta[iris][od]" value="<?=isset($meta) ? $meta['iris']['od'] : ''?>">
            </td>
            <td class="text-center">Iris</td>
            <td>
                <input type="text" name="meta[iris][os]" value="<?=isset($meta) ? $meta['iris']['os'] : ''?>">
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="meta[lensa][od]" value="<?=isset($meta) ? $meta['lensa']['od'] : ''?>">
            </td>
            <td class="text-center">Lensa</td>
            <td>
                <input type="text" name="meta[lensa][os]" value="<?=isset($meta) ? $meta['lensa']['os'] : ''?>">
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="meta[vitreous][od]" value="<?=isset($meta) ? $meta['vitreous']['od'] : ''?>">
            </td>
            <td class="text-center">Vitreous</td>
            <td>
                <input type="text" name="meta[vitreous][os]" value="<?=isset($meta) ? $meta['vitreous']['os'] : ''?>">
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="meta[fundus][od]" value="<?=isset($meta) ? $meta['fundus']['od'] : ''?>">
            </td>
            <td class="text-center">Fundus</td>
            <td>
                <input type="text" name="meta[fundus][os]" value="<?=isset($meta) ? $meta['fundus']['os'] : ''?>">
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="meta[tio][od]" value="<?=isset($meta) ? $meta['tio']['od'] : ''?>">
            </td>
            <td class="text-center">T.I.O</td>
            <td>
                <input type="text" name="meta[tio][os]" value="<?=isset($meta) ? $meta['tio']['os'] : ''?>">
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="meta[campus][od]" value="<?=isset($meta) ? $meta['campus']['od'] : ''?>">
            </td>
            <td class="text-center">Campus</td>
            <td>
                <input type="text" name="meta[campus][os]" value="<?=isset($meta) ? $meta['campus']['os'] : ''?>">
            </td>
        </tr>
    </table>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Tes Buta Mata</label>
    <div class="col-sm-9">
        <label class="checkbox-inline"><input type="radio" name="meta[buta_mata]" <?=isset($meta) && $meta['buta_mata'] == 'Normal' ? 'checked' : ''?> value="Normal">Normal</label>
        <label class="checkbox-inline"><input type="radio" name="meta[buta_mata]" <?=isset($meta) && $meta['buta_mata'] == 'Red Green Dificiency' ? 'checked' : ''?> value="Red Green Dificiency">Red Green Dificiency</label>
        <label class="checkbox-inline"><input type="radio" name="meta[buta_mata]" <?=isset($meta) && $meta['buta_mata'] == 'Buta Warna Total' ? 'checked' : ''?> value="Buta Warna Total">Buta Warna Total</label>
    </div>
</div>
