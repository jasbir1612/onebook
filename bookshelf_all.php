<!DOCTYPE html>
<?php ob_start(); ?>
<?php require_once "cs/config.php"; ?>
<html lang="en">
	<head>
		<title>1Book: Digital Solutions for Students, Educators and Publishers</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="<?php echo $SiteURL;?>img/fevicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" href="css/bookshelf.css">
		<link rel="stylesheet" href="css/responsive.css">
		<?php
			require_once "cs/common.php";
		?>
		
		<!-- Validation for search book/notes start here -->
		<script language="javascript" type="text/javascript">
		function searchvalidation()
		{
			if(document.getElementById("srchtextbs").value=="")
			{
				alert("Please enter any search keyword");
				document.getElementById("srchtextbs").focus();
				return false;
			}
		}
		</script>
		<script  language="javascript" type="text/javascript">
			function srchEnter()
			{
				document.getElementById('srchtextbs').onkeypress=function(e)
				{
					if(e.keyCode==13)
					{
						document.getElementById('submit').click();
						return false;
					}
				}
			}
		</script>
		<!-- Validation for search book/notes end here -->
		
		<!-- Code for search the book/notes start here -->
		<?php
			include "cs/config.php";
			if(isset($_POST['submit']))
			{
				$srchtextval=$_POST['srchtextbs'];
				if($srchtextval!="")
				{
				 $path= "location:bookshelf_search.php?search=".$srchtextval."";
				 header($path);
				}
				else
				{
				  header("location:bookshelf.html");
				}
			}
		 ?> 
		<!-- Code for search the book/notes end here -->
		
		<!-- Function start for search bookstore's books-->
		<?php
		function main_section_election($courseid,$catid,$flag)
		{
			include "cs/config.php";
			$result = $db->query("sp_get_bookstore('".$courseid."','".$catid."','".$flag."')");
			$db->close();
			$total=0;
			if(!($total= $result->num_rows)==0){
			while($row = $result->fetch_array())
			{
			$rows[] = $row;
			}
			$result->close(); }
			return $rows;
		}	
		?> 
		<!-- Function end for search bookstore's books-->
		
	</head>
	<body>
	<div class="mainWrap">
             
       <!-- Header Start Here -->
	   <?php include_once('header_second.php');?>
	   <!-- Header End Here -->

		<div class="col-xs-12 padd0 divBG1" style="display:none;">
			<div class="innerWrap padd015">
				<div class="pull-left shelfTxt">BOOKSTORE</div>
				<div class="pull-right">
					<form class="navbar-form searchBox1" role="search" method="post" id="form1" name="form1" enctype="multipart/form-data" action= "<?php $_PHP_SELF ?>">
						<div class="input-group">
							<input type="text" id="srchtextbs" form="form1" name="srchtextbs" class="form-control searchBoxInput" placeholder="Find eBook, eNotes, etc" onkeypress="return srchEnter();">
							<div class="input-group-btn">
								<button class="btn btn-default searchBoxBtn" type="submit" name="submit" id="submit" form="form1"  OnClick="return searchvalidation();"><i class="glyphicon glyphicon-search"></i></button>
								<!--<input class="btn btn-default searchBoxBtn" type="submit" name="submit" id="submit" form="form1"  OnClick="return searchvalidation();">-->
							</div>
						</div>
					</form>
				</div>
				<div style="display: block; clear: both;"></div>
			</div>
		</div>

		<div class="col-xs-12 padd0 mtop24">
			<div class="innerWrap">
				<div class="col-xs-4 bswidth1 pnl_wrap">

					<!-- <div class="container demo"> -->
				<div class="panel-group mrg_0" id="accordion" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default bspanel">
						<div class="panel-heading panHead" role="tab" id="headingOne">
							<h4 class="panel-title">
								<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="more-less fa fa-caret-down mright3"></i> By Course</a>
							</h4>
						</div>
						<?php
						    if (isset($_GET['Cid']) && count($_GET) > 0 ) 
							  { 
								  $Cid=$_GET['Cid']; 
								  ?><div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne"> <?php
							  }
							  else
							  {
							    $Cid='All';
							    ?><div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne"> <?php 
							  }
						   
						 ?>
							<div class="panel-body bsPanelBody">
								  <ul class="bsBooksType">
								  <!-- start code for get the course -->
								   <?php				
										include "cs/config.php";
										$result_state = $db->query("call sp_get_common('GETCOURSE')");
										$db->close();
										$total=0;
										if(!($total= $result_state->num_rows)==0)
										{
											while($rowdist = $result_state->fetch_array()) 
											{
												$CourseId=$rowdist['courseid'];
												$CourseName=$rowdist['coursename'];
												$TotalCount=$rowdist['totalcount'];
												if ($CourseId == 'All')
												{
													$CourseName='All';
													?>
													<!--<li class="active"><a href="bookshelf.php?Cid=<?php echo $CourseId ?>"><?php echo $CourseName ?>(<?php echo $TotalCount ?>)</a></li>-->
													<?php	
													if ($CourseId == $Cid)
													{ 
													?><li class="active"><a href="bookshelf.php?Cid=<?php echo $CourseId ?>"><?php echo $CourseName ?></a></li><?php
													}
													else
													{
													?><li><a href="bookshelf.php?Cid=<?php echo $CourseId ?>"><?php echo $CourseName ?></a></li><?php
													}
													?>
												    <?php
												}
												else
												{
												 ?>
												 <!--<li><a href="bookshelf.php?Cid=<?php echo $CourseId ?>"><?php echo $CourseName ?>(<?php echo $TotalCount ?>)</a></li>-->
												 <?php
												    if ($CourseId == $Cid)
													{
													?><li class="active"><a href="bookshelf.php?Cid=<?php echo $CourseId ?>"><?php echo $CourseName ?></a></li><?php
													}
													else
													{
													?><li><a href="bookshelf.php?Cid=<?php echo $CourseId ?>"><?php echo $CourseName ?></a></li><?php
													}
												  ?>
												 
												 <?php 
												 }	   
											}
											$result_state->close(); 
										}
									 ?>
									 <!-- end code for get the course -->
								  </ul>
							</div>
						</div>
					</div>

					<div class="bsdivider1"></div>

					<div class="panel panel-default bspanel">
						<div class="panel-heading panHead" role="tab" id="headingTwo">
							<h4 class="panel-title">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="more-less fa fa-caret-down"></i> By Subject</a>
							</h4>
						</div>
						
							<?php
								if (isset($_GET['Sid']) && count($_GET) > 0 ) 
								  { 
									  $Sid=$_GET['Sid']; 
									  ?><div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo"> <?php
								  }
								  else
								  {
									$Sid='All';
									?><div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo"><?php 
								  }
							 ?>
							<div class="panel-body bsPanelBody">
								<ul class="bsBooksType">
								    <!-- start code for get the subject -->
								    <?php				
											include "cs/config.php";
											$result_state = $db->query("call sp_get_common('GETSUBJECT')");
											$db->close();
											$total=0;
											if(!($total= $result_state->num_rows)==0)
											{
											while($rowdist = $result_state->fetch_array()) 
											{
												$Subjectid=$rowdist['subjectid'];
												$Subjectname=$rowdist['subjectname'];
												$TotalCount=$rowdist['data-count'];
												if ($Subjectid == 'All')
												{
												$Subjectname='All';
												?>
												<!--<li class="active"><a href="bookshelf.php?Sid=<?php echo $Subjectid ?>"><?php echo $Subjectname ?>(<?php echo $TotalCount ?>)</a></li>-->
												 <?php
												    if ($Subjectid == $Sid)
													{
													?><li class="active"><a href="bookshelf.php?Sid=<?php echo $Subjectid ?>"><?php echo $Subjectname ?></a></li><?php
													}
													else
													{
													?><li><a href="bookshelf.php?Sid=<?php echo $Subjectid ?>"><?php echo $Subjectname ?></a></li><?php
													}
												 ?>
												<?php
												}
												 else
												{
												?>
												<!--<li><a href="bookshelf.php?Sid=<?php echo $Subjectid ?>"><?php echo $Subjectname ?>(<?php echo $TotalCount ?>)</a></li>-->
												<?php
												    if ($Subjectid == $Sid)
													{
													?><li class="active"><a href="bookshelf_all.php?Sid=<?php echo $Subjectid ?>"><?php echo $Subjectname ?></a></li><?php
													}
													else
													{
													?><li><a href="bookshelf_all.php?Sid=<?php echo $Subjectid ?>"><?php echo $Subjectname ?></a></li><?php
													}
												 ?>
												<?php
												}
											}
											$result_state->close(); 
										}
									?>
									 <?php 
										  if (isset($_GET['Cid']) && count($_GET) > 0 ) 
										  { 
											  $Cid=$_GET['Cid']; 
										  }
										  else
											{
											 $Cid='All';
											}
									   ?>
									   <!-- end code for get the subject -->
								  </ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			   <div class='col-xs-8 bswidth2'>
			    <!-- start code for get the books -->
				 <?php
				 $Sid="";
				 $Cid="";
				 if(isset($_GET['Sid']) && count($_GET) > 0 )
				 {
				     $Sid=$_GET['Sid'];
					 if($Sid=='All')
					 {
					    $Sid="";
					 }
				 }
				 if(isset($_GET['Cid']) && count($_GET) > 0 ) 
				 {
				     $Cid=$_GET['Cid']; 
					 if($Cid=='All')
					 {
					    $Cid="";
					 }
				 }
				 include "cs/config.php";
				 $run = mysqli_query($db,"call sp_get_bookstore('".$Cid."','".$Sid."','','GETCATEGORY')");	
				 $db->close();				 
				 $totalrowno= $run->num_rows;
				 $i=1;
				  while($rowcat = mysqli_fetch_array($run))
				  {
					 $catid = $rowcat['category_id'];
					 $catname = $rowcat['category_name'];
					 if(isset($_GET['Cid']) && count($_GET) > 0 ) 
					 {
					    $Cid=$_GET['Cid'];
						if($Cid=='All')
						{
						  $Cid="";
						}
					 }
					 include "cs/config.php";
					 $runbook = $db->query("call sp_get_bookstore('".$Cid."','".$catid."','','GETBOOKNOTES')");
					 $db->close();
					 
					    echo "<div class='col-xs-12 listHeading'>
						  <div class='pull-left brdr_org'><a href='bookshelf_all.php?Sid=$catid'>$catname </a></div>
						  <div class='pull-right'>
						   
						  </div>
						  <div class='col-xs-12 brdr_btm'></div>
						  </div>
						  <div class='col-xs-12 mbottom8'>";
						  
                     $totalbooks=0;
					 $j=1;
					 // echo $runbook->num_rows. "<br>";
					 if(!($totalbooks= $runbook->num_rows)==0){
					   
					 while($rowbook= mysqli_fetch_array($runbook))
					 {
						$bookid = $rowbook['id'];
						$booktitle = $rowbook['title'];
						$booktitleurl = keyword($rowbook['title']);
						$bookauthor = $rowbook['author'];
						$price = $rowbook['price'];
						if($price=="" || $price=="0")
						{
						   $price = 'Free';
						}
						else
						{
						  $price= "<i class='fa fa-inr' aria-hidden='true'></i>&nbsp;".$price;
						}
						$longtitle = $rowbook['long_title'];
						$publisher = $rowbook['publication'];
						$edition = $rowbook['edition'];
						$pages = $rowbook['pages'];
						$printisbn = $rowbook['print_isbn'];
						$etextisbn = $rowbook['etext_isbn'];
						$thumbimg = $rowbook['thumb_img'];
						$largeimg = $rowbook['large_img'];
						$booktypeval = $rowbook['book_type'];
                        if($booktypeval=="BOOK")
						{
						  $booktypeval="eBook";
						}
						else
						{
						  $booktypeval="eNotes";
						}
						if($thumbimg!="")
						{
							$thumbimgpath=returnthbimage($thumbimg);
						    $largeimgpath=returnthbimage($largeimg);
							$thumbimgpath=$S3URL.$thumbimgpath;
							$largeimgpath=$S3URL.$largeimgpath;
						}
						else
						 {
							$thumbimgpath=$DefaultThumbPath;
							$largeimgpath=$DefaultLargePath;
						 }
						 
						 $book_url=$SiteURL."subscription/".$booktitleurl."/".$bookid.".html";
						 /*<div class='bookTitle1 dot1'><a href='subscriber_page.php?id=$bookid' target='_self'>$booktitle</a></div>*/
						 
						 echo "<div class='col-xs-3 bsCarouselItem mbottom10'>
							<div class='bcvrLink'>
									<div class='posRel'>
										<a href='$book_url' target='_self'><img src='$thumbimgpath' alt='Book Cover' class='img-responsive' /></a>
										<span class='qView transEase' data-toggle='modal' data-target='#bsModal$i'>Quick View</span>
									</div>

										<div class='modal fade' id='bsModal$i' role='dialog' tabindex='-1'>
											<div class='modal-dialog modalWidth'>
											
											<div class='modal-content'>
												<div class='modal-header modHead1'>
												<button type='button' class='close' data-dismiss='modal'>&times;</button>
												<h4 class='modal-title'>$catname</h4>
												</div>
												<div class='modal-body modBody1'>
													<div class='modBody2'>
														<div class='bodyside1'>
															<a href='$book_url' target='_self'><img src='$largeimgpath' alt='Book Cover' class='img-responsive' /></a>
														</div>
														<div class='bodyside2'>
															<div class='aboutBook hidden-xs'><a href='$book_url' target='_self'>$longtitle</a>
															</div>
															<p>Type: $booktypeval</p>
															<p>Author(s): $bookauthor</p>
															<p>Publisher: $publisher</p>
															<p>Edition: $edition</p>
															<p>Pages: $pages</p>
															<p>Print ISBN: $printisbn</p>
															<p>eText ISBN: $etextisbn</p>
														</div>
														<div class='aboutBook2 visible-xs'>$longtitle</div>
													</div>
												</div>
											</div>
											</div>
										</div>

									<div class='coverFooter'>
										<div class='bookTitle1'><a href='$book_url' class='bookTitle2 dot1' target='_self'>$booktitle</a></div>
										<div class='bookAuthor1'>by $bookauthor</div>
										<div class='bookPrice1'>Price: $price</div>
									</div>
								
							</div>
						</div>";
					   $i=$i+1;
					   $j=$j+1;
					}
					
					}
					$runbook->close();
					?>
				</div>
			<?php 
		  }
		  $run->close();
		?>
        <!-- end code for get the books -->
				</div>
			</div>
		</div>

	   <!-- Footer Start Here -->
	   <?php include_once('footer.php');?>
	   <!-- Footer End Here -->

	</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="js/jquery.dotdotdot.min.js"></script>
		<script src="js/index.js"></script>
		
		<script src="js/scrolltofixed.js"></script> <!-- plugin is used to fix elements on the page (top, bottom, anywhere) -->
 
	<script>
	/* Fixed footer until it reaches its original position */
	$(document).ready(function() {
	$(".stickyNav").scrollToFixed();
	 
	$(window).scroll(function() {
	if ($(this).scrollTop() > 0) { // this refers to window
	$(".stickyNav").css("box-shadow", "0 2px 10px #999");
	}else{
	$(".stickyNav").css("box-shadow", "none");
	}
	});
	});
	/* Fixed footer until it reaches its original position */
	</script>
	
	
		<script>

$(document).ready(function() {
$('.dot1').dotdotdot({
ellipsis	: '...',
wrap		: 'letter',
fallbackToLetter: 'letter',
after		: null,
watch		: true,
height		: null,
tolerance	: 0
});

});

		</script>
	</body>
</html>
<?php ob_end_flush(); ?>