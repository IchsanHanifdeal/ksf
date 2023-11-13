<?php
$host = "127.0.0.1"; 
$user = "root"; 
$pass = ""; 
$database = "ksf"; 

$koneksi = mysqli_connect($host, $user, $pass, $database); 

if(mysqli_connect_errno()){ 
	echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error(); 
}
?>