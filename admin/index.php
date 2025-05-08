<?php include '../configs/db.php';
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit();
}
include 'includes/admin_header.php'; // Added admin header include
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Homepage</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-8 bg-gray-50">
    <h1 class="text-3xl font-bold mb-6">Find Services</h1>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <?php
        $categories = $conn->query("SELECT * FROM categories");
        while($cat = $categories->fetch_assoc()):
        ?>
        <div class="bg-white shadow rounded p-4 text-center hover:bg-blue-100">
            <p class="font-semibold"><?= htmlspecialchars($cat['name']) ?></p>
        </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
