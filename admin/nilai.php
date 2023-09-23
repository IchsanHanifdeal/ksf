<?php $thisPage="Nilai"; ?>
<?php $title = "Nilai Mahasiswa" ?>
<?php $description = "Nilai Mahasiswa" ?>
<?php 
include("header.php"); 
include("../koneksi.php"); 
?>
	<div class="container">
		<div class="content">
			<h2>Nilai Mahasiswa</h2>
			<hr />
			
			<?php
			if(isset($_GET['aksi']) == 'delete'){ 
				$id_nilai = $_GET['id_nilai'];
				$cek = mysqli_query($koneksi, "SELECT * FROM detail_matkul WHERE id_nilai='$id_nilai'"); 
				if(mysqli_num_rows($cek) == 0){ 
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>'; 
				}else{ 
					$delete = mysqli_query($koneksi, "DELETE FROM detail_matkul WHERE id_nilai='$id_nilai'"); 
					if($delete){ 
						echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								  Data Berhasil Dihapus!
								</div>'; 
					}else{ 
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>'; 
					}
				}
			}
			?>
			<form class="form-inline" method="get">
				<div class="form-group">
					<select name="filter" class="form-control" onchange="form.submit()">
						<option value="0">Filter Nilai Mahasiswa</option>
						<?php $filter = addslashes(isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
						<option value="A" <?php if($filter == 'A'){ echo 'selected'; } ?>>A</option>
						<option value="B" <?php if($filter == 'B'){ echo 'selected'; } ?>>B</option>
                        <option value="C" <?php if($filter == 'C'){ echo 'selected'; } ?>>C</option>
						<option value="D" <?php if($filter == 'D'){ echo 'selected'; } ?>>D</option>
						<option value="E" <?php if($filter == 'E'){ echo 'selected'; } ?>>E</option>
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
						<th>Nama Maktul</th>
						<th>Dosen</th>
						<th>Jenis Nilai</th>
						<th>Nilai</th>
						<th>Grade</th>
						<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tools</th>
					</tr>
					<?php
					if($filter){
						$sql = mysqli_query($koneksi, "SELECT * FROM detail_matkul
							INNER JOIN tbl_mahasiswa ON detail_matkul.nim = tbl_mahasiswa.nim
						WHERE grade='$filter'"); 
					}else{
						$sql = mysqli_query($koneksi, "SELECT * FROM detail_matkul
								INNER JOIN tbl_mahasiswa ON detail_matkul.nim = tbl_mahasiswa.nim
								"); 
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
								<td>'.$row['nm_matkul'].'</td>
								<td>'.$row['dosen'].'</td>
								<td>'.$row['jns_nilai'].'</td>
								<td>'.$row['nilai'].'</td>
								
								<td>';
								if($row['grade'] == 'A'){
									echo '<span class="label label-success">A</span>';
								}
								else if ($row['grade'] == 'B' ){
									echo '<span class="label label-success">B</span>';
								}
								else if ($row['grade'] == 'C' ){
									echo '<span class="label label-success">C</span>';
								}
								else if ($row['grade'] == 'D' ){
									echo '<span class="label label-success">D</span>';
								}
								else if ($row['grade'] == 'E' ){
									echo '<span class="label label-success">E</span>';
								}
							echo '
								</td>
								<td>
									
									

									<a href="nilai.php?aksi=delete&id_nilai='.$row['id_nilai'].'" title="Hapus Data" data-toggle="tooltip" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['nama'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

									<a href="detail_nilai.php?nim='.$row['nim'].'" title="Detail Nilai" data-toggle="tooltip" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></a>
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
		<a href="cetak.php?grade=<?php echo $filter ?>" data-toggle="tooltip" title="Cetak" class="btn btn-success" role="button" target="_blank"><span class="glyphicon glyphicon-print"></span> Cetak Nilai </a>
	</div> 
<?php 
include("footer.php"); 
?>