<?php
	include_once ('header.php');	
	$_SESSION["voterid"] = '881355547';
	$_SESSION["voteremail"] = 'mohit.11.arora@gmail.com';
	$_SESSION["pk"] = 1;
	if($_SERVER["REQUEST_METHOD"] == "POST")
	 {
	    vote($_SESSION["pk"],$_SESSION["voterid"],$_SESSION["voteremail"]);
	}
?>

<div class="champ"><strong class="marbot">Vote</strong>
	<?php
		$q = isvoted($_SESSION["pk"],$_SESSION["voterid"]);		
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
