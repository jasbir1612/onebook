<!--Code start for logout -->
<?php
// Initialize the session.
include "cs/config.php";
if(isset($_REQUEST['userid']))
{
	include "cs/common.php";
	$IpAddress = $_SERVER['REMOTE_ADDR'];
	$DeviceType =detectDevice();
	$TotalAccess="3";
	$CurrentAccess="0";
	$LoginStatus="F";
	$Active="F";
	$UEmail=$_REQUEST['userid'];

	$resulttrace = mysqli_query($db,"call sp_insert_user_trace('','','".$UEmail."','".$DeviceType."','".$IpAddress."','".$IpAddress."','".$TotalAccess."','".$CurrentAccess."','".$LoginStatus."','".$Active."','LOGOUT_USER_ALL_ACCESS')") or die('Query Not execute'.mysqli_error($db));
	$db->close();	
	if (mysqli_num_rows($resulttrace) > 0) {
		 while($row = mysqli_fetch_array($resulttrace)) {
			 //$resulttraceval= $row['active'];
		 }
		 mysqli_free_result($resulttrace);
	}
}
 
 $WebSite_URL="location:".$SiteURL;
 header($WebSite_URL);
 location.reload();
 
?> 
<!--Code end for logout -->
