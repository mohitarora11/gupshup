<?php
if ( isset($_REQUEST['PHPSESSID'])){
	session_id($_REQUEST['PHPSESSID']);
}
include_once('app_config.php');
include_once('sql.php');
if($_SESSION["userid"]){
	$q = getjodifromfbid($_SESSION['userid']);
	$r = $q->fetch(PDO::FETCH_ASSOC);
	if($_SERVER["REQUEST_METHOD"] == "POST"){ 	
		if($r["opitonchoosen"]==2){
			savecaption($_SESSION['userid'],$_POST["location"],$_POST["caption"]);
		}
		$_SESSION["firsttime"] = true;
		unset($_SESSION["caption"]);
		header("Location: ".$GLOBALS['url']."thanku.php?PHPSESSID=".session_id()); /* Redirect browser */
		exit();
	}
	else{
		if($r["opitonchoosen"]==2){
			if($r["caption"]!=''){
				header("Location: ".$GLOBALS['url']."thanku.php?PHPSESSID=".session_id()); /* Redirect browser */
				exit();
			}
			
		}else{
			header("Location: ".$GLOBALS['url']."index.php"); /* Redirect browser */
			exit();
		}
		
	}
	$_SESSION["caption"] = true;
}
include_once('header.php');
?>
<div id="opaque" style="display:block"></div>
<div class="champ" ><strong>CHAMPIONS</strong>
	<div class="card"  >
<br/><br/>
		<?php 
		  $sql = getjodifromfbid($_SESSION['userid']);
		  $r = $sql->fetch(PDO::FETCH_ASSOC);
		?>
		<div class="leftcol" style="text-align:left">
			<form class="table1" method="post" style="margin-bottom:10px" action="caption.php" name="captionform" onsubmit="return validatecaption()">
				<input type="hidden" name="PHPSESSID" value="<?php echo session_id(); ?>"/>
			<ul>
			<li class="divselect">
				<select name="location" class="styled">
				<option value="">select location </option>
				<option>Al Zaitoon </option>
<option>Angels in My Kittchen </option>
<option>The Beer Cafe </option>
<option>Bubble Teas</option>
<option>Cafe DT </option>
<option>Café Delhi Heights</option>
<option>California Pizza </option>
<option>Canton Spice </option>
<option>Chai Point </option>
<option>Dhaba (by Claridges) </option>
<option>Dunkin' Donuts </option>
<option>Haldiram's</option>
<option>Hard Rock Cafe</option>
<option>Imperfecto</option>
<option>Italiano  </option>
<option>Joost </option>
<option>KFC </option>
<option>Kebab Express   </option>
<option>Kings Kulfi  </option>
<option>Made in Punjab  </option>
<option>McDonald's  </option>
<option>Nando's  </option>
<option>Oh! Calcutta</option>
<option>Olive Bistro</option>
<option>Panchvati Gaurav  </option>
<option>Pita Pit </option>
<option>Pizza Hut Delivery</option>
<option>Raasta</option>
<option>Red Mango  </option>
<option>Rred Hot  </option>
<option>Soda Bottle Opener  </option>
<option>Soi 7  </option>
<option>Sutra Gastropub</option>
<option>Starbucks</option>
<option>The Beer Cafe </option>
<option>The Wine Company</option>
<option>Vaango  </option>
<option>Yogito </option>
<option>Zambar </option>

				</select>
			</li>

		<li class="divselect">
			<select name="caption" class="styled">
			<option value="">select caption</option>
			<option>Cheers</option>
		<option>Gup-Shup</option>
		<option>Power Lunches</option>
		<option>Love</option>
		<option>Making a Point</option>
		<option>Pushing the Envelope</option>
		<option>Breaking the Ice</option>
		<option>Mergers and Acquisitions</option>
		<option>Mumbai Vs Delhi</option>
		<option>Popping the Question</option>
		<option>Breaking News</option>
		<option>Friends and Family</option>
		<option>Coffee Breaks</option>

			</select>
		</li>
<li>
			<div class="errormsg"></div>
			<input type="submit" value="submit">
			</li>
			</ul>
			</form>
		</div>
		<div class="rytimg">		
			<img src="resizedimages/<?php echo $r['resizephotourl']?>"   style="margin-right:10px;width:300px;height:300px" /><br/>
			<a href="champ.php?PHPSESSID=<?php echo session_id(); ?>" >Change Image</a>
		</div>
	</div>
	
	</div>
<div class="bottomborder">
<span class="spntxt pull-left">
        Want these offers, but don't have an
American Express&reg; Card? <a target="_blank" href="https://www.americanexpress.com/in/content/credit-cards/">Get one NOW!</a>
    </span>

</div>

<script type="text/javascript">
function validatecaption(){
	var cap = document.forms["captionform"]["caption"].value;
	var loc = document.forms["captionform"]["location"].value;
    if (cap == null || cap == "" || loc ==null || loc=="") {
        $('.errormsg').html("Kindly Select caption and location");
        return false;
    }
	$('.errormsg').html('');
}
</script>
<?php
include ('footer.html');
?>