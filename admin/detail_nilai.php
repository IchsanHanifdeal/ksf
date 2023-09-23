<?php $thisPage="Nilai"; ?>
<?php $title = "Nilai Mahasiswa" ?>
<?php $description = "Nilai Mahasiswa" ?>
<?php 
include("header.php"); 
?>

<div class="container">
	<div class="content">
		<h1>Detail Nilai </h1>
			<table class="table" style="width: 100%">
				<thead class="thead-dark">
		        <tr>
		            <th>No</th>
		            <th>NIM</th>
		            <th>Nama</th>
		            <th>Nama Matkul</th>
		            <th>Jenis Nilai</th>
		            <th>Nilai</th>
		            <th>Grade</th>
		        </tr>
		        </thead>
		        <?php 
				include '../koneksi.php';
				$nim = $_GET['nim']; 
		        $no = 1;
		        $sql = mysqli_query($koneksi,"SELECT * FROM detail_matkul INNER JOIN tbl_mahasiswa 
		        								ON detail_matkul.nim = tbl_mahasiswa.nim WHERE tbl_mahasiswa.nim='$nim'");
		        while($data = mysqli_fetch_array($sql)){
		   	     ?>
		        <tbody>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $data['nim']; ?></td>
					<td><?php echo $data['nama']; ?></td>
		            <td><?php echo $data['nm_matkul']; ?></td>
		            <td><?php echo $data['jns_nilai']; ?></td>
		            <td><?php echo $data['nilai']; ?></td>
		            <td><?php echo $data['grade']; ?></td>
		           
				</tr>
				</tbody>
				<?php 
		        }
		        ?>
		</table>
	</div>
</div>
