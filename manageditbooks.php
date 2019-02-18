
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>1 Book</title>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/jasny-bootstrap.min.css">
		<link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" href="css/manageBooks.css">
		<link rel="stylesheet" href="css/responsive.css">
		<script language="javascript" type="text/javascript">
		function book_validation()
		{
			var fm = document.form1;
			if ((fm.mbOptradio1[0].checked == false) && (fm.mbOptradio1[1].checked == false)) 
			{
			alert("please choose Books or Notes"); 
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
			alert("please enter title");
			fm.mbForm1title.focus();
			return false;
			}
			if(fm.mbForm1publication.value=="")
			{
			alert("please enter publisher");
			fm.mbForm1publication.focus();
			return false;
			}
			if(fm.mbForm2author.value=="")
			{
			alert("please enter author");
			fm.mbForm2author.focus();
			return false;
			}
			var ddlcourse = document.getElementById("mbForm3course");
			if(ddlcourse.value=="--Select--")
			{
			alert("please select any course");
			return false;
			}
			if(fm.mbForm4edition.value=="")
			{
			alert("please enter edition");
			fm.mbForm4edition.focus();
			return false;
			}
			var ddlsubject = document.getElementById("mbForm5subject")
			if(ddlsubject.value=="--Select--")
			{
			alert("please select any subject");
			return false;
			}
			if(fm.mbForm6validfor.value=="")
			{
			alert("please enter attempt valid for");
			fm.mbForm6validfor.focus();
			return false;
			}
			if(fm.mbForm7pages.value=="")
			{
			alert("please enter page no");
			fm.mbForm7pages.focus();
			return false;
			}
			if(fm.mbForm8printisbn.value=="")
			{
			alert("please enter print isbn");
			fm.mbForm8printisbn.focus();
			return false;
			}
			if(fm.mbForm9etextisbn.value=="")
			{
			alert("please enter etext isbn");
			fm.mbForm9etextisbn.focus();
			return false;
			}
			if(fm.mbForm10desc.value=="")
			{
			alert("please enter description");
			fm.mbForm10desc.focus();
			return false;
			}
			var pdffileval = document.getElementById("pdffile")
			if(pdffileval.value=="")
			{
			alert("please upload pdf file");
			return false;
			}
		}
		</script>

        <?php
		include "cs/config.php";
		include "cs/uploadgallery.php";
		session_start();
		if($_SESSION['userid']!="")
		{
			if (isset($_POST['submit']))
			{
				$sqlmaxid = "SELECT IFNULL(MAX(id+1),1) as maxid FROM edition";
				$resultmaxid = mysqli_query($db,$sqlmaxid);
				if(mysqli_num_rows($resultmaxid)>=0){
				while($row=mysqli_fetch_array($resultmaxid)){
				$editionid=$row['maxid'];
			  }}

			$book_title = addslashes ($_POST['mbForm1title']);
			$book_title = $_POST['mbForm1title'];
			$book_author = $_POST['mbForm2author'];
			$book_publication = $_POST['mbForm1publication'];
			$book_course = $_POST['mbForm3course'];

			$foldername="gall_content/";
			$upload_folder=uploadgall($foldername)."/";
			$upload_filenm="coverimg";
			$thumgimg=homeuploadfile($upload_filenm,$upload_folder);
		   
			$upload_pdf="pdffile";
			$pdffilename=Singleuploadfile($upload_pdf,$upload_folder);
		  
			$book_thumb= $thumgimg;
			$book_large= $thumgimg;
			$book_file = $pdffilename;
			$userid=$_SESSION['userid'];
			$availability_val="";
			$book_edition = $_POST['mbForm4edition'];
			$book_subject = $_POST['mbForm5subject'];
			$book_validfor = $_POST['mbForm6validfor'];
			$book_pages = $_POST['mbForm7pages'];
			$book_printisbn = $_POST['mbForm8printisbn'];
			$book_etextisbn = $_POST['mbForm9etextisbn'];
			$book_desc = $_POST['mbForm10desc'];
			//$book_type = $_POST['hdn_book_type'];
			$book_type = $_POST['mbOptradio1'];
			
			$sql ="insert into edition(id,PublicationName,category_id,title,long_title,description,publication,author,book_type,print_isbn,etext_isbn,
			thumb_img,large_img,file,edition,pages,attempt_valid_for,valid_from,valid_to,crtd_date,mod_date,publish_date,crtd_by,mod_by,status,
			active,access,availability,course_id,lang_id)
			VALUES('$editionid','$book_title','$book_course','$book_title','$book_title',$book_desc,'$book_publication','$book_author','$book_type',
			'$book_printisbn','$book_etextisbn','$book_thumb',
			'$book_large','$book_file','$book_edition','$book_pages','$book_validfor',now(),now(),now(),now(),now(),'$userid','$userid','A','A','A',
			'$availability_val','$book_course',1)";
			mysqli_query($db,$sql) or die ('Query Not Execute'.mysqli_error()); 
			echo "<script>alert('Book/Notes Saved Successfully.')</script>"; 
			mysqli_close($db);

			}
		}
	    else
		{
			header('location:index.php');
		}
       ?>
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
								<li><a href="#">Books</a></li>
								<li><a href="#">Notes</a></li>
								<li><a href="#">Upload Content</a></li>
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
					<div class="col-xs-3 paddL0">
						<div class="fileinput fileinput-new" data-provides="fileinput" style="width:100%;">
							<div class="fileinput-new thumbnail" style="width: 100%; height: 225px; position: relative;">
								<div class="uploadTxt">
									<div>Upload Note</div>
									<div>Cover Image</div>
								</div>
							</div>
							<div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 225px; width:100%"></div>
							<div class="text-center">
								<span class="btn btn-default btn-file uploadBtn1">
									<span class="fileinput-new">Upload Cover Image</span>
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
						<form method="post" id="form1" name="form1" enctype="multipart/form-data" action="<?php $_PHP_SELF ?>" class="form-horizontal horizontalForm">

						<?php
session_start();
include "cs/config.php";
include "cs/uploadgallery.php";
$bookid=$_REQUEST['bookid'];
if($_SESSION['userid']!="")
{
    $qryget = "select * from edition where id='$bookid'";
	$qrygetds = mysqli_query($db,$qryget);
	if(mysqli_num_rows($qrygetds)>0)
	{
		echo 'row>>>>>>>>>>>>>>>>.'.mysqli_num_rows($qrygetds);
		while($row = mysqli_fetch_array($qrygetds))
		{
			echo 'ttttttttttt>>>>>>>>>>>>>>>>.'.$row['title'];
		    $book_title = $row['title'];
		}
	}
}
?>

						    <div class="form-group">
							<label class="control-label col-sm-2 padd0" for="mbForm1"></label>
								<div class="col-sm-10 paddR0">
								  <input type="radio" name="mbOptradio1" id="mbOptradio1" value="BOOK" onClick="document.form1.hdn_book_type.value = this.value" onchange="this.form.submit()"
  <?php if(isset($_POST['mbOptradio1'])){ if($_POST['mbOptradio1'] == 'BOOK') {echo "checked";}} ?>>&nbsp;&nbsp;Books&nbsp;&nbsp;&nbsp;
								  <input type="radio" name="mbOptradio1" id="mbOptradio1" value="NOTES" onClick="document.form1.hdn_book_type.value = this.value" onchange="this.form.submit()"
  <?php if(isset($_POST['mbOptradio1'])){ if($_POST['mbOptradio1'] == 'NOTES') {echo "checked";}} ?>>&nbsp;&nbsp;Notes
							  </div>
						    </div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm1">Title</label>
								<div class="col-sm-10 paddR0">
									<input type="text" class="form-control" id="mbForm1title" name="mbForm1title" value="<?php echo $book_title; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm1">Publisher</label>
								<div class="col-sm-10 paddR0">
									<input type="text" class="form-control" id="mbForm1publication" name="mbForm1publication">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm2">Author</label>
								<div class="col-sm-4 paddR0">
									<input type="text" class="form-control" id="mbForm2author" name="mbForm2author">
								</div>
								<label class="control-label col-sm-2 padd0" for="mbForm3">Course</label>
								<div class="col-sm-4 paddR0">
									<select class="form-control" id="mbForm3course" name="mbForm3course">
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
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm4">Edition</label>
								<div class="col-sm-4 paddR0">
									<input type="text" class="form-control" id="mbForm4edition" name="mbForm4edition">
								</div>
								<label class="control-label col-sm-2 padd0" for="mbForm5">Subject</label>
								<div class="col-sm-4 paddR0">
									<select class="form-control" id="mbForm5subject" name="mbForm5subject">
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
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm6">Attempt valid for</label>
								<div class="col-sm-4 paddR0">
									<input type="text" class="form-control" id="mbForm6validfor" name="mbForm6validfor">
								</div>
								<label class="control-label col-sm-2 padd0" for="mbForm7">Pages</label>
								<div class="col-sm-4 paddR0">
									<input type="text" class="form-control" id="mbForm7pages" name="mbForm7pages">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm8">Print ISBN</label>
								<div class="col-sm-4 paddR0">
									<input type="text" class="form-control" id="mbForm8printisbn" name="mbForm8printisbn">
								</div>
								<label class="control-label col-sm-2 padd0" for="mbForm9">eText ISBN</label>
								<div class="col-sm-4 paddR0">
									<input type="text" class="form-control" id="mbForm9etextisbn" name="mbForm9etextisbn">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm10">Description</label>
								<div class="col-sm-10 paddR0">
									<textarea class="form-control txtarea" rows="5" id="mbForm10desc" name="mbForm10desc"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 padd0" for="mbForm10">Upload File</label>
								<div class="col-sm-10 paddR0">
									<input type="file" name="pdffile" id="pdffile" />
								</div>
							</div>
							<input type="hidden" id="hdn_book_type" name="hdn_book_type" value="" />
						</form>
						
					</div>
					<div class="col-xs-12 padd0">
						<form class="radioInline">
							<label class="radio-inline">
							<input type="radio" name="mbOptradio2">For Members
							</label>
							<label class="radio-inline">
							<input type="radio" name="mbOptradio2">For Market Place
							</label>
							<label class="radio-inline">
							<input type="radio" name="mbOptradio2">Both of these
							</label>
						</form>
					</div>
					<div class="col-xs-12 padd0 mtop20 mbOuter1">
						<div class="row row05">
							<div class="col-xs-4 padd05">
								<form class="mblegend1">
									<fieldset>
										<legend>Subscription 1</legend>
										<div class="form-group">
											<label class="control-label col-sm-4 padd0 text-right" for="mbForm11">No. of Days</label>
											<div class="col-sm-8 paddR0">
												<select class="form-control" id="mbForm11">
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
												<input type="text" class="form-control" id="mbForm12">
											</div>
										</div>
									</fieldset>
								</form>
							</div>
							<div class="col-xs-4 padd05">
								<form class="mblegend1">
									<fieldset>
										<legend>Subscription 1</legend>
										<div class="form-group">
											<label class="control-label col-sm-4 padd0 text-right" for="mbForm13">No. of Days</label>
											<div class="col-sm-8 paddR0">
												<select class="form-control" id="mbForm13">
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
												<input type="text" class="form-control" id="mbForm14">
											</div>
										</div>
									</fieldset>
								</form>
							</div>
							<div class="col-xs-4 padd05">
								<form class="mblegend1">
									<fieldset>
										<legend>Subscription 1</legend>
										<div class="form-group">
											<label class="control-label col-sm-4 padd0 text-right" for="mbForm15">No. of Days</label>
											<div class="col-sm-8 paddR0">
												<select class="form-control" id="mbForm15">
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
												<input type="text" class="form-control" id="mbForm16">
											</div>
										</div>
									</fieldset>
								</form>
							</div>
						</div>
					</div>
					<div class="col-xs-12 padd0 mtop24 mbAddSub">
						<i class="fa fa-plus" aria-hidden="true"></i> Add more subscription
					</div>
					<div class="col-xs-12 padd0 mtop20">
						<!--<button type="button" class="btn mbBtn1 btn-default">SAVE</button>-->
						<input id="button" form="form1" type="submit" name="submit" value="UPDATE" class="btn mbBtn1 btn-default" OnClick="return book_validation();">
						<button type="button" class="btn mbBtn2 btn-default">CANCEL</button>
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
		<script type="text/javascript" src="js/scrolltofixed.js"></script>
		<script src="js/jasny-bootstrap.min.js"></script>
		<script src="js/index.js"></script>
	</body>
</html>