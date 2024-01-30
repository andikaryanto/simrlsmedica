<link rel="stylesheet"
      href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Riwayat Bahan Habis Pakai
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Riwayat Bahan Habis Pakai</a></li>
            <li class="active">Data Riwayat Bahan Habis Pakai</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-body">
                        <h5><i class='fa fa-file-text-o fa-fw'></i> Riwayat Bahan Habis Pakai</h5>
                        <hr/>

                        <form class="form-horizontal" method="get"
                              action="<?php echo base_url() ?>HistoryBahanHabisPakai/riwayat">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Bulan</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="bulan"
                                                        name="bulan">
                                                    <option value="1" <?php if (isset($bulan) && $bulan == "1") echo 'selected'; ?>>Januari</option>
                                                    <option value="2" <?php if (isset($bulan) && $bulan == "2") echo 'selected'; ?>>Februari</option>
                                                    <option value="3" <?php if (isset($bulan) && $bulan == "3") echo 'selected'; ?>>Maret</option>
                                                    <option value="4" <?php if (isset($bulan) && $bulan == "4") echo 'selected'; ?>>April</option>
                                                    <option value="5" <?php if (isset($bulan) && $bulan == "5") echo 'selected'; ?>>Mei</option>
                                                    <option value="6" <?php if (isset($bulan) && $bulan == "6") echo 'selected'; ?>>Juni</option>
                                                    <option value="7" <?php if (isset($bulan) && $bulan == "7") echo 'selected'; ?>>Juli</option>
                                                    <option value="8" <?php if (isset($bulan) && $bulan == "8") echo 'selected'; ?>>Agustus</option>
                                                    <option value="9" <?php if (isset($bulan) && $bulan == "9") echo 'selected'; ?>>September</option>
                                                    <option value="10" <?php if (isset($bulan) && $bulan == "10") echo 'selected'; ?>>Oktober</option>
                                                    <option value="11" <?php if (isset($bulan) && $bulan == "11") echo 'selected'; ?>>November</option>
                                                    <option value="12" <?php if (isset($bulan) && $bulan == "12") echo 'selected'; ?>>Desember</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Tahun</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="tahun" name="tahun">
                                                    <?php $year = intval(date('Y')); for ($a = $year; $a > $year - 5; $a--) { ?>
                                                    <option value="<?php echo $a; ?>" <?php if (isset($bulan) && $bulan == $a) echo 'selected'; ?>><?php echo $a; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class='row'>
                                <div class="col-sm-3">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col-sm-4"></div>
                                            <div class="col-sm-8">
                                                <button type="submit" class="btn btn-primary" style='margin-left: 0px;'>
                                                    Tampilkan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data List Riwayat Bahan Habis Pakai</h3>&nbsp;&nbsp;

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
                            <h4><i class="icon fa fa-success"></i> Success!</h4>
                            <?php echo $success ?>
                        </div>
                    <?php } ?>
                    <div class="box-body">
                        <div class="table-responsive">
                        <table id="printable_table_e" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th rowspan="2" style="vertical-align: middle">No</th>
                                <th rowspan="2" style="vertical-align: middle">Nama</th>
                                <th rowspan="2" style="vertical-align: middle">Harga Jual</th>
                                <th rowspan="2" style="vertical-align: middle">Harga Beli</th>

                                <?php for ($a = 1; $a <= $data['hari_akhir']; $a++) { ?>
                                    <th colspan="2"  style="text-align: center"><?php echo $a; ?></th>
                                <?php } ?>

                            </tr>
                            <tr>
                                <?php for ($a = 1; $a <= $data['hari_akhir']; $a++) { ?>
                                    <th>↓</th>
                                    <th>↑</th>
                                <?php } ?>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $no=1; foreach ($data['data'] as $row) { ?>

                                <tr>
                                    <td> <?php echo $no; ?></td>
                                    <td> <?php echo $row['bahan_habis_pakai']->nama; ?></td>
                                    <td nowrap style="text-align: right">Rp  <?php echo number_format($row['bahan_habis_pakai']->harga_jual, 2,',','.'); ?></td>
                                    <td nowrap style="text-align: right">Rp  <?php echo number_format($row['bahan_habis_pakai']->harga_beli, 2,',','.'); ?></td>

                                    <?php for ($a = 1; $a <= $data['hari_akhir']; $a++) { ?>
                                        <?php if (isset($row['history'][$a])) { ?>
                                            <td style="color: #57b747"><?php echo $row['history'][$a]['masuk']; ?></td>
                                            <td style="color: #a74242"><?php echo $row['history'][$a]['keluar']; ?></td>
                                        <?php } else { ?>
                                            <td style="background: #EEEEEE"></td>
                                            <td style="background: #EEEEEE"></td>
                                        <?php } ?>
                                    <?php } ?>

                                </tr>

                                <?php $no++; } ?>


                            </tbody>

                        </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>

<script>
    $(document).ready(function(){
        var table = $('#printable_table_e').DataTable({
            dom: "Bfrtip",
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: '<i class="fa fa-files-o"></i>',
                    titleAttr: 'Copy',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    titleAttr: 'Excel',
                    title: 'Data Persentase Untuk Klinik',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    titleAttr: 'PDF',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    titleAttr: 'Print',
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '10pt' );

                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size','inherit');
                    },
                    exportOptions: {
                        columns: ':visible'
                    }
                },
            ]
        });
        table.buttons().container().appendTo( '#printable_table_wrapper .col-md-6:eq(0)' );
    });
</script>