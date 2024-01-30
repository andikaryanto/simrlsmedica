<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/select2/dist/css/select2.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Detail User
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>Dashbord"><i class="fa fa-dashboard"></i> Dashbord</a></li>
            <li class="active">User</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Data User</h3>
                    </div>

                    <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url()?>FrontOffice/simpanUpdate">


                        <!-- Date dd/mm/yyyy -->

                        <div class="box-body">
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama" class="col-sm-4 control-label" >Nama</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $user->nama; ?>"  placeholder="Masukkan nama front office">
                                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $user->id; ?>"  placeholder="Masukkan nama front office">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="username" class="col-sm-4 control-label" >username</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $user->username; ?>"   placeholder="Masukkan username">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-4 control-label" >email</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $user->email; ?>"   placeholder="Masukkan email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-sm-4 control-label" >password</label>

                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" id="password" name="password" value="<?php echo $user->password_ori; ?>"   placeholder="Masukkan password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="telepon" class="col-sm-4 control-label">No. Telepon</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="telepon" name="telepon" value="<?php echo $user->telepon; ?>"  placeholder="Masukkan telepon front office">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">

                                        <div class="col-sm-8">
                                            <img src="<?php echo base_url(); ?>assets/img/profil/<?= isset($user->foto) && $user->foto != '' ? $user->foto : 'kss.png' ?>" class="avatar img-square img-thumbnail" alt="avatar">
                                        </div>
                                    </div><div class="form-group">

                                        <div class="col-sm-8">
                                            <input type="file" name="foto" id="exampleInputFile">
                                            <p class="help-block">Upload foto profil</p>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" name="submit" value="1" class="btn btn-primary btn-lg btn-flat pull-right">Update</button>
                            <a href="<?php echo base_url() ?>FrontOffice"  class="btn btn-default btn-lg btn-flat pull-right">Batal</a>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- InputMask -->
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<script type="text/javascript">

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()
</script>
