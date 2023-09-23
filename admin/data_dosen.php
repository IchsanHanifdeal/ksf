<?php $thisPage="Data Dosen"; ?>
<?php $title = "Data Dosen" ?>
<?php $description = "Data Dosen" ?>
<?php 
include("header.php"); 
include("../koneksi.php"); 
?>
	<div class="container">
		<div class="content">
			<h2>Data Dosen</h2>
			<hr />
			
			<?php
			if(isset($_GET['aksi']) == 'delete'){ 
				$nip = $_GET['nip']; 
				$cek = mysqli_query($koneksi, "SELECT * FROM dosen WHERE nip='$nip'"); 
				if(mysqli_num_rows($cek) == 0){ 
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>'; 
				}else{ 
					$delete = mysqli_query($koneksi, "DELETE FROM dosen WHERE nip='$nip'"); 
					if($delete){ 
						echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil dihapus.</div>'; 
					}else{ 
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>'; 
					}
				}
			}
			?>
			
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>No</th>
						<th>Nip</th>
						<th>Nama</th>
						<th>Jenis Kelamin</th>
						<th>Mengajar</th>
						<th>Tempat Lahir</th>	
						<th>No Telepon</th>
						<th>Email</th>
						<th>Tools</th>
					</tr>
					<?php
					$sql = mysqli_query($koneksi, "SELECT * FROM dosen WHERE nip");
						$no = 1; 
						while($row = mysqli_fetch_assoc($sql)){ 
							echo '
							<tr>
								<td>'.$no.'</td>
								<td>'.$row['nip'].'</td>
								<td><a href="profile_dosen.php?nip='.$row['nip'].'">'.$row['nama_dosen'].'</a></td>
								<td>'.$row['jenis_kelamin'].'</td>
								<td>'.$row['dosen_matkul'].'</td>
								<td>'.$row['tempat_lahir'].'</td>
								<td>'.$row['telepon'].'</td>
								<td>'.$row['email'].'</td>';
						
							echo '
								
								<td>
									
									<a href="edit_dosen.php?nip='.$row['nip'].'" title="Edit Data" data-toggle="tooltip" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
									
									<a href="data_dosen.php?aksi=delete&nip='.$row['nip'].'" title="Hapus Data" data-toggle="tooltip" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['nama_dosen'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
								</td>
							</tr>
							';
							$no++; 
						}
					?>
				</table>
			</div> 
		</div> 
	</div> 
<?php 
include("footer.php"); 
?>