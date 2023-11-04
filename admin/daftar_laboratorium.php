<?php
require '../function_public.php';
require '../cek.php';

if (!isset($_SESSION['log']) || $_SESSION['role'] !== 'admin') {
    header('location: ../login.php');
    exit();
} else {
    $username = $_SESSION['username'];
    $id_faku = isset($_GET['id_faku']) ? intval($_GET['id_faku']) : null;
    if ($id_faku === null || $id_faku <= 0) {
        header("Location: daftar_laboratorium.php?id_faku=$id_faku");
        exit();
    }
    $ambildaritabel = mysqli_query($koneksi, "SELECT * FROM daftar_lab WHERE id_faku = $id_faku");
    if (mysqli_num_rows($ambildaritabel) > 0) {
        if ($ambildaritabel) {
            $data = mysqli_fetch_assoc($ambildaritabel);
            $nama_faku = $data['fakultas'];
        } else {
            header("Location: daftar_laboratorium.php?id_labo=$id_labo&id_faku=$id_faku");
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
            <title>Daftar Lab <?= $nama_faku; ?> - Sistem Informasi Manajemen Laboratorium</title>
            <link rel="icon" href="../assets/img/logo-simela-icon.png" type="image/png">
            <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
            <link href="../css/styles.css" rel="stylesheet" />
            <link href="../css/scroll-to-top.css" rel="stylesheet" />
            <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        </head>

        <body class="sb-nav-fixed">
            <?php include '../navbar_index.php'; ?>
            <div id="layoutSidenav_content" style="padding-top: 76px;">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-1">Daftar Laboratorium <?= $nama_faku; ?></h1>
                        <div class="fs-5 fw-light mb-4">
                            <p>Sistem Informasi Manajemen Laboratorium</p>
                        </div>
                        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Daftar Fakultas</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Daftar Laboratorium</li>
                            </ol>
                        </nav>
                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                    Tambah Lab
                                </button>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Laboratorium</th>
                                            <th>Nama Laboratorium</th>
                                            <th>Program Studi</th>
                                            <th>Nama Laboran</th>
                                            <th>Kapasitas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ambildaritabel = mysqli_query($koneksi, "SELECT * FROM daftar_lab WHERE id_faku = '$id_faku'");
                                        $nomor = 1;

                                        while ($data = mysqli_fetch_array($ambildaritabel)) {
                                            $id_labo = $data['id_labo'];
                                            $kode_labo = $data['kode_labo'];
                                            $nama_labo = $data['nama_labo'];
                                            $prodi = $data['prodi'];
                                            $nama_lgkp = $data['nama_lgkp'];
                                            $kapasitas = $data['kapasitas'];
                                        ?>
                                            <tr>
                                                <td><?= $nomor++; ?></td>
                                                <td><?= $kode_labo; ?></td>
                                                <td><?= $nama_labo; ?></td>
                                                <td><?= $prodi; ?></td>
                                                <td><?= $nama_lgkp; ?></td>
                                                <td><?= $kapasitas; ?></td>
                                                <td>
                                                    <a href="pinjam_laboratorium.php?id_labo=<?= $id_labo; ?>&id_faku=<?= $id_faku; ?>" class="btn btn-info">Daftar Jadwal</a>
                                                    <a href="pinjam_peralatan.php?id_labo=<?= $id_labo; ?>&id_faku=<?= $id_faku; ?>" class="btn btn-info">Daftar Peralatan</a>
                                                </td>
                                            </tr>
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
            <script src="../js/scroll-to-top.js"></script>
            <script src="../js/refresher.js"></script>
            <script src="../js/validasi_jumlah_kapasitas.js"></script>

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