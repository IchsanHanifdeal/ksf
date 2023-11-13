<?php
$thisPage = "Tugas";
$title = "Tugas";
$description = "Halaman Data Tugas";
include("header.php");
include("../koneksi.php");
?>
<?php 
if (isset($_FILES['file'])) {
    $targetDir = "uploads/Tugas/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);
    $allowedExtensions = array('png', 'jpeg', 'img', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'mp4', 'avi');
    $fileExtension = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "File yang diunggah harus dalam format PDF, Word (DOC/DOCX), Excel (XLS/XLSX), PowerPoint (PPT/PPTX), MP4, atau AVI.";
        exit;
    }
    if ($_FILES["file"]["error"] > 0) {
        echo "Terjadi kesalahan saat mengunggah file: " . $_FILES["file"]["error"];
        exit;
    }
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        echo "File berhasil diunggah: " . $targetFile;

        $namaFile = basename($_FILES["file"]["name"]);
        $ukuranFile = filesize($targetFile);
        $deskripsi = isset($_POST['deskripsi']) ? mysqli_real_escape_string($koneksi, $_POST['deskripsi']) : '';
        $waktuPengumpulan = isset($_POST['waktu_pengumpulan']) ? mysqli_real_escape_string($koneksi, $_POST['waktu_pengumpulan']) : '';

        $query = "INSERT INTO Tugas (FileTugas, Judul, Deskripsi, WaktuPengumpulan) VALUES ('$namaFile', '$judul', '$deskripsi', '$waktuPengumpulan')";

        if ($result = mysqli_query($koneksi, $query)) {
            header("Location: tugas.php");
            exit;
        } else {
            echo "Error executing query: " . mysqli_error($koneksi);
        }
    } else {
        echo "Terjadi kesalahan saat memindahkan file yang diunggah.";
    }
}
?>
<div class="container">
    <div class="content">
        <h1 class="text-center">Tambah Tugas</h1>
         <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Pilih File Tugas:</label>
                <input type="file" name="file" id="file" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="judul">Judul Tugas:</label>
                <input type="text" name="judul" id="judul" class="form-control">
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi Tugas:</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="waktu_pengumpulan">Waktu Pengumpulan:</label>
                <input type="datetime-local" name="waktu_pengumpulan" id="waktu_pengumpulan" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</div>