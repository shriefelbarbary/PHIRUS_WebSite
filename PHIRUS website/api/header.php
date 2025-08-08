<?php
session_start();
header('Content-Type: application/json');

require_once '../config/Database.php';

$database = new Database();
$conn = $database->connect();

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$payload = json_decode(file_get_contents('php://input'), true);
if (!$payload) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
    exit;
}

$sql = "INSERT INTO header_checks
        (user_id, check_id, from_email, to_email, subject, date, message_id, reply_to)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->execute([
    $user_id,
    $payload['check_id'] ?? '',
    $payload['from'] ?? '',
    $payload['to'] ?? '',
    $payload['subject'] ?? '',
    $payload['date'] ?? '',
    $payload['message_id'] ?? '',
    $payload['reply_to'] ?? ''
]);

echo json_encode(['message' => 'Header check stored']);
