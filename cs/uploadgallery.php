<?php
ini_set('memory_limit','128M');

Function homeuploadfile($uploadfilenm,$upload_folder)
{
if (is_uploaded_file($_FILES[$uploadfilenm]['tmp_name'])) 
{ 
//Get the Filename and the File Type 
$fileName = $_FILES[$uploadfilenm]['name'];
//echo $fileName;
$fileType = $_FILES[$uploadfilenm]['type']; 

//echo "ssssssss>>".$fileType."<br>";

///// file nm start

$file_extn = substr($fileName, strrpos($fileName, '.')+1);

$str1=date(Y)."-".date(m)."-".date(d);

$randomstring=randomAlphaNum(5);

$fileName=$str1."~".$randomstring.".".$file_extn;

$filenamebig=imagelarge($fileName,$upload_folder);

$filenamethumb=imagethumb($fileName,$upload_folder);

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

//echo "aaaaaaaa>>".$fileType;

        if (($fileType == 'image/jpg') || ($fileType == 'image/pjpeg') || ($fileType == 'image/jpeg') || ($fileType == 'image/gif') || ($fileType == 'image/PNG') || ($fileType == 'image/png') || ($fileType == 'application/octet-stream')) 
        { 
            if (move_uploaded_file($_FILES[$uploadfilenm]['tmp_name'],$upload_folder.''.$fileName)) 
            { 
             $upload_folder1=$upload_folder;
createThumbsbig1($upload_folder1,$upload_folder,800,$fileName,$fileType,$filenamebig);
createThumbs($upload_folder1,$upload_folder,275,$fileName,$fileType,$filenamethumb);

$original_image=$upload_folder."/".$fileName;
unlink($original_image);

            }
        }
           
}

$fileName=$filenamethumb;
return $fileName;

}//function end






function createThumbsbig1( $pathToImages, $pathToThumbs, $thumbWidth,$fnamestr,$fileType,$filenamethumb) 
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
       $thumbWidth4=600;
    
      if($width5<"600")
        {
        $new_height5 = $height5;
        $new_width5 =$width5;
        }
        else
        {
        $new_height5 = $thumbWidth4;
        $new_width5 = floor( $width5 * ( $thumbWidth4 / $height5 ) );
        }

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
        if($width5<"175")
        {
        $new_height5=$height5;
        $new_width5=$width5;
        }
        else
        {
        $thumbWidth4=175;
        $new_height5 = $thumbWidth4;
        $new_width5 = floor( $width5 * ( $thumbWidth4 / $height5 ) );
        }
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



function imagelarge($name,$upload_folder)
{
    $image2=str_replace(" ","",$name);
    if(!empty($image2))
    {
    $image3 = explode(".",$image2);
    $image1=$image3[0]."_large.".$image3[1];
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
     $image1=$image3[0]."_thumb.".$image3[1];;
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



function randomAlphaNum($length){

    $rangeMin = pow(36, $length-1); //smallest number to give length digits in base 36
    $rangeMax = pow(36, $length)-1; //largest number to give length digits in base 36
    $base10Rand = mt_rand($rangeMin, $rangeMax); //get the random number
    $newRand = base_convert($base10Rand, 10, 36); //convert it
   
    return $newRand; //spit it out

} 



Function Singleuploadfile($uploadfilenm,$upload_folder)
{

if (is_uploaded_file($_FILES[$uploadfilenm]['tmp_name'])) 
{ 
//Get the Filename and the File Type 
$fileName = $_FILES[$uploadfilenm]['name'];
//echo $fileName;
$fileType = $_FILES[$uploadfilenm]['type']; 

//echo "ssssssss>>".$fileType."<br>";

 
///// file nm start

$file_extn = substr($fileName, strrpos($fileName, '.')+1);

$str1=date(Y)."-".date(m)."-".date(d);

$randomstring=randomAlphaNum(5);

$fileName=$str1."~".$randomstring.".".$file_extn;

//$filenamebig=imagelarge($fileName,$upload_folder);

//$filenamethumb=imagethumb($fileName,$upload_folder);

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


        if (($fileType == 'image/jpg') || ($fileType == 'image/pjpeg') || ($fileType == 'image/jpeg') || ($fileType == 'image/gif') || ($fileType == 'image/png') || ($fileType == 'application/octet-stream') || ($fileType == 'application/pdf') || ($fileType == 'application/PDF')) 
        { 
            if (move_uploaded_file($_FILES[$uploadfilenm]['tmp_name'],$upload_folder.''.$fileName)) 
            { 
            // $upload_folder1=$upload_folder;
//createThumbsbig1($upload_folder1,$upload_folder,800,$fileName,$fileType,$filenamebig);
//createThumbs($upload_folder1,$upload_folder,275,$fileName,$fileType,$filenamethumb);

//$original_image=$upload_folder."/".$fileName;

//echo "aaa>>".$original_image."<br>";

unlink($original_image);

            }
        }
           
}

//$fileName=$filenamethumb;
return $fileName;

}//function end



function SingleVideoupload($uploadfilenm,$upload_folder)
{
echo "dddddddddddd>>";
if (is_uploaded_file($_FILES[$uploadfilenm]['tmp_name'])) 
{ 
//Get the Filename and the File Type 
$fileName = $_FILES[$uploadfilenm]['name'];
//echo $fileName;
$fileType = $_FILES[$uploadfilenm]['type'];

echo "ssssssss>>".$fileType."<br>";
 
///// file nm start

$file_extn = substr($fileName, strrpos($fileName, '.')+1);

$str1=date(Y)."-".date(m)."-".date(d);

$randomstring=randomAlphaNum(5);

$fileName=$str1."~".$randomstring.".".$file_extn;

//$filenamebig=imagelarge($fileName,$upload_folder);

//$filenamethumb=imagethumb($fileName,$upload_folder);

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



        if (($fileType == 'video/x-ms-wmv') || ($fileType == 'audio/mpeg') || ($fileType == 'image/jpeg') || ($fileType == 'flv') || ($fileType == 'video/mp4') || ($fileType == 'application/octet-stream')) 
        { 
            if (move_uploaded_file($_FILES[$uploadfilenm]['tmp_name'],$upload_folder.''.$fileName)) 
            { 

        unlink($original_image);

         }




    }
           
}

return $fileName;

}
?>
