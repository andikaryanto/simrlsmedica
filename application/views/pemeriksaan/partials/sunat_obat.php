<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-8">
                <select id="obat-option-2">
                    <option value="">-- Pilih Obat --</option>
                    <?php foreach ($obat1 as $key => $value) { ?>
                        <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-sm-4">
                <button type="button" name="button"
                        class="btn btn-sm btn-block btn-primary"
                        id="button-add-obat-2"><i class="fa fa-plus"></i>
                    Tambah obat
                </button>
                <input type="hidden" id="abdush-counter22" value="0">
            </div>

        </div>

        <div class="form-area-obat2" style="margin-top:15px;">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Nama</th>
                    <th>Stok Obat</th>
                    <th>Jml</th>
                    <th>Signa</th>

                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(function () {
        var obat = <?php echo json_encode($obat1); ?>;
        $('#obat-option-2').select2();


        $('#button-add-obat-2').on('click', function (e) {
            var id_Obat = $('#obat-option-2').val();
            if (id_Obat == '') {
                alert('Anda belum memilih obat !');
            }
            else {
                var theObat = {};
                var counter = parseInt($('#abdush-counter22').val());
                $.each(obat, function (i, v) {
                    if (v.id == id_Obat) {
                        theObat = v;
                        return;
                    }
                });

                var html = `
                <tr>
                  <td>
                    ` + theObat.nama + `
                    <input type="hidden" name="nama_obat_sunat[]" value="` + theObat.id + `">
                  </td>
                  <td>` + theObat.stok_obat + ` item </td>
                  <input type="hidden" id="stok` + counter + `" value="` + theObat.stok_obat + `">
                  <td>
                    <input style="width:65px;" type="text" class="form-control" onchange="loadData(` + counter + `);" name="jumlah_satuan_sunat[]" id="jumlah_satuan_sunat` + counter + `">
                  </td>
                  <td>
                    <input style="width:100px;" type="text" class="form-control"  name="signa_obat_sunat[]" id="signa_obat_sunat` + counter + `">
                  </td>
                  <td>
                    <button class="btn btn-sm btn-danger btn-delete-row2" type="button"> <i class="fa fa-trash"></i> </button>
                  </td>
                </tr>

                `;

                $('.form-area-obat2 tbody').append(html);
                $('#abdush-counter22').val(counter + 1);
                $('input[id="jumlah_satuan_sunat' + counter + '"]').focus();

                $('.btn-delete-row2').unbind('click');
                $('.btn-delete-row2').each(function () {
                    $(this).on('click', function () {
                        $(this).parents('tr').remove();
                    });
                });
            }

            $('#obat-option-2').val('').trigger('change');
        });

    })
</script>