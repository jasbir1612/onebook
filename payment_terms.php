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
				<div class="pull-left shelfTxt">Our Team</div>
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
			    <h4 class="common_title">Payment Terms</h4>
				<p><ul>
						<li>Threshold</li>
						<li>Withholding</li>
						<li>Payment Update Steps</li>
						<li>Missing Payment Issues</li>
					</ul>
                </p>
				<p>We pay royalties for each marketplace approximately ten (10) days following the end of the calendar month in which your royalties meet the payment threshold.</p>
<p>Royalties accrue on your account until the total amount in each marketplace has reached the minimum threshold.</p>
<p>You'll receive royalty payments for, either via Electronic Funds Transfer (EFT), Wire Transfer (where available), or cheque.</p>
<p>Your bank may have fees associated with some payments. Please contact your bank to verify fees associated with receiving payments.</p>
<br />
<p><span style="color: rgb(255, 153, 0);"><strong>Threshold</strong></span></p>
<p>There is a minimum threshold after deducting the applicable tax withholding.</p>
<p>Minimum Threshold is <strong>INR 2,500</strong>.</p>
<p>Your royalties must meet the minimum threshold amount before you can receive a payment.</p>
<p><strong>Threshold not met in a single month.</strong></p>
<p>If your royalty earnings fall below the threshold, we will keep a running total and issue payment once the amount exceeds the minimum threshold. Your payment occurs ten (10) days after the end of the month in which your royalties meet the threshold.</p>
<br />
<p><span style="color: rgb(255, 153, 0);"><strong>Withholding</strong></span></p>
<p>The tax withholding will be applied to the gross amount of your payment before it gets processed.You will be provided the complete details for the same.</p>
<br />
<p><span style="color: rgb(255, 153, 0);"><strong>Payment Options by Location</strong></span></p>
<p>When you're setting up your account information, you shall provide your bank account details.</p>
<p>Available payment options (EFT, wire transfer, or cheque) are based on the location of your bank account.</p>
<br />
<p><span style="color: rgb(255, 153, 0);"><strong>Payment Update Steps</strong></span></p>
<p>For details on updating your payment information, see 1Book <a class="active" href="<?php echo $SiteURL;?>bank_details.html">Payment &amp; Banking.</a></p>
<p><strong>Report shows an NEFT/WIRE payment, but payment doesn't appear in bank account</strong></p>
<p>NEFT payments can take 1-5 business days to show on your bank account from the payment date. In case of Wire payments, it can take 5-10 days.</p>
<p>If in your Payments Report you see the amounts showing as &quot;Paid,&quot; but the payment still does not appear in your account, please reach out to your financial institution for verification.</p>
<p><strong>Cheque has not arrived</strong></p>
<p>Cheque delivery time frames vary depending on location. After the payment date it can take up to a month for the check to reach the address in your 1Book account. Please allow this much time before reporting your check as lost, and be sure to confirm the address on file is correct.</p>
<br />
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
		</script>
		
	</body>
</html>
<?php ob_end_flush(); ?>