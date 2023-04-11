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

	// Send email
	$to = 'raphael277.eng.alfy@gmail.com';
	$subject = 'php email send lab iti';
	$headers = 'From: rafy.assaad@gmail.com' . "\r\n" .
	    'Reply-To: rafy.assaad@gmail.com' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers);

	// Redirect to success page
	header('Location: success.html');
	exit();
}
?>
