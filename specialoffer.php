<?php
if( isset($_REQUEST['PHPSESSID'])){
	session_id($_REQUEST['PHPSESSID']);
}
include_once('app_config.php');
include_once ('header.php');

?>

<div class="champsp"><strong>SPECIAL OFFERS</strong>

<u>Exclusively for American Express&reg; Cardholders</u>

Avail special privileges exclusive to <br>

American Express customers


<div class="spofld">
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
<?php if(isset($_SESSION["LOGINURL"])){
?>
<a target="_top" href="<?php echo $_SESSION['LOGINURL'];?>" class="buttonsp">ENTER CONTEST</a>
<?php }else {
?>
<a target="_top" href="https://www.facebook.com/v2.0/dialog/oauth?client_id=557404164366859&redirect_uri=https%3A%2F%2Fapps.facebook.com%2Fatablefor%2F&state=0a60d415e3306119af0a07ad0842d0e7&sdk=php-sdk-4.0.8&scope=email%2Cpublish_actions" class="buttonsp test">ENTER CONTEST</a>
<?php } ?>
</div>

<div class="bottomborder"><p class="btext">
Want these offers, but don't have an
American Express&reg; Card? <a target="_blank" href="https://www.americanexpress.com/in/content/credit-cards/">Get one NOW!</a>
</p></div>


<?php
include ('footer.html');
?>