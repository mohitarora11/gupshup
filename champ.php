<?php
session_id($_REQUEST['PHPSESSID']);
include_once('app_config.php');
if(isset($_SESSION) && $_SESSION["userid"]){
	include_once('sql.php');
	if($_SERVER["REQUEST_METHOD"] == "POST"){	  
		if($_POST["optionchosen"]=='1'){
			$id = saveoption($_SESSION["userid"],$_POST["optionchosen"],$_POST["comment"],"");			
			savestatus($_SESSION["userid"],2);	
			header("Location: ".$GLOBALS['url']."thanku.php?PHPSESSID=".session_id()); /* Redirect browser */
		exit();
		}else{
			include_once("imagesave.php");
			header("Location: ".$GLOBALS['url']."caption.php?PHPSESSID=".session_id()); /* Redirect browser */
		    exit();
		}
		
		
	}
}else{
	header("Location: ".$GLOBALS['url']."index.php?PHPSESSID=".session_id()); /* Redirect browser */
	exit();
}
?>
<?php
include_once('header.php');
include_once('templates/champ_html.html');
include_once('footer.html');
?>
