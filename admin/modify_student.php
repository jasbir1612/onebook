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
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/common.css">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/dashboard.css">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/responsive.css">
		
		<script type="text/javascript">
		function ConfirmDelete(UId) {
			 var x = confirm("Are you sure you want to delete?");
			  if (x)
			  {
				//alert(bookid);
				var Url="admin/modify_user.html";				
				location.href="delete_user.php?userid="+UId+"&url="+Url+"";
			  }
			  else{return false;}
		}
		
		function reset_form() {
			document.getElementById("frmuser").reset();
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
			
			if (isset($_POST['btnsrchuser']))
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
				  $statusval="T";
				  $roleid="1";
				  $useremail=$_COOKIE['useremailid'];
				  for($i=0; $i < $N; $i++)
				  {
				     include "../cs/config.php";
					 $UID=$achk[$i];
					 $qryds = mysqli_query($db,"call sp_update_common('".$UID."','".$useremail."','','','','','','','".$statusval."','".$roleid."','','','','','','','','','','UPDATE_STATUS_USER',@resultmsg,@errormsg)") or die('Query Not execute'.mysqli_error($db));
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
				    echo "<script>alert('Educator/Publisher approved successfully')</script>";
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
				  $statusval="F";
				  $roleid="1";
				  $useremail=$_COOKIE['useremailid'];
				  for($i=0; $i < $N; $i++)
				  {
				     include "../cs/config.php";
					 $UID=$achk[$i];
					 $qryds = mysqli_query($db,"call sp_update_common('".$UID."','".$useremail."','','','','','','','".$statusval."','".$roleid."','','','','','','','','','','UPDATE_STATUS_USER',@resultmsg,@errormsg)") or die('Query Not execute'.mysqli_error($db));
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
				    echo "<script>alert('Educator/Publisher unapproved successfully')</script>";
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
				  $roleid="1";
				  $useremail=$_COOKIE['useremailid'];
				  for($i=0; $i < $N; $i++)
				  {
				     include "../cs/config.php";
					 $UID=$achk[$i];
					 $qryds = mysqli_query($db,"call sp_update_common('".$UID."','".$useremail."','','','','','','','".$statusval."','".$roleid."','','','','','','','','','','UPDATE_STATUS_USER',@resultmsg,@errormsg)") or die('Query Not execute'.mysqli_error($db));
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
				    echo "<script>alert('Educator/Publisher deleted successfully')</script>";
				  }
			   }
			}
		}
		 
		?>
		
	</head>
	<body>
		<div class="mainWrap">
		
			 <!-- Dashboard Start Here -->
			 <?php include_once('../dashboard.php');?>
			 <!-- Dashboard End Here -->
			 
			<div class="container wrapMB">
			<form method="post" id="frmuser" name="frmuser" enctype="multipart/form-data" action="<?php $_PHP_SELF ?>">
				<div class="col-xs-12 padd0 mbHeadDiv">
					<div class="pull-left">
						<img src="<?php echo $SiteURL;?>img/readerIcons/subscribers_big.png" alt="User Logo" class="img-responsive mbBshelf"/>
						<div class="mbManage">
							<div class="mBooksTxt">Manage Students</div>
							<ul class="list-inline">
								<!--<li><a href="#">Monthwise</a></li>
								<li><a href="#">Subscribers</a></li>
								<li><a href="<?php echo $SiteURL;?>admin/add_user.html">Add Educators</a></li>-->
							</ul>
						</div>
					</div>
					<div class="pull-right">
						<form class="mtop19">
							<?php
							    
							// $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') 
											// === FALSE ? 'http' : 'https';
							// $host     = $_SERVER['HTTP_HOST'];
							// $script   = $_SERVER['SCRIPT_NAME'];
							// $params   = $_SERVER['QUERY_STRING'];
							// $currentUrl = $protocol . '://' . $host . $script . '?' . $params;
							// $currentUrl;
							
							// $CurrentURL = $_SERVER['PHP_SELF']; // Get the current URL Path
							// $CurrentPage = basename($CurrentURL); //Get the File/Page/Folder Name from the Path
							// $CurrentPage = basename($CurrentURL, '.php');   //Show filename without file extension
								
							  //ECHO $Actual_Url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
							  $Actual_Url = $_SERVER['REQUEST_URI'];

							  $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
							  echo "<a class='btn ndBtn1 btn-default' href='$url'><i class='fa fa-angle-left' aria-hidden='true'></i> Back</a>"; 
						    ?>
						</form>
					</div>
				</div>
				<div class="col-xs-12 padd0 ndEco">
					<div class="mgLeftPart">
					
					<div class="input-group searchInput">
							<input id="srchkeywrd" name="srchkeywrd" type="text" class="form-control" form="frmuser" placeholder="Search here..." value="<?php echo $get_srch_keyword;?>" />
							<div class="input-group-btn">
								<div class="btn-group" role="group">
									<button id="btnsrchuser" name="btnsrchuser" type="submit" class="btn" form="frmuser"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
								</div>
							</div>
						</div>
					
						<div id="datetimepicker1" class="input-append date npDivWidth1">
							<input id="txtfromdate" name="txtfromdate" data-format="dd/MM/yyyy" type="text" form="frmuser" class="form-control user_drop_dwn border_radius4" placeholder="From Date" value="<?php echo $get_from_date_sel;?>" readonly />
							<span class="add-on input-group-addon no_css">
							<i class="fa fa-calendar clrOrange"></i>
							</span>
						</div>
						<div id="datetimepicker2" class="input-append date npDivWidth1">
							<input id="txttodate" name="txttodate" data-format="dd/MM/yyyy" type="text" form="frmuser" class="form-control user_drop_dwn border_radius4" placeholder="To Date" value="<?php echo $get_to_date_sel;?>" readonly />
							<span class="add-on input-group-addon no_css">
							<i class="fa fa-calendar clrOrange"></i>
							</span>
						</div>
						
						<div class="input-append npDivWidth2">
						 <select id="ddlstatus" name="ddlstatus" form="frmuser" class="form-control drpdown_status">
							<option selected='selected' value="">--Select Status--</option>
							<option value="T" selected="true" <?php if($get_status=='T'){echo 'selected=selected';} ?>>Approve</option>
							<option value="F" <?php if($get_status=='F'){echo 'selected=selected';} ?>>UnApprove</option>
							<option value="D" <?php if($get_status=='D'){echo 'selected=selected';} ?>>Delete</option>
							</select>
						</div>
						<form class="goBtnForm1">
							<!--<a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>-->
							<button id="btngo" name="btngo" type="submit" form="frmuser" class="btn npBtn1 btn-default">SEARCH</button>
							<input id="btnapprove" name="btnapprove" type="submit" form="frmuser" value="APPROVE" class="btn npBtn1 btn-default">
							<input id="btnunapprove" name="btnunapprove" type="submit" form="frmuser" value="UNAPPROVE" class="btn npBtn1 btn-default">
							<input id="btndelete" name="btndelete" type="submit" form="frmuser" value="DELETE" class="btn npBtn1 btn-default">
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
									 $usertypeval="1";	
									 $srchkywrdval="";
									 $fromdateval="";
									 $todateval="";
									 $statusval="";	

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
									   $statusval="T";
									 }
									 if($get_srch_keyword!="")
									 {
									    $srchkywrdval=$get_srch_keyword;
									 }
									 
									 $queryds = mysqli_query($db,"call sp_get_users('','".$UserId."','".$usertypeval."','".$fromdateval."','".$todateval."','".$statusval."','".$srchkywrdval."','".$start."','".$perpage."','GET_USERS')");
									 $db->close();
									 if(mysqli_num_rows($queryds)>0)
									 {
									   $i=1;
									   $TotalRecords=mysqli_num_rows($queryds);
									   echo "<table class='table aTable1'><thead>
										<tr style='text-align: center;font-size: 16px;'><td colspan='8'>Results: <font color='darkorange'>".$TotalRecords." </font>Records Found</td></tr>
											<tr>
												<th><input class='ChkBox_Size' type='checkbox' value='' id='checkAll' /></th>
												<th>#</th>
												<th style='text-align: left;'>NAME</th>
												<th>EMAILID</th>
												<!--<th>USERTYPE</th>-->
												<th>CREATED BY</th>									
												<th>STATUS</th>
												<th colspan='2'>ACTION</th>
											</tr>
										</thead>
										<tbody>";
									   while($row = mysqli_fetch_array($queryds))
									   {
											$Subscriber_id = $row['Subscriber_id'];
											$First_name = $row['first_name'];
											$Subscriber_emailid = $row['subscriber_emailid'];
											$crtddate = $row['crtddate'];
											$User_type = $row['user_type'];
											if($User_type==0) 
											{
											   $User_type="Admin";
											}
											else if($User_type==1) 
											{
											   $User_type="Student";
											}
											else if($User_type==2) 
											{
											   $User_type="Educator";
											}
											$Status = $row['status'];
											if ($Status=='T') 
											{
											   $Status="Approve";
											}
											else if ($Status=='D') 
											{
											   $Status="Delete";
											}
											else
											{
											   $Status="UnApprove";
											}
											
											$EditUrl=$SiteURL."admin/edit_user.php?userid=".$Subscriber_id;
											$DeleteUrl=$SiteURL."admin/delete_user.php?userid=".$Subscriber_id."&url=".$Actual_Url;
											
											echo "<tr>";
											echo "<td><input type='checkbox' form='frmuser' class='toggleCheck ChkBox_Size' name='checkbox[]' value='$Subscriber_id'></td>";
											echo "<td>$i</td>";
											echo "<td style='text-align: left;'>$First_name</td>";
											echo "<td>$Subscriber_emailid</td>";
											//echo "<td>$User_type</td>";
											echo "<td>$crtddate</td>";
											echo "<td style='font-size: 14px;'>$Status</td>";
											echo "<td><a title='$First_name' href='$EditUrl' target='_blank'><i class='fa fa-pencil-square-o EditIcon_Size' aria-hidden='true'></i></a></td>";
											echo "<td style='text-align: center;'><a title='Delete User' Onclick='return ConfirmDelete($Subscriber_id);' target='_self'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
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