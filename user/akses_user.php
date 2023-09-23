<?php
if (session_status() == PHP_SESSION_NONE) { 
    session_start(); 
}
if(!isset($_SESSION['user'])){ 
	echo '<script language="javascript">document.location="../login.php";</script>'; 
}
?>