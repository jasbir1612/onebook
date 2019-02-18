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
           
		<!-- Validation start for add group  -->  
		<script language="javascript" type="text/javascript">
		function group_validation()
		{
			var fm=document.form1;
			if(fm.focusedInput1.value=="")
			{
			
			document.getElementById('groupName').style.display = "initial";
			document.getElementById("groupName").innerHTML = "Please enter group name";
			fm.focusedInput1.focus();
			return false;
			}
			var ddlcourse = document.getElementById("focusedInput2");
			if(ddlcourse.value=="--Select--")
			{
			document.getElementById('groupCourse').style.display = "initial";
			document.getElementById("groupCourse").innerHTML = "Please select any course";
			return false;
			}
			var ddlsubject = document.getElementById("focusedInput3")
			if(ddlsubject.value=="--Select--")
			{
			document.getElementById('groupSubject').style.display = "initial";
			document.getElementById("groupSubject").innerHTML = "Please select any subject";
			return false;
			}
			if(fm.focusedInput4.value=="")
			{
			document.getElementById('groupTimings').style.display = "initial";
			document.getElementById("groupTimings").innerHTML = "Please enter timings";	
			fm.focusedInput4.focus();
			return false;
			}
			if(fm.focusedInput5.value=="")
			{
			document.getElementById('groupSummary').style.display = "initial";
			document.getElementById("groupSummary").innerHTML = "Please enter summary";	
			fm.focusedInput5.focus();
			return false;
			}
		}
		function groupErrorHide(hideId) 
		{
			document.getElementById(hideId).style.display = "none";
		}
		</script>
		
		<script type="text/javascript">
		function ConfirmGroupDelete(group_id) {
			 var ok = confirm("Are you sure you want to delete?");
			  if (ok)
			  {		  
				location.href="deletegroup.php?groupid="+group_id+"";
			  }
			  else{return false;}
		}
		</script>

		<!-- Validation end for add group  --> 

		<!-- Code start for insert group --> 
		<?php
                include "cs/config.php";
				//session_start();
			    if(isset($_COOKIE['useremailid']))
			    {
					$UserID=$_COOKIE['useremailid'];
					if(isset($_POST['submit']))
					{
					  $group_name = mysqli_real_escape_string($db,$_POST['focusedInput1']);
					  $courseid = mysqli_real_escape_string($db,$_POST['focusedInput2']);
					  $subjectid = mysqli_real_escape_string($db,$_POST['focusedInput3']);
					  $grouptiming = mysqli_real_escape_string($db,$_POST['focusedInput4']);
					  $groupsummary = mysqli_real_escape_string($db,$_POST['focusedInput5']);
					  $group_status='A';
					  $meta_keyword = '';
					  $meta_desc = '';
					  
					  $resultds = mysqli_query($db,"call sp_insert_groups('','".$courseid."','".$subjectid."','".$group_name."','".$groupsummary."','".$group_status."','".$grouptiming."','".$UserID."','".$UserID."','','','','','','".$meta_keyword."','".$meta_desc."','INSERT_GROUPS',@resultmsg,@errormsg)") or die('Query Not execute'.mysqli_error($db));
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
					   echo "<script>alert('Group Saved Successfully.')</script>"; 
					  }
					  if ($result=="EXIST")
					  {
					    echo "<script>alert('Error Ocured Try Again.')</script>"; 
					  }
				 }
			}
			else
			{
				$WebSite_URL="location:".$SiteURL;
			    header($WebSite_URL);
			}
		 ?> 
		 <!-- Code end for insert group --> 
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
								<li class="hidden"><a href="#">Send Notification</a></li>
								<li class="hidden"><a href="#">Free Subscription</a></li>
							</ul>
						</div>
					</div>
					<div class="pull-right hidden">
						<form class="mtop19">
							<img src="img/readerIcons/subscribers_mid.png" alt="Subscriber Logo" class="img-responsive rightIcons1 mRight10" />
							<img src="img/readerIcons/invite_frnd_mid.png" alt="Invite Friend Logo" class="img-responsive rightIcons1" />
						</form>
					</div>
				</div>
				<div class="col-xs-12 padd0 ndEco">
					<div class="mgLeftPart">
						<div id="datetimepicker1" class="input-append date npDivWidth1 hidden">
							<input data-format="dd/MM/yyyy" type="text" class="form-control user_drop_dwn border_radius4" placeholder="From Date">
							<span class="add-on input-group-addon no_css">
							<i class="fa fa-calendar clrOrange"></i>
							</span>
						</div>
						<div id="datetimepicker2" class="input-append date npDivWidth1 hidden">
							<input data-format="dd/MM/yyyy" type="text" class="form-control user_drop_dwn border_radius4" placeholder="To Date">
							<span class="add-on input-group-addon no_css">
							<i class="fa fa-calendar clrOrange"></i>
							</span>
						</div>
						<form class="goBtnForm1 hidden">
							<button type="button" class="btn npBtn1 btn-default">Go</button>
						</form>
						<button type="button" class="btn btn-success npBtn2" data-toggle="modal" data-target="#mgModal">+ NEW GROUP</button>
					</div>
					<div class="mgRightPart hidden">
						<ul class="pagination">
							<li><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">6</a></li>
							<li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
				<!-- Start Modal -->
				<div class="modal fade" id="mgModal" role="dialog">
					<div class="modal-dialog modal-md">
						<div class="modal-content">
							<div class="modal-header modHead1">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">NEW GROUP</h4>
							</div>
							<form class="form-horizontal modForm1" method="post" id="form1" name="form1" enctype="multipart/form-data" action= "<?php $_PHP_SELF ?>">
							<div class="modal-body modBody1">
								
									<div class="form-group margin0 mbottom8">
										<label class="col-sm-2 control-label padd0 fWeight">Group Name</label>
										<div class="col-sm-10 paddL10R0">
											 <input class="form-control mgForm1" id="focusedInput1" name="focusedInput1" type="text" value="" onkeypress='return groupErrorHide("groupName")'>
											 <span id="groupName" class="label label-danger"></span>
										</div>
									</div>
									<div class="form-group margin0 mbottom8">
										<label class="col-sm-2 control-label padd0 fWeight">Course</label>
										<div class="col-sm-10 paddL10R0">
											<!--<input class="form-control mgForm1" id="focusedInput2" type="text" value="">-->
											<select id="focusedInput2" name="focusedInput2" class="form-control mgForm1" onchange='return groupErrorHide("groupCourse")'>
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
												<option value="<?php echo $rowdist['course_id']; ?>"><?php echo  $rowdist['course_name']; ?></option>
											  <?php 
											}
										    }
										    ?>
											<!-- Code end for bind the course --> 
		                                    </select>
		                                    <span id="groupCourse" class="label label-danger"></span>
										</div>
									</div>
									<div class="form-group margin0 mbottom8">
										<label class="col-sm-2 control-label padd0 fWeight">Subject</label>
										<div class="col-sm-10 paddL10R0">
											<!--<input class="form-control mgForm1" id="focusedInput3" type="text" value="">-->
											<select class="form-control mgForm1" id="focusedInput3" name="focusedInput3" onchange='return groupErrorHide("groupSubject")'>
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
												<option value="<?php echo $rowdist['category_id']; ?>"><?php echo  $rowdist['category_name']; ?></option>
											  <?php 
											}
										    }
										  ?>
										  <!-- Code end for bind the subject -->
									      </select>
									      <span id="groupSubject" class="label label-danger"></span>
										</div>
									</div>
									<div class="form-group margin0 mbottom8">
										<label class="col-sm-2 control-label padd0 fWeight">Timings</label>
										<div class="col-sm-10 paddL10R0">
											<input class="form-control mgForm1" id="focusedInput4" name="focusedInput4" type="text" value=""
											onkeypress='return groupErrorHide("groupTimings")'>
											<span id="groupTimings" class="label label-danger"></span>
										</div>
									</div>
									<div class="form-group margin0 mbottom8">
										<label class="col-sm-2 control-label padd0 fWeight">Summary</label>
										<div class="col-sm-10 paddL10R0">
											<textarea class="form-control mgForm1 mgTextArea1" id="focusedInput5" name="focusedInput5" rows="5" onkeypress='return groupErrorHide("groupSummary")'></textarea>
											<span id="groupSummary" class="label label-danger"></span>
										</div>
									</div>
								
							</div>
							<div class="modal-footer modFoot1 text-left">
								<div class="col-xs-10 col-xs-offset-2 paddL10R0">
									<div class="goBtnForm2">
										<!--<button type="button" class="btn npBtn1 npBtn3 btn-default">CREATE</button>-->
										<input type="submit" class="btn npBtn1 npBtn3 btn-default" name="submit" id="submit" form="form1" value="CREATE" OnClick="return group_validation();">
									</div>
									<div class="goBtnForm2" style="display:none;">
										<button type="button" class="btn npBtn1 npBtn3 btn-default">CREATE & ADD MEMBER(S)</button>
									</div>
									<button type="button" class="btn btn-default npBtn4" data-dismiss="modal">CANCEL</button>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
				<!-- End Modal -->
				
				<div class="col-xs-12 padd0">
					<div class="table-responsive">
						<table class="table mgTable1">
							<thead>
								<tr>
									<th>#</th>
									<th>GROUP</th>
									<th>DATE</th>
									<th>COURSE</th>
									<th>SUBJECT</th>
									<th>SUMMARY</th>
									<th>TIMINGS</th>
									<th>MEMBER(S)</th>
									<th colspan="4">ACTION</th>
								</tr>
							</thead>
							<tbody>
							 <!-- Code start for get the groups --> 
							<?php 
							   include "cs/config.php";
							   $qrygetds = mysqli_query($db,"call sp_get_common_data('','".$UserID."','','','','','','A',
							   '','','','','','','','','','GET_USER_GROUPS')") or die('Query Not execute'.mysqli_error($db));
							   $db->close();
							   $i=1;
							   if(mysqli_num_rows($qrygetds)>0)
							   {
                               while ($row = mysqli_fetch_array($qrygetds))
                               {
                               	$group_id = $row['group_id'];
                               	$group_name = $row['group_name'];
								$group_date = $row['crtd_date'];
                               	$group_desc = $row['group_desc'];
                               	$course_id = $row['course_id'];
                               	$subject_id = $row['subject_id'];
                               	$timeing = $row['group_timing'];
								$course_name = $row['course_name'];
                               	$subject_name = $row['category_name'];

								 // $querymem = "select count(*) as totalmembers from group_member_dtls where group_id='".$group_id."'";
                                 // $querymem_ds = mysqli_query($db,$querymem);
								 include "cs/config.php";
								 $querymem_ds = mysqli_query($db,"call sp_get_common_data('','','','','','','','A','".$group_id."','','','','','','','','','GET_GROUPS_MEMBERS_COUNTS')") or die('Query Not execute'.mysqli_error($db));
								 $db->close();
								 if(mysqli_num_rows($querymem_ds)>0)
								 {
									 $rowm = mysqli_fetch_array($querymem_ds);
									 $totalmembers = $rowm['totalmembers'];
								 }
								 ?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><a href="manageListMembers.php?groupid=<?php echo $group_id; ?>" target='_self'><?php echo $group_name; ?></a></td>
									<td><?php echo $group_date; ?></td>
									<td><?php echo $course_name; ?></td>
									<td><?php echo $subject_name; ?></td>
									<td><?php echo $group_desc; ?></td>
									<td><?php echo $timeing; ?></td>
									<td><?php echo $totalmembers;?></td>
									<td><a href="manageEditGroups.php?groupid=<?php echo $group_id; ?>" target='_self'><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
									<td style='width:45px;'><a href="manageAddMembers.php?groupid=<?php echo $group_id; ?>" target='_self'><i class="fa fa-user" aria-hidden="true"></i><sup class="plusSup">+</sup></a></td>
									<td><a style='cursor: pointer;' Onclick='return ConfirmGroupDelete(<?php echo $group_id; ?>);'><i class="fa fa-trash" aria-hidden="true"></i></a></td>
									<td style='width:40px;'><a href="subscriber_group_to_book.php?groupid=<?php echo $group_id; ?>" target='_blank'><img src="img/readerIcons/bookshelf_black.png" alt="Bookshelf" class="img-responsive" onmouseover="hover1(this);" onmouseout="unhover1(this);"></a></td>
						         </tr>
								  <?php 
								   $i=$i+1;
								  } 
								 }
								?>
							  <!-- Code end for get the groups --> 
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-xs-12 padd0 hidden">
					<div class="mgRightPart mgRightPart2">
						<ul class="pagination">
							<li><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">6</a></li>
							<li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
						</ul>
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
		<script src="js/bootstrap-datetimepicker.min.js"></script>
		<script src="js/index.js"></script>
		<script>
			/* Date Time Function Start */
			$(function() {
				$('#datetimepicker1, #datetimepicker2').datetimepicker({
				pickTime: false
				});
			});

			function hover1(element) {
			    element.setAttribute('src', 'img/readerIcons/bookshelf_orange.png');
			}
			function unhover1(element) {
			    element.setAttribute('src', 'img/readerIcons/bookshelf_black.png');
			}

			/* End */
		</script>
	</body>
</html>
<?php ob_end_flush(); ?>