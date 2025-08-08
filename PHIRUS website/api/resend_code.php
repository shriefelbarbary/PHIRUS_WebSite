<?php
session_start();
require_once '../helpers/mail_helper.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['success' => false, 'message' => 'No email found in session']);
    exit;
}

$email = $_SESSION['email'];
$code = rand(100000, 999999);

// store code in session or DB
$_SESSION['verification_code'] = $code;

// send email
$sent = sendEmail($email, "Verification Code", "Your new code is: $code");

echo json_encode(['success' => $sent]);
