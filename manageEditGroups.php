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
		<link rel="stylesheet" href="css/jasny-bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
		<link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" href="css/manageGroups.css">
		<link rel="stylesheet" href="css/responsive.css">
		 <!-- Code start for get the group details --> 
		<?php
			include "cs/config.php";
			$Gid = mysqli_real_escape_string($db,$_GET['groupid']);
			$qrygetds = mysqli_query($db,"call sp_get_common_data('','','','','','','','A','".$Gid."','','','','','','','','','GET_GROUPS')") or die('Query Not execute'.mysqli_error($db));
			$db->close();
			if(mysqli_num_rows($qrygetds)>0)
			{
				while($row = mysqli_fetch_array($qrygetds))
				{
					$group_id = $row['group_id'];
					$groupname = $row['group_name'];
					$hdncourseid = $row['course_id'];
					$hdnsubjectid = $row['subject_id'];
					$grouptiming = $row['group_timing'];
					$groupdesc = $row['group_desc'];
				}
		   }
		?>
		<!-- Code end for get the group details --> 
		
		<!-- Code start for update group --> 
		<?php 
			include "cs/config.php";
			//session_start();
			if(isset($_POST['update']))
			{
			     $UserID=$_COOKIE['useremailid'];
				 $Gid = mysqli_real_escape_string($db,$_GET['groupid']);
				 $group_name = mysqli_real_escape_string($db,$_POST['focusedInput1']);
				 $course_id = mysqli_real_escape_string($db,$_POST['focusedInput2']);
				 $subject_id = mysqli_real_escape_string($db,$_POST['focusedInput3']);
				 $group_timing = mysqli_real_escape_string($db,$_POST['focusedInput4']);
				 $group_desc = mysqli_real_escape_string($db,$_POST['focusedInput5']);
				 $group_status='A';
				 $meta_keyword = '';
				 $meta_desc = '';
				 
				 $resultds = mysqli_query($db,"call sp_insert_groups('".$Gid."','".$course_id."','".$subject_id."','".$group_name."','".$group_desc."','".$group_status."','".$group_timing."','".$UserID."','".$UserID."','','','','','','".$meta_keyword."','".$meta_desc."','UPDATE_GROUPS',@resultmsg,@errormsg)") or die('Query Not execute'.mysqli_error($db));
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
				   echo "<script>alert('Group Updated Successfully.')</script>"; 
				 }
				 if ($result=="EXIST")
				 {
					echo "<script>alert('Error Ocured Try Again.')</script>"; 
				 }
				 
				 header("location:manageGroups.html");
			}
		  ?>
		 <!-- Code end for update group --> 
		 
	   <script>
		function goBack() {
			window.history.go(-1);
		}
		</script>

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
						<form class="mtop19" style="display:none;">
							<img src="img/readerIcons/subscribers_mid.png" alt="Subscriber Logo" class="img-responsive rightIcons1 mRight10" />
							<img src="img/readerIcons/invite_frnd_mid.png" alt="Invite Friend Logo" class="img-responsive rightIcons1" />
						</form>
					</div>
				</div>
				<div class="col-xs-12 padd0 ndEco">
				</div>
				<!-- Start Modal -->
				
					<div class="modal-dialog modal-md" style="margin:80px auto;">
						<div class="modal-content">
							<div class="modal-header modHead1">
								<h4 class="modal-title">UPDATE GROUP</h4>
							</div>
							<div class="modal-body modBody1">
								<form class="form-horizontal modForm1" method="post" id="form1" name="form1" enctype="multipart/form-data" action= "<?php $_PHP_SELF ?>">
									<div class="form-group margin0 mbottom8">
										<label class="col-sm-2 control-label padd0 fWeight">Group Name</label>
										<div class="col-sm-10 paddL10R0">
											 <input class="form-control mgForm1" id="focusedInput1" name="focusedInput1" type="text" value="<?php echo $groupname; ?>">
										</div>
									</div>
									<div class="form-group margin0 mbottom8">
										<label class="col-sm-2 control-label padd0 fWeight">Course</label>
										<div class="col-sm-10 paddL10R0">
											<!--<input class="form-control mgForm1" id="focusedInput2" type="text" value="">-->
											<select id="focusedInput2" name="focusedInput2" class="form-control mgForm1">
											<!-- Code start for bind the course --> 
		                                     <?php				
											include "cs/config.php";
											$result_state = $db->query("call sp_get_admin_common('GETALLCOURSE')");
											$db->close();
											$total=0;
											if(!($total= $result_state->num_rows)==0)
											{
										    ?><option selected='selected'>--Select--</option> <?php 
											while($rowdist = $result_state->fetch_array()) 
											{
										     ?>  
												<option value="<?php echo $rowdist['course_id']; ?>" <?php if($hdncourseid==$rowdist['course_id']){echo 'selected=selected';} ?> ><?php echo  $rowdist['course_name']; ?></option>
											  <?php 
											}
										    }
										  ?>
										  <!-- Code end for bind the course --> 
		                                    </select>
										</div>
									</div>
									<div class="form-group margin0 mbottom8">
										<label class="col-sm-2 control-label padd0 fWeight">Subject</label>
										<div class="col-sm-10 paddL10R0">
											<!--<input class="form-control mgForm1" id="focusedInput3" type="text" value="">-->
											<select class="form-control mgForm1" id="focusedInput3" name="focusedInput3">
											 <!-- Code start for bind the subject --> 
										   <?php				
											include "cs/config.php";
											$result_state = $db->query("call sp_get_admin_common('GETALLSUBJECT')");
											$db->close();
											$total=0;
											if(!($total= $result_state->num_rows)==0)
											{
										    ?><option selected='selected'>--Select--</option> <?php 
											while($rowdist = $result_state->fetch_array()) 
											{
										     ?>  
												<option value="<?php echo $rowdist['category_id']; ?>" <?php if($hdnsubjectid==$rowdist['category_id']){echo 'selected=selected';} ?>><?php echo  $rowdist['category_name']; ?></option>
											  <?php 
											}
										    }
										  ?>
										   <!-- Code end for bind the subject --> 
									     </select>
										</div>
									</div>
									<div class="form-group margin0 mbottom8">
										<label class="col-sm-2 control-label padd0 fWeight">Timings</label>
										<div class="col-sm-10 paddL10R0">
											<input class="form-control mgForm1" id="focusedInput4" name="focusedInput4" type="text" value="<?php echo $grouptiming; ?>">
										</div>
									</div>
									<div class="form-group margin0 mbottom8">
										<label class="col-sm-2 control-label padd0 fWeight">Summary</label>
										<div class="col-sm-10 paddL10R0">
											<textarea class="form-control mgForm1 mgTextArea1" id="focusedInput5" name="focusedInput5" rows="5"><?php echo $groupdesc; ?></textarea>
										</div>
									</div>
									<input type="hidden" id="hdn_course_id" name="hdn_course_id" value="<?php echo $hdncourseid;?>">
							<input type="hidden" id="hdn_subject_id" name="hdn_subject_id" value="<?php echo $hdnsubjectid;?>">
								</form>
							</div>
							<div class="modal-footer modFoot1 text-left">
								<div class="col-xs-10 col-xs-offset-2 paddL10R0">
									<form class="goBtnForm2">
										<input type="submit" class="btn npBtn1 npBtn3 btn-default" name="update" id="update" form="form1" value="UPDATE">
									</form>
									<button type="button" class="btn btn-default npBtn4" data-dismiss="modal" onclick="goBack();">CANCEL</button>
								</div>
							</div>
						</div>
					</div>
			
				<!-- End Modal -->
				
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