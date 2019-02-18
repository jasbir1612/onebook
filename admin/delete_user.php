 <!-- Code start for delete user -->
<?php
include "../cs/config.php";
if (isset($_GET['userid']) && count($_GET) > 0 ) 
{ 
	$UserId=$_GET['userid'];
	if (isset($_GET['url']) && count($_GET) > 0 ) 
	{ 
	   $Url=$_GET['url'];
	   $Url=$SiteURL.$Url;
	}
	$qryds = mysqli_query($db,"call sp_delete_common_data('".$UserId."','','','','','','','D','','','','','','','','','','DELETE_USER')") or die('Query Not execute'.mysqli_error($db));
	$db->close();

	echo "<script>";
	echo "alert('User deleted successfully ')";
	echo "</script>";
  
	header("location:$Url");
	exit();
 }
?>
  <!-- Code end for delete user -->
