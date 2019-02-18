<?php include "cs/config.php"; ?>
<link rel="stylesheet" href="<?php echo $SiteURL;?>css/style.css">
<link rel="stylesheet" href="<?php echo $SiteURL;?>css/login_register.css">
<!-- validation start for user registration-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script language="javascript" type="text/javascript">
function registration_validation()
{
	if(document.getElementById("uFName").value=="")
	{
	/*alert("Please enter your name");*/
	document.getElementById('u_FName').style.display = "initial";
	document.getElementById("u_FName").innerHTML = "Please enter your name";
	document.getElementById("uFName").focus();
	return false;
	}
	if(document.getElementById("uEmail").value=="")
	{
	/*alert("Please enter your email");*/
	document.getElementById('u_Email').style.display = "initial";
	document.getElementById("u_Email").innerHTML = "Please enter your email";
	document.getElementById("uEmail").focus();
	return false;
	}
	if(document.getElementById("uRegPassword").value=="")
	{
	/*alert("Please enter password");*/
	document.getElementById('u_RegPassword').style.display = "initial";
	document.getElementById("u_RegPassword").innerHTML = "Please enter password";
	document.getElementById("uRegPassword").focus();
	return false;
	}
	if(document.getElementById("uPassConfirm").value=="")
	{
	/*alert("Please enter confirm password");*/
	document.getElementById('u_PassConfirm').style.display = "initial";
	document.getElementById("u_PassConfirm").innerHTML = "Please enter confirm password";
	document.getElementById("uPassConfirm").focus();
	return false;
	}
	if(document.getElementById("uRegPassword").value!=document.getElementById("uPassConfirm").value)
	{
	 /*alert("Password did not match! Try again");*/
	 document.getElementById('u_PassConfirm').style.display = "initial";
	 document.getElementById("u_PassConfirm").innerHTML = "Password did not match! Try again";
	 document.getElementById("uPassConfirm").focus();
	 return false;
	}
	var decimal=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{4,14}$/;  
	if(document.getElementById("uPassConfirm").value.match(decimal))   
	{   
	return true;  
	}  
	else  
	{   
	/*alert('Password must have at least one digit (0-9), one lowercase character (a-z), one uppercase character(A-Z) and one special character! It can have minimum 4 characters and maximum 14 characters.')*/
	document.getElementById('u_RegPassword').style.display = "initial";
	document.getElementById("u_RegPassword").innerHTML = "Password does not meet requirements";
	return false;  
	}  
}
/* validation end for user registration */
/* validation start for login */
function signin_validation()
{
	var fm2 = document.form2;
	if(fm2.uLogin.value=="")
	{
	/*alert("Please enter your email");*/
	document.getElementById('u_Login').style.display = "initial";
	document.getElementById("u_Login").innerHTML = "Please enter your email";
	fm2.uLogin.focus();
	return false;
	}
	if(fm2.uPassword.value=="")
	{
	/*alert("Please enter your password");*/
	document.getElementById('u_Password').style.display = "initial";
	document.getElementById("u_Password").innerHTML = "Please enter your password";
	fm2.uPassword.focus();
	return false;
	}
}
/* validation end for login */
/* validation start for forgot password */
function forgot_validation()
{
	var fm2 = document.form3;
	if(fm2.fpEmail.value=="")
	{
	/*alert("Please enter your email");*/
	document.getElementById('fp_Email').style.display = "initial";
	document.getElementById("fp_Email").innerHTML = "Please enter your email";
	fm2.fpEmail.focus();
	return false;
	}
}
/* validation end for forgot password */ 
/* validation start for reset password */
function change_pwd_validation()
{
	if(document.getElementById("uResetEmail").value=="")
	{
	/*alert("Please enter your email");*/
	document.getElementById('ResetError').style.display = "block";
	document.getElementById("ResetError").innerHTML = "Please enter your email.";
	document.getElementById("uResetEmail").focus();
	return false;
	}
	if(document.getElementById("uResetOldPassword").value=="")
	{
	/*alert("Please enter old password");*/
	document.getElementById('ResetError').style.display = "block";
	document.getElementById("ResetError").innerHTML = "Please enter old password.";
	document.getElementById("uResetOldPassword").focus();
	return false;
	}
	if(document.getElementById("uResetNewPassword").value=="")
	{
	/*alert("Please enter new password");*/
	document.getElementById('ResetError').style.display = "block";
	document.getElementById("ResetError").innerHTML = "Please enter new password.";
	document.getElementById("uResetNewPassword").focus();
	return false;
	}
	if(document.getElementById("uResetConPassword").value=="")
	{
	/*alert("Please enter confirm password");*/
	document.getElementById('ResetError').style.display = "block";
	document.getElementById("ResetError").innerHTML = "Please enter confirm password.";
	document.getElementById("uResetConPassword").focus();
	return false;
	}
	if(document.getElementById("uResetNewPassword").value!=document.getElementById("uResetConPassword").value)
	{
	 /*alert("Password did not match! Try again");*/
	 document.getElementById('ResetError').style.display = "block";
	 document.getElementById("ResetError").innerHTML = "Password did not match! Try again.";
	 document.getElementById("uResetConPassword").focus();
	 return false;
	}
	var decimal=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{4,14}$/;  
	if(document.getElementById("uResetNewPassword").value.match(decimal))   
	{   
	return true;  
	}  
	else  
	{   
	/*alert('Password must have at least one digit (0-9), one lowercase character (a-z), one uppercase character(A-Z) and one special character! It can have minimum 4 characters and maximum 14 characters.')*/
	document.getElementById('ErrorMsg').style.display = "block";  
	document.getElementById("ResetError").innerHTML = "Password does not meet requirements";
	return false;  
	}  
}
/* validation end for reset password */

function PwdMsgShow() {
   document.getElementById('pwdmsgid').style.display='block';
}
function PwdMsgHide() {
   document.getElementById('pwdmsgid').style.display='none';
}
function PwdMsgResetShow() {
   document.getElementById('pwdmsgresetid').style.display='block';
}
function PwdMsgResetHide() {
   document.getElementById('pwdmsgresetid').style.display='none';
}

function ErrorMsgHide() 
{
	document.getElementById('ErrorMsg').style.display = "none";
}
function ResetHide() 
{
	document.getElementById('ResetError').style.display = "none";
}
function errorMsgHide(hideId)
{
	document.getElementById(hideId).style.display = "none";
} 
</script>

<script>
	$(document).ready(function(){
		$("#uEmail").change(function(){
			var u_email = $("#uEmail").val();
			$.post("CheckMail.php",{email:u_email},function(data){
				$("#email_status").html(data);
			});
		});
	});
</script>

<?php 
	include "cs/config.php";
	session_start();
	/*Code start for user registration*/
	if(isset($_POST['register']))
	{
		$User_Name = mysqli_real_escape_string($db,$_POST['uFName']);
		$User_Email = mysqli_real_escape_string($db,$_POST['uEmail']);
		$User_Password = mysqli_real_escape_string($db,$_POST['uRegPassword']);
		$User_ConPassword = mysqli_real_escape_string($db,$_POST['uPassConfirm']);
		$UserType="1";
		$RoleId="1";
		$status='T';
		$regis_type='SELF';
		$resultds = mysqli_query($db,"call sp_user_registration('','".$User_Email."','".$User_Name."','".$User_Name."','".$User_Password."','".$UserType."','".$RoleId."','".$status."','".$regis_type."','','','INSERT_REGISTRATION',@resultmsg,@errormsg)") or die('Query Not execute'.mysqli_error($db));
		$db->close();	
		if (mysqli_num_rows($resultds) > 0) {
			 while($row = mysqli_fetch_array($resultds)) {
			     $result= $row['resultval'];
			     $IsError= $row['IsErrorval'];
			 }
			 mysqli_free_result($resultds);
		}
		
		if ($result=="INSERT")
		{
		   //echo "<script>alert('You have been successfully registered !')</script>"; 
		   $submitResult='<div class="alert alert-success" style="text-align:center;font-weight: bold">You have been successfully registered.</div>';
		}
		if ($result=="EXIST")
		{
		    /*echo "<script>alert('Your email ID have already registered.')</script>";*/
		    $submitResult='<div class="alert alert-danger" style="text-align:center;font-weight: bold">Your email ID have already registered.</div>';
		}
		// if($IsError="1")
		// {
		  // // echo  $IsError;
		   // //echo "<script>alert('An error occurred Please try again!')</script>";
		// }

			//Mailing process to registered user
			// if($result)
			// {	
				// require 'PHPMailer/PHPMailerAutoload.php';
				// $mail = new PHPMailer;
				// $mail->isSMTP();                                   // Set mailer to use SMTP
				// $mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
				// $mail->SMTPAuth = true;                            // Enable SMTP authentication
				// $mail->Username = '1book4c@gmail.com';          // SMTP username
				// $mail->Password = '1book@123'; // SMTP password
				// $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
				// $mail->Port = 587;                                 // TCP port to connect to

				// $mail->setFrom('1book4c@gmail.com', '1Book');
				// $mail->addReplyTo('1book4c@gmail.com', '1Book');
				// $mail->addAddress($User_Email);   
				// // Add a recipient
				// //$mail->addCC('cc@example.com');
				// //$mail->addBCC('bcc@example.com');

				// $mail->isHTML(true);  // Set email format to HTML

				// $bodyContent = "<p>Dear ".$User_Name.",</p>";
				// $bodyContent .= "<p>It's good to study</p>";
				// $bodyContent .= "<p>Now Access books and notes on the move.</p>";
				// $bodyContent .= "<p>You have created an account on 1Book portal. Your username is: '".$User_Email."'.
				// To verify your email ID <a href='".$SiteURL."account_activation.php?email=".$User_Email."'>click here</a></p>";
				// $bodyContent .= "<p>If the link above does not appear clickable or does not open a browser window when you click it, copy the undermentioned link and paste in your web browser:</p>";
				// $bodyContent .= "<p>".$SiteURL."account_activation.php?email=".$User_Email."</p>";
				// $bodyContent .= "<p>You can now access following on the portal:</p>";
				// $bodyContent .= "<p>1.Books and Notes of your Educator</p>";
				// $bodyContent .= "<p>2.Save up to 70% by studying on 1Book</p>";
				// $bodyContent .= "<p>Please ignore this mail, if you did not register at 1Book portal.</p>";
				// $bodyContent .= "<p>To access the 1Book portal, Please visit https://www.1Book.in</p>";
				// $bodyContent .= "<p>Sincerely</p>";
				// $bodyContent .= "<p>1Book Team</p>";
				// $bodyContent .= "<p><h5>Do not reply to this email.</h5></p>";
				// $bodyContent .= "<p><h5>Please do not reply directly to this email. The email is sent from a service that is unable to receive emails.</h5></p>";

				// $mail->Subject = '1Book - Account Activation';
				// $mail->Body = $bodyContent;

				// if(!$mail->send()) 
				// {
				    // //echo "<script>alert('Message could not be sent.')</script>";
				    // //echo 'Mailer Error: ' . $mail->ErrorInfo;
					// echo "<script>alert('You have been successfully registered')";
				// } 
				// else 
				// {
					// echo "<script>alert('You have been successfully registered')";
				    // //echo "<script>alert('You have been successfully registered,Please verify it by clicking the activation link that has been send to your email')</script>";
				// }

				// //require_once('nomad_mimemail.inc.php');
				// //$mimemail = new nomad_mimemail();
				// ////$smtp_host = "119.82.71.30"; // Change Value
				// //$smtp_host = "192.168.1.30"; // Change Value
				// //$smtp_user = "4cplus";  // Change Value
				// //$smtp_pass = "4321";  // Change Value
				// //$cc_email="reena@4cplus.com";
				// //$bcc_email="reenasingh2011@gmail.com";
				// //$to = $User_Email;
				// //$subject="Account Activation";
				// //$from = "robintyagi289@gmail.com";
				// //$body = "This is the email to activate your account.\n";
				// //$body.="Click the following link to activate your account.\n";
				// //$body.="<a href='account_activation.php?email=$User_Email'>Click here</a>";
				
				// //$mimemail->set_from($from);
				// //$mimemail->set_to($to);
				// //$mimemail->set_cc($cc_email);
				// //$mimemail->set_bcc($bcc_email);
				// //$mimemail->set_subject($subject);
				// //$mimemail->set_html($body);
				// //$mimemail->set_smtp_host($smtp_host, 25);
				// //$mimemail->set_smtp_auth($smtp_user, $smtp_pass);
				// //$mimemail->send();

				// //echo "<script>alert('You have been successfully registered,Please verify it by clicking the activation link that has been send to your email')</script>";

				// //$mail = mail($to,$mail_subject,$mail_body,$header);
				// //if($mail)
				// //{
					// //echo "<script>alert('You have been successfully registered,Please verify it by clicking the activation link that has been send to your email')</script>";
				// //}
			// }
	}
	
	/*Code end for user registration*/
	
    /*Code start for user login*/
	if(isset($_POST['signin']))
	{
	    include "cs/config.php";
	    $UserEmail = mysqli_real_escape_string($db,$_POST['uLogin']);
	   	$UserPassword = mysqli_real_escape_string($db,$_POST['uPassword']);
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
			$_SESSION['userid'] = $UEmail;
			$_SESSION['roleid'] = $URoleId;
			$_SESSION['username'] = $UName;
			$_SESSION['user_id'] = $UId;
			if ($URoleId=="1")
			{
			    $WebSite_URL="location:".$SiteURL;
			    header($WebSite_URL);
			} 
			if ($URoleId=="2" || $URoleId=="3")
			{
			    $WebSite_URL="location:".$SiteURL."modify_booknotes.html";
			    header($WebSite_URL);
			} 
		 }
		}
		else
		{
			echo "<script>alert('You have not registered!')</script>";
		}
	}
	/*Code end for user login*/
	
  /*Code start for reset password*/
	if(isset($_POST['resetbtn']))
	{
		include "cs/config.php";
	    $UserREmail = $_POST['uResetEmail'];
		$UserOldPassword = $_POST['uResetOldPassword'];
		$UserNewPassword = $_POST['uResetNewPassword'];
		$UserConPassword = $_POST['uResetConPassword'];
		$resultreset = mysqli_query($db,"call sp_update_password('','".$UserREmail."','".$UserNewPassword."','".$UserOldPassword."','RESET_PASSWORD')");
		$db->close();
		if($resultreset)
	    {
		   echo "<script>alert('Your password reset successfully!')</script>";
		}
		else
		{
			echo "<script>alert('Try Again!')</script>";
		}
	}
	/*Code end for reset password*/
	
   /*Code start for forgot password*/
  if(isset($_POST['fpSubmit']))
  {		
  		$fpemail = mysqli_real_escape_string($db,$_POST['fpEmail']);
		include ("cs/config.php");
		$r = mysqli_query($db,"call sp_update_password('','".$fpemail."','','','CHECKUSER')");
		$db->close();
	    if(mysqli_num_rows($r)>0)
	    {
		$rows = mysqli_fetch_assoc($r);
		$name = $rows['first_name'];
		$email = $rows['billing_Email'];
		require 'PHPMailer/PHPMailerAutoload.php';

		$mail = new PHPMailer;
		$mail->isSMTP();                                   // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                            // Enable SMTP authentication
		$mail->Username = '1book4c@gmail.com';          // SMTP username
		$mail->Password = '1book@123'; 					// SMTP password
		$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;    
		$mail->CharSet="UTF-8";
		// TCP port to connect to

		$mail->setFrom('1book4c@gmail.com', '1Book');
		$mail->addReplyTo('1book4c@gmail.com', '1Book');
		$mail->addAddress($email);   
		$mail->AddEmbeddedImage('img/1book_logo.png','1book_logo');
		// Add a recipient
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');
		$mail->isHTML(true);  // Set email format to HTML
		$randString= md5($email);
		$htmlmsg = '
			<html>
			<body>
			<p>Dear '.$name.',</p>				
			<p>We got a request to reset your <span style="color:#EF7F1B">1Book</span> password for username: '.$name.'.</p>
			<p>Click on the link to Reset Password:<br>
				<a href="'.$SiteURL.'reset_password.php?id=$email">Reset Password</a></p>
			<p>Alternatively, you may copy and paste the link given below in your internet account browser and rest your password.<br>
				<a href="'.$SiteURL.'reset_password.php?id='.$email.'">'.$SiteURL.'reset_password.php?'.$randString.'</a>
			</p>
			<p>If you weren’t trying to reset your password, don’t worry — your account is still secure, and no one has been given access to it.</p>
			<p>Sincerely<br>
				<span style="color:#EF7F1B">1Book</span> Team</p>
				<img src="cid:1book_logo" alt="1Book">
			</html>
			</body>';
		$bodyContent =  $htmlmsg;
		$mail->Subject = '1Book- Reset Password';
		$mail->Body = $bodyContent;
		if(!$mail->send()) 
		{
			//echo "Mailer Error: " . $mail->ErrorInfo;
		 	echo "<script>alert('Mail delivery failed.')</script>";

		} 
		else 
		{
		 	echo "<script>alert('Password reset mail has been sent successfully, Kindly check your email.')</script>";
		}
	   }
	    else
		{
			echo "<script>alert('This email ID does not exist.')</script>";
		}
  }
	/*Code end for forgot password*/
 ?>

            <div class="navbar-fixed-top">
				<nav class="navbar navbar-default headNav">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#oneBookNav">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							</button>
							<div class="headCart visible-xs">
								<div class="divider1 hidden-xs"></div>
								<a href="#"><span class="fa fa-shopping-cart cartIcon" aria-hidden="true"></span></a>
							</div>
							<a class="navbar-brand headLogo" href="<?php echo $SiteURL;?>"><img src="<?php echo $SiteURL;?>img/logo.png" alt="Logo" /></a>
						</div>
						<div class="headCart hidden-xs">
							<div class="divider1"></div>
							<a href="#"><span class="fa fa-shopping-cart cartIcon" aria-hidden="true"></span></a>
						</div>
						<div class="collapse navbar-collapse" id="oneBookNav">
							<ul class="nav navbar-nav navbar-right">
								
								<?php 
								$path = $_SERVER['PHP_SELF']; // will return http://xyz.com/two.php for our example
								$page = basename($path); // will return two.php
								$page = basename($path, '.php'); 
								if($_SESSION['userid']!="")
								{ 
									 $UserName=$_SESSION['username'];
									 if($_SESSION['roleid']=="1")
								     {
										  ?>
										 <li><a class="<?php echo ($page == "bookshelf" ? "active" : "")?>" href="<?php echo $SiteURL;?>bookshelf.html">Bookstore</a></li>
										 <?php 
										  ?>
										  <li><a class="<?php echo ($page == "mybookshelf" ? "active" : "")?>" href="<?php echo $SiteURL;?>mybookshelf.html">My Dashboard</a></li>
										  <?php 
									 }
									 else if($_SESSION['roleid']=="2" || $_SESSION['roleid']=="3")
									 {
										?>
										  <li><a class="<?php echo ($page == "mybookshelf" ? "active" : "")?>" href="modify_booknotes.html">My Dashboard</a></li>
										  <?php 
									 }
								     ?> 
									 <li><a class="<?php echo ($page == "features" ? "active" : "")?>" href="<?php echo $SiteURL;?>features.html">Features</a></li>
									  <li><a href="#"><?php echo $UserName ?></a></li>
									  <li><a href="<?php echo $SiteURL;?>logout.php">Logout</a></li>
							         <?php 
					             } 
								 else
								 {
								 ?>
								  <li><a class="<?php echo ($page == "bookshelf" ? "active" : "")?>" href="bookshelf.html">Bookstore</a></li>
								  <li><a class="<?php echo ($page == "features" ? "active" : "")?>" href="features.html">Features</a></li>
								  <li><a href="#" data-toggle="modal" data-target="#loginModal" data-keyboard="true">Login</a></li>
								  <li><a href="#" data-toggle="modal" data-target="#registerModal" data-keyboard="true">Register</a></li>
								 <?php
								  }
								?>
								
							</ul>
						</div>
					</div>
				</nav>
			</div>

				<!-- Login modal -->
				<div class="modal fade logModCSS" id="loginModal" role="dialog" tabindex='-1'>
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
								<h4 class="modal-title" id="loginModalLabel">Log in</h4>
							</div>
							<div class="modal-body">
								<div class="text-center mbottom20">
									<img src="img/logo_login.png" alt="1Book Logo" class="loginLogo"/>
								</div>
								<form method="post" id="form2" name="form2" enctype="multipart/form-data" action= "<?php $_PHP_SELF ?>">
									<div class="form-group">
										<div class="input-group">
											<input type="email" class="form-control" id="uLogin" name="uLogin" form="form2" placeholder="Login" onkeypress='return errorMsgHide("u_Login")'>
											<label for="uLogin" class="input-group-addon glyphicon glyphicon-user"></label>
										</div>
										<span id="u_Login" class="label label-danger"></span>
									</div>
									<div class="form-group">
										<div class="input-group">
											<input type="password" class="form-control" id="uPassword" name="uPassword" form="form2" placeholder="Password" onkeypress='return errorMsgHide("u_Password")'>
											<label for="uPassword" class="input-group-addon glyphicon glyphicon-lock"></label>
										</div>
										<span id="u_Password" class="label label-danger"></span>
									</div>
									<div class="checkbox" style="display:none;">
										<label>
										<input type="checkbox"> Remember me
										</label>
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<!--<button class="form-control btn btn-warning loginmodal-submit">Sign in</button>-->
								<input type="submit" form="form2" id="signin" name="signin" value="Sign in" class="form-control btn btn-warning loginmodal-submit" OnClick="return signin_validation();" />
								<div class="login-help">
									<a href="#" data-toggle="modal" data-dismiss="modal" data-target="#forgotPassModal">Forgot Password?</a>
								</div>
								<div class="modDivider"></div>
								<div class="text-center">
									<a href="#" class="modFB hvr-bounce-in"><i class="fa fa-facebook" aria-hidden="true"></i></a>
									<a href="#" class="modGP hvr-bounce-in"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
								</div>
								<div class="newUser">
									<a href="#" data-toggle="modal" data-dismiss="modal" data-target="#registerModal">New User ? Sign Up</a>
								</div>
								<div class="login-help">
									<a href="#" data-dismiss="modal" aria-hidden="true">Skip</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Login modal -->

				<!-- Register modal -->
				<div class="modal fade logModCSS" id="registerModal" role="dialog" tabindex='-1' data-backdrop="static">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
								<h4 class="modal-title" id="regModalLabel">Register</h4>
							</div>
							<div class="modal-body">
								<div class="text-center mbottom20">
									<img src="img/logo_login.png" alt="1Book Logo" class="loginLogo"/>
								</div>
								<form method="post" id="form1" name="form1" enctype="multipart/form-data" action="<?php $_PHP_SELF ?>">
									<div class="form-group">
										<div class="input-group">
											<input type="text" class="form-control" id="uFName" name="uFName" placeholder="Full Name" onkeypress='return errorMsgHide("u_FName")'>
											<label for="uFName" class="input-group-addon glyphicon glyphicon-user"></label>
										</div>
										<span id="u_FName" class="label label-danger"></span>
									</div>
									<div class="form-group">
										<div class="input-group">
											<input type="email" class="form-control" id="uEmail" name="uEmail" placeholder="E-mail"
											onkeypress='return errorMsgHide("u_Email")'>
											<label for="uEmail" class="input-group-addon fa fa-at emailAt" aria-hidden="true"></label>
										</div>
										<span id="email_status"></span>
										<span id="u_Email" class="label label-danger"></span>
									</div>
									<div class="form-group">
										<div class="input-group">
											<input type="password" class="form-control" id="uRegPassword" name="uRegPassword" placeholder="Password" onfocus="PwdMsgShow()" onblur="PwdMsgHide()" onkeypress='return errorMsgHide("u_RegPassword")'>
											<label for="uRegPassword" class="input-group-addon glyphicon glyphicon-lock"></label>
										</div>
										<span id="u_RegPassword" class="label label-danger"></span>
									</div>
									<div class="form-group">
										<div class="input-group">
											<input type="password" class="form-control" id="uPassConfirm" name="uPassConfirm" placeholder="Confirm Password" onkeypress='return errorMsgHide("u_PassConfirm")'>
											<label for="uPassConfirm" class="input-group-addon glyphicon glyphicon-lock"></label>
										</div>
										<span id="u_PassConfirm" class="label label-danger"></span>
									</div>
									<div class="form-group" id="pwdmsgid" style="display:none;font-size: 12px;">
										<div class="input-group">
											Password should contain at least 8 characters, an upper case letter, a lowercase letter and a special character.
										</div>
									</div>	
									<div class="form-group">
										<div>
											<?php echo $submitResult; ?>	
										</div>
									</div>
								</form>
							</div>
							
							<div class="modal-footer">
								<!--<button class="form-control btn btn-warning loginmodal-submit">Register</button>-->
								<input type="submit" class="form-control btn btn-warning loginmodal-submit" id="register" form="form1" name="register" value="Register" OnClick="return registration_validation();" />
								<div class="modDivider"></div>
								<div class="text-center">
									<a href="#" class="modFB hvr-bounce-in"><i class="fa fa-facebook" aria-hidden="true"></i></a>
									<a href="#" class="modGP hvr-bounce-in"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
								</div>
								<div class="newUser">
									<a href="#" data-toggle="modal" data-dismiss="modal" data-target="#loginModal">Existing User ? Sign in</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- / Register modal -->

				<!-- Forgot Password modal -->
				<div class="modal fade logModCSS" id="forgotPassModal" role="dialog" data-backdrop="static">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
								<h4 class="modal-title" id="fpModalLabel">Forgot Password</h4>
							</div>
							<div class="modal-body">
								<div class="text-center mbottom20">
									<img src="img/logo_login.png" alt="1Book Logo" class="loginLogo"/>
								</div>
								<div class="fpText">Enter your email address, and we'll send you a password reset email.</div>
								<form method="post" id="form3" name="form3" action="<?php $_PHP_SELF ?>">
									<div class="form-group">
										<div class="input-group">
											<input type="email" class="form-control" id="fpEmail" placeholder="E-mail" name="fpEmail" onkeypress='return errorMsgHide("fp_Email")'>
											<label for="fpEmail" class="input-group-addon fa fa-at emailAt" aria-hidden="true"></label>
										</div>
										<span id="fp_Email" class="label label-danger"></span>
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<!-- <button class="form-control btn btn-warning loginmodal-submit">Submit</button> -->
								<input type="submit" name="fpSubmit" value="Submit" class="form-control btn btn-warning loginmodal-submit" form="form3" onclick="return forgot_validation();" />
								<div class="modDivider"></div>
								<div class="text-center">
									<a href="#" class="modFB hvr-bounce-in"><i class="fa fa-facebook" aria-hidden="true"></i></a>
									<a href="#" class="modGP hvr-bounce-in"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
								</div>
								<div class="newUser">
									<a href="#" data-toggle="modal" data-dismiss="modal" data-target="#loginModal"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to login</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- / Forgot Password modal -->

