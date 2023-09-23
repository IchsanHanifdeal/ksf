<?php $thisPage="Profile"; ?>
<?php $title = "Profile" ?>
<?php $description = "Halaman Profile" ?>
<?php 
include("header.php"); 
include("../koneksi.php"); 
?>
	<div class="container">
		<div class="content">
			<h2>Profile</h2>
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
					<th width="20%">NIP</th>
					<td><?php echo $row['nip']; ?></td>
				</tr>
				<tr>
					<th>Nama Dosen</th>
					<td><?php echo $row['nama_dosen']; ?></td>
				</tr>
				<tr>
					<th>Mengajar</th>
					<td><?php echo $row['dosen_matkul']; ?></td>
				</tr>
				<tr>
					<th>Jenis Kelamin</th>
					<td><?php echo $row['jenis_kelamin']; ?></td>
				</tr>
				<tr>
					<th>Tempat & Tanggal Lahir</th>
					<td><?php echo $row['tempat_lahir'].', '.$row['tanggal_lahir']; ?></td>
				</tr>
				<tr>
					<th>Alamat Asal</th>
					<td><?php echo $row['alamat']; ?></td>
				</tr>
				<tr>
					<th>No Telepon</th>
					<td><?php echo $row['telepon']; ?></td>
				</tr>
				<tr>
					<th>Email</th>
					<td><?php echo $row['email']; ?></td>
				</tr>
				<tr>
					<th>Username</th>
					<td><?php echo $row['username']; ?></td>
				</tr>
			</table>
			
			<a href="index.php" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Dashboard</a>
			<a href="edit.php?username=<?php echo $row['username']; ?>" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit Profile</a>
			<a href="password_dosen.php?username=<?php echo $row['username']; ?>" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Ganti Password</a>
		</div> 
	</div> 
<?php 
include("footer.php"); 
?>