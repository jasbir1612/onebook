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
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" href="css/bookshelf_search.css">
		<link rel="stylesheet" href="css/responsive.css">
		<?php
			require_once "cs/common.php";
		?>
		<?php
		if(isset($_COOKIE['useremailid']))
		{
		$UID=$_COOKIE['userid'];
		}
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

	  <script language="javascript" type="text/javascript">
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
			  header("location:bookshelf.php");
			}
		}
	 ?> 
	<!-- Code for search the book/notes end here -->
	
	

	</head>
	<body>
	<div class="mainWrap">
		
		 <!-- Header Start Here -->
	     <?php include_once('header.php');?>
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

		<div class="col-xs-12 padd0 mtop20">
			<div class="innerWrap">
				<div class="col-xs-12">
					   <!-- Code start for get the category name -->
					   <?php
						  include "cs/config.php";
						  if(isset($_GET['Sid']) && count($_GET) > 0 ) 
						  {
							 $Sid=$_GET['Sid'];
							 $querycat = "SELECT * FROM category_master where category_id='".$Sid."'";
							 $querycatds = mysqli_query($db,$querycat);
							 if(mysqli_num_rows($querycatds)>0)
							 {
							 while($rowcat= mysqli_fetch_array($querycatds))
							 {
								 $catname = $rowcat['category_name'];
								echo "<div class='pull-left'><a style='font-weight:700;' href='bookshelf.php' target='_self'>$catname</a></div>";
							  }
							 }
						  }
					   ?>
					  <!-- Code end for get the category name -->
					  <ul class="list-inline bCoverUL xs_widBCoverUL">
						 <!-- Code start for search the books/notes -->
						<?php
						 if(isset($_GET['Cid']) && count($_GET) > 0 ) 
						  {
							$Cid=$_GET['Cid'];
							if($Cid=='All')
							{
							  $Cid="";
							}
						  }
						  $catid="";

						 include "cs/config.php";
						 $runbook = $db->query("call sp_get_bookstore_user('".$Cid."','".$catid."','','".$UID."','','ALLGETBOOKNOTESUSER')");
						 $db->close();
					 
						 $i=1;
						 if(mysqli_num_rows($runbook)>0)
					     {
						 while($rowbook= mysqli_fetch_array($runbook))
						 {
							$bookid = $rowbook['id'];
							$booktitle = $rowbook['title'];
							$booktitleurl = keyword($rowbook['title']);
							$bookauthor = $rowbook['author'];
							$price = $rowbook['price'];
							if($price=="" || $price=="0" || $price=="(NULL)" || $price=="NULL")
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
							
							   include "cs/config.php";
							   $dscountpages = mysqli_query($db,"call sp_get_common_data('','','".$bookid."','','','','','A','','','','','','','','','','COUNT_NO_OF_PAGES')") or die('Query Not execute'.mysqli_error($db));
							   $db->close();
							   if(mysqli_num_rows($dscountpages)>0)
							   {
								$rowdup = mysqli_fetch_array($dscountpages);
								$pages = $rowdup['totalpages'];
								mysqli_free_result($dscountpages);
							   }
							   else
							   {
								 $pages = $rowbook['pages'];
							   }
							   
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
							echo "<li>
							<div class='bcvrLink'>
									<div class='posRel'>
										<a href='reader.php?id=$bookid' target='_blank'><img src='$thumbimgpath' alt='Book Cover' class='img-responsive' style='height:190px;' /></a>
										<span class='qView transEase' data-toggle='modal' data-target='#bsModal$i'>Quick View</span>
									</div>
										<div class='modal fade' id='bsModal$i' role='dialog'>
											<div class='modal-dialog modalWidth'>
											<!-- Modal content-->
											<div class='modal-content'>
												<div class='modal-header modHead1'>
												<button type='button' class='close' data-dismiss='modal'>&times;</button>
												<h4 class='modal-title'>ECONOMICS</h4>
												</div>
												<div class='modal-body modBody1'>
													<div class='modBody2'>
														<div class='bodyside1'>
															<img src='$largeimgpath' alt='Book Cover' class='img-responsive' />
														</div>
														<div class='bodyside2'>
															<div class='aboutBook hidden-xs'>$longtitle</div>
															<p>Type: $booktypeval</p>
															<p>Author(s): $bookauthor</p>
															<p>Publisher: $publisher</p>
															<p>Edition: $edition</p>
															<p>Pages: $pages</p>
															<p>Price: $price</p>
															<p style='display:none;'>Print ISBN: $printisbn</p>
															<p style='display:none;'>eText ISBN: $etextisbn</p>
														</div>
														<div class='aboutBook2 visible-xs'>$longtitle</div>
													</div>
												</div>
											</div>
											</div>
										</div>
									<div class='coverFooter'>
										<div class='bookTitle1 dot1'><a href='reader.php?id=$bookid' target='_blank'>$booktitle</a></div>
										<div class='bookAuthor1'>by $bookauthor</div>
										<div style='display:none;' class='bookPrice1'>Price: $price</div>
									</div>
							</div>
						</li>";
						$i=$i+1;
						}
						$runbook->close();
					    }
						else
						{
						     echo "<li style='width:100%;text-align:center;color: #EE8834;'><a href='bookshelf.html' title='Bookstore' alt='Bookstore'>Go to Bookstore</a></li>";
						}
					   ?>
						<!-- Code end for search the books/notes -->
						</ul>
					</div>
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
		<script>
			$(function() {
				$('.dot1').dotdotdot();
			});
		</script>
	</body>
</html>
<?php ob_end_flush(); ?>