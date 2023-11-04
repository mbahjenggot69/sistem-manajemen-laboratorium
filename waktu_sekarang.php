<?php

$conn = mysqli_connect("localhost", "root", "", "simera_beta");

if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
}

date_default_timezone_set('Asia/Jakarta');

$waktu_sekarang = date("Y-m-d H:i:s");
$tanggal_sebelumnya = date('Y-m-d', strtotime($tanggal_pinj . ' -1 day'));

$sql1 = "UPDATE daftar_alat 
        SET waktu_sekarang = '$waktu_sekarang'";

$sql2 = "UPDATE jadwal_alat 
        SET waktu_sekarang = '$waktu_sekarang'";

$sql3 = "UPDATE daftar_jadwal 
        SET waktu_sekarang = '$waktu_sekarang'";

$sql4 = "UPDATE daftar_alat 
        SET status = 'Dipinjam', waktu_sekarang = '$waktu_sekarang' 
        WHERE status = 'Tersedia' AND tanggal_pinj <= '$tanggal_sebelumnya'";

$sql5 = "UPDATE daftar_alat
        SET status = 'Tersedia',
            waktu_sekarang = '$waktu_sekarang',
            kondisi = 'No Record',
            catatan = 'No Record',
            kode_pinj = NULL,
            tanggal_pinj = NULL,
            tanggal_sele = NULL,
            tipe = NULL,
            nama_lgkp = NULL
        WHERE status = 'Dipinjam' AND tanggal_sele IS NOT NULL AND tanggal_sele <= '$waktu_sekarang';";

$sql6 = "DELETE FROM jadwal_alat 
        WHERE tanggal_sele <= '$waktu_sekarang'";

$sql7 = "DELETE FROM daftar_jadwal
        WHERE tanggal_sele <= '$waktu_sekarang'";

if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3) && mysqli_query($conn, $sql4) && mysqli_query($conn, $sql5) && mysqli_query($conn, $sql6) && mysqli_query($conn, $sql7)) {
        return true;
} else {
        mysqli_error($conn);
}

mysqli_close($conn);
