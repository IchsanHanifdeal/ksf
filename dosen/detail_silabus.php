<style>

</style>
<?php
session_start();
if (isset($_SESSION['nama_dosen'])) {
    $loggedInUsername = $_SESSION['nama_dosen'];
} else {
    $loggedInUsername = '';
}
$thisPage = "Detail Pembelajaran";
$title = "Detail Pembelajaran";
$description = "Detail Pembelajaran";
include("header.php");
include("../koneksi.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM silabus WHERE id = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $file = 'uploads/silabus/' . $row['nama_file'];
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
    } else {
        echo "Item tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak ditemukan dalam parameter URL.";
    exit; 
}

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
    } elseif (in_array($extension, ['mp4', 'webm', 'ogg', 'mkv'])) {
        $preview = '<video width="100%" height="auto" controls>';
        $preview .= '<source src="' . $file . '" type="video/' . $extension . '">';
        $preview .= 'Your browser does not support the video tag.';
        $preview .= '</video>';
    }

    return $preview;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <style>
        .comment-form {
    background-color: #f7f7f7;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-top: 20px;
}
    .comment {
        border: 1px solid #ddd;
        margin-bottom: 15px;
        padding: 10px;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .comment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .username {
        font-size: 18px;
        font-weight: bold;
        color: #333;
    }

    .timestamp {
        color: #777;
    }

    .comment-text {
        font-size: 16px;
        line-height: 1.4;
        color: #444;
    }

    .no-comments {
        color: #777;
        font-style: italic;
    }
    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: bold;
    }

    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        resize: vertical;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
    .description {
        margin-top: 20px;
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
    }

    .description-heading {
        font-size: 24px;
        color: #333;
        margin-bottom: 10px;
    }

    .description-text {
        font-size: 16px;
        line-height: 1.5;
        color: #555;
    }
    .label-username {
        font-size: 18px;
        color: #333;
        margin-bottom: 5px;
    }

    .input-username {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        color: #555;
        background-color: #f7f7f7;
    }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <h2>Detail <?php echo $row['nama_file']; ?></h2>
        <?php
            $preview = generatePreview($file, $fileExtension);
            echo $preview;
        ?>
    </div>
        <div class="description">
            <h3 class="description-heading">Deskripsi</h3>
            <p class="description-text"><?php echo $row['Deskripsi']?></p>
        </div>
    <div class="comments">
        <h3>Komentar</h3>
         <form class="comment-form" method="POST" action="tambah_komentar.php?id=<?= $id ?>">
            <div class="form-group">
                <label for="username" class="label-username">Nama Pengguna:</label>
                <input type="text" name="username" id="username" value="<?php echo $loggedInUsername; ?>" class="input-username" readonly>
            </div>
            <div class="form-group">
                <label for="komentar">Komentar:</label>
                <textarea name="komentar" id="komentar" rows="4" required></textarea>
            </div>
            <input type="hidden" name="id_materi" value="<?php echo $id; ?>">
            <button type="submit" class="btn btn-primary">Kirim Komentar</button>
        </form>
      <?php
        $commentsQuery = "SELECT * FROM komentar WHERE id_materi = ?";
        $commentsStmt = $koneksi->prepare($commentsQuery);
        $commentsStmt->bind_param("i", $id);
        $commentsStmt->execute();
        $commentsResult = $commentsStmt->get_result();

        if ($commentsResult->num_rows > 0) {
            while ($comment = $commentsResult->fetch_assoc()) {
                echo '<div class="comment">';
                echo '<div class="comment-header">';
                echo '<h4 class="username">' . $comment['username'] . '</h4>';
                echo '<span class="timestamp">' . $comment['timestamp'] . '</span>';
                echo '</div>';
                echo '<p class="comment-text">' . $comment['komentar'] . '</p>';
                
                echo '<div class="text-right">';
                echo '<form method="post" action="hapus_komentar.php?id_komentar=' . $comment['id_komentar'] . '" class="d-inline">';
                echo '<input type="hidden" name="comment_id" value="' . $comment['id_komentar'] . '">';
                echo '<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                    }
                } else {
            echo '<p class="no-comments">Tidak ada komentar untuk Pembelajaran ini.</p>';
        }
    ?>
</div>
</div>
</body>
</html>