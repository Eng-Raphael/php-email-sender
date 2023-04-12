<?php

require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require './PHPMailer/src/Exception.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	// Get form data
	$firstName = trim($_POST['firstName']);
	$lastName = trim($_POST['lastName']);
	$address = trim($_POST['address']);
	$country = trim($_POST['country']);
	$gender = trim($_POST['gender']);
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$department = trim($_POST['department']);
	$skills = isset($_POST['skills']) ? $_POST['skills'] : [];

	//Add to file 
	// Open the file in append mode
	$file = fopen('data.txt', 'a');

	// Write the form values to the file
	fwrite($file, $firstName . "\n");
	fwrite($file, $lastName . "\n");
	fwrite($file, $address . "\n");
	fwrite($file, $country . "\n");
	fwrite($file, $gender . "\n");
	fwrite($file, $username . "\n");
	fwrite($file, $password . "\n");
	fwrite($file, $department . "\n");

	// Write the skills as a comma-separated list
	if (!empty($skills)) {
		$skillsStr = implode(',', $skills);
		fwrite($file, $skillsStr . "\n");
	}

	// Close the file
	fclose($file);

	// Validate form data
	if (empty($firstName)) {
		$errors[] = "First name is required";
	} else if (!preg_match("/^[a-zA-Z' -]+$/", $firstName)) {
		$errors[] = "First name should only contain letters, spaces, apostrophes, or hyphens";
	}

	if (empty($lastName)) {
		$errors[] = "Last name is required";
	} else if (!preg_match("/^[a-zA-Z' -]+$/", $lastName)) {
		$errors[] = "Last name should only contain letters, spaces, apostrophes, or hyphens";
	}

	if (empty($address)) {
		$errors[] = "Address is required";
	}

	if (empty($country)) {
		$errors[] = "Country is required";
	}

	if (empty($gender)) {
		$errors[] = "Gender is required";
	}

	if (empty($username)) {
		$errors[] = "Username is required";
	} else if (!preg_match("/^[a-zA-Z0-9_\-\.]+$/", $username)) {
		$errors[] = "Username should only contain letters, numbers, underscores, hyphens, or dots";
	}

	if (empty($password)) {
		$errors[] = "Password is required";
	} else if (strlen($password) < 8) {
		$errors[] = "Password should be at least 8 characters long";
	}

	if (empty($department)) {
		$errors[] = "Department is required";
	}

	if (empty($skills)) {
		$errors[] = "Skills are required";
	}

	if (!empty($errors)) {
		foreach ($errors as $error) {
			echo $error;
		}
	}

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
