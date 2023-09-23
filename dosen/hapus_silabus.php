<?php
include("../koneksi.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Dapatkan informasi file yang akan dihapus
    $query = "SELECT * FROM Silabus WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $namaFile = $row['nama_file'];
        $file = "uploads/" . $namaFile;

        // Hapus data silabus dari database
        $queryDelete = "DELETE FROM Silabus WHERE id = '$id'";
        $resultDelete = mysqli_query($koneksi, $queryDelete);

        if ($resultDelete) {
            // Hapus file fisik dari server
            if (file_exists($file)) {
                unlink($file);
            }

            echo "Silabus dengan ID $id berhasil dihapus.";

            // Redirect kembali ke halaman silabus.php setelah penghapusan
            header("Location: silabus.php");
            exit;
        } else {
            echo "Terjadi kesalahan saat menghapus data silabus.";
        }
    } else {
        echo "Silabus tidak ditemukan.";
    }
} else {
    echo "ID silabus tidak ditemukan.";
}
?>
