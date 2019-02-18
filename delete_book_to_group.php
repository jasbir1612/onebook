<!-- Code start for delete books from group -->
<?php
include "cs/config.php";
if (isset($_GET['groupid']) && count($_GET) > 0 ) 
{ 
	$groupidval=$_GET['groupid'];
	$bookidval=$_GET['bookid'];

	$sqldelgroup = mysqli_query($db,"call sp_delete_common_data('','','".$bookidval."','','','','','D','".$groupidval."','','','','','','','','','DELETE_BOOK_TO_GROUP')") or die('Query Not execute'.mysqli_error($db));
	$db->close();

	$path="?bookid=$bookidval";
	header("location:subscriber_book_to_group_del.php".$path);
	exit();
 }
?>
<!-- Code end for delete books from group -->
