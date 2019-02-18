<!DOCTYPE html>
<?php ob_start(); ?>
<?php include "../cs/config.php"; ?>
<html lang="en">
	<head>
		<title>1Book</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
		 <link rel="shortcut icon" href="<?php echo $SiteURL;?>img/fevicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/jasny-bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/bootstrap-datetimepicker.min.css">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/common.css">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/dashboard.css">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/responsive.css">
		
		<script type="text/javascript">
		// function ConfirmDelete(UId) {
			 // var x = confirm("Are you sure you want to delete?");
			  // if (x)
			  // {
				// //alert(bookid);
				// var Url="admin/modify_user.html";				
				// location.href="delete_user.php?userid="+UId+"&url="+Url+"";
			  // }
			  // else{return false;}
		// }
		
		function reset_form() {
			document.getElementById("frmnotesbooks").reset();
		}
		
		</script>
		
		<?php
		include "../cs/config.php";
		if(isset($_COOKIE['useremailid']))
		{
		    if (isset($_POST['btngo']))
			{
			    if($_POST['txtfromdate']!="")
				{
				  $get_from_date= mysqli_real_escape_string($db,$_POST['txtfromdate']);
				  $get_from_date_sel=$get_from_date;
			      $get_from_date = DateTime::createFromFormat('d/m/Y', $get_from_date)->format('Y-m-d');
				}
			    if($_POST['txttodate']!="")
				{
				  $get_to_date= mysqli_real_escape_string($db,$_POST['txttodate']);
				  $get_to_date_sel=$get_to_date;
			      $get_to_date = DateTime::createFromFormat('d/m/Y', $get_to_date)->format('Y-m-d');
				}
				
				$get_status = mysqli_real_escape_string($db,$_POST['ddlstatus']);
				$get_crtdby = mysqli_real_escape_string($db,$_POST['ddleducator']);
				
				$get_srch_keyword= mysqli_real_escape_string($db,$_POST['srchkeywrd']);
			}
			
			if (isset($_POST['btnsrchbook']))
			{
			   $get_srch_keyword= mysqli_real_escape_string($db,$_POST['srchkeywrd']);
			}
			
			if (isset($_POST['btnapprove']))
			{
			   $achk = $_POST['checkbox'];
			   if(empty($achk)) 
			   {
				  //echo "You didn't select any row."; 
				  echo "<script>alert('please select any row')</script>";
			   } 
			   else
			   { 
			      $N = count($achk);
				  $statusval="A";
				  $useremail=$_COOKIE['useremailid'];
				  for($i=0; $i < $N; $i++)
				  {
				     include "../cs/config.php";
					 $BNID=$achk[$i];
					 $qryds = mysqli_query($db,"call sp_update_common('','".$useremail."','".$BNID."','','','','','','".$statusval."','','','','','','','','','','','APPROVE_BOOK_NOTES',@resultmsg,@errormsg)") or die('Query Not execute'.mysqli_error($db));
					 $db->close();
					 if (mysqli_num_rows($qryds) > 0) 
					 {
					 while($row = mysqli_fetch_array($qryds)) 
					 {
						$result= $row['resultval'];
						$IsError= $row['IsErrorval'];
					 }
					  mysqli_free_result($qryds);
					 }
				  }
				  if ($result=="UPDATE")
				  {
				    echo "<script>alert('Books/Notes approved successfully')</script>";
				  }
			   }
			}
			
			if (isset($_POST['btnunapprove']))
			{
			   $achk = $_POST['checkbox'];
			   if(empty($achk)) 
			   {
				//echo "You didn't select any row."; 
				echo "<script>alert('please select any row')</script>";
			   } 
			   else
			   { 
			      $N = count($achk);
				  $statusval="P";
				  $useremail=$_COOKIE['useremailid'];
				  for($i=0; $i < $N; $i++)
				  {
				     include "../cs/config.php";
					 $BNID=$achk[$i];
					 $qryds = mysqli_query($db,"call sp_update_common('','".$useremail."','".$BNID."','','','','','','".$statusval."','','','','','','','','','','','UNAPPROVE_BOOK_NOTES',@resultmsg,@errormsg)") or die('Query Not execute'.mysqli_error($db));
					 $db->close();
					 if (mysqli_num_rows($qryds) > 0) 
					 {
					 while($row = mysqli_fetch_array($qryds)) 
					 {
						$result= $row['resultval'];
						$IsError= $row['IsErrorval'];
					 }
					  mysqli_free_result($qryds);
					 }
				  }
				  if ($result=="UPDATE")
				  {
				    echo "<script>alert('Books/Notes unapproved successfully')</script>";
				  }
			   }
			}
			
			if (isset($_POST['btndelete']))
			{
			   $achk = $_POST['checkbox'];
			   if(empty($achk)) 
			   {
				//echo "You didn't select any row."; 
				echo "<script>alert('please select any row')</script>";
			   } 
			   else
			   { 
			      $N = count($achk);
				  $statusval="D";
				  $useremail=$_COOKIE['useremailid'];
				  for($i=0; $i < $N; $i++)
				  {
				     include "../cs/config.php";
					 $BNID=$achk[$i];
					 $qryds = mysqli_query($db,"call sp_update_common('','".$useremail."','".$BNID."','','','','','','".$statusval."','','','','','','','','','','','DELETE_BOOK_NOTES',@resultmsg,@errormsg)") or die('Query Not execute'.mysqli_error($db));
					 $db->close();
					 if (mysqli_num_rows($qryds) > 0) 
					 {
					 while($row = mysqli_fetch_array($qryds)) 
					 {
						$result= $row['resultval'];
						$IsError= $row['IsErrorval'];
					 }
					  mysqli_free_result($qryds);
					 }
				  }
				  if ($result=="UPDATE")
				  {
				    echo "<script>alert('Books/Notes deleted successfully')</script>";
				  }
			   }
			}
		}
		 
		?>
	</head>
	<body>
		<div class="mainWrap">
		
			<!--<div class="navmenu navmenu-default navmenu-fixed-left offcanvas leftUserDetail" style="display:none;">
				<div class="userDetail">
					<div class="userName"><a href="#">Rajat Nandwani</a></div>
					<div><a href="#">rajatnandwani1991@gmail.com</a></div>
					<a href="#" class="userLoginIcon transform1 transEase"><span class="fa fa-lock" aria-hidden="true"></span></a>
					<ul class="nav navmenu-nav sideMenu1">
						
						<li><a href="#" class="dropdown-toggle dropDToggle" data-toggle="dropdown"><span class="icoR1"><img src="img/readerIcons/students.png" alt="Bookshelf" class="menuImg" /></span> Manage Students</a>
							<ul class="dropdown-menu dropDMenu">
								<li><a href="#">Reset Password</a></li>
								<li><a href="#">Active/Inactive User</a></li>
							</ul>
						</li>
						
						<li><a href="#" class="dropdown-toggle dropDToggle" data-toggle="dropdown"><span class="icoR1"><img src="img/readerIcons/educators.png" alt="Bookshelf" class="menuImg" /></span> Manage Educators</a>
							<ul class="dropdown-menu dropDMenu">
								<li><a href="#">Reset Password</a></li>
								<li><a href="#">Active/Inactive User</a></li>
							</ul>
						</li>
						
						<li><a href="#" class="dropdown-toggle dropDToggle" data-toggle="dropdown"><span class="icoR1"><img src="img/readerIcons/books.png" alt="Bookshelf" class="menuImg" /></span> Manage Books/Notes</a>
							<ul class="dropdown-menu dropDMenu">
								<li><a href="#">Edit/Delete</a></li>
								<li><a href="#">Upload</a></li>
							</ul>
						</li>
						
						<li><a href="#" class="dropdown-toggle dropDToggle" data-toggle="dropdown"><span class="icoR1"><img src="img/readerIcons/users.png" alt="Bookshelf" class="menuImg" /></span> Manage Users</a>
							<ul class="dropdown-menu dropDMenu">
								<li><a href="#">Role</a></li>
								<li><a href="#">Permission</a></li>
								<li><a href="#">User</a></li>
							</ul>
						</li>
						
						<li><a href="#" class="dropdown-toggle dropDToggle" data-toggle="dropdown"><span class="icoR1"><img src="img/readerIcons/master.png" alt="Bookshelf" class="menuImg" /></span> Masters</a>
							<ul class="dropdown-menu dropDMenu">
								<li><a href="#">Subjects</a></li>
								<li><a href="#">Course</a></li>
							</ul>
						</li>
						
						<li><a href="#" class="dropdown-toggle dropDToggle" data-toggle="dropdown"><span class="icoR1"><img src="img/readerIcons/reports.png" alt="Bookshelf" class="menuImg" /></span> Reports</a>
							<ul class="dropdown-menu dropDMenu">
								<li><a href="#">Revenue</a></li>
							</ul>
						</li>
						
						<li><a href="#"><span class="icoR1"><img src="img/readerIcons/upload_content.png" alt="Upload Content" class="menuImg" /></span> Upload Content</a></li>
					</ul>
					<ul class="nav navmenu-nav sideMenu2">
						<li><a href="#"><img src="img/readerIcons/profile.png" alt="Profile" class="menuImg" /> My Profile</a></li>
						<li><a href="#"><img src="img/readerIcons/comment.png" alt="Comments" class="menuImg" /> Rating/Comments</a></li>
						<li><a href="#"><img src="img/readerIcons/subscribers.png" alt="Subscribers" class="menuImg" /> Manage Subscribers</a></li>
						<li><a href="#"><img src="img/readerIcons/invite_frnd.png" alt="Invite A Friend" class="menuImg" /> Send Notification</a></li>
						<li><a href="#"><img src="img/readerIcons/statistics.png" alt="Statistics" class="menuImg" /> Statistics(Usage & Download)</a></li>
					</ul>
				</div>
				<ul class="nav navmenu-nav sideMenu3">
					<li><a href="#"><img src="img/readerIcons/library.png" alt="Library" class="menuImg" /> Bookshelf(Shop Now)</a></li>
					<li><a href="#"><img src="img/readerIcons/support.png" alt="support" class="menuImg" /> Support</a></li>
					<li><a href="#"><img src="img/readerIcons/about_us.png" alt="About Us" class="menuImg" /> About Us</a></li>
					<li><a href="#"><img src="img/readerIcons/contact_us.png" alt="Contact Us" class="menuImg" /> Contact Us</a></li>
					<li><a href="#"><img src="img/readerIcons/feedback.png" alt="Feedback" class="menuImg" /> Feedback</a></li>
					<li><a href="#"><img src="img/readerIcons/sign_out.png" alt="Sign Out" class="menuImg" /> Sign Out</a></li>
				</ul>
			</div>
			<div class="navbar navbar-default navbar-fixed-top resNav" style="display:none;">
				<div class="navbar-toggle leftNavFixed mbpadd515">
					<div class="resPullLeft">
						<div><span class="fa fa-bars barToggle faSlideIcons transEase" aria-hidden="true" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body" data-autohide="false"></span></div>
						<div><span class="fa fa-home faSlideIcons transEase" aria-hidden="true"></span></div>
					</div>
					<div class="resPullRight">
						<div class="resOuterDiv">
							<div class="resInnerDiv">Publisher Dashboard</div>
						</div>
					</div>
				</div>
			</div>-->
			
			
			 <!-- Dashboard Start Here -->
			 <?php include_once('../dashboard.php');?>
			 <!-- Dashboard End Here -->
			 
			<div class="container wrapMB">
			<form method="post" id="frmnotesbooks" name="frmnotesbooks" enctype="multipart/form-data" action="<?php $_PHP_SELF ?>">
				<div class="col-xs-12 padd0 mbHeadDiv">
					<div class="pull-left">
						<img src="<?php echo $SiteURL;?>img/readerIcons/bookshelf_big.png" alt="Bookshelf Logo" class="img-responsive mbBshelf"/>
						<div class="mbManage">
							<div class="mBooksTxt">Manage Books/Notes</div>
							<!--<ul class="list-inline">
								<li><a href="#">Monthwise</a></li>
								<li><a href="#">Subscribers</a></li>
							</ul>-->
						</div>
					</div>
					<div class="pull-right">
						<form class="mtop19">
							<?php
							  $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
							  echo "<a class='btn ndBtn1 btn-default' href='$url'><i class='fa fa-angle-left' aria-hidden='true'></i> Back</a>"; 
						    ?>
						</form>
					</div>
				</div>
				<div class="col-xs-12 padd0 ndEco">
					<div class="mgLeftPart">
					
						<div class="input-group searchInput">
							<input id="srchkeywrd" name="srchkeywrd" type="text" class="form-control" form="frmnotesbooks" placeholder="Search here..." value="<?php echo $get_srch_keyword;?>" />
							<div class="input-group-btn">
								<div class="btn-group" role="group">
									<button id="btnsrchbook" name="btnsrchbook" type="submit" class="btn" form="frmnotesbooks"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
								</div>
							</div>
						</div>
					
						<div id="datetimepicker1" class="input-append date npDivWidth1">
							<input id="txtfromdate" name="txtfromdate" data-format="dd/MM/yyyy" type="text" form="frmnotesbooks" class="form-control user_drop_dwn border_radius4" placeholder="From Date" value="<?php echo $get_from_date_sel;?>" readonly />
							<span class="add-on input-group-addon no_css">
							<i class="fa fa-calendar clrOrange"></i>
							</span>
						</div>
						<div id="datetimepicker2" class="input-append date npDivWidth1">
							<input id="txttodate" name="txttodate" data-format="dd/MM/yyyy" type="text" form="frmnotesbooks" class="form-control user_drop_dwn border_radius4" placeholder="To Date" value="<?php echo $get_to_date_sel;?>" readonly />
							<span class="add-on input-group-addon no_css">
							<i class="fa fa-calendar clrOrange"></i>
							</span>
						</div>
						
						<div class="input-append npDivWidth2">
						 <select id="ddlstatus" name="ddlstatus" form="frmnotesbooks" class="form-control drpdown_status">
							<option selected='selected' value="">--Select Status--</option>
							<option value="A" selected="true" <?php if($get_status=='A'){echo 'selected=selected';} ?>>Approve</option>
							<option value="P" <?php if($get_status=='P'){echo 'selected=selected';} ?>>UnApprove</option>
							<option value="D" <?php if($get_status=='D'){echo 'selected=selected';} ?>>Delete</option>
							</select>
						</div>
						
						<div class="input-append npDivWidth2">
						 <select id="ddleducator" name="ddleducator" form="frmnotesbooks" class="form-control drpdown_edu">
								<!-- Code start for bind the educator  -->
								 <?php				
									include "../cs/config.php";
									$result_state = $db->query("call sp_get_admin_common('GET_ALL_EDUCATORS')");
									$db->close();
									$total=0;
									if(!($total= $result_state->num_rows)==0)
									{
									?><option selected='selected' value="">--Select Educator--</option> <?php 
									while($rowdist = $result_state->fetch_array()) 
									{
									 ?>  
										<option value="<?php echo $rowdist['subscriber_emailid']; ?>" <?php if($get_crtdby==$rowdist['subscriber_emailid']){echo 'selected=selected';} ?>><?php echo  $rowdist['fullname']; ?></option>
									  <?php 
									}
									}
								  ?>
								   <!-- Code end for bind the educator  -->
							</select>
						</div>

						<form class="goBtnForm1">
							<!--<a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>-->
							<button id="btngo" name="btngo" type="submit" form="frmnotesbooks" class="btn npBtn1 btn-default">SEARCH</button>
							<input id="btnapprove" name="btnapprove" type="submit" form="frmnotesbooks" value="APPROVE" class="btn npBtn1 btn-default">
							<input id="btnunapprove" name="btnunapprove" type="submit" form="frmnotesbooks" value="UNAPPROVE" class="btn npBtn1 btn-default">
							<input id="btndelete" name="btndelete" type="submit" form="frmnotesbooks" value="DELETE" class="btn npBtn1 btn-default">
							<input id="btnreset" name="btnreset" type="submit" form="frmuser" value="RESET" onclick="reset_form()" class="btn npBtn1 btn-default">
						</form>
					</div>
					
					<div class="mgRightPart rightBtn" style="display:none;">
						<button type="button" class="btn btn-default">Active/Inactive</button>
						<button type="button" class="btn btn-default">Reset</button>
					</div>
					
				</div>
				
				<div class="col-xs-12 padd0">
					<div class="table-responsive">
						
							  <!-- Code start for get all books/notes  -->
							   <?php	
							      $perpage = 2000;
								  if(isset($_GET["page"])){
								   $page = intval($_GET["page"]);
								  }
								  else {
								   $page = 1;
								  }
								  $calc = $perpage * $page;
								  $start = $calc - $perpage;
								 
								  if(isset($_COOKIE['useremailid']))
								  {
								     include "../cs/config.php";
									 $UserId=$_COOKIE['useremailid'];
									 $srchkywrdval="";
									 $fromdateval="";
									 $todateval="";
									 $statusval="";
									 $CrtdByVal="";
									 if($get_from_date!="")
									 {
									    $fromdateval=$get_from_date;
									 }
									 if($get_to_date!="")
									 {
									    $todateval=$get_to_date;
									 }
									 else
									 {
									    $todateval=date("Y-m-d");
									 }
									 if($get_status!="")
									 {
									   $statusval=$get_status;
									 }
									 else
									 {
									   $statusval="A";
									 }
									 if($get_crtdby!="")
									 {
									   $CrtdByVal=$get_crtdby;
									 }
									 if($get_srch_keyword!="")
									 {
									    $srchkywrdval=$get_srch_keyword;
									 }

									 $queryds = mysqli_query($db,"call sp_get_admin_books('','','','','".$fromdateval."','".$todateval."','','".$CrtdByVal."','".$srchkywrdval."','','".$statusval."','','','".$start."','".$perpage."','GET_ADMIN_BOOKSNOTES')");
									 $db->close();
									 if(mysqli_num_rows($queryds)>0)
									 {
									   $i=1;
									   $TotalRecords=mysqli_num_rows($queryds);
									   echo "<table class='table aTable1'><thead>
									   <tr style='text-align: center;font-size: 16px;'><td colspan='10'>Results: <font color='darkorange'>".$TotalRecords." </font>Records Found</td></tr>
													<tr>
														<th><input class='ChkBox_Size' type='checkbox' value='' id='checkAll' /></th>
														<th style='text-align: left;'>#</th>
														<th style='text-align: left;'>BOOK/NOTES</th>
														<th style='text-align: left;'>PRICE</th>
														<th style='text-align: left;'>CREATED DATE</th>
														<!--<th style='text-align: left;'>TYPE</th>-->
														<th style='text-align: left;'>AVAILABLE FOR</th>
														<th style='text-align: left;'>CREATED BY</th>
														<th>*</th>
														<th>EDIT</th>
														<th>VIEW</th>
													</tr>
												</thead>
												<tbody>";
									   while($row = mysqli_fetch_array($queryds))
									   {
									        $bookid = $row['id'];
											$booktitle = $row['title'];
											$booktitle=implode(' ', array_slice(explode(' ', $booktitle), 0, 3));
											$bookauthor = $row['author'];
											$price = $row['price'];
											if($price=="" || $price=="0" || $price=="(NULL)" || $price=="NULL")
											{
											   $price = 'Free';
											}
											else
											{
											   $price= "<i class='fa fa-inr' aria-hidden='true'></i>&nbsp;".$price;
											}
											$crtddate = $row['crtddate'];
											$processval = $row['process'];
											$booktypeval = $row['book_type'];
											if($booktypeval=="BOOK")
											{
											  $booktypeval="Book";
											}
											else
											{
											  $booktypeval="Notes";
											}
											$crtdby = $row['crtdby'];
											$availabilityval = $row['availability'];
											
										    // if($availabilityval=="BOTH")
										    // {
											  // $availabilityval="For Marketplace & Members";
										    // }
										    // elseif($availabilityval=="MARKET")
										    // {
											  // $availabilityval="For Marketplace";
										    // }
										     // elseif($availabilityval=="MEMBER")
										    // {
											  // $availabilityval="For Members";
										    // }
											
											$EditUrl=$SiteURL."booksnotesdetails.php?bookid=".$bookid;
											$ViewUrl=$SiteURL."reader.php?id=".$bookid;
											
											echo "<tr>";
											echo "<td><input type='checkbox' form='frmnotesbooks' class='toggleCheck ChkBox_Size' name='checkbox[]' value='$bookid'></td>";
											echo "<td style='text-align: left;'>$i</td>";
											echo "<td style='text-align: left;'>$booktitle</td>";
											echo "<td style='text-align: left;'>$price</td>";
											echo "<td style='text-align: left;'>$crtddate</td>";
											//echo "<td style='text-align: left;'>$booktypeval</td>";
											echo "<td style='text-align: left;'>$availabilityval</td>";
											echo "<td style='text-align: left;'>$crtdby</td>";
											if($processval=="T")
											 {
												 echo "<td><i class='fa fa-check-circle-o greenTick_Active' aria-hidden='true'></i></td>";
											 }
											 else if($processval=="E")
											 {
												 echo "<td><i class='fa fa-check-circle-o redTick_InActive' aria-hidden='true'></i></td>";
											 }
											 else if($processval=='' || $processval=='F' || $processval=='(NULL)' || $processval=='NULL')
											 {
											    echo "<td><i class='fa fa-clock-o grayTick_InActive' aria-hidden='true'></i></td>";
											 }
											 else
											 {
												 echo "<td><i class='fa fa-clock-o clockWait' aria-hidden='true'></i></td>";
											 }
											echo "<td style='text-align: center;'><a href='$EditUrl' target='_blank' alt='Edit eBook/eNote' title='Edit eBook/eNote'><i class='fa fa-pencil-square-o EditIcon_Size' aria-hidden='true'></i></a></td>";
											echo "<td><a href='$ViewUrl' target='_blank' alt='VIEW eBook/eNote' title='VIEW eBook/eNote'><i class='fa fa-eye ViewIcon_Size' aria-hidden='true'></i></a></td>";
											
											echo "</tr>";
											$i=$i+1;
									    }
										echo "</tbody></table>";
									 }
									 else
									 {
									  echo "<table class='table aTable1'><tbody>";
									  echo "<tr style='background: none;'>";
									  echo "<td style='border:none;font-size: 16px;' colspan='10'>Results: No Records found</td>";
									  echo "</tr></tbody></table>";
									 }
								  }
							  ?>
							  <!-- Code end for get all books/notes  -->
							
						
					</div>
				</div>
				</form>
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
		
		<script>
			/* Date Time Function Start */
			$(function() {
				$('#datetimepicker1, #datetimepicker2').datetimepicker({
				pickTime: false
				});
			});
			/* End */
		</script>
	</body>
</html>
<?php ob_end_flush(); ?>