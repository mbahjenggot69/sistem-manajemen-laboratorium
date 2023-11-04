function validasi_jumlah_tambah() {
    var jumlah_alat = parseInt(document.getElementById("jumlah_alat_baru").value);
    if (jumlah_alat < 0 ||jumlah_alat == 0 ) {
        alert("Jumlah alat yang dipinjam tidak sesuai!");
        return false;
    }
    return true;
}

                                                     