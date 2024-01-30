<style>
    .padding-sm {
        padding: 5px !important;
    }
</style>


<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/iCheck/all.css">
<form class="form-horizontal" method="post" action="<?= base_url() ?>laboratorium/periksa/<?= $pemeriksaan['id'] ?>">
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Pemeriksaan Pasien
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= base_url() ?>Dashbord"><i class="fa fa-dashboard"></i> Dashbord</a></li>
                <li class="active">Pemeriksaan</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12'?>">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title"> No. Rekam Medis : <?= $pendaftaran['no_rm']; ?> </h3>
                        </div>
                        <div class="box-body">
                            <div class="box-body">
                                <input type="hidden" class="form-control" name="pendaftaran_id" id="pendaftran_id"
                                       value="<?= $pemeriksaan['id']; ?>">
                                <input type="hidden" class="form-control" name="dokter_id" id="dokter_id"
                                       value="<?= $pemeriksaan['dokter_id']; ?>">
                                <input type="hidden" class="form-control" name="kode_daftar" id="kode_daftar"
                                       value="<?= $pendaftaran['kode_daftar']; ?>">

                                <div class="form-group">
                                    <label for="nama_pasien" class="col-sm-3 control-label">Nama Pasien</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="nama_pasien" id="nama_pasien"
                                               value="<?= $pemeriksaan['nama_pasien'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="usia" class="col-sm-3 control-label">Usia</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="usia" id="usia"
                                               value="<?= $pendaftaran['usia'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="alamat" class="col-sm-3 control-label">Alamat</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="alamat" id="alamat"
                                               value="<?= $pendaftaran['alamat'] ?>" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php foreach (json_decode($pemeriksaan['hasil_lab']) as $parent) : ?>
                                            <h4 style="text-align: center"><strong><?=$parent->nama?></strong></h4>
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Layanan</th>
                                                    <th>Hasil</th>
                                                    <th>Nilai Rujukan</th>
                                                    <th>Satuan</th>
                                                    <th>Metode Periksa</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($parent->children as $child) : ?>
                                                    <tr>
                                                        <td><?=$child->nama?></td>
                                                        <td><?=$child->result?></td>
                                                        <td><?=$child->nilai_rujukan?></td>
                                                        <td><?=$child->satuan?></td>
                                                        <td></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                            </div>
                            <div class="box-footer">
                                <button onclick="window.history.go(-1); return false;"
                                   class="btn btn-default btn-lg btn-flat pull-right">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</form>

<script>
    jQuery(function ($) {
        for (let i = 1; i <= 20; i++) {
            $('#tab_' + i).css('display', 'none');
        }

        let layanan = <?=json_encode($layanan);?>;
        layanan.forEach(v => {
            $('#tab_' + v.id).css('display', 'block');
        });

        let hasil = JSON.parse(<?=json_encode($pemeriksaan['hasil_lab']);?>);
        for (let key of Object.keys(hasil)) {
            $('#' + key).val(hasil[key]);
        }
    });
</script>
