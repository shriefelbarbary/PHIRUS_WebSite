<?php
session_start();
require_once './helpers/jwt_helper.php';

$isLoggedIn = isset($_SESSION['user_id']);
$isPro = isset($_SESSION['subscription_type']) && $_SESSION['subscription_type'] === 'pro';


$user = null;

if (isset($_COOKIE['token'])) {
    $token = $_COOKIE['token'];
    $payload = JWTHandler::validateToken($token);

    if ($payload) {
        $user = $payload;
    } else {
        header("Location: login.php?error=Session expired");
        exit;
    }
} else {
    header("Location: login.php?error=Please login first");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./img/logo_nav.png">
    <meta http-equiv="refresh" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/home.css">
    <title>Phirus</title>
</head>

<body>
    <nav>
        <div class="logo_navbar_home">
            <a href="home.php">
                <img class="logo_img" src="./img/logo_nav.png" alt="logo_icon"></a>
            <a class="logo_text" href="home.php">Phirus</a>
        </div>
        <ul class="links">
            <a class="li" href="home.php">
                <li>Home</li>
            </a>
            <a class="li" href="features.php">
                <li>Features</li>
            </a>
            <a class="li" href="<?php echo ($isLoggedIn && $isPro) ? 'full.email.html' : 'payment.php'; ?>">
                <li>Pro</li>
            </a>
            <a class="li" href="#footer">
                <li>About us</li>
            </a>
        </ul>
            <div class="links_navbar">
            <?php if ($user && isset($user['username'])): ?>
                <span class="username_nav">👋 <?php echo htmlspecialchars( $user['username']); ?></span>
                <a class="logout_nav" href="logout.php">Logout</a>
            <?php else: ?>
                <a class="login_nav" href="login.php">Login</a>
                <a class="signup_nav" href="signup.php">Sign up</a>
            <?php endif; ?>

              </div>

    </nav>

    <!-- Hero_section -->
    <div class="Hero_section">
        <h1 class="text_lift_section">
            Welcome To Our Website ,
            Now you Scan <br>Your E-Mail<br>
            and be sure that your E-Mail<br>
            isn't Phishing
        </h1>
        <img class="img_right_section" src="./img/logo_home.png" alt="image">
    </div>

    <!--section_2-->
    <div class="Hero_section">
        <span class="text_section_2">
            You can scan your E-Mail Now with many Features <br>
            Like Scanning your E-mail Body or <br>
            E-Mail Header
        </span>
        <img class="img_right_section_2" src="./img/logo_home_2.svg" alt="image">
    </div>
    
    <!--section_3-->
    <div class="Hero_section">
        <span class="text_section_2">
            E-Mail header feature contains many sub features to<br>
            be sure that the E-Mail header isn't Phishing or <br>
            Malicious .<br>
            It contains many features like Whois lookup , SPF &<br>
            DMARC & DKIM , Check domain in black list and<br>
            Extract Header information
        </span>
        <img class="img_right_section_2" src="./img/logo_home_3.svg" alt="image">
    </div>

    <!--section_4-->
    <div class="Hero_section">
        <span class="text_section_2">
            E-Mail Body feature contains many sub features to be <br>
            sure that the E-Mail body isn't Phishing or Malicious . <br>
            It contains many features like Checking attachment , <br>
            Checking URL and Checking Steganography
        </span>
        <img class="img_right_section_2" src="./img/logo_home_4.svg" alt="image">
    </div>
</body>
</html>