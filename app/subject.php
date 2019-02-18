<?php
    include "../cs/config.php";
    
    $UID = mysqli_real_escape_string($db,$_POST['userid']); 
	$UEID = mysqli_real_escape_string($db,$_POST['email_id']); 
	$Sid = mysqli_real_escape_string($db,$_POST['subjectid']); 
	$Cid = mysqli_real_escape_string($db,$_POST['courseid']);
	// $UID="4";
	// $UEID="";
	// $Sid="";
	// $Cid="";

	$return_arr = array();
	$result_subject = $db->query("call sp_get_common_user('GETSUBJECTUSER','$UID','$UEID')");
	$db->close();
	if(!($total= $result_subject->num_rows)==0)
	{
	 while($rowdist = $result_subject->fetch_array()) 
	 {
		$row_array['subjectid'] = $rowdist['subjectid'];
		$row_array['subjectname'] = $rowdist['subjectname'];
		$row_array['totalcount'] = $rowdist['totalcount'];
        array_push($return_arr,$row_array);
	  }
	  echo'{"Subject":'.json_encode($return_arr).'}';
	}
	else
	{
	  $return_arr=array("No Data");
	  echo'{"Subject":'.json_encode($return_arr).'}';
	}
	
	$result_subject->close(); 
 
?>
