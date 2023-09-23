<?php $thisPage="Edit"; ?>
<?php $title = "Edit Profile" ?>
<?php $description = "Halaman Edit Profile" ?>
<?php 
include("header.php"); 
include("../koneksi.php"); 
?>
	<div class="container">
		<div class="content">
			<h2>Edit Profile</h2>
			<hr />
			
			<?php
			$username = $_SESSION['user']; 
			$sql = mysqli_query($koneksi, "SELECT * FROM tbl_mahasiswa WHERE username='$username'"); 
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){ 
				$nim		     = $_POST['nim'];
				$nama		     = $_POST['nama'];
				$jenis_kelamin   = $_POST['jenis_kelamin'];
				$tempat_lahir	 = $_POST['tempat_lahir'];
				$tanggal_lahir	 = $_POST['tanggal_lahir'];
				$alamat_asal     = $_POST['alamat_asal'];
				$alamat_sekarang = $_POST['alamat_sekarang'];
				$no_telepon		 = $_POST['no_telepon'];
				$email  		 = $_POST['email'];
				$agama			 = $_POST['agama'];
				$jurusan	     = $_POST['jurusan'];
								
				$update = mysqli_query($koneksi, "UPDATE tbl_mahasiswa SET nama='$nama', jenis_kelamin='$jenis_kelamin', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', alamat_asal='$alamat_asal', alamat_sekarang='$alamat_sekarang', no_telepon='$no_telepon', email='$email', agama='$agama', jurusan='$jurusan' WHERE username='$username'") or die(mysqli_error()); 
				if($update){ 
					header("Location: edit.php?username=".$username."&pesan=sukses"); 
				}else{ 
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>'; 
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){ 
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan. <- <a href="data.php">Kembali ke Profile</a></div>'; 
			}
			?>
			
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">NIM</label>
					<div class="col-sm-2">
						<input type="text" name="nim" value="<?php echo $row ['nim']; ?>" class="form-control" placeholder="nim" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nama</label>
					<div class="col-sm-4">
						<input type="text" name="nama" value="<?php echo $row ['nama']; ?>" class="form-control" placeholder="Nama" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Jenis Kelamin</label>
					<div class="col-sm-2">
						<select name="jenis_kelamin" class="form-control" required>
							<option value="<?php echo $row ['jenis_kelamin']; ?>"><?php echo $row ['jenis_kelamin']; ?></option>
							<option value="Laki-Laki">Laki-Laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Tempat Lahir</label>
					<div class="col-sm-4">
						<input type="text" name="tempat_lahir" value="<?php echo $row ['tempat_lahir']; ?>" class="form-control" placeholder="Tempat Lahir" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Tanggal Lahir</label>
					<div class="col-sm-4">
						<input type="text" name="tanggal_lahir" value="<?php echo $row ['tanggal_lahir']; ?>" class="input-group datepicker form-control" date="" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Alamat Asal</label>
					<div class="col-sm-3">
						<textarea name="alamat_asal" class="form-control" placeholder="Alamat Asal"><?php echo $row ['alamat_asal']; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Alamat Sekarang</label>
					<div class="col-sm-3">
						<textarea name="alamat_sekarang" class="form-control" placeholder="Alamat Sekarang"><?php echo $row ['alamat_sekarang']; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">No Telepon</label>
					<div class="col-sm-3">
						<input type="text" name="no_telepon" value="<?php echo $row ['no_telepon']; ?>" class="form-control" placeholder="No Telepon" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Email</label>
					<div class="col-sm-3">
						<input type="email" name="email" value="<?php echo $row ['email']; ?>" class="form-control" placeholder="Email" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Agama</label>
					<div class="col-sm-4">
						<input type="text" name="agama" value="<?php echo $row ['agama']; ?>" class="form-control" placeholder="Agama" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Jurusan</label>
					<div class="col-sm-2">
					<select name="filter" class="form-control" required>
						<option value="0">Jurusan</option>
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
                    <div class="col-sm-3">
                    <b>Jurusan Sekarang :</b> <span class="label label-success"><?php echo $row['jurusan']; ?></span>
				    </div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Simpan" data-toggle="tooltip" title="Simpan Data Mahasiswa">
						<a href="data.php" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Batal">Batal</a>
					</div>
				</div>
			</form>
		</div> 
	</div> 
<?php 
include("footer.php"); 
?>