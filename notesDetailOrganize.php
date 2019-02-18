<!DOCTYPE html>
<?php ob_start(); ?>
<?php include "cs/config.php"; ?>
<html lang="en">
   <head>
      <title>1Book</title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="<?php echo $SiteURL;?>css/bootstrap.min.css">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	   <link rel="shortcut icon" href="<?php echo $SiteURL;?>img/fevicon.ico" type="image/x-icon" />
	   <link rel="stylesheet" href="css/dragula.min.css">
      <link rel="stylesheet" href="css/jasny-bootstrap.min.css">
      <link rel="stylesheet" href="css/common.css">
      <link rel="stylesheet" href="css/notesDetailOrganize.css">
      <link rel="stylesheet" href="css/responsive.css">
	  <?php require_once "cs/common.php"; ?>
	  
	  <script type="text/javascript">
		function ConfirmBookDelete(bookid,pageno) {
			 var x = confirm("Are you sure you want to delete?");
			  if (x)
			  {			
				location.href="deletebooknotespages.php?booknotesid="+bookid+"&pageno="+pageno+"";
			  }
			  else{return false;}
		}
		</script>
		
		
		<!-- Code start for update books/notes  -->
        <?php
		if(isset($_COOKIE['useremailid']))
		{
			if (isset($_POST['savebooknotes']))
			{
				$bookid = mysqli_real_escape_string($db,$_POST['savebooknotes']);
				$book_topic = mysqli_real_escape_string($db,$_POST['topicid']);
				$book_desc = mysqli_real_escape_string($db,$_POST['bookdescid']);
			    
				$resultds = mysqli_query($db,"call sp_update_common('UserID','".$_COOKIE['useremailid']."','".$bookid."','BookType','SubjectID','CourseID','GroupID','MemberID','StatusVal','".$book_topic."','".$book_desc."','TempVal3','TempVal4','TempVal5','TempVal6','TempVal7','TempVal8','TempVal9','TempVal10',
				'UPDATE_BOOKNOTES_TOPICS',@resultmsg,@errormsg)") or die('Query Not execute'.mysqli_error($db));
				 $db->close();
			    if (mysqli_num_rows($resultds) > 0) 
				{
					 while($row = mysqli_fetch_array($resultds)) {
						 $result= $row['resultval'];
						 $IsError= $row['IsErrorval'];
					 }
					  mysqli_free_result($resultds);
				}
				// if ($result=="UPDATE")
				// {
				   // echo "<script>alert('Book/Notes Updated Successfully.')</script>"; 
				// }
			}
		}
	    else
		{
			$WebSite_URL="location:".$SiteURL;
			header($WebSite_URL);
		}
       ?>
	  <!-- Code end for insert books/notes  -->
	  
	  <!--Code Start for set the priority of book-->
	  <?php 
		if(isset($_POST['btnpublish']))
		{
		    $tablerowcountval = $_POST['tablerowcount'];
			$hdnbookidval = $_POST['hdnbookid'];
			for ($i = 1; $i <= $tablerowcountval; $i++) 
		    {
			    $bookpageno = $_POST['page'.$i];
			    $bookpriority = $_POST['priority'.$i];
			   
			    if (isset($_POST['chk'.$i])) 
				{
					$chkboxval = strtoupper($_POST['chk'.$i]); 
					//$hdnpagetitleval = $_POST['pagetitle'.$i];
					$samplepage = "T";
					include "cs/config.php";
					$sqlupdate = "update epaper set sample_page= '".$samplepage."' where editioncode= $hdnbookidval and pageno=$bookpageno";
					mysqli_query($db,$sqlupdate) or die ('Query Not Execute'.mysqli_error());
					mysqli_close($sqlupdate);
				}
				else
				{
				    $samplepage = "F";
					include "cs/config.php";
					$sqlupdate = "update epaper set sample_page = '".$samplepage."' where editioncode= $hdnbookidval and pageno=$bookpageno";
					mysqli_query($db,$sqlupdate) or die ('Query Not Execute'.mysqli_error());
					mysqli_close($sqlupdate);
				}
				include "cs/config.php";
				$sql = "update epaper set priority = $bookpriority where editioncode = $hdnbookidval and pageno=$bookpageno";
				mysqli_query($db,$sql) or die ('Query Not Execute'.mysqli_error());
				mysqli_close($db);
		    }			
		}
	 ?>
	 <!--Code End for set the priority of book-->
   </head>
   <body>
      <div class="mainWrap">
         
		 <!-- Dashboard Start Here -->
		 <?php include_once('dashboard.php');?>
		 <!-- Dashboard End Here -->
		 
		 <?php 
			  $currentpage = $_SERVER['PHP_SELF']; // will return http://xyz.com/two.php for our example
			  $currentpage = basename($currentpage); // will return two.php
			  $currentpage = basename($currentpage, '.php');
		 ?>
         
         <div class="container wrapMB">
            <div class="col-xs-12 padd0 mbHeadDiv ndEco">
               <div class="pull-left">
                  <img src="img/readerIcons/bookshelf_big.png" alt="Bookshelf Logo" class="img-responsive mbBshelf"/>
                  <div class="mbManage">
                     <div class="mBooksTxt">Manage Books/Notes</div>
                     <ul class="list-inline">
                        <!--<li><a href="#">Books</a></li>
                        <li><a href="#">Notes</a></li>-->
                        <li><a href="<?php echo $SiteURL;?>manageBooks.html">Upload Content</a></li>
                     </ul>
                  </div>
               </div>
               <div class="pull-right">
                  <form class="mtop19">
                     <!--<button type="button" class="btn ndBtn1 btn-default"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</button>-->
					  <?php
						  $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
						  echo "<a class='btn ndBtn1 btn-default' href='$url'><i class='fa fa-angle-left' aria-hidden='true'></i> Back</a>"; 
					  ?>
                  </form>
               </div>
            </div>
            <div class="col-xs-12 padd0">
               <div class="row row05 disFlex">
			      <!-- Code start for get books/notes details -->
			          <?php
					     include "cs/config.php";
						 if(isset($_GET['bookid']) && count($_GET) > 0 ) 
						 {
							$BNId=$_GET['bookid'];
							$qryds = mysqli_query($db,"call sp_get_common_data('','','".$BNId."','','','','','A','','','','','','','','','','GET_BOOKNOTES_STATUS_DETAILS')") or die('Query Not execute'.mysqli_error($db));
							$db->close();
							if(mysqli_num_rows($qryds)>0)
							{
							 $row = mysqli_fetch_array($qryds);
							 $category_nameval = $row['category_name'];
							 $titleval = $row['title'];
							 $statusval = $row['status'];
							 if($statusval="T")
							 {
							   $statusval="Processed";
							 }
							 else
							 {
							   $statusval="In Process";
							 }
							 $crtddateval = $row['crtd_date'];
							 $moddateval = $row['mod_date'];
							 $thumbimg = $row['thumb_img'];
							 if($thumbimg!="")
							 {
							   $thumbimgpath=returnthbimage($thumbimg);
							   $thumbimgpath=$S3URL.$thumbimgpath;
							 }
							 else
							 {
								$thumbimgpath=$DefaultThumbPath;
							 }
							 echo "<div class='col-xs-3 ndWid1 padd05'>
								 <img src='$thumbimgpath' alt='Book Cover' class='img-responsive' />
							  </div>
							  <div class='col-xs-5 ndWid2 padd05'>
								 <div class='bodyside2'>
								 <div class='aboutBook'>$titleval</div>
								<p>Status: <span class='bookStatus'>$statusval</span></p>
								<p>Creation Date: ".$crtddateval."</p>
								<p>Last Update: ".$moddateval."</p>
								 </div>                     
							  </div>";
							}
							mysqli_free_result($qryds);
						 }
					   ?>
			         <!-- Code end for get books/notes details -->
                  <div class="col-xs-4 ndWid3 padd05">
				  <div class="ndWid3Abs">
						<button type="button" class="btn ndBtn2 btn-default">Replace PDF</button>
						<button type="button" class="<?php echo ($currentpage == "notesDetailOrganize" ? "btn ndBtn2 btn-default active" : "")?>" class="btn ndBtn2 btn-default">Organize</button>
						<button type="button" class="btn ndBtn2 btn-default" data-toggle="modal" data-target="#modalInfo">Info</button>
						<?php
						 if(isset($_GET['bookid']) && count($_GET) > 0 ) 
				         {
							include "cs/config.php";
							$BNId=$_GET['bookid']; 
							$qryds = mysqli_query($db,"call sp_get_common_data('','','".$BNId."','','','','','A','','','','','','','','','','GET_BOOKNOTES_PARTS_DETAILS')") or die('Query Not execute'.mysqli_error($db));
							$db->close();
							if(mysqli_num_rows($qryds)>0)
							{
							  while($row=mysqli_fetch_array($qryds))
							  {
								  $category_nameval = $row['category_name'];
								  $bookid = $row['id'];
								  $titleval = $row['title'];
								  $topicval = $row['topic'];
								  if($topicval=="")
								  {
									  $topicval="NA";
								  }
								  $authorval = $row['author'];
								  $crtddateval = $row['crtd_date'];
								  $moddateval = $row['mod_date'];
								  $publicationval = $row['publication'];
								  $editionval = $row['edition'];
								  $pagesval = $row['pages'];
								  $print_isbnval = $row['print_isbn'];
								  $etext_isbn = $row['etext_isbn'];
								  $processval = $row['process'];
								  $availabilityval = $row['availability'];
								  $availability_val=$availabilityval;
								  if($availabilityval=="BOTH")
								  {
									  $availabilityval="Marketplace & Members";
								  }
								  elseif($availabilityval=="MARKET")
								  {
									  $availabilityval="Marketplace";
								  }
								  elseif($availabilityval=="MEMBER")
								  {
									  $availabilityval="Mambers";
								  }
								  $descriptionval = $row['description'];
								  if($descriptionval=="")
								  {
									  $descriptionval="NA";
								  }
								  
								  echo "
								  <form method='post' id='formbooknotes' name='formbooknotes' enctype='multipart/form-data' action='$_PHP_SELF' class='form-horizontal horizontalForm'>
									<div id='modalInfo' class='modal fade' role='dialog' tabindex='-1'>
									  <div class='modal-dialog'>
										<div class='modal-content'>
										  <div class='modal-header'>
											<button type='button' class='close' data-dismiss='modal'>&times;</button>
											<h4 class='modal-title fweight700'>$category_nameval</h4>
										  </div>
										  <div class='modal-body'>
											<div class='disTable1'><div class='leftPart1'>Topic <span class='marginLR10'>:</span></div><div class='rightPart1'><input type='text' form='formbooknotes' id='topicid' name='topicid' class='form-control' name='paTopic' value='$topicval'></div></div>
											<div class='disTable1'><div class='leftPart1'>No. of Pages <span class='marginLR10'>:</span></div><div class='rightPart1'>$pagesval</div></div>
											<div class='disTable1'><div class='leftPart1'>Last Updated <span class='marginLR10'>:</span></div><div class='rightPart1'>$moddateval</div></div>
											<div class='disTable1'><div class='leftPart1'>Creation <span class='marginLR10'>:</span></div><div class='rightPart1'>$crtddateval</div></div>
											<div class='disTable1'><div class='leftPart1'>Summary <span class='marginLR10'>:</span></div><div class='rightPart1'><textarea class='form-control txtArea' rows='5' form='formbooknotes' id='bookdescid' name='bookdescid'>$descriptionval</textarea></div></div>
											<div class='disTable1'><div class='leftPart1'></div><div class='rightPart1'>
											<button form='formbooknotes' type='submit' id='savebooknotes' name='savebooknotes' class='btn mbBtn1 btn-default' value='$bookid' >SAVE</button></div></div>
										  </div>
										</div>
									  </div>
									</div></form>";
						    }
						  }
						  mysqli_free_result($qryds);
					     }
					    ?>
					  
						
				  </div>
                  </div>
               </div>
            </div>
			<form method="post" id="frmndo" name="frmndo" enctype="multipart/form-data" action="<?php $_PHP_SELF ?>">
			<div class="col-xs-12 padd0 ndEco2">
               <div class="ndLeftPart">
					<button type="button" class="btn ndBtn3 btn-default"><i class="fa fa-align-right" aria-hidden="true"></i> Mark page as sample</button> <button type="button" class="btn ndBtn3 btn-default"><i class="fa fa-search" aria-hidden="true"></i> Preview</button>
				</div>
               <div class="ndRightPart">
			   <input type="submit" class="btn ndEcoBtn" id="btnpublish" name="btnpublish" form="frmndo" value="PUBLISH CHANGES"  />
                  <!--<button type="button" class="btn ndEcoBtn">PUBLISH CHANGES</button>-->
               </div>
            </div>
            <div class="col-xs-12 padd0">
				<div class="row row03" id='sortable'>
				        <!--Code Start for get the pages og books/notes-->
				        <?php
					     include "cs/config.php";
						 if(isset($_GET['bookid']) && count($_GET) > 0 ) 
						 {
							$BNId=$_GET['bookid'];
							$qryds = mysqli_query($db,"call sp_get_common_data('','','".$BNId."','','','','','A','','','','','','','','','','GET_BOOKNOTES_PAGES')") or die('Query Not execute'.mysqli_error($db));
							$db->close();
							if(mysqli_num_rows($qryds)>0)
							{
							$CountRows=mysqli_num_rows($qryds);
							while($row = mysqli_fetch_array($qryds))
							{
							     $bookidval = $row['editioncode'];
								 $pagenoval = $row['pageno'];
								 $pagetitleval = $row['pagetitle'];
								 $priorityval = $row['priority'];
								 $processval = $row['process'];
								 $thumbimg = $row['imagepath'];
								 $SamplePageVal = $row['sample_page'];
								 $statusval = $row['status'];
								 if($SamplePageVal=="T")
								 {
								    $SamplePageActive=" active";
								 }
								 else
								 {
								   $SamplePageActive="";
								 }
								 if($thumbimg!="")
								 {
								     $thumbimg=str_replace('.jpg','thumb.jpg',$thumbimg);
									 $thumbimgpath=$S3URL.$thumbimg;
								 }
								 else
								 {
									$thumbimgpath=$DefaultThumbPath;
								 }
								 
								 echo "<div id='$pagenoval' class='col-xs-4 col-sm-3 col-md-2 padd03 ndoBox'>
									<div class='ndoInnerBox'>
										<div class='ndoImg'><img src='$thumbimgpath' class='img-responsive' /></div>
										<div class='ndoBoxFooter'>
											<div class='disTable'>
												<div class='ndLeftPart'><i class='fa fa-ellipsis-v faToggle' aria-hidden='true'></i></div>
												<div class='ndRightPart'>
												
												<input id='chk$pagenoval' name='chk$pagenoval' type='checkbox' class='ndoChkbx' " .(($SamplePageVal == 'T') ? "checked='checked'':''"   : ""). ">
												
												<a class='samplepagecss$SamplePageActive' href='#'><i class='fa fa-align-right' aria-hidden='true'></i></a> <a href='reader.php?id=$bookidval&pageno=$pagenoval' class='mRL3' target='_blank'><i class='fa fa-search' aria-hidden='true'></i></a> <span class='ndBookPage'><input class='ndBookPagetxtbox' type='text' id='priority$pagenoval' name='priority$pagenoval' value='$priorityval' onfocus='SetCursorToTextEnd(this.id);'>
												<input type='hidden' form='frmndo' id='page$pagenoval' name='page$pagenoval' value='$pagenoval'><input type='hidden' form='frmndo' id='pagetitle$pagenoval' name='pagetitle$pagenoval' value='$pagetitleval'></span></div>
											</div>
										</div>
										<div class='ndOuterdiv'>
											<div class='ndreplace'><a href='#' class='ndHoverbg'>Replace Page</a></div>
											<a Onclick='return ConfirmBookDelete($bookidval,$pagenoval);' class='ndHoverbg'>Delete</a>
										</div>
									</div>
								</div>";
							 }
							}
							mysqli_free_result($qryds);
						 }
						 ?>
						 <!--Code End for get the pages og books/notes-->
				</div>
				<?php echo '<input type="hidden" name="hdnbookid" id="hdnbookid" value = "' .$BNId. '"><input type="hidden" id="tablerowcount" name="tablerowcount" value="'.$CountRows.'" />';?>
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
      <script src="js/dragula.min.js"></script>
      <script src="js/dragulaDrag.min.js"></script>
	  <script>
		$(document).ready(function(){
			$(window).click(function() {
				$('.ndOuterdiv').hide();
			});
			
			$(".faToggle").click(function(event){
				event.stopPropagation();
				$(".faToggle").not(this).closest(".ndoBoxFooter").siblings(".ndOuterdiv").hide();
				$(this).closest(".ndoBoxFooter").siblings(".ndOuterdiv").toggle();
			});
			
			$(document).keydown(function(e) {
				if (e.keyCode === 27){		// esc
					$('.ndOuterdiv').hide();
				}
			});
		});
	</script>
	  <script src="js/index.js"></script>
	  
  
	  <script type="text/javascript" language="javascript">
		function SetCursorToTextEnd(textControlID) {
			var t1 = document.getElementById(textControlID);
			t1.focus();
			//t1.value = t1.value;
		}
	</script>
	  
	 <script type="text/javascript" src="js/dragula.drag.drop.custom.min.js"></script>
	 
	  <script>
	 $(function() {
     $('#sortable').sortable({
        axisX: 'x',
		axisY: 'y',
        opacity: 0.7,
        handle: 'div',
        update: function(event, ui) {
            var list_sortable = $(this).sortable('toArray').toString();
			//alert(list_sortable);
			var bnid = $('#hdnbookid').val();
			//alert(bnid);
    		// change order in the database using Ajax
            
            $.ajax({
                url: 'set_book_priority.php',
                type: 'POST',
                data: {list_order:list_sortable,bookid:bnid},
                success: function(data) {
                    //finished
					location.reload();
                }
            });
        }
        }); // fin sortable
	 });
	 </script>
	 
	 
   </body>
</html>
<?php ob_end_flush(); ?>