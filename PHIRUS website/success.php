<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/features.css">

    <title>Document</title>
</head>
<body>
<nav>
    <div class="logo_navbar_home">
        <a href="home.php">
            <img class="logo_img" src="./img/logo_nav.png" alt="logo_icon"></a>
        <a class="logo_text" href="home.php">Phirus</a>
    </div>
        <a class="features_menu" href="features.php">
            <li>Features</li>
        </a>
</nav>

<center>
    <br>
    <br><br><br><br><br><br><br><br>
<?php

require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_51RUZFyHJXV6vX5SKNjyPtU5pL6bAzj78oVBAmBGfVtrkZfiSTNUv8eJADIJM9GvptsuwnfwfNdrkakuKTIentDfs00eCuKtOT5');

if (!isset($_GET['session_id'])) {
    die('No session ID passed');
}

$session_id = $_GET['session_id'];
$session = \Stripe\Checkout\Session::retrieve($session_id);

if ($session->payment_status === 'paid') {
    $userId = $session->metadata->user_id;
    echo "Payment successful! Thank you for subscribing to Pro.";
    echo '<br>';
    $pdo = new PDO("mysql:host=localhost;dbname=authentication", "root", "");

    $stmt = $pdo->prepare("UPDATE users SET subscription_type = 'pro' WHERE id = ?");
    $stmt->execute([$userId]);
} else {
    echo "Payment not completed.";
}
?>
    <br>
    <br>
    <img src="img/Vector%20(3).svg">
    <br>
    <br>
    <br>
    <div id="check_Whois_Lookup" class="check_Whois_Lookup">
        <p>
            <button id="button_Whois_Lookup" class="button_Whois_Lookup" onclick="window.location.href='login.php'">
                Welcome to PHIRUS PRO, LogIn again please!.
            </button>
        </p>
    </div>

</center>
</body>
</html>

