<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit();
}
?>
<h1>Welcome, Admin!</h1>
<?php include 'includes/admin_header.php'; ?>
<div class="p-6">
  <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>
  <ul class="space-y-2">
    <li><a href="businesses.php" class="text-blue-600 underline">Manage Business Listings</a></li>
    <li><a href="categories.php" class="text-blue-600 underline">Manage Categories</a></li>
    <li><a href="payments.php" class="text-blue-600 underline">View Payment History</a></li>
  </ul>
</div>

<a href="../pages/logout.php">Logout</a>