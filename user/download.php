<?php
// Mendapatkan path file yang akan diunduh dari parameter GET
$file = isset($_GET['file']) ? $_GET['file'] : '';

// Cek apakah file yang akan diunduh ada
if (!empty($file) && file_exists($file)) {
    // Mendapatkan nama file
    $filename = basename($file);

    // Mengatur header untuk memulai transfer file
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Content-Length: " . filesize($file));

    // Membaca dan mengirimkan file ke output
    readfile($file);
    exit;
} else {
    // File tidak ditemukan, tampilkan pesan error
    echo "File tidak ditemukan.";
}
?>
