<?php
include_once('globalvar.php');
include_once('app_config.php');
include_once('sql.php');

//$_SESSION["userid"] = '12310';
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
<meta name="og:title" content="I have participated in the American Express 'A Table for You' contest. Vote for me and make me win!" />
<meta name="og:description" content="A Table For' is a unique contest by American Express. Check out your friend's entry, vote for it, and make it win" />
<meta name="og:image" content="https:<?php echo BASEURL?>images/pastry.jpg/" />
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
unset($_SESSION['firsttime']);
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
	
	<?php
	}
	?>
	<script>
	function fbfeed(o,cb){
	try{FB.Canvas.scrollTo(0,0);}catch(e){}
		var o = {};
		o.feedObj = {
			message: "I have participated in the American Express 'A Table for You' Contest. Help me win this contest by voting for my entry",
			name: 'A table for',
			link: SC.CANVASURL+"vote.php?pk="+<?php echo $pk; ?>,
			picture: 'https:'+SC.BASEURL+'images/pastry.jpg',
			caption: "A table for CHAMPIONS",		
			description: "'A Table For' is a unique contest by American Express. Check out your friend's entry, vote for it, and make it win"
		};
		o.path = '/me/feed/';
		FB.api(o.path,'POST',o.feedObj,function(r){
			try{
				//console.log(arguments);
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
<div class="table">
	<img src="images/tablefor.png" width="298" height="59" alt=""><span></span>
</div>

<div class="champ">
	<div class="card">
		<div class="leftcol1">
		
		<p>
				<?php 		
					if($r["opitonchoosen"]==2){
				?><br/><br/>
				<strong><?php echo $r["caption"];?></strong>
				<br/>
				At <?php echo $r["location"]?>
				<?php	}else{ ?><br/><br/><br/><br/><br/><br/><br/>
				<strong style="font-size:80px"><?php echo $r["cmt"];?></strong>
				<input  id="id_msg" type="hidden" data-pk="<?php echo $pk; ?>" data-img="images/pastry.jpg" value="I have uploaded a #Caption - 'A Table for <?php echo $r["cmt"];?> ' at Cyber Hub to
															participate in the American Express 'A Table for You' Contest. Help me win this contest by voting for my entry"/>
				<?php	} ?>
			</p>
		<br/>
		<?php if($r["opitonchoosen"]==2){ ?>
			<img src="resizedimages/<?php echo $r['photourl']?>" width="250" height="250" />
			<input  id="id_msg" type="hidden" data-pk="<?php echo $pk; ?>" data-img="resizedimages/<?php echo $r['photourl']?>" value=" I have uploaded a #Selfie at Cyber Hub to participate in the American Express 'A Table for You' Contest. Help me win this contest by voting for my entry"/>
		<?php } ?>
		
			<!--<img src="images/pastry.jpg" width="210" height="210"  />-->
		
		</div>
		<div class="leftcol1" style="margin:20px 0px 60px 0;padding-left:140px">
		<a class="link" href="leaderboard.php">LeaderBoard</a>
		<a style="width:148px" class="link" href="specialoffer.php">Offers</a>
	
	</div>
	
	<?php
		if ($r["isapproved"]==1){
	?>
	<div class="leftcol1" style="margin:20px 0px 60px 0">
	
<p>Get maximum votes and WIN</p>
<br/>
	<a class="link cls_share" href="javascript:void(0)" data-prop="fb">Share on Facebook</a>
		<a class="link" target="_blank" href="http://twitter.com/intent/tweet?text=Vote-for-me-and-make-me-win&amp;url=<?php echo CANVASURL ?>vote.php?pk=<?php echo $pk; ?>">Share on Twitter</a>
	
	</div>
	
	<?php }else{ ?>
	<br><br>
		<div class="leftcol1">
	We will publish your <?php if($r["opitonchoosen"]==2){ ?> Selfie <?php } else { ?> Caption <?php } ?>
	after validation. Please come back soon and share your entry with your
	friends for Votes
		</div>
		
	<?php } ?>
	</div>
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