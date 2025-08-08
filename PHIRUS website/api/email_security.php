<?php
// /api/email_security.php
session_start();
header('Content-Type: application/json');
require_once '../config/Database.php';

$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthenticated']);
    exit;
}

$payload = trim(file_get_contents('php://input'));
$data = json_decode($payload, true);

if (!$data || empty($data['domain'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON or missing domain']);
    exit;
}

try {
    $db   = new Database();
    $conn = $db->connect();

    $sql  = "INSERT INTO email_security_checks
                (user_id, domain,
                 spf_status, spf_mail_from, spf_authorized, spf_comment, spf_authorization,
                 dkim_status, dkim_domain, dkim_integrity, dkim_comment,
                 dmarc_status, dmarc_policy, dmarc_alignment, dmarc_comment)
             VALUES (?,?,?,?, ?,?,?, ?,?,?, ?,?,?,?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $userId,
        strtolower(trim($data['domain'])),   // domain

        // SPF (array keys may be absent, so use null coalescing)
        $data['spf']['status']        ?? null,
        $data['spf']['mail_from']     ?? null,
        $data['spf']['authorized']    ?? null,
        $data['spf']['comment']       ?? null,
        isset($data['spf']['authorization']) ? (int) $data['spf']['authorization'] : null,

        // DKIM
        $data['dkim']['status']           ?? null,
        $data['dkim']['signing_domain']   ?? null,
        $data['dkim']['header_integrity'] ?? null,
        $data['dkim']['comment']          ?? null,

        // DMARC
        $data['dmarc']['status']      ?? null,
        $data['dmarc']['policy']      ?? null,
        $data['dmarc']['alignment']   ?? null,
        $data['dmarc']['comment']     ?? null
    ]);

    echo json_encode([
        'message'  => 'Stored successfully',
        'check_id' => $conn->lastInsertId()
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
