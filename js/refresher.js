function autoRefresh() {
    setTimeout("location.reload(true);", 300000); 
}
// Memanggil fungsi autoRefresh saat halaman selesai dimuat
window.onload = autoRefresh;