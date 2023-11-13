<?php
$thisPage = "Pembelajaran";
$title = "Pembelajaran";
$description = "Halaman Pembelajaran";
include("header.php");
include("../koneksi.php");

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
function getFileInfo($file)
{
    $fileName = basename($file);
    $fileSize = filesize($file);
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $fileLogo = getFileLogo($fileExtension);
    $filePreview = '';

    $info = array(
        'Nama File' => $fileName,
        'Ukuran File' => formatFileSize($fileSize),
        'Ekstensi File' => $fileExtension,
        'Logo File' => $fileLogo,
        'Preview' => $filePreview,
    );

    return $info;
}

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

function formatFileSize($fileSize)
{
    $mbSize = round($fileSize / 1048576, 2);
    return $mbSize . ' MB';
}

if (isset($_FILES['file'])) {
    $targetDir = "uploads/silabus/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);
    $allowedExtensions = array('pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'mp4', 'avi');
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

        $query = "INSERT INTO Silabus (nama_file, ukuran_file, deskripsi) VALUES ('$namaFile', '$ukuranFile', '$deskripsi')";
        $result = mysqli_query($koneksi, $query);
    } else {
        echo "Terjadi kesalahan saat memindahkan file yang diunggah.";
    }
}


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
                        <th class="text-center">Ukuran File</th>
                        <th class="text-center">Opsi</th>
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
        ?>

        <tr>
            <td><?= $no ?></td>
            <td>
                <img src="icons/<?= $fileInfo['Logo File'] ?>" alt="<?= $fileInfo['Ekstensi File'] ?>" height="50px" width="50px">
                <?= $fileInfo['Nama File'] ?>          
            </td>
            <td class="text-center"><?= $fileInfo['Ukuran File'] ?></td>
            <td class="text-center">
                <a href="download.php?file=<?= urlencode($file) ?>" class="btn btn-success">Download</a>
                <a class="btn btn-primary" href="detail_silabus.php?id=<?= $row['id'] ?>">Detail</a>
                <a href="hapus_silabus.php?id=<?= $row['id'] ?>" class="btn btn-danger">Hapus</a>
            </td>
        </tr>

        <?php
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
</script>