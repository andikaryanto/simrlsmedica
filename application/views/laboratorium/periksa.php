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

                                <?php render($parents); ?>
                            </div>
                            <div class="box-footer">
                                <button type="submit" name="submit" value="1"
                                        class="btn btn-primary btn-lg btn-flat pull-right">Simpan
                                </button>
                                <a href="<?= base_url() ?>pemeriksaan/listpemeriksaanPasien"
                                   class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</form>

<?php function render($parents) { ?>
    <div class="row">
        <div class="box-body">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <?php
                        $i = 1;
                        foreach ($parents as $l) : ?>
                            <?php if ($l->id == 16) continue; ?>
                            <li <?=$i++ == 1 ? 'class="active"' : ''?>>
                                <a href="#tab_<?=$l->id?>" data-toggle="tab" class="padding-sm">
                                    <span style="font-size: 14px;"><?=$l->nama?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="tab-content">
                        <?php $i = 1; foreach ($parents as $p) : ?>
                            <?php if ($l->id == 16) continue; ?>
                            <div class="tab-pane <?=$i++ == 1 ? 'active' : ''?>" id="tab_<?=$p->id?>">
                                <h4 class="box-title text-center"><strong><?=$p->nama?></strong></h4>
                                <?php foreach ($p->children as $child) : ?>
                                    <div class="form-group">
                                        <label for="inputtext3" class="col-sm-3 control-label"><?=$child->nama?></label>
                                        <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                                            <input type="text" class="form-control" id="child_<?=$child->id?>" name="child_<?=$child->id?>" value="">
                                            <span class="input-group-addon"><?=$child->satuan?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<script>
    jQuery(function ($) {
        let id = <?= sizeof($layanan) > 0 ? $layanan[0]->id : '""' ?>;
        if (id === '') {
            return;
        }
        $('#tab_' + id).addClass('active');
    });
</script>
