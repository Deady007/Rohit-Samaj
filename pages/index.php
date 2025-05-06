<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rohit Samaj Community</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <style>
    .blob-shape {
      position: absolute;
      top: 5%;
      right: 5%;
      width: 300px;
      height: 300px;
      background: linear-gradient(135deg, #d946ef, #9333ea);
      border-radius: 50%;
      filter: blur(120px);
      z-index: -1;
    }
    [x-cloak] {
      display: none !important;
    }
    .hidden-navbar {
      transform: translateY(-100%);
      transition: transform 0.3s ease-in-out;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-purple-900 via-indigo-900 to-gray-900 text-white relative overflow-x-hidden">
  <div class="blob-shape"></div>

  <!-- Navbar -->
  <header id="navbar" class="bg-gradient-to-r from-purple-800 to-indigo-800 shadow-md fixed top-0 left-0 w-full z-50 transition-transform duration-300">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-3xl font-extrabold text-pink-400">RohitSamaj</h1>
      <nav class="hidden md:flex space-x-8">
        <a href="#about" class="text-gray-200 hover:text-pink-400 transition duration-200">About</a>
        <a href="#features" class="text-gray-200 hover:text-pink-400 transition duration-200">Features</a>
        <a href="#business" class="text-gray-200 hover:text-pink-400 transition duration-200">Businesses</a>
        <a href="#contact" class="text-gray-200 hover:text-pink-400 transition duration-200">Contact</a>
      </nav>
      <button onclick="toggleSidebar()" class="md:hidden bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-400 transition duration-200">
        ☰
      </button>
    </div>
  </header>

  <!-- Sidebar -->
  <div id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-gradient-to-br from-purple-800 to-indigo-800 shadow-lg transform -translate-x-full transition-transform duration-300 z-50">
    <div class="p-4 border-b border-gray-700 text-xl font-semibold text-white">
      Menu
      <button onclick="toggleSidebar()" class="float-right text-gray-400 hover:text-white transition duration-200">
        ✖
      </button>
    </div>
    <nav class="p-4 space-y-4">
      <a href="#about" class="block text-gray-300 hover:text-pink-400 transition duration-200">About</a>
      <a href="#features" class="block text-gray-300 hover:text-pink-400 transition duration-200">Features</a>
      <a href="#business" class="block text-gray-300 hover:text-pink-400 transition duration-200">Businesses</a>
      <a href="#contact" class="block text-gray-300 hover:text-pink-400 transition duration-200">Contact</a>
    </nav>
  </div>

  <!-- Hero Section -->
  <section class="min-h-screen flex items-center justify-center text-center px-4 relative">
    <div>
      <h1 class="text-5xl md:text-7xl font-extrabold mb-6" data-aos="fade-up">
        Welcome to <span class="text-pink-400">RohitSamaj.com</span>
      </h1>
      <p class="text-xl md:text-2xl mb-6 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
        Empowering communities with innovation and visibility.
      </p>
      <a href="pages/login.php" class="bg-pink-500 hover:bg-pink-400 text-white font-semibold py-3 px-8 rounded-xl transition-all" data-aos="zoom-in" data-aos-delay="400">
        Join Community
      </a>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="py-16 px-6 bg-gray-800" data-aos="fade-up">
    <h2 class="text-4xl font-bold text-center mb-6 text-pink-400">About Rohit Samaj</h2>
    <p class="max-w-3xl mx-auto text-center text-gray-300">
      RohitSamaj.com is a platform designed to connect and empower community members by showcasing their businesses, talents, and services.
    </p>
  </section>

  <!-- Features Section -->
  <section id="features" class="py-16 px-6 bg-gradient-to-br from-purple-800 to-indigo-800" data-aos="fade-up">
    <h2 class="text-4xl font-bold text-center mb-10 text-pink-400">Key Features</h2>
    <div class="grid md:grid-cols-3 gap-8 text-center">
      <div class="bg-gray-900 p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold mb-2 text-pink-400">Business Directory</h3>
        <p class="text-gray-400">List your business and reach more people in the community.</p>
      </div>
      <div class="bg-gray-900 p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold mb-2 text-pink-400">Interactive Profiles</h3>
        <p class="text-gray-400">Create detailed profiles for businesses and individuals.</p>
      </div>
      <div class="bg-gray-900 p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold mb-2 text-pink-400">Mobile Friendly</h3>
        <p class="text-gray-400">Optimized for all devices for a seamless experience.</p>
      </div>
    </div>
  </section>

  <!-- Business Cards Showcase -->
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

<section id="business" class="py-16 px-6 container mx-auto" data-aos="fade-up">
    <h3 class="text-4xl font-bold mb-12 text-center text-pink-400">Top Businesses</h3>
    <div class="grid md:grid-cols-3 gap-10">
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <div class="bg-gray-900 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300">
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
                        <h4 class="text-xl font-semibold text-pink-400"><?= htmlspecialchars($row['business_name']) ?></h4>
                        <p class="text-gray-400 text-sm">Created by: <?= htmlspecialchars($row['user_name']) ?></p>
                        <span class="text-xs inline-block bg-pink-100 text-pink-700 px-2 py-1 mt-1 rounded-full">
                            <?= htmlspecialchars($row['business_type']) ?>
                        </span>
                    </div>
                </div>

                <!-- Additional Info -->
                <div class="text-sm space-y-3 pl-1">
                    <div class="flex items-center gap-2">
                        <!-- Owner Name Icon -->
                        <svg class="w-5 h-5 text-pink-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 14c4.418 0 8-3.582 8-8S16.418 0 12 0 4 3.582 4 8s3.582 8 8 8z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 14c-4.418 0-8 3.582-8 8v2h16v-2c0-4.418-3.582-8-8-8z" />
                        </svg>
                        <span class="text-gray-400"><?= htmlspecialchars($row['owner_name']) ?></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <!-- Email Icon -->
                        <svg class="w-5 h-5 text-pink-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z" />
                        </svg>
                        <span class="text-gray-400"><?= htmlspecialchars($row['user_email']) ?></span>
                    </div>

                    <div class="flex items-center gap-2">
                        <!-- Phone Icon -->
                        <svg class="w-5 h-5 text-pink-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 5a2 2 0 012-2h2a2 2 0 012 2v.1a1 1 0 01-.293.707l-1.414 1.414a1 1 0 000 1.414l4.95 4.95a1 1 0 001.414 0l1.414-1.414A1 1 0 0116.9 13H17a2 2 0 012 2v2a2 2 0 01-2 2h-.1a19.91 19.91 0 01-13.8-5.9A19.91 19.91 0 013 5.1V5z" />
                        </svg>
                        <span class="text-gray-400"><?= htmlspecialchars($row['user_phone']) ?></span>
                    </div>

                    <div class="flex items-start gap-2">
                        <!-- Location Icon -->
                        <svg class="w-5 h-5 text-pink-400 mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4.5 8-11a8 8 0 10-16 0c0 6.5 8 11 8 11z" />
                        </svg>
                        <span class="text-gray-400"> 
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

  <!-- Contact Section -->
  <section id="contact" class="py-16 px-6 bg-gray-800" data-aos="fade-up">
    <h2 class="text-4xl font-bold text-center mb-8 text-pink-400">Contact Us</h2>
    <form class="max-w-xl mx-auto bg-gray-900 p-6 rounded-xl space-y-4">
      <input type="text" placeholder="Your Name" class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white" required />
      <input type="email" placeholder="Your Email" class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white" required />
      <textarea placeholder="Your Message" class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white h-32" required></textarea>
      <button type="submit" class="w-full bg-pink-500 hover:bg-pink-400 py-2 rounded-lg text-white font-semibold">Send Message</button>
    </form>
  </section>

  <!-- Footer -->
  <footer class="py-6 text-center text-sm text-gray-400 bg-gradient-to-r from-purple-800 to-indigo-800">
    &copy; 2025 RohitSamaj.com. All rights reserved.
  </footer>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
    function toggleSidebar() {
      const sidebar = document.getElementById("sidebar");
      sidebar.classList.toggle("-translate-x-full");
    }

    // Hide Navbar on Scroll Down
    let lastScrollTop = 0;
    const navbar = document.getElementById("navbar");

    window.addEventListener("scroll", () => {
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      if (scrollTop > lastScrollTop) {
        // Scrolling down
        navbar.classList.add("hidden-navbar");
      } else {
        // Scrolling up
        navbar.classList.remove("hidden-navbar");
      }
      lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // For mobile or negative scrolling
    });
  </script>
</body>
</html>
