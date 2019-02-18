<?php
ini_set('display_errors','0');
$sys=date_default_timezone_set('Asia/Calcutta');
/*$host = "119.82.71.90";
$username = "1book";
$password = "Vfd#2!qwas";
$dbname = "1book";*/

$host = "172.31.17.1";
$username = "1book";
$password = "Vfd#2!qwas";
$dbname = "1book";

/*$host = "localhost";
$username = "root";
$password = "editor";
$dbname = "1book";*/

@$db = new mysqli($host, $username, $password, $dbname);
if(mysqli_connect_errno())
{
die('Connection could not be established: ' . mysqli_error());
}
mysqli_query($db,'SET CHARACTER SET utf8');
mysqli_query($db,"SET SESSION collation_connection ='utf8_general_ci'") or  die("Could not connect: " . mysqli_error());

 $date=date("d");
 $month=date("m");
 $year=date("Y");
 $DefaultThumbPath="img/no_book_cover_2.jpg";
 $DefaultLargePath="img/no_book_cover_2.jpg";
 
 $rootpath="../gall_content/".$year."/".$month."/".$date."/";
 $path="../gall_content/";
# $SiteURL="http://35.154.4.144/1book/";
 $SiteURL="https://1book.in/";
 $S3URL="https://s3.amazonaws.com/1book.in/";
 
 $SMTPServer="smtp.zoho.com";	
 $SMTPServerPort="465";
 $SMTPServerCCEmailID="kanchangrover@gmail.com";
 $SMTPServerBCCEmailID="kanchangrover@gmail.com";
 $SMTPServerFromEmailID="contact@1book.in";

?>
