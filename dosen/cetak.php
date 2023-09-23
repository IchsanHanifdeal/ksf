<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

    <center>
            <br>
        <h2>LAPORAN NILAI MAHASISWA</h2>
            <br>
    </center>

    <?php 
    include '../koneksi.php';
    ?>

    <table class="table" style="width: 100%">
        <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Nama Matkul</th>
            <th>Dosen</th>
            <th>Jenis Nilai</th>
            <th>Nilai</th>
            <th>Grade</th>
            <th>Keterangan</th>
        </tr>
        </thead>
        <tbody>

        <?php 
        $no = 1;    
        $grade = addslashes($_GET['grade']);
       
        if($grade == ""){ 
                $sql = mysqli_query($koneksi, "SELECT * ,CASE WHEN grade='A' then 'LULUS' when grade='B' then 'LULUS' when grade='C' then 'LULUS' when grade='D' then 'TIDAK LULUS' when grade='E' then 'SANGAT TIDAK LULUS' end as Keterangan FROM detail_matkul INNER JOIN tbl_mahasiswa ON detail_matkul.nim = tbl_mahasiswa.nim order by grade ASC");
            }else{
                $sql = mysqli_query($koneksi,"SELECT * ,CASE WHEN grade='A' then 'LULUS' when grade='B' then 'LULUS' when grade='C' then 'LULUS' when grade='D' then 'TIDAK LULUS' when grade='E' then 'SANGAT TIDAK LULUS' end as Keterangan FROM detail_matkul INNER JOIN tbl_mahasiswa ON detail_matkul.nim = tbl_mahasiswa.nim WHERE grade='$grade'");
            }
        
        while($data = mysqli_fetch_array($sql)){
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['nim']; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['nm_matkul']; ?></td>
            <td><?php echo $data['dosen']; ?></td>
            <td><?php echo $data['jns_nilai']; ?></td>
            <td><?php echo $data['nilai']; ?></td>
            <td><?php echo $data['grade']; ?></td>
            <td><?php echo $data['Keterangan']; ?></td>
        </tr>
        </tbody>
        <?php 
        }
        ?>
    </table>

    <script>
        window.print();
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>