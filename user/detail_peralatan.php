<?php
require '../function_public.php';
require '../cek.php';

if (!isset($_SESSION['log']) || $_SESSION['role'] !== 'user') {
    header('location: ../login.php');
    exit();
} else {
    $username = $_SESSION['username'];
    $nama_alat = isset($_GET['nama_alat']) ? intval($_GET['nama_alat']) : null;
    $id_labo = isset($_GET['id_labo']) ? intval($_GET['id_labo']) : null;
    $id_faku = isset($_GET['id_faku']) ? intval($_GET['id_faku']) : null;

    if ($nama_alat === null || $id_labo === null || $id_labo <= 0 || $id_faku === null || $id_faku <= 0) {
        header("Location: detail_peralatan.php?nama_alat=$nama_alat&id_labo=$id_labo&id_faku=$id_faku");
        exit();
    }
    $ambildaritabel = mysqli_query($koneksi, "SELECT * FROM daftar_lab WHERE id_faku = $id_faku AND id_labo = $id_labo");
    if (mysqli_num_rows($ambildaritabel) > 0) {

        if ($ambildaritabel) {
            $data = mysqli_fetch_assoc($ambildaritabel);
            $nama_alat = $_GET['nama_alat'];
        } else {
            header("Location: detail_peralatan.php?nama_alat=$nama_alat&id_labo=$id_labo&id_faku=$id_faku");
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
            <title>Detail <?= $nama_alat; ?> - Sistem Informasi Manajemen Laboratorium</title>
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
                            <h1 class="mt-4">Detail <?= $nama_alat; ?></h1>
                            <div class="fs-5 fw-light mb-4">
                                <p>Sistem Informasi Manajemen Laboratorium</p>
                            </div>
                            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Daftar Fakultas</a></li>
                                    <li class="breadcrumb-item"><a href="daftar_laboratorium.php?id_faku=<?= $id_faku; ?>">Daftar Laboratorium</a></li>
                                    <li class="breadcrumb-item"><a href="pinjam_peralatan.php?id_labo=<?= $id_labo; ?>&id_faku=<?= $id_faku; ?>">Daftar Peralatan</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Detail Alat <?= $nama_alat; ?></li>
                                </ol>
                                <div class="card mb-4">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body">
                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Alat</th>
                                                    <th>Nama Alat</th>
                                                    <th>Harga</th>
                                                    <th>Kondisi</th>
                                                    <th>Tanggal Masuk</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $ambildaritabel = mysqli_query($koneksi, "SELECT * FROM daftar_alat WHERE nama_alat = '$nama_alat'");
                                                $nomor = 1;
                                                while ($data = mysqli_fetch_array($ambildaritabel)) {
                                                    $id_alat = $data['id_alat'];
                                                    $kode_alat = $data['kode_alat'];
                                                    $nama_alat = $data['nama_alat'];
                                                    $kode_modl = $data['kode_modl'];
                                                    $harga = $data['harga'];
                                                    $kondisi = $data['kondisi'];
                                                    $catatan = $data['catatan'];
                                                    $tanggal_msuk = $data['tanggal_msuk'];
                                                    $status = $data['status'];
                                                ?>
                                                    <tr>
                                                        <td><?= $nomor++; ?></td>
                                                        <td><?= $kode_alat; ?></td>
                                                        <td><?= $nama_alat; ?></td>
                                                        <td>Rp<?= number_format($harga, 2); ?></td>
                                                        <td><?= $kondisi; ?></td>
                                                        <td><?= date('d M Y', strtotime($tanggal_msuk)); ?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#catatan<?= $id_alat; ?>">
                                                                <i class="fas fa-eye"></i>
                                                            </button>

                                                        </td>
                                                    </tr>
                                                    <!-- The Modal Catatan -->
                                                    <div class="modal fade" id="catatan<?= $id_alat; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <!-- Modal Header -->
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="exampleModalLabel">Catatan</h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <!-- Modal body -->
                                                                <div class="modal-body">
                                                                    <form method="post">
                                                                        <input type="hidden" name="id_alat" value="<?= $id_alat; ?>">
                                                                        <div class="mb-3">
                                                                            <textarea name="catatan" class="form-control" rows="4" id="catatan" readonly><?= $catatan; ?></textarea>
                                                                        </div>
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
                                    <div class="card-footer">
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
            <script src="../js/scroll-to-top.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="../js/scripts.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
            <script src="../assets/demo/chart-area-demo.js"></script>
            <script src="../assets/demo/chart-bar-demo.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
            <script src="../js/datatables-simple-demo.js"></script>
            <script src="../js/refresher.js"></script>
            <script>
                window.onload = function() {
                    autoRefresh();
                };
            </script>
        </body>

        </html>

<?php
    } else {
        header("Location: index.php");
        exit();
    }
}
?>