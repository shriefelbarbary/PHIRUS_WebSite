<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

include_once "../config/Database.php";
include_once "../model/User.php";

$database = new Database();
$db = $database->connect();
$user = new User($db);

// Check if form data exists
if (isset($_POST['full_name'], $_POST['email'], $_POST['password'], $_POST['confirm_password'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        header("Location: ../signup.php?error=Passwords do not match");
        exit;
    }

    // Assign values
    $user->username = $full_name;
    $user->email = $email;
    $user->password = $password;

    if ($user->register()) {
        header("Location: ../login.php?success=User registered successfully");
    } else {
        header("Location: ../signup.php?error=Registration failed. Try again");
    }
} else {
    header("Location: ../signup.php?error=Incomplete form submission");
}




/*
 * <?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");


include_once "../config/Database.php";
include_once "../model/User.php";

$database = new Database();
$db = $database->connect();
$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

if (!$data) {
    echo json_encode(["message" => "No JSON received"]);
    exit;
}

echo json_encode(["received_data" => $data]);

if (!empty($data->username) && !empty($data->email) && !empty($data->password)) {
    $user->username = $data->username;
    $user->email = $data->email;
    $user->password = $data->password;

    if ($user->register()) {
        echo json_encode(["message" => "User registered successfully."]);
    } else {
        echo json_encode(["message" => "Registration failed."]);
    }
} else {
    echo json_encode(["message" => "Incomplete data."]);
}
?>
*/