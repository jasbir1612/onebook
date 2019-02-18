<!DOCTYPE html>
<?php ob_start(); ?>
<?php require_once "cs/config.php"; ?>
<html lang="en">
	<head>
		<title>1Book</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
		<link rel="shortcut icon" href="<?php echo $SiteURL;?>img/fevicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="css/invoice.css">
		
		<?php
		if(isset($_COOKIE['useremailid']))
		{
		  if(isset($_GET['bookid']) && count($_GET) > 0 ) 
		  {
		     $BNId = mysqli_real_escape_string($db,$_GET['bookid']);
			 $UserId = $_GET['userid'];
			 $UserEmailId = $_GET['useremailid'];
			 
			  include "cs/config.php";
			  $qryds = mysqli_query($db,"call sp_get_common_data('".$UserId."','','".$BNId."','','','','','A','','','','','','','','','','GET_USER_INVOICE')") 
			  or die('Query Not execute'.mysqli_error($db));
			  $db->close();
			  if(mysqli_num_rows($qryds)>0)
			  {
				  while ($row = mysqli_fetch_array($qryds))
				  {
				     $SubscriberName = $row['first_name'];
				     $BookNotesName = $row['title'];
					 $OrderID = $row['order_id'];
					 $OrderDate = $row['order_date'];
					 $OrderDateArr = explode(" ", $OrderDate);
					 if(count($OrderDateArr) >0)
					 {
					   $OrderDateVal=$OrderDateArr[0].'-'.$OrderDateArr[1].', '.$OrderDateArr[2].'; '.$OrderDateArr[3].' '.$OrderDateArr[4];
					 }
					 else
					 {
					    $OrderDateVal=$OrderDate;
					 }
					
                     $PriceVal=$row['price'];
					 if($PriceVal=="" || $PriceVal=="0" || $PriceVal=="(NULL)" || $PriceVal=="NULL")
				     {
					    $PriceVal = "0";
					    $PriceVal = "<i class='fa fa-inr' aria-hidden='true'></i>&nbsp; $PriceVal";
				     }
				     else
				     {
					   $PriceVal = "<i class='fa fa-inr' aria-hidden='true'></i>&nbsp; $PriceVal";
				     }
					 $AuthorName = $row['author'];
					 if($AuthorName=="" || $AuthorName=="(NULL)" || $AuthorName=="NULL")
				     {
					   $AuthorName="NA";
					 }
					 $PublicationName = $row['publication'];
					 if($PublicationName=="" || $PublicationName=="(NULL)" || $PublicationName=="NULL")
				     {
					   $PublicationName="NA";
					 }
					 $Print_isbnName = $row['print_isbn'];
					 if($Print_isbnName=="" || $Print_isbnName=="(NULL)" || $Print_isbnName=="NULL")
				     {
					   $Print_isbnName="NA";
					 }
					 $Etext_isbnName = $row['etext_isbn'];
					 if($Etext_isbnName=="" || $Etext_isbnName=="(NULL)" || $Etext_isbnName=="NULL")
				     {
					   $Etext_isbnName="NA";
					 }
				  }
			   }
			  mysqli_free_result($qryds);
		   }
		}
		else
		{
			$WebSite_URL="location:".$SiteURL;
			header($WebSite_URL);
		}
		?>
	</head>
	<body>
		<div class="mainCont">
		    <h1 class="header1"><a title="1Book" href="<?php echo $SiteURL;?>"><img src="<?php echo $SiteURL;?>img/homePage/logo.svg" alt="1Book Logo" /></a></h1>
			<h1 class="header1">Thank you for your order!</h1>
			<div class="invoiceTab">
				<div class="invoiceTabCellL">
					<p class="invoiceTxt">Your order is complete. If you need a receipt, you can print this page. You will also receive  a confirmation message with this information at <span class="clrBlue"><?php echo $UserEmailId; ?></span></p>
					<p class="invoiceTxt">Payment through Credit Card, Debit Card, Net Banking or UPI</p>
				</div>
				<div class="invoiceTabCellR">
				    <p class="invoiceP1">Subscriber:</p>
					<p class="invoiceP2"><?php echo $SubscriberName; ?></p>
					<p class="invoiceP1">Order Number:</p>
					<p class="invoiceP2"><?php echo $OrderID; ?></p>
					<p class="invoiceP1">Order Date:</p>
					<p class="invoiceP2a"><?php echo $OrderDateVal; ?></p>
				</div>
			</div>
			<h3 class="header1">Order Information</h3>
			<div class="table-responsive">
				<table class="table table-bordered invoiceTab1">
					<thead>
						<tr>
							<th>Quantity</th>
							<th>Description</th>
							<th>Item Price</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td><?php echo $BookNotesName; ?>
							<br><span class="clrGrey">Author(s): <?php echo $AuthorName; ?></span>
							<br><span class="clrGrey">Publisher: <?php echo $PublicationName; ?></span>
							<br><span class="clrGrey">Print ISBN: <?php echo $Print_isbnName; ?></span>
							<br><span class="clrGrey">eText ISBN: <?php echo $Etext_isbnName; ?></span>
							</td>
							<td><?php echo $PriceVal; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="tabWid">
				<div class="totTab1">
					<div class="totTab1Cell">Subtotal</div>
					<div class="totTab1Cell text-right"><?php echo $PriceVal; ?></div>
				</div>
				<div class="totTab2">
					<div class="totTab1Cell">Total</div>
					<div class="totTab1Cell text-right"><?php echo $PriceVal; ?></div>
				</div>
			</div>
			<!--<div class="invoiceDash"><a href="#">Go to Dashboard</a></div>-->
		</div>
	</body>
</html>
<?php ob_end_flush(); ?>