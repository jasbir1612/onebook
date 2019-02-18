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

		<div class="col-xs-12 padd0 divBG1">
			<div class="innerWrap padd015">
				<div class="pull-left shelfTxt">Contact Request Submitted</div>
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
		
		
		<div align="center">
			<img src="<?php echo $SiteURL;?>img/tick.png"/>
			<h2>Thank you for contacting us.</h2>
			<p class="h4">You are very important to us, all information received will always remain confidential. We will contact you as soon as we review your message.</p>
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