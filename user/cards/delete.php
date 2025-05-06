<?php
include '../../includes/auth.php';
include '../../configs/db.php';

// Get the business card ID from the query string
$business_id = $_GET['id'] ?? null;

if (!$business_id || !is_numeric($business_id)) {
    die("Invalid request. A valid Business ID is required.");
}

// Prepare the SQL statement to fetch the business card
$stmt = $conn->prepare("SELECT business_name FROM business_cards WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $business_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$business = $result->fetch_assoc();

if (!$business) {
    die("Business card not found or you do not have permission to delete it.");
}
?>

<div class="p-6">
    <h2>Are you sure you want to delete the business card for "<?php echo htmlspecialchars($business['business_name']); ?>"?</h2>
    <form method="POST" action="delete_process.php">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($business_id); ?>">
        <button type="submit" class="btn btn-danger">Yes, Delete</button>
        <a href="list.php" class="btn">Cancel</a>
    </form>
</div>