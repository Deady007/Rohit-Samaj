<?php
session_start();
include '../configs/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $address = $_POST['address'];
    $desc = $_POST['description'];
    $services = $_POST['services'];
    $contact = $_POST['contact_number'];
    $email = $_POST['email'];
    $payment_id = $_POST['payment_id'] ?? null;

    // Image upload
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    $target_dir = "../uploads/" . basename($image);
    move_uploaded_file($tmp, $target_dir);

    // Insert into DB
    $payment_status = $payment_id ? 'paid' : 'pending';
    $stmt = $conn->prepare("INSERT INTO businesses (user_id, category_id, name, state, city, pincode, address, description, services, contact_number, email, image, payment_id, payment_status)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissssssssssss", $user_id, $category_id, $name, $state, $city, $pincode, $address, $desc, $services, $contact, $email, $image, $payment_id, $payment_status);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Failed to submit.']);
    }
}
