<?php
$thisPage = "Tugas";
$title = "Tugas";
$description = "Halaman Data Tugas";
include("header.php");
include("../koneksi.php");
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
                        <th style="width:15%;">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                    $sql = "SELECT * FROM tugas";
                    $result = $koneksi->query($sql);
                    $nomor = 1;

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $idTugas = $row["id_tugas"];
                            $tugas = $row["tugas"];
                            $deskripsi = $row["deskripsi"];
                            $deadline = $row["deadline"];
                            ?>
                            <tr>
                                <td><?php echo $nomor; ?></td>
                                <td><?php echo $tugas; ?></td>
                                <td><?php echo $deskripsi; ?></td>
                                <td><?php echo $deadline; ?></td>
                                <td style="text-align:center;">
                                    <a class="btn btn-warning fa fa-edit" href="EditTugas.php?id=<?php echo $idTugas; ?>"></a> |
                                    <a class="btn btn-danger fa fa-trash" href="HapusTugas.php?id=<?php echo $idTugas; ?>"></a> | 
                                    <a class="btn btn-primary fa fa-users" href="nilaiTugas.php?id=<?php echo $idTugas; ?>"></a>
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
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Pilih File Tugas:</label>
                <input type="file" name="file" id="file" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</div>