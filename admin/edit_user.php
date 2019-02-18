<!DOCTYPE html>
<?php ob_start(); ?>
<?php include "../cs/config.php"; ?>
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
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/jasny-bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/bootstrap-datetimepicker.min.css">
		<!--<link rel="stylesheet" href="<?php echo $SiteURL;?>css/manageGroups.css">-->
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/common.css">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/dashboard.css">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/responsive.css">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/manageBooks.css">
		<!--<link href="./css/style1.css" rel="stylesheet">-->
		
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
 
 
        <!-- Code start for get user details -->
		<?php
			//session_start();
			include "../cs/config.php";
			if(isset($_GET['userid']) && count($_GET) > 0 ) 
         	{				 
				
				$UserId=$_GET['userid'];
				if(isset($_COOKIE['useremailid']))
				{
					$qrygetds = mysqli_query($db,"call sp_get_users('".$UserId."','','','','','','','','','GET_USER_DETAILS')");
					$db->close();
					if(mysqli_num_rows($qrygetds)>0)
					{
						while($row = mysqli_fetch_array($qrygetds))
						{
							$subscriber_id_get=$row['Subscriber_id'];
							$first_name_get=$row['first_name'];
							$last_name_get=$row['last_name'];
							$subscriber_emailid_get=$row['subscriber_emailid'];
							$password_get=$row['password'];
							$user_type_get=$row['user_type'];
							$role_id_get=$row['role_id'];
							$status_get=$row['status'];			
						}
						 mysqli_free_result($qrygetds);
					}
				}
			}
			?>
	   <!-- Code end for get user details -->
	   

</head>
<body>

<div class="mainWrap">
 
	  <!-- Dashboard Start Here -->
	  <?php include_once('../dashboard.php');?>
	  <!-- Dashboard End Here -->

	 <div class="container wrapMB">
	 
	        <div class="col-xs-12 padd0 mbHeadDiv">
					<div class="pull-left">
						<img src="<?php echo $SiteURL;?>img/readerIcons/subscribers_big.png" alt="User Logo" class="img-responsive mbBshelf"/>
						<div class="mbManage">
							<div class="mBooksTxt">Edit Educators</div>
							<ul class="list-inline">
								<!--<li><a href="#">Monthwise</a></li>
								<li><a href="#">Subscribers</a></li>-->
								<li><a href="<?php echo $SiteURL;?>admin/modify_user.html">Manage Educators</a></li>
							</ul>
						</div>
					</div>
					<div class="pull-right" style="display:none;">
						<form class="mtop19">
							<?php
							  $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
							  echo "<a class='btn ndBtn1 btn-default' href='$url'><i class='fa fa-angle-left' aria-hidden='true'></i> Back</a>"; 
						    ?>
						</form>
					</div>
				</div>
			<div class="col-xs-12 padd0 ndEco" style="display:none;">
					<div class="mgLeftPart" style="display:none;">
					
					<div class="input-group searchInput">
						<input type="text" class="form-control" placeholder="Search here..." />
						<div class="input-group-btn">
							<div class="btn-group" role="group">
								<button type="button" class="btn"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
							</div>
						</div>
					</div>
							
					
						<div id="datetimepicker1" class="input-append date npDivWidth1">
							<input data-format="dd/MM/yyyy" type="text" class="form-control user_drop_dwn border_radius4" placeholder="From Date" readonly />
							<span class="add-on input-group-addon no_css">
							<i class="fa fa-calendar clrOrange"></i>
							</span>
						</div>
						<div id="datetimepicker2" class="input-append date npDivWidth1">
							<input data-format="dd/MM/yyyy" type="text" class="form-control user_drop_dwn border_radius4" placeholder="To Date" readonly />
							<span class="add-on input-group-addon no_css">
							<i class="fa fa-calendar clrOrange"></i>
							</span>
						</div>

						<form class="goBtnForm1">
							<a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
						</form>
					</div>
					
					<div class="mgRightPart rightBtn" style="display:none;">
						<button type="button" class="btn btn-default">Active/Inactive</button>
						<button type="button" class="btn btn-default">Reset</button>
					</div>
				</div>
				
			<div class="col-xs-12 padd0">
			  <div class="col-xs-9 paddR0">
			   <form class="form-horizontal horizontalForm" enctype="multipart/form-data" method="post" id="insertform" name="insertform"  action= "<?php $_PHP_SELF ?>">
				    <div class="form-group">
						<label class="control-label col-sm-2 padd0" for="mbForm1">First Name:</label>
						<div class="col-sm-10 paddR0">
							<input class="form-control" id="fname" name="fname" type="text" value="<?php echo $first_name_get; ?>" onkeypress='return errorMsgHide("ErrorMsg")'>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2 padd0" for="mbForm1">Last Name:</label>
						<div class="col-sm-10 paddR0">
							<input class="form-control" id="lname" name="lname" type="text" value="<?php echo $last_name_get; ?>" onkeypress='return errorMsgHide("ErrorMsg0")'>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2 padd0" for="mbForm1">E-Mail-Address:</label>
						<div class="col-sm-10 paddR0"> 
							<input class="form-control" id="email" name="email" type="email" value="<?php echo $subscriber_emailid_get; ?>" onkeypress='return errorMsgHide("ErrorMsg1")' readonly="true">
						</div>
					</div>
					<div class="form-group" style="display:none;">
						<label class="control-label col-sm-2 padd0" for="mbForm1">Password:</label>
						<div class="col-sm-10 paddR0">
							<input class="form-control" id="pwd" name="pwd" type="password" value="<?php echo $password_get; ?>" onkeypress='return errorMsgHide("ErrorMsg2")'>
						</div>
					</div>
					<div class="form-group" style="display:none;">
						<label class="control-label col-sm-2 padd0" for="mbForm1">Confirm Password:</label>
						<div class="col-sm-10 paddR0">
							<input class="form-control" id="cpwd" name="cpwd" type="Password" value="<?php echo $password_get; ?>" onkeypress='return errorMsgHide("ErrorMsg3")'>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2 padd0" for="mbForm1">User-Type:</label>
						<div class="col-sm-10 paddR0">
							<select id="utype" name="utype" class="form-control" onkeypress='return errorMsgHide("ErrorMsg4")'>
							<option selected='selected'>--Select--</option>
							<option value="1" <?php if($user_type_get=="1"){echo 'selected=selected';} ?>>Student</option>
							<option value="2" <?php if($user_type_get=="2"){echo 'selected=selected';} ?>>Educator</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2 padd0" for="mbForm1">Role:</label>
						<div class="col-sm-10 paddR0">
							<select id="role" name="role" class="form-control" onkeypress='return errorMsgHide("ErrorMsg5")'>
							<option selected='selected'>--Select--</option>
							<option value="1" <?php if($role_id_get=="1"){echo 'selected=selected';} ?>>Student</option>
							<option value="2" <?php if($role_id_get=="2"){echo 'selected=selected';} ?>>Educator</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2 padd0" for="mbForm1">Status:</label>
						<div class="col-sm-10 paddR0">
							<select id="status" name="status" class="form-control" onkeypress='return errorMsgHide("ErrorMsg6")'>
							<option selected='selected'>--Select--</option>
							<option value="T" <?php if($status_get=="T"){echo 'selected=selected';} ?>>Approve</option>
							<option value="F" <?php if($status_get=="F"){echo 'selected=selected';} ?>>UnApprove</option>
							</select>
						</div>
					</div>
					<div class="col-xs-12 padd0 mtop20" style="text-align:center;">
					<input type="submit" name="submit"  value="Update" id="submit" form="insertform"  class="btn mbBtn1 btn-default" OnClick="return insertuser_validation();">
					<!--<button type="button" class="btn mbBtn2 btn-default">CANCEL</button>-->
					</div>
					</div>
				</form>	   
			  </div>
			</div>
	</div>
	<div class="col-xs-12 footer2a">
		<div class="pull-left xs_100">Copyrights @ 2016 1Book All Right Reserved</div>
		<div class="pull-right xs_100">Designed by <a href="http://www.4cplus.com" target="_blank">4C Plus</a></div>
	</div>
</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="<?php echo $SiteURL;?>js/jasny-bootstrap.min.js"></script>
		<script src="<?php echo $SiteURL;?>js/bootstrap-datetimepicker.min.js"></script>
		<script src="<?php echo $SiteURL;?>js/index.js"></script>
	</body>
	</html>
	<?php ob_end_flush(); ?>
   
<?php 
	include "../cs/config.php";
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

		$resultds = mysqli_query($db,"call sp_insert_members('".$UserId."','".$email."','".$f_name."','".$l_name."','".$password."',
		'".$user_type."','".$role."','".$status."','".$regis_type."','".$c_password."','','','',
		'','','','','','','UPDATE_USER',@resultmsg,@errormsg)") 
		or die('Query Not execute'.mysqli_error($db));
		$db->close();	
		if (mysqli_num_rows($resultds) > 0) {
			 while($row = mysqli_fetch_array($resultds)) {
			     $result= $row['resultval'];
			     $IsError= $row['IsErrorval'];
			 }
			 mysqli_free_result($resultds);
		}
		
		if ($result=="UPDATE")
		{
		   echo "<script>alert('User update successfully!')</script>"; 
		}
		if ($result=="EXIST")
		{
		  echo "<script>alert('User email ID have already registered.')</script>";
		}
     }
     ?>