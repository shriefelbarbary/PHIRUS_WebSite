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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phirus - Pro</title>
    <link rel="stylesheet" href="./css/Video.Steganography.css">
</head>

<body>
<nav>
    <div class="logo_navbar_home">
        <a href="home.php"><img class="logo_img" src="./img/logo_nav.png" alt="logo_icon"></a>
        <a class="logo_text" href="home.php">Phirus</a>
    </div>
    <ul class="links">
        <a class="li" href="home.php"><li>Home</li></a>
        <a class="li" href="features.php"><li>Features</li></a>
        <a class="li" id="proButton" href="payment.php"><li>Pro</li></a>
        <a class="li" href="#"><li>About us</li></a>
    </ul>
    <div class="links_navbar">
        <?php if ($user && isset($user['username'])): ?>
            <span class="username_nav">👋 <?php echo htmlspecialchars($user['username']); ?></span>
            <a class="signup_nav" href="logout.php">Logout</a>
        <?php else: ?>
            <a class="login_nav" href="login.php">Login</a>
            <a class="signup_nav" href="signup.php">Sign up</a>
        <?php endif; ?>

    </div>
</nav>

<!-- Optional section -->
<section style="text-align:center; margin-top: 100px;">
    <h1>Unlock Pro Features</h1>
    <p>Subscribe now to get access to premium email analysis tools.</p>
    <button id="proCheckout" style="padding: 10px 20px; font-size: 18px; margin-top: 20px;">Subscribe to Pro</button>
</section>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const proButton = document.getElementById('proButton');
    const proCheckout = document.getElementById('proCheckout');

    const redirectToStripe = async () => {
        try {
            const response = await fetch('create_checkout_session.php', {
                method: 'POST'
            });

            const data = await response.json();

            if (data.error) {
                alert(data.error);
                return;
            }

            const stripe = Stripe('pk_test_51RUZFyHJXV6vX5SK5VJafC3VnLlCMBqN0bjisg7LMXEdcyqb01fBmoau3jqu21nXJzSZZIK0zwjk7YW3LBwQ7DIJ00d9CNitJK'); // Replace with your Stripe public key
            stripe.redirectToCheckout({ sessionId: data.id });
        } catch (error) {
            console.error('Error:', error);
            alert('Something went wrong. Please try again.');
        }
    };

    proButton.addEventListener('click', (e) => {
        e.preventDefault();
        redirectToStripe();
    });

    proCheckout.addEventListener('click', redirectToStripe);
</script>

<footer class="footer" id="footer" style="margin-top: 100px;">
    <div class="container">
        <div class="footer_section_1">
            <div class="icon_and_text">
                <a href="#"><img class="img_1" src="./img/Logo (1).svg" alt=""></a>
                <a href="#"><h2 class="text_h2_section_1">Phirus</h2></a>
            </div>
            <p class="p_section_1">Copyright © 2024 Phirus.</p>
            <span class="span_section_1">All rights reserved</span>
        </div>
    </div>
</footer>
</body>
</html>
