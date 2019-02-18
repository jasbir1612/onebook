<?php
// Code start for activate enduser account //
include('cs/config.php');
include('cs/common.php');
if(isset($_GET['email']))
{
    $email = $_GET['email'];
    // if (!strlen($_SERVER['QUERY_STRING']) )
	// {
		// exit ();
	// }
	// else
	// {
	   // echo $email = $_SERVER['QUERY_STRING'];
	// }
	 $Decrypt_email=safe_b64decode($email);
	 $email=$Decrypt_email;
	 $email=trim($email);
	 $status = "T";

	 $qryds = mysqli_query($db,"call sp_update_common('','".$email."','','','','','','','".$status."','','','','','','','','','','','ACTIVE_ACCOUNT',@resultmsg,@errormsg)") or die('Query Not execute'.mysqli_error($db));
	 $db->close();
	 if (mysqli_num_rows($qryds) > 0) 
	 {
	 while($row = mysqli_fetch_array($qryds)) {
		$result= $row['resultval'];
		$IsError= $row['IsErrorval'];
	 }
	  mysqli_free_result($qryds);
	 }
	 
	 if ($result=="ACTIVE")
	 {
		echo "<script>
		alert('Your account has been activated successfully.');
		window.location.href='index.html';
		</script>";
	 }
	 else
	 {
	    exit ();
	    // echo "<script>
		// alert('Your account has not been activated. Try Again');
		// window.location.href='index.html';
		// </script>";
	 }

	 //echo $query = "update subscriber_master set status= '$status' where billing_Email= '$email';";
	 //$run = mysqli_query($db,$query);

	// if($run)
	// {
		 //echo "<script>
		 //alert('Your account has been activated successfully.');
		 //window.location.href='index.html';
		 //</script>";
		
		 // // $WebSite_URL="location:".$SiteURL;
	     // // header($WebSite_URL);
	// }	
}

// Code end for activate enduser account //
?>