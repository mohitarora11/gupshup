<?php session_start();
$url_prefix = '/gupshup/';$bpc = '8';
$url="http://localhost/gupshup/";
//$url="http://www.ratulpuri.com/";

if(!isset($_SESSION["login"])){
	$_SESSION["login"]=false;
}


?>
