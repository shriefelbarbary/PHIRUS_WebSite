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
    <link rel="stylesheet" href="./css/ssl.css">
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
            <img class="image_section_1" src="./img/features_1.svg" alt="image">
        </div>
    </div>

    <div class="section_2">
        <h1 class="section_2_h1">
            Checking the Body of your<br>
            E-mail
        </h1>
        <div class="image_section_2">
            <div class="img_features_1">
                <a href="features.php">
                    <img src="./img/image 3.svg" alt="image" />
                    <p>Header</p>
                </a>
            </div>
            <div class="img_features_2">
                <a href="#">
                    <img src="./img/image 2.svg" alt="image" />
                    <p>Body</p>
                </a>
            </div>
        </div>
    </div>

    <div class="featuer_check_ssl">
        <h1 class="text_check_ssl_1">
            How do you want to scan your E-Mail Body ?
        </h1>
        <div class="container_check_ssl">
            <div class="one">
                <a class="but_Check_Steganography" href="Body.php">Check Attachment</a>
            </div>
            <div class="two">
                <div class="dropdown_Check_URL" id="dropdown_Check_URL">
                    <div class="dropdown_section_Check_URL">
                        <a id="but_Check_2" class="but_Check_2" href="#dropdown_Check_URL">Check URL
                            <img class="arrow_img_check_1" src="./img/layer..svg" alt="">
                        </a>
                    </div>
                    <div class="dropdown_menu_Check_url">
                        <a id="but_scan_1" class="but_scan_1" href="scan.php">Scan URL
                        </a>
                        <a id="but_check_ssl_1" class="but_check_ssl_1" href="ssl.php">Check SSL Certificate
                            <img src="./img/Tick.svg" alt="">
                        </a>
                    </div>
                </div>
                <div class="dropdown_check_ssl" id="dropdown_check_ssl">
                    <div class="dropdown_section_Attachment">
                        <a class="but_Attachment" id="but_Attachment" href="#dropdown_check_ssl">Check Steganography
                            <img class="arrow_img_Attachment" src="./img/layer..svg" alt="">
                        </a>
                    </div>
                    <div class="dropdown_menu_Check_Attachment">
                        <a id="but_Image" class="but_Image" href="Steganography.php">Image Steganography
                        </a>
                        <a id="but_Video" class="but_Video" href="Video.Steganography.php">Video Steganography
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="ssl" class="ssl">
        <h1 class="section_5_h1">Check SSL Certificate</h1>
        <div class="ssl_box">
            <input id="ssl_input" class="check_ssl_box" required type="text" placeholder="Input URL....">
            <p><button type="submit" id="button_check_ssl" class="button_check_ssl">Check</button></p>
        </div>
    </div>

    <div class="container_features_ssl">
        <div class="container_ssl">
            <p class="ssl_1">
                <strong class="strong_ssl_1">Issued To</strong><span class="span_ssl_1" id = "IssuedTo"><a
                        href="https://accounts.google.com">google.com</a></span>
            </p>
            <p class="ssl_2">
                <strong class="strong_ssl_2">Issuer</strong><span class="span_ssl_2" id = "Issuer">WR2</span>
            </p>
            <p class="ssl_3">
                <strong class="strong_ssl_3">Valid From</strong><span class="span_ssl_3" id = "ValidFrom">Jan 6 08:36:08 2025 GMT</span>
            </p>
            <p class="ssl_4">
                <strong class="strong_ssl_4">Valid To</strong><span class="span_ssl_4" id = "ValidTo">Mar 29 08:36:07 2025 GMT</span>
            </p>
        </div>

        <footer class="footer" id="footer">
            <div class="container">
                <div class="footer_section_1">
                    <div class="icon_and_text">
                        <a href=""><img class="img_1" src="./img/Logo (1).svg" alt=""></a>
                        <a href="">
                            <h2 class="text_h2_section_1">Phirus</h2>
                        </a>
                    </div>
                    <p class="p_section_1">Copyright © 2024 Phirus.</p>
                    <span class="span_section_1">All rights reserved</span>
                    <div class="icon_three_section_1">
                        <a href=""><img class="img_2" src="./img/Social Icons.svg" alt="Instagram"></a>
                        <a href=""><img class="img_3" src="./img/Icons2.svg" alt="Twitter"></a>
                        <a href=""><img class="img_4" src="./img/Icons3.svg" alt="Youtube"></a>
                    </div>
                </div>
                <div class="container_three">
                    <div class="footer_section_2">
                        <h2 class="text_h2_section_2">Company</h2>
                        <ul>
                            <li><a href="">About us</a></li>
                            <li><a href="">Blog</a></li>
                            <li><a href="">Contact us</a></li>
                            <li><a href="">Pricing</a></li>
                            <li><a href="">Testimonials</a></li>
                        </ul>
                    </div>

                    <div class="footer_section_3">
                        <h2 class="text_h2_section_3">Support</h2>
                        <ul>
                            <li><a href="">Help center</a></li>
                            <li><a href="">Terms of service</a></li>
                            <li><a href="">Legal</a></li>
                            <li><a href="">Privacy policy</a></li>
                            <li><a href="">Status</a></li>
                        </ul>
                    </div>
                    <div class="footer_section_4">
                        <h2 class="text_h2_section_4">Stay up to date</h2>
                        <form class="subscribe_form">
                            <input type="email" placeholder="Your email address" required>
                            <button type="submit"><img src="./img/0.svg" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </footer>

        <script>
            /* ------------------------------------------------------------------
               CONFIG – adjust if your back‑ends live elsewhere
            ------------------------------------------------------------------ */
            const FLASK_CHECK_URL = "https://tester-production-caf8.up.railway.app/ssltls";
            const PHP_STORE_URL   = "/api/ssl.php";   // <-- leading “/”

            /* ------------------------------------------------------------------
               1. Helper: put the same element look‑ups in variables
            ------------------------------------------------------------------ */
            const btn       = document.getElementById("button_check_ssl");
            const input     = document.getElementById("ssl_input");
            const spanTo    = document.getElementById("IssuedTo");
            const spanIssuer= document.getElementById("Issuer");
            const spanFrom  = document.getElementById("ValidFrom");
            const spanToD   = document.getElementById("ValidTo");

            /* ------------------------------------------------------------------
               2. Main click handler
            ------------------------------------------------------------------ */
            btn.addEventListener("click", async (e) => {
                e.preventDefault();

                // -- Validate & normalise URL ----------------------------------
                let url = input.value.trim();
                if (!url) { alert("Please enter a URL."); return; }
                if (!/^https?:\/\//i.test(url)) url = "https://" + url;

                btn.disabled = true;
                btn.textContent = "Checking…";

                try {
                    /* 2.1 Call Flask micro‑service ---------------------------- */
                    const res = await fetch(FLASK_CHECK_URL, {
                        method : "POST",
                        headers: { "Content-Type": "application/json" },
                        body   : JSON.stringify({ url })
                    });
                    if (!res.ok) throw new Error(`Flask API HTTP ${res.status}`);
                    const cert = await res.json();
                    if (cert.error) throw new Error(cert.error);

                    /* 2.2 Update UI ------------------------------------------ */
                    spanTo.innerHTML    = cert.IssuedTo
                        ? `<a href="${url}" target="_blank" rel="noopener">${cert.IssuedTo}</a>`
                        : "Not Available";
                    spanIssuer.textContent = cert.Issuer    || "Not Available";
                    spanFrom.textContent   = cert.ValidFrom || "Not Available";
                    spanToD.textContent    = cert.ValidTo   || "Not Available";

                    /* 2.3 Store in DB via PHP -------------------------------- */
                    const store = await fetch(PHP_STORE_URL, {
                        method : "POST",
                        headers: { "Content-Type": "application/json" },
                        credentials: "include",              // sends PHPSESSID cookie
                        body   : JSON.stringify({
                            url,
                            issued_to : cert.IssuedTo,
                            issuer    : cert.Issuer,
                            valid_from: cert.ValidFrom,
                            valid_to  : cert.ValidTo
                        })
                    });
                    const storeJson = await store.json();
                    if (!store.ok) console.error("Store API error:", storeJson.error);
                }
                catch (err) {
                    console.error(err);
                    alert("❌ " + err.message);
                    ["IssuedTo","Issuer","ValidFrom","ValidTo"].forEach(id =>
                        document.getElementById(id).textContent = "Error");
                }
                finally {
                    btn.disabled  = false;
                    btn.textContent = "Check";
                }
            });
        </script>


</body>

</html>