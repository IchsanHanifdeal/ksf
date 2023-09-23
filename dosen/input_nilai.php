<?php $thisPage="Tambah"; ?>
<?php $title = "Tambah Data Mahasiswa" ?>
<?php $description = "Tambah Data Mahasiswa" ?>
<?php 
include("header.php"); 
include("../koneksi.php"); 
?>
	<div class="container">
		<div class="content">
			<h2>Input Nilai &raquo; Tambah Nilai</h2>
			<hr />
			
			<?php
			if(isset($_POST['add'])){ 
				$nim			 = $_POST['nim'];
				$nm_matkul		 = $_POST['nm_matkul'];
				$dosen			 = $_POST['dosen'];
				$jns_nilai   	 = $_POST['jns_nilai'];
				$nilai	 		 = $_POST['nilai'];
				$grade 			 = $_POST['grade'];
				
				$nilai = $_POST['nilai'];
					if ($nilai >= 90 ){ $grade='A';} else
					if ($nilai > 70 ){ $grade='B';} else
					if ($nilai > 50 ){ $grade='C';} else
					if ($nilai > 30 ){ $grade='D';}	else 
					if ($nilai > 10 ){ $grade='E';}

				$insert = mysqli_query($koneksi, "INSERT INTO detail_matkul( nim,jns_nilai,nm_matkul,dosen,nilai,grade) 
															VALUES('$nim','$jns_nilai','$nm_matkul','$dosen','$nilai','$grade')");
					if($insert){ 
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Nilai Berhasil Di Simpan. <a href="nilai.php"><- Kembali</a></div>'; 
					}else{ 
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data Nilai Gagal Di simpan! <a href="nilai.php"><- Kembali</a></div>'; 
					}

				}
			?>
			
			<form class="form-horizontal" action="" method="post">
			

				<div class="form-group">
					<label class="col-sm-3 control-label">NIM</label>
					<div class="col-sm-2">
						<input type="text" name="nim" class="form-control" placeholder="nim" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Nama Matkul</label>
					<div class="col-sm-3">
						<select name="nm_matkul" id="mt" class="form-control" required>
							<option>- Pilih Matkul -</option>
							<option value="Kapita Selekta Fiqih">Kapita Selekta Fiqih</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Dosen</label>
					<div class="col-sm-3">
						<select name="dosen" class="form-control" required>
							<option> -- Pilih Dosen -- </option>
							<?php 
								$ambil = mysqli_query($koneksi, "SELECT * FROM dosen");
								while ($data = mysqli_fetch_assoc($ambil)) {
									echo '<option value="'.$data['nama_dosen'].'">'.$data['nama_dosen'].'</option>';								
								}
							?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Jenis Nilai</label>
					<div class="col-sm-3">
						<select name="jns_nilai" class="form-control" required>
							<option value=""> - Jenis Penilaian - </option>
							<option>TUGAS</option>
							<option>KUIS</option>
							<option>RESUME</option>
							<option>UTS</option>
							<option>UAS</option>
						</select>
						
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Nilai</label>
					<div class="col-sm-3">
						<input type="text" name="nilai" class="form-control" placeholder="Masukan Nilai" onkeypress="return event.charCode >= 48 && event.charCode <=57" required>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-3">
						<input type="hidden" name="grade" class="form-control" ></input>
					</div>
				</div>
				 
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Simpan" data-toggle="tooltip" title="Simpan Data nilai" onClick="x()">
						<a href="index.php" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Batal">Batal</a>
					</div>
				</div>
			</form> 
		</div> 
	</div> 
<?php 
include("footer.php"); 
?>