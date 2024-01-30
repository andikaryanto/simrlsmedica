<!DOCTYPE html>
<html>
<!-- HEAD-->
<?php echo $head; ?>
<!-- HEAD CLOSE-->


<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <!-- header -->
      <?php echo $header; ?>
      <!-- ./header -->
  <!-- //////////////////////////////////////////////////////////////////////////// -->
      
      <!-- Left side column. contains the logo and sidebar -->
<?php echo $sidebar; ?>
      <!-- Left side column. contains the logo and sidebar -->
   <!-- //////////////////////////////////////////////////////////////////////////// -->    

      <!-- Content Wrapper. Contains page content -->
      <?php echo $content; ?>
      <!-- /.content-wrapper -->
       <?php echo $footer; ?>

    <!-- //////////////////////////////////////////////////////////////////////////// -->  

      <!-- Control Sidebar -->
      <!-- Right Sidebar -->
<?php echo $right_sidebar; ?>
      <!-- Right Sidebar -->
      <!-- /.control-sidebar -->

     <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div>
<!-- ./wrapper -->

<!-- js -->
  <?php echo $footer_js; ?>

<!-- ./js -->

</body>
</html>
