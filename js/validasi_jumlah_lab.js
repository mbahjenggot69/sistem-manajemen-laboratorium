function validasi_jumlah_kapasitas() {
    var jumlah_lab = parseInt(document.getElementById("jumlah_labo").value);
    if (jumlah_lab <= 0 ) {
        alert("Jumlah tidak valid!");
        return false;
    }
    return true;
}

            