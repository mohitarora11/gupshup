<?php 
if(!isset($_SESSION)){
	session_start();
}
$url_prefix = '/gupshup/';$bpc = '10';
$url="http://localhost/gupshup/";
//$url="//www.digiqom.com/aexp/atableforappflow/";
//$url="http://www.ratulpuri.com/";

if(!isset($_SESSION["login"])){
	$_SESSION["login"]=false;
}


?>
