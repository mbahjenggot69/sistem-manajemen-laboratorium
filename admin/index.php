<?php
require '../function_public.php';
require '../cek.php';

if (!isset($_SESSION['log']) || $_SESSION['role'] !== 'admin') {
    header('location: ../login.php');
    exit();
} else {
    $username = $_SESSION['username'];
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Index - Sistem Informasi Manajemen Laboratorium</title>
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
                    <h1 class="mt-1">Daftar Fakultas</h1>
                    <div class="fs-5 fw-light mb-4">
                        <p>Sistem Informasi Manajemen Laboratorium</p>
                    </div>
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Daftar Fakultas</li>
                        </ol>
                    </nav>
                    <div class="card mb-4">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Fakultas</th>
                                        <th>Jumlah Laboratorium</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ambildaritabel = mysqli_query($koneksi, "SELECT * FROM daftar_lab GROUP BY fakultas");
                                    $nomor = 1;
                                    while ($data = mysqli_fetch_array($ambildaritabel)) {
                                        $id_faku = $data['id_faku'];
                                        $fakultas = $data['fakultas'];
                                        $query = "SELECT COUNT(*) AS jumlah_labo FROM daftar_lab WHERE fakultas = '$fakultas'";
                                        $hasil = mysqli_query($koneksi, $query);
                                        $jumlah_data = mysqli_fetch_assoc($hasil);
                                        $jumlah_labo = $jumlah_data['jumlah_labo'];
                                    ?>
                                        <tr>
                                            <td><?= $nomor++; ?></td>
                                            <td><?= $fakultas; ?></td>
                                            <td><?= $jumlah_labo; ?></td>
                                            <td>
                                                <a href="daftar_laboratorium.php?id_faku=<?= $id_faku; ?>" class="btn btn-info">Daftar Lab</a>
                                            </td>
                                        </tr>
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
}
?>