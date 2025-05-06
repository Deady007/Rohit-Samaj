<?php 
include '../../includes/auth.php'; 
include '../../configs/db.php';

$stmt = $conn->prepare("SELECT * FROM business_cards WHERE user_id = ?");
$stmt->bind_param("i", $_SESSION['user_id']); // Bind the user_id as an integer
$stmt->execute();
$result = $stmt->get_result(); // Get the result set
$cards = $result->fetch_all(MYSQLI_ASSOC); // Fetch all rows as an associative array
?>
<!-- Tailwind CSS and Alpine.js CDN -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
<script src="https://unpkg.com/phosphor-icons"></script>

<div class="flex h-screen bg-gray-100" x-data="{ showModal: false }">
    <!-- Sidebar -->
    <?php include '../../includes/sidebar.php'; ?>

    <!-- Main content -->
    <div class="flex-1 p-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">My Business Cards</h1>
     
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php foreach ($cards as $card): ?>
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-2xl transition duration-300 transform hover:scale-105">
                    <!-- Card Header -->
                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-6 relative">
                        <img src="<?= htmlspecialchars($card['business_logo']) ?>" alt="Logo" class="w-24 h-24 rounded-full mx-auto border-4 border-white shadow-md">
                        <div class="absolute top-4 right-4 bg-white text-blue-500 px-3 py-1 rounded-full text-xs font-semibold shadow">
                            <?= htmlspecialchars($card['business_type']) ?>
                        </div>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-center text-gray-800"><?= htmlspecialchars($card['business_name']) ?></h3>
                        <p class="text-sm text-gray-500 text-center mb-4 italic">"<?= htmlspecialchars($card['tagline'] ?? 'Your trusted partner') ?>"</p>
                        
                        <div class="text-sm text-gray-600 space-y-3">
                            <p class="flex items-center"><i class="ph ph-user-circle text-blue-500 mr-2"></i> <strong>Owner:</strong> <?= htmlspecialchars($card['owner_name']) ?></p>
                            <p class="flex items-center"><i class="ph ph-phone text-green-500 mr-2"></i> <strong>Phone:</strong> <?= htmlspecialchars($card['owner_phone']) ?></p>
                            <p class="flex items-center"><i class="ph ph-envelope text-red-500 mr-2"></i> <strong>Email:</strong> <?= htmlspecialchars($card['email']) ?></p>
                            <p class="flex items-center"><i class="ph ph-map-pin text-yellow-500 mr-2"></i> <strong>Location:</strong> <?= htmlspecialchars($card['city'] . ', ' . $card['state']) ?></p>
                        </div>
                    </div>
                    
                    <!-- Card Footer -->
                    <div class="p-4 bg-gray-100 border-t border-gray-200 flex justify-between items-center">
                        <a href="edit.php?id=<?= $card['id'] ?>" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition duration-300 flex items-center">
                            <i class="ph ph-pencil mr-2"></i> Edit
                        </a>
                        <button @click="showModal = true" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300 flex items-center">
                            <i class="ph ph-eye mr-2"></i> Preview
                        </button>
                        <a href="delete.php?id=<?= $card['id'] ?>" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-300 flex items-center">
                            <i class="ph ph-trash mr-2"></i> Delete
                        </a>
                    </div>
                </div>

                <!-- Modal -->
                <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" x-cloak>
                    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
                        <div class="flex justify-between items-center mb-4">
                            <h5 class="text-xl font-semibold text-gray-800">Business Card Preview</h5>
                            <button @click="showModal = false" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
                        </div>
                        <img src="<?= htmlspecialchars($card['business_logo']) ?>" alt="Logo" class="w-20 h-20 rounded-full mx-auto mb-4">
                        <h3 class="text-lg font-semibold text-center text-gray-800"><?= htmlspecialchars($card['business_name']) ?></h3>
                        <p class="text-sm text-gray-500 text-center mb-4"><?= htmlspecialchars($card['business_type']) ?></p>
                        <div class="text-sm text-gray-600 space-y-2">
                            <p><strong>Owner:</strong> <?= htmlspecialchars($card['owner_name']) ?></p>
                            <p><strong>Phone:</strong> <?= htmlspecialchars($card['owner_phone']) ?></p>
                            <p><strong>Email:</strong> <?= htmlspecialchars($card['email']) ?></p>
                            <p><strong>Address:</strong> <?= htmlspecialchars($card['address']) ?></p>
                            <p><strong>Pincode:</strong> <?= htmlspecialchars($card['pincode']) ?></p>
                            <p><strong>City:</strong> <?= htmlspecialchars($card['city']) ?></p>
                            <p><strong>State:</strong> <?= htmlspecialchars($card['state']) ?></p>
                            <p><strong>Country:</strong> <?= htmlspecialchars($card['country']) ?></p>
                        </div>
                        <button @click="showModal = false" class="mt-6 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 w-full transition duration-300">Close</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
