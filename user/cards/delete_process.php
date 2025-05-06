<?php
include '../../includes/auth.php';
include '../../configs/db.php';

// Get the business card ID from the POST data
$business_id = $_POST['id'] ?? null;

if (!$business_id || !is_numeric($business_id)) {
    die("Invalid request. A valid Business ID is required.");
}

// Prepare the SQL statement to delete the business card
$stmt = $conn->prepare("DELETE FROM business_cards WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $business_id, $_SESSION['user_id']);

// Execute the query
if ($stmt->execute()) {
    header('Location: list.php?deleted=1');
    exit;
} else {
    die("Failed to delete the business card.");
}
?>