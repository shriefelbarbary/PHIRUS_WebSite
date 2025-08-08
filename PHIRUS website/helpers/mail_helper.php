<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'shefo993@gmail.com'; // Replace with your email
        $mail->Password   = 'hello';   // Replace with your app password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Email content
        $mail->setFrom('shefo993@gmail.com', 'Your App Name');
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        return $mail->send(); // Returns true if email sent
    } catch (Exception $e) {
        return false;
    }
}
?>
