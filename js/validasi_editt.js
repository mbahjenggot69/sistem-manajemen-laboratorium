function validasi_editt() {
    var jumlah_labo = parseInt(document.getElementById("jumlah_labo").value);
    if (jumlah_labo < 0 ||jumlah_labo == 0 ) {
        alert("Jumlah alat yang dipinjam tidak sesuai!");
        return false;
    }
    return true;
}

             