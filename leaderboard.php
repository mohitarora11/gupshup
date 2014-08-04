<?php
include_once('globalvar.php');
include_once('app_config.php');


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


if(isset($_REQUEST['error']) ){

	$helper = new FacebookRedirectLoginHelper(CANVASURL);
	$LOGINURL = $helper->getLoginUrl(explode(',',SCOPE));
	//include_once('home.php');
	header("Location: ".$GLOBALS['url']."index.php"); /* Redirect browser */
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
	$_SESSION["userid"]=$graphObject->getProperty('id');
	$_SESSION["useremail"]=$graphObject->getProperty('email');
	$_SESSION["username"]=$graphObject->getProperty('name');
	$_SESSION["facebook_session"] = $session;	
	//$page = $GLOBALS['url']."savedata.php?PHPSESSID=".session_id();
	//print_r($_SESSION);
	//header("Location: ".$page);
	//exit();
}else{

	$helper = new FacebookRedirectLoginHelper(CANVASURL);
	$LOGINURL = $helper->getLoginUrl(explode(',',SCOPE));
	$_SESSION["LOGINURL"]= $LOGINURL;
	
?>
	<script>
		top.window.location.href = '<?php echo $helper->getLoginUrl(explode(',',SCOPE));?>';
	</script>
<?php
}

include_once('sql.php');
include_once ('header.php');
//$_SESSION["userid"] = '111';
if($_SESSION["userid"]){

?>

<div class="champ"><strong class="marbot">LEADERS</strong>

<span class="spntxt pull-left">Entries which are leading the contest</span>
<br/>
<div class="cont">
Caption Leaders

<ul class="leaderboard">
<?php 
	$sql = leaderboard_bycaption();
	//$r = $sql->fetch(PDO::FETCH_ASSOC);
	while ($row = $sql->fetch(PDO::FETCH_ASSOC))
{

//echo '<li><img src="https://graph.facebook.com/'.$row['fbid'].'/picture?type=normal" width="100" height="90"><u>';
echo '<li><tbr>Atable<br/>For<br/>'.$row['cmt'].'</tbr>';
echo $row['fname'];
echo'</u><br><b>';
echo $row['count'];
echo ' Vote(s)</b></li>';
}?>


</ul>
</div>
<div class="cont">
Selfie Leaders
<ul class="leaderboard">
<?php 
	$sql = leaderboard_byselfie();
	//$r = $sql->fetch(PDO::FETCH_ASSOC);
	while ($row = $sql->fetch(PDO::FETCH_ASSOC))
{

//echo '<li><img src="https://graph.facebook.com/'.$row['fbid'].'/picture?type=normal" width="100" height="90"><u>';
echo '<li><img src="resizedimages/'.$row["resizephotourl"].'" width="100" height="90" /><u>';
echo $row['fname'];
echo'</u><br><b>';
echo $row['count'];
echo ' Vote(s)</b></li>';
}?>
</ul>

<div style="clear:both;height:10px"></div>
<a class="link"  href="thanku.php">Go Back</a>

</div>
Winners will be declared every Friday!
<div class="fbtwt" style="display:none">
<a href="#"><img src="images/fb.png" width="66" height="24"></a>
<a href="#"><img src="images/tweet.png" width="66" height="24"></a>

</div>

</div>


<div class="bottomborder"></div>
<?php
	include ('footer.html');
}
else{
	header("Location: ".$GLOBALS['url']."index.php"); /* Redirect browser */
}
?>


