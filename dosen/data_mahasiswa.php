<?php $thisPage="Data Mahasiswa"; ?>
<?php $title = "Data Mahasiswa" ?>
<?php $description = "Data Mahasiswa" ?>
<?php 
include("header.php"); 
include("../koneksi.php"); 

$filter = isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL;

?>
	<div class="container">
		<div class="content">
			<h2>Data Mahasiswa</h2>
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>No</th>
						<th>NIM</th>
						<th>Nama</th>
						<th>Jenis Kelamin</th>
						<th>Tempat Lahir</th>
						<th>Tanggal Lahir</th>
						<th>No Telepon</th>
						<th>Agama</th>
						<th>Email</th>
						<th>Tools</th>
					</tr>
					<?php
					if($filter){
						$sql = mysqli_query($koneksi, "SELECT * FROM tbl_mahasiswa"); 
					}else{
						$sql = mysqli_query($koneksi, "SELECT * FROM tbl_mahasiswa ORDER BY nim ASC"); 
					}
					if(mysqli_num_rows($sql) == 0){ 
						echo '<tr><td colspan="10">Data Tidak Ada.</td></tr>'; 
					}else{ 
						$no = 1; 
						while($row = mysqli_fetch_assoc($sql)){ 
							echo '
							<tr>
								<td>'.$no.'</td>
								<td>'.$row['nim'].'</td>
								<td><a href="profile_mahasiswa.php?nim='.$row['nim'].'">'.$row['nama'].'</a></td>
								<td>'.$row['jenis_kelamin'].'</td>
								<td>'.$row['tempat_lahir'].'</td>
								<td>'.$row['tanggal_lahir'].'</td>
								<td>'.$row['no_telepon'].'</td>
								<td>'.$row['agama'].'</td>
								<td>'.$row['email'].'</td>
								<td>
									<a href="edit_mahasiswa.php?nim='.$row['nim'].'" title="Edit Data" data-toggle="tooltip" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
								</td>
							</tr>
							';
							$no++; 
						}
					}
					?>
				</table>
			</div> 
		</div> 
	</div> 
<?php 
include("footer.php"); 
?>
