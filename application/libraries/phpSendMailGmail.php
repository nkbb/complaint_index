<html>
<head>
<title>ThaiCreate.Com Tutorial</title>
</head>
<body>
<?php
	require_once('class.phpmailer.php');
	$mail = new PHPMailer();
	$mail->IsHTML(true);
	$mail->IsSMTP();
	$mail->CharSet = "utf-8";
	$mail->SMTPAuth = true; // enable SMTP authentication
	$mail->SMTPSecure = "ssl"; // sets the prefix to the servier
	$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
	$mail->Port = 465; // set the SMTP port for the GMAIL server
	$mail->Username = "mtb23fkng@gmail.com"; // GMAIL username
	$mail->Password = "mtb23ar2"; // GMAIL password
	$mail->From = "mtb23fkng@gamil.com"; // "name@yourdomain.com";
	//$mail->AddReplyTo = "support@thaicreate.com"; // Reply
	$mail->FromName = "Mr.Weerachai Nukitram";  // set from Name
	$mail->Subject = "Test sending mail."; 


	$message = '<html><body>';
$message .= '<img src="//css-tricks.com/examples/WebsiteChangeRequestForm/images/wcrf-header.png" alt="Website Change Request" />';
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>121</td></tr>";
$message .= "<tr><td><strong>Email:</strong> </td><td>1212</td></tr>";
$message .= "<tr><td><strong>Type of Change:</strong> </td><td>12121</td></tr>";
$message .= "<tr><td><strong>Urgency:</strong> </td><td>121212</td></tr>";
$message .= "<tr><td><strong>URL To Change (main):</strong> </td><td>12121212</td></tr>";

$message .= "<tr><td><strong>NEW Content:</strong> </td><td>1221212</td></tr>";
$message .= "</table>";
$message .= "</body></html>";


	$mail->Body = $message;

	$mail->AddAddress("new_konbanban@Hotmail.com", "Mr.Adisorn Boonsong"); // to Address



	//$mail->AddCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC
	//$mail->AddBCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC

	$mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low

	$mail->Send(); 
?>
</body>
</html>