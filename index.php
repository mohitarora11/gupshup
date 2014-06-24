<?php
session_start();
include('app_config.php');

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
	$_SESSION["userid"]=$graphObject->getProperty('id');
	$_SESSION["useremail"]=$graphObject->getProperty('email');
	$_SESSION["username"]=$graphObject->getProperty('name');
	$_SESSION["facebook_session"] = $session;
	
	$page = $GLOBALS['url']."savedata.php?PHPSESSID=".session_id();
	//print_r($_SESSION);
	header("Location: ".$page);
	exit(print_r($_SESSION));
}else{

	$helper = new FacebookRedirectLoginHelper(CANVASURL);
	$LOGINURL = $helper->getLoginUrl(explode(',',SCOPE));
	include_once('home.php');
	die('');
?>
	<script>
		//top.window.location.href = '<?php echo $helper->getLoginUrl(explode(',',SCOPE));?>';
	</script>
<?php
}
?>