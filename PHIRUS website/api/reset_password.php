<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../config/Database.php";
include_once "../model/User.php";

$database = new Database();
$db = $database->connect();
$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->token) && !empty($data->new_password) && !empty($data->confirm_password)) {
    if ($data->new_password !== $data->confirm_password) {
        echo json_encode(["message" => "Passwords do not match."]);
        exit;
    }

    if ($user->verifyToken($data->token)) {
        $hashedPassword = password_hash($data->new_password, PASSWORD_BCRYPT);
        if ($user->updatePassword($hashedPassword)) {
            echo json_encode(["message" => "Password updated successfully."]);
        } else {
            echo json_encode(["message" => "Failed to update password."]);
        }
    } else {
        echo json_encode(["message" => "Invalid or expired token."]);
    }
} else {
    echo json_encode(["message" => "All fields are required."]);
}
?>
