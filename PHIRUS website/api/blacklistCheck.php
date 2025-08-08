<?php

session_start();
header('Content-Type: application/json');
require_once '../config/Database.php';

// Check if user is logged in
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// Get POST JSON
$payload = file_get_contents("php://input");
$data = json_decode($payload, true);

// Validate required fields
if (
    empty($data['domain']) || empty($data['check_id']) ||
    !isset($data['status']) || !isset($data['malicious_votes']) || !isset($data['suspicious_votes'])
) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required fields']);
    exit;
}

try {
    $database = new Database();
    $conn = $database->connect();

    $sql = "INSERT INTO blacklist_checks 
            (user_id, check_id, domain, status, malicious_votes, suspicious_votes)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $user_id,
        $data['check_id'],
        $data['domain'],
        $data['status'],
        (int)$data['malicious_votes'],
        (int)$data['suspicious_votes']
    ]);

    echo json_encode(['message' => 'Blacklist check stored']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'DB Error: ' . $e->getMessage()]);
}
