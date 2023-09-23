<?php
$thisPage = "Absensi";
$title = "Absensi";
$description = "Absensi";
include("header.php");
include("../koneksi.php");

// Fungsi untuk menyimpan absensi
if (isset($_POST['submit'])) {
    $pertemuan = $_POST['pertemuan'];
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $keterangan = $_POST['keterangan'];

    // Periksa apakah data absensi sudah ada atau belum
    $checkQuery = "SELECT * FROM tbl_absen WHERE nim = '$nim'";
    $checkResult = mysqli_query($koneksi, $checkQuery);
    if ($checkResult) {
        // Jika query sukses
        if (mysqli_num_rows($checkResult) > 0) {
            // Jika data sudah ada, lakukan update
            $updateQuery = "UPDATE tbl_absen SET pertemuan$pertemuan = '$keterangan' WHERE nim = '$nim'";
            $updateResult = mysqli_query($koneksi, $updateQuery);
            if ($updateResult) {
                $successMessage = "Absen berhasil.";
            } else {
                $errorMessage = "Gagal melakukan update absensi: " . mysqli_error($koneksi);
            }
        } else {
            // Jika data belum ada, lakukan insert
            $insertQuery = "INSERT INTO tbl_absen (nim, pertemuan$pertemuan) VALUES ('$nim', '$keterangan')";
            $insertResult = mysqli_query($koneksi, $insertQuery);
            if ($insertResult) {
                $successMessage = "Absen berhasil.";
            } else {
                $errorMessage = "Gagal melakukan insert absensi: " . mysqli_error($koneksi);
            }
        }
    } else {
        // Jika query error
        $errorMessage = "Error: " . mysqli_error($koneksi);
    }
}

?>

<div class="container">
    <div class="content">
        <h2>Absensi</h2>
        <?php
        if (isset($successMessage)) {
            echo '<div class="alert alert-success">' . $successMessage . '</div>';
        }
        if (isset($errorMessage)) {
            echo '<div class="alert alert-danger">' . $errorMessage . '</div>';
        }
        ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nim">NIM:</label>
                <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
            </div>
            <div class="form-group">
                <label for="pertemuan">Pertemuan:</label>
                <select class="form-control" id="pertemuan" name="pertemuan" required>
                    <option value="">Pilih Pertemuan</option>
                    <?php
                    for ($i = 1; $i <= 16; $i++) {
                        echo "<option value=\"$i\">Pertemuan $i</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <select class="form-control" id="keterangan" name="keterangan" required>
                    <option value="">Pilih Keterangan</option>
                    <option value="hadir">Hadir</option>
                    <option value="sakit">Sakit</option>
                    <option value="alfa">Alfa</option>
                    <option value="izin">Izin</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Absen</button>
        </form>
    </div>
</div>

<?php
include("footer.php");
?>
