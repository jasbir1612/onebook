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
      <link rel="stylesheet" href="css/manageAddMembers.css">
	  <link rel="stylesheet" href="css/manageGroups.css">
      <link rel="stylesheet" href="css/responsive.css">
	  
	  <script type="text/javascript">
		function ConfirmMemberDelete(group_id,member_id,subscriber_id) {
			 var ok = confirm("Are you sure you want to delete?");
			  if (ok)
			  {		  
				location.href="deletemember.php?groupid="+group_id+"&memberid="+member_id+"&subscriberid="+subscriber_id+"";
			  }
			  else{return false;}
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
            <div class="col-xs-12 padd0 mbHeadDiv1">
               <div class="pull-left">
                  <img src="img/readerIcons/subscribers_big.png" alt="Bookshelf Logo" class="img-responsive mbBshelf"/>
                  <div class="mbManage">
				      <!-- Code start for header --> 
				      <?php 
						if(isset($_COOKIE['useremailid']))
						{
							if($_COOKIE['roleid']=="3")
							{
							?>		
							 <div class="mBooksTxt">Manage Subscribers</div>
							 <ul class="list-inline">
								<li><a href="#">Subscriber Details</a></li>
								<li><a href="manageGroups.html">Manage Groups</a></li>
								<!--<li><a href="#">Send Notification</a></li>
								<li><a href="#">Free Subscription</a></li>--> 
							 </ul>
							<?php 
							}
							else if($_COOKIE['roleid']=="2")
							{
							 ?>		
							 <div class="mBooksTxt">Manage Members</div>
							 <ul class="list-inline">
								<li><a href="manageGroups.html">Manage Groups</a></li>
								<!--<li><a href="#">Send Notification</a></li>
								<li><a href="#">Free Subscription</a></li>--> 
							 </ul>
							 <?php 
							}
						}
						?>
                      <!-- Code end for header --> 
                  </div>
               </div>
               <div class="pull-right">
                  <form class="mtop19" style="display:none;">
                     <img src="img/readerIcons/subscribers_mid.png" alt="Subscriber Logo" class="img-responsive rightIcons1 mRight10" />
                     <img src="img/readerIcons/invite_frnd_mid.png" alt="Invite Friend Logo" class="img-responsive rightIcons1" />
                  </form>
               </div>
            </div>
            <div class="col-xs-12 padd0 mbHeadDiv2">
               <div class="pull-left">
                  <div class="mbBshelf2"><i class="fa fa-star" aria-hidden="true"></i></div>
                  <div class="mbManage mbManage2">
                     <div class="mBooksTxt">
					         <!-- Code start for get the group details--> 
					       <?php 
						      if (isset($_GET['groupid']) && count($_GET) > 0 ) 
						      { 
								 include "cs/config.php";
                                 // $querygroup = "select * from group_master where group_id='".$Gid."' order by group_id desc";
                                 // $querygroup_ds = mysqli_query($db,$querygroup);
								 $Gid = mysqli_real_escape_string($db,$_GET['groupid']); 
								 $querygroup_ds = mysqli_query($db,"call sp_get_common_data('','','','','','','','A','".$Gid."','','','','','','','','','GET_GROUPS')") or die('Query Not execute'.mysqli_error($db));
								 $db->close();
								 if(mysqli_num_rows($querygroup_ds)>0)
								 {
									 while ($row = mysqli_fetch_array($querygroup_ds))
									 {
										$group_id = $row['group_id'];
										$group_name = $row['group_name'];
										$course_id = $row['course_id'];
										$timeing = $row['group_timing'];
										$totalmembers ="1";
									     ?>
										<span class="mRight10"><?php echo $group_name; ?></span>
										<span class="mRight10 amTOpm"><?php echo $timeing; ?></span>
										<a href="manageeditgroups.php?groupid=<?php echo $group_id; ?>" target='_blank'><i class="fa fa-pencil" aria-hidden="true"></i></a>
										<?php 
									 } 
								 }
							  }
						   ?>
                         <!-- Code end for get the group details--> 
                     </div>
                     <ul class="list-inline">
					    <!-- Code start for get the no of members/books/notes in group--> 
                        <li><a class="<?php echo ($page == "manageAddMembers" ? "active" : "")?>" href="manageAddMembers.php?groupid=<?php echo $_GET['groupid']; ?>" target='_self'>Add Member(s)</a></li>
						<?php 
						      if (isset($_GET['groupid']) && count($_GET) > 0 ) 
						      { 
						         include "cs/config.php";
								 $Gid = mysqli_real_escape_string($db,$_GET['groupid']);
								 $querymem_ds = mysqli_query($db,"call sp_get_common_data('','','','','','','','A','".$Gid."','','','','','','','','','GET_GROUPS_MEMBERS_COUNTS')") or die('Query Not execute'.mysqli_error($db));
								 $db->close();
								 if(mysqli_num_rows($querymem_ds)>0)
								 {
									 $rowm = mysqli_fetch_array($querymem_ds);
									 $totalmembersval = $rowm['totalmembers'];
									 ?>
									 <li><a class="<?php echo ($page == "manageListMembers" ? "active" : "")?>" href="manageListMembers.php?groupid=<?php echo $Gid; ?>" target='_self'><?php echo $totalmembersval; ?> Member(s)</a></li>
									 <?php 
								 }
								
								 include "cs/config.php";
								 $querybook_ds = mysqli_query($db,"call sp_get_common_data('','','','','','','','A','".$Gid."','','','','','','','','','GET_USER_EBOOK_COUNTS')") or die('Query Not execute'.mysqli_error($db));
								 $db->close();
								 if(mysqli_num_rows($querybook_ds)>=0)
								 {
								       $totalbookval=mysqli_num_rows($querybook_ds);
									   ?>
										<li><a href="subscriber_group_to_book_del.php?groupid=<?php echo $Gid; ?>" target='_blank'><?php echo $totalbookval; ?> eBook(s)</a></li>
									   <?php 
								 }
								 
								 include "cs/config.php";
								 $querynotes_ds = mysqli_query($db,"call sp_get_common_data('','','','','','','','A','".$Gid."','','','','','','','','','GET_USER_ENOTES_COUNTS')") or die('Query Not execute'.mysqli_error($db));
								 $db->close();
								 if(mysqli_num_rows($querynotes_ds)>=0)
								 {
								      $totalnotesval = mysqli_num_rows($querynotes_ds);
									  ?>
									  <li><a href="subscriber_group_to_book_del.php?groupid=<?php echo $Gid; ?>" target='_blank'><?php echo $totalnotesval; ?> eNote(s)</a></li>
									 <?php 
								 }
							  }
						   ?>
						    <!-- Code end for get the no of members/books/notes in group--> 
                     </ul>
                  </div>
               </div>
               <div class="pull-right">
                  <ul class="list-unstyled batchrightPrt">
				       <!-- Code start for get group's details --> 
				      <?php 
						  if (isset($_GET['groupid']) && count($_GET) > 0 ) 
						  { 
							 include "cs/config.php";
							 $Gid = mysqli_real_escape_string($db,$_GET['groupid']); 
						     $qry_ds = mysqli_query($db,"call sp_get_common_data('','','','','','','','A','".$Gid.  "','','','','','','','','','GET_GROUP_COURSE_SUBJECT_TIME')") or die('Query Not execute'.mysqli_error($db));
						     $db->close();
							 if(mysqli_num_rows($qry_ds)>0)
							 {
								 while ($row1 = mysqli_fetch_array($qry_ds))
								 {
									$group_id = $row1['group_id'];
									$coursename = $row1['course_name'];
									$subjectname = $row1['category_name'];
									$crtddate = $row1['crtd_date'];
									$groupdesc = $row1['group_desc'];
									$totalmembers ="1";
									 ?>
									  <li>Course - <?php echo $coursename; ?></li>
									  <li>Subject - <?php echo $subjectname; ?></li>
									  <li>Creation Date - <?php echo $crtddate; ?></li>
									  <li class="mlmSum dot1">Summary - <?php echo $groupdesc; ?></li>
									<?php 
								 } 
							 }
						  }
						   ?>
                         <!-- Code end for get group's details --> 
                  </ul>
               </div>
            </div>
           
            
         <div class="col-xs-12 padd0">
					<div class="table-responsive">
						<table class="table mgTable1">
							<thead>
								<tr>
									  <th>#</th>
									  <th>MEMBER NAME</th>
									  <th>EMAIL</th>
									  <th>JOINING DATE</th>
									  <th>REGISTRATION NO</th>
									  <th>PHONE NO</th>
									  <th colspan="2">ACTION</th>
								</tr>
							</thead>
							<tbody>
							  <!-- Code start for get group's member details -->
							  <?php 
							  if (isset($_GET['groupid']) && count($_GET) > 0 ) 
						      { 
						       $Gid=$_GET['groupid']; 
							   include "cs/config.php";
							   $run = mysqli_query($db,"call sp_get_common_data('','','','','','','','A','".$Gid.  "','','','','','','','','','GET_GROUPS_MEMBERS_DETAILS')") or die('Query Not execute'.mysqli_error($db));
						       $db->close();
							   $i=1;
							   if(mysqli_num_rows($run)>0)
							   {
                                 while ($row = mysqli_fetch_array($run))
                                 {
									$memberidval = $row['auto_id'];
									$nameval = $row['member_name'];
									$emailidval = $row['emailid'];
									$details_1val = $row['registration_no'];
									$details_2val = $row['phone_no'];
									$crtd_dateval = $row['crtd_date'];
									$Subscriber_id=$row['Subscriber_id'];
									 ?>
									 <tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $nameval; ?></td>
										<td><?php echo $emailidval; ?></td>
										<td><?php echo $crtd_dateval; ?></td>
										<td style='color: #333;font-size: 14px;'><?php echo $details_1val; ?></td>
										<td style='color: #333;font-size: 14px;'><?php echo $details_2val; ?></td>
										<td style='color: #EF7F1B;'><a href="manageEditMembers.php?groupid=<?php echo $group_id; ?>&memberid=<?php echo $memberidval; ?>" target='_blank'><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
										<td><a style='cursor: pointer;' Onclick='return ConfirmMemberDelete(<?php echo $group_id; ?>,<?php echo $memberidval; ?>,<?php echo $Subscriber_id; ?>);'><i class="fa fa-trash" aria-hidden="true"></i></a></td>
									  </tr>
									  <?php 
									   $i=$i+1;
								   } 
								}
							  }
							?>
						    <!-- Code end for get group's member details -->
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-xs-12 padd0" style="display:none;">
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
	  <script src="js/jquery.dotdotdot.min.js"></script>
      <script src="js/index.js"></script>
	  
	  <script>
		$(document).ready(function() {
			$('.dot1').dotdotdot();
		});
	  </script>
   </body>
</html>
<?php ob_end_flush(); ?>
