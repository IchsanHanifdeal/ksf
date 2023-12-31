<?php
include("akses_user.php"); 
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?php echo $title; ?></title>
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/bootstrap-datepicker.css" rel="stylesheet">
	<link rel="stylesheet" href="../app/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/tooltip.js"></script>
	<script src="../js/bootstrap-datepicker.js"></script>
    <link href="../style.css" rel="stylesheet">
	<script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
	});
	</script>
  </head>
<body>
	
	<nav class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
		  <ul class="nav navbar-nav navbar-left">
			<li<?php if ($thisPage=="Dashboard") echo " class=\"active\""; ?>><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
			<li<?php if ($thisPage=="Silabus") echo " class=\"active\""; ?>><a href="silabus.php" data-toggle="tooltip" data-placement="bottom" title="Silabus"><span class="glyphicon glyphicon-book"></span> Silabus</a></li>
			<li<?php if ($thisPage=="Absen") echo " class=\"active\""; ?>><a href="absen.php" data-toggle="tooltip" data-placement="bottom" title="Absen"><span class="glyphicon glyphicon-list"></span> Absen</a></li>
			<li<?php if ($thisPage=="Materi") echo " class=\"active\""; ?>><a href="materi.php" data-toggle="tooltip" data-placement="bottom" title="Materi"><span class="glyphicon glyphicon-folder-open"></span> Materi</a></li>
			<li<?php if ($thisPage=="Tugas") echo " class=\"active\""; ?>><a href="tugas.php" data-toggle="tooltip" data-placement="bottom" title="Lihat Tugas Mahasiswa"><span class="glyphicon glyphicon-list"></span> Tugas</a></li>
			<li<?php if ($thisPage=="Data") echo " class=\"active\""; ?>><a href="data.php" data-toggle="tooltip" data-placement="bottom" title="Lihat Data Mahasiswa"><span class="glyphicon glyphicon-list"></span> Data Mahasiswa</a></li>
			<li<?php if ($thisPage=="Nilai") echo " class=\"active\""; ?>><a href="nilai.php" data-toggle="tooltip" data-placement="bottom" title="Lihat Nilai Mahasiswa"><span class="glyphicon glyphicon-list"></span> Nilai Mahasiswa</a></li>
			<form name="cari" method="post" action="cari.php" role="search" class="navbar-form navbar-left">
				<div class="form-group">
					<input type="text" name="carinim" placeholder="Cari NIM Mahasiswa" class="form-control">
				</div>
				<button type="submit" name="submit" id="submit" value="search" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Cari Data Mahasiswa">Cari</button>
			</form>
		  </ul>
	      <ul class="nav navbar-nav navbar-right">
	        <a href="../logout.php" data-toggle="tooltip" data-placement="bottom" title="Logout" class="btn btn-danger navbar-btn" role="button"><span class="glyphicon glyphicon-off"></span> Logout</a>
	      </ul>
		</div>
	  </div>
	</nav>
	