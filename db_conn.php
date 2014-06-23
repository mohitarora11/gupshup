<?php
$db = mysql_connect("182.50.133.145","merchantbonus","Cloud9Media!");
$con = mysql_select_db("merchantbonus");


function exec_query_returnid($q){
	mysql_query($q);
	return mysql_insert_id();
}


?>

