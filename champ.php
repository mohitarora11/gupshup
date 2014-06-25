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

FacebookSession::setDefaultApplication(APPID, APPSECRET);
$_SESSION["userid"] = '111';
include ('header.php');
if($_SESSION["userid"]){
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{   
		if($_POST["optionchosen"]=='1'){
			$id = saveoption($_SESSION["userid"],$_POST["optionchosen"],$_POST["comment"]);
			$pk=0;
			savestatus($_SESSION["userid"],1);
			while($r= mysql_fetch_array($id)){
				$pk = $r["id"];
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
					
					$request = new FacebookRequest( $session, 'GET', '/me/feed' , array(
						'link' => $GLOBALS['url']."vote.php?pk=".$pk,
						'message' => 'User provided message',
						'picture' => $GLOBALS['url'].'images/pastry.jpg',
						'description' => '',
						'caption' => 'Gupshup'
					  ));
					$response = $request->execute();  
					$graphObject = $response->getGraphObject();
					
					/*$response = (new FacebookRequest(
					  $session, 'POST', '/me/feed', array(
						'link' => $GLOBALS['url']."vote.php?pk=".$pk,
						'message' => 'User provided message',
						'picture' => $GLOBALS['url'].'images/pastry.jpg',
						'description' => '',
						'caption' => 'Gupshup'
					  )
					))->execute()->getGraphObject();				*/
					header("Location: ".$GLOBALS['url']."thanku.php");
					die('');
						/* Redirect browser */
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
			include ('imagesave.php');
			
		}
	}
}else{
	header("Location: ".$GLOBALS['url']."index.php"); /* Redirect browser */
}
?>


<div class="champ"><strong>CHAMPIONS</strong>

American Express gives you a chance to win table for two
<ul class="cyberhub">
<li><b>1.</b>
Add a caption
or upload 
a selfie.</li>
<li><b>2. </b>
Share with 
friends for 
likes.</li><li><b>3.</b>
Refer Friends 
and get assured 
prizes.</li><li><b>4.</b>
Get Maximum
Likes and 
Win.</li>	


</ul>

<form class="table1" method="post" style="margin-bottom:10px">

<strong># A TABLE FOR
</strong>
<input name="comment" type="text">
<input name="optionchosen" value="1" type="hidden">
<input name="" type="submit" value="Submit" />
<em>Submit a caption for us to feature in our outdoor advertising at Cyber Hub
</em><span>OR</span>
</form>
<form class="table1" style="margin-top:5px" enctype="multipart/form-data" method="post"> 
<label id="browse">
	<input name="file" type="file">
</label>
<input name="optionchosen" value="2" type="hidden">
<input name="" type="submit" value="Upload">
<em>Smile & Take a Dazzling selfie. Tag the location to upload. Your selfie will be be tagged with a auomated heading incase you do not fill the first column.
</em></form>

</div>

<div class="bottomborder"><p class="btext">
Want these offers* dont have a American Express® Card. Get one NOW!
</p></div>


<?php
include ('footer.html');
?>
