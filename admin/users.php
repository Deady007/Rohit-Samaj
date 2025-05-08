<?php
include 'includes/admin_header.php';
$users = $conn->query("SELECT * FROM users ORDER BY created_at DESC");
?>

<div class="p-6">
  <h2 class="text-xl font-bold mb-4">User Management</h2>
  <table class="w-full table-auto border">
    <thead class="bg-gray-200">
      <tr>
        <th>Name</th><th>Email</th><th>Role</th><th>Status</th><th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($user = $users->fetch_assoc()): ?>
        <tr class="border-t">
          <td><?= $user['name'] ?></td>
          <td><?= $user['email'] ?></td>
          <td>
            <form method="POST" action="update_role.php" class="inline">
              <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
              <select name="role" onchange="this.form.submit()" class="border rounded px-1">
                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
              </select>
            </form>
          </td>
          <td>
            <form method="POST" action="toggle_status.php" class="inline">
              <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
              <button type="submit" name="toggle_status" class="text-sm text-blue-600 underline">
                <?= $user['status'] === 'active' ? '🟢 Active' : '🔴 Inactive' ?>
              </button>
            </form>
          </td>
          <td>
            <a href="delete_user.php?id=<?= $user['id'] ?>" onclick="return confirm('Delete user?')" class="text-red-600">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
