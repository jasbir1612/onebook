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
							<div class="mBooksTxt">Professional Accounting <span class="xsmBooksTxt">(Gautama Publications)</div>
							<ul class="list-inline">
								<li><a href="#">Monthwise</a></li>
								<li><a href="#">Subscribers</a></li>
							</ul>
						</div>
					</div>
					<div class="pull-right">
						<form class="mtop19">
							<button type="button" class="btn ndBtn1 btn-default"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</button>
						</form>
					</div>
				</div>
				<div class="col-xs-12 padd0 ndEco">
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
				
				<div class="col-xs-12 padd0">
					<div class="table-responsive">
						<table class="table aTable1">
							<thead>
								<tr>
									<th>#</th>
									<th>TITLE</th>
									<th>PUBLISHERS</th>
									<th>LISTING PRICE</th>
									<th>TOTAL SALES</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>Sunil Singh</td>
									<td>sunil312@gmail.com</td>
									<td>2</td>
									<td>5</td>
									
								</tr>
								<tr>
									<td>2</td>
									<td>Deepak Bora</td>
									<td>dBora8986@gmail.com</td>
									<td>1</td>
									<td>6</td>
									
								</tr>
								<tr>
									<td>3</td>
									<td>Divya Verma</td>
									<td>vermaji902@gmail.com</td>
									<td>3</td>
									<td>1</td>
									
								</tr>
								<tr>
									<td>4</td>
									<td>Mayank Yadav</td>
									<td>mkyadav454@gmail.com</td>
									<td>1</td>
									<td>3</td>
									
								</tr>
								<tr>
									<td>5</td>
									<td>Sunil Singh</td>
									<td>sunil312@gmail.com</td>
									<td>2</td>
									<td>5</td>
									
								</tr>
								<tr>
									<td>6</td>
									<td>Deepak Bora</td>
									<td>dBora8986@gmail.com</td>
									<td>1</td>
									<td>6</td>
									
								</tr>
								<tr>
									<td>7</td>
									<td>Divya Verma</td>
									<td>vermaji902@gmail.com</td>
									<td>3</td>
									<td>1</td>
									
								</tr>
								<tr>
									<td>8</td>
									<td>Mayank Yadav</td>
									<td>mkyadav454@gmail.com</td>
									<td>1</td>
									<td>3</td>
									
								</tr>
								<tr>
									<td>9</td>
									<td>Sunil Singh</td>
									<td>sunil312@gmail.com</td>
									<td>2</td>
									<td>5</td>
									
								</tr>
								<tr>
									<td>10</td>
									<td>Deepak Bora</td>
									<td>dBora8986@gmail.com</td>
									<td>1</td>
									<td>6</td>
									
								</tr>
								<tr>
									<td>11</td>
									<td>Divya Verma</td>
									<td>vermaji902@gmail.com</td>
									<td>3</td>
									<td>1</td>
									
								</tr>
								<tr>
									<td>12</td>
									<td>Mayank Yadav</td>
									<td>mkyadav454@gmail.com</td>
									<td>1</td>
									<td>3</td>
									
								</tr>
								<tr>
									<td>13</td>
									<td>Sunil Singh</td>
									<td>sunil312@gmail.com</td>
									<td>2</td>
									<td>5</td>
									
								</tr>
								<tr>
									<td>14</td>
									<td>Deepak Bora</td>
									<td>dBora8986@gmail.com</td>
									<td>1</td>
									<td>6</td>
									
								</tr>
								<tr>
									<td>15</td>
									<td>Divya Verma</td>
									<td>vermaji902@gmail.com</td>
									<td>3</td>
									<td>1</td>
									
								</tr>
								<tr>
									<td>16</td>
									<td>Mayank Yadav</td>
									<td>mkyadav454@gmail.com</td>
									<td>1</td>
									<td>3</td>
									
								</tr>
							</tbody>
						</table>
					</div>
				</div>
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