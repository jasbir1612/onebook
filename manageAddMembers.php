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
	  <link rel="shortcut icon" href="<?php echo $SiteURL;?>img/fevicon.ico" type="image/x-icon" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <link rel="stylesheet" href="css/jasny-bootstrap.min.css">
      <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
      <link rel="stylesheet" href="css/common.css">
      <link rel="stylesheet" href="css/manageAddMembers.css">
      <link rel="stylesheet" href="css/responsive.css">
	  
	  <script type="text/javascript">
	$(document).ready(function(){
		$("#csvfile").on('change',function(){
			$("#submitcsvfile").click();
			return false;
		});
	});

// function savemembers(){
               // alert('success');
       // }
	   
</script>

      <!-- function start for add the dymanic rows  -->
	 <SCRIPT language="javascript">
		function addRow(tableID) {

			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);
			var colCount = table.rows[0].cells.length;
			
			for(var i=0; i<colCount; i++) {
				var newcell	= row.insertCell(i);
				newcell.innerHTML = table.rows[0].cells[i].innerHTML;
			}
            
			table.rows[rowCount].cells[0].innerHTML=rowCount;
			table.rows[rowCount].cells[1].innerHTML="<input class='form-control' type='text' id='name"+rowCount+"' name='name"+rowCount+"'>";
			table.rows[rowCount].cells[2].innerHTML="<input class='form-control' type='text' id='email"+rowCount+"' name='email"+rowCount+"'>";
			table.rows[rowCount].cells[3].innerHTML="<input class='form-control' type='text' id='detail1"+rowCount+"' name='detail1"+rowCount+"'>";
			table.rows[rowCount].cells[4].innerHTML="<input class='form-control' type='text' id='detail2"+rowCount+"' name='detail2"+rowCount+"'>";
			document.getElementById("tablerowcount").value = rowCount;
			document.getElementById("tablecolumncount").value = colCount;
		}
	</SCRIPT>
	 <!-- function end for add the dymanic rows  -->

	  <!-- Code start for add the members  -->
	<?php
		  //session_start();
		  require 'PHPMailer/mail_common.php';
		  ini_set('display_errors','1');
		  $UserID=$_COOKIE['useremailid'];
		  $Groupid=$_GET['groupid'];
		  if(isset($_POST['save']))
		  {
			  if(isset($_COOKIE['useremailid']))
			  {
				  include "cs/config.php";
				  $resultsqlqry = mysqli_query($db,"call sp_get_common_user('GET_USER_DETAILS','','".$UserID."')") or die('Query Not execute'.mysqli_error($db));
				  $db->close();
				  if(mysqli_num_rows($resultsqlqry)>0)
				  {
					$rowqry = mysqli_fetch_array($resultsqlqry);
					$EducatorName = $rowqry['first_name'];
				  }
				  mysqli_free_result($resultsqlqry);
				  
				  include "cs/config.php";
				   $resultsqldtls = mysqli_query($db,"call sp_get_common_data('','','','','','','','A','".$Groupid.  "','','','','','','','','','GET_GROUP_COURSE_SUBJECT_TIME')") or die('Query Not execute'.mysqli_error($db));
				  $db->close();
				   if(mysqli_num_rows($resultsqldtls)>0)
				   {
					$rowqrydtls = mysqli_fetch_array($resultsqldtls);
					$GroupName = $rowqrydtls['group_name'];
					$CourseName = $rowqrydtls['course_name'];
					$SubjectName = $rowqrydtls['category_name'];
					$GroupTiming = $rowqrydtls['group_timing'];
				   }
				   mysqli_free_result($resultsqldtls);

				   $tablerow1=$_POST['tablerowcount'];
				   if($tablerow1!="")
				   {
				   }
				   else
				   {
					   $tablerow1="5";
				   }
				   for ($x = 1; $x <= $tablerow1; $x++) 
				   {
					   $m_name = addslashes($_POST['name'.$x]);
					   $email = addslashes($_POST['email'.$x]);
					   $detail1 = addslashes($_POST['detail1'.$x]);
					   $detail2 = addslashes($_POST['detail2'.$x]);
					   
					   // $m_name = mysqli_real_escape_string($db,$m_name);
					   // $email = mysqli_real_escape_string($db,$email);
					   // $detail1 = mysqli_real_escape_string($db,$detail1);
					   // $detail2 = mysqli_real_escape_string($db,$detail2);
				    
				   if($email!="")
				   {
						$UserType="1";
						$RoleId="1";
						$status='F';
						$regis_type='GROUP';
						$User_Password=$email;
						
						include "cs/config.php";
						$resultds = mysqli_query($db,"call sp_insert_members('','".$email."','".$m_name."','".$m_name."','".$User_Password."',
						'".$UserType."','".$RoleId."','".$status."','".$regis_type."','".$detail1."','".$detail2."','".$detail1."','".$detail2."',
						'','','','".$UserID."','".$UserID."','".$Groupid."','INSERT_MEMBERS',@resultmsg,@errormsg)") 
						or die('Query Not execute'.mysqli_error($db));
						$db->close();
						
						if (mysqli_num_rows($resultds) > 0) {
						 while($row = mysqli_fetch_array($resultds)) {
							$result= $row['resultval'];
							$IsError= $row['IsErrorval'];
							$MID = $row['MemberId'];
							  // echo ("<SCRIPT LANGUAGE='JavaScript'>
							   // window.alert('".$MID."');
							   // </SCRIPT>");
							// echo ("<SCRIPT LANGUAGE='JavaScript'>
							   // window.alert('".$result."');
							   // </SCRIPT>");
						 }
					      mysqli_free_result($resultds);
						 }
						
						if ($result=="INSERT" || $result=="EXIST" )
					    {
						       // echo ("<SCRIPT LANGUAGE='JavaScript'>
							   // window.alert('".$result."');
							   // </SCRIPT>");

							$bodyContent = "<p>Hi ".$m_name.",</p>";
							$bodyContent .= "<p><span style='color:#EF7F1B'>It's good to study</span></p>";
							$bodyContent .= "<p>".$EducatorName." has added you to a batch ".$GroupName." for ".$CourseName." and ".$SubjectName.". The batch timings are ".$GroupTiming.".</p>";
							$bodyContent .= "<p>The access allows you to view content delivered to this batch by ".$EducatorName.".</p>";
							$bodyContent .= "<p>You can view the content in your 1Book account.</p>";
							$bodyContent .= "<p>In case you don’t have an account on 1Book, you can register by clicking on this link: 
							<a href=".$SiteURL.">Registration Link</a></p>";
							$bodyContent .= "<p>USE THE SAME EMAIL ID THAT YOU PROVIDED TO THE EDUCATOR AT THE TIME OF REGISTRATION.</p>";
							$bodyContent .= "<p>Sincerely</p>";
							$bodyContent .= "<p><span style='color:#EF7F1B'>1Book</span> Team</p>";
							$MailSubject="1Book - Access to Batch";
							
				            $SendMailMsg = SendMail($SMTPServerFromEmailID,$email,'','',$MailSubject,$bodyContent,"","");
							//echo $SendMailMsg. "<br>";
							sleep(2); 
							 
							 include "cs/config.php";
							 $result_dss = mysqli_query($db,"call sp_get_common_data('','','','','','',
							 '','A','".$Groupid."','','','','','','','','','GET_ASSIGNED_BOOKS_TO_GROUPMEMBERS')")
							 or die('Query Not execute'.mysqli_error($db));
							 $db->close();  
							 if (mysqli_num_rows($result_dss) > 0) 
							 {
							 $m=1;
							 while($row_dss = mysqli_fetch_array($result_dss)) 
							 {
								 include "cs/config.php";
								 $BN_Id= $row_dss['book_id'];
								 $flagds = mysqli_query($db,"call sp_insert_booktogroup('".$BN_Id."','','','".$Groupid."','".$MID."','','','','',
								 '','','INSERT_BOOKNOTES_TO_GROUP_NEWMEMBER',@resultmsg,@errormsg)") or die('Query Not execute'.mysqli_error($db));
								 $db->close();
								 if($m==1)
								 {
								 $bodyContent="";
								 $MailSubject = '1Book - New Access to Book';
								 $bodydata = "<img src='cid:1book_logo' alt='1Book'><br>";
								 $bodydata .= "<p>Hi ".$m_name.",</p>";
								 $bodydata .= "<p><span style='color:#EF7F1B'>It's good to study</span></p>";
								 $bodydata .= "<p>".$_COOKIE['username']." has provided access for 'Book/Note' to ".$GroupName." for ".$CourseName." and ".$SubjectName.".</p>";
								 $bodydata .= "<p>You can now view the 'Book/Note' in your 1Book account.</p>";
								 $bodydata .= "<p>In case you have not created an account on 1Book, you can register by clicking on this link: <a href=".$SiteURL.">Registration Link</a></p>";
								 $bodydata .= "<p>Sincerely</p>";
								 $bodydata .= "<p><span style='color:#EF7F1B'>1Book</span> Team</p>";
								 $SendMailMsg = SendMail($SMTPServerFromEmailID,$email,'','',$MailSubject,$bodydata,"","");

								 // if(!$mail->send()) 
								 // {
									// echo "Message was not sent PHP Mailer Error: " . $mail->ErrorInfo;
								 // } 
								 // else 
								 // {
								 // }
								 }
								 $m=$m+1;
							  }
							   mysqli_free_result($result_dss);
							 }			
						 }						 
				    }
				 }
				
				 if ($result=="INSERT" || $result=="EXIST")
				 {
				   echo "<script>alert('Member Added Successfully.')</script>";
				 }
			   }
			   else
			   {
				  $WebSite_URL="location:".$SiteURL;
			      header($WebSite_URL);
			   }
			  }				
    ?> 
     <!-- Code end for add the members  -->
	 
	 <!-- Code start for add members through excel file  -->
	 <?php
		include "cs/config.php";
		if (isset($_POST['submitcsvfile']))
		{
		   if(isset($_COOKIE['useremailid']))
		   {
			$fname = $_FILES['csvfile']['name'];
			$chk_ext = explode(".",$fname);
			if(strtolower(end($chk_ext)) == "csv")
			 {
			      $UserID=$_COOKIE['useremailid'];
				  $Groupid=$_GET['groupid'];
				
				  include "cs/config.php";
				  $resultsqlqry = mysqli_query($db,"call sp_get_common_user('GET_USER_DETAILS','','".$UserID."')") or die('Query Not execute'.mysqli_error($db));
				  $db->close();
				  if(mysqli_num_rows($resultsqlqry)>0)
				  {
					$rowqry = mysqli_fetch_array($resultsqlqry);
					$EducatorName = $rowqry['first_name'];
				  }
				  mysqli_free_result($resultsqlqry);
				  
				  include "cs/config.php";
				   $resultsqldtls = mysqli_query($db,"call sp_get_common_data('','','','','','','','A','".$Groupid.  "','','','','','','','','','GET_GROUP_COURSE_SUBJECT_TIME')") or die('Query Not execute'.mysqli_error($db));
				  $db->close();
				   if(mysqli_num_rows($resultsqldtls)>0)
				   {
					$rowqrydtls = mysqli_fetch_array($resultsqldtls);
					$GroupName = $rowqrydtls['group_name'];
					$CourseName = $rowqrydtls['course_name'];
					$SubjectName = $rowqrydtls['category_name'];
					$GroupTiming = $rowqrydtls['group_timing'];
				   }
				   mysqli_free_result($resultsqldtls);
				   
				   
				$filename = $_FILES['csvfile']['tmp_name'];
				$handle = fopen($filename,"r");
				$i=1;
				while(($data = fgetcsv($handle,1000,","))!==FALSE)
				{
				    if($i>1)
					{
				        $email=$data[2];  
						$m_name=$data[1];
				        $UserType="1";
						$RoleId="1";
						$status='F';
						$regis_type='GROUP';
						$User_Password=$email;
						$detail1=$data[3];
						$detail2=$data[4];
						
						include "cs/config.php";
						$resultds = mysqli_query($db,"call sp_insert_members('','".$email."','".$m_name."','".$m_name."','".$User_Password."',
						'".$UserType."','".$RoleId."','".$status."','".$regis_type."','".$detail1."','".$detail2."','".$detail1."','".$detail2."',
						'','','','".$UserID."','".$UserID."','".$Groupid."','INSERT_MEMBERS',@resultmsg,@errormsg)") 
						or die('Query Not execute'.mysqli_error($db));
						$db->close();
						
						if (mysqli_num_rows($resultds) > 0) {
						 while($row = mysqli_fetch_array($resultds)) {
							$result= $row['resultval'];
							$IsError= $row['IsErrorval'];
							$MID = $row['MemberId'];
						 }
					      mysqli_free_result($resultds);
						 }
						 
						 if ($result=="INSERT" || $result=="EXIST" )
					     {
							$bodyContent = "<p>Hi ".$m_name.",</p>";
							$bodyContent .= "<p><span style='color:#EF7F1B'>It's good to study</span></p>";
							$bodyContent .= "<p>".$EducatorName." has added you to a batch ".$GroupName." for ".$CourseName." and ".$SubjectName.". The batch timings are ".$GroupTiming.".</p>";
							$bodyContent .= "<p>The access allows you to view content delivered to this batch by ".$EducatorName.".</p>";
							$bodyContent .= "<p>You can view the content in your 1Book account.</p>";
							$bodyContent .= "<p>In case you don’t have an account on 1Book, you can register by clicking on this link: 
							<a href=".$SiteURL.">Registration Link</a></p>";
							$bodyContent .= "<p>USE THE SAME EMAIL ID THAT YOU PROVIDED TO THE EDUCATOR AT THE TIME OF REGISTRATION.</p>";
							$bodyContent .= "<p>Sincerely</p>";
							$bodyContent .= "<p><span style='color:#EF7F1B'>1Book</span> Team</p>";
							$MailSubject="1Book - Access to Batch";
							
				             $SendMailMsg = SendMail($SMTPServerFromEmailID,$email,'','',$MailSubject,$bodyContent,"","");
							 sleep(2); 
							 include "cs/config.php";
							 $result_dss = mysqli_query($db,"call sp_get_common_data('','','','','','',
							 '','A','".$Groupid."','','','','','','','','','GET_ASSIGNED_BOOKS_TO_GROUPMEMBERS')")
							 or die('Query Not execute'.mysqli_error($db));
							 $db->close();  
							 if (mysqli_num_rows($result_dss) > 0) 
							 {
							 $m=1;
							 while($row_dss = mysqli_fetch_array($result_dss)) 
							 {
								 include "cs/config.php";
								 $BN_Id= $row_dss['book_id'];
								 $flagds = mysqli_query($db,"call sp_insert_booktogroup('".$BN_Id."','','','".$Groupid."','".$MID."','','','','',
								 '','','INSERT_BOOKNOTES_TO_GROUP_NEWMEMBER',@resultmsg,@errormsg)") or die('Query Not execute'.mysqli_error($db));
								 $db->close();
								 if($m==1)
								 {
								 $bodyContent="";
								 $MailSubject = '1Book - New Access to Book';
								 $bodydata = "<img src='cid:1book_logo' alt='1Book'><br>";
								 $bodydata .= "<p>Hi ".$m_name.",</p>";
								 $bodydata .= "<p><span style='color:#EF7F1B'>It's good to study</span></p>";
								 $bodydata .= "<p>".$_COOKIE['username']." has provided access for 'Book/Note' to ".$GroupName." for ".$CourseName." and ".$SubjectName.".</p>";
								 $bodydata .= "<p>You can now view the 'Book/Note' in your 1Book account.</p>";
								 $bodydata .= "<p>In case you have not created an account on 1Book, you can register by clicking on this link: <a href=".$SiteURL.">Registration Link</a></p>";
								 $bodydata .= "<p>Sincerely</p>";
								 $bodydata .= "<p><span style='color:#EF7F1B'>1Book</span> Team</p>";
								 $SendMailMsg = SendMail($SMTPServerFromEmailID,$email,'','',$MailSubject,$bodydata,"","");
								 }
								 $m=$m+1;
							  }
							   mysqli_free_result($result_dss);
							 }			
						 }
					}		
					$i=$i+1;					
						 
				}
				fclose($handle);
				if ($result=="INSERT" || $result=="EXIST")
				 {
				   echo "<script>alert('Member Added Successfully.')</script>";
				 }
			 }
			  else
			  {
				echo "invalid file";
			  }
		  }
		  else
		  {
			  $WebSite_URL="location:".$SiteURL;
			  header($WebSite_URL);
		  }
		}
      ?>
 <!-- Code end for add members through excel file  -->

	 
   </head>
   <body>
      <div class="mainWrap">
        
		 <!-- Dashboard Start Here -->
		 <?php include_once('dashboard.php');?>
		  <!-- Dashboard End Here -->

         <div class="container wrapMB">
            <div class="col-xs-12 padd0 mbHeadDiv1">
               <div class="pull-left">
                  <img src="img/readerIcons/subscribers_big.png" alt="Bookshelf Logo" class="img-responsive mbBshelf"/>
                  <div class="mbManage">
				      <!-- Code start for header --> 
				      <?php 
						if(isset($_COOKIE['useremailid']))
						{
							if($_COOKIE['roleid']=="3")
							{
							?>		
							 <div class="mBooksTxt">Manage Subscribers</div>
							 <ul class="list-inline">
								<li><a href="#">Subscriber Details</a></li>
								<li><a href="manageGroups.html">Manage Groups</a></li>
								<!--<li><a href="#">Send Notification</a></li>
								<li><a href="#">Free Subscription</a></li>--> 
							 </ul>
							<?php 
							}
							else if($_COOKIE['roleid']=="2")
							{
							 ?>		
							 <div class="mBooksTxt">Manage Members</div>
							 <ul class="list-inline">
								<li><a href="manageGroups.html">Manage Groups</a></li>
								<!--<li><a href="#">Send Notification</a></li>
								<li><a href="#">Free Subscription</a></li>--> 
							 </ul>
							 <?php 
							}
						}
						?>
						<!-- Code end for header --> 
                  </div>
               </div>
               <div class="pull-right">
                  <div class="mtop19" style="display:none;">
                     <img src="img/readerIcons/subscribers_mid.png" alt="Subscriber Logo" class="img-responsive rightIcons1 mRight10" />
                     <img src="img/readerIcons/invite_frnd_mid.png" alt="Invite Friend Logo" class="img-responsive rightIcons1" />
                  </div>
               </div>
            </div>
            <div class="col-xs-12 padd0 mbHeadDiv2">
               <div class="pull-left">
                  <div class="mbBshelf2"><i class="fa fa-star" aria-hidden="true"></i></div>
                  <div class="mbManage mbManage2">
                     <div class="mBooksTxt">
					       <!-- Code start for get the group details--> 
					       <?php 
						      if (isset($_GET['groupid']) && count($_GET) > 0 ) 
						      { 
							     include "cs/config.php";
						      	 $Gid = mysqli_real_escape_string($db,$_GET['groupid']);
								 $querygroup_ds = mysqli_query($db,"call sp_get_common_data('','','','','','','','A','".$Gid."','','','','','','','','','GET_GROUPS')") or die('Query Not execute'.mysqli_error($db));
								 $db->close();
								 if(mysqli_num_rows($querygroup_ds)>0)
								 {
									 while ($row = mysqli_fetch_array($querygroup_ds))
									 {
										$group_id = $row['group_id'];
										$group_name = $row['group_name'];
										$course_id = $row['course_id'];
										$timeing = $row['group_timing'];
										$totalmembers ="1";
									     ?>
										<span class="mRight10"><?php echo $group_name; ?></span>
										<span class="mRight10 amTOpm"><?php echo $timeing; ?></span>
										<a href="manageeditgroups.php?groupid=<?php echo $group_id; ?>" target='_self'><i class="fa fa-pencil" aria-hidden="true"></i></a>
										<?php 
									 } 
									 mysqli_free_result($querygroup_ds);
								 }
							  }
						   ?>
						   <!-- Code end for get the group details--> 
                     </div>
                     <ul class="list-inline">
					    <!-- Code start for get the no of members/books/notes in group--> 
                        <li><a href="manageAddMembers.php?groupid=<?php echo $_GET['groupid']; ?>"">Add Member(s)</a></li>
						<?php 
						      if (isset($_GET['groupid']) && count($_GET) > 0 ) 
						      { 
								 include "cs/config.php";
								 $Gid = mysqli_real_escape_string($db,$_GET['groupid']);
								 $querymem_ds = mysqli_query($db,"call sp_get_common_data('','','','','','','','A','".$Gid."','','','','','','','','','GET_GROUPS_MEMBERS_COUNTS')") or die('Query Not execute'.mysqli_error($db));
								 $db->close();
								 if(mysqli_num_rows($querymem_ds)>0)
								 {
									 $rowm = mysqli_fetch_array($querymem_ds);
									 $totalmembersval = $rowm['totalmembers'];
									 ?>
									 <li><a href="manageListMembers.php?groupid=<?php echo $Gid; ?>" target='_self'><?php echo $totalmembersval; ?> Member(s)</a></li>
									 <?php
									mysqli_free_result($querymem_ds);									 
								 }
								
								 include "cs/config.php";
								 $querybook_ds = mysqli_query($db,"call sp_get_common_data('','','','','','','','A','".$Gid."','','','','','','','','','GET_USER_EBOOK_COUNTS')") or die('Query Not execute'.mysqli_error($db));
								 $db->close();
								 if(mysqli_num_rows($querybook_ds)>=0)
								 {
								      $totalbookval=mysqli_num_rows($querybook_ds);
									  ?>
										<li><a href="subscriber_group_to_book_del.php?groupid=<?php echo $Gid; ?>" target='_blank'><?php echo $totalbookval; ?> eBook(s)</a></li>
									  <?php 
									  mysqli_free_result($querybook_ds);
								 }
								 
								 include "cs/config.php";
								 $querynotes_ds = mysqli_query($db,"call sp_get_common_data('','','','','','','','A','".$Gid."','','','','','','','','','GET_USER_ENOTES_COUNTS')") or die('Query Not execute'.mysqli_error($db));
								 $db->close();
								 if(mysqli_num_rows($querynotes_ds)>=0)
								 {
								     $totalnotesval = mysqli_num_rows($querynotes_ds);
									 ?>
									 <li><a href="subscriber_group_to_book_del.php?groupid=<?php echo $Gid; ?>" target='_blank'><?php echo $totalnotesval; ?> eNote(s)</a></li>
									 <?php 
									 mysqli_free_result($querynotes_ds);
								 }
							  }
						   ?>
						   <!-- Code end for get the no of members/books/notes in group--> 
                     </ul>
                  </div>
               </div>
               <div class="pull-right">
                  <ul class="list-unstyled batchrightPrt">
				        <!-- Code start for get group's details --> 
				      <?php 
						  if (isset($_GET['groupid']) && count($_GET) > 0 ) 
						  { 
						     include "cs/config.php";
							 $Gid = mysqli_real_escape_string($db,$_GET['groupid']); 

						     $qry_ds = mysqli_query($db,"call sp_get_common_data('','','','','','','','A','".$Gid.  "','','','','','','','','','GET_GROUP_COURSE_SUBJECT_TIME')") or die('Query Not execute'.mysqli_error($db));
						     $db->close();
							 if(mysqli_num_rows($qry_ds)>0)
							 {
								 while ($row1 = mysqli_fetch_array($qry_ds))
								 {
									$group_id = $row1['group_id'];
									$coursename = $row1['course_name'];
									$subjectname = $row1['category_name'];
									$crtddate = $row1['crtd_date'];
									$groupdesc = $row1['group_desc'];
									$totalmembers ="1";
									 ?>
									  <li>Course - <?php echo $coursename; ?></li>
									  <li>Subject - <?php echo $subjectname; ?></li>
									  <li>Creation Date - <?php echo $crtddate; ?></li>
									  <li class="mlmSum dot1">Summary - <?php echo $groupdesc; ?></li>
									<?php 
								 } 
								 mysqli_free_result($qry_ds);
							 }
						  }
						   ?>
						    <!-- Code end for get group's details --> 
                  </ul>
               </div>
            </div>
			<form class="form-horizontal modForm1" method="post" id="form1"  enctype="multipart/form-data" action= "<?php $_PHP_SELF ?>">
            <div class="col-xs-12 padd0 mtop20">
               <div class="uploadBox1">
                  <div class="browseLeftPrt">
                     <img src="img/readerIcons/excel.png" alt="Excel Logo" class="img-responsive" />
                  </div>
				   
                  <div class="browseRightPrt paddL10R0">
				   
                     <p>Add Members through Excel</p>
					 <div class="fileUpload1 btn btn-warning bgOrange">
					    <span>UPLOAD</span>
                        <input type="file" name="csvfile" id="csvfile" form="form1" class="upload" />
					   </div>
					   <div class="fileUpload2">
							<a href="Manage_Members_Add_Students.csv"><span class="csvDown">Download</span> template</a>
					   </div>
                     
					 
                       <div class="exclam"  data-toggle="modal" data-target="#myModal">&#xA1;</div>
                     
                       <div class="modal fade" id="myModal" role="dialog">
                       <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                       <div class="modal-header" style="padding:15px 15px 0px 15px;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <p >Add Members through Excel.</p> 
                      </div> 
                       <div align="left">
                          <ol type="I" class="mamDown" >
                            <li ><a style='color:#EF7F1B;' href="Manage_Members_Add_Students.csv"> Download</a> the template. </li>
                            <li>Fill in the details in the given format</li>
                            <li>Upload the file</li>
                          </ol> 
                       </div>
					   <div class="mamNote">Note: Ensure file is in .csv format.</div>
                      </div>
					  </div>
					 </div>
					   
					  <input type="submit" name="submitcsvfile" id="submitcsvfile" value="SAVE" class="fileUpload1 btn btn-warning bgOrange" form="form1" style='display:none;' />
                  </div>
               </div>
            </div>
            <div class="col-xs-12 divOR padd0">
               <div class="dividerOR">
                  <div class="absOR">OR</div>
               </div>
            </div>
            <div class="col-xs-12 padd0">
               <div class="table-responsive">
                  <table id="dataTable" name="dataTable" class="table mgTable2">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>MEMBER NAME</th>
                           <th>EMAIL</th>
                           <th>REGISTRATION NO</th>
                           <th>PHONE NO</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>1</td>
                           <td><input class="form-control" type="text" id='name1' name='name1'></td>
                           <td><input class="form-control" type="text" id='email1' name='email1'></td>
                           <td><input class="form-control" type="text" id='detail11' name='detail11'></td>
                           <td><input class="form-control" type="text" id='detail21' name='detail21'></td>
                        </tr>
                        <tr>
                           <td>2</td>
                           <td><input class="form-control" type="text" id='name2' name='name2'></td>
                           <td><input class="form-control" type="text" id='email2' name='email2'></td>
                           <td><input class="form-control" type="text" id='detail12' name='detail12'></td>
                           <td><input class="form-control" type="text" id='detail22' name='detail22'></td>
                        </tr>
                        <tr>
                           <td>3</td>
                          <td><input class="form-control" type="text" id='name3' name='name3'></td>
                           <td><input class="form-control" type="text" id='email3' name='email3'></td>
                           <td><input class="form-control" type="text" id='detail13' name='detail13'></td>
                           <td><input class="form-control" type="text" id='detail23' name='detail23'></td>
                        </tr>
                        <tr>
                           <td>4</td>
                          <td><input class="form-control" type="text" id='name4' name='name4'></td>
                           <td><input class="form-control" type="text" id='email4' name='email4'></td>
                           <td><input class="form-control" type="text" id='detail14' name='detail14'></td>
                           <td><input class="form-control" type="text" id='detail24' name='detail24'></td>
                        </tr>
                        <tr>
                           <td>5</td>
                          <td><input class="form-control" type="text" id='name5' name='name5'></td>
                           <td><input class="form-control" type="text" id='email5' name='email5'></td>
                           <td><input class="form-control" type="text" id='detail15' name='detail15'></td>
                           <td><input class="form-control" type="text" id='detail25' name='detail25'></td>
                        </tr>
                     </tbody>
                  </table>
				  <input type='hidden' id='tablerowcount' name='tablerowcount' />
				  <input type='hidden' id='tablecolumncount' name='tablecolumncount' />
               </div>
            </div>
            <div class="col-xs-12 padd0 mbAddSub clrOrange">
               <i class="fa fa-plus" aria-hidden="true"></i><a onclick="addRow('dataTable')" style='cursor: pointer;'>Add more members</a>
            </div>
            <div class="col-xs-12 padd0 mtop20">
               <!--<button type="button" class="btn mbBtn1 btn-default">SAVE</button>-->
			   <input type="submit" class="btn mbBtn1 btn-default" form="form1" id="save" name="save" value="SAVE">
               <button type="button" class="btn mbBtn2 btn-default" onclick="goBack()">CANCEL</button>
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
      <script src="js/jasny-bootstrap.min.js"></script>
      <script src="js/jquery.dotdotdot.min.js"></script>
      <script src="js/index.js"></script>
	  <script>
		$(document).ready(function() {
			$('.dot1').dotdotdot();
		});
	  </script>
	   <script>
		   function goBack() 
			{
			  window.history.go(-1);
			}
        </script>
   </body>
</html>
<?php ob_end_flush(); ?>

// <?php
 // error_reporting(1);
 // include "cs/config.php";
 // $csvfile = $_FILES['csvfile']['name'];
 // $ext = pathinfo($csvfile, PATHINFO_EXTENSION);
 // $base_name = pathinfo($csvfile, PATHINFO_BASENAME);
 // if (isset($_POST['submit'])) {
 // if(!$_FILES['csvfile']['name'] == "")
    // {
     // if($ext == "csv")
     // {
       // if(file_exists($base_name))
       // {
        // echo "file already exist" . $base_name;
       // }
       // else
          // {
          // if (is_uploaded_file($_FILES['csvfile']['tmp_name']))
            // {
            // "<h1>" . "File ". $_FILES['filename']['name'] ." uploaded successfully." . "</h1>";
            // readfile($_FILES['csvfile']['tmp_name']);                                                   }
            // $handle = fopen($_FILES['csvfile']['tmp_name'], "r");
            // while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
             // {
             	  // /* $Id = addslashes($_POST['id'.$x]);
				   // $Name = addslashes($_POST['name'.$x]);
				   // $Address = addslashes($_POST['address'.$x]);
				   // $Phone = addslashes($_POST['phone'.$x]);*/

				    // $Id = $_POST['id'];
	                // $Name = $_POST['name'];
	                // $Address = $_POST['address'];
	                // $Phone=$_POST['phone'];
				     // echo "<script>alert($Name)</script>";

                        // $UserType="1";
						// $RoleId="1";
						// $status='T';
						// $regis_type='GROUP';
						// $User_Password="123";
						// include "cs/config.php";
						// $resultds1 = mysqli_query($db,"call sp_insert_members('','".$Name."','".$Address."','".$Phone."','INSERT_MEMBERS',@resultmsg,@errormsg)") 
						// or die('Query Not execute'.mysqli_error($db));
						// $db->close();
						
						// if (mysqli_num_rows($resultds1) > 0) {
						 // while($row = mysqli_fetch_array($resultds1)) {
							// $result= $row['resultval'];
							// $IsError= $row['IsErrorval'];
							// $MID = $row['Member_Id'];
						 // }
					      // mysqli_free_result($resultds1);
						 // }
             // }
             // fclose($handle);
             // echo "Import done";
           // } 
       // }
        // else
            // {
             // echo " Check Extension. your extension is ." . $ext;  
            // } 
   // }  
       // else
           // {
            // echo "Please Upload File";
           // }
  // } 
//?>