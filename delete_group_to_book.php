<!-- Code start for delete books from group -->
<?php
include "cs/config.php";
if (isset($_GET['groupid']) && count($_GET) > 0 ) 
{ 
	$groupidval=$_GET['groupid'];
	$bookidval=$_GET['bookid'];
	
	$sqldelgroup = mysqli_query($db,"call sp_delete_common_data('','','".$bookidval."','','','','','D','".$groupidval."','','','','','','','','','DELETE_GROUP_TO_BOOK')") or die('Query Not execute'.mysqli_error($db));
	$db->close();

	$path="?groupid=$groupidval";
	header("location:subscriber_group_to_book_del.php".$path);
	exit();
 }
?>
<!-- Code start for delete books from group -->