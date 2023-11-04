function validasi_jumlah_kapasitas() {
    var kapasitas = parseInt(document.getElementById("kapasitas").value);
    if (kapasitas <= 0 ) {
        alert("Jumlah tidak valid!");
        return false;
    }
    return true;
}

                                                     