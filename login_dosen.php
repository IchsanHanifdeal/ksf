<?php $thisPage="Login"; ?>
<?php $title = "Login - Dosen" ?>
<?php 
include("akses_dosen.php");
include("header.php"); 
require("koneksi.php"); 
?>
	
	<div class="container">
		<div class="content login">
			<form class="form-signin" action="" method="post">
				<center><img src="logo/uin.png" height="300" width="300" class="img-responsive"/><br /></center>
				<h2 class="form-signin-heading"><center>Silahkan Login</center></h2><br />
				<label for="username" class="sr-only">Username</label>
				<input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
				<label for="password" class="sr-only">Password</label>
				<input type="password" name="password" class="form-control" placeholder="Password" required>
				<div class="checkbox">
				  <label>
					
				  </label>
				</div>
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="Login">Login</button>
			</form>
		</div> 
	</div>
	

	<?php
	if(isset($_POST['login'])){
		$user = mysqli_real_escape_string($koneksi, htmlentities($_POST['username']));
		$pass = mysqli_real_escape_string($koneksi, htmlentities(md5($_POST['password'])));

		$sql = mysqli_query($koneksi, "SELECT * FROM dosen WHERE username='$user' AND password='$pass'") or die(mysqli_error($koneksi));
		if(mysqli_num_rows($sql) == 0){
			echo '<center><span class="label label-danger">User tidak ditemukan</span></center>';
		}else{
			
			$sql = mysqli_query($koneksi, "SELECT * FROM dosen WHERE username='$user'") or die(mysqli_error($koneksi));
			$row2 = mysqli_fetch_assoc($sql);
			if($row2['level'] == 'dosen'){
				$_SESSION['dosen']=$user;
				$_SESSION['level']='dosen';
				$_SESSION['id_dosen'] = $row2['id_dosen'];
				echo '<script language="javascript">document.location="dosen/index.php";</script>';
			}else{
				echo '<center><div class="alert alert-danger">Upss...!!! Login gagal.</div></center>';
			}
		}
	}
	?>

<?php 
include("footer.php"); 
?>