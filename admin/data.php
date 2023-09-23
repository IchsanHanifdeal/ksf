<?php $thisPage="Data"; ?>
<?php $title = "Data Mahasiswa" ?>
<?php $description = "Data Mahasiswa" ?>
<?php 
include("header.php"); 
include("../koneksi.php"); 
?>
	<div class="container">
		<div class="content">
			<h2>Data Mahasiswa</h2>
			<hr />
			
			<?php
			if(isset($_GET['aksi']) == 'delete'){ 
				$nim = $_GET['nim']; 
				$cek = mysqli_query($koneksi, "SELECT * FROM tbl_mahasiswa WHERE nim='$nim'"); 
				if(mysqli_num_rows($cek) == 0){ 
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>'; 
				}else{ 
					$delete = mysqli_query($koneksi, "DELETE FROM tbl_mahasiswa WHERE nim='$nim'"); 
					if($delete){ 
						echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil dihapus.</div>'; 
					}else{ 
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>'; 
					}
				}
			}
			?>
	
			<form class="form-inline" method="get">
				<div class="form-group">
				<select name="filter" class="form-control" onchange="form.submit()">
						<option value="0">Filter Data Mahasiswa</option>
						<?php $filter = addslashes(isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
						<option value="Manajemen Informatika" <?php if($filter == 'Manajemen Informatika'){ echo 'selected'; } ?>>Manajemen Informatika</option>
						<option value="Akuntansi Syariah" <?php if($filter == 'Akuntansi Syariah'){ echo 'selected'; } ?>>Akuntansi Syariah</option>
						<option value="Perbankan Syariah" <?php if($filter == 'Perbankan Syariah'){ echo 'selected'; } ?>>Perbankan Syariah</option>
						<option value="Manajemen Bisnis Syariah" <?php if($filter == 'Manajemen Bisnis Syariah'){ echo 'selected'; } ?>>Manajemen Bisnis Syariah</option>
						<option value="Ekonomi Syariah" <?php if($filter == 'Ekonomi Syariah'){ echo 'selected'; } ?>>Ekonomi Syariah</option>
						<option value="Manajemen Zakat & Wakaf" <?php if($filter == 'Manajemen Zakat & Wakaf'){ echo 'selected'; } ?>>Manajemen Zakat & Wakaf</option>
						<option value="Pariwisata Syariah" <?php if($filter == 'Pariwisata Syariah'){ echo 'selected'; } ?>>Pariwisata Syariah</option>
					</select>
				</div>
			</form> 
			<br />
			
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
						<th>Jurusan</th>
						<th>Tools</th>
					</tr>
					<?php
					if($filter){
						$sql = mysqli_query($koneksi, "SELECT * FROM tbl_mahasiswa WHERE jurusan='$filter' ORDER BY nim ASC"); 
					}else{
						$sql = mysqli_query($koneksi, "SELECT * FROM tbl_mahasiswa ORDER BY nim ASC"); 
					}
					if(mysqli_num_rows($sql) == 0){ 
						echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; 
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
								<td>';
								if($row['jurusan'] == 'Manajemen Informatika'){
									echo '<span class="label label-success">Manajemen Informatika</span>';
								}
								else if ($row['jurusan'] == 'Akuntansi Syariah' ){
									echo '<span class="label label-success">Akuntansi Syariah</span>';
								}
								else if ($row['jurusan'] == 'Perbankan Syariah' ){
									echo '<span class="label label-success">Perbankan Syariah</span>';
								}
								else if ($row['jurusan'] == 'Manajemen Bisnis Syariah' ){
									echo '<span class="label label-success">Manajemen Bisnis Syariah</span>';
								}
								else if ($row['jurusan'] == 'Ekonomi Syariah' ){
									echo '<span class="label label-success">Ekonomi Syariah</span>';
								}
								else if ($row['jurusan'] == 'Manajemen Zakat & Wakaf' ){
									echo '<span class="label label-success">Manajemen Zakat & Wakaf</span>';
								}
								else if ($row['jurusan'] == 'Pariwisata Syariah' ){
									echo '<span class="label label-success">Pariwisata Syariah</span>';
								}
							echo '
								</td>
								<td>
									
									<a href="edit_mahasiswa.php?nim='.$row['nim'].'" title="Edit Data" data-toggle="tooltip" class="btn btn-primary btn-sm mr3"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
									<a href="password.php?nim='.$row['nim'].'" title="Ganti Password" data-toggle="tooltip" class="btn btn-warning btn-sm mr3"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a>
									<a href="data.php?aksi=delete&nim='.$row['nim'].'" title="Hapus Data" data-toggle="tooltip" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['nama'].'?\')" class="btn btn-danger btn-sm mr3"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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