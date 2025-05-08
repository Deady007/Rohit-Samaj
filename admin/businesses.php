<?php
include 'includes/admin_header.php';
$result = $conn->query("SELECT b.*, c.name as category FROM businesses b JOIN categories c ON b.category_id = c.id ORDER BY b.id DESC");
?>

<div class="p-6">
  <h2 class="text-xl font-bold mb-4">All Business Listings</h2>
  <table class="w-full table-auto border">
    <thead class="bg-gray-200">
      <tr>
        <th>Name</th><th>Category</th><th>Status</th><th>Payment</th><th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr class="border-t">
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td><?= htmlspecialchars($row['category']) ?></td>
          <td><?= $row['is_approved'] ? '✅ Approved' : '⏳ Pending' ?></td>
          <td><?= $row['payment_status'] == 'paid' ? '💰 Paid' : '❌ Not Paid' ?></td>
          <td class="space-x-2">
            <?php if (!$row['is_approved']): ?>
              <a href="approve_businesses.php?id=<?= $row['id'] ?>&action=approve" class="text-green-600">Approve</a>
              <a href="approve_businesses.php?id=<?= $row['id'] ?>&action=reject" class="text-red-600">Reject</a>
            <?php endif; ?>
            <a href="edit_business.php?id=<?= $row['id'] ?>" class="text-blue-600">Edit</a>
            <a href="delete_business.php?id=<?= $row['id'] ?>" class="text-red-600">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
