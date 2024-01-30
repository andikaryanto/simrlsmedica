<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Edit Persen Harga Jual Bahan Habis Pakai
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>Dashbord"><i class="fa fa-dashboard"></i> Dashbord</a></li>
            <li class="active">Edit Persen Harga Jual Bahan Habis Pakai</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Persen Harga Jual Bahan Habis Pakai</h3>
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
                    <form class="form-horizontal" method="post">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php foreach ($persen as $v) : ?>
                                        <div class="form-group">
                                            <label for="stok_obat" class="col-sm-4 control-label">Untung Harga Jual <?=$v->kategori?> (%)</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control"
                                                       value="<?php echo $v->prosentase; ?>" name="id-<?=$v->id?>"
                                                       placeholder="Masukkan prosentase <?=$v->kategori?>">
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="submit" value="1" class="btn btn-primary btn-lg btn-flat pull-right">Simpan</button>
                            <a href="<?php if ($is_pembelian) echo base_url().'Apotek/pembelian'; else echo base_url().'BahanHabisPakai/pembelian'; ?>"  class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
