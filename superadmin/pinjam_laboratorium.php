<?php
require '../function_public.php';
require '../cek.php';

if (!isset($_SESSION['log']) || $_SESSION['role'] !== 'superadmin') {
    header('location: ../login.php');
    exit();
} else {
    $username = $_SESSION['username'];
    $id_labo = isset($_GET['id_labo']) ? intval($_GET['id_labo']) : null;
    $id_faku = isset($_GET['id_faku']) ? intval($_GET['id_faku']) : null;

    if ($id_labo === null || $id_labo <= 0 || $id_faku === null || $id_faku <= 0) {
        header("Location: pinjam_laboratorium.php?id_labo=$id_labo&id_faku=$id_faku");
        exit();
    }

    $ambildaritabel = mysqli_query($koneksi, "SELECT * FROM daftar_lab WHERE id_faku = $id_faku AND id_labo = $id_labo");
    if (mysqli_num_rows($ambildaritabel) > 0) {

        if ($ambildaritabel) {
            $data = mysqli_fetch_assoc($ambildaritabel);
            $nama_labo = $data['nama_labo'];
        } else {
            header("Location: pinjam_laboratorium.php?id_labo=$id_labo&id_faku=$id_faku");
            exit();
        }
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <meta name="description" content="" />
            <meta name="author" content="" />
            <title>Daftar Jadwal <?= $nama_labo; ?> - Sistem Informasi Manajemen Laboratorium</title>
            <link rel="icon" href="../assets/img/logo-simela-icon.png" type="image/png">
            <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
            <link href="../css/styles.css" rel="stylesheet" />
            <link href="../css/scroll-to-top.css" rel="stylesheet" />
            <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        </head>

        <body class="sb-nav-fixed">
            <?php include '../navbar_public.php'; ?>
            <div id="layoutSidenav">
                <?php include '../sidebar.php'; ?>
                <div id="layoutSidenav_content">
                    <main>
                        <div class="container-fluid px-4">
                            <h1 class="mt-4">Daftar Jadwal <?= $nama_labo; ?></h1>
                            <div class="fs-5 fw-light mb-4">
                                <p>Sistem Informasi Manajemen Laboratorium</p>
                            </div>
                            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Daftar Fakultas</a></li>
                                    <li class="breadcrumb-item"><a href="daftar_laboratorium.php?id_faku=<?= $id_faku; ?>">Daftar Laboratorium</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Daftar Jadwal</li>
                                </ol>
                            </nav>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                        Tambah Jadwal
                                    </button>
                                </div>
                                <div class="card-body">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Peminjaman</th>
                                                <th>Nama Modul</th>
                                                <th>Nama Peminjam</th>
                                                <th>Tanggal Pinjam</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $ambildaritabel = mysqli_query($koneksi, "SELECT * FROM daftar_jadwal WHERE id_labo = '$id_labo' AND id_faku = '$id_faku'");
                                            $nomor = 1;
                                            while ($data = mysqli_fetch_array($ambildaritabel)) {
                                                $id_jdwl = $data['id_jdwl'];
                                                $kode_pinj = $data['kode_pinj'];
                                                $nama_modl = $data['nama_modl'];
                                                $nama_lgkp = $data['nama_lgkp'];
                                                $tanggal_pinj = $data['tanggal_pinj'];
                                                $tanggal_sele = $data['tanggal_sele'];
                                            ?>
                                                <tr>
                                                    <td><?= $nomor++; ?></td>
                                                    <td><?= $kode_pinj; ?></td>
                                                    <td><?= $nama_modl; ?></td>
                                                    <td><?= $nama_lgkp; ?></td>
                                                    <td><?= $tanggal_pinj; ?></td>
                                                    <td><?= $tanggal_sele; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#selesai<?= $id_jdwl; ?>">
                                                            Selesai
                                                        </button>
                                                    </td>
                                                </tr>
                                                <!-- The Modal Selesai -->
                                                <div class="modal fade" id="selesai<?= $id_jdwl; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="exampleModalLabel">Selesaikan Jadwal?</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form method="post">
                                                                    <?php
                                                                    ?>
                                                                    <input type="hidden" name="id_jdwl" value="<?= $id_jdwl; ?>">
                                                                    <input type="hidden" name="kode_pinj" value="<?= $kode_pinj; ?>">
                                                                    <input type="hidden" name="nama_lgkp" value="<?= $nama_lgkp; ?>">
                                                                    <input type="hidden" name="tanggal_pinj" value="<?= $tanggal_pinj; ?>">
                                                                    <input type="hidden" name="tanggal_sele" value="<?= $tanggal_sele; ?>">
                                                                    <div class="mb-3">
                                                                        Apakah Anda yakin ingin menyelesaikan jadwal atas nama <?= $nama_lgkp; ?> dengan kode <?= $kode_pinj; ?>?
                                                                    </div>
                                                                    <br>
                                                                    <button type="submit" class="btn btn-danger" name="selesaijadwal" style="width: 100%;">Selesai</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </main>
                    <?php include '../footer.php'; ?>
                </div>
            </div>
            <div id="scroll-to-top-button" class="btn btn-primary">
                <i class="fas fa-arrow-up"></i>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="../js/scripts.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
            <script src="../assets/demo/chart-area-demo.js"></script>
            <script src="../assets/demo/chart-bar-demo.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
            <script src="../js/datatables-simple-demo.js"></script>
            <script src="../js/date-input-validation.js"></script>
            <script src="../js/scroll-to-top.js"></script>
            <script src="../js/refresher.js"></script>
            <script>
                window.onload = function() {
                    autoRefresh();
                };
            </script>
        </body>
        <!-- The Modal Tambah -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Tambah Jadwal</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Modal for Adding Reservation -->
                    <div class="modal-body">
                        <form method="post">
                            <div class="mb-3">
                                <h6 style="color: red;">Mohon cek ketersediaan modul terlebih dahulu di dalam menu Daftar Modul!</h6>
                            </div>
                            <div class="mb-3">
                                <small><label for="tanggal_pinj" class="form-label">Tanggal Pinjam</label></small>
                                <input type="datetime-local" class="form-control" id="tanggal_pinj" name="tanggal_pinj" required>
                            </div>
                            <div class="mb-3">
                                <small> <label for="tanggal_sele" class="form-label">Tanggal Selesai</label></small>
                                <input type="datetime-local" class="form-control" id="tanggal_sele" name="tanggal_sele" required>
                            </div>
                            <div class="mb-3">
                                <small><label for="nama_modl" class="form-label">Nama Modul</label></small>
                                <select class="form-select" id="nama_modl" name="nama_modl"> <!-- required tidak wajib -->
                                    <option value="" disabled selected hidden>Pilih di sini</option>
                                    <?php
                                    $ambildaritabel = mysqli_query($koneksi, "SELECT * FROM daftar_modul WHERE id_faku = '$id_faku'");
                                    while ($data = mysqli_fetch_array($ambildaritabel)) {
                                        $kode_modl = $data['kode_modl'];
                                        $statusModul = "Tidak ada barang"; // Reset statusModul ke nilai default

                                        $ambilAlatQuery = mysqli_query($koneksi, "SELECT * FROM daftar_alat WHERE id_labo = '$id_labo' AND id_faku = '$id_faku' AND kode_modl LIKE '%$kode_modl%'");
                                        $jumlahBarang = mysqli_num_rows($ambilAlatQuery);

                                        if ($jumlahBarang > 0) {
                                            $statusModul = "Lengkap";
                                        }

                                        // Jika status modul adalah "Tidak ada barang", skip iterasi ini
                                        if ($statusModul == "Tidak ada barang") {
                                            continue;
                                        }

                                        $nama_modl = $data['nama_modl'];
                                    ?>
                                        <option value="<?= $kode_modl . ',' . $nama_modl; ?>"><?= $nama_modl; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>



                            </div>
                            <div class="mb-3">
                                <small> <label for="nama_lgkp" class="form-label">Nama Anda</label></small>
                                <input type="text" class="form-control" id="nama_lgkp" name="nama_lgkp" value="<?php echo $_SESSION['nama_lgkp']; ?>">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary" name="tambahjadwal" style="width: 100%;">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        </html>
<?php
    } else {
        header("Location: index.php");
        exit();
    }
}
?>