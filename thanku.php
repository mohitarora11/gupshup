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

<div class="champ" >
	<div class="card"  >
		<div class="leftcol1">
<?php 
	  $sql = getjodifromfbid($_SESSION['userid']);
	  $r = $sql->fetch(PDO::FETCH_ASSOC);
    ?>	
		
		<p>
				<?php 		
					if($r["opitonchoosen"]==2){
				?>
				<strong><?php echo $r["caption"];?></strong>
				<br/>
				At <?php echo $r["location"]?>
				<?php	}else{ ?>
				<strong><?php echo $r["cmt"];?></strong>
				<?php	} ?>
			</p>
		<br/>
		<?php if($r["opitonchoosen"]==2){ ?>
			<img src="resizedimages/<?php echo $r['photourl']?>" width="250" height="250" />
		<?php }else{ ?>
			<img src="images/pastry.jpg" width="210" height="210"  />
		<?php } ?>
	
	
	
	</div>
	</div>
	<?php
		if ($r["isapproved"]==1){
	?>
	<div class="fbtwt">
	<a href="#"><img src="images/fb.png" width="66" height="24"></a>
	<a href="#"><img src="images/tweet.png" width="66" height="24"></a>
	</div>
	<?php }else{ ?>
	<br>
	We will publish your Caption/Selfie
	after validation. Please come back soon and share your entry with your
	friends for Votes
	<?php } ?>
</div>
<div class="bottomborder"></div>
<?php
include ('footer.html');
?>
