<?php
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require './PHPMailer/src/Exception.php';

$errors = [];

function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Get form data
	if (empty($_POST['firstName'])) {
		$errors['firstName'] = 'First name is required.';
	} else {
		$firstName = test_input($_POST['firstName']);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/", $firstName)) {
			$errors['firstName'] = 'Only letters and white space allowed for first name.';
		}
	}

	if (empty($_POST['lastName'])) {
		$errors['lastName'] = 'Last name is required.';
	} else {
		$lastName = test_input($_POST['lastName']);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/", $lastName)) {
			$errors['lastName'] = 'Only letters and white space allowed for last name.';
		}
	}

	if (empty($_POST['address'])) {
		$errors['address'] = 'Address is required.';
	} else {
		$address = test_input($_POST['address']);
	}

	if (empty($_POST['country'])) {
		$errors['country'] = 'Country is required.';
	} else {
		$country = test_input($_POST['country']);
	}

	if (empty($_POST['gender'])) {
		$errors['gender'] = 'Gender is required.';
	} else {
		$gender = test_input($_POST['gender']);
	}

	if (empty($_POST['username'])) {
		$errors['username'] = 'Username is required.';
	} else {
		$username = test_input($_POST['username']);
		// check if username only contains alphanumeric characters
		if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
			$errors['username'] = 'Only letters and numbers allowed for username.';
		}
	}

	if (empty($_POST['password'])) {
		$errors['password'] = 'Password is required.';
	} else {
		$password = test_input($_POST['password']);
	}

	if (empty($_POST['department'])) {
		$errors['department'] = 'Department is required.';
	} else {
		$department = test_input($_POST['department']);
	}

	if (empty($_POST['skills'])) {
		$errors['skills'] = 'Skills are required.';
	} else {
		$skills = test_input($_POST['skills']);
	}

	function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	if (count($errors) > 0) {
		// display errors on the form
		foreach ($errors as $error) {
			echo '<p class="error">' . $error . '</p>';
		}
	} else {

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
}
