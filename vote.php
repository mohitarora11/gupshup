<?php
if ( isset($_GET['PHPSESSID'])){
	session_id($_GET['PHPSESSID']);
}
include_once('app_config.php');
include_once('sql.php');
include_once('globalvar.php');
require_once( 'Facebook/HttpClients/FacebookHttpable.php' );
require_once( 'Facebook/HttpClients/FacebookCurl.php' );
require_once( 'Facebook/HttpClients/FacebookCurlHttpClient.php' );
 
require_once( 'Facebook/FacebookSession.php' );
require_once( 'Facebook/FacebookCanvasLoginHelper.php' );
require_once( 'Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'Facebook/FacebookRequest.php' );
require_once( 'Facebook/FacebookResponse.php' );
require_once( 'Facebook/FacebookSDKException.php' );
require_once( 'Facebook/FacebookRequestException.php' );
require_once( 'Facebook/FacebookAuthorizationException.php' );
require_once( 'Facebook/GraphObject.php' );

// path of these files have changes
use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurl;
use Facebook\HttpClients\FacebookCurlHttpClient;
 
use Facebook\FacebookSession;
use Facebook\FacebookCanvasLoginHelper;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;


// init app with app id (APPID) and secret (SECRET)
FacebookSession::setDefaultApplication(APPID, APPSECRET);

if(isset($_GET['pk'])){
	$_SESSION['pk']=$_GET['pk'];
}

 
if(isset($_REQUEST['error']) ){

	$helper = new FacebookRedirectLoginHelper(CANVASURL);
	$LOGINURL = $helper->getLoginUrl(explode(',',SCOPE));
	$_SESSION["LOGINURL"]= $LOGINURL;
	include_once('home.php');
	die('');
}

//for canvas
$helper = new FacebookCanvasLoginHelper();
try {
  $session = $helper->getSession();
  //print_r($session); 
} catch (FacebookRequestException $ex) {
	// When Facebook returns an error
	//print_r($ex);
} catch (\Exception $ex) {   
	// When validation fails or other local issues
	//print_r($ex);
}
if ($session){
	try{
		$request = new FacebookRequest( $session, 'GET', '/me' );
		$response = $request->execute();  
		$graphObject = $response->getGraphObject();
		$_SESSION["voterid"]=$graphObject->getProperty('id');
		$_SESSION["voteremail"]=$graphObject->getProperty('email');
		

				
				} catch(FacebookRequestException $e) {
					//echo "Exception occured, code: " . $e->getCode();
					//echo " with message: " . $e->getMessage();
				}
}else{
	$helper = new FacebookRedirectLoginHelper(CANVASURL."vote.php?pk=".$_SESSION['pk']."&PHPSESSID=".session_id());
	$LOGINURL = $helper->getLoginUrl(explode(',',SCOPE));
	$_SESSION["LOGINURL"]= $LOGINURL;
?>
	<script>
		top.window.location.href = '<?php echo $helper->getLoginUrl(explode(',',SCOPE));?>';
	</script>
<?php
	//exit();
}
/*
$_SESSION["voterid"] = '13310';
	$_SESSION["voteremail"] = 'mohit.11.arora@gmail.com';
	$_SESSION["pk"] = 57;
*/
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta property="og:url" content="<?php echo $GLOBALS['url'];?>vote.php?pk=<?php echo $_SESSION['pk'] ?>" />
<title>Gupshup</title>
<link href="https://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css"  rel="stylesheet" type="text/css">
<link href="css/american.css?<?php echo $GLOBALS['bpc'];?>" rel="stylesheet" type="text/css">
<script>var SC={DISPLAYNAME:'<?php echo APPNAME;?>',CANVASURL: '<?php echo CANVASURL;?>',APPID:'<?php echo APPID;?>',BASEURL:'<?php echo BASEURL;?>',SCOPE:'<?php echo SCOPE;?>'};</script>
<style type="text/css">a.link{font-size:13px;padding:4px}</style>
</head>
<body>

<div id="opaque"></div>
<div id="fb-root"></div>


<?php 	  
				$sql = getuserfromid($_SESSION['pk']);	  
				$r = $sql->fetch(PDO::FETCH_ASSOC);
			
	if ($r["isapproved"]==0){
?>

<div class="table">
	<span></span>
</div>
<div class="champ"  >
	<div class="card"  >
		
	<span class="spntxt pull-left" style="margin-top:70px;font-size:17px !important"> The submission is still under validation, Kindly come back to vote later</span>
	
	
	
	</div>
	</div>
<?php } else {

?>
<div class="table">
	<img src="images/tablefor_old.png" alt=""><span></span>
</div>

<?php
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	    if(isset($_POST["userid"])){
			vote($_POST["userid"],$_SESSION["voterid"],$_SESSION["voteremail"]);
		}
	}
?>

<div class="champ" >
	<div class="card"  >
		
					
			<span class="spntxt pull-left">
				<?php 		
					if($r["opitonchoosen"]==2){
				?>
					<strong style="text-transform:uppercase"><?php echo $r["caption"];?></strong>
					
					At <?php echo $r["location"]?>
				<?php }else{ ?>
					<strong style="text-transform:uppercase"><?php echo $r["cmt"];?></strong>
				<?php } ?>
			</span>
			
			
			
			
			<br/>
				<?php if($r["opitonchoosen"]==2){ 
						if ($r["isapproved"]==1)
						{	
				?>
							<img src="resizedimages/<?php echo $r['resizephotourl']?>" width="200" height="200" />
						<?php 
							} 
						?>
				<?php } ?>
			<br/>	
			
			<?php
			
				$q = isvoted($_SESSION["pk"],$_SESSION["voterid"]);		
				if($q->rowCount()==0){
			?>
			<span class="spntxt pull-left">
			
			
			<?php if ($r["fbid"] != $_SESSION["voterid"] ) {?>
			
			
			<?php if ($r["opitonchoosen"]==1) { ?>
			
			Here's what your friend has written<?php } else {?>Here is your friend's selfie<?php } ?>. Like it? <br/>Vote now and help your friend to win!<br/>
			<?php }
			?>
			</span>
			<form method="post" action="vote.php">
					<input type="hidden" name="PHPSESSID" value="<?php echo session_id(); ?>"/>
					<input type="hidden" name="userid" value="<?php echo $_SESSION["pk"]; ?>"/>
					<input type="Submit" value="vote" style="margin-left:335px;margin-top:10px"/>			
				</form>
				
				
				<?php
				} else { ?>
					<span class="spntxt pull-left">Thank you for voting!<br/><br/></span>
					
					<?php if ($r["fbid"] == $_SESSION["voterid"] ) {?>
						<span class="off" style="display:inline;background:#2a5665;font-size:15px;margin-top:7px;padding:5px">
						<a href="leaderboard.php">Check your Votes</a></span>
						
						<?php 
							$sql = getuserfromid($_SESSION["pk"]);
							$q = $sql->fetch(PDO::FETCH_ASSOC);	
							$pk = $_SESSION["pk"];
						?>	


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
						
						<span class="spntxt pull-left" style="text-transform:uppercase">
	<?php 		
		if($q["opitonchoosen"]==2){
	?>
		
		<input  id="id_msg" type="hidden" data-pk="<?php echo $pk; ?>" data-cmt="<?php echo $r["caption"];?>" data-img="resizedimages/<?php echo $r['resizephotourl']?>" value=" I have uploaded a #Selfie at Cyber Hub to participate in the American Express '#ATableFor' Contest. Help me win this contest by voting for my entry"/>
	<?php } else { ?>
		
		<input  id="id_msg" type="hidden" data-pk="<?php echo $pk; ?>" data-cmt="<?php echo $r["cmt"];?>" data-img="images/pastry_.jpg" value="I have submitted the phrase - '#ATableFor <?php echo $r["cmt"];?> ' at Cyber Hub to participate in the American Express '#ATableFor' Contest. Help me win this contest by voting for my submission"/>
		<?php } ?>
	
	</span>	
	<span class="spntxt pull-left" style="margin-top:10px;">
	Don't forget to share it with your friends. <br/>
Remember, the more you share, the more your chances to win. 
</span>	
	
	<span class="spntxt pull-left" style="margin-top:7px">
	<a style="margin-left:55px;background:#073955" class="link cls_share" href="javascript:void(0)" data-prop="fb">Share on Facebook</a>
		<a class="link" style="background:#073955" target="_blank" href="http://twitter.com/intent/tweet?text=Vote for my entry in '%23ATableFor' Contest&amp;url=<?php echo CANVASURL ?>vote.php?pk=<?php echo $pk; ?>">Share on Twitter</a>
		</span>
	
						
						
						<?php } else { ?>
						<span class="spntxt pull-left">
						Now its your turn to win vouchers from <br/>American Express&reg;.<br/><br/>
							
							Come, participate in the contest and, get lucky!<br/><br/> 
							</span>
							<span class="off" style="display:inline;background:#2a5665;font-size:15px;margin-top:7px;padding:7px">
						<a href="index.php">Enter Contest</a>
						</span>	



						
						<?php } ?>
					
				
				<?php } ?>

					
	</div>
</div>


<?php } ?>	

<div class="bottomborder">

<span class="spntxt pull-left">Want these offers, but don't have an
American Express&reg; Card?. 
		<span class="off" style="display:inline;background:#3e513d"><a href="specialoffer.php">DEALS</a></span>
If not, <a target="_blank" href="https://www.americanexpress.com/in/content/credit-cards/">apply for a Card, NOW!</a> 
</span>

</div>
<div id="thanku" title="#ATableFor" style="display:none">Processing...</div>
<?php
	include_once ('footer.html');
?>