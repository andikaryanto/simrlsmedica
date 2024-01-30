<div class="tab-pane" id="tab_2">
    <table id="example2" class="table table-striped table-hover">
        <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Periksa</th>
            <th>Jenis Layanan Lab</th>
            <th>Gejala Klinis</th>
            <th>Tindakan</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        foreach ($laborat as $the_i => $row) { ?>
            <tr>
                <td> <?php echo $no; ?></td>
                <td> <?php echo date('d-F-Y', strtotime($row->waktu_pemeriksaan)); ?></td>
                <td>
                    <table style="font-size: 10px; padding: 0px 5px;">
                        <tbody>
                        <?php
                        if ($penyakit) {
                            foreach ($penyakit->result() as $row1) {
                                if ($row->id == $row1->pemeriksaan_id) {
                                    ?>
                                    <tr>
                                        <td style="padding: 0px 5px;"> <?php echo $row1->nama; ?></td>
                                        <td style="padding: 0px 5px;"> <?php echo $row1->kode; ?></td>
                                    </tr>
                                <?php }
                            }
                        } else {
                            ?>
                            <tr>
                                <td bgcolor="lightblue" colspan="3"> Data Tidak ada</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </td>
                <td><?= $row->diagnosis ?></td>
                <td>
                    <table style="font-size: 12px">
                        <tbody>
                        <?php
                        if ($tindakan) {
                            foreach ($tindakan->result() as $row2) {
                                if ($row->id == $row1->pemeriksaan_id) {
                                    ?>
                                    <tr>
                                        <td> <?php echo $row2->nama; ?></td>
                                    </tr>
                                <?php }
                            }
                        } else { ?>
                            <tr>
                                <td bgcolor="lightblue" colspan="3"> Data Tidak ada</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </td>
                <td>
                    <a href="<?php echo base_url(); ?>Laporan/EditRekamMedis/<?php echo $row->id; ?>" style="margin-bottom: 5px;" class="btn-block">
                        <button type="button" class="btn btn-sm btn-block btn-primary"><i class="fa fa-pencil"></i> Edit</button>
                    </a>
                    <a href="<?php echo base_url(); ?>Laporan/DetailRiwayatPoli/<?php echo $row->id; ?>" style="margin-bottom: 5px;" class="btn-block">
                        <button type="button" class="btn btn-sm btn-block btn-warning"><i class="fa fa-arrows"></i> Detail</button>
                    </a>
                    <a href="<?php echo base_url(); ?>Laporan/downloadPemeriksaan/<?php echo $row->id; ?>" style="margin-bottom: 5px;" class="btn-block">
                        <button type="button" class="btn btn-sm btn-block btn-success"><i class="fa fa-download"></i> Unduh</button>
                    </a>
                    <a href="<?php echo base_url(); ?>Laporan/printPemeriksaan/<?php echo $row->id; ?>" target="_blank" rel="noopener noreferrer">
                        <button type="button" class="btn btn-sm btn-block btn-danger"><i class="fa fa-print"></i> Cetak</button>
                    </a>
                </td>
            </tr>
            <?php $no++;
        } ?>
        </tbody>
    </table>
</div>
