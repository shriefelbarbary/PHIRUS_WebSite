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
    <meta http-equiv="refresh" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/steganography.css">
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
        <h1 class="section_1_h1">How do you want to scan your E-mail?</h1>
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
            How do you want to scan your E-Mail Body?
        </h1>
        <div class="container_check_ssl">
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
                        <a id="but_scan_1" class="but_scan_1" href="scan.php">Scan URL</a>
                        <a id="but_check_ssl_1" class="but_check_ssl_1" href="ssl.php">Check SSL Certificate</a>
                    </div>
                </div>
                <div class="dropdown_check_ssl">
                    <div class="dropdown_section_Attachment">
                        <a class="but_Attachment" id="but_Attachment" href="#">Check Steganography
                            <img class="arrow_img_Attachment" src="./img/layer..svg" alt="">
                        </a>
                    </div>
                    <div class="dropdown_menu_Check_Attachment">
                        <a id="but_Image" class="but_Image" href="#">Image Steganography
                            <img src="./img/Tick.svg" alt="">
                        </a>
                        <a id="but_Video" class="but_Video" href="Video.Steganography.php">Video Steganography</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container_check_image">
        <h1 class="text_5">Image Steganography</h1>
        <div class="box_Image_Steganography">
            <label for="imageInput" class="image_label">
                <img id="uploadIcon" class="upload_iocn" src="./img/image.check.svg" alt="Upload Icon">
            </label>
            <input id="imageInput" type="file" accept="image/*" hidden>
            <button class="upload_button" onclick="checkSteganography()">Upload The Image</button>
        </div>
    </div>

    <div id="resultContainer" class="container_features_image" style="display: none;"></div>

    <footer class="footer" id="footer">
        <div class="container">
            <div class="footer_section_1">
                <div class="icon_and_text">
                    <a href=""><img class="img_1" src="./img/Logo (1).svg" alt=""></a>
                    <a href=""><h2 class="text_h2_section_1">Phirus</h2></a>
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
        const input       = document.getElementById('imageInput');
        const uploadIcon  = document.getElementById('uploadIcon');
        const resultBox   = document.getElementById('resultContainer');

        input.addEventListener('change', e => {
            const file = e.target.files[0];
            if (!file) return;

            // Show preview
            const reader = new FileReader();
            reader.onload = ev => {
                uploadIcon.src = ev.target.result;
            };
            reader.readAsDataURL(file);

            // Auto-run the check on file selection
            checkSteganography(file);
        });

        async function checkSteganography(file) {
            try {
                const formData = new FormData();
                formData.append('image', file);

                const response = await fetch('https://tester-production-caf8.up.railway.app/stegnography', {
                    method: 'POST',
                    body: formData
                });

                if (!response.ok) throw new Error(`Server error: ${response.status}`);
                const result = await response.json();

                // UI display
                resultBox.innerHTML = result.hidden
                    ? `<div class="container_image">
                    <img src="./img/no.svg" alt="Warning">
                    <h2 class="like_image">Image Steganography</h2>
                    <p>🚨 Hidden message found</p>
                   </div>`
                    : `<div class="container_image">
                    <img src="./img/like.svg" alt="Success">
                    <h2 class="like_image">Image Steganography</h2>
                    <p>✅ No hidden message found</p>
                   </div>`;
                resultBox.style.display = 'block';

                // Store result in database via PHP
                await fetch('/api/image_steg.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    credentials: 'include',
                    body: JSON.stringify({
                        filename: file.name,
                        hidden  : result.hidden ? 1 : 0,
                        message : result.hidden ? result.message : null
                    })
                })
                    .then(r => r.json())
                    .then(j => console.log('DB store →', j))
                    .catch(e => console.error('Store API error:', e));
            }
            catch (err) {
                console.error(err);
                alert(`Failed: ${err.message}`);
            }
        }
    </script>


</body>
</html>
