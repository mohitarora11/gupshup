<?php
session_id($_REQUEST['PHPSESSID']);
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

if($_SESSION["userid"]){    
	if($_SERVER["REQUEST_METHOD"] == "POST"){ 	
		$q = getjodifromfbid($_SESSION['userid']);
		$r = $q->fetch(PDO::FETCH_ASSOC);
		
		if($r["opitonchoosen"]==1){
			savecaption($_SESSION['userid'],$_POST["location"],"");			
		}else{
			savecaption($_SESSION['userid'],$_POST["location"],$_POST["caption"]);
		}
		//$r = $id->fetch(PDO::FETCH_ASSOC);
			$pk=0;
			$pk = $r["id"];
			
			
			
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
					$request = new FacebookRequest( $session, 'POST', '/me/feed' , array(
						'link' => $GLOBALS['url']."vote.php?pk=".$pk,
						'message' => 'User provided message',
						'picture' => $GLOBALS['url'].'images/pastry.jpg',
						'description' => '',
						'caption' => 'A table for'
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
			
			}
		
		header("Location: ".$GLOBALS['url']."thanku.php?PHPSESSID=".session_id()); /* Redirect browser */
		exit();
	}
}
include_once('header.php');
?>

<div class="champ"><strong class="marbot">select location</strong>

<form class="table1" method="post" style="margin-bottom:10px" action="caption.php">
	<input type="hidden" name="PHPSESSID" value="<?php echo session_id(); ?>"/>
<select name="location" >
<option>select location </option>
<option >Delhi</option>
<option >mumbai</option>
<option >kolkata</option>
<option >chennai</option>
<option >banglore</option>
</select>
<!--<?php 
$q = getjodifromfbid($_SESSION['userid']);
 $r = $q->fetch(PDO::FETCH_ASSOC);
if($r["opitonchoosen"]==2){
?>-->
<select name="caption">
<option>select caption</option>
<option >hiiii</option>
<option >hello</option>
<option >how r u</option>
<option >sdfghhjjhg</option>
<option >sdfghj</option>
</select>
<!--<?php
}
?>-->
<input type="submit" value="submit">
</form>
</div>
<div class="bottomborder"></div>
<?php
include ('footer.html');
?>