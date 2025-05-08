<?php
include 'configs/db.php';

// Set the number of businesses per page
$businesses_per_page = 9;

// Get the current page number from the URL (default to 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the offset for the query
$offset = ($page - 1) * $businesses_per_page;

$categories = $conn->query("SELECT * FROM categories");
$selected_category = $_GET['category'] ?? '';
$search_city = $_GET['city'] ?? '';
$search_state = $_GET['state'] ?? '';
$search = $_GET['search'] ?? '';

$sql = "SELECT b.*, c.name AS category FROM businesses b 
        JOIN categories c ON b.category_id = c.id 
        WHERE b.is_approved = 1";

if ($selected_category) {
    $sql .= " AND b.category_id = " . intval($selected_category);
}
if (!empty($search_city)) {
    $sql .= " AND b.city LIKE '%" . $conn->real_escape_string($search_city) . "%'";
}
if (!empty($search_state)) {
    $sql .= " AND b.state LIKE '%" . $conn->real_escape_string($search_state) . "%'";
}
if (!empty($search)) {
    $sql .= " AND (b.name LIKE '%" . $conn->real_escape_string($search) . "%' 
                  OR b.description LIKE '%" . $conn->real_escape_string($search) . "%')";
}

// Apply the offset and limit to the query
$sql .= " ORDER BY b.created_at DESC LIMIT $businesses_per_page OFFSET $offset";

$approved = $conn->query($sql);

// Fetch the total number of businesses to calculate total pages
$total_query = "SELECT COUNT(*) AS total FROM businesses WHERE is_approved = 1";
$total_result = $conn->query($total_query);
$total_row = $total_result->fetch_assoc();
$total_businesses = $total_row['total'];

$total_pages = ceil($total_businesses / $businesses_per_page);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Browse Businesses - BizConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Neumorphism Styles */
        .neumorphic {
            background: #e0e5ec;
            box-shadow: 8px 8px 16px #b8b9be, -8px -8px 16px #ffffff;
            border-radius: 12px;
        }

        .neumorphic-inset {
            background: #e0e5ec;
            box-shadow: inset 8px 8px 16px #b8b9be, inset -8px -8px 16px #ffffff;
            border-radius: 12px;
        }

        .neumorphic-button {
            background: #e0e5ec;
            box-shadow: 4px 4px 8px #b8b9be, -4px -4px 8px #ffffff;
            border-radius: 8px;
            transition: all 0.2s ease-in-out;
        }

        .neumorphic-button:hover {
            box-shadow: inset 4px 4px 8px #b8b9be, inset -4px -4px 8px #ffffff;
        }

        body {
            background: #e0e5ec;
            color: #333;
        }
    </style>
</head>
<body class="text-gray-800">

    <!-- Navbar -->
    <nav class="neumorphic fixed top-0 left-0 w-full z-50 px-6 py-4 flex justify-between items-center shadow-md">
        <div class="text-2xl font-bold">BizConnect</div>
        <ul class="flex space-x-6">
            <li><a href="index.php" class="hover:text-indigo-500 transition">Home</a></li>
            <li><a href="#filter" class="hover:text-indigo-500 transition">Find</a></li>
            <li><a href="user/add_business.php" class="hover:text-indigo-500 transition">add Business</a></li>
        </ul>
    </nav>

    <!-- Filter Section -->
    <section class="py-16">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Find Businesses</h2>
            <form method="GET" class="neumorphic p-6 flex flex-wrap items-center space-y-4 sm:space-y-0 sm:space-x-4">
                <input type="text" name="search" placeholder="Search anything..." 
                       value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" 
                       class="neumorphic-inset w-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" />

                <select name="category" class="neumorphic-inset p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                    <option value="">All Categories</option>
                    <?php while ($cat = $categories->fetch_assoc()): ?>
                        <option value="<?= $cat['id'] ?>" <?= $selected_category == $cat['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['name']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <input type="text" name="city" placeholder="Search by City"
                       value="<?= htmlspecialchars($search_city) ?>"
                       class="neumorphic-inset p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" />

                <input type="text" name="state" placeholder="Search by State"
                       value="<?= htmlspecialchars($search_state) ?>"
                       class="neumorphic-inset p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" />

                <button type="submit" class="neumorphic-button py-3 px-6 text-gray-700 hover:text-blue-500 transition-all">
                    Search
                </button>
            </form>
        </div>
    </section>

    <!-- Business Listings Section -->
    <section class="max-w-6xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        <?php while ($b = $approved->fetch_assoc()): ?>
            <div class="neumorphic p-6 transition-transform transform hover:scale-105 hover:shadow-lg">
                <?php if ($b['image']): ?>
                    <img src="uploads/<?= $b['image'] ?>" class="h-48 w-full object-cover rounded mb-3" alt="Business Image">
                <?php endif; ?>
                <h3 class="text-xl font-semibold mb-2"><?= htmlspecialchars($b['name']) ?></h3>
                <p class="text-gray-600 mb-2"><?= htmlspecialchars($b['category']) ?> - <?= $b['city'] ?>, <?= $b['state'] ?> (<?= $b['pincode'] ?>)</p>
                <p class="text-gray-500 mb-4"><?= substr($b['description'], 0, 100) ?>...</p>
                <div class="flex justify-between items-center">
                    <a href="tel:<?= $b['contact_number'] ?>" class="text-blue-500 hover:text-blue-700 transition-all">Call Now</a>
                    <a href="mailto:<?= $b['email'] ?>" class="text-blue-500 hover:text-blue-700 transition-all">Email</a>
                </div>
            </div>
        <?php endwhile; ?>
    </section>

    <!-- Pagination -->
    <div class="flex justify-center mb-10">
        <div class="inline-flex items-center space-x-2">
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1 ?>&category=<?= $selected_category ?>&city=<?= $search_city ?>&state=<?= $search_state ?>"
                   class="neumorphic-button px-4 py-2 text-gray-700">Previous</a>
            <?php else: ?>
                <span class="neumorphic-button px-4 py-2 text-gray-400 cursor-not-allowed">Previous</span>
            <?php endif; ?>

            <?php if ($page < $total_pages): ?>
                <a href="?page=<?= $page + 1 ?>&category=<?= $selected_category ?>&city=<?= $search_city ?>&state=<?= $search_state ?>"
                   class="neumorphic-button px-4 py-2 text-gray-700">Next</a>
            <?php else: ?>
                <span class="neumorphic-button px-4 py-2 text-gray-400 cursor-not-allowed">Next</span>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="neumorphic text-center py-8">
        <p>&copy; 2025 BizConnect. All rights reserved.</p>
    </footer>
</body>
</html>
