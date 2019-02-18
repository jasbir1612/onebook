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
		<link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" href="css/bookshelf.css">
		<link rel="stylesheet" href="css/responsive.css">
	</head>
	<body>
		<div class="mainWrap">

			   <!-- Header Start Here -->
				<?php include_once('header.php');?>
				<!-- Header End Here -->

		<div class="col-xs-12 padd0 divBG1" style="display:none;">
			<div class="innerWrap padd015">
				<div class="pull-left shelfTxt">Features</div>
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
		

		<div class="col-xs-12 padd0 mtop20">
			<div class="innerWrap">

					<p><strong>For Educators</strong></p>
					<p>1Book is a marketplace for books and notes. As an educator you now have a platform to monetize the content that you make in the form of notes and books. Students get access to e-notes and e-books directly from the educator and the reduction in cost is passed onto them. The educator benefits from a wider market for their content and excellent technical assistance.</p>
					<p>What are the services 1Book provides?</p>
					<ul>
						<li>Content Delivery in E-Format: The 1Book application allows educators to upload their text content on the platform and determine the prices they want to set. Books and notes can be sold and also be monetized through a subscription mechanism.</li>
						<li>Secure Content Delivery: The 1Book platform is a highly secure platform that processes text content in a unique format and presents it on the 1Book reader.</li>
						<li>Excellent Text Reader: The 1Book reader is a state of the art reading application that has several features that give the user the comfort that is usually present in hard copy books. The reader offers features like sharing, highlighting, comments, insert text and strikethrough.</li>
						<li>Real Time Updating and Editing: 1Book offers educators the option of adding and editing content to a note or a book they have uploaded at their convenience. The addition or edit will simultaneously reflect in the users&rsquo; purchased books or notes. This is a really unique and efficient way to disseminate class notes as it allows the educator to distribute in parts.</li>
						<li>Sharing of Highlights and Comments: The 1Book application allows an educator to share the highlights and comments made inside a book with their students. This feature gives a personalized feel and enhances the delivery mechanism.</li>
					</ul>
					<p><strong>&nbsp;For Students</strong></p>
					<p>1Book is a marketplace for books and notes. Students get access to e-notes and e-books directly from the educator and the reduction in cost is passed onto them.&nbsp;</p>
					<p>What are the services 1Book provides?</p>
					<ul>
						<li>Save upto 60% on Prices: Prices on the 1Book platform are at least 60% lower than hard copy books and notes because of the savings that come through the e-content delivery.</li>
						<li>Excellent Text Reader: The 1Book reader is a state of the art reading application that has several features that give the user the comfort that is usually present in hard copy books. The reader offers features like sharing, highlighting, comments, insert text and strikethrough.</li>
						<li>Real Time Updating and Editing: Get class notes on a real time basis. All your notes collate into one as your classes progress.</li>
						<li>Sharing of Highlights and Comments by Educators: The 1Book application allows an educator to share the highlights and comments made inside a book with their students.</li>
					</ul>

					<p><strong>For Publishers</strong></p>
					<p>1Book is a marketplace for books and notes. As a Publisher you now have a platform to monetize the content that you publish. Students get access to e-books directly from the publisher and the reduction in cost is passed onto them. The publisher benefits from a wider market for their content and excellent technical assistance.</p>
					<p>What are the services 1Book provides?</p>

					<ul>
						<li>Content Delivery in E-Format: The 1Book application allows publishers to upload their text content on the platform and determine the prices they want to set. Books can be sold and also be monetized through a subscription mechanism.</li>
						<li>Secure Content Delivery: The 1Book platform is a highly secure platform that processes text content in a unique format and presents it on the 1Book reader.</li>
						<li>Excellent Text Reader: The 1Book reader is a state of the art reading application that has several features that give the user the comfort that is usually present in hard copy books. The reader offers features like sharing, highlighting, comments, insert text and strikethrough.</li>
					</ul>

			</div>
		</div>

				<!-- Footer Start Here -->
			   <?php include_once('footer.php');?>
			   <!-- Footer End Here -->
		</div>

		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="js/index.js"></script>
	</body>
</html>
<?php ob_end_flush(); ?>