<?php
include '../koneksi.php';
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['comment_id'])) {
        $commentId = $_POST['comment_id'];
        $query = "DELETE FROM komentar WHERE id_komentar = ?";
        $stmt = $koneksi->prepare($query);

        $stmt->bind_param("i", $commentId);

        if ($stmt->execute()) {
            header('Location: silabus.php');
            exit;
        } else {
            echo "Gagal menghapus komentar.";
        }
    } else {
        echo "Parameter comment_id tidak diterima.";
    }
} else {
    echo "Metode yang digunakan harus POST.";
}
?>
