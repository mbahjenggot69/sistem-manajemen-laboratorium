<?php
require 'function_public.php';
require 'function_login.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - Sistem Informasi Manajemen Ruangan</title>
    <link rel="icon" href="assets/img/logo-simela-icon.png" type="image/png">
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header text-center d-flex flex-column align-items-center">
                                    <img src="assets/img/logo-simela-landscape.png" width="300px" alt="Logo" />
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-floating mt-4 mb-3">
                                            <input class="form-control" name="username" id="inputUsername" type="username" placeholder="Username" />
                                            <label for="inputUsername">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mt-3">
                                            <button class="btn btn-primary" style="width : 100% " name="login">Login</button>
                                        </div>
                                        <br>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-3 pb-1">
                                    <p class="fs-6 fw-light">Belum punya akun? <a href="register.php" style="text-decoration-line: none; font-weight:500">Register</a></p>
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