<!DOCTYPE html>
<?php ob_start(); ?>
<?php include "cs/config.php"; 

// echo '>>>>>>>>>>>>' .realpath('gall_content/');
// echo  '<br>';
// echo '>>>>>>>>>>>>' .getcwd();
// echo  '<br>';
// echo '>>>>>>>>>>>>' .$_SERVER['DOCUMENT_ROOT'];
// echo  '<br>';
// echo '>>>>>>>>>>>>' .$root = realpath($_SERVER["DOCUMENT_ROOT"]);

?>
<html lang="en">
	<head>
		<title>1Book</title>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
		<link rel="shortcut icon" href="<?php echo $SiteURL;?>img/fevicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="css/jasny-bootstrap.min.css">
		<link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" href="css/manageBooks.css">
		<link rel="stylesheet" href="css/responsive.css">
		<?php
			require_once "cs/common.php";
		?>
		<!-- function start for add the dymanic rows  -->
		<script language="javascript" type="text/javascript">
		function addRow(tableID) {

			var DivID = document.getElementById(tableID);
			var ADDDiv = document.getElementById(tableID).innerHTML;
			//alert(ADDDiv);
			var ADDDivNew = "<div class='col-xs-4 padd05'><form class='mblegend1'><fieldset>						<legend>Subscription 1</legend><div class='form-group'><label class='control-label col-sm-4 padd0 text-right' for='mbForm15'>No. of Days</label><div class='col-sm-8 paddR0'>												<select class='form-control' id='mbForm15'>													<option>--Select--</option><option>1</option>												<option>2</option><option>3</option><option>4</option>												</select></div></div><div class='form-group'><label class='control-label col-sm-4 padd0 text-right' for='mbForm16'>Price(In Rs.)</label><div class='col-sm-8 paddR0'>												<input type='text' class='form-control' id='mbForm16'></div>										</div></fieldset></form></div>";

			ADDDiv +=ADDDivNew;

			DivID.innerHTML =ADDDiv;						
			//var rowCount = table.rows.length;
			//var row = table.insertRow(rowCount);
			//var colCount = table.rows[0].cells.length;
			
			//for(var i=0; i<colCount; i++) {
				//var newcell	= row.insertCell(i);
				//newcell.innerHTML = table.rows[0].cells[i].innerHTML;
			//}
            
			
			//document.getElementById("tablerowcount").value = rowCount;
			//document.getElementById("tablecolumncount").value = colCount;
		}
	  </script>
	  <!-- function end for add the dymanic rows  -->

	    <!-- validation start for books/notes  -->
		<script language="javascript" type="text/javascript">
		function book_validation()
		{
			//var fm = document.form1;
			//if ((fm.mbOptradio1[0].checked == false) && (fm.mbOptradio1[1].checked == false)) 
			//{
			//alert("please choose Books or Notes"); 
			//return false;
			//}
			
			//var rates = document.getElementsByName('mbOptradio1');
			//var rate_value;
			//for(var i = 0; i < rates.length; i++){
				//if(rates[i].checked){
					//rate_value = rates[i].value;
					//document.getElementsByName('hdn_book_type').value = rate_value;
				//}
			//}

			//if(fm.mbForm1title.value=="")
			//{
			//alert("please enter title");
			//fm.mbForm1title.focus();
			//return false;
			//}
			//if(fm.mbForm1publication.value=="")
			//{
			//alert("please enter publisher");
			//fm.mbForm1publication.focus();
			//return false;
			//}
			//if(fm.mbForm2author.value=="")
			//{
			//alert("please enter author");
			//fm.mbForm2author.focus();
			//return false;
			//}
			//var ddlcourse = document.getElementById("mbForm3course");
			//if(ddlcourse.value=="--Select--")
			//{
			//alert("please select any course");
			//return false;
			//}
			//if(fm.mbForm4edition.value=="")
			//{
			//alert("please enter edition");
			//fm.mbForm4edition.focus();
			//return false;
			//}
			//var ddlsubject = document.getElementById("mbForm5subject")
			//if(ddlsubject.value=="--Select--")
			//{
			//alert("please select any subject");
			//return false;
			//}
			//if(fm.mbForm6validfor.value=="")
			//{
			//alert("please enter attempt valid for");
			//fm.mbForm6validfor.focus();
			//return false;
			//}
			//if(fm.mbForm7pages.value=="")
			//{
			//alert("please enter page no");
			//fm.mbForm7pages.focus();
			//return false;
			//}
			//if(fm.mbForm8printisbn.value=="")
			//{
			//alert("please enter print isbn");
			//fm.mbForm8printisbn.focus();
			//return false;
			//}
			//if(fm.mbForm9etextisbn.value=="")
			//{
			//alert("please enter etext isbn");
			//fm.mbForm9etextisbn.focus();
			//return false;
			//}
			//if(fm.mbForm10desc.value=="")
			//{
			//alert("please enter description");
			//fm.mbForm10desc.focus();
			//return false;
			//}
			//var pdffileval = document.getElementById("pdffile")
			//if(pdffileval.value=="")
			//{
			//alert("please upload pdf file");
			//return false;
			//}
		}
		</script>
        <!-- validation end for books/notes  -->
		
		<!-- functions start for enable/disable the subscription part  -->
		<script language="javascript" type="text/javascript">
		function disable() {
			document.getElementById("subscriptiontype1").disabled=true;
			document.getElementById("subscriptionprice1").disabled=true;
			document.getElementById("subscriptiontype2").disabled=true;
			document.getElementById("subscriptionprice2").disabled=true;
			document.getElementById("subscriptiontype3").disabled=true;
			document.getElementById("subscriptionprice3").disabled=true;
			document.getElementById("txtprice").disabled=true;
			document.getElementById("txtprice").value="0";
			document.getElementById("addmoresubscription").style.display='none';
		}
		function enable() {
			document.getElementById("subscriptiontype1").disabled=false;
			document.getElementById("subscriptionprice1").disabled=false;
			document.getElementById("subscriptiontype2").disabled=false;
			document.getElementById("subscriptionprice2").disabled=false;
			document.getElementById("subscriptiontype3").disabled=false;
			document.getElementById("subscriptionprice3").disabled=false;
			document.getElementById("txtprice").disabled=false;
			document.getElementById("addmoresubscription").style.display='block';
		}
     </script>
	 <!-- functions end for enable/disable the subscription part  -->

	   <!-- Code start for get books/notes details -->
		<?php
			//session_start();
			include "cs/config.php";
			$bookid=$_REQUEST['bookid'];
			if(isset($_COOKIE['useremailid']))
			{
				$qrygetds = mysqli_query($db,"call sp_get_common_data('','','".$bookid."','','','','','A','','','','','','','','','','GET_BOOKNOTES')") or die('Query Not execute'.mysqli_error($db));
		        $db->close();
				if(mysqli_num_rows($qrygetds)>0)
				{
					while($row = mysqli_fetch_array($qrygetds))
					{
						$book_title_get=$row['title'];
						$book_topic_get=$row['topic'];
						$book_publisher_get=$row['publication'];
						$book_author_get=$row['author'];
						$book_edition_get=$row['edition'];
						$book_attemptvalidfor_get=$row['attempt_valid_for'];
						$book_pages_get=$row['pages'];
						$book_printisbn_get=$row['print_isbn'];
						$book_etextisbn_get=$row['etext_isbn'];
						$book_desc_get=$row['description'];
						$hdncourseid=$row['course_id'];
						$hdnsubjectid=$row['category_id'];
						$hdnpdffile=$row['file'];
						$hdnthumbimg=$row['thumb_img'];
						$hdnlargeimg=$row['large_img'];
						$hdnbooktype=$row['book_type'];
						if($hdnthumbimg!="")
						{
						  $thumbimgpath=returnthbimage($hdnthumbimg);
						  $thumbimgpath=$S3URL.$thumbimgpath;
						}
						else
						{
						   $thumbimgpath=$SiteURL.$DefaultThumbPath;
						}
						$availability=$row['availability'];
						$meta_keyword_get=$row['meta_keywords'];
						$meta_desc_get=$row['meta_description'];
						$book_price_get=$row['price'];
					}
					mysqli_free_result($qrygetds);
				}
			}
			?>
	   <!-- Code end for get books/notes details -->
	   
	   <!-- Code start for update books/notes  -->
        <?php
		include "cs/config.php";
		include "cs/uploadgallery.php";
		if(isset($_COOKIE['useremailid']))
		{
			if (isset($_POST['submit']))
			{
			    $msgerror = "false";
			    $book_status='A';
				$book_active='A';
				$book_access='A';
				$book_process='T';
				
				$bookid=$_REQUEST['bookid'];
				$book_title = mysqli_real_escape_string($db,$_POST['mbForm1title']);
				$book_topic = mysqli_real_escape_string($db,$_POST['mbForm1topic']);
				$book_author = mysqli_real_escape_string($db,$_POST['mbForm2author']);
				$book_publication = mysqli_real_escape_string($db,$_POST['mbForm1publication']);
				$book_course = mysqli_real_escape_string($db,$_POST['mbForm3course']);

				// $foldername="gall_content/";
				// $upload_folder=uploadgall($foldername)."/";
				// $upload_filenm="coverimg";
				// $thumgimg=homeuploadfile($upload_filenm,$upload_folder);
				// $upload_pdf="pdffile";
				// $pdffilename=Singleuploadfile($upload_pdf,$upload_folder);
				// $book_thumb= $thumgimg;
				// $book_large= $thumgimg;
				// $book_file = $pdffilename;
				
				include('cs/s3_config.php');
				$str1=date(Y)."-".date(m)."-".date(d);
				$randomstring=randomAlphaNum(5);
				$sysdate= date(d);
				$sysmonth= date(m);
				$sysyear= date(Y);
				$folderyr = $strfoldername.$sysyear;
				$foldermn = $folderyr."/".$sysmonth;
				$folderdy = $foldermn."/".$sysdate;
				
				include('cs/image_check.php');
			    $msg='';
				$name = $_FILES['coverimg']['name'];
				$size = $_FILES['coverimg']['size'];
				$tmp = $_FILES['coverimg']['tmp_name'];
				if(strlen($name) > 0)
                {
					$ext = getExtension($name);
					if(in_array($ext,$valid_image_formats))
					{
						// $book_thumb=$str1."~".$randomstring.".".$ext;
						// $FolderThumbImgPath = "gall_content/$folderdy/$book_thumb";
						// if($s3->putObjectFile($tmp, $bucket , $FolderThumbImgPath, S3::ACL_PUBLIC_READ) )
						// {
							// //echo $msg = "S3 Upload Successful.";	
						// }
						$foldername="gall_content/";
						$upload_folder=uploadgall($foldername)."/";
						$upload_filenm="coverimg";
						$thumgimg=homeuploadfile($upload_filenm,$upload_folder);

						$book_thumb=$thumgimg;
						$book_large= str_replace("thumb","large",$book_thumb);
						$FolderThumbImgPath = "gall_content/$folderdy/$book_thumb";
						$FolderLargeImgPath = "gall_content/$folderdy/$book_large";
						$tmpthumb= realpath($FolderThumbImgPath);
						$tmplarge= realpath($FolderLargeImgPath);
						if($s3->putObjectFile($tmpthumb, $bucket , $FolderThumbImgPath, S3::ACL_PUBLIC_READ) )
						{
							// $msg = "S3 Upload Successful.";	
						}
						if($s3->putObjectFile($tmplarge, $bucket , $FolderLargeImgPath, S3::ACL_PUBLIC_READ) )
						{
							// $msg = "S3 Upload Successful.";	
						}
						// unlink($tmpthumb);
						// unlink($tmplarge);
					}
					else
					{
					  $msgerror = "true";
					  echo "<script>alert('Invalid file, please upload image file.')</script>";
					}
				}
				else
				{
				   $book_thumb = mysqli_real_escape_string($db,$_POST['hdn_thumbimg']);
				   //echo "<br>";
				   $book_large = mysqli_real_escape_string($db,$_POST['hdn_largeimg']);
				}
				
				$pdfname = $_FILES['file_name']['name'];
				$pdfsize = $_FILES['file_name']['size'];
				$pdftmp = $_FILES['file_name']['tmp_name'];
				if(strlen($pdfname) > 0)
                {
					$pdfext = getExtension($pdfname);
					if(in_array($pdfext,$valid_pdf_formats))
					{
						$book_file=$str1."~".$randomstring.".".$pdfext;
						$FolderPdfPath = "gall_content/$folderdy/$book_file";
						if($s3->putObjectFile($pdftmp, $bucket , $FolderPdfPath, S3::ACL_PUBLIC_READ) )
						{
							//echo $msg = "S3 Upload Successful.";	
						}
						
						include "cs/config.php";
						$qrygetbnp = mysqli_query($db,"call sp_get_common_data('','','".$bookid."','','','','','A','','','','','','','','','','COUNT_NO_OF_BOOKPARTS')") or die('Query Not execute'.mysqli_error($db));
						$db->close();
						if(mysqli_num_rows($qrygetbnp)>0)
						{
						  $book_process='R';
						}
						else
						{
						  $book_process='F';
						}
						mysqli_free_result($qrygetbnp);
					}
					else
					{
					  $msgerror = "true";
					  echo "<script>alert('Invalid file, please upload pdf file.')</script>";
					}
				}
				else
				{
				   $book_file = mysqli_real_escape_string($db,$_POST['hdn_pdf_file']);
				}
				
				$userid=$_COOKIE['useremailid'];
				$availability_val = mysqli_real_escape_string($db,$_POST['mbOptradio2']);
				$book_edition = mysqli_real_escape_string($db,$_POST['mbForm4edition']);
				$book_subject = mysqli_real_escape_string($db,$_POST['mbForm5subject']);
				$book_validfor = mysqli_real_escape_string($db,$_POST['mbForm6validfor']);
				$book_pages = mysqli_real_escape_string($db,$_POST['mbForm7pages']);
				$book_printisbn = mysqli_real_escape_string($db,$_POST['mbForm8printisbn']);
				$book_etextisbn = mysqli_real_escape_string($db,$_POST['mbForm9etextisbn']);
				$book_desc = mysqli_real_escape_string($db,$_POST['mbForm10desc']);
				//$book_desc= str_replace("'", "''", $book_desc);
				$book_type = mysqli_real_escape_string($db,$_POST['hdn_book_type']);
				$book_type = $_POST['mbOptradio1'];
				$meta_keyword = mysqli_real_escape_string($db,$_POST['mbForm10metakey']);
				$meta_desc = mysqli_real_escape_string($db,$_POST['mbForm10metadesc']);
				$book_price = mysqli_real_escape_string($db,$_POST['txtprice']);
				if($book_price=="")
				{
				   $book_price = '0';
				}
				$book_partval="1"; 
				
				if ($msgerror=="false") 
				{
				    //Echo 'Catttttttttttt>>>>>>>>>>>>>>>>>>>'  . $book_subject;
				    include "cs/config.php";
					$resultds = mysqli_query($db,"call sp_insert_booknotes('".$bookid."','".$book_subject."','".$book_course."','".$book_title."','".$book_desc."','".$book_topic."','".$book_publication."','".$book_author."','".$book_edition."','".$book_pages."','".$book_validfor."','".$availability_val."','".$book_printisbn."','".$book_etextisbn."','".$book_thumb."','".$book_large."','".$book_file."','".$book_status."','".$book_active."','".$book_access."','".$book_process."','".$userid."','".$userid."','".$meta_keyword."','".$meta_desc."','".$book_price."','".$book_type."','".$book_partval."','UPDATE_BOOKNOTES',@resultmsg,@errormsg)") or die('Query Not execute'.mysqli_error($db));
					$db->close();
					if (mysqli_num_rows($resultds) > 0) {
					 while($row = mysqli_fetch_array($resultds)) {
						 $result= $row['resultval'];
						 $IsError= $row['IsErrorval'];
					 }
					  mysqli_free_result($resultds);
					}
					
					if ($result=="UPDATE")
					{
					   echo "<script>alert('Book/Notes Updated Successfully.')</script>"; 
					}
				}
			}
		}
	    else
		{
			$WebSite_URL="location:".$SiteURL;
			header($WebSite_URL);
		}
       ?>
	   
	   <!-- Code end for update books/notes  -->
	</head>
	<body>
		<div class="mainWrap">
			 <!-- Dashboard Start Here -->
			 <?php include_once('dashboard.php');?>
			 <!-- Dashboard End Here -->

			<div class="container wrapMB">
				<div class="col-xs-12 padd0 mbHeadDiv">
					<div class="pull-left">
						<img src="img/readerIcons/bookshelf_big.png" alt="Bookshelf Logo" class="img-responsive mbBshelf"/>
						<div class="mbManage">
							<div class="mBooksTxt">Update Books/Notes</div>
							<ul class="list-inline">
								<!--<li><a href="#">Books</a></li>
								<li><a href="#">Notes</a></li>-->
								<li><a href="<?php echo $SiteURL;?>manageBooks.html">Upload Content</a></li>
							</ul>
						</div>
					</div>
					<div class="pull-right">
						<form class="mtop19">
							<?php
								  $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
								  echo "<a class='btn ndBtn2 btn-default' href='$url'><i class='fa fa-angle-left' aria-hidden='true'></i> Back</a>"; 
							?>
							<!--<label class="radio-inline">
							<input type="radio" name="mbOptradio1" id="mbOptradio1" value="BOOK" onClick="document.form1.hdn_book_type.value = this.value">Books
							</label>
							<label class="radio-inline">
							<input type="radio" name="mbOptradio1" id="mbOptradio1"  value="NOTES" checked="checked" onClick="document.form1.hdn_book_type.value = this.value">Notes
							</label>-->
						</form>
					</div>
				</div>
				<div class="col-xs-12 padd0">
				<form method="post" id="form1" name="form1" enctype="multipart/form-data" action="<?php $_PHP_SELF ?>" class="form-horizontal horizontalForm">
					<div class="col-xs-3 paddL0">
						<div class="fileinput fileinput-new" data-provides="fileinput" style="width:100%;">
						    <div class="fileinput-new thumbnail" style="width: 100%; height: 225px; position: relative;">
							   <?php
								if($thumbimgpath!="")
								{
								?>
								    <img src='<?php echo $thumbimgpath; ?>' style='max-height: 215px;' />
								<?php
								}
								?>
							</div>
							<div class="fileinput-new thumbnail" style="width: 100%; height: 225px; position: relative; display:none;">
								<div class="uploadTxt">
									<div>Upload Note</div>
									<div>Cover Image</div>
								</div>
							</div>
							<div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 225px; width:100%">
							</div>
							<div class="text-center">
								<span class="btn btn-default btn-file uploadBtn1">
									<span class="fileinput-new">Change Cover Image</span>
									<span class="fileinput-exists">Change</span>
									<input type="file" name="coverimg" id="coverimg" form="form1" />
									</span>
								<a href="#" class="btn btn-default fileinput-exists uploadBtn1" data-dismiss="fileinput">Remove</a>
							</div>
							<div class="text-center">
								<!--<span class="btn btn-default btn-file uploadBtn1">
									<span class="fileinput-new">Upload File</span>
									<span class="fileinput-exists">Change</span>
									<input type="file" name="pdffile" id="pdffile" form="form1" />
									</span>
								<a href="#" class="btn btn-default fileinput-exists uploadBtn1" data-dismiss="fileinput">Remove</a>
								 <input type="file" name="pdffile" id="pdffile" form="form1" accept=".pdf" />-->
							</div>
						</div>
					</div>
					<div class="col-xs-9 paddR0">
						
						    <div class="form-group">
							<label class="control-label col-sm-2 padd0" for="mbForm1"></label>
								<div class="col-sm-10 paddR0">
								  <input type="radio" name="mbOptradio1" id="mbOptradio1" value="BOOK" onClick="document.form1.hdn_book_type.value = this.value" onchange="this.form.submit()"
  <?php if(isset($_POST['mbOptradio1'])){ if($_POST['mbOptradio1'] == 'BOOK') {echo "checked";}} ?> <?php if($hdnbooktype=="BOOK"){echo 'checked=checked';} ?> disabled='disabled'>&nbsp;&nbsp;Books&nbsp;&nbsp;&nbsp;
								  <input type="radio" name="mbOptradio1" id="mbOptradio1" value="NOTES" onClick="document.form1.hdn_book_type.value = this.value" onchange="this.form.submit()"
  <?php if(isset($_POST['mbOptradio1'])){ if($_POST['mbOptradio1'] == 'NOTES') {echo "checked";}} ?> <?php if($hdnbooktype=="NOTES"){echo 'checked=checked';} ?> disabled='disabled'>&nbsp;&nbsp;Notes
							  </div>
						    </div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm1">Title</label>
								<div class="col-sm-10 paddR0">
									<input type="text" class="form-control" id="mbForm1title" name="mbForm1title" value="<?php echo $book_title_get; ?>">
								</div>
							</div>
							<div class="form-group" style='display:none;'>
								<label class="control-label col-sm-2 padd0" for="mbForm1">Topic</label>
								<div class="col-sm-10 paddR0">
									<input type="text" class="form-control" id="mbForm1topic" name="mbForm1topic" value="<?php echo $book_topic_get; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm1">Publisher</label>
								<div class="col-sm-10 paddR0">
									<input type="text" class="form-control" id="mbForm1publication" name="mbForm1publication" value="<?php echo $book_publisher_get; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm2">Author</label>
								<div class="col-sm-4 paddR0">
									<input type="text" class="form-control" id="mbForm2author" name="mbForm2author" value="<?php echo $book_author_get; ?>">
								</div>
								<label class="control-label col-sm-2 padd0" for="mbForm3">Course</label>
								<div class="col-sm-4 paddR0">
									<select class="form-control" id="mbForm3course" name="mbForm3course">
									 <!-- Code start for bind the cource  -->
										 <?php				
											include "cs/config.php";
											$result_state = $db->query("call sp_get_admin_common('GETALLCOURSE')");
											$db->close();
											$total=0;
											if(!($total= $result_state->num_rows)==0)
											{
										    ?><option selected='selected'>--Select--</option> <?php 
											while($rowdist = $result_state->fetch_array()) 
											{
										     ?>  
												<option value="<?php echo $rowdist['course_id']; ?>" <?php if($hdncourseid==$rowdist['course_id']){echo 'selected=selected';} ?> ><?php echo  $rowdist['course_name']; ?></option>
											  <?php 
											}
										    }
										  ?>
										   <!-- Code end for bind the cource  -->
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm4">Edition</label>
								<div class="col-sm-4 paddR0">
									<input type="text" class="form-control" id="mbForm4edition" name="mbForm4edition" value="<?php echo $book_edition_get; ?>">
								</div>
								<label class="control-label col-sm-2 padd0" for="mbForm5">Subject</label>
								<div class="col-sm-4 paddR0">
									<select class="form-control" id="mbForm5subject" name="mbForm5subject">
									  <!-- Code start for bind the subject  -->
										 <?php				
											include "cs/config.php";
											$result_state = $db->query("call sp_get_admin_common('GETALLSUBJECT')");
											$db->close();
											$total=0;
											if(!($total= $result_state->num_rows)==0)
											{
										    ?><option selected='selected'>--Select--</option> <?php 
											while($rowdist = $result_state->fetch_array()) 
											{
										     ?>  
												<option value="<?php echo $rowdist['category_id']; ?>" <?php if($hdnsubjectid==$rowdist['category_id']){echo 'selected=selected';} ?>><?php echo  $rowdist['category_name']; ?></option>
											  <?php 
											}
										    }
										  ?>
										   <!-- Code end for bind the subject  -->
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm6">Attempt valid for</label>
								<div class="col-sm-4 paddR0">
									<input type="text" class="form-control" id="mbForm6validfor" name="mbForm6validfor"
									value="<?php echo $book_attemptvalidfor_get; ?>">
								</div>
								<label class="control-label col-sm-2 padd0" for="mbForm8">Print ISBN</label>
								<div class="col-sm-4 paddR0">
									<input type="text" class="form-control" id="mbForm8printisbn" name="mbForm8printisbn" value="<?php echo $book_printisbn_get; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm7" style="display:none;">Pages</label>
								<div class="col-sm-4 paddR0" style="display:none;">
									<input type="text" class="form-control" id="mbForm7pages" name="mbForm7pages" value="<?php echo $book_pages_get; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
								</div>
								<label class="control-label col-sm-2 padd0" for="mbForm9" style="display:none;">eText ISBN</label>
								<div class="col-sm-4 paddR0" style="display:none;">
									<input type="text" class="form-control" id="mbForm9etextisbn" name="mbForm9etextisbn" value="<?php echo $book_etextisbn_get; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm10">Description</label>
								<div class="col-sm-10 paddR0">
									<textarea class="form-control txtarea" rows="5" id="mbForm10desc" name="mbForm10desc"><?php echo $book_desc_get; ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm10">Meta Keywords</label>
								<div class="col-sm-10 paddR0">
									<textarea class="form-control txtarea" rows="2" id="mbForm10metakey" name="mbForm10metakey"><?php echo $meta_keyword_get; ?></textarea>
								</div>
							</div>
							<div class="form-group" style="display:none;">
								<label class="control-label col-sm-2 padd0" for="mbForm10">Meta Description</label>
								<div class="col-sm-10 paddR0">
									<textarea class="form-control txtarea" rows="2" id="mbForm10metadesc" name="mbForm10metadesc"><?php echo $meta_desc_get; ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm10">Price</label>
								<div class="col-sm-4 paddR0">
									<input type="text" class="form-control" id="txtprice" name="txtprice" value="<?php echo $book_price_get; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' onchange='return bookMsgHide("bookprice")' <?php if($book_price_get==""){echo 'disabled';} ?>>
									<span id="bookprice" class="label label-danger"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm10">Upload File</label>
								<div class="col-sm-10 paddR0">
									<input type="file" name="file_name" id="file_name" onclick='return bookMsgHide("bookPdf")' form="form1" />
									<span id="bookPdf" class="label label-danger" ></span>
								</div>
							</div>
							<input type="hidden" id="hdn_book_type" name="hdn_book_type" value="<?php echo $hdnbooktype;?>" />
							<input type="hidden" id="hdn_course_id" name="hdn_course_id" value="<?php echo $hdncourseid;?>">
							<input type="hidden" id="hdn_subject_id" name="hdn_subject_id" value="<?php echo $hdnsubjectid;?>">
							<input type="hidden" id="hdn_pdf_file" name="hdn_pdf_file" value="<?php echo $hdnpdffile;?>">
							<input type="hidden" id="hdn_thumbimg" name="hdn_thumbimg" value="<?php echo $hdnthumbimg;?>">
							<input type="hidden" id="hdn_largeimg" name="hdn_largeimg" value="<?php echo $hdnlargeimg;?>">
						
						
					</div>
					<div class="col-xs-12 padd0">
						<div class="radioInline">
							<label class="radio-inline">
							<input type="radio" name="mbOptradio2" value="MEMBER" form="form1" onclick="disable()" <?php if($availability=="MEMBER"){echo 'checked=checked';} ?>>For Members
							</label>
							<label class="radio-inline">
							<input type="radio" name="mbOptradio2" value="MARKET" form="form1" onclick="enable()" <?php if($availability=="MARKET"){echo 'checked=checked';} ?>>For Market Place
							</label>
							<label class="radio-inline">
							<input type="radio" name="mbOptradio2" value="BOTH" form="form1" onclick="enable()" <?php if($availability=="BOTH"){echo 'checked=checked';} ?>>Both
							</label>
						</div>
					</div>
					<div class="col-xs-12 padd0 mtop20 mbOuter1" style='display:none;'>
						<div class="row row05" id="dataTable">
							<div class="col-xs-4 padd05">
								<div class="mblegend1">
									<fieldset>
										<legend>Subscription 1</legend>
										<div class="form-group">
											<label class="control-label col-sm-4 padd0 text-right" for="mbForm11">No. of Days</label>
											<div class="col-sm-8 paddR0">
												<select class="form-control" id="subscriptiontype1" name="subscriptiontype1">
													<option>--Select--</option>
													<option>1</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-4 padd0 text-right" for="mbForm12">Price(In Rs.)</label>
											<div class="col-sm-8 paddR0">
												<input type="text" class="form-control" id="subscriptionprice1" name="subscriptionprice1">
											</div>
										</div>
									</fieldset>
								</div>
							</div>
							<div class="col-xs-4 padd05">
								<div class="mblegend1">
									<fieldset>
										<legend>Subscription 2</legend>
										<div class="form-group">
											<label class="control-label col-sm-4 padd0 text-right" for="mbForm13">No. of Days</label>
											<div class="col-sm-8 paddR0">
												<select class="form-control" id="subscriptiontype2" name="subscriptiontype2">
													<option>--Select--</option>
													<option>1</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-4 padd0 text-right" for="mbForm14">Price(In Rs.)</label>
											<div class="col-sm-8 paddR0">
												<input type="text" class="form-control" id="subscriptionprice2" 
												name="subscriptionprice2">
											</div>
										</div>
									</fieldset>
								</div>
							</div>
							<div class="col-xs-4 padd05">
								<div class="mblegend1">
									<fieldset>
										<legend>Subscription 3</legend>
										<div class="form-group">
											<label class="control-label col-sm-4 padd0 text-right" for="mbForm15">No. of Days</label>
											<div class="col-sm-8 paddR0">
												<select class="form-control" id="subscriptiontype3" name="subscriptiontype3">
													<option>--Select--</option>
													<option>1</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-4 padd0 text-right" for="mbForm16">Price(In Rs.)</label>
											<div class="col-sm-8 paddR0">
												<input type="text" class="form-control" id="subscriptionprice3" name="subscriptionprice3">
											</div>
										</div>
									</fieldset>
								</div>
							</div>
						</div>
					</div>
					<!--<div class="col-xs-12 padd0 mtop24 mbAddSub" id="addmoresubscription" style='display:none;'>
						<i class="fa fa-plus" aria-hidden="true"></i><a onclick="addRow('dataTable')" style='cursor: pointer;'>Add more subscription</a>
					</div>-->
					<div class="col-xs-12 padd0 mtop20">
						<!--<button type="button" class="btn mbBtn1 btn-default">SAVE</button>-->
						<input id="button" form="form1" type="submit" name="submit" value="UPDATE" class="btn mbBtn1 btn-default" OnClick="return book_validation();">
						<button type="button" class="btn mbBtn2 btn-default" onclick="window.close()">CANCEL</button>
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
		<script type="text/javascript" src="js/scrolltofixed.js"></script>
		<script src="js/jasny-bootstrap.min.js"></script>
		<script src="js/index.js"></script>
	</body>
</html>
<?php ob_end_flush(); ?>