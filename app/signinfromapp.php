<?php
	include "../cs/config.php";
	$UserEmail = mysqli_real_escape_string($db,$_POST['email_id']);
	$UserPassword = mysqli_real_escape_string($db,$_POST['pwd']);
	
	// $UserEmail = 'rajatnandwani1991@gmail.com';
	// $UserPassword = 'Raj@1991';
	
	$resultlogin = mysqli_query($db,"call sp_user_signin('','".$UserEmail."','".$UserPassword."','USER_SIGNIN')");
	$db->close();	
	if(mysqli_num_rows($resultlogin)>0)
	{
	 while($row=mysqli_fetch_array($resultlogin))
	 {
		$UId = $row['Subscriber_id'];
		$UName = $row['Billing_Name'];
		$UEmail = $row['billing_Email'];
		$URoleId = $row['role_id'];
		$UPwd = $row['password'];
		if($UserPassword==$UPwd)
		{
		 setcookie('useremailid', $UEmail, time() + 24*60*60, "/");
		 setcookie('roleid', $URoleId, time() + 24*60*60, "/");
		 setcookie('username', $UName, time() + 24*60*60, "/");
		 setcookie('userid', $UId, time() + 24*60*60, "/");
		 
		 if ($URoleId=="1")
		 {
			//$pageURL = $_SERVER["REQUEST_URI"];
			//echo ("<SCRIPT LANGUAGE='JavaScript'>
			//window.location.href='".$pageURL."';
			//</SCRIPT>");
			//$WebSite_URL=$SiteURL."index.html";
			$WebSite_URL=$SiteURL."app/signinfromapp_redirect.php?useremailid=".$UserEmail."&roleid=".$URoleId."&username=".$UName."&userid=".$UId."";
			
			$arr = array('Status' => "Success",'WebSiteUrl' => $WebSite_URL,'UserID' => $UId,'UserEmailID' => $UEmail,'RoleID' => $URoleId,'UserName' => $UName);
				 echo json_encode($arr);
		 } 
		 if ($URoleId=="2" || $URoleId=="3")
		 {
			//echo ("<SCRIPT LANGUAGE='JavaScript'>
			//window.location.href='modify_booknotes.html';
			//</SCRIPT>");
			//$WebSite_URL=$SiteURL."modify_booknotes.html";
			$WebSite_URL=$SiteURL."app/signinfromapp_redirect.php?useremailid=".$UserEmail."&roleid=".$URoleId."&username=".$UName."&userid=".$UId."";
			
			 $arr = array('Status' => "Success",'WebSiteUrl' => $WebSite_URL,'UserID' => $UId,'UserEmailID' => $UEmail,'RoleID' => $URoleId,'UserName' => $UName);
				 echo json_encode($arr);
		 } 
		}
		else
		{
		   //echo "<script>alert('Incorrect Password. Try Again!')</script>";
		   $arr = array('Status' => "Incorrect Password. Try Again",'WebSiteUrl' => '','UserID' => '','UserEmailID' => '','RoleID' => '','UserName' => '');
		    echo json_encode($arr);
		}
	 }
	}
	else
	{
		//echo "<script>alert('Sorry this emailid is not registered with us!')</script>";
		 $arr = array('Status' => "Sorry this emailid is not registered with us!",'WebSiteUrl' => '','UserID' => '','UserEmailID' => '','RoleID' => '','UserName' => '');
		    echo json_encode($arr);
	}


?>
