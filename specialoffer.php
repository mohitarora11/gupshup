<?php
if( isset($_REQUEST['PHPSESSID'])){
	session_id($_REQUEST['PHPSESSID']);
}
include_once('app_config.php');
include_once ('header.php');

?>
<style type="text/css">
footer ul{padding-top:4px}
.table{height:85px}
</style>
<div class="champsp"><strong>GREAT DEALS</strong>
You don’t just book a table for two, three or four. You book a table for love, romance, friendship, memories and many other great occasions. This is the spirit that American Express celebrates at Cyber Hub with 17 exciting offers on dining.<br/>

<div class="spofld" style="height:459px">
<ul>
<li><span><img src="images/bbar.png" width="60" height="43"></span><p>Earn 10 Bonus Membership 
Rewards&reg; Points for every Rs. 100 Spent</p></li>
<li><span><img src="images/bbar.png" width="60" height="43"></span><p>Earn 10 Bonus Membership 
Rewards&reg; Points for every Rs. 100 Spent</p></li>
<li><span><img src="images/bbar.png" width="60" height="43"></span><p>Earn 10 Bonus Membership 
Rewards&reg; Points for every Rs. 100 Spent</p></li>
<li><span><img src="images/bbar.png" width="60" height="43"></span><p>Earn 10 Bonus Membership 
Rewards&reg; Points for every Rs. 100 Spent</p></li>
</ul>
</div>
<span class="pull-left spntxt" style="margin-bottom:5px">Now, participate in the contest and win American Express Gift Card worth Rs. 2000!</span>

<?php if(isset($_SESSION["LOGINURL"])){
?>
<a target="_top" href="<?php echo $_SESSION['LOGINURL'];?>" class="buttonsp">ENTER CONTEST</a>
<?php }else {
?>
<a target="_top" href="https://www.facebook.com/v2.0/dialog/oauth?client_id=557404164366859&redirect_uri=https%3A%2F%2Fapps.facebook.com%2Fatablefor%2F&state=0a60d415e3306119af0a07ad0842d0e7&sdk=php-sdk-4.0.8&scope=email%2Cpublish_actions" class="buttonsp test">ENTER CONTEST</a>
<?php } ?>
</div>

<div class="bottomborder"><p class="offer">
Liked these deals but do not have an American Express Card?  <a target="_blank" href="https://www.americanexpress.com/in/content/credit-cards/">Apply Now!</a>
</p></div>


<?php
include ('footer.html');
?>