<?php
include_once("db_connection.php");

/* for checking user exist or not */
function checkifexist($fbid){
	global $conn;
    $q = "SELECT fbid FROM user_atableforyou WHERE fbid=".$fbid;
	//die($q);
	$res = $conn->prepare($q);
	$res->execute();
	//$res = mysqli_query($GLOBALS['conn'],$q);
	$count = $res->rowCount();
    if($count > 0){
        return 1;
    }else{
        return 0;
    }
}

/* for inserting the user info */
function saveuser($fbid,$email,$fname){
	global $conn;
	$sql = "INSERT INTO user_atableforyou(fbid,email,fname,inserteddate)
			VALUES('".$fbid."','".$email."','".$fname."',current_timestamp())";
	$res = $conn->prepare($sql);
	$res->execute();
	//mysqli_query($GLOBALS['conn'],$sql);
}

/* for updating  user selected info */
function saveoption($fbid,$optionchoosen,$choosenvalue,$resizedphoto){
	global $conn;
	if($optionchoosen == 1){ /*  user has choosen comment */
		$sql = "Update user_atableforyou set opitonchoosen = ".$optionchoosen.", cmt = '".$choosenvalue."',resizephotourl='".$resizedphoto."' where fbid= '".$fbid."'";
	}else{
		$sql = "Update user_atableforyou set opitonchoosen = ".$optionchoosen.", photourl = '".$choosenvalue."',resizephotourl='".$resizedphoto."' where fbid= '".$fbid."'";
	}
	//mysqli_query($GLOBALS['conn'],$sql);
	$res = $conn->prepare($sql);
	$res->execute();
	
	$sql = "Select id from user_atableforyou where fbid= '".$fbid."'";
	$res = $conn->prepare($sql);
	$res->execute();
	return $res;
	//return mysqli_query($GLOBALS['conn'],$sql);
}

/* for updating status */
function savestatus($fbid,$status){
	global $conn;
	$sql = "Update user_atableforyou set status = ".$status." where fbid= '".$fbid."'";
	$res = $conn->prepare($sql);
	$res->execute();
	//mysqli_query($GLOBALS['conn'],$sql);
}
/* for updating location and caption */
function savecaption($fbid,$loc,$cap){
	global $conn;
	$sql = "Update user_atableforyou set location='".$loc."',caption='".$cap."',status='2' where fbid= '".$fbid."'";
	//exit($sql);
	$res = $conn->prepare($sql);
	$res->execute();
	//mysqli_query($GLOBALS['conn'],$sql);
}
/* for getting status */
function getstatus($fbid){
	global $conn;
	$q = "Select status from user_atableforyou where fbid = ".$fbid;
	$res = $conn->prepare($q);
	$res->execute();
	return $res;
    //return mysqli_query($GLOBALS['conn'],$q);
}
/* for inserting a vote */
function vote($userid,$fbid,$email){
	global $conn;
	$arr = array();
	//$arr['ip'] = $_SERVER['REMOTE_ADDR'];
	$q=isvoted($userid,$fbid);
	$count = $q->rowCount();
	if($count == 0){
		$q = "insert into vote_atableforyou(userid,fbid,votetime,ipaddress,email) 
			values(".$userid.",'".$fbid."',current_timestamp(),'".$_SERVER['REMOTE_ADDR']."','".$email."')";		
		$_SESSION["voted"] = 1;
		$res=$conn->prepare($q);
		$res->execute();
		return $res;
		//return mysqli_query($GLOBALS['conn'],$q);
	}
	return 0;
}
/* for getting the total count of register user */
function totalcount(){
	$q = "Select count(*) as count from user_atableforyou";
	return $conn->query($q);
	//return mysqli_query($GLOBALS['conn'],$q);
}

/* for getting the vote total count  */
function totalcountvote(){
	global $conn;
	$q = "Select count(*) as count from vote_atableforyou";
	$res = $conn->prepare($q);
	$res->execute();
	return $res;
	//return mysqli_query($GLOBALS['conn'],$q);
}
/* for checking has the user already voted */
function isvoted($userid,$fbid){
	global $conn;
	$q = "select * from vote_atableforyou where userid=".$userid." and fbid='".$fbid."'";
	$res = $conn->prepare($q);
	$res->execute();
	return $res;
	//return mysqli_query($GLOBALS['conn'],$q);
}

/* getting user selected option useing fbid */
function getjodifromfbid($fbid){
	global $conn;
	$q = "select * from user_atableforyou where fbid =".$fbid;
	$res = $conn->prepare($q);
	$res->execute();
	return $res;
	//return mysqli_query($GLOBALS['conn'],$q);
}

/* for getting user current rank */
function currentposition(){
	global $conn;
	$q="select i.cmt,i.optionchoosen,i.photourl,i.fbid 
		from user_atableforyou i left outer join vote_atableforyou v on i.id = v.userid
		group by i.fbid
		order by count(userid) desc";
	$res = $conn->prepare($q);
	$res->execute();
	return $res;
	//return mysqli_query($GLOBALS['conn'],$q);
}

/* for getting user vote count */

function getvotecount($id){
	global $conn;
	$q = "Select count(*) from vote_atableforyou where userid = ".$id;
	$res = $conn->prepare($q);
	$res->execute();
	return $res;
	//return mysqli_query($GLOBALS['conn'],$q);
}