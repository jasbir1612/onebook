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
      <link rel="stylesheet" href="css/jasny-bootstrap.min.css">
      <link rel="stylesheet" href="css/common.css">
      <link rel="stylesheet" href="css/notesDetail.css">
      <link rel="stylesheet" href="css/responsive.css">
	  <?php require_once "cs/common.php"; ?>
		
		<!-- Code start for update books/notes  -->
        <?php
		if(isset($_COOKIE['useremailid']))
		{
			if (isset($_POST['savebooknotes']))
			{
				$bookid = mysqli_real_escape_string($db,$_POST['savebooknotes']);
				$topicidval=topicid.$bookid;
				$book_topic = mysqli_real_escape_string($db,$_POST[$topicidval]);
				$bookdescidval=bookdescid.$bookid;
				$book_desc = mysqli_real_escape_string($db,$_POST[$bookdescidval]);
			    
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
		
	    <!-- Code start for delete the books/notes parts--> 
		<?php
		 if(isset($_COOKIE['useremailid']))
		 {
		    $Uid=$_COOKIE['useremailid'];
			if (isset($_POST['deletebooktnotes']))
			{
			  $achk = $_POST['checkbox'];
			  if(empty($achk)) 
			  {
				//echo "You didn't select any group."; 
			  } 
			  else
			  {
			     $N = count($achk);
				 if($N>0)
				 {
				     if(isset($_GET['bookid']) && count($_GET) > 0 ) 
					 {
					       $BNId=$_GET['bookid'];
						   include "cs/config.php";
						   $dscountparts = mysqli_query($db,"call sp_get_common_data('','','".$BNId."','','','','','A','','','','','','','','','','COUNT_NO_OF_BOOKPARTS')") or die('Query Not execute'.mysqli_error($db));
						   $db->close();
						   if(mysqli_num_rows($dscountparts)>0)
						   {
							 $rown= mysqli_fetch_array($dscountparts);
							 $countval = $rown['totalparts'];;
							 if($N==$countval)
							 {
							    include "cs/config.php";
								$qryds = mysqli_query($db,"call sp_delete_common_data('','','".$BNId."','','','','','D','','','','','','','','','','DELETE_COMPLETE_BOOKNOTES')") or die('Query Not execute'.mysqli_error($db));
								$db->close();
								$WebSite_URL="location:".$SiteURL."modify_booknotes.html";
								header($WebSite_URL);
							 }
							 else
							 {
							
							 }
							 mysqli_free_result($dscountparts);
						   }
					 } 
				 }
			     for($i=0; $i < $N; $i++)
				 {
				    include "cs/config.php";
					$booknotesid=$achk[$i];
					$qryds = mysqli_query($db,"call sp_delete_common_data('','','".$booknotesid."','','','','','D','','','','','','','','','','DELETE_BOOKNOTES')") or die('Query Not execute'.mysqli_error($db));
					$db->close();
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
		<!-- Code end for delete the books/notes parts-->
		  
		<script type="text/javascript">
		function ConfirmDelete(bookid) {
			 var x = confirm("Are you sure you want to delete?");
			  if (x)
			  {
				//alert(bookid);	
				location.href="deletebooknotes.php?booknotesid="+bookid+"";
			  }
			  else{return false;}
		}
		</script>
		
		
		
		 
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
				        <?php
							  $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
							  echo "<a class='btn ndBtn1 btn-default' href='$url'><i class='fa fa-angle-left' aria-hidden='true'></i> Back</a>"; 
						 ?>
						<!--<button type="button" class="btn ndBtn1 btn-default"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</button>-->
                  </form>
               </div>
            </div>
            <!--<div class="col-xs-12 padd0 ndEco">
               <div class="ndLeftPart">Economics</div>
               <div class="ndRightPart">
                  <div class="input-group stylish-input-group">
                     <input type="text" class="form-control"  placeholder="Search by name" >
                     <span class="input-group-addon">
                     <button type="submit">
                     <span class="glyphicon glyphicon-search"></span>
                     </button>
                     </span>
                  </div>
               </div>
            </div>-->

			 <!-- Code start for get books/notes details -->
			<?php
				include "cs/config.php";
				if(isset($_GET['bookid']) && count($_GET) > 0 ) 
				{
					$BNId=$_GET['bookid'];
					$qryds = mysqli_query($db,"call sp_get_common_data('','','".$BNId."','','','','','A','','','','','','','','','','GET_BOOKNOTES_DETAILS')") or die('Query Not execute'.mysqli_error($db));
		            $db->close();
					if(mysqli_num_rows($qryds)>0)
					{
					  $row = mysqli_fetch_array($qryds);
					  $category_nameval = $row['category_name'];
					  $bookid = $row['id'];
					  $titleval = $row['title'];
					  $authorval = $row['author'];
					  $publicationval = $row['publication'];
					  $editionval = $row['edition'];
					  
					  include "cs/config.php";
					  $dscountpages = mysqli_query($db,"call sp_get_common_data('','','".$bookid."','','','','','A','','','','','','','','','','COUNT_NO_OF_PAGES')") or die('Query Not execute'.mysqli_error($db));
					  $db->close();
					  if(mysqli_num_rows($dscountpages)>0)
					  {
					    $rowdup = mysqli_fetch_array($dscountpages);
					    $pagesval = $rowdup['totalpages'];
					    mysqli_free_result($dscountpages);
					  }
					  else
					  {
					     $pagesval = $row['pages'];
					  }
					  $print_isbnval = $row['print_isbn'];
					  $etext_isbn = $row['etext_isbn'];
					  $availabilityval = $row['availability'];
					  $availability_val=$availabilityval;
					  $booktypeval = $row['book_type'];
					  if($booktypeval=="BOOK")
					  {
						 $booktypeval="Book";
					  }
					  else
					  {
					    $booktypeval="Notes";
					  }
					  if($availabilityval=="BOTH")
					  {
						  $availabilityval=$booktypeval. " For Marketplace & Members";
					  }
					  elseif($availabilityval=="MARKET")
					  {
						  $availabilityval=$booktypeval. " For Marketplace";
					  }
					  elseif($availabilityval=="MEMBER")
					  {
						  $availabilityval=$booktypeval. " For Members";
					  }
					  $descriptionval = $row['description'];
					  if($descriptionval=="")
					  {
						  $descriptionval="NA";
					  }
					  $thumbimg = $row['thumb_img'];
					  $largeimg = $row['large_img'];
					  if($thumbimg!="")
						{
					     $thumbimgpath=returnthbimage($thumbimg);
					     $largeimgpath=returnthbimage($largeimg);
						 $thumbimgpath=$S3URL.$thumbimgpath;
						 $largeimgpath=$S3URL.$largeimgpath;
						}
						else
						 {
							$thumbimgpath=$DefaultThumbPath;
							$largeimgpath=$DefaultLargePath;
						 }

						echo "<div class='col-xs-12 padd0 ndEco'>
						   <div class='ndLeftPart'>$category_nameval</div>
						   <div class='ndRightPart' style='display:none;'>
							  <div class='input-group stylish-input-group'>
								 <input type='text' class='form-control' placeholder='Search by name' >
								 <span class='input-group-addon'>
								 <button type='submit'>
								 <span class='glyphicon glyphicon-search'></span>
								 </button>
								 </span>
							  </div>
						   </div>
						</div>";
						
					   echo "<div class='col-xs-12 padd0'>";
					   echo "<div class='row row10'>";
							  echo "<div class='col-xs-3 ndWid1 padd10'>";
							  echo "<img src='$thumbimgpath' alt='Book Cover' class='img-responsive' />";
							  echo "</div>";
							   echo "<div class='col-xs-5 ndWid2 padd10'>";
								echo "<div class='bodyside2'>";
								 echo "<div class='aboutBook'><p class='aboutBookP1'>$titleval</p>";
								 echo "<p class='aboutBookP2'>$availabilityval</p>";
								 echo "</div>";
								 echo "<p>Author(s): $authorval</p>";
								 echo "<p>Publisher: $publicationval</p>";
								 echo "<p>Edition: $editionval</p>";
								 echo "<p>Pages: $pagesval</p>";
								 echo "<p>Print ISBN: $print_isbnval</p>";
								 echo "<p>eText ISBN: $etext_isbn</p>";
								 echo "<div>";
								 echo "<a href='ManageEditBooks.php?bookid=$BNId' target='_self' class='abEdit'><i class='fa fa-pencil' aria-hidden='true'></i> EDIT DETAILS</a>";
								 if($availability_val=='MEMBER' || $availability_val=='BOTH')
								  {
								 echo "<a href='subscriber_book_to_group.php?bookid=$bookid' target='_self' class='abGroup'><img src='img/readerIcons/subscribers_BW.png' alt='Subscriber Logo' class='img-responsive' /> ADD GROUP</a>";

								  $querygrp = "select count(*) as totalgroup from order_header where book_id='".$bookid."' and subscription_type='GROUP' and subscriber_crtd_by='".$_SESSION['userid']."' group by group_id";
								 $querygrp_ds = mysqli_query($db,$querygrp);
								  $totalgroupval=mysqli_num_rows($querygrp_ds);
								 //if(mysqli_num_rows($querygrp_ds)>0)
								 //{
									 //$rowb = mysqli_fetch_array($querygrp_ds);
									 //$totalgroupval = $rowb['totalgroup'];
								 //}
								 echo "<a href='subscriber_book_to_group_del.php?bookid=$bookid' target='_self' class='abGroup'><img src='img/readerIcons/subscribers_BW.png' alt='Subscriber Logo' class='img-responsive' /> $totalgroupval GROUP(S)</a>";
								  }
								 echo "</div>";
								 echo "<div style='margin-top:5px;'><a href='reader.php?id=$bookid' target='_blank' class='abGroup'>VIEW eBook/eNote</a></div>";
								echo "</div>";
								echo "<div class='aboutBook2 visible-xs'>$titleval</div>";
							    echo "</div>";

							    echo "<div class='col-xs-4 ndWid3 padd10'>";
							    echo "<div class='ndAboutBk'>";
								 echo "<h4>About Book</h4>";
								 echo "<p>$descriptionval</p>";
							    echo "</div>";
							    echo "</div>";

					   echo "</div>";			
					   echo "</div>";
				  }
				  else
				  {
					  $WebSite_URL="location:".$SiteURL."modify_booknotes.html";
			          header($WebSite_URL);
				  }   
				  mysqli_free_result($qryds);
				}
			?>
			<!-- Code end for get books/notes details -->
			
            <!-- <div class="col-xs-12 padd0">
               <div class="row row10">
                  <div class="col-xs-3 ndWid1 padd10">
                     <img src="img/bookInfo.jpg" alt="Book Cover" class="img-responsive" />
                  </div>
                  <div class="col-xs-5 ndWid2 padd10">
                     <div class="bodyside2">
                        <div class="aboutBook">
							<p class="aboutBookP1">Booms and Busts: An Encyclopedia of the Economic History from the First Stock Market Crash of 1792</p>
							<p class="aboutBookP2">For Marketplace & Mambers</p>
						</div>
                        <p>Author(s): Odekon, Mehmet</p>
                        <p>Publisher: Routledge</p>
                        <p>Edition: 3rd</p>
                        <p>Pages: 1050</p>
                        <p>Print ISBN: 9780765682246, 0765682249</p>
                        <p>eText ISBN: 9781317475767, 1317475763</p>
						<div>
							<a href="#" class="abEdit"><i class="fa fa-pencil" aria-hidden="true"></i> EDIT</a>
							<a href="#" class="abGroup"><img src="img/readerIcons/subscribers_BW.png" alt="Subscriber Logo" class="img-responsive" /> ADD GROUP</a>
							<a href="#" class="abGroup"><img src="img/readerIcons/subscribers_BW.png" alt="Subscriber Logo" class="img-responsive" /> 13 GROUP(S)</a>
						</div>
                     </div>
                     <div class="aboutBook2 visible-xs">Booms and Busts: An Encyclopedia of the Economic History from the First Stock Market Crash of 1792 to the Current Global Economic Crisis</div>
                  </div>
                  <div class="col-xs-4 ndWid3 padd10">
                     <div class="ndAboutBk">
                        <h4>About Book</h4>
                        <p>From the best selling creators of Duck! Rabbit!, an exciting tale of self-discovery! He stood out here. He stood out there. He tried everything to be more like them. It's not easy being seen. Especially when you're NOT like everyone else. Especially when what sets you apart is YOU. Sometimes we squish ourselves to fit in. We shrink. Twist. Bend. Until -- ! -- a friend shows the way to endless possibilities. In this bold and highly visual book, an emphatic but misplaced exclamation point learns that being different can be very exciting! Period.</p>
                     </div>
                  </div>
               </div>
            </div>-->
         
		  <!-- Code start for get books/notes's chapters -->
		   <?php
				if(isset($_GET['bookid']) && count($_GET) > 0 ) 
				{
				    include "cs/config.php";
					$BNId=$_GET['bookid']; 
					$qryds = mysqli_query($db,"call sp_get_common_data('','','".$BNId."','','','','','A','','','','','','','','','','GET_BOOKNOTES_PARTS')") or die('Query Not execute'.mysqli_error($db));
		            $db->close();
					if(mysqli_num_rows($qryds)>0)
					{
					  $rowcount=1;
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
					  <form method='post' id='formbooknotes$bookid' name='formbooknotes$bookid' enctype='multipart/form-data' action='$_PHP_SELF' class='form-horizontal horizontalForm'>
						<div id='modalInfo$rowcount' class='modal fade' role='dialog' tabindex='-1'>
						  <div class='modal-dialog'>
							<div class='modal-content'>
							  <div class='modal-header'>
								<button type='button' class='close' data-dismiss='modal'>&times;</button>
								<h4 class='modal-title fweight700'>$category_nameval</h4>
							  </div>
							  <div class='modal-body'>
								<div class='disTable1'><div class='leftPart1'>Topic <span class='marginLR10'>:</span></div><div class='rightPart1'><input type='text' form='formbooknotes$bookid' id='topicid$bookid' name='topicid$bookid' class='form-control' name='paTopic' value='$topicval'></div></div>
								<div class='disTable1'><div class='leftPart1'>No. of Pages <span class='marginLR10'>:</span></div><div class='rightPart1'>$pagesval</div></div>
								<div class='disTable1'><div class='leftPart1'>Last Updated <span class='marginLR10'>:</span></div><div class='rightPart1'>$moddateval</div></div>
								<div class='disTable1'><div class='leftPart1'>Creation <span class='marginLR10'>:</span></div><div class='rightPart1'>$crtddateval</div></div>
								<div class='disTable1'><div class='leftPart1'>Summary <span class='marginLR10'>:</span></div><div class='rightPart1'><textarea class='form-control txtArea' rows='5' form='formbooknotes$bookid' id='bookdescid$bookid' name='bookdescid$bookid'>$descriptionval</textarea></div></div>
								<div class='disTable1'><div class='leftPart1'></div><div class='rightPart1'>
								<button form='formbooknotes$bookid' type='submit' id='savebooknotes' name='savebooknotes' class='btn mbBtn1 btn-default' value='$bookid' >SAVE</button></div></div>
							  </div>
							</div>
						  </div>
						</div></form>";

					   if($rowcount=="1")
					   {
					    echo "<div class='col-xs-12 padd0 clrOrange ndMorePg'>More Pages</div>";
						echo "<form method='post' id='formbooknotespages' name='formbooknotespages' enctype='multipart/form-data' action='$_PHP_SELF' class='form-horizontal horizontalForm'>";
						echo "<div class='col-xs-12 padd0 btndeldiv'><input form='formbooknotespages' type='submit' value='Delete' id='deletebooktnotes' name='deletebooktnotes' class='btndel'></input></div>";
					    echo "<div class='col-xs-12 padd0'>";
					    echo "<div class='table-responsive'>";
						echo "<table class='table ndTable1'>";
						echo "<thead>
								<tr>
								<th style='display:none;'><i class='fa fa-arrows' aria-hidden='true'></i></th>
								<th><input form='formbooknotespages' type='checkbox' value='' id='checkAll' /></th>
								<th>#</th>
								<th>CHAPTER NAME</th>
								<th>TOPICS</th>
								<th>*</th>
								<th colspan='2'>EDIT</th>
								</tr>
							 </thead>";
						 echo "<tbody></form>";
					   }
					  echo "<tr>";
					  echo "<td style='display:none;' class='cursorArrow'><i class='fa fa-ellipsis-v mright2' aria-hidden='true'></i><i class='fa fa-ellipsis-v' aria-hidden='true'></i> </td>";
					  echo "<td><input type='checkbox' form='formbooknotespages' class='toggleCheck' name='checkbox[]' value='$bookid' /></td>";
					  echo "<td>$rowcount</td>";
					  echo "<td>$titleval</td>";
					  echo "<td>$topicval</td>";
					  if($processval=="T")
					  {
					     echo "<td><i class='fa fa-check-circle-o greenTick' aria-hidden='true'></i></td>";
					  }
					  else if($processval=="E")
					  {
					     echo "<td><i class='fa fa-check-circle-o redTick' aria-hidden='true'></i></td>";
					  }
					  else
					  {
					     echo "<td><i class='fa fa-clock-o clockWait' aria-hidden='true'></i></td>";
					  }
					  //echo "<td>$crtddateval</td>";
					  //echo "<td>$pagesval</td>";
					  // echo "<td><a href='manageeditbookpages.php?bookid=$bookid' target='_target'><i class='fa fa-pencil' aria-hidden='true'></i></a></td>";
					  echo "<td><a class='ahover' href='manageeditbookpages.php?bookid=$bookid' target='_target'>Replace PDF</a></td>";
					  //echo "<td><a class='ahover' href='notesDetailOrganize.php?bookid=$bookid' target='_self'>Organize</a></td>";
					  echo "<td><span data-toggle='modal' data-target='#modalInfo$rowcount' class='cPointer'>Info</span></td>";
					  // echo "<td><a href='deletebooknotes.php?booknotesid=$bookid' target='_self'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
					  //echo "<td><a style='cursor: pointer;' class='ahover' Onclick='return ConfirmDelete($bookid);'>Delete</a></td>";
					  echo "</tr>";
					  // echo "<tr>";
					  // echo "<td class='cursorArrow'><i class='fa fa-ellipsis-v mright2' aria-hidden='true'></i><i class='fa fa-ellipsis-v' aria-hidden='true'></i></td>";
					  // echo "<td>$rowcount</td>";
					  // echo "<td>$titleval</td>";
					  // echo "<td>$topicval</td>";
					  // echo "<td><i class='fa fa-clock-o clockWait' aria-hidden='true'></i></td>";
					  // echo "<td>Replace PDF</td>";
					  // echo "<td>Organize</td>";
					  // echo "<td><span data-toggle='modal' data-target='#modalInfo' class='cPointer'>Info</span></td>";
					  // echo "<td>Delete</td>";
					  // echo "</tr>";
					   $rowcount=$rowcount+1;
					  }
					  echo "</tbody>";
					  echo "</table>";
					  echo "</div>";
					  echo "</div>";
				  }
				  mysqli_free_result($qryds);
				}
			?>
			 <!-- Code end for get books/notes's chapters -->
			
            <!--<div class="col-xs-12 padd0 clrOrange ndMorePg">More Pages</div>
            <div class="col-xs-12 padd0">
               <div class="table-responsive">
                  <table class="table ndTable1">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>CHAPTER NAME</th>
                           <th>TOPICS</th>
                           <th>SUMMARY</th>
                           <th>CREATION DATE</th>
                           <th>PAGES</th>
                           <th colspan="2">ACTION</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>1</td>
                           <td>PROFESSIONAL ACCOUNTING</td>
                           <td>ITS ONLY FOR CS STUDENT ONLY</td>
                           <td>STUDENT ONLY</td>
                           <td>28-09-2016</td>
                           <td>1-20</td>
                           <td><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                           <td><a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        </tr>
                        <tr>
                           <td>2</td>
                           <td>EXTENT AND COMMENCEMENT</td>
                           <td>ITS ONLY FOR CS STUDENT ONLY</td>
                           <td>STUDENT ONLY</td>
                           <td>28-09-2016</td>
                           <td>21-30</td>
                           <td><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                           <td><a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        </tr>
                        <tr>
                           <td>3</td>
                           <td>PROFESSIONAL ACCOUNTING</td>
                           <td>ITS ONLY FOR CS STUDENT ONLY</td>
                           <td>STUDENT ONLY</td>
                           <td>28-09-2016</td>
                           <td>31-60</td>
                           <td><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                           <td><a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        </tr>
                        <tr>
                           <td>4</td>
                           <td>EXTENT AND COMMENCEMENT</td>
                           <td>ITS ONLY FOR CS STUDENT ONLY</td>
                           <td>STUDENT ONLY</td>
                           <td>28-09-2016</td>
                           <td>61-90</td>
                           <td><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                           <td><a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>-->


            <div class="col-xs-12 padd0 mbAddSub clrOrange">
               <a href="manageaddbookpages.php?bookid=<?php echo $_GET['bookid']?>" target='_blank'><i class="fa fa-plus" aria-hidden="true"></i>Add more pages</a>
            </div>
            <div class="col-xs-12 padd0 mtop20" style="display:none;">
               <button type="button" class="btn mbBtn1 btn-default">SAVE</button>
               <button type="button" class="btn mbBtn2 btn-default">CANCEL</button>
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
<?php ob_end_flush(); ?>