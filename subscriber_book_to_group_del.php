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
		<link rel="stylesheet" href="css/notesPage.css">
		<link rel="stylesheet" href="css/subscriber_details.css">
		<link rel="stylesheet" href="css/responsive.css">
		<?php
			require_once "cs/common.php";
		?>
	</head>
	<body>
		<div class="mainWrap">
			
			 <!-- Dashboard Start Here -->
			 <?php include_once('dashboard.php');?>
			 <!-- Dashboard End Here -->

			<div class="container wrapMB">
				<div class="col-xs-12 padd0 mbHeadDiv">
					<div class="pull-left">
						<img src="img/readerIcons/bookshelf_big.png" alt="Bookshelf Logo" class="img-responsive mbBshelf"/>
						<div class="mbManage">
						      <!-- Code start for header --> 
						    <?php 
								if(isset($_COOKIE['useremailid']))
								{
									if($_COOKIE['roleid']=="3")
									{
										?>		
										<div class="mBooksTxt">Manage Books/Notes</div>
										<ul class="list-inline">
											<!--<li><a href="#">Books</a></li>
											<li><a href="#">Notes</a></li>-->
											<li><a href="manageBooks.html">Upload Content</a></li>
										</ul>
										<?php 
									}
									else if($_COOKIE['roleid']=="2")
									{
										?>		
										<div class="mBooksTxt">Manage Books/Notes</div>
										<ul class="list-inline">
											<!--<li><a href="#">Books</a></li>
											<li><a href="#">Notes</a></li>-->
											<li><a href="manageBooks.html">Upload Content</a></li>
										</ul>
										<?php 
									}
								}
								?>
								<!-- Code end for header --> 
						</div>
					</div>
				</div>
				<div class="col-xs-12 padd0 ndEco" style='border-bottom:none;'>
				<form method="post" id="form2" name="form2" enctype="multipart/form-data" 
				action="<?php $_PHP_SELF?>"> 
				<!-- Code start for get the book/notes title --> 
				<?php
				include "cs/config.php";
				if(isset($_GET['bookid']) && count($_GET) > 0 ) 
				{ 
					$BNId = mysqli_real_escape_string($db,$_GET['bookid']);
					$qryds = mysqli_query($db,"call sp_get_common_data('','','".$BNId."','','','','','A','','','','','','','','','','GET_BOOKNOTES_DETAILS')") 
					or die('Query Not execute'.mysqli_error($db));
					$db->close();
					if(mysqli_num_rows($qryds)>0)
					{
					  $row = mysqli_fetch_array($qryds);
					  $category_nameval = $row['category_name'];
					  $BookNotesId = $row['id'];
					  $titleval = $row['title'];
					  $authorval = $row['author'];
					  $publicationval = $row['publication'];
					  $course_idval = $row['course_id'];
					  $subject_idval = $row['category_id'];					 
					  echo "<div class='mBooksTxt'>$titleval</div>";
					  mysqli_free_result($qryds);
				  }
				}
			?>
			<!-- Code end for get the book/notes title --> 
			</form>
				    
				</div>
				<div class="col-xs-12 padd0 ndEco">
					<div class="ndLeftPart" style='width:78%;'>
						<div class="input-group stylish-input-group" style='width:25.5%;display:none;'>
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
						<form class="goBtnForm1" style='margin-right:0px;display:none;'>
							<button type="button" class="btn npBtn1 btn-default">Go</button>
						</form>
						<div>
						<a href="subscriber_book_to_group.php?bookid=<?php echo $_GET['bookid']; ?>" target='_self' class="abGroup"><img src="img/readerIcons/subscribers_BW.png" alt="Subscriber Logo" class="img-responsive" /> ADD GROUP</a>
						 <!--<button form="form1" type='submit' id='addbooktogroup' name='addbooktogroup' class='btn npBtn1 btn-default'><i class="fa fa-check" aria-hidden="true"></i> ADD SELECTED</button>-->
						 <!--<input form="form1" type='submit' value='ADD GROUP' id='addbooktogroup' name='addbooktogroup' class='btn npBtn1 btn-default'></input>-->
						</div>
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
					<div class="table-responsive">
					<form method="post" id="form1" name="form1" enctype="multipart/form-data" action="<?php $_PHP_SELF ?>">
						<table class="table mgTable2">
							<thead>
								<tr>
									<!--<th><input type="checkbox" value="" id="checkAll" /></th>-->
									<th>#</th>
									<th>GROUP NAME</th>
									<th>COURSE</th>
									<th>SUBJECT</th>
									<th>SUMMARY</th>
									<th>TIMING</th>
									<th>MEMBER(S)</th>
									<th>ACTION</th>
								</tr>
							</thead>
							<tbody>
                             <!-- Code start for get the groups --> 
							<?php 
							   include "cs/config.php";
							   $run = mysqli_query($db,"call sp_get_common_data('','".$_COOKIE['useremailid']."','".$_GET['bookid']."','','','',
							   '','A','','','','','','','','','','GET_ASSIGNED_BOOK_TO_GROUP')") or die('Query Not execute'.mysqli_error($db));
							   $db->close();
							   if(mysqli_num_rows($run)>0)
						       {
							       $i=1;
							       $rownumber=0;
								   while ($row = mysqli_fetch_array($run))
								   {
									$rownumber = $rownumber + 1;
									$group_id = $row['group_id'];
									$group_name = $row['group_name'];
									$group_date = $row['crtd_date'];
									$group_desc = $row['group_desc'];
									$course_id = $row['course_id'];
									$subject_id = $row['subject_id'];
									$timeing = $row['group_timing'];
									$course_name = $row['course_name'];
									$subject_name = $row['category_name'];

									 include "cs/config.php";
									 $querymem_ds = mysqli_query($db,"call sp_get_common_data('','','','','','','','A','".$group_id."','','','','','','','','','GET_GROUPS_MEMBERS_COUNTS')") or die('Query Not execute'.mysqli_error($db));
									 $db->close();
									 if(mysqli_num_rows($querymem_ds)>0)
									 {
										 $rowm = mysqli_fetch_array($querymem_ds);
										 $totalmembers = $rowm['totalmembers'];
										 mysqli_free_result($querymem_ds); 
									 }
									 ?>
									   <tr>
										<!--<td><input type="checkbox" class="toggleCheck" name='checkbox[]' value='<?php echo $group_id; ?>' /></td>-->
										<td><?php echo $i; ?></td>
										<td><a href="manageListMembers.php?groupid=<?php echo $group_id; ?>" target='_self'><?php echo $group_name; ?></a></td>
										<td><?php echo $course_name; ?></td>
										<td><?php echo $subject_name; ?></td>
										<td><?php echo $group_desc; ?></td>
										<td><?php echo $timeing; ?></td>
										<td><?php echo $totalmembers;?></td>
										<td><a href="delete_book_to_group.php?groupid=<?php echo $group_id; ?>&bookid=<?php echo $_GET['bookid']; ?>" target='_self'><i class="fa fa-trash" aria-hidden="true"></i></a></td>
									 </tr>
									  <?php 
									   $i=$i+1;
									  } 
								    mysqli_free_result($run);
								  }
								?>
								 <!-- Code end for get the groups --> 
							</tbody>
						</table>
						<input type="hidden" id="hdn_course_id" name="hdn_course_id" value="<?php echo $course_idval;?>">
			           <input type="hidden" id="hdn_subject_id" name="hdn_subject_id" value="<?php echo   $subject_idval;?>">
					   <input type="hidden" id="hdn_booknotes_id" name="hdn_booknotes_id" value="<?php echo $BookNotesId;?>">
					   <input type="hidden" id="hdn_booknotes_title" name="hdn_booknotes_title" value="<?php echo $titleval;?>">
						</form>
					</div>
				</div>
				<div class="col-xs-12 padd0" style='display:none;'>
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
			/* End */
		</script>
		
		
	</body>
</html>
<?php ob_end_flush(); ?>