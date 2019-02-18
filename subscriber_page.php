<!DOCTYPE html>
<?php ob_start(); ?>
<!-- Code start for get the title,meta keywords and meta description -->
<?php include "cs/config.php"; ?>
<?php require_once "cs/common.php"; ?>
<?php
if(isset($_GET['id']) && count($_GET) > 0 ) 
{	
	$BNId = mysqli_real_escape_string($db,$_GET['id']); 
	$qrymetads = mysqli_query($db, "call sp_get_common_data('','',$BNId,'','','','','A','','','','','','','','','','GET_BOOKNOTES_METAKEYWORDS')");
	$db->close();
	if (mysqli_num_rows($qrymetads) > 0) {
	while($row = mysqli_fetch_array($qrymetads)) 
	{
	 $title= $row['title'];
	 $meta_keywords= $row['meta_keywords'];
	 $meta_description= $row['meta_description'];
	 $bookdescription= $row['description'];
	 $largeimgval = $row['large_img'];
	 if($largeimgval!="")
	 {
	   $largeimgpath=returnthbimage($largeimgval);
	   $largeimgpath=$S3URL.$largeimgpath;
	 }
	 else
	 {
	   $largeimgpath=$SiteURL.$DefaultLargePath;
	 }
	  $GetSiteUrl=$_SERVER['HTTP_HOST'];
	  $CurrentPageURL='http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	}
      mysqli_free_result($qrymetads);
   }
}
?>
<!-- Code end for get the title,meta keywords and meta description -->

<html lang="en">
	<head>
		<title><?php echo $title; ?> | 1Book</title>
		<meta charset="utf-8">
		<meta name="keywords" content='<?php echo $meta_keywords; ?>'>
	    <meta name="description" content='<?php echo $meta_description; ?>'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="<?php echo $SiteURL;?>img/fevicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/common.css">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/subscriber_page.css">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/responsive.css">
		
		<meta property="og:title" content="<?php echo $title; ?>" />
		<meta property="og:description" content="<?php echo $bookdescription; ?>" />
		<meta property="og:image" content="<?php echo $largeimgpath; ?>" />
		<meta property="og:url" content="<?php echo $CurrentPageURL; ?>" />
		<meta property="og:site_name" content="<?php echo $GetSiteUrl; ?>" />
	    <meta name="twitter:card" content="summary" />
		<meta name="twitter:site" content="@1Book" />
		<meta name="twitter:domain" content="<?php echo $GetSiteUrl; ?>" />
		<meta name="twitter:title" content="<?php echo $title; ?>" />
		<meta name="twitter:decription" content="<?php echo $bookdescription; ?>" />
		<meta name="twitter:image" content="<?php echo $largeimgpath; ?>" />
		
		
		 <!-- Code start for add the book/notes in dashboard -->
		<?php
		    require 'PHPMailer/mail_common.php';
			if (isset($_POST['paynow']))
			{
			    //session_start();
				if(isset($_COOKIE['useremailid']))
				{
				if(isset($_GET['id']) && count($_GET) > 0 ) 
				{
					include "cs/config.php";
					$BNId = mysqli_real_escape_string($db,$_GET['id']); 
					$qryds = mysqli_query($db, "call sp_get_common_data('','',$BNId,'','','','','A','','','','','','','','','','GET_SUBSCRIBEBOOK')");
					$db->close();
					if(mysqli_num_rows($qryds)>0)
					{
					  $row = mysqli_fetch_array($qryds);
					  $category_nameval = $row['category_name'];
					  $titleval = $row['title'];
					  $authorval = $row['author'];
					  $publicationval = $row['publication'];
					  $editionval = $row['edition'];
					  $pagesval = $row['pages'];
					  $print_isbnval = $row['print_isbn'];
					  $etext_isbn = $row['etext_isbn'];
					  $descriptionval = $row['description'];
					  $category_idval = $row['category_id'];
					  $course_idval = $row['course_id'];
					  $bookidval = $row['id'];
					  $booktypeval = $row['book_type'];
					  $bookpriceval = $row['price'];
					  
                     include "cs/config.php";
					 $resultsqldul = mysqli_query($db,"call sp_get_common_data('','".$_COOKIE['useremailid']."','".$bookidval."','','','','','A','','','','','','','','','','GET_ALREADY_SUBSCRIBED')");
					 $db->close();
					 if(mysqli_num_rows($resultsqldul)>0)
					 {
					   $rowdup = mysqli_fetch_array($resultsqldul);
					   $existbookval = $rowdup['countval'];
					 }
					
				     if($existbookval==0)
					 {
						 $Subscriberid=$_COOKIE['userid'];
						 $quantityval="1";
						 $noofuserval="1";
						 include "cs/config.php";
						 mysqli_query($db,"call sp_add_bookindashboard('".$Subscriberid."','".$_COOKIE['useremailid']."','','".$titleval."','".$quantityval."','".$noofuserval."','".$course_idval."','".$category_idval."','".$bookidval."','".$bookpriceval."','ADDBOOK_IN_DASHBOARD')"); 
						 $db->close();
						 
						 
						 include "cs/config.php";
						 $dsud = mysqli_query($db,"call sp_get_common_data('','".$_COOKIE['useremailid']."','','','','','','A','','','','','','','','','','GET_USER_DETAILS')");
						 $db->close();
						 if(mysqli_num_rows($dsud)>0)
						 {
						   $rowdsud = mysqli_fetch_array($dsud);
						   $Membername = $rowdsud['first_name'];
						 }
						 mysqli_free_result($dsud);
						 
						 $MemberEmailid=$_COOKIE['useremailid'];
						 $MailSubject = "1Book : Your order of ".$titleval." is confirmed";
						 //$bodydata = "<img src='cid:1book_logo' alt='1Book'><br>";
						 $bodydata .= "<p>Hi ".$Membername.",</p>";
						 $bodydata .= "<p><span style='color:#EF7F1B'>Thank you for choosing 1Book!</span></p>";
						 $bodydata .= "<p>You have successfully subscribed to ".$titleval.". You can access the invoice by going to the My Orders section in your account.</p>";
						 $bodydata .= "<p>You can now view the 'Book/Note' in your 1Book account.</p>";
						 $bodydata .= "<p>Sincerely,</p>";
						 $bodydata .= "<p><span style='color:#EF7F1B'>1Book</span> Team</p>";
						 $SendMailMsg = SendMail($SMTPServerFromEmailID,$MemberEmailid,'','',$MailSubject,$bodydata,"","");
						 
						 echo "<script>alert('Book added successfully in your dashboard')</script>"; 
					  }
					  else
					  {
						 echo "<script>alert('Book already added in your dashboard')</script>"; 
					  }
					}
				}
			}
			else
			{
				$WebSite_URL="location:".$SiteURL;
				header($WebSite_URL);
			}
		}
	   
       ?>
	   
	   <!-- Code end for add the book/notes in dashboard -->
	   
	</head>
	<body>
	
	<div class="mainWrap">
	
		 <!-- Header Start Here -->
		 <?php include_once('header.php');?>
		 <!-- Header End Here -->
		 
         <form method="post" id="frmsubs1" name="frmsubs1" enctype="multipart/form-data" action="<?php $_PHP_SELF ?>">
		<div class="col-xs-12 padd0 divBG1" style="display:none;">
			<div class="innerWrap padd015">
				<div class="pull-left shelfTxt">
				 <?php
				  $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
				  echo "<a href='$url'><span class='glyphicon glyphicon-arrow-left'></span> <span>Back to store</span></a>"; 
				?>
				</div>
				<div class="pull-right">
					<div class="navbar-form searchBox1" role="search">
						<div class="input-group">
							
						</div>
					</div>
				</div>
				<div style="display: block; clear: both;"></div>
			</div>
		</div>
		
              <!-- Code start for get the book/notes detail -->
             <?php
				    if(isset($_GET['id']) && count($_GET) > 0 ) 
				    {
						$BNId = mysqli_real_escape_string($db,$_GET['id']); 
						include "cs/config.php";
						$qryds = mysqli_query($db, "call sp_get_common_data('','','".$BNId."','','','','','A','','','','','','','','','','GET_SUBSCRIBEBOOK')");
						$db->close();
					    if(mysqli_num_rows($qryds)>0)
					    {
						  $row = mysqli_fetch_array($qryds);
						  $category_nameval = $row['category_name'];
						  $titleval = $row['title'];
						  $authorval = $row['author'];
						  $publicationval = $row['publication'];
						  $editionval = $row['edition'];
						  $pagesval = $row['pages'];
						  
						  include "cs/config.php";
						  $dscountpages = mysqli_query($db,"call sp_get_common_data('','','".$BNId."','','','','','A','','','','','','','','','','COUNT_NO_OF_PAGES')") or die('Query Not execute'.mysqli_error($db));
						  $db->close();
						  if(mysqli_num_rows($dscountpages)>0)
						  {
							$rowdup = mysqli_fetch_array($dscountpages);
							$pagesval = $rowdup['totalpages'];
							mysqli_free_result($dscountpages);
						  }
						  else
						  {
							 $pagesval = $row['pages'];
						  }
						  
						  $priceval = $row['price'];
						  $Subscribebtnvalue='Subscribe';
						  if($priceval=="" || $priceval=="0" || $priceval=="(NULL)" || $priceval=="NULL")
						  {
						     $priceval = 'Free';
							 $Subscribebtnvalue='Subscribe';
						  }
						  else
						  {
						    $priceval= "<i class='fa fa-inr' aria-hidden='true'></i>&nbsp;".$priceval;
							$Subscribebtnvalue = "Buy&nbsp;&nbsp;&nbsp;&nbsp;".$priceval;
						  }
						  $print_isbnval = $row['print_isbn'];
						  $etext_isbn = $row['etext_isbn'];
						  $descriptionval = $row['description'];
						  if($descriptionval=="")
						  {
							  $descriptionval="NA";
						  }
						 $thumbimg = $row['thumb_img'];
						 $largeimg = $row['large_img'];
						 if($thumbimg!="")
						 {
						  $thumbimgpath=returnthbimage($thumbimg);
						  $largeimgpath=returnthbimage($largeimg);
						  $thumbimgpath=$S3URL.$thumbimgpath;
						  $largeimgpath=$S3URL.$largeimgpath;
						 }
						 else
						 {
						  $thumbimgpath=$SiteURL.$DefaultThumbPath;
						  $largeimgpath=$SiteURL.$DefaultLargePath;
						 }
						
						 $booktypeval = $row['book_type'];
						 $bookpriceval = $row['price'];
						 if($booktypeval=="BOOK")
						 {
						 $booktypeval="eBook";
						 }
						 else
						 {
						 $booktypeval="eNotes";
						 }

			 echo "<div class='col-xs-12 padd0 mtop20'>
				<div class='innerWrap padd015'>
					<div class='col-xs-12 padd0 ndEco'>
					<span>$category_nameval</span>
					</div>
				</div>
			</div>
		
		<div class='col-xs-12 padd0'>
			<div class='innerWrap padd015'>
               <div class='row row10'>
			   <div class='col-xs-12 padd10 '>
					<div class='pull-left aboutBook1'>$titleval</div>
					<div class='pull-right aboutBook2'><button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'><i class='fa fa-share-alt' aria-hidden='true'></i> Share <span class='caret'></span></button>
						<ul class='dropdown-menu'>
							<li><a href='https://www.facebook.com/sharer/sharer.php?u=$CurrentPageURL' onclick='window.open(this.href, '', 'width=626,height=436'); return false;' rel='nofollow' target='_blank' title='Share this on Facebook'><span class='dMenuLeft'>Facebook</span> <i class='fa fa-facebook' aria-hidden='true'></i></a></li>
							<li><a href='https://twitter.com/share?text=$title&url=$CurrentPageURL&amp;via=1Book' onclick='window.open(this.href, '', 'width=626,height=436'); return false;' rel='nofollow' target='_blank' title='Tweet this'><span class='dMenuLeft'>Twitter</span> <i class='fa fa-twitter' aria-hidden='true'></i></a></li>
							<li><a href='https://plus.google.com/share?url=$CurrentPageURL' onclick='window.open(this.href, '', 'width=626,height=436'); return false;' rel='nofollow' target='_blank' title='Share this on Google Plus'><span class='dMenuLeft'>Google-plus</span> <i class='fa fa-google-plus' aria-hidden='true'></i></a></li>
							<li><a href='https://www.linkedin.com/shareArticle?mini=true&url=$CurrentPageURL&title=$title&summary=$bookdescription&source=$GetSiteUrl' onclick='window.open(this.href, '', 'width=626,height=436'); return false;' rel='nofollow' target='_blank' title='Share this on Linkedin'><span class='dMenuLeft'>Linkedin</span> <i class='fa fa-linkedin' aria-hidden='true'></i></a></li>
							<li><a href='whatsapp://send?text=$CurrentPageURL' data-action='share/whatsapp/share' onclick='window.open(this.href, '', 'width=626,height=436'); return false;' rel='nofollow' target='_blank' title='Send this on Whatsapp'><span class='dMenuLeft'>Whatsapp</span> <i class='fa fa-whatsapp' aria-hidden='true'></i></a></li>
						</ul>
					</div>
				</div>
				
				<div class='col-xs-12 xsWid100 padd0'>
                  <div class='col-xs-3 ndWid1 padd10'>
                     <img src='$thumbimgpath' alt='Book Cover' class='img-responsive' />
                  </div>
                  <div class='col-xs-9 ndWid2 paddL10R0 xsPaddR15'>
                     <div class='bodyside2R'>
						<p>Type: $booktypeval</p>
                        <p>Author(s): $authorval</p>
                        <p>Publisher: $publicationval</p>
                        <p>Edition: $editionval</p>
                        <p>Pages: $pagesval</p>
						<p>Price: $priceval</p>
                        <p>Print ISBN: $print_isbnval</p>
                        <p>eText ISBN: $etext_isbn</p>";
						if(!isset($_COOKIE['useremailid']))
					    {
						 // Subscribe Now... =Free
						  echo "<a class='btn btn-warning subsBtn' href='#' data-toggle='modal' data-target='#loginModal'>$Subscribebtnvalue</a>";
						}
						if(isset($_COOKIE['useremailid']))
					   {
						if(isset($_GET['id']) && count($_GET) > 0 ) 
						{
						 include "cs/config.php";
						 $BNID = mysqli_real_escape_string($db,$_GET['id']);
						 $UEmailId=$_COOKIE['useremailid'];
						 $UName=$_COOKIE['username'];
						 
						 $resultsqldul = mysqli_query($db,"call sp_get_common_data('','".$UEmailId."','".$BNID."','','','','','A','','','','','','','','','','GET_ALREADY_SUBSCRIBED')");
						 $db->close();
						 if(mysqli_num_rows($resultsqldul)>0)
						 {
						   $rowdup = mysqli_fetch_array($resultsqldul);
						   $existbookval = $rowdup['countval'];
						 }
						 mysqli_free_result($resultsqldul);
						 
						 if($existbookval==0)
						 {
						     if($bookpriceval=="" || $bookpriceval=="(NULL)" || $bookpriceval=="NULL" || $bookpriceval=="0")
							 {
							  // Subscribe Now = Free
							  echo "<input form='frmsubs1' type='submit' id='paynow' name='paynow' value='Subscribe'
							  class='btn btn-warning subsBtn' onClick='document.location.href='index.html'/>";
							 }
							 else
							 {
							    $totalprice = $bookpriceval * 100;
							    echo "<button form='frmsubs1' class='btn btn-warning subsBtn' id='rzp-button1'>$Subscribebtnvalue</button>
								<script src='https://checkout.razorpay.com/v1/checkout-new.js'></script>
								<script>
									var options = {
										'key': 'rzp_live_dOcPnVQ9nekfda',
										'amount': '".$totalprice."', // 5000 paise = INR 500
										'name': '1book',
										'description': '1book is an online portal where students can access eNotes and eBooks for studying.',
										'image': 'http://1book.in/img/homePage/logo.png',
										'handler': function (response) {
											var payment_userid = response.razorpay_payment_id;
											
											var WebSite_URL='".$SiteURL."thankyou.php?paymentid=".payment_userid."&bookid=$BNID&useremailid=$UEmailId&bookname=$titleval';
											
											window.open(WebSite_URL,'_self');	   
										},
										'prefill': {
											'name': '".$UName."',
											'email': '".$UEmailId."'
										},
										'theme': {
											'color': '#ef7f1b'
										}
									};
									var rzp1 = new Razorpay(options);

									document.getElementById('rzp-button1').onclick = function (e) {
										rzp1.open();
										e.preventDefault();
									}
								</script>";
								}
						 }
						 else
						 {
							 echo "<input form='frmsubs1' type='submit' id='paynowalready' name='paynowalready' value='Subscribed' class='btn btn-warning subsBtn' style='cursor: text;' />";
						 }
						}
					   }
                      echo "</div>
                     <div class='aboutBook2R visible-xs'>$titleval</div>
                  </div>
				  
				  <div class='col-xs-12 padd10'>
					<div class='ndAboutBk contAbt'>
                        <h4>About Book</h4>
                        <p>$descriptionval</p>
                     </div>
				  </div>
				  
				  </div>
			   
			   <!-- <div class='col-xs-8 ndWid1a xsWid100 padd0'>
                  <div class='col-xs-5 ndWid1 padd10'>
                     <img src='$thumbimgpath' alt='Book Cover' class='img-responsive' />
                  </div>
                  <div class='col-xs-7 ndWid2 paddL10R0 xsPaddR15'>
                     <div class='bodyside2R'>
                        <div class='aboutBook'>$titleval</div>
						<p>Type: $booktypeval</p>
                        <p>Author(s): $authorval</p>
                        <p>Publisher: $publicationval</p>
                        <p>Edition: $editionval</p>
                        <p>Pages: $pagesval</p>
						<p>Price: $priceval</p>
                        <p>Print ISBN: $print_isbnval</p>
                        <p>eText ISBN: $etext_isbn</p>
                     </div>
                     <div class='aboutBook2R visible-xs'>$titleval</div>
                  </div>
				  
				  <div class='col-xs-12 padd10'>
					<div class='ndAboutBk contAbt'>
                        <h4>About Book</h4>
                        <p>$descriptionval</p>
                     </div>
				  </div>
				  
				  </div>-->
				  
				  
                   <div class='col-xs-4 ndWid3 xsSubWid padd10' style='display:none;'>
                     <div class='ndSubs' style='display:none;'>   <!-- Deepak Comment -->
                        <div class='titSub'>Subscription</div>
                        <div class='col-xs-12 padd0 mbottom10'>
							<div class='pull-left'>
								<div class='radio margin0'>
									<label>
										<input type='radio' name='optradio' class='mtop5' />
										<span class='radiobtnTop'>90 Day Access</span>
										<span class='radiobtnBtm'>Expires 12/09/2016</span>
									</label>
								</div>
							</div>
							<div class='pull-right'>
								<span class='radiobtnTop'><i class='fa fa-inr' aria-hidden='true'></i> NA</span>
								<span class='radiobtnBtm'>(INR)</span>
							</div>
						</div>
						<div class='col-xs-12 padd0 mbottom10'>
							<div class='pull-left'>
								<div class='radio margin0'>
									<label>
										<input type='radio' name='optradio' class='mtop5' />
										<span class='radiobtnTop'>120 Day Access</span>
										<span class='radiobtnBtm'>Expires 12/09/2016</span>
									</label>
								</div>
							</div>
							<div class='pull-right'>
								<span class='radiobtnTop'><i class='fa fa-inr' aria-hidden='true'></i> NA</span>
								<span class='radiobtnBtm'>(INR)</span>
							</div>
						</div>
						<div class='col-xs-12 padd0 mbottom10'>
							<div class='pull-left'>
								<div class='radio margin0'>
									<label>
										<input type='radio' name='optradio' class='mtop5' />
										<span class='radiobtnTop'>132 Day Access</span>
										<span class='radiobtnBtm'>Expires 12/09/2016</span>
									</label>
								</div>
							</div>
							<div class='pull-right'>
								<span class='radiobtnTop'><i class='fa fa-inr' aria-hidden='true'></i> NA</span>
								<span class='radiobtnBtm'>(INR)</span>
							</div>
						</div>
						
						<div class='col-xs-12 padd0 mbottom8 totSum'>
							<div class='pull-left'>
								<div class='radio margin0'>
									<span class='sumTop'>Print List Price</span>
									<span class='sumBtm'>You Save</span>
								</div>
							</div>
							<div class='pull-right'>
								<span class='sumTop'><i class='fa fa-inr' aria-hidden='true'></i> NA</span>
								<span class='sumBtm'><i class='fa fa-inr' aria-hidden='true'></i> NA</span>
							</div>
						</div>						
                     </div>";
					 if(!isset($_COOKIE['useremailid']))
					 {
					   // echo "<input form='frmsubs1' type='submit' id='paynow' name='paynow' value='Subscribe Now' class='btn btn-warning subsBtn' onClick='document.location.href='index.php'/>";
					   // Subscribe Now = Free
					   echo "<a class='btn btn-warning subsBtn' href='#' data-toggle='modal' data-target='#loginModal'>Subscribe</a>";
					 }
                     
					 if(isset($_COOKIE['useremailid']))
					 {
						if(isset($_GET['id']) && count($_GET) > 0 ) 
						{
						 include "cs/config.php";
						 $BNID = mysqli_real_escape_string($db,$_GET['id']);
						 $UEmailId=$_COOKIE['useremailid'];
						 $UName=$_COOKIE['username'];
						 
						 $resultsqldul = mysqli_query($db,"call sp_get_common_data('','".$UEmailId."','".$BNID."','','','','','A','','','','','','','','','','GET_ALREADY_SUBSCRIBED')");
						 $db->close();
						 if(mysqli_num_rows($resultsqldul)>0)
						 {
						   $rowdup = mysqli_fetch_array($resultsqldul);
						   $existbookval = $rowdup['countval'];
						 }
						 mysqli_free_result($resultsqldul);
						 
						 if($existbookval==0)
						 {
						     if($bookpriceval=="" || $bookpriceval=="(NULL)" || $bookpriceval=="NULL" || $bookpriceval=="0")
							 {
							 // Subscribe Now = Free
							  echo "<input form='frmsubs1' type='submit' id='paynow' name='paynow' value='Subscribe' class='btn btn-warning subsBtn' onClick='document.location.href='index.html'/>";
							 }
							 else
							 {
							    $totalprice = $bookpriceval * 100;
							    echo "<button class='btn btn-warning subsBtn' id='rzp-button1'>Subscribe Now</button>
								<script src='https://checkout.razorpay.com/v1/checkout-new.js'></script>
								<script>
									var options = {
										'key': 'rzp_live_dOcPnVQ9nekfda',
										'amount': '".$totalprice."', // 5000 paise = INR 500
										'name': '1book',
										'description': '1book is an online portal where students can access eNotes and eBooks for studying.',
										'image': 'http://1book.in/img/homePage/logo.png',
										'handler': function (response) {
											var payment_userid = response.razorpay_payment_id;
											
											var WebSite_URL='".$SiteURL."thankyou.php?paymentid=".payment_userid."&bookid=$BNID&useremailid=$UEmailId&bookname=$titleval';
											
											window.open(WebSite_URL,'_self');	   
										},
										'prefill': {
											'name': '".$UName."',
											'email': '".$UEmailId."'
										},
										'theme': {
											'color': '#ef7f1b'
										}
									};
									var rzp1 = new Razorpay(options);

									document.getElementById('rzp-button1').onclick = function (e) {
										rzp1.open();
										e.preventDefault();
									}
								</script>";
								}
						 }
						 else
						 {
							 echo "<input form='frmsubs1' type='submit' id='paynowalready' name='paynowalready' value='Subscribed' class='btn btn-warning subsBtn' style='cursor: text;' />";
						 }
						}
					   }
						 echo"</div>
						 </div>
						</div>
						</div>";
					  }
					}
				?>
				 <!-- Code end for get the book/notes detail -->

		</form>
	   <!-- Footer Start Here -->
	   <?php include_once('footer.php');?>
	   <!-- Footer End Here -->
	 </div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="<?php echo $SiteURL;?>js/index.js"></script>
		
		<script src="<?php echo $SiteURL;?>js/scrolltofixed.js"></script> <!-- plugin is used to fix elements on the page (top, bottom, anywhere) -->
	 
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