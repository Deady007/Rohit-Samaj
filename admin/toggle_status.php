<?php
include '../configs/db.php';
$user_id = $_POST['user_id'];

$user = $conn->query("SELECT status FROM users WHERE id = $user_id")->fetch_assoc();
$new_status = $user['status'] === 'active' ? 'inactive' : 'active';

$conn->query("UPDATE users SET status = '$new_status' WHERE id = $user_id");

header("Location: users.php");
exit;
