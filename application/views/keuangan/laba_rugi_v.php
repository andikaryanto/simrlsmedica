<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Laba Rugi
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Master</a></li>
            <li class="active">Data Laba Rugi</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <form class="form-horizontal" method="get" action="<?php echo base_url()?>Keuangan/labaRugi">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Dari Tanggal</label>
                                            <div class="col-sm-8">
                                                <input type='date' name='from' class='form-control' id='tanggal_dari' value="<?php echo ($this->input->get('from')) ? $this->input->get('from') : date('Y-m-01') ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Sampai Tanggal</label>
                                            <div class="col-sm-8">
                                                <input type='date' name='to' class='form-control' id='tanggal_sampai' value="<?php echo ($this->input->get('to')) ? $this->input->get('to') : date('Y-m-d') ?>">
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
                                                <button type="submit" class="btn btn-primary" style='margin-left: 0px;'>Tampilkan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <br/>
                        <h3 class="box-title">Pemasukan</h3>&nbsp;&nbsp;
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td colspan="2" class="bg-primary text-white" align="center"><strong> Jasa Medis </strong></td>
                                </tr>
                                <tr>
                                    <th>Item</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_pemasukan = 0;
                                foreach ($total_jasa_medis->result() as $row) { ?>
                                    <tr>
                                        <td> <?php echo ucwords($row->jenis_pendaftaran); ?></td>
                                        <td align="right"> <?php echo  number_format($row->total,2,',','.'); ?></td>
                                    </tr>
                                    <?php
                                    $total_pemasukan = $total_pemasukan + $row->total;
                                } ?>
                                <tr >
                                    <td align="right"><strong>Total Jasa Medis : </strong></td>
                                    <td align="right"><strong><?php echo number_format($total_pemasukan,2,',','.'); ?></strong></td>
                                </tr>
                                <tr><td colspan="2"></td></tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <td colspan="2" class="bg-primary text-white" align="center"><strong> Penjualan Obat </strong></td>
                                </tr>
                                <tr>
                                    <th>Item</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_pemasukan = 0;
                                foreach ($total_obat->result() as $row) { ?>
                                    <tr>
                                        <td> <?php echo ucwords($row->jenis_pendaftaran); ?></td>
                                        <td align="right"> <?php echo  number_format($row->total,2,',','.'); ?></td>
                                    </tr>
                                    <?php
                                    $total_pemasukan = $total_pemasukan + $row->total;
                                } ?>
                                <tr >
                                    <td align="right"><strong>Total Penjualan Obat : </strong></td>
                                    <td align="right"><strong><?php echo number_format($total_pemasukan,2,',','.'); ?></strong></td>
                                </tr>
                                <tr><td colspan="2"></td></tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <td colspan="2" class="bg-primary text-white" align="center"><strong> Penjualan Obat Racik </strong></td>
                                </tr>
                                <tr>
                                    <th>Item</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_pemasukan = 0;
                                foreach ($total_obat_racikan->result() as $row) { ?>
                                    <tr>
                                        <td> <?php echo ucwords($row->jenis_pendaftaran); ?></td>
                                        <td align="right"> <?php echo  number_format($row->total,2,',','.'); ?></td>
                                    </tr>
                                    <?php
                                    $total_pemasukan = $total_pemasukan + $row->total;
                                } ?>
                                <tr >
                                    <td align="right"><strong>Total Penjualan Obat Racik : </strong></td>
                                    <td align="right"><strong><?php echo number_format($total_pemasukan,2,',','.'); ?></strong></td>
                                </tr>
                                <tr><td colspan="2"></td></tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <td colspan="2" class="bg-primary text-white" align="center"><strong> Jasa Obat Racik </strong></td>
                                </tr>
                                <tr>
                                    <th>Item</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_pemasukan = 0;
                                foreach ($total_jasa_racik->result() as $row) { ?>
                                    <tr>
                                        <td> <?php echo ucwords($row->jenis_pendaftaran); ?></td>
                                        <td align="right"> <?php echo  number_format($row->total,2,',','.'); ?></td>
                                    </tr>
                                    <?php
                                    $total_pemasukan = $total_pemasukan + $row->total;
                                } ?>
                                <tr >
                                    <td align="right"><strong>Total Jasa Obat Racik : </strong></td>
                                    <td align="right"><strong><?php echo number_format($total_pemasukan,2,',','.'); ?></strong></td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <td colspan="2" class="bg-primary text-white" align="center"><strong> Penjualan Obat Non Pemeriksaan </strong></td>
                                </tr>
                                <tr>
                                    <th>Item</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_pemasukan = 0;
                                foreach ($total_obat_resep_luar->result() as $row) { ?>
                                    <tr>
                                        <td> <?php echo ucwords(str_replace('_', ' ', $row->tipe)); ?></td>
                                        <td align="right"> <?php echo  number_format($row->total,2,',','.'); ?></td>
                                    </tr>
                                    <?php
                                    $total_pemasukan = $total_pemasukan + $row->total;
                                } ?>
                                <tr >
                                    <td align="right"><strong>Total Penjualan Obat Non Pemeriksaan : </strong></td>
                                    <td align="right"><strong><?php echo number_format($total_pemasukan,2,',','.'); ?></strong></td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <td colspan="2" class="bg-primary text-white" align="center"><strong> Bahan Habis Pakai </strong></td>
                                </tr>
                                <tr>
                                    <th>Item</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_pemasukan = 0;
                                foreach ($total_bahan_habis_pakai->result() as $row) { ?>
                                    <tr>
                                        <td> <?php echo ucwords($row->jenis_pendaftaran); ?></td>
                                        <td align="right"> <?php echo  number_format($row->total,2,',','.'); ?></td>
                                    </tr>
                                    <?php
                                    $total_pemasukan = $total_pemasukan + $row->total;
                                } ?>
                                <tr >
                                    <td align="right"><strong>Total Bahan Habis Pakai : </strong></td>
                                    <td align="right"><strong><?php echo number_format($total_pemasukan,2,',','.'); ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header"><br/>
                        <h3 class="box-title">Pengeluaran</h3>&nbsp;&nbsp;
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td colspan="2" class="bg-primary text-white" align="center"><strong> Insentif Dokter </strong></td>
                                </tr>
                                <tr>
                                    <th>Item</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_pemasukan = 0;
                                foreach ($insentif_dokter->result() as $row) { ?>
                                    <tr>
                                        <td> <?php echo ucwords($row->nama); ?></td>
                                        <td align="right"> <?php echo  number_format($row->total_insentif,2,',','.'); ?></td>
                                    </tr>
                                    <?php
                                    $total_pemasukan = $total_pemasukan + $row->total_insentif;
                                } ?>
                                <tr >
                                    <td align="right"><strong>Total Jasa Medis : </strong></td>
                                    <td align="right"><strong><?php echo number_format($total_pemasukan,2,',','.'); ?></strong></td>
                                </tr>
                                <tr><td colspan="2"></td></tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <td colspan="2" class="bg-primary text-white" align="center"><strong> Insentif Perawat </strong></td>
                                </tr>
                                <tr>
                                    <th>Item</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_pemasukan = 0;
                                foreach ($insentif_perawat->result() as $row) { ?>
                                    <tr>
                                        <td> <?php echo ucwords($row->nama); ?></td>
                                        <td align="right"> <?php echo  number_format($row->total_insentif,2,',','.'); ?></td>
                                    </tr>
                                    <?php
                                    $total_pemasukan = $total_pemasukan + $row->total_insentif;
                                } ?>
                                <tr >
                                    <td align="right"><strong>Total Penjualan Obat : </strong></td>
                                    <td align="right"><strong><?php echo number_format($total_pemasukan,2,',','.'); ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
</script>
