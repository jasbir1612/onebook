 <!-- Code start for delete the members from group--> 
<?php
include "cs/config.php";
if (isset($_GET['groupid']) && count($_GET) > 0 ) 
{ 
	 $groupidval=$_GET['groupid'];
	 $memberidval=$_GET['memberid'];
	 $subscriberidval=$_GET['subscriberid'];
	 
	 $qryds = mysqli_query($db,"call sp_delete_common_data('".$subscriberidval."','','','','','','','D','".$groupidval."','".$memberidval."','','','','','','','','DELETE_MEMBERS')") or die('Query Not execute'.mysqli_error($db));
	 $db->close();

	echo "<script>";
	echo "alert('Member deleted sucessfully')";
	echo "</script>";

	$path="?groupid=$groupidval";
	header("location:manageListMembers.php".$path);
	exit();
 }
?>
 <!-- Code end for delete the members from group--> 