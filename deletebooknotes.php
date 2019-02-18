 <!-- Code start for delete books/notes -->
<?php
include "cs/config.php";
if (isset($_GET['booknotesid']) && count($_GET) > 0 ) 
{ 
	$booknotesid=$_GET['booknotesid'];
	$qryds = mysqli_query($db,"call sp_delete_common_data('','','".$booknotesid."','','','','','D','','','','','','','','','','DELETE_BOOKNOTES')") or die('Query Not execute'.mysqli_error($db));
	$db->close();

	echo "<script>";
	echo "alert('Book/Notes deleted successfully ')";
	echo "</script>";

	header("location:modify_booknotes.php");
	exit();
 }
?>
  <!-- Code end for delete books/notes -->
