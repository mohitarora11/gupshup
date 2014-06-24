<?php
include_once ('globalvar.php');
include('sql.php');

if(!isset($_SESSION["user"])){
	$_SESSION["userid"]='1234';
	$_SESSION["useremail"]='pooja@gmail.com';
	$_SESSION["username"]='pooja';
	
}

if(!checkifexist($_SESSION["userid"])){

	saveuser($_SESSION["userid"],$_SESSION["useremail"],$_SESSION["username"]);
}
header("Location: ".$GLOBALS['url']."champ.php"); /* Redirect browser */
exit();
?>

