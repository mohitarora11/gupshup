<?php
/*
$dbhost = 'merchantbonus.db.9297235.hostedresource.com';
$dbuser = 'merchantbonus';
$dbpass = 'Cloud9Media!';
$dbname = 'merchantbonus';


//$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');    
//mysql_select_db($dbname, $conn);
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);*/
//$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);


$dbhost = 'merchantbonus.db.9297235.hostedresource.com';
$dbuser = 'merchantbonus';
$dbpass = 'Cloud9Media!';
$dbname = 'merchantbonus';
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');    
mysql_select_db($dbname, $conn);


?>
