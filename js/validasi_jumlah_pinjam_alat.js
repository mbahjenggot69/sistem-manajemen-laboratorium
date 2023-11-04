function validasi_jumlah_pinjam_alat() {
    var jumlah_pinjam = parseInt(document.getElementById("jumlah_pinjam").value);
    var jumlah_ready = parseInt(document.getElementById("jumlah_ready").value);
    if (jumlah_pinjam < 0 ||jumlah_pinjam == 0 || jumlah_pinjam > jumlah_ready) {
        alert("Jumlah alat yang dipinjam tidak sesuai!");
        return false;
    }
    return true;
}

                                                     