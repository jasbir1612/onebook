
<?php

// get the bookid 
$BNId = $_POST['bookid'];

// get the list of items id separated by cama (,)
$list_order = $_POST['list_order'];

//convert the string list to an array
$list = explode(',' , $list_order);

$i = 1 ;
foreach($list as $id) {
	try {
	    include "cs/config.php";
	    $sql  = "update epaper set priority = $i where editioncode = $BNId and pageno=$id";
		mysqli_query($db,$sql) or die ('Query Not Execute'.mysqli_error());
		mysqli_close($db);
	} catch (PDOException $e) {
		echo 'PDOException : '.  $e->getMessage();
	}
	$i++ ;
}
?>
