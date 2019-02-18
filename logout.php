<!--Code start for logout -->
<?php
// Initialize the session.
 include "cs/config.php";
 // session_start();
// // // Unset all of the session variables.
 // $_SESSION['userid']="";
 // $_SESSION['roleid']="";
 // $_SESSION['username']="";
 // $_SESSION['user_id']="";

// // Finally, destroy the session.
 // session_unset();
 // session_destroy();
 
if(isset($_COOKIE['useremailid']))
{
	include "cs/common.php";
	$IpAddress = $_SERVER['REMOTE_ADDR'];
	$DeviceType =detectDevice();
	$TotalAccess="3";
	$CurrentAccess="0";
	$LoginStatus="F";
	$Active="F";
	$UEmail=$_COOKIE['useremailid'];

	$resulttrace = mysqli_query($db,"call sp_insert_user_trace('','','".$UEmail."','".$DeviceType."','".$IpAddress."','".$IpAddress."','".$TotalAccess."','".$CurrentAccess."','".$LoginStatus."','".$Active."','LOGOUT_USER')") or die('Query Not execute'.mysqli_error($db));
	$db->close();	
	if (mysqli_num_rows($resulttrace) > 0) {
		 while($row = mysqli_fetch_array($resulttrace)) {
			 //$resulttraceval= $row['active'];
		 }
		 mysqli_free_result($resulttrace);
	}
}
 
//expires the cookie
//redirects to login.php

setcookie('useremailid', '', time() - 24*60*60, "/");
setcookie('roleid', '', time() - 24*60*60, "/");
setcookie('username', '', time() - 24*60*60, "/");
setcookie('userid', '', time() - 24*60*60, "/");
				
// setcookie('useremailid', '', time() - 24*60*60);
// setcookie('roleid', '', time() - 24*60*60);
// setcookie('username', '', time() - 24*60*60);
// setcookie('user_id', '', time() - 24*60*60);
 

// Go To The Index Page
 $WebSite_URL="location:".$SiteURL;
 header($WebSite_URL);
 location.reload();
?> 
<!--Code end for logout -->
