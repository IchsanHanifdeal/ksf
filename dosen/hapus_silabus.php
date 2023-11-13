<?php
include("../koneksi.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM Silabus WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $namaFile = $row['nama_file'];
        $file = "uploads/" . $namaFile;

        $queryDelete = "DELETE FROM Silabus WHERE id = '$id'";
        $resultDelete = mysqli_query($koneksi, $queryDelete);

        if ($resultDelete) {
            if (file_exists($file)) {
                unlink($file);
            }

            echo "Silabus dengan ID $id berhasil dihapus.";

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
