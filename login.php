<?php
include_once('globalvar.php');
if($_SERVER["REQUEST_METHOD"] == "POST")
 { 
    if(!strcasecmp($_REQUEST["txtUserName"],"atableforyou") && !strcasecmp($_REQUEST["txtUserPass"],"atableforyou")) {
		$_SESSION["login"]=true;
		header("Location: ".$GLOBALS['url']."table.php"); /* Redirect browser */
		die();
	}
 }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<title>Login</title>
 
</head>
<body>
<div class="login">
<div class="box">
                <h3>WishList - Please Login</h3>
			<form method="post" class="cls_insert" action="">
                <table width="100%" border="0" style="margin: auto;" cellpadding="2" cellspacing="3">
                    <tbody><tr>
                        <td colspan="2">
                            <span style="color:Red;font-weight: bold;" id="message"></span>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="spnname">User Name:</span></td>
                        <td><input type="text" maxlength="40" size="20"  name="txtUserName" class="inp" /></td>
                    </tr>
                    <tr>
                        <td><span class="spnname">Password:</span></td>
                        <td><input type="password" maxlength="40" size="22" class="inp" name="txtUserPass" /></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: bottom;">&nbsp; </td>
                        <td align="left" style="padding-top: 8px;"><input type="submit"  value="Login" class="cls_submit" id="cmdLogin" name="cmdLogin" /></td>
                    </tr>
                </tbody></table></form>
            </div>
</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" ></script>
</body>
</html>