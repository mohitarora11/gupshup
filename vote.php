<?php
	include_once('globalvar.php');
	include ('sql.php'); 
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta property="og:url" content="<?php echo $GLOBALS['url']; ?>vote.php?pk=<?php echo $_SESSION["pk"] ?>" />
<title>Gupshup</title>
<link href="css/american.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="table1"><img src="images/tablefor.png" width="298" height="59" alt=""><span></span></div>

<?php

	/*$_SESSION["voterid"] = '881355547';
	$_SESSION["voteremail"] = 'mohit.11.arora@gmail.com';
	$_SESSION["pk"] = 1;*/
	if($_SERVER["REQUEST_METHOD"] == "POST")
	 {
	    vote($_SESSION["pk"],$_SESSION["voterid"],$_SESSION["voteremail"]);
	}
?>

<div class="champ"><strong class="marbot">Vote</strong>
	<?php
		$q = isvoted($_SESSION["pk"],$_SESSION["voterid"]);		
			if(mysql_num_rows($q)==0){
	?>
	<form method="post">
		<input type = "Submit" value="vote" />
	</form>
	<?php }else{
		echo 'You have already voted for this ';
	}?>	
	
</div>
<div class="bottomborder"></div>
<?php
include_once ('footer.html');
?>
