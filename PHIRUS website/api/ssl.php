<?php
session_start();
header('Content-Type: application/json');
require_once '../config/Database.php';

$userId = $_SESSION['user_id'] ?? null;

function convertToMySQLDatetime($dateString) {
    $timestamp = strtotime($dateString);
    if ($timestamp === false) {
        return null;
    }
    return date('Y-m-d H:i:s', $timestamp);
}


if (!$userId) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized: No session user_id']);
    exit;
}

$payload = trim(file_get_contents('php://input'));
$data = json_decode($payload, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
    exit;
}

try {
    $database = new Database();
    $conn = $database->connect();

    $sql = 'INSERT INTO ssl_checks
        (user_id, issued_to, issuer, valid_from, valid_to)
        VALUES (?, ?, ?, ?, ?)';

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $userId,
        $data['issued_to']   ?? '',
        $data['issuer']      ?? '',
        $validFrom = convertToMySQLDatetime($data['valid_from'] ?? ''),
    $validTo   = convertToMySQLDatetime($data['valid_to'] ?? '')
    ]);

    echo json_encode(['message' => 'Stored successfully']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
