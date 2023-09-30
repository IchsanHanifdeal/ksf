<?php
$thisPage = "Pembelajaran";
$title = "Pembelajaran";
$description = "Halaman Pembelajaran";
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

function generateVideoPreview($file)
{
    $preview = '<video controls width="100%" height="auto">
                    <source src="' . $file . '" type="video/mp4">
                    Your browser does not support the video tag.
                </video>';

    return $preview;
}

// Fungsi untuk mendapatkan informasi tentang silabus yang diunggah
function getFileInfo($file)
{
    $fileName = basename($file);
    $fileSize = filesize($file);
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $fileLogo = getFileLogo($fileExtension);
    $filePreview = '';

    if ($fileExtension === 'mp4' || $fileExtension === 'avi') {
        $filePreview = generateVideoPreview($file);
    } else {
        $filePreview = generatePreview($file, $fileExtension);
    }

    $info = array(
        'Nama File' => $fileName,
        'Ukuran File' => formatFileSize($fileSize),
        'Ekstensi File' => $fileExtension,
        'Logo File' => $fileLogo,
        'Preview' => $filePreview,
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
        case 'mp4':
        case 'avi':
            $logo = 'mp4.png';
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
    $targetDir = "uploads/silabus/"; // Folder tujuan penyimpanan file
    // Pastikan folder tujuan penyimpanan file sudah ada
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    // Tentukan nama file yang akan diunggah
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);
    // Cek apakah file yang diunggah memiliki ekstensi yang diizinkan
    $allowedExtensions = array('pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'mp4', 'avi');
    $fileExtension = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "File yang diunggah harus dalam format PDF, Word (DOC/DOCX), Excel (XLS/XLSX), PowerPoint (PPT/PPTX), MP4, atau AVI.";
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
        $deskripsi = isset($_POST['deskripsi']) ? mysqli_real_escape_string($koneksi, $_POST['deskripsi']) : '';

        $query = "INSERT INTO Silabus (nama_file, ukuran_file, deskripsi) VALUES ('$namaFile', '$ukuranFile', '$deskripsi')";
        $result = mysqli_query($koneksi, $query);
    } else {
        echo "Terjadi kesalahan saat memindahkan file yang diunggah.";
    }
}


// Fungsi untuk menampilkan tampilan cetak file PDF
function printPDF($file)
{
    echo '<script>
    window.print();
</script>';
    $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    echo generatePreview($file, $fileExtension);
}

?>

<div class="container">
    <div class="content">
        <h2>Pembelajaran</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pembelajaran</th>
                        <th>Deskripsi</th>
                        <th>Ukuran File</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $filter = false;

                    if ($filter) {
                        $query = "SELECT * FROM Silabus";
                    } else {
                        $query = "SELECT * FROM Silabus ORDER BY nama_file ASC";
                    }

                    $result = mysqli_query($koneksi, $query);

                    if (mysqli_num_rows($result) == 0) {
                        echo '<tr><td colspan="4">Data Tidak Ada.</td></tr>';
                    } else {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $file = 'uploads/silabus/' . $row['nama_file'];
                            $fileInfo = getFileInfo($file);
                            echo '<tr>
                <td>' . $no . '</td>
                <td>
                    <img src="icons/' . $fileInfo['Logo File'] . '" alt="' . $fileInfo['Ekstensi File'] . '" height="50px" width="50px">
                    ' . $fileInfo['Nama File'] . '
                    <div id="previewModal" style="display: none;">
                        <div id="modal-content">
                            <span id="close" onclick="closeModal()">&times;</span>
                            <div id="previewModalBody">
                                <div id="videoPreviewContainer">
                                </div>
                            </div>
                        </div>
                    </div>                        
                </td>
                <td>' . $row['Deskripsi'] . '</td>
                <td>' . $fileInfo['Ukuran File'] . '</td>
                <td>
                    <a href="download.php?file=' . urlencode($file) . '" class="btn btn-success">Download</a>
                    <button class="btn btn-primary" onclick="previewFile(\'' . urlencode($file) . '\')">Preview</button>
                    <a href="hapus_silabus.php?id=' . $row['id'] . '" class="btn btn-danger">Hapus</a>
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
                <label for="file">Pilih File Pembelajaran:</label>
                <input type="file" name="file" id="file" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
            </div>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function previewFile(file) {
        var modal = document.getElementById('previewModal');
        modal.style.display = 'block';

        var videoPreviewContainer = document.getElementById('videoPreviewContainer');
        videoPreviewContainer.innerHTML = '<iframe src="preview.php?file=' + file + '" width="100%" height="400px" frameborder="0"></iframe>';
        loadComments(file);
    }

    function loadComments(file) {
        var comments = [{
                username: 'User1',
                comment: 'This is great!'
            },
            {
                username: 'User2',
                comment: 'Awesome content.'
            }
        ];

        var commentsList = document.getElementById('commentsList');
        commentsList.innerHTML = '';

        comments.forEach(function(comment) {
            var commentItem = document.createElement('div');
            commentItem.classList.add('commentItem');
            commentItem.innerHTML = '<strong>' + comment.username + ':</strong> ' + comment.comment;
            commentsList.appendChild(commentItem);
        });
    }

    function postComment() {
        // Post a comment for the previewed file
        var commentInput = document.getElementById('commentInput');
        var comment = commentInput.value.trim();

        if (comment !== '') {
            var commentsList = document.getElementById('commentsList');
            var commentItem = document.createElement('div');
            commentItem.classList.add('commentItem');
            commentItem.innerHTML = '<strong>User:</strong> ' + comment;
            commentsList.appendChild(commentItem);
            commentInput.value = '';
        }
    }

    function closeModal() {
        var modal = document.getElementById('previewModal');
        modal.style.display = 'none';
    }
</script>