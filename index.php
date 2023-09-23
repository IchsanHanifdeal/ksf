<?php $thisPage="Home"; ?>
<?php $title = "Sistem Informasi Data Mahasiswa" ?>
<?php $description = "Mahasiswa Universitas Riau" ?>
<?php require('akses.php'); ?> 
<?php 
include("header.php"); 
include("koneksi.php"); 
?>
	
	<div class="container">
		<div class="content">
			<div class="jumbotron">
				<center><h1>Kapita Selekta Fiqih</h1>
				<img src="logo/uin.png" height="300" width="300" class="img-responsive"/><br />
				<a href="login.php" data-toggle="tooltip" title="Login!" class="btn btn-info" role="button"><span class="glyphicon glyphicon-list"></span> Login!</a></center>
			</div> 
		</div> 
	</div>
	
<?php 
include("footer.php"); 
?>