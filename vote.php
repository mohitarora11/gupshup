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
?>
	<script>
		top.window.location.href = '<?php echo $helper->getLoginUrl(explode(',',SCOPE));?>';
	</script>
<?php
	//exit();
}
/*$_SESSION["voterid"] = '81355519';
	$_SESSION["voteremail"] = 'mohit.11.arora@gmail.com';
	$_SESSION["pk"] = 18;*/
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
<div class="table">
	<img src="images/tablefor.png" width="298" height="59" alt=""><span></span>
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
		<div class="leftcol1">
			<?php 	  
				$sql = getuserfromid($_SESSION['pk']);	  
				$r = $sql->fetch(PDO::FETCH_ASSOC);
			?>			
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
							<img src="resizedimages/<?php echo $r['photourl']?>" width="250" height="250" />
						<?php 
							} 
						?>
				<?php } ?>
			<br/><br/>
			<?php
			if ($r["isapproved"]==1){	
				$q = isvoted($_SESSION["pk"],$_SESSION["voterid"]);		
				if($q->rowCount()==0){
			?>
				<form method="post" action="vote.php">
					<input type="hidden" name="PHPSESSID" value="<?php echo session_id(); ?>"/>
					<input type="hidden" name="userid" value="<?php echo $_SESSION["pk"]; ?>"/>
					<input type="Submit" value="vote"/>			
				</form>
				<?php
				} else {
					echo '<br/><br/><p>Thank You for voting.</p>';
				}
					//unset($_SESSION['pk']);
					/*}else if(isset($_POST["userid"])){
						echo '<br/><br/><p>Thank You for voting.</p>';
						//unset($_SESSION['voted']);
					}else{
						echo '<br/><br/><p>You have already voted for this</p> ';
					}*/
				?>	
			<?php } else {
				echo '<p> The submission is still under validation, Kindly come back to vote later</p>';
				}
			?>
			
		</div>
	</div>
</div>
<div class="bottomborder"></div>
<?php
	include_once ('footer.html');
?>