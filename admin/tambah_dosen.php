<?php $thisPage="Tambah Dosen"; ?>
<?php $title = "Tambah Data Dosen" ?>
<?php $description = "Tambah Data Dosen" ?>
<?php 
include("header.php"); 
include("../koneksi.php"); 
?>
	<div class="container">
		<div class="content">
			<h2> Data Dosen &raquo; Tambah Dosen</h2>
			<hr />
			
			<?php
			if(isset($_POST['add'])){ 
				$nip		     = $_POST['nip'];
				$nama_dosen		 = $_POST['nama_dosen'];
				$jenis_kelamin   = $_POST['jenis_kelamin'];
				$tempat_lahir	 = $_POST['tempat_lahir'];
				$tanggal_lahir	 = $_POST['tanggal_lahir'];
				$dosen_matkul	 = $_POST['dosen_matkul'];
				$alamat 		 = $_POST['alamat'];
				$telepon		 = $_POST['telepon'];
				$email  		 = $_POST['email'];
				$username		 = $_POST['username'];
				$level 			 = $_POST['level'];
				$pass1	         = $_POST['pass1'];
				$pass2           = $_POST['pass2'];
				
				$cek = mysqli_query($koneksi, "SELECT * FROM dosen WHERE nip='$nip'"); 
				if(mysqli_num_rows($cek) == 0){ 
					if($pass1 == $pass2){ 
						$pass = md5($pass1); 
						$insert = mysqli_query($koneksi, "INSERT INTO dosen(nip, nama_dosen, jenis_kelamin, tempat_lahir, tanggal_lahir, dosen_matkul,alamat, telepon, email, level, username, password) VALUES('$nip','$nama_dosen', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$dosen_matkul','$alamat', '$telepon', '$email','$level', '$username','$pass')") or die(mysqli_error()); 
						if($insert){ 
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Dosen Berhasil Di Simpan. <a href="data_dosen.php"><- Kembali</a></div>'; 
						}else{ 
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data Dosen Gagal Di simpan! <a href="data_dosen.php"><- Kembali</a></div>'; 
						}
					} else{ 
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password Tidak sama!</div>'; 
					}
				}else{ 
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>NIP Sudah Ada..! <a href="data_dosen.php"><- Kembali</a></div>'; 
				}
			}
			?>
			
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">NIP</label>
					<div class="col-sm-2">
						<input type="text" name="nip" class="form-control" placeholder="NIP" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nama</label>
					<div class="col-sm-4">
						<input type="text" name="nama_dosen" class="form-control" placeholder="Nama" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Jenis Kelamin</label>
					<div class="col-sm-2">
						<select name="jenis_kelamin" class="form-control" required>
							<option value=""> - Pilih - </option>
							<option value="Laki-Laki">Laki-Laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>
				</div>
	
				<div class="form-group">
					<label class="col-sm-3 control-label">Tanggal Lahir</label>
					<div class="col-sm-3">
						<input type="text" name="tanggal_lahir" class="input-group datepicker form-control" date="" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Mengajar</label>
					<div class="col-sm-3">
						<input type="text" name="dosen_matkul" class="form-control" placeholder="Sebagai Dosen" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Tempat Lahir</label>
					<div class="col-sm-3">
						<input type="text" name="tempat_lahir" class="form-control"  placeholder="Tempat Lahir" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Alamat</label>
					<div class="col-sm-3">
						<textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">No Telepon</label>
					<div class="col-sm-3">
						<input type="text" name="telepon" class="form-control" placeholder="No Telepon" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Email</label>
					<div class="col-sm-3">
						<input type="email" name="email" class="form-control" placeholder="Email" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Level</label>
					<div class="col-sm-2">
						<select name="level" class="form-control" required>
							<option value="dosen">Dosen</option>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Username</label>
					<div class="col-sm-2">
						<input type="text" name="username" class="form-control" placeholder="Username" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Password</label>
					<div class="col-sm-2">
						<input type="password" name="pass1" class="form-control" placeholder="Password" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Ulangi Password</label>
					<div class="col-sm-2">
						<input type="password" name="pass2" class="form-control" placeholder="Ulangi Password" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Simpan" data-toggle="tooltip" title="Simpan Data mahasiswa">
						<a href="index.php" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Batal">Batal</a>
					</div>
				</div>
			</form> 
		</div> 
	</div> 
<?php 
include("footer.php"); 
?>