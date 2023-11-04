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
        header("Location: daftar_modul.php?id_labo=$id_labo&id_faku=$id_faku");
        exit();
    }
    $ambildaritabel = mysqli_query($koneksi, "SELECT * FROM daftar_lab WHERE id_faku = $id_faku AND id_labo = $id_labo");
    if (mysqli_num_rows($ambildaritabel) > 0) {

        if ($ambildaritabel) {
            $data = mysqli_fetch_assoc($ambildaritabel);
            $nama_faku = $data['fakultas'];
        } else {
            header("Location: daftar_modul.php?id_labo=$id_labo&id_faku=$id_faku");
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
            <title>Daftar Modul <?= $nama_faku; ?> - Sistem Informasi Manajemen Laboratorium</title>
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
                            <h1 class="mt-4">Daftar Modul <?= $nama_faku; ?></h1>
                            <div class="fs-5 fw-light mb-4">
                                <p>Sistem Informasi Manajemen Laboratorium</p>
                            </div>
                            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Daftar Fakultas</a></li>
                                    <li class="breadcrumb-item"><a href="daftar_laboratorium.php?id_faku=<?= $id_faku; ?>">Daftar Laboratorium</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Daftar Modul</li>
                                </ol>
                            </nav>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                        Tambah Modul
                                    </button>
                                </div>
                                <div class="card-body">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Modul</th>
                                                <th>Nama Modul</th>
                                                <th>Pemberitahuan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ambildaritabel1 = mysqli_query($koneksi, "SELECT * FROM daftar_modul WHERE id_labo = '$id_labo' AND id_faku = '$id_faku'");
                                            $nomor = 1;
                                            $statusModul = "Tidak ada barang"; // Status default

                                            while ($data = mysqli_fetch_array($ambildaritabel1)) {
                                                $id_modl = $data['id_modl'];
                                                $kode_modl = $data['kode_modl'];
                                                $nama_modl = $data['nama_modl'];

                                                $ambilAlatQuery = mysqli_query($koneksi, "SELECT * FROM daftar_alat WHERE id_labo = '$id_labo' AND id_faku = '$id_faku' AND kode_modl LIKE '%$kode_modl%'");
                                                $jumlahBarang = mysqli_num_rows($ambilAlatQuery);

                                                if ($jumlahBarang == 0) {
                                                    $statusModul = "Tidak ada barang";
                                                } elseif ($jumlahBarang > 0) {
                                                    $statusModul = "Lengkap";
                                                    while ($alat = mysqli_fetch_array($ambilAlatQuery)) {
                                                        $kode_alat = $alat['kode_alat'];

                                                        $cekJadwalQuery = mysqli_query($koneksi, "SELECT COUNT(*) AS count FROM daftar_alat WHERE kode_alat = '$kode_alat' AND status = 'Dipinjam'");
                                                        $cekJadwalResult = mysqli_fetch_assoc($cekJadwalQuery);

                                                        if ($cekJadwalResult['count'] > 0) {
                                                            $statusModul = "Tidak Lengkap";
                                                        }
                                                    }
                                                } else {
                                                    $statusModul = "error";
                                                }

                                            ?>
                                                <tr>
                                                    <td><?= $nomor++; ?></td>
                                                    <td><?= $kode_modl; ?></td>
                                                    <td><?= $nama_modl; ?></td>
                                                    <td><?= $statusModul; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $id_modl; ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $id_modl; ?>">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        <a href="detail_modul.php?kode_modl=<?= $kode_modl; ?>&nama_modl=<?= $nama_modl; ?>&id_labo=<?= $id_labo; ?>&id_faku=<?= $id_faku; ?>" class="btn btn-info">Daftar Peralatan</a>
                                                    </td>
                                                </tr>
                                                <!-- The Modal Edit -->
                                                <div class="modal fade" id="edit<?= $id_modl; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="exampleModalLabel">Edit Modul</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form method="post">
                                                                    <input type="hidden" name="id_modl" value="<?= $id_modl; ?>">
                                                                    <div class="mb-3">
                                                                        <small><label for="kode_modl" class="form-label">Kode Modul</label></small>
                                                                        <input type="text" name="kode_modl" value="<?= $kode_modl; ?>" placeholder="Kode" class="form-control" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <small><label for="nama_modl" class="form-label">Nama Modul</label></small>
                                                                        <input type="text" name="nama_modl" value="<?= $nama_modl; ?>" placeholder="Nama modul" class="form-control" required>
                                                                    </div>
                                                                    <br>
                                                                    <button type="submit" class="btn btn-warning" name="editmodul" style="width: 100%;">Edit</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- The Modal Hapus -->
                                                <div class="modal fade" id="hapus<?= $id_modl; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="exampleModalLabel">Hapus Modul</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form method="post">
                                                                    <input type="hidden" name="id_modl" value="<?= $id_modl; ?>">
                                                                    <div class="mb-3">
                                                                        Apakah Anda yakin ingin menghapus <?= $nama_modl; ?> dengan kode <?= $kode_modl; ?>?
                                                                    </div>
                                                                    <br>
                                                                    <button type="submit" class="btn btn-danger" name="hapusmodul" style="width:100%;">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- The Modal Tambah -->
                                                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="exampleModalLabel">Tambah Modul</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <!-- Modal for Adding Reservation -->
                                                            <div class="modal-body">
                                                                <form method="post">
                                                                    <div class="mb-3">
                                                                        <small><label for="kode_modl" class="form-label">Kode Modul</label></small>
                                                                        <input type="text" placeholder="Kode" class="form-control" id="kode_modl" name="kode_modl" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <small><label for="nama_modl" class="form-label">Nama Modul</label></small>
                                                                        <input type="text" placeholder="Nama modul" class="form-control" id="nama_modl" name="nama_modl" required>
                                                                    </div>
                                                                    <br>
                                                                    <button type="submit" class="btn btn-primary" name="tambahmodul" style="width: 100%;">Tambah</button>
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
    } else {
        header("Location: index.php");
        exit();
    }
}
?>