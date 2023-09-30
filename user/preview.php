<?php
$file = $_GET['file'];

if (file_exists($file)) {
    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

    if ($extension === 'pdf') {
        echo '<script>window.print();</script>';
        echo '<embed src="' . $file . '" type="application/pdf" width="100%" height="100%" />';
    } elseif ($extension === 'mp4' || $extension === 'avi') {
        echo '<video controls width="100%" height="auto">
                    <source src="' . $file . '" type="video/' . $extension . '">
                    Your browser does not support the video tag.
                </video>';
    } else {
        echo "Tipe file tidak didukung.";
    }
} else {
    echo "File tidak ditemukan.";
}
?>
