<?php
include_once('globalvar.php');
include_once('sql.php');
if(isset($_SESSION) && $_SESSION["userid"]){
	if($_SERVER["REQUEST_METHOD"] == "POST"){	  
		if($_POST["optionchosen"]=='1' && trim($_POST["optionchosen"])!=''){			
			$id = saveoption($_SESSION["userid"],$_POST["optionchosen"],$_POST["comment"],"");			
			savestatus($_SESSION["userid"],2);	
			$_SESSION["firsttime"] = true;
			header("Location: ".$GLOBALS['url']."thanku.php?PHPSESSID=".session_id()); /* Redirect browser */
			exit();
		}else if($_POST["optionchosen"]=='2'){
			include_once("imagesave.php");
			header("Location: ".$GLOBALS['url']."caption.php?PHPSESSID=".session_id()); /* Redirect browser */
		    exit();
		}
		else{
			header("Location: ".$GLOBALS['url']."index.php?PHPSESSID=".session_id()); /* Redirect browser */
			exit();
		}
	}
	else{
		returnuser($_SESSION["userid"]);
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