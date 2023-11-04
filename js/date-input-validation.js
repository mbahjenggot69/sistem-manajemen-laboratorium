document.addEventListener("DOMContentLoaded", function () {
    var tanggal_pinjInput = document.getElementById("tanggal_pinj");
    var tanggal_seleInput = document.getElementById("tanggal_sele");

    tanggal_pinjInput.addEventListener("input", function () {
        var tanggal_pinj = new Date(tanggal_pinjInput.value);
        var tanggal_sele = new Date(tanggal_seleInput.value);
        var now = new Date();

        if (tanggal_pinj <= now) {
            alert("Tanggal pinjam harus lebih besar dari waktu sekarang");
            tanggal_pinjInput.value = "";
        }

        if (tanggal_pinj >= tanggal_sele) {
            alert("Tanggal pinjam harus lebih kecil dari tanggal selesai");
            tanggal_pinjInput.value = "";
        }
    });

    tanggal_seleInput.addEventListener("input", function () {
        var tanggal_pinj = new Date(tanggal_pinjInput.value);
        var tanggal_sele = new Date(tanggal_seleInput.value);
        var now = new Date();

        if (tanggal_sele <= now) {
            alert("Tanggal selesai harus lebih besar dari waktu sekarang");
            tanggal_seleInput.value = "";
        }

        if (tanggal_sele <= tanggal_pinj) {
            alert("Tanggal selesai harus lebih besar dari tanggal pinjam");
            tanggal_seleInput.value = "";
        }
    });

    tanggal_pinjInput.addEventListener("input", function () {
        var tanggal_pinj = new Date(tanggal_pinjInput.value);
        var tanggal_sele = new Date(tanggal_seleInput.value);

        if (tanggal_pinj.getTime() === tanggal_sele.getTime()) {
            alert("Tanggal pinjam dan tanggal selesai tidak boleh sama");
            tanggal_pinjInput.value = "";
        }
    });

    tanggal_seleInput.addEventListener("input", function () {
        var tanggal_pinj = new Date(tanggal_pinjInput.value);
        var tanggal_sele = new Date(tanggal_seleInput.value);

        if (tanggal_pinj.getTime() === tanggal_sele.getTime()) {
            alert("Tanggal pinjam dan tanggal selesai tidak boleh sama");
            tanggal_seleInput.value = "";
        }
    });
});
