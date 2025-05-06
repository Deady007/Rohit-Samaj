<?php include '../../includes/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Business Card</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="bg-gray-100">

<div class="flex h-screen">
    <!-- Sidebar -->
    <?php include '../../includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Header -->
        <header class="bg-white shadow px-6 py-4 sticky top-0 z-10">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="ph ph-plus"></i> Add Business Card
            </h2>
        </header>

        <!-- Form Section -->
        <main class="p-6">
            <form method="POST" action="add_process.php" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow max-w-4xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="owner_name" class="block text-sm font-medium text-gray-700">Owner Name</label>
                        <input type="text" id="owner_name" name="owner_name" class="w-full border border-gray-300 rounded-md p-2" placeholder="Enter owner's name" required>
                    </div>

                    <div>
                        <label for="owner_phone" class="block text-sm font-medium text-gray-700">Phone</label>
                        <input type="text" id="owner_phone" name="owner_phone" class="w-full border border-gray-300 rounded-md p-2" placeholder="Enter phone number" required>
                    </div>

                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <textarea id="address" name="address" class="w-full border border-gray-300 rounded-md p-2" placeholder="Enter address"></textarea>
                    </div>

                    <div>
                        <label for="pincode" class="block text-sm font-medium text-gray-700">Pincode</label>
                        <input type="text" id="pincode" name="pincode" class="w-full border border-gray-300 rounded-md p-2" placeholder="Enter pincode" required>
                    </div>

                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text" id="city" name="city" class="w-full border border-gray-300 rounded-md p-2" placeholder="Enter city" required>
                    </div>

                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                        <input type="text" id="state" name="state" class="w-full border border-gray-300 rounded-md p-2" placeholder="Enter state" required>
                    </div>

                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                        <input type="text" id="country" name="country" class="w-full border border-gray-300 rounded-md p-2" placeholder="Enter country" required>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Business Email</label>
                        <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-md p-2" placeholder="Enter business email" required>
                    </div>

                    <div>
                        <label for="business_name" class="block text-sm font-medium text-gray-700">Business Name</label>
                        <input type="text" id="business_name" name="business_name" class="w-full border border-gray-300 rounded-md p-2" placeholder="Enter business name" required>
                    </div>

                    <div>
                        <label for="business_type" class="block text-sm font-medium text-gray-700">Business Type</label>
                        <select id="business_type" name="business_type" class="w-full border border-gray-300 rounded-md p-2">
                            <option value="Retail">Retail</option>
                            <option value="Food">Food</option>
                            <option value="Services">Services</option>
                        </select>
                    </div>

                    <div>
                        <label for="business_logo" class="block text-sm font-medium text-gray-700">Business Logo</label>
                        <input type="file" id="business_logo" name="business_logo" class="w-full border border-gray-300 rounded-md p-2" accept="image/*" required>
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                        <i class="ph ph-check"></i> Save Business Card
                    </button>
                </div>
            </form>
        </main>
    </div>
</div>

</body>
</html>