<?php
  $data = $this->session->userdata('logged_in');
  //print_r($data);die();


 ?>
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url() ?>Dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SC</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Smart Clinic</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown messages-menu">
                <a href="<?=base_url('/TV/farmasi')?>"
                   onclick="get_bed_status()">
                    <i class="fa fa-tv cal15"></i>
                    <span class="spanDM"> Antrian Farmasi</span>
                </a>
            </li>
            <li class="dropdown messages-menu">
                <a href="<?=base_url('/TV/poli')?>"
                   onclick="get_bed_status()">
                    <i class="fa fa-tv cal15"></i>
                    <span class="spanDM"> Antrian Poli</span>
                </a>
            </li>
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url(); ?>assets/img/profil/<?=$data->foto?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=$data->nama?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url(); ?>assets/img/profil/<?=$data->foto?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $data->nama;  ?> - <?php echo $data->nama_grup;  ?>
                  <!-- <small>Member since Nov. 2012</small> -->
                </p>
              </li>
              <!-- Menu Body -->
              <!-- <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div> -->
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url(); ?>user/detailuser/<?php echo $data->id?>" class="btn btn-default btn-flat">Profil</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('login/logout');?>" class="btn btn-default btn-flat">Log out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        <!--   <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>