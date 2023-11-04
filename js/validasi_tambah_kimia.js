function validasi_tambah_kimia() {
    var harga_bhkimia = parseInt(document.getElementById("harga").value);
    var stok_bhkimia = parseInt(document.getElementById("stok").value); // Menggunakan "stokk" sebagai ID

    // Validasi harga dan stok
    if (harga_bhkimia <= 0 || stok_bhkimia <= 0) {
        alert("Harga dan stok harus angka positif!");
        return false;
    }

    return true;
}
