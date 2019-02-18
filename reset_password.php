<!DOCTYPE html>
<?php ob_start(); ?>
<?php require_once "cs/config.php"; ?>
<html lang="en">
	<head>
		<title>1Book : Digital Solutions for Students, Educators and Publishers</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="<?php echo $SiteURL;?>img/fevicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" href="css/passwordForm.css">
		<link rel="stylesheet" href="css/responsive.css">
		
		<!-- Validation start for reset password  -->
		<script language="javascript" type="text/javascript">
		function reset_validation()
		{
			if(document.getElementById("rResPass").value=="")
			{
			/*alert("Please enter password");*/
			document.getElementById('ResError').style.display = "block";
			document.getElementById("ResError").innerHTML = "Please enter password.";
			document.getElementById("rResPass").focus();
			return false;
			}
			if(document.getElementById("rConPass").value=="")
			{
			/*alert("Please enter confirm password");*/
			document.getElementById('ResError').style.display = "block";
			document.getElementById("ResError").innerHTML = "Please enter confirm password.";
			document.getElementById("rConPass").focus();
			return false;
			}
			if(document.getElementById("rResPass").value!=document.getElementById("rConPass").value)
			{
			 /*alert("Password did not match! Try again");*/
			 document.getElementById('ResError').style.display = "block";
			 document.getElementById("ResError").innerHTML = "Password did not match! Try again.";
			 document.getElementById("rConPass").focus();
			 return false;
			}
			var decimal=  /^.{8,25}$/; 
			if(document.getElementById("rConPass").value.match(decimal))   
			{   
			  return true;  
			}  
			else  
			{   
			/*alert('Password must have at least one digit (0-9), one lowercase character (a-z), one uppercase character(A-Z) and one special character! It can have minimum 4 characters and maximum 14 characters.')*/
			document.getElementById('ResError').style.display = "block";
			document.getElementById("ResError").innerHTML = "Password should contain at least 8 characters.";
			return false;  
			}  
		}

		function ResetErrorHide() 
		{
		   document.getElementById('ResError').style.display = "none";
		}
		
		function PwdMsgShow() {
	      document.getElementById('pwdmsgid').style.display='block';
		}
		function PwdMsgHide() {
		   document.getElementById('pwdmsgid').style.display='none';
		}
		</script>
		
		<!-- Validation end for reset password  -->
		
		
		<!-- Code start for update the password -->
		<?php
		include "cs/config.php";
		if(isset($_POST['rSubmit']))
		{
			$billingEmail = $_GET['id'];
			$resPass = $_POST['rResPass'];
			$resetQuery = mysqli_query($db,"call sp_update_password('','".$billingEmail."','".$resPass."','','RESET_PASSWORD')");
			$db->close();
			//echo "<script>alert('Your password has been reset successfully!')</script>";
			$WebSite_URL="location:".$SiteURL;
			//header($WebSite_URL);
			echo '<script type="text/javascript">'; 
			echo 'alert("Your password has been reset successfully!");'; 
			echo 'window.location.href = "index.html";';
			echo '</script>';
		}
		?>
		<!-- Code end for update the password -->

	</head>
	<body>
	<div class="mainWrap">
	
	    <!-- Header Start Here -->
	   <?php include_once('header.php');?>
	   <!-- Header End Here -->

	
		<!--<div class="col-xs-12 mtop20">
			<div class="footerWrap">
		<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-md">
	  <div class="modal-content">
      <div class="modal-header">
          <h2 class="text-center">Reset Password</h2>
      </div>
      <div class="modal fade">
          <form class="form col-md-12 center-block" name="frmReset" id="frmReset">
            <div class="form-group">
              <input type="password" class="form-control input-lg" placeholder="Password" name="rResPass" id="rResPass" onkeypress="return ResetErrorHide();" onfocus="ResMsgShow()" onblur="ResMsgHide()">
            </div>
            <div class="form-group">
              <input type="password" class="form-control input-lg" placeholder="Confirm Password" name="rConPass" id="rConPass" onkeypress="return ResetErrorHide();">
            </div>
            <div class="form-group" id="passmsg" style="display:none;font-size: 12px;">
            	<div class="input-group">
            		Password should contain at least 8 characters, an upper case letter, a lowercase letter and a special character.
            	</div>
            </div>
            <div>
            	<span id="ResError" style="color:red;font-weight: bold"></span>
            </div>
            <div class="form-group">
             
              <input type="submit" class="btn btn-warning btn-lg btn-block" value="Reset" name="rSubmit" id="rSubmit" OnClick="return reset_validation();" >
            </div>
          </form>
      </div>
	  </div>
	  </div>
	</div>
	</div>
	</div>-->
	
	<div class="col-xs-12 mtop20 respMargin0 rpswd">
		<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
  <div class="modal-content">
      <div class="modal-header">
          <h2 class="text-center">Reset Password</h2>
      </div>
      <div class="modal-body">
          <form class="form col-md-12 center-block" method="post" name="frmReset" id="frmReset" enctype="multipart/form-data" action= "<?php $_PHP_SELF ?>">
            <div class="form-group">
			   <input type="password" class="form-control input-lg" placeholder="Password" name="rResPass" id="rResPass" onkeypress="return ResetErrorHide();">
            </div>
            <div class="form-group">
			   <input type="password" class="form-control input-lg" placeholder="Confirm Password" name="rConPass" id="rConPass" onkeypress="return ResetErrorHide();">
            </div>
			 <div>
            	<span id="ResError" style="color:red;font-weight: norwal"></span>
            </div>
			</div>	
            <div class="form-group">
			  <input type="submit" class="btn btn-warning btn-lg btn-block" value="Reset" name="rSubmit" id="rSubmit" form="frmReset" OnClick="return reset_validation();" >
            </div>
          </form>
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
<?php ob_end_flush(); ?>
