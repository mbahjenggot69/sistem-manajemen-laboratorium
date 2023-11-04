function validasi_edit_bhkimia() {
    var stok = parseInt(document.getElementById("stok").value);
    var harga = parseInt(document.getElementById("harga").value);

    if (stok <= 0 || harga <= 0 ) {
        alert("Jumlah alat yang dipinjam tidak sesuai!");
        return false;
    }
    return true;
}

                                                     