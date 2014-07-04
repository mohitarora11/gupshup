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


/*$dbhost = 'merchantbonus.db.9297235.hostedresource.com';
$dbuser = 'merchantbonus';
$dbpass = 'Cloud9Media!';
$dbname = 'merchantbonus';*/
/*$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');    
mysql_select_db($dbname, $conn);
*/
$dbhost = '127.0.0.1';
$dbuser = 'root';

$dbpass = 'admin123';
$dbname = 'atableforyou';


//$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
//$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname) or die ('Error connecting to mysql');    
//mysql_select_db($dbname, $conn);

/* new way to execute mysql quires*/
$conn = new PDO("mysql:host=".$dbhost.";dbname=".$dbname, $dbuser, $dbpass);
?>
