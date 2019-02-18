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
		<link rel="shortcut icon" href="<?php echo $SiteURL;?>img/fevicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/jasny-bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
		<link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" href="css/manageGroups.css">
		<link rel="stylesheet" href="css/responsive.css">

		<!-- Code start for get the member's details--> 
		<?php
			include "cs/config.php";
			$Gid = mysqli_real_escape_string($db,$_GET['groupid']);
			$Mid = mysqli_real_escape_string($db,$_GET['memberid']);
            $run = mysqli_query($db,"call sp_get_common_data('".$Mid."','','','','','','','A','".$Gid."','','','','','','','','','GET_MEMBERS_DETAILS')") or die('Query Not execute'.mysqli_error($db));
			$db->close();
			if(mysqli_num_rows($run)>0)
			{
				while($row = mysqli_fetch_array($run))
				{
				$group_id = $row['group_id'];
				$firstname = $row['member_name'];
				$details1 = $row['registration_no'];
				$details2 = $row['phone_no'];
				//$hdncourseid = $row['course_id'];
				//$hdnsubjectid = $row['subject_id'];
				//$grouptiming = $row['group_timing'];
				//$groupdesc = $row['group_desc'];
			   }
		   }
		?>
		<!-- Code end for get the member's details--> 
		
		<!-- Code start for update the member's details--> 
		<?php 
		    //session_start();
			include "cs/config.php";
			if(isset($_COOKIE['useremailid']))
			  {
				if(isset($_POST['update']))
				{
					 $Gid = mysqli_real_escape_string($db,$_GET['groupid']);
					 $Mid = mysqli_real_escape_string($db,$_GET['memberid']);
					 $firstname = mysqli_real_escape_string($db,$_POST['focusedInput1']);
					 $details1 = mysqli_real_escape_string($db,$_POST['focusedInput2']);
					 $details2 = mysqli_real_escape_string($db,$_POST['focusedInput3']);

					$UserID=$_COOKIE['useremailid'];
					
					$resultds = mysqli_query($db,"call sp_insert_members('".$Mid."','','".$firstname."','".$firstname."','".$User_Password."',
					'','','','','".$details1."','".$details2."','".$details1."','".$details2."',
					'','','','".$UserID."','".$UserID."','".$Gid."','UPDATE_MEMBERS',@resultmsg,@errormsg)") or die('Query Not execute'.mysqli_error($db));
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
					   echo "<script>alert('Member Updated Successfully.')</script>"; 
					 }
					
					 $path="?groupid=$Gid";
					 header("location:manageListMembers.php".$path);
				}
			}
			else
			{
			    $WebSite_URL="location:".$SiteURL;
			    header($WebSite_URL);
			}
		  ?>
		  <!-- Code end for update the member's details--> 
	</head>
	<body>
		<div class="mainWrap">
			
			<!-- Dashboard Start Here -->
			 <?php include_once('dashboard.php');?>
			 <!-- Dashboard End Here -->

			  <?php 
			  $path = $_SERVER['PHP_SELF']; // will return http://xyz.com/two.php for our example
			  $page = basename($path); // will return two.php
			  $page = basename($path, '.php');
			  ?>
			
			<div class="container wrapMB">
				<div class="col-xs-12 padd0 mbHeadDiv">
					<div class="pull-left">
						<img src="img/readerIcons/subscribers_big.png" alt="Bookshelf Logo" class="img-responsive mbBshelf"/>
						<div class="mbManage">
							<div class="mBooksTxt">Manage Groups</div>
							<ul class="list-inline">
								 <!-- Code start for header --> 
							    <?php 
								if(isset($_COOKIE['useremailid']))
								{
									if($_COOKIE['roleid']=="3")
									{
									?>		
									<li><a href="#">Subscriber Details</a></li>
									<?php 
									}
									else if($_COOKIE['roleid']=="2")
									{
										?><li><a class="<?php echo ($page == "manageGroups" ? "active" : "")?>" href="manageGroups.html">Manage Groups</a></li><?php 
									}
								}
								?>
								<!-- Code end for header --> 
								<!--<li><a href="#">Send Notification</a></li>
								<li><a href="#">Free Subscription</a></li>--> 
							</ul>
						</div>
					</div>
					<div class="pull-right">
						<div class="mtop19" style="display:none;">
							<img src="img/readerIcons/subscribers_mid.png" alt="Subscriber Logo" class="img-responsive rightIcons1 mRight10" />
							<img src="img/readerIcons/invite_frnd_mid.png" alt="Invite Friend Logo" class="img-responsive rightIcons1" />
						</div>
					</div>
				</div>
				<div class="col-xs-12 padd0 ndEco">
				</div>
					<div class="modal-dialog modal-md" style="margin:80px auto;">
					<form class="form-horizontal modForm1" method="post" id="form1" name="form1" enctype="multipart/form-data" action= "<?php $_PHP_SELF ?>">
						<div class="modal-content">
							<div class="modal-header modHead1">
								<h4 class="modal-title">UPDATE MEMBER</h4>
							</div>
							<div class="modal-body modBody1">
									<div class="form-group margin0 mbottom8">
										<label class="col-sm-2 control-label padd0 fWeight">Name</label>
										<div class="col-sm-10 paddL10R0">
											 <input class="form-control mgForm1" id="focusedInput1" name="focusedInput1" type="text" value="<?php echo $firstname; ?>">
										</div>
									</div>
									<div class="form-group margin0 mbottom8">
										<label class="col-sm-2 control-label padd0 fWeight">Registration No</label>
										<div class="col-sm-10 paddL10R0">
											<input class="form-control mgForm1" id="focusedInput2" name="focusedInput2" type="text" value="<?php echo $details1; ?>">
										</div>
									</div>
									<div class="form-group margin0 mbottom8">
										<label class="col-sm-2 control-label padd0 fWeight">Phone No</label>
										<div class="col-sm-10 paddL10R0">
											<input class="form-control mgForm1" id="focusedInput3" name="focusedInput3" type="text" value="<?php echo $details2; ?>">
									</select>
										</div>
									</div>
									<!--<div class="form-group margin0 mbottom8">
										<label class="col-sm-2 control-label padd0 fWeight">Timings</label>
										<div class="col-sm-10 paddL10R0">
											<input class="form-control mgForm1" id="focusedInput4" name="focusedInput4" type="text" value="<?php echo $firstname; ?>">
										</div>
									</div>
									<div class="form-group margin0 mbottom8">
										<label class="col-sm-2 control-label padd0 fWeight">Summary</label>
										<div class="col-sm-10 paddL10R0">
											<textarea class="form-control mgForm1 mgTextArea1" id="focusedInput5" name="focusedInput5" rows="5"><?php echo $firstname; ?></textarea>
										</div>
									</div>-->
									<!--<input type="hidden" id="hdn_course_id" name="hdn_course_id" value="<?php echo $hdncourseid;?>">
							        <input type="hidden" id="hdn_subject_id" name="hdn_subject_id" value="<?php echo $hdnsubjectid;?>">-->
								
							</div>
							<div class="modal-footer modFoot1 text-left">
								<div class="col-xs-10 col-xs-offset-2 paddL10R0">
									<div class="goBtnForm2">
										<input type="submit" class="btn npBtn1 npBtn3 btn-default" name="update" id="update" form="form1" value="UPDATE">
									</div>
									<button type="button" class="btn btn-default npBtn4" data-dismiss="modal" onclick="window.close()">CANCEL</button>
								</div>
							</div>
						</form>
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
		<script src="js/bootstrap-datetimepicker.min.js"></script>
		<script src="js/index.js"></script>
		<script>
			/* Date Time Function Start */
			$(function() {
				$('#datetimepicker1, #datetimepicker2').datetimepicker({
				pickTime: false
				});
			});
			/* End */

			function hover1(element) {
			    element.setAttribute('src', 'img/readerIcons/bookshelf_orange.png');
			}
			function unhover1(element) {
			    element.setAttribute('src', 'img/readerIcons/bookshelf_black.png');
			}
		</script>
	</body>
</html>
<?php ob_end_flush(); ?>