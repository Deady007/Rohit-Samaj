<?php include '../configs/db.php'; 
include 'includes/admin_header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Categories</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <h1 class="text-2xl font-bold mb-4">Business Categories</h1>

    <!-- Add New Category Form -->
    <form action="process_category.php" method="POST" class="mb-6">
        <input type="text" name="name" placeholder="New Category" required
               class="p-2 border rounded w-64">
        <button type="submit" name="add"
                class="bg-blue-500 text-white px-4 py-2 rounded">Add</button>
    </form>

    <!-- Category Table -->
    <table class="w-full bg-white rounded shadow">
        <thead class="bg-gray-200 text-left">
            <tr>
                <th class="p-3">ID</th>
                <th class="p-3">Name</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM categories ORDER BY id DESC");
            while($row = $result->fetch_assoc()):
            ?>
            <tr class="border-t">
                <td class="p-3"><?= $row['id'] ?></td>
                <td class="p-3"><?= htmlspecialchars($row['name']) ?></td>
                <td class="p-3">
                    <form action="process_category.php" method="POST" class="inline">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button type="submit" name="delete" class="text-red-600">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
