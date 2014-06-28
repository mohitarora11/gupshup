<?php
include_once('globalvar.php');
include_once('app_config.php');
include_once('sql.php');

//$_SESSION["userid"] = '11';
if(!isset($_SESSION["userid"])){
	header("Location: ".$GLOBALS['url']."index.php"); /* Redirect browser */
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Thanks</title>
<link href="https://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css"  rel="stylesheet" type="text/css">
<link href="css/american.css?<?php echo $GLOBALS['bpc'];?>" rel="stylesheet" type="text/css">
<script>var SC={DISPLAYNAME:'<?php echo APPNAME;?>',CANVASURL: '<?php echo CANVASURL;?>',APPID:'<?php echo APPID;?>',BASEURL:'<?php echo BASEURL;?>',SCOPE:'<?php echo SCOPE;?>'};</script>
</head>
<body>
<?php 
	$sql = getjodifromfbid($_SESSION['userid']);
	$r = $sql->fetch(PDO::FETCH_ASSOC);
	$pk = $r["id"];
?>
<?php if(isset($_SESSION["firsttime"]))
{
?>
<div id="fb-root"></div>
<script>
      window.fbAsyncInit = function() {
        FB.init({
			appId      : '<?php echo APPID?>',
			xfbml      : true,
			version    : 'v2.0'
        });
		
		FB.getLoginStatus(function(r){
			if(r.status === 'connected') {
				fbfeed();
			}else {
				FB.login(function(){
					fbfeed();
				},{scope: SC.SCOPE});
			}
		});
    };
	
	(function() {
		var e = document.createElement('script');
		e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
		e.async = true;
		document.getElementById('fb-root').appendChild(e);
	}());
    </script>
	<script>
	function fbfeed(o,cb){
		var o = {};
		o.feedObj = {
			message: "Participate in the 'American Express A Table for You' contest and gets a chance to win",
			name: 'A table for',
			link: SC.CANVASURL+"vote.php?pk="+<?php echo $pk; ?>,
			picture: 'https:'+SC.BASEURL+'images/pastry.jpg',
			caption: "A table for",		
			description: "The contest encourages users to complete the caption ' A Table For ___' or click and upload photos on Facebook while dining at Cyber Hub, submit selected photos or captions through the contest application, share it on their own facebook timeline and get votes from friends"
		};
		o.path = '/me/feed/';
		FB.api(o.path,'POST',o.feedObj,function(r){
			try{
				console.log(arguments);
			}catch(ee){
				
			}
			if(r != void 0){
				//debug('fbShare'+ o.path , r);
				//cb(r);
			}else{
				//debug(arguments);
			}
		});	
	}	
    </script>
	<?php
	}
	?>
<div class="table">
	<img src="images/tablefor.png" width="298" height="59" alt=""><span></span>
</div>

<div class="champ">
	<div class="card">
		<div class="leftcol1">
		
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
<?php /*
<hr/>
<a href="#" onclick="javascript:postToFacebook();">Postwall</a>
<hr/>
<a href="#" onclick="javascript:fbfeed();">feed</a>
*/ ?>
<script type="text/javascript">
//setTimeout(function(){postToFacebook()}, 3000);

</script>

<?php
include ('footer.html');
?>