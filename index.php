<!DOCTYPE html>
<?php ob_start(); ?>
<?php include "cs/config.php"; ?>
<?php
	//ini_set('display_errors','1');
 // session_start();
 // if($_SESSION['userid']!="")
 // {
    // //echo $_SESSION['userid'];
    // setcookie('useremailid', $_SESSION['userid'], time() + 24*60*60, "/");
	// setcookie('roleid', $_SESSION['roleid'], time() + 24*60*60, "/");
	// setcookie('username', $_SESSION['username'], time() + 24*60*60, "/");
	// setcookie('user_id', $_SESSION['user_id'], time() + 24*60*60, "/");
 // }
//print_r($_COOKIE);
// if(isset($_COOKIE['useremailid'])) {
// echo "<br>";
    // echo "User Name '" . $_COOKIE['username'] . "' is set!<br>";
	 // echo "User RoleID '" . $_COOKIE['roleid'] . "' is set!<br>";
	  // echo "User Emailid '" . $_COOKIE['useremailid'] . "' is set!";
// } 
?>

<html lang="en">
<head>
	<title>1Book: Digital Solutions for Students, Educators and Publishers</title>
	<meta charset="utf-8">
	<meta name="keywords" content='ebook rentals, ebooks sales, ebooks sales in India, ebooks For PCs, ebooks For iPad, ebooks For Android, ebooks free  download, download free ebooks, ebook library, company secretary ebooks, ca ebooks download, Chartered accountancy ebooks download, Chartered accountancy ebooks, Chartered accountancy books, download, 1book, company secretary books, company secretary notes, Chartered accountancy notes, CS Notes, CA notes, CA notes pdf, CS notes pdf, ebooks for tablet,onebook, One Book'>
	<meta name="description" content='Digital solutions for Students, Institutes, Educators & Publishers. Access eBooks/ eNotes on the move.'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?php echo $SiteURL;?>img/fevicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo $SiteURL;?>css/style.css">
	<link rel="stylesheet" href="<?php echo $SiteURL;?>css/login_register.css">
	<link rel="stylesheet" href="<?php echo $SiteURL;?>css/common.css">

	<!-- Validation start for search books/notes -->
	<script language="javascript" type="text/javascript">
	function srchbooksvalidation()
	{
		if(document.getElementById("srchbooksnotes").value=="")
		{
		    window.location="bookshelf.html";
			//document.getElementById('srch_msg').style.display = "initial";
			//document.getElementById("srch_msg").innerHTML = "Please enter any search keyword";
			//document.getElementById("srchbooksnotes").focus();
			return false;
			
		}
	}
	function srchmsghide(hideId)
	{
		document.getElementById(hideId).style.display = "none";
	} 
	</script>
	
	<script  language="javascript" type="text/javascript">
		function srchbooksnotesfun()
		{
			document.getElementById('srchbooksnotes').onkeypress=function(e)
			{
			    if(e.keyCode==13)
			    {
			        document.getElementById('submit').click();
			        return false;
			    }
			}
		}
	</script>
	<!-- Validation end for search books/notes -->

	<!-- Code start for search books/notes -->
	<?php
		include "cs/config.php";
		if(isset($_POST['submit']))
		{
			$srchtextval=$_POST['srchbooksnotes'];
			if($srchtextval!="")
			{
			 $path= "location:bookshelf_search.php?search=".$srchtextval."";
		     header($path);
			}
			else
			{
			  header("location:bookshelf.html");
			}
		}
	 ?> 
	 <!-- Code end for search books/notes -->
</head>
<body>
	<div class="mainWrap">

	   <!-- Header Start Here -->
	   <?php include_once('header.php');?>
	   <!-- Header End Here -->

		        <div class="col-xs-12 headSearch">
				<form method="post" id="form1" name="form1" enctype="multipart/form-data" action= "<?php $_PHP_SELF ?>">
					<div class="searchContainer">
						<div class="headerTxt">Now Access<br>eNotes/ eBooks on the move</div>
						<div id="custom-search-input">
							<div class="input-group col-md-12">
								<input type="text" form="form1" id="srchbooksnotes" name="srchbooksnotes" onKeyPress="javascript:srchbooksnotesfun(); return false;" class="form-control input-lg" placeholder="Find eBooks, eNotes etc." onkeyup='return srchmsghide("srch_msg")' />
								<span class="input-group-btn">
									<button class="btn btn-info btn-lg" type="submit" name="submit" id="submit" form="form1" OnClick="return srchbooksvalidation();">
										<i class="glyphicon glyphicon-search"></i>
									</button>
								</span>
							</div>
						</div>
						<span id="srch_msg" class="label label-danger"></span>
					</div>
				</form>
				</div>
				
				<div class="col-xs-12 studyHeader">
					We Make Studying
				</div>
				<div class="col-xs-12 studybody">
					
						<div class="studyContainer">
							<div class="col-sm-4 hidden-xs studyContwid">
								<img src="img/homePage/interesting.png" alt="Interesting Image" />
								<h3>Interesting</h3>
								<p>Access content in colour. Feel the power of the <span class="clrOrange">1Book</span> interactive reader. Relive the classroom experience with direct access to your educator.</p>
							</div>
							<div class="col-sm-4 hidden-xs studyContwid">
								<img src="img/homePage/convenient.png" alt="Convenient Image" />
								<h3>Convenient</h3>
								<p>Carry your books on your mobile, tablet or laptop. Access anywhere anytime.</p>
							</div>
							<div class="col-sm-4 hidden-xs studyContwid">
								<img src="img/homePage/efficient.png" alt="Efficient Image" />
								<h3>Efficient</h3>
								<p>Get updated content directly from your educator. Say goodbye to the hassles of looking for revised books and notes.</p>
							</div>
							
							<div class="col-xs-12 visible-xs studyContwid">
								<div class="media">
									<div class="media-left">
										<img src="img/homePage/interesting.png" alt="Interesting Image" />
									</div>
									<div class="media-body">
										<h3 class="media-heading">Interesting</h3>
										<p>Access content in colour. Feel the power of the <span class="clrOrange">1Book</span> interactive reader. Relive the classroom experience with direct access to your educator.</p>
									</div>
								</div>
							</div>
							
							<div class="col-xs-12 visible-xs studyContwid">
								<div class="media">
									<div class="media-left">
										<img src="img/homePage/convenient.png" alt="Convenient Image" />
									</div>
									<div class="media-body">
										<h3 class="media-heading">Convenient</h3>
										<p>Carry your books on your mobile, tablet or laptop. Access anywhere anytime.</p>
									</div>
								</div>
							</div>
							
							<div class="col-xs-12 visible-xs studyContwid">
								<div class="media">
									<div class="media-left">
										<img src="img/homePage/efficient.png" alt="Efficient Image" />
									</div>
									<div class="media-body">
										<h3 class="media-heading">Efficient</h3>
										<p>Get updated content directly from your educator. Say goodbye to the hassles of looking for revised books and notes.</p>
									</div>
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
	<script src="<?php echo $SiteURL;?>js/index.js"></script>
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