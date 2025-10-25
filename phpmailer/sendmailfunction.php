<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // run "composer require phpmailer/phpmailer" once

function sendemailsmtp($to="", $msg="", $subject="", $replyToEmail = null, $replyToName = null){
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@echomintadvt.com';
        $mail->Password   = '#InfoAdvt2025'; // Replace with actual password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // or PHPMailer::ENCRYPTION_SMTPS for port 465
        $mail->Port       = 587;

        $mail->setFrom('info@echomintadvt.com', 'EchoMint Advertising');
        $mail->addAddress($to);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $msg;
        $mail->AltBody = strip_tags($msg); // Plain text version

        if (!empty($replyToEmail)) {
            // Set reply-to so recipients can respond to the submitter
            $mail->addReplyTo($replyToEmail, $replyToName ?: $replyToEmail);
        }

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}
?>