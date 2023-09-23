<?php
$thisPage = "Materi";
$title = "Materi";
$description = "Halaman Materi";
include("header.php");
include("../koneksi.php");

// Fungsi untuk menghasilkan pratinjau PDF menggunakan Google Docs Viewer
function generatePreview($file, $extension)
{
    $preview = '';

    if ($extension === 'pdf') {
        $preview = '<embed src="' . $file . '" type="application/pdf" width="100%" height="600px" />';
    } elseif ($extension === 'doc' || $extension === 'docx') {
        $preview = '<iframe src="https://view.officeapps.live.com/op/embed.aspx?src=' . urlencode($file) . '" width="100%" height="600px" frameborder="0"></iframe>';
    } elseif ($extension === 'xls' || $extension === 'xlsx') {
        $preview = '<iframe src="https://docs.google.com/viewer?url=' . urlencode($file) . '&embedded=true" width="100%" height="600px" frameborder="0"></iframe>';
    } elseif ($extension === 'ppt' || $extension === 'pptx') {
        $preview = '<iframe src="https://docs.google.com/presentation/d/e/2PACX-1vQXehyh33mlTHFBy6k-bUCUWc2G2YkuxBUfmvwhZj2b-uZc5RdrkvvGkldKqQg-Po20ic3T7B1t1hqu/embed?start=false&loop=false&delayms=3000&slide=id.p1&rm=minimal" width="100%" height="600px" frameborder="0" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>';
    }

    return $preview;
}

// Fungsi untuk mendapatkan informasi tentang silabus yang diunggah
function getFileInfo($file)
{
    $fileName = basename($file);
    $fileSize = filesize($file);
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $fileLogo = getFileLogo($fileExtension);

    $info = array(
        'Nama File' => $fileName,
        'Ukuran File' => formatFileSize($fileSize),
        'Ekstensi File' => $fileExtension,
        'Logo File' => $fileLogo,
    );

    return $info;
}

// Fungsi untuk mendapatkan logo file berdasarkan ekstensi
function getFileLogo($fileExtension)
{
    $logo = '';

    switch ($fileExtension) {
        case 'pdf':
            $logo = 'pdf.png';
            break;
        case 'doc':
        case 'docx':
            $logo = 'doc.png';
            break;
        case 'xls':
        case 'xlsx':
            $logo = 'xls.png';
            break;
        case 'ppt':
        case 'pptx':
            $logo = 'ppt.png';
            break;
        default:
            $logo = 'file.png';
            break;
    }

    return $logo;
}

// Fungsi untuk mengubah ukuran file menjadi MB
function formatFileSize($fileSize)
{
    $mbSize = round($fileSize / 1048576, 2); // Konversi byte ke megabyte
    return $mbSize . ' MB';
}

// Cek apakah ada file yang diunggah
if (isset($_FILES['file'])) {
    // Tentukan lokasi penyimpanan file yang diunggah
    $targetDir = "uploads/materi/";
    // Tentukan nama file yang akan diunggah
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);
    // Cek apakah file yang diunggah memiliki ekstensi yang diizinkan
    $allowedExtensions = array('pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx');
    $fileExtension = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "File yang diunggah harus dalam format PDF, Word (DOC/DOCX), Excel (XLS/XLSX), atau PowerPoint (PPT/PPTX).";
        exit;
    }
    // Cek apakah terdapat error saat mengunggah file
    if ($_FILES["file"]["error"] > 0) {
        echo "Terjadi kesalahan saat mengunggah file: " . $_FILES["file"]["error"];
        exit;
    }
    // Pindahkan file yang diunggah ke lokasi penyimpanan
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        echo "File berhasil diunggah: " . $targetFile;

        // Simpan informasi file ke dalam database
        $namaFile = basename($_FILES["file"]["name"]);
        $ukuranFile = filesize($targetFile);

        $query = "INSERT INTO materi (nama_file, ukuran_file) VALUES ('$namaFile', '$ukuranFile')";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            echo "<br>Informasi file berhasil disimpan ke database.";

            // Tampilkan tombol download
            echo '<a href="download.php?file=' . urlencode($targetFile) . '" class="btn btn-success">Download</a>';
        } else {
            echo "<br>Terjadi kesalahan saat menyimpan informasi file ke database.";
        }
    } else {
        echo "Terjadi kesalahan saat memindahkan file yang diunggah.";
    }
}

// Fungsi untuk menampilkan tampilan cetak file PDF
function printPDF($file)
{
    echo '<script>window.print();</script>';
    $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    echo generatePreview($file, $fileExtension);
}

?>

<div class="container">
    <div class="content">
        <h2>Materi</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Materi</th>
                        <th>Ukuran File</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $filter = false;

                    if ($filter) {
                        $sql = mysqli_query($koneksi, "SELECT * FROM materi");
                    } else {
                        $sql = mysqli_query($koneksi, "SELECT * FROM materi ORDER BY nama_file ASC");
                    }
                    if (mysqli_num_rows($sql) == 0) {
                        echo '<tr><td colspan="4">Data Tidak Ada.</td></tr>';
                    } else {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($sql)) {
                            $file = 'uploads/materi/' . $row['nama_file'];
                            $fileInfo = getFileInfo($file);
                            echo '
                            <tr>
                                <td>' . $no . '</td>
                                <td>
                                    <img src="icons/' . $fileInfo['Logo File'] . '" alt="' . $fileInfo['Ekstensi File'] . '" height="50px" width="50px">
                                    ' . $fileInfo['Nama File'] . '
                                </td>
                                <td>' . $fileInfo['Ukuran File'] . '</td>
                                <td>
                                    <a href="download.php?file=' . urlencode($file) . '" class="btn btn-success">Download</a>
                                    <a href="preview.php?file=' . urlencode($file) . '" class="btn btn-primary">Preview</a>
                                    <a href="hapus_materi.php?id=' . $row['id'] . '" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>';
                            $no++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <hr />
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Pilih File Materi:</label>
                <input type="file" name="file" id="file" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</div>

<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];
    if (file_exists($file)) {
        printPDF($file);
    } else {
        echo "File tidak ditemukan.";
    }
}

include("footer.php");
?>
