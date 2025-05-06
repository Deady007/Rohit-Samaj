<?php
include '../../configs/db.php';

$search = $_GET['search'] ?? '';
$location = $_GET['location'] ?? '';
$types = isset($_GET['type']) ? (array)$_GET['type'] : [];

$query = "SELECT bc.*, u.name AS user_name, u.profile_picture 
          FROM business_cards bc
          JOIN users u ON bc.user_id = u.id
          WHERE 1=1";

if ($search) {
    $searchTerm = "%" . mysqli_real_escape_string($conn, $search) . "%";
    $query .= " AND (
        bc.business_name LIKE '$searchTerm' OR 
        bc.business_type LIKE '$searchTerm' OR 
        bc.owner_name LIKE '$searchTerm' OR 
        bc.owner_phone LIKE '$searchTerm' OR 
        bc.email LIKE '$searchTerm'
    )";
}
if ($location) {
    $locationTerm = "%" . mysqli_real_escape_string($conn, $location) . "%";
    $query .= " AND (
        bc.city LIKE '$locationTerm' OR 
        bc.state LIKE '$locationTerm' OR 
        bc.country LIKE '$locationTerm' OR 
        bc.pincode LIKE '$locationTerm' OR 
        bc.address LIKE '$locationTerm'
    )";
}
if (!empty($types)) {
    $escapedTypes = array_map(function ($type) use ($conn) {
        return "'" . mysqli_real_escape_string($conn, $type) . "'";
    }, $types);
    $query .= " AND bc.business_type IN (" . implode(',', $escapedTypes) . ")";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Business Cards | RohitSamaj</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function toggleNavbar() {
      const menu = document.getElementById('mobile-menu');
      menu.classList.toggle('hidden');
    }
    function toggleSidebar() {
      const sidebar = document.getElementById('filter-sidebar');
      sidebar.classList.toggle('hidden');
    }
  </script>
</head>
<body class="bg-gray-100 text-gray-800">

<!-- Navbar -->
<nav class="bg-white shadow-md sticky top-0 z-50 px-6 py-4">
  <div class="flex justify-between items-center">
    <!-- Logo -->
    <div class="text-2xl font-bold text-blue-700">RohitSamaj</div>

    <!-- Hamburger Icon -->
    <button 
      class="md:hidden text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-300" 
      onclick="toggleNavbar()">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>

    <!-- Desktop Menu -->
    <ul class="hidden md:flex space-x-6 text-gray-700 font-medium">
      <li><a href="/rohit/user/dashboard.php" class="hover:text-blue-600 transition">Home</a></li>
      <li><a href="/rohit/community.php" class="hover:text-blue-600 transition">Community</a></li>
      <li><a href="/rohit/user/cards/list.php" class="hover:text-blue-600 transition">My Business Cards</a></li>
      <li><a href="/rohit/user/cards/add.php" class="hover:text-blue-600 transition">Add New Card</a></li>
      <li><a href="/rohit/pages/logout.php" class="hover:text-blue-600 transition">Logout</a></li>
    </ul>
  </div>

  <!-- Mobile Menu -->
  <ul id="mobile-menu" class="hidden md:hidden flex flex-col space-y-4 mt-4 text-gray-700 font-medium">
    <li><a href="/rohit/user/dashboard.php" class="hover:text-blue-600 transition">Home</a></li>
    <li><a href="/rohit/community.php" class="hover:text-blue-600 transition">Community</a></li>
    <li><a href="/rohit/user/cards/list.php" class="hover:text-blue-600 transition">My Business Cards</a></li>
    <li><a href="/rohit/user/cards/add.php" class="hover:text-blue-600 transition">Add New Card</a></li>
    <li><a href="/rohit/user/pages/logout.php" class="hover:text-blue-600 transition">Logout</a></li>
  </ul>
</nav>

<!-- Search Bar -->
<div class="bg-white shadow-md p-6">
  <form method="GET" class="flex flex-wrap gap-4 items-center justify-center">
    <input 
      type="text" 
      name="search" 
      placeholder="Search business..." 
      value="<?= htmlspecialchars($search) ?>" 
      class="px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 w-full md:w-1/3" 
    />
    <input 
      type="text" 
      name="location" 
      placeholder="Location..." 
      value="<?= htmlspecialchars($location) ?>" 
      class="px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 w-full md:w-1/3" 
    />
    <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition w-full md:w-auto">Search</button>
  </form>
</div>

<!-- Main Layout -->
<div class="flex flex-col md:flex-row mt-6">
  
  <!-- Sidebar Toggle Button -->
  <button 
    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition md:hidden mb-4 mx-6" 
    onclick="toggleSidebar()">
    Toggle Filters
  </button>

  <!-- Filter Sidebar -->
  <aside id="filter-sidebar" class="w-full md:w-64 bg-white shadow-md rounded-lg p-6 hidden md:block">
    <h2 class="font-bold text-lg mb-4">Filters</h2>
    <form method="GET" class="space-y-6">
      <div>
        <label class="block mb-2 font-semibold">Business Type</label>
        <div class="grid grid-cols-1 gap-2 max-h-48 overflow-y-auto pr-2">
          <?php
          $typeQuery = "SELECT DISTINCT business_type FROM business_cards";
          $typeResult = mysqli_query($conn, $typeQuery);
          while ($typeRow = mysqli_fetch_assoc($typeResult)) {
              $businessType = htmlspecialchars($typeRow['business_type']);
              $checked = in_array($businessType, $types) ? 'checked' : '';
              echo "<label class='inline-flex items-center space-x-2'>
                      <input type='checkbox' name='type[]' value='$businessType' $checked class='accent-blue-600 rounded'>
                      <span>$businessType</span>
                    </label>";
          }
          ?>
        </div>
      </div>
      <button type="submit" class="bg-blue-600 text-white w-full py-2 rounded hover:bg-blue-700 transition">Apply</button>
    </form>
  </aside>

  <!-- Business Cards Grid -->
  <main class="flex-1 p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php while($row = mysqli_fetch_assoc($result)): ?>
      <div class="bg-white shadow-lg rounded-xl p-6 hover:shadow-2xl transform hover:scale-[1.02] transition duration-300 ease-in-out">
        <div class="flex items-center space-x-4 mb-4">
          <img src="<?= $row['business_logo'] ?>" alt="Logo" class="w-16 h-16 rounded-full object-cover ring-2 ring-blue-400">
          <div>
            <h3 class="text-xl font-semibold text-gray-800"><?= $row['business_name'] ?></h3>
            <p class="text-sm text-gray-500"><?= $row['business_type'] ?></p>
          </div>
        </div>
        <div class="text-sm space-y-1">
          <p><strong>Owner:</strong> <?= $row['owner_name'] ?> (<?= $row['owner_phone'] ?>)</p>
          <p><strong>Email:</strong> <?= $row['email'] ?></p>
          <p><strong>Location:</strong> <?= $row['city'] ?>, <?= $row['state'] ?>, <?= $row['country'] ?></p>
        </div>
      </div>
    <?php endwhile; ?>
  </main>
</div>

</body>
</html>