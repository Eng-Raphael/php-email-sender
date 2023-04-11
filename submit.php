<?php
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require './PHPMailer/src/Exception.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Get form data
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$address = $_POST['address'];
	$country = $_POST['country'];
	$gender = $_POST['gender'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$department = $_POST['department'];
	$skills = $_POST['skills'];

	// Format email body
	$message = "Registration Form Submission\n";
	$message .= "First Name: " . $firstName . "\n";
	$message .= "Last Name: " . $lastName . "\n";
	$message .= "Address: " . $address . "\n";
	$message .= "Country: " . $country . "\n";
	$message .= "Gender: " . $gender . "\n";
	$message .= "Username: " . $username . "\n";
	$message .= "Password: " . $password . "\n";
	$message .= "Department: " . $department . "\n";
	$message .= "Skills: " . $skills . "\n";

	// Set SMTP credentials
	$smtpHost = 'smtp-relay.sendinblue.com';
	$smtpPort = 587;
	$smtpUsername = 'raphael277.eng.alfy@gmail.com';
	$smtpPassword = 'RWbtwnL06KpYCrz9';

	// Create SMTP client
	$smtp = new \PHPMailer\PHPMailer\SMTP();
	$smtp->SMTPAuth = true;
	$smtp->Host = $smtpHost;
	$smtp->Port = $smtpPort;
	$smtp->Username = $smtpUsername;
	$smtp->Password = $smtpPassword;
	$smtp->SMTPSecure = 'tls';

	// Create email message
	$mail = new \PHPMailer\PHPMailer\PHPMailer();
	$mail->setFrom('raphael277.eng.alfy@gmail.com');
	$mail->addAddress('rafy.assaad@gmail.com');
	$mail->isHTML(false);
	$mail->Subject = 'php email send lab iti';
	$mail->Body = $message;

	// Use SMTP client for sending email
	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->Host = $smtpHost;
	$mail->Port = $smtpPort;
	$mail->Username = $smtpUsername;
	$mail->Password = $smtpPassword;
	$mail->SMTPSecure = 'tls';

	// Send email
	if (!$mail->send()) {
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		// Redirect to success page
		header('Location: success.html');
		exit();
	}
}
