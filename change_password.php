
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>1Book</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" href="css/passwordForm.css">
		<link rel="stylesheet" href="css/responsive.css">
		
		<!-- Validation start for change password -->
		<script language="javascript" type="text/javascript">
		function chpass_validation()
		{
			if(document.getElementById("cOldPass").value=="")
			{
			/*alert("Please enter password");*/
			document.getElementById('ChPassError').style.display = "block";
			document.getElementById("ChPassError").innerHTML = "Please enter old password.";
			document.getElementById("cOldPass").focus();
			return false;
			}
			if(document.getElementById("cNewpass").value=="")
			{
			/*alert("Please enter confirm password");*/
			document.getElementById('ChPassError').style.display = "block";
			document.getElementById("ChPassError").innerHTML = "Please enter new password.";
			document.getElementById("cNewpass").focus();
			return false;
			}
			if(document.getElementById("cConPass").value=="")
			{
			/*alert("Please enter confirm password");*/
			document.getElementById('ChPassError').style.display = "block";
			document.getElementById("ChPassError").innerHTML = "Please enter confirm password.";
			document.getElementById("cConPass").focus();
			return false;
			}
			if(document.getElementById("cNewpass").value!=document.getElementById("cConPass").value)
			{
			 /*alert("Password did not match! Try again");*/
			 document.getElementById('ChPassError').style.display = "block";
			 document.getElementById("ChPassError").innerHTML = "Password did not match! Try again.";
			 document.getElementById("cConPass").focus();
			 return false;
			}
			var decimal=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{4,14}$/;  
			if(document.getElementById("cConPass").value.match(decimal))   
			{   
			return true;  
			}  
			else  
			{   
			/*alert('Password must have at least one digit (0-9), one lowercase character (a-z), one uppercase character(A-Z) and one special character! It can have minimum 4 characters and maximum 14 characters.')*/
			document.getElementById('ChPassError').style.display = "block";
			document.getElementById("ChPassError").innerHTML = "Password must have at least one digit (0-9), one lowercase character (a-z), one uppercase character(A-Z) and one special character! It can have minimum 4 characters and maximum 14 characters.";
			return false;  
			}  
		}

		function ChPassErrorHide() 
		{
			document.getElementById('ChPassError').style.display = "none";
		}
		function ChPassHintShow() 
		{
		   document.getElementById('passhint').style.display='block';
		}
		function ChPassHintHide() 
		{
		   document.getElementById('passhint').style.display='none';
		}
		</script>
		
		<!-- Validation end for change password -->
		
		<!-- Code start for check the session -->
		<?php
		include "cs/config.php";
		//session_start();
		if(!isset($_COOKIE['useremailid']))
		{
			$WebSite_URL="location:".$SiteURL;
			header($WebSite_URL);
		}
		?>
		<!-- Code end for check the session -->

	</head>
	<body>
	<div class="mainWrap">
		
			<!-- Header Start Here -->
		   	<?php include_once('header.php');?>
		   	<!-- Header End Here -->
		
		<div class="col-xs-12 mtop20">
			<div class="footerWrap">
		<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
  <div class="modal-content">
      <div class="modal-header">
          <h2 class="text-center">Change Password</h2>
      </div>
      <div class="modal-body">
          <form method="post" class="form col-md-12 center-block" name="frmChangePass" id="frmChangePass" enctype="multipart/form-data" action="<?php $_PHP_SELF ?>">
            <div class="form-group">
              <input type="password" class="form-control input-lg" placeholder="Old Password" form="frmChangePass" name="cOldPass" id="cOldPass"
              onkeypress="return ChPassErrorHide();">
            </div>
			<div class="form-group">
              <input type="password" class="form-control input-lg" placeholder="New Password" form="frmChangePass" name="cNewpass" id="cNewpass"
              onfocus="ChPassHintShow()" onblur="ChPassHintHide()" onkeypress="return ChPassErrorHide();">
            </div>
            <div class="form-group">
              <input type="password" class="form-control input-lg" placeholder="Confirm Password" form="frmChangePass" name="cConPass" id="cConPass"
              onkeypress="return ChPassErrorHide();">
            </div>
            <div class="form-group" id="passhint" style="display:none;font-size: 12px;">
            	<div class="input-group">
            		Password should contain at least 8 characters, an upper case letter, a lowercase letter and a special character.
            	</div>
            </div>
            <div>
            	<span id="ChPassError" style="color:red;font-weight: bold"></span>
            </div>
            <span id="frmChangePassSub"></span>
            <div class="form-group">
              <!-- <button class="btn btn-warning btn-lg btn-block">Submit</button> -->
              <input type="submit" name="ChangePassbtn" id="ChangePassbtn" form="frmChangePass" class="btn btn-warning btn-lg btn-block" value="Submit"
              OnClick="return chpass_validation();">
            </div>
          </form>
      </div>
  </div>
  </div>
</div>
</div>
</div>
		
		     <!-- Footer Start Here -->
			 <?php include_once('footer.php');?>
			 <!-- Footer End Here -->

				
				

	</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="js/index.js"></script>
	</body>
</html>

<!-- Change Password Process Starts Here -->
<?php

if(isset($_POST['ChangePassbtn']))
{	
    include "cs/config.php";
	$userid = $_COOKIE['useremailid'];
	$oldpass = $_POST['cOldPass'];
	$newpass = $_POST['cNewpass'];
	$conpass = $_POST['cConPass'];
	
	$checkpass = mysqli_query($db, "call sp_update_password('','".$userid."','','','CHECK_PASSWORD')");
	$db->close();
	$rows = mysqli_fetch_assoc($checkpass);
	$fetchOldPass = $rows['password'];
	if($fetchOldPass==$oldpass)
	{	
		include "cs/config.php";
		$updatepass = mysqli_query($db,"call sp_update_password('','".$userid."','".$newpass."','".$oldpass."','CHANGE_PASSWORD')");
		$db->close();
		echo "<script>alert('Your password has been upadted successfully.')</script>";
	}
	else
	{
		echo "<script>
				document.getElementById('frmChangePassSub').innerHTML = '<p>You have entered incorrect old password..</p>';
			</script>";
	}


}

?>
<!-- Change Password Process Ends Here -->