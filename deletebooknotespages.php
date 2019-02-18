 <!-- Code start for delete books/notes -->
<?php
include "cs/config.php";
if (isset($_GET['booknotesid']) && count($_GET) > 0 ) 
{ 
    $UserId=$_COOKIE['useremailid'];
	$booknotesidval=$_GET['booknotesid'];
	$pagenoval=$_GET['pageno'];
	$qryds = mysqli_query($db,"call sp_delete_common_data('','".$UserId."','".$booknotesidval."','','','','','D','','','','','".$pagenoval."','','','','','DELETE_BOOKNOTES_PAGES')") or die('Query Not execute'.mysqli_error($db));
	$db->close();

	echo "<script>";
	echo "alert('Page deleted successfully ')";
	echo "</script>";
	
	$path="?bookid=$booknotesidval";
	header("location:notesDetailOrganize.php".$path);
	exit();
 }
?>
  <!-- Code end for delete books/notes -->
