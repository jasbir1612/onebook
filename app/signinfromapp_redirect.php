<?php
	include "../cs/config.php";
	
	if(isset($_GET['useremailid']) && count($_GET) > 0 ) 
	{ 
	   $Useremail_Id=$_GET['useremailid'];
	}
	if(isset($_GET['roleid']) && count($_GET) > 0 ) 
	{ 
	   $Role_Id=$_GET['roleid'];
	}
	if(isset($_GET['username']) && count($_GET) > 0 ) 
	{ 
	   $UserName=$_GET['username'];
	}
	if(isset($_GET['userid']) && count($_GET) > 0 ) 
	{ 
	   $User_Id=$_GET['userid'];
	}
	
	 setcookie('useremailid', $Useremail_Id, time() + 24*60*60, "/");
	 setcookie('roleid', $Role_Id, time() + 24*60*60, "/");
	 setcookie('username', $UserName, time() + 24*60*60, "/");
	 setcookie('userid', $User_Id, time() + 24*60*60, "/");
		 
	 if ($Role_Id=="1")
	 {
		$WebSite_URL=$SiteURL."bookshelf.html";
		//header($WebSite_URL);
		echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.location.href='".$WebSite_URL."';
				</SCRIPT>");
	 }
	 if ($Role_Id=="2" || $Role_Id=="3")
	 {
		$WebSite_URL=$SiteURL."modify_booknotes.html";
		//header($WebSite_URL);
		echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.location.href='".$WebSite_URL."';
				</SCRIPT>");
	 }
	

?>
