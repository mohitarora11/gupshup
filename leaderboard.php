
<?php

include_once('globalvar.php');
include_once('app_config.php');

include_once('sql.php');
include_once ('header.php');
//$_SESSION["userid"] = '111';
//if($_SESSION["userid"]){

?>

<div class="champ"><strong class="marbot" style="margin-bottom:2px">LEADERS</strong>

<span class="spntxt pull-left">Entries which are leading the contest</span>
<br/>
<div class="cont">
Caption Leaders

<ul class="leaderboard">
<?php 
	$sql = leaderboard_bycaption();
	//$r = $sql->fetch(PDO::FETCH_ASSOC);
	while ($row = $sql->fetch(PDO::FETCH_ASSOC))
{

//echo '<li><img src="https://graph.facebook.com/'.$row['fbid'].'/picture?type=normal" width="100" height="90"><u>';
echo '<li><tbr>Atable<br/>For<br/>'.$row['cmt'].'</tbr>';
echo $row['fname'];
echo'</u><b>';
echo $row['count'];
echo ' Vote(s)</b></li>';
}?>


</ul>
</div>
<div class="cont" style="margin-bottom:8px">
Selfie Leaders
<ul class="leaderboard">
<?php 
	$sql = leaderboard_byselfie();
	//$r = $sql->fetch(PDO::FETCH_ASSOC);
	while ($row = $sql->fetch(PDO::FETCH_ASSOC))
{

//echo '<li><img src="https://graph.facebook.com/'.$row['fbid'].'/picture?type=normal" width="100" height="90"><u>';
echo '<li><img src="resizedimages/'.$row["resizephotourl"].'" width="100" height="100" /><u>';
echo $row['fname'];
echo'</u><b>';
echo $row['count'];
echo ' Vote(s)</b></li>';
}?>
</ul>

<div style="clear:both;height:7px"></div>
<a class="link"  href="thanku.php">Go Back</a>

</div>
Winners will be declared every Friday!
<div class="fbtwt" style="display:none">
<a href="#"><img src="images/fb.png" width="66" height="24"></a>
<a href="#"><img src="images/tweet.png" width="66" height="24"></a>

</div>

</div>


<div class="bottomborder"></div>
<?php
	include ('footer.html');
/*}
else{
	header("Location: ".$GLOBALS['url']."index.php"); /* Redirect browser */
}*/
?>


