<?php
session_start();
header('Content-Type: application/json');
require_once '../config/Database.php';

// ✅ Ensure user is logged in
$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// ✅ Get JSON payload
$payload = trim(file_get_contents('php://input'));
$data = json_decode($payload, true);
if (!$data) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
    exit;
}

// ✅ Get raw string values (no datetime conversion)
$creation_date   = $data['creation_date']   ?? '';
$expiration_date = $data['expiration_date'] ?? '';
$updated_date    = $data['updated_date']    ?? '';

// ✅ Create DB connection
try {
    $database = new Database();
    $conn = $database->connect();

    $sql = 'INSERT INTO whois_results (
                domain_name, status, registrar, creation_date,
                expiration_date, update_date, name_servers, user_id
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        strtolower($data['domain_name']  ?? ''),
        is_array($data['status'])        ? implode(', ', $data['status']) : ($data['status'] ?? ''),
        $data['registrar']               ?? '',
        $creation_date,
        $expiration_date,
        $updated_date,
        is_array($data['name_servers'])  ? implode(', ', $data['name_servers']) : ($data['name_servers'] ?? ''),
        $userId
    ]);

    echo json_encode(['message' => 'WHOIS result stored as text successfully']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
