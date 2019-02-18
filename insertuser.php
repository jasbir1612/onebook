<!DOCTYPE html>
<?php ob_start(); ?>
<?php include "cs/config.php"; ?>
<html lang="en">
	<head>
		<title>1Book</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
		<link rel="shortcut icon" href="<?php echo $SiteURL;?>img/fevicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="css/jasny-bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
		<link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" href="css/manageGroups.css">
		<link rel="stylesheet" href="css/responsive.css">
		<link href="./css/style1.css" rel="stylesheet">
		
<script language="javascript" type="text/javascript">
function insertuser_validation()
{
	if(document.getElementById("fname").value=="")
	{
	/*alert("Please enter your name");*/
	document.getElementById('ErrorMsg').style.display = "initial";
	document.getElementById("ErrorMsg").innerHTML = "Please enter your firstname.";
	document.getElementById("fname").focus();
	return false;
	}
	if(document.getElementById("lname").value=="")
	{
	/*alert("Please enter your name");*/
	document.getElementById('ErrorMsg0').style.display = "initial";
	document.getElementById("ErrorMsg0").innerHTML = "Please enter your lastname.";
	document.getElementById("lname").focus();
	return false;
	}
	if(document.getElementById("email").value=="")
	{
	/*alert("Please enter your email");*/
	document.getElementById('ErrorMsg1').style.display = "initial";
	document.getElementById("ErrorMsg1").innerHTML = "Please enter your email.";
	document.getElementById("email").focus();
	return false;
	}
	if(document.getElementById("pwd").value=="")
	{
	document.getElementById('ErrorMsg2').style.display = "initial";
	document.getElementById("ErrorMsg2").innerHTML = "Please enter password.";
	document.getElementById("pwd").focus();
	return false;
	}
	if(document.getElementById("cpwd").value=="")
	{
	document.getElementById('ErrorMsg3').style.display = "initial";
	document.getElementById("ErrorMsg3").innerHTML = "Please enter confirm password.";
	document.getElementById("cpwd").focus();
	return false;
	}
    if(document.getElementById("pwd").value!=document.getElementById("cpwd").value)
	{
	 /*alert("Password did not match! Try again");*/
	 document.getElementById('ErrorMsg3').style.display = "initial";
	 document.getElementById("ErrorMsg3").innerHTML = "Password did not match! Try again";
	 document.getElementById("cpwd").focus();
	 return false;
	}
	var ddlusertype = document.getElementById("utype")
	if(ddlusertype.value=="--Select--")
	{	
	document.getElementById('ErrorMsg4').style.display = "initial";
	document.getElementById("ErrorMsg4").innerHTML = "Please enter user type.";
	 document.getElementById("utype").focus();
	return false;
	}
	var ddlrole = document.getElementById("role");
	if(ddlrole.value=="--Select--")
	{
	document.getElementById('ErrorMsg5').style.display = "initial";
	document.getElementById("ErrorMsg5").innerHTML = "Please enter role.";
	 document.getElementById("role").focus();
	return false;
	}
	var ddlstatus = document.getElementById("status")
	if(ddlstatus.value=="--Select--")
	{
	document.getElementById('ErrorMsg6').style.display = "initial";
	document.getElementById("ErrorMsg6").innerHTML = "Please enter status.";
	 document.getElementById("status").focus();
	return false;
	}
}

 </script>
 

</head>
<body>
       <!-- Header Start Here -->
          <?php include_once('header.php');?><br><br><br>
	   <!-- Header End Here -->

			     <div class="modal-dialog modal-md">
						<div class="modal-content">
							<div class="modal-header modHead1">
								 <h4 class="modal-title" > Registration</h4>
							</div>
							<div class="modal-body modBody1">
								<form class="form-horizontal modForm1" enctype="multipart/form-data" method="post" id="insertform" name="insertform"  action= "<?php $_PHP_SELF ?>">
									<div class="form-group margin0 mbottom8">
										<label >First Name:</label>
										<div >
											<input class="form-control mgForm1" id="fname" name="fname" type="text" value="" onkeypress='return errorMsgHide("ErrorMsg")'>

										</div>
										<span id="ErrorMsg" class="label label-danger"></span>
									</div>
									<div class="form-group margin0 mbottom8">
										<label >Last Name:</label>
										<div >
											<input class="form-control mgForm1" id="lname" name="lname" type="text" value="" onkeypress='return errorMsgHide("ErrorMsg0")'>
										</div>
                                        <span id="ErrorMsg0" class="label label-danger"></span>
									</div>
									<div class="form-group margin0 mbottom8">
										<label >E-Mail-Address:</label>
										<div >
											<input class="form-control mgForm1" id="email" name="email" type="email" value="" onkeypress='return errorMsgHide("ErrorMsg1")'>
											<span id="ErrorMsg1" class="label label-danger"></span>
										</div>
										
									</div>
                                    <div class="form-group margin0 mbottom8">
										<label >Password:</label>
										<div >
											<input class="form-control mgForm1" id="pwd" name="pwd" type="password" value="" onkeypress='return errorMsgHide("ErrorMsg2")'>
										</div>
										<span id="ErrorMsg2" class="label label-danger"></span>
									</div>
                                   <div class="form-group margin0 mbottom8">
										<label >Confirm Password:</label>
										<div >
											<input class="form-control mgForm1" id="cpwd" name="cpwd" type="Password" value="" onkeypress='return errorMsgHide("ErrorMsg3")'>
										</div>	
										<span id="ErrorMsg3" class="label label-danger"></span>
									</div>
                                      <div class="form-group margin0 mbottom8">
										<label >User-Type:</label>
										<div >
											<select id="utype" name="utype" class="form-control mgForm1" onkeypress='return errorMsgHide("ErrorMsg4")'>
											<option selected='selected'>--Select--</option>
											<option value="1">Student</option>
                                            <option value="2">Educator</option>
										    </select>
										</div>
										<span id="ErrorMsg4" class="label label-danger"></span>
									</div>
									 <div class="form-group margin0 mbottom8">
										<label >Role:</label>
										<div >
											<select id="role" name="role" class="form-control mgForm1" onkeypress='return errorMsgHide("ErrorMsg5")'>
											<option selected='selected'>--Select--</option>
											<option value="1">Student</option>
                                            <option value="2">Educator</option>
										    </select>
										</div>
										<span id="ErrorMsg5" class="label label-danger"></span>
									</div>

									 <div class="form-group margin0 mbottom8">
										<label >Status:</label>
										<div >
											<select id="status" name="status" class="form-control mgForm1" onkeypress='return errorMsgHide("ErrorMsg6")'>
											<option selected='selected'>--Select--</option>
											<option value="T">Approve</option>
                                            <option value="F">UnApprove</option>
										    </select>
										</div>
										<span id="ErrorMsg6" class="label label-danger"></span>
									</div>
                                      <div align="center">
										<input type="submit" name="submit"  value="Submit" id="submit" form="insertform"  class="btn npBtn1 npBtn3 btn-default" OnClick="return insertuser_validation();"></div>
										
									</div>	
							</div>
						</div>
					</div>
				</div>
		</div>

	   <!-- Footer Start Here -->
	   <?php include_once('footer.php');?>
	   <!-- Footer End Here -->

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="js/index.js"></script>
	</body>
	</html>
	<?php ob_end_flush(); ?>
   
<?php 
	include "cs/config.php";
	if(isset($_POST['submit']))
	{
		$f_name = $_POST['fname'];
	    $l_name = $_POST['lname'];
	    $email = $_POST['email'];
	    $password = $_POST['pwd'];
	    $c_password = $_POST['cpwd'];
	    $user_type = $_POST['utype'];
	    $role = $_POST['role'];
	    $status = $_POST['status'];
		$regis_type='SELF';

		$resultds = mysqli_query($db,"call sp_insert_members('','".$email."','".$f_name."','".$l_name."','".$password."',
						'".$user_type."','".$role."','".$status."','".$regis_type."','".$c_password."','','','',
						'','','','','','','INSERT_MEMBERS',@resultmsg,@errormsg)") 
						or die('Query Not execute'.mysqli_error($db));
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
		   echo "<script>alert('User insert successfully!')</script>"; 
		}
		if ($result=="EXIST")
		{
		  echo "<script>alert('User email ID have already registered.')</script>";
		}
     }
     ?>