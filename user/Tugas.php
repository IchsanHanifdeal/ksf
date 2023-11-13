<?php
$thisPage = "Tugas";
$title = "Tugas";
$description = "Halaman Tugas";
include("header.php");
include("../koneksi.php");


function getTugasInfo($tugas)
{
    $tugasName = basename($tugas);
    $tugasExtension = strtolower(pathinfo($tugasName, PATHINFO_EXTENSION));
    $tugasLogo = getFileLogo($tugasExtension);
    $tugasPreview = '';

    $info = array(
        'Nama File' => $tugasName,
        'Ekstensi File' => $tugasExtension,
        'Logo File' => $tugasLogo,
        'Preview' => $tugasPreview,
    );

    return $info;
}

function getFileLogo($tugasExtension)
{
    $logo = '';

    switch ($tugasExtension) {
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
        case 'jpeg':
        case 'png':
        case 'img':            
            $logo = 'image.png';
            break;
        default:
            $logo = 'file.png';
            break;
    }

    return $logo;
}

?>

<div class="container">
    <div class="content">
        <h2>Tugas</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width:5%;">No</th>
                        <th style="width:30%;">Tugas</th>
                        <th style="width:20%;">Deskripsi</th>
                        <th style="width:10%;">Deadline</th>
                        <th style="width:10%;">Status</th>
                        <th class="text-center" style="width:15%;">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                    $sql = "SELECT * FROM tugas";
                    $result = $koneksi->query($sql);
                    $nomor = 1;

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $idTugas = $row["TugasID"];
                            $tugas = '../dosen/uploads/tugas/' . $row["Judul"] . $row["FileTugas"];
                            $TugasInfo = getTugasInfo($tugas);
                            $deskripsi = $row["Deskripsi"];
                            $deadline = $row["WaktuPengumpulan"];
                            $Status = $row["Status"];
                            ?>
                            <tr>
                                <td><?php echo $nomor; ?></td>
                                <td>
                                    <img src="../dosen/icons/<?= $TugasInfo['Logo File'] ?>" alt="<?= $TugasInfo['Ekstensi File'] ?>" height="50px" width="50px">
                                    <?= $TugasInfo['Nama File'] ?>          
                                </td>
                                <td><?php echo $deskripsi; ?></td>
                                <td><?php echo $deadline; ?></td>
                                <td><?php echo $Status; ?></td>
                                <td style="text-align:center;">
                                    <a class="btn btn-primary fa fa-upload" href="uploadTugas.php?TugasID=<?php echo $idTugas; ?>"> Upload</a>
                                </td>
                            </tr>
                            <?php
                            $nomor++;
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada tugas.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <hr />
    </div>
</div>
