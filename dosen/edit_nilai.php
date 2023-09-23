<?php $thisPage="Edit Mahasiswa"; ?>
<?php $title = "Edit Nilai Mahasiswa" ?>
<?php $description = "Edit Nilai Mahasiswa" ?>
<?php 
include("header.php"); 
include("../koneksi.php"); 
?>
	<div class="container">
		<div class="content">
			<h2>Nilai Mahasiswa &raquo; Edit Nilai</h2>
			<hr />
			
			<?php
			$id_nilai = $_GET['id_nilai']; 
			$sql = mysqli_query($koneksi, "SELECT * FROM detail_matkul INNER JOIN tbl_mahasiswa 
		        								ON detail_matkul.nim = tbl_mahasiswa.nim WHERE id_nilai='$id_nilai'"); 
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){ 
				$nim			 = $_POST['nim'];
				$nm_matkul		 = $_POST['nm_matkul'];
				$dosen    	     = $_POST['dosen'];
				$jns_nilai    	 = $_POST['jns_nilai'];
				$nilai	 		 = $_POST['nilai'];
				$grade 			 = $_POST['grade'];

				$nilai = $_POST['nilai'];
					if ($nilai >= 90 ){ $grade='A';} else
					if ($nilai > 70 ){ $grade='B';} else
					if ($nilai > 50 ){ $grade='C';} else
					if ($nilai > 30 ){ $grade='D';}	else 
					if ($nilai > 10 ){ $grade='E';}
				
				$update = mysqli_query($koneksi, "UPDATE detail_matkul SET jns_nilai='$jns_nilai',nm_matkul='$nm_matkul',dosen='$dosen',nilai='$nilai',grade='$grade' WHERE id_nilai='$id_nilai'") or die(mysqli_error()); 
				if($update){ 
					header("Location: edit_nilai.php?id_nilai=".$id_nilai."&pesan=sukses"); 
				}else{ 
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>'; 
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){ 
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan. <a href="nilai.php"><- Kembali</a></div>'; 
			}
			?>
			
			<form class="form-horizontal" action="" method="post">
			
				<div class="form-group">
					<label class="col-sm-3 control-label">NIM</label>
					<div class="col-sm-2">
						<input type="text" name="nim" class="form-control" value="<?php echo $row['nim']; ?>" readonly>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Nama Matkul</label>
					<div class="col-sm-3">
						<select name="nm_matkul" class="form-control" required>
							<option value="<?php echo $row['nm_matkul']; ?>"> <?php echo $row['nm_matkul']; ?> </option>
							<option>Pemrograman Web</option>
							<option>PBO</option>
							<option>Desain Web</option>
							<option>Mobile Programing</option>
							<option>Basis Data</option>
							<option>Java Web</option>
							<option>Algoritma dan Pemrograman</option>
							<option>Pemrograman OOP</option>
							<option>Pemrograman Visual / GUI</option>
							<option>Jaringan Komputer</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Dosen</label>
					<div class="col-sm-3">
						<select name="dosen" class="form-control" required>
							<option value="<?php echo $row['dosen']; ?>"> <?php echo $row['dosen']; ?> </option>
							<?php 
								$ambil = mysqli_query($koneksi, "SELECT * FROM dosen");
								while ($data = mysqli_fetch_assoc($ambil)) {
									echo '<option value="'.$data['nama'].'">'.$data['nama'].'</option>';								
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Jenis Nilai</label>
					<div class="col-sm-3">
						<select name="jns_nilai" class="form-control" required>
							<option value="<?php echo $row['jns_nilai']; ?>"> <?php echo $row['jns_nilai']; ?> </option>
							<option>SKS</option>
							<option>UAS</option>
							<option>UTS</option>
							<option>UN</option>
							<option>TUGAS</option>
							<option>LPK</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Nilai</label>
					<div class="col-sm-3">
						<input type="text" name="nilai" class="form-control" value="<?php echo $row['nilai']; ?>" required>
					</div>
				</div>

				
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Simpan" data-toggle="tooltip" title="Simpan Data Mahasiswa">
						<a href="nilai.php" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Batal">Batal</a>
					</div>
				</div>
			</form>
		</div> 
	</div> 
<?php 
include("footer.php"); 
?>