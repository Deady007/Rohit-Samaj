<?php 
include '../includes/auth.php'; 
include '../configs/db.php';

$user_id = $_SESSION['user_id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$bio = trim($_POST['bio'] ?? '');

// Handle profile picture upload
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['profile_picture']['tmp_name'];
    $file_name = basename($_FILES['profile_picture']['name']);
    $file_size = $_FILES['profile_picture']['size'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];

    // Validate file type and size
    if (!in_array($file_ext, $allowed_exts)) {
        die('Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.');
    }
    if ($file_size > 2 * 1024 * 1024) { // 2MB limit
        die('File size exceeds the 2MB limit.');
    }

    // Generate a unique file name and move the file
    $new_file_name = uniqid('profile_', true) . '.' . $file_ext;
    $upload_dir = '../uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    $upload_path = $upload_dir . $new_file_name;
    if (!move_uploaded_file($file_tmp, $upload_path)) {
        die('Failed to upload the file.');
    }

    // Update the profile picture in the database
    $stmt = $conn->prepare("UPDATE users SET name=?, phone=?, bio=?, profile_picture=? WHERE id=?");
    $stmt->bind_param("ssssi", $name, $phone, $bio, $new_file_name, $user_id);
} else {
    // Update without changing the profile picture
    $stmt = $conn->prepare("UPDATE users SET name=?, phone=?, bio=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $phone, $bio, $user_id);
}

$stmt->execute();
header('Location: profile.php?updated=1');
exit();
