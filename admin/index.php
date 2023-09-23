<?php $thisPage="Dashboard"; ?>
<?php $title = "Dashboard Admin" ?>
<?php $description = "Dashboard Admin" ?>
<?php 
include("header.php"); 
include("../koneksi.php"); 
?>
	
	<div class="container">
		<div class="content">
			<?php
			$username = $_SESSION['admin']; 
			$sql = mysqli_query($koneksi, "SELECT * FROM tbl_mahasiswa WHERE username='$username'"); 
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			?>
			<div class="jumbotron">
				<center><h1>Kapita Selekta Fiqih</h1>
				<img src="../logo/uin.png" height="300" width="300" class="img-responsive"/><br />
				<p>Anda login sebagai Administrator <strong><a href="profile.php"><?php echo $row['nama']; ?></a></strong>.</p>
				<a href="data.php" data-toggle="tooltip" title="Lihat Data Mahasiswa" class="btn btn-info" role="button"><span class="glyphicon glyphicon-list"></span> Data Mahasiswa</a>
				<a href="nilai.php" data-toggle="tooltip" title="Lihat Nilai Mahasiswa" class="btn btn-info" role="button"><span class="glyphicon glyphicon-list"></span> Nilai Mahasiswa</a>
				<a href="tambah.php" data-toggle="tooltip" title="Tambah Data Mahasiswa" class="btn btn-success" role="button"><span class="glyphicon glyphicon-user"></span> Tambah Data</a></center>
			</div> 
		</div> 
	</div>
	
<?php 
include("footer.php"); 
?>