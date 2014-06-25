<?php use Facebook\FacebookRequest;
use Facebook\GraphObject;
use Facebook\FacebookRequestException;


include ('header.php');
if($_SESSION["userid"]){
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{   if($_POST["optionchosen"]=='1'){
			$id = saveoption($_SESSION["userid"],$_POST["optionchosen"],$_POST["comment"]);
			$pk=0;
			savestatus($_SESSION["userid"],1);
			while($r= mysql_fetch_array($id)){
				$pk = $r["id"];
			}
			try {

				$response = (new FacebookRequest(
				  $_SESSION["facebook_session"], 'POST', '/me/feed', array(
					'link' => $GLOBALS['url']."vote.php?pk=".$pk,
					'message' => 'User provided message',
					'picture' => $GLOBALS['url'].'images/pastry.jpg',
					'description' => '',
					'caption' => 'Gupshup'
				  )
				))->execute()->getGraphObject();

				//echo "Posted with id: " . $response->getProperty('id');

			  } catch(FacebookRequestException $e) {

				//echo "Exception occured, code: " . $e->getCode();
				//echo " with message: " . $e->getMessage();

			  }   
			header("Location: ".$GLOBALS['url']."thanku.php"); /* Redirect browser */
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

<form class="table1" method="post">

<strong># A TABLE FOR
</strong>
<input name="comment" type="text">
<input name="optionchosen" value="1" type="hidden">
<input name="" type="submit" value="Submit">
<em>Submit a caption for us to feature in our outdoor advertising at Cyber Hub
</em><span>OR</span>
</form>
<form class="table1" enctype="multipart/form-data" method="post"> 
<input name="file" type="file">
<input name="optionchosen" value="2" type="hidden">
<input name="" type="submit" value="Submit">
<em>Smile & Take a Dazzling selfie. Tag the location to upload. Your selfie will be be tagged with a auomated heading incase you do not fill the first column.
</em></form>

</div>

<div class="bottomborder"><p class="btext">
Want these offers* dont have a American Express® Card. Get one NOW!
</p></div>


<?php
include ('footer.html');
?>
