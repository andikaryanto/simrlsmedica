  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Rekap Transaksi
        <small></small>
      </h1>
      <ol class="breadcrumb">
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <table id="example2" class="table table-striped table-hover">
                <thead>
                        <tr>
                            <th>No</th>
                            <th>NO RM</th>
                            <th>Tanggal Daftar</th>
                            <th>Nama Pasien</th>
                            <th>Nama Dokter</th>
                            <th>Tindakan</th>
                            <th>Total</th>
                        </tr>
                    </thead>



                    <tbody>
                        <?php $no=1; foreach ($transaksi as $row) { ?>

                        <tr>
                            <td> <?php echo $no; ?></td>
                            <td style="width: 100px;">
                              <span class="norm"><?php echo $row->no_rm; ?></span>
                              <br>
                              <small>
                                <span class="label <?=$jaminan[$row->jaminan]['class']?>"><?=$jaminan[$row->jaminan]['label']?></span>
                                <?php if (!isset($jaminan[$row->jaminan])) { ?>
                                <span class="label label-warning">Umum</span>
                                <?php } ?>
                              </small>
                            </td>
                            <td>
                            	<?php echo date('d M Y', strtotime($row->waktu_pendaftaran)); ?><br>
                            	<?php echo date('H:i', strtotime($row->waktu_pendaftaran)); ?>
                            	
                            </td>
                            <td class="nama"> <?php echo ucwords($row->nama_pasien); ?></td>
                            <td> <?php echo ucwords($row->nama); ?></td>
                            <td> 
                            	<ol style="padding-left: 10px;">
	                            	<?php 
	                            		$sub= 0;
	                            		$tindakan = $context->getDetailTindakan($row->id);
	                            		foreach ($tindakan as $tdk) {
	                            			$sub = $sub + $tdk->tarif_perawat + $tdk->tarif_dokter + $tdk->tarif_lain + $tdk->tarif_pasien;
	                            			echo "<li>$tdk->nama</li>";
	                            		}
	                            	?>
                            	</ol>
                            </td>
                            <td class="text-right">Rp <?=number_format($sub, 0, ',', '.');?></td>
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

         <div class="col-xs-12" id="tess"></div>
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
  });

</script>
