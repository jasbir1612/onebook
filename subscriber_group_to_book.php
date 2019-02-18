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
	  <link rel="stylesheet" href="css/notesPage.css">
      <link rel="stylesheet" href="css/responsive.css">
	  <?php
			require_once "cs/common.php";
	   ?>
	   
	   <!-- Code start for insert group to book--> 
	   <?php
		//session_start();
		require 'PHPMailer/mail_common.php';
		if(isset($_COOKIE['useremailid']))
		{
			$Uid=$_COOKIE['useremailid'];
			if (isset($_POST['addgrouptobook']))
			{
			   $achk = $_POST['checkbox'];
			   if(empty($achk)) 
			   {
				  echo "You didn't select any group."; 
			   } 
			   else
			   {
				 $N = count($achk);
				 for($i=0; $i < $N; $i++)
				 {					  
				      include "cs/config.php";
					  $BNid= $achk[$i]; 
					  $Gid = mysqli_real_escape_string($db,$_GET['groupid']);
					  $resultsqldul = mysqli_query($db,"call sp_get_common_data('','','".$BNid."','','','','','A','".$Gid."','','','','','','','','','GET_ORDER_BOOK_COUNT')") or die('Query Not execute'.mysqli_error($db));
					  $db->close();
					  if(mysqli_num_rows($resultsqldul)>0)
					  {
					    $rowdup = mysqli_fetch_array($resultsqldul);
					    $existbookval = $rowdup['countval'];
					    mysqli_free_result($resultsqldul); 
					  }
					   
					  if($existbookval==0)
					  {
						 include "cs/config.php";
						 $resultsqlbooknotes = mysqli_query($db,"call sp_get_common_data('','','".$BNid."','','','',
						 '','A','','','','','','','','','','GET_BOOKNOTES')") or die('Query Not execute'.mysqli_error($db));
					     $db->close();
						 if(mysqli_num_rows($resultsqlbooknotes)>0)
						 {
							$rows = mysqli_fetch_array($resultsqlbooknotes);
							$booknotes_title = $rows['title'];
							$subject_id = $rows['category_id'];
							$course_id = $rows['course_id'];
							mysqli_free_result($resultsqlbooknotes);
						 }
						 
						 include "cs/config.php";
						 $runmemds = mysqli_query($db,"call sp_get_common_data('','','','','','','','A','".$Gid."','','','','','','','','','GET_GROUPS_ALL_MEMBERS_DETAILS')") or die('Query Not execute'.mysqli_error($db));
					     $db->close();
						 if(mysqli_num_rows($runmemds)>0)
						 {
							 while ($rowmem = mysqli_fetch_array($runmemds))
							 {
								 $quantityval="1";
								 $noofuserval="1";
								 $Memberid = $rowmem['member_id'];
								 $Membername = $rowmem['first_name'];
								 $GroupName = $rowmem['group_name'];
								 $CourseName = $rowmem['course_name'];
								 $SubjectName = $rowmem['category_name'];
								 $MemberEmailid = $rowmem['billing_Email'];
								 include "cs/config.php";
								 $resultds = mysqli_query($db,"call sp_insert_grouptobook('".$BNid."','".$course_id."','".$subject_id."','".$Gid."','".$Memberid."','','".$Uid."','".$booknotes_title."','".$quantityval."','".$noofuserval."','',
								 'INSERT_GROUP_TO_BOOKNOTES',@resultmsg,@errormsg)") or die('Query Not execute'.mysqli_error($db));
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
								    $MailSubject = '1Book - New Access to Book';
									$bodydata = "<img src='cid:1book_logo' alt='1Book'><br>";
									$bodydata .= "<p>Hi ".$Membername.",</p>";
									$bodydata .= "<p><span style='color:#EF7F1B'>It's good to study</span></p>";
									$bodydata .= "<p>".$_COOKIE['username']." has provided access for 'Book/Note' to ".$GroupName." for ".$CourseName." and ".$SubjectName.".</p>";
									$bodydata .= "<p>You can now view the 'Book/Note' in your 1Book account.</p>";
									$bodydata .= "<p>In case you have not created an account on 1Book, you can register by clicking on this link: <a href=".$SiteURL.">Registration Link</a></p>";
									$bodydata .= "<p>Sincerely</p>";
									$bodydata .= "<p><span style='color:#EF7F1B'>1Book</span> Team</p>";
								    $SendMailMsg = SendMail($SMTPServerFromEmailID,$MemberEmailid,'','',$MailSubject,$bodydata,"","");
									sleep(2); 
								}
							 }
						    mysqli_free_result($runmemds);
						 }
					  }
				  }
				 if ($result=="INSERT")
				 {
				   echo "<script>alert('Selected Books/Notes added successfully in group.')</script>";
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
      <!-- Code end for insert group to book--> 

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
								<!--<li><a href="#">Subscriber Details</a></li>-->
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
                  <div class="mtop19">
                     <img src="img/readerIcons/subscribers_mid.png" alt="Subscriber Logo" class="img-responsive rightIcons1 mRight10" />
                     <img src="img/readerIcons/invite_frnd_mid.png" alt="Invite Friend Logo" class="img-responsive rightIcons1" />
                  </div>
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
										<!--<i class="fa fa-pencil" aria-hidden="true"></i>-->
										<?php 
									 }
									 mysqli_free_result($querygroup_ds);
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
									  mysqli_free_result($querymem_ds);
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
									 mysqli_free_result($querybook_ds);
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
									 mysqli_free_result($querynotes_ds);
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
									$subject_id = $row1['subject_id'];
									$subject_idval = $row1['subject_id'];
									$course_idval = $row1['course_id'];
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
								  mysqli_free_result($qry_ds);
							 }
						  }
						   ?>
                         <!-- Code end for get group's details --> 
                  </ul>
               </div>
            </div>
           <form method="post" id="form1" name="form1" enctype="multipart/form-data" 
					action="<?php $_PHP_SELF ?>">
		   <div class="col-xs-12 padd0 ndEco">
					<div class="ndLeftPart" style='width:78%;'>
						<div class="input-group stylish-input-group" style='width:22.5%;display:none;'>
							<input type="text" class="form-control" placeholder="Search by name" >
							<span class="input-group-addon">
							<button type="submit">
							<span class="glyphicon glyphicon-search"></span>
							</button>
							</span>
						</div>
						<div id="datetimepicker1" class="input-append date npDivWidth1" style='display:none;'>
							<input data-format="dd/MM/yyyy" type="text" class="form-control user_drop_dwn border_radius4" placeholder="From Date">
							<span class="add-on input-group-addon no_css">
							<i class="fa fa-calendar clrOrange"></i>
							</span>
						</div>
						<div id="datetimepicker2" class="input-append date npDivWidth1" style='display:none;'> 
							<input data-format="dd/MM/yyyy" type="text" class="form-control user_drop_dwn border_radius4" placeholder="To Date">
							<span class="add-on input-group-addon no_css">
							<i class="fa fa-calendar clrOrange"></i>
							</span>
						</div>
						<div class="goBtnForm1" style='margin-right:0px;display:none;'>
							<button type="button" class="btn npBtn1 btn-default">Go</button>
						</div>
						
						<!--<a href="#" class="abGroup"><img src="img/readerIcons/subscribers_BW.png" alt="Subscriber Logo" class="img-responsive" /> ADD SELECTED</a>-->
						 <input form='form1' type='submit' id='addgrouptobook' name='addgrouptobook' value='ADD SELECTED' class='btn npBtn1 btn-default'/>
						
					</div>
					<div class="ndRightPart" style='display:none;'>
						<ul class="pagination">
							<li><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>

				<div class="col-xs-12 padd0">
					<div class="row row03">
					 <!-- Code start for get the book and notes --> 
					<?php				
				          include "cs/config.php";
						  //session_start();
						  if(isset($_COOKIE['useremailid']))
						  {
							$UserId=$_COOKIE['useremailid'];
							$queryds = mysqli_query($db,"call sp_get_common_data('','".$UserId."','','','','','','A','".$_GET['groupid'].  "','','','','','','','','','GET_GROUP_TO_BOOK')") or die('Query Not execute'.mysqli_error($db));
						    $db->close();
							if(mysqli_num_rows($queryds)>0)
							{
							  while($row = mysqli_fetch_array($queryds))
							  {
								    $bookid = $row['id'];
									$booktitle = $row['title'];
									$booktitle=implode(' ', array_slice(explode(' ', $booktitle), 0, 3));
									$bookauthor = $row['author'];
									$price = 'NA';
									$longtitle = $row['long_title'];
									$author = $row['author'];
									$publisher = $row['publication'];
									$edition = $row['edition'];
									$pages = $row['pages'];
									$printisbn = $row['print_isbn'];
									$etextisbn = $row['etext_isbn'];
									$thumbimg = $row['thumb_img'];
									$largeimg = $row['large_img'];
									$crtddate = $row['crtd_date'];
									$moddate = $row['mod_date'];
									$availabilityval = $row['availability'];
                                     
									if($thumbimg!="")
									{
										$thumbimgpath=returnthbimage($thumbimg);
										$largeimgpath=returnthbimage($largeimg);
										$thumbimgpath=$S3URL.$thumbimgpath;
										$largeimgpath=$S3URL.$largeimgpath;
									}
									else
									{
									    $thumbimgpath=$SiteURL.$DefaultThumbPath;
										$largeimgpath=$SiteURL.$DefaultLargePath;
									}

									echo "<div class='col-xs-12 col-sm-6 col-md-4 padd03 mtop5'>";
									echo "<div class='col-xs-12 padd5 npOuterBox'>
										<div class='col-xs-4 padd0'>
											<img style='height:115px;' src='$thumbimgpath' alt='Book Cover' class='img-responsive'>
										</div>
										<div class='col-xs-8 paddL10R0 npTitleDiv1'>
											<div class='npBooktitle1'><a href='booksnotesdetails.php?bookid=$bookid' target='_blank'>$booktitle</a></div>
											<p>by $bookauthor</p>
											<p>Price: $price</p>
											<p class='txtItalic'>$crtddate</p>
										</div>
										<div class='checkboxR1'>
											  <input type='checkbox' name='checkbox[]' value='$bookid'>
										</div>
									    </div>";
									echo "<div class='col-xs-12 padd5 text-center npBtmdiv'>
										     Last Update: $moddate
									      </div>";
									echo "</div>";
							    }
								 mysqli_free_result($queryds);
							}
						 }
						 ?>
					     <!-- Code end for get the book and notes -->
						 
						 <!--<input type="hidden" id="hdn_course_id" name="hdn_course_id" value="<?php echo $course_idval;?>">
						 <input type="hidden" id="hdn_subject_id" name="hdn_subject_id" value="<?php echo $subject_idval;?>">-->
						
					</div>
				</div>
				</form>
				<div class="col-xs-12 padd0" style='display:none;'>
					<div class="ndRightPart ndRightPart2">
						<ul class="pagination">
							<li><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
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
