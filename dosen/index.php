<?php $thisPage="Dashboard"; ?>
<?php $title = "Dashboard Dosen" ?>
<?php $description = "Dashboard User" ?>
<?php 
include ("akses_dosen.php");
include("header.php"); 
include("../koneksi.php"); 
?>
	
	<div class="container">
		<div class="content">
			<?php
			$username = $_SESSION['dosen']; 
			$sql = mysqli_query($koneksi, "SELECT * FROM dosen WHERE username='$username'"); 
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			?>
			<div class="jumbotron">
				<center><h1>Kapita Selekta Fiqih</h1>
				<img src="../logo/uin.png" height="300" width="300" class="img-responsive"/><br />
				<p>Anda login sebagai Dosen <strong><a href="profile.php"><?php echo $row['nama_dosen']; ?></a></strong>.</p>
				<a href="data_mahasiswa.php" data-toggle="tooltip" title="Lihat Data Mahasiswa" class="btn btn-info" role="button"><span class="glyphicon glyphicon-list"></span> Data Mahasiswa</a>
				<a href="nilai.php" data-toggle="tooltip" title="Lihat Nilai Mahasiswa" class="btn btn-info" role="button"><span class="glyphicon glyphicon-list"></span> Nilai Mahasiswa</a>
				<a href="absen.php" data-toggle="tooltip" title="Lihat Data Absen" class="btn btn-info" role="button"><span class="glyphicon glyphicon-list"></span> Data Absensi</a>
				<a href="tambah.php" data-toggle="tooltip" title="Tambah Data Mahasiswa" class="btn btn-success" role="button"><span class="glyphicon glyphicon-user"></span> Tambah Data</a></center>
			</div> 
		</div> 
	</div>
	
<?php 
include("footer.php"); 
?>