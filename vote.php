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

if($_REQUEST['pk']!=null){
	$_SESSION['pk']=$_REQUEST['pk'];
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
<div class="table1"><img src="images/tablefor.png" width="298" height="59" alt=""><span></span></div>

<?php

	/*$_SESSION["voterid"] = '81355529';
	$_SESSION["voteremail"] = 'mohit.11.arora@gmail.com';
	$_SESSION["pk"] = 1;*/
	if($_SERVER["REQUEST_METHOD"] == "POST")
	 {
	    vote($_SESSION["pk"],$_SESSION["voterid"],$_SESSION["voteremail"]);
		
		
	}
?>

<div class="champ"><strong class="marbot">Vote</strong>
	<?php
		$q = isvoted($_SESSION["pk"],$_SESSION["voterid"]);		
			if(mysqli_num_rows($q)==0){
	?>
	<form method="post">
		<input type="hidden" name="PHPSESSID" value="<?php echo session_id(); ?>"/>
		<input type = "Submit" value="vote" />
		
	</form>
	<?php }else if(isset($_SESSION["voted"])){
		echo 'Thank You for voting.';
		unset($_SESSION['voted']);
	}else{
		echo 'You have already voted for this ';
	}?>	
	
</div>
<div class="bottomborder"></div>
<?php
include_once ('footer.html');
?>
