<?php
session_start();

include_once "../config/Database.php";
include_once "../model/User.php";
include_once "../helpers/jwt_helper.php";

$database = new Database();
$db = $database->connect();
$user = new User($db);

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        $user->email = $email;
        $userData = $user->login();

        if ($userData && password_verify($password, $userData['password'])) {
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['subscription_type'] = $userData['subscription_type'];

            // ✅ Create JWT payload and token
            $payload = [
                "id" => $userData['id'],
                "username" => $userData['username'],
                "email" => $userData['email']
            ];
            $token = JWTHandler::generateToken($payload);

            // ✅ Set the token in a secure, HTTP-only cookie
            setcookie(
                'token',
                $token,
                [
                    'expires' => time() + 3600,    // 1 hour
                    'path' => '/',
                    'secure' => true,             // Set to false only for local testing without HTTPS
                    'httponly' => true,
                    'samesite' => 'Lax'
                ]
            );

            // ✅ Redirect to home.php
            header("Location: ../home.php?success=Login successful");
            exit;
        } else {
            header("Location: ../login.php?error=Invalid email or password");
            exit;
        }
    } else {
        header("Location: ../login.php?error=Incomplete form data");
        exit;
    }
} else {
    header("Location: ../login.php?error=Invalid request");
    exit;
}
