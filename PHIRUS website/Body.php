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
    <link rel="stylesheet" href="./css/body.css">
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


    <div class="featuer_Check_Attachment">
        <h1 class="text_Check_Attachment_1">
            How do you want to scan your E-Mail Body ?
        </h1>
        <div class="container_Check_Attachment" id="container_Check_Attachment">
            <div class="three">
                <a class="but_Check_Steganography" href="Body.php">Check Attachment</a>
            </div>
            <div class="four">
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
                            <img src="./img/Tick.svg" alt="">
                        </a>
                    </div>
                </div>
                <div class="dropdown_Check_Attachment">
                    <div class="dropdown_section_Attachment">
                        <a class="but_Attachment" id="but_Attachment" href="#">Check Steganography
                            <img class="arrow_img_Attachment" src="./img/layer..svg" alt="">
                        </a>
                    </div>
                    <div class="dropdown_menu_Check_Attachment">
                        <a id="but_Image" class="but_Image" href="Steganography.php">Image Steganography
                            <img src="./img/Tick.svg" alt="">
                        </a>
                        <a id="but_Video" class="but_Video" href="Video.Steganography.php">Video Steganography
                            <img src="./img/Tick.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container_check_file">
        <h1 class="text_5">Check Attachment</h1>
        <div class="box_Check_Attachment">
    <label for="fileInput" class="file_label">
        <img id="previewImage" class="upload_iocn" src="./img/file.icon.svg" alt="Upload Icon">
        <span id="fileNameText" style="display:none; font-weight:bold; text-align:center;"></span>
    </label>
    <input id="fileInput" type="file" hidden>
    <button id="upload_button" class="upload_button">Upload The Attachment</button>
    <p id="fileNameDisplay" style="margin-top: 10px; font-weight: bold;"></p>
</div>
    </div>


    <div class="container_featuer_Check_Attachment">
        <p class="Attachment_1">
            <strong class="strong_Attachment_1">File ID</strong><span class="span_Attachment_1" id="file_id">12345abcde67890</span>
        </p>
        <p class="Attachment_2">
            <strong class="strong_Attachment_2">Malicious Detections</strong><span class="span_Attachment_2" id="malicious">3</span>
        </p>
        <p class="Attachment_3">
            <strong class="strong_Attachment_3">Undetected Detections</strong><span class="span_Attachment_3" id="undetected">60</span>
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
        // Preview selected file (image vs non-image)
        document.getElementById("fileInput").addEventListener("change", function (e) {
            const file = e.target.files[0];
            const preview = document.getElementById("previewImage");
            const fileNameText = document.getElementById("fileNameText");

            if (file) {
                if (file.type.startsWith("image/")) {
                    fileNameText.style.display = "none";
                    preview.style.display = "block";
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        preview.src = event.target.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.style.display = "none";
                    fileNameText.style.display = "block";
                    fileNameText.textContent = file.name;
                }
            }
        });

        // Upload & analyse attachment + persist result
        document.getElementById("upload_button").addEventListener("click", async function (event) {
            event.preventDefault();

            const input = document.getElementById("fileInput");
            const file = input.files[0];
            if (!file) {
                alert("Please upload a file.");
                return;
            }

            const formData = new FormData();
            formData.append("file", file);

            try {
                const response = await fetch("https://tester-production-caf8.up.railway.app/checkattach", {
                    method: "POST",
                    body: formData
                });
                const data = await response.json();

                if (data.error) {
                    alert(data.error);
                    return;
                }

                // Display results in UI
                document.getElementById("file_id").textContent = data.file_id;
                document.getElementById("malicious").textContent = data.malicious;
                document.getElementById("undetected").textContent = data.undetected;

                // Persist result to backend DB
                await fetch("/api/attachement.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        check_id: "att-" + Date.now(),
                        file_id: data.file_id,
                        malicious_detections: data.malicious,
                        undetected_detections: data.undetected
                    })
                })
                    .then(r => r.json())
                    .then(res => console.log("✔ Stored:", res.message || res.error))
                    .catch(err => console.error("Store Error:", err));

            } catch (error) {
                console.error("Error:", error);
                alert("An error occurred while fetching the attachment.");
            }
        });
    </script>

</body>
</html>