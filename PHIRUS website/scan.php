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
    <link rel="stylesheet" href="./css/scan.css">
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

    <div class="featuer_Scan_URL">
        <h1 class="text_Scan_URL_1">
            How do you want to scan your E-Mail Body ?
        </h1>
        <div class="container_Scan_URL">
            <div class="one">
                <a class="but_Check_Steganography" href="Body.php">Check Attachment</a>
            </div>
            <div class="two">
                <div class="dropdown_Check_URL">
                    <div class="dropdown_section_Check_URL">
                        <a id="but_Check_2" class="but_Check_2" href="#two">Check URL
                            <img class="arrow_img_check_1" src="./img/layer..svg" alt="">
                        </a>
                    </div>
                    <div class="dropdown_menu_Check_url">
                        <a id="but_scan_1" class="but_scan_1" href="scan.php">Scan URL
                            <img src="./img/Tick.svg" alt="">
                        </a>
                        <a id="but_check_ssl_1" class="but_check_ssl_1" href="ssl.php">Check SSL Certificate
                        </a>
                    </div>
                </div>
                <div class="dropdown_Scan_URL">
                    <div class="dropdown_section_Attachment">
                        <a class="but_Attachment" id="but_Attachment" href="#">Check Steganography
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

    <div id="Scan_URL" class="Scan_URL">
        <h1 class="section_5_h1">Scan URL</h1>
        <div class="Scan_box">
            <input id="inputurl" class="Scan_URL_box" required type="text" placeholder="Input URL....">
            <p><button type="submit" id="button_Scan_URL" class="button_Scan_URL">Check</button></p>
        </div>
    </div>


    <div class="container_three_features">
        <div class="container_url">
            <p class="url_1">
                <strong class="strong_url_1">Domain </strong><span class="span_url_1"><a
                        href="https://accounts.google.com">google.com</a></span>
            </p>
            <p class="url_2">
                <strong class="strong_url_2">Path</strong><span class="span_url_2">/path</span>
            </p>
            <p class="url_3">
                <strong class="strong_url_3">Query</strong><span class="span_url_3">123</span>
            </p>
            <p class="url_4">
                <strong class="strong_url_4">Scheme</strong><span class="span_url_4">HTTPS</span>
            </p>
            <p class="url_5">
                <strong class="strong_url_5">Port</strong><span class="span_url_5">443</span>
            </p>
            <p class="url_6">
                <strong class="strong_url_6">Phirus Result</strong><span class="span_url_6">Malicious</span>
            </p>
        </div>
        <div class="container_Virus_Total">
            <h3 class="h1_Virus">Virus Total Result</h3>
            <p class="Virus_1">
                <strong class="strong_Virus_1">Type</strong><span class="span_Virus_1">URL</span>
            </p>
            <p class="Virus_2">
                <strong class="strong_Virus_2">Harmless Count</strong><span class="span_Virus_2">70</span>
            </p>
            <p class="Virus_3">
                <strong class="strong_Virus_3">Malicious Count</strong><span class="span_Virus_3">2</span>
            </p>
            <p class="Virus_4">
                <strong class="strong_Virus_4">Suspicious Count</strong><span class="span_Virus_4">3</span>
            </p>
            <p class="Virus_5">
                <strong class="strong_Virus_5">Undetected Count</strong><span class="span_Virus_5">25</span>
            </p>
        </div>

        <div class="verdict_box">
            <div class="verdict_row">
                <strong class="label_1">Engine :</strong><span class="value">McAfee</span>
                <strong class="label_2">Verdict :</strong><span class="value">Malicious</span>
                <strong class="label_3">Result :</strong><span class="value">Malicious Site</span>
            </div>
            <div class="verdict_row_2">
                <strong class="label_4">Engine :</strong><span class="value_2">Kaspersky</span>
                <strong class="label_5">Verdict :</strong><span class="value_2">Malicious</span>
                <strong class="label_6">Result :</strong><span class="value_2">Malicious Site</span>
            </div>
        </div>
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
        document.getElementById('button_Scan_URL').addEventListener('click', async () => {
            const url = document.getElementById('inputurl').value.trim();
            if (!url) { alert('Please enter a URL'); return; }

            try {
                /* ───── 1. Call Flask micro‑service ───── */
                const res = await fetch('https://tester-production-caf8.up.railway.app/urlcheck', {
                    method : 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body   : JSON.stringify({ url })
                });
                if (!res.ok) {
                    const err = await res.json().catch(() => ({}));
                    throw new Error(err.error || 'Flask API error');
                }
                const data = await res.json();

                /* ───── 2. Update UI ───── */
                document.querySelector('.span_url_1 a').textContent = data.url_info.Domain;
                document.querySelector('.span_url_1 a').href        = 'https://' + data.url_info.Domain;
                document.querySelector('.span_url_2').textContent   = data.url_info.Path   || '/';
                document.querySelector('.span_url_3').textContent   = data.url_info.Query  || 'None';
                document.querySelector('.span_url_4').textContent   = data.url_info.Scheme || '';
                document.querySelector('.span_url_5').textContent   = data.url_info.Port   || '';
                document.querySelector('.span_url_6').textContent   =
                    data.prediction === 'phishing' ? 'Malicious' : 'Legitimate';

                if (data.virustotal_result?.data?.attributes?.last_analysis_stats) {
                    const s = data.virustotal_result.data.attributes.last_analysis_stats;
                    document.querySelector('.span_Virus_1').textContent = 'URL';
                    document.querySelector('.span_Virus_2').textContent = s.harmless;
                    document.querySelector('.span_Virus_3').textContent = s.malicious;
                    document.querySelector('.span_Virus_4').textContent = s.suspicious;
                    document.querySelector('.span_Virus_5').textContent = s.undetected;
                }

                document.querySelector('.value').textContent   = 'McAfee';
                document.querySelector('.value_2').textContent = 'Kaspersky';
                document.querySelector('.label_3 + .value').textContent =
                    document.querySelector('.label_6 + .value_2').textContent =
                        data.prediction === 'phishing' ? 'Malicious Site' : 'Safe Site';

                /* ───── 3. Store results in your PHP API ───── */
                await fetch('/api/url_scan.php', {
                    method      : 'POST',
                    headers     : { 'Content-Type': 'application/json' },
                    credentials : 'include', // send PHP session cookie
                    body        : JSON.stringify({
                        url_info : {
                            FullURL: url,
                            Domain : data.url_info.Domain,
                            Path   : data.url_info.Path,
                            Query  : data.url_info.Query,
                            Scheme : data.url_info.Scheme,
                            Port   : data.url_info.Port
                        },
                        prediction       : data.prediction,
                        virustotal_result: data.virustotal_result
                    })
                })
                    .then(r => r.json())
                    .then(j => console.log('DB store →', j))
                    .catch(e => console.error('Store API error:', e));
            }
            catch (error) {
                console.error(error);
                alert('Error: ' + error.message);
            }
        });
    </script>


</body>

</html>