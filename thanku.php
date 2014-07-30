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
<meta name="og:image" content="https:<?php echo BASEURL?>images/pastry_.jpg/" />
<script>var SC={DISPLAYNAME:'<?php echo APPNAME;?>',CANVASURL: '<?php echo CANVASURL;?>',APPID:'<?php echo APPID;?>',BASEURL:'<?php echo BASEURL;?>',SCOPE:'<?php echo SCOPE;?>'};</script>
<style type="text/css">
.spntxt {font-size:15px !important}
.table{height:60px}
.bottomborder .spntxt {    
    position: absolute;
    top: -17px;
}
.off{font-size:12px}
</style>
</head>
<body>
<?php 
	$sql = getjodifromfbid($_SESSION['userid']);
	$r = $sql->fetch(PDO::FETCH_ASSOC);
	$pk = $r["id"];
?>
<div id="opaque"></div>
<div id="fb-root"></div>
<?php if(isset($_SESSION["firsttime"]))
{
unset($_SESSION['firsttime']);
?>
<!--
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
	-->
	<?php
	}else {
	?>
<?php } ?>
	<script>
      window.fbAsyncInit = function() {
        FB.init({
			appId      : '<?php echo APPID?>',
			xfbml      : true,
			version    : 'v2.0'
        });
		
		FB.getLoginStatus(function(r){
			if(r.status === 'connected') {
				
			}else {
				FB.login(function(){
					
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
	try{FB.Canvas.scrollTo(0,0);}catch(e){}
		var o = {};
		o.feedObj = {
			message: "I have participated in the American Express 'A Table for You' Contest. Help me win this contest by voting for my entry",
			name: 'A Table For',
			link: SC.CANVASURL+"vote.php?pk="+<?php echo $pk; ?>,
			picture: 'https:'+SC.BASEURL+'images/pastry_.jpg',
			caption: "A Table For CHAMPIONS",		
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
	<!--
<div class="table">
	<img src="images/tablefor.png" width="298" height="59" alt=""><span></span>
</div>
-->
<div class="table" ><span></span></div>	
<div class="champ" >


<?php if ($r["isapproved"]==2){

?>
<span class="spntxt pull-left" style="font-size:30px !important">Thank You<br/>for participating.</span>

<span class="spntxt pull-left" style="margin-top:10px;font-size:18px !important">Your entry had inappropriate content and has been deleted. Please refer to T&Cs for details.

<br/><br/>Participate in the contest next week!
<br/>
</span>

	<?php
		} else if ($r["isapproved"]==0){
	?>

<span class="spntxt pull-left" style="font-size:30px !important">Thank You<br/>for participating.</span>
	
	
	<span class="spntxt pull-left" style="margin-top:15px;">Your entry is in the moderation queue and will take few minutes to get published. </span>
<span class="spntxt pull-left" style="margin-top:10px;margin-bottom:15px">
To win the contest, remember to share your entry with friends as soon as it is up!</span>
<div style="clear:both"></div>
<a class="link" href="leaderboard.php" style="float:none">Click to see what's trending in the contest</a>

	<?php } ?>
	
	<?php
		if ($r["isapproved"]==1){
	?>
	
<span class="spntxt pull-left" style="font-size:30px !important">#ATableFor</span>	
	
	<span class="spntxt pull-left" style="text-transform:uppercase">
	<?php 		
		if($r["opitonchoosen"]==2){
	?>
		<strong><?php echo $r["caption"];?></strong>
		<img src="resizedimages/<?php echo $r['resizephotourl']?>" width="120" height="120" />
		<input  id="id_msg" type="hidden" data-pk="<?php echo $pk; ?>" data-cmt="<?php echo $r["caption"];?>" data-img="resizedimages/<?php echo $r['resizephotourl']?>" value=" I have uploaded a #Selfie at Cyber Hub to participate in the American Express '#ATableFor' Contest. Help me win this contest by voting for my entry"/>
	<?php } else { ?>
		<strong><?php echo $r["cmt"];?></strong>
		<input  id="id_msg" type="hidden" data-pk="<?php echo $pk; ?>" data-cmt="<?php echo $r["cmt"];?>" data-img="images/pastry_.jpg" value="I have submitted the phrase - '#ATableFor <?php echo $r["cmt"];?> ' at Cyber Hub to participate in the American Express '#ATableFor' Contest. Help me win this contest by voting for my submission"/>
		<?php } ?>
	
	</span>	
	<span class="spntxt pull-left" style="margin-top:10px;">
	Great! You entry is now live.<br/> Time to share this with your friends. <br/>
Remember, the more you share, the more your chances to win. 
</span>	
	<span class="spntxt pull-left" style="margin-top:10px">
	<a style="margin-left:55px;background:#073955" class="link cls_share" href="javascript:void(0)" data-prop="fb">Share on Facebook</a>
		<a class="link" style="background:#073955" target="_blank" href="http://twitter.com/intent/tweet?text=Vote for my entry in '%23ATableFor' Contest&amp;url=<?php echo CANVASURL ?>vote.php?pk=<?php echo $pk; ?>">Share on Twitter</a>
		</span>
	
			
		<span class="spntxt pull-left" style="margin-top:10px">
		<a style="background:#073955" class="link" href="leaderboard.php">Check your Votes</a>
	</span>
	<span class="spntxt pull-left" style="margin-top:10px;font-size:15px !important">
	Six American Express Gift Cards to be won every week! 

	</span>
	
	<?php } ?>
	
</div>
<div class="bottomborder">

<span class="spntxt pull-left" >
If you are an American Express Cardmember, do not forget to explore special deals at Cyber Hub, Gurgaon. <br/>
<span class="off" style="display:inline;background:#3e513d"><a href="specialoffer.php">DEALS</a></span>
Yet to have one? <a target="_blank" href="https://www.americanexpress.com/in/content/credit-cards/">Apply for a Card, NOW!</a>

</span>
</div>
<?php /*
<hr/>
<a href="#" onclick="javascript:postToFacebook();">Postwall</a>
<hr/>
<a href="#" onclick="javascript:fbfeed();">feed</a>
*/ ?>
<script type="text/javascript">
//setTimeout(function(){postToFacebook()}, 3000);


</script>
<div id="thanku" title="#ATableFor" style="display:none">Processing...</div>
<?php
include ('footer.html');
?>