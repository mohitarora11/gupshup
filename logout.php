<?php 
include_once('globalvar.php'); 
  
	if(isset($_SESSION["login"])){
		$_SESSION["login"] = false;
		header("Location:".$GLOBALS['url']."login.php");
		exit();
    }
?>