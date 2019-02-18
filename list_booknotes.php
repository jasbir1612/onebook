<!DOCTYPE html>
<?php ob_start(); ?>
<?php include "cs/config.php"; ?>
<?php require_once "cs/common.php";	?>
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
		<link rel="stylesheet" href="css/jasny-bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
		<link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" href="css/notesPage.css">
		<link rel="stylesheet" href="css/responsive.css">
		<style>
		 #page_links
		 {
		  color:white;
		  background: #93939a;
		 }
		 #page_a_link
		 {
		  text-decoration: none;
		 }
		</style>
		<script type="text/javascript">
		function ConfirmDelete(bookid) {
		    alert('sdfdsf');
			 var x = confirm("Are you sure you want to delete?");
			  if (x)
			  {
				//alert(bookid);		  
				location.href="deletebooknotes.php?booknotesid="+bookid+"";
			  }
			  else{return false;}
		}
		</script>
		
		<?php	
		 if(isset($_POST['searchbtn']))
		 {
		    $hdncourseid=mysqli_real_escape_string($db,$_POST['dropdowncourse']);
			$hdnsubjectid=mysqli_real_escape_string($db,$_POST['dropdownsubject']);
			$hdnstatusid=mysqli_real_escape_string($db,$_POST['dropdownstatus']);
	     }
		 if(isset($_POST['approvebtn']))
		 {
			include "cs/config.php";
			$hdncourseid=mysqli_real_escape_string($db,$_POST['dropdowncourse']);
			$hdnsubjectid=mysqli_real_escape_string($db,$_POST['dropdownsubject']);
			$hdnstatusid=mysqli_real_escape_string($db,$_POST['dropdownstatus']);
			
			$booknotesid=$_POST['approvebtn']; 
			$status="A";
			$qryds = mysqli_query($db,"call sp_delete_common_data('','','".$booknotesid."','','','','','".$status."','','','','','','','','','','STATUS_UPDATE_BOOKNOTES')") or die('Query Not execute'.mysqli_error($db));
			$db->close();
		 }
		 if(isset($_POST['unapprovebtn']))
		 {
			include "cs/config.php";
			$hdncourseid=mysqli_real_escape_string($db,$_POST['dropdowncourse']);
			$hdnsubjectid=mysqli_real_escape_string($db,$_POST['dropdownsubject']);
			$hdnstatusid=mysqli_real_escape_string($db,$_POST['dropdownstatus']);
			
			$booknotesid=$_POST['unapprovebtn']; 
			$status="P";
			$qryds = mysqli_query($db,"call sp_delete_common_data('','','".$booknotesid."','','','','','".$status."','','','','','','','','','','STATUS_UPDATE_BOOKNOTES')") or die('Query Not execute'.mysqli_error($db));
			$db->close();
		 }
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
						         <!-- Code start for top bar  -->
						        <?php 
								if(isset($_COOKIE['useremailid']))
								{
									if($_COOKIE['roleid']=="3" || $_COOKIE['roleid']=="2")
									{
										?>		
										<div class="mBooksTxt">Manage Books/Notes</div>
										<ul class="list-inline">
											<li><a href="#">Books</a></li>
											<li><a href="#">Notes</a></li>
											<li><a href="manageBooks.html">Upload Content</a></li>
										</ul>
										<?php 
									}
								}
								?>
								<!-- Code end for top bar  -->
						</div>
					</div>
				</div>
				<div class="col-xs-12 padd0 ndEco" style="display:block;">
					<div class="ndLeftPart">
					<form method="post" id="frmsrchbooks" name="frmsrchbooks" enctype="multipart/form-data" action= "<?php $_PHP_SELF ?>">
						<div class="col-xs-12 padd0">
						<div class="input-group stylish-input-group">
							<input type="text" class="form-control" placeholder="Search by name" >
							<span class="input-group-addon">
							<button type="submit">
							<span class="glyphicon glyphicon-search"></span>
							</button>
							</span>
						</div>
						<div id="datetimepicker1" class="input-append date npDivWidth1">
							<input data-format="dd/MM/yyyy" type="text" form="frmsrchbooks" class="form-control user_drop_dwn border_radius4" placeholder="From Date">
							<span class="add-on input-group-addon no_css">
							<i class="fa fa-calendar clrOrange"></i>
							</span>
						</div>
						<div id="datetimepicker2" class="input-append date npDivWidth1">
							<input data-format="dd/MM/yyyy" type="text" form="frmsrchbooks" class="form-control user_drop_dwn border_radius4" placeholder="To Date">
							<span class="add-on input-group-addon no_css">
							<i class="fa fa-calendar clrOrange"></i>
							</span>
						</div>
							<!--<button type="button" class="btn npBtn1 btn-default">Go</button>-->
							<input type="submit" form="frmsrchbooks" id="searchbtn" name="searchbtn" value="Go" class="btn npBtn1 btn-default" />
							<input type="hidden" id="hdn_course_id" name="hdn_course_id" value="<?php echo $hdncourseid;?>">
							<input type="hidden" id="hdn_subject_id" name="hdn_subject_id" value="<?php echo $hdnsubjectid;?>">
							<input type="hidden" id="hdn_status_id" name="hdn_status_id" value="<?php echo $hdnstatusid;?>">
						</div>
						
						<div class="col-xs-12 padd0 mtop5">
						<div class="input-group stylish-input-group" style='width:12.5%;'>
						  <select class="ndLeftPart" form="frmsrchbooks" id="dropdowncourse" name="dropdowncourse">
						   <?php	
							include "cs/config.php";
							$result_state = $db->query("call sp_get_admin_common('GETALLCOURSE')");
							$db->close();
							$total=0;
							if(!($total= $result_state->num_rows)==0)
							{
							?><option value="0" selected='selected'>--Select--</option> <?php 
							while($rowdist = $result_state->fetch_array()) 
							{
							 ?>  
								<option value="<?php echo $rowdist['course_id']; ?>" <?php if($hdncourseid==$rowdist['course_id']){echo 'selected=selected';} ?> ><?php echo  $rowdist['course_name']; ?></option>
							 <?php 
							}
							}
							
							?>
						  </select>
	                 </div>
					   <div class="input-group stylish-input-group" style='width:12.5%;' >
					   <select class="ndLeftPart" form="frmsrchbooks" id="dropdownsubject" name="dropdownsubject">
							   <?php				
								include "cs/config.php";
								$result_state = $db->query("call sp_get_admin_common('GETALLSUBJECT')");
								$db->close();
								$total=0;
								if(!($total= $result_state->num_rows)==0)
								{
								?><option value="0" selected='selected'>--Select--</option> <?php 
								while($rowdist = $result_state->fetch_array()) 
								{
								 ?>  
									<option value="<?php echo $rowdist['category_id']; ?>" <?php if($hdnsubjectid==$rowdist['category_id']){echo 'selected=selected';} ?>><?php echo  $rowdist['category_name']; ?></option>
								  <?php 
								}
								}
							  ?>
					  </select>
					  </div>
					   <div class="input-group stylish-input-group" style='width:12.5%;'>
					   <select class="ndLeftPart" id="dropdownstatus" name="dropdownstatus">
						 <option value="0" selected='selected'>--Select--</option>
						 <option value="A" <?php if($hdnstatusid=="A"){echo 'selected=selected';} ?>><?php echo "Approve"; ?></option>
						 <option value="P" <?php if($hdnstatusid=="P"){echo 'selected=selected';} ?>><?php echo "Unapprove"; ?></option>
						 <option value="D" <?php if($hdnstatusid=="D"){echo 'selected=selected';} ?>><?php echo "Delete"; ?></option>
					  </select>
					  <!--<input type='submit' form='frmsrchbooks' id='approvebtn' name='approvebtn' value='Approve' class='btn npBtn1 btn-default' />
					  <input type="submit" form="frmsrchbooks" id="unapprovebtn" name="unapprovebtn" value="Unapprove" class="btn npBtn1 btn-default" />-->
					   </div>
					   </div>
					</form>
					</div>
					<div class="ndRightPart" style="display:none;">
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
					  <!-- Code start for get all books/notes  -->
					  <?php			
						  $perpage = 20;
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
							include "cs/config.php";
							$UserId=$_COOKIE['useremailid'];

							if($hdnstatusid=="0" or $hdnstatusid=="")
							{
							  $hdnstatusid="A";
							}

							$queryds = mysqli_query($db,"call sp_get_books_list('".$hdncourseid."','".$hdnsubjectid."','','','','','".$UserId."','','','".$hdnstatusid."','".$start."','".$perpage."','GETBOOKSNOTES')");
							$db->close();
							if(mysqli_num_rows($queryds)>0)
							{
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
									$process = $row['process'];
									$availabilityval = $row['availability'];
                                     
									if($thumbimg!="")
									{
										$thumbimgpath = returnthbimage($thumbimg);
									    $largeimgpath = returnthbimage($largeimg);
										$thumbimgpath=$S3URL.$thumbimgpath;
									    $largeimgpath=$S3URL.$largeimgpath;																
									}
									else
									{
										$thumbimgpath=$DefaultThumbPath;
										$largeimgpath=$DefaultLargePath;
									}
									 
									echo "<div class='col-xs-12 col-sm-6 col-md-4 padd03 mtop5'>";
											echo " <div class='col-xs-12 padd5 npOuterBox'>";
											echo "<div class='col-xs-4 padd0' style='height: 170px;'>";
												echo "<a href='booksnotesdetails.php?bookid=$bookid' target='_self'><img style='width: auto;height: 100%;' src='$thumbimgpath' alt='Book Cover' class='img-responsive'></a>";
											echo "</div>";
											echo "<div class='col-xs-8 paddL10R0 npTitleDiv1'>
												<div class='npBooktitle1'><a href='booksnotesdetails.php?bookid=$bookid' target='_self'>$booktitle</a></div>";
												echo "<p>by $bookauthor</p>
												<p>Price: $price</p>
												<p class='txtItalic'>$crtddate</p>
												<fieldset class='rating' style='display:none;'>
													<input type='radio' id='star1a' name='rating1' value='5' />
													<label for='star1a'>5 stars</label>
													<input type='radio' id='star1b' name='rating1' value='4' />
													<label for='star1b'>4 stars</label>
													<input type='radio' id='star1c' name='rating1' value='3' />
													<label for='star1c'>3 stars</label>
													<input type='radio' id='star1d' name='rating1' value='2' />
													<label for='star1d'>2 stars</label>
													<input type='radio' id='star1e' name='rating1' value='1' />
													<label for='star1e'>1 star</label>
												</fieldset>";
												echo "<div class='npIconPC'>
													<a href='ManageEditBooks.php?bookid=$bookid' target='_self'><i class='fa fa-pencil' aria-hidden='true' style='display:none;'></i></a>
													<i class='fa fa-comment' aria-hidden='true' style='display:none;'></i>
													<sup style='display:none;'>5</sup>";
													  if($availabilityval=='MEMBER' || $availabilityval=='BOTH')
													  {
														echo "<a href='subscriber_book_to_group.php?bookid=$bookid' target='_self'><img src='img/readerIcons/subscribers_mid.png'  alt='Subsciber Icon' class='img-responsive'/></a>";
													  }
													echo "<a style='cursor: pointer;' Onclick='return ConfirmDelete($bookid);' class='npIconA'>
														<i class='fa fa-trash-o' aria-hidden='true'></i></a>
												   </div>";
												 if($process=='' || $process=='F' || $process=='(NULL)' || $process=='NULL')
												 {
													echo "<div style='background: #FFAB4A;float: left;padding: 6px 10px;color: white;font-weight: bold;'>In Process</div>";
												 }
											echo "</div>
											 <button type='submit' form='frmsrchbooks' name='approvebtn' id='approvebtn' class='btn npBtn1 btn-default' value='$bookid'>Approve</button>
											 <button type='submit' form='frmsrchbooks' name='unapprovebtn' id='unapprovebtn' class='btn npBtn1 btn-default' value='$bookid'>Unapprove</button>
										</div>
										<div class='col-xs-12 padd5 text-center npBtmdiv'>
											Last Update:  $moddate
										</div>
									</div>";
							    }
							}
						  }
						 ?>
						 <!-- Code start for get all books/notes  -->
					</div>
				</div>
				<div class="col-xs-12 padd0" style="display:none;">
					<div class="ndRightPart ndRightPart2">
					    <?php
						//$perpage = 3;
						if(isset($page))
						{
							include "cs/config.php";
							$UserId=$_COOKIE['useremailid'];
							$resultpage = mysqli_query($db,"call sp_get_books_list('".$hdncourseid."','".$hdnsubjectid."','','','','','".$UserId."','','','".$hdnstatusid."','0','0','GETBOOKSNOTES_COUNTS')");
							$db->close();
							if(mysqli_num_rows($resultpage)>0)
							{
								$rowqry = mysqli_fetch_array($resultpage);
								$total = $rowqry['totalrows'];
							}
							$totalPages = ceil($total / $perpage);
							echo "<ul class='pagination'>";
							if($page <=1 )
							{
							   echo "<li><a id='page_links' style='font-weight: bold;margin-right: 3px;' href='#'><i class='fa fa-angle-left' aria-hidden='true'></i></a></li>";
							}
							else
							{
							    $j = $page - 1;
								echo "<li><a id='page_a_link' href='modify_booknotes.php?page=$j'><i class='fa fa-angle-left' aria-hidden='true'></i></a></li>";
							}
							for($i=1; $i <= $totalPages; $i++)
							{
							   if($i<>$page)
								{
								echo "<li><a id='page_a_link' href='modify_booknotes.php?page=$i'>$i</a></li>";
								}
								else
								{
								echo "<li><a id='page_links' style='font-weight: bold;' href='#'>$i</a></li>";
								}
							}
							if($page == $totalPages )
							{
							echo "<li><a id='page_links' style='font-weight: bold;margin-left: 3px;' href='#'><i class='fa fa-angle-right' aria-hidden='true'></i></a></li>";
							}
							else
							{
							$j = $page + 1;
							  echo "<li><a id='page_a_link' href='modify_booknotes.php?page=$j'><i class='fa fa-angle-right' aria-hidden='true'></i></a></li>";
							}
                            echo "</ul>";
						}
					    ?>
					    <!--<ul class="pagination">
							<li><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
						</ul>-->
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