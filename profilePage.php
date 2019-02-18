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
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/jasny-bootstrap.min.css">
		<link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" href="css/profilePage.css">
		<link rel="stylesheet" href="css/responsive.css">
		<?php
		  /*Code start for forgot password*/
		  if(isset($_COOKIE['useremailid']))
		  {
			  if(isset($_POST['logoutuser']))
			  {
			     setcookie('useremailid', '', time() - 24*60*60, "/");
				 setcookie('roleid', '', time() - 24*60*60, "/");
				 setcookie('username', '', time() - 24*60*60, "/");
				 setcookie('userid', '', time() - 24*60*60, "/");
				 echo("<script>if(confirm('Do you want to logout from all devices')){
						window.location.href='logoutallaccess.php?userid=$UserEmail';
					 } else {
						window.location.href='".$WebSite_URL."';
					 };</script>");
			  }
		  }
		  else
		  {
		    $WebSite_URL="location:".$SiteURL;
		    header($WebSite_URL);
		  }
		?>
	</head>
	<body>
		<div class="mainWrap">
		
		 <!-- Header Start Here -->
	     <?php include_once('header.php');?>
	     <!-- Header End Here -->
		 
			<div class="container ppWrapMB">
				<div class="col-xs-12 padd0 mbHeadDiv">
					<div class="pull-left">
						<span class="glyphicon glyphicon-arrow-left"></span> <span class="uprofile">User Profile</span>
					</div>
				</div>
				<div class="col-xs-12 padd0 ndEco1">
					<div class="aoGraphBox">
								<div class="abTabCell aoTabCellL">
									<i class="fa fa-user uProIco" aria-hidden="true"></i>
								</div>
								<form method="post" id="frmuserprofile" name="frmuserprofile" action="<?php $_PHP_SELF ?>">
								<div class="abTabCell aoTabCellR">
								    <?php
								     if(isset($_COOKIE['useremailid']))
									 {
									 $UserId=$_COOKIE['userid'];
								     include "cs/config.php";
									 $dsuser = $db->query("call sp_get_common_user('GETUSERDETAILS','','".$_COOKIE['useremailid']."')");
									 $db->close();
									  if(mysqli_num_rows($dsuser)>0)
									  {
									     $row = mysqli_fetch_array($dsuser);
										 $UserName = $row['first_name'];
										 $UserEmailId = $row['subscriber_emailid'];
										 $MobileNo = $row['phone_no'];
										 if($MobileNo=='' || $MobileNo=='(NULL)' || $MobileNo=='NULL')
										 {
										    $MobileNo='NA';
										 }
										 mysqli_free_result($dsuser); 
										 echo "<div class='ppTabCellR1'><i class='fa fa-user' aria-hidden='true'></i> <span class='ppSpn1'>$UserName</span></div>
										 <div class='ppTabCellR2'><span class='glyphicon glyphicon-envelope'></span> <span class='ppSpn2'>$UserEmailId </span></div>
										 <div style='display:none;' class='ppTabCellR3'><i class='fa fa-phone' aria-hidden='true'></i><span class='ppSpn3'>$MobileNo</span></div>";
									  }
									 }
									 else
									{
										$WebSite_URL="location:".$SiteURL;
										header($WebSite_URL);
									}
						           ?>
									<!--<input type="submit" name="logoutuser" value="Logout from all Devices" class="btn npBtn1 btn-default" form="frmuserprofile" />-->
									<button type="submit" name="logoutuser" form="frmuserprofile" class="btn npBtn1 btn-default">
									<i class="fa fa-lock" aria-hidden="true"></i> Logout from all Devices</button>
								</div>
								</form>
							</div>
				</div>
				<div class="col-xs-12 padd0 ndEco2">
					<div class="mgLeftPart2">Your Order(s)</div>
				</div>
				<div class="col-xs-12 padd0 ndEco">
					<div class="mgLeftPart">
						<div id="datetimepicker2" class="input-append date npDivWidth1">
							<select class="form-control" style='display:none;'>
								<option>Filters</option>
								<option>Filters Option 1</option>
								<option>Filters Option 2</option>
								<option>Filters Option 3</option>
							</select>
						</div>
					</div>
				</div>
				
				<div class="col-xs-12 padd0">
					<div class="table-responsive">
						<table class="table aTable1 abTable1">
							<thead>
								<tr>
									<th>#</th>
									<th>TITLE</th>
									<th>PUBLISHERS</th>
									<th>LIST PRICE / ACCESS FROM</th>
									<th style='text-align: center;'>PURCHASE DATE</th>
									<th style='display:none;'>VALID TILL</th>
									<th style='display:none;' colspan="2">ACTION</th>
									<th style='text-align: center;width: 120px;'>ORDER DETAILS</th>
								</tr>
							</thead>
							<tbody>
							 <?php
							 include "cs/config.php";
							 $ds= mysqli_query($db,"call sp_get_common_data('','".$_COOKIE['useremailid']."','','','','','','','','','','','','','','','','GET_USER_BOOKS_NOTES')") or die('Query Not execute'.mysqli_error($db));
							 $db->close();
							 if(mysqli_num_rows($ds)>0)
							 {
							     $i=1;
								 while ($rown = mysqli_fetch_array($ds))
								 {
								    $BNId = $rown['id'];
								    $BookName = $rown['title'];
									$BookPublication = $rown['publication'];
									$priceval = $rown['price'];
									$PurchaseDate = $rown['order_date'];
									$ValidTo = $rown['valid_to'];
									$AuthorVal = $rown['author'];
									$GroupVal = $rown['subscription_type'];
									$CrtdByVal = $rown['crtd_by'];
								    if($priceval=="" || $priceval=="0" || $priceval=="(NULL)" || $priceval=="NULL")
								    {
									   if($GroupVal=="GROUP")
									   {
									      $priceval = 'Free / '. $CrtdByVal;
									   }
									   else
									   {
									     $priceval = 'Free / '.'Bookstore';
									   }
								    }
								    else
								    {
									   $priceval= "<i class='fa fa-inr' aria-hidden='true'></i>&nbsp;".$priceval. ' / Bookstore';
								    }
								    echo "<tr>
									<td>$i</td>
									<td>$BookName</td>
									<td style='text-align: left;width:150px;'>$BookPublication</td>
									<td style='text-align: left;width:190px;'>$priceval</td>
									<td style='text-align: center;width:185px;'>$PurchaseDate</td>
									<td style='display:none;'>$ValidTo</td>
									<td style='display:none;'><i class='fa fa-print' aria-hidden='true'></i></td>
									<td style='display:none;'><i class='fa fa-refresh' aria-hidden='true'></i></td>
									<td><a title='$titleval' href='invoice.php?bookid=$BNId&userid=$UserId&useremailid=$UserEmailId']' target='_blank'>Click here</a></td>
								    </tr>";
								     $i=$i+1;
								 }
							     mysqli_free_result($ds);
							 }
							 ?>
							</tbody>
						</table>
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
		<script src="js/jasny-bootstrap.min.js"></script>
		<script src="js/index.js"></script>
	</body>
</html>
<?php ob_end_flush(); ?>