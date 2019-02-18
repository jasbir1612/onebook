
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
<?php
    include "cs/config.php";
	$uemail = $_POST['email'];
	$run = mysqli_query($db,"call sp_user_registration('0','".$uemail."','','1','1','','','','','','','CHECK_REGISTRATION',@resultmsg,@errormsg)") or die('Query Not execute Try Again'.mysqli_error($db));
		$db->close();	
	if (mysqli_num_rows($run) > 0) {
			 while($row = mysqli_fetch_array($run)) {
			     $result= $row['resultval'];
			     $IsError= $row['IsErrorval'];
			 }
			 mysqli_free_result($resultds);
		}
	if($result=="EXIST")
	{
		echo "<p style='color:red;text-align:left'><i class='fa fa-times-circle fa-lg' aria-hidden='true'></i>&nbsp;Email already in use</p>";
	}
	else
	{
		echo "<p style='color:green;text-align:left'><i class='fa fa-check-circle fa-lg' aria-hidden='true'></i>&nbsp;Email is Available</p>";
	}
?>