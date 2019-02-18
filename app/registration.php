<?php
    include "../cs/config.php";
    $User_FName = mysqli_real_escape_string($db,$_POST['firstname']); 
	$User_LName = mysqli_real_escape_string($db,$_POST['lastname']); 
	$User_Email = mysqli_real_escape_string($db,$_POST['email_id']); 
	$User_Pwd = mysqli_real_escape_string($db,$_POST['pwd']);
	
	// $User_FName = "Vikash123"; 
	// $User_LName = "Vikash123"; 
	// $User_Email = "kumarkv456@gmail.com"; 
	// $User_Pwd = "123";
	
	$UserType="1";
	$RoleId="1";
	$status='F';
	$regis_type='SELF';
	if($User_Email<>"") 
    {
		$resultds = mysqli_query($db,"call sp_user_registration('','".$User_Email."','".$User_FName."','".$User_LName."','".$User_Pwd."','".$UserType."','".$RoleId."','".$status."','".$regis_type."','','','INSERT_REGISTRATION',@resultmsg,@errormsg)") or die('Query Not execute'.mysqli_error($db));
		$db->close();	
		if (mysqli_num_rows($resultds) > 0) 
		{
			 while($row = mysqli_fetch_array($resultds)) 
			 {
				 $result= $row['resultval'];
				 $IsError= $row['IsErrorval'];
				 $arr = array('status' => $result);
				 echo json_encode($arr);
			 }
			 mysqli_free_result($resultds);
			 
			 if($result=="INSERT")
			 {	
				require '../PHPMailer/PHPMailerAutoload.php';
				$mail = new PHPMailer;
				$mail->isSMTP();                                 
				$mail->Host = 'localhost';                 
				$mail->SMTPAuth = false;   
				$mail->SMTPSecure = false;
				$mail->Port = 25;    
				$mail->CharSet="UTF-8";
				$mail->setFrom('1booktechteam@gmail.com', '1Book');
				$mail->addReplyTo('1booktechteam@gmail.com', '1Book');
				$mail->addAddress($User_Email); 
				$mail->AddEmbeddedImage('img/1book_logo.png','1book_logo');
				$mail->isHTML(true); 
				
				include "../cs/common.php";
			    $Encrypt_User_Email=safe_b64encode($User_Email);

				$bodyContent = "<img src='cid:1book_logo' alt='1Book'><br>";
				$bodyContent .= "<p>Dear ".$User_Name.",</p>";
				$bodyContent .= "<p><span style='color:#EF7F1B'>It's good to study</span></p>";
				$bodyContent .= "<p>Now Access books and notes on the move.</p>";
				$bodyContent .= "<p>You have created an account on <a href='".$SiteURL."'>1Book.in</a>. Your username is: '".$User_Email."'.
				To verify your email ID <a href='".$SiteURL."account_activation.php?email=".$Encrypt_User_Email."'>click here</a></p>";
				$bodyContent .= "<p>If the link does not work then copy the link given below into your web browser:</p>";
				$bodyContent .= "<p>".$SiteURL."account_activation.php?email=".$Encrypt_User_Email."</p>";
				$bodyContent .= "<p>Please ignore this mail, if you did not register at 1Book portal.</p>";
				$bodyContent .= "<p>To access the 1Book portal, Please visit http://www.1book.in</p>";
				$bodyContent .= "<p>Sincerely</p>";
				$bodyContent .= "<p><span style='color:#EF7F1B'>1Book</span> Team</p>";
				$bodyContent .= "<p><h5>Do not reply to this email.</h5></p>";
				$bodyContent .= "<p><h5>Please do not reply to this email. This email is sent from an automated service and is not monitored. To get in touch <a href='".$SiteURL."contactus.html'>contact us</a> here.</h5></p>";
			
				$mail->Subject = '1Book - Account Activation';
				$mail->Body = $bodyContent;

				if(!$mail->send()) 
				{
				} 
				else 
				{
				}
			}
		}
	}
	else
	{
	  $result="Emailid can't be blank";
	  $arr = array('status' => $result);
	  echo json_encode($arr);
	}

?>
