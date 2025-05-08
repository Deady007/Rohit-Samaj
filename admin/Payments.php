<?php
include 'includes/admin_header.php';
$result = $conn->query("SELECT id, name, email, payment_id, payment_status, created_at FROM businesses WHERE payment_status = 'paid'");
?>

<div class="p-6">
  <h2 class="text-xl font-bold mb-4">Payment History</h2>
  <table class="w-full border">
    <thead class="bg-gray-100">
      <tr><th>Business</th><th>Email</th><th>Payment ID</th><th>Date</th></tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr class="border-t">
          <td><?= $row['name'] ?></td>
          <td><?= $row['email'] ?></td>
          <td><?= $row['payment_id'] ?></td>
          <td><?= $row['created_at'] ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
