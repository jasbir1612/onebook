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
	$result_course = $db->query("call sp_get_common_user('GETCOURSEUSER','$UID','$UEID')");
	$db->close();
	if(!($total= $result_course->num_rows)==0)
	{
	while($rowdist = $result_course->fetch_array()) 
	{
		$row_array['courseid'] = $rowdist['courseid'];
		$row_array['coursename'] = $rowdist['coursename'];
		$row_array['totalcount'] = $rowdist['totalcount'];
        array_push($return_arr,$row_array);
	}
     //echo json_encode($return_arr);
	 echo'{"Course":'.json_encode($return_arr).'}';
	}
	else
	{
	  $return_arr=array("No Data");
	  echo'{"Course":'.json_encode($return_arr).'}';
	}
	$result_course->close(); 
 
?>
