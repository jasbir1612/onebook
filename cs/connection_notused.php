<?php
//ini_set('display_errors', '0');
//ini_set('session.gc_maxlifetime', 30*60);
//ini_set('session.gc_probability',1); 
//ini_set('session.gc_divisor',1);
//session_start(); 

ini_set('display_errors','0');
$sys=date_default_timezone_set('Asia/Calcutta');

//$con = mysql_connect("119.82.71.90","1book","Vfd#2!qwas");
//$con = mysql_connect("localhost","1book","Vfd#2!qwas");
//$con = mysql_connect("119.82.71.71","ezinemart","Wr6nUprumedUFU+++");
$con = mysql_connect("localhost","root","editor");
if(!$con)
{
  die('Could not connect: '. mysql_error());
}
mysql_select_db("1book", $con);
mysql_query('SET CHARACTER SET utf8');
mysql_query("SET SESSION collation_connection ='utf8_general_ci'") or die (mysql_error()); 

$date=date("d");
$month=date("m");
$year=date("Y");
$rootpath="../gall_content/".$year."/".$month."/".$date."/";
$path="../gall_content/";
$paath="http://119.82.71.90/1book";

?>





<!-- function for generate random password start-->
<?php
function random_password( $length = 8 ) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
	$password = substr( str_shuffle( $chars ), 0, $length );
	return $password;
}
?>
<?php $password = random_password(8); ?>
<!-- function for generate random password end-->