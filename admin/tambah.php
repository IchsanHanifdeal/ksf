<?php $thisPage = "Tambah"; ?>
<?php $title = "Tambah Data Mahasiswa" ?>
<?php $description = "Tambah Data Mahasiswa" ?>
<?php
include("header.php");
include("../koneksi.php");
?>
<div class="container">
  <div class="content">
    <h2>Data mahasiswa &raquo; Tambah Data</h2>
    <hr />

    <?php
    if (isset($_POST['add'])) {
      $nim             = $_POST['nim'];
      $nama            = $_POST['nama'];
      $jenis_kelamin   = $_POST['jenis_kelamin'];
      $tempat_lahir    = $_POST['tempat_lahir'];
      $tanggal_lahir   = $_POST['tanggal_lahir'];
      $alamat_asal     = $_POST['alamat_asal'];
      $alamat_sekarang = $_POST['alamat_sekarang'];
      $no_telepon      = $_POST['no_telepon'];
      $email           = $_POST['email'];
      $agama           = $_POST['agama'];
      $jurusan         = $_POST['jurusan'];
      $username        = $_POST['username'];
      $level           = $_POST['level'];
      $pass1           = $_POST['pass1'];
      $pass2           = $_POST['pass2'];

      $cek = mysqli_query($koneksi, "SELECT * FROM tbl_mahasiswa WHERE nim='$nim'");
      if (mysqli_num_rows($cek) == 0) {
        if ($pass1 == $pass2) {
          $pass = md5($pass1);
          $insert = mysqli_query($koneksi, "INSERT INTO tbl_mahasiswa(nim, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat_asal, alamat_sekarang, no_telepon, email, agama, jurusan, username, level, password) VALUES('$nim','$nama', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$alamat_asal', '$alamat_sekarang', '$no_telepon', '$email', '$agama', '$jurusan', '$username', '$level', '$pass')") or die(mysqli_error());
          if ($insert) {
            echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Mahasiswa Berhasil Di Simpan. <a href="data.php"><- Kembali</a></div>';
          } else {
            echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data Mahasiswa Gagal Di simpan! <a href="data.php"><- Kembali</a></div>';
          }
        } else {
          echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password Tidak sama!</div>';
        }
      } else {
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>NIM Sudah Ada..! <a href="data.php"><- Kembali</a></div>';
      }
    }
    ?>

    <form class="form-horizontal" action="" method="post">
      <div class="form-group">
        <label class="col-sm-3 control-label">NIM</label>
        <div class="col-sm-2">
          <input type="text" name="nim" class="form-control" placeholder="nim" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Nama</label>
        <div class="col-sm-4">
          <input type="text" name="nama" class="form-control" placeholder="Nama" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Jenis Kelamin</label>
        <div class="col-sm-2">
          <select name="jenis_kelamin" class="form-control" required>
            <option value=""> - Pilih - </option>
            <option value="Laki-Laki">Laki-Laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Tempat Lahir</label>
        <div class="col-sm-4">
          <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Tanggal Lahir</label>
        <div class="col-sm-3">
          <input type="text" name="tanggal_lahir" class="input-group datepicker form-control" date="" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Alamat Asal</label>
        <div class="col-sm-3">
          <textarea name="alamat_asal" class="form-control" placeholder="Alamat Asal"></textarea>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Alamat Sekarang</label>
        <div class="col-sm-3">
          <textarea name="alamat_sekarang" class="form-control" placeholder="Alamat Sekarang"></textarea>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">No Telepon</label>
        <div class="col-sm-3">
          <input type="text" name="no_telepon" class="form-control" placeholder="No Telepon" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Email</label>
        <div class="col-sm-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Agama</label>
        <div class="col-sm-4">
          <input type="text" name="agama" class="form-control" placeholder="Agama" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Jurusan</label>
        <div class="col-sm-2">
          <select name="jurusan" class="form-control" required>
            <option value=""> - Pilih - </option>
            <option value="Manajemen Informatika">Manajemen Informatika</option>
            <option value="Akuntansi Syariah">Akuntansi Syariah</option>
            <option value="Perbankan Syariah">Perbankan Syariah</option>
            <option value="Manajemen Bisnis Syariah">Manajemen Bisnis Syariah</option>
            <option value="Ekonomi Syariah">Ekonomi Syariah</option>
            <option value="Manajemen Zakat & Wakaf">Manajemen Zakat & Wakaf</option>
            <option value="Pariwisata Syariah">Pariwisata Syariah</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Username</label>
        <div class="col-sm-2">
          <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Level</label>
        <div class="col-sm-2">
          <select name="level" class="form-control" required>
            <option value=""> - Pilih - </option>
            <option value="admin">Admin</option>
            <option value="user">User</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Password</label>
        <div class="col-sm-2">
          <input type="password" name="pass1" class="form-control" placeholder="Password" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Ulangi Password</label>
        <div class="col-sm-2">
          <input type="password" name="pass2" class="form-control" placeholder="Ulangi Password" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">&nbsp;</label>
        <div class="col-sm-6">
          <input type="submit" name="add" class="btn btn-sm btn-primary" value="Simpan" data-toggle="tooltip" title="Simpan Data mahasiswa">
          <a href="index.php" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Batal">Batal</a>
        </div>
      </div>
    </form> 
  </div> 
</div> 
<?php 
include("footer.php"); 
?>
