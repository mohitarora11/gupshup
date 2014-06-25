<?php
include_once('globalvar.php');
$_SESSION["userid"] = '111';
if($_SESSION["userid"]){
}else{
	header("Location: ".$GLOBALS['url']."index.php"); /* Redirect browser */
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Thanks</title>
<link href="css/american.css?<?php echo $GLOBALS['bpc'];?>" rel="stylesheet" type="text/css">
</head>

<body>
<div class="table">
	<img src="images/tablefor.png" width="298" height="59" alt=""><span></span>
</div>

<div class="champ">

<div class="card">
<div class="leftcol"><span></span>
<p><strong>GUPSHUP</strong>
At Soi 7, Cyber Hub
</p>

</div>
<div class="rytimg"><img src="images/img.png" width="342" height="309"></div>

</div>

<!--
<div class="card" style="height:200px">
<div class="leftcol1">
<p><strong>GUPSHUP</strong>
</p>
</div>
</div>
-->
<strong class="marbot fontst">Thanks for Participating</strong>


<div class="fbtwt">
<a href="#"><img src="images/fb.png" width="66" height="24"></a>
<a href="#"><img src="images/tweet.png" width="66" height="24"></a>

</div>
<br>
Your picture will be posted to your timeline after validation.  
Share your picture to get maximum votes
</div>

<?php
include ('footer.html');
?>
