<!DOCTYPE html>
<?php ob_start(); ?>
<?php require_once "cs/config.php"; ?>
<html lang="en">
	<head>
		<title>Thank You | 1Book</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="<?php echo $SiteURL;?>img/fevicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	    <link rel="stylesheet" href="css/login_register.css">
		<link rel="stylesheet" href="css/contactUs.css">
		<link rel="stylesheet" href="css/common.css">
		
	</head>
	<body class="modal-open">
	<div class="mainWrap">
		
		 <!-- Header Start Here -->
	   <?php include_once('header.php');?>
	   <!-- Header End Here -->

		
		<div class="formWid1">
		<?php 
		require 'PHPMailer/mail_common.php';
		include "cs/config.php";
		if(isset($_GET['bookname']) && count($_GET) > 0 )
		{
		    //session_start();
				if(isset($_COOKIE['useremailid']))
				{
				if(isset($_GET['bookid']) && count($_GET) > 0 ) 
				{
					include "cs/config.php";
					$BNId = mysqli_real_escape_string($db,$_GET['bookid']); 
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
					 mysqli_free_result($resultsqldul);
					
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
									
						 //echo "<script>alert('Book added successfully in your dashboard')</script>"; 
					  }
					  else
					  {
						 //echo "<script>alert('Book already added in your dashboard')</script>"; 
					  }
					}
					mysqli_free_result($qryds);
				}
			}
			
			echo "<p style='font-size:17px;'>Thank You! You have successfully subscribed to 
			<a style='font-size:17px;' href='".$SiteURL."mybookshelf.html'><b>".$_GET['bookname']."</b></a>. Click here to go to your <a style='font-size:17px;' href='".$SiteURL."mybookshelf.html'><b>Dashboard</b></a></p>";
		}
		?>
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

