<?php
include ('header.php');
if($_SESSION["userid"]){
}else{
	header("Location: ".$GLOBALS['url']."index.php"); /* Redirect browser */
}
?>


<div class="champ"><strong class="marbot">WINNERS</strong>
<div class="cont">
Caption Leaders

<ul class="leaderboard">
<a href="#">
<li>
<img src="images/img1.png" width="100" height="90">
<u>User 2</u><br>
<b>80 Votes</b>
</li>
</a>

<a href="#">
<li>
<img src="images/img1.png" width="100" height="90">
<u>User 2</u><br>
<b>80 Votes</b>
</li>
</a>


<a href="#">
<li>
<img src="images/img1.png" width="100" height="90">
<u>User 2</u><br>
<b>80 Votes</b>
</li>
</a>


<a href="#">
<li>
<img src="images/img1.png" width="100" height="90">
<u>User 2</u><br>
<b>80 Votes</b>
</li>
</a>


</ul>
</div>
<div class="cont">

Selfie Leaders

<ul class="leaderboard">
<a href="#">
<li>
<img src="images/img1.png" width="100" height="90">
<u>User 2</u><br>
<b>80 Votes</b>
</li>
</a>

<a href="#">
<li>
<img src="images/img1.png" width="100" height="90">
<u>User 2</u><br>
<b>80 Votes</b>
</li>
</a>


<a href="#">
<li>
<img src="images/img1.png" width="100" height="90">
<u>User 2</u><br>
<b>80 Votes</b>
</li>
</a>


<a href="#">
<li>
<img src="images/img1.png" width="100" height="90">
<u>User 2</u><br>
<b>80 Votes</b>
</li>
</a>


</ul>

</div>
Winners will be declared every monday!
<div class="fbtwt">
<a href="#"><img src="images/fb.png" width="66" height="24"></a>
<a href="#"><img src="images/tweet.png" width="66" height="24"></a>

</div>

</div>


<div class="bottomborder"></div>
<?php
include ('footer.html');
?>

