<?php 
include '../../includes/auth.php'; 
include '../../configs/db.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM business_cards WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $_SESSION['user_id']); // Bind id and user_id as integers
$stmt->execute();
$result = $stmt->get_result();
$card = $result->fetch_assoc();

if (!$card) {
    die("Card not found.");
}
?>

<div class="border p-4 m-4 bg-white rounded shadow w-full max-w-md mx-auto">
    <img src="<?= htmlspecialchars($card['business_logo']) ?>" alt="Logo" class="logo">
    <h2 class="text-2xl font-bold"><?= htmlspecialchars($card['business_name']) ?></h2>
    <p class="text-sm">Type: <?= htmlspecialchars($card['business_type']) ?></p>
    <p>Owner: <?= htmlspecialchars($card['owner_name']) ?></p>
    <p>Email: <?= htmlspecialchars($card['email']) ?></p>
    <p>Phone: <?= htmlspecialchars($card['owner_phone']) ?></p>
    <p><strong>Address:</strong> <?= htmlspecialchars($card['address']) ?></p>
    <p><strong>Pincode:</strong> <?= htmlspecialchars($card['pincode']) ?></p>
    <p><strong>City:</strong> <?= htmlspecialchars($card['city']) ?></p>
    <p><strong>State:</strong> <?= htmlspecialchars($card['state']) ?></p>
    <p><strong>Country:</strong> <?= htmlspecialchars($card['country']) ?></p>
</div>