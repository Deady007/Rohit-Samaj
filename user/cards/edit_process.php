<?php
include '../../includes/auth.php';
include '../../configs/db.php';

// Get the form data
$business_id = $_POST['id'] ?? null;
$owner_name = $_POST['owner_name'] ?? '';
$owner_phone = $_POST['owner_phone'] ?? '';
$address = $_POST['address'] ?? '';
$pincode = $_POST['pincode'] ?? '';
$city = $_POST['city'] ?? '';
$state = $_POST['state'] ?? '';
$country = $_POST['country'] ?? '';
$email = $_POST['email'] ?? '';
$business_name = $_POST['business_name'] ?? '';
$business_type = $_POST['business_type'] ?? '';
$business_logo = null;

// Validate the business ID
if (!$business_id || !is_numeric($business_id)) {
    die("Invalid request. A valid Business ID is required.");
}

// Handle file upload if a new logo is provided
if (!empty($_FILES['business_logo']['name'])) {
    $upload_dir = "/uploads/"; // Web path, from root
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . $upload_dir;

    // Ensure the uploads directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Create the directory with permissions
    }

    $filename = basename($_FILES["business_logo"]["name"]);
    $target_file = $target_dir . $filename;

    // Move the uploaded file
    if (move_uploaded_file($_FILES["business_logo"]["tmp_name"], $target_file)) {
        $business_logo = $upload_dir . $filename; // Store web path
    } else {
        die("Failed to upload the business logo.");
    }
}

// Prepare the SQL query to update the business card
if ($business_logo) {
    $stmt = $conn->prepare("UPDATE business_cards SET owner_name = ?, owner_phone = ?, address = ?, pincode = ?, city = ?, state = ?, country = ?, email = ?, business_name = ?, business_type = ?, business_logo = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ssssssssssssi", $owner_name, $owner_phone, $address, $pincode, $city, $state, $country, $email, $business_name, $business_type, $business_logo, $business_id, $_SESSION['user_id']);
} else {
    $stmt = $conn->prepare("UPDATE business_cards SET owner_name = ?, owner_phone = ?, address = ?, pincode = ?, city = ?, state = ?, country = ?, email = ?, business_name = ?, business_type = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ssssssssssii", $owner_name, $owner_phone, $address, $pincode, $city, $state, $country, $email, $business_name, $business_type, $business_id, $_SESSION['user_id']);
}

// Execute the query
if ($stmt->execute()) {
    header('Location: list.php?updated=1&name=' . urlencode($business_name));
    exit;
} else {
    die("Failed to update the business card.");
}
?>