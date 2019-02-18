<?php
	include "../cs/config.php";
	$UserEmail = mysqli_real_escape_string($db,$_POST['email_id']);
	$UserPassword = mysqli_real_escape_string($db,$_POST['pwd']);

	$resultlogin = mysqli_query($db,"call sp_user_signin('','".$UserEmail."','".$UserPassword."','USER_SIGNIN_APP')");
	$db->close();	
	if(mysqli_num_rows($resultlogin)>0)
	{
	 while($row=mysqli_fetch_array($resultlogin))
	 {
		$UId = $row['Subscriber_id'];
		$UName = $row['Billing_Name'];
		$UEmail = $row['billing_Email'];
		$URoleId = $row['role_id'];
		if ($URoleId=="1")
		{
			 $arr = array('Status' => "Success",'UserID' => $UId,'UserEmailID' => $UEmail,'RoleID' => $URoleId,'UserName' => $UName);
			 //$arr = array('Status' => "Success");
				 echo json_encode($arr);
		} 
		if ($URoleId=="2" || $URoleId=="3")
		{
		     $arr = array('Status' => "Success",'UserID' => $UId,'UserEmailID' => $UEmail,'RoleID' => $URoleId,'UserName' => $UName);
			 //$arr = array('Status' => "Success");
				 echo json_encode($arr);
		} 
	 }
	}
	else
	{
		$arr = array('Status' => "Not Registered");
		 echo json_encode($arr);
	}


?>
