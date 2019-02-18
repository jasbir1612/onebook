<?php
    include "../cs/config.php";
    
	$UID = mysqli_real_escape_string($db,$_POST['userid']); 
	$UEID = mysqli_real_escape_string($db,$_POST['email_id']); 
	$Sid = mysqli_real_escape_string($db,$_POST['subjectid']); 
	$Cid = mysqli_real_escape_string($db,$_POST['courseid']);
	
    $UID="14";
	$UEID="rajatnandwani1991@gmail.com";
	$Sid="";
	$Cid="";
	
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
	
	if(mysqli_num_rows($run)>0)
	{
	  //$rss.="<data>";
	  $domDocument = new DOMDocument('1.0', "UTF-8");
	  $domElement = $domDocument->createElement('data');
	  while($rowcat = mysqli_fetch_array($run))
	  {
	     $catid = $rowcat['category_id'];
		 $catname = $rowcat['category_name'];
		 $json_response['category_name']=$catname;
		 
		 include "../cs/config.php";
		 require_once "../cs/common.php";
		 $runbook = $db->query("call sp_get_bookstore_user('".$Cid."','".$catid."','','".$UID."','','GETBOOKNOTESUSER')");
		 $db->close();
		  if(mysqli_num_rows($runbook)>0)
	      {
		      while($rowbook= mysqli_fetch_array($runbook))
		      {
		            $BNId=$rowbook['id'];
					$domElementEditions = $domDocument->createElement('editions');
					$domElement->appendChild($domElementEditions);
					
					$domElementEdition = $domDocument->createElement('edition', $rowbook['title']);
					$domElementEditions->appendChild($domElementEdition);
					
					$domElementEdcode = $domDocument->createElement('edcode', $BNId);
					$domElementEditions->appendChild($domElementEdcode);
		    }
		 }
	     $runbook->close();
	  }
      //$rss.="</data>";
	  $domDocument->appendChild($domElement);
	}
	
	//echo $rss;
	echo '<pre>'.htmlentities($domDocument->saveXML(), ENT_COMPAT | ENT_HTML401, "ISO-8859-1") . '</pre>';
	//echo $domDocument->saveXML();
	 //printf ("<pre>%s</pre>", htmlentities ($domDocument->saveXML()));
	 
	//echo'{"Books":'.json_encode($return_arr).'}';
	$run->close(); 
 
 
 
 

 




?>
