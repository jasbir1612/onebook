<?php 
$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') 
                === FALSE ? 'http' : 'https';
$host     = $_SERVER['HTTP_HOST'];
$script   = $_SERVER['SCRIPT_NAME'];
$params   = $_SERVER['QUERY_STRING'];
$currentUrl = $protocol . '://' . $host . $script . '?' . $params;
$currentUrl;
?>

<?php 
error_reporting(0);
// $headers = apache_request_headers();
// //print_r($headers);
// $timestamp = time();
// $tsstring = gmdate('D, d M Y H:i:s ', $timestamp) . 'GMT';
// $etag = md5($timestamp);
// header("Last-Modified: $tsstring");
// header("ETag: \"{$etag}\"");
// header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + 7200).'');

include "cs/config.php"; ?>
<link rel="stylesheet" href="<?php echo $SiteURL;?>css/style.css">
<link rel="stylesheet" href="<?php echo $SiteURL;?>css/login_register.css">
<link rel="stylesheet" href="<?php echo $SiteURL;?>css/common.css">
<link rel="stylesheet" href="<?php echo $SiteURL;?>css/component.css" />
<!-- validation start for user registration-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Validation start for search books/notes -->
	<script language="javascript" type="text/javascript">
	function searchvalidation()
	{
		if(document.getElementById("srchtext").value=="")
		{
		    window.location="bookshelf.html";
			//document.getElementById('srch_error').style.display = "initial";
			//document.getElementById("srch_error").innerHTML = "Please enter any search keyword";
			//document.getElementById("srchtext").focus();
			return false;
		}
	}
	function srchErrorHide(hideId)
	{
		document.getElementById(hideId).style.display = "none";
	} 
	</script>
	
	<script  language="javascript" type="text/javascript">
		function srchEnter()
		{
			document.getElementById('srchtext').onkeypress=function(e)
			{
			    if(e.keyCode==13)
			    {
			        document.getElementById('searchbtn').click();
			        return false;
			    }
			}
		}
	</script>
	<!-- Validation end for search books/notes -->

	<!-- Code start for search books/notes -->
	<?php
		include "cs/config.php";
		if(isset($_POST['searchbtn']))
		{
			$srchtextval=$_POST['srchtext'];
			if($srchtextval!="")
			{
			 $path= "location:".$SiteURL."bookshelf_search.php?search=".$srchtextval."";
		     header($path);
			}
			else
			{
			  header("location:bookshelf.html");
			}
		}
		
	    if (isset($_GET['search']) && count($_GET) > 0 ) 
	    { 
	        $searchedval=$_GET['search'];
	    }
		else
		{
		    $searchedval="";
		}
	   
	 ?> 
	 <!-- Code end for search books/notes -->
	 
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
	var decimal=  /^.{8,25}$/;  
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
	//var fm2 = document.form2;
	if(document.getElementById("uLogin").value=="" && document.getElementById("uPassword").value=="")
	{
	/*alert("Please enter your email");*/
	document.getElementById('u_Login').style.display = "initial";
	document.getElementById("u_Login").innerHTML = "Please enter your email";
	document.getElementById('u_Password').style.display = "initial";
	document.getElementById("u_Password").innerHTML = "Please enter your password";
	//fm2.uLogin.focus();
	document.getElementById("uLogin").focus();
	return false;
	}
	else if(document.getElementById("uLogin").value=="")
	{
	/*alert("Please enter your email");*/
	document.getElementById('u_Login').style.display = "initial";
	document.getElementById("u_Login").innerHTML = "Please enter your email";
	document.getElementById('u_Password').style.display = "none";
	//fm2.uLogin.focus();
	document.getElementById("uLogin").focus();
	return false;
	}
	else if(document.getElementById("uPassword").value=="")
	{
	/*alert("Please enter your password");*/
	document.getElementById('u_Password').style.display = "initial";
	document.getElementById("u_Password").innerHTML = "Please enter your password";
	document.getElementById('u_Login').style.display = "none";
	//fm2.uPassword.focus();
	document.getElementById("uPassword").focus();
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
	var decimal=  /^.{8,25}$/;  
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
	//session_start();
	/*Code start for user registration*/
	if(isset($_POST['register']))
	{
		$User_Name = mysqli_real_escape_string($db,$_POST['uFName']);
		$User_Email = mysqli_real_escape_string($db,$_POST['uEmail']);
		$User_Password = mysqli_real_escape_string($db,$_POST['uRegPassword']);
		$User_ConPassword = mysqli_real_escape_string($db,$_POST['uPassConfirm']);
		$UserType="1";
		$RoleId="1";
		$status='F';
		$regis_type='SELF';
		$MailReSend="F";
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
		    $MailReSend="T";
		   //echo "<script>alert('You have been successfully registered !')</script>"; 
		   $submitResult='<div class="alert alert-success" style="text-align:center;font-weight: bold">You have successfully registered. Check your email to activate your account.</div>';
		}
		if ($result=="EXIST")
		{
		    include "cs/config.php";
		    $dsuac = mysqli_query($db,"call sp_user_registration('','".$User_Email."','','','','','','','','','','CHECK_USER_ACTIVATION',@resultmsg,@errormsg)") or die('Query Not execute'.mysqli_error($db));
			$db->close();
			if(mysqli_num_rows($dsuac)>0)
			{
			  $rowuac = mysqli_fetch_array($dsuac);
			  $UserStatusVal = $rowuac['status'];
			  if($UserStatusVal=="F")
			  {
			    $MailReSend="T";
			  }
			  else
			  {
			     $MailReSend="F";
				 echo "<script>alert('Your email ID have already registered.')</script>";
			  }
			}
			mysqli_free_result($dsuac);
			
		    //$submitResult='<div class="alert alert-danger" style="text-align:center;font-weight: bold">Your email ID have already registered.</div>';
		}
		// if($IsError="1")
		// {
		  // // echo  $IsError;
		   // //echo "<script>alert('An error occurred Please try again!')</script>";
		// }

		//Mailing process to registered user

		if($result && $MailReSend=="T")
		{	
			require 'PHPMailer/PHPMailerAutoload.php';
			$mail = new PHPMailer;
			$mail->isSMTP();                                   // Set mailer to use SMTP
			$mail->Host = 'localhost';                    // Specify main and backup SMTP servers
			$mail->SMTPAuth = false;   
			$mail->SMTPSecure = false;
			// Enable SMTP authentication
			//$mail->Username = '1book4c@gmail.com';          // SMTP username
			//$mail->Password = '1book@123'; 					// SMTP password
			//$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 25;    
			$mail->CharSet="UTF-8";
			// TCP port to connect to

			$mail->setFrom($SMTPServerFromEmailID, '1Book');
			$mail->addReplyTo($SMTPServerFromEmailID, '1Book');
			$mail->addAddress($User_Email); 
			$mail->AddEmbeddedImage('img/1book_logo.png','1book_logo');

			$mail->isHTML(true);  // Set email format to HTML
             
			include "cs/common.php";
			$Encrypt_User_Email=safe_b64encode($User_Email);
			 
			$bodyContent = "<img src='cid:1book_logo' alt='1Book'><br>";
			$bodyContent .= "<p>Dear ".$User_Name.",</p>";
			$bodyContent .= "<p><span style='color:#EF7F1B'>It's good to study</span></p>";
			$bodyContent .= "<p>Now Access books and notes on the move.</p>";
			$bodyContent .= "<p>You have created an account on <a href='".$SiteURL."'>1Book.in</a>. Your username is: '".$User_Email."'.
			To verify your email ID <a href='".$SiteURL."account_activation.php?email=".$Encrypt_User_Email."'>click here</a></p>";
			$bodyContent .= "<p>If the link does not work then copy the link given below into your web browser:</p>";
			$bodyContent .= "<p>".$SiteURL."account_activation.php?email=".$Encrypt_User_Email."</p>";
			$bodyContent .= "<p>Please ignore this mail, if you did not register at 1Book portal.</p>";
			$bodyContent .= "<p>To access the 1Book portal, Please visit http://www.1book.in</p>";
			$bodyContent .= "<p>Sincerely</p>";
			$bodyContent .= "<p><span style='color:#EF7F1B'>1Book</span> Team</p>";
			$bodyContent .= "<p><h5>Do not reply to this email.</h5></p>";
			$bodyContent .= "<p><h5>Please do not reply to this email. This email is sent from an automated service and is not monitored. To get in touch <a href='".$SiteURL."contactus.html'>contact us</a> here.</h5></p>";
			
			$mail->Subject = '1Book - Account Activation';
			$mail->Body = $bodyContent;
            
			if(!$mail->send()) 
			{
				//echo 'Mailer Error: ' . $mail->ErrorInfo;
				echo "<script>alert('You have successfully registered. Check your email to activate your account.')</script>";
			} 
			else 
			{
				//echo "<script>alert('You have been successfully registered')";
				echo "<script>alert('You have successfully registered. Check your email to activate your account.')</script>";
			}
			// echo "<script>alert('You have been successfully registered,Please verify it by clicking the activation link that has been send to your email')</script>";
		}
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
			$UName = $row['first_name'];
			$ULName = $row['last_name'];
		    $UEmail = $row['billing_Email'];
			$URoleId = $row['role_id'];
			if ($URoleId=="0" || $URoleId=="2" || $URoleId=="3")
			{
			   $UName=$UName .' '. $ULName;
			}
			$UPwd = $row['password'];
			//echo "<script>alert(".$UEmail.")</script>";
			  
			if($UserPassword==$UPwd)
			{
			   include_once "cs/common.php";
			   $IpAddress = $_SERVER['REMOTE_ADDR'];
			   $DeviceType = detectDevice();
			   $TotalAccess="3";
			   $CurrentAccess="1";
			   $LoginStatus="T";
			   $Active="T";
			   //echo "<script>alert('I')</script>";
			   include "cs/config.php";
			   $resulttrace = mysqli_query($db,"call sp_insert_user_trace('','".$UId."','".$UEmail."','".$DeviceType."','".$IpAddress."','".$IpAddress."','".$TotalAccess."','".$CurrentAccess."','".$LoginStatus."','".$Active."','ADD_USER_TRACE')") or die('Query Not execute'.mysqli_error($db));
				$db->close();	
				if (mysqli_num_rows($resulttrace) > 0) {
					 while($row = mysqli_fetch_array($resulttrace)) {
						 $total_accessval= $row['total_access'];
						 $current_accessval= $row['current_access'];
					 }
					 mysqli_free_result($resulttrace);
				}

			 if ($total_accessval>=$current_accessval)
			 {
			 // $_SESSION['userid'] = $UEmail;
			 // $_SESSION['roleid'] = $URoleId;
			 // $_SESSION['username'] = $UName;
			 // $_SESSION['user_id'] = $UId;
			
			 //set the cookies for 1 day, ie, 1*24*60*60 secs
             //change it to something like 30*24*60*60 to remember user for 30 days
			 //set the cookies for 5 Minutes, ie, 60*5 secs
			
             setcookie('useremailid', $UEmail, time() + 24*60*60, "/");
			 setcookie('roleid', $URoleId, time() + 24*60*60, "/");
             setcookie('username', $UName, time() + 24*60*60, "/");
			 setcookie('userid', $UId, time() + 24*60*60, "/");
			
			 if ($URoleId=="1")
			 {
				// $WebSite_URL="location:".$SiteURL."index.html";
				// header($WebSite_URL);
				// echo ("<SCRIPT LANGUAGE='JavaScript'>
				// window.alert('Succesfully Login')
				// window.location.href='index.html';
				// </SCRIPT>");
				// echo ("<SCRIPT LANGUAGE='JavaScript'>
				// window.location.href='index.html';
				// </SCRIPT>");
				
				$pageURL = $_SERVER["REQUEST_URI"];
				echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.location.href='".$pageURL."';
				</SCRIPT>");
			 } 
			 if ($URoleId=="2" || $URoleId=="3")
			 {
				 //$WebSite_URL="location:".$SiteURL."modify_booknotes.html";
				// header($WebSite_URL);
				// echo ("<SCRIPT LANGUAGE='JavaScript'>
				// window.alert('Succesfully Updated')
				// window.location.href='modify_booknotes.html';
				// </SCRIPT>");
				$WebSite_URL=$SiteURL."modify_booknotes.html";
				echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.location.href='".$WebSite_URL."';
				</SCRIPT>");
			 } 
			 if ($URoleId=="0")
			 {
			    $WebSite_URL=$SiteURL."admin/admin_modify_booknotes.html";
				echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.location.href='".$WebSite_URL."';
				</SCRIPT>");
			 }
			 }
			 else
			 {
			     // echo "<script>alert('You have exceeded the maximum number of logins allowed. Please logout from previously logged in devices.')</script>";
				 echo("<script>if(confirm('You have exceeded the maximum number of logins allowed. Please logout from previously logged in devices.Do you want to reset all previous login from all devices')){
					window.location.href='logoutallaccess.php?userid=$UserEmail';
				 } else {
					window.location.href='".$WebSite_URL."';
				 };</script>");
			 }
			}
			else
			{
			   echo "<script>alert('Incorrect Password. Try Again!')</script>";
			   //$LoginMsg='Incorrect Password. Try Again!';
			}
		 }
		}
		else
		{
			echo "<script>alert('Sorry this emailid is not registered with us!')</script>";
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
		$mail->Host = 'localhost';                    // Specify main and backup SMTP servers
		$mail->SMTPAuth = false;   
		$mail->SMTPSecure = false;
		// Enable SMTP authentication
		//$mail->Username = '1book4c@gmail.com';          // SMTP username
		//$mail->Password = '1book@123'; 					// SMTP password
		//$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 25;    
		$mail->CharSet="UTF-8";
		// TCP port to connect to

		$mail->setFrom($SMTPServerFromEmailID, '1Book');
		//$mail->addReplyTo($SMTPServerFromEmailID, '1Book');
		$mail->addAddress($email);   
		$mail->AddEmbeddedImage('img/1book_logo.png','1book_logo');
		// Add a recipient
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');
		$mail->isHTML(true);  // Set email format to HTML
		$randString= md5($email);
		$htmlmsg = '
			<html>
			<body style="font-family: Open Sans, sans-serif;font-size: 15px;color: black;">
			<p>Dear '.$name.',</p>				
			<p>We got a request to reset your <span style="color:#EF7F1B">1Book</span> password for:<br>email id: '.$email.'</p>
			<p>Click on the link to Reset Password:<br>
			<a href="'.$SiteURL.'reset_password.php?id='.$email.'">Reset Password</a></p><br>
			<p>Alternatively, you may copy the link given below and paste in your browser to reset your password.<br>
				<a href="'.$SiteURL.'reset_password.php?id='.$email.'">'.$SiteURL.'reset_password.php?'.$randString.'</a>
			</p><br>
			<p>Regards,</p>
			<p><span style="color:#EF7F1B">1Book</span> Team<br>
			<img src="cid:1book_logo" alt="1Book"></p>
			</html>
			</body>';
		$bodyContent =  $htmlmsg;
		$mail->Subject = '1Book- Reset Password';
		$mail->Body = $bodyContent;
		if(!$mail->send()) 
		{
			echo "Mailer Error: " . $mail->ErrorInfo;
		 	echo "<script>alert('Mail delivery failed.')</script>";
		} 
		else 
		{
		 	echo "<script>alert('We have sent the link to Change your Password to your email address.')</script>";
		}
	   }
	    else
		{
			echo "<script>alert('This email ID does not exist.')</script>";
		}
  }
	/*Code end for forgot password*/
	
	$CurrentURL = $_SERVER['PHP_SELF']; // Get the current URL Path
	$CurrentPage = basename($CurrentURL); //Get the File/Page/Folder Name from the Path
	$CurrentPage = basename($CurrentURL, '.php');   //Show filename without file extension
	
	// // find out the domain:
	// $domain = $_SERVER['HTTP_HOST'];
	// // find out the path to the current file:
	// $path = $_SERVER['SCRIPT_NAME'];
	// // find out the QueryString:
	// $queryString = $_SERVER['QUERY_STRING'];
	// // put it all together:
	// $url = "http://" . $domain . $path . "?" . $queryString;
	// echo $url;

?>      


    <!-- Code start for search books/notes -->
	<?php
		include "cs/config.php";
		if(isset($_POST['submitfrm2srch']))
		{
			echo $srchtextval=$_POST['srchbooks'];
			if($srchtextval!="")
			{
			 $path= "location:bookshelf_search.php?search=".$srchtextval."";
		     header($path);
			}
			else
			{
			  header("location:bookshelf.html");
			}
		}
	 ?> 
	 <!-- Code end for search books/notes -->
	 
	<?php if (isset($_GET['flag']) && count($_GET) > 0) { ?>
	<script type='text/javascript'> 
		$(document).ready(function() {
			$('#forgotPassModalID').trigger('click');
		});
	</script>
	<?php } ?>
	
	
    <!-- Code start for header -->
	
	<div class="col-xs-12 outerDivTable hidden-xs stickyNav">
		<div class="innerDivCell">
		<?php 
		if($CurrentPage=="index" || $CurrentPage=="student" || $CurrentPage=="educator" || $CurrentPage=="bookshelf")
		{
			?><span class="logoLink"><a <?php if ($CurrentPage=="student") echo "class='active'";?> title="Students" href="<?php echo $SiteURL;?>student.html"><img src="<?php echo $SiteURL;?>img/homePage/students.png" alt="Students Logo" /> <span>Students</span></a></span>
			<span class="logoLink"><a  <?php if ($CurrentPage=="educator") echo "class='active'";?>title="Educators" href="<?php echo $SiteURL;?>educator.html"><img src="<?php echo $SiteURL;?>img/homePage/educators.png" alt="Educators Logo" /> <span>Educators</span></a></span>
			 <span class="logoLink">
					<span id="sb-search" class="sb-search">
						<form method="post" id="frm2srch" name="frm2srch" enctype="multipart/form-data" action= "<?php $_PHP_SELF ?>">
							<input class="sb-search-input" placeholder="Find eBooks, eNotes etc." type="text" value="" name="srchbooks" id="srchbooks" form="frm2srch">
							<input class="sb-search-submit" type="submit" name="submitfrm2srch" id="submitfrm2srch" value="" form="frm2srch">
							<span class="sb-icon-search">
							<!--<button style="background: #eee;border: none;" type="submit" name="submitfrm2srch" id="submitfrm2srch" form="frm2srch">-->
							  <i class="fa fa-search" aria-hidden="true"></i>
							<!--</button>-->
							</span>
						</form>
					</span>
			 </span>
			<?php
		}
		else
		{
		    ?>
			<form method="post" id="form1srch" name="form1srch" enctype="multipart/form-data" action= "<?php $_PHP_SELF ?>">
			<div id="custom-search-input_1">
			<div class="input-group col-md-12">
				<input type="text" class="form-control input-lg" form="form1srch" id="srchtext" name="srchtext" onkeypress="return srchEnter();" placeholder="Find eBooks, eNotes etc." value="<?php echo $searchedval;?>" onkeyup='return srchErrorHide("srch_error")' />
				<span class="input-group-btn input-group-btn_1">
					<button class="btn btn-info btn-lg" type="submit" name="searchbtn" id="searchbtn" form="form1srch" OnClick="return searchvalidation();">
						<i class="glyphicon glyphicon-search"></i>
					</button>
				</span>
				</div>
			</div>
			<span id="srch_error" class="label label-danger"></span>
		  </form>
		 <?php
		}
		?>
		</div>
		<div class="innerDivCell text-center">
	     	<?php 
			if($CurrentPage=="bookshelf")
			{
			  ?><a title="1Book" href="<?php echo $SiteURL;?>"><img src="<?php echo $SiteURL;?>img/1bookstore.svg" alt="1Book Logo" /></a><?php 
			}
			else if($CurrentPage=="index")
			{
			  ?><a title="1Book" href="<?php echo $SiteURL;?>"><img src="<?php echo $SiteURL;?>img/homePage/logo.svg" alt="1Book Logo" /></a><?php 
			}
			else
			{
			  ?><a title="1Book" href="<?php echo $SiteURL;?>"><img src="<?php echo $SiteURL;?>img/homePage/logo.svg" alt="1Book Logo" /></a><?php 
			}
			?>
		</div>
		<div class="innerDivCell text-right">
		    <?php 
		     if(isset($_COOKIE['useremailid']))  //$_SESSION['userid']!=""
			 {
			  ?>
			    <span class="logoLink toggleLogin"><a title="Sign In" href="#" data-toggle="modal" data-target="#loginModal">Sign In</a></span>
			    <span class="logoLink toggleRegister"><a title="Sign Up" href="#" data-toggle="modal" data-target="#registerModal">Sign Up</a></span>
				<?php 
				       if (strpos($currentUrl,"index") == false) 
					   {
							?><span class="logoLink"><a title="1Book" href="<?php echo $SiteURL;?>index.html"><i class="fa fa-home hme" aria-hidden="true"></i></a></span><?php
					   }
					   if($_COOKIE['roleid']=="0")  // $_SESSION['roleid']
					   {
					     ?> <span class="logoLink"><a title="Dashboard" href="<?php echo $SiteURL;?>admin/admin_modify_booknotes.html">Dashboard</a></span>  <?php 
					   }
					   if($_COOKIE['roleid']=="1")  // $_SESSION['roleid']
					   {
					     ?> <span class="logoLink"><a title="Dashboard" href="<?php echo $SiteURL;?>mybookshelf.html">Dashboard</a></span>  <?php 
					   }
					   else if($_COOKIE['roleid']=="2" || $_COOKIE['roleid']=="3")
					   {
					     ?> <span class="logoLink"><a title="Dashboard" href="<?php echo $SiteURL;?>modify_booknotes.html">Dashboard</a></span><?php 
					   }
				  ?>
				<span class="logoLink"><a title="Bookstore" href="<?php echo $SiteURL;?>bookshelf.html">Bookstore</a></span>
			    <span class="logoLinkNoborder toggleLogout dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i> <span class="caret"></span></a>
				<span class="dropdown-menu dropdownmenu">
				    <span><a href="#"><?php echo $_COOKIE['username'];?></a></span>
					<?php
					if($_COOKIE['roleid']=="1")  // $_SESSION['roleid']
					{
					   ?><span><a title="My Orders" href="<?php echo $SiteURL;?>myorders.html">My Orders</a></span><?php 
					}
					?>
					<span><a title="Logout" href="<?php echo $SiteURL;?>logout.php">Logout</a></span>
				</span>
			    </span>
			 <?php 
			}
			else
			 {
			 ?>
			    <?php 
			    if (strpos($currentUrl,"index") == false)  
			    {
				 ?><span class="logoLink"><a href="<?php echo $SiteURL;?>index.html"><i class="fa fa-home hme" aria-hidden="true"></i></a></span><?php 
				}
				?>
			  <span class="logoLink"><a title="Sign In" href="#" data-toggle="modal" data-target="#loginModal">Sign In</a></span>
			  <span class="logoLink"><a title="Sign Up" href="#" data-toggle="modal" data-target="#registerModal">Sign Up</a></span>
			  <span class="logoLink"><a title="Bookstore" href="<?php echo $SiteURL;?>bookshelf.html">Bookstore</a></span>
			 <?php
			 }
			?>
		</div>
	</div>
	
	<nav class="navbar navbar-default outerDivTable visible-xs stickyNav">
	<div class="container-fluid">
		<div class="navbar-header">
		<span class="pull-right">
			<span class="logoLinkXS">
				<span id="sb-search2" class="sb-search">
					<form>
						<input class="sb-search-input" placeholder="Enter your search term..." type="text" value="" name="search" id="search">
						<input class="sb-search-submit" type="submit" value="">
						<span class="sb-icon-search"><i class="fa fa-search" aria-hidden="true"></i></span>
					</form>
				</span>
			</span>
			
			<button type="button" class="navbar-toggle obNav" data-toggle="collapse" data-target="#homeNav">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
			</button>
		</span>
		<a class="navbar-brand" href="<?php echo $SiteURL;?>"><img src="<?php echo $SiteURL;?>img/homePage/logo.svg" alt="1Book Logo" /></a>
		</div>
		<div class="collapse navbar-collapse" id="homeNav">
		<ul class="nav navbar-nav">
		    <?php 
		     if(isset($_COOKIE['useremailid']))
			 {
			   ?>
			   <li class="active"><a title="Students" href="<?php echo $SiteURL;?>student.html"><img src="<?php echo $SiteURL;?>img/homePage/students.png" alt="Students Logo" /> <span>Students</span></a></li>
			   <li><a title="Educators" href="<?php echo $SiteURL;?>educator.html"><img src="<?php echo $SiteURL;?>img/homePage/educators.png" alt="Educators Logo" /> <span>Educators</span></a></li>
			   <li><a title="Bookstore" href="<?php echo $SiteURL;?>bookshelf.html">Bookstore</a></li> 
			    <?php 
			       if($_COOKIE['roleid']=="1")
				   {
			        ?> <li><a title="Dashboard" href="<?php echo $SiteURL;?>mybookshelf.html">Dashboard</a></li>  <?php 
				   }
				   else if($_COOKIE['roleid']=="2" || $_COOKIE['roleid']=="3")
				   {
				     ?> <li><a title="Dashboard" href="<?php echo $SiteURL;?>modify_booknotes.html">Dashboard</a></li>  <?php 
				   }
				 ?>
			   <li><a title="Logout" href="<?php echo $SiteURL;?>logout.php">Logout</a></li> 
			   <?php 
			 }
			 else
			 {
			 ?>
			 <li class="active"><a href="<?php echo $SiteURL;?>student.html"><img src="<?php echo $SiteURL;?>img/homePage/students.png" alt="Students Logo" /> <span>Students</span></a></li>
			 <li><a href="<?php echo $SiteURL;?>educator.html"><img src="<?php echo $SiteURL;?>img/homePage/educators.png" alt="Educators Logo" /> <span>Educators</span></a></li>
			 <li><a title="Sign In" href="#" data-toggle="modal" data-target="#loginModal">Sign In</a></li> 
			 <li><a title="Sign Up" href="#" data-toggle="modal" data-target="#registerModal">Sign Up</a></li> 
			 <li><a title="Bookstore" href="<?php echo $SiteURL;?>bookshelf.html">Bookstore</a></li> 
			 <?php
			 }
			 ?>
		</ul>
		</div>
	</div>
	</nav>
   <!-- Code end for header -->
		
		<!-- Login modal -->
				<div class="modal fade logModCSS" id="loginModal" role="dialog" tabindex='-1'>
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
								<h4 class="modal-title" id="loginModalLabel">Log in</h4>
							</div>
							
							<form method="post" id="form2" name="form2" enctype="multipart/form-data" action= "<?php $_PHP_SELF ?>">
							<div class="modal-body">
								<div class="text-center mbottom20">
									<img src="<?php echo $SiteURL;?>img/logo_login.png" alt="1Book Logo" class="loginLogo"/>
								</div>
								
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
								
							</div>
							<div class="modal-footer">
								<!--<button class="form-control btn btn-warning loginmodal-submit">Sign in</button>-->
								<input type="submit" form="form2" id="signin" name="signin" value="Sign in" class="form-control btn btn-warning loginmodal-submit" OnClick="return signin_validation();" />
								<div class="login-help">
									<a href="#" id="forgotPassModalID" data-toggle="modal" data-dismiss="modal" data-target="#forgotPassModal">Forgot Password?</a>
								</div>
								<div class="modDivider" style="display:none;"></div>
								<div class="text-center" style="display:none;">
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
							</form>
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
								<h4 class="modal-title" id="regModalLabel">Sign Up</h4>
							</div>
							
							<form method="post" id="form1" name="form1" enctype="multipart/form-data" action="<?php $_PHP_SELF ?>">
							<div class="modal-body">
								<div class="text-center mbottom20">
									<img src="<?php echo $SiteURL;?>img/logo_login.png" alt="1Book Logo" class="loginLogo"/>
								</div>
								
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
											Password should contain at least 8 characters.
										</div>
									</div>	
									<div class="form-group">
										<div>
											<?php echo $submitResult; ?>	
										</div>
									</div>
								
							</div>
							
							<div class="modal-footer">
								<!--<button class="form-control btn btn-warning loginmodal-submit">Register</button>-->
								<input type="submit" class="form-control btn btn-warning loginmodal-submit" id="register" form="form1" name="register" value="Sign Up" OnClick="return registration_validation();" />
								<div class="modDivider" style="display:none;"></div>
								<div class="text-center" style="display:none;">
									<a href="#" class="modFB hvr-bounce-in"><i class="fa fa-facebook" aria-hidden="true"></i></a>
									<a href="#" class="modGP hvr-bounce-in"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
								</div>
								<div class="newUser">
									<a href="#" data-toggle="modal" data-dismiss="modal" data-target="#loginModal">Existing User ? 									Sign in</a>
									<p style="font-size:12px;margin-top:7px;">Please note activation mail can also be in your spam folder.</p>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>

				<!-- Register modal -->

				<!-- Forgot Password modal -->
				<div class="modal fade logModCSS" id="forgotPassModal" role="dialog" data-backdrop="static">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
								<h4 class="modal-title" id="fpModalLabel">Forgot Password</h4>
							</div>
							<form method="post" id="form3" name="form3" action="<?php $_PHP_SELF ?>">
							<div class="modal-body">
								<div class="text-center mbottom20">
									<img src="<?php echo $SiteURL;?>img/logo_login.png" alt="1Book Logo" class="loginLogo"/>
								</div>
								<div class="fpText">Enter your email address, and we'll send you a password reset email.</div>

									<div class="form-group">
										<div class="input-group">
											<input type="email" class="form-control" id="fpEmail" placeholder="E-mail" name="fpEmail" onkeypress='return errorMsgHide("fp_Email")'>
											<label for="fpEmail" class="input-group-addon fa fa-at emailAt" aria-hidden="true"></label>
										</div>
										<span id="fp_Email" class="label label-danger"></span>
									</div>

							</div>
							<div class="modal-footer">
								<!-- <button class="form-control btn btn-warning loginmodal-submit">Submit</button> -->
								<input type="submit" name="fpSubmit" value="Submit" class="form-control btn btn-warning loginmodal-submit" form="form3" onclick="return forgot_validation();" />
								<div class="modDivider" style="display:none;"></div>
								<div class="text-center" style="display:none;">
									<a href="#" class="modFB hvr-bounce-in"><i class="fa fa-facebook" aria-hidden="true"></i></a>
									<a href="#" class="modGP hvr-bounce-in"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
								</div>
								<div class="newUser">
									<a href="#" data-toggle="modal" data-dismiss="modal" data-target="#loginModal"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to login</a>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
				<!-- / Forgot Password modal -->
		
<script src="<?php echo $SiteURL;?>js/classie.js"></script>
<script src="<?php echo $SiteURL;?>js/uisearch.js"></script>

<script>
			new UISearch( document.getElementById( 'sb-search' ) );
			new UISearch( document.getElementById( 'sb-search2' ) );
		</script>
		
		