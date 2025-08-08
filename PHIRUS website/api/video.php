<?php
session_start();
header('Content-Type: application/json');
require_once '../config/Database.php';

// Allow only POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// Make sure user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// Get JSON body
$data = json_decode(file_get_contents('php://input'), true);

// Validate required fields
if (!isset($data['message'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing message']);
    exit;
}

// Prepare data
$user_id = $_SESSION['user_id'];
$filename = $data['filename'] ?? 'unknown.mp4';
$message = $data['message'];
$hidden = stripos($message, 'no hidden') !== false ? 0 : 1;

// Connect to DB
require_once '../config/Database.php'; // Adjust path if needed
$db = new Database();
$pdo = $db->connect();

// Insert record
try {
    $stmt = $pdo->prepare("
        INSERT INTO video_steg_checks (user_id, filename, hidden, message)
        VALUES (:user_id, :filename, :hidden, :message)
    ");
    $stmt->execute([
        ':user_id'  => $user_id,
        ':filename' => $filename,
        ':hidden'   => $hidden,
        ':message'  => $message
    ]);

    echo json_encode(['success' => true, 'message' => 'Result saved.']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error', 'details' => $e->getMessage()]);
}
