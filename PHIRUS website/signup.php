<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./img/logo_nav.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/signup.css">
    <title>Phirus</title>
</head>

<body>
<div class="Back_Arrow">
    <a href="index.php">
        <img class="icon" src="./img/Back-Arrow.svg"></a>
</div>
<div class="logo">
    <img class="logo_img" src="./img/logo_home.png" alt="logo_img">
</div>
<div class="container">
    <div class="card">
        <form action="api/register.php" method="POST">
            <h1>Create Account</h1>

            <?php
                if (isset($_GET['error'])) {
                    echo '<p style="color:red;">' . htmlspecialchars($_GET['error']) . '</p>';
            }
            if (isset($_GET['success'])) {
            echo '<p style="color:green;">' . htmlspecialchars($_GET['success']) . '</p>';
            }
            ?>

            <div class="input_group">
                <input name="full_name" required type="text" placeholder="Full Name" autofocus>
                <p><input name="email" required type="email" placeholder="Email Address"></p>
                <p><input name="password" required type="password" placeholder="Enter Password"></p>
                <p><input name="confirm_password" required type="password" placeholder="Confirm Password"></p>
            </div>

            <button type="submit">Create Account</button>

            <div class="hr">
                <hr>
                Other Sign Up Options
                <hr>
            </div>

            <div class="social_sign_up">
                <a href="https://appleid.apple.com/login" class="social_btn_apple">
                    <img src="./img/IOS.svg">
                </a>
                <a href="https://accounts.google.com/login" class="social_btn_google">
                    <img src="./img/Google.svg">
                </a>
            </div>
        </form>
    </div>
</div>
</body>

</html>
