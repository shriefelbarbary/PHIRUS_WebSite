<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

include_once "../config/Database.php";

$input = json_decode(file_get_contents("php://input"), true);

$required = ['check_id', 'file_id', 'malicious_detections', 'undetected_detections'];

foreach ($required as $field) {
    if (!isset($input[$field])) {
        echo json_encode(["error" => "Missing $field"]);
        exit;
    }
}

$database = new Database();
$db = $database->connect();

$stmt = $db->prepare("
    INSERT INTO attachment_analysis 
    (user_id, check_id, file_id, malicious_detections, undetected_detections)
    VALUES (:user_id, :check_id, :file_id, :malicious, :undetected)
");

$stmt->bindParam(":user_id", $_SESSION['user_id']);
$stmt->bindParam(":check_id", $input['check_id']);
$stmt->bindParam(":file_id", $input['file_id']);
$stmt->bindParam(":malicious", $input['malicious_detections']);
$stmt->bindParam(":undetected", $input['undetected_detections']);

if ($stmt->execute()) {
    echo json_encode(["message" => "Attachment analysis stored successfully"]);
} else {
    echo json_encode(["error" => "Database insert error"]);
}
