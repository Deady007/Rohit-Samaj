<?php
include '../configs/db.php';

// Validate and sanitize input
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($id <= 0 || !in_array($action, ['approve', 'reject'])) {
    die("Invalid request");
}

// Determine status based on action
$status = $action === 'approve' ? 1 : 0;

// Prepare and execute the query
$stmt = $conn->prepare("UPDATE businesses SET is_approved = ? WHERE id = ?");
$stmt->bind_param("ii", $status, $id);

if ($stmt->execute()) {
    header("Location: businesses.php");
    exit;
} else {
    die("Error updating record: " . $conn->error);
}
