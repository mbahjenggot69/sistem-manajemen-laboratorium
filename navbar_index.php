<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.php">
        <img src="../assets/img/logo-simela-landscape.png" alt="Logo" width="120px">
    </a>
    <!-- Navbar-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i> <?php echo $_SESSION['nama_lgkp']; ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="../profile.php">
                            Profil Anda
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </li>
        </ul>
    </form>
</nav>