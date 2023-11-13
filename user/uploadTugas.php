<?php
$thisPage = "Tugas";
$title = "Upload Tugas";
$description = "Halaman Upload Tugas";
include("header.php");
include("../koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["TugasID"])) {
        $TugasID = $_POST["TugasID"];
        $judulTugas = $_POST["judul"];
        $deskripsi = $_POST["deskripsi"];
        $waktuPengumpulan = $_POST["waktu_pengumpulan"];

        $uploadDir = "../dosen/uploads/tugas/";

        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $uploadDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $uploadOk = 1;

        if (file_exists($targetFilePath)) {
            echo "File already exists.";
            $uploadOk = 0;
        }

        if ($_FILES["file"]["size"] > 5000000) {
            echo "File is too large. Maximum file size is 5 MB.";
            $uploadOk = 0;
        }

        $allowedExtensions = array("pdf", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "mp4", "avi", "jpeg", "png", "img");
        if (!in_array($fileType, $allowedExtensions)) {
            echo "Invalid file format. Allowed formats: " . implode(", ", $allowedExtensions);
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "File upload failed.";
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                $updateQuery = "UPDATE tugas SET FileTugas = '$fileName', Status = 'Sudah dinilai' WHERE TugasID = '$TugasID'";
                if ($koneksi->query($updateQuery) === TRUE) {
                    echo "File uploaded successfully.";
                } else {
                    echo "Error updating database: " . $koneksi->error;
                }
            } else {
                echo "Error uploading file.";
            }
        }
    } else {
        echo "Invalid request. TugasID is missing.";
    }
} else {
    echo "Invalid request method.";
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["TugasID"])) {
        $TugasID = $_GET["TugasID"];

        $query = "SELECT * FROM tugas WHERE TugasID = '$TugasID'";
        $result = $koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $judulTugas = $row["Judul"];
            $deskripsi = $row["Deskripsi"];
            $waktuPengumpulan = $row["WaktuPengumpulan"];
?>
            <div class="container">
                <div class="content">
                    <h2>Upload Tugas</h2>
                    <form action="processUpload.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="TugasID" value="<?php echo $TugasID; ?>">
                        <div class="form-group">
                            <label for="file">Pilih File Tugas:</label>
                            <input type="file" name="file" id="file" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label for="judul">Judul Tugas:</label>
                            <input type="text" name="judul" id="judul" class="form-control" value="<?php echo $judulTugas; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Tugas:</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" readonly><?php echo $deskripsi; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="waktu_pengumpulan">Waktu Pengumpulan:</label>
                            <input type="text" name="waktu_pengumpulan" id="waktu_pengumpulan" class="form-control" value="<?php echo $waktuPengumpulan; ?>" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
<?php
        } else {
            echo "Tugas not found.";
        }
    } else {
        echo "Invalid request. TugasID is missing.";
    }
} else {
    echo "Invalid request method.";
}
?>