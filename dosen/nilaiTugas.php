<?php
$thisPage = "Tugas";
$title = "Nilai Tugas";
$description = "Halaman Data Tugas";
include("header.php");
include("../koneksi.php");

$sql = "SELECT NilaiID, TugasID, Nilai, Komentar, WaktuPenilaian FROM Nilai";
$result = $koneksi->query($sql);

function getNamaMahasiswa($nim) {
    global $koneksi;

    $query = "SELECT nama FROM tbl_mahasiswa WHERE nim = '{$nim}'";
    $result = $koneksi->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        return $row ? $row['nama'] : "Nama Mahasiswa Tidak Ditemukan";
    } else {
        return "Error: " . $koneksi->error;
    }
}
function getJudulTugas($tugasID) {
    global $koneksi;

    $query = "SELECT Judul FROM Tugas WHERE TugasID = '{$tugasID}'";
    $result = $koneksi->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        return $row ? $row['Judul'] : "Judul Tugas Tidak Ditemukan";
    } else {
        return "Error: " . $koneksi->error;
    }
}

?>

<div class="container">
    <div class="content">
        <h1 class="text-center">Data Nilai</h1>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>Tugas</th>
                    <th>Waktu Submit</th>
                    <th>Nilai</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $nomor = 1;

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $namaMahasiswa = getNamaMahasiswa($row['TugasID']);
                        $judulTugas = getJudulTugas($row['TugasID']);

                        echo "<tr>";
                        echo "<td>{$nomor}</td>";
                        echo "<td>{$namaMahasiswa}</td>";
                        echo "<td>{$judulTugas}</td>";
                        echo "<td>{$row['WaktuPenilaian']}</td>";
                        echo "<td>{$row['Nilai']}</td>";
                        echo "<td>Opsi</td>";
                        echo "</tr>";

                        $nomor++;
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada data nilai.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

