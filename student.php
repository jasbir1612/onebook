<!DOCTYPE html>
<?php ob_start(); ?>
<?php require_once "cs/config.php"; ?>
<html lang="en">
	<head>
		<title>1Book</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="<?php echo $SiteURL;?>img/fevicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	    <link rel="stylesheet" href="css/login_register.css">
		<link rel="stylesheet" href="css/student.css">
		<link rel="stylesheet" href="css/common.css">
	</head>
	<body class="modal-open">

			   <!-- Header Start Here -->
		       <?php include_once('header.php');?>
		       <!-- Header End Here -->
				
					
					<div class="col-xs-12 text-center educatorCont">
					<div class="eduInner">
						<p class="fontSize22 fWeight700">Student</p>
						<p class="mbottom3 clrLBlack">Now get high quality eBooks and eNotes directly from Educators</p>
						<p class="mbottom3 clrLBlack">Access Notes and Books on the go.</p>
						<div class="eduDivider1"></div>
						
						
						<div class="media mediaWid">
							<a href="#panel_1" class="smoothScroll">
								<div class="media-left">
									<img src="img/student/update_content.png" alt="Customized Content Delivery" class="media-object" />
								</div>
								<div class="media-body">
									<h4 class="media-heading mbottom10">Continuously Updated Content</h4>
									<p class="margin0">Get updated content from your educator</p>
								</div>
							</a>
						</div>
						<div class="media mediaWid">
							<a href="#panel_2" class="smoothScroll">
								<div class="media-left">
									<img src="img/student/compilation_notes.png" alt="3 Simple Steps" class="media-object" />
								</div>
								<div class="media-body">
									<h4 class="media-heading mbottom10">Compilation of Notes</h4>
									<p class="margin0">All your notes compiled at one place</p>
								</div>
							</a>
						</div>
						<div class="media mediaWid">
							<a href="#panel_3" class="smoothScroll">
								<div class="media-left">
									<img src="img/student/authentic_content.png" alt="Auto Compilation" class="media-object" />
								</div>
								<div class="media-body">
									<h4 class="media-heading mbottom10">Authentic Content</h4>
									<p class="margin0">Get authentic content directly from your educator</p>
								</div>
							</a>
						</div>
						
						
						<div class="media mediaWid">
							<a href="#panel_4" class="smoothScroll">
								<div class="media-left">
									<img src="img/student/reader.png" alt="Interactive Reader" class="media-object" />
								</div>
								<div class="media-body">
									<h4 class="media-heading mbottom10">Easy and Intuitive Reader</h4>
									<p class="margin0">Simply Brilliant way to Study</p>
								</div>
							</a>
						</div>
						<div class="media mediaWid">
							<a href="#panel_5" class="smoothScroll">
								<div class="media-left">
									<img src="img/student/convenient.png" alt="Save Time" class="media-object" />
								</div>
								<div class="media-body">
									<h4 class="media-heading mbottom10">Convenient</h4>
									<p class="margin0">Save on time and costs.</p>
								</div>
							</a>
						</div>
						<!-- <div class="media mediaWid">
							<div class="media-left">
								<img src="img/student/secure.png" alt="Secure" class="media-object" />
							</div>
							<div class="media-body">
								<h4 class="media-heading mbottom10">Secure</h4>
								<p class="margin0">Secure Content Delivery</p>
							</div>
						</div> -->
						
					</div>
				</div>
				
				<div class="col-xs-12 eduCCD" id="panel_1">
					<p class="fontSize22 text-center fWeight700">Continuously Updated Content</p>
					<p class="mbottom3 clrLBlack text-center">Get updated content from your educator</p>
					
					<div class="media eduCCDMedia">
						<div class="media-left eduACleft visible-xs">
							<img src="img/student/continuously-updated-content.jpg" alt="Auto Compilation" class="media-object" />
						</div>
						<div class="media-body mediaBodyLft">
							<!-- <h4 class="media-heading mbottom20">Provide customized access to the batches you teach.</h4> -->
							<p class="eduCCDTxt">Educators on <span class="clrOrange">1Book</span> give you relevant content for your next big examination. You can depend on us to give you content that is up to date and accounted for all changes.</p>
							<a href="#" class="btn btn-default eduCCDBtn1" data-toggle="modal" data-target="#registerModal">Get Started</a>
						</div>
						<div class="media-right eduACRight2 hidden-xs">
							<img src="img/student/continuously-updated-content.jpg" alt="Customized Content Delivery" class="media-object" />
						</div>
					</div>
				</div>
				
				<div class="col-xs-12 eduCCD eduSSBG" id="panel_2">
					<p class="fontSize22 text-center fWeight700">Compilation of Notes</p>
					<p class="mbottom3 clrLBlack text-center">All Your Notes Compiled at one Place</p>
					
					<div class="media eduCCDMedia">
						<div class="media-left">
							<img src="img/student/compilation-of-notes.jpg" alt="Customized Content Delivery" class="media-object" />
						</div>
						<div class="media-body">
							<p class="eduCCDTxt"><span class="clrOrange">1Book</span> compiles your notes with each class taught by your educator. <br>Missed a class? Don't worry!<br> We have you covered. 1Book will compile your notes into one file giving you all the convenience.</p>
							<a href="#" class="btn btn-default eduCCDBtn1" data-toggle="modal" data-target="#registerModal">Get Started</a>
						</div>
					</div>
				</div>
				
				<div class="col-xs-12 eduCCD" id="panel_3">
					<p class="fontSize22 text-center fWeight700">Authentic Content</p>
					<p class="mbottom3 clrLBlack text-center">Get authentic content directly from your educator</p>
					
					<div class="media eduCCDMedia">
						<div class="media-left eduACleft visible-xs">
							<img src="img/student/authentic-content.jpg" alt="Auto Compilation" class="media-object" />
						</div>
						<div class="media-body mediaBodyLft">
							<!-- <h4 class="media-heading mbottom20">Provide customized access to the batches you teach.</h4> -->
							<p class="eduCCDTxt">The <span class="clrOrange">1Book</span> Portal links you directly with the educator, thus giving you access to content that is authentic and recommended by the educator.</p>
							<a href="#" class="btn btn-default eduCCDBtn1" data-toggle="modal" data-target="#registerModal">Get Started</a>
						</div>
						<div class="media-right eduACRight2 hidden-xs">
							<img src="img/student/authentic-content.jpg" alt="Customized Content Delivery" class="media-object" />
						</div>
					</div>
				</div>
				
				<div class="col-xs-12 eduIR" id="panel_4">
					<p class="fontSize22 text-center fWeight700 padd015">Easy and Intuitive Reader</p>
					<p class="mbottom3 clrLBlack text-center padd015">Simply Brilliant way to Study</p>
					
					<div class="eduCCDMedia3">
						<!-- <div class="media-left eduACleft"> -->
							<div class="mediaObj3">
								<img src="img/educator/interactive_reader.jpg" alt="Interactive Reader" class="" />
							</div>
						<!-- </div> -->
						
						<div class="eduACBody">
							<p class="eduCCDTxt">An experience that will make you forget hard copies. With features like comments, highlighting, insert text and strikethrough the <span class="clrOrange">1Book</span> platform gives you the perfect learning experience.</p>
							<ul class="eduACico">
								<li><img src="img/readerIcons/highlighter_pen.png" alt="Highlighter Pen" /> Highlight</li>
								<!--<li><img src="img/readerIcons/print.png" alt="Print Icon" /> Print active page</li>-->
								<li><img src="img/readerIcons/comment_mid.png" alt="Comment Icon" /> Comment</li>
								<li><img src="img/readerIcons/note.png" alt="Stylus Icon" /> Use stylus</li>
							</ul>
						</div>
					</div>
				</div>
				
				<div class="col-xs-12 eduCCD" id="panel_5">
					<p class="fontSize22 text-center fWeight700">Convenient</p>
					<p class="mbottom3 clrLBlack text-center">Save on time and costs.</p>
					
					<div class="media eduCCDMedia">
						<div class="media-left eduACleft visible-xs">
							<img src="img/student/convenient.jpg" alt="Auto Compilation" class="media-object" />
						</div>
						<div class="media-body mediaBodyLft">
							<!-- <h4 class="media-heading mbottom20">Provide customized access to the batches you teach.</h4> -->
							<p class="eduCCDTxt">Get content on the go on your mobile device. Save time and chuck the hard copy. No more low quality photocopies. Feel the power that color adds to learning.</p>
							<a href="#" class="btn btn-default eduCCDBtn1" data-toggle="modal" data-target="#registerModal">Get Started</a>
						</div>
						<div class="media-right eduACRight2 hidden-xs">
							<img src="img/student/convenient.jpg" alt="Customized Content Delivery" class="media-object" />
						</div>
					</div>
				</div>
				
				
	    <!-- Footer Start Here -->
	   <?php include_once('footer.php');?>
	   <!-- Footer End Here -->
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
            function filterPath(string) {
                return string
                    .replace(/^\//, '')
                    .replace(/(index|default).[a-zA-Z]{3,4}$/, '')
                    .replace(/\/$/, '');
            }
            $('.smoothScroll').each(function() {
                if (filterPath(location.pathname) == filterPath(this.pathname) &&
                    location.hostname == this.hostname &&
                    this.hash.replace(/#/, '')) {
                    var $targetId = $(this.hash),
                        $targetAnchor = $('[id=' + this.hash.slice(1) + ']');
                    var $target = $targetId.length ? $targetId : $targetAnchor.length ? $targetAnchor : false;
                    if ($target) {
                        var targetOffset = $target.offset().top - $('nav').height() - 10;
                        $(this).click(function() {
                            $('html, body').animate({
                                scrollTop: targetOffset
                            }, 400);
                            return false;
                        });
                    }
                }
            });
        });
		</script>
	</body>
</html>
<?php ob_end_flush(); ?>