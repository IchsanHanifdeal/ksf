<?php
if (session_status() == PHP_SESSION_NONE) { 
    session_start(); 
}
if(!isset($_SESSION['dosen'])){ 
	echo '<script language="javascript">document.location="../login_dosen.php";</script>'; 
}
?>