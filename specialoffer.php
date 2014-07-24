<?php
if( isset($_REQUEST['PHPSESSID'])){
	session_id($_REQUEST['PHPSESSID']);
}
include_once('app_config.php');
include_once ('header.php');

?>
<style type="text/css">
footer ul{padding-top:4px}

</style>
<div class="champ"><strong>GREAT DEALS</strong>
The Card of your choice at Cyber Hub<br/><span style="font-size:12px">Exclusive offers for American Express&reg; Cardmembers</span>

<div class="spofld" style="overflow:hidden">
<ul>
<li><span><img src="images/dunkindonuts.jpg" width="60" ></span><p>20% discount at Pizza Hut</p></li>
<li><span><img src="images/pizzahut.jpg" width="60" ></span><p>10% discount at Dunkin Donuts</p></li>
<li><span><img src="images/pizzahut.jpg" width="60" ></span><p>10% discount at Zambar</p></li>
<li><span><img src="images/pizzahut.jpg" width="60" ></span><p>10% discount at The Beer Cafe </p></li>
<li><span><img src="images/pizzahut.jpg" width="60" ></span><p>15% discount at Rred Hot </p></li>
<li><span><img src="images/pizzahut.jpg" width="60" ></span><p>5% discount</p></li>
<li><span><img src="images/pizzahut.jpg" width="60" ></span><p>10% discount on Italiano</p></li>
<li><span><img src="images/pizzahut.jpg" width="60" ></span><p>10% discount on Krispy Kreme</p></li>
<li><span><img src="images/pizzahut.jpg" width="60" ></span><p>10% discount on au bon pain</p></li>
<li><span><img src="images/rsz_thumb-13.jpg" width="60" ></span><p>15% discount on cafe Delhi Heights</p></li>
<li><span><img src="images/rsz_thumb-14.jpg" width="60" ></span><p>10% discount on Joost Juice bars</p></li>
<li><span><img src="images/rsz_thumb-15.jpg" width="60" ></span><p>15% discount on Raasta</p></li>
<li><span><img src="images/rsz_thumb-16.jpg" width="60" ></span><p>10% discount on Dhaba</p></li>
<li><span><img src="images/rsz_thumb-17.jpg" width="60" ></span><p>10% discount on Quiznos</p></li>
<li><span><img src="images/rsz_thumb-18.png" width="60" ></span><p>10% discount on Smokeys</p></li>
<li><span><img src="images/rsz_thumb-19.png" width="60" ></span><p>15% discount on Cherry Comet</p></li>



</ul>
</div>
<div style="clear:both"></div>
<span class="pull-left spntxt" style="padding-bottom:5px !important">Now, participate in the contest and win American Express Gift Card worth Rs. 2000!</span>

<?php if(isset($_SESSION["LOGINURL"])){
?>
<a target="_top" href="<?php echo $_SESSION['LOGINURL'];?>" class="buttonsp">ENTER CONTEST</a>
<?php }else {
?>
<a target="_top" href="https://www.facebook.com/v2.0/dialog/oauth?client_id=557404164366859&redirect_uri=https%3A%2F%2Fapps.facebook.com%2Fatablefor%2F&state=0a60d415e3306119af0a07ad0842d0e7&sdk=php-sdk-4.0.8&scope=email%2Cpublish_actions" class="buttonsp test">ENTER CONTEST</a>
<?php } ?>
</div>

<div class="bottomborder"><span class="spntxt pull-left">
Liked these deals but do not have an American Express Card?  <a target="_blank" href="https://www.americanexpress.com/in/content/credit-cards/">Apply Now!</a>
</div>


<?php
include ('footer.html');
?>