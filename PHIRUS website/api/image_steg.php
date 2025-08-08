<?php

session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../config/Database.php';   // adjust path if different

/* 1. Require login */
$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthenticated']);
    exit;
}

/* 2. Parse payload */
$data = json_decode(file_get_contents('php://input'), true);
if (!$data || !isset($data['filename'], $data['hidden'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON or missing fields']);
    exit;
}

$filename = basename($data['filename']);  // rudimentary sanitisation
$hidden   = (int) !!$data['hidden'];      // ensure 0/1
$message  = $data['message'] ?? null;

/* 3. Insert row */
try {
    $db   = new Database();
    $conn = $db->connect();

    $sql  = "INSERT INTO image_steg_checks
             (user_id, filename, hidden, extracted_message)
             VALUES (:uid, :file, :hid, :msg)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':uid'  => $userId,
        ':file' => $filename,
        ':hid'  => $hidden,
        ':msg'  => $message
    ]);

    echo json_encode([
        'message'  => 'Stored successfully',
        'check_id' => $conn->lastInsertId()
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
