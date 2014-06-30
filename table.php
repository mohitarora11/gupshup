<?php
include_once('globalvar.php');

if($_SESSION["login"] == true){
	
	include_once('table.html');
}
else{
	header("Location: ".$GLOBALS['url']."login.php"); /* Redirect browser */
	exit();
}


?>