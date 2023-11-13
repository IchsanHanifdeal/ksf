<?php $thisPage = "Login"; ?>
<?php $title = "Login - Data Mahasiswa" ?>
<?php $description = "Login - Data Mahasiswa" ?>
<?php
include("akses.php");
include("header.php");
require("koneksi.php");
?>

<div class="container">
	<div class="content login">
		<form class="form-signin" action="" method="post">
			<center><img src="logo/uin.png" height="300" width="300" class="img-responsive" /><br /></center>
			<h2 class="form-signin-heading">
				<center>Silahkan Login</center>
			</h2><br />
			<label for="username" class="sr-only">Username</label>
			<input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
			<label for="password" class="sr-only">Password</label>
			<input type="password" name="password" class="form-control" placeholder="Password" required>
			<div class="checkbox">
				<label>

				</label>
			</div>
			<button class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="Login">Login</button>
			<a href="login_dosen.php" class="btn btn-lg btn-success btn-block">Login Sebagai Dosen</a>
		</form>
	</div>


</div>

<?php
if (isset($_POST['login'])) {
	$user = mysqli_real_escape_string($koneksi, $_POST['username']);
	$pass = mysqli_real_escape_string($koneksi, $_POST['password']);

	$hashed_pass = md5($pass);

	$stmt = $koneksi->prepare("SELECT * FROM tbl_mahasiswa WHERE username=? AND password=?");
	$stmt->bind_param("ss", $user, $hashed_pass);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows == 0) {
		echo '<center><span class="label label-danger">User tidak ditemukan</span></center>';
	} else {
		$row = $result->fetch_assoc();
		if ($row['level'] == 'admin') {
			$_SESSION['admin'] = $user;
			$_SESSION['level'] = 'admin';
			header("Location: admin/index.php");
			exit();
		} elseif ($row['level'] == 'user') {
			$_SESSION['user'] = $user;
			$_SESSION['level'] = 'user';
			header("Location: user/index.php");
			exit();
		} else {
			echo '<center><div class="alert alert-danger">Upss...!!! Login gagal.</div></center>';
		}
	}

	$stmt->close();
	$koneksi->close();
}
?>

<?php
include("footer.php");
?>