<?php
$u = $this->session->userdata('logged_in');
?>
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">
<!-- Select2 -->

<div class="content-wrapper">

    <style type="text/css">
        .form-group {
            margin-bottom: 2px;
        }
    </style>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pendaftaran Pasien Lama
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>Dashbord"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Pendaftaran</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <form class="form-horizontal" method="post" action="<?php echo base_url() ?>pendaftaran/pendaftaran_lama">
                <input type="hidden" name="id_antrian" value="<?=$id_antrian?>">
                <div class="col-xs-12">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title">Data Pasien</h3>
                        </div>
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


                        <!-- Date dd/mm/yyyy -->

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama" class="col-sm-4 control-label">No RM</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="no_rm" name="no_rm"
                                                   value="<?php echo $pasien->no_rm; ?>"
                                                   placeholder="Masukkan no_rm pasien" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama" class="col-sm-4 control-label">Nama</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="nama"
                                                   value="<?php echo $pasien->nama; ?>" name="nama"
                                                   placeholder="Masukkan nama pasien" >
                                            <input type="hidden" class="form-control" id="id" name="id"
                                                   value="<?php echo $pasien->id; ?>"
                                                   placeholder="Masukkan nama pasien">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                            <label for="nama" class="col-sm-4 control-label">NIK</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="nik" name="nik"
                                                       value="<?php echo $pasien->nik; ?>"
                                                       placeholder="Masukkan NIK">
                                            </div>
                                        </div>
                                    <div class="form-group">
                                        <label for="tanggal_lahir" class="col-sm-4 control-label">Tanggal Lahir</label>

                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" id="tanggal_lahir"
                                                   name="tanggal_lahir" value="<?php echo $pasien->tanggal_lahir; ?>"
                                                   >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tempat_lahir" class="col-sm-4 control-label">Tempat Lahir</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="tempat_lahir"
                                                   name="tempat_lahir" value="<?php echo $pasien->tempat_lahir; ?>"
                                                   placeholder="masukkan tempat lahir pasien" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_kelamin" class="col-sm-4 control-label">Jenis Kelamin</label>
                                        <div class="col-sm-8">
                                            <label class="radio-inline"><input type="radio" value="L"
                                                                               name="jenis_kelamin"
                                                                               id="jenis_kelamin" <?= $pasien->jk == 'L' ? 'checked' : '' ?>>Laki
                                                - laki</label>
                                            <label class="radio-inline"><input type="radio" value="P"
                                                                               name="jenis_kelamin"
                                                                               id="jenis_kelamin" <?= $pasien->jk == 'P' ? 'checked' : '' ?>>Perempuan</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat" class="col-sm-4 control-label">Alamat (Sesuai KTP)</label>

                                        <div class="col-sm-8">
                                            <textarea type="text" class="form-control" id="alamat" name="alamat"
                                                      placeholder="Masukkan alamat pasien"
                                            ><?php echo $pasien->alamat; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat" class="col-sm-4 control-label">Alamat (Domisili / Surat)</label>

                                        <div class="col-sm-8">
                                            <textarea type="text" class="form-control" id="alamat_domisili" name="alamat_domisili"
                                                      placeholder="Masukkan alamat domisili pasien"
                                            ><?php echo $pasien->alamat_domisili; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telepon" class="col-sm-4 control-label">No. Telepon</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="telepon" name="telepon"
                                                   value="<?php echo $pasien->telepon; ?>"
                                                   placeholder="Masukkan telepon pasien" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="agama" class="col-sm-4 control-label">Agama</label>
                                        <div class="col-sm-8">
                                            <select class="form-control abdush-select" name="agama">
                                                <option value="">--Pilih Agama--</option>
                                                <option value="Islam" <?=$pasien->agama == 'Islam' ? 'selected' : ''?>>Islam</option>
                                                <option value="Kristen" <?=$pasien->agama == 'Kristen' ? 'selected' : ''?>>Kristen</option>
                                                <option value="Katholik" <?=$pasien->agama == 'Katholik' ? 'selected' : ''?>>Katholik</option>
                                                <option value="Hindu" <?=$pasien->agama == 'Hindu' ? 'selected' : ''?>>Hindu</option>
                                                <option value="Buddha" <?=$pasien->agama == 'Buddha' ? 'selected' : ''?>>Buddha</option>
                                                <option value="Konghucu" <?=$pasien->agama == 'Konghucu' ? 'selected' : ''?>>Konghucu</option>
                                                <option value="lainnya" <?=$pasien->agama == 'lainnya' ? 'selected' : ''?>>lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="pekerjaan" class="col-sm-4 control-label">Tingkat Pendidikan</label>
                                        <div class="col-sm-8">
                                            <select class="form-control abdush-select" name="pendidikan">
                                                <option value="">--Pilih Tingkat Pendidikan--</option>
                                                <option value="Tidak Sekolah" <?=$pasien->pendidikan == 'Tidak Sekolah' ? 'selected' : ''?>>Tidak Sekolah</option>
                                                <option value="SD" <?=$pasien->pendidikan == 'SD' ? 'selected' : ''?>>SD</option>
                                                <option value="SMP" <?=$pasien->pendidikan == 'SMP' ? 'selected' : ''?>>SMP</option>
                                                <option value="SMA" <?=$pasien->pendidikan == 'SMA' ? 'selected' : ''?>>SMA</option>
                                                <option value="Sarjana S1" <?=$pasien->pendidikan == 'Sarjana S1' ? 'selected' : ''?>>Sarjana S1</option>
                                                <option value="S2" <?=$pasien->pendidikan == 'S2' ? 'selected' : ''?>>S2</option>
                                                <option value="S3" <?=$pasien->pendidikan == 'S3' ? 'selected' : ''?>>S3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="pekerjaan" class="col-sm-4 control-label">Status Perkawinan</label>
                                        <div class="col-sm-8">
                                            <select class="form-control abdush-select" name="perkawinan">
                                                <option value="">--Pilih Status Perkawinan--</option>
                                                <option value="Sudah Menikah" <?=$pasien->perkawinan == 'Sudah Menikah' ? 'selected' : ''?>>Sudah Menikah</option>
                                                <option value="Belum Menikah" <?=$pasien->perkawinan == 'Belum Menikah' ? 'selected' : ''?>>Belum Menikah</option>
                                                <option value="Cerai" <?=$pasien->perkawinan == 'Cerai' ? 'selected' : ''?>>Cerai</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="pekerjaan" class="col-sm-4 control-label">Pekerjaan</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                                   value="<?php echo $pasien->pekerjaan; ?>"
                                                   placeholder="masukkan pekerjaan Pasien" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="penanggungjawab" class="col-sm-4 control-label">Penanggung
                                            Jawab</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="penanggungjawab"
                                                   name="penanggungjawab"
                                                   value="<?php echo $pendaftaran->penanggungjawab; ?>"
                                                   placeholder="Masukkan penanggung jawab dari pasien"
                                                   >
                                        </div>
                                    </div>
                                    <div class="form-group hidden">
                                        <label for="asuhan" class="col-sm-4 control-label">Catatan
                                            Alergi/Lainnya</label>

                                        <div class="col-sm-8">
                                            <input type="hidden" class="form-control" id="asuhan" name="asuhan"
                                                   value="<?php echo $pendaftaran->asuhan_keperawatan; ?>"
                                                   placeholder="Masukkan catatan alergi/lainnya" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_pendaftaran" class="col-sm-4 control-label">Tipe Layanan</label>

                                        <div class="col-sm-8">
                                            <select class="form-control abdush-select" name="tipe_layanan" id="tipe_layanan" required>
                                                <option value="">--Pilih Tipe Layanan--</option>
                                                <option value="1">Home Visit</option>
                                                <option value="2">On Site</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_pendaftaran" class="col-sm-4 control-label">Jenis Layanan</label>

                                        <div class="col-sm-8">
                                            <select class="form-control abdush-select" name="jenis_pendaftaran" id="poli"
                                                    required>
                                                <option value="">--Pilih Jenis Layanan--</option>
                                                <?php foreach ($jenis_pendaftaran->result() as $key => $value) {
                                                    ?>
                                                    <option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_pendaftaran" class="col-sm-4 control-label">Pilih Surat</label>
                                        <div class="col-sm-8">
                                            <select class="form-control abdush-select" name="surat">
                                                <option value="">--Pilih Surat (Opsional)--</option>
                                                <option value="sehat">Surat Keterangan Sehat</option>
                                                <option value="sakit">Surat Keterangan Sakit</option>
                                                <option value="consent">Surat Informed Consent</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_pendaftaran" class="col-sm-4 control-label">Sifat Kunjungan</label>
                                        <div class="col-sm-8">
                                            <select class="form-control abdush-select" name="sifat" required id="sifat">
                                                <option value="">--Pilih Sifat Kunjungan--</option>
                                                <option value="1">Rujukan</option>
                                                <option value="2">Non Rujukan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="rujukan">
                                        <label for="rujukan" class="col-sm-4 control-label">Rujukan</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="rujukan"
                                                   placeholder="Rujukan">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputtext3" class="col-sm-4 control-label">Jenis Pendaftaran</label>
                                        <div class="col-sm-8">
                                            <select id="jaminan" class="abdush-select form-control" name="jaminan" required>
                                                <option value="">--Pilih Jenis Pendaftaran--</option>
                                                <?php foreach ($jaminan as $key => $value) { ?>
                                                    <option value="<?= $key ?>" <?= $key == 'umum' ? 'selected' : '' ?>><?= $value['label'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="nomor">
                                        <label for="asuhan" class="col-sm-4 control-label">No</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="no_jaminan"
                                                   placeholder="Nomor">
                                        </div>
                                    </div>
                                    <div class="form-group" style="display: none">
                                        <label for="inputtext3" class="col-sm-4 control-label">Pilih Dokter</label>
                                        <input type="hidden" name="dokter" value="1">
                                        <div class="col-sm-8">
                                            <select class="form-control abdush-select">
                                                <option value="" selected>-- Pilih Dokter --</option>
                                                <?php foreach ($dokter->result() as $key => $value) {
                                                    ?>
                                                    <option value="<?php echo $value->id ?>"><?php echo $value->nama; ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_lahir" class="col-sm-4 control-label">Tanggal Pendaftaran</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" id="due_date" name="due_date" required value="<?=date('Y-m-d')?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="submit" value="1"
                                    class="btn btn-primary btn-lg btn-flat pull-right">Daftar
                            </button>
                            <a href="<?php echo base_url() ?>pendaftaran/listPendaftaranPasien"
                               class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /.box -->


            <div class="col-xs-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Riwayat Periksa</h3>&nbsp;&nbsp;

                    </div>

                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Periksa</th>
                                <th>Diagnosis Jenis Penyakit</th>
                                <th>Obat</th>
                                <th>Obat Racik</th>
                                <th>Tindakan</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 0;
                            foreach ($pemeriksaan as $row) {
                                $no++;
                                ?>
                                <tr>
                                    <td> <?php echo $no; ?></td>
                                    <td> <?php echo date('d-F-Y', strtotime($row->waktu_pemeriksaan)); ?></td>
                                    <!-- <td> <?php echo $row->no_rm; ?></td> -->
                                    <td>
                                        <table style="font-size: 10px;" class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Nama Penyakit</th>
                                                <th>Kode</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if ($penyakit) {

                                                foreach ($penyakit->result() as $row1) {
                                                    if ($row->id == $row1->pemeriksaan_id) {
                                                        ?>
                                                        <tr>
                                                            <td> <?php echo $row1->nama; ?></td>
                                                            <td> <?php echo $row1->kode; ?></td>
                                                        </tr>
                                                    <?php }
                                                }
                                            } else { ?>
                                                <tr>
                                                    <td bgcolor="lightblue" colspan="3"> Data Tidak ada</td>
                                                </tr>
                                            <?php } ?>

                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <table style="font-size: 10px;" class="table table-bordered">
                                            <thead>
                                            <tr>

                                                <th>Nama Obat</th>
                                                <th> signa</th>
                                                <th> jumlah</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if ($obat) {

                                                foreach ($obat->result() as $row2) {
                                                    if ($row->id == $row2->pemeriksaan_id) {
                                                        ?>
                                                        <tr>

                                                            <td> <?php echo $row2->nama; ?></td>
                                                            <td> <?php echo $row2->signa_obat; ?></td>
                                                            <td> <?php echo $row2->jumlah_satuan; ?></td>
                                                        </tr>
                                                    <?php }
                                                    $no++;
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td bgcolor="lightblue" colspan="3"> Data Tidak ada</td>
                                                </tr>
                                            <?php } ?>


                                            </tbody>

                                        </table>
                                    </td>
                                    <td>
                                        <table style="font-size: 10px;" class="table table-bordered">
                                            <thead>
                                            <tr>

                                                <th>Nama Obat</th>
                                                <th> Signa Obat</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if ($racikan) {

                                                foreach ($racikan->result() as $row4) {
                                                    if ($row->id == $row4->pemeriksaan_id) {
                                                        ?>
                                                        <tr>

                                                            <td> <?php echo $row4->nama_racikan; ?></td>
                                                            <td> <?php echo $row4->signa; ?></td>

                                                        </tr>
                                                    <?php }
                                                    $no++;
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td bgcolor="lightblue" colspan="3"> Data Tidak ada</td>
                                                </tr>
                                            <?php } ?>


                                            </tbody>

                                        </table>
                                    </td>
                                    <td>
                                        <table style="font-size: 10px;" class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Nama Tindakan</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php


                                            if ($tindakan) {

                                                foreach ($tindakan->result() as $row3) {
                                                    if ($row->id == $row3->pemeriksaan_id) {
                                                        ?>
                                                        <tr>

                                                            <td> <?php echo $row3->nama; ?></td>

                                                        </tr>
                                                    <?php }
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td bgcolor="lightblue" colspan="3"> Data Tidak ada</td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                            <?php } ?>


                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>


            <!-- /.col (right) -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>

<div class="modal modal-primary fade" id="modal-info">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Primary Modal</h4>
            </div>
            <div class="modal-body">
                <p>One fine body…</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script src="<?php echo base_url() ?>assets/plugins/autocomplete/ajax.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<script type="text/javascript">
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
    //Money Euro
    $('[data-mask]').inputmask()

    function set_bmi() {
        var tb = $('#tb').val();
        var bb = $('#bb').val();
        var tbm = tb / 100;
        var bmi = bb / (tbm * tbm);

        $('#bmi').val(bmi.toFixed(2));
    }

    $(function () {
        $('#nomor').hide();
        $('#jaminan').on('change', function (e) {
            if (this.value === 'umum' || this.value === '') {
                $('#nomor').hide();
            }
            else {
                $('#nomor').show();
            }
        });

        $('#rujukan').hide();
        $('#sifat').on('change', function (e) {
            if (this.value === '1') {
                $('#rujukan').show();
            }
            else {
                $('#rujukan').hide();
            }
        });
        // $('#poli').on('change', function() {
        //     $('.requirable').prop('required', this.value != 19);
        // });


    });

</script>
