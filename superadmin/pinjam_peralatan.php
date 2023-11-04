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
        header("Location: pinjam_peralatan.php?id_labo=$id_labo&id_faku=$id_faku");
        exit();
    }
    $ambildaritabel = mysqli_query($koneksi, "SELECT * FROM daftar_lab WHERE id_faku = $id_faku AND id_labo = $id_labo");
    if (mysqli_num_rows($ambildaritabel) > 0) {

        if ($ambildaritabel) {
            $data = mysqli_fetch_assoc($ambildaritabel);
            $nama_labo = $data['nama_labo'];
        } else {
            header("Location: pinjam_peralatan.php?id_labo=$id_labo&id_faku=$id_faku");
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
            <title>Daftar Peralatan <?= $nama_labo; ?> - Sistem Informasi Manajemen Laboratorium</title>
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
                            <h1 class="mt-4">Daftar Peralatan <?= $nama_labo; ?></h1>
                            <div class="fs-5 fw-light mb-4">
                                <p>Sistem Informasi Manajemen Laboratorium</p>
                            </div>
                            <nav style=" --bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8' %3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor' /%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Daftar Fakultas</a></li>
                                    <li class="breadcrumb-item"><a href="daftar_laboratorium.php?id_faku=<?= $id_faku; ?>">Daftar Laboratorium</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Daftar Peralatan</li>
                                </ol>
                            </nav>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <!-- Button to Open the Modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                                        Tambah Alat
                                    </button>
                                </div>
                                <div class="card-body">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Alat</th>
                                                <th>Jumlah Alat Tersedia</th>
                                                <th>Jumlah Alat Total</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $ambilsemuadatastok = mysqli_query($koneksi, "SELECT * FROM daftar_alat WHERE id_faku = $id_faku AND id_labo = $id_labo GROUP BY nama_alat ");
                                            $no = 1;

                                            while ($data = mysqli_fetch_array($ambilsemuadatastok)) {
                                                $nama_alat = $data['nama_alat'];
                                                $kode_alat = $data['kode_alat'];
                                                $nama_alat_clean = str_replace(' ', '_', $nama_alat);
                                                $query = "SELECT COUNT(*) AS jumlah_alat FROM daftar_alat WHERE nama_alat = '$nama_alat'";
                                                $hasil = mysqli_query($koneksi, $query);
                                                $jumlah_data = mysqli_fetch_assoc($hasil);
                                                $jumlah_alat = $jumlah_data['jumlah_alat'];

                                                $ready = "SELECT COUNT(*) AS jumlah_alat FROM daftar_alat WHERE nama_alat = '$nama_alat' AND kondisi ='Baik' AND status = 'Tersedia'";
                                                $hasilready = mysqli_query($koneksi, $ready);
                                                $queryready = mysqli_fetch_assoc($hasilready);
                                                $jumlah_ready = $queryready['jumlah_alat'];

                                            ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $nama_alat; ?></td>
                                                    <td><?= $jumlah_ready; ?></td>
                                                    <td><?= $jumlah_alat; ?></td>
                                                    <td>
                                                        <a href="detail_peralatan.php?nama_alat=<?= $nama_alat; ?>&id_labo=<?= $id_labo; ?>&id_faku=<?= $id_faku; ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>

                                                        <?php if ($jumlah_alat > 0) { ?>
                                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#pinjam<?= $nama_alat_clean; ?>"><i class="fas fa-book"></i></button>
                                                        <?php } else { ?>
                                                            <button type="button" class="btn btn-secondary" disabled>
                                                                Pinjam
                                                            </button>
                                                        <?php } ?>
                                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $nama_alat_clean; ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $nama_alat_clean; ?>">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                <!-- The Modal EDIT -->
                                                <div class="modal fade" id="edit<?= $nama_alat_clean; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Ubah Jumlah <?= $nama_alat; ?></h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                <br><br>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <form method="post" onsubmit="return validasi_jumlah_edit()">
                                                                <div class="modal-body">
                                                                    <!-- Input hidden untuk melempar nama_alat -->
                                                                    <input type="hidden" id="jumlah_alat" name="jumlah_alat" value="<?= $jumlah_alat; ?>">
                                                                    <input type="hidden" id="jumlah_ready" name="jumlah_ready" value="<?= $jumlah_ready; ?>">
                                                                    <!-- Form lainnya -->
                                                                    <div class="form-group mb-3">
                                                                        <small><label for="nama" class="form-label">Nama</label></small>
                                                                        <input class="form-control" id="nama" name="nama" value="<?= $nama_alat; ?>" type="text" readonly />
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <small><label for="jumlah">Jumlah Alat</label></small>
                                                                        <input type="number" class="form-control" id="jumlah" value="<?= $jumlah_alat; ?>" name="jumlah" required>
                                                                    </div>
                                                                    <br>
                                                                    <button type="submit" class="btn btn-warning" name="edit_jumlah_alat" style="width: 100%;">Edit</button>
                                                                </div>


                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- The Modal Pinjam -->
                                                <div class="modal fade" id="pinjam<?= $nama_alat_clean; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Pinjam Alat</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                <br><br>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <form method="post" onsubmit="return validasi_jumlah_pinjam_alat()">

                                                                <div class="modal-body">
                                                                    <!-- Input hidden untuk melempar nama_alat -->
                                                                    <input type="hidden" id="nama_alat" name="nama_alat" value="<?= $nama_alat; ?>">
                                                                    <input type="hidden" id="jumlah_alat" name="jumlah_alat" value="<?= $jumlah_alat; ?>">
                                                                    <input type="hidden" id="kode_alat" name="kode_alat" value="<?= $kode_alat; ?>">
                                                                    <input type="hidden" id="jumlah_ready" name="jumlah_ready" value="<?= $jumlah_ready; ?>">

                                                                    <!-- Form lainnya -->
                                                                    <div class="form-group mb-3">
                                                                        <small><label for="nama_lgkp">Nama Peminjam</label></small>
                                                                        <input type="text" class="form-control" id="nama_lgkp" name="nama_lgkp" value="<?php echo $_SESSION['nama_lgkp']; ?>">
                                                                    </div>
                                                                    <div class=" form-group mb-3">
                                                                        <small><label for="tanggal_pinj">Tanggal Pinjam</label></small>
                                                                        <input type="datetime-local" class="form-control" id="tanggal_pinj" name="tanggal_pinj" required>
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <small><label for="tanggal_sele">Tanggal Selesai</label></small>
                                                                        <input type="datetime-local" class="form-control" id="tanggal_sele" name="tanggal_sele" required>
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <small><label for="jumlah_pinjam">Jumlah Alat yang Dipinjam:</label></small>
                                                                        <input type="number" class="form-control" id="jumlah_pinjam" name="jumlah_pinjam" required>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-warning" name="pinjam_alat" style="width: 100%;">Pinjam</button>

                                                                </div>

                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- The Modal Hapus -->
                                                <div class="modal fade" id="hapus<?= $nama_alat_clean; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="exampleModalLabel">Hapus Alat</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form method="post">
                                                                    <input type="hidden" name="nama_alat" value="<?= $nama_alat; ?>">
                                                                    <div class="mb-3">
                                                                        Apakah Anda yakin ingin menghapus stok <?= $nama_alat; ?> dengan jumlah <?= $jumlah_alat; ?>?
                                                                    </div>
                                                                    <br>
                                                                    <button type="submit" class="btn btn-danger" name="hapusalat" style="width: 100%;">Hapus</button>
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
            <script src="../js/validasi_jumlah_pinjam_alat.js"></script>
            <script src="../js/validasi_jumlah_edit.js"></script>
            <script src="../js/validasi_jumlah_tambah.js"></script>
            <script src="../js/date-input-validation.js"></script>
            <script src="../js/scroll-to-top.js"></script>
            <script src="../js/refresher.js"></script>
            <script>
                window.onload = function() {
                    autoRefresh();
                };
            </script>

        </body>

        <!-- The Modal Tambah-->
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Tambah Peralatan</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method="post" onsubmit="return validasi_jumlah_tambah()">
                            <div class="mb-3">
                                <small><label for="nama_alat" class="form-label">Nama Alat</label></small>
                                <input type="text" id="nama_alat" name="nama_alat" placeholder="Nama alat" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <small><label for="jumlah_alat" class="form-label">Jumlah Alat</label></small>
                                <input type="number" id="jumlah_alat_baru" name="jumlah_alat_baru" placeholder="Jumlah" class="form-control" required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary" name="tambahalat" style="width: 100%;">Tambah</button>
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