<?php
include_once('globalvar.php');
include_once('app_config.php');
include_once('sql.php');

include_once ('header.php');
//$_SESSION["userid"] = '111';
if($_SESSION["userid"]){
}else{
	header("Location: ".$GLOBALS['url']."index.php"); /* Redirect browser */
}
?>

<div class="champ"><strong class="marbot">LEADERS</strong>

<span class="spntxt pull-left" style="font-size:18px !important">Entries which are leading the contest</span>
<br/><br/>
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
echo'</u><br><b>';
echo $row['count'];
echo 'Vote(s)</b></li>';
}?>


</ul>
</div>
<div class="cont">

Selfie Leaders

<ul class="leaderboard">
<?php 
	$sql = leaderboard_byselfie();
	//$r = $sql->fetch(PDO::FETCH_ASSOC);
	while ($row = $sql->fetch(PDO::FETCH_ASSOC))
{

//echo '<li><img src="https://graph.facebook.com/'.$row['fbid'].'/picture?type=normal" width="100" height="90"><u>';
echo '<li><img src="resizedimages/'.$row["resizephotourl"].'" width="100" height="90" /><u>';
echo $row['fname'];
echo'</u><br><b>';
echo $row['count'];
echo 'Votes</b></li>';
}?>
</ul>


<a class="link" style="margin-left:250px;margin-top:40px" href="thanku.php">Go Back</a>

</div>
Winners will be declared every Monday!
<div class="fbtwt" style="display:none">
<a href="#"><img src="images/fb.png" width="66" height="24"></a>
<a href="#"><img src="images/tweet.png" width="66" height="24"></a>

</div>

</div>


<div class="bottomborder"></div>
<?php
include ('footer.html');
?>
