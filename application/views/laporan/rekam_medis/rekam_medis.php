<link rel="stylesheet"
      href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/autocomplete/style-gue.css">
<style type="text/css">
    @import(

    'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/css/bootstrap.min.css'
    )
    ;
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Laporan Rekam Medis
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Laporan Rekam Medis</a></li>
            <li class="active"> Pasien</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <h5><i class='fa fa-file-text-o fa-fw'></i> Laporan Rekam Medis</h5>
                        <hr/>

                        <form class="form-horizontal" method="get" action="<?php echo base_url() ?>Laporan/RekamMedis">
                            <div class="row">
                                <div class="col-sm-6">
                                    <?php echo form_open('Pendaftaran/Pendaftaran_lama2', array('id' => 'form_cari')); ?>
                                    <div class="form-group">
                                        <label for="cari" class="col-sm-1 control-label">Cari</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="pencarian_kode"
                                                   id="pencarian_kode" placeholder="Masukkan Nama atau No RM"
                                                   autocomplete="off">
                                            <input type="hidden" name="id_pasien" id='id_pasien'>
                                            <div id='hasil_pencarian'></div>
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="button" class="btn btn-primary" id="detail_pasien"><i
                                                        class="fa fa-pencil"></i> Detail
                                            </button>
                                        </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Rekam Medis</h3>&nbsp;&nbsp;

                    </div>
                    <!-- /.box-header -->
                    <?php $warning = $this->session->flashdata('warning');
                    if (!empty($warning)) { ?>
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                            </button>
                            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                            <?php echo $warning ?>
                        </div>
                    <?php } ?>
                    <?php $success = $this->session->flashdata('success');
                    if (!empty($success)) { ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                            </button>
                            <h4><i class="icon fa fa-check"></i> Success!</h4>
                            <?php echo $success ?>
                        </div>
                    <?php } ?>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>NO RM</th>
                                <th>Nama Pasien</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Usia</th>
                                <th>Jenis kelamin</th>
                                <th>Alamat</th>
                                <th>telepon</th>
                                <th>Pekerjaan</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1;
                            foreach ($pasien->result() as $row) { ?>
                                <tr>
                                    <td> <?php echo $no; ?></td>
                                    <td> <?php echo $row->no_rm; ?></td>
                                    <td> <?php echo ucwords($row->nama); ?></td>
                                    <td> <?php echo ucwords($row->tempat_lahir); ?></td>
                                    <td> <?php echo $row->tanggal_lahir; ?></td>
                                    <td> <?php echo ucwords($row->usia); ?></td>
                                    <td> <?php echo ucwords($row->jk); ?></td>
                                    <td> <?php echo ucwords($row->alamat); ?></td>
                                    <td> <?php echo ucwords($row->telepon); ?></td>
                                    <td> <?php echo ucwords($row->pekerjaan); ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>Laporan/RekamMedis/<?php echo $row->id; ?>">
                                            <button type="button" class="btn btn-primary"><i
                                                        class="fa fa-pencil"></i> Detail
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                <?php $no++;
                            } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
</div>

<script>

    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })

</script>

<script>

    $('#pencarian_kode').keypress((event) => {
        if (event.keyCode == 13) {
            event.preventDefault();
        }
    });
    $('#detail_pasien').click(() => {
        window.location.href = "<?=base_url()?>Laporan/RekamMedis/" + $('#id_pasien').val();
    });

    var timer = null;
    $(document).on('keyup', '#pencarian_kode', (e) => {
        clearTimeout(timer);
        timer = setTimeout(() => {
            if ($('#pencarian_kode').val() != '') {
                var charCode = (e.which) ? e.which : event.keyCode;

                if (charCode == 40) { //arrow down

                    if ($('.form-group').find('div#hasil_pencarian li.autocomplete_active').length > 0) {
                        var selanjutnya = $('.form-group').find('div#hasil_pencarian li.autocomplete_active').next();
                        $('.form-group').find('div#hasil_pencarian li.autocomplete_active').removeClass('autocomplete_active');
                        selanjutnya.addClass('autocomplete_active');
                    } else {
                        $('.form-group').find('div#hasil_pencarian li:first').addClass('autocomplete_active');
                    }
                } else if (charCode == 38) { //arrow up

                    if ($('.form-group').find('div#hasil_pencarian li.autocomplete_active').length > 0) {
                        var sebelumnya = $('.form-group').find('div#hasil_pencarian li.autocomplete_active').prev();
                        $('.form-group').find('div#hasil_pencarian li.autocomplete_active').removeClass('autocomplete_active');
                        sebelumnya.addClass('autocomplete_active');
                    } else {
                        $('.form-group').find('div#hasil_pencarian li:first').addClass('autocomplete_active');
                    }
                } else if (charCode == 13) { // enter

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
                } else {
                    var text = $('#form_cari').find('div#hasil_pencarian').html();
                    autoComplete($('#pencarian_kode').width(), $('#pencarian_kode').val());
                }
            } else {
                $('#form_cari').find('div#hasil_pencarian').hide();
            }
        }, 100);
    });

    $(document).on('click', '#daftar-autocomplete li', function () {
        $(this).parent().parent().parent().find('#pencarian_kode').val($(this).find('span#no_rmnya').html() + ' - ' + $(this).find('span#namanya').html());
        $(this).parent().parent().parent().find('#id_pasien').val($(this).find('span#kodenya').html());

        $('.form-group').find('#daftar-autocomplete').hide();
    });

    function autoComplete(Lebar, KataKunci) {
        let $hasil_pencarian = $('div#hasil_pencarian');
        $hasil_pencarian.hide();
        var Lebar = Lebar + 25;

        $.ajax({
            url: "<?php echo site_url('pendaftaran/ajax_kode'); ?>",
            type: "POST",
            cache: false,
            data: 'keyword=' + KataKunci,
            dataType: 'json',
            success: function (json) {
                if (json.status == 1) {
                    $hasil_pencarian.css({'width': Lebar + 'px'});
                    $hasil_pencarian.css({'display': 'block'});
                    $hasil_pencarian.show('fast');
                    $hasil_pencarian.html(json.datanya);
                }
                if (json.status == 0) {
                    $('#form_cari').find('div#hasil_pencarian').html('');
                }
            }
        });
    }
</script>

<script src="<?php echo base_url() ?>assets/bower_components/Flot/jquery.flot.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/Flot/jquery.flot.categories.js"></script>
