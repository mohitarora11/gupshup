<?php
if(!isset($_SESSION)){
	session_start();
}
// for backend
define("APPNAME","ask answer");
define("NAMESPACE","askanswer");
define("APPID","557404164366859");
define("APPSECRET","7b45b2047a24571436b19e2b5f2d1b9d");
define("CANVASURL","https://apps.facebook.com/askanswer/");
define("SCOPE","email"); // comma seperate values
define("DOMAIN","digiqom.com");
define("BASEURL","//www.digiqom.com/aexp/atableforappflow/");
define("BPC","0");
define("TITLE","A Table for App Flow");