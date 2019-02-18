<?php
    include "../cs/config.php";
    
	$BNId = mysqli_real_escape_string($db,$_POST['bookid']); 
	//$BNId="1";
	$return_arr = array();
	$json_response = array();

	$qryds = mysqli_query($db, "call sp_get_common_data('','','".$BNId."','','','','','A','','','','','','','','','','GET_BOOKFORREADER')");
	$db->close();
	if(mysqli_num_rows($qryds)>0)
	{
		while($rowcat = mysqli_fetch_array($qryds))
		 {
		    $json_response['pageno'] = $rowcat['pageno'];
		    $json_response['pagetitle'] = $rowcat['pagetitle'];
		    $imagepath = $rowcat['imagepath'];
			$imagepath = str_replace("\\", '/', $imagepath);
		    $img_path=$S3URL.$imagepath; 
			$json_response['imagepath'] = $img_path;
			array_push($return_arr,$json_response); 
	    }
	}
	echo'{"Bookdetails":'.json_encode($return_arr).'}';
	$qryds->close();
 

?>
