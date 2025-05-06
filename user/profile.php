<?php
include '../includes/auth.php';
include '../configs/db.php';

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, phone, profile_picture, bio FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "<p class='text-red-500 text-center mt-6'>User not found. Please contact support.</p>";
    exit();
}

// Display error or success messages
if (isset($_SESSION['error'])) {
    echo "<p class='text-red-500 text-center mt-6'>" . htmlspecialchars($_SESSION['error']) . "</p>";
    unset($_SESSION['error']);
}

if (isset($_SESSION['success'])) {
    echo "<p class='text-green-500 text-center mt-6'>" . htmlspecialchars($_SESSION['success']) . "</p>";
    unset($_SESSION['success']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->
</head>
<body class="bg-gray-100 min-h-screen font-sans">

<div class="flex h-screen" x-data="{ tab: 'profile' }">

    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg p-6 space-y-6">
        <div class="flex flex-col items-center">
            <?php if (!empty($user['profile_picture'])): ?>
                <img src="../uploads/<?= htmlspecialchars($user['profile_picture']) ?>" class="w-20 h-20 rounded-full object-cover mb-2" alt="Profile">
            <?php else: ?>
                <div class="w-20 h-20 rounded-full bg-gray-300 flex items-center justify-center text-2xl text-white mb-2">👤</div>
            <?php endif; ?>
            <h2 class="text-lg font-semibold"><?= htmlspecialchars($user['name']) ?></h2>
            <p class="text-sm text-gray-500"><?= htmlspecialchars($user['phone']) ?></p>
        </div>

        <nav class="space-y-2">
            <button @click="tab = 'profile'" class="w-full text-left px-4 py-2 rounded hover:bg-blue-100" :class="tab === 'profile' ? 'bg-blue-200 font-semibold' : ''">
                <i class="fas fa-user-edit"></i> Edit Profile
            </button>
           
            <button @click="tab = 'password'" class="w-full text-left px-4 py-2 rounded hover:bg-blue-100" :class="tab === 'password' ? 'bg-blue-200 font-semibold' : ''">
                <i class="fas fa-lock"></i> Change Password
            </button>
            <a href="../pages/logout.php" class="w-full text-left px-4 py-2 rounded hover:bg-blue-100 flex items-center">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form method="POST" action="delete_account.php" onsubmit="return confirm('Are you sure you want to delete your account?')" class="pt-4">
                <button type="submit" class="text-red-600 text-sm hover:underline">
                    <i class="fas fa-trash-alt"></i> Delete Account
                </button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-10 overflow-y-auto bg-gray-50">

        <!-- Edit Profile -->
        <div x-show="tab === 'profile'" x-transition>
            <h2 class="text-2xl font-bold mb-6">Edit Profile</h2>
            <form method="POST" action="update_profile.php" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-6 rounded-lg shadow">
                <div>
                    <label class="block text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Phone</label>
                    <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" pattern="\d{10}" class="w-full border rounded p-2" required>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-gray-700 mb-1">Profile Picture</label>
                    <input type="file" name="profile_picture" accept="image/*" class="w-full border p-2 rounded">
                </div>
                <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Your Bio</label>
                <textarea name="bio" rows="5" class="w-full border rounded p-3 resize-none"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
                </div>
                <div class="md:col-span-2 text-right">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
                </div>
            </form>
        </div>

        <!-- Change Password -->
        <div x-show="tab === 'password'" x-transition>
            <h2 class="text-2xl font-bold mb-6">Change Password</h2>
            <form method="POST" action="change_password.php" class="bg-white p-6 rounded-lg shadow space-y-4 max-w-lg">
                <div>
                    <label class="block text-gray-700">Current Password</label>
                    <input type="password" name="current_password" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block text-gray-700">New Password</label>
                    <input type="password" name="new_password" class="w-full border rounded p-2" required minlength="6">
                </div>
                <div>
                    <label class="block text-gray-700">Confirm New Password</label>
                    <input type="password" name="confirm_password" class="w-full border rounded p-2" required minlength="6">
                </div>
                <div class="text-right">
                    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Change Password</button>
                </div>
            </form>
        </div>

    </div>
</div>

</body>
</html>
