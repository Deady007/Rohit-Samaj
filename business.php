<?php
include 'configs/db.php';

// Get the business ID from the URL (e.g., business.php?id=1)
$business_id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($business_id) {
    // Fetch the business details from the database
    $query = "SELECT b.*, c.name AS category FROM businesses b
              JOIN categories c ON b.category_id = c.id
              WHERE b.id = $business_id AND b.is_approved = 1";
    
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $business = $result->fetch_assoc();
    } else {
        // Redirect or show an error if the business isn't found
        echo "Business not found or not approved.";
        exit;
    }
} else {
    // Redirect if no business ID is provided
    echo "No business selected.";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($business['name']) ?> - Business Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold"><?= htmlspecialchars($business['name']) ?></h1>
        <p class="text-sm text-gray-500"><?= htmlspecialchars($business['category']) ?> | <?= htmlspecialchars($business['city']) ?>, <?= htmlspecialchars($business['state']) ?></p>

        <?php if ($business['image']): ?>
            <img src="uploads/<?= $business['image'] ?>" class="h-72 w-full object-cover rounded mt-4 mb-6" alt="Business Image">
        <?php endif; ?>

        <div class="text-lg mt-4">
            <h2 class="text-2xl font-semibold">Description:</h2>
            <p class="mt-2"><?= nl2br(htmlspecialchars($business['description'])) ?></p>
        </div>

        <div class="mt-6">
            <h2 class="text-2xl font-semibold">Services Offered:</h2>
            <p><?= htmlspecialchars($business['services']) ?></p>
        </div>

        <div class="mt-6">
            <h2 class="text-2xl font-semibold">Contact Information:</h2>
            <p><strong>Phone:</strong> <?= htmlspecialchars($business['contact_number']) ?></p>
            <p><strong>Email:</strong> <a href="mailto:<?= htmlspecialchars($business['email']) ?>" class="text-blue-500"><?= htmlspecialchars($business['email']) ?></a></p>
        </div>

        <div class="mt-6">
            <h2 class="text-2xl font-semibold">Location:</h2>
            <p><strong>Address:</strong> <?= htmlspecialchars($business['address']) ?>, <?= htmlspecialchars($business['city']) ?>, <?= htmlspecialchars($business['state']) ?>, <?= htmlspecialchars($business['pincode']) ?></p>
        </div>

        <div class="mt-6">
            <a href="tel:<?= htmlspecialchars($business['contact_number']) ?>" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">Call Now</a>
        </div>
    </div>

</body>
</html>
