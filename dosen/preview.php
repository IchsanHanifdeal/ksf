<?php
$file = './' . $_GET['file'];
$extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

if (file_exists($file)) {
    $contentType = '';

    switch ($extension) {
        case 'doc':
        case 'docx':
            $contentType = 'application/msword';
            break;
        case 'pdf':
            $contentType = 'application/pdf';
            echo '<script>window.print();</script>';
            break;
        case 'xls':
        case 'xlsx':
            $contentType = 'application/vnd.ms-excel';
            break;
        case 'ppt':
        case 'pptx':
            $contentType = 'application/vnd.ms-powerpoint';
            break;
        case 'mp4':
            $contentType = 'video/mp4';
            echo '<video controls width="100%" height="auto">
                        <source src="' . $file . '" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>';
            exit;
        case 'avi':
            $contentType = 'video/x-msvideo';
            echo '<video controls width="100%" height="auto">
                        <source src="' . $file . '" type="video/avi">
                        Your browser does not support the video tag.
                    </video>';
            exit;
        default:
            echo "Tipe file tidak didukung.";
            exit;
    }

    header('Content-Type: ' . $contentType);
    readfile($file);
} else {
    echo "File tidak ditemukan.";
}
?>