<?php
include ('header.php');
if($_SESSION["userid"]){
}else{
	header("Location: ".$GLOBALS['url']."index.php"); /* Redirect browser */
}
?>

<div class="champ"><strong class="marbot">Thank You</strong>
</div>
<div class="bottomborder"></div>
<?php
include ('footer.html');
?>
