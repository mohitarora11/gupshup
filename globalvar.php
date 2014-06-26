<?php 
if(!isset($_SESSION)){
if ( isset($_GET['PHPSESSID'])){
	session_id($_GET['PHPSESSID']);
}
	session_start();
}
//
$url_prefix = '/gupshup/';$bpc = '14';
//$url="http://localhost/gupshup/";
$url="//www.digiqom.com/aexp/atableforappflow/";
//$url="http://www.ratulpuri.com/";

if(!isset($_SESSION["login"])){
	$_SESSION["login"]=false;
}


?>