<!DOCTYPE html>
<?php ob_start(); ?>
<?php include "../cs/config.php"; ?>
<html lang="en">
	<head>
		<title>1Book</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
		<link rel="shortcut icon" href="<?php echo $SiteURL;?>img/fevicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/jasny-bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/common.css">
		<link rel="stylesheet" href="css/analyticsSubsWise.css">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/responsive.css">
	</head>
	<body>
		<div class="mainWrap">
			
			<!-- Dashboard Start Here -->
			 <?php include_once('../dashboard.php');?>
			 <!-- Dashboard End Here -->
			 
			 <?php 
			   $CurrentPage = $_SERVER['PHP_SELF']; // will return http://xyz.com/two.php for our example
			   $CurrentPage = basename($CurrentPage); // will return two.php
			   $CurrentPage = basename($CurrentPage, '.php');
			 ?>
			   
			
			<div class="container wrapMB">
				<div class="col-xs-12 padd0 mbHeadDiv">
					<div class="pull-left">
						<img src="img/analytics/ellipse.png" alt="Ellipse Logo" class="img-responsive mbBshelf"/>
						<div class="mbManage">
						    <?php
							if(isset($_GET['bookid']) && count($_GET) > 0 ) 
							{
								include "cs/config.php";
								$BNId=$_GET['bookid']; 
								$qryds = mysqli_query($db,"call sp_get_common_data('','','".$BNId."','','','','','A','','','','','','','','','','GET_BOOKNOTES_DETAILS')") 
								or die('Query Not execute'.mysqli_error($db));
								$db->close();
								if(mysqli_num_rows($qryds)>0)
								{
								  $row = mysqli_fetch_array($qryds);
								  // $category_nameval = $row['category_name'];
								  // $BookNotesId = $row['id'];
								  $titleval = $row['title'];
								  // $authorval = $row['author'];
								   $publicationval = $row['publication'];
								  // $course_idval = $row['course_id'];
								  // $subject_idval = $row['category_id'];
								  // echo "<div class='mBooksTxt'>$titleval</div>";
								  // mysqli_free_result($qryds);
								  echo "<div class='mBooksTxt'>$titleval <span class='xsmBooksTxt'>($publicationval)</div>";
							   }
							}
						   ?>
							<ul class="list-inline">
								<!--<li><a href="#">Monthwise</a></li>-->
								<li><a href="<?php echo $SiteURL;?>analytics/analytics_subs_wise.php?bookid=<?php echo $BNId;?>">Subscribers</a></li>
							</ul>
						</div>
					</div>
					<div class="pull-right">
						<form class="mtop19">
						     <?php
								  $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
								  echo "<a class='btn ndBtn1 btn-default' href='$url'><i class='fa fa-angle-left' aria-hidden='true'></i> Back</a>"; 
							 ?>
							<!--<button type="button" class="btn ndBtn1 btn-default"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</button>-->
						</form>
					</div>
				</div>
				
				<div class="col-xs-12 padd0 ndEco" style='display:none;'>
					<div class="mgLeftPart">
						<div id="datetimepicker1" class="input-append date npDivWidth1">
							<select class="form-control">
								<option>Month</option>
								<option>Option 1</option>
								<option>Option 2</option>
								<option>Option 3</option>
							</select>
						</div>
						<div id="datetimepicker2" class="input-append date npDivWidth1">
							<select class="form-control">
								<option>Year</option>
								<option>Option 1</option>
								<option>Option 2</option>
								<option>Option 3</option>
							</select>
						</div>

						<form class="goBtnForm1">
							<a href="#"><img src="img/analytics/xlsx_icon.png" alt="xlsx Icon" /></a>
						</form>
					</div>
					
				</div>
				
				<form method="post" id="formsubs" name="formsubs" enctype="multipart/form-data" action= "<?php $_PHP_SELF ?>">
				<div class="col-xs-12 padd0 ndEco">
					<div class="mgLeftPart">
						<div id="datetimepicker2" class="input-append date npDivWidth1">
						<?php
						     if (isset($_POST['subscriptionstype']))
							 {
								$subscriptionstypeval = $_POST['subscriptionstype'];
							 }
							 else
							 {
								$subscriptionstypeval="PAID";
							 }
							?>
							<select name="subscriptionstype" class="form-control" onchange='this.form.submit();'>
								<option value="ALL" <?php if ($_POST['subscriptionstype'] == 'ALL') echo 'selected="selected"'; ?> >All Subscriptions</option>
								<option value="FREE" <?php if ($_POST['subscriptionstype'] == 'FREE') echo 'selected="selected"';  ?> >CDP Allotment</option>
								<option value="PAID" <?php if ($_POST['subscriptionstype'] == 'PAID' || $subscriptionstypeval == 'PAID') echo 'selected="selected"'; ?>>Paid Subscription</option> 
							</select>
						</div>

						<form class="goBtnForm1">
							<!--<a href="#"><img src="img/analytics/xlsx_icon.png" alt="xlsx Icon" /></a>-->
						</form>
					</div>
				</div>
				
				<div class="col-xs-12 padd0">
					<div class="table-responsive">
						<table class="table aTable1">
							<thead>
								<tr>
									<th>#</th>
									<th>NAME</th>
									<th>EMAIL</th>
									<th>SUBSCRIPTION TYPE</th>
									<th>PRICE</th>
									<th>SUBSCRIPTION DATE</th>
								</tr>
							</thead>
							<tbody>
							   <?php
							         include "../cs/config.php";
									 $pub_ds = mysqli_query($db,"call sp_get_books_analytics('','".$_COOKIE['useremailid']."','','".$BNId."','','','','A','','','','','','','$subscriptionstypeval','','','','','',
							         'GET_DETAILS_OF_ALL_SUBSCRIBERS')") or die('Query Not execute'.mysqli_error($db));
									 $db->close();
									 if(mysqli_num_rows($pub_ds)>0)
						             {
									  $i=1;
									  while ($row = mysqli_fetch_array($pub_ds))
								      {
									    $Subscriber_IdVal = $row['subscriber_id'];
									    $Subscriber_EmailidVal = $row['subscriber_emailid'];
										$Subscriber_NameVal = $row['first_name'];
										$Subscription_typeVal = $row['subscription_type'];
										$PriceVal = $row['price'];
										if($Subscription_typeVal=="GROUP")
									    {
									       $Subscription_typeVal="CDP ALLOTMENT";
										   $PriceVal="NA";
									    }
										if($Subscription_typeVal=="PAYMENT")
									    {
									       $Subscription_typeVal="PAID SUBSCRIPTION";
										   if($PriceVal=="" || $PriceVal=="0" || $PriceVal=="(NULL)" || $PriceVal=="NULL")
										   {
											   $PriceVal = '0'." (INR)";
										   }
										   else
										   {
											   $PriceVal = $PriceVal." (INR)";
										   }
									    }
										
										$Order_dateVal = $row['order_date'];
										echo "<tr>
											<td>$i</td>
											<td>$Subscriber_NameVal</td>
											<td>$Subscriber_EmailidVal</td>
											<td>$Subscription_typeVal</td>
											<td>$PriceVal</td>
											<td>$Order_dateVal</td>
										</tr>";
										$i=$i+1;
									 }
								   }
								   mysqli_free_result($pub_ds);
								?>
							</tbody>
						</table>
					</div>
				</div>
			    </form>
			 </div>
			<div class="col-xs-12 footer2a">
				<div class="pull-left xs_100">Copyrights @ 2016 1Book All Right Reserved</div>
				<div class="pull-right xs_100">Designed by <a href="http://www.4cplus.com" target="_blank">4C Plus</a></div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="../js/jasny-bootstrap.min.js"></script>
		<script src="../js/index.js"></script>
	</body>
</html>
<?php ob_end_flush(); ?>