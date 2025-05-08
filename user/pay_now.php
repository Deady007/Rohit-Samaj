<?php
require '../vendor/autoload.php';
include '../configs/db.php';

use Razorpay\Api\Api;

$api = new Api('rzp_test_g8BTePa0YVN72s', 'NwGLo5yJwkv1dyK4Xrgi0tr7');

$amount = 100; // ₹100.00 in paise
$orderData = [
    'receipt'         => 'biz_rcptid_' . rand(1000, 9999),
    'amount'          => $amount,
    'currency'        => 'INR',
    'payment_capture' => 1
];

$razorpayOrder = $api->order->create($orderData);
$orderId = $razorpayOrder['id'];

session_start();
$_SESSION['razorpay_order_id'] = $orderId;

echo json_encode([
    'order_id' => $orderId,
    'amount' => $amount,
    'key' => 'rzp_test_g8BTePa0YVN72s'
]);