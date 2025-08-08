<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./img/logo_nav.png">
    <meta http-equiv="refresh" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/forget.css">
    <title>Phirus</title>
</head>

<body>
    <div class="Back_Arrow">
        <a href="login.php">
            <img class="icon" src="./img/Back-Arrow.svg"></a>
    </div>
    <div class="logo">
        <img class="logo_img" src="./img/logo_home.png" alt="logo_img">
    </div>
    <div class="container">
        <div class="card">
            <form action="api/request_reset.php" method="POST">
                <img class="lock_box" src="./img/Password.svg">
                <h1>Forgot Password</h1>
                <input type="email" name="email" required placeholder="Enter Email" autofocus>
                <a href="log.otp.html"><p><button type="submit">Send</button></p></a>
            </form>
        </div>
    </div>
</body>

</html>