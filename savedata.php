<?php

include_once ('globalvar.php');
include('sql.php');

if(!isset($_SESSION["user"])){
    /*$_SESSION["userid"]='12349';
	$_SESSION["useremail"]='mohit123@gmail.com';
	$_SESSION["username"]='mohit';*/
	$_SESSION["pk"] = null;
}

if($_REQUEST['pk']!=null){
		$_SESSION['pk']=$_REQUEST['pk'];
	}
	

if($_SESSION["pk"]!=null){
	header("Location: ".$GLOBALS['url']."vote.php"); /* Redirect browser */
	exit();
} 
else{
	if($_SESSION["userid"]){
		if(!checkifexist($_SESSION["userid"])){
			saveuser($_SESSION["userid"],$_SESSION["useremail"],$_SESSION["username"]);
			savestatus($_SESSION["userid"],0);			
		}
        $q = getstatus($_SESSION["userid"]);
        $r= mysqli_fetch_array($q);
		if($r["status"]==0){		
			header("Location: ".$GLOBALS['url']."champ.php"); /* Redirect browser */
			exit();
		}
		else if($r["status"]==1){
			header("Location: ".$GLOBALS['url']."caption.php"); /* Redirect browser */
			exit();
		}
		else if($r["status"]==2){
			header("Location: ".$GLOBALS['url']."thanku.php"); /* Redirect browser */
			exit();
		}
	}
	else{
		header("Location: ".$GLOBALS['url']."index.php"); /* Redirect browser */
		exit();
	}
}
?>

