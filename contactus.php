<!DOCTYPE html>
<?php ob_start(); ?>
<?php require_once "cs/config.php"; ?>
<html lang="en">
	<head>
		<title>Contact Us | 1Book</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="<?php echo $SiteURL;?>img/fevicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	    <link rel="stylesheet" href="css/login_register.css">
		<link rel="stylesheet" href="css/contactUs.css">
		<link rel="stylesheet" href="css/common.css">
		

		 <!-- Validation start for Contact Us Page -->
		<script language="javascript" type="text/javascript">
		function contact_validation()
		{
			if(document.getElementById("Uname").value=="")
			{
			/*alert("Please enter your name");*/
			document.getElementById('ContactErrMsg').style.display = "block";
			document.getElementById("ContactErrMsg").innerHTML = "Please enter your name.";
			document.getElementById("Uname").focus();
			return false;
			}
			if(document.getElementById("Uemail").value=="")
			{
			/*alert("Please enter your email");*/
			document.getElementById('ContactErrMsg').style.display = "block";
			document.getElementById("ContactErrMsg").innerHTML = "Please enter your email.";
			document.getElementById("Uemail").focus();
			return false;
			}
			if(document.getElementById("Uphone").value=="")
			{
			/*alert("Please enter your email");*/
			document.getElementById('ContactErrMsg').style.display = "block";
			document.getElementById("ContactErrMsg").innerHTML = "Please enter your phone no.";
			document.getElementById("Uphone").focus();
			return false;
			}
			if(document.getElementById("Umessage").value=="")
			{
			document.getElementById('ContactErrMsg').style.display = "block";
			document.getElementById("ContactErrMsg").innerHTML = "Please enter message.";
			document.getElementById("Umessage").focus();
			return false;
			}
			// if(document.getElementById("Ucode").value=="")
			// {
			
			// document.getElementById('ContactErrMsg').style.display = "block";
			// document.getElementById("ContactErrMsg").innerHTML = "Please enter code.";
			// document.getElementById("Ucode").focus();
			// return false;
			// }
			
		}

		function ContactErrHide() 
		{
			document.getElementById('ContactErrMsg').style.display = "none";
		}
		 </script>
		 
		 <!-- Validation end for Contact Us Page -->
		 
		  <!-- Code Start for Get the User Information -->
		 <?php
			if(isset($_POST['submit']))
			{
			    include ("cs/config.php");
				$uname = $_POST['Uname'];
				$uemail = $_POST['Uemail'];
				$uphone = $_POST['Uphone'];
				$uenquiry = $_POST['Umessage'];
				require 'PHPMailer/PHPMailerAutoload.php';
				$mail = new PHPMailer;
				$mail->isSMTP();                                   // Set mailer to use SMTP
				$mail->Host = 'localhost';                    // Specify main and backup SMTP servers
				$mail->SMTPAuth = false;   
				$mail->SMTPSecure = false;

				$mail->Port = 25;    
				$mail->CharSet="UTF-8";
				
				$mail->setFrom($SMTPServerFromEmailID, '1Book');
				$mail->addReplyTo($uemail);
				$mail->addAddress($SMTPServerFromEmailID, '1Book');   
				$mail->AddEmbeddedImage('img/1book_logo.png','1book_logo');
				//$mail->addCC('deepaknirwal11@gmail.com');
				$mail->addBCC('deepaknirwal11@gmail.com');
				
				$mail->isHTML(true);  // Set email format to HTML

				$bodyContent .= '<p><b>Name: </b>'.$uname.'</p>';
				$bodyContent .= '<p><b>Email Address: </b>'.$uemail.'</p>';
				$bodyContent .= '<p><b>Phone No: </b>'.$uphone.'</p>';
				$bodyContent .= '<p><b>Message: </b>'.$uenquiry.'</p>';
				$bodyContent .= '<p>Sincerely</p>
				<p><span style="color:#EF7F1B">1Book</span> Team</p>
				<img src="cid:1book_logo" alt="1Book">';
				
				$mail->Subject = '1Book Contact Request Submitted By '.$uname;
				$mail->Body = $bodyContent;
				if(!$mail->send()) 
				{
					 echo "<script>
							document.getElementById('formsubmit').innerHTML = '<p>Mail delivery failed.</p>';
						</script>";
				} 
				else 
				{
				    //echo "<script>alert('Your contact request has been submitted successfully..')</script>";
					// echo "<script>
							// document.getElementById('ContactErrMsg').innerHTML = '<p>Your contact request has been submitted successfully.</p>';
						// </script>";
						$submitResult='Your contact request has been submitted successfully.';
					 // echo "<script>
							// document.getElementById('formsubmit').innerHTML = '<p>Your contact request has been submitted successfully..</p>';
						// </script>";
				}
			}
         ?>
		 <!-- Code End for Get the User Information -->
		 
	</head>
	<body class="modal-open">
	<div class="mainWrap">
		
		 <!-- Header Start Here -->
	   <?php include_once('header.php');?>
	   <!-- Header End Here -->

		
		<div class="formWid1">
				<form class="form_inner" action="<?php $_PHP_SELF ?>" method="post" id="frmcontactus" name="frmcontactus">
						<h4 class="form_title">Send us a message</h4>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input placeholder="Name" class="form-control" type="text" id="Uname" name="Uname" onkeypress="return ContactErrHide();">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
								<input placeholder="Email" class="form-control" type="email" id="Uemail" name="Uemail" onkeypress="return ContactErrHide();">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
								<input placeholder="Phone" class="form-control" type="text" id="Uphone" name="Uphone" onkeypress="return ContactErrHide();">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
								<textarea class="form-control" rows="5" placeholder="Message" id="Umessage" name="Umessage" onkeypress="return ContactErrHide();"></textarea>
							</div>
						</div>
						<div>	
				  		<span id="ContactErrMsg" style="color:red;"></span>
						<span style="color:green;"><?php echo $submitResult; ?></span>
				     	</div>
				  	    <span id="formsubmit"></span>
						<!--<input type="submit" name="submit" value="Submit" class="btnsub" 
						onclick="return contact_validation();" form="frmcontactus">-->
						<button type="submit" name="submit" value="Submit" class="btn btn-warning submitBtn" onclick="return contact_validation();">Send <span class="glyphicon glyphicon-send"></span></button>
						<div class="ccformDiv"></div>
				</form>
					<div class="form_inner">
						<h4 class="form_title">Call Us</h4>
						<div class="form-group">
							<div class="input-group callUs">
								<i class="fa fa-phone" aria-hidden="true"></i>
								<label class="control-label">09999 249 105</label>
								<p>(Business Hours: 10:00 am to 6:00 pm)</p>
								<!--<h4 class="form_title mtop20">Address:</h4>
								<p>601, Technology Apartments, IP Extension<br>
								Delhi-110092</p>-->
								<h4 class="form_title mtop20">Mail us at:</h4>
								<p><a href="mailto:contact@1book.in" target="_top">contact@1book.in</a></p>
							</div>
						</div>
					</div>
				</div>

				
	
		<!--<div class="col-xs-12 padd0 mtop20">
			<div class="card signin-card">
				<form action="<?php $_PHP_SELF ?>" method="post" id="form5" name="form5">
					<div class="form-group">
				  		<label for="Uname">Name:</label>
				  			<input type="text" class="form-control" id="Uname" name="Uname" onkeypress="return ContactErrHide();">
					</div>
				  	<div class="form-group">
				    	<label for="Uemail">Email Address:</label>
				    		<input type="email" class="form-control" id="Uemail" name="Uemail" onkeypress="return ContactErrHide();">
				  	</div>
				  	<div class="form-group">
				    	<label for="Uenquiry">Message:</label>
				    		<textarea id="Uenquiry" name="Uenquiry" rows="5" class="form-control" onkeypress="return ContactErrHide();"></textarea>
				  	</div>
				  	<div class="form-group" style="display:none;">
				    	<label for="Ucode">Enter the code in the box below:</label>
				    		<input type="text" class="form-control" id="Ucode" name="Ucode" onkeypress="return ContactErrHide();">
				  	</div>
				  	<div>	
				  		<span id="ContactErrMsg" style="color:red;"></span>
				  	</div>
				  	<span id="formsubmit"></span>
				  	<div class="form-group">
				  		<input type="submit" name="submit" value="Submit" class="btnsub" 
						onclick="return contact_validation();" form="form5">
				  	</div>
				</form>
			</div>
		</div>-->



		 <!-- Footer Start Here -->
	   <?php include_once('footer.php');?>
	   <!-- Footer End Here -->

	</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="js/index.js"></script>
		
		<script src="js/scrolltofixed.js"></script> <!-- plugin is used to fix elements on the page (top, bottom, anywhere) -->
	 
		<script>
		/* Fixed footer until it reaches its original position */
		$(document).ready(function() {
		$(".stickyNav").scrollToFixed();
		 
		$(window).scroll(function() {
		if ($(this).scrollTop() > 0) { // this refers to window
		$(".stickyNav").css("box-shadow", "0 2px 10px #999");
		}else{
		$(".stickyNav").css("box-shadow", "none");
		}
		});
		});
		/* Fixed footer until it reaches its original position */
		</script>
	</body>
</html>
<?php ob_end_flush(); ?>

