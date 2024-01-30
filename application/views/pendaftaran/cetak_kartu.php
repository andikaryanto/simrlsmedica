<link rel="stylesheet"
      href="<?= base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/autocomplete/style-gue.css">
<style type="text/css">
    @import('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/css/bootstrap.min.css');
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Cetak Kartu
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"> Cetak Kartu</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Cetak Kartu</h3>&nbsp;&nbsp;
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>NO RM</th>
                                <th>Nama Pasien</th>
                                <th>NIK</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1;
                            foreach ($listPendaftaran->result() as $row) { ?>
                                <tr>
                                    <td> <?= $no; ?></td>
                                    <td> <?= ucwords($row->no_rm); ?></td>
                                    <td> <?= ucwords($row->nama_pasien); ?></td>
                                    <td> <?= ucwords($row->nik); ?></td>
                                    <td>
                                        <?= ucwords($row->alamat) ?>
                                        <?php if ($row->desa) : ?><?= ", Desa $row->desa" ?><?php endif; ?>
                                        <?php if ($row->kec) : ?><?= ", Kec $row->kec" ?><?php endif; ?>
                                        <?php if ($row->kab) : ?><?= ", Kab $row->kab" ?><?php endif; ?>
                                        <?php if ($row->prov) : ?><?= ", Prov $row->prov" ?><?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url(); ?>Pendaftaran/cetak_kartu/<?= $row->pendaftaran_id; ?>" target="_blank">
                                            <button type="button" class="btn btn-warning btn-sm btn-block"><i class="fa fa-print"></i> Cetak</button>
                                        </a>
                                    </td>
                                </tr>
                                <?php $no++;
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $('#pencarian_kode').keypress(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
        }
    });


    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true
        })
    })


</script>

<script type="text/javascript">
    var timer = null;
    $(document).on('keyup', '#pencarian_kode', function (e) {
       if($('#pencarian_kode').val().length > 0){
            clearTimeout(timer);
            timer = setTimeout(
            function () {
                if ($('#pencarian_kode').val() != '') {
                    var charCode = ( e.which ) ? e.which : event.keyCode;
                    if (charCode == 40) //arrow down
                    {

                        if ($('.form-group').find('div#hasil_pencarian li.autocomplete_active').length > 0) {
                            var selanjutnya = $('.form-group').find('div#hasil_pencarian li.autocomplete_active').next();
                            $('.form-group').find('div#hasil_pencarian li.autocomplete_active').removeClass('autocomplete_active');
                            selanjutnya.addClass('autocomplete_active');
                        } else {
                            $('.form-group').find('div#hasil_pencarian li:first').addClass('autocomplete_active');
                        }
                    }
                    else if (charCode == 38) //arrow up
                    {
                        if ($('.form-group').find('div#hasil_pencarian li.autocomplete_active').length > 0) {
                            var sebelumnya = $('.form-group').find('div#hasil_pencarian li.autocomplete_active').prev();
                            $('.form-group').find('div#hasil_pencarian li.autocomplete_active').removeClass('autocomplete_active');
                            sebelumnya.addClass('autocomplete_active');
                        } else {
                            $('.form-group').find('div#hasil_pencarian li:first').addClass('autocomplete_active');
                        }
                    }
                    else if (charCode == 13) // enter
                    {

                        var Kodenya = $('.form-group').find('div#hasil_pencarian li.autocomplete_active span#kodenya').html();
                        var No_rmnya = $('.form-group').find('div#hasil_pencarian li.autocomplete_active span#no_rmnya').html();
                        var Namanya = $('.form-group').find('div#hasil_pencarian li.autocomplete_active span#namanya').html();
                        if (Kodenya) {
                            $('#pencarian_kode').val(No_rmnya + ' - ' + Namanya);
                            $('#id_pasien').val(Kodenya);
                        } else {
                            alert('data tidak ada! Pilih pilihan yang ada sebelum di enter.');
                        }


                        $('.form-group').find('div#hasil_pencarian').hide();

                    }
                    else {
                        var text = $('#FormStockOpname').find('div#hasil_pencarian').html();
                        autoComplete($('#pencarian_kode').width(), $('#pencarian_kode').val());
                    }
                } else {
                    $('#FormStockOpname').find('div#hasil_pencarian').hide();
                }
            }, 100);
        }
    });
    $(document).on('click', '#daftar-autocomplete li', function () {
        $(this).parent().parent().parent().find('#pencarian_kode').val($(this).find('span#no_rmnya').html() + ' - ' + $(this).find('span#namanya').html());
        $(this).parent().parent().parent().find('#id_pasien').val($(this).find('span#kodenya').html());

        $('.form-group').find('#daftar-autocomplete').hide();
    });

    function autoComplete(Lebar, KataKunci) {
        $('div#hasil_pencarian').hide();
        var Lebar = Lebar + 25;

        $.ajax({
            url: "<?= site_url('pendaftaran/ajax_kode'); ?>",
            type: "POST",
            cache: false,
            data: 'keyword=' + KataKunci,
            dataType: 'json',
            success: function (json) {
                if (json.status == 1) {
                    $('#FormStockOpname').find('div#hasil_pencarian').css({'width': Lebar + 'px'});
                    $('#FormStockOpname').find('div#hasil_pencarian').show('fast');
                    $('#FormStockOpname').find('div#hasil_pencarian').html(json.datanya);
                }
                if (json.status == 0) {
                    $('#FormStockOpname').find('div#hasil_pencarian').html('');
                }
            }
        });
    }

    function cekbarcode(KataKunci, Indexnya) {
        //alert(KataKunci+' '+Indexnya);
        var Registered = '';
        $('#TabelTransaksi tbody tr').each(function () {
            if (Indexnya !== $(this).index()) {
                if ($(this).find('td:nth-child(2)').find('#kode').val() !== '') {
                    Registered += $(this).find('td:nth-child(2)').find('#kode').val() + ',';
                }
            }
        });
        var suplieridnya = $('#id_suplier').val();
        if (Registered !== '') {
            Registered = Registered.replace(/,\s*$/, "");
        }
        var pencarian_kode = $('#TabelTransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(2)').find('#pencarian_kode');
        $.ajax({
            url: "<?= site_url('pembelian/cek-kode'); ?>",
            type: "POST",
            cache: false,
            data: 'keyword=' + KataKunci,
            dataType: 'json',
            success: function (json) {
                if (json.status == 1) {
                    call(1, KataKunci, Indexnya);
                }
                if (json.status == 0) {
                    call(0, KataKunci, Indexnya);
                }
            }
        });
    }
</script>
