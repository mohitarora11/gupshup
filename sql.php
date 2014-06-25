<?php
include_once("db_connection.php");

/* for checking user exist or not */
function checkifexist($fbid){
	
    $q = "SELECT fbid FROM user_atableforyou WHERE fbid=".$fbid;
	#die($q);
    $res = mysqli_query($GLOBALS['conn'],$q);
    if(mysqli_num_rows($res) > 0){
        return 1;
    }else{
        return 0;
    }
}

/* for inserting the user info */
function saveuser($fbid,$email,$fname){
	$sql = "INSERT INTO user_atableforyou(fbid,email,fname,inserteddate)
	VALUES('".$fbid."','".$email."','".$fname."',current_timestamp())";
	mysqli_query($GLOBALS['conn'],$sql);
}

/* for updating  user selected info */
function saveoption($fbid,$optionchoosen,$choosenvalue){

	if($optionchoosen == 1){ /*  user has choosen comment */
		$sql = "Update user_atableforyou set opitonchoosen = ".$optionchoosen.", cmt = '".$choosenvalue."' where fbid= '".$fbid."'";
	}else{
		$sql = "Update user_atableforyou set opitonchoosen = ".$optionchoosen.", photourl = '".$choosenvalue."' where fbid= '".$fbid."'";
	}
	mysqli_query($GLOBALS['conn'],$sql);
	$sql = "Select id from user_atableforyou where fbid= '".$fbid."'";
	return mysqli_query($GLOBALS['conn'],$sql);
}

/* for updating status */
function savestatus($fbid,$status){	
	$sql = "Update user_atableforyou set status = ".$status." where fbid= '".$fbid."'";
	mysqli_query($sql);
}

/* for getting status */
function getstatus($fbid){	
	$q = "Select status from user_atableforyou where fbid = ".$fbid;
    return mysqli_query($GLOBALS['conn'],$q);
}
/* for inserting a vote */
function vote($userid,$fbid,$email){
	$arr = array();
	//$arr['ip'] = $_SERVER['REMOTE_ADDR'];
	$q=isvoted($userid,$fbid);
	
	if(mysqli_num_rows($q)==0){
		$q = "insert into vote_atableforyou(userid,fbid,votetime,ipaddress,email) 
		values(".$userid.",'".$fbid."',current_timestamp(),'".$_SERVER['REMOTE_ADDR']."','".$email."')";		
		return mysqli_query($GLOBALS['conn'],$q);
	}
	return 0;
}
/* for getting the total count of register user */
function totalcount(){
	$q = "Select count(*) as count from user_atableforyou";	
	return mysqli_query($GLOBALS['conn'],$q);
}

/* for getting the vote total count  */
function totalcountvote(){
	$q = "Select count(*) as count from vote_atableforyou";	
	return mysqli_query($GLOBALS['conn'],$q);
}
/* for checking has the user already voted */
function isvoted($userid,$fbid){
	
	$q = "select * from vote_atableforyou where userid=".$userid." and fbid='".$fbid."'";	
	return mysqli_query($GLOBALS['conn'],$q);
}

/* getting user selected option useing fbid */
function getjodifromfbid($fbid){
		
		$q = "select * from user_atableforyou where fbid =".$fbid;
		return mysqli_query($GLOBALS['conn'],$q);
}

/* for getting user current rank */

function currentposition(){
	
	$q="select i.cmt,i.optionchoosen,i.photourl,i.fbid 
	from user_atableforyou i left outer join vote_atableforyou v on i.id = v.userid
	group by i.fbid
	order by count(userid) desc";
	return mysqli_query($GLOBALS['conn'],$q);
}

/* for getting user vote count */

function getvotecount($id){
    $q = "Select count(*) from vote_atableforyou where userid = ".$id;
    return mysqli_query($GLOBALS['conn'],$q);
}
