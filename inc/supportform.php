<?php
include "modules/common.module.php";

$translate = $_GET['lang'];

error_reporting(0);
$name = $_POST['full_name'];
$username = $_POST['plex_username'];
$email = $_POST['support_email'];
$subject = $_POST['support_subject'];
$message = $_POST['support_message'];
$subjectemail = 'Support Request';
$date = date('Y');

include 'modules/sql.module.php';

$sql = "SELECT * FROM users WHERE plexmail = '$email' AND plexusername = '$username'";
$res = mysqli_query($link, $sql);
$count = mysqli_num_rows($res);
if($count == 1){


$sql_support = "INSERT INTO support (name, email, username, subject, message)
                VALUES ('$name', '$email', '$username', '$subject', '$message')";

                if ($link->query($sql_support) === TRUE) {
                  // header("Location:redirected.php");
				 } else {
                       echo "Error: " . $sql_support . "<br>" . $link->error;
                        }

                $link->close();


// Include phpmailer class
require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

// SMTP configuration
$mail->isSMTP();
$mail->Host = 'mystreamnet-club.netcup-mail.de';
$mail->SMTPAuth = true;
$mail->Username = 'support@mystreamnet.club';
$mail->Password = '9ffe4e761f';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('support@mystreamnet.club', 'StreamNet Club');
$mail->addReplyTo('');

// Add a recipient
$mail->addAddress('support@mystreamnet.club');

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
	        <p><strong>Username:</strong> $username </p>
	        <p><strong>Subject:</strong> $subject </p>
                <p><strong>Message:</strong> $message </p>";

$mail->Body = $mailContent;

// Send email
if(!$mail->send()) {
    header('Location: https://auth.mystreamnet.club/error.php?lang='.$translate);
} else {
    header('Location: https://auth.mystreamnet.club/support.php?lang='.$translate);
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
$htmlContent = file_get_contents("form_emails/support.php");
$htmlContent = str_replace("t1t1", "$username", $htmlContent);
$htmlContent = str_replace("t2t2", "$name", $htmlContent);
$htmlContent = str_replace("t3t3", "$email", $htmlContent);
$htmlContent = str_replace("t4t4", "$subject", $htmlContent);
$htmlContent = str_replace("t5t5", "$message", $htmlContent);
$htmlContent = str_replace("date", "$date", $htmlContent);

$mail->Body = $htmlContent;

// Send email
if(!$mail->send()) {
    header('Location: https://auth.mystreamnet.club/error.php?lang='.$translate);
} else {
    header('Location: https://auth.mystreamnet.club/support.php?lang='.$translate);
}

}else{
		//echo '<p>You are not a REGISTRED USER of StreamNet.Club! </br> Either your Email or Username doesn't match our Database </br> <a href="https://mystreamnet.club/">go back</a></p>';
                header("Location: https://auth.mystreamnet.club/no_user.php?lang='.$translate");
	}

?>
