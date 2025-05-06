<?php 
include '../../includes/auth.php'; 
include '../../configs/db.php';

// Handle file upload
$upload_dir = "/uploads/"; // Web path, from root
$target_dir = $_SERVER['DOCUMENT_ROOT'] . $upload_dir;
$filename = basename($_FILES["business_logo"]["name"]);
$target_file = $target_dir . $filename;

// Move the uploaded file
move_uploaded_file($_FILES["business_logo"]["tmp_name"], $target_file);

// Store web path in DB
$web_path = $upload_dir . $filename;

// Insert into database
$stmt = $conn->prepare("INSERT INTO business_cards (user_id, owner_name, owner_phone, address, pincode, city, state, country, email, business_name, business_type, business_logo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([
    $_SESSION['user_id'],
    $_POST['owner_name'],
    $_POST['owner_phone'],
    $_POST['address'],
    $_POST['pincode'],
    $_POST['city'],
    $_POST['state'],
    $_POST['country'],
    $_POST['email'],
    $_POST['business_name'],
    $_POST['business_type'],
    $web_path
]);

header('Location: list.php?added=1&name=' . urlencode($_POST['business_name']));
