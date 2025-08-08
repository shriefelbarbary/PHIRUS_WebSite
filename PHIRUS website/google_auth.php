<?php
require_once './helpers/jwt_helper.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$token = $data['token'] ?? '';

if (empty($token)) {
    echo json_encode(['success' => false, 'error' => 'No token provided']);
    exit;
}


$url = 'https://oauth2.googleapis.com/tokeninfo?id_token=' . $token;
$response = file_get_contents($url);
$userInfo = json_decode($response, true);

if (isset($userInfo['email'])) {
    
    $payload = [
        'username' => $userInfo['email'],
        'iat' => time(),
        'exp' => time() + 3600
    ];
    
    $appToken = JWTHandler::generateToken($payload);
    setcookie('token', $appToken, time() + 3600, '/');
    
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid Google token']);
}