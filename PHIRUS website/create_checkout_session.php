<?php
require 'vendor/autoload.php';

// Set your Stripe Secret Key here
\Stripe\Stripe::setApiKey('sk_test_51RUZFyHJXV6vX5SKNjyPtU5pL6bAzj78oVBAmBGfVtrkZfiSTNUv8eJADIJM9GvptsuwnfwfNdrkakuKTIentDfs00eCuKtOT5');

session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in.']);
    exit;
}

$userId = $_SESSION['user_id'];

header('Content-Type: application/json');

try {
    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'unit_amount' => 500,  // $6.00
                'product_data' => [
                    'name' => 'Pro Plan',
                ],
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://localhost/Graduation.Progect2/success.php?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => 'http://localhost/Graduation.Progect2/cancel.php',
        'metadata' => [
            'user_id' => $userId, // Save user ID here
        ],
    ]);

    echo json_encode(['id' => $checkout_session->id]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
