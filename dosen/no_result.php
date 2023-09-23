<?php $thisPage="Cari"; ?>
<?php $title = "Data Tidak Ditemukan" ?>
<?php $description = "Cari Data Mahasiswa" ?>
<?php 
include("header.php"); 
include("../koneksi.php"); 
?>
	<div class="container">
		<div class="content">
			<h2>Pencarian Data Mahasiswa</h2>
			<hr />
			
			
			<table class="table table-striped table-condensed">
				<tr>
					<td>Data tidak ditemukan</td>
				</tr>
			</table>
			
			<a href="index.php" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Kembali ke Halaman Depan</a>
		</div> 
	</div> 
<?php 
include("footer.php"); 
?>