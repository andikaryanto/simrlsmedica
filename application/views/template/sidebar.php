_<?php
$u = $this->session->userdata('logged_in');

function seq($seg, $val, $ignore_case = true) {
    $ci =& get_instance();
    return $ignore_case ?
        strtolower($ci->uri->segment($seg)) == strtolower($val) :
        $ci->uri->segment($seg) == $val;
}

?>

<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= base_url() ?>assets/img/profil/<?= $u->foto; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= $u->nama;  ?></p>
                <?= $u->nama_grup;  ?>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <?php

            if (superadmin($u) || adminKeuangan($u) || admin($u)) {
                dashboard();
            }
            if (superadmin($u) || frontOffice($u) || admin($u) ) {
                pendaftaran_pasien($u);
            }
            if (superadmin($u) || perawat($u) || admin($u)) {
                pemeriksaan_awal();
            }
            if (superadmin($u) || dokter($u) || perawat($u) || admin($u) || laborat($u) || ekg($u) || spirometri($u)) {
                pemeriksaan_pasien();
            }
             if (superadmin($u) || admin($u) || laborat($u)) {
//              pemeriksaan_lab();
             }
            if (superadmin($u) || frontOffice($u) || apoteker($u) || adminKeuangan($u) || admin($u) || laborat($u) || ekg($u) || spirometri($u)) {
                master_data($u);
            }
            if (superadmin($u) || frontOffice($u) || apoteker($u) || admin($u) ) {
                apotek();
            }
            if (superadmin($u) || admin($u) || frontOffice($u) || kasir($u) || apoteker($u)) { // BILLING billing
                administrasi_periksa($u);
            }
            if (superadmin($u) || dokter($u) || perawat($u) || frontOffice($u) || admin($u)) {
                surat_ket_sehat();
            }
            if (superadmin($u) || dokter($u) || perawat($u) || frontOffice($u) || admin($u)) {
                surat_ket_sakit();
            }
            if (superadmin($u) || adminKeuangan($u) || admin($u)) {
                intensif_karyawan();
            }
            if (superadmin($u) || dokter($u) || perawat($u) || admin($u)) {
                executive_summary($u);
            }
            if (superadmin($u) || adminKeuangan($u)) {
                laba_rugi();
            }
            if (superadmin($u) || admin($u)) {
                pengaturan_akun();
            }

            logout();

            ?>
        </ul>
    </section>
</aside>

<?php

function superadmin($u) {
    return $u->nama_grup == 'superadmin';
}

function admin($u) {
    return $u->nama_grup == 'admin';
}

function dokter($u) {
    return $u->nama_grup == 'dokter';
}

function dokter_orto($u) {
    return $u->nama_grup == 'dokter' && $u->id_jenis_pendaftaran == 53;
}

function perawat($u) {
    return $u->nama_grup == 'perawat';
}

function apoteker($u) {
    return $u->nama_grup == 'apoteker';
}

function frontOffice($u) {
    return $u->nama_grup == 'front_office';
}

function adminKeuangan($u) {
    return $u->nama_grup == 'administrasi_keuangan';
}

function kasir($u) {
    return $u->nama_grup == 'kasir';
}

function laborat($u) {
    return $u->nama_grup == 'laborat';
}

function ekg($u) {
    return $u->nama_grup == 'ekg';
}

function spirometri($u) {
    return $u->nama_grup == 'spirometri';
}
?>

<?php function dashboard() { $ci =& get_instance(); ?>
    <li class="<?= strtolower($ci->uri->segment(1)) == 'dashboard' ? 'active' : ''; ?>">
        <a href="<?= base_url();?>dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>
<?php } ?>

<?php function pendaftaran_pasien($u) { $ci =& get_instance(); ?>
    <li class="treeview <?= (seq(1, 'AntrianFrontOffice') || seq(1, 'AntrianPoli') || $ci->uri->segment(1) == 'pendaftaran') ? 'active menu-open' : ''; ?>">
        <a href="#">
            <i class="fa  fa-user-plus"></i> <span>Pendaftaran Pasien</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
            <?php if (!dokter_orto($u)) : ?>
                <li class="<?= seq(1, 'AntrianFrontOffice') ? 'active' : ''; ?>"><a href="<?= base_url();?>AntrianFrontOffice"><i class="fa fa-circle-o"></i> Antrian Front Office</a></li>
                <li class="<?= seq(2, 'cetak_kartu') ? 'active' : ''; ?>"><a href="<?= base_url();?>pendaftaran/cetak_kartu"><i class="fa fa-circle-o"></i> Cetak Kartu</a></li>
                <li class="<?= seq(1, 'AntrianPoli') ? 'active' : ''; ?>"><a href="<?= base_url();?>AntrianPoli"><i class="fa fa-circle-o"></i> Antrian Poli</a></li>
                <li class="<?= ($ci->uri->segment(2) == 'listPendaftaranPasien') ? 'active' : ''; ?>"><a href="<?= base_url();?>pendaftaran/listPendaftaranPasien"><i class="fa fa-circle-o"></i> List Pendaftaran</a></li>
            <?php endif; ?>
            <li class="<?= ($ci->uri->segment(2) == 'rencanaKunjunganPoliOrto') ? 'active' : ''; ?>"><a href="<?= base_url();?>pendaftaran/rencanaKunjunganPoliOrto"><i class="fa fa-circle-o"></i> Rencana Kunjungan RL</a></li>
            <li class="<?= ($ci->uri->segment(2) == 'rencanaKunjunganSunat') ? 'active' : ''; ?>"><a href="<?= base_url();?>pendaftaran/rencanaKunjunganSunat"><i class="fa fa-circle-o"></i> Rencana Kunjungan Sunat</a></li>
        </ul>
    </li>
<?php } ?>

<?php function pemeriksaan_awal() { $ci =& get_instance(); ?>
    <li class="<?= $ci->uri->segment(1) == 'PemeriksaanAwal' ? 'active' : ''; ?>">
        <a  href="<?= base_url();?>PemeriksaanAwal">
            <i class="fa fa-user"></i> <span>Pemeriksaan Awal</span>
        </a>
    </li>
<?php } ?>

<?php function pemeriksaan_pasien() { $ci =& get_instance(); ?>
    <li  class="treeview <?= ($ci->uri->segment(1) == 'pemeriksaan') ? 'active menu-open' : ''; ?>">
        <a href="#">
            <i class="fa fa-user"></i> <span>Pemeriksaan Pasien</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
            <li class="<?= ($ci->uri->segment(2) == 'listpemeriksaanPasien') ? 'active' : ''; ?>"><a href="<?= base_url();?>pemeriksaan/listpemeriksaanPasien"><i class="fa fa-circle-o"></i> List Pasien daftar</a></li>
            <li class="<?= ($ci->uri->segment(2) == 'listPasienSelesaiPeriksa') ? 'active' : ''; ?>"><a href="<?= base_url();?>pemeriksaan/listPasienSelesaiPeriksa"><i class="fa fa-circle-o"></i>List Pasien sudah diperiksa</a></li>
        </ul>
    </li>
<?php } ?>

<?php function pemeriksaan_lab() { $ci =& get_instance(); ?>
    <li  class="treeview <?= ($ci->uri->segment(1) == 'laboratorium') ? 'active menu-open' : ''; ?>">
        <a href="#">
            <i class="fa fa-user"></i> <span>Laboratorium</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
            <li class="<?= ($ci->uri->segment(2) == 'listpemeriksaanPasien') ? 'active' : ''; ?>"><a href="<?= base_url();?>laboratorium/listpemeriksaanPasien"><i class="fa fa-circle-o"></i> List Pasien daftar</a></li>
<!--            <li class="--><?//= ($ci->uri->segment(2) == 'pengecekanAwal') ? 'active' : ''; ?><!--"><a href="--><?//= base_url();?><!--laboratorium/pengecekanAwal"><i class="fa fa-circle-o"></i>Pengecekan Awal</a></li>-->
            <li class="<?= ($ci->uri->segment(2) == 'pemeriksaanLab') ? 'active' : ''; ?>"><a href="<?= base_url();?>laboratorium/pemeriksaanLab"><i class="fa fa-circle-o"></i>Pemeriksaan Lab</a></li>
            <li class="<?= ($ci->uri->segment(2) == 'rekapitulasiLab') ? 'active' : ''; ?>"><a href="<?= base_url();?>laboratorium/rekapitulasiLab"><i class="fa fa-circle-o"></i>Rekapitulasi Lab</a></li>
            <li class="<?= ($ci->uri->segment(2) == 'tarifDanLayanan') ? 'active' : ''; ?>"><a href="<?= base_url();?>laboratorium/tarifDanLayanan"><i class="fa fa-circle-o"></i>Tarif dan Layanan</a></li>
        </ul>
    </li>
<?php } ?>

<?php function master_data($u) { $ci =& get_instance(); ?>
    <li class="treeview <?= (
        $ci->uri->segment(1) == 'mastergigi' ||
        $ci->uri->segment(1) == 'MasterPoli' ||
        $ci->uri->segment(1) == 'Apotek' ||
        $ci->uri->segment(1) == 'Pasien' ||
        $ci->uri->segment(1) == 'Dokter' ||
        $ci->uri->segment(1) == 'Admin' ||
        $ci->uri->segment(1) == 'AdminKeuangan' ||
        $ci->uri->segment(1) == 'Laboratorium' ||
        $ci->uri->segment(1) == 'Ekg' ||
        $ci->uri->segment(1) == 'Spirometri' ||
        $ci->uri->segment(1) == 'Perawat' ||
        $ci->uri->segment(1) == 'Apoteker' ||
        $ci->uri->segment(1) == 'Kasir' ||
        $ci->uri->segment(1) == 'FrontOffice' ||
        $ci->uri->segment(1) == 'Obat' ||
        $ci->uri->segment(2) == 'detailklinik' ||
        $ci->uri->segment(1) == 'JenisPendaftaran' ||
        $ci->uri->segment(1) == 'TarifTindakan' ||
        $ci->uri->segment(1) == 'Penyakit' ||
        ($ci->uri->segment(1) == 'User' && $ci->uri->segment(2) == 'adduser')

    ) ? 'active menu-open' : ''; ?>">
        <a href="#">
            <i class="fa fa-list"></i> <span>Master Data</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
            <?php
            if (superadmin($u) || admin($u)) master_data_poli();
            if (superadmin($u) || admin($u)) master_data_hak_akes();
            if (superadmin($u) || admin($u)) master_data_other();
            if (frontOffice($u)) master_data_pasien();
            if (perawat($u)) master_data_tarif_tindakan();
            if (adminKeuangan($u)) master_data_insentif_shift();
            if (laborat($u)) master_data_laboratorium();
            if (ekg($u)) master_data_ekg();
            if (spirometri($u)) master_data_spirometri();
            ?>
        </ul>
    </li>
<?php } ?>

<?php function master_data_poli() { $ci =& get_instance(); ?>
  <?php $data_poli = $ci->config->item('poli'); ?>
    <?php foreach ($data_poli as $key => $value) { if (1) { ?>
        <li class="treeview <?= (in_array($ci->uri->segment(2), ['listPenyakit', 'listTarifTindakan']) && $ci->uri->segment(3) == $key) ? 'menu-open' : ''; ?>">
            <a href="#">
                <i class="fa fa-circle-o"></i> <?=$value['label']?> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu" <?= (in_array($ci->uri->segment(2), ['listPenyakit', 'listTarifTindakan']) && $ci->uri->segment(3) == $key) ? 'style="display:block;"' : ''; ?>>
                <?php if ($key == 'umum' || $key == 'rawat luka' || $key='sunat') : ?>
                    <li class="<?= ($ci->uri->segment(2) == 'listPenyakit' && $ci->uri->segment(3) == $key) ? 'active' : ''; ?>">
                        <a href="<?= base_url();?>MasterPoli/listPenyakit/<?=$key?>"><i class="fa fa-circle-o"></i>
                            Jenis Penyakit
                        </a>
                    </li>
                <?php endif; ?>
                <li class="<?= ($ci->uri->segment(2) == 'listTarifTindakan' && $ci->uri->segment(3) == $key) ? 'active' : ''; ?>"><a href="<?= base_url();?>MasterPoli/listTarifTindakan/<?=$key?>"><i class="fa fa-circle-o"></i>Tarif Tindakan</a></li>
                <?php if (in_array($key, ['ekg', 'spirometri', 'pemeriksaan-laborat'])) { ?>
                    <li class="<?= ($ci->uri->segment(2) == 'transaksi' && $ci->uri->segment(3) == $key) ? 'active' : ''; ?>"><a href="<?= base_url();?>MasterPoli/transaksi/<?=$key?>"><i class="fa fa-circle-o"></i>Rekapitulasi Transaksi</a></li>
                <?php } ?>
            </ul>
        </li>
    <?php } } ?>
<?php } ?>

<?php function master_data_laboratorium() { $ci =& get_instance(); ?>
    <li class="treeview  <?= (in_array($ci->uri->segment(2), ['listPenyakit', 'listTarifTindakan']) && $ci->uri->segment(3) == 'laboratorium') ? 'menu-open' : ''; ?>">
        <a href="#">
            <i class="fa fa-circle-o"></i> Pemeriksaan Laboratorium <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu" <?= (in_array($ci->uri->segment(2), ['listPenyakit', 'listTarifTindakan']) && $ci->uri->segment(3) == 'laboratorium') ? 'style="display:block;"' : ''; ?>>
            <li class="<?= ($ci->uri->segment(2) == 'listPenyakit' && $ci->uri->segment(3) == 'laboratorium') ? 'active' : ''; ?>"><a href="<?= base_url();?>MasterPoli/listPenyakit/laboratorium"><i class="fa fa-circle-o"></i>List Layanan</a></li>
            <li class="<?= ($ci->uri->segment(2) == 'listTarifTindakan' && $ci->uri->segment(3) == 'laboratorium') ? 'active' : ''; ?>"><a href="<?= base_url();?>MasterPoli/listTarifTindakan/laboratorium"><i class="fa fa-circle-o"></i>Tarif Tindakan</a></li>
        </ul>
    </li>
<?php } ?>

<?php function master_data_ekg() { $ci =& get_instance(); ?>
    <li class="treeview  <?= (in_array($ci->uri->segment(2), ['listPenyakit', 'listTarifTindakan']) && $ci->uri->segment(3) == 'ekg') ? 'menu-open' : ''; ?>">
        <a href="#">
            <i class="fa fa-circle-o"></i> Pemeriksaan Ekg <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu" <?= (in_array($ci->uri->segment(2), ['listPenyakit', 'listTarifTindakan']) && $ci->uri->segment(3) == 'ekg') ? 'style="display:block;"' : ''; ?>>
            <li class="<?= ($ci->uri->segment(2) == 'listPenyakit' && $ci->uri->segment(3) == 'ekg') ? 'active' : ''; ?>"><a href="<?= base_url();?>MasterPoli/listPenyakit/ekg"><i class="fa fa-circle-o"></i>List Layanan</a></li>
            <li class="<?= ($ci->uri->segment(2) == 'listTarifTindakan' && $ci->uri->segment(3) == 'ekg') ? 'active' : ''; ?>"><a href="<?= base_url();?>MasterPoli/listTarifTindakan/ekg"><i class="fa fa-circle-o"></i>Tarif Tindakan</a></li>
        </ul>
    </li>
<?php } ?>

<?php function master_data_spirometri() { $ci =& get_instance(); ?>
    <li class="treeview  <?= (in_array($ci->uri->segment(2), ['listPenyakit', 'listTarifTindakan']) && $ci->uri->segment(3) == 'spirometri') ? 'menu-open' : ''; ?>">
        <a href="#">
            <i class="fa fa-circle-o"></i> Pemeriksaan Spirometri <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu" <?= (in_array($ci->uri->segment(2), ['listPenyakit', 'listTarifTindakan']) && $ci->uri->segment(3) == 'spirometri') ? 'style="display:block;"' : ''; ?>>
            <li class="<?= ($ci->uri->segment(2) == 'listPenyakit' && $ci->uri->segment(3) == 'spirometri') ? 'active' : ''; ?>"><a href="<?= base_url();?>MasterPoli/listPenyakit/spirometri"><i class="fa fa-circle-o"></i>List Layanan</a></li>
            <li class="<?= ($ci->uri->segment(2) == 'listTarifTindakan' && $ci->uri->segment(3) == 'spirometri') ? 'active' : ''; ?>"><a href="<?= base_url();?>MasterPoli/listTarifTindakan/spirometri"><i class="fa fa-circle-o"></i>Tarif Tindakan</a></li>
        </ul>
    </li>
<?php } ?>

<?php function master_data_apotek() { $ci =& get_instance(); ?>
    <li class="treeview  <?= (in_array($ci->uri->segment(1), ['apotek']) ? 'menu-open' : '') ?>">
        <a href="#">
            <i class="fa fa-circle-o"></i> Apotek <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu" <?= (in_array($ci->uri->segment(1), ['apotek']) ? 'style="display:block"' : '') ?>>
            <li class="<?= ($ci->uri->segment(2) == 'stokObat') ? 'active' : ''; ?>"><a href="<?= base_url();?>apotek/stokObat"><i class="fa fa-circle-o"></i> Stok Obat</a></li>
<!--            <li class="--><?//= ''; ?><!--"><a href="#"><i class="fa fa-circle-o"></i> Retur Pembelian Obat</a></li>-->
<!--            <li class="--><?//= ''; ?><!--"><a href="#"><i class="fa fa-circle-o"></i> Retur Penjualan Obat</a></li>-->
<!--            <li class="--><?//= ''; ?><!--"><a href="#"><i class="fa fa-circle-o"></i> HPP Obat</a></li>-->
            <li class="<?= (
                    $ci->uri->segment(2) == 'pembelian' ||
                    $ci->uri->segment(2) == 'editPembelianObat' ||
                    $ci->uri->segment(2) == 'tambahPembelianObat'
            ) ? 'active' : ''; ?>"><a href="<?= base_url();?>apotek/pembelian"><i class="fa fa-circle-o"></i> Pembelian</a></li>
            <li class="<?= ($ci->uri->segment(2) == 'gudang') ? 'active' : ''; ?>"><a href="<?= base_url();?>apotek/gudang"><i class="fa fa-circle-o"></i> Gudang</a></li>
            <li class="<?= ($ci->uri->segment(2) == 'mutasi') ? 'active' : ''; ?>"><a href="<?= base_url();?>apotek/mutasi"><i class="fa fa-circle-o"></i> Mutasi</a></li>
            <li class="<?= ($ci->uri->segment(2) == 'resep') ? 'active' : ''; ?>"><a href="<?= base_url();?>apotek/resep"><i class="fa fa-circle-o"></i> Rekapitulasi Resep</a></li>
            <li class="<?= (
                    $ci->uri->segment(2) == 'resep_n' ||
                    $ci->uri->segment(2) == 'resep_nota'
            ) ? 'active' : ''; ?>"><a href="<?= base_url();?>apotek/resep_n"><i class="fa fa-circle-o"></i> Resep</a></li>
        </ul>
    </li>
    <li class="treeview  <?= (in_array($ci->uri->segment(1), ['BahanHabisPakai']) ? 'menu-open' : '') ?>">
            <a href="#">
                <i class="fa fa-circle-o"></i> Bahan Habis Pakai <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu" <?= (in_array($ci->uri->segment(1), ['BahanHabisPakai']) ? 'style="display:block"' : '') ?>>
                <li class="<?= ($ci->uri->segment(2) == 'stok') ? 'active' : ''; ?>"><a href="<?= base_url();?>BahanHabisPakai/stok"><i class="fa fa-circle-o"></i> Stok</a></li>
                <li class="<?= (
                        $ci->uri->segment(2) == 'pembelian' ||
                        $ci->uri->segment(2) == 'editPembelian' ||
                        $ci->uri->segment(2) == 'tambahPembelian'
                ) ? 'active' : ''; ?>"><a href="<?= base_url();?>BahanHabisPakai/pembelian"><i class="fa fa-circle-o"></i> Pembelian</a></li>
                <li class="<?= ($ci->uri->segment(2) == 'gudang') ? 'active' : ''; ?>"><a href="<?= base_url();?>BahanHabisPakai/gudang"><i class="fa fa-circle-o"></i> Gudang</a></li>
                <li class="<?= ($ci->uri->segment(2) == 'mutasi') ? 'active' : ''; ?>"><a href="<?= base_url();?>BahanHabisPakai/mutasi"><i class="fa fa-circle-o"></i> Mutasi</a></li>
            </ul>
        </li>
<?php } ?>

<?php function master_data_hak_akes() { $ci =& get_instance(); ?>
    <li class="treeview <?= (
        $ci->uri->segment(1) == 'Dokter' ||
        $ci->uri->segment(1) == 'Admin' ||
        $ci->uri->segment(1) == 'AdminKeuangan' ||
        $ci->uri->segment(1) == 'Laboratorium' ||
        $ci->uri->segment(1) == 'Ekg' ||
        $ci->uri->segment(1) == 'Spirometri' ||
        $ci->uri->segment(1) == 'Perawat' ||
        $ci->uri->segment(1) == 'Apoteker' ||
        $ci->uri->segment(1) == 'Kasir' ||
        $ci->uri->segment(1) == 'FrontOffice' ||
        ($ci->uri->segment(1) == 'User' && $ci->uri->segment(2) == 'adduser')

    ) ? 'active menu-open' : ''; ?>">
        <a href="#">
            <i class="fa fa-circle-o"></i> Hak Akses <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
            <li class="<?= $ci->uri->segment(1) == 'Admin' ? 'active' : ''; ?>"><a href="<?= base_url();?>Admin"><i class="fa fa-circle-o"></i> Admin</a></li>
            <li class="<?= $ci->uri->segment(1) == 'Dokter' ? 'active' : ''; ?>"><a href="<?= base_url();?>Dokter"><i class="fa fa-circle-o"></i> Dokter</a></li>
            <li class="<?= $ci->uri->segment(1) == 'Perawat' ? 'active' : ''; ?>"><a href="<?= base_url();?>Perawat"><i class="fa fa-circle-o"></i> Perawat</a></li>
            <li class="<?= $ci->uri->segment(1) == 'FrontOffice' ? 'active' : ''; ?>"><a href="<?= base_url();?>FrontOffice"><i class="fa fa-circle-o"></i> Front Office</a></li>
        </ul>
    </li>
<?php } ?>

<?php function master_data_pasien() { $ci =& get_instance(); ?>
    <li class="<?= $ci->uri->segment(1) == 'Pasien' ? 'active' : ''; ?>"><a href="<?= base_url();?>Pasien"><i class="fa fa-circle-o"></i> Pasien</a></li>
<?php } ?>

<?php function master_data_tarif_tindakan() { $ci =& get_instance(); ?>
    <li class="<?= $ci->uri->segment(1) == 'TarifTindakan' ? 'active' : ''; ?>"><a href="<?= base_url();?>TarifTindakan/listTarifTindakan"><i class="fa fa-circle-o"></i> Tarif Tindakan</a></li>
<?php } ?>

<?php function master_data_insentif_shift() { $ci =& get_instance(); ?>
    <li class="<?= $ci->uri->segment(2) == 'listInsentifShift' ? 'active' : ''; ?>"><a href="<?= base_url();?>Insentif/listInsentifShift"><i class="fa fa-circle-o"></i> Insentif Shift</a></li>
<?php } ?>

<?php function master_data_other() { $ci =& get_instance(); ?>
    <li class="<?= $ci->uri->segment(1) == 'Pasien' ? 'active' : ''; ?>"><a href="<?= base_url();?>Pasien"><i class="fa fa-circle-o"></i> Pasien</a></li>
    <li class="<?= $ci->uri->segment(1) == 'JenisPendaftaran' ? 'active' : ''; ?>"><a href="<?= base_url();?>JenisPendaftaran"><i class="fa fa-circle-o"></i> Jenis Pendaftaran</a></li>
    <li class="<?= $ci->uri->segment(2) == 'detailklinik' ? 'active' : ''; ?>"><a href="<?= base_url();?>User/detailklinik"><i class="fa fa-circle-o"></i> Data Klinik</a></li>
<?php } ?>

<?php function apotek() { $ci =& get_instance(); ?>
    <li class="treeview <?= ($ci->uri->segment(1) == 'apotek' || $ci->uri->segment(1) == 'BahanHabisPakai' || $ci->uri->segment(1) == 'Pengadaan') ? 'active menu-open' : ''; ?>">
        <a href="#">
            <i class="fa fa-medkit"></i> <span>Apotek</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
            <li class="treeview  <?= (in_array($ci->uri->segment(1), ['apotek', 'HistoryObat']) ? 'menu-open' : '') ?>">
                <a href="#">
                    <i class="fa fa-circle-o"></i> Obat <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu" <?= (in_array($ci->uri->segment(1), ['apotek', 'HistoryObat']) ? 'style="display:block"' : '') ?>>
                    <?php if (!perawat($u)) : ?>
                        <li class="<?= ($ci->uri->segment(1) == 'apotek' && $ci->uri->segment(2) == 'stokObat') ? 'active' : ''; ?>"><a href="<?= base_url();?>apotek/stokObat"><i class="fa fa-circle-o"></i> Stok Obat</a></li>
                        <li class="<?= ($ci->uri->segment(1) == 'apotek' && (
                                $ci->uri->segment(2) == 'pembelian' ||
                                $ci->uri->segment(2) == 'editPembelianObat' ||
                                $ci->uri->segment(2) == 'tambahPembelianObat'
                            )) ? 'active' : ''; ?>"><a href="<?= base_url();?>apotek/pembelian"><i class="fa fa-circle-o"></i> Pembelian</a></li>
                        <li class="<?= ($ci->uri->segment(1) == 'apotek' && $ci->uri->segment(2) == 'resep') ? 'active' : ''; ?>"><a href="<?= base_url();?>apotek/resep"><i class="fa fa-circle-o"></i> Rekapitulasi Resep</a></li>
                    <?php endif; ?>
                    <li class="<?= ($ci->uri->segment(1) == 'apotek' && (
                            $ci->uri->segment(2) == 'resep_n' ||
                            $ci->uri->segment(2) == 'resep_nota'
                        )) ? 'active' : ''; ?>"><a href="<?= base_url();?>apotek/resep_n"><i class="fa fa-circle-o"></i> Resep</a></li>
                    <?php if (!perawat($u)) : ?>
                        <li class="treeview  <?= (in_array($ci->uri->segment(1), ['HistoryObat']) ? 'menu-open' : '') ?>">
                            <a href="#">
                                <i class="fa fa-circle-o"></i> Persediaan <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                            </a>
                            <ul class="treeview-menu" <?= (in_array($ci->uri->segment(1), ['HistoryObat']) ? 'style="display:block"' : '') ?>>
                                <li class="<?= ($ci->uri->segment(2) == 'stokAwal') ? 'active' : ''; ?>"><a href="<?= base_url();?>HistoryObat/stokAwal"><i class="fa fa-circle-o"></i> Stok Awal</a></li>
                                <li class="<?= ($ci->uri->segment(2) == 'stokAkhir') ? 'active' : ''; ?>"><a href="<?= base_url();?>HistoryObat/stokAkhir"><i class="fa fa-circle-o"></i> Stok Akhir</a></li>
                                <li class="<?= ($ci->uri->segment(2) == 'riwayat') ? 'active' : ''; ?>"><a href="<?= base_url();?>HistoryObat/riwayat"><i class="fa fa-circle-o"></i> Riwayat Transaksi</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
            <li class="treeview  <?= (in_array($ci->uri->segment(1), ['BahanHabisPakai', 'HistoryBahanHabisPakai']) ? 'menu-open' : '') ?>">
                <a href="#">
                    <i class="fa fa-circle-o"></i> Bahan Habis Pakai <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu" <?= (in_array($ci->uri->segment(1), ['BahanHabisPakai', 'HistoryBahanHabisPakai']) ? 'style="display:block"' : '') ?>>
                    <li class="<?= ($ci->uri->segment(1) == 'BahanHabisPakai' && $ci->uri->segment(2) == 'stok') ? 'active' : ''; ?>"><a href="<?= base_url();?>BahanHabisPakai/stok"><i class="fa fa-circle-o"></i> Stok</a></li>
                    <li class="<?= ($ci->uri->segment(1) == 'BahanHabisPakai' && (
                            $ci->uri->segment(2) == 'pembelian' ||
                            $ci->uri->segment(2) == 'editPembelian' ||
                            $ci->uri->segment(2) == 'tambahPembelian'
                        )) ? 'active' : ''; ?>"><a href="<?= base_url();?>BahanHabisPakai/pembelian"><i class="fa fa-circle-o"></i> Pembelian</a></li>
                    <li class="<?= ($ci->uri->segment(1) == 'BahanHabisPakai' && (
                            $ci->uri->segment(2) == 'input' ||
                            $ci->uri->segment(2) == 'editInput' ||
                            $ci->uri->segment(2) == 'tambahInput'
                        )) ? 'active' : ''; ?>"><a href="<?= base_url();?>BahanHabisPakai/input"><i class="fa fa-circle-o"></i> Input BHP</a></li>
                    <li class="treeview  <?= (in_array($ci->uri->segment(1), ['HistoryBahanHabisPakai']) ? 'menu-open' : '') ?>">
                        <a href="#">
                            <i class="fa fa-circle-o"></i> Persediaan <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu" <?= (in_array($ci->uri->segment(1), ['HistoryBahanHabisPakai']) ? 'style="display:block"' : '') ?>>
                            <li class="<?= ($ci->uri->segment(2) == 'stokAwal') ? 'active' : ''; ?>"><a href="<?= base_url();?>HistoryBahanHabisPakai/stokAwal"><i class="fa fa-circle-o"></i> Stok Awal</a></li>
                            <li class="<?= ($ci->uri->segment(2) == 'stokAkhir') ? 'active' : ''; ?>"><a href="<?= base_url();?>HistoryBahanHabisPakai/stokAkhir"><i class="fa fa-circle-o"></i> Stok Akhir</a></li>
                            <li class="<?= ($ci->uri->segment(2) == 'riwayat') ? 'active' : ''; ?>"><a href="<?= base_url();?>HistoryBahanHabisPakai/riwayat"><i class="fa fa-circle-o"></i> Riwayat Transaksi</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <!--                <li class="--><?//= $ci->uri->segment(2) == 'dikirim_diterima' ? 'active' : ''; ?><!--"><a href="--><?//= base_url();?><!--Pengadaan/dikirim_diterima/Farmasi"><i class="fa fa-circle-o"></i> Dikirim/Diterima (Farmasi)</a></li>-->
            <!--                <li class="--><?//= $ci->uri->segment(2) == 'retur' ? 'active' : ''; ?><!--"><a href="--><?//= base_url();?><!--Pengadaan/retur"><i class="fa fa-circle-o"></i> Retur</a></li>-->
        </ul>
    </li>
<?php } ?>

<?php function administrasi_periksa($u) { $ci =& get_instance(); ?>
    <li class="treeview <?= ($ci->uri->segment(1) == 'Administrasi' || $ci->uri->segment(1) == 'apotek') ? 'active menu-open' : ''; ?>">
        <a href="#">
            <i class="fa fa-dollar"></i> Billing <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
            <?php
            if (superadmin($u) || admin($u) || kasir($u) || frontOffice($u)) {
                billing_kasir_rekap_resep();
            }
            billing_obat_non_periksa();
            ?>
        </ul>
    </li>
<?php } ?>

<?php function billing_kasir_rekap_resep() { $ci =& get_instance(); ?>
    <li class="<?= (
        $ci->uri->segment(2) == 'listPasienSelesaiPeriksa' ||
        $ci->uri->segment(2) == 'nota' ||
        $ci->uri->segment(2) == 'nota_submit'
    ) ? 'active' : ''; ?>"><a href="<?= base_url();?>Administrasi/listPasienSelesaiPeriksa"><i class="fa fa-circle-o"></i> Kasir</a></li>
    <li class="<?= $ci->uri->segment(2) == 'rekapitulasi' ? 'active' : ''; ?>"><a href="<?= base_url();?>Administrasi/rekapitulasi"><i class="fa fa-circle-o"></i> Rekapitulasi</a></li>
    <li class="<?= (
        $ci->uri->segment(2) == 'resep_n' ||
        $ci->uri->segment(2) == 'resep_nota'
    ) ? 'active' : ''; ?>"><a href="<?= base_url();?>apotek/resep_n"><i class="fa fa-circle-o"></i> Resep</a></li>
<?php } ?>

<?php function billing_obat_non_periksa() { $ci =& get_instance(); ?>
    <li class="<?= $ci->uri->segment(2) == 'resep_luar' ? 'active' : ''; ?>"><a href="<?= base_url();?>apotek/resep_luar"><i class="fa fa-circle-o"></i> Resep Luar</a></li>
    <li class="<?= $ci->uri->segment(2) == 'rekapitulasi_resep_luar' ? 'active' : ''; ?>"><a href="<?= base_url();?>apotek/rekapitulasi_resep_luar"><i class="fa fa-circle-o"></i> Rekapitulasi Resep Luar</a></li>
    <li class="<?= $ci->uri->segment(2) == 'obat_bebas' ? 'active' : ''; ?>"><a href="<?= base_url();?>apotek/obat_bebas"><i class="fa fa-circle-o"></i> Obat Bebas</a></li>
    <li class="<?= $ci->uri->segment(2) == 'rekapitulasi_obat_bebas' ? 'active' : ''; ?>"><a href="<?= base_url();?>apotek/rekapitulasi_obat_bebas"><i class="fa fa-circle-o"></i> Rekapitulasi Obat Bebas</a></li>
    <li class="<?= $ci->uri->segment(2) == 'obat_internal' ? 'active' : ''; ?>"><a href="<?= base_url();?>apotek/obat_internal"><i class="fa fa-circle-o"></i> Penj. Obat Internal</a></li>
    <li class="<?= $ci->uri->segment(2) == 'rekapitulasi_obat_internal' ? 'active' : ''; ?>"><a href="<?= base_url();?>apotek/rekapitulasi_obat_internal"><i class="fa fa-circle-o"></i> Rekap. Penj. Obat Internal</a></li>
<?php } ?>

<?php function surat_ket_sehat() { $ci =& get_instance(); ?>
    <li class="<?= ($ci->uri->segment(2) == 'listPasienSelesai_sehat') ? 'active' : ''; ?>">
        <a href="<?= base_url();?>administrasi/listPasienSelesai_sehat">
            <i class="fa fa-newspaper-o"></i> <span>Surat Ket. Sehat</span>
        </a>
    </li>
<?php } ?>

<?php function surat_ket_sakit() { $ci =& get_instance(); ?>
    <li class="<?= ($ci->uri->segment(2) == 'listPasienSelesaiPeriksa_sakit') ? 'active' : ''; ?>">
        <a href="<?= base_url();?>administrasi/listPasienSelesaiPeriksa_sakit">
            <i class="fa fa-newspaper-o"></i> <span>Surat Ket. Sakit</span>
        </a>
    </li>
    <li class="<?= ($ci->uri->segment(2) == 'listPasienSelesaiPeriksa_consent') ? 'active' : ''; ?>">
        <a href="<?= base_url();?>administrasi/listPasienSelesaiPeriksa_consent">
            <i class="fa fa-newspaper-o"></i> <span>Surat Informed Consent</span>
        </a>
    </li>
<?php } ?>

<?php function intensif_karyawan() { $ci =& get_instance(); ?>
    <li  class="treeview <?= ($ci->uri->segment(1) == 'dokter' || $ci->uri->segment(1) == 'perawat' || $ci->uri->segment(1) == 'Insentif') ? 'active menu-open' : ''; ?>">
        <a href="#">
            <i class="fa fa-suitcase"></i><span>Insentif Karyawan</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
<!--            <li class="--><?php //= $ci->uri->segment(2) == 'listInsentifShift' ? 'active' : ''; ?><!--"><a href="--><?php //= base_url();?><!--Insentif/listInsentifShift"><i class="fa fa-circle-o"></i> Insentif Shift/Kehadiran</a></li>-->
            <li class="treeview  <?= ((
                $ci->uri->segment(2) == 'listInsentifDokter' ||
                $ci->uri->segment(2) == 'listInsentifPerawat' ||
                $ci->uri->segment(2) == 'listInsentifApoteker'
            ) ? 'menu-open' : '') ?>">
                <a href="#">
                    <i class="fa fa-circle-o"></i> Insentif Jasa Medis <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu" <?= ((
                    $ci->uri->segment(2) == 'listInsentifDokter' ||
                    $ci->uri->segment(2) == 'listInsentifPerawat' ||
                    $ci->uri->segment(2) == 'listInsentifApoteker'
                ) ? 'style="display:block"' : '') ?>>
                    <li class="<?= ($ci->uri->segment(2) == 'listInsentifDokter') ? 'active' : ''; ?>"><a href="<?= base_url();?>Insentif/listInsentifDokter"><i class="fa fa-circle-o"></i> Insentif Dokter</a></li>
                    <li class="<?= ($ci->uri->segment(2) == 'listInsentifPerawat') ? 'active' : ''; ?>"><a href="<?= base_url();?>Insentif/listInsentifPerawat"><i class="fa fa-circle-o"></i>Insentif Perawat</a></li>
                    <li class="<?= ($ci->uri->segment(2) == 'listInsentifApoteker') ? 'active' : ''; ?>"><a href="<?= base_url();?>Insentif/listInsentifApoteker"><i class="fa fa-circle-o"></i>Insentif Apoteker</a></li>
                </ul>
            </li>
        </ul>
    </li>
<?php } ?>

<?php function executive_summary($u) { $ci =& get_instance(); ?>
    <li class="treeview <?= ($ci->uri->segment(1) == 'Laporan') ? 'active menu-open' : ''; ?>">
        <a href="#">
            <i class="fa fa-list"></i> <span>Executive Summary</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <?php if (superadmin($u)): ?>
            <ul class="treeview-menu">
                <li class="treeview <?= (
                    $ci->uri->segment(2) == 'jumlahKunjungan' ||
                    $ci->uri->segment(2) == 'jumlahPasien' ||
                    $ci->uri->segment(2) == 'jumlahPasienBaru' ||
                    $ci->uri->segment(2) == 'jumlahPasien20' ||
                    $ci->uri->segment(2) == 'rata2Kunjungan' ||
                    $ci->uri->segment(2) == 'rata2Pasien'
                ) ? 'active menu-open' : ''; ?>">
                    <a href="#">
                        <i class="fa fa-circle-o"></i> <span>Pasien</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?= $ci->uri->segment(2) == 'jumlahKunjungan' ? 'active' : ''; ?>"><a href="<?= base_url();?>Laporan"><i class="fa fa-caret-right"></i> Kunjungan Pasien</a></li>
                        <li class="<?= $ci->uri->segment(2) == 'jumlahPasien' ? 'active' : ''; ?>"><a href="<?= base_url();?>Laporan/jumlahPasien"><i class="fa fa-caret-right"></i> Jumlah Pasien</a></li>
                        <li class="<?= $ci->uri->segment(2) == 'jumlahPasienBaru' ? 'active' : ''; ?>"><a href="<?= base_url();?>Laporan/jumlahPasienBaru"><i class="fa fa-caret-right"></i> Jumlah Pasien Baru</a></li>
                        <li class="<?= $ci->uri->segment(2) == 'jumlahPasien20' ? 'active' : ''; ?>"><a href="<?= base_url();?>Laporan/jumlahPasien20"><i class="fa fa-caret-right"></i> Top 20 Pasien</a></li>
                        <li class="<?= $ci->uri->segment(2) == 'rata2Kunjungan' ? 'active' : ''; ?>"><a href="<?= base_url();?>Laporan/rata2Kunjungan"><i class="fa fa-caret-right"></i> Rata-Rata Kunjungan</a></li>
                        <li class="<?= $ci->uri->segment(2) == 'rata2Pasien' ? 'active' : ''; ?>"><a href="<?= base_url();?>Laporan/rata2Pasien"><i class="fa fa-caret-right"></i> Rata-Rata Pasien</a></li>
                    </ul>
                </li>

            <!--<li class="<?= $ci->uri->segment(2) == 'performaDokter' ? 'active' : ''; ?>"><a href="<?= base_url();?>Laporan/performaDokter"><i class="fa fa-circle-o"></i> Performa Dokter</a></li>-->
                <!--<li class="<?= $ci->uri->segment(2) == 'performaPerawat' ? 'active' : ''; ?>"><a href="<?= base_url();?>Laporan/performaPerawat"><i class="fa fa-circle-o"></i> Performa Perawat</a></li>-->
                <li class="<?= $ci->uri->segment(2) == 'Penyakit' ? 'active' : ''; ?>"><a href="<?= base_url();?>Laporan/Penyakit"><i class="fa fa-circle-o"></i> Jenis Penyakit</a></li>

                <li class="treeview <?= (
                    $ci->uri->segment(2) == 'Obat' ||
                    $ci->uri->segment(2) == 'obat_resep_luar' ||
                    $ci->uri->segment(2) == 'obat_obat_bebas' ||
                    $ci->uri->segment(2) == 'obat_obat_internal'
                ) ? 'active menu-open' : ''; ?>">
                    <a href="#">
                        <i class="fa fa-circle-o"></i> <span>Apotek</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?= $ci->uri->segment(2) == 'Obat' ? 'active' : ''; ?>"><a href="<?= base_url();?>Laporan/Obat"><i class="fa fa-caret-right"></i> Resep Internal</a></li>
                        <li class="<?= $ci->uri->segment(2) == 'obat_resep_luar' ? 'active' : ''; ?>"><a href="<?= base_url();?>Laporan/obat_resep_luar"><i class="fa fa-caret-right"></i> Resep Luar</a></li>
                        <li class="<?= $ci->uri->segment(2) == 'obat_obat_bebas' ? 'active' : ''; ?>"><a href="<?= base_url();?>Laporan/obat_obat_bebas"><i class="fa fa-caret-right"></i> Obat Bebas</a></li>
                        <li class="<?= $ci->uri->segment(2) == 'obat_obat_internal' ? 'active' : ''; ?>"><a href="<?= base_url();?>Laporan/obat_obat_internal"><i class="fa fa-caret-right"></i> Obat Internal</a></li>
                    </ul>
                </li>

                <li class="<?= $ci->uri->segment(2) == 'RekamMedis' ? 'active' : ''; ?>"><a href="<?= base_url();?>Laporan/RekamMedis"><i class="fa fa-circle-o"></i> Rekam Medis</a></li>

            </ul>
        <?php else: ?>
            <ul class="treeview-menu">
                <li class="<?= $ci->uri->segment(2) == 'RekamMedis' ? 'active' : ''; ?>"><a href="<?= base_url();?>Laporan/RekamMedis"><i class="fa fa-circle-o"></i> Rekam Medis</a></li>
            </ul>
        <?php endif; ?>
    </li>
<?php } ?>

<?php function laba_rugi() { $ci =& get_instance(); ?>
    <li class="treeview <?= ($ci->uri->segment(1) == 'Keuangan' ) ? 'active menu-open' : ''; ?>" >
        <a href="#">
            <i class="fa fa-files-o"></i><span>Laporan Keuangan</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
<!--            <li class="--><?//= ''; ?><!--" ><a href="#"><i class="fa fa-circle-o"></i> Neraca</a></li>-->
<!--            <li class="--><?//= ''; ?><!--" ><a href="#"><i class="fa fa-circle-o"></i> Persediaan</a></li>-->
<!--            <li class="--><?//= ''; ?><!--" ><a href="#"><i class="fa fa-circle-o"></i> Perubahan Modal</a></li>-->
<!--            <li class="--><?//= $ci->uri->segment(2) == 'listTotalPemasukan' ? 'active' : ''; ?><!--" ><a href="--><?//= base_url(); ?><!--Keuangan/listTotalPemasukan"><i class="fa fa-circle-o"></i> Pemasukan</a></li>-->
            <li class="treeview <?= ($ci->uri->segment(2) == 'resume_pemasukan_' || $ci->uri->segment(2) == 'penjualan_obat_global_' || $ci->uri->segment(2) == 'resume_frekuensi_tindakan') ? 'active menu-open' : ''; ?>">
                <a href="#"><i class="fa fa-circle-o"></i> <span>Pemasukan</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li class="<?= $ci->uri->segment(2) == 'resume_pemasukan_' ? 'active' : ''; ?>" ><a href="<?= base_url(); ?>Keuangan/resume_pemasukan_"><i class="fa fa-caret-right"></i> Resume Pemasukan</a></li>
                    <li class="<?= $ci->uri->segment(2) == 'resume_frekuensi_tindakan' ? 'active' : ''; ?>" ><a href="<?= base_url(); ?>Keuangan/resume_frekuensi_tindakan"><i class="fa fa-caret-right"></i> Resume Frekuensi Tindakan</a></li>
                    <li class="<?= $ci->uri->segment(2) == 'penjualan_obat_global_' ? 'active' : ''; ?>"><a href="<?= base_url();?>Keuangan/penjualan_obat_global_"><i class="fa fa-caret-right"></i> Penjualan Obat Global</a></li>
                </ul>
            </li>
            <li class="<?= $ci->uri->segment(2) == 'listTotalPiutang' ? 'active' : ''; ?>" ><a href="<?= base_url(); ?>Keuangan/listTotalPiutang"><i class="fa fa-circle-o"></i> Piutang</a></li>
            <li class="<?= $ci->uri->segment(2) == 'listTotalPengeluaran' ? 'active' : ''; ?>"><a href="<?= base_url(); ?>Keuangan/listTotalPengeluaran"><i class="fa fa-circle-o"></i> Pengeluaran</a></li>
            <li class="<?= $ci->uri->segment(2) == 'labaRugi' ? 'active' : ''; ?>" ><a href="<?= base_url(); ?>Keuangan/labaRugi"><i class="fa fa-circle-o"></i> Laba Rugi</a></li>
        </ul>
    </li>
<?php } ?>

<?php function pengaturan_akun() { $ci =& get_instance(); ?>
    <li class="<?= $ci->uri->segment(1) == 'User' ? 'active' : ''; ?>">
        <a href="<?= base_url(); ?>User">
            <i class="fa  fa-user-plus"></i> <span>Pengaturan Akun</span>
        </a>
    </li>
<?php } ?>

<?php function logout() { $ci =& get_instance(); ?>
    <li>
        <a href="<?= base_url(); ?>login/logout">
            <i class="fa  fa-sign-out"></i>
            <span>Log Out</span><span class="pull-right-container"></span>
        </a>
    </li>
<?php } ?>
