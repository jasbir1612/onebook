<?php
 ini_set('display_errors','1');
 require 'PHPMailerAutoload.php';
function SendMail($FromMail,$ToMail,$CCMail,$BCCMail,$SubjectMail,$BodyHtml,$ReplyToMail,$WebsiteLogo)
{
	$SendMailMsg="";
	$mail = new PHPMailer;
	$mail->isSMTP();              // Set mailer to use SMTP
	$mail->Host = 'localhost';    // Specify main and backup SMTP servers
	$mail->SMTPAuth = false;   
	$mail->SMTPSecure = false;
	$mail->Port = 25;    
	$mail->CharSet="UTF-8";
	
	if (!empty($FromMail)) 
	{
	   $mail->setFrom($FromMail, '1Book');
	}
	if (!empty($ReplyToMail)) 
	{
	   $mail->addReplyTo($ReplyToMail);
	}
	
	if (!empty($ToMail)) 
	{
	   $mail->addAddress($ToMail,$ToMail); 
	   //$mail->addAddress('EmailID','Deepak'); 
	}
	if (!empty($WebsiteLogo)) 
	{
	  $mail->AddEmbeddedImage('img/1book_logo.png','1book_logo');
	}
	if (!empty($CCMail)) 
	{
	   $mail->addCC($CCMail);
	}
	if (!empty($BCCMail)) 
	{
	  $mail->addBCC($BCCMail);
	}
	$mail->isHTML(true);  // Set email format to HTML
     
	if (!empty($SubjectMail)) 
	{
	   $mail->Subject = $SubjectMail;
	}
	
	if (!empty($WebsiteLogo)) 
	{
		$SiteLogo = "<p><img src='cid:1book_logo' alt='1Book'></p>";
		$BodyHtml.=$SiteLogo;
	}
	$mail->Body = $BodyHtml;
	if(!$mail->send()) 
	{
		$SendMailMsg="Failed";
		//$SendMailMsg=$mail->ErrorInfo;
	} 
	else 
	{
	   $SendMailMsg="Sucess";
	}			
	
	// require 'PHPMailerAutoload.php';
	// $mail = new PHPMailer;
	// $mail->isSMTP();                                   // Set mailer to use SMTP
	// $mail->Host = 'localhost';                    // Specify main and backup SMTP servers
	// $mail->SMTPAuth = false;   
	// $mail->SMTPSecure = false;
	// $mail->Port = 25;    
	// $mail->CharSet="UTF-8";

	// $mail->setFrom('1booktechteam@gmail.com', '1Book');
	// //$mail->addReplyTo('deepaknirwal11@gmail.com');
	// $mail->addAddress('deepaknirwal11@gmail.com', 'Deepak'); 
			// // foreach ($result as $address) {
			// // echo $mail->addAddress($address);
			// // echo "<br>";
		// // }				
	// $mail->AddEmbeddedImage('img/1book_logo.png','1book_logo');
	// //$mail->addCC('deepaknirwal11@gmail.com');
	// //$mail->addBCC('deepaknirwal11@gmail.com');
	// $mail->isHTML(true);  // Set email format to HTML

	// $bodyContent = "<img src='cid:1book_logo' alt='1Book'><br>";
	// $bodyContent .= "<p>Hi Deepak,</p>";
	// $bodyContent .= "<p><span style='color:#EF7F1B'>It's good to study</span></p>";
	// $bodyContent .= "<p>$EducatorName has added you to a batch $GroupName for $CourseName and $SubjectName. The batch timings are $GroupTiming.</p>";
	// $bodyContent .= "<p>The access allows you to view content delivered to this batch by $EducatorName.</p>";
	// $bodyContent .= "<p>You can view the content in your 1Book account.</p>";
	// $bodyContent .= "<p>In case you don’t have an account on 1Book, you can register by clicking on this link: 
	// <a href=".$SiteURL.">Registration Link</a></p>";
	// $bodyContent .= "<p>USE THE SAME EMAIL ID THAT YOU PROVIDED TO THE EDUCATOR AT THE TIME OF REGISTRATION.</p>";
	// $bodyContent .= "<p>Sincerely</p>";
	// $bodyContent .= "<p><span style='color:#EF7F1B'>1Book</span> Team</p>";
	// $bodyContent .= "<p><img src='cid:1book_logo' alt='1Book'></p>";
	// $mail->Subject = '1Book - Test Mail';
	// $mail->Body = $bodyContent;

	// if(!$mail->send()) 
	// {
		// $SendMailMsg="Message was not sent PHP Mailer Error";
	// } 
	// else 
	// {
	   // $SendMailMsg= "Message has been sent";
	// }

    return $SendMailMsg;
}


?>