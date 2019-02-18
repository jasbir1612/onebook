<!DOCTYPE html>
<?php ob_start(); ?>
<?php require_once "cs/config.php"; ?>
<html lang="en">
	<head>
		<title>FeedBack | 1Book</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="<?php echo $SiteURL;?>img/fevicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" href="css/bookshelf.css">
		<link rel="stylesheet" href="css/responsive.css">
		<style>
			.card{
			  margin-bottom: 0px;
			  margin-bottom: 20px;
			  padding: 20 25 30;
			  margin:0px auto 25px;
			  width: 304px;
			  background-color: #EBEBEB;

			}

			.signin-card{
			  height: 500px;
			  position: realtive;
			  overflow: hidden;
			  width: 500px;
			  padding: 40px;
			  border-radius: 2px;
			  box-shadow: 0 2px 4px 0 rgba(0,0,0,.3);
			}

			.btnsub
			{
				font-size: 13px;
				padding: 3px 12px;
				background: #EF7F1B !important;
				color: #fff !important;
				font-weight: 700;
				border: none;
				outline-color: transparent !important;
				line-height: 1.42857143;
				text-align: center;
				white-space: nowrap;
				vertical-align: middle;
				margin-top: 20px;
			}

		</style>
        
		 <!-- Validation start for feedback form  -->
		<script language="javascript" type="text/javascript">
		function Feedback_validation()
		{
			if(document.getElementById("Uname").value=="")
			{
			/*alert("Please enter your name");*/
			document.getElementById('FeedbackErrMsg').style.display = "block";
			document.getElementById("FeedbackErrMsg").innerHTML = "Please enter your name.";
			document.getElementById("Uname").focus();
			return false;
			}
			if(document.getElementById("Uemail").value=="")
			{
			/*alert("Please enter your email");*/
			document.getElementById('FeedbackErrMsg').style.display = "block";
			document.getElementById("FeedbackErrMsg").innerHTML = "Please enter your email.";
			document.getElementById("Uemail").focus();
			return false;
			}
			if(document.getElementById("Uenquiry").value=="")
			{
			
			document.getElementById('FeedbackErrMsg').style.display = "block";
			document.getElementById("FeedbackErrMsg").innerHTML = "Please enter enquiry.";
			document.getElementById("Uenquiry").focus();
			return false;
			}
			/*if(document.getElementById("Ucode").value=="")
			{
			
			document.getElementById('FeedbackErrMsg').style.display = "block";
			document.getElementById("FeedbackErrMsg").innerHTML = "Please enter code.";
			document.getElementById("Ucode").focus();
			return false;
			}*/
			
		}

		function FeedbackErrHide() 
		{
			document.getElementById('FeedbackErrMsg').style.display = "none";
		}
		 </script>
		 
		  <!-- Validation end for feedback form  -->
	</head>
	<body>
	<div class="mainWrap">
		
		 <!-- Header Start Here -->
	   <?php include_once('header.php');?>
	   <!-- Header End Here -->

		<div class="col-xs-12 padd0 divBG1" style="display:none;">
			<div class="innerWrap padd015">
				<div class="pull-left shelfTxt">Feedback</div>
				<div class="pull-right" style="display:none;">
					<form class="navbar-form searchBox1" role="search">
						<div class="input-group">
							<input type="text" class="form-control searchBoxInput" placeholder="Find eBook, eNotes, etc" name="q">
							<div class="input-group-btn">
								<button class="btn btn-default searchBoxBtn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
							</div>
						</div>
					</form>
				</div>
				<div style="display: block; clear: both;"></div>
			</div>
		</div>
		

		<div class="col-xs-12 padd0 mtop20">
			<div class="card signin-card">
				<form action="<?php $_PHP_SELF ?>" method="post" id="feedback_form" name="feedback_form">
					<div class="form-group">
				  		<label for="Uname">First Name:</label>
				  			<input type="text" class="form-control" id="Uname" name="Uname" onkeypress="return FeedbackErrHide();">
					</div>
				  	<div class="form-group">
				    	<label for="Uemail">E-Mail-Address:</label>
				    		<input type="email" class="form-control" id="Uemail" name="Uemail" onkeypress="return FeedbackErrHide();">
				  	</div>
				  	<div class="form-group">
				    	<label for="Uenquiry">Message:</label>
				    		<textarea id="Uenquiry" name="Uenquiry" rows="5" class="form-control" onkeypress="return FeedbackErrHide();"></textarea>
				  	</div>
				  	<div class="form-group" style='display:none;'>
				    	<label for="Ucode">Enter the code in the box below:</label>
				    		<input type="text" class="form-control" id="Ucode" name="Ucode" onkeypress="return FeedbackErrHide();">
				  	</div>
				  	<div>	
				  		<span id="FeedbackErrMsg" style="color:red;"></span>
				  	</div>
				  	<div class="form-group">
				  		<!-- <button type="submit" class="btnsub">Submit</button> -->
				  		<input type="submit" name="submit" value="Submit" class="btnsub" onclick="return Feedback_validation();" form="feedback_form">
				  	</div>
				</form>
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
 <!-- Code start for insert user feedback -->
 
<?php 
	include "cs/config.php";
	//session_start();
	if(isset($_POST['submit']))
	{
		$name = $_POST['Uname'];
	    $email = $_POST['Uemail'];
	    $enquiry = $_POST['Uenquiry'];
	    $code=$_POST['ucode'];
		$resultds = mysqli_query($db,"call sp_add_feedback('','".$name."','".$email."','','".$enquiry."','".$code."','ADD_FEEDBACK')") or die('Query Not execute'.mysqli_error($db));
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
		    echo "<script>alert('Your feedback submitted successfully!')</script>"; 
		   /* echo "<script>
	 			document.getElementById('submit').innerHTML = '<p>You have been successfully registered.</p>';
	 		</script>";*/
		}
     }
     ?>
	 
	 <!-- Code end for insert user feedback -->
