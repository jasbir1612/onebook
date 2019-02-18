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
		<link rel="stylesheet" href="css/educator.css">
		<link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" href="css/responsive.css">
		 <!-- Code Start for Get the User Information -->
		 <?php
			if(isset($_POST['submit']))
			{
				include ("cs/config.php");
				$uname = $_POST['name'];
				$uemail = $_POST['emailid'];
				$uphone = $_POST['phone'];
				$ucompany = $_POST['company'];
				$umessage = $_POST['message'];
				require 'PHPMailer/PHPMailerAutoload.php';
				$mail = new PHPMailer;
				$mail->isSMTP();                                   // Set mailer to use SMTP
				$mail->Host = 'localhost';                    // Specify main and backup SMTP servers
				$mail->SMTPAuth = false;   
				$mail->SMTPSecure = false;
				$mail->Port = 25;    
				$mail->CharSet="UTF-8";
				
				$mail->setFrom($SMTPServerFromEmailID, '1Book');
				$mail->addReplyTo($uemail);
				$mail->addAddress($SMTPServerFromEmailID, '1Book');   
				$mail->AddEmbeddedImage('img/1book_logo.png','1book_logo');
				//$mail->addCC('deepaknirwal11@gmail.com');
				//$mail->addBCC('deepaknirwal11@gmail.com');
				
				$mail->isHTML(true);  // Set email format to HTML

				$bodyContent .= '<p><b>Name: </b>'.$uname.'</p>';
				$bodyContent .= '<p><b>Email Address: </b>'.$uemail.'</p>';
				$bodyContent .= '<p><b>Phone No: </b>'.$uphone.'</p>';
				$bodyContent .= '<p><b>Company: </b>'.$ucompany.'</p>';
				$bodyContent .= '<p><b>Message: </b>'.$umessage.'</p>';
				$bodyContent .= '<p>Sincerely</p>
				<p><span style="color:#EF7F1B">1Book</span> Team</p>
				<img src="cid:1book_logo" alt="1Book">';
				
				$mail->Subject = '1Book - Schedule';
				$mail->Body = $bodyContent;
				if(!$mail->send()) 
				{
					 // echo "<script>
							// document.getElementById('formsubmit').innerHTML = '<p>Mail delivery failed.</p>';
						// </script>";
				} 
				else 
				{
				   //$submitResult='Your contact request has been submitted successfully.';
				}
			}
         ?>
		 <!-- Code End for Get the User Information -->
		 
		 
	</head>
	<body class="modal-open">

		  <!-- Header Start Here -->
	   <?php include_once('header.php');?>
	   <!-- Header End Here -->
				
					<!-- Tootip Form -->
				<div id="popover-content" class="hide">
					<form action="<?php $_PHP_SELF ?>" method="post" id="frmeducator" name="frmeducator">
						<div class="form-group">
							<label for="name">NAME<sup style="color: #e00000; font-size: 16px; top: -1px;">*</sup></label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required />
						</div>
						<div class="form-group">
							<label for="email">EMAIL<sup style="color: #e00000; font-size: 16px; top: -1px;">*</sup></label>
							<input type="email" class="form-control" id="emailid" name="emailid" placeholder="Enter your email address" required/>
						</div>
						<div class="form-group">
							<label for="phone">PHONE<sup style="color: #e00000; font-size: 16px; top: -1px;">*</sup></label>
							<input type="text" class="form-control" id="phone" name="phone" pattern="[7-9]{1}[0-9]{9}" placeholder="Enter your phone number" required/>
						</div>
						<div class="form-group">
							<label for="company">COMPANY</label>
							<input type="text" class="form-control" id="company" name="company" placeholder="Enter your company name" />
						</div>
						<div class="form-group">
							<label for="interested">INTERESTED IN</label>
							<select class="form-control" id="interested" name="interested" style="color: #8a8a8a;">
							  <option value="">Please Choose</option>
							  <option value="1">Provide access of content to students</option>
							  <option value="2">List content on bookstore</option>
							  <option value="3">Know more about the portal</option>
							</select>
						</div>
						<div class="form-group">
							<label for="message">MESSAGE</label>
							<textarea class="form-control" rows="3" id="message" name="message" style="max-width: 100%;"></textarea>
						</div>
						<div class="form-group">
							<label><sup style="color: #e00000; font-size: 16px; top: -1px;">*</sup> Indicates a required field.</label>
						</div>
						<div class="form-group groupTG">
						<div class="groupTGL"><button type="submit" name="submit" value="Submit" class="btn btn-default">Submit</button></div>
						<div class="groupTGR"><label>We'll Contact you</label></div>
						</div>
					</form>
				</div>
				<!-- Tootip Form -->
				
				<div class="col-xs-12 text-center educatorCont">
					<div class="eduInner">
						<p class="fontSize22 fWeight700">Educator</p>
						<p class="mbottom3 clrLBlack">Widen your reach and Improve on the value you provide to students.</p>
						<p class="margin0 clrLBlack">Provide eBooks and eNotes through the <span class="clrOrange">1Book</span> Platform.</p>
						<div class="eduDivider1"></div>
						
						
						<div class="media mediaWid">
							<a href="#panel_1" class="smoothScroll">
								<div class="media-left">
									<img src="img/educator/customized_content_delivery.png" alt="Customized Content Delivery" class="media-object" />
								</div>
								<div class="media-body">
									<h4 class="media-heading mbottom10">Customized Content Delivery</h4>
									<p class="margin0">Make Groups and Provide Customized Access</p>
								</div>
							</a>
						</div>
						<div class="media mediaWid">
							<a href="#panel_2" class="smoothScroll">
								<div class="media-left">
									<img src="img/educator/simple_steps.png" alt="3 Simple Steps" class="media-object" />
								</div>
								<div class="media-body">
									<h4 class="media-heading mbottom10">3 Simple Steps</h4>
									<p class="margin0">That's all it takes to reach your students</p>
								</div>
							</a>
						</div>
						<div class="media mediaWid">
							<a href="#panel_3" class="smoothScroll">
								<div class="media-left">
									<img src="img/educator/auto_compilation.png" alt="Auto Compilation" class="media-object" />
								</div>
								<div class="media-body">
									<h4 class="media-heading mbottom10">Auto Compilation</h4>
									<p class="margin0">Students get your content compiled together</p>
								</div>
							</a>
						</div>
						
						
						<div class="media mediaWid">
							<a href="#panel_4" class="smoothScroll">
								<div class="media-left">
									<img src="img/educator/interactive_reader.png" alt="Interactive Reader" class="media-object" />
								</div>
								<div class="media-body">
									<h4 class="media-heading mbottom10">Interactive Reader</h4>
									<p class="margin0">Simple, Intuitive and Easy on the Eye</p>
								</div>
							</a>
						</div>
						<div class="media mediaWid">
							<a href="#panel_5" class="smoothScroll">
								<div class="media-left">
									<img src="img/educator/save_time.png" alt="Save Time" class="media-object" />
								</div>
								<div class="media-body">
									<h4 class="media-heading mbottom10">Save Time</h4>
									<p class="margin0">Save at least 20% of your time</p>
								</div>
							</a>
						</div>
						<div class="media mediaWid">
							<a href="#panel_6" class="smoothScroll">
								<div class="media-left">
									<img src="img/educator/secure.png" alt="Secure" class="media-object" />
								</div>
								<div class="media-body">
									<h4 class="media-heading mbottom10">Secure</h4>
									<p class="margin0">Secure Content Delivery</p>
								</div>
							</a>
						</div>
						
					</div>
				</div>
				
				<div class="col-xs-12 eduCCD" id="panel_1">
					<p class="fontSize22 text-center fWeight700">Customized Content Delivery</p>
					<p class="mbottom3 clrLBlack text-center">Make Groups and Provide Customized Access</p>
					
					<div class="media eduCCDMedia">
						<div class="media-left">
							<img src="img/educator/customized_content_delivery.jpg" alt="Customized Content Delivery" class="media-object" />
						</div>
						<div class="media-body">
							<!--<h4 class="media-heading mbottom20">Provide customized access to the batches you teach.</h4>-->
							<p class="eduCCDTxt1">Provide customized access to the batches you teach.</p>
							<p class="eduCCDTxt">The <span class="clrOrange">1Book</span> Dashboard allows you to create groups among your students, enabling customized content delivery on a group  by group basis.</p>
							<a href="#" class="btn btn-default eduCCDBtn" data-placement="" data-toggle="popover" data-container="body" data-html="true">Schedule a meeting</a>
						</div>
					</div>
				</div>
				
				<div class="col-xs-12 eduCCD eduSSBG" id="panel_2">
					<p class="fontSize22 text-center fWeight700">3 Simple Steps</p>
					<p class="mbottom3 clrLBlack text-center">Provide eBooks and eNotes to students in 3 simple steps</p>
					
					<div class="eduCCDMedia2">
						
							<div class="col-xs-4 text-center eud1xsWid100">
								<img src="img/educator/upload_content.png" alt="Upload Content" />
								<p class="fWeight700">Upload Content</p>
								<p class="xs1eduFSize13">Simply fill the basic details and upload the eBook/eNote</p>
							</div>
							<div class="col-xs-4 text-center eud1xsWid100">
								<img src="img/educator/manage_groups.png" alt="Manage Groups" />
								<p class="fWeight700">Manage Groups</p>
								<p class="xs1eduFSize13">Create a Group and add student's basic details</p>
							</div>
							<div class="col-xs-4 text-center eud1xsWid100">
								<img src="img/educator/provide_access.png" alt="Provide Access" />
								<p class="fWeight700">Provide Access</p>
								<p class="xs1eduFSize13">Provide the access of eBook/eNote to the group</p>
							</div>
						
					</div>
				</div>
				
				<div class="col-xs-12 eduCCD" id="panel_3">
					<p class="fontSize22 text-center fWeight700">Auto Compilation</p>
					<p class="mbottom3 clrLBlack text-center">Students get your content compiled together</p>
					
					<div class="media eduCCDMedia">
						
						<div class="media-left eduACleft visible-xs">
							<img src="img/educator/auto_compilation.jpg" alt="Auto Compilation" class="media-object" />
						</div>
						
						<div class="media-body eduACBody">
							<p>Give your students the ease of getting the notes you provide at one place.</p>
							<p class="eduCCDTxt"><span class="clrOrange">1Book</span> compiles your notes at one place into a single file providing ease of access to students.</p>
							<!-- <a href="#" class="btn btn-default eduCCDBtn">Schedule a meeting</a> -->
							<a href="#" class="btn btn-default eduCCDBtn" data-placement="" data-toggle="popover" data-container="body" data-html="true">Schedule a meeting</a>
						</div>
						<div class="media-right eduACRight hidden-xs">
							<img src="img/educator/auto_compilation.jpg" alt="Auto Compilation" class="media-object" />
						</div>
					</div>
				</div>
				
				<div class="col-xs-12 eduIR" id="panel_4">
					<p class="fontSize22 text-center fWeight700 padd015">Interactive reader</p>
					<p class="mbottom3 clrLBlack text-center padd015">Simple, Intuitive and Easy on the Eye</p>
					
					<div class="eduCCDMedia3">
						<!-- <div class="media-left eduACleft"> -->
							<div class="mediaObj3">
								<img src="img/educator/interactive_reader.jpg" alt="Interactive Reader" class="" />
							</div>
						<!-- </div> -->
						
						<div class="eduACBody">
							<p>Give students comfort that matches the Hard Copy.</p>
							<p class="eduCCDTxt">With features like comments, highlighting, insert text and strike-through the <span class="clrOrange">1Book</span> platform will give your students the perfect learning experience.</p>
							<ul class="eduACico">
								<li><img src="img/readerIcons/highlighter_pen.png" alt="Highlighter Pen" /> Highlight</li>
								<!--<li><img src="img/readerIcons/print.png" alt="Print Icon" /> Print active page</li>-->
								<li><img src="img/readerIcons/comment_mid.png" alt="Comment Icon" /> Comment</li>
								<li><img src="img/readerIcons/note.png" alt="Stylus Icon" /> Use stylus</li>
							</ul>
						</div>
					</div>
				</div>
				
				<div class="col-xs-12 eduCCD eduST" id="panel_5">
					<p class="fontSize22 text-center fWeight700">Save Time</p>
					<p class="mbottom3 clrLBlack text-center">Time is priceless save it by using <span class="clrOrange">1Book</span></p>
					
					<div class="eduCCDMedia">
						
						<div class="eduSTBody">
							<p>You can save <strong>at least 20%</strong> of your time by simply delivering content on the portal.</p>
							<p class="eduCCDTxt">Spend more time teaching. Save time that you would spend dictating notes by going digital.</p>
							<a href="#" class="btn btn-default eduCCDBtn" data-placement="" data-toggle="popover" data-container="body" data-html="true">Schedule a meeting</a>
						</div>
						
					</div>
				</div>
				
				
				<div class="col-xs-12 eduCCD eduSecure" id="panel_6">
					<p class="fontSize22 text-center fWeight700">Secure</p>
					<p class="mbottom3 clrLBlack text-center">Secure Content Delivery</p>
					
					<div class="eduCCDMedia text-right">
						<div class="eduSecureBody">
							<p><span class="clrOrange">1Book</span> delivers content in a secure manner by processing your books and notes in a unique format.</p>
							<p class="eduCCDTxt">Leave the worries of content theft behind.</p>
							<a href="#" class="btn btn-default eduCCDBtn btnsam" data-placement="" data-toggle="popover" data-container="body" data-html="true">Schedule a meeting</a>
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
		
		<script>
			if ($(window).width() < 740) {
				$(".eduCCDBtn").attr("data-placement", "bottom");
				$(".btnsam").attr("data-placement", "top");
				if ($(window).width() < 400) {
					$(".btnsam").attr("data-placement", "bottom");
				}
			}else{
				$(".eduCCDBtn").attr("data-placement", "auto left");
			}
		
			$(".eduCCDBtn").popover({
				html: true, 
				content: function() {
					return $('#popover-content').html();
					}
			});
			
			$('.eduCCDBtn').click(function(e)
			{
				e.preventDefault();
			});
			


$('[data-toggle="popover"],[data-original-title]').popover();
$(document).on('click keydown', function(e) {
 $('[data-toggle="popover"],[data-original-title]').each(function() {
   if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0 || e.keyCode === 27) {
     $(this).popover('hide').data('bs.popover').inState.click = false; // fix for BS 3.3.6
   }

 });
});
		</script>
	</body>
</html>
<?php ob_end_flush(); ?>