<?php
$thisPage = "Data Absensi";
$title = "Data Absensi";
$description = "Data Absensi";
include("header.php");
include("../koneksi.php");

$filter = isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL;

// Hapus data absensi
if (isset($_GET['delete']) && isset($_GET['nim'])) {
    $deleteNim = $_GET['nim'];
    $deleteQuery = "DELETE FROM tbl_absen WHERE nim = '$deleteNim'";
    mysqli_query($koneksi, $deleteQuery);
}

?>

<div class="container">
    <div class="content">
        <h2>Data Absensi</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <?php
                    for ($i = 1; $i <= 16; $i++) {
                        echo "<th>Pertemuan " . $i . "</th>";
                    }
                    ?>
                    <th>Aksi</th>
                </tr>
                <?php
                if ($filter) {
                    $sql = mysqli_query($koneksi, "SELECT a.nim, m.nama, a.pertemuan1, a.pertemuan2, a.pertemuan3, a.pertemuan4, a.pertemuan5, a.pertemuan6, a.pertemuan7, a.pertemuan8, a.pertemuan9, a.pertemuan10, a.pertemuan11, a.pertemuan12, a.pertemuan13, a.pertemuan14, a.pertemuan15, a.pertemuan16 FROM tbl_absen a JOIN tbl_mahasiswa m ON a.nim = m.nim");
                } else {
                    $sql = mysqli_query($koneksi, "SELECT a.nim, m.nama, a.pertemuan1, a.pertemuan2, a.pertemuan3, a.pertemuan4, a.pertemuan5, a.pertemuan6, a.pertemuan7, a.pertemuan8, a.pertemuan9, a.pertemuan10, a.pertemuan11, a.pertemuan12, a.pertemuan13, a.pertemuan14, a.pertemuan15, a.pertemuan16 FROM tbl_absen a JOIN tbl_mahasiswa m ON a.nim = m.nim ORDER BY a.nim ASC");
                }
                if (mysqli_num_rows($sql) == 0) {
                    echo '<tr><td colspan="20">Data Tidak Ada.</td></tr>';
                } else {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($sql)) {
                        echo '<tr>
                            <td>' . $no . '</td>
                            <td>' . $row['nim'] . '</td>
                            <td><a href="data_mahasiswa.php?nim=' . $row['nim'] . '">' . $row['nama'] . '</a></td>';
                            for ($i = 1; $i <= 16; $i++) {
                                $attendance = '';
                                switch ($row['pertemuan' . $i]) {
                                    case 0:
                                        $attendance = 'Hadir';
                                        break;
                                    case 1:
                                        $attendance = 'Sakit';
                                        break;
                                    case 2:
                                        $attendance = 'Alfa';
                                        break;
                                    case 3:
                                        $attendance = 'Izin';
                                        break;
                                    default:
                                        $attendance = 'Tidak Hadir';
                                }
                                echo "<td>" . $attendance . "</td>";
                            }
                            echo '<td><a href="?delete=true&nim=' . $row['nim'] . '" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">Hapus</a></td>
                        </tr>';
                        $no++;
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>
<?php
include("footer.php");
?>
