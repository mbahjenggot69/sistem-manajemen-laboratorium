<?php
require '../function_public.php';
require '../cek.php';

if (!isset($_SESSION['log']) || $_SESSION['role'] !== 'moderator') {
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
        <title>Laporan Aktivitas - Sistem Informasi Manajemen Laboratorium</title>
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
                        <h1 class="mt-4">Laporan Aktivitas</h1>
                        <div class="fs-5 fw-light mb-4">
                            <p>Sistem Informasi Manajemen Laboratorium</p>
                        </div>
                        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                            <ol class="breadcrumb">

                                <li class="breadcrumb-item active" aria-current="page">Laporan Aktivitas</li>
                            </ol>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                        Buat Laporan
                                    </button>
                                </div>
                                <div class="card-body">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Isi Laporan</th>
                                                <th>Nama Laboran</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ambildaritabel = mysqli_query($koneksi, "SELECT * FROM daftar_aktivitas WHERE  status_mode = 1");
                                            $nomor = 1;
                                            while ($data = mysqli_fetch_array($ambildaritabel)) {
                                                $id_lapo = $data['id_lapo'];
                                                $isi_lapo = $data['isi_lapo'];
                                                $tanggal_buat = $data['tanggal_buat'];
                                                $respons = $data['respons'];
                                                $nama_lgkp = $data['nama_lgkp'];

                                            ?>
                                                <tr>
                                                    <td><?= $nomor++; ?></td>
                                                    <td>
                                                        <p><?= $tanggal_buat; ?></p>
                                                        <?php
                                                        $atur_teks = wordwrap($isi_lapo, 35, "\n", true);
                                                        $atur_teks = nl2br($atur_teks);
                                                        ?>
                                                        <p><?= $atur_teks; ?></p>
                                                    </td>
                                                    <td><?= $nama_lgkp; ?></td>
                                                    <td>

                                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#respons<?= $id_lapo; ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $id_lapo; ?>">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <!-- The Modal Respons -->
                                                <div class="modal fade" id="respons<?= $id_lapo; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="exampleModalLabel">Respons</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form method="post">
                                                                    <input type="hidden" name="id_lapo" value="<?= $id_lapo; ?>">
                                                                    <div class="mb-3">
                                                                        <textarea name="respons" class="form-control" rows="4" id="respons" placeholder="Respons dari Kepala Laboratorium"><?= $respons; ?></textarea>
                                                                    </div>
                                                                    <br>
                                                                    <button type="submit" class="btn btn-success" name="submitrespons" style="width: 100%;">Submit</button>

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- The Modal Hapus -->
                                                <div class="modal fade" id="hapus<?= $id_lapo; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="exampleModalLabel">Hapus Laporan</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form method="post">
                                                                    <input type="hidden" name="id_lapo" value="<?= $id_lapo; ?>">
                                                                    <div class="mb-3">
                                                                        Apakah Anda yakin ingin menghapus laporan ini dengan?
                                                                    </div>
                                                                    <br>
                                                                    <button type="submit" class="btn btn-danger" name="hapuslaporan" style="width: 100%;">Hapus</button>
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
        <script src="../js/scroll-to-top.js"></script>
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