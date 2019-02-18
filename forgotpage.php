<?php
include ("cs/config.php"); //connects to the database
if (isset($_POST['username'])){
      $username = $_POST['username'];
	 $query="select * from subscriber_master where billing_Email='$username'";
	$result   = mysqli_query($db,$query);
	$row=mysqli_fetch_array($result);
	$count=mysqli_num_rows($result);
	// If the count is equal to one, we will send message other wise display an error message.
	if($count>0)
	{
		$pass  =  $row['password'];//FETCHING PASS
		$name  =  $row['Shipping_Name'];
		$user  =  $row['user_id'];
	   require_once('nomad_mimemail.inc.php');
						$error = "";
						
					   $mimemail = new nomad_mimemail();
                                           $smtp_host = "216.15.194.90";
					   //$smtp_host = "192.168.1.30"; // Change Value
					   //$smtp_user = "4cplus";  // Change Value
					   //$smtp_pass = "4321";  // Change Value
					   $from  = "1book4c@gmail.com"; // Change Value
					   $to   = $username; // Change Value
                                           //$CC ="test@ezinemart.com";
                                           //$BCC ="subscription@ezinemart.com";
					   $subject = "Password recovered";
					   $text="";
					  
					   $htmlsa .= '<h5>Hi '.$name.',</h5>';
					   $htmlsa .= '<h3>Your Recovery user_id is '.$user.'.</h3>';
					   $htmlsa .= '<h3>Your Recovery Password is '.$pass.'.</h3>';
					   $htmlsa .= '<h5>Regards,</h5>';
					   $htmlsa .= '<h5>1Book Team</h5>';
						 echo $htmlsa;
					  echo $mimemail->set_from($from);
					   echo 'Mailer Error: ' . $mimemail->ErrorInfo;
					   $mimemail->set_to($to);
                                           //$mimemail->set_CC($CC);
                                           //$mimemail->set_BCC($BCC);
						
					   $mimemail->set_subject($subject);
						//$mimemail->set_text($text);
						
						$mimemail->set_html($htmlsa);
						
						$mimemail->set_smtp_host($smtp_host, 25);
						//$mimemail->set_smtp_auth($smtp_user, $smtp_pass);
						echo "send";
						$mimemail->send();
						if(!$mimemail->send()) 
						{
							echo 'Mailer Error: ' . $mimemail->ErrorInfo;
							}
						
					echo  $note= 'Your Password Has Been Sent To Your Email Address...!';
                        //echo "<a href='#' onclick='self.close()'>Ok</a>";   					
	} else {
        if ($count==0){?>
    <span style="color:#ff0000;"> Not found your email in our database</span>
        <?php }else
    if ($_POST ['username'] == ""){?>
    <span style="color:#ff0000;"> Not found your email in our database</span>
		<?php }
		}
	//If the message is sent successfully, display sucess message otherwise display an error message.
	if($sentmail==1)
	{
		echo "<span style='color: #ff0000;'> Your Password Has Been Sent To Your Email Address.</span>";
	}
		else
		{
		if($_POST['submit']!="")
		 "<span style='color: #ff0000;'> Cannot send password to your e-mail address.Problem with sending mail...</span>";
	}
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>1Book</title>
</head>
<body>
<form action="" method="post" style="margin-top:50px;margin-left:8%;">
		<label> Enter your Email ID : </label>
		<input id="username" type="text" name="username" />
		<input id="button" type="submit" name="submit" value="Submit" />
	</form>
</body>
</html>
