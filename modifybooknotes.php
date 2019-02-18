<!DOCTYPE html>
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
		<link rel="stylesheet" href="css/notesPage.css">
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
						    <?php 
								if($_SESSION['userid']!="")
								{
									if($_SESSION['roleid']=="3")
									{
										?>		
										<div class="mBooksTxt">Manage Books/Notes</div>
										<ul class="list-inline">
											<li><a href="#">Books</a></li>
											<li><a href="#">Notes</a></li>
											<li><a href="manageBooks.php">Upload Content</a></li>
										</ul>
										<?php 
									}
									else if($_SESSION['roleid']=="2")
									{
										?>		
										<div class="mBooksTxt">Manage Books/Notes</div>
										<ul class="list-inline">
											<li><a href="#">Books</a></li>
											<li><a href="#">Notes</a></li>
											<li><a href="manageBooks.php">Upload Content</a></li>
										</ul>
										<?php 
									}
								}
								?>
							
						</div>
					</div>
				</div>
				<div class="col-xs-12 padd0 ndEco">
					<div class="ndLeftPart">
						<div class="input-group stylish-input-group">
							<input type="text" class="form-control"  placeholder="Search by name" >
							<span class="input-group-addon">
							<button type="submit">
							<span class="glyphicon glyphicon-search"></span>
							</button>
							</span>
						</div>
						<div id="datetimepicker1" class="input-append date npDivWidth1">
							<input data-format="dd/MM/yyyy" type="text" class="form-control user_drop_dwn border_radius4" placeholder="From Date">
							<span class="add-on input-group-addon no_css">
							<i class="fa fa-calendar clrOrange"></i>
							</span>
						</div>
						<div id="datetimepicker2" class="input-append date npDivWidth1">
							<input data-format="dd/MM/yyyy" type="text" class="form-control user_drop_dwn border_radius4" placeholder="To Date">
							<span class="add-on input-group-addon no_css">
							<i class="fa fa-calendar clrOrange"></i>
							</span>
						</div>
						<form class="goBtnForm1">
							<button type="button" class="btn npBtn1 btn-default">Go</button>
						</form>
					</div>
					<div class="ndRightPart">
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
					  <?php				
				           include "cs/config.php";
						   session_start();
						  if($_SESSION['userid']!="")
						  {
							$UserId=$_SESSION['userid'];
						    $query = "select * from edition where crtd_by='".$UserId."' and pid=0 and status='A' order by id asc limit 20";
							$queryds = mysqli_query($db,$query);
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

									$thumbimgpath=returnthbimage($thumbimg);
									$largeimgpath=returnthbimage($largeimg);

									echo "<div class='col-xs-12 col-sm-6 col-md-4 padd03 mtop5'>";
											echo "  <div class='col-xs-12 padd5 npOuterBox'>";
											echo "<div class='col-xs-4 padd0'>";
												echo "<a href='booksnotesdetails.php?bookid=$bookid' target='_blank'><img src='$thumbimgpath' alt='Book Cover' class='img-responsive'></a>";
											echo "</div>";
											echo "<div class='col-xs-8 paddL10R0 npTitleDiv1'>
												<div class='npBooktitle1'><a href='booksnotesdetails.php?bookid=$bookid' target='_blank'>$booktitle</a></div>";
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
													<a href='ManageEditBooks.php?bookid=$bookid' target='_blank'><i class='fa fa-pencil' aria-hidden='true' style='display:none;'></i></a>
													<i class='fa fa-comment' aria-hidden='true' style='display:none;'></i>
													<sup style='display:none;'>5</sup>";
													  if($availabilityval=='MEMBER' || $availabilityval=='BOTH')
													  {
														echo "<a href='subscriber_book_to_group.php?bookid=$bookid' target='_blank'><img src='img/readerIcons/subscribers_mid.png'  alt='Subsciber Icon' class='img-responsive'/></a>";
													  }
													echo "<a href='deletebooknotes.php?booknotesid=$bookid' target='_self' class='npIconA'>
														<i class='fa fa-trash-o' aria-hidden='true'></i></a>
												</div>
											</div>
										</div>
										<div class='col-xs-12 padd5 text-center npBtmdiv'>
											Last Update:  $moddate
										</div>
									</div>";
							    }
							}
						 }
						 ?>
					</div>
				</div>
				<div class="col-xs-12 padd0">
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