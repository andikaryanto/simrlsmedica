<?php
  $data = $this->session->userdata('logged_in');
 


 ?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url() ?>assets/img/profil/<?php echo $data->username; ?>.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $data->nama;  ?></p>
          <?php echo $data->nama_grup;  ?>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php if ($data->nama_grup == 'superadmin') {?>
     
       <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

         <li class="<?php echo $this->uri->segment(1) == 'dashboard' ? 'active' : ''; ?>">
          <a  href="<?php echo base_url();?>dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>         
          </a>
        </li>
       
        
         <li  class="treeview <?php echo ($this->uri->segment(1) == 'pendaftaran') ? 'active menu-open' : ''; ?>">
          <a href="#">
            <i class="fa  fa-user-plus"></i> <span>Pendaftaran Pasien</span> 
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo ($this->uri->segment(2) == 'listPendaftaranPasien') ? 'active' : ''; ?>"><a href="<?php echo base_url();?>pendaftaran/listPendaftaranPasien"><i class="fa fa-circle-o"></i> List Pendaftaran</a></li>
            <li class="<?php echo ($this->uri->segment(2) == 'pendaftaran_baru') ? 'active' : ''; ?>"><a href="<?php echo base_url();?>pendaftaran/pendaftaran_baru"><i class="fa fa-circle-o"></i> Pasien Baru</a></li>
            <li class="<?php echo ($this->uri->segment(2) == 'pendaftaran_lama') ? 'active' : ''; ?>"><a href="<?php echo base_url();?>pendaftaran/pendaftaran_lama"><i class="fa fa-circle-o"></i> Pasien Lama</a></li>
           
           
          </ul>
        </li>
         <li  class="treeview <?php echo ($this->uri->segment(1) == 'pemeriksaan') ? 'active menu-open' : ''; ?>">
          <a href="#">
            <i class="fa  fa-user-plus"></i> <span>Pemeriksaan Pasien</span> 
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo ($this->uri->segment(2) == 'listpemeriksaanPasien') ? 'active' : ''; ?>"><a href="<?php echo base_url();?>pemeriksaan/listpemeriksaanPasien"><i class="fa fa-circle-o"></i> List Pasien daftar</a></li>
            <li class="<?php echo ($this->uri->segment(2) == 'listPasienSelesaiPeriksa') ? 'active' : ''; ?>"><a href="<?php echo base_url();?>pemeriksaan/listPasienSelesaiPeriksa"><i class="fa fa-circle-o"></i>List Pasien sudah diperiksa</a></li>
            
           
           
          </ul>
        </li>
       
        <li class="treeview <?php echo ($this->uri->segment(1) == 'Pasien' || $this->uri->segment(1) == 'Dokter' || $this->uri->segment(1) == 'Perawat'|| $this->uri->segment(1) == 'Obat' || $this->uri->segment(1) == 'JenisPendaftaran') ? 'active menu-open' : ''; ?>">
          <a href="#">
            <i class="fa fa-list"></i> <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo $this->uri->segment(1) == 'Pasien' ? 'active' : ''; ?>"><a href="<?php echo base_url();?>Pasien"><i class="fa fa-circle-o"></i> Pasien</a></li>
            <li class="<?php echo $this->uri->segment(1) == 'Dokter' ? 'active' : ''; ?>"><a href="<?php echo base_url();?>Dokter"><i class="fa fa-circle-o"></i> Dokter</a></li>
            <li class="<?php echo $this->uri->segment(1) == 'Perawat' ? 'active' : ''; ?>"><a href="<?php echo base_url();?>Perawat"><i class="fa fa-circle-o"></i> Perawat</a></li>
            <li class="<?php echo $this->uri->segment(1) == 'Obat' ? 'active' : ''; ?>"><a href="<?php echo base_url();?>Obat"><i class="fa fa-circle-o"></i> Obat</a></li>
            <li class="<?php echo $this->uri->segment(1) == 'JenisPendaftaran' ? 'active' : ''; ?>"><a href="<?php echo base_url();?>JenisPendaftaran"><i class="fa fa-circle-o"></i> Jenis Pendaftaran</a></li>
          </ul>
        </li>
        
        
        <li class="<?php echo $this->uri->segment(1) == 'Administrasi' ? 'active' : ''; ?>">
          <a  href="<?php echo base_url();?>Administrasi/listPasienSelesaiPeriksa">
            <i class="fa fa-dollar"></i> <span>Administrasi Periksa</span>         
          </a>
        </li>
        <li>
          <a href="pages/widgets.html">
            <i class="fa fa-newspaper-o"></i> <span>Surat Ket. Sehat</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li>
         <li>
          <a href="pages/widgets.html">
            <i class="fa  fa-newspaper-o"></i> <span>Surat Ket. Sakit</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li>
         <li>
          <a href="pages/widgets.html">
            <i class="fa  fa-newspaper-o"></i> <span>Surat Ket. Maba</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li>
        <li>
          <a href="pages/widgets.html">
            <i class="fa fa-suitcase"></i> <span>Insentif Karyawan</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li>
        <li>
          <a href="pages/widgets.html">
            <i class="fa  fa-list-alt"></i> <span>Executive Summary</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Laba Rugi</span>
            <!-- <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span> -->
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Pemasukan</a></li>
            <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Pengeluaran</a></li>
            <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Laporan Laba Rugi</a></li>
            
          </ul>
        </li>
      
        <li class="<?php echo $this->uri->segment(1) == 'User' ? 'active' : ''; ?>">
          <a href="<?php echo base_url(); ?>User">
            <i class="fa  fa-user-plus"></i> <span>Pengaturan Akun</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>login/logout">
            <i class="fa  fa-sign-out"></i> <span>Log Out</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li>
       
       
       
     
     <?php } ?>

     <!-- ------------------------------------------------------------------------------------------------ -->
     <!-- ------------------------------------------------------------------------------------------------ -->

      <?php if ($data->nama_grup == 'dokter') {?>
       <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

         <li class="<?php echo $this->uri->segment(1) == 'dashboard' ? 'active' : ''; ?>">
          <a  href="<?php echo base_url();?>dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>         
          </a>
        </li>        
        
         <li  class="treeview <?php echo ($this->uri->segment(1) == 'pemeriksaan') ? 'active menu-open' : ''; ?>">
          <a href="#">
            <i class="fa  fa-user-plus"></i> <span>Pemeriksaan Pasien</span> 
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo ($this->uri->segment(2) == 'listpemeriksaanPasien') ? 'active' : ''; ?>"><a href="<?php echo base_url();?>pemeriksaan/listpemeriksaanPasien"><i class="fa fa-circle-o"></i> List Pasien daftar</a></li>
            <li class="<?php echo ($this->uri->segment(2) == 'listPasienSelesaiPeriksa') ? 'active' : ''; ?>"><a href="<?php echo base_url();?>pemeriksaan/listPasienSelesaiPeriksa"><i class="fa fa-circle-o"></i>List Pasien sudah diperiksa</a></li>
          </ul>
        </li>        

      
        <li>
          <a href="#">
            <i class="fa fa-newspaper-o"></i> <span>Surat Ket. Sehat</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li>
         <li>
          <a href="#">
            <i class="fa  fa-newspaper-o"></i> <span>Surat Ket. Sakit</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li>
         <li>
          <a href="#">
            <i class="fa  fa-newspaper-o"></i> <span>Surat Ket. Maba</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>login/logout">
            <i class="fa  fa-sign-out"></i> <span>Log Out</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li>
       
       
       
    <?php } ?>

    
    <!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
    <!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->

      <?php if ($data->nama_grup == 'perawat') {?>
       <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

         <li class="<?php echo $this->uri->segment(1) == 'dashboard' ? 'active' : ''; ?>">
          <a  href="<?php echo base_url();?>dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>         
          </a>
        </li>      
        
         <li  class="treeview <?php echo ($this->uri->segment(1) == 'pendaftaran') ? 'active menu-open' : ''; ?>">
          <a href="#">
            <i class="fa  fa-user-plus"></i> <span>Pendaftaran Pasien</span> 
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo ($this->uri->segment(2) == 'listPendaftaranPasien') ? 'active' : ''; ?>"><a href="<?php echo base_url();?>pendaftaran/listPendaftaranPasien"><i class="fa fa-circle-o"></i> List Pendaftaran</a></li>
            <li class="<?php echo ($this->uri->segment(2) == 'pendaftaran_baru') ? 'active' : ''; ?>"><a href="<?php echo base_url();?>pendaftaran/pendaftaran_baru"><i class="fa fa-circle-o"></i> Pasien Baru</a></li>
            <li class="<?php echo ($this->uri->segment(2) == 'pendaftaran_lama') ? 'active' : ''; ?>"><a href="<?php echo base_url();?>pendaftaran/pendaftaran_lama"><i class="fa fa-circle-o"></i> Pasien Lama</a></li>
           
           
          </ul>
        </li> 
         <li class="<?php echo $this->uri->segment(1) == 'Administrasi' ? 'active' : ''; ?>">
          <a  href="<?php echo base_url();?>Administrasi/listPasienSelesaiPeriksa">
            <i class="fa fa-dollar"></i> <span>Administrasi Periksa</span>         
          </a>
        </li>       
        
        
        <li>
          <a href="#">
            <i class="fa fa-newspaper-o"></i> <span>Surat Ket. Sehat</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li>
         <li>
          <a href="#">
            <i class="fa  fa-newspaper-o"></i> <span>Surat Ket. Sakit</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li>
         <li>
          <a href="#">
            <i class="fa  fa-newspaper-o"></i> <span>Surat Ket. Maba</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>login/logout">
            <i class="fa  fa-sign-out"></i> <span>Log Out</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li>
       
     <?php } ?>


     
     
        
     
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>