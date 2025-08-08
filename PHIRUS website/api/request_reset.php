<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../config/Database.php";
include_once "../model/User.php";
include_once "../helpers/mail_helper.php";

$database = new Database();
$db = $database->connect();
$user = new User($db);

// Support both JSON and form data
$data = json_decode(file_get_contents("php://input"));
$email = $data->email ?? $_POST['email'] ?? null;

if (!empty($email)) {
    $user->email = $email;
    $verification_code = rand(1000, 9999);

    $expiry_time = date("Y-m-d H:i:s", time() + 30);

    if ($user->storeResetToken($verification_code, $expiry_time)) {
        sendEmail($user->email, "Password Reset Code", "Your verification code is: $verification_code");

        header("Location: ../log.otp.html?success=Verification code sent");
    } else {
        header("Location: ../forget.php?Failed=failed to generate");
    }
} else {
    header("Location: ../forget.php?Enter the Email");
}
?>
