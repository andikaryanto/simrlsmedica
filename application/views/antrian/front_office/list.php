<link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/autocomplete/style-gue.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Antrian Front Office
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"> Antrian Front Office</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-sm-12 col-md-5 col-lg-4">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title"> </h3>&nbsp;&nbsp;
                    </div>
                    <div class="box-header text-center">
                        <h3>Antrian Dipanggil</h3>
                        <h1 style="font-size: 49px" id="no-antrian"><b><?=$current_no?></b></h1>
                        <h4 style="margin-top: 40px"><b>Loket 1</b></h4>
                        <hr>
                        <h4>Antrian Front Office</h4>
                    </div>
                    <div class="box-footer text-center">
                        <button class="btn btn-sm btn-warning" onclick="layani()" id="b-layan" data-id="<?=$last_id?>">
                            <i class="fa fa-handshake-o"></i> Layani
                        </button>
                        <a href="<?=base_url()?>/AntrianFrontOffice/hapus/<?=$last_id?>"
                           onclick="return confirm('Yakin hapus no antrian ini?')"
                           id="b-batal"
                           class="btn btn-sm btn-danger">
                            <i class="fa fa-trash-o"></i> Hapus
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-7 col-lg-8">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">Daftar Antrian Front Office</h3>&nbsp;&nbsp;
                        <a href="<?=base_url()?>/AntrianFrontOffice/ambil" class="btn btn-success pull-right">
                            <i class="fa fa-plus"></i> Ambil Antrian
                        </a>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Waktu Ambil Antrian</th>
                                <th>No Antrian</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($list as $k => $v) : ?>
                            <tr>
                                <td><?=$k + 1?></td>
                                <td><?=date('d-M-Y H:i', strtotime($v->mulai_tunggu_admisi_at))?></td>
                                <td><?=$v->no_antrian?></td>
                                <td>
                                    <?php if ($k == 0) : ?>
                                        <button class="btn btn-sm btn-success" onclick="panggil(<?=$v->id?>, '<?=$v->no_antrian?>')">
                                            <i class="fa fa-volume-up"></i> Panggil
                                        </button>
                                        <button class="btn btn-sm btn-warning" onclick="layani(<?=$v->id?>)">
                                            <i class="fa fa-handshake-o"></i> Layani
                                        </button>
                                    <?php endif; ?>
                                    <a target="_blank" href="<?=base_url()?>/AntrianFrontOffice/print/<?=$v->no_antrian?>" class="btn btn-sm btn-primary">
                                        <i class="fa fa-print"></i> Print
                                    </a>
                                    <a href="<?=base_url()?>/AntrianFrontOffice/hapus/<?=$v->id?>"
                                       onclick="return confirm('Yakin hapus no antrian <?=$v->no_antrian?>?')"
                                       class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash-o"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" data-backdrop="static" id="modal-pasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" id="FormStockOpname">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-size: 16px" id="modal-title">Jenis pasien</h5>
                </div>
                <div class="modal-body">
                    <div class="container" style="width: 100%">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nama" class="control-label">Pilih Pasien</label>
                                    <br>
                                    <label style="font-weight: normal">
                                        <input type="radio" name="jns_pasien" value="1" required> Pasien Baru
                                    </label>
                                    <label style="font-weight: normal; margin-left: 8px">
                                        <input type="radio" name="jns_pasien" value="2" required> Pasien Lama
                                    </label>
                                </div>
                                <div class="form-group" style="display: none" id="ctr-pasien">
                                    <label for="cari">Cari</label>
                                    <input type="text" class="form-control" name="pencarian_kode" id="pencarian_kode" style="width: 100%"
                                           placeholder="Masukkan Nama / No RM / NIK" autocomplete="off">
                                    <input type="hidden" name="id_pasien" id='id_pasien'>
                                    <div id='hasil_pencarian'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Layani</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function layani(id = 0) {
        if (id === 0) {
            id = $('#b-layan').data('id')
        }
        $('#modal-pasien').modal('show')
        $('#FormStockOpname').attr('action', `<?=base_url()?>/AntrianFrontOffice/layani/${id}`)
        $('#ctr-pasien')
    }

    let speech = new SpeechSynthesisUtterance();
    speech.lang = "id";
    speech.rate = 0.8

    function panggil(id, no_antrian) {
        speech.text = `Nomor antrian.... ${no_antrian.replaceAll('-', ' ')}.... Silahkan ke bagian pendaftaran`
        window.speechSynthesis.speak(speech)

        $('#no-antrian').html(`<b>${no_antrian}</b>`)
        $('#b-layan').data('id', id)
        $('#b-batal').attr('href', `<?=base_url()?>/AntrianFrontOffice/hapus/${id}`)

        $.ajax({url: `<?=base_url()?>/AntrianFrontOffice/panggil/${id}`}).done(function() { })
    }

    $(function () {
        $('input[type=radio][name=jns_pasien]').change(function() {
            if (this.value === '2') {
                $('#ctr-pasien').css('display', 'block')
            }
            else {
                $('#ctr-pasien').css('display', 'none')
            }
        })

        $('#example2').DataTable({
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true
        })
    })
</script>

<script>
    $(function () {
        <?php $warning = $this->session->flashdata('warning');
        if (!empty($warning)) { ?>
        Swal.fire({
            icon: 'error',
            title: '<?=$warning?>',
        })
        <?php } ?>

        <?php $success = $this->session->flashdata('success');
        if (!empty($success)) { ?>
        Swal.fire({
            icon: 'success',
            title: '<?=$success?>',
        })
        <?php } ?>

        <?php $print = $this->session->flashdata('print');
        if (!empty($print)) { ?>
            window.open('<?=base_url()?>/AntrianFrontOffice/print/<?=$this->session->flashdata('nomor')?>', '_blank').focus();
        <?php } ?>
    })
</script>

<script>
    $('#pencarian_kode').keypress(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
        }
    });
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
            url: "<?php echo site_url('pendaftaran/ajax_kode'); ?>",
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
            url: "<?php echo site_url('pembelian/cek-kode'); ?>",
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