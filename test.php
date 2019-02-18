<?php
ini_set('display_errors', '1');
$host = "172.31.17.1";
$username = "1book";
$password = "Vfd#2!qwas";
$dbname = "1book";
//$link = mysqli_connect("localhost", "root", "editor", "1book");
@$link = new mysqli($host, $username, $password, $dbname);
if(mysqli_connect_errno())
{
	die('Connection could not be established: ' . mysqli_error());
}
echo $ipadd=$_SERVER['REMOTE_ADDR'];
$query = mysqli_query($link, "CALL GETCOUNTRY('$ipadd','.')") or die (mysqli_error($link)); 
mysqli_close($link);
while ($recordset = mysqli_fetch_array($query)) {
		$shortcd=$recordset['countrySHORT'];
		include "commoncode/connection.php";
		echo $query_h = "select * from country_master where code='$shortcd'";
		$Showgind=mysql_query($query_h);
        $count=mysql_num_rows($Showgind);
			if($count>0)
			{
			?>
			<script>
			window.location.href="https://epaperlive.timesofindia.com/notavailable.html";
			</script>
			<?php
			}
			
}	

?>
