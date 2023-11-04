<?php
require 'function_public.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SIMERA | Register</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" href="assets/img/Logo_SIMERA_3.png" type="image/x-icon" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Profil Anda</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <?php
                                        $username = $_SESSION['username'];
                                        $profile = mysqli_query($koneksi, "SELECT * FROM daftar_akun WHERE username = '$username'");
                                        // Periksa apakah query berhasil dijalankan
                                        if ($profile) {
                                            $data = mysqli_fetch_assoc($profile);

                                            $nama = $data['nama_lgkp'];
                                            $email = $data['email'];
                                            $role = $data['role'];
                                            $telp = $data['nomor_telp'];
                                            $username = $data['username'];
                                            $password = $data['password'];
                                            $id = $data['id_akun'];
                                        ?>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="namaawal" class="form-label">Name</label>
                                                    <input class="form-control" id="nama" name="nama" value="<?= $nama; ?>" type="text" readonly />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input class="form-control" id="email" name="email" value="<?= $email; ?>" type="text" readonly />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="role" class="form-label">Role</label>
                                                    <input class="form-control" id="role" name="role" value="<?= $role; ?>" type="text" readonly />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input class="form-control" id="username" name="username" value="<?= $username; ?>" type="text" readonly />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input class="form-control" id="password" name="password" value="<?= $password; ?>" type="password" placeholder="Enter your password" />
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-2">
                                                <!-- Button tidak perlu diubah menjadi readonly karena button tidak mempunyai atribut readonly -->
                                                <button type="submit" class="btn btn-primary" name="profil" style="width: 100%;">Simpan</button>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-4 pb-2">
                                    <p class="fs-6 fw-light"><a href="login.php" style="text-decoration-line: none; font-weight:500">Kembali</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>