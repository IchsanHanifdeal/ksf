<?php
$thisPage = "Tugas";
$title = "Tugas";
$description = "Halaman Data Tugas";
include("header.php");
include("../koneksi.php");
?>

<?php
if (isset($_GET['TugasID'])) {
    $id = $_GET['TugasID'];

    $querySelect = "SELECT * FROM Tugas WHERE TugasID = $id";
    $resultSelect = mysqli_query($koneksi, $querySelect);

    if ($resultSelect) {
        $row = mysqli_fetch_assoc($resultSelect);
        $existingFile = $row['FileTugas'];
        $judul = $row['Judul'];
        $deskripsi = $row['Deskripsi'];
        $waktuPengumpulan = $row['WaktuPengumpulan'];
        $Status = $row['Status'];

        if (isset($_POST['submit'])) {
            $newJudul = mysqli_real_escape_string($koneksi, $_POST['judul']);
            $newDeskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
            $newWaktuPengumpulan = mysqli_real_escape_string($koneksi, $_POST['waktu_pengumpulan']);
            $newStatus = mysqli_real_escape_string($koneksi, $_POST['Status']);

            if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
                $existingFilePath = "uploads/Tugas/" . $existingFile;
                if (file_exists($existingFilePath)) {
                    unlink($existingFilePath);
                }

                $newFile = basename($_FILES["file"]["name"]);
                $newFileTarget = "uploads/Tugas/" . $newFile;
                move_uploaded_file($_FILES["file"]["tmp_name"], $newFileTarget);

                $queryUpdate = "UPDATE Tugas SET FileTugas = '$newFile', Judul = '$newJudul', Deskripsi = '$newDeskripsi', WaktuPengumpulan = '$newWaktuPengumpulan', Status = '$newStatus' WHERE TugasID = $id";
            } else {
                $queryUpdate = "UPDATE Tugas SET Judul = '$newJudul', Deskripsi = '$newDeskripsi', WaktuPengumpulan = '$newWaktuPengumpulan', Status = '$newStatus' WHERE TugasID = $id";
            }

            $resultUpdate = mysqli_query($koneksi, $queryUpdate);

            if ($resultUpdate) {
                header("Location: tugas.php");
                exit;
            } else {
                echo "Error updating task: " . mysqli_error($koneksi);
            }
        }
    } else {
        echo "Error retrieving task information: " . mysqli_error($koneksi);
    }
} else {
    echo "Invalid request. Please provide a task ID.";
}
?>

<div class="container">
    <div class="content">
        <h1 class="text-center">Edit Tugas</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Pilih File Tugas (Biarkan kosong jika tidak ingin mengganti file):</label>
                <input type="file" name="file" id="file" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="judul">Judul Tugas:</label>
                <input type="text" name="judul" id="judul" class="form-control" value="<?php echo $judul; ?>">
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi Tugas:</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control"><?php echo $deskripsi; ?></textarea>
            </div>
            <div class="form-group">
                <label for="waktu_pengumpulan">Waktu Pengumpulan:</label>
                <input type="datetime-local" name="waktu_pengumpulan" id="waktu_pengumpulan" class="form-control" value="<?php echo $waktuPengumpulan; ?>">
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select name="Status" id="status" class="form-control">
                    <option value="Belum dinilai" <?php echo ($Status == 'Belum dinilai') ? 'selected' : ''; ?>>Belum dinilai</option>
                    <option value="Sudah dinilai" <?php echo ($Status == 'Sudah dinilai') ? 'selected' : ''; ?>>Sudah dinilai</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
