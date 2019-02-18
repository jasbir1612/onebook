<!DOCTYPE html>
<?php ob_start(); ?>
<?php include "cs/config.php";?>
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
			var fm = document.form1;
			if ((fm.mbOptradio1[0].checked == false) && (fm.mbOptradio1[1].checked == false)) 
			{
			document.getElementById('bookType').style.display = "initial";
			document.getElementById("bookType").innerHTML = "Please choose Books or Notes"; 
			return false;
			}
			
			var rates = document.getElementsByName('mbOptradio1');
			var rate_value;
			for(var i = 0; i < rates.length; i++){
				if(rates[i].checked){
					rate_value = rates[i].value;
					document.getElementsByName('hdn_book_type').value = rate_value;
				}
			}

			if(fm.mbForm1title.value=="")
			{
			document.getElementById('bookTitle').style.display = "initial";
			document.getElementById("bookTitle").innerHTML = "Please enter title";
			/*alert("please enter title");*/
			fm.mbForm1title.focus();
			return false;
			}
			if(fm.mbForm1publication.value=="")
			{
			document.getElementById('bookPublisher').style.display = "initial";
			document.getElementById("bookPublisher").innerHTML = "Please enter publisher";	
			/*alert("please enter publisher");*/
			fm.mbForm1publication.focus();
			return false;
			}
			if(fm.mbForm2author.value=="")
			{
			document.getElementById('bookAuthor').style.display = "initial";	
			document.getElementById("bookAuthor").innerHTML = "Please enter author";	
			// alert("please enter author");
			fm.mbForm2author.focus();
			return false;
			}
			var ddlcourse = document.getElementById("mbForm3course");
			if(ddlcourse.value=="--Select--")
			{
			document.getElementById('bookCourse').style.display = "initial";	
			document.getElementById("bookCourse").innerHTML = "Please select any course";
			/*alert("please select any course");*/
			return false;
			}
			// if(fm.mbForm4edition.value=="")
			// {
			// document.getElementById('bookEdition').style.display = "initial";	
			// document.getElementById("bookEdition").innerHTML = "Please enter edition";
			// // alert("please enter edition");
			// fm.mbForm4edition.focus();
			// return false;
			// }
			var ddlsubject = document.getElementById("mbForm5subject")
			if(ddlsubject.value=="--Select--")
			{
			document.getElementById('bookSubject').style.display = "initial";	
			document.getElementById("bookSubject").innerHTML = "Please select any subject";
			/*alert("please select any subject");*/
			return false;
			}
			// if(fm.mbForm6validfor.value=="")
			// {
			// document.getElementById('bookAttemptvalidfor').style.display = "initial";	
			// document.getElementById("bookAttemptvalidfor").innerHTML = "Please enter attempt valid for";
			// /*alert("please enter attempt valid for");*/
			// fm.mbForm6validfor.focus();
			// return false;
			// }
			// if(fm.mbForm7pages.value=="")
			// {
			// document.getElementById('bookPages').style.display = "initial";	
			// document.getElementById("bookPages").innerHTML = "Please enter page no";
			// /*alert("please enter page no");*/
			// fm.mbForm7pages.focus();
			// return false;
			// }
			// if(fm.mbForm8printisbn.value=="")
			// {
			// document.getElementById('bookPisbn').style.display = "initial";	
			// document.getElementById("bookPisbn").innerHTML = "Please enter print isbn";
			// /*alert("please enter print isbn");*/
			// fm.mbForm8printisbn.focus();
			// return false;
			// }
			// if(fm.mbForm9etextisbn.value=="")
			// {
			// document.getElementById('bookTextisbn').style.display = "initial";	
			// document.getElementById("bookTextisbn").innerHTML = "Please enter etext isbn";
			// /*alert("please enter etext isbn");*/
			// fm.mbForm9etextisbn.focus();
			// return false;
			// }
			// if(fm.mbForm10desc.value=="")
			// {
			// document.getElementById('bookDescription').style.display = "initial";	
			// document.getElementById("bookDescription").innerHTML = "Please enter description";
			// /*alert("please enter description");*/
			// fm.mbForm10desc.focus();
			// return false;
			// }
			var bookpriceval = document.getElementById("txtprice")
			if(bookpriceval.value=="")
			{
			document.getElementById('bookprice').style.display = "initial";	
			document.getElementById("bookprice").innerHTML = "Please enter price";
			return false;
			}
			var pdffileval = document.getElementById("file_name")
			if(pdffileval.value=="")
			{
			document.getElementById('bookPdf').style.display = "initial";	
			document.getElementById("bookPdf").innerHTML = "Please upload pdf file";
			/*alert("please upload pdf file");*/
			return false;
			}
		}

		function bookMsgHide(hideId) 
		{
			document.getElementById(hideId).style.display = "none";
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
			document.getElementById("txtprice").value="";
			document.getElementById("addmoresubscription").style.display='block';
		}
      </script>
       <!-- functions end for enable/disable the subscription part  -->
	  
        <!-- Code start for insert books/notes  -->
        <?php
		include "cs/config.php";
		include "cs/uploadgallery.php";
		//session_start();
		if(isset($_COOKIE['useremailid']))
		{
			if (isset($_POST['submit']))
			{
			    $msgerror = "false";
			   //if(isset($_POST['hdn_book_type']))
			   //{
			   //echo "You have selected :".$_POST['hdn_book_type'];  //  Displaying Selected Value
			   //}
				$book_title = mysqli_real_escape_string($db,$_POST['mbForm1title']);
				$book_topic = mysqli_real_escape_string($db,$_POST['mbForm1topic']);
				$book_author = mysqli_real_escape_string($db,$_POST['mbForm2author']);
				$book_publication = mysqli_real_escape_string($db,$_POST['mbForm1publication']);
				$book_course = mysqli_real_escape_string($db,$_POST['mbForm3course']);
 
				//$foldername="gall_content/";
				//$upload_folder=uploadgall($foldername)."/";
				//$upload_filenm="coverimg";
				//$thumgimg=homeuploadfile($upload_filenm,$upload_folder);
				//$upload_pdf="file_name";
				//$pdffilename=Singleuploadfile($upload_pdf,$upload_folder);
				//$book_thumb= $thumgimg;
				//$book_large= $thumgimg;
				//$book_file = $pdffilename;
				
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
							// // $msg = "S3 Upload Successful.";	
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
						unlink($tmpthumb);
						unlink($tmplarge);
					}
					else
					{
					  $msgerror = "true";
					  echo "<script>alert('Invalid file, please upload image file.')</script>";
					   // echo ("<SCRIPT LANGUAGE='JavaScript'>
						// window.alert('Invalid file, please upload image file.')
						// window.location.href='manageBooks.html';
						// </SCRIPT>");
					}
				}
				else
				{
				    //$msgerror = "true";
				    //echo "<script>alert('Please select image file.')</script>";
					 // echo ("<SCRIPT LANGUAGE='JavaScript'>
						// window.alert('Please select image file.')
						// window.location.href='manageBooks.html';
						// </SCRIPT>");	
					   $book_thumb="";
				       $book_large= $book_thumb;						
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
							// $msg = "S3 Upload Successful.";	
						}
					}
					else
					{
					   $msgerror = "true";
					   echo "<script>alert('Invalid file, please upload pdf file.')</script>";
					}
				}
				else
				{
				   $msgerror = "true";
				   echo "<script>alert('Please select pdf file.')</script>"; 
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
				//$book_type = $_POST['hdn_book_type'];
				$book_type = $_POST['mbOptradio1'];
				$book_status='A';
				$book_active='A';
				$book_access='A';
				$book_process='F';
				$meta_keyword = mysqli_real_escape_string($db,$_POST['mbForm10metakey']);
				$meta_desc = mysqli_real_escape_string($db,$_POST['mbForm10metadesc']);
				//$meta_desc= str_replace("'", "''", $meta_desc);
				$book_price = mysqli_real_escape_string($db,$_POST['txtprice']);
				if($book_price=="")
				{
				   $book_price = '0';
				}
				$book_partval="1"; 
									
				if ($msgerror=="false") 
				{
					$resultds = mysqli_query($db,"call sp_insert_booknotes('','".$book_subject."','".$book_course."','".$book_title."','".$book_desc."','".$book_topic."','".$book_publication."','".$book_author."','".$book_edition."','".$book_pages."','".$book_validfor."','".$availability_val."','".$book_printisbn."','".$book_etextisbn."','".$book_thumb."','".$book_large."','".$book_file."','".$book_status."','".$book_active."','".$book_access."','".$book_process."','".$userid."','".$userid."','".$meta_keyword."','".$meta_desc."','".$book_price."','".$book_type."','".$book_partval."','INSERT_BOOKNOTES',@resultmsg,@errormsg)") or die('Query Not execute'.mysqli_error($db));
					$db->close();
					if (mysqli_num_rows($resultds) > 0) {
					 while($row = mysqli_fetch_array($resultds)) {
						 $result= $row['resultval'];
						 $IsError= $row['IsErrorval'];
					 }
					  mysqli_free_result($resultds);
					}
					
					if ($result=="INSERT")
					{
					   echo "<script>alert('Book/Notes Saved Successfully.')</script>"; 
					}
					if ($result=="EXIST")
					{
					  echo "<script>alert('Error Ocured Try Again.')</script>"; 
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
	    <!-- Code end for insert books/notes  -->
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
							<div class="mBooksTxt">Upload Books/Notes</div>
							<ul class="list-inline">
								<!-- <li><a href="#">Books</a></li>
								<li><a href="#">Notes</a></li>-->
								<li><a href="<?php echo $SiteURL;?>manageBooks.html">Upload Content</a></li>
							</ul>
						</div>
					</div>
					<!--<div class="pull-right">
						<form class="mtop24">
							<label class="radio-inline">
							<input type="radio" name="mbOptradio1" id="mbOptradio1" value="BOOK" onClick="document.form1.hdn_book_type.value = this.value">Books
							</label>
							<label class="radio-inline">
							<input type="radio" name="mbOptradio1" id="mbOptradio1"  value="NOTES" checked="checked" onClick="document.form1.hdn_book_type.value = this.value">Notes
							</label>
						</form>
					</div>-->
				</div>
				<div class="col-xs-12 padd0">
				<form method="post" id="form1" name="form1" enctype="multipart/form-data" action="<?php $_PHP_SELF ?>" class="form-horizontal horizontalForm">
					<div class="col-xs-3 paddL0">
						<div class="fileinput fileinput-new" data-provides="fileinput" style="width:100%;">
							<div class="fileinput-new thumbnail" style="width: 100%; height: 225px; position: relative;">
								<div class="uploadTxt">
									<!--<div>Upload Note</div>-->
									<div>Cover Image</div>
								</div>
							</div>
							<div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 225px; width:100%"></div>
							<div class="text-center">
								<span class="btn btn-default btn-file uploadBtn1">
									<span class="fileinput-new">Upload Cover Image</span>
									<span class="fileinput-exists">Change</span>
									<input type="file" name="coverimg" id="coverimg" form="form1"  />
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
								  <input type="radio" name="mbOptradio1" id="mbOptradio1" value="BOOK" onClick="document.form1.hdn_book_type.value = this.value" onchange="this.form.submit()" onmouseout='return bookMsgHide("bookType")'
  <?php if(isset($_POST['mbOptradio1'])){ if($_POST['mbOptradio1'] == 'BOOK') {echo "checked";}} ?>>&nbsp;&nbsp;Books&nbsp;&nbsp;&nbsp;
								  <input type="radio" name="mbOptradio1" id="mbOptradio1" value="NOTES" onClick="document.form1.hdn_book_type.value = this.value" onchange="this.form.submit()"
  <?php if(isset($_POST['mbOptradio1'])){ if($_POST['mbOptradio1'] == 'NOTES') {echo "checked";}} ?>>&nbsp;&nbsp;Notes
									<span id="bookType" class="label label-danger"></span>
							  </div>
						    </div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm1">Title</label>
								<div class="col-sm-10 paddR0">
									<input type="text" class="form-control" id="mbForm1title" name="mbForm1title" 
									onkeypress='return bookMsgHide("bookTitle")'>
									<span id="bookTitle" class="label label-danger"></span>
								</div>
							</div>
							<div class="form-group" style='display:none;'>
								<label class="control-label col-sm-2 padd0" for="mbForm1">Topic</label>
								<div class="col-sm-10 paddR0">
									<input type="text" class="form-control" id="mbForm1topic" name="mbForm1topic" value="">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm1">Publisher</label>
								<div class="col-sm-10 paddR0">
									<input type="text" class="form-control" id="mbForm1publication" name="mbForm1publication" onkeypress='return bookMsgHide("bookPublisher")'>
									<span id="bookPublisher" class="label label-danger"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm2">Author</label>
								<div class="col-sm-4 paddR0">
									<input type="text" class="form-control" id="mbForm2author" name="mbForm2author" onkeypress='return bookMsgHide("bookAuthor")'>
									<span id="bookAuthor" class="label label-danger"></span>
								</div>
								<label class="control-label col-sm-2 padd0" for="mbForm3">Course</label>
								<div class="col-sm-4 paddR0">
									<select class="form-control" id="mbForm3course" name="mbForm3course" onchange='return bookMsgHide("bookCourse")'>
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
												<option value="<?php echo $rowdist['course_id']; ?>"><?php echo  $rowdist['course_name']; ?></option>
											  <?php 
											}
										    }
										  ?>
										   <!-- Code end for bind the cource  -->
									</select>
									<span id="bookCourse" class="label label-danger"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm4">Edition</label>
								<div class="col-sm-4 paddR0">
									<input type="text" class="form-control" id="mbForm4edition" name="mbForm4edition" onkeypress='return bookMsgHide("bookEdition")'>
									<span id="bookEdition" class="label label-danger"></span>
								</div>
								<label class="control-label col-sm-2 padd0" for="mbForm5">Subject</label>
								<div class="col-sm-4 paddR0">
									<select class="form-control" id="mbForm5subject" name="mbForm5subject" onchange='return bookMsgHide("bookSubject")'>
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
												<option value="<?php echo $rowdist['category_id']; ?>"><?php echo  $rowdist['category_name']; ?></option>
											  <?php 
											}
										    }
										  ?>
										  <!-- Code end for bind the subject  -->
									</select>
									<span id="bookSubject" class="label label-danger"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm6">Attempt valid for</label>
								<div class="col-sm-4 paddR0">
										<input type="text" class="form-control" id="mbForm6validfor" name="mbForm6validfor" onkeypress='return bookMsgHide("bookAttemptvalidfor")'>
									  <span id="bookAttemptvalidfor" class="label label-danger"></span>
								</div>
								<label class="control-label col-sm-2 padd0" for="mbForm8">Print ISBN</label>
								<div class="col-sm-4 paddR0">
									<input type="text" class="form-control" id="mbForm8printisbn" name="mbForm8printisbn" onkeypress='return bookMsgHide("bookPisbn")'>
									<span id="bookPisbn" class="label label-danger"></span>
								</div>
								
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm7" style="display:none;">Pages</label>
								<div class="col-sm-4 paddR0" style="display:none;">
									<input type="text" class="form-control" id="mbForm7pages" name="mbForm7pages" onkeypress='return event.charCode >= 48 && event.charCode <= 57' onchange='return bookMsgHide("bookPages")'>
									<span id="bookPages" class="label label-danger"></span>
								</div>
								<label class="control-label col-sm-2 padd0" for="mbForm9" style="display:none;">eText ISBN</label>
								<div class="col-sm-4 paddR0" style="display:none;">
									<input type="text" class="form-control" id="mbForm9etextisbn" name="mbForm9etextisbn" onkeypress='return bookMsgHide("bookTextisbn")'>
									<span id="bookTextisbn" class="label label-danger"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm10">Description</label>
								<div class="col-sm-10 paddR0">
									<textarea class="form-control txtarea" rows="5" id="mbForm10desc" name="mbForm10desc" onkeypress='return bookMsgHide("bookDescription")'></textarea>
									<span id="bookDescription" class="label label-danger"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm11">Meta Keywords</label>
								<div class="col-sm-10 paddR0">
									<textarea class="form-control txtarea" rows="2" id="mbForm10metakey" name="mbForm10metakey"></textarea>
								</div>
							</div>
							<div class="form-group" style="display:none;">
								<label class="control-label col-sm-2 padd0" for="mbForm12">Meta Description</label>
								<div class="col-sm-10 paddR0">
									<textarea class="form-control txtarea" rows="2" id="mbForm10metadesc" name="mbForm10metadesc"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm13">Price</label>
								<div class="col-sm-4 paddR0">									
									<input type="text" class="form-control" id="txtprice" name="txtprice" onkeypress='return event.charCode >= 48 && event.charCode <= 57' onchange='return bookMsgHide("bookprice")'>
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
							<input type="hidden" id="hdn_book_type" name="hdn_book_type" value="" />
					</div>
					<div class="col-xs-12 padd0">
						<div class="radioInline">
							<label class="radio-inline">
							<input type="radio" name="mbOptradio2" value="MEMBER" form="form1" onclick="disable()">For Members
							</label>
							<label class="radio-inline">
							<input type="radio" name="mbOptradio2" value="MARKET" form="form1" onclick="enable()" checked="checked">For Market Place
							</label>
							<label class="radio-inline">
							<input type="radio" name="mbOptradio2" value="BOTH" form="form1" onclick="enable()">Both
							</label>
						</div>
					</div>
					<div class="col-xs-12 padd0 mtop20 mbOuter1" style="display:none;">
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
										<legend>Subscription 2</legend>
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
					<!--<div class="col-xs-12 padd0 mtop24 mbAddSub">
						<i class="fa fa-plus" aria-hidden="true"></i><a onclick="addRow('dataTable')" style='cursor: pointer;'>Add more subscription</a>
					</div>-->
					<div class="col-xs-12 padd0 mtop20">
						<!--<button type="button" class="btn mbBtn1 btn-default">SAVE</button>-->
						<input id="button" form="form1" type="submit" name="submit" value="SAVE" class="btn mbBtn1 btn-default" OnClick="return book_validation();">
						<button type="button" class="btn mbBtn2 btn-default" onclick="goBack()">CANCEL</button>
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
		<script>
		   function goBack() 
			{
			  window.history.go(-1);
			}
        </script>
	</body>
</html>
<?php ob_end_flush(); ?>