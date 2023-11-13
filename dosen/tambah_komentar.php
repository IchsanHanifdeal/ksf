<?php
include("../koneksi.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_materi = $_POST["id_materi"];
    $username = $_POST["username"];
    $komentar = $_POST["komentar"];

    $insertQuery = "INSERT INTO komentar (id_materi, username, komentar) VALUES (?, ?, ?)";
    $insertStmt = $koneksi->prepare($insertQuery);
    $insertStmt->bind_param("iss", $id_materi, $username, $komentar);

    if ($insertStmt->execute()) {
        header("Location: detail_silabus.php?id=" . $id_materi);
    } else {
        echo "Gagal menyimpan komentar.";
    }
} else {
    echo "Permintaan tidak valid.";
}
?>
