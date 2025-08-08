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
        <meta http-equiv="refresh" content />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/domain.css">
        <title>Phirus</title>
    </head>

    <body>
    <nav>
        <img class="features_menu" src="./img/Menu.svg" alt>
        <div class="logo_navbar_home">
            <a href="home.php">
                <img class="logo_img" src="./img/logo_nav.png"
                     alt="logo_icon"></a>
            <a class="logo_text" href="home.php">Phirus</a>
        </div>
        <ul class="links">
            <li> <a class="li" href="home.php">Home</a></li>
            <li><a class="li_2" href="#">Features</a></li>
            <li><a class="li" href="payment.php">Pro</a></li>
            <li><a class="li" href="#footer">About us</a></li>
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

        <div class="hero_section">
            <h1 class="section_1_h1"> How do yo want to scan your E-mail ?</h1>
            <div class="text_and_img">
                <p class="text_p_1">
                    Now , you can scan your e-mail and be<br>
                    sure that your e-mail isn’t phishing or<br>
                    malicious with some Primary features<br>
                    and every primary feature has some sub<br>
                    features
                </p>
                <img class="image_section_1" src="./img/features_1.svg"
                    alt="image">
            </div>
        </div>

        <div class="section_2">
            <h1 class="section_2_h1">
                Checking the Header of your<br> E-mail
            </h1>
            <div class="image_section_2">
                <div class="img_features_1">
                    <a href="#">
                        <img src="./img/image 3.svg" alt="image" />
                        <p>Header</p>
                    </a>
                </div>
                <div class="img_features_2">
                    <a href="Body.html">
                        <img src="./img/image 2.svg" alt="image" />
                        <p>Body</p>
                    </a>
                </div>
            </div>
        </div>
        <!--
    <div id="section_all_features" class="section_all_features">
        <h1 class="section_3_h1">
            How do you want to scan your E-Mail Header ?
        </h1>
        <div class="one">
            <a class="but_1" href="features.html">Whois lookup</a>
            <a class="but_2" href="spf.html">SPF & DMARK & DKIM Check</a>
        </div>
        <div class="two">
            <a class="but_3" href="#section_spf">Check domain in Black List</a>
            <a class="but_4" href="extract.html">Extract Header Information</a>
        </div>
    </div>-->
    <div id="section_Whois" class="section_Whois">
        <h1 class="section_4_h1">
            How do you want to scan your E-MailHeader ?
        </h1>
        <div class="three">
            <a id="but_5" class="but_5" href="features.php">Whois lookup</a>
            <a class="but_6" href="spf.php">SPF & DMARK & DKIM Check</a>
        </div>
        <div class="four">
            <a class="but_7" href="domain.php">Check domain in Black
                List</a>
            <a class="but_8" href="extract.php">Extract Header
                Information</a>
        </div>
    </div>


        <div id="check_domain" class="check_domain">
            <h1 class="section_5_h1">Check domain in Black List</h1>
            <div class="domain_box">
                <input id="domain_input" class="check_box" required type="text"
                    placeholder="Input Domain Name....">
                <p><button type="submit" id="button_domain"
                        class="button_domain">Check</button></p>
            </div>
        </div>

        <div class="container_check_domain">
            <div class="container_domain">
                <p class="domain_1">
                    <strong class="strong_domain_1">Domain</strong><span
                        class="span_domain_1"><a id="domain"
                            href="#" target="_blank"
                            rel="noopener noreferrer">google.com</a></span>
                </p>
                <p class="domain_2">
                    <strong class="strong_domain_2">Malicious
                        Votes</strong><span class="span_domain_2"
                        id="malicious_votes">0</span>
                </p>
                <p class="domain_3">
                    <strong class="strong_domain_3">Suspicious
                        Votes</strong><span class="span_domain_3"
                        id="suspicious_votes">0</span>
                </p>
                <p class="domain_4">
                    <strong class="strong_domain_4">Status</strong><span
                        class="span_domain_4" id="status">Safe</span><img
                        class="icon_domain_4" src="./img/Vector (3).svg" alt>
                </p>
            </div>
        </div>

        <footer class="footer" id="footer">
            <div class="container">
                <div class="footer_section_1">
                    <div class="icon_and_text">
                        <a href><img class="img_1" src="./img/Logo (1).svg"
                                alt></a>
                        <a href>
                            <h2 class="text_h2_section_1">Phirus</h2>
                        </a>
                    </div>
                    <p class="p_section_1">Copyright © 2024 Phirus.</p>
                    <span class="span_section_1">All rights reserved</span>
                    <div class="icon_three_section_1">
                        <a href><img class="img_2" src="./img/Social Icons.svg"
                                alt="Instagram"></a>
                        <a href><img class="img_3" src="./img/Icons2.svg"
                                alt="Twitter"></a>
                        <a href><img class="img_4" src="./img/Icons3.svg"
                                alt="Youtube"></a>
                    </div>
                </div>
                <div class="container_three">
                    <div class="footer_section_2">
                        <h2 class="text_h2_section_2">Company</h2>
                        <ul>
                            <li><a href>About us</a></li>
                            <li><a href>Blog</a></li>
                            <li><a href>Contact us</a></li>
                            <li><a href>Pricing</a></li>
                            <li><a href>Testimonials</a></li>
                        </ul>
                    </div>

                    <div class="footer_section_3">
                        <h2 class="text_h2_section_3">Support</h2>
                        <ul>
                            <li><a href>Help center</a></li>
                            <li><a href>Terms of service</a></li>
                            <li><a href>Legal</a></li>
                            <li><a href>Privacy policy</a></li>
                            <li><a href>Status</a></li>
                        </ul>
                    </div>
                    <div class="footer_section_4">
                        <h2 class="text_h2_section_4">Stay up to date</h2>
                        <form class="subscribe_form">
                            <input type="email" placeholder="Your email address"
                                required>
                            <button type="submit"><img src="./img/0.svg"
                                    alt></button>
                        </form>

                    </div>

                </div>

            </div>

        </footer>

        <script>
            document.getElementById("button_domain").addEventListener("click", function(event) {
                event.preventDefault();

                const domainName = document.getElementById("domain_input").value;
                if (domainName === "") {
                    alert("Please enter a domain name.");
                    return;
                }

                // Perform Blacklist Check
                fetch("https://tester-production-caf8.up.railway.app/blacklist", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({ domain: domainName }),
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                            return;
                        }

                        const domainLink = document.getElementById("domain");
                        domainLink.textContent = data.domain;
                        domainLink.href = "https://" + data.domain;

                        document.getElementById("malicious_votes").textContent = data.malicious_votes;
                        document.getElementById("suspicious_votes").textContent = data.suspicious_votes;

                        const statusText = data.status === "alert" ? "Unsafe!" : "Safe";
                        document.getElementById("status").textContent = statusText;

                        const statusIcon = document.querySelector(".icon_domain_4");
                        statusIcon.src = data.status === "alert" ? "./img/alert-svgrepo-com.svg" : "./img/Vector (3).svg";

                        // Save to DB (store_blacklist.php)
                        fetch("/api/blacklistCheck.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({
                                check_id: 'bl-' + Date.now(),
                                domain: data.domain,
                                status: data.status,
                                malicious_votes: data.malicious_votes,
                                suspicious_votes: data.suspicious_votes
                            })
                        })
                            .then(res => res.json())
                            .then(response => console.log("✔ Stored:", response.message || response.error))
                            .catch(err => console.error("Store Error:", err));

                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("An error occurred while checking the domain.");
                    });
            });
        </script>
    </body>

</html>