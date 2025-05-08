<?php

include '../configs/db.php';

// 🔐 Optional: Check if admin is logged in
// Uncomment this if you implement admin login
// if (!isset($_SESSION['admin_logged_in'])) {
//     header("Location: login.php");
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel - BizHub</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
  <nav class="bg-blue-600 text-white p-4 flex justify-between">
    <div class="text-xl font-semibold">📊 BizHub Admin</div>
    <div class="space-x-4">
      <a href="index.php" class="hover:underline">Dashboard</a>
      <a href="businesses.php" class="hover:underline">Businesses</a>
      <a href="categories.php" class="hover:underline">Categories</a>
      <a href="payments.php" class="hover:underline">Payments</a>
      <!-- <a href="logout.php" class="hover:underline">Logout</a> -->
    </div>
  </nav>
