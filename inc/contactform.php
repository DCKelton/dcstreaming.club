<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // access
        $secretKey = '6LfrkY8UAAAAAJVkZ9CII_ssCMQtMdau3NWOQmeb';
        $captcha = $_POST['g-recaptcha-response'];


if(!$captcha){
          echo '<script type="text/javascript">alert("Please check the the captcha form.");window.history.go(-1);</script>';
          exit;
        }

$ip = $_SERVER['REMOTE_ADDR'];
$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
$responseKeys = json_decode($response,true);
		
if(intval($responseKeys["success"]) !== 1) {
          echo '<script type="text/javascript">alert("Please check the the captcha form.");window.history.go(-1);</script>';

        } else {

include 'modules/common.module.php';
$translate = $_GET['lang'];

		
error_reporting(0);
$name = $_POST['contact_name'];
$email = $_POST['contact_email'];
$subject = $_POST['contact_subject'];
$request = $_POST['contact_message'];
$subjectemail = 'User Contact Request';
$date = date('Y');


// Include phpmailer class
require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

// SMTP configuration
$mail->isSMTP();
$mail->Host = 'mystreamnet-club.netcup-mail.de';
$mail->SMTPAuth = true;
$mail->Username = 'contact@mystreamnet.club';
$mail->Password = '9ffe4e761f';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('contact@mystreamnet.club', 'StreamNet Club');
$mail->addReplyTo('');

// Add a recipient
$mail->addAddress('contact@mystreamnet.club');

// Add cc or bcc
$mail->addCC('');
$mail->addBCC('');

// Add attachments
$mail->addAttachment('');

// Email subject
$mail->Subject = $subjectemail;

// Set email format to HTML
$mail->isHTML(true);

// Email body content
$mailContent = "<p><strong>Full Name:</strong> $name </p>
                <p><strong>Email:</strong> $email </p>
	            <p><strong>Subject:</strong> $subject </p>
                <p><strong>Message:</strong> $request </p>";

$mail->Body = $mailContent;

// Send email
if(!$mail->send()) {
    header('Location: https://auth.mystreamnet.club/error.php?lang='.$translate);
} else {
    header('Location: https://auth.mystreamnet.club/thanks.php?lang='.$translate);
}

$mail = new PHPMailer;

// SMTP configuration
$mail->isSMTP();
$mail->Host = 'mystreamnet-club.netcup-mail.de';
$mail->SMTPAuth = true;
$mail->Username = 'noreply@mystreamnet.club';
$mail->Password = '9ffe4e761f';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('noreply@mystreamnet.club', 'StreamNet Club');
$mail->addReplyTo('');

// Add a recipient
$mail->addAddress($email);

// Add cc or bcc
$mail->addCC('');
$mail->addBCC('');

// Add attachments
$mail->addAttachment('');

// Email subject
$mail->Subject = $subjectemail;

// Set email format to HTML
$mail->isHTML(true);

$htmlContent = file_get_contents("form_emails/contact.php");
$htmlContent = str_replace("t2t2", "$name", $htmlContent);
$htmlContent = str_replace("t3t3", "$email", $htmlContent);
$htmlContent = str_replace("t4t4", "$subject", $htmlContent);
$htmlContent = str_replace("t5t5", "$request", $htmlContent);
$htmlContent = str_replace("date", "$date", $htmlContent);

$mail->Body = $htmlContent;

// Send email
if(!$mail->send()) {
    header('Location: https://auth.mystreamnet.club/error.php?lang='.$translate);
} else {
    header('Location: https://auth.mystreamnet.club/thanks.php?lang='.$translate);
}

}
} else {
    header('Location: https://auth.mystreamnet.club/error.php?lang='.$translate);
    }

?>
