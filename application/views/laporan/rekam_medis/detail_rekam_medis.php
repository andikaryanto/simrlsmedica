<link rel="stylesheet"
      href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<style>
    table.bor, th.bor, td.bor {
        font-size: 12px;
        border: 1px solid #e5e5e5;
    }
    th, td {
        padding: 0px 5px;
    }
    td.cat {
        min-width: 100px;
        max-width: 300px;
    }
    td.no-data {
        padding: 5px;
        text-align: center;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Data Rekam Medis
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Master</a></li>
            <li class="active">Data Rekam Medis</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_1" data-toggle="tab">
                                <span style="font-size: 18px;">Riwayat Periksa Poli</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <?php

                        $data['penyakit'] = $penyakit;
                        $data['tindakan'] = $tindakan;
                        $data['laborat'] = [];
                        $data['ekg'] = [];
                        $data['spirometri'] = [];
                        $data['poli'] = [];

                        foreach ($pemeriksaan as $the_i => $row) {
                            if (strpos($row->nama_jenis_pendaftaran, 'aborat') !== false) {
                                $data['laborat'][] = $row;
                            }
                            else if (strpos(strtolower($row->nama_jenis_pendaftaran), 'ekg') !== false) {
                                $data['ekg'][] = $row;
                            }
                            else if (strpos(strtolower($row->nama_jenis_pendaftaran), 'spirometri') !== false) {
                                $data['spirometri'][] = $row;
                            }
                            else {
                                $data['poli'][] = $row;
                            }
                        }
                        $this->load->view('laporan/rekam_medis/riwayat_poli', $data);
                        $this->load->view('laporan/rekam_medis/riwayat_laboratorium', $data);
                        $this->load->view('laporan/rekam_medis/riwayat_ekg', $data);
                        $this->load->view('laporan/rekam_medis/riwayat_spirometri', $data);
                        ?>
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
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true
        })
    })
</script>
