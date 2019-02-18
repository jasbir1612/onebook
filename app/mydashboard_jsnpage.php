<?php
    include "../cs/config.php";
    
	$UID = mysqli_real_escape_string($db,$_POST['userid']); 
	$UEID = mysqli_real_escape_string($db,$_POST['email_id']); 
	$Sid = mysqli_real_escape_string($db,$_POST['subjectid']); 
	$Cid = mysqli_real_escape_string($db,$_POST['courseid']);
	
    // $UID="14";
	// $UEID="rajatnandwani1991@gmail.com";
	// $Sid="";
	// $Cid="";
	
	 if(isset($_POST['courseid']) && count($_POST) > 0 )
	 {
		 $Sid=$_POST['courseid'];
		 if($Sid=='All')
		 {
			$Sid="";
		 }
	 }
	 if(isset($_POST['subjectid']) && count($_POST) > 0 ) 
	 {
		 $Cid=$_POST['subjectid']; 
		 if($Cid=='All')
		 {
			$Cid="";
		 }
	 }
 
	$return_arr = array();
	$json_response = array();
	$run = mysqli_query($db,"call sp_get_bookstore_user('".$Cid."','".$Sid."','','".$UID."','','GETCATEGORYUSER')");	
	$db->close();	
	while($rowcat = mysqli_fetch_array($run))
	{
	    $catid = $rowcat['category_id'];
		$catname = $rowcat['category_name'];
		$json_response['category_name']=$catname;
		
		 include "../cs/config.php";
		 require_once "../cs/common.php";
		 $runbook = $db->query("call sp_get_bookstore_user('".$Cid."','".$catid."','','".$UID."','','GETBOOKNOTESUSER')");
		 $db->close();
		 
		 while($rowbook= mysqli_fetch_array($runbook))
		 {
		            $BNId=$rowbook['id'];
					$json_response['bookid'] = $rowbook['id'];
					$json_response['title'] = $rowbook['title'];
					$json_response['author'] = $rowbook['author'];
					$price = 'NA';
					$longtitle = $rowbook['long_title'];
					$json_response['publication'] = $rowbook['publication'];
					$json_response['edition']  = $rowbook['edition'];
					$json_response['pages'] = $rowbook['pages'];
					$printisbn = $rowbook['print_isbn'];
					$etextisbn = $rowbook['etext_isbn'];
					$thumbimg = $rowbook['thumb_img'];
					$largeimg = $rowbook['large_img'];
					$booktypeval = $rowbook['book_type'];
					if($booktypeval=="BOOK")
					{
					  $booktypeval="eBook";
					}
					else
					{
					  $booktypeval="eNotes";
					}
					$json_response['book_type']=$booktypeval;
					if($thumbimg!="")
					{
					 $thumbimgpath=returnthbimage($thumbimg);
					 $largeimgpath=returnthbimage($largeimg);
					 $thumbimgpath=$S3URL.$thumbimgpath;
					 $largeimgpath=$S3URL.$largeimgpath;
					}
					else
					{
					  $thumbimgpath=$SiteURL.$DefaultThumbPath;
					  $largeimgpath=$SiteURL.$DefaultLargePath;
					}
					$json_response['thumb_img']=$thumbimgpath;
					$json_response['large_img']=$largeimgpath;
					
					include "../cs/config.php";
					$qryds = mysqli_query($db, "call sp_get_common_data('','','".$BNId."','','','','','A','','','','','','','','','','GET_BOOKFORREADER')");
					$db->close();
					
					$json_response['totalpages'] = mysqli_num_rows($qryds);
					$img_path=$S3URL."gall_images/".$BNId; 
					$json_response['bookurl'] = $img_path;
					$json_response['bookurlpage'] = $img_path . "/page1.jpg";
					$json_response['bookurlzip'] = $img_path .".zip";
					$json_response['bookstatus'] = "NA";
					$json_response['bookmoddate']=$rowbook['mod_page_date'];
					
					// $zipfile=$img_path .".zip";
					// $zipfileurl = get_headers("".$zipfile."", 1);
					// $zipfilesize=bytesToSize($zipfileurl["Content-Length"]);
					// $json_response['zipfilesize']=$zipfilesize;
					
					if(mysqli_num_rows($qryds)>0)
					{
						//$i=0;
						$AllActivePages="";
						while($rowcatp = mysqli_fetch_array($qryds))
						{
							 $pageno = $rowcatp['pageno'];
							// $pagetitle = $rowcatp['pagetitle'];
							// $imagepath = $rowcatp['imagepath'];
							//echo "<li><a href='#' onClick='javascript:goToSlide($pageno);'>$pagetitle</a></li>";
							//$i=$i+1;
							//$pageno.= $pageno . ",";
							//$pageno=implode(',',$pageno);
							$AllActivePages .= $pageno . ",";
						}
						$AllActivePages=substr(trim($AllActivePages), 0, -1);
						$json_response['activepages']=$AllActivePages;
					}
					$qryds->close();
					
					array_push($return_arr,$json_response); 
			}
			$runbook->close();
	}
	echo'{"Books":'.json_encode($return_arr).'}';
	$run->close(); 
 
 
 
 

 




?>
