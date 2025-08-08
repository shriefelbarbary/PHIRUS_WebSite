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
    <link rel="stylesheet" href="./css/Video.Steganography.css">
    <title>Phirus</title>
</head>

<body>
    <!-- Navbar -->
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

    <!-- Hero Section -->
    <div class="hero_section">
        <h1 class="section_1_h1"> How do you want to scan your E-mail?</h1>
        <div class="text_and_img">
            <p class="text_p_1">
                Now, you can scan your e-mail and be<br>
                sure that your e-mail isn’t phishing or<br>
                malicious with some Primary features,<br>
                and every primary feature has some sub<br>
                features.
            </p>
            <img class="image_section_1" src="./img/features_1.svg" alt="image">
        </div>
    </div>

    <!-- Features Section -->
    <div class="section_2">
        <h1 class="section_2_h1">Checking the Body of your<br> E-mail</h1>
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

    <!-- Sub Features Section -->
    <div class="featuer_check_ssl">
        <h1 class="text_check_ssl_1">How do you want to scan your E-Mail Body?</h1>
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
                        <a id="but_Image" class="but_Image" href="Steganography.php">Image Steganography</a>
                        <a id="but_Video" class="but_Video" href="Video.Steganography.php">Video Steganography
                            <img src="./img/Tick.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Video Upload Section -->
    <div class="container_check_video">
        <h1 class="text_5">Video Steganography</h1>
        <div class="box_video_Steganography">
            <label for="videoInput" class="video_label">
                <img id="uploadIcon" class="upload_iocn" src="./img/fluent-mdl2_video-search.svg" alt="Upload Icon">
                <span id="fileName" class="file_name_text"></span>
            </label>
            <input id="videoInput" type="file" accept="video/*" hidden>
            <button class="upload_button" onclick="checkSteganography()">Upload The Video</button>
        </div>
        
        <div id="resultContainer" style="display: none; margin-top: 30px;"></div>
    </div>

    <!-- Footer -->
    <footer class="footer" id="footer">
        <div class="container">
            <div class="footer_section_1">
                <div class="icon_and_text">
                    <a href="#"><img class="img_1" src="./img/Logo (1).svg" alt=""></a>
                    <a href="#">
                        <h2 class="text_h2_section_1">Phirus</h2>
                    </a>
                </div>
                <p class="p_section_1">Copyright © 2024 Phirus.</p>
                <span class="span_section_1">All rights reserved</span>
                <div class="icon_three_section_1">
                    <a href="#"><img class="img_2" src="./img/Social Icons.svg" alt="Instagram"></a>
                    <a href="#"><img class="img_3" src="./img/Icons2.svg" alt="Twitter"></a>
                    <a href="#"><img class="img_4" src="./img/Icons3.svg" alt="Youtube"></a>
                </div>
            </div>
            <div class="container_three">
                <div class="footer_section_2">
                    <h2 class="text_h2_section_2">Company</h2>
                    <ul>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">Pricing</a></li>
                        <li><a href="#">Testimonials</a></li>
                    </ul>
                </div>
                <div class="footer_section_3">
                    <h2 class="text_h2_section_3">Support</h2>
                    <ul>
                        <li><a href="#">Help center</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Legal</a></li>
                        <li><a href="#">Privacy policy</a></li>
                        <li><a href="#">Status</a></li>
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
        const videoInput  = document.getElementById('videoInput');
        const fileNameSpan= document.getElementById('fileName');
        const uploadIcon  = document.getElementById('uploadIcon');

        /* preview filename */
        videoInput.addEventListener('change', e => {
            const f = e.target.files[0];
            if (f) { fileNameSpan.textContent = f.name; uploadIcon.style.display = 'none'; }
        });

        async function checkSteganography() {
            const file = videoInput.files[0];
            if (!file) { alert('Please upload a video first.'); return; }

            try {
                /* 1. call Flask */
                const fd  = new FormData();
                fd.append('file', file);
                const res = await fetch('https://tester-production-caf8.up.railway.app/sstegno', {
                    method: 'POST', body: fd
                });
                const result = await res.json();

                /* 2. show result */
                const box = document.getElementById('resultContainer');
                const found = result.hidden;
                const msg   = found ? (result.message || 'Hidden message found')
                    : 'No hidden message found';
                box.innerHTML = found
                    ? `<div class="container_features_image" style="height:400px">
                 <div class="container_image">
                     <img src="./img/no.svg"><h2>Video Steganography</h2>
                     <p>🚨 Hidden message found</p>
                 </div></div>`
                    : `<div class="container_features_image" style="height:400px">
                 <div class="container_image">
                     <img src="./img/like.svg"><h2>Video Steganography</h2>
                     <pre>✅ There is No hidden message found in the Video</pre>
                 </div></div>`;
                box.style.display = 'block';

                /* 3. save to MySQL via PHP */
                await fetch('/api/video.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    credentials: 'include',                // send PHPSESSID cookie
                    body: JSON.stringify({
                        filename: file.name,
                        message : msg
                    })
                })
                    .then(r => r.json())
                    .then(j => console.log('DB store →', j))
                    .catch(e => console.error('Store API error:', e));

            } catch (err) {
                console.error('❌ Error:', err);
                alert('Failed: ' + err.message);
            }
        }
    </script>



</body>

</html>
