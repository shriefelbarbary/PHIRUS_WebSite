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
        <link rel="stylesheet" href="./css/spf.css">
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

        <div id="check_SPF" class="check_SPF">
            <h1 class="section_5_h1">SPF & DMARK & DKIM Check</h1>
            <div class="SPF_box">
                <input id="domainInput" class="check_box" required type="text"
                    placeholder="Input Domain Name....">
                <p><button type="submit" id="button_SPF"
                        class="button_SPF">Check</button></p>
            </div>
        </div>

        <div class="container_three_features hidden">
            <div class="container_spf">
                <h1 class="h1_spf">SPF</h1>
                <p class="spf_1">
                    <strong class="strong_spf_1">Status</strong><span
                        id="spf_status" class="span_spf_1">Fail</span><img
                        class="icon_spf_1"
                        src="./img/Vector (2).svg" alt>
                </p>
                <p class="spf_2">
                    <strong class="strong_spf_2">Mail From</strong><span
                        id="mail_from" class="span_spf_2"><a
                            href>Phishing.com</a></span>
                </p>
                <p class="spf_3">
                    <strong class="strong_spf_3">Authorized</strong><span
                        id="authorized" class="span_spf_3">No</span>
                </p>
                <p class="spf_4">
                    <strong class="strong_spf_4">Comment</strong><span
                        id="comment" class="span_spf_4">SPF Validation
                        Failed.<br>
                        Email claimed to be sent from<br>
                        <a href>phishing.com</a> .Mail server </span>
                </p>
                <p class="spf_4">
                    <strong class="strong_spf_5">Authorization</strong><span
                        id="authorization" class="span_spf_5">No</span>
                </p>
            </div>

            <div class="container_dkim">
                <h1 class="h1_dkim">DKIM</h1>
                <p class="Dkim_1">
                    <strong class="strong_dkim_1">Status</strong><span
                        id="dkim_status" class="span_dkim_1">Fail</span><img
                        class="icon_dkim_1" src="./img/Vector (2).svg" alt>
                </p>
                <p class="Dkim_2">
                    <strong class="strong_dkim_2">Signing Domain</strong><span
                        id="dkim_domain" class="span_dkim_2"><a
                            href>malicious.com</a></span>
                </p>
                <p class="Dkim_3">
                    <strong class="strong_dkim_3">Header Integrity</strong><span
                        id="dkim_integrity" class="span_dkim_3"> Possibly
                        Altered</span>
                </p>
                <p class="Dkim_4">
                    <strong class="strong_dkim_4">Comment</strong><span
                        id="dkim_comment" class="span_dkim_4">DKIM Validation
                        Failed.
                        .<br>
                        Email signed by <a href="#">malicious.com</a><br>
                        Header Integrity : Possibly Altered </span>
                </p>
            </div>

            <div class="container_dmarc">
                <h1 class="h1_dmarc">DMARC</h1>
                <p class="Dmarc_1">
                    <strong class="strong_dmarc_1">Status</strong><span
                        id="dmarc_status" class="span_dmarc_1">pass</span><img
                        class="icon_dmarc_1" src="./img/Vector (3).svg" alt>
                    <p class="Dmarc_2">
                        <strong class="strong_dmarc_2">Policy</strong><span
                            id="dmarc_policy" class="span_dmarc_2">Reject</span>
                    </p>
                    <p class="Dmarc_3">
                        <strong class="strong_dmarc_3">Alignment</strong><span
                            id="dmarc_alignment"
                            class="span_dmarc_3">Failed</span>
                    </p>
                    <p class="Dmarc_4">
                        <strong class="strong_dmarc_4">Comment</strong><span
                            id="dmarc_comment" class="span_dmarc_4">DMARC
                            Validation Failed.
                            <br>
                            Policy Applied : reject.<br>
                            Domain Alignment : Failed. </span>
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
                            <a href><img class="img_2"
                                    src="./img/Social Icons.svg"
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
                                <input type="email"
                                    placeholder="Your email address" required>
                                <button type="submit"><img src="./img/0.svg"
                                        alt></button>
                            </form>

                        </div>

                    </div>

                </div>

            </footer>

 <script>
     document.getElementById("button_SPF").addEventListener("click", function(event) {
         event.preventDefault();

         const domainName = document.getElementById("domainInput").value;
         document.querySelector(".container_three_features").classList.add("hidden");

         if (!domainName) {
             alert("Please enter a domain name.");
             return;
         }

         fetch("https://tester-production-caf8.up.railway.app/spfdmarc", {
             method: "POST",
             headers: {
                 "Content-Type": "application/json",
             },
             body: JSON.stringify({ domain: domainName }),
         })
             .then(response => {
                 if (!response.ok) throw new Error('Network response was not ok');
                 return response.json();
             })
             .then(data => {
                 console.log("Received data:", data);

                 
document.querySelector(".container_three_features").classList.remove("hidden");

// ----- SPF -----
if (data.spf) {
    document.getElementById("spf_status").textContent = data.spf.status || "N/A";
    if (data.spf.mail_from) {
        const mailFrom = data.spf.mail_from;
        document.getElementById("mail_from").innerHTML = `<a href="https://${mailFrom}" target="_blank">${mailFrom}</a>`;
    }
    document.getElementById("authorized").textContent = data.spf.authorized || "N/A";
    document.getElementById("comment").textContent = data.spf.comment || "N/A";
    document.getElementById("authorization").textContent = data.spf.authorization ? "Yes" : "No";

    
    const spfIcon = document.querySelector(".icon_spf_1");
    if (data.spf.status && data.spf.status.toLowerCase() === "pass") {
        spfIcon.src = "./img/Vector (3).svg";  
    } else {
        spfIcon.src = "./img/Vector (2).svg";  
    }
}

// ----- DKIM -----
if (data.dkim) {
    document.getElementById("dkim_status").textContent = data.dkim.status || "N/A";
    if (data.dkim.signing_domain) {
        const domain = data.dkim.signing_domain;
        document.getElementById("dkim_domain").innerHTML = `<a href="https://${domain}" target="_blank" rel="noopener noreferrer">${domain}</a>`;
    } else {
        document.getElementById("dkim_domain").textContent = "N/A";
    }
    document.getElementById("dkim_integrity").textContent = data.dkim.header_integrity || "N/A";
    document.getElementById("dkim_comment").textContent = data.dkim.comment || "N/A";

    const dkimIcon = document.querySelector(".icon_dkim_1");
    if (data.dkim.status && data.dkim.status.toLowerCase() === "pass") {
        dkimIcon.src = "./img/Vector (3).svg";
    } else {
        dkimIcon.src = "./img/Vector (2).svg";
    }
}

// ----- DMARC -----
if (data.dmarc) {
    document.getElementById("dmarc_status").textContent = data.dmarc.status || "N/A";
    document.getElementById("dmarc_policy").textContent = data.dmarc.policy || "N/A";
    document.getElementById("dmarc_alignment").textContent = data.dmarc.alignment || "N/A";
    document.getElementById("dmarc_comment").textContent = data.dmarc.comment || "N/A";

    const dmarcIcon = document.querySelector(".icon_dmarc_1");
    if (data.dmarc.status && data.dmarc.status.toLowerCase() === "pass") {
        dmarcIcon.src = "./img/Vector (3).svg";
    } else {
        dmarcIcon.src = "./img/Vector (2).svg";
    }
}


                 // ✅ Store in your PHP backend
                 return fetch("/api/email_security.php", {
                     method: "POST",
                     headers: { "Content-Type": "application/json" },
                     credentials: "include",
                     body: JSON.stringify({
                         domain: domainName,
                         spf  : data.spf  || null,
                         dkim : data.dkim || null,
                         dmarc: data.dmarc|| null
                     })
                 });
             })
             .then(r => r.json())
             .then(j => {
                 console.log("DB store ➜", j);
             })
             .catch(error => {
                 console.error("Error:", error);
                // alert("Failed to fetch data: " + error.message);
             });
     });

 </script>

        </body>

    </html>