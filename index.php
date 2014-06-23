<?php

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

include('app_config.php');
// init app with app id (APPID) and secret (SECRET)
FacebookSession::setDefaultApplication(APPID, APPSECRET);

// https://apps.facebook.com/askanswer/?error=access_denied&error_code=200&error_description=Permissions+error&error_reason=user_denied&state=5e383f6bf8f5f09b4581097c33b83ecf#_=_
//if user denied access
if(isset($_REQUEST['error']) ){
	$helper = new FacebookRedirectLoginHelper(CANVASURL);
	$LOGINURL = $helper->getLoginUrl(explode(',',SCOPE));
	include_once('templates/error.html');
	die('');
}
/*
//https://www.webniraj.com/2014/05/01/facebook-api-php-sdk-updated-to-v4-0-0/
// login helper with redirect_uri
//for websites
$helper = new FacebookRedirectLoginHelper( BASEURL );

try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
 
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
   
  // print data
  echo  print_r( $graphObject, 1 );
} else {
  // show login url
  echo '<a href="' . $helper->getLoginUrl() . '" target="_blank">Login</a>';
}

*/

//for canvas
$helper = new FacebookCanvasLoginHelper();
try {
  $session = $helper->getSession();
} catch (FacebookRequestException $ex) {
    // When Facebook returns an error
	print_r($ex);
} catch (\Exception $ex) {
    // When validation fails or other local issues
	print_r($ex);
}

if ($session){
  // Logged in.
    // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
   
  // print data
  
  /*
  1.store user ingfo
  1.1 comment on wall
  1.2 if user upload image
  1.2.1 sow frames
  1.2.2 user have options to choose frams
  1.2.3 once user select's and submit, then we need to post on wall
  2. if user already exist direct scoreboard
  */
  
  include('templates/index.html');
  
  //print_r($session);
}else{
	$helper = new FacebookRedirectLoginHelper(CANVASURL);
	$LOGINURL = $helper->getLoginUrl(explode(',',SCOPE));
	include_once('templates/error.html');
	die('');
?>
	<script>
		//top.window.location.href = '<?php echo $helper->getLoginUrl(explode(',',SCOPE));?>';
	</script>
<?php
}
?>