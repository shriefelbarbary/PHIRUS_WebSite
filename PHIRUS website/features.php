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
        <link rel="stylesheet" href="./css/features.css">
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
                    <a href="Body.php">
                        <img src="./img/image 2.svg" alt="image" />
                        <p>Body</p>
                    </a>
                </div>
            </div>
        </div>

        <div id="section_Whois" class="section_Whois">
            <h1 class="section_4_h1">
                How do you want to scan your E-MailHeader ?
            </h1>

            <div class="three">
                <a id="but_5" class="but_5" href>Whois lookup</a>
                <a class="but_6" href="spf.php">SPF & DMARK & DKIM Check</a>
            </div>
            <div class="four">
                <a class="but_7" href="domain.php">Check domain in Black
                    List</a>
                <a class="but_8" href="extract.php">Extract Header
                    Information</a>
            </div>
        </div>

        <div id="check_Whois_Lookup" class="check_Whois_Lookup">
            <h1 class="section_5_h1">Whois Lookup</h1>
            <div class="Whois_Lookup_box">
                <input class="check_box" id="domain_input" required type="text"
                    placeholder="Input Domain Name....">
                <p><button type="submit" id="button_Whois_Lookup"
                        class="button_Whois_Lookup">Check</button></p>
            </div>
        </div>

        <div class="feature_Whois_Lookup" style="width: 1200px;height: 770px">
            <p class="text_1">
                <strong>Domain Name</strong><span id="domain_name"
                    class="text_span_1"><a id="domain_link" href="#"
                        target="_blank">domain.com</a></span>
            </p>
            <p class="text_2">
                <strong>Registrar </strong><span id="registrar"
                    class="text_span_2">MarkMonitor
                    Inc</span>
            </p>
            <p class="text_3">
                <strong>Creation Date</strong><span id="creation_date"
                    class="text_span_3">1997-09-15 04:00:00</span>
            </p>
            <p class="text_4">
                <strong>Expiration Date</strong><span id="expiration_date"
                    class="text_span_4">2028-09-14 04:00:00</span>
            </p>
            <p class="text_5">
                <strong>Update Date</strong><span id="updated_date"
                    class="text_span_5">2023-09-14 04:39:00</span>
            </p>
            <p class="text_6">
                <strong>Name Server</strong><span id="name_servers"
                    class="text_span_6">NS1.GOOGLE.COM,<br> NS2.GOOGLE.COM,<br>
                    NS3.GOOGLE.COM<br></span>
            </p>
            <p class="text_7">
                <strong>Status</strong><span id="status"
                    class="text_span_7">client Update
                    Prohibited,<br>
                    client
                    Transfer Prohibited,<br> client Delete Prohibited<br></span>
            </p>
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
            document.getElementById("button_Whois_Lookup").addEventListener("click", async function (event) {
                event.preventDefault();

                const domainName = document.getElementById("domain_input").value.trim();
                if (!domainName) {
                    alert("Please enter a domain name.");
                    return;
                }

                try {
                    // Call the Flask API
                    const res = await fetch("https://tester-production-caf8.up.railway.app/whoise", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({ domain: domainName })
                    });

                    const data = await res.json();

                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    // Update UI
                    document.getElementById("domain_link").href = "https://" + (data.domain_name || "N/A");
                    document.getElementById("domain_link").textContent = data.domain_name || "N/A";
                    document.getElementById("registrar").textContent = data.registrar || "N/A";
                    document.getElementById("creation_date").textContent = data.creation_date || "N/A";
                    document.getElementById("expiration_date").textContent = data.expiration_date || "N/A";
                    document.getElementById("updated_date").textContent = data.updated_date || "N/A";
                    document.getElementById("name_servers").textContent = Array.isArray(data.name_servers)
                        ? data.name_servers.join(", ") : "N/A";
                    document.getElementById("status").textContent = Array.isArray(data.status)
                        ? data.status.join(", ") : "N/A";

                    // Store in MySQL using your PHP endpoint
                    await fetch("api/store_whois.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify(data)
                    });

                } catch (error) {
                    console.error("Error:", error);
                    alert("An error occurred while fetching WHOIS data.");
                }
            });
        </script>

    </body>

</html>