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

			
			<form class="form-inline" method="get">
				<div class="form-group">
					<select name="filter" class="form-control" onchange="form.submit()">
						<option value="0">Filter Nilai Mahasiswa</option>
						<?php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
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
						<th>Dosen</th>
						<th>Nama Maktul</th>
						<th>Jenis Nilai</th>
						<th>Nilai</th>
						<th>Grade</th>
					</tr>
					<?php
					$username = $_SESSION['user'];
					if($filter){
						$sql = mysqli_query($koneksi, "SELECT * FROM detail_matkul
							INNER JOIN tbl_mahasiswa ON detail_matkul.nim = tbl_mahasiswa.nim
						WHERE grade='$filter' AND username='$username'"); 
					}else{
						$sql = mysqli_query($koneksi,"SELECT * FROM detail_matkul
								INNER JOIN tbl_mahasiswa ON detail_matkul.nim = tbl_mahasiswa.nim WHERE username='$username'
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
								<td>'.$row['nama'].'</a></td>
								<td>'.$row['dosen'].'</a></td>
								<td>'.$row['nm_matkul'].'</td>
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