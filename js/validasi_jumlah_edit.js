function validasi_jumlah_edit() {
    var jumlah_alat = parseInt(document.getElementById("jumlah").value);
    if (jumlah_alat < 0 ||jumlah_alat == 0 ) {
        alert("Jumlah alat yang dipinjam tidak sesuai!");
        return false;
    }
    return true;
}

                                                     