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
      top: 10%;
      left: 5%;
      width: 200px;
      height: 200px;
      background: #38bdf8;
      border-radius: 50%;
      filter: blur(100px);
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
<body class="bg-gradient-to-br from-gray-900 via-black to-gray-800 text-white relative overflow-x-hidden">
  <div class="blob-shape"></div>

  <!-- Navbar -->
  <header id="navbar" class="bg-gradient-to-br from-gray-800 via-gray-900 to-black shadow-md fixed top-0 left-0 w-full z-50 transition-transform duration-300">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-2xl font-bold text-cyan-400">RohitSamaj</h1>
      <nav class="hidden md:flex space-x-6">
        <a href="#about" class="text-gray-300 hover:text-cyan-400 transition duration-200">About</a>
        <a href="#features" class="text-gray-300 hover:text-cyan-400 transition duration-200">Features</a>
        <a href="#businesses" class="text-gray-300 hover:text-cyan-400 transition duration-200">Businesses</a>
        <a href="#contact" class="text-gray-300 hover:text-cyan-400 transition duration-200">Contact</a>
        <a href="../pages/logout.php" class="text-gray-300 hover:text-cyan-400 transition duration-200">Logout</a>
      </nav>
      <button onclick="toggleSidebar()" class="md:hidden bg-cyan-500 text-white px-4 py-2 rounded hover:bg-cyan-400 transition duration-200">
        ☰
      </button>
    </div>
  </header>

  <!-- Sidebar -->
  <div id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-gradient-to-br from-gray-800 via-gray-900 to-black shadow-lg transform -translate-x-full transition-transform duration-300 z-50">
    <div class="p-4 border-b border-gray-700 text-xl font-semibold text-white">
      Menu
      <button onclick="toggleSidebar()" class="float-right text-gray-400 hover:text-white transition duration-200">
        ✖
      </button>
    </div>
    <nav class="p-4 space-y-4">
      <a href="#about" class="block text-gray-300 hover:text-cyan-400 transition duration-200">About</a>
      <a href="#features" class="block text-gray-300 hover:text-cyan-400 transition duration-200">Features</a>
      <a href="#businesses" class="block text-gray-300 hover:text-cyan-400 transition duration-200">Businesses</a>
      <a href="#contact" class="block text-gray-300 hover:text-cyan-400 transition duration-200">Contact</a>
    </nav>
  </div>

  <!-- Page Content -->
  <div class="pt-20 px-6">
    <section class="min-h-screen flex items-center justify-center text-center px-4 relative">
      <div>
        <h1 class="text-4xl md:text-6xl font-bold mb-6" data-aos="fade-up">Welcome to <span class="text-cyan-400">RohitSamaj.com</span></h1>
        <p class="text-xl md:text-2xl mb-6 max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="200">Modernizing community visibility and business reach with style and innovation.</p>
        <a href="#explore" class="bg-cyan-500 hover:bg-cyan-400 text-white font-semibold py-2 px-6 rounded-xl transition-all" data-aos="zoom-in" data-aos-delay="400">Explore Now</a>
        <div class="mt-10" data-aos="fade-up" data-aos-delay="600">
          <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_puciaact.json" background="transparent" speed="1" style="width: 300px; height: 300px; margin: auto;" loop autoplay></lottie-player>
        </div>
      </div>
    </section>
  </div>

  <!-- About Section -->
  <section id="about" class="py-16 px-6" data-aos="fade-up">
    <h2 class="text-3xl font-bold text-center mb-6">About Rohit Samaj</h2>
    <p class="max-w-3xl mx-auto text-center text-gray-300">RohitSamaj.com is a modern digital platform designed to empower our community members by offering them a space to showcase their businesses, talents, and services. We aim to connect people and support growth through visibility and technology.</p>
  </section>

  <!-- Features Section -->
  <section id="features" class="py-16 px-6 bg-gray-900" data-aos="fade-up">
    <h2 class="text-3xl font-bold text-center mb-10">Key Features</h2>
    <div class="grid md:grid-cols-3 gap-8 text-center">
      <div class="bg-gray-800 p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold mb-2">Business Directory</h3>
        <p class="text-gray-400">Get your business listed and reach more people within the community.</p>
      </div>
      <div class="bg-gray-800 p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold mb-2">Interactive Profiles</h3>
        <p class="text-gray-400">Create your personal or business profile with all your contact and service details.</p>
      </div>
      <div class="bg-gray-800 p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold mb-2">Mobile Friendly</h3>
        <p class="text-gray-400">Optimized for all devices to give seamless experience to users.</p>
      </div>
    </div>
  </section>

  <!-- Business Cards Showcase -->
  <section id="explore" class="py-16 px-6" data-aos="fade-up">
    <h2 class="text-3xl font-bold text-center mb-12">Explore Community Businesses</h2>
    <div class="grid md:grid-cols-3 gap-8">
      <div class="bg-white text-black rounded-xl p-6 shadow-xl hover:scale-105 transition-all">
        <img src="https://source.unsplash.com/300x200/?business,office" class="rounded-md mb-4" alt="Business 1" />
        <h3 class="font-semibold text-xl">Anand Textiles</h3>
        <p>Providing premium quality garments since 1995.</p>
      </div>
      <div class="bg-white text-black rounded-xl p-6 shadow-xl hover:scale-105 transition-all">
        <img src="https://source.unsplash.com/300x200/?shop,people" class="rounded-md mb-4" alt="Business 2" />
        <h3 class="font-semibold text-xl">Suresh Kirana</h3>
        <p>Your trusted neighborhood grocery partner.</p>
      </div>
      <div class="bg-white text-black rounded-xl p-6 shadow-xl hover:scale-105 transition-all">
        <img src="https://source.unsplash.com/300x200/?startup,team" class="rounded-md mb-4" alt="Business 3" />
        <h3 class="font-semibold text-xl">Ravi IT Solutions</h3>
        <p>Affordable tech services and IT consulting.</p>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="py-16 px-6 bg-gray-900" data-aos="fade-up">
    <h2 class="text-3xl font-bold text-center mb-8">Contact Us</h2>
    <form class="max-w-xl mx-auto bg-gray-800 p-6 rounded-xl space-y-4">
      <input type="text" placeholder="Your Name" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white" required />
      <input type="email" placeholder="Your Email" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white" required />
      <textarea placeholder="Your Message" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white h-32" required></textarea>
      <button type="submit" class="w-full bg-cyan-500 hover:bg-cyan-400 py-2 rounded-lg text-white font-semibold">Send Message</button>
    </form>
  </section>

  <!-- Footer -->
  <footer class="py-6 text-center text-sm text-gray-400 border-t border-gray-700 mt-16">
    &copy; 2025 RohitSamaj.com. All rights reserved.
  </footer>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
  <script>
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
