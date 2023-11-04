var dataBhkimia = []; // Array untuk menampung pasangan kode dan nama Bhkimia

// Event listener ketika formulir dikirim
document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault(); // Mencegah pengiriman formulir

    // Mendapatkan nilai dari input
    var kode = document.querySelector('input[name="kode_bhkimia"]').value;
    var nama = document.querySelector('input[name="nama_bhkimia"]').value;

    // Menambah pasangan kode dan nama ke dalam array
    dataBhkimia.push({ kode: kode, nama: nama });

    // Menampilkan data dalam bentuk tabel atau daftar (terserah Anda)
    renderData();
});

function renderData() {
    // Ambil elemen tabel atau daftar (sesuai kebutuhan)
    var tableBody = document.getElementById('data-table-body'); // Ganti dengan ID elemen tabel atau daftar

    // Hapus konten tabel atau daftar sebelum menambahkan data baru
    tableBody.innerHTML = '';

    // Tambahkan baris baru untuk setiap pasangan kode dan nama dalam array
    dataBhkimia.forEach(function(item) {
        var row = document.createElement('tr'); // Baris baru dalam tabel
        var cellKode = document.createElement('td'); // Sel untuk kode
        var cellNama = document.createElement('td'); // Sel untuk nama

        cellKode.textContent = item.kode; // Set nilai sel kode
        cellNama.textContent = item.nama; // Set nilai sel nama

        // Masukkan sel kode dan nama ke dalam baris
        row.appendChild(cellKode);
        row.appendChild(cellNama);

        // Masukkan baris ke dalam tabel
        tableBody.appendChild(row);
    });
}
