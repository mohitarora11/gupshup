<?php
if ( isset($_REQUEST['PHPSESSID'])){
	session_id($_REQUEST['PHPSESSID']);
}
include_once('app_config.php');
include_once('sql.php');
if($_SESSION["userid"]){    
	if($_SERVER["REQUEST_METHOD"] == "POST"){ 	
		$q = getjodifromfbid($_SESSION['userid']);
		$r = $q->fetch(PDO::FETCH_ASSOC);
		
		if($r["opitonchoosen"]==2){
			
			savecaption($_SESSION['userid'],$_POST["location"],$_POST["caption"]);
		}
		
		header("Location: ".$GLOBALS['url']."thanku.php?PHPSESSID=".session_id()); /* Redirect browser */
		exit();
	}
}
include_once('header.php');
?>

<div class="champ" >
	<div class="card"  >

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
				<option >Delhi</option>
				<option >mumbai</option>
				<option >kolkata</option>
				<option >chennai</option>
				<option >banglore</option>
				</select>
			</li>

		<li class="divselect">
			<select name="caption" class="styled">
			<option value="">select caption</option>
			<option >hiiii</option>
			<option >hello</option>
			<option >how r u</option>
			<option >sdfghhjjhg</option>
			<option >sdfghj</option>
			</select>
		</li>
<li>
			<input type="submit" value="submit">
			</li>
			</ul>
			</form>
		</div>
		<div class="rytimg">		
			<img src="resizedimages/<?php echo $r['resizephotourl']?>"  style="margin-right:10px;" />
		</div>
	</div>
</div>
<div class="bottomborder"></div>
<script type="text/javascript" src="js/custom-form-elements.js"></script>
<script type="text/javascript">
function validatecaption(){
	var cap = document.forms["captionform"]["caption"].value;
	var loc = document.forms["captionform"]["location"].value;
    if (cap == null || cap == "" || loc ==null || loc=="") {
        alert("Kindly Select caption and location");
        return false;
    }
	

}
</script>
<?php
include ('footer.html');
?>