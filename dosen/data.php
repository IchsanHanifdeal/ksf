<?php $thisPage="Data Dosen"; ?>
<?php $title = "Data Dosen" ?>
<?php $description = "Halaman Dosen" ?>
<?php 
include("header.php"); 
include("../koneksi.php"); 
?>
	<div class="container">
		<div class="content">
			<h2>Data Dosen</h2>
			<hr />
			
			<?php
			$username = $_SESSION['dosen']; 
			
			$sql = mysqli_query($koneksi, "SELECT * FROM dosen WHERE username='$username'"); 
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			?>
			
			<table class="table table-striped table-condensed">
				<tr>
					<th>Username</th>
					<td><?php echo $row['username']; ?></td>
				</tr>
				<tr>
					<th width="20%">NIP</th>
					<td><?php echo $row['nip']; ?></td>
				</tr>
				<tr>
					<th>Nama Dosen</th>
					<td><?php echo $row['nama_dosen']; ?></td>
					<tr>
					<th>Jenis Kelamin</th>
					<td><?php echo $row['jenis_kelamin']; ?></td>
				</tr>
				</tr>
				<tr>
					<th>Alamat</th>
					<td><?php echo $row['alamat']; ?></td>
				</tr>
				<tr>
					<th>Tempat & Tanggal Lahir</th>
					<td><?php echo $row['tempat_lahir'].', '.$row['tanggal_lahir']; ?></td>
				</tr>
				
				<tr>
					<th>No Telepon</th>
					<td><?php echo $row['telepon']; ?></td>
				</tr>
				<tr>
					<th>Mengajar</th>
					<td><?php echo $row['dosen_matkul']; ?></td>
				</tr>
				<tr>
					<th>Email</th>
					<td><?php echo $row['email']; ?></td>
				</tr>
			</table>
			
		</div> 
	</div> 
<?php 
include("footer.php"); 
?>