 <!-- Code start for delete the group--> 
<?php
include "cs/config.php";
if (isset($_GET['groupid']) && count($_GET) > 0 ) 
{ 
	$groupidval=$_GET['groupid'];

	$qryds = mysqli_query($db,"call sp_delete_common_data('','','','','','','','D','".$groupidval."','','','','','','','','','DELETE_GROUPS')") or die('Query Not execute'.mysqli_error($db));
	$db->close();

	echo "<script>";
	echo "alert('Group deleted sucessfully')";
	echo "</script>";

	header("location:manageGroups.html");
	exit();
 }
?>
 <!-- Code end for delete the group--> 