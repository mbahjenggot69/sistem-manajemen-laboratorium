<?php
$role = $_SESSION['role'];
$isAdm = ($role === 'admin');
$isSA = ($role === 'superadmin');
$isMod = ($role === 'moderator');
$isUser = ($role === 'user');
?>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Index</div>
                <?php if ($isAdm || $isSA || $isUser) : ?>
                    <a class="nav-link" href="index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Menu Utama
                    </a>
                    <div class="sb-sidenav-menu-heading">Menu</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePraktikum" aria-expanded="false" aria-controls="collapsePraktikum">
                        <div class="sb-nav-link-icon"><i class="fas fa-microscope"></i></div>
                        Praktikum
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePraktikum" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="pinjam_laboratorium.php?id_labo=<?= $id_labo; ?>&id_faku=<?= $id_faku; ?>">Daftar Jadwal</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseEksperimen" aria-expanded="false" aria-controls="collapseEksperimen">
                        <div class="sb-nav-link-icon"><i class="fas fa-vials"></i></div>
                        Eksperimen
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseEksperimen" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="pinjam_peralatan.php?id_labo=<?= $id_labo; ?>&id_faku=<?= $id_faku; ?>">Daftar Peralatan</a>
                            <a class="nav-link" href="daftar_peminjaman_peralatan.php?id_labo=<?= $id_labo; ?>&id_faku=<?= $id_faku; ?>">Peralatan Dipinjam</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsechemical" aria-expanded="false" aria-controls="collapsechemical">
                        <div class="sb-nav-link-icon"><i class="fas fa-flask"></i></div>
                        Bahan Kimia
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsechemical" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="daftar_bhkimia.php?id_labo=<?= $id_labo; ?>&id_faku=<?= $id_faku; ?>">Request Bahan Kimia</a>
                        </nav>
                    </div>
                    <?php if ($isAdm || $isSA) : ?>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseModul" aria-expanded="false" aria-controls="collapseModul">
                            <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                            Modul
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseModul" aria-labelledby="headingThree" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="daftar_modul.php?id_labo=<?= $id_labo; ?>&id_faku=<?= $id_faku; ?>">Daftar Modul</a>
                            </nav>
                        </div>
                        <?php if ($isSA) : ?>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseKelola" aria-expanded="false" aria-controls="collapseKelola">
                                <div class="sb-nav-link-icon"><i class="fas fa-key"></i></div>
                                Akun
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseKelola" aria-labelledby="headingFour" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="daftar_akun.php?id_labo=<?= $id_labo; ?>&id_faku=<?= $id_faku; ?>">Kelola Akun</a>
                                </nav>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseRiwayat" aria-expanded="false" aria-controls="collapseRiwayat">
                        <div class="sb-nav-link-icon"><i class="fas fa-history"></i></div>
                        Riwayat
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseRiwayat" aria-labelledby="headingFive" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="riwayat_peminjaman_laboratorium.php?id_labo=<?= $id_labo; ?>&id_faku=<?= $id_faku; ?>">Praktikum</a>
                            <a class="nav-link" href="riwayat_peminjaman_peralatan.php?id_labo=<?= $id_labo; ?>&id_faku=<?= $id_faku; ?>">Eksperimen</a>
                            <a class="nav-link" href="riwayat_bahankimia.php?id_labo=<?= $id_labo; ?>&id_faku=<?= $id_faku; ?>">Bahan Kimia</a>
                        </nav>
                    </div>
                <?php endif; ?>
                <?php if ($isAdm || $isSA || $isMod) : ?>
                    <a class="nav-link" href="laporan_aktivitas.php?id_labo=<?= $id_labo; ?>&id_faku=<?= $id_faku; ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-bar"></i></div>
                        Laporan Aktivitas
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</div>