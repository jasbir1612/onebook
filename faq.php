<!DOCTYPE html>
<?php ob_start(); ?>
<?php require_once "cs/config.php"; ?>
<html lang="en">
	<head>
		<title>1Book</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
		<link rel="shortcut icon" href="<?php echo $SiteURL;?>img/fevicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/login_register.css">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/faq.css">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/common.css">
	</head>
	<body>
	<div class="mainWrap">
		
	   <!-- Header Start Here -->
	   <?php include_once('header.php');?>
	   <!-- Header End Here -->
	   
	   
	   <!-- Tootip Form -->
				<div id="popover-content" class="hide">
					<form>
						<div class="form-group">
							<label for="name">NAME<sup style="color: #e00000; font-size: 16px; top: -1px;">*</sup></label>
							<input type="text" class="form-control" id="name" placeholder="Enter your full name" />
						</div>
						<div class="form-group">
							<label for="email">EMAIL<sup style="color: #e00000; font-size: 16px; top: -1px;">*</sup></label>
							<input type="email" class="form-control" id="email" placeholder="Enter your email address" />
						</div>
						<div class="form-group">
							<label for="phone">PHONE<sup style="color: #e00000; font-size: 16px; top: -1px;">*</sup></label>
							<input type="text" class="form-control" id="phone" placeholder="Enter your phone number" />
						</div>
						<div class="form-group">
							<label for="company">COMPANY</label>
							<input type="text" class="form-control" id="company" placeholder="Enter your company name" />
						</div>
						<div class="form-group">
							<label for="interested">INTERESTED IN</label>
							<select class="form-control" id="interested" style="color: #8a8a8a;">
							  <option>Please Choose</option>
							  <option>Provide access of content to students</option>
							  <option>List content on bookstore</option>
							  <option>Know more about the portal</option>
							</select>
						</div>
						<div class="form-group">
							<label for="message">MESSAGE</label>
							<textarea class="form-control" rows="3" id="message" style="max-width: 100%;"></textarea>
						</div>
						<div class="form-group">
							<label><sup style="color: #e00000; font-size: 16px; top: -1px;">*</sup> indicates a required field.</label>
						</div>
						<div class="form-group groupTG">
						<div class="groupTGL"><button type="submit" class="btn btn-default">Submit</button></div>
						<div class="groupTGR"><label>We'll Contact you</label></div>
						</div>
					</form>
				</div>
				<!-- Tootip Form -->
				

		<div class="col-xs-12 padd0 divBG1" style="display:none;">
			<div class="innerWrap padd015">
				<div class="pull-left shelfTxt">FAQ</div>
				<div class="pull-right" style="display:none;">
					<form class="navbar-form searchBox1" role="search">
						<div class="input-group">
							<input type="text" class="form-control searchBoxInput" placeholder="Find eBook, eNotes, etc" name="q">
							<div class="input-group-btn">
								<button class="btn btn-default searchBoxBtn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
							</div>
						</div>
					</form>
				</div>
				<div style="display: block; clear: both;"></div>
			</div>
		</div>
		
		
		<div class="col-xs-12 faqHeadSearch">
			<h3>FAQ</h3>
			<p>Now get high quality eBooks and eNotes directly from your educator through <span class="clrOrange">1Book</span>. Access Notes and Books on the go.</p>
		</div>
				<div class="col-xs-12 studyHeader">
			<div class="otBorder">
				<a data-toggle="tab" href="#team" class="otHeader active"><img src="img/student_big.png" alt="Students Logo" /> <span>Students</span></a><a data-toggle="tab" href="#partners" class="otHeader"><img src="img/educator_big.png" alt="Educators Logo" /> <span>Educators</span></a>
			</div>
			<div class="otTabContent tab-content">
				<div id="team" class="tab-pane fade in active">
					<div class="faqest">
						<h3>How is 1Book useful to me?</h3>
						<p>1Book is designed for students to connect directly with content providers. You can access content for free if your educator uses 1Book. He simply needs to add you in his group and upload the content you will be able to access that on your mobile and/or computer. You can also access eBooks and eNotes from the Bookstore.</p>
					</div>
					
					<div class="faqest">
						<h3>How can I <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#registerModal">register</a>?</h3>
						<p>You can <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#registerModal">register</a> using the '<a href="#" data-toggle="modal" data-dismiss="modal" data-target="#registerModal">Register</a>' link on the website or application after providing necessary authentication.</p>
					</div>
					
					<div class="faqest">
						<h3>What do I need to read 1Book eBooks/eNotes?</h3>
						<p>You can access our eBooks/eNotes through your mobile, tablet or PC/Laptop. The 1Book application is available on Android and will be out very soon on iOS.</p>
					</div>
					
					<div class="faqest">
						<h3>Where can I find the eBook/eNote I am looking for?</h3>
						<p>Our eBooks are conveniently catalogued on our website and our application under different sections. Just choose your section and get through to the book of your choice using our easy-to-use navigation. You can also search for an eBook by title, ISBN, publisher or author.</p>
					</div>
					
					<div class="faqest">
						<h3>How do I buy an eBook from 1Book?</h3>
						<p>Once you have found an eBook that you like, click on the "Add to Cart" button - the eBook is now added to your cart. You can either continue shopping for other items or complete the checkout process after that. If you are not logged in, the system will prompt you to sign in at this point. If you do not have a registered account, you can create one right then and proceed to payment.</p>
					</div>
					
					<div class="faqest">
						<h3>How do I pay for the eBooks/eNotes?</h3>
						<p>Payments are made through a secure electronic billing system. You can choose any of the standard online payment methods such as debit card, credit card or net banking.</p>
					</div>
					
					<div class="faqest">
						<h3>How do I read the eBooks/eNotes?</h3>
						<p>Log in to the 1Book application or website. Go to your dashboard and click on the book you want to read. The book will open up in the 1Book reader.</p>
					</div>
				</div>
				<div id="partners" class="tab-pane fade">
					<div class="faqest">
						<h3>How can I <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#registerModal">register</a> on 1Book?</h3>
						<p>Registration through the 1Book website and application is open to students only. To <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#registerModal">register</a> with us as an Educator who wants to sell eNotes and eBooks online you can <a href="contactus.html">contact us</a> by filling out this form to <a href="#" class="eduCCDBtn" data-placement="" data-toggle="popover" data-container="body" data-html="true">Schedule a meeting</a>, alternatively you can use the following the link to <a href="contactus.html">Contact Us</a>.</p>
					</div>
					<div class="faqest">
						<h3>Do I need to pay to <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#registerModal">register</a> on 1Book?</h3>
						<p>No, 1Book is a free service. Just <a href="contactus.html">Contact Us</a>/<a href="#" class="eduCCDBtn" data-placement="" data-toggle="popover" data-container="body" data-html="true">Schedule a meeting</a> and we will <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#registerModal">register</a> you after verification.</p>
					</div>
					<div class="faqest">
						<h3>How is 1Book useful to me?</h3>
						<p>1Book is designed for educators to connect directly with their students. As an educator you can <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#registerModal">register</a> with 1Book to provide your notes and books online in a digital format. 1Book provides you with top of the line security features for your content. Students can easily access your books or notes on the 1Book website or application by purchasing them for a price you set. Moreover, students who study from you in person can access the content you provide, for free on the 1Book platform. This system helps you monetize your content and it also helps you maintain a learning management system.</p>
					</div>
					<div class="faqest">
						<h3>What features does 1Book offer?</h3>
						<p>1Book offers several features to Educators. Given below is a gist of the features at offer:</p>
						<ul>
							<li class="mtop30">
								<p class="faqfw">Upload Your Book and Notes</p>
								<p>1Book's easy upload process helps you digitize your content in an efficient and secure manner. Once you upload content, 1Book's technology processes the file in a format that is secure and not downloadable from the portal. The eBook/eNote so created retains all the original formatting and presents to the users a digitized version that can only be viewed in the application after authentication.</p>
							</li>
							<li class="mtop30">
								<p class="faqfw">Make Groups and Deliver Content</p>
								<p>1Book has come up with an unique feature that helps you create groups of your students by uploading their mail ids for authentication. 1Book then processes each group you create into a separate unit so that you can deliver customized content for them. This will help you build notes for the group and keep track of each group of students.</p>
							</li>
							<li class="mtop30">
								<p class="faqfw">View Statistics</p>
								<p>1Book offers various levels of statistics ranging from the number of sales or subscriptions for your content to statistics relating to groups you create. In our effort to create a highly interactive environment we will keep giving you more relevant data so you can keep track of your profile on 1Book.</p>
								<p>Keep checking us out, with new innovative features we will be coming up with very soon.</p>
							</li>
						</ul>
					</div>
					<div class="faqest">
						<h3>What all can I upload onto the portal?</h3>
						<p>1Book is designed to help you digitize all the text content that you create. Apart from the books that you have written, 1Book also helps you build notes for students. You can easily upload day by day class notes or chapter wise notes on to the portal. You can keep adding parts to the note you have created and your students will be able to view it as a consolidated file.</p>
					</div>
					<div class="faqest">
						<h3>Will my content be secure?</h3>
						<p>Yes, we have the best in class technology to secure your content. We process and store your content in a different format which is secure and has multiple safeguards to prevent content theft.</p>
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
		$(document).ready(function() {
				$(".otHeader").click(function () {
					$(".otHeader").removeClass("active");
					$(this).addClass("active");
				});
			});
		</script>
		
		<script>
			if ($(window).width() < 740) {
				$(".eduCCDBtn").attr("data-placement", "bottom");
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