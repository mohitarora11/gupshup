<?php
if ( isset($_GET['PHPSESSID'])){
	session_id($_GET['PHPSESSID']);
}
include_once('app_config.php');
include_once('sql.php');
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
//$_SESSION["voterid"] = '1444';
 
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
	$request = new FacebookRequest( $session, 'GET', '/me' );
	$response = $request->execute();  
	$graphObject = $response->getGraphObject();	
}else{
	$helper = new FacebookRedirectLoginHelper(CANVASURL."vote.php?pk=".$_SESSION['pk']."&PHPSESSID=".session_id());
	$LOGINURL = $helper->getLoginUrl(explode(',',SCOPE));
?>
	<script>
		top.window.location.href = '<?php echo $helper->getLoginUrl(explode(',',SCOPE));?>';
	</script>
<?php
	exit();
}
?>
 <!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta property="og:url" content="<?php echo $GLOBALS['url']; ?>vote.php?pk=<?php echo $_SESSION["pk"] ?>" />
<title>Gupshup</title>
<link href="css/american.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="table"><span></span></div>
<?php
	/*$_SESSION["voterid"] = '81355519';
	$_SESSION["voteremail"] = 'mohit.11.arora@gmail.com';
	$_SESSION["pk"] = 13;*/
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	    vote($_SESSION["pk"],$_SESSION["voterid"],$_SESSION["voteremail"]);
	}
?>
<div class="champ" style="height:738px"><strong class="marbot">Vote</strong>
	<div class="card"  >
		<div class="leftcol">
		<span><img width="180" height="32" src="images/table.png"></span><br/>
	<?php 
	  $sql = getuserfromid($_SESSION['pk']);
	  $r = $sql->fetch(PDO::FETCH_ASSOC);
    ?>	
	
	<?php
		$q = isvoted($_SESSION["pk"],$_SESSION["voterid"]);		
		if($q->rowCount()==0){
			?>
			<p>
			<?php 		
				if($r["opitonchoosen"]==2){
					echo $r["caption"];
				}else{
					echo $r["cmt"];
				}
			?>
			</p>
			<form method="post">
				<input type="hidden" name="PHPSESSID" value="<?php echo session_id(); ?>"/>
				<input type="Submit" value="vote"/>
			</form>
			<?php
		}else if(isset($_SESSION["voted"])){
			echo '<p>Thank You for voting.</p>';
			unset($_SESSION['voted']);
		}else{
			echo '<p>You have already voted for this</p> ';
		}
	?>	
	</div>
	<?php if($r["opitonchoosen"]==2){ ?>
		<div class="rytimg"><img src="resizedimages/<?php echo $r['resizephotourl']?>" width="210" height="210"></div>
	<?php } ?>
	</div>
</div>
<div class="bottomborder"></div>
<?php
	include_once ('footer.html');
?>