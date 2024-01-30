<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<style>
    .lbl-jmn {
        cursor: pointer;
    }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pasien Sudah Diperiksa
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">List Pasien Sudah Diperiksa</a></li>
            <li class="active"> Pasien</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Pasien Sudah Diperiksa</h3>&nbsp;&nbsp;

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
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>NO RM</th>
                                <th>Nama Pasien</th>
                                <th>Jenis Layanan</th>
                                <th>Tindakan</th>
                                <th>Obat</th>
                                <th>Obat Racikan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no=1;
                            foreach ($listPemeriksaan as $key => $row) { ?>
                                <tr>
                                    <td> <?php echo $no++; ?></td>
                                    <td style="width: 100px;" <?= $row->obat_luar ? 'bgcolor="#d9ffc4"' : '' ?>>
                                      <?php echo $row->no_rm; ?><br>
                                      <small>
                                          <?php
                                          if ($row->obat_luar) {
                                              if ($row->jaminan == 'resep_luar') {
                                                  $label = 'label-info';
                                                  $txt = 'Resep Luar';
                                              }
                                              else if ($row->jaminan == 'obat_bebas') {
                                                  $label = 'label-success';
                                                  $txt = 'Obat Bebas';
                                              }
                                              else {
                                                  $label = 'label-danger';
                                                  $txt = 'Obat Internal';
                                              }
                                              echo '<span class="label '.$label.'">'.$txt.'</span>';
                                          }
                                          else { ?>
                                              <span class="lbl-jmn label <?=$jaminan[$row->jaminan]['class']?>" onclick="change_jaminan(<?=$key?>, '<?=$row->jaminan?>')">
                                                  <?=$jaminan[$row->jaminan]['label']?>
                                              </span>
                                              <?php if (!isset($jaminan[$row->jaminan])) { ?>
                                                  <span class="lbl-jmn label label-warning" onclick="change_jaminan(<?=$key?>, '<?=$row->jaminan?>')">Umum</span>
                                              <?php } ?>
                                          <?php } ?>
                                      </small>
                                    </td>
                                    <td> <?php echo ucwords($row->nama_pasien); ?></td>
                                    <td> <?php echo ucwords($row->poli); ?></td>
                                    <td>
                                        <?php if (!$row->obat_luar) { ?>
                                            <table style="font-size: 10px">
                                                <thead>
                                                <tr>
                                                    <th> Tindakan</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                if($tindakan) {
                                                    foreach ($tindakan->result() as $row3) {
                                                        if($row->id == $row3->pemeriksaan_id){?>
                                                            <tr>

                                                                <td> <?php echo $row3->nama; ?></td>

                                                            </tr>
                                                        <?php }
                                                    }
                                                }
                                                else {?>
                                                    <tr>
                                                        <td bgcolor="lightblue" colspan="3"> Data Tidak ada</td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <table style="font-size: 10px">
                                            <thead>
                                            <tr>
                                                <th style="padding: 0px 5px;">Nama </th>
                                                <th style="padding: 0px 5px;">Signa </th>
                                                <th style="padding: 0px 5px;">jumlah</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if ($row->obat_luar) {
                                                if (isset($obat_luar)) {
                                                    foreach ($obat_luar as $row2) {
                                                        if($row->id == $row2->penjualan_obat_luar_id) { ?>
                                                            <tr>
                                                                <td style="padding: 0px 5px;"> <?php echo $row2->nama; ?></td>
                                                                <td style="padding: 0px 5px;"> <?php echo $row2->signa_obat; ?></td>
                                                                <td style="padding: 0px 5px;"> <?php echo $row2->jumlah_satuan; ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                else { ?>
                                                    <tr>
                                                        <td bgcolor="lightblue" colspan="3"> Data Tidak ada</td>
                                                    </tr>
                                                <?php }
                                            }
                                            else {
                                                if (isset($obat)) {
                                                    foreach ($obat->result() as $row2) {
                                                        if($row->id == $row2->pemeriksaan_id) { ?>
                                                            <tr>
                                                                <td style="padding: 0px 5px;"> <?php echo $row2->nama; ?></td>
                                                                <td style="padding: 0px 5px;"> <?php echo $row2->signa_obat; ?></td>
                                                                <td style="padding: 0px 5px;"> <?php echo $row2->jumlah_satuan; ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                else { ?>
                                                    <tr>
                                                        <td bgcolor="lightblue" colspan="3"> Data Tidak ada</td>
                                                    </tr>
                                                <?php }
                                            } ?>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <table style="font-size: 10px">
                                            <thead>
                                                <tr>
                                                    <th style="padding: 0px 5px;">Nama </th>
                                                    <th style="padding: 0px 5px;">Signa </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if ($row->obat_luar) { ?>
                                                <?php if ($racikan_luar) {
                                                    foreach ($racikan_luar as $row2) {
                                                        if ($row->id == $row2->penjualan_obat_luar_id) {?>
                                                            <tr>
                                                                <td style="padding: 0px 5px;"> <?php echo $row2->nama_racikan; ?></td>
                                                                <td style="padding: 0px 5px;"> <?php echo $row2->signa; ?></td>
                                                            </tr>
                                                        <?php }
                                                    }
                                                }
                                                else { ?>
                                                    <tr>
                                                        <td bgcolor="lightblue" colspan="3"> Data Tidak ada</td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($racikan) {
                                                    foreach ($racikan->result() as $row2) {
                                                        if ($row->id == $row2->pemeriksaan_id) {?>
                                                            <tr>
                                                                <td style="padding: 0px 5px;"> <?php echo $row2->nama_racikan; ?></td>
                                                                <td style="padding: 0px 5px;"> <?php echo $row2->signa; ?></td>
                                                            </tr>
                                                        <?php }
                                                    }
                                                }
                                                else { ?>
                                                    <tr>
                                                        <td bgcolor="lightblue" colspan="3"> Data Tidak ada</td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <span class="pull-right-container">
                                            <?php
                                            if ($row->status == 'sudah_obat') {
                                                $bg = 'bg-red';
                                                $status = 'sudah periksa & obat';
                                            }
                                            else if ($row->status == 'sudah_periksa') {
                                                $bg = 'bg-orange';
                                                $status = 'sudah periksa';
                                            }
                                            else if ($row->status == 'sudah_bayar') {
                                                $bg = 'bg-green';
                                                $status = 'sudah bayar';
                                            }
                                            else {
                                                $bg = 'bg-blue';
                                                $status = 'belum';
                                            }

                                            if ($row->obat_luar) {
                                                $bg = $row->progress == 'sudah_obat' ? 'bg-orange' : 'bg-blue';
                                                $status = 'belum bayar';
                                            }
                                            ?>
                                            <small class="label pull-right <?=$bg?>">
                                            <?= trim($status) ?>
                                            </small>
                                        </span>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row->obat_luar) : ?>
                                            <a href="<?php echo base_url(); ?>Administrasi/nota_obat_luar/<?php echo $row->id; ?>">
                                                <button type="button" class="btn btn-primary"><i class="fa fa-dollar"></i> Bayar</button>
                                            </a>
                                            <a href="<?php echo base_url(); ?>Administrasi/edit_obat_luar/<?php echo $row->id; ?>">
                                                <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</button>
                                            </a>
                                        <?php else : ?>
                                            <a href="<?php echo base_url(); ?>Administrasi/nota/<?php echo $row->id; ?>">
                                                <button type="button" class="btn btn-primary"><i class="fa fa-dollar"></i> Bayar</button>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="choose-jaminan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="display: flex">
                <h4 class="modal-title" style="flex: 1">Pilih Jenis Pendaftaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container" style="width: 100%">
                    <div class="row">
                        <div class="col-12">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>Nama Pasien</td>
                                    <td> : </td>
                                    <td id="nama_pasien"></td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <label for="inputtext3" class="control-label">Jenis Pendaftaran</label>
                                <select id="jaminan" class="abdush-select form-control" name="jaminan" style="width: 100%">
                                    <option value="">--Pilih Jenis Pendaftaran--</option>
                                    <?php foreach ($jaminan as $key => $value) { ?>
                                        <option value="<?= $key ?>"><?= $value['label'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="b-simpan-jenis">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#example1').DataTable();
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

    const list = <?=json_encode($listPemeriksaan)?>;
    let id = ''

    function change_jaminan(key, jaminan) {
        $('#jaminan').val(jaminan.toLowerCase()).change()
        $('#choose-jaminan').modal('show')
        const v = list[key]
        if (v) {
            $('#nama_pasien').html(v.nama_pasien)
            id = v.id
        }
    }

    $(function () {
        $('#b-simpan-jenis').click(function () {
            $('#choose-jaminan').modal('hide')
            window.open(`<?=base_url()?>/Pendaftaran/set_jenis/${id}/${$('#jaminan').val()}`,"_self")
        })
    })

</script>
