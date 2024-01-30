<table>
  <tbody>
    <tr>
      <td>NORM</td>
      <td>&nbsp;:&nbsp;</td>
      <td><?=$pasien->no_rm?></td>
    </tr>
    <tr>
      <td>Nama</td>
      <td>&nbsp;:&nbsp;</td>
      <td><?=$pasien->nama?></td>
    </tr>
    <tr>
      <td>Tempat Tanggal Lahir</td>
      <td>&nbsp;:&nbsp;</td>
      <td><?=$pasien->tempat_lahir?>, <?=$pasien->tanggal_lahir?></td>
    </tr>
    <tr>
      <td>Usia</td>
      <td>&nbsp;:&nbsp;</td>
      <td><?=$pasien->usia?></td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td>&nbsp;:&nbsp;</td>
      <td><?=$pasien->jk?></td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>&nbsp;:&nbsp;</td>
      <td><?=$pasien->alamat?></td>
    </tr>
    <tr>
      <td>Telepon</td>
      <td>&nbsp;:&nbsp;</td>
      <td><?=$pasien->telepon?></td>
    </tr>
    <tr>
      <td>Pekerjaan</td>
      <td>&nbsp;:&nbsp;</td>
      <td><?=$pasien->pekerjaan?></td>
    </tr>
    <tr>
      <td>Agama</td>
      <td>&nbsp;:&nbsp;</td>
      <td><?=$pasien->agama?></td>
    </tr>
    <tr>
      <td>Penanggung Jawab</td>
      <td>&nbsp;:&nbsp;</td>
      <td><?=$pasien->penanggungjawab?></td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
<div class="table-responsive">
  <table class="table table-bordered table-striped table-hover">
    <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Periksa</th>
                <th>Diagnosis Jenis Penyakit</th>
                <th>Obat</th>
                <th>Obat Racik</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=0;
            foreach ($pemeriksaan as $row) {
              $no++;
              ?>
            <tr>
                <td> <?php echo $no; ?></td>
                <td> <?php echo date('d-F-Y', strtotime($row->waktu_pemeriksaan)); ?></td>
                <!-- <td> <?php echo $row->no_rm; ?></td> -->
                <td> <table style="font-size: 10px;" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Penyakit</th>
                                <th>Kode</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($penyakit){

                              foreach ($penyakit->result() as $row1) {
                                if($row->id == $row1->pemeriksaan_id){?>
                                  <tr>
                                      <td> <?php echo $row1->nama; ?></td>
                                      <td> <?php echo $row1->kode; ?></td>
                                  </tr>
                        <?php   }
                              }
                            }else{    ?>
                              <tr>
                                <td bgcolor="lightblue" colspan="3"> Data Tidak ada</td>
                              </tr>
                      <?php } ?>

                        </tbody>
                    </table>
                </td>
                <td>
                  <table style="font-size: 10px;" class="table table-bordered">
                        <thead>
                            <tr>

                                <th>Nama Obat</th>
                                <th> signa</th>
                                <th> jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($obat){

                              foreach ($obat->result() as $row2) {
                                if($row->id == $row2->pemeriksaan_id){?>
                                  <tr>

                                      <td> <?php echo $row2->nama; ?></td>
                                      <td> <?php echo $row2->signa_obat; ?></td>
                                       <td> <?php echo $row2->jumlah_satuan; ?></td>
                                  </tr>
                                 <?php } $no++; }
                             }else{?>
                              <tr>
                                <td bgcolor="lightblue" colspan="3"> Data Tidak ada</td>
                              </tr>
                             <?php } ?>


                        </tbody>

                    </table>
                  </td>
                   <td>
                  <table style="font-size: 10px;" class="table table-bordered">
                        <thead>
                            <tr>

                                <th>Nama Obat</th>
                                <th> Signa Obat</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($racikan){

                              foreach ($racikan->result() as $row4) {
                                if($row->id == $row4->pemeriksaan_id){?>
                                  <tr>

                                      <td> <?php echo $row4->nama_racikan; ?></td>
                                      <td> <?php echo $row4->signa; ?></td>

                                  </tr>
                                 <?php } $no++; }
                             }else{?>
                              <tr>
                                <td bgcolor="lightblue" colspan="3"> Data Tidak ada</td>
                              </tr>
                             <?php } ?>


                        </tbody>

                    </table>
                  </td>
                  <td>
                    <table style="font-size: 10px;" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php


                            if($tindakan){

                              foreach ($tindakan->result() as $row3) {
                                if($row->id == $row3->pemeriksaan_id){?>
                                  <tr>

                                      <td> <?php echo $row3->nama; ?></td>

                                  </tr>
                                 <?php } }
                             }else{?>
                              <tr>
                                <td bgcolor="lightblue" colspan="3"> Data Tidak ada</td>
                              </tr>
                             <?php } ?>
                        </tbody>
                    </table>
                  </td>
            </tr>

           <?php } ?>


        </tbody>

  </table>
</div>
