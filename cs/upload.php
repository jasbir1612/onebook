<?php
ini_set('max_execution_time', 3600); 
ini_set('memory_limit','128M');

function singleimgupload($imagename,$upload_folder,$cropimage)
{

if (is_uploaded_file($_FILES[$imagename]['tmp_name'])) 
{ 
    //Get the Filename and the File Type 
    $fileName = $_FILES[$imagename]['name'];
	//echo $fileName;
    $fileType = $_FILES[$imagename]['type']; 
	//$fileType =strtolower($fileType1);

	 
/*************file nm start****************/
$str1=date(Y)."-".date(m)."-".date(d);
$fileName=$str1."~".$fileName;

if($cropimage=="2")
{
$filenamebig=imagelarge($fileName,$upload_folder);
}
else
{
$filenamebig="";
}
$filenamemedium=imagemedium($fileName,$upload_folder);
$filenamethumb=imagethumb($fileName,$upload_folder);

//echo "reena11>>".$filenamebig."-".$filenamemedium."-".$filenamethumb."<br>";

if($cropimage=="1")
{
$strfile=$filenamethumb;
}
if($cropimage=="2")
{
$strfile=$filenamebig;
}

/*************file nm end****************/


//if (($fileType == 'image/jpg') || ($fileType == 'image/pjpeg') || ($fileType == 'image/jpeg') || ($fileType == 'image/gif') || ($fileType == 'text/plain') || ($fileType == 'application/pdf')   || ($fileType == 'image/png') || ($fileType == 'text/htm')) 

if (($fileType == 'image/jpg') || ($fileType == 'image/pjpeg') || ($fileType == 'image/jpeg') || ($fileType == 'image/gif') || ($fileType == 'image/png') ) 
{ 

if (move_uploaded_file($_FILES[$imagename]['tmp_name'],$upload_folder.''.$strfile)) 
	{ 

$upload_folder1=$upload_folder;

if ($cropimage=="2")
{
createBigThumbs($upload_folder1,$upload_folder,660,$strfile,$fileType);
if(!file_exists($upload_folder . '/' . $filenamebig))
	createBigThumbs($upload_folder1,$upload_folder,660,$strfile,$fileType);
}

createMediumThumbs($upload_folder1,$upload_folder,320,$strfile,$fileType,$filenamemedium);

if(!file_exists($upload_folder . '/' . $filenamemedium))	createMediumThumbs($upload_folder1,$upload_folder,320,$strfile,$fileType,$filenamemedium);

createThumbs($upload_folder1,$upload_folder,100,$strfile,$fileType,$filenamethumb);
if(!file_exists($upload_folder . '/' . $filenamethumb))	createThumbs($upload_folder1,$upload_folder,100,$strfile,$fileType,$filenamethumb);
	 }
	 
}

return $filenamebig."^".$filenamemedium."^".$filenamethumb;

}

return $fileName1;

}



function singletextupload($imagename,$upload_folder)
{

if (is_uploaded_file($_FILES[$imagename]['tmp_name'])) 
{ 
    //Get the Filename and the File Type 
    $fileName = $_FILES[$imagename]['name'];
	//echo $fileName;
    $fileType = $_FILES[$imagename]['type']; 
	//$fileType =strtolower($fileType1);
	 
///// file nm start
$str1=date(Y)."-".date(m)."-".date(d);
$fileName=$str1."~".$fileName;

//echo $upload_folder .'/' . $fileName;

if ($fileName!="")
{
if (file_exists($upload_folder . '/' . $fileName)) 
{
// append a digit to the beginning of the name
$tmpVar1 = 1;
$filenamestr=split('~',$fileName);
$filenamestr0=$filenamestr[0];
$filenamestr1=$filenamestr[1];

while(file_exists($upload_folder . '/' . $filenamestr0.'~'.$tmpVar1 . '-' . $filenamestr1)) 
   {
	// and keep increasing it until we have a unique name
   $tmpVar1++;
   }
  
  $fileName2= $tmpVar1 . '-' . $filenamestr1;
  $fileName=$filenamestr0.'~'.$fileName2;

  //echo "reena>>".$fileName;
}

}

//////// file nm end 

if (($fileType == 'image/jpg') || ($fileType == 'image/pjpeg') || ($fileType == 'image/jpeg') || ($fileType == 'image/gif') || ($fileType == 'text/plain') || ($fileType == 'application/pdf')   || ($fileType == 'image/png') || ($fileType == 'text/htm')) 
{ 

if (move_uploaded_file($_FILES[$imagename]['tmp_name'],$upload_folder.''.$fileName)) 
	{ 
	 }
}

}

return $fileName;
}




function uploadgall($strfoldername)
{
$sysdate= date(d);
$sysmonth= date(m);
$sysyear= date(Y);

$folderyr = $strfoldername.$sysyear;
$foldermn = $folderyr."/".$sysmonth;
$folderdy = $foldermn."/".$sysdate;

	if (is_dir($folderyr))
	{
	$flag="T";
	}
	else
	{
	mkdir($folderyr,0777);
	chmod($folderyr, 0777);
	$flag="F";
	}

		if(is_dir($foldermn))
		{
		$flag="T";			
		}
		else
		{
		mkdir($foldermn,0777);
		chmod($foldermn, 0777);
		$flag="F";
		}

			if(is_dir($folderdy))
			{
			$flag="T";
			}
			else
			{
			mkdir($folderdy,0777);
			chmod($folderdy, 0777);
			$flag="F";
			}

	return $folderdy;
}



function multiplegalupload($newsid,$imgname,$imgpath,$userid,$funcname)
{

$imgcount=count($_FILES[$imgname]['name']);

//echo "hhhhhhhhhh>>".$imgcount;

if($imgcount>'0') 
{
//check if any file uploaded
$GLOBALS['msg'] = ""; //initiate the global message

$filen="";
$filen1="";

for($j=0; $j <$imgcount; $j++) 
{ //loop the uploaded file array
			
$filen1 = $_FILES[$imgname]['name']["$j"]; //file name

$fileType1 = $_FILES[$imgname]['type']["$j"]; 
			
//echo "file type >".$fileType1."<br>";
$str1=date(Y)."-".date(m)."-".date(d);

$filen1=$str1."~".$filen1;

///// file nm start
if ($filen1!="")
{
$foldername=$imgpath;

$sysfolder=uploadgall($foldername);

//echo $sysfolder;
if (file_exists($sysfolder . '/' . $filen1)) {
// append a digit to the beginning of the name
  $tmpVar1 = 1;

$filenamestr=split('~',$filen1);
$filenamestr0=$filenamestr[0];
$filenamestr1=$filenamestr[1];

while(file_exists($sysfolder . '/' . $filenamestr0.'~'.$tmpVar1 . '-' . $filenamestr1)) {
 // while(file_exists($sysfolder . '/' . $tmpVar1 . '-' . $filen1)) {
// and keep increasing it until we have a unique name
   $tmpVar1++;
   }
	$fileName2= $tmpVar1 . '-' . $filenamestr1;

	$filen1=$filenamestr0.'~'.$fileName2;

  //$filen1= $tmpVar1 . '-' . $filen1;
  } 
}
$gpath=$filen1;

//////// file nm end
$path = $sysfolder."/".$filen1; //generate the destination path

	//echo $path;
	
	if ($fileType1 == 'image/jpg') 
		{
		$fileType ="jpg";
		}
	if ($fileType1 == 'image/pjpeg') 
		{
		$fileType ="jpg";
		}
	if ($fileType1 == 'image/jpeg') 
	{
		$fileType ="jpeg";
	}	
	if ($fileType1 == 'image/gif')
		{
		$fileType ="gif";
		}
	if ($fileType1 == 'image/png') 
		{
		$fileType ="png";
		}
	if ($fileType1 == 'video/x-ms-wmv') 
		{
		$fileType ="wmv";
		}
	if ($fileType1 == 'audio/wav') 
		{
		$fileType ="wav";
		}
	if(move_uploaded_file($_FILES[$imgname]['tmp_name']["$j"],$path)) { //upload the file
		$GLOBALS['msg'] .= "File# ".($j+1)." ($filen1) uploaded successfully<br>"; //Success message
	}

	$strdsc2=$_REQUEST['TN_desc'];
	$strdsc1=str_replace("'","~",$strdsc2);
	$gdesc=$strdsc1[$j];
	$gcap=$gdesc;

	$strembed2=$_REQUEST['TN_embed'];
	$strembed1=str_replace("'","~",$strembed2);
	$gembed=$strembed1[$j];

	$strimgtype1=$_REQUEST['TN_imgtype'];
	$gtype=$strimgtype1[$j];

	

if ($_FILES[$imgname]['name']["$j"]!="") 
{
//insertnewsgal($newsid,$gtype,$gcap,$gpath,$gdesc,$gembed,$userid);
$funcname($newsid,$gtype,$gcap,$gpath,$gdesc,$gembed,$userid);

} //if loop end when inserting data


}//end of forloop



}//if loop end

}
?>

<?php

function multiplegalupdate($autoid,$img1,$imgpath,$userid,$funcname1)
{
//echo "hhhhhhhhhh>>".$img1;

$imgcount=count($_FILES[$img1]['name']);

//echo '>>'.$imgcount;

if($imgcount>'0') 
{
//check if any file uploaded
$GLOBALS['msg'] = ""; //initiate the global message

$filen="";
$filen1="";



for($j=0; $j <$imgcount; $j++) 
{ //loop the uploaded file array
			
$filen1 = $_FILES[$img1]['name']["$j"]; //file name

$fileType1 = $_FILES[$img1]['type']["$j"]; 
			
$str1=date(Y)."-".date(m)."-".date(d);

$filen1=$str1."~".$filen1;

///// file nm start
if ($filen1!="")
{
$foldername=$imgpath;

$sysfolder=uploadgall($foldername);

//echo $sysfolder;
if (file_exists($sysfolder . '/' . $filen1)) {
// append a digit to the beginning of the name
  $tmpVar1 = 1;

$filenamestr=split('~',$filen1);
$filenamestr0=$filenamestr[0];
$filenamestr1=$filenamestr[1];

while(file_exists($sysfolder . '/' . $filenamestr0.'~'.$tmpVar1 . '-' . $filenamestr1)) {
 // while(file_exists($sysfolder . '/' . $tmpVar1 . '-' . $filen1)) {
// and keep increasing it until we have a unique name
   $tmpVar1++;
   }
	$fileName2= $tmpVar1 . '-' . $filenamestr1;

	$filen1=$filenamestr0.'~'.$fileName2;

  //$filen1= $tmpVar1 . '-' . $filen1;
  } 
}

$gpath1=$filen1;

//////// file nm end
$path = $sysfolder."/".$filen1; //generate the destination path

	//echo $path;
	
	if ($fileType1 == 'image/jpg') 
		{
		$fileType ="jpg";
		}
	if ($fileType1 == 'image/pjpeg') 
		{
		$fileType ="jpg";
		}
	if ($fileType1 == 'image/jpeg') 
	{
		$fileType ="jpeg";
	}	
	if ($fileType1 == 'image/gif')
		{
		$fileType ="gif";
		}
	if ($fileType1 == 'image/png') 
		{
		$fileType ="png";
		}
	if ($fileType1 == 'video/x-ms-wmv') 
		{
		$fileType ="wmv";
		}
	if ($fileType1 == 'audio/wav') 
		{
		$fileType ="wav";
		}
	if(move_uploaded_file($_FILES[$img1]['tmp_name']["$j"],$path)) { //upload the file
		$GLOBALS['msg'] .= "File# ".($j+1)." ($filen1) uploaded successfully<br>"; //Success message
	}

	$strdsc2=$_REQUEST['cap'];
	$strdsc1=str_replace("'","~",$strdsc2);
	$gdesc1=$strdsc1[$j];
	$gcap1=$gdesc1;

	$strembed2=$_REQUEST['embed'];
	$strembed1=str_replace("'","~",$strembed2);
	$gembed1=$strembed1[$j];

//echo "ssssssss>>".$strembed2;

	
if ($_FILES[$img1]['name']["$j"]!="") 
{
$funcname1($autoid,$gcap1,$gpath1,$gdesc1,$gembed1,$userid);
}//if loop end when inserting data


}//end of forloop

}//if loop end

}
?>


<?php


function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth,$fnamestr,$fileType,$filenamethumb) 
{
 
//echo "ggggggg>>".$fileType."-".$fnamestr."-".$pathToImages."<br>";
 //$fnamestr2="";

// $width5="";
// $height5="";
//$img="";

	if (($fileType=='jpg') || ($fileType=='jpeg') || ($fileType=='JPG') || ($fileType=='image/pjpeg') || ($fileType == 'image/jpeg'))
	{
	  $img = imagecreatefromjpeg("{$pathToImages}{$fnamestr}");
	}

	if (($fileType=='gif') || ($fileType=='GIF') || ($fileType=='image/gif'))
	{
      $img = imagecreatefromgif("{$pathToImages}{$fnamestr}");

	}
	if (($fileType=='png') || ($fileType=='PNG') || ($fileType=='image/png') )
	{
      $img = imagecreatefrompng("{$pathToImages}{$fnamestr}");
	}
	
//echo "eeee>>".$img."<br>";

      $width5 = imagesx($img);
      $height5 = imagesy($img);

//echo "actual>>".$width5.",".$height5."<br>";

	if ($width5>=$height5)
	{
      // calculate thumbnail size
      $new_width5 = $thumbWidth;
      $new_height5 = floor( $height5 * ( $thumbWidth / $width5 ) );
	}


	if ($width5<$height5)
	{
	$thumbWidth4=135;
	$new_height5 = $thumbWidth4;
    $new_width5 = floor( $width5 * ( $thumbWidth4 / $height5 ) );
	}

//echo "ddddddd>>".$new_width5.",".$new_height5;

      // create a new temporary image
      $tmp_img5 = imagecreatetruecolor( $new_width5, $new_height5 );

      // copy and resize old image into new image 
     // imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

	 imagecopyresampled( $tmp_img5, $img, 0, 0, 0, 0, $new_width5, $new_height5, $width5, $height5 );


$fnamestr2=$filenamethumb;
      // save thumbnail into a file
      imagejpeg( $tmp_img5, "{$pathToThumbs}{$fnamestr2}" );

	imagedestroy($tmp_img5);  
	//imagedestroy($img); 
   }


function createBigThumbs( $pathToImages1, $pathToThumbs1, $thumbWidth1,$fnamestr1,$fileType1) 
{
 //echo "ddddddd>>".$fileType1."<br>";

	if (($fileType1=='jpg') || ($fileType1=='jpeg') || ($fileType1=='JPG') || ($fileType1=='image/pjpeg') || ($fileType == 'image/jpeg') )
	{
		
      $img1 = imagecreatefromjpeg("{$pathToImages1}{$fnamestr1}");
	  
	}
	if (($fileType1=='gif') || ($fileType1=='GIF') || ($fileType1=='image/gif'))
	{
      $img1 = imagecreatefromgif( "{$pathToImages1}{$fnamestr1}" );

	}
	if (($fileType1=='png') || ($fileType1=='PNG') || ($fileType1=='image/png'))
	{
      $img1 = imagecreatefrompng( "{$pathToImages1}{$fnamestr1}" );
	}
	
      $width1 = imagesx( $img1 );
      $height1 = imagesy( $img1 );


	if ($width1>=$height1)
	{
      // calculate thumbnail size
      $new_width1 = $thumbWidth1;
      $new_height1 = floor( $height1 * ( $thumbWidth1 / $width1 ) );
	}

	
	if ($width1<$height1)
	{
	$thumbWidth2=487;
	$new_height1 = $thumbWidth2;
    $new_width1 = floor( $width1 * ( $thumbWidth2 / $height1 ) );
	}


      // create a new temporary image
      $tmp_img1 = imagecreatetruecolor( $new_width1, $new_height1 );

      // copy and resize old image into new image 
      imagecopyresized( $tmp_img1, $img1, 0, 0, 0, 0, $new_width1, $new_height1, $width1, $height1 );

//echo "rrrrrr".$fnamestr1;

$fnamestr2=$fnamestr1;
      // save thumbnail into a file
      imagejpeg( $tmp_img1, "{$pathToThumbs1}{$fnamestr2}" );

	  imagedestroy($tmp_img1);  
	  //imagedestroy($img1); 
   }


function createMediumThumbs( $pathToImages1, $pathToThumbs1, $thumbWidth1,$fnamestr1,$fileType1,$filenamemedium) 
{
 //echo "medium>>". $fileType1."<br>";

	if (($fileType1=='jpg') || ($fileType1=='jpeg') || ($fileType1=='JPG') || ($fileType1=='image/pjpeg') || ($fileType1 == 'image/jpeg') )
	{
		
      $img1 = imagecreatefromjpeg("{$pathToImages1}{$fnamestr1}");
	  
	}
	if (($fileType1=='gif') || ($fileType1=='GIF') || ($fileType1=='image/gif'))
	{
      $img1 = imagecreatefromgif( "{$pathToImages1}{$fnamestr1}" );

	}
	if (($fileType1=='png') || ($fileType1=='PNG') || ($fileType1=='image/png'))
	{
      $img1 = imagecreatefrompng( "{$pathToImages1}{$fnamestr1}" );
	}
	
      $width1 = imagesx( $img1 );
      $height1 = imagesy( $img1 );

//echo "actual medium>>".$width1.",".$height1."<br>";

	if ($width1>=$height1)
	{
      // calculate thumbnail size
      $new_width1 = $thumbWidth1;
      $new_height1 = floor( $height1 * ( $thumbWidth1 / $width1 ) );
	}

	
	if ($width1<$height1)
	{
	$thumbWidth2=400;
	$new_height1 = $thumbWidth2;
    $new_width1 = floor( $width1 * ( $thumbWidth2 / $height1 ) );
	}


      // create a new temporary image
      $tmp_img1 = imagecreatetruecolor( $new_width1, $new_height1 );

      // copy and resize old image into new image 
      imagecopyresized( $tmp_img1, $img1, 0, 0, 0, 0, $new_width1, $new_height1, $width1, $height1 );

//echo "rrrrrr".$fnamestr1;

$fnamestr2=$filenamemedium;
      // save thumbnail into a file
      imagejpeg( $tmp_img1, "{$pathToThumbs1}{$fnamestr2}" );

	//free memory
	imagedestroy($tmp_img1);  
	imagedestroy($img1); 
   }

?>

<?php


function multiplegalupload_news($newsid,$imgname,$imgpath,$userid,$funcname)
{

$imgcount=count($_FILES[$imgname]['name']);

//echo "hhhhhhhhhh>>".$imgcount;

if($imgcount>'0') 
{
	
//check if any file uploaded
$GLOBALS['msg'] = ""; //initiate the global message

$filen="";
$filen1="";
$gpath='';

for($j=0; $j <$imgcount; $j++) 
{ //loop the uploaded file array
			
$filen1 = $_FILES[$imgname]['name']["$j"]; //file name

$fileType1 = $_FILES[$imgname]['type']["$j"]; 
			
//echo "file type >".$fileType1."<br>";
$str1=date(Y)."-".date(m)."-".date(d);

$filen1=$str1."~".$filen1;

///// file nm start
if ($filen1!="")
{
$foldername=$imgpath;

$sysfolder=uploadgall($foldername);

//echo $sysfolder;
if (file_exists($sysfolder . '/' . $filen1)) {
// append a digit to the beginning of the name
  $tmpVar1 = 1;

$filenamestr=split('~',$filen1);
$filenamestr0=$filenamestr[0];
$filenamestr1=$filenamestr[1];
$fileName2='';

while(file_exists($sysfolder . '/' . $filenamestr0.'~'.$tmpVar1 . '-' . $filenamestr1)) {
 // while(file_exists($sysfolder . '/' . $tmpVar1 . '-' . $filen1)) {
// and keep increasing it until we have a unique name
   $tmpVar1++;
   }
	$fileName2= $tmpVar1 . '-' . $filenamestr1;

	$filen1=$filenamestr0.'~'.$fileName2;

  //$filen1= $tmpVar1 . '-' . $filen1;
  } 
}
$gpath=$filen1;

//////// file nm end
$path = $sysfolder."/".$filen1; //generate the destination path

	//echo $path;
	
	if ($fileType1 == 'image/jpg') 
		{
		$fileType ="jpg";
		}
	if ($fileType1 == 'image/pjpeg') 
		{
		$fileType ="jpg";
		}
	if ($fileType1 == 'image/jpeg') 
	{
		$fileType ="jpeg";
	}	
	if ($fileType1 == 'image/gif')
		{
		$fileType ="gif";
		}
	if ($fileType1 == 'image/png') 
		{
		$fileType ="png";
		}
	if ($fileType1 == 'video/x-ms-wmv') 
		{
		$fileType ="wmv";
		}
	if ($fileType1 == 'audio/wav') 
		{
		$fileType ="wav";
		}
	if(move_uploaded_file($_FILES[$imgname]['tmp_name']["$j"],$path)) { //upload the file
		$GLOBALS['msg'] .= "File# ".($j+1)." ($filen1) uploaded successfully<br>"; //Success message
	}



	$strdsc2=$_REQUEST['TN_desc'];
	$strdsc1=str_replace("'","~",$strdsc2);
	$gdesc=$strdsc1[$j];
	$gcap=$gdesc;

	$strembed2=$_REQUEST['TN_embed'];
	$gembed1=$strembed2[$j];
	//$gembed= htmlentities($gembed1);
	//$gembed= html2txt($gembed1);
	$gembed=$gembed1;

	//echo "ddddggg>>".$gembed1."<br>".$gcap;

	$strimgtype1=$_REQUEST['TN_imgtype'];
	$gtype=$strimgtype1[$j];

	$str4="";
	$str4=$_REQUEST['rdval'];

	if(trim($j)==trim($str4))
	{
	$hstatus="1";
	}
	else
	{
	$hstatus="0";
	}

//echo "gggggggggg>>".$fileName2;

if (($_FILES[$imgname]['name']["$j"]!="") || ($hstatus=="1"))
{
$funcname($newsid,$gtype,$gcap,$gpath,$gdesc,$gembed,$userid,$hstatus);

} //if loop end when inserting data

if(($gembed!='') && (($_FILES[$imgname]['name']["$j"]!="")==''))
{
$gpath='';
$funcname($newsid,$gtype,$gcap,$gpath,$gdesc,$gembed,$userid,$hstatus);

}


}//end of forloop



}//if loop end

}
?>

<?php
function html2txt($document){ 
$search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript 
               '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags 
               '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly 
               '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA 
); 
$text = preg_replace($search, '', $document); 
return $text; 
} 
?>


<?php

function imagemedium($name,$upload_folder)
{
	$image2=str_replace(" ","",$name);
	if(!empty($image2))
	{
	$image3 = explode(".",$image2);
	$image1=$image3[0]."_ns.".$image3[1];;
	}

/******************/

if (file_exists($upload_folder . '/' . $image1)) 
{
// append a digit to the beginning of the name
$tmpVar1 = 1;
$filenamestr=split('~',$image1);
$filenamestr0=$filenamestr[0];
$filenamestr1=$filenamestr[1];

while(file_exists($upload_folder . '/' . $filenamestr0.'~'.$tmpVar1 . '-' . $filenamestr1)) 
   {
	// and keep increasing it until we have a unique name
   $tmpVar1++;
   }
  
  $fileName2= $tmpVar1 . '-' . $filenamestr1;
  $image1=$filenamestr0.'~'.$fileName2;

}

/******************/

	return $image1;
}


function imagelarge($name,$upload_folder)
{
	$image2=str_replace(" ","",$name);
	if(!empty($image2))
	{
	$image3 = explode(".",$image2);
	$image1=$image3[0]."_nl.".$image3[1];
	}

/******************/

if (file_exists($upload_folder . '/' . $image1)) 
{
// append a digit to the beginning of the name
$tmpVar1 = 1;
$filenamestr=split('~',$image1);
$filenamestr0=$filenamestr[0];
$filenamestr1=$filenamestr[1];

while(file_exists($upload_folder . '/' . $filenamestr0.'~'.$tmpVar1 . '-' . $filenamestr1)) 
   {
	// and keep increasing it until we have a unique name
   $tmpVar1++;
   }
  
  $fileName2= $tmpVar1 . '-' . $filenamestr1;
  $image1=$filenamestr0.'~'.$fileName2;

}

/******************/

	return $image1;
}

function imagethumb($name,$upload_folder)
{
	$image2=str_replace(" ","",$name);
	if(!empty($image2))
	{
	$image3 = explode(".",$image2);
	$image1=$image3[0]."_nt.".$image3[1];;
	}

	/******************/

if (file_exists($upload_folder . '/' . $image1)) 
{
// append a digit to the beginning of the name
$tmpVar1 = 1;
$filenamestr=split('~',$image1);
$filenamestr0=$filenamestr[0];
$filenamestr1=$filenamestr[1];

while(file_exists($upload_folder . '/' . $filenamestr0.'~'.$tmpVar1 . '-' . $filenamestr1)) 
   {
	// and keep increasing it until we have a unique name
   $tmpVar1++;
   }
  
  $fileName2= $tmpVar1 . '-' . $filenamestr1;
  $image1=$filenamestr0.'~'.$fileName2;

}

/******************/

	return $image1;
}

?>



<?php


function multiplegalupload_newsqps($newsid,$imgname,$imgpath,$userid,$funcname,$tbl_gal)
{

$imgcount=count($_FILES[$imgname]['name']);

//echo "hhhhhhhhhh>>".$imgcount;

if($imgcount>'0') 
{
	
//check if any file uploaded
$GLOBALS['msg'] = ""; //initiate the global message

$filen="";
$filen1="";

for($j=0; $j <$imgcount; $j++) 
{ //loop the uploaded file array
			
$filen1 = $_FILES[$imgname]['name']["$j"]; //file name

$fileType1 = $_FILES[$imgname]['type']["$j"]; 
			
//echo "file type >".$fileType1."<br>";
$str1=date(Y)."-".date(m)."-".date(d);

$filen1=$str1."~".$filen1;

///// file nm start
if ($filen1!="")
{
$foldername=$imgpath;

$sysfolder=uploadgall($foldername);

//echo $sysfolder;
if (file_exists($sysfolder . '/' . $filen1)) {
// append a digit to the beginning of the name
  $tmpVar1 = 1;

$filenamestr=split('~',$filen1);
$filenamestr0=$filenamestr[0];
$filenamestr1=$filenamestr[1];

while(file_exists($sysfolder . '/' . $filenamestr0.'~'.$tmpVar1 . '-' . $filenamestr1)) {
 // while(file_exists($sysfolder . '/' . $tmpVar1 . '-' . $filen1)) {
// and keep increasing it until we have a unique name
   $tmpVar1++;
   }
	$fileName2= $tmpVar1 . '-' . $filenamestr1;

	$filen1=$filenamestr0.'~'.$fileName2;

  //$filen1= $tmpVar1 . '-' . $filen1;
  } 
}
$gpath=$filen1;

//////// file nm end
$path = $sysfolder."/".$filen1; //generate the destination path

	//echo $path;
	
	if ($fileType1 == 'image/jpg') 
		{
		$fileType ="jpg";
		}
	if ($fileType1 == 'image/pjpeg') 
		{
		$fileType ="jpg";
		}
	if ($fileType1 == 'image/jpeg') 
	{
		$fileType ="jpeg";
	}	
	if ($fileType1 == 'image/gif')
		{
		$fileType ="gif";
		}
	if ($fileType1 == 'image/png') 
		{
		$fileType ="png";
		}
	if ($fileType1 == 'video/x-ms-wmv') 
		{
		$fileType ="wmv";
		}
	if ($fileType1 == 'audio/wav') 
		{
		$fileType ="wav";
		}
	if(move_uploaded_file($_FILES[$imgname]['tmp_name']["$j"],$path)) { //upload the file
		$GLOBALS['msg'] .= "File# ".($j+1)." ($filen1) uploaded successfully<br>"; //Success message
	}



	$strdsc2=$_REQUEST['TN_desc'];
	$strdsc1=str_replace("'","~",$strdsc2);
	$gdesc=$strdsc1[$j];
	$gcap=$gdesc;

	$strembed2=$_REQUEST['TN_embed'];
	$gembed1=$strembed2[$j];
	//$gembed= htmlentities($gembed1);
	//$gembed= html2txt($gembed1);
	$gembed=$gembed1;

	//echo "ddddggg>>".$gembed."<br>".$gcap;

	$strimgtype1=$_REQUEST['TN_imgtype'];
	$gtype=$strimgtype1[$j];

	$str4="";
	$str4=$_REQUEST['rdval'];

	if(trim($j)==trim($str4))
	{
	$hstatus="1";
	}
	else
	{
	$hstatus="0";
	}

if (($_FILES[$imgname]['name']["$j"]!="") || ($hstatus=="1"))
{
//insertnewsgal($newsid,$gtype,$gcap,$gpath,$gdesc,$gembed,$userid);
$funcname($newsid,$gtype,$gcap,$gpath,$gdesc,$gembed,$userid,$hstatus,$tbl_gal);

} //if loop end when inserting data


}//end of forloop



}//if loop end

}

?>