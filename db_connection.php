<?php

/*$dbhost = 'merchantbonus.db.9297235.hostedresource.com';
$dbuser = 'merchantbonus';
$dbpass = 'Cloud9Media!';
$dbname = 'merchantbonus';*/

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'atableforyou';


$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');    
mysql_select_db($dbname, $conn);
?>
