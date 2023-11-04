<?php
session_start();

// KONEKSI KE DATABASE
$koneksi = mysqli_connect("localhost", "root", "", "simera_beta");

// TAMBAH FAKULTAS FIXED
if (isset($_POST['tambahfakultas'])) {
    $nama_faku = $_POST['nama_faku'];
    $prodi = $_POST['prodi'];
    $jumlah_labo = $_POST['jumlah_labo'];

    if ($jumlah_labo <= 0) {
        echo "<script>alert('Jumlah laboratorium harus lebih dari 0.');</script>";
    } else {
        $result = mysqli_query($koneksi, "SELECT MAX(id_faku) AS max_id FROM daftar_lab");
        $row = mysqli_fetch_assoc($result);
        $max_id = $row['max_id'];

        $ambilnama = mysqli_query($koneksi, "SELECT fakultas FROM daftar_lab WHERE fakultas = '$nama_faku'");
        $data = mysqli_fetch_assoc($ambilnama);
        $pencocokan = $data['fakultas'];

        if ($nama_faku === $pencocokan) {
            for ($i = 0; $i < $jumlah_labo; $i++) {
                $tambahketabel = mysqli_query($koneksi, "INSERT INTO daftar_lab (id_faku, kode_labo, nama_labo, prodi, fakultas, nama_lgkp) VALUES ('$max_id', '-', '-', '$prodi', '$nama_faku', '-')");
                if (!$tambahketabel) {
                    echo "<script>alert('GAGAL MENAMBAH FAKULTAS');</script>";
                    break;
                }
            }
            if ($tambahketabel) {
                echo "<script>alert('SUKSES MENAMBAH FAKULTAS\nMohon isi detail sebelum dipakai!');</script>";
            } else {
                echo "<script>alert('GAGAL MENAMBAH FAKULTAS');</script>";
            }
        } else {
            $new_id_faku = $max_id + 1;
            for ($i = 0; $i < $jumlah_labo; $i++) {
                $tambahketabel = mysqli_query($koneksi, "INSERT INTO daftar_lab (id_faku, kode_labo, nama_labo, prodi, fakultas, nama_lgkp) VALUES ('$new_id_faku', '-', '-', '$prodi', '$nama_faku', '-')");
                if (!$tambahketabel) {
                    echo "<script>alert('GAGAL MENAMBAH FAKULTAS');</script>";
                    break;
                }
            }
            if ($tambahketabel) {
                echo "<script>alert('SUKSES MENAMBAH FAKULTAS\nMohon isi detail sebelum dipakai!');</script>";
            } else {
                echo "<script>alert('GAGAL MENAMBAH FAKULTAS');</script>";
            }
        }
    }
}

// EDIT FAKULTAS FIXED
if (isset($_POST['editfakultas'])) {
    $id_faku = $_POST['id_faku'];
    $nama_faku = $_POST['nama_faku'];
    $prodi = $_POST['prodi'];
    $jumlah_labo = $_POST['jumlah_labo'];
    $edit_jumlah_labo = $_POST['edit_jumlah_labo'];

    if ($edit_jumlah_labo > $jumlah_labo) {
        $edit_jumlah_labo = $edit_jumlah_labo - $jumlah_labo;
        for ($i = 0; $i < $edit_jumlah_labo; $i++) {
            $tambahketabel = mysqli_query($koneksi, "INSERT INTO daftar_lab (id_faku, kode_labo, nama_labo, prodi, fakultas, nama_lgkp) VALUES ('$id_faku', '-', '-', '$prodi', '$nama_faku', '-')");

            if (!$tambahketabel) {
                echo "<script>alert('GAGAL MENAMBAH LABORATORIUM');</script>";
                break;
            }
        }
        if ($i == $edit_jumlah_labo) {
            echo "<script>alert('SUKSES MENAMBAH $edit_jumlah_labo LABORATORIUM');</script>";
        }
    } elseif ($edit_jumlah_labo < $jumlah_labo) {
        $edit_jumlah_labo = $jumlah_labo - $edit_jumlah_labo;
        $kurangtabel = mysqli_query($koneksi, "DELETE FROM daftar_lab WHERE id_faku='$id_faku'LIMIT $edit_jumlah_labo ");

        if ($kurangtabel) {
            echo "<script>alert('SUKSES MENGURANGI $edit_jumlah_labo LABORATORIUM');</script>";
        }
    } else {
        header('location:index.php');
        exit();
    }
}

// HAPUS FAKULTAS FIXED
if (isset($_POST['hapusfakultas'])) {
    $id_faku = $_POST['id_faku'];

    $hapusdaritabel = mysqli_query($koneksi, "DELETE FROM daftar_lab WHERE id_faku='$id_faku'");
}

// TAMBAH LABORATORIUM FIXED
if (isset($_POST['tambahlaboratorium'])) {
    $id_faku = $_GET['id_faku'];
    $kode_labo = $_POST['kode_labo'];
    $nama_labo = $_POST['nama_labo'];
    $nama_lgkp = $_POST['nama_lgkp'];
    $kapasitas = $_POST['kapasitas'];

    $tambahketabel = mysqli_query($koneksi, "INSERT INTO daftar_lab (id_faku, kode_labo, nama_labo, nama_lgkp, kapasitas) VALUES ('$id_faku', '$kode_labo', '$nama_labo', '$nama_lgkp', '$kapasitas')");

    if ($tambahketabel) {
        header("Location: daftar_laboratorium.php?id_faku=$id_faku");
        exit();
    } else {
        header("Location: daftar_laboratorium.php?id_faku=$id_faku");
        exit();
    }
}

// EDIT LABORATORIUM FIXED
if (isset($_POST['editlaboratorium'])) {
    $id_faku = $_GET['id_faku'];
    $id_labo = $_POST['id_labo'];
    $kode_labo = $_POST['kode_labo'];
    $nama_labo = $_POST['nama_labo'];
    $nama_lgkp = $_POST['nama_lgkp'];
    $kapasitas = $_POST['kapasitas'];

    $editdaritabel = mysqli_query($koneksi, "UPDATE daftar_lab SET kode_labo='$kode_labo',nama_labo='$nama_labo',nama_lgkp='$nama_lgkp',kapasitas='$kapasitas' WHERE id_labo='$id_labo'");

    if ($editdaritabel) {
        header("Location: daftar_laboratorium.php?id_faku=$id_faku");
        exit();
    } else {
        header("Location: daftar_laboratorium.php?id_faku=$id_faku");
        exit();
    }
}

// HAPUS LABORATORIUM FIXED
if (isset($_POST['hapuslaboratorium'])) {
    $id_faku = $_GET['id_faku'];
    $id_labo = $_POST['id_labo'];

    $hapusdaritabel = mysqli_query($koneksi, "DELETE FROM daftar_lab WHERE id_labo='$id_labo'");

    if ($hapusdaritabel) {
        header("Location: daftar_laboratorium.php?id_faku=$id_faku");
        exit();
    } else {
        header("Location: daftar_laboratorium.php?id_faku=$id_faku");
        exit();
    }
}

// TAMBAH ALAT BARU FIXED
if (isset($_POST['tambahalat'])) {
    $username = $_SESSION['username'];
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $nama_alat = $_POST['nama_alat'];
    $jumlah_alat = $_POST['jumlah_alat_baru'];


    if ($jumlah_alat > 0) {
        for ($i = 0; $i < $jumlah_alat; $i++) {
            $tambahketabel = mysqli_query($koneksi, "INSERT INTO daftar_alat (id_labo, id_faku, nama_alat, kode_alat, harga, kondisi, pemilik) VALUES ('$id_labo', '$id_faku', '$nama_alat', '-', 0, '-', '$username')");

            if (!$tambahketabel) {
                echo "<script>alert('Gagal menambah alat');</script>";
                break;
            }
        }
        header("Location: pinjam_peralatan.php?id_labo=$id_labo&id_faku=$id_faku");
        exit();
    } else {
        header("Location: pinjam_peralatan.php?id_labo=$id_labo&id_faku=$id_faku");
        exit();
    }
}

// EDIT ALAT BARU FIXED
if (isset($_POST['edit_jumlah_alat'])) {
    $nama = $_POST['nama'];
    $jumlah_alat = $_POST['jumlah_alat'];
    $jumlah = $_POST['jumlah'];

    if ($jumlah > $jumlah_alat) {
        $jumlah = $jumlah - $jumlah_alat;
        for ($i = 0; $i < $jumlah; $i++) {
            $tambahketabel = mysqli_query($koneksi, "INSERT INTO daftar_alat (nama_alat, kode_alat, harga, kondisi, status) VALUES ('$nama', '-', 0, '-', 0)");

            if (!$tambahketabel) {
                echo "<script>alert('Gagal menambah alat');</script>";
                break;
            }
        }
        if ($i == $jumlah) {
            echo "<script>alert('Sukses menambah $jumlah alat');</script>";
        }
    } elseif ($jumlah < $jumlah_alat) {
        $jumlah = $jumlah_alat - $jumlah;
        $kurangtabel = mysqli_query($koneksi, "DELETE FROM daftar_alat WHERE nama_alat = '$nama' LIMIT $jumlah ");
    } else {
        echo "<script>alert('Anda bodoh!');</script>";
    }
}

// HAPUS ALAT BARU FIXED
if (isset($_POST['hapusalat'])) {
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $nama_alat = $_POST['nama_alat'];

    $hapusdaritabel = mysqli_query($koneksi, "DELETE FROM daftar_alat WHERE nama_alat='$nama_alat'");

    if ($hapusdaritabel) {
        $hapusdaritabel = mysqli_query($koneksi, "DELETE FROM daftar_alat WHERE nama_alat='$nama_alat'");
    }

    header("Location: pinjam_peralatan.php?id_labo=$id_labo&id_faku=$id_faku");
    exit();
}

// EDIT DETAIL FIXED
if (isset($_POST['editdetail'])) {
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $id_alat = $_POST['id_alat'];
    $nama_alat = $_POST['nama_alat'];
    $kode_alat = $_POST['kode_alat'];
    $kode_modl = $_POST['kode_modl'];
    $harga = $_POST['harga'];
    $kondisi = $_POST['kondisi'];
    $catatan = $_POST['catatan'];

    $ambildaritabel1 = mysqli_query($koneksi, "SELECT kode_alat FROM daftar_alat WHERE id_alat != '$id_alat'");
    $kode_alat_available = array();

    $ambildaritabel2 = mysqli_query($koneksi, "SELECT status FROM daftar_alat WHERE id_alat='$id_alat'");
    $data = mysqli_fetch_assoc($ambildaritabel2);
    $status = $data['status'];

    while ($row = mysqli_fetch_assoc($ambildaritabel1)) {
        $kode_alat_available[] = $row['kode_alat'];
    }

    if ($status != 'Dipinjam' && !in_array($kode_alat, $kode_alat_available)) {
        $editdaritabel = mysqli_query($koneksi, "UPDATE daftar_alat SET status='Tersedia', kode_alat='$kode_alat', kode_modl = '$kode_modl', harga='$harga', kondisi='$kondisi', catatan='$catatan' WHERE id_alat='$id_alat'");
    } elseif ($status != 'Dipinjam' && in_array($kode_alat, $kode_alat_available)) {
        echo "<script>alert('Kode alat sudah digunakan!');</script>";
    } else {
        // Redirect atau tindakan lainnya jika alat sedang dipinjam
        header("Location: detail_peralatan.php?nama_alat=$nama_alat&id_labo=$id_labo&id_faku=$id_faku");
        exit();
    }
}

// HAPUS DETAIL FIXED
if (isset($_POST['hapusdetail'])) {
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $id_alat = $_POST['id_alat'];
    $nama_alat = $_POST['nama_alat'];

    $ambildaritabel = mysqli_query($koneksi, "SELECT status FROM daftar_alat WHERE id_alat='$id_alat'");
    $data = mysqli_fetch_assoc($ambildaritabel);
    $status = $data['status'];

    if ($status !== 'Dipinjam') {
        $hapusdaritabel = mysqli_query($koneksi, "DELETE FROM daftar_alat WHERE id_alat='$id_alat'");

        if ($hapusdaritabel) {
            $ambildaritabel = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah_sisa FROM daftar_alat WHERE nama_alat='$nama_alat' AND status='Tersedia'");

            if ($ambildaritabel) {
                $data = mysqli_fetch_assoc($ambildaritabel);
                $jumlah_sisa = $data['jumlah_sisa'];
                if ($editdaritabel) {
                    header("Location: detail_peralatan.php?nama_alat=$nama_alat&id_labo=$id_labo&id_faku=$id_faku");
                    exit();
                }
            }
        }
    }

    header("Location: detail_peralatan.php?nama_alat=$nama_alat&id_labo=$id_labo&id_faku=$id_faku");
    exit();
}

// TAMBAH JADWAL FIXED
if (isset($_POST['tambahjadwal'])) {
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $username = $_SESSION['username'];
    $selectedValue = $_POST['nama_modl'];
    list($kode_modl, $nama_modl) = explode(',', $selectedValue);
    $tanggal_pinj = $_POST['tanggal_pinj'];
    $tanggal_sele = $_POST['tanggal_sele'];
    $nama_lgkp = $_POST['nama_lgkp'];
    $kode_pinj = str_pad(rand(0, 9999), 5, '0', STR_PAD_LEFT);

    $statusdipinjam1 = mysqli_prepare($koneksi, "UPDATE daftar_alat SET kode_pinj = ?, tipe = 'Praktikum' 
    WHERE kondisi = 'Baik' AND status = 'Tersedia' AND kode_modl LIKE ?");

    $tambahketabel1 = mysqli_prepare($koneksi, "INSERT INTO daftar_jadwal (id_labo, id_faku, kode_modl, nama_modl, tanggal_pinj, tanggal_sele, nama_lgkp, kode_pinj) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $tambahketabel2 = mysqli_prepare($koneksi, "INSERT INTO daftar_riwayat (id_labo, id_faku, kode_alat, nama_alat, kode_pinj, tanggal_pinj, tanggal_sele, nama_lgkp, role, tipe) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'Praktikum')");

    mysqli_stmt_bind_param($statusdipinjam1, "ss", $kode_pinj, $kode_modl_like);
    mysqli_stmt_bind_param($tambahketabel1, "iissssss", $id_labo, $id_faku, $kode_modl, $nama_modl, $tanggal_pinj, $tanggal_sele, $nama_lgkp, $kode_pinj);
    mysqli_stmt_bind_param($tambahketabel2, "iisssssss", $id_labo, $id_faku, $kode_modl, $nama_modl, $kode_pinj, $tanggal_pinj, $tanggal_sele, $nama_lgkp, $username);

    $kode_modl_like = '%' . $kode_modl . '%';

    $statusdipinjam1_result = mysqli_stmt_execute($statusdipinjam1);
    $tambahketabel1_result = mysqli_stmt_execute($tambahketabel1);
    $tambahketabel2_result = mysqli_stmt_execute($tambahketabel2);

    if ($statusdipinjam1_result && $tambahketabel1_result && $tambahketabel2_result) {
        header("Location: pinjam_laboratorium.php?id_labo=$id_labo&id_faku=$id_faku");
        exit();
    }
}


// SELESAI JADWAL FIXED
if (isset($_POST['selesaijadwal'])) {
    $username = $_SESSION['username'];
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $id_jdwl = $_POST['id_jdwl'];
    $kode_pinj = $_POST['kode_pinj'];
    $nama_lgkp = $_POST['nama_lgkp'];
    $tanggal_pinj = $_POST['tanggal_pinj'];
    $tanggal_sele = $_POST['tanggal_sele'];

    $statusdipinjam = mysqli_query($koneksi, "UPDATE daftar_alat SET status = 'Tersedia', kode_pinj = NULL, tipe = NULL, kode_pinj = NULL WHERE kode_pinj = '$kode_pinj'");
    $statusdipinjam = mysqli_query($koneksi, "UPDATE daftar_riwayat SET tanggal_sele = '$tanggal_sele'");

    $hapusdaritabel = mysqli_query($koneksi, "DELETE FROM daftar_jadwal WHERE id_jdwl = '$id_jdwl'");

    if ($hapusdaritabel && $tambahketabel && $statusdipinjam) {
        header("Location: pinjam_laboratorium.php?id_labo=$id_labo&id_faku=$id_faku");
        exit();
    } else {
        header("Location: pinjam_laboratorium.php?id_labo=$id_labo&id_faku=$id_faku");
        exit();
    }
}

// PINJAM ALAT FIXED
if (isset($_POST['pinjam_alat'])) {
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $username = $_SESSION['username'];
    $nama_alat = $_POST['nama_alat'];
    $nama_lgkp = $_POST['nama_lgkp'];
    $kode_alat = $_POST['kode_alat'];
    $tanggal_pinj = $_POST['tanggal_pinj'];
    $tanggal_sele = $_POST['tanggal_sele'];
    $jumlah_pinjam = $_POST['jumlah_pinjam'];
    $kode_pinjam = uniqid(); // Menghasilkan kode acak

    $checkQuery = mysqli_query($koneksi, "SELECT COUNT(*) AS count FROM jadwal_alat WHERE 
    (('$tanggal_pinj' BETWEEN tanggal_pinj AND tanggal_sele) OR 
    ('$tanggal_sele' BETWEEN tanggal_pinj AND tanggal_sele)) AND 
    (id_labo = '$id_labo' AND id_faku = '$id_faku' AND kode_alat = '$kode_alat')");

    $checkResult = mysqli_fetch_assoc($checkQuery);

    if ($checkResult['count'] == 0) {
        // Tidak ada tanggal bertabrakan, dapat melakukan penambahan data
        $masukjadwal = mysqli_query($koneksi, "INSERT INTO jadwal_alat (id_labo, id_faku, kode_alat, nama_alat, tanggal_pinj, tanggal_sele, nama_lgkp, kode_pinj) 
        VALUES ('$id_labo', '$id_faku', '$kode_alat', '$nama_alat', '$tanggal_pinj', '$tanggal_sele', '$nama_lgkp', '$kode_pinjam')");

        $tambahketabel = mysqli_query($koneksi, "INSERT INTO daftar_riwayat (id_labo, id_faku, kode_alat, nama_alat, kode_pinj, tanggal_pinj, tanggal_sele, nama_lgkp, role, tipe)
        VALUES ('$id_labo', '$id_faku', '$kode_alat', '$nama_alat','$kode_pinjam', '$tanggal_pinj', '$tanggal_sele', '$nama_lgkp', '$username', 'Eksperimen')");

        $pinjamdaristok = mysqli_query($koneksi, "UPDATE daftar_alat SET tanggal_pinj = '$tanggal_pinj', tanggal_sele = '$tanggal_sele', 
        nama_lgkp = '$nama_lgkp', tipe = 'Eksperimen', kode_pinj = '$kode_pinjam' 
        WHERE nama_alat = '$nama_alat' AND status = 'Tersedia' AND kondisi = 'Baik' AND kode_alat = '$kode_alat' LIMIT $jumlah_pinjam");

        if ($masukjadwal && $pinjamdaristok) {
            header('location:pinjam_peralatan.php?id_labo=' . $id_labo . '&id_faku=' . $id_faku);
        } else {
            echo "Gagal menambahkan jadwal alat: " . mysqli_error($koneksi);
        }
    } else { // Dialihkan ke barang lain 
        $ambildaritabel1 = mysqli_query($koneksi, "SELECT * FROM daftar_alat WHERE nama_alat = '$nama_alat' AND kode_alat != '$kode_alat'");
        while ($data = mysqli_fetch_array($ambildaritabel1)) {
            $nama_alatt = $data['nama_alat'];
            $kode_alatt = $data['kode_alat'];

            $checkQuery = mysqli_query($koneksi, "SELECT COUNT(*) AS count FROM jadwal_alat WHERE 
            (('$tanggal_pinj' BETWEEN tanggal_pinj AND tanggal_sele) OR 
            ('$tanggal_sele' BETWEEN tanggal_pinj AND tanggal_sele)) AND 
            (id_labo = '$id_labo' AND id_faku = '$id_faku' AND kode_alat = '$kode_alatt')");

            $checkResult = mysqli_fetch_assoc($checkQuery);

            if ($checkResult['count'] == 0) {
                // Tidak ada tanggal bertabrakan, dapat melakukan penambahan data
                $masukjadwal = mysqli_query($koneksi, "INSERT INTO jadwal_alat (id_labo, id_faku, kode_alat, nama_alat, tanggal_pinj, tanggal_sele, nama_lgkp, kode_pinj) 
                VALUES ('$id_labo', '$id_faku', '$kode_alatt', '$nama_alatt', '$tanggal_pinj', '$tanggal_sele', '$nama_lgkp', '$kode_pinjam')");

                $tambahketabel = mysqli_query($koneksi, "INSERT INTO daftar_riwayat (id_labo, id_faku, kode_alat, nama_alat, kode_pinj, tanggal_pinj, tanggal_sele, nama_lgkp, role, tipe)
                VALUES ('$id_labo', '$id_faku', '$kode_alatt', '$nama_alatt','$kode_pinjam', '$tanggal_pinj', '$tanggal_sele', '$nama_lgkp', '$username', 'Eksperimen')");

                $pinjamdaristok = mysqli_query($koneksi, "UPDATE daftar_alat SET tanggal_pinj = '$tanggal_pinj', tanggal_sele = '$tanggal_sele', 
                nama_lgkp = '$nama_lgkp', tipe = 'Eksperimen', kode_pinj = '$kode_pinjam' 
                WHERE nama_alat = '$nama_alatt' AND status = 'Tersedia' AND kondisi = 'Baik' AND kode_alat = '$kode_alatt' LIMIT $jumlah_pinjam");

                if ($masukjadwal && $pinjamdaristok) {
                    header('location:pinjam_peralatan.php?id_labo=' . $id_labo . '&id_faku=' . $id_faku);
                } else {
                    echo "Gagal menambahkan jadwal alat: " . mysqli_error($koneksi);
                }
            } else {
                echo "<script>alert('Jadwal bertabrakan dengan yang sudah ada!');</script>";
            }
        }
    }
}

// SELESAI ALAT FIXED
if (isset($_POST['selesaialat'])) {
    $username = $_SESSION['username'];
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $id_alat = $_POST['id_alat'];
    $kondisi = $_POST['kondisi'];
    $catatan = $_POST['catatan'];
    $tanggal_sele = $_POST['timestamp'];
    $kode_pinjam = $_POST['kode_pinj'];

    if ($kondisi == 'Baik') {
        $status = 'Tersedia';
    } else {
        $status = 'Tidak Tersedia';
    }

    $tambahketabel = mysqli_query($koneksi, "UPDATE daftar_riwayat SET tanggal_sele = '$tanggal_sele'");

    $editdaritabel = mysqli_query($koneksi, "UPDATE daftar_alat SET status = '$status', kondisi = '$kondisi', catatan = '$catatan',
    kode_pinj = NULL, tanggal_pinj = NULL, tanggal_sele = NULL, tipe = NULL, nama_lgkp = NULL  WHERE kode_pinj = '$kode_pinjam' AND id_alat = '$id_alat'");

    if ($editdaritabel) {
        if ($kondisi == 'Baik') {
            $ambildaritabel = mysqli_query($koneksi, "SELECT nama_alat FROM daftar_alat WHERE id_alat = '$id_alat'");
            $data = mysqli_fetch_assoc($ambildaritabel);
            $nama_alat = $data['nama_alat'];
        }

        if ($editdaritabel) {
            header("Location: daftar_peminjaman_peralatan.php?id_labo=$id_labo&id_faku=$id_faku");
            exit();
        }
    }

    header("Location: daftar_peminjaman_peralatan.php?id_labo=$id_labo&id_faku=$id_faku");
    exit();
}

// TAMBAH MODUL FIXED
if (isset($_POST['tambahmodul'])) {
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $username = $_SESSION['username'];
    $kode_modl = $_POST['kode_modl'];
    $nama_modl = $_POST['nama_modl'];

    $ambildaritabel1 = mysqli_query($koneksi, "SELECT kode_modl, nama_modl FROM daftar_modul");
    $modul_available = array();

    while ($row = mysqli_fetch_assoc($ambildaritabel1)) {
        $modul_available[] = array(
            'kode_modl' => $row['kode_modl'],
            'nama_modl' => $row['nama_modl']
        );
    }

    $kode_modl_exists = false;
    $nama_modl_exists = false;

    foreach ($modul_available as $modl) {
        if ($modl['kode_modl'] === $kode_modl) {
            $kode_modl_exists = true;
        }
        if ($modl['nama_modl'] === $nama_modl) {
            $nama_modl_exists = true;
        }
    }

    if ($kode_modl_exists && $nama_modl_exists) {
        echo "<script>alert('Kode atau nama modul sudah digunakan!');</script>";
    } else {
        $tambahketabel = mysqli_query($koneksi, "INSERT INTO daftar_modul (id_labo, id_faku, kode_modl, nama_modl, pemilik) VALUES ('$id_labo', '$id_faku', '$kode_modl', '$nama_modl', '$username')");
    }
}

// EDIT MODUL FIXED
if (isset($_POST['editmodul'])) {
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $id_modl = $_POST['id_modl'];
    $kode_modl = $_POST['kode_modl'];
    $nama_modl = $_POST['nama_modl'];

    $ambildaritabel1 = mysqli_query($koneksi, "SELECT kode_modl, nama_modl FROM daftar_modul WHERE id_modl != '$id_modl'");
    $modul_available = array();

    while ($row = mysqli_fetch_assoc($ambildaritabel1)) {
        $modul_available[] = array(
            'kode_modl' => $row['kode_modl'],
            'nama_modl' => $row['nama_modl']
        );
    }

    $kode_modl_exists = false;
    $nama_modl_exists = false;

    foreach ($modul_available as $modl) {
        if ($modl['kode_modl'] === $kode_modl) {
            $kode_modl_exists = true;
        }

        if ($modl['nama_modl'] === $nama_modl) {
            $nama_modl_exists = true;
        }
    }

    if (!$kode_modl_exists && !$nama_modl_exists) {
        $editdaritabel = mysqli_query($koneksi, "UPDATE daftar_modul SET kode_modl='$kode_modl', nama_modl='$nama_modl' WHERE id_modl='$id_modl'");
    } else {
        echo "<script>alert('Kode atau nama modul sudah digunakan!');</script>";
    }
}

// EDIT DETAIL MODUL FIXED
if (isset($_POST['editdetailmodul'])) {
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $id_modl = $_GET['id_modl'];
    $id_alat = $_POST['id_alat'];
    $nama_alat = $_POST['nama_alat'];
    $kode_modl = $_POST['kode_modl'];
    $kondisi = $_POST['kondisi'];
    $catatan = $_POST['catatan'];

    $ambildaritabel = mysqli_query($koneksi, "SELECT status FROM daftar_alat WHERE id_alat='$id_alat'");
    $data = mysqli_fetch_assoc($ambildaritabel);
    $status = $data['status'];

    if ($status != 'Dipinjam') {
        if ($kondisi == 'Reparasi' || $kondisi == 'Rusak') {
            $editdaritabel = mysqli_query($koneksi, "UPDATE daftar_alat SET status='Tidak Tersedia', kode_modl = '$kode_modl', kondisi='$kondisi', catatan='$catatan' WHERE id_alat='$id_alat'");
        }

        if ($kondisi == 'Baik') {
            $editdaritabel = mysqli_query($koneksi, "UPDATE daftar_alat SET status='Tersedia', kode_modl = '$kode_modl', kondisi='$kondisi', catatan='$catatan' WHERE id_alat='$id_alat'");
        }
    }

    header("Location: detail_modul.php?id_modl=$id_modl&id_labo=$id_labo&id_faku=$id_faku");
    exit();
}

// HAPUS MODUL FIXED
if (isset($_POST['hapusmodul'])) {
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $id_modl = $_POST['id_modl'];

    $hapusdaritabel = mysqli_query($koneksi, "DELETE FROM daftar_modul WHERE id_modl='$id_modl'");

    if ($hapusdaritabel) {
        header("Location: daftar_modul.php?id_labo=$id_labo&id_faku=$id_faku");
        exit();
    } else {
        header("Location: daftar_modul.php?id_labo=$id_labo&id_faku=$id_faku");
        exit();
    }
}


// TAMBAH BAHAN KIMIA 
if (isset($_POST['tambahbhkimia'])) {
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $username = $_SESSION['username'];
    $kode_bhkimia = $_POST['kode_bhkimia'];
    $nama_bhkimia = $_POST['nama_bhkimia'];
    $bentuk = $_POST['bentuk'];
    $stok = $_POST['stok'];
    $satuan = $_POST['satuan'];
    $harga = $_POST['harga'];

    $ambildaritabel1 = mysqli_query($koneksi, "SELECT kode_bhkimia, nama_bhkimia FROM daftar_bhkimia ");
    $chemical_bhkimia = array();

    while ($row = mysqli_fetch_assoc($ambildaritabel1)) {
        $chemical_bhkimia[] = array(
            'kode_bhkimia' => $row['kode_bhkimia'],
            'nama_bhkimia' => $row['nama_bhkimia']
        );
    }

    $kode_bhkimia_exists = false;
    $nama_bhkimia_exists = false;

    foreach ($chemical_bhkimia as $chemical) {
        if ($chemical['kode_bhkimia'] === $kode_bhkimia) {
            $kode_bhkimia_exists = true;
        }
        if ($chemical['nama_bhkimia'] === $nama_bhkimia) {
            $nama_bhkimia_exists = true;
        }
    }

    if ($kode_bhkimia_exists && $nama_bhkimia_exists) {
        echo "<script>alert('Kode atau nama bahan kimia sudah digunakan!');</script>";
    } else {
        $tambahketabel = mysqli_query($koneksi, "INSERT INTO daftar_bhkimia 
        (id_labo, id_faku, kode_bhkimia, nama_bhkimia, bentuk, stok, satuan, harga,  pemilik) 
        VALUES ('$id_labo', '$id_faku', '$kode_bhkimia', '$nama_bhkimia', '$bentuk', '$stok', '$satuan', '$harga', '$username')");
    }
}

// EDIT BAHAN KIMIA
if (isset($_POST['editbhkimia'])) {
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $id_bhkimia = $_POST['id_bhkimia'];
    $kode_bhkimia = $_POST['kode_bhkimia'];
    $nama_bhkimia = $_POST['nama_bhkimia'];
    $bentuk = $_POST['bentuk'];
    $stok = $_POST['stok'];
    $satuan = $_POST['satuan'];
    $harga = $_POST['harga'];
    $keterangan = $_POST['keterangan'];

    $ambildaritabel1 = mysqli_query($koneksi, "SELECT kode_bhkimia, nama_bhkimia FROM daftar_bhkimia WHERE id_bhkimia != '$id_bhkimia'");
    $chemical_bhkimia = array();

    while ($row = mysqli_fetch_assoc($ambildaritabel1)) {
        $chemical_bhkimia[] = array(
            'kode_bhkimia' => $row['kode_bhkimia'],
            'nama_bhkimia' => $row['nama_bhkimia']
        );
    }

    $kode_bhkimia_exists = false;
    $nama_bhkimia_exists = false;

    foreach ($chemical_bhkimia as $chemical) {
        if ($chemical['kode_bhkimia'] === $kode_bhkimia) {
            $kode_bhkimia_exists = true;
        }

        if ($chemical['nama_bhkimia'] === $nama_bhkimia) {
            $nama_bhkimia_exists = true;
        }
    }

    if (!$kode_bhkimia_exists && !$nama_bhkimia_exists) {
        $editdaritabel = mysqli_query($koneksi, "UPDATE daftar_bhkimia SET kode_bhkimia='$kode_bhkimia', nama_bhkimia='$nama_bhkimia', stok='$stok', bentuk='$bentuk', satuan='$satuan', harga='$harga', keterangan='$keterangan' WHERE id_bhkimia='$id_bhkimia'");
    } else {
        echo "<script>alert('Kode atau nama bahan kimia sudah digunakan!');</script>";
    }
}

// HAPUS BAHAN KIMIA
if (isset($_POST['hapusbhkimia'])) {
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $id_bhkimia = $_POST['id_bhkimia'];

    $hapusdaritabel = mysqli_query($koneksi, "DELETE FROM daftar_bhkimia WHERE id_bhkimia='$id_bhkimia'");

    if ($hapusdaritabel) {
        header("Location: daftar_bhkimia.php?id_labo=$id_labo&id_faku=$id_faku");
        exit();
    } else {
        header("Location: daftar_bhkimia.php?id_labo=$id_labo&id_faku=$id_faku");
        exit();
    }
}

// HAPUS QUEUE BAHAN KIMIA
if (isset($_POST['hapusqueuebhkimia'])) {
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $id_req = $_POST['id_req'];

    $hapusdaritabel = mysqli_query($koneksi, "DELETE FROM daftar_request WHERE id_req = '$id_req'");

    if ($hapusdaritabel) {
        header("Location: daftar_bhkimia.php?id_labo=$id_labo&id_faku=$id_faku");
        exit();
    } else {
        header("Location: daftar_bhkimia.php?id_labo=$id_labo&id_faku=$id_faku");
        exit();
    }
}

// QUEUE BAHAN KIMIA
if (isset($_POST['reqbhkimia'])) {
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $username = $_SESSION['username'];
    $jumlah = $_POST['jumlah'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $catatan = $_POST['catatan'];
    $nama_lgkp = $_POST['nama_lgkp'];
    $nama_labo = $_POST['nama_labo'];
    $nama_bhkimia = $_POST['nama_bhkimia'];
    $kode_bhkimia = $_POST['kode_bhkimia'];

    $total_harga = $jumlah * $harga;

    $input = mysqli_query($koneksi, "INSERT INTO daftar_request (id_labo, id_faku, kode_bhkimia, nama_bhkimia, jumlah, total_harga, nama_lgkp, nama_labo, catatan, status, username) 
    VALUES ('$id_labo', '$id_faku', '$kode_bhkimia', '$nama_bhkimia', '$jumlah', '$total_harga', '$nama_lgkp', '$nama_labo', '$catatan', 'In Queue', '$username')");
    if ($input) {
        header("Location: daftar_bhkimia.php?id_labo=$id_labo&id_faku=$id_faku");
        exit();
    }
}

// REQUEST BAHAN KIMIA
if (isset($_POST['reqAllBhkimia'])) {
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $username = $_SESSION['username'];
    $kode_bhkimia_array = $_POST['kode_bhkimia'];

    foreach ($kode_bhkimia_array as $kode_bhkimia) {
        // Ubah status menjadi 'Requested' untuk setiap kode bahan kimia
        $updatestatus = mysqli_query($koneksi, "UPDATE daftar_request SET status = 'Requested' WHERE status = 'In Queue' AND kode_bhkimia = '$kode_bhkimia' AND username = '$username'");
    }

    header("Location: daftar_bhkimia.php?id_labo=$id_labo&id_faku=$id_faku");
    exit();
}

// KIRIM BAHAN KIMIA
if (isset($_POST['kirimbhkimia'])) {
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $id_req = $_POST['id_req'];
    $nama_bhkimia = $_POST['nama_bhkimia'];
    $username = $_SESSION['username'];
    $jumlah = $_POST['jumlah'];

    $ambilstok = mysqli_query($koneksi, "SELECT stok FROM daftar_bhkimia WHERE nama_bhkimia = '$nama_bhkimia'");
    $data = mysqli_fetch_assoc($ambilstok);
    $stok = $data['stok'];

    $stoksekarang = $stok - $jumlah;

    $updatestok = mysqli_query($koneksi, "UPDATE daftar_bhkimia SET stok = $stoksekarang WHERE nama_bhkimia = '$nama_bhkimia'");

    if ($updatestok) {
        $updatestatus = mysqli_query($koneksi, "UPDATE daftar_request SET status = 'Dikirim' WHERE status = 'Requested' AND id_req = '$id_req' AND username = '$username'");

        if ($updatestatus) {
            header("Location: daftar_bhkimia.php?id_labo=$id_labo&id_faku=$id_faku");
            exit();
        }
    }
}

// SELESAI BAHAN KIMIA
if (isset($_POST['selesaibhkimia'])) {
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $id_req = $_POST['id_req'];
    $username = $_SESSION['username'];

    $updatestatus = mysqli_query($koneksi, "UPDATE daftar_request SET status = 'Selesai' WHERE status = 'Dikirim' AND id_req = '$id_req' AND username = '$username'");

    header("Location: daftar_bhkimia.php?id_labo=$id_labo&id_faku=$id_faku");
    exit();
}

// TAMBAH AKUN FIXED
if (isset($_POST['tambahakun'])) {
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $nama_lgkp = $_POST['nama_lgkp'];
    $email = $_POST['email'];
    $nomor_telp = $_POST['nomor_telp'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $tambahketabel = mysqli_query($koneksi, "INSERT INTO daftar_akun (nama_lgkp, email, nomor_telp, username, password, role) VALUES ('$nama_lgkp', '$email', '$nomor_telp', '$username', '$password', '$role')");

    if ($tambahketabel) {
        header("Location: daftar_akun.php?id_labo=$id_labo&id_faku=$id_faku");
    } else {
        header("Location: daftar_akun.php?id_labo=$id_labo&id_faku=$id_faku");
    }
}

// EDIT AKUN FIXED
if (isset($_POST['editakun'])) {
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $id_akun = $_POST['id_akun'];
    $role = $_POST['role'];

    $editdaritabel = mysqli_query($koneksi, "UPDATE daftar_akun SET role='$role' WHERE id_akun='$id_akun'");

    if ($editdaritabel) {
        header("Location: daftar_akun.php?id_labo=$id_labo&id_faku=$id_faku");
    } else {
        header("Location: daftar_akun.php?id_labo=$id_labo&id_faku=$id_faku");
    }
}

// HAPUS AKUN FIXED
if (isset($_POST['hapusakun'])) {
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $id_akun = $_POST['id_akun'];

    $hapusdaritabel = mysqli_query($koneksi, "DELETE from daftar_akun WHERE id_akun='$id_akun'");

    if ($hapusdaritabel) {
        header("Location: daftar_akun.php?id_labo=$id_labo&id_faku=$id_faku");
    } else {
        header("Location: daftar_akun.php?id_labo=$id_labo&id_faku=$id_faku");
    }
}

// HAPUS RIWAYAT JADWAL FIXED
if (isset($_POST['hapusriwayatjadwal'])) {
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $username = $_SESSION['username'];

    $hapusdaritabel = mysqli_query($koneksi, "DELETE FROM daftar_riwayat WHERE id_labo = '$id_labo' AND id_faku = '$id_faku' AND role = '$username'");

    if ($hapusdaritabel) {
        header("Location: riwayat_peminjaman_laboratorium.php?id_labo=$id_labo&id_faku=$id_faku");
    } else {
        header("Location: riwayat_peminjaman_laboratorium.php?id_labo=$id_labo&id_faku=$id_faku");
    }
}

// HAPUS RIWAYAT ALAT FIXED
if (isset($_POST['hapusriwayatalat'])) {
    $id_labo = $_GET['id_labo'];
    $id_faku = $_GET['id_faku'];
    $username = $_SESSION['username'];

    $hapusdaritabel = mysqli_query($koneksi, "DELETE FROM daftar_riwayat WHERE id_labo = '$id_labo' AND id_faku = '$id_faku' AND role = '$username'");

    if ($hapusdaritabel) {
        header("Location: riwayat_peminjaman_peralatan.php?id_labo=$id_labo&id_faku=$id_faku");
    } else {
        header("Location: riwayat_peminjaman_peralatan.php?id_labo=$id_labo&id_faku=$id_faku");
    }
}


// BUAT LAPORAN FIXED
if (isset($_POST['buatlaporan'])) {
    $isi_lapo = $_POST['isi_lapo'];
    $nama_lgkp = $_POST['nama_lgkp'];

    $tambahketabel = mysqli_query($koneksi, "INSERT INTO daftar_aktivitas (id_labo, id_faku, isi_lapo, nama_lgkp, status_mode, status_admn) VALUES ('$id_labo', '$id_faku', '$isi_lapo', '$nama_lgkp', 1, 1)");

    if ($tambahketabel) {
        header("Location: index.php");
    } else {
        header("Location: index.php");
    }
}

// EDIT LAPORAN FIXED
if (isset($_POST['editlaporan'])) {
    // $id_labo = $_GET['id_labo'];
    // $id_faku = $_GET['id_faku'];
    $id_lapo = $_POST['id_lapo'];
    $respons = $_POST['respons'];


    $editdaritabel = mysqli_query($koneksi, "UPDATE daftar_aktivitas SET respons = '$respons', nama_lgkp = 'Moderator' WHERE id_lapo = $id_lapo");

    if ($editdaritabel) {
        header("Location: index.php");
    } else {
        header("Location: index.php");
    }
}

// VALIDASI LAPORAN FIXED
if (isset($_POST['submitrespons'])) {
    $id_lapo = $_POST['id_lapo'];
    $respons = $_POST['respons'];

    $editdaritabel = mysqli_query($koneksi, "UPDATE daftar_aktivitas SET respons = '$respons' WHERE id_lapo = $id_lapo");

    if ($editdaritabel) {
        header("Location: index.php");
    } else {
        header("Location: index.php");
    }
}

// HAPUS LAPORAN FIXED
if (isset($_POST['hapuslaporan'])) {
    $id_lapo = $_POST['id_lapo'];

    $ambildaritabel = mysqli_query($koneksi, "SELECT status_admn, status_mode FROM daftar_aktivitas WHERE id_lapo = $id_lapo");
    $data = mysqli_fetch_assoc($ambildaritabel);

    if ($data['status_admn'] == 0 || $data['status_mode'] == 0) {
        $hapusdaritabel = mysqli_query($koneksi, "DELETE FROM daftar_aktivitas WHERE id_lapo = $id_lapo");
    } else {
        $role = $_SESSION['role'];
        $status_role = "status_admn";

        if ($role === 'moderator') {
            $status_role = "status_mode";
        }

        $editdaritabel = mysqli_query($koneksi, "UPDATE daftar_aktivitas SET $status_role = 0 WHERE id_lapo = $id_lapo");

        if ($editdaritabel) {
            $ambildaritabel = mysqli_query($koneksi, "SELECT * FROM daftar_aktivitas WHERE id_lapo = $id_lapo");
            $data = mysqli_fetch_assoc($ambildaritabel);
            $isi_lapo = $data['isi_lapo'];
            $tanggal_buat = $data['tanggal_buat'];
            $respons = $data['respons'];
            $status_lapo = $data['status_lapo'];
            $nama_lgkp = $data['nama_lgkp'];
        }
    }

    if (isset($hapusdaritabel)) {
        header("Location: index.php");
    } else {
        header("Location: index.php");
    }
}

// PROFILE
if (isset($_POST['profil'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "UPDATE daftar_akun SET password='$password' WHERE username='$username'";

    if (mysqli_query($koneksi, $query)) {
        header('location:profile.php');
    } else {
        echo 'Gagal';
        echo "Error updating record: " . mysqli_error($koneksi);
    }
}
