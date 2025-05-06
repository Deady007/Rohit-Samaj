<?php
include '../includes/auth.php'; // Ensure this is included at the top
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RohitSamaj.com | Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .blob-shape {
            position: absolute;
            top: 10%;
            left: 5%;
            width: 200px;
            height: 200px;
            background: #38bdf8;
            border-radius: 50%;
            filter: blur(100px);
            z-index: -1;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-900 via-black to-gray-800 text-white">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-gray-900 shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-cyan-400">RohitSamaj.com</h1>
            <button id="menu-toggle" class="text-cyan-400 md:hidden">
                <span class="material-icons">menu</span>
            </button>
            <div id="menu" class="hidden md:flex gap-6 items-center">
                <a href="profile.php" class="hover:text-cyan-400 flex items-center gap-1"><span class="material-icons">person</span>My Profile</a>
                <a href="cards/dashboard.php" class="hover:text-cyan-400 flex items-center gap-1"><span class="material-icons">business_center</span>My Business</a>
                <a href="cards/dashboard.php" class="hover:text-cyan-400 flex items-center gap-1"><span class="material-icons">group</span>Community</a>
                <a href="#contact" class="hover:text-cyan-400 flex items-center gap-1"><span class="material-icons">contact_mail</span>Contact</a>
            </div>
        </div>
        <div id="mobile-menu" class="md:hidden hidden bg-gray-800 px-6 py-4">
            <a href="profile.php" class="block py-2 hover:text-cyan-400 flex items-center gap-1"><span class="material-icons">person</span>My Profile</a>
            <a href="cards/dashboard.php" class="block py-2 hover:text-cyan-400 flex items-center gap-1"><span class="material-icons">business_center</span>My Business</a>
            <a href="cards/dashboard.php" class="block py-2 hover:text-cyan-400 flex items-center gap-1"><span class="material-icons">group</span>Community</a>
            <a href="#contact" class="block py-2 hover:text-cyan-400 flex items-center gap-1"><span class="material-icons">contact_mail</span>Contact</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-28 pb-16 px-6 container mx-auto flex flex-col md:flex-row items-center gap-10 relative">
        <div class="blob-shape"></div>
        <div class="md:w-1/2 text-center md:text-left">
            <h2 class="text-4xl font-bold mb-4">Welcome to <span class="text-cyan-400">RohitSamaj.com</span></h2>
            <p class="text-gray-300 mb-6">Manage your profile, create business cards, and connect with the local community in one place.</p>
            <div class="flex flex-col md:flex-row gap-4 justify-center md:justify-start">
                <a href="cards/add.php" class="bg-cyan-500 hover:bg-cyan-400 px-6 py-2 rounded text-black font-semibold transition-all">Create Business Card</a>
                <a href="cards/list.php" class="border border-cyan-500 px-6 py-2 rounded text-cyan-400 hover:bg-cyan-500 hover:text-black font-semibold transition-all">Explore Community</a>
            </div>
        </div>
    </section>

    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const menu = document.getElementById('menu');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

    <!-- Features Section -->
    <section class="py-16 bg-gray-900 px-6" id="features">
        <div class="container mx-auto text-center">
            <h3 class="text-3xl font-bold mb-10">Features</h3>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-800 p-6 rounded-lg shadow-xl hover:scale-105 transition-all">
                    <span class="material-icons text-cyan-400 text-4xl mb-4">badge</span>
                    <h4 class="font-semibold text-xl mb-2">Profile Management</h4>
                    <p class="text-gray-400">Easily update your name, email, phone number and profile picture.</p>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg shadow-xl hover:scale-105 transition-all">
                    <span class="material-icons text-cyan-400 text-4xl mb-4">credit_card</span>
                    <h4 class="font-semibold text-xl mb-2">Business Cards</h4>
                    <p class="text-gray-400">Create and manage your own professional business cards.</p>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg shadow-xl hover:scale-105 transition-all">
                    <span class="material-icons text-cyan-400 text-4xl mb-4">group</span>
                    <h4 class="font-semibold text-xl mb-2">Community</h4>
                    <p class="text-gray-400">Join the network of business owners and explore other profiles.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Top Business Section -->
    <?php
    // Include database connection
    include_once '../configs/db.php';

    // Fetch top businesses from the database
    $query = "
    SELECT 
        business_cards.business_name,
        business_cards.owner_name,
        business_cards.business_type,
        business_cards.address,
        business_cards.city,
        business_cards.state,
        business_cards.country,
        business_cards.pincode,
        business_cards.business_logo,
        users.name AS user_name,
        users.phone AS user_phone,
        users.email AS user_email
    FROM business_cards
    JOIN users ON business_cards.user_id = users.id
    ORDER BY business_cards.id DESC
    LIMIT 6
";
    $result = mysqli_query($conn, $query);
    ?>

<section class="py-16 px-6 container mx-auto" id="business">
    <h3 class="text-4xl font-bold mb-12 text-center ">Top Businesses</h3>
    <div class="grid md:grid-cols-3 gap-10">
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300">
                <div class="flex items-center mb-4">
                    <!-- Logo -->
                    <?php if (!empty($row['business_logo'])) : ?>
                        <img src="<?= htmlspecialchars($row['business_logo']) ?>" alt="Business Logo"
                            class="w-20 h-20 object-cover rounded-full border-4 border-gray-200 shadow-sm mr-6">
                    <?php else : ?>
                        <div class="w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center mr-6 text-gray-600">
                            No Logo
                        </div>
                    <?php endif; ?>

                    <!-- Business Info -->
                    <div>
                        <h4 class="text-xl font-semibold text-blue-600"><?= htmlspecialchars($row['business_name']) ?></h4>
                        <p class="text-gray-700 text-sm">Created by: <?= htmlspecialchars($row['user_name']) ?></p>
                        <span class="text-xs inline-block bg-blue-100 text-blue-700 px-2 py-1 mt-1 rounded-full">
                            <?= htmlspecialchars($row['business_type']) ?>
                        </span>
                    </div>
                </div>

                <!-- Additional Info -->
                <div class="text-sm space-y-3 pl-1">
                    <div class="flex items-center gap-2">
                        <!-- Owner Name Icon -->
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 14c4.418 0 8-3.582 8-8S16.418 0 12 0 4 3.582 4 8s3.582 8 8 8z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 14c-4.418 0-8 3.582-8 8v2h16v-2c0-4.418-3.582-8-8-8z" />
                        </svg>
                        <span class="text-gray-600"><?= htmlspecialchars($row['owner_name']) ?></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <!-- Email Icon -->
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z" />
                        </svg>
                        <span class="text-gray-600"><?= htmlspecialchars($row['user_email']) ?></span>
                    </div>

                    <div class="flex items-center gap-2">
                        <!-- Phone Icon -->
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 5a2 2 0 012-2h2a2 2 0 012 2v.1a1 1 0 01-.293.707l-1.414 1.414a1 1 0 000 1.414l4.95 4.95a1 1 0 001.414 0l1.414-1.414A1 1 0 0116.9 13H17a2 2 0 012 2v2a2 2 0 01-2 2h-.1a19.91 19.91 0 01-13.8-5.9A19.91 19.91 0 013 5.1V5z" />
                        </svg>
                        <span class="text-gray-600"><?= htmlspecialchars($row['user_phone']) ?></span>
                    </div>

                    <div class="flex items-start gap-2">
                        <!-- Location Icon -->
                        <svg class="w-5 h-5 text-blue-600 mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4.5 8-11a8 8 0 10-16 0c0 6.5 8 11 8 11z" />
                        </svg>
                        <span class="text-gray-600">
                            <?= htmlspecialchars($row['address']) ?>, 
                            <?= htmlspecialchars($row['city']) ?>, 
                            <?= htmlspecialchars($row['state']) ?>, 
                            <?= htmlspecialchars($row['country']) ?> - 
                            <?= htmlspecialchars($row['pincode']) ?>
                        </span>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>
    <!-- About Section -->
    <section class="py-16 bg-gray-900 px-6">
        <div class="container mx-auto text-center">
            <h3 class="text-3xl font-bold mb-4">About RohitSamaj.com</h3>
            <p class="text-gray-400 max-w-2xl mx-auto">RohitSamaj.com is a platform to help users from our Samaj build their presence online, showcase their business, and connect with other members.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-16 px-6 container mx-auto" id="contact">
        <h3 class="text-3xl font-bold mb-8 text-center">Contact Us</h3>
        <form class="bg-gray-800 p-6 rounded-lg max-w-xl mx-auto shadow-xl">
            <div class="mb-4">
                <label class="block mb-1 text-gray-300">Your Name</label>
                <input type="text" class="w-full p-3 bg-gray-700 text-white rounded">
            </div>
            <div class="mb-4">
                <label class="block mb-1 text-gray-300">Email</label>
                <input type="email" class="w-full p-3 bg-gray-700 text-white rounded">
            </div>
            <div class="mb-4">
                <label class="block mb-1 text-gray-300">Message</label>
                <textarea class="w-full p-3 bg-gray-700 text-white rounded h-32"></textarea>
            </div>
            <button type="submit" class="bg-cyan-500 hover:bg-cyan-400 text-black font-semibold px-6 py-2 rounded">Send Message</button>
        </form>
    </section>

    <!-- Footer -->
    <footer class="text-center text-sm py-6 border-t border-gray-700 mt-10 text-gray-400">
        &copy; <?= date('Y') ?> RohitSamaj.com. All rights reserved.
    </footer>
</body>

</html>
