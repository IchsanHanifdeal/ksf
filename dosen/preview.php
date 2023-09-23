<?php
$file = './' . $_GET['file']; // Dapatkan lokasi file yang akan di-preview
$extension = strtolower(pathinfo($file, PATHINFO_EXTENSION)); // Dapatkan ekstensi file

// Cek apakah file ada
if (file_exists($file)) {
    // Tentukan tipe konten berdasarkan ekstensi file
    $contentType = '';

    switch ($extension) {
        case 'doc':
        case 'docx':
            $contentType = 'application/msword';
            break;
        case 'pdf':
            $contentType = 'application/pdf';
            break;
        case 'xls':
        case 'xlsx':
            $contentType = 'application/vnd.ms-excel';
            break;
        case 'ppt':
        case 'pptx':
            $contentType = 'application/vnd.ms-powerpoint';
            break;
        default:
            echo "Tipe file tidak didukung.";
            exit;
    }

    // Tampilkan tampilan cetak jika file berupa PDF
    if ($extension === 'pdf') {
        echo '<script>window.print();</script>';
    }

    // Tampilkan konten file
    header('Content-Type: ' . $contentType);
    readfile($file);
} else {
    echo "File tidak ditemukan.";
}
?>