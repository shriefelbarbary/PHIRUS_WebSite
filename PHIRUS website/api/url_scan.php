<?php

session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../config/Database.php';   // ← adjust path if needed

$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthenticated']);
    exit;
}

$payload = trim(file_get_contents('php://input'));
$data    = json_decode($payload, true);

if (!$data || empty($data['url_info']) || !isset($data['prediction'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON payload']);
    exit;
}

// helper to pull nested stats safely
$stats = $data['virustotal_result']['data']['attributes']['last_analysis_stats'] ?? [];

try {
    $db   = new Database();
    $conn = $db->connect();

    $sql = "INSERT INTO url_scan_results
              (user_id, url, domain, path, query, scheme, port,
               prediction, harmless_count, malicious_count, suspicious_count, undetected_count)
            VALUES
              (:user_id, :url, :domain, :path, :query, :scheme, :port,
               :prediction, :harmless, :malicious, :suspicious, :undetected)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':user_id'    => $userId,
        ':url'        => $data['url_info']['FullURL']  ?? '',
        ':domain'     => $data['url_info']['Domain']   ?? '',
        ':path'       => $data['url_info']['Path']     ?? '',
        ':query'      => $data['url_info']['Query']    ?? '',
        ':scheme'     => $data['url_info']['Scheme']   ?? '',
        ':port'       => $data['url_info']['Port']     ?? null,

        ':prediction' => $data['prediction']           ?? 'unknown',
        ':harmless'   => $stats['harmless']   ?? 0,
        ':malicious'  => $stats['malicious']  ?? 0,
        ':suspicious' => $stats['suspicious'] ?? 0,
        ':undetected' => $stats['undetected'] ?? 0
    ]);

    echo json_encode([
        'message' => 'Stored successfully',
        'id'      => $conn->lastInsertId()
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
