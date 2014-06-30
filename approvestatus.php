<?php 
include_once('globalvar.php');
include_once('sql.php');
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest") {
if( isset( $_REQUEST["id"] ) ){
$rtn=array();	
	try{
		saveapprovedstatus($_REQUEST["id"],$_REQUEST["status"]);
			$rtn['res']=true;
		}catch (Exception $e) {
	
			$rtn['error']=$e;
		}
	
	header('Content-Type:application/json');
	echo json_encode($rtn);
}
}
?>