<?php
$to = 'rafy.assaad@gmail.com';
$subject = 'Test email';
$message = 'This is a test email sent using the PHP mail() function.';
$headers = 'From: raphael277.eng.alfy@gmail.com' . "\r\n" .
           'Reply-To: rafy.assaad@gmail.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

if (mail($to, $subject, $message, $headers)) {
    echo 'Email sent successfully.';
} else {
    echo 'An error occurred while sending the email.';
}
?>
