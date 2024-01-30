<div class="tab-pane active" id="tab_1">
    <div class="table-responsive">
        <table id="example2" class="table table-striped table-hover">
            <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Periksa</th>
                <th>Tipe Layanan</th>
                <th>Jenis Layanan</th>
                <th>Nama Dokter</th>
                <th>Nama Perawat</th>
                <th>Resep Obat</th>
                <th>Obat Racik</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            foreach ($poli as $the_i => $row) { ?>
                <tr>
                    <td> <?php echo $no; ?></td>
                    <td> <?php echo date('d-F-Y', strtotime($row->waktu_pemeriksaan)); ?></td>
                    <td> <?php echo $row->tipe_layanan == 1 ? 'Home Visit' : 'On Site'; ?></td>
                    <td> <?php echo $row->nama_jenis_pendaftaran; ?></td>
                    <td> <?php echo $row->nama_dokter; ?></td>
                    <td> <?php echo $row->perawat; ?></td>
                    <!-- ######################### OBAT ######################### -->
                    <td>
                        <table class="bor">
                            <thead>
                            <tr>
                                <th class="bor">Nama</th>
                                <th class="bor">Signa</th>
                                <th class="bor">jumlah</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $o = $obat;
                            $o = array_map(function ($v) {
                                return $v->pemeriksaan_id;
                            }, $o->result());
                            if ($obat && in_array($row->id, $o)) {
                                foreach ($obat->result() as $row2) {
                                    if ($row->id == $row2->pemeriksaan_id) { ?>
                                        <tr>
                                            <td class="bor"> <?php echo $row2->nama; ?></td>
                                            <td class="bor"> <?php echo $row2->signa_obat; ?></td>
                                            <td class="bor"
                                                class="pull-right"> <?php echo $row2->jumlah_satuan; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                            } else { ?>
                                <tr>
                                    <td bgcolor="#FEFFEF" colspan="3"> Data Tidak ada</td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                    </td>
                    <!-- ######################### OBAT RACIKAN ######################### -->
                    <td>
                        <table class="bor">
                            <thead>
                            <tr>
                                <th class="bor">Nama</th>
                                <th class="bor">Signa</th>
                                <th class="bor">Obat</th>
                                <th class="bor">Catatan</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($row->racikans)) {
                                foreach ($row->racikans as $row2) { ?>
                                    <tr>
                                        <td class="bor" valign="top"> <?php echo $row2->nama_racikan; ?></td>
                                        <td class="bor" valign="top"> <?php echo $row2->signa; ?></td>
                                        <td class="bor">
                                            <table>
                                                <tbody>
                                                <?php foreach ($row2->racikan as $v) { ?>
                                                    <tr>
                                                        <td><?= $v->nama ?></td>
                                                        <td><?= $v->jumlah_satuan ?></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td class="bor cat" valign="top"> <?php echo $row2->catatan; ?></td>
                                    </tr>
                                    <?php
                                }
                            } else { ?>
                                <tr>
                                    <td class="no-data" bgcolor="#FEFFEF" colspan="4"> Data Tidak
                                        ada
                                    </td>
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
                        <!--                    <a href="--><?php //echo base_url(); ?><!--Laporan/downloadPemeriksaan/--><?php //echo $row->id; ?><!--" style="margin-bottom: 5px;" class="btn-block">-->
                        <!--                        <button type="button" class="btn btn-sm btn-block btn-success"><i class="fa fa-download"></i> Unduh</button>-->
                        <!--                    </a>-->
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
</div>
