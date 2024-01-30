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
            Data Resep
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Resep</a></li>
            <li class="active">Data Resep</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Resep</h3>&nbsp;&nbsp;
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
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>NO RM</th>
                                <th>Nama Pasien</th>
                                <th>Jenis Layanan</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            foreach ($listPendaftaran as $row) { ?>
                                <tr>
                                    <td> <?php echo $no; ?></td>
                                    <td style="width: 100px;" <?= isset($row->obat_luar) && $row->obat_luar ? 'bgcolor="#d9ffc4"' : '' ?>>
                                        <?php echo $row->no_rm; ?><br>
                                        <small>
                                            <?php
                                            if (isset($row->obat_luar) && $row->obat_luar) {
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
                                            ?>
                                        </small>
                                    </td>
                                    <td> <?php echo ucwords($row->nama_pasien); ?></td>
                                    <td> <?php echo ucwords($row->poli); ?></td>
                                    <td>
                                        <?php if (isset($row->obat_luar) && $row->obat_luar): ?>
                                            <a href="<?php echo base_url(); ?>Apotek/resep_nota_obat_luar/<?=$row->id?>"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>Detail</button></a>
                                        <?php else: ?>
                                            <a href="<?php echo base_url(); ?>Apotek/resep_nota/<?=$row->id?>"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>Detail</button></a>
                                        <?php endif; ?>
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

<div class="modal fade" id="modal-soap" role="dialog" aria-labelledby="formObat">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i class="fa fa-times-circle-o"></i> </button>
                <h4 class="modal-title">Isi SOAP Apoteker</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url('Apotek/isi_soap')?>">
                    <input type="hidden" name="isi_soap_id" id="isi_soap_id">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Subjective</label>
                                <textarea class="form-control" name="subjective" id="subjective" required></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Objective</label>
                                <textarea class="form-control" name="objective" id="objective" required></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Analysis</label>
                                <textarea class="form-control" name="analysis" id="analysis" required></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Planning</label>
                                <textarea class="form-control" name="planning" id="planning" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-telaah" role="dialog" aria-labelledby="formObat">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i class="fa fa-times-circle-o"></i> </button>
                <h4 class="modal-title">Isi Telaah Resep</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url('Apotek/isi_telaah')?>">
                    <input type="hidden" name="isi_telaah_id" id="isi_telaah_id">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="nama" class="control-label">Resep Lengkap</label>
                                <br>
                                <label style="font-weight: normal">
                                    <input type="radio" name="resep_lengkap" value="1" required checked> Ya
                                </label>
                                <label style="font-weight: normal; margin-left: 8px">
                                    <input type="radio" name="resep_lengkap" value="2" required> Tidak
                                </label>
                                <input type="text" name="resep_lengkap_tl" id="resep_lengkap_tl" class="form-control" placeholder="Tindak lanjut">
                            </div>
                            <div class="form-group">
                                <label for="nama" class="control-label">Pasien Sesuai</label>
                                <br>
                                <label style="font-weight: normal">
                                    <input type="radio" name="pasien_sesuai" value="1" required checked> Ya
                                </label>
                                <label style="font-weight: normal; margin-left: 8px">
                                    <input type="radio" name="pasien_sesuai" value="2" required> Tidak
                                </label>
                                <input type="text" name="pasien_sesuai_tl" id="pasien_sesuai_tl" class="form-control" placeholder="Tindak lanjut">
                            </div>
                            <div class="form-group">
                                <label for="nama" class="control-label">Nama Obat</label>
                                <br>
                                <label style="font-weight: normal">
                                    <input type="radio" name="nama_obat" value="1" required checked> Ya
                                </label>
                                <label style="font-weight: normal; margin-left: 8px">
                                    <input type="radio" name="nama_obat" value="2" required> Tidak
                                </label>
                                <input type="text" name="nama_obat_tl" id="nama_obat_tl" class="form-control" placeholder="Tindak lanjut">
                            </div>
                            <div class="form-group">
                                <label for="nama" class="control-label">Bentuk Sediaan</label>
                                <br>
                                <label style="font-weight: normal">
                                    <input type="radio" name="bentuk_sediaan" value="1" required checked> Ya
                                </label>
                                <label style="font-weight: normal; margin-left: 8px">
                                    <input type="radio" name="bentuk_sediaan" value="2" required> Tidak
                                </label>
                                <input type="text" name="bentuk_sediaan_tl" id="bentuk_sediaan_tl" class="form-control" placeholder="Tindak lanjut">
                            </div>
                            <div class="form-group">
                                <label for="nama" class="control-label">Dosis</label>
                                <br>
                                <label style="font-weight: normal">
                                    <input type="radio" name="dosis" value="1" required checked> Ya
                                </label>
                                <label style="font-weight: normal; margin-left: 8px">
                                    <input type="radio" name="dosis" value="2" required> Tidak
                                </label>
                                <input type="text" name="dosis_tl" id="dosis_tl" class="form-control" placeholder="Tindak lanjut">
                            </div>
                            <div class="form-group">
                                <label for="nama" class="control-label">Jumlah Obat</label>
                                <br>
                                <label style="font-weight: normal">
                                    <input type="radio" name="jumlah_obat" value="1" required checked> Ya
                                </label>
                                <label style="font-weight: normal; margin-left: 8px">
                                    <input type="radio" name="jumlah_obat" value="2" required> Tidak
                                </label>
                                <input type="text" name="jumlah_obat_tl" id="jumlah_obat_tl" class="form-control" placeholder="Tindak lanjut">
                            </div>
                            <div class="form-group">
                                <label for="nama" class="control-label">Aturan Pakai</label>
                                <br>
                                <label style="font-weight: normal">
                                    <input type="radio" name="aturan_pakai" value="1" required checked> Ya
                                </label>
                                <label style="font-weight: normal; margin-left: 8px">
                                    <input type="radio" name="aturan_pakai" value="2" required> Tidak
                                </label>
                                <input type="text" name="aturan_pakai_tl" id="aturan_pakai_tl" class="form-control" placeholder="Tindak lanjut">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="nama" class="control-label">Tepat Indikasi</label>
                                <br>
                                <label style="font-weight: normal">
                                    <input type="radio" name="tepat_indikasi" value="1" required checked> Ya
                                </label>
                                <label style="font-weight: normal; margin-left: 8px">
                                    <input type="radio" name="tepat_indikasi" value="2" required> Tidak
                                </label>
                                <input type="text" name="tepat_indikasi_tl" id="tepat_indikasi_tl" class="form-control" placeholder="Tindak lanjut">
                            </div>
                            <div class="form-group">
                                <label for="nama" class="control-label">Tepat Dosis</label>
                                <br>
                                <label style="font-weight: normal">
                                    <input type="radio" name="tepat_dosis" value="1" required checked> Ya
                                </label>
                                <label style="font-weight: normal; margin-left: 8px">
                                    <input type="radio" name="tepat_dosis" value="2" required> Tidak
                                </label>
                                <input type="text" name="tepat_dosis_tl" id="tepat_dosis_tl" class="form-control" placeholder="Tindak lanjut">
                            </div>
                            <div class="form-group">
                                <label for="nama" class="control-label">Tepat Waktu Penggunaan</label>
                                <br>
                                <label style="font-weight: normal">
                                    <input type="radio" name="tepat_waktu_penggunaan" value="1" required checked> Ya
                                </label>
                                <label style="font-weight: normal; margin-left: 8px">
                                    <input type="radio" name="tepat_waktu_penggunaan" value="2" required> Tidak
                                </label>
                                <input type="text" name="tepat_waktu_penggunaan_tl" id="tepat_waktu_penggunaan_tl" class="form-control" placeholder="Tindak lanjut">
                            </div>
                            <div class="form-group">
                                <label for="nama" class="control-label">Duplikasi Pengobatan</label>
                                <br>
                                <label style="font-weight: normal">
                                    <input type="radio" name="duplikasi_pengobatan" value="1" required checked> Ya
                                </label>
                                <label style="font-weight: normal; margin-left: 8px">
                                    <input type="radio" name="duplikasi_pengobatan" value="2" required> Tidak
                                </label>
                                <input type="text" name="duplikasi_pengobatan_tl" id="duplikasi_pengobatan_tl" class="form-control" placeholder="Tindak lanjut">
                            </div>
                            <div class="form-group">
                                <label for="nama" class="control-label">Alergi</label>
                                <br>
                                <label style="font-weight: normal">
                                    <input type="radio" name="alergi" value="1" required checked> Ya
                                </label>
                                <label style="font-weight: normal; margin-left: 8px">
                                    <input type="radio" name="alergi" value="2" required> Tidak
                                </label>
                                <input type="text" name="alergi_tl" id="alergi_tl" class="form-control" placeholder="Tindak lanjut">
                            </div>
                            <div class="form-group">
                                <label for="nama" class="control-label">Kontraindikasi</label>
                                <br>
                                <label style="font-weight: normal">
                                    <input type="radio" name="kontraindikasi" value="1" required checked> Ya
                                </label>
                                <label style="font-weight: normal; margin-left: 8px">
                                    <input type="radio" name="kontraindikasi" value="2" required> Tidak
                                </label>
                                <input type="text" name="kontraindikasi_tl" id="kontraindikasi_tl" class="form-control" placeholder="Tindak lanjut">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="nama" class="control-label">Telaah Obat</label>
                                <br>
                                <label style="font-weight: normal">
                                    <input type="radio" name="telaah_obat" value="1" required checked> Ya
                                </label>
                                <label style="font-weight: normal; margin-left: 8px">
                                    <input type="radio" name="telaah_obat" value="2" required> Tidak
                                </label>
                                <input type="text" name="telaah_obat_tl" id="telaah_obat_tl" class="form-control" placeholder="Tindak lanjut">
                            </div>
                            <div class="form-group">
                                <label for="nama" class="control-label">Nama Obat dengan Resep</label>
                                <br>
                                <label style="font-weight: normal">
                                    <input type="radio" name="nama_obat_dengan_resep" value="1" required checked> Ya
                                </label>
                                <label style="font-weight: normal; margin-left: 8px">
                                    <input type="radio" name="nama_obat_dengan_resep" value="2" required> Tidak
                                </label>
                                <input type="text" name="nama_obat_dengan_resep_tl" id="nama_obat_dengan_resep_tl" class="form-control" placeholder="Tindak lanjut">
                            </div>
                            <div class="form-group">
                                <label for="nama" class="control-label">Jumlah / Dosis Obat dengan Resep</label>
                                <br>
                                <label style="font-weight: normal">
                                    <input type="radio" name="jumlah_dosis_dengan_resep" value="1" required checked> Ya
                                </label>
                                <label style="font-weight: normal; margin-left: 8px">
                                    <input type="radio" name="jumlah_dosis_dengan_resep" value="2" required> Tidak
                                </label>
                                <input type="text" name="jumlah_dosis_dengan_resep_tl" id="jumlah_dosis_dengan_resep_tl" class="form-control" placeholder="Tindak lanjut">
                            </div>
                            <div class="form-group">
                                <label for="nama" class="control-label">Rute dengan Resep</label>
                                <br>
                                <label style="font-weight: normal">
                                    <input type="radio" name="rute_dengan_resep" value="1" required checked> Ya
                                </label>
                                <label style="font-weight: normal; margin-left: 8px">
                                    <input type="radio" name="rute_dengan_resep" value="2" required> Tidak
                                </label>
                                <input type="text" name="rute_dengan_resep_tl" id="rute_dengan_resep_tl" class="form-control" placeholder="Tindak lanjut">
                            </div>
                            <div class="form-group">
                                <label for="nama" class="control-label">Waktu & Frekuensi Pemberian</label>
                                <br>
                                <label style="font-weight: normal">
                                    <input type="radio" name="waktu_frekuensi_pemberian" value="1" required checked> Ya
                                </label>
                                <label style="font-weight: normal; margin-left: 8px">
                                    <input type="radio" name="waktu_frekuensi_pemberian" value="2" required> Tidak
                                </label>
                                <input type="text" name="waktu_frekuensi_pemberian_tl" id="waktu_frekuensi_pemberian_tl" class="form-control" placeholder="Tindak lanjut">
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
    });


    const list = <?=json_encode($listPendaftaran);?>;

    function open_soap(id) {
        $('#isi_soap_id').val(id)
        $('#modal-soap').modal('show')

        const x = list.find(v => +v.id === +id)
        if (x && x.soap_apoteker) {
            const soap = JSON.parse(x.soap_apoteker)
            $('#subjective').val(soap.subjective)
            $('#objective').val(soap.objective)
            $('#analysis').val(soap.analysis)
            $('#planning').val(soap.planning)
        }
        else {
            $('#subjective').val('')
            $('#objective').val('')
            $('#analysis').val('')
            $('#planning').val('')
        }
    }

    function open_telaah(id) {
        $('#isi_telaah_id').val(id)
        $('#modal-telaah').modal('show')

        const x = list.find(v => +v.id === +id)
        if (x && x.telaah) {
            const y = JSON.parse(x.telaah)

            $(`input:radio[name="resep_lengkap"][value="${y.resep_lengkap}"]`).prop('checked', true)
            $('#resep_lengkap_tl').val(y.resep_lengkap_tl)
            $(`input:radio[name="pasien_sesuai"][value="${y.pasien_sesuai}"]`).prop('checked', true)
            $('#pasien_sesuai_tl').val(y.pasien_sesuai_tl)
            $(`input:radio[name="nama_obat"][value="${y.nama_obat}"]`).prop('checked', true)
            $('#nama_obat_tl').val(y.nama_obat_tl)
            $(`input:radio[name="bentuk_sediaan"][value="${y.bentuk_sediaan}"]`).prop('checked', true)
            $('#bentuk_sediaan_tl').val(y.bentuk_sediaan_tl)
            $(`input:radio[name="dosis"][value="${y.dosis}"]`).prop('checked', true)
            $('#dosis_tl').val(y.dosis_tl)
            $(`input:radio[name="jumlah_obat"][value="${y.jumlah_obat}"]`).prop('checked', true)
            $('#jumlah_obat_tl').val(y.jumlah_obat_tl)
            $(`input:radio[name="aturan_pakai"][value="${y.aturan_pakai}"]`).prop('checked', true)
            $('#aturan_pakai_tl').val(y.aturan_pakai_tl)
            $(`input:radio[name="tepat_indikasi"][value="${y.tepat_indikasi}"]`).prop('checked', true)
            $('#tepat_indikasi_tl').val(y.tepat_indikasi_tl)
            $(`input:radio[name="tepat_dosis"][value="${y.tepat_dosis}"]`).prop('checked', true)
            $('#tepat_dosis_tl').val(y.tepat_dosis_tl)
            $(`input:radio[name="tepat_waktu_penggunaan"][value="${y.tepat_waktu_penggunaan}"]`).prop('checked', true)
            $('#tepat_waktu_penggunaan_tl').val(y.tepat_waktu_penggunaan_tl)
            $(`input:radio[name="duplikasi_pengobatan"][value="${y.duplikasi_pengobatan}"]`).prop('checked', true)
            $('#duplikasi_pengobatan_tl').val(y.duplikasi_pengobatan_tl)
            $(`input:radio[name="alergi"][value="${y.alergi}"]`).prop('checked', true)
            $('#alergi_tl').val(y.alergi_tl)
            $(`input:radio[name="kontraindikasi"][value="${y.kontraindikasi}"]`).prop('checked', true)
            $('#kontraindikasi_tl').val(y.kontraindikasi_tl)
            $(`input:radio[name="telaah_obat"][value="${y.telaah_obat}"]`).prop('checked', true)
            $('#telaah_obat_tl').val(y.telaah_obat_tl)
            $(`input:radio[name="nama_obat_dengan_resep"][value="${y.nama_obat_dengan_resep}"]`).prop('checked', true)
            $('#nama_obat_dengan_resep_tl').val(y.nama_obat_dengan_resep_tl)
            $(`input:radio[name="jumlah_dosis_dengan_resep"][value="${y.jumlah_dosis_dengan_resep}"]`).prop('checked', true)
            $('#jumlah_dosis_dengan_resep_tl').val(y.jumlah_dosis_dengan_resep_tl)
            $(`input:radio[name="rute_dengan_resep"][value="${y.rute_dengan_resep}"]`).prop('checked', true)
            $('#rute_dengan_resep_tl').val(y.rute_dengan_resep_tl)
            $(`input:radio[name="waktu_frekuensi_pemberian"][value="${y.waktu_frekuensi_pemberian}"]`).prop('checked', true)
            $('#waktu_frekuensi_pemberian_tl').val(y.waktu_frekuensi_pemberian_tl)
        } else {
            $(`input:radio[name="resep_lengkap"][value="1"]`).prop('checked', true)
            $('#resep_lengkap_tl').val('')
            $(`input:radio[name="pasien_sesuai"][value="1"]`).prop('checked', true)
            $('#pasien_sesuai_tl').val('')
            $(`input:radio[name="nama_obat"][value="1"]`).prop('checked', true)
            $('#nama_obat_tl').val('')
            $(`input:radio[name="bentuk_sediaan"][value="1"]`).prop('checked', true)
            $('#bentuk_sediaan_tl').val('')
            $(`input:radio[name="dosis"][value="1"]`).prop('checked', true)
            $('#dosis_tl').val('')
            $(`input:radio[name="jumlah_obat"][value="1"]`).prop('checked', true)
            $('#jumlah_obat_tl').val('')
            $(`input:radio[name="aturan_pakai"][value="1"]`).prop('checked', true)
            $('#aturan_pakai_tl').val('')
            $(`input:radio[name="tepat_indikasi"][value="1"]`).prop('checked', true)
            $('#tepat_indikasi_tl').val('')
            $(`input:radio[name="tepat_dosis"][value="1"]`).prop('checked', true)
            $('#tepat_dosis_tl').val('')
            $(`input:radio[name="tepat_waktu_penggunaan"][value="1"]`).prop('checked', true)
            $('#tepat_waktu_penggunaan_tl').val('')
            $(`input:radio[name="duplikasi_pengobatan"][value="1"]`).prop('checked', true)
            $('#duplikasi_pengobatan_tl').val('')
            $(`input:radio[name="alergi"][value="1"]`).prop('checked', true)
            $('#alergi_tl').val('')
            $(`input:radio[name="kontraindikasi"][value="1"]`).prop('checked', true)
            $('#kontraindikasi_tl').val('')
            $(`input:radio[name="telaah_obat"][value="1"]`).prop('checked', true)
            $('#telaah_obat_tl').val('')
            $(`input:radio[name="nama_obat_dengan_resep"][value="1"]`).prop('checked', true)
            $('#nama_obat_dengan_resep_tl').val('')
            $(`input:radio[name="jumlah_dosis_dengan_resep"][value="1"]`).prop('checked', true)
            $('#jumlah_dosis_dengan_resep_tl').val('')
            $(`input:radio[name="rute_dengan_resep"][value="1"]`).prop('checked', true)
            $('#rute_dengan_resep_tl').val('')
            $(`input:radio[name="waktu_frekuensi_pemberian"][value="1"]`).prop('checked', true)
            $('#waktu_frekuensi_pemberian_tl').val('')

        }
    }
</script>
