<!DOCTYPE html>
<?php ob_start(); ?>
<?php require_once "cs/config.php"; ?>
<html lang="en">
	<head>
		<title>Buy or Rent eBooks/eNotes | Digital Solutions for Educators and Publishers</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="<?php echo $SiteURL;?>img/fevicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/jasny-bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/bootstrap-slider.css">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/common.css">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/reader.css">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/responsive.css">
		<?php
			require_once "cs/common.php";
		?>
		
		<?php 
		if(isset($_GET['pageno']) && count($_GET) > 0 ) 
		{
		   $PageNoVal=$_GET['pageno'];
		}
		else
		{
		  $PageNoVal="1";
		}
		
		?>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="<?php echo $SiteURL;?>js/disable_copy_paste_jquery.js"></script>
		<script type="text/javascript">
		$(document).ready(function () {
			//Disable cut copy paste
			$('body').bind('cut copy paste', function (e) {
				e.preventDefault();
			});
		   
			//Disable mouse right click
			$("body").on("contextmenu",function(e){
				return false;
			});
		});
		</script>
		
		  <script language="JavaScript">

		//////////F12 disable code////////////////////////
			document.onkeypress = function (event) {
				event = (event || window.event);
				if (event.keyCode == 123) {
				   //alert('No F-12');
					return false;
				}
			}
			document.onmousedown = function (event) {
				event = (event || window.event);
				if (event.keyCode == 123) {
					//alert('No F-keys');
					return false;
				}
			}
		document.onkeydown = function (event) {
				event = (event || window.event);
				if (event.keyCode == 123) {
					//alert('No F-keys');
					return false;
				}
			}
		/////////////////////end///////////////////////
		
		
		   $(window).on('keydown',function(event)
			{
			if(event.keyCode==123)
			{
				//alert('Entered F12');
				return false;
			}
			else if(event.ctrlKey && event.shiftKey && event.keyCode==73)
			{
				//alert('Entered ctrl+shift+i')
				return false;  //Prevent from ctrl+shift+i
			}
			else if(event.ctrlKey && event.keyCode==73)
			{
				//alert('Entered ctrl+shift+i')
				return false;  //Prevent from ctrl+shift+i
			}
		});
		$(document).on("contextmenu",function(e)
		{
		//alert('Right Click Not Allowed')
		e.preventDefault();
		});
		</script>
	</head>
	<body onload="javascript:{goToSlider(0);}">
		<div class="mainWrap">
			
            <!-- Header Start Here -->
				<?php include_once('dashboard_reader.php');?>
			<!-- Header End Here -->
               
			<div class="col-xs-12 padd0 readerJS">
				<div class="caroCont">
					<div id="pageCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">
						 <div class="carousel-inner" role="listbox">
						 
						 <!-- Code Start for get the all pages of book/notes -->
						 <?php
								if(isset($_COOKIE['useremailid']))
								{
									if(isset($_GET['id']) && count($_GET) > 0 ) 
									{
									    include "cs/config.php";
										$BNId=$_GET['id']; 
										$qryds = mysqli_query($db, "call sp_get_common_data('','','".$BNId."','','','','','A','','','','','','','','','','GET_BOOKFORREADER')");
										$db->close();
										if(mysqli_num_rows($qryds)>0)
										{
											$i=0;
											while($rowcat = mysqli_fetch_array($qryds))
											{
											    $processval = $rowcat['process'];
												$pageno = $rowcat['pageno'];
												$pagetitle = $rowcat['pagetitle'];
												$imagepath = $rowcat['imagepath'];
                            
												$img_path=$S3URL.$imagepath; 
												 
												if($i==0)
												{
												  echo "<div class='item active' data-step='0'>
												   <img src='$img_path' alt='$pagetitle' class='img-responsive'>
											       </div>";
												}
												 //elseif($i==$count-1)
												 //{
												  //echo '>>>>>>>>>>>>Last' .$i;
												//}
												else
												{
												   echo "<div class='item' data-step='0'>
													<img src='$img_path' alt='$pagetitle' class='img-responsive'>
												   </div>";
												}
												$i=$i+1;
											}
										}
										else
										{
										    if($_COOKIE['roleid']=="1")  // $_SESSION['roleid']
										    {
											  $WebSite_URL="location:".$SiteURL."mybookshelf.html";
											  header($WebSite_URL);
										    }
										    else if($_COOKIE['roleid']=="2" || $_COOKIE['roleid']=="3")
										    {
											    $currenturl = htmlspecialchars($_SERVER['HTTP_REFERER']);
											    echo ("<SCRIPT LANGUAGE='JavaScript'>
												window.alert('This Book/Note is in process.')
												window.location.href='$currenturl';
												</SCRIPT>");
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
						    <!-- Code end for get the all pages of book/notes -->
						</div>
						<a href="#" class="caroL caroLR transEase" onclick="$('#pageCarousel').carousel('prev')"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
						<a href="#" class="caroR caroLR transEase" onclick="$('#pageCarousel').carousel('next')"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
					</div>
				</div>
			
			
			<div class="col-xs-12 carofooter">
				<!--<div class="col-xs-1 padd0 text-center">
					<input type="text" class="form-control currentPage text-center" id="txtboxToFilter" value="1" />
				</div>-->
				<div class="col-xs-12 paddTB8LR0 resPadd8">
					<div class="col-xs-12 padd0 margTB3LR0">
						<div class="pull-left resLeftWidth">
							<!--<span class="mRight15 caroTitle">Post with Threaded Comments</span>-->
							<!--<span class="mRight15 caroPageCount"><input type="text" class="form-control currentPage text-center" id="txtboxToFilter" value="1" /> of <span class="totalPages">0</span></span>-->
							<span class="mRight15 caroPageCount"><input type="text" class="form-control currentPage text-center" id="txtboxToFilter" value="<?php echo $PageNoVal ?>" onkeydown="javascript:if(event.keyCode == 13){goToSlider(0);}" /> of <span class="totalPages">0</span></span>
							
							<a href="#" class="mRight10 hidden"><img src="<?php echo $SiteURL;?>img/readerIcons/bookmark.png" alt="Bookmark" class="resIcnWid hidden-xs" /></a>
							<div class="dropdown headDropDown hidden-xs" style="display: inline-block;">
								<span style="display: none;" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-caret-up bmCaretUp transform1 transEase"></span></span>
								<ul class="dropdown-menu menuUpward">
								
								 <!-- Code Start for get the path of book/notes's images -->
								<?php
									if(isset($_COOKIE['useremailid']))
									{
										if(isset($_GET['id']) && count($_GET) > 0 ) 
										{
											include "cs/config.php";
											$BNId=$_GET['id']; 
											$qryds = mysqli_query($db, "call sp_get_common_data('','','".$BNId."','','','','','A','','','','','','','','','','GET_BOOKFORREADER')");
										    $db->close();
											if(mysqli_num_rows($qryds)>0)
											{
												$i=0;
												while($rowcat = mysqli_fetch_array($qryds))
												{
													$pageno = $rowcat['pageno'];
													$pagetitle = $rowcat['pagetitle'];
													$imagepath = $rowcat['imagepath'];
													echo "<li><a href='#' onClick='javascript:goToSlide($pageno);'>$pagetitle</a></li>";
													$i=$i+1;
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
								
								 <!-- Code End for get the path of book/notes's images -->
								 
								</ul>
							</div>
						</div>
						<div class="pull-right resRightWidth">
							<div class="dropdown headDropDown visible-xs">
								<span class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-ellipsis-v resEllipsis" aria-hidden="true"></span></span>
								<ul class="dropdown-menu menuUpward resMenuUp">
									<li><a href="#"><img src="<?php echo $SiteURL;?>img/readerIcons/bookmark.png" alt="Bookmark" class="resIcnWid" /></a></li>
									<li><a href="#"><img src="<?php echo $SiteURL;?>img/readerIcons/highlighter_pen.png" alt="Highlighter" class="resIcnWid2" /></a></li>
									<li><a href="#"><img src="<?php echo $SiteURL;?>img/readerIcons/text_view.png" alt="Text View" class="resIcnWid2" /></a></li>
									<li><a href="#"><img src="<?php echo $SiteURL;?>img/readerIcons/print.png" alt="Print" class="resIcnWid2" /></a></li>
									<li><a href="#"><img src="<?php echo $SiteURL;?>img/readerIcons/coment.png" alt="Comment" class="resIcnWid2" /></a></li>
									<li><a href="#"><img src="<?php echo $SiteURL;?>img/readerIcons/note.png" alt="Note" class="resIcnWid2" /></a></li>
								</ul>
							</div>
							<span class="rightSpan hidden">
								<a href="#" class="mRight15"><img src="<?php echo $SiteURL;?>img/readerIcons/highlighter_pen.png" alt="Highlighter" class="resIcnWid2" /></a>
								<a href="#" class="mRight15"><img src="<?php echo $SiteURL;?>img/readerIcons/text_view.png" alt="Text View" class="resIcnWid2" /></a>
								<a href="#" class="mRight15"><img src="<?php echo $SiteURL;?>img/readerIcons/print.png" alt="Print" class="resIcnWid2" /></a>
								<a href="#" class="mRight15"><img src="<?php echo $SiteURL;?>img/readerIcons/coment.png" alt="Comment" class="resIcnWid2" /></a>
								<a href="#"><img src="<?php echo $SiteURL;?>img/readerIcons/note.png" alt="Note" class="resIcnWid2" /></a>
							</span>
						</div>
					</div>
					<div class="col-xs-12 padd0 progress margTB3LR0">
						<input id="ex1" data-slider-id='ex1Slider' type="text" data-slider-min="1" data-slider-max="" data-slider-step="1" data-slider-value=""/>
					</div>
				</div>
			</div>
			</div>



			<div class="col-xs-12 footer2a" style="display:none;">
				<div class="pull-left xs_100">Copyrights &#x40; 2016 1Book All Right Reserved</div>
				<div class="pull-right xs_100">Designed by <a href="http://www.4cplus.com" target="_blank">4C Plus</a></div>
			</div>
		</div>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="<?php echo $SiteURL;?>js/bootstrap.js"></script>
		
		<script src="<?php echo $SiteURL;?>js/scrolltofixed.js"></script> <!-- plugin is used to fix elements on the page (top, bottom, anywhere) -->
		<script src="<?php echo $SiteURL;?>js/jasny-bootstrap.min.js"></script> <!-- for push effect for the off canvas navmenu -->
		<script src='<?php echo $SiteURL;?>js/bootstrap-slider.js'></script> <!-- for ui scrolling slider at bottom -->
		<script src="<?php echo $SiteURL;?>js/carousel-swipe.js"></script> <!-- Carousel Slide on Touch(only for Mobile Device) -->
		<script src="<?php echo $SiteURL;?>js/jquery.panzoom.js"></script> <!-- Carousel Image Zoom In/Out -->
		<script src="<?php echo $SiteURL;?>js/index.js"></script>
		
				
		<script>
			/* Fixed footer until it reaches its original position */
			$(document).ready(function() {
				$('.carofooter').scrollToFixed( { bottom: 0, limit: $('.carofooter').offset().top } );
			});
			/* Fixed footer until it reaches its original position */
		</script>

	  <script>
	  (function() {
	  
	  var $leftNav = $('.leftNavFixed');
	  
		$('#pageCarousel .carousel-inner .active .img-responsive').panzoom({
            $zoomIn: $leftNav.find(".zoom-in"),
            $zoomOut: $leftNav.find(".zoom-out"),
            $reset: $leftNav.find(".reset"),
			panOnlyWhenZoomed: true,
			minScale: 1,
			maxScale: 2,
			increment: 0.1,
			contain: 'automatic'
        });
		
		$('#pageCarousel').bind('slid.bs.carousel', function (e) {
			$('#pageCarousel .carousel-inner [class="item"] .img-responsive').panzoom("reset");
			$('#pageCarousel .carousel-inner [class="item"] .img-responsive').panzoom("enable");
		});
		
		$('#pageCarousel').bind('slid.bs.carousel', function (e) {
			if ($(e.relatedTarget).hasClass('active')){
				$('#pageCarousel .carousel-inner [class="item active"] .img-responsive').panzoom("reset");
				$('#pageCarousel .carousel-inner [class="item active"] .img-responsive').panzoom("enable");
				$('#pageCarousel .carousel-inner [class="item active"] .img-responsive').panzoom({
					$zoomIn: $leftNav.find(".zoom-in"),
					$zoomOut: $leftNav.find(".zoom-out"),
					$reset: $leftNav.find(".reset"),
					panOnlyWhenZoomed: true,
					minScale: 1,
					maxScale: 2,
					increment: 0.1,
					contain: 'automatic'
				});
			}
		});
		  })();


		  /* Current Page Number, Total Page Number, ProgressBar */
			var totalSteps = $('#pageCarousel .item').length;	
			$('.totalPages').text(totalSteps);
			$('#ex1').attr('data-slider-max',totalSteps);
	
			$("#pageCarousel .item").each(function(i) {
				$(this).attr("data-step", ++i);
			});
			
			$(document).ready(function() {
			var $slider = $('#ex1');
			$('#pageCarousel').on('slide.bs.carousel', function (e) {
				var step = $(e.relatedTarget).data('step');
				$('#txtboxToFilter').val(step);
				$slider.slider('setValue', step);
			});
			
			$slider.slider().on('change', function() {
				$('#pageCarousel').carousel($slider.data('slider').getValue() - 1);
			});
			});
		/* Current Page Number, Total Page Number, ProgressBar */

		/* Start Reader Slider */
		$('#ex1').slider({
			formatter: function(value) {
				return 'Page: ' + value;
			}
		});
		/* End Reader Slider */
	  </script>
	  
	</body>
</html>
<?php ob_end_flush(); ?>