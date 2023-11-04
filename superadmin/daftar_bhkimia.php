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
        header("Location: daftar_bhkimia.php?id_labo=$id_labo&id_faku=$id_faku");
        exit();
    }
    $ambildaritabel = mysqli_query($koneksi, "SELECT * FROM daftar_lab WHERE id_faku = $id_faku AND id_labo = $id_labo");
    if (mysqli_num_rows($ambildaritabel) > 0) {

        if ($ambildaritabel) {
            $data = mysqli_fetch_assoc($ambildaritabel);
            $nama_faku = $data['fakultas'];
            $nama_labo = $data['nama_labo'];
        } else {
            header("Location: daftar_bhkimia.php?id_labo=$id_labo&id_faku=$id_faku");
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
            <title>Daftar Bahan Kimia <?= $nama_labo; ?> - Sistem Informasi Manajemen Laboratorium</title>
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
                            <h1 class="mt-4">Daftar Bahan Kimia <?= $nama_labo; ?></h1>
                            <div class="fs-5 fw-light mb-4">
                                <p>Sistem Informasi Manajemen Laboratorium</p>
                            </div>
                            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Daftar Fakultas</a></li>
                                    <li class="breadcrumb-item"><a href="daftar_laboratorium.php?id_faku=<?= $id_faku; ?>">Daftar Laboratorium</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Daftar Bahan Kimia</li>
                                </ol>
                            </nav>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                                        Tambah Bahan Kimia
                                    </button>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#req">
                                        Keranjang Bahan Kimia
                                    </button>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#dafrequser">
                                        Daftar Request User
                                    </button>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#dafreqadmin">
                                        Daftar Request Admin
                                    </button>
                                </div>
                                <div class="card-body">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Bahan Kimia</th>
                                                <th>Nama Bahan Kimia</th>
                                                <th>Stok</th>
                                                <th>Satuan</th>
                                                <th>Harga per satuan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ambildaritabel = mysqli_query($koneksi, "SELECT * FROM daftar_bhkimia ");
                                            $nomor = 1;
                                            while ($data = mysqli_fetch_array($ambildaritabel)) {
                                                $id_bhkimia = $data['id_bhkimia'];
                                                $kode_bhkimia = $data['kode_bhkimia'];
                                                $nama_bhkimia = $data['nama_bhkimia'];
                                                $bentuk = $data['bentuk'];
                                                $stok = $data['stok'];
                                                $tanggal_masuk = $data['tanggal_masuk'];
                                                $satuan = $data['satuan'];
                                                $harga = $data['harga'];
                                                $keterangan = $data['keterangan'];
                                            ?>
                                                <tr>
                                                    <td><?= $nomor++; ?></td>
                                                    <td><?= $kode_bhkimia; ?></td>
                                                    <td><?= $nama_bhkimia; ?></td>
                                                    <td><?= $stok; ?></td>
                                                    <td><?= $satuan; ?></td>
                                                    <td>Rp<?= number_format($harga, 2); ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $id_bhkimia; ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $id_bhkimia; ?>">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#deskripsi<?= $id_bhkimia; ?>">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#isi<?= $id_bhkimia; ?>">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <!-- The Modal Edit -->
                                                <div class="modal fade" id="edit<?= $id_bhkimia; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="exampleModalLabel">Edit Bahan Kimia</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form method="post" onsubmit="return validasi_edit_bhkimia()">
                                                                    <input type="hidden" name="id_bhkimia" value="<?= $id_bhkimia; ?>">
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <small><label for="kode_bhkimia" class="form-label">Kode Bahan Kimia</label></small>
                                                                            <input type="text" name="kode_bhkimia" value="<?= $kode_bhkimia; ?>" placeholder="Kode" class="form-control" required>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <small><label for="nama_bhkimia" class="form-label">Nama Bahan Kimia</label></small>
                                                                            <input type="text" name="nama_bhkimia" value="<?= $nama_bhkimia; ?>" placeholder="Nama Bahan Kimia" class="form-control" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <small><label for="stok" class="form-label">Stok Bahan Kimia</label></small>
                                                                            <input type="number" placeholder="Stok" value="<?= $stok; ?>" class="form-control" id="stok" name="stok" required>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <small><label for="bentuk" class="form-label">Bentuk Bahan Kimia</label></small>
                                                                            <input type="text" placeholder="Bentuk" value="<?= $bentuk; ?>" class="form-control" id="bentuk" name="bentuk" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <small><label for="satuan" class="form-label">Satuan Berat</label></small>
                                                                            <input type="text" placeholder="Satuan" value="<?= $satuan; ?>" class="form-control" id="satuan" name="satuan" required>
                                                                        </div>
                                                                        <div class="col md-6">
                                                                            <small><label for="harga" class="form-label">Harga per Satuan</label></small>
                                                                            <input type="number" placeholder="Harga" value="<?= $harga; ?>" class="form-control" id="harga" name="harga" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <small><label for="keterangan" class="form-label">Deskripsi dan Panduan Pemakaian</label></small>
                                                                        <textarea name="keterangan" class="form-control" rows="5" id="keterangan" placeholder="Deskripsi dan Panduan Pemakaian" required><?= $keterangan; ?></textarea>
                                                                    </div>
                                                                    <br>
                                                                    <button type="submit" class="btn btn-warning" name="editbhkimia" style="width: 100%;">Edit</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- The Modal Hapus -->
                                                <div class="modal fade" id="hapus<?= $id_bhkimia; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="exampleModalLabel">Hapus Bahan Kimia</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form method="post">
                                                                    <input type="hidden" name="id_bhkimia" value="<?= $id_bhkimia; ?>">
                                                                    <div class="mb-3">
                                                                        Apakah Anda yakin ingin menghapus <?= $nama_bhkimia; ?> dengan kode <?= $kode_bhkimia; ?>?
                                                                    </div>
                                                                    <br>
                                                                    <button type="submit" class="btn btn-danger" name="hapusbhkimia" style="width:100%;">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- The Modal Deskripsi-->
                                                <div class="modal fade" id="deskripsi<?= $id_bhkimia; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="exampleModalLabel">Keterangan <?= $nama_bhkimia; ?></h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <!-- Modal for Adding Reservation -->
                                                            <div class="modal-body">
                                                                <form method="post">
                                                                    <div class="mb-3">
                                                                        <small><label for="tanggal_masuk" class="form-label">Tanggal Masuk</label></small>
                                                                        <input type="text" value="<?= date('d M Y', strtotime($tanggal_masuk)); ?>" class="form-control" id="tanggal_masuk" name="tanggal_masuk" readonly>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <small><label for="bentuk" class="form-label">Bentuk Bahan Kimia</label></small>
                                                                        <input type="text" placeholder="Bentuk" value="<?= $bentuk; ?>" class="form-control" id="bentuk" name="bentuk" readonly>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <small><label for="keterangan" class="form-label">Deskripsi dan Panduan Pemakaian</label></small>
                                                                        <textarea type="text" placeholder="Deskripsi dan Panduan Pemakaian" class="form-control" id="keterangan" name="keterangan" rows="10" readonly><?= $keterangan; ?></textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- The Modal Isi -->
                                                <div class="modal fade" id="isi<?= $id_bhkimia; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="exampleModalLabel"><?= $nama_bhkimia; ?> (<?= $kode_bhkimia; ?>)</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form method="post" onsubmit="return validasi_jumlah_edit()">
                                                                    <input type="hidden" name="kode_bhkimia" value="<?= $kode_bhkimia; ?>">
                                                                    <input type="hidden" name="nama_bhkimia" value="<?= $nama_bhkimia; ?>">
                                                                    <input type="hidden" name="stok" value="<?= $stok; ?>">
                                                                    <input type="hidden" name="harga" value="<?= $harga; ?>">

                                                                    <div class="mb-3">
                                                                        <small><label for="jumlah" class="form-label">Jumlah Bahan Kimia</label></small>
                                                                        <input type="number" placeholder="Jumlah (Sesuaikan dengan satuan berat)" class="form-control" id="jumlah" name="jumlah" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <small><label for="catatan" class="form-label">Catatan</label></small>
                                                                        <textarea type="text" placeholder="Tulis catatan" class="form-control" id="catatan" name="catatan" rows="5"></textarea>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <small><label for="nama_labo" class="form-label">Nama Laboratorium</label></small>
                                                                        <input type="text" class="form-control" id="nama_labo" name="nama_labo" value="<?= $nama_labo; ?>" required>
                                                                    </div>
                                                                    <br>
                                                                    <div class="mb-3">
                                                                        <h6>Masukkan ke keranjang?</h6>
                                                                    </div>
                                                                    <br>
                                                                    <div style="display: flex; justify-content: space-between;">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" style="width:48%;">Tidak</button>
                                                                        <button type="submit" class="btn btn-primary" name="reqbhkimia" style="width: 48%;">Ya</button>
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
            <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
            <script src="../js/datatables-simple-demo.js"></script>
            <script src="../js/scroll-to-top.js"></script>
            <script src="../js/refresher.js"></script>
            <script src="../js/validasi_tambah_kimia.js"></script>
            <script src="../js/validasi_jumlah_edit.js"></script>
            <script src="../js/validasi_edit_bhkimia.js"></script>
            <script>
                window.onload = function() {
                    autoRefresh();
                };
            </script>

        </body>

        <!-- The Modal Tambah -->
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Tambah Bahan Kimia</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Modal for Adding Reservation -->
                    <div class="modal-body">
                        <form method="post" onsubmit="return validasi_tambah_kimia()">
                            <div class="mb-3">
                                <small><label for="kode_bhkimia" class="form-label">Kode Bahan Kimia</label></small>
                                <input type="text" placeholder="Kode" class="form-control" id="kode_bhkimia" name="kode_bhkimia" required>
                            </div>
                            <div class="mb-3">
                                <small><label for="nama_bhkimia" class="form-label">Nama Bahan Kimia</label></small>
                                <input type="text" placeholder="Nama" class="form-control" id="nama_bhkimia" name="nama_bhkimia" required>
                            </div>
                            <div class="mb-3">
                                <small><label for="bentuk" class="form-label">Bentuk Bahan Kimia</label></small>
                                <input type="text" placeholder="Bentuk" class="form-control" id="bentuk" name="bentuk" required>
                            </div>
                            <div class="mb-3">
                                <small><label for="satuan" class="form-label">Satuan Berat</label></small>
                                <input type="text" placeholder="Satuan" class="form-control" id="satuan" name="satuan" required>
                            </div>
                            <div class="mb-3">
                                <small><label for="harga" class="form-label">Harga per Satuan</label></small>
                                <input type="number" placeholder="Harga" class="form-control" id="harga" name="harga" required>
                            </div>
                            <div class="mb-3">
                                <small><label for="stok" class="form-label">Stok Bahan Kimia</label></small>
                                <input type="number" placeholder="Stok" class="form-control" id="stok" name="stok" required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary" name="tambahbhkimia" style="width: 100%;">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- The Modal Request-->
        <div class="modal fade" id="req" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg"> <!-- Tambahkan class modal-lg untuk modal ukuran besar -->
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Request Bahan Kimia</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Modal Body with Table -->
                    <div class="modal-body">
                        <form method="post">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Kode Bahan Kimia</th>
                                        <th>Nama Bahan Kimia</th>
                                        <th>Jumlah</th>
                                        <th>Total Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ambildaritabel = mysqli_query($koneksi, "SELECT * FROM daftar_request WHERE id_faku = '$id_faku' AND status = 'In Queue' AND username =  '$username'");
                                    $nomor = 1;
                                    $totalHarga = 0;
                                    while ($data = mysqli_fetch_array($ambildaritabel)) {
                                        $id_req = $data['id_req'];
                                        $kode_bhkimia = $data['kode_bhkimia'];
                                        $nama_bhkimia = $data['nama_bhkimia'];
                                        $jumlah = $data['jumlah'];
                                        $tanggal_req = $data['tanggal_req'];
                                        $total_harga = $data['total_harga'];
                                        $catatan = $data['catatan'];

                                        $ambilTotalHarga = mysqli_query($koneksi, "SELECT SUM(total_harga) as total_harga FROM daftar_request WHERE id_faku = '$id_faku' AND status = 'In Queue' AND username = '$username'");
                                        $dataTotalHarga = mysqli_fetch_assoc($ambilTotalHarga);
                                        $totalHarga = $dataTotalHarga['total_harga'];

                                    ?>
                                        <tr>
                                            <td><?= $kode_bhkimia; ?></td>
                                            <td><?= $nama_bhkimia; ?></td>
                                            <td><?= $jumlah; ?></td>
                                            <td>Rp<?= number_format($total_harga, 2); ?></td>
                                            <td>
                                                <form method="post">
                                                    <input type="hidden" name="id_req" value="<?= $id_req; ?>">
                                                    <button type="submit" class="btn btn-danger" name="hapusqueuebhkimia">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        <input type="hidden" name="kode_bhkimia[]" value="<?= $kode_bhkimia; ?>">
                                        <?php

                                        ?>
                                    <?php
                                    }
                                    ?>
                                </tbody>

                            </table>

                            <h6 style="text-align: right;">Total Harga: Rp<?= number_format($totalHarga, 2); ?></h6>


                            <div class="modal-footer">
                                <button type="submit" class="btn btn-warning" name="reqAllBhkimia" style="width: 100%;">Request</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- The Modal Daftar Request User-->
        <div class="modal fade" id="dafrequser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Daftar Request Bahan Kimia</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Modal Body with Table -->
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Kode Bahan Kimia</th>
                                    <th>Nama Bahan Kimia</th>
                                    <th>Jumlah</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ambildaritabel = mysqli_query($koneksi, "SELECT * FROM daftar_request WHERE id_faku = '$id_faku' AND status IN ('Requested', 'Dikirim') AND username =  '$username'");
                                $nomor = 1;
                                while ($data = mysqli_fetch_array($ambildaritabel)) {
                                    $id_req = $data['id_req'];
                                    $kode_bhkimia = $data['kode_bhkimia'];
                                    $nama_bhkimia = $data['nama_bhkimia'];
                                    $jumlah = $data['jumlah'];
                                    $tanggal_req = $data['tanggal_req'];
                                    $total_harga = $data['total_harga'];
                                    $status = $data['status'];
                                    $catatan = $data['catatan'];
                                ?>
                                    <tr>
                                        <td><?= $kode_bhkimia; ?></td>
                                        <td><?= $nama_bhkimia; ?></td>
                                        <td><?= $jumlah; ?></td>
                                        <td>Rp<?= number_format($total_harga, 2); ?></td>
                                        <td><?= $status; ?></td>
                                        <td>
                                            <form method="post">
                                                <input type="hidden" name="id_req" value="<?= $id_req; ?>">
                                                <button type="submit" class="btn btn-success" name="selesaibhkimia">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
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
        </div>
        <!-- The Modal Daftar Request Admin-->
        <div class="modal fade" id="dafreqadmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Daftar Request Bahan Kimia</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Modal Body with Table -->
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Kode Bahan Kimia</th>
                                    <th>Nama Bahan Kimia</th>
                                    <th>Jumlah</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ambildaritabel = mysqli_query($koneksi, "SELECT * FROM daftar_request WHERE id_faku = '$id_faku' AND status = 'Requested' AND username =  '$username'");

                                $nomor = 1;
                                $totalHarga = 0;
                                while ($data = mysqli_fetch_array($ambildaritabel)) {

                                    $id_req = $data['id_req'];
                                    $kode_bhkimia = $data['kode_bhkimia'];
                                    $nama_bhkimia = $data['nama_bhkimia'];
                                    $jumlah = $data['jumlah'];
                                    $tanggal_req = $data['tanggal_req'];
                                    $total_harga = $data['total_harga'];
                                    $status = $data['status'];
                                    $catatan = $data['catatan'];



                                    $ambilTotalHarga = mysqli_query($koneksi, "SELECT SUM(total_harga) as total_harga FROM daftar_request WHERE id_faku = '$id_faku' AND status = 'Requested' AND username = '$username'");
                                    $dataTotalHarga = mysqli_fetch_assoc($ambilTotalHarga);
                                    $totalHarga = $dataTotalHarga['total_harga'];

                                ?>
                                    <tr>
                                        <td><?= $kode_bhkimia; ?></td>
                                        <td><?= $nama_bhkimia; ?></td>
                                        <td><?= $jumlah; ?></td>
                                        <td>Rp<?= number_format($total_harga, 2); ?></td>
                                        <td><?= $status; ?></td>
                                        <td>
                                            <form method="post">
                                                <input type="hidden" name="id_req" value="<?= $id_req; ?>">
                                                <input type="hidden" name="nama_bhkimia" value="<?= $nama_bhkimia; ?>">
                                                <input type="hidden" name="jumlah" value="<?= $jumlah; ?>">
                                                <button type="submit" class="btn btn-success" name="kirimbhkimia">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>


                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <h6 style="text-align: right;">Total Harga: Rp<?= number_format($totalHarga, 2); ?></h6>
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