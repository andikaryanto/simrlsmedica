<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<style>
    table.bor, th.bor, td.bor {
        font-size: 12px;
        border: 1px solid #e5e5e5;
    }
    th, td {
        padding: 0px 5px;
    }
    td.cat {
        min-width: 100px;
        max-width: 300px;
    }
    td.no-data {
        padding: 5px;
        text-align: center;
    }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Rekapitulasi Resep
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Resep</a></li>
            <li class="active">Data Rekapitulasi Resep</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Rekapitulasi Resep</h3>&nbsp;&nbsp;
                    </div>
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
                        <table id="printable_table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NO RM</th>
                                    <th>Tgl Pemeriksaan</th>
                                    <th>Nama Pasien</th>
                                    <th>Nama Dokter</th>
                                    <th>Obat</th>
                                    <th>Obat Racikan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            foreach ($listPendaftaran as $row) { ?>
                                <tr>
                                    <td> <?php echo $no; ?></td>
                                    <td> <?php echo $row->no_rm; ?></td>
                                    <td> <?php echo date('d-F-Y H:i', strtotime($row->waktu_pemeriksaan)); ?></td>
                                    <td> <?php echo ucwords($row->nama_pasien); ?></td>
                                    <td> <?php echo ucwords($row->nama_dokter); ?></td>
                                    <!-- ######################### OBAT ######################### -->
                                    <td>
                                        <table style="font-size: 12px">
                                            <thead>
                                            <tr>
                                                <th style="padding: 0px 5px;">Nama </th>
                                                <th style="padding: 0px 5px;">Signa </th>
                                                <th style="padding: 0px 5px;">jumlah</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if($obat) {
                                                foreach ($obat->result() as $row2) {
                                                    if($row->id == $row2->pemeriksaan_id) { ?>
                                                        <tr>
                                                            <td style="padding: 0px 5px;"> <?php echo $row2->nama; ?></td>
                                                            <td style="padding: 0px 5px;"> <?php echo $row2->signa_obat; ?></td>
                                                            <td style="padding: 0px 5px;" class="pull-right"> <?php echo $row2->jumlah_satuan; ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                            }
                                            else { ?>
                                                <tr>
                                                    <td bgcolor="lightblue" colspan="3"> Data Tidak ada</td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </td>
                                    <!-- ######################### OBAT RACIKAN ######################### -->
                                    <td>
                                        <table class="bor">
                                            <thead>
                                            <tr>
                                                <th class="bor">Nama </th>
                                                <th class="bor">Signa </th>
                                                <th class="bor">Obat </th>
                                                <th class="bor">Catatan </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if(!empty($row->racikans)) {
                                                foreach ($row->racikans as $row2) { ?>
                                                    <tr>
                                                        <td class="bor" valign="top"> <?php echo $row2->nama_racikan; ?></td>
                                                        <td class="bor" valign="top"> <?php echo $row2->signa; ?></td>
                                                        <td class="bor">
                                                            <table>
                                                                <tbody>
                                                                <?php foreach ($row2->racikan as $v) { ?>
                                                                    <tr>
                                                                        <td><?=$v->nama?></td>
                                                                        <td><?=$v->jumlah_satuan?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        <td class="bor cat" valign="top"> <?php echo $row2->catatan; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            else { ?>
                                                <tr>
                                                    <td class="no-data" bgcolor="#FEFFEF" colspan="4"> Data Tidak ada</td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <a target="_blank" href="<?php echo base_url(); ?>Apotek/cetak_resep/<?php echo $row->id; ?>" class="btn btn-success btn-sm">
                                            <i class="fa fa-print"></i> Cetak
                                        </a>
                                        <div style="height: 4px"></div>
                                        <a target="_blank" href="<?php echo base_url(); ?>Apotek/cetak_soap/<?php echo $row->id; ?>" class="btn btn-warning btn-sm">
                                            <i class="fa fa-print"></i> Cetak SOAP
                                        </a>
                                        <div style="height: 4px"></div>
                                        <a target="_blank" href="<?php echo base_url(); ?>Apotek/cetak_telaah/<?php echo $row->id; ?>" class="btn btn-danger btn-sm">
                                            <i class="fa fa-print"></i> Cetak Telaah
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            $no++;
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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