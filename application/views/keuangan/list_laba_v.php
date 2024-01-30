<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php if (isset($jpem) && isset($jp_name)) { ?>
            Data Pemasukan <?=$jpem?> <?=$jp_name?>
        <?php } else { ?>
            Data Pemasukan <?=$tipe?>
        <?php } ?>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Master</a></li>
        <li class="active">Data Pemasukan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                  <?php if (isset($jpem) && isset($jp_name)) { ?>
                      List Pemasukan Dari <?=$jpem?>
                  <?php } else { ?>
                      List Pemasukan Dari <?=$tipe?>
                  <?php } ?>
              </h3>&nbsp;&nbsp;
              <!-- <a  href="<?php  echo base_url(); ?>Keuangan/tambah_Keuangan"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></button></a> -->
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
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    <?php echo $success ?>
                </div>
            <?php } ?>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Item </th>
                        <th>Jenis Item</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; $subtotal =0; foreach ($detail->result() as $row) { ?>
                    <tr>
                        <td> <?php echo $no++; ?></td>
                        <td> <?php echo ucwords($row->item); ?></td>
                        <td> <?php echo ucwords($row->jenis_item); ?></td>
                        <td> <?php echo $row->jumlah; ?></td>
                        <td> <?php echo $row->harga; ?></td>
                        <td class="pull-right"> <?php echo $row->subtotal; ?></td>
                    </tr>
                    <?php $subtotal += $row->subtotal;?>
                    <?php $no++; } ?>
                   <tr>
                        <td colspan="5" align="right"><strong>Total Pemasukan : </strong></td>
                        <td align="right"><strong><?= number_format($subtotal,2,',','.'); ?></strong></td>
                    </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
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
