<!DOCTYPE html>
<?php ob_start(); ?>
<?php include "../cs/config.php"; ?>
<html lang="en">
	<head>
		<title>1Book</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/bootstrap.min.css">
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
							<div class="mBooksTxt">Sales Report & Analytics</div>
							<div style='display:none;' class="mBooksTxt">Sales Report <span class="xsmBooksTxt">(Gautama Publications)</div>
							<ul class="list-inline">
								<li><a class="<?php echo ($CurrentPage == "analytics_overview" ? "active" : "")?>" href="<?php echo $SiteURL;?>analytics/analytics_overview.html">Overview</a></li>
								<!--<li><a href="<?php echo $SiteURL;?>analytics/analytics_subscribers.php">Subscriber(s)</a></li>
								<li><a href="<?php echo $SiteURL;?>analytics/sales_report.php">Sales Report</a></li>-->
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
				<div class="col-xs-12 padd0 ndEco">
					<div class="row03">
						<div class="col-xs-6 padd03">
							<div class="aoGraphBox" style="text-align:center;">
							
							    <?php 
							    include "../cs/config.php";
								$dsfree = mysqli_query($db,"call sp_get_books_analytics('','".$_COOKIE['useremailid']."','','','','',
							    '','A','','','','','','','','','','','','','GET_TOTAL_FREE_SUBSCRIPTIONS')") or die('Query Not execute'. mysqli_error($db));
							    $db->close();
								$countfreepubs= mysqli_num_rows($dsfree);
								mysqli_free_result($dsfree);
								
								include "../cs/config.php";
								$dspaid = mysqli_query($db,"call sp_get_books_analytics('','".$_COOKIE['useremailid']."','','','','',
							    '','A','','','','','','','','','','','','','GET_TOTAL_PAID_SUBSCRIPTIONS')") or die('Query Not execute'. mysqli_error($db));
							    $db->close();
								$countpaidpubs= mysqli_num_rows($dspaid);
								mysqli_free_result($dspaid);

								$totalpubs=$countfreepubs + $countpaidpubs;
								?>
								
								<div class='abTabCell aoTabCellL' style='display:none;'>
								<div id='visualization' style='width: 200px; height: 150px;'></div>
								<!-- load api -->
								<script type='text/javascript' src='http://www.google.com/jsapi'></script>
								<script type='text/javascript'>
									//load package
									google.load('visualization', '1', {packages: ['corechart']});
								</script>
								
								<script type='text/javascript'>
									function drawVisualization() {
										// Create and populate the data table.
										var data = google.visualization.arrayToDataTable([
											['Free', 'Paid'],
											<?php
											// while( $row = $result->fetch_assoc() ){
												//extract($row);
												//echo "['{$name}', {$ratings}],";
												echo "['Free', $countfreepubs],";
												echo "['Paid', $countpaidpubs],";
											//}
											?>
										]);

										// Create and draw the visualization.
										new google.visualization.PieChart(document.getElementById('visualization')).
										draw(data, {title:""});
									}
									google.setOnLoadCallback(drawVisualization);
								</script>
								
								<!--<img src='img/analytics/graph2.jpg' alt='Graph' class='img-responsive' />-->
								</div>
								
								<?php 
								echo "<div class='abTabCell'>
									<img src='img/analytics/subscriber_icon.png' alt='Sales Icon' class='img-responsive abTabImg' />
									<div class='abTabRBox'>
										<div class='abBoxTxt1'>Total Subscriptions</div>
										<div class='abBoxTxt2'>$totalpubs</div>
									</div>
									<div class='abBox1'>
										<div class='abTabBox2'>
											<div class='abBoxTxt1'><img src='img/analytics/like.png' alt='Free Icon' class='img-responsive' /> Free</div>
											<div class='abBoxTxt2'>$countfreepubs</div>
										</div>
										<div class='abTabBox3'>
											<div class='abBoxTxt1'><img src='img/analytics/paid.png' alt='Paid Icon' class='img-responsive' /> Paid</div>
											<div class='abBoxTxt2'>$countpaidpubs</div>
										</div>
									</div>
								</div>";
								?>
								
							</div>
							<div class="aoGraphBox2" style='display:none;'>
								<div class="dropdown">
									<span class="dropdown-toggle">
									<!--<a class='ahover' href="<?php echo $SiteURL;?>analytics/analytics_subscribers.php">Click here for details</a>-->
									<a href="#">Click here for details</a>
									</span>
									<!--<span class="dropdown-toggle" data-toggle="dropdown"><a href="#">Click here for details <span class="caret"></span></a></span>
									<ul class="dropdown-menu">
										<li><a href="#">Example1</a></li>
										<li><a href="#">Example2</a></li>
										<li><a href="#">Example3</a></li>
									</ul>-->
								</div>
							</div>
						</div>
						<div class="col-xs-6 padd03">
							<div class="aoGraphBox" style="text-align:center;">
							
							    <?php 
							    include "../cs/config.php";
								$dstotalsale = mysqli_query($db,"call sp_get_books_analytics('','".$_COOKIE['useremailid']."','','','','',
							    '','A','','','','','','','','','','','','','GET_TOTAL_SALES')") or die('Query Not execute'. mysqli_error($db));
							    $db->close();
								if(mysqli_num_rows($dstotalsale)>0)
								{
								    while($row = mysqli_fetch_array($dstotalsale))
									{
									    $SettledAmount="0";
										$UnsettledAmount="0";
									    $totalsaleval = $row['totalsale'];
										$UnsettledAmount=$totalsaleval;
									    if($totalsaleval=="" || $totalsaleval=="(NULL)" || $totalsaleval=="NULL")
										{
										  $totalsaleval="0";
										  $UnsettledAmount="0";
										}
									}
								}
								mysqli_free_result($dstotalsale);
								?>
								
								<div class="abTabCell aoTabCellL" style='display:none;'>
								
								<div id='visualizationsales' style='width: 200px; height: 150px;'></div>
								<!-- load api -->
								<script type='text/javascript' src='http://www.google.com/jsapi'></script>
								<script type='text/javascript'>
									//load package
									google.load('visualization', '1', {packages: ['corechart']});
								</script>
								
								<script type='text/javascript'>
									function drawVisualization() {
										// Create and populate the data table.
										var data = google.visualization.arrayToDataTable([
											['Settled', 'Unsettled'],
											<?php
											// while( $row = $result->fetch_assoc() ){
												//extract($row);
												//echo "['{$name}', {$ratings}],";
												echo "['Settled', $SettledAmount],";
												echo "['Unsettled', $UnsettledAmount],";
											//}
											?>
										]);

										// Create and draw the visualization.
										new google.visualization.PieChart(document.getElementById('visualizationsales')).
										draw(data, {title:""});
									}
									google.setOnLoadCallback(drawVisualization);
								</script>
								<!--<img src="img/analytics/graph2.jpg" alt="Graph" class="img-responsive" />-->
								
								</div>
								
								
								<?php 
								echo "<div class='abTabCell'>
									<img src='img/analytics/sales_icon_light.png' alt='Sales Icon' class='img-responsive abTabImg' />
									<div class='abTabRBox'>
										<div class='abBoxTxt1'>Total Sales</div>
										<div class='abBoxTxt2'>INR $totalsaleval</div>
									</div>
									<div class='abBox1'>
										<div class='abTabBox2'>
											<div class='abBoxTxt1'><img src='img/analytics/law_policy.png' alt='Settled Icon' class='img-responsive' /> Settled</div>
											<div class='abBoxTxt2'>INR $SettledAmount</div>
										</div>
										<div class='abTabBox3'>
											<div class='abBoxTxt1'><img src='img/analytics/coins_icon.png' alt='Unsettled Icon' class='img-responsive' /> Unsettled</div>
											<div class='abBoxTxt2'>INR $UnsettledAmount</div>
										</div>
									</div>
								</div>";
								
								 ?>
							</div>
							<div class="aoGraphBox2" style='display:none;'>
								<div class="dropdown">
								   <span class="dropdown-toggle">
								   <!--<a class='ahover' href="<?php echo $SiteURL;?>analytics/sales_report.php" >Click here for details</a>-->
								   <a href="#">Click here for details</a>
								   </span>
									<!--<span class="dropdown-toggle" data-toggle="dropdown"><a href="#">Click here for details <span class="caret"></span></a></span>
									<ul class="dropdown-menu">
										<li><a href="#">Example1</a></li>
										<li><a href="#">Example2</a></li>
										<li><a href="#">Example3</a></li>
									</ul>-->
								</div>
							</div>
						</div>
					</div>
				</div>
				<form method="post" id="formsubs" name="formsubs" enctype="multipart/form-data" action= "<?php $_PHP_SELF ?>">
				<div class="col-xs-12 padd0 ndEco">
					<div class="mgLeftPart" style="display:none;">
						<div id="datetimepicker2" class="input-append date npDivWidth1">
							<select name="subscriptionstype" class="form-control" onchange='this.form.submit();'>
								<option value="ALL" <?php if ($_POST['subscriptionstype'] == 'ALL') echo 'selected="selected"'; ?> >All Subscriptions</option>
								<option value="FREE" <?php if ($_POST['subscriptionstype'] == 'FREE') echo 'selected="selected"'; ?> >Free</option>
								<option value="PAID" <?php if ($_POST['subscriptionstype'] == 'PAID') echo 'selected="selected"'; ?>>Paid</option> 
							</select>
						</div>

						<form class="goBtnForm1">
							<!--<a href="#"><img src="img/analytics/xlsx_icon.png" alt="xlsx Icon" /></a>-->
						</form>
					</div>
				</div>
				
				
				<div class="col-xs-12 padd0">
					<div class="table-responsive">
						<table class="table aTable1 abTable1">
							<thead>
								<tr>
									<th>#</th>
									<th>TITLE</th>
									<th>PUBLISHERS</th>
									<th style="width:132px;">CDP ALLOTMENT</th>
									<th>SUBSCRIPTIONS</th>
									<th style="width:110px;" colspan="2">VIEW DETAILS</th>
								</tr>
							</thead>
							<tbody>
							  <!-- Code start for get the all books subscriptions --> 
							 <?php 
							 
							    // Check if the form was submitted
								if (isset($_POST['subscriptionstype']))
								{
								   $subscriptionstypeval= $_POST['subscriptionstype'];
								}
							
							   include "../cs/config.php";
							   $run = mysqli_query($db,"call sp_get_books_analytics('','".$_COOKIE['useremailid']."','','','','',
							   '','A','','','','','','','$subscriptionstypeval','','','','','','GET_BOOKS_SUBSCRIPTIONS_LIST')") or die('Query Not execute'.mysqli_error($db));
							    $db->close();
							   if(mysqli_num_rows($run)>0)
						       {
							      $i=1;
								  while ($row = mysqli_fetch_array($run))
								  {
								    $bookid = $row['id'];
								    $booktitle = $row['title'];
									$publication = $row['publication'];
									
									// $price = $row['price'];
									// if($price=="" || $price=="0" || $price=="(NULL)" || $price=="NULL")
									// {
									   // $price = 'Free';
									// }
									// else
									// {
									   // $price = $price." (INR)";
									// }
									
									 // include "../cs/config.php";
									 // $pub_ds = mysqli_query($db,"call sp_get_books_analytics('','".$_COOKIE['useremailid']."','','".$bookid."','','','','A','','','','','','','','','','','','',
							         // 'GET_COUNT_BOOK_ALL_SUBSCRIPTIONS')") or die('Query Not execute'.mysqli_error($db));
									 // $db->close();
									 // $totalsubscriptions= mysqli_num_rows($pub_ds);
									 // mysqli_free_result($pub_ds);
									 
									 include "../cs/config.php";
									 $pub_dsfree = mysqli_query($db,"call sp_get_books_analytics('','".$_COOKIE['useremailid']."','','".$bookid."','','','','A','','','','','','','GROUP','','','','','',
							         'GET_SUBSCRIPTIONS_PER_BOOK')") or die('Query Not execute'.mysqli_error($db));
									 $db->close();
									 $totalfreesubscriptions= mysqli_num_rows($pub_dsfree);
									 mysqli_free_result($pub_dsfree);
									 
									 include "../cs/config.php";
									 $pub_dspaid = mysqli_query($db,"call sp_get_books_analytics('','".$_COOKIE['useremailid']."','','".$bookid."','','','','A','','','','','','','PAYMENT','','','','','',
							         'GET_SUBSCRIPTIONS_PER_BOOK')") or die('Query Not execute'.mysqli_error($db));
									 $db->close();
									 $totalpaidsubscriptions= mysqli_num_rows($pub_dspaid);
									 mysqli_free_result($pub_dspaid);

									 $Analytics_Subswise_URL=$SiteURL.'analytics/analytics_subs_wise.php?bookid='.$bookid.'';
									 //$Analytics_Subswise_URL="#";
									 
									  echo "<tr>
										<td>$i</td>
										<td>$booktitle</td>
										<td>$publication</td>
										<td>$totalfreesubscriptions</td>
										<td>$totalpaidsubscriptions</td>
										<td><a href='$Analytics_Subswise_URL' target='_blank'><img src='img/analytics/eye.png' alt='Eye Icon' class='img-responsive' /></a></td>
										<td style='display:none;'><img src='img/analytics/xlsx_icon.png' alt='xlsx Icon' class='img-responsive' /></td>
									 </tr>";
									  $i=$i+1;
								   }
								   mysqli_free_result($run);
								   echo "<input type = 'hidden' name = 'body' value = '<?php echo $booktitle; ?>'>"; 
							   }
							  
							  ?>
							 <!-- Code end for get the all books subscriptions --> 
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
		
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="../js/jasny-bootstrap.min.js"></script>
		<script src="../js/index.js"></script>
	
</body>
</html>
<?php ob_end_flush(); ?>