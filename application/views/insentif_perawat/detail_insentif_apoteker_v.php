<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data List Insentif Apoteker
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="#">List insentif Apoteker</a></li>
      <li class="active">Data List insentif Apoteker</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data List Insentif Apoteker</h3>&nbsp;&nbsp;

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
                          <th>Nama Apoteker</th>
                          <th>Tanggal</th>
                          <th>NO. RM</th>
                          <th>Insentif</th>

                      </tr>
                  </thead>



                  <tbody>
                      <?php $no=1; foreach ($listInsentif as $row) { ?>

                      <tr>
                          <td> <?php echo $no; ?></td>
                          <td> <?php echo $row->nama; ?></td>
                          <td> <?php echo $row->waktu_pemeriksaan; ?></td>
                          <td> <?php echo $row->no_rm; ?></td>
                          <td class="text-right"> <?php echo number_format($insentif_resep,2,',','.'); ?></td>



                      </tr>

                     <?php $no++; } ?>


                  </tbody>

            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->

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
})
</script>
