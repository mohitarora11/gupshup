<?php
include_once('globalvar.php');
include_once('sql.php');
/*$_SESSION["userid"] = '11';*/
if(!isset($_SESSION["userid"])){

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
	<?php
	
		$q = getjodifromfbid($_SESSION['userid']);
		$r = $q->fetch(PDO::FETCH_ASSOC);		
		if($r["opitonchoosen"]==2){
	?>		
	<div class="card">
	<div class="leftcol"><span></span>
	<p><strong><?php echo $r["caption"] ?></strong>
		At <?php echo $r["location"]?>
   </p>

</div>
<div class="rytimg"><img src="resizedimages/<?php echo $r['resizephotourl']?>" width="210" height="210"></div>

</div>
<?php } else{?>

<div class="card" style="height:200px">
<div class="leftcol1">
<p><strong><?php echo $r["cmt"] ?></strong>
</p>
</div>
</div>
<?php } ?>
<strong class="marbot fontst">Thanks for Participating</strong>


<div class="fbtwt">
<a href="#"><img src="images/fb.png" width="66" height="24"></a>
<a href="#"><img src="images/tweet.png" width="66" height="24"></a>

</div>
<br>
We will publish your Caption/Selfie
after validation. Please come back soon and share your entry with your
friends for Votes
</div>
<div class="bottomborder"></div>
<?php
include ('footer.html');
?>
