<style media="screen">
    .pemeriksaan-kulit {
        border: 1px solid #eee;
    }

    .pemeriksaan-kulit input {
        width: 100%;
        border: 0;
        border-bottom: 1px dotted #333;
        background-color: #fff0;
    }

    .pemeriksaan-kulit input:focus {
        border-style: solid;
        outline: none !important;
    }

    #area-pemeriksaan {
        padding: 0;
        cursor: pointer;
    }

    #area-pemeriksaan .marker {
        width: 40px;
        height: 23px;
        text-align: right;
        position: absolute;
        color: red;
        font-weight: bold;
    }
</style>

<div class="form-group">
    <label class="col-sm-3 control-label">Status Lokalis</label>
    <label class="col-sm-9 control-label" style="color:red;">
        <i>Klik pada gambar untuk menandai lokasi !</i>
    </label>
</div>
<div class="table-responsive">
    <table class="table table-striped pemeriksaan-kulit">
        <tbody>
        <tr>
            <td colspan="3" class="text-center">
                <div id="area-pemeriksaan">
                    <img class="img-responsive" src="<?= base_url() . 'assets/img/kk.png' ?>" alt="Status Lokalis">
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="text-center">
                ( Status Dermatologis / Status Venerologis )
            </td>
        </tr>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(function () {

        let res = <?=json_encode(unserialize($pemeriksaan['meta']));?>;
        for (let key in res) {
            if (res.hasOwnProperty(key)) {
                let o = res[key];
                let n = key.split("-")[1];
                $("#area-pemeriksaan").append(`
                  <div class="marker" data-n="` + n + `" style="margin-top:-` + (o.y_pos) + `px; margin-left:` + (o.x_pos) + `px;">
                    ` + n + `<i class="fa fa-long-arrow-right"></i>
                  </div>
                `);
                $('.pemeriksaan-kulit tbody').append(`
                  <tr class="row-lokalis-` + n + `">
                    <td style="width: 30px;font-weight: bold;color: red;">` + n + `</td>
                    <td>
                      <input type="hidden" name="meta[lokalis-` + n + `][x_pos]" value="${o.x_pos}">
                      <input type="hidden" name="meta[lokalis-` + n + `][y_pos]" value="${o.y_pos}">
                      <input type="hidden" name="meta[lokalis-` + n + `][status]">
                      <input type="hidden" name="meta[lokalis-` + n + `][x_per_width]" value="` + o.x_per_width + `">
                      <input type="hidden" name="meta[lokalis-` + n + `][y_per_width]" value="` + o.y_per_width + `">
                      <input class="lokalis-` + n + `" type="text" name="meta[lokalis-` + n + `][value]" value="${o.value}">
                    </td>
                    <td style="width: 55px;text-align: right;"><button type="button" class="btn btn-sm btn-warning btn-lokalis-` + n + `"><i class="fa fa-trash"></i></button></td>
                  </tr>
                `);
                $('.btn-lokalis-' + n).on('click', function () {
                    var ask = confirm('Apakah anda akan menghapus status?');

                    if (ask) {
                        $('.marker[data-n="' + n + '"]').remove();
                        $('input[name="meta[lokalis-' + n + '][status]"]').val('hidden');
                        $('.row-lokalis-' + n).remove();
                    }
                });
            }
        }

        $("#area-pemeriksaan").click(function (e) {
            var box = $(this);
            var offset = box.offset();
            var height = box.height();
            var width = box.width();
            var x = e.pageX - offset.left;
            var y = e.pageY - offset.top;
            var n = parseInt($('#area-pemeriksaan .marker')[$('#area-pemeriksaan .marker').length - 1].textContent) + 1;
            var x_pos = x - 40;
            var y_pos = (height - y) + 11.5;

            var theHtml = `
              <div class="marker" data-n="` + n + `" style="margin-top:-` + ((height - y) + 11.5) + `px; margin-left:` + (x - 40) + `px;">
                ` + n + `<i class="fa fa-long-arrow-right"></i>
              </div>
            `;

            box.append(theHtml);

            var theForm = `
              <tr class="row-lokalis-` + n + `">
                <td style="width: 30px;font-weight: bold;color: red;">` + n + `</td>
                <td>
                  <input type="hidden" name="meta[lokalis-` + n + `][x_pos]" value="${x_pos}">
                  <input type="hidden" name="meta[lokalis-` + n + `][y_pos]" value="${y_pos}">
                  <input type="hidden" name="meta[lokalis-` + n + `][status]">
                  <input type="hidden" name="meta[lokalis-` + n + `][x_per_width]" value="` + (x / width) + `">
                  <input type="hidden" name="meta[lokalis-` + n + `][y_per_width]" value="` + (y / height) + `">
                  <input class="lokalis-` + n + `" type="text" name="meta[lokalis-` + n + `][value]">
                </td>
                <td style="width: 55px;text-align: right;"><button type="button" class="btn btn-sm btn-warning btn-lokalis-` + n + `"><i class="fa fa-trash"></i></button></td>
              </tr>
            `;
            console.log({n, x_pos, y_pos});

            $('.pemeriksaan-kulit tbody').append(theForm);
            $('.lokalis-' + n).focus();

            $('.btn-lokalis-' + n).on('click', function () {
                var ask = confirm('Apakah anda akan menghapus status?');

                if (ask) {
                    $('.marker[data-n="' + n + '"]').hide();
                    $('.row-lokalis-' + n).hide();
                    $('input[name="meta[lokalis-' + n + '][status]"]').val('hidden');
                }
            });

        });

    });
</script>
