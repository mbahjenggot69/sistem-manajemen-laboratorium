<?php
// VALIDASI AKUN DENGAN DATABASE
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $cekdatabase = mysqli_query($koneksi, "SELECT * FROM daftar_akun WHERE username='$username' AND password='$password'");
    $hitung = mysqli_num_rows($cekdatabase);

    if ($hitung > 0) {
        $ambildaritabel = mysqli_fetch_array($cekdatabase);

        $role = $ambildaritabel['role'];
        $nama_lgkp = $ambildaritabel['nama_lgkp'];
        $_SESSION['username'] = $username;
        $_SESSION['nama_lgkp'] = $nama_lgkp;

        if ($role == 'superadmin') {
            $_SESSION['log'] = 'Logged';
            $_SESSION['role'] = 'superadmin';
            header('location:superadmin/index.php');
        } elseif ($role == 'admin') {
            $_SESSION['log'] = 'Logged';
            $_SESSION['role'] = 'admin';
            header('location:admin/index.php');
        } elseif ($role == 'moderator') {
            $_SESSION['log'] = 'Logged';
            $_SESSION['role'] = 'moderator';
            header('location:moderator/index.php');
        } else {
            $_SESSION['log'] = 'Logged';
            $_SESSION['role'] = 'user';
            header('location:user/index.php');
        }
    } else {
        header('location:login.php');
    }
}

if (isset($_SESSION['log'])) {
    if ($_SESSION['role'] === 'superadmin') {
        header('location:superadmin/index.php');
    } elseif ($_SESSION['role'] === 'admin') {
        header('location:admin/index.php');
    } elseif ($_SESSION['role'] === 'moderator') {
        header('location:moderator/index.php');
    } else {
        header('location:user/index.php');
    }
}
