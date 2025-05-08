<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rohit Samaj Community</title>
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- AOS (Animate on Scroll) -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  
  <style>
    body {
      background-color: #f8fafc;
      font-family: 'Arial', sans-serif;
    }
    .glass {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .neumorphic {
      box-shadow: 8px 8px 16px #d1d9e6, -8px -8px 16px #ffffff;
    }
    .neumorphic-btn {
      background: #e0e5ec;
      border-radius: 12px;
      box-shadow: 6px 6px 12px #b8bcc2, -6px -6px 12px #ffffff;
      padding: 10px 20px;
      font-weight: bold;
      color: #333;
      transition: all 0.3s ease;
    }
    .neumorphic-btn:hover {
      box-shadow: inset 6px 6px 12px #b8bcc2, inset -6px -6px 12px #ffffff;
    }
  </style>
</head>
<body class="font-sans text-slate-800">

  <!-- Navbar -->
  <header class="fixed top-0 left-0 w-full z-50 glass text-slate-800 px-8 py-4 flex justify-between items-center shadow-md rounded-b-xl">
    <h1 class="text-2xl font-bold text-pink-500">RohitSamaj</h1>
    <nav class="hidden md:flex space-x-6 font-medium">
      <a href="#about" class="hover:text-pink-500 transition">About</a>
      <a href="#features" class="hover:text-pink-500 transition">Features</a>
      <a href="#business" class="hover:text-pink-500 transition">Businesses</a>
      <a href="#contact" class="hover:text-pink-500 transition">Contact</a>
    </nav>
    <button onclick="toggleSidebar()" class="md:hidden neumorphic-btn">
      ☰
    </button>
  </header>

  <!-- Sidebar -->
  <div id="sidebar" class="fixed top-0 left-0 w-64 h-full bg-gray-100 transform -translate-x-full transition-transform">
    <div class="p-4">
      <h2 class="text-xl font-bold text-pink-500 mb-4">Sidebar Menu</h2>
      <ul class="space-y-2">
        <li><a href="#about" class="text-gray-600 hover:text-pink-500">About</a></li>
        <li><a href="#features" class="text-gray-600 hover:text-pink-500">Features</a></li>
        <li><a href="#business" class="text-gray-600 hover:text-pink-500">Businesses</a></li>
        <li><a href="#contact" class="text-gray-600 hover:text-pink-500">Contact</a></li>
      </ul>
    </div>
  </div>

  <!-- Hero Section -->
  <section id="hero" class="min-h-screen flex items-center justify-center text-center px-4 relative">
    <div class="absolute top-[-20%] right-[-20%] w-[60vw] h-[60vw] bg-gradient-to-tr from-pink-500 to-pink-300 rounded-full opacity-30 blur-3xl z-0"></div>
    <div class="relative z-10">
      <h1 class="text-5xl md:text-7xl font-extrabold mb-6 text-pink-500" data-aos="fade-up">
        Welcome to <span class="text-pink-400">RohitSamaj.com</span>
      </h1>
      <p class="text-xl md:text-2xl mb-6 max-w-2xl mx-auto text-gray-600" data-aos="fade-up" data-aos-delay="200">
        Empowering communities with innovation and visibility.
      </p>
      <a href="pages/login.php" class="neumorphic-btn" data-aos="zoom-in" data-aos-delay="400">
        Join Community
      </a>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="py-16 px-6 bg-white" data-aos="fade-up">
    <h2 class="text-4xl font-bold text-center mb-6 text-pink-500">About Rohit Samaj</h2>
    <p class="max-w-3xl mx-auto text-center text-gray-600">
      RohitSamaj.com is a platform designed to connect and empower community members by showcasing their businesses, talents, and services.
    </p>
  </section>

  <!-- Features Section -->
  <section id="features" class="py-16 px-6 bg-gray-50" data-aos="fade-up">
    <h2 class="text-4xl font-bold text-center mb-10 text-pink-500">Key Features</h2>
    <div class="grid md:grid-cols-3 gap-8 text-center">
      <div class="neumorphic p-6">
        <h3 class="text-xl font-semibold mb-2 text-pink-500">Business Directory</h3>
        <p class="text-gray-600">List your business and reach more people in the community.</p>
      </div>
      <div class="neumorphic p-6">
        <h3 class="text-xl font-semibold mb-2 text-pink-500">Interactive Profiles</h3>
        <p class="text-gray-600">Create detailed profiles for businesses and individuals.</p>
      </div>
      <div class="neumorphic p-6">
        <h3 class="text-xl font-semibold mb-2 text-pink-500">Mobile Friendly</h3>
        <p class="text-gray-600">Optimized for all devices for a seamless experience.</p>
      </div>
    </div>
  </section>

  <!-- Business Cards Showcase -->
  <?php
    include_once '../configs/db.php';
    $query = "
    SELECT 
        business_cards.business_name,
        business_cards.owner_name,
        business_cards.business_type,
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
    <h3 class="text-4xl font-bold mb-12 text-center text-pink-500">Top Businesses</h3>
    <div class="grid md:grid-cols-3 gap-10">
      <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <div class="neumorphic p-6">
          <div class="flex items-center mb-4">
            <?php if (!empty($row['business_logo'])) : ?>
              <img src="<?= htmlspecialchars($row['business_logo']) ?>" alt="Business Logo" class="w-20 h-20 object-cover rounded-full border-4 border-gray-200 shadow-sm mr-6">
            <?php else : ?>
              <div class="w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center mr-6 text-gray-600">No Logo</div>
            <?php endif; ?>
            <div>
              <h4 class="text-xl font-semibold text-pink-500"><?= htmlspecialchars($row['business_name']) ?></h4>
              <p class="text-gray-600 text-sm">Created by: <?= htmlspecialchars($row['user_name']) ?></p>
              <span class="text-xs inline-block bg-pink-100 text-pink-700 px-2 py-1 mt-1 rounded-full"><?= htmlspecialchars($row['business_type']) ?></span>
            </div>
          </div>
          <div class="text-sm space-y-3">
            <p class="text-gray-600"><?= htmlspecialchars($row['city']) ?>, <?= htmlspecialchars($row['state']) ?>, <?= htmlspecialchars($row['country']) ?> - <?= htmlspecialchars($row['pincode']) ?></p>
            <p class="text-gray-600">Contact: <?= htmlspecialchars($row['user_phone']) ?> | <?= htmlspecialchars($row['user_email']) ?></p>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="py-16 px-6 bg-gray-50" data-aos="fade-up">
    <h2 class="text-4xl font-bold text-center mb-8 text-pink-500">Contact Us</h2>
    <form class="max-w-xl mx-auto space-y-4">
      <input type="text" placeholder="Your Name" class="neumorphic-btn w-full" required />
      <input type="email" placeholder="Your Email" class="neumorphic-btn w-full" required />
      <textarea placeholder="Your Message" class="neumorphic-btn w-full h-32" required></textarea>
      <button type="submit" class="neumorphic-btn w-full">Send Message</button>
    </form>
  </section>

  <!-- Footer -->
  <footer class="py-6 text-center text-sm text-gray-600">
    &copy; 2025 RohitSamaj.com. All rights reserved.
  </footer>

  <script>
    AOS.init();
    function toggleSidebar() {
      const sidebar = document.getElementById("sidebar");
      sidebar.classList.toggle("-translate-x-full");
    }
  </script>
</body>
</html>
