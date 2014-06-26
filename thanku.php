<?php
include_once('globalvar.php');
$_SESSION["userid"] = '11';
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

<body class="bckno">
<div class="table hgt"><span></span></div>

<div class="champ"><strong class="marbot fontst">Thanks for Participating</strong>
<!--<div class="card">
<div class="leftcol"><span><img src="images/table.png" width="180" height="32"></span>
<p><strong>GUPSHUP</strong>
At Soi 7, Cyber Hub
</p>

</div>
<div class="rytimg"><img src="images/img.png" width="342" height="309"></div>
<div class="topbor"><img src="images/bor.png" width="604" height="350"></div>
</div>
-->

<div class="card">
<div class="leftcol1"><span><img width="298" height="59" src="images/tablefor.png"></span>
<p><strong>GUPSHUP</strong>
</p>

</div>

<div class="topbor"><img width="604" height="350" src="images/bor.png"></div>
</div>





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
