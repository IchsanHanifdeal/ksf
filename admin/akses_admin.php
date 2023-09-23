<?php
if (session_status() == PHP_SESSION_NONE) { 
    session_start(); 
}
if(!isset($_SESSION['admin'])){ 
	echo '<script language="javascript">document.location="../login.php";</script>'; 
}
?>