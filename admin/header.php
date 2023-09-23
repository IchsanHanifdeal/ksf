<?php
include("akses_admin.php"); 
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?php echo $title; ?></title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/bootstrap-datepicker.css" rel="stylesheet">
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
			<li<?php if ($thisPage=="Dashboard") echo " class=\"active\""; ?>>
				<a href="index.php"><span class="glyphicon glyphicon-home"></span> Home </a>
			</li>

			<li<?php if ($thisPage=="Data") echo " class=\"active\""; ?>>
				<a href="data.php" data-toggle="tooltip" data-placement="bottom" title="Lihat Data Mahasiswa"><span class="glyphicon glyphicon-list"></span> Data Mahasiswa </a>
			</li>

			<li<?php if ($thisPage=="Data Dosen") echo " class=\"active\""; ?>>
				<a href="data_dosen.php" data-toggle="tooltip" data-placement="bottom" title="Data Dosen"><span class="glyphicon glyphicon-list"></span> Data Dosen</a>
			</li>

			<li<?php if ($thisPage=="Tambah") echo " class=\"active\""; ?>>
				<a href="tambah.php" data-toggle="tooltip" data-placement="bottom" title="Tambah Data Mahasiswa" ><span class="glyphicon glyphicon-user"></span> Tambah Mahasiswa</a>
			</li>

			<li<?php if ($thisPage=="Tambah Dosen") echo " class=\"active\""; ?>>
				<a href="tambah_dosen.php" data-toggle="tooltip" data-placement="bottom" title="Tambah Dosen" ><span class="glyphicon glyphicon-user"></span> Tambah Dosen</a>
			</li>

			<form name="cari" method="post" action="cari.php" role="search" class="navbar-form navbar-left">
				<div class="form-group">
					<input type="text" name="carinim" placeholder="Cari NIM Mahasiswa" class="form-control">
				</div>
				<button type="submit" name="submit" id="submit" value="search" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Cari Data Mahasiswa">Cari</button>
			</form>
		  </ul>
	      <ul class="nav navbar-nav navbar-right">
	      	<li<?php if ($thisPage=="Profile") echo " class=\"active\""; ?>><a href="profile.php" data-toggle="tooltip" data-placement="bottom" title="Lihat Profile"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
	        <a href="../logout.php" data-toggle="tooltip" data-placement="bottom" title="Logout" class="btn btn-danger navbar-btn" role="button"><span class="glyphicon glyphicon-off"></span> Logout</a>
	      </ul>
		</div>
	  </div>
	</nav>
	