<div class="modal fade" id="modal-rekamedis">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Reka Medis</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" name="button" class="btn btn-primary" data-dismiss="modal"> <i class="fa fa-close"></i> Tutup</button>
      </div>
    </div>
  </div>
</div>
<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>assets/bower_components/raphael/raphael.min.js"></script>

<!--<script src="--><?php //echo base_url() ?><!--assets/bower_components/jquery/dist/jquery.min.js"></script>-->
<!-- jQuery UI 1.11.4 -->
<!--<script src="--><?php //echo base_url() ?><!--assets/bower_components/jquery-ui/jquery-ui.min.js"></script>-->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!--<script>-->
<!--  $.widget.bridge('uibutton', $.ui.button);-->
<!--</script>-->
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- DataTables -->
<!--<script src="--><?php //echo base_url() ?><!--assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>-->
<!--<script src="--><?php //echo base_url() ?><!--assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>-->

<!-- Morris.js charts -->
<!-- <script src="<?php echo base_url() ?>assets/bower_components/morris.js/morris.min.js"></script> -->
<!-- Sparkline -->
<script src="<?php echo base_url() ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url() ?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url() ?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url() ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) --><!--
<script src="<?php echo base_url() ?>assets/dist/js/pages/dashboard.js"></script>
 --><!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>



<script type="text/javascript">
$(document).on("keypress", 'form', function (e) {
    var code = e.keyCode || e.which;
    console.log(code);
    if (code == 13) {
        console.log('Inside');
        e.preventDefault();
        return false;
    }
});
$(function(){
  $('.abdush-select').select2();
});
  //<?php echo site_url('pemeriksaan/detail'); ?>

  jQuery(function($){
    $('.btn-rekamedis').on('click', function(){
      var theButton = $(this);
      var loadingText = `<i class="fa fa-spinner fa-pulse"></i> Mengambil data...`;
        $('#modal-rekamedis .modal-body').html(loadingText);

      $('#modal-rekamedis').modal('show');

      $.ajax({
          url: '<?php echo base_url()?>pemeriksaan/rekamedis',
          method: 'post',
          dataType: 'html',
          data: {
            id: theButton.data('pasien_id')
          },
          success: function(data){
            $('#modal-rekamedis .modal-body').html(data) ;
          },
          error: function(data){
            $('#modal-rekamedis .modal-body').html('<span class="small-error text-danger"><i class="fa fa-exclamation-circle"></i> ERROR['+ data.status +']: '+ data.statusText +'.</span>') ;
          }
      });

    });


  });
</script>

<script>
    $(document).ready(function () {
        var table = $('#printable_table').DataTable({
            dom: "Bfrtip",
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: '<i class="fa fa-files-o"></i>',
                    titleAttr: 'Copy',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    titleAttr: 'Excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    titleAttr: 'PDF',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    titleAttr: 'Print',
                    customize: function (win) {
                        $(win.document.body)
                            .css('font-size', '10pt');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    },
                    exportOptions: {
                        columns: ':visible'
                    }
                },
            ]
        });
        table.buttons().container().appendTo('#printable_table_wrapper .col-md-6:eq(0)');
    });

    $(document).on("keydown", ":input:not(textarea)", function(event) {
        return event.key != "Enter";
    });
</script>
