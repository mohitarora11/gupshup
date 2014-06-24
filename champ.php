<?php
session_id($_REQUEST['PHPSESSID']);
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

if(isset($_SESSION) && $_SESSION["userid"]){
	include_once('sql.php');
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if($_POST["optionchosen"]=='1'){
			$id = saveoption($_SESSION["userid"],$_POST["optionchosen"],$_POST["comment"]);
			$pk=0;
			savestatus($_SESSION["userid"],1);
			$r = $id->fetch(PDO::FETCH_ASSOC);
			$pk = $r["id"];
			
			/*while($r= mysqli_fetch_array($id)){
				$pk = $r["id"];
			}*/
			
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
					
					/*$response = (new FacebookRequest($session, 'POST', '/me/feed', array(
						  'link' => 'www.example.com',
						  'message' => 'User provided message'
						)
					  ))->execute()->getGraphObject();
					*/
					
					//?pk=".$pk
					$request = new FacebookRequest( $session, 'POST', '/me/feed' , array(
						'link' => $GLOBALS['url']."vote.php",
						'message' => 'User provided message',
						'picture' => $GLOBALS['url'].'images/pastry.jpg',
						'description' => '',
						'caption' => 'Gupshup'
					  ));
					$response = $request->execute();  
					$graphObject = $response->getGraphObject();
					header("Location: ".$GLOBALS['url']."thanku.php?PHPSESSID=".session_id());
					exit('');
				} catch(FacebookRequestException $e) {
					echo "Exception occured, code: " . $e->getCode();
					echo " with message: " . $e->getMessage();
				}   		
			}else{
				$helper = new FacebookRedirectLoginHelper(CANVASURL);
				$LOGINURL = $helper->getLoginUrl(explode(',',SCOPE));
				//include_once('home.php');
				//die('');
			}
		}else{
			include_once("imagesave.php?PHPSESSID=".session_id());
		}
		header("Location: ".$GLOBALS['url']."caption.php?PHPSESSID=".session_id()); /* Redirect browser */
		exit();
	}
}else{
	header("Location: ".$GLOBALS['url']."index.php?PHPSESSID=".session_id()); /* Redirect browser */
	exit();
}
?>
<?php
include_once('header.php');
include_once('templates/champ_html.html');
include_once('footer.html');
?>
