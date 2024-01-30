<link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<style>
    hr {
        margin-top: 0 !important;
        margin-bottom: 15px !important;
    }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Detail Resume Frekuensi Tindakan
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Master</a></li>
            <li class="active">Detail Resume Frekuensi Tindakan</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Detail Resume Frekuensi Tindakan</h3>&nbsp;&nbsp;
                    </div>
                    <div class="box-header">
                        <div class="panel panel-danger">
                            <div class="panel-heading"><h4><b>DISCLAIMER</b></h4></div>
                            <div class="panel-body">DATA YANG DITAMPILKAN TIDAK TERMASUK DISKON YANG DIBERIKAN.</div>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="printable_table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl Bayar</th>
                                <th>Shift</th>
                                <th>Pasien</th>
                                <th>Jenis Dftr</th>
                                <th>Dokter</th>
                                <th>Poli</th>
                                <th>Item</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Sub Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no=1;
                            $subtotal = 0;
                            foreach ($list as $row) { ?>
                                <tr>
                                    <td><?=$no?></td>
                                    <td><?=date('d-M-Y H:i', strtotime($row->created_at))?></td>
                                    <td><?=$row->shift?></td>
                                    <td><?=ucwords($row->nama_pasien)?></td>
                                    <td><?=$jaminan[$row->jaminan]['label']?></td>
                                    <td><?=ucwords($row->nama_dokter)?></td>
                                    <td><?=ucwords($row->nama_poli)?></td>
                                    <td><?=ucwords($row->item)?></td>
                                    <td><?=$row->jumlah?></td>
                                    <td align="right"><?= number_format($row->harga,2,',','.')?></td>
                                    <td align="right"><?= number_format($row->subtotal,2,',','.')?></td>
                                </tr>
                                <?php
                                $subtotal = $subtotal + $row->subtotal;
                                $no++; } ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="10" align="right"><strong>Total Pemasukan Jasa Medis : </strong></td>
                                <td align="right"><strong><?= number_format($subtotal,2,',','.')?></strong></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<script src="<?= base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>

<script>
    $(function () {
        $('.select2').select2();

        const jenis = <?=isset($jenis) ? $jenis : -100?>;
        if (jenis === 2) {
            $('#jenis-2').css('display', 'block')
        }
        else if (jenis === 3) {
            $('#jenis-3').css('display', 'block')
        }

        $("#jenis").change(function () {

            $('#jenis-2').css('display', 'none')
            $('#jenis-3').css('display', 'none')

            if ($(this).val() === '2') {
                $('#jenis-2').css('display', 'block')
            }
            else if ($(this).val() === '3') {
                $('#jenis-3').css('display', 'block')
            }
        })

        const tindakan_all = <?=json_encode($tindakan_all)?>;
        const tindakan_lab_all = <?=json_encode($tindakan_lab_all)?>;
        const tindakan_lab_all_merge = <?=json_encode($tindakan_lab_all_merge)?>;
        const kode_poli = <?=json_encode($kode_poli);?>;
        const jenis_pendaftaran = <?=json_encode($jenis_pendaftaran_all->result());?>;
        const get_kategori = kode => {
            for (const key in kode_poli) {
                for (const kode_ of kode_poli[key].kode) {
                    if (kode_ === kode) {
                        return key
                    }
                }
            }
        }

        $('#poli').change(function () {
            $('#tindakan').find('option').remove()

            if ($(this).val()) {
                if (parseInt($(this).val()) === 62) {
                    tindakan_lab_all.forEach(v => $('#tindakan').append(`<option value="${v.id}">${v.nama}</option>`))
                }
                else {
                    const kode = jenis_pendaftaran.find(v => parseInt(v.id) === parseInt($(this).val())).kode ?? ''
                    let cat = get_kategori(kode)
                    if (cat) {
                        tindakan_all
                            .filter(v => v.category === cat)
                            .forEach(v => $('#tindakan').append(`<option value="${v.id}">${v.nama}</option>`))
                    }
                }
            }
            else {
                tindakan_lab_all_merge.forEach(v => $('#tindakan').append(`<option value="${v.id}">${v.nama}</option>`))
            }
        })
    })

    $(function () {
        $('#example1').DataTable()
        // $('#example2').DataTable({
        //     rowReorder: {
        //         selector: 'td:nth-child(2)'
        //     },
        //     'paging'      : true,
        //     'lengthChange': true,
        //     'searching'   : true,
        //     'ordering'    : true,
        //     'info'        : true,
        //     'autoWidth'   : true
        // })
    })
</script>
