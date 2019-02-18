<?php
// phpinfo(); 
	ini_set('display_errors','1');
include "cs/common.php";
?>
<html>
	<head>
		<title>Simple way to detect device type With PHP - wsnippets.com</title>
		<style type="text/css">
			body{
				font-family: verdana;
			}
			.wrap{
				width:  50%;
				margin: 0 auto;
				padding:10%;
			}
			.wrap b{
				border: blue 1px solid;
				padding: 10px;
			}
		</style>
	</head>
<body>
	<div class="wrap">
	
	    <?php 
		  $User_Email="chdeepaknirwal@yahoo.com";
          // Echo  $Encrypt_User_Email=doEncrypt($User_Email);
          // echo "<br><br>";
		  // echo $Decrypt_User_Email=doDecrypt($Encrypt_User_Email);
		  
		  echo $Encrypt_User_Email=safe_b64encode($User_Email);
		  
		  echo "<br><br>";
		  echo $Decrypt_User_Email=safe_b64decode($Encrypt_User_Email);
		  
		?>
		
		
	</div>
</body>
</html>