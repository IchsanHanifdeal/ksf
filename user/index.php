<?php $thisPage="Dashboard"; ?>
<?php $title = "Dashboard User" ?>
<?php $description = "Dashboard User" ?>
<?php 
include("header.php"); 
include("../koneksi.php"); 
?>
	
	<div class="container">
		<div class="content">
			<?php
			$username = $_SESSION['user']; 
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
				<p>Anda Login Sebagai User <strong><a href="profile.php"><?php echo $row['nama']; ?></a></strong>.</p>
				<a href="data.php" data-toggle="tooltip" title="Lihat Data Mahasiswa" class="btn btn-info" role="button"><span class="glyphicon glyphicon-list"></span> Lihat Data Mahasiswa</a>
				<a href="nilai.php" data-toggle="tooltip" title="Lihat Nilai Mahasiswa" class="btn btn-info" role="button"><span class="glyphicon glyphicon-list"></span> Lihat Nilai Mahasiswa</a></center>
			</div> 
		</div> 
	</div>
	
<?php 
include("footer.php"); 
?>