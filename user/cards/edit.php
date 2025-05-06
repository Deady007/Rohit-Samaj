<?php
include '../../includes/auth.php';
include '../../configs/db.php';

// Get the business card ID from the query string
$business_id = $_GET['id'] ?? null;

if (!$business_id || !is_numeric($business_id)) {
    die("Invalid request. A valid Business ID is required.");
}

// Prepare the SQL statement
$stmt = $conn->prepare("SELECT * FROM business_cards WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $business_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$business = $result->fetch_assoc();

if (!$business) {
    die("Business card not found or you do not have permission to edit it.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Business Card</title>
    <script src="https://unpkg.com/phosphor-icons"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex h-screen">
    <!-- Sidebar -->
    <?php include '../../includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 p-6">
        
        <!-- Header -->
        <header class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold flex items-center gap-x-2"><i class="ph ph-pencil-simple"></i> Edit Business Card</h1>
            <a href="list.php" class="text-blue-600 hover:underline flex items-center gap-x-1"><i class="ph ph-arrow-left"></i> Back to List</a>
        </header>

        <!-- Edit Form -->
        <form method="POST" action="edit_process.php" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-6 space-y-6">
            <input type="hidden" name="id" value="<?= htmlspecialchars($business['id']) ?>">

            <!-- Progress Indicator -->
            <div class="relative w-full bg-gray-200 rounded-full h-2 mb-6">
                <div id="progress-bar" class="absolute top-0 left-0 h-2 bg-blue-600 rounded-full" style="width: 33%;"></div>
            </div>
            <div class="flex justify-between text-sm font-medium text-gray-600">
                <span>Step 1</span>
                <span>Step 2</span>
                <span>Step 3</span>
            </div>

            <!-- Step 1: Owner Information -->
            <div id="step-1" class="border rounded-lg overflow-hidden transition-all duration-300">
                <div class="w-full text-left bg-gray-100 p-4 font-semibold">
                    Step 1: Owner Information
                </div>
                <div class="p-4 space-y-4">
                    <div class="flex flex-col">
                        <label class="text-sm font-medium mb-1">Owner Name</label>
                        <input type="text" name="owner_name" class="border p-2 rounded focus:ring-2 focus:ring-blue-500" value="<?= htmlspecialchars($business['owner_name']) ?>" placeholder="Enter owner's full name" required>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm font-medium mb-1">Phone</label>
                        <input type="text" name="owner_phone" class="border p-2 rounded focus:ring-2 focus:ring-blue-500" value="<?= htmlspecialchars($business['owner_phone']) ?>" placeholder="Enter phone number" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700" onclick="nextStep(1)">
                            Next
                        </button>
                    </div>
                </div>
            </div>

            <!-- Step 2: Business Information -->
            <div id="step-2" class="border rounded-lg overflow-hidden transition-all duration-300 hidden">
                <div class="w-full text-left bg-gray-100 p-4 font-semibold">
                    Step 2: Business Information
                </div>
                <div class="p-4 space-y-4">
                    <div class="flex flex-col">
                        <label class="text-sm font-medium mb-1">Business Name</label>
                        <input type="text" name="business_name" class="border p-2 rounded focus:ring-2 focus:ring-blue-500" value="<?= htmlspecialchars($business['business_name']) ?>" placeholder="Enter business name" required>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm font-medium mb-1">Business Type</label>
                        <select name="business_type" class="border p-2 rounded focus:ring-2 focus:ring-blue-500">
                            <option value="Retail" <?= $business['business_type'] == 'Retail' ? 'selected' : '' ?>>Retail</option>
                            <option value="Food" <?= $business['business_type'] == 'Food' ? 'selected' : '' ?>>Food</option>
                            <option value="Services" <?= $business['business_type'] == 'Services' ? 'selected' : '' ?>>Services</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm font-medium mb-1">Business Logo</label>
                        <input type="file" name="business_logo" class="border p-2 rounded focus:ring-2 focus:ring-blue-500" accept="image/*">
                        <p class="text-xs text-gray-500 mt-1">Current: <img src="<?= htmlspecialchars($business['business_logo']) ?>" alt="Logo" class="mt-1 h-12 rounded shadow-md"></p>
                    </div>
                    <div class="flex justify-between">
                        <button type="button" class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700" onclick="prevStep(2)">
                            Previous
                        </button>
                        <button type="button" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700" onclick="nextStep(2)">
                            Next
                        </button>
                    </div>
                </div>
            </div>

            <!-- Step 3: Address Information -->
            <div id="step-3" class="border rounded-lg overflow-hidden transition-all duration-300 hidden">
                <div class="w-full text-left bg-gray-100 p-4 font-semibold">
                    Step 3: Address Information
                </div>
                <div class="p-4 space-y-4">
                    <div class="flex flex-col">
                        <label class="text-sm font-medium mb-1">Address</label>
                        <textarea name="address" class="border p-2 rounded focus:ring-2 focus:ring-blue-500" placeholder="Enter full address"><?= htmlspecialchars($business['address']) ?></textarea>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm font-medium mb-1">City</label>
                        <input type="text" name="city" class="border p-2 rounded focus:ring-2 focus:ring-blue-500" value="<?= htmlspecialchars($business['city']) ?>" placeholder="Enter city" required>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm font-medium mb-1">State</label>
                        <input type="text" name="state" class="border p-2 rounded focus:ring-2 focus:ring-blue-500" value="<?= htmlspecialchars($business['state']) ?>" placeholder="Enter state" required>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm font-medium mb-1">Country</label>
                        <input type="text" name="country" class="border p-2 rounded focus:ring-2 focus:ring-blue-500" value="<?= htmlspecialchars($business['country']) ?>" placeholder="Enter country" required>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm font-medium mb-1">Pincode</label>
                        <input type="text" name="pincode" class="border p-2 rounded focus:ring-2 focus:ring-blue-500" value="<?= htmlspecialchars($business['pincode']) ?>" placeholder="Enter pincode" required>
                    </div>
                    <div class="flex justify-between">
                        <button type="button" class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700" onclick="prevStep(3)">
                            Previous
                        </button>
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <script>
            let currentStep = 1;

            function nextStep(step) {
                document.getElementById(`step-${step}`).classList.add('hidden');
                document.getElementById(`step-${step + 1}`).classList.remove('hidden');
                updateProgressBar(step + 1);
            }

            function prevStep(step) {
                document.getElementById(`step-${step}`).classList.add('hidden');
                document.getElementById(`step-${step - 1}`).classList.remove('hidden');
                updateProgressBar(step - 1);
            }

            function updateProgressBar(step) {
                const progressBar = document.getElementById('progress-bar');
                const progress = (step / 3) * 100;
                progressBar.style.width = `${progress}%`;
            }
        </script>

    </div>
</div>

</body>
</html>
