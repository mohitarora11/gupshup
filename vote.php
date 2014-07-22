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
//		top.window.location.href = '<?php echo $helper->getLoginUrl(explode(',',SCOPE));?>';
	</script>
<?php
	//exit();
}

$_SESSION["voterid"] = '81355519';
	$_SESSION["voteremail"] = 'mohit.11.arora@gmail.com';
	$_SESSION["pk"] = 47;
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta property="og:url" content="<?php echo $GLOBALS['url'];?>vote.php?pk=<?php echo $_SESSION['pk'] ?>" />
<title>Gupshup</title>
<link href="https://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css"  rel="stylesheet" type="text/css">
<link href="css/american.css?<?php echo $GLOBALS['bpc'];?>" rel="stylesheet" type="text/css">
</head>
<body>
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
	<img src="images/tablefor.png" alt=""><span></span>
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
		
					
			<p>
				<?php 		
					if($r["opitonchoosen"]==2){
				?>
					<strong><?php echo $r["caption"];?></strong>
					<br/>
					At <?php echo $r["location"]?>
				<?php }else{ ?>
					<strong><?php echo $r["cmt"];?></strong>
				<?php } ?>
			</p>
			
			
			
			
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
			<span class="spntxt pull-left"><?php if ($r["opitonchoosen"]==1) { ?>Here's what your friend has written<?php } else {?>Here is your friend's selfie<?php } ?>. Like it? <br/>Vote now and help your friend to win!<br/></span>
				<form method="post" action="vote.php">
					<input type="hidden" name="PHPSESSID" value="<?php echo session_id(); ?>"/>
					<input type="hidden" name="userid" value="<?php echo $_SESSION["pk"]; ?>"/>
					<input type="Submit" value="vote" style="margin-left:375px;margin-top:10px"/>			
				</form>
				
				
				<?php
				} else { ?>
					<span class="spntxt pull-left">Thank you for voting!<br/>
					
							Now its your turn to win vouchers from <br/>American Express&reg;.<br/><br/>
							
							Come, participate in the contest and, get lucky!<br/><br/> 
							</span>
					
					<span class="off" style="display:inline;background:#2a5665;font-size:15px;margin-top:10px;padding:10px">
						<a href="index.php">Enter Contest</a>
					</span>		
				
				<?php } ?>

					
	</div>
</div>


<?php } ?>	

<div class="bottomborder">

<span class="spntxt pull-left">If you are an American Express Cardmember, do not forget to explore special deals at Cyber Hub, Gurgaon. 
		<span class="off" style="display:inline;background:#3e513d"><a href="specialoffer.php">DEALS</a></span><br/>
If not, <a target="_blank" href="https://www.americanexpress.com/in/content/credit-cards/">apply for a Card, NOW!</a> 
</span>

</div>
<?php
	include_once ('footer.html');
?>