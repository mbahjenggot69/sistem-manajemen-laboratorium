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
        header("Location: daftar_akun.php?id_labo=$id_labo&id_faku=$id_faku");
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
        <title>Daftar Akun - Sistem Informasi Manajemen Laboratorium</title>
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
                        <h1 class="mt-4">Daftar Akun</h1>
                        <div class="fs-5 fw-light mb-4">
                            <p>Sistem Informasi Manajemen Laboratorium</p>
                        </div>
                        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Daftar Fakultas</a></li>
                                <li class="breadcrumb-item"><a href="daftar_laboratorium.php?id_faku=<?= $id_faku; ?>">Daftar Laboratorium</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Daftar Akun</li>
                            </ol>
                        </nav>
                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                    Tambah Admin
                                </button>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Email</th>
                                            <th>No Telepon</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ambilsemuadatalogin = mysqli_query($koneksi, "SELECT * FROM daftar_akun");
                                        $nomor = 1;
                                        while ($data = mysqli_fetch_array($ambilsemuadatalogin)) {
                                            $id_akun = $data['id_akun'];
                                            $nama_lgkp = $data['nama_lgkp'];
                                            $email = $data['email'];
                                            $nomor_telp = $data['nomor_telp'];
                                            $username = $data['username'];
                                            $password = $data['password'];
                                            $role = $data['role'];
                                        ?>
                                            <tr>
                                                <td><?= $nomor++; ?></td>
                                                <td><?= $nama_lgkp; ?></td>
                                                <td><?= $email; ?></td>
                                                <td><?= $nomor_telp; ?></td>
                                                <td><?= $username; ?></td>
                                                <td><?= $password; ?></td>
                                                <td><?= $role; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $id_akun; ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $id_akun; ?>">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- The Modal Edit -->
                                            <div class="modal fade" id="edit<?= $id_akun; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="exampleModalLabel">Edit Akun</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <form method="post">
                                                                <input type="hidden" name="id_akun" value="<?= $id_akun; ?>">
                                                                <div class="mb-3">
                                                                    <small><label for="role" class="form-label">Role</label></small>
                                                                    <select class="form-select" id="role" name="role" required>
                                                                        <option value="" disabled selected hidden>Pilih di sini</option>
                                                                        <option value="user">User</option>
                                                                        <option value="admin">Admin</option>
                                                                        <option value="superadmin">Super Admin</option>
                                                                    </select>
                                                                </div>
                                                                <br>
                                                                <button type="submit" class="btn btn-warning" name="editakun" style="width: 100%;">Edit</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- The Modal Hapus -->
                                            <div class="modal fade" id="hapus<?= $id_akun; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="exampleModalLabel">Hapus Akun</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <form method="post">
                                                                <input type="hidden" name="id_akun" value="<?= $id_akun; ?>">
                                                                <div class="mb-3">
                                                                    Apakah Anda yakin ingin menghapus akun atas nama <?= $nama_lgkp; ?> dengan role <?= $role; ?>?
                                                                </div>
                                                                <button type="submit" class="btn btn-danger" name="hapusakun" style="width: 100%;">Hapus</button>
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
                                                            <h4 class="modal-title" id="exampleModalLabel">Tambah Akun</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <!-- Modal for Adding Reservation -->
                                                        <div class="modal-body">
                                                            <form method="post">
                                                                <div class="mb-3">
                                                                    <small><label for="nama_lgkp" class="form-label">Nama Lengkap</label></small>
                                                                    <input type="text" placeholder="Nama lengkap" class="form-control" id="nama_lgkp" name="nama_lgkp" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <small><label for="email" class="form-label">Email</label></small>
                                                                    <input type="text" placeholder="Email" class="form-control" id="email" name="email" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <small><label for="nomor_telp" class="form-label">Nomor Telepon</label></small>
                                                                    <input type="text" placeholder="Nomor telepon" class="form-control" id="nomor_telp" name="nomor_telp" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <small><label for="username" class="form-label">Username</label></small>
                                                                    <input type="text" placeholder="Username" class="form-control" id="username" name="username" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <small><label for="password" class="form-label">Password</label></small>
                                                                    <input type="text" placeholder="Password" class="form-control" id="password" name="password" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <small><label for="role" class="form-label">Role</label></small>
                                                                    <select class="form-select" id="role" name="role" required>
                                                                        <option value="" disabled selected hidden>Pilih di sini</option>
                                                                        <option value="user">User</option>
                                                                        <option value="admin">Admin</option>
                                                                        <option value="superadmin">Super Admin</option>
                                                                    </select>
                                                                </div>
                                                                <br>
                                                                <button type="submit" class="btn btn-primary" name="tambahakun" style="width: 100%;">Tambah</button>
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