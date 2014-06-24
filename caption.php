<?php
include_once('globalvar.php');
include_once('sql.php');
/*if($_SESSION["userid"]){
}else{
	header("Location: ".$GLOBALS['url']."index.php"); /* Redirect browser */
/*}*/

if($_SESSION["userid"]){    
	if($_SERVER["REQUEST_METHOD"] == "POST"){ 	
		$q = getjodifromfbid($_SESSION['userid']);
		$r = $q->fetch(PDO::FETCH_ASSOC);
		if($r["opitonchoosen"]==1){
			savecaption($_SESSION['userid'],$_POST["location"],"");			
		}else{
			savecaption($_SESSION['userid'],$_POST["location"],$_POST["caption"]);
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
<option value="1">Delhi</option>
<option value="2">mumbai</option>
<option value="3">kolkata</option>
<option value="4">chennai</option>
<option value="5">banglore</option>
</select>
<?php 
$q = getjodifromfbid($_SESSION['userid']);
 $r = $q->fetch(PDO::FETCH_ASSOC);
if($r["opitonchoosen"]==2){
?>
<select name="caption">
<option>select caption</option>
<option value="1">hiiii</option>
<option value="2">hello</option>
<option value="3">how r u</option>
<option value="4">sdfghhjjhg</option>
<option value="5">sdfghj</option>
</select>
<?php
}
?>
<input type="submit" value="submit">
</form>
</div>
<div class="bottomborder"></div>
<?php
include ('footer.html');
?>