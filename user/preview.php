<?php
$file = $_GET['file']; // Dapatkan lokasi file yang akan di-preview

// Cek apakah file ada
if (file_exists($file)) {
    // Tampilkan tampilan cetak
    echo '<script>window.print();</script>';
    echo '<embed src="' . $file . '" type="application/pdf" width="100%" height="100%" />';
} else {
    echo "File tidak ditemukan.";
}
?>
