<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data List Pasien
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">List Pasien</a></li>
            <li class="active">Data List Pasien</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php foreach($jenis_pendaftaran as $jp) : ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Data Pasien Belum Pemeriksaan Awal - <?=$jp->jenis_pendaftaran?></h3>&nbsp;&nbsp;

                        </div>
                        <!-- /.box-header -->
                        <?php $warning = $this->session->flashdata('warning');
                        if (!empty($warning)){ ?>
                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                                <?php echo $warning ?>
                            </div>
                        <?php } ?>
                        <?php $success = $this->session->flashdata('success');
                        if (!empty($success)){ ?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-check"></i> Success!</h4>
                                <?php echo $success ?>
                            </div>
                        <?php } ?>
                        <div class="box-body">
                            <table class="table table-bordered table-hover example2">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NO RM</th>
                                    <th>Nama Pasien</th>
                                    <th>Alamat</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Jenis Pendaftaran</th>
<!--                                    <th>Nama Dokter</th>-->
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no=1; foreach ($jp->list as $row) { ?>
                                    <tr>
                                        <td> <?php echo $no; ?></td>
                                        <td style="width:100px;">
                                            <?php echo $row->no_rm; ?><br>
                                            <small>
                                                <span class="label <?=$jaminan[$row->jaminan]['class']?>"><?=$jaminan[$row->jaminan]['label']?></span>
                                                <?php if (!isset($jaminan[$row->jaminan])) { ?>
                                                    <span class="label label-warning">Umum</span>
                                                <?php } ?>
                                            </small>
                                        </td>
                                        <td> <?php echo ucwords($row->nama_pasien); ?></td>
                                        <td> <?php echo ucwords($row->alamat); ?></td>
                                        <td> <?php echo date('d-F-Y', strtotime($row->waktu_pendaftaran)); ?></td>
                                        <td> <?php echo ucwords($row->jenis_pendaftaran); ?></td>
<!--                                        <td> --><?php //echo ucwords($row->nama_dokter); ?><!--</td>-->
                                        <td>
                                        <span class="pull-right-container">
                                            <small class="label pull-right <?=$row->sudah_periksa_perawat ? 'bg-green' : 'label-danger'?>">
                                                <?php echo $row->sudah_periksa_perawat ? 'Sudah Diperiksa' : 'Belum Diperiksa' ?>
                                            </small>
                                        </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-bars"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <button onclick="panggil(<?=$row->antrian_id?>, '<?=$row->kode_antrian?>', '<?=$row->jenis_pendaftaran?>')"
                                                            class=" btn btn-sm btn-block btn-success"
                                                            style="margin-bottom: 5px;">
                                                        <i class="fa fa-volume-up"></i> Panggil
                                                    </button>
                                                    <a href="<?php  echo base_url(); ?>PemeriksaanAwal/periksa/<?php echo $row->id; ?>">
                                                        <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-pencil"></i> Periksa</button>
                                                    </a>
                                                    <div style="height: 8px"></div>
                                                    <a href="<?php echo base_url(); ?>PemeriksaanAwal/hapus/<?php echo $row->id; ?>"
                                                       onclick="return confirm('Yakin hapus data pemeriksaan ini?')"
                                                       class="btn btn-sm btn-block btn-danger" style="margin-bottom: 5px;">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $no++; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" id="tess"></div>
            </div>
        <?php endforeach; ?>
    </section>
</div>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
            </div>
            <div class="modal-body">
                <div class="col-xs-12" id="tess">

                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    $(function () {
        $('#example1').DataTable()
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

    function tes(id){
        var jum_data = <?php echo count($listPendaftaran->result()); ?>;
//alert(jum_data);


        $.ajax({
            url: "<?php echo site_url('pemeriksaan/detail'); ?>",
            type: "GET",
            cache: false,
            data:{"id_pasien": id},
            dataType:'html',
            success: function (result) {



                $('#tess').html(result);
                $('#modal-default').show;

            }
        });


    }



</script>
