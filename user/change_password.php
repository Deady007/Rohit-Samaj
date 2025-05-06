<?php
session_start();
include '../configs/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Fetch the current password hash from the database
    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user || !password_verify($current_password, $user['password'])) {
        $_SESSION['error'] = 'Current password is incorrect.';
        header('Location: profile.php');
        exit();
    }

    // Check if new password matches confirmation
    if ($new_password !== $confirm_password) {
        $_SESSION['error'] = 'New password and confirmation do not match.';
        header('Location: profile.php');
        exit();
    }

    // Hash the new password and update it in the database
    $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->bind_param("si", $new_password_hash, $user_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = 'Password updated successfully.';
    } else {
        $_SESSION['error'] = 'Failed to update password. Please try again.';
    }

    header('Location: profile.php');
    exit();
}
?>