<?php
if (session_status() == PHP_SESSION_NONE) { 
    session_start(); 
}
if(isset($_SESSION['admin'])){ 
	echo '<script language="javascript">document.location="admin/index.php";</script>'; 
}
elseif(isset($_SESSION['user'])){ 
	echo '<script language="javascript">document.location="user/index.php";</script>'; 
}
?>