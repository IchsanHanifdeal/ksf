<?php
include("../koneksi.php");

if (isset($_GET['TugasID'])) {
    $id = $_GET['TugasID'];

    $querySelect = "SELECT FileTugas FROM Tugas WHERE TugasID = $id";
    $resultSelect = mysqli_query($koneksi, $querySelect);

    if ($resultSelect) {
        $row = mysqli_fetch_assoc($resultSelect);
        $fileToDelete = $row['FileTugas'];

        $queryDelete = "DELETE FROM Tugas WHERE TugasID = $id";
        $resultDelete = mysqli_query($koneksi, $queryDelete);

        if ($resultDelete) {
            $filePath = "uploads/Tugas/" . $fileToDelete;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            header("Location: Tugas.php");
            exit;
        } else {
            echo "Error deleting task: " . mysqli_error($koneksi);
        }
    } else {
        echo "Error retrieving file information: " . mysqli_error($koneksi);
    }
} else {
    echo "Invalid request. Please provide a task ID.";
}
?>
