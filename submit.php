<?php
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

	// Send email using Sendinblue SMTP server
	require_once('vendor/autoload.php');

	$config = array(
		'host' => 'smtp-relay.sendinblue.com',
		'port' => 587,
		'username' => 'raphael277.eng.alfy@gmail.com',
		'password' => 'RWbtwnL06KpYCrz9',
		'protocol' => 'tls'
	);

	$transport = new Swift_SmtpTransport($config['host'], $config['port'], $config['protocol']);
	$transport->setUsername($config['username']);
	$transport->setPassword($config['password']);

	$mailer = new Swift_Mailer($transport);

	$message = (new Swift_Message($subject))
		->setFrom(['rafy.assaad@gmail.com' => 'Your Name'])
		->setTo(['raphael277.eng.alfy@gmail.com' => 'Recipient Name'])
		->setBody($message);

	$result = $mailer->send($message);

	if ($result) {
		// Redirect to success page
		header('Location: success.html');
		exit();
	} else {
		echo "An error occurred while sending the email.";
	}
}
