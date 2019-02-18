<?php
     include "../cs/config.php";
    
	 $BNID = mysqli_real_escape_string($db,$_POST['bookid']); 	
     $BNID="53";
	 
	 include "../cs/config.php";
	 require_once "../cs/common.php";
	 $qryds = mysqli_query($db, "call sp_get_common_data('','','".$BNID."','','','','','A','','','','','','','','','','GET_BOOKFORREADER')");
	 $db->close();
	 if(mysqli_num_rows($qryds)>0)
	 {
		  $domDocument = new DOMDocument('1.0', "UTF-8");
		  $domElement = $domDocument->createElement('page');
		  while($rowbook= mysqli_fetch_array($qryds))
		  {
			 $domElementEditions = $domDocument->createElement('story');
			 $domElement->appendChild($domElementEditions);
			 
			 $domElementboxid = $domDocument->createElement('boxid', '0');
			 $domElementEditions->appendChild($domElementboxid);
			
			 $domElementparentid = $domDocument->createElement('parentid', '0');
			 $domElementEditions->appendChild($domElementparentid);
			
			 $domElementCoordi = $domDocument->createElement('Coordinates');
			 $domElementEditions->appendChild($domElementCoordi);
			 
			 $domElementTop = $domDocument->createElement('Top', '0');
			 $domElementCoordi->appendChild($domElementTop);
			  $domElementBottom = $domDocument->createElement('Bottom', '0');
			 $domElementCoordi->appendChild($domElementBottom);
			  $domElementLeft = $domDocument->createElement('Left', '0');
			 $domElementCoordi->appendChild($domElementLeft);
			  $domElementRight = $domDocument->createElement('Right', '0');
			 $domElementCoordi->appendChild($domElementRight);
			 
			 $domElementHeadline = $domDocument->createElement('headline', $rowbook['pagetitle']);
			 $domElementEditions->appendChild($domElementHeadline);
			 
			 $imagepath = $rowbook['imagepath'];
			 $img_path=$S3URL.$imagepath; 
			 
			 $domElementLargeimage = $domDocument->createElement('largeimage', $img_path);
			 $domElementEditions->appendChild($domElementLargeimage);
			 
			 $domElementDescription = $domDocument->createElement('description', '0');
			 $domElementEditions->appendChild($domElementDescription);
			 
			 $domElementAuthor = $domDocument->createElement('author', '0');
			 $domElementEditions->appendChild($domElementAuthor);
			  
			 //$domElementEditions->appendChild($domElementEdcode);
	    }
		$domDocument->appendChild($domElement);
	 }
	 $qryds->close();
     echo '<pre>'.htmlentities($domDocument->saveXML(), ENT_COMPAT | ENT_HTML401, "ISO-8859-1") . '</pre>';		


?>
