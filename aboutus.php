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

		<div class="col-xs-12 padd0 divBG1">
			<div class="innerWrap padd015">
				<div class="pull-left shelfTxt">About Us</div>
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
<p>1Book is a platform for students to access content of educators and publishers. 1Book is started with a vision to be a one stop solution for a student’s text book needs.</p> <p>We partner with educators to enhance their delivery mechanism and help students to shift to digital learning with user friendly reading experience and customized content delivery.</p>
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