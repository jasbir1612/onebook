<?php

function detectDevice(){
	$userAgent = $_SERVER["HTTP_USER_AGENT"];
	$devicesTypes = array(
        "computer" => array("msie 10", "msie 9", "msie 8", "windows.*firefox", "windows.*chrome", "x11.*chrome", "x11.*firefox", "macintosh.*chrome", "macintosh.*firefox", "opera"),
        "tablet"   => array("tablet", "android", "ipad", "tablet.*firefox"),
        "mobile"   => array("mobile ", "android.*mobile", "iphone", "ipod", "opera mobi", "opera mini"),
        "bot"      => array("googlebot", "mediapartners-google", "adsbot-google", "duckduckbot", "msnbot", "bingbot", "ask", "facebook", "yahoo", "addthis")
    );
 	foreach($devicesTypes as $deviceType => $devices) {           
        foreach($devices as $device) {
            if(preg_match("/" . $device . "/i", $userAgent)) {
                $deviceName = $deviceType;
            }
        }
    }
    return ucfirst($deviceName);
 	}

function bytesToSize($bytes, $precision = 2)
{  
    $kilobyte = 1024;
    $megabyte = $kilobyte * 1024;
    $gigabyte = $megabyte * 1024;
    $terabyte = $gigabyte * 1024;
   
    if (($bytes >= 0) && ($bytes < $kilobyte)) {
        return $bytes . ' B';
 
    } elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
        return round($bytes / $kilobyte, $precision) . ' KB';
 
    } elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
        return round($bytes / $megabyte, $precision) . ' MB';
 
    } elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
        return round($bytes / $gigabyte, $precision) . ' GB';
 
    } elseif ($bytes >= $terabyte) {
        return round($bytes / $terabyte, $precision) . ' TB';
    } else {
        return $bytes . ' B';
    }
}	



//First Method for Encrypt and Decrypt string Start Here

// Key for the Encrypt and Decrypt string
$crypt_key = "oru-9(£20fjasdiofewfqwfh;klncsahei223gfpaoeighew";

//Encrypt Function
function doEncrypt($encrypt)
{
    global $crypt_key;
	$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
	$passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $crypt_key, $encrypt, MCRYPT_MODE_ECB, $iv);
	$encode = base64_encode($passcrypt);
	return $encode;
}

//Decrypt Function
function doDecrypt($decrypt)
{
    global $crypt_key;
	$decoded = base64_decode($decrypt);
	$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
	$decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $crypt_key, $decoded, MCRYPT_MODE_ECB, $iv);
	return str_replace("\\0", '', $decrypted);
}


//First Method for Encrypt and Decrypt string End Here

//Second Method for Encrypt and Decrypt string Start Here
// Key for the Encrypt and Decrypt string
 $skey = "SuPerEncKey2010"; 
 function safe_b64encode($string) 
 {
	$data = base64_encode($string);
	$data = str_replace(array('+','/','='),array('-','_',''),$data);
	return $data;
}

 function safe_b64decode($string) {
	$data = str_replace(array('-','_'),array('+','/'),$string);
	$mod4 = strlen($data) % 4;
	if ($mod4) {
		$data .= substr('====', $mod4);
	}
	return base64_decode($data);
}


function encode($value)
{
	if(!$value){return false;}
	$text = $value;
	$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	$crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->skey, $text, MCRYPT_MODE_ECB, $iv);
	return trim($this->safe_b64encode($crypttext)); 
}

function decode($value)
{
	if(!$value){return false;}
	$crypttext = $this->safe_b64decode($value); 
	$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	$decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
	return trim($decrypttext);
}
	
	
//Second Method for Encrypt and Decrypt string End Here	
	
function keyword($keyword)
{
	$keyword1=trim(str_replace(" ","-",str_replace(",","-",str_replace("'","",$keyword))));
	$keyword2=str_replace("--","-",str_replace("---","",$keyword1));
	$keyword2=preg_replace("/[^a-zA-Z0-9]/", "-", $keyword2);
	$keyword2=strtolower($keyword2);
	$keyword2 = preg_replace('/-+/', '-', $keyword2);
	return $keyword2;
}
function getUrl($catname,$newsid,$keyword)
{
if(empty($catname) && empty($keyword))
$str="http://www.lokmat.com/news/article-".$newsid;
else if(empty($catname))
$str="http://www.lokmat.com/news/".keyword($keyword)."-".$newsid;
else if(empty($keyword))
$str="http://www.lokmat.com/".$catname."/article-".$newsid;
else
$str="https://1book.in/".$catname."/".keyword($keyword)."-".$newsid;
return $str;
}
function returnthbimage($image)
{
$filepath=explode("~",$image);
$filepath1=explode("-",$filepath[0]);
$img_path="gall_content/".$filepath1[0]."/".$filepath1[1]."/".$filepath1[2]."/".$image;
return $img_path;
}
function returnthbimage1($id,$ga_id)
{
$url_path="slidebar.php?g_id=".$ga_id."&g_tran=".$id."&catid=200";
return $url_path;
}
function getnewsurl($catid,$newsid)
{
$str="https://1book.in/storypage.php?catid=".$catid."&newsid=".$newsid;
return $str;
}
function getblogurl($bid,$catid,$newsid)
{
$str="https://1book.in/blog_detail.php?id=".$bid."&amp;catid=".$catid."&amp;newsid=".$newsid;
return $str;
}
function getgalleryurl($galleryid,$section,$gallcatid,$gallimageid)
{
$str="https://1book.in/galleryfullpage.php?galleryid=".$galleryid."&section=".$section."&gallcatid=".$gallcatid."&gallimageid=".$gallimageid;
return $str;
}
function returnVideoUrl($keyword,$vid)
{
	$url="https://1book.in/video.php?vid=".$vid;
	return $url;
}
?>

