<!DOCTYPE html>
<?php ob_start(); ?>
<?php require_once "cs/config.php"; ?>
<html lang="en">
	<head>
		<title>1Book</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="<?php echo $SiteURL;?>img/fevicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/bank_details.css">
		
		<link rel="stylesheet" href="css/jasny-bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
		<link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" href="css/notesPage.css">
		<link rel="stylesheet" href="css/responsive.css">
		
		
		<!-- Validation start for add Bank Details  -->  
		<script language="javascript" type="text/javascript">
		function bank_validation()
		{
		    if(document.getElementById("user_name").value=="")
			{
				alert("Please enter account holder name");
				document.getElementById("user_name").focus();
				return false;
			}
			if(document.getElementById("bank_name").value=="")
			{
				alert("Please enter bank name");
				document.getElementById("bank_name").focus();
				return false;
			}
			if(document.getElementById("branch_name").value=="")
			{
				alert("Please enter branch name");
				document.getElementById("branch_name").focus();
				return false;
			}
			if(document.getElementById("ifsccode").value=="")
			{
				alert("Please enter ifsc code");
				document.getElementById("ifsccode").focus();
				return false;
			}
			if(document.getElementById("pannum").value=="")
			{
				alert("Please enter PAN number");
				document.getElementById("pannum").focus();
				return false;
			}
			var ddlaccount_type = document.getElementById("account_type");
			if(ddlaccount_type.value=="NONE")
			{
			  alert("Please select account type");
			  return false;
			}
			if(document.getElementById("accountnum").value=="")
			{
				alert("Please enter account number");
				document.getElementById("accountnum").focus();
				return false;
			}
			if(document.getElementById("confaccountnum").value=="")
			{
				alert("Please enter confirm account number");
				document.getElementById("confaccountnum").focus();
				return false;
			}
			
		}
		</script>
		
		<!-- Validation end for add Bank Details  -->  
		
	    <!-- Code start for insert Bank Details --> 
	    <?php
			include "cs/config.php";
			if(isset($_COOKIE['useremailid']))
			{
				$msgerror="false";
				$UserID="0";
				$UserEmailID=$_COOKIE['useremailid'];
				if(isset($_POST['submit']))
				{
				  $BankAutoID = mysqli_real_escape_string($db,$_POST['hdn_auto_id']);
				  $user_nameval = mysqli_real_escape_string($db,$_POST['user_name']);
				  $bank_nameval = mysqli_real_escape_string($db,$_POST['bank_name']);
				  $ifsccodeval = mysqli_real_escape_string($db,$_POST['ifsccode']);
				  $account_typeval = mysqli_real_escape_string($db,$_POST['account_type']);
				  $branch_nameval = mysqli_real_escape_string($db,$_POST['branch_name']);
				  $phonenumval = mysqli_real_escape_string($db,$_POST['phonenum']);
				  $pannumval = mysqli_real_escape_string($db,$_POST['pannum']);
				  $accountnumval = mysqli_real_escape_string($db,$_POST['accountnum']);
				  $confaccountnumval = mysqli_real_escape_string($db,$_POST['confaccountnum']);
				  $statusval="A";
				  
				 if($accountnumval==$confaccountnumval)
				 {
					$msgerror = "false";
				  }
				  else
				  {
					$msgerror = "true";
				   echo "<script>alert('Account Number did not match! Try again')</script>";
				  }
				 if ($msgerror=="false") 
				 {
				  $resultds = mysqli_query($db,"call sp_insert_bankdetails('".$BankAutoID."','".$UserID."','".$UserEmailID."','".$bank_nameval."',
				  '".$ifsccodeval."','".$account_typeval."','".$accountnumval."',
				  '".$UserEmailID."','".$UserEmailID."','".$statusval."','".$user_nameval."','".$branch_nameval."','".$phonenumval."','".$pannumval."','',
				  'INSERT_BANKDETAILS',@resultmsg,@errormsg)") or die('Query Not execute'.mysqli_error($db));
				  $db->close();
				  if (mysqli_num_rows($resultds) > 0) {
				  while($row = mysqli_fetch_array($resultds)) 
				  {
					 $result= $row['resultval'];
					 $IsError= $row['IsErrorval'];
				  }
				   mysqli_free_result($resultds);
				  }
				
				  if ($result=="INSERT")
				  {
				   echo "<script>alert('Bank Details Saved Successfully.')</script>"; 
				  }
				  if ($result=="UPDATE")
				  {
				   echo "<script>alert('Bank Details Updated Successfully.')</script>"; 
				  }
				  if ($result=="EXIST")
				  {
					echo "<script>alert('Error Ocured Try Again.')</script>"; 
				  }
				}
			 }
		   }
			else
			{
				$WebSite_URL="location:".$SiteURL;
				header($WebSite_URL);
			}
	    ?> 
	    <!-- Code end for insert Bank Details --> 
		
		
		
		<!-- Code start for edit Bank Details --> 
	    <?php
			include "cs/config.php";
			if(isset($_COOKIE['useremailid']))
			{
				$msgerror="false";
				$UserID="0";
				$UserEmailID=$_COOKIE['useremailid'];
				if(isset($_POST['edit']))
				{
				  $dsbde = mysqli_query($db,"call sp_get_common_data('','".$UserEmailID."','','','','','','A','','','','','','','','','','GET_BANK_DETAILS')")  or die('Query Not execute'.mysqli_error($db));
				  $db->close();
				  if(mysqli_num_rows($dsbde)>0)
				  {
				    $FlagInsert="EDIT";
					$FlagGet="FALSE";
					while ($rowe = mysqli_fetch_array($dsbde))
					{ 
					     $BankAutoVal = $rowe['auto_id'];
						 $BankNameEditVal = $rowe['bank_name'];
						 $IfscCodeEditVal = $rowe['ifsc_code'];
						 $AccTypeEditVal = $rowe['account_type'];
						 $AccNoEditVal = $rowe['account_no'];
						 $AccHolNameEditVal = $rowe['account_holder_name'];
						 $BranchNameEditVal = $rowe['branch_name'];
						 $ContactNoEditVal = $rowe['contact_no'];
						 $PancardNoEditVal = $rowe['pancard_no'];
						 $BankNameGetVal = $BankNameEditVal;
						 $IfscCodeGetVal = $IfscCodeEditVal;
						 $AccTypeGetVal = $AccTypeEditVal ;
						 $AccNoGetVal = $AccNoEditVal;
						 $AccHolNameGetVal = $AccHolNameEditVal;
						 $BranchNameGetVal = $BranchNameEditVal;
						 $ContactNoGetVal = $ContactNoEditVal;
						 $PancardNoGetVal = $PancardNoEditVal;
					}
				  }
				  mysqli_free_result($dsbde);
			    }
				else
				{
				  $dsbd = mysqli_query($db,"call sp_get_common_data('','".$UserEmailID."','','','','','','A','','','','','','','','','','GET_BANK_DETAILS')")  or die('Query Not execute'.mysqli_error($db));
				  $db->close();
				  if(mysqli_num_rows($dsbd)>0)
				  {
				    $FlagInsert="FALSE";
					while ($rowmem = mysqli_fetch_array($dsbd))
					{ 
						 $BankNameGetVal = $rowmem['bank_name'];
						 $IfscCodeGetVal = $rowmem['ifsc_code'];
						 $AccTypeGetVal = $rowmem['account_type'];
						 $AccNoGetVal = $rowmem['account_no'];
						 $AccHolNameGetVal = $rowmem['account_holder_name'];
						 $BranchNameGetVal = $rowmem['branch_name'];
						 $ContactNoGetVal = $rowmem['contact_no'];
						 $PancardNoGetVal = $rowmem['pancard_no'];
					}
				  }
				  else
				  {
				     $FlagGet="FALSE";
				     $FlagInsert="TRUE";
					 $BankNameGetVal = "";
					 $IfscCodeGetVal = "";
					 $AccTypeGetVal = "";
					 $AccNoGetVal = "";
					 $AccHolNameGetVal ="";
					 $BranchNameGetVal="";
					 $ContactNoGetVal="";
					 $PancardNoGetVal="";
				  }
				  mysqli_free_result($dsbd);
				}
		    }
			else
			{
				$WebSite_URL="location:".$SiteURL;
				header($WebSite_URL);
			}
	    ?> 
	    <!-- Code end for edit Bank Details --> 
		 
	</head>
	<body>
       <div class="mainWrap">
	   
	         <!-- Dashboard Start Here -->
			 <?php include_once('dashboard.php');?>
			 <!-- Dashboard End Here -->
			 
		 <div class="container wrapMB">
		 
		  <form <?php if($FlagInsert=="FALSE"){echo 'style=display:none;';} else {echo 'style=display:block;';} ?> class="well form-horizontal payForm" method="post" id="frmbankdetails"  enctype="multipart/form-data" action= "<?php $_PHP_SELF ?>">
			<fieldset>
				<!-- Form Name -->
				<legend class="payLegend">Payment Detail</legend>
				<!-- Text input-->
				<div class="form-group">
					<label class="col-sm-4 control-label">Name of Account Holder</label>  
					<div class="col-sm-6 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
							<input name="user_name" id="user_name" placeholder="Name of Account Holder" class="form-control" type="text" form="frmbankdetails" value="<?php echo $AccHolNameEditVal; ?>">
						</div>
					</div>
				</div>
				<!-- Text input-->
				<div class="form-group">
					<label class="col-sm-4 control-label">Bank Name</label>  
					<div class="col-sm-6 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
							<input name="bank_name" id="bank_name" placeholder="Bank Name" class="form-control" type="text" form="frmbankdetails" value="<?php echo $BankNameEditVal; ?>">
						</div>
					</div>
				</div>
				<!-- Select Basic -->
				<div class="form-group">
					<label class="col-sm-4 control-label">Account Type</label>
					<div class="col-sm-6 selectContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
							<select name="account_type" id="account_type" class="form-control selectpicker" form="frmbankdetails">
								<option value="NONE">Please select your account type</option>
								<!--<option value="SAVING">Saving Account</option>
								<option value="CURRENT">Current Account</option>-->
								<option value="SAVING" <?php if($AccTypeEditVal=="SAVING"){echo 'selected=selected';} ?>>Saving Account</option>
								<option value="CURRENT" <?php if($AccTypeEditVal=="CURRENT"){echo 'selected=selected';} ?>>Current Account</option>
							</select>
						</div>
					</div>
				</div>
				<!-- Text input-->
				<div class="form-group">
					<label class="col-sm-4 control-label">Branch</label>  
					<div class="col-sm-6 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
							<input name="branch_name" id="branch_name" placeholder="Branch" class="form-control" type="text" form="frmbankdetails" value="<?php echo $BranchNameEditVal; ?>">
						</div>
					</div>
				</div>
				<!-- Text input-->
				<div class="form-group">
					<label class="col-sm-4 control-label" >IFSC Code</label> 
					<div class="col-sm-6 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-file-code-o" aria-hidden="true"></i></span>
							<input name="ifsccode" id="ifsccode" placeholder="IFSC Code" class="form-control" type="text" form="frmbankdetails" value="<?php echo $IfscCodeEditVal; ?>">
						</div>
					</div>
				</div>
				<!-- Text input-->
				<div class="form-group">
					<label class="col-sm-4 control-label">Registered Phone Number</label>  
					<div class="col-sm-6 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></span>
							<input name="phonenum" id="phonenum" placeholder="Registered Phone Number" class="form-control" type="text" form="frmbankdetails" value="<?php echo $ContactNoEditVal; ?>">
						</div>
					</div>
				</div>
				<!-- Text input-->
				<div class="form-group">
					<label class="col-sm-4 control-label">PAN Number</label>  
					<div class="col-sm-6 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></span>
							<input name="pannum" id="pannum" placeholder="PAN Number" class="form-control" type="text" form="frmbankdetails" value="<?php echo $PancardNoEditVal; ?>">
						</div>
					</div>
				</div>
				<!-- Text input-->
				<div class="form-group">
					<label class="col-sm-4 control-label">Account Number</label>  
					<div class="col-sm-6 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></span>
							<input name="accountnum" id="accountnum" placeholder="Your Account Number" class="form-control" type="text" form="frmbankdetails" value="<?php echo $AccNoEditVal; ?>">
						</div>
					</div>
				</div>
				<!-- Text input-->
				<div class="form-group">
					<label class="col-sm-4 control-label">Confirm Account Number</label>  
					<div class="col-sm-6 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></span>
							<input name="confaccountnum" id="confaccountnum" placeholder="Confirm Account Number" class="form-control" type="text" form="frmbankdetails" value="<?php echo $AccNoEditVal; ?>">
						</div>
					</div>
				</div>
				<!-- Button -->
				<div class="form-group">
					<label class="col-sm-4 control-label"></label>
					<div class="col-sm-6 text-right">
						<button type="submit" name="submit" id="submit" form="frmbankdetails" class="btn btn-warning" onclick="return bank_validation();">Save <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
						<!--<input type="submit" class="btn btn-warning" name="submit" id="submit" form="frmbankdetails" value="CREATE">-->
						<input type="hidden" form="frmbankdetails" id="hdn_auto_id" name="hdn_auto_id" value="<?php echo $BankAutoVal; ?>">
					</div>
				</div>
			</fieldset>
		</form>
		
		
		
		<form <?php if($FlagGet=="FALSE"){echo 'style=display:none;';} else {echo 'style=display:block;';} ?> class="well form-horizontal payForm payFormHS" method="post" id="frmbankdetailsget"  enctype="multipart/form-data" action= "<?php $_PHP_SELF ?>">
			<fieldset>
				<!-- Form Name -->
				<legend class="payLegend">Payment Details</legend>
				<!-- Text input-->
				<div class="form-group">
					<label class="col-xs-5 control-label">Name of Account Holder</label>  
					<div class="col-xs-7 inputGroupContainer">
							<span><?php echo  $AccHolNameGetVal ?></span>
					</div>
				</div>
				<!-- Text input-->
				<div class="form-group">
					<label class="col-xs-5 control-label">Account Number</label>  
					<div class="col-xs-7 inputGroupContainer">
						<span><?php echo $AccNoGetVal ?></span>
					</div>
				</div>
				<!-- Text input-->
				<div class="form-group">
					<label class="col-xs-5 control-label">Bank Name</label>  
					<div class="col-xs-7 inputGroupContainer">
							<span><?php echo $BankNameGetVal ?></span>
					</div>
				</div>
				<!-- Select Basic -->
				<div class="form-group">
					<label class="col-xs-5 control-label">Account Type</label>
					<div class="col-xs-7 inputGroupContainer">						
						<?php 
						if($AccTypeGetVal=="SAVING")
						{
						   $AccTypeGetVal="Saving Account";
						   ?><span><?php echo $AccTypeGetVal ?></span><?php 
						}
						else if($AccTypeGetVal=="CURRENT")
						{
						   $AccTypeGetVal="Current Account";
						   ?><span><?php echo $AccTypeGetVal ?></span><?php 
						}
						else
						{
						  $AccTypeGetVal="";
						  ?><span><?php echo $AccTypeGetVal ?></span><?php 
						}
						?>
					</div>
				</div>
				<!-- Text input-->
				<div class="form-group">
					<label class="col-xs-5 control-label">Branch</label>  
					<div class="col-xs-7 inputGroupContainer">
							<span><?php echo $BranchNameGetVal ?></span>
					</div>
				</div>
				<!-- Text input-->
				<div class="form-group">
					<label class="col-xs-5 control-label" >IFSC Code</label> 
					<div class="col-xs-7 inputGroupContainer">
						<span><?php echo $IfscCodeGetVal ?></span>
					</div>
				</div>
				<!-- Text input-->
				<div class="form-group">
					<label class="col-xs-5 control-label" >Registered Phone Number</label> 
					<div class="col-xs-7 inputGroupContainer">
						<span><?php echo $ContactNoGetVal ?></span>
					</div>
				</div>
				<!-- Text input-->
				<div class="form-group">
					<label class="col-xs-5 control-label" >PAN Number</label> 
					<div class="col-xs-7 inputGroupContainer">
						<span><?php echo $PancardNoGetVal ?></span>
					</div>
				</div>
				<!-- Button -->
				<div class="form-group">
					<label class="col-xs-5 control-label"></label>
					<div class="col-xs-7 text-right">
						<button type="submit" name="edit" id="edit" class="btn btn-warning" form="frmbankdetailsget">Edit <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
					</div>
				</div>
			</fieldset>
		</form>
		
		     <div style="margin:0px 50px 0px 50px"><p style="font-size: 1em;margin:0px; padding:0px;"><font color="black">Note: </font>All the payments shall be made in compliance with provisions of Income Tax Act, 1961 or any other act for the time being in force in India.</p></div>
		</div>
		
		<div class="col-xs-12 footer2a">
				<div class="pull-left xs_100">Copyrights @ 2016 1Book All Right Reserved</div>
				<div class="pull-right xs_100">Designed by <a href="http://www.4cplus.com" target="_blank">4C Plus</a></div>
			</div>
			
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="js/jasny-bootstrap.min.js"></script>
		<script src="js/bootstrap-datetimepicker.min.js"></script>
		<script src="js/index.js"></script>
		
	</body>
</html>
<?php ob_end_flush(); ?>