<?php
session_start();
require_once './helpers/jwt_helper.php';
include_once "./config/Database.php";
include_once "./model/User.php";

$database = new Database();
$db = $database->connect();
$user = new User($db);
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        $user->email = $email;
        $userData = $user->login();

        if ($userData && password_verify($password, $userData['password'])) {
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['subscription_type'] = $userData['subscription_type'];

            $payload = [
                'id' => $userData['id'],
                'username' => $userData['username'],
                'email' => $userData['email']
            ];

            $token = JWTHandler::generateToken($payload);
            setcookie('token', $token, time() + 3600, '/');

            header("Location: home.php");
            exit;
        } else {
            $error = "Invalid email or password";
        }
    } else {
        $error = "Please fill in all fields";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./img/logo_nav.png">
    <meta http-equiv="refresh" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <title>Phirus</title>
</head>

<body>

    <div class="Back_Arrow">
        <a href="index.php"><img class="icon" src="./img/Back-Arrow.svg" alt="icon_img"></a>
    </div>

    <div class="logo">
        <img class="logo_img" src="./img/logo_home.png" alt="logo_img">
    </div>
    <div class="container">

        <div class="login_box">
            <h2>Login</h2>
            <?php if (!empty($error)): ?>
                <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form method="POST" action="login.php">
                <div class="input_group">
                    <img class="imge" src="./img/Frame.svg">
                    <input name="email" required type="email" placeholder="Email Address">

                </div>
                <div class="input_group">
                    <img class="imge" src="./img/Frame (1).svg">
                    <input name="password" required type="password" placeholder="Enter Password">

                </div>
                <div class="options">
                    <label><input type="checkbox">Remender Me</label>
                    <a id="Forgot_Password" class="Forgot_Password" href="forget.php">Forgot Password</a>
                </div>
                <button type="submit">Login</button>
                <div class="or">
                    <hr>
                    or
                    <hr>
                </div>
                <div class="social_login">
                    <a href="https://appleid.apple.com/login" class="social_btn_apple">
                        <img src="./img/IOS.svg">
                    </a>
                    <a href="https://accounts.google.com/login" class="social_btn_google">
                        <img src="./img/Google.svg">
                    </a>

                </div>
                <div class="sign_up">
                    <p>Don’t have an accont ?</p>
                    <a href="signup.php" class="sign">Sign Up</a>
                </div>
            </form>
        </div>
    </div>


</body>

</html>