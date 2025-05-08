<?php
// Include the database connection
include 'configs/db.php';
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Business Connect</title>
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- AOS (Animate on Scroll) -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
  
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#6366F1',
            secondary: '#A855F7',
            glass: 'rgba(255,255,255,0.1)',
          },
          backdropBlur: {
            xs: '2px',
          }
        }
      }
    };
  </script>
  
  <style>
    body {
      background-color: #f8fafc;
    }
    .glass {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .neumorphic {
      box-shadow: 8px 8px 16px #d1d9e6,
                  -8px -8px 16px #ffffff;
    }
    .inset-neumorphic {
      box-shadow: inset 8px 8px 16px #d1d9e6,
                  inset -8px -8px 16px #ffffff;
    }
  </style>
</head>
<body class="font-sans text-slate-800">

  <!-- Navbar -->
  <header class="fixed top-0 left-0 w-full z-50 glass text-slate-800 px-8 py-4 flex justify-between items-center shadow-md rounded-b-xl">
    <h1 class="text-2xl font-bold">BizConnect</h1>
    <nav class="space-x-6 font-medium hidden md:block">
      <a href="#home" class="hover:text-primary transition">Home</a>
      <a href="#about" class="hover:text-primary transition">About</a>
      <a href="#features" class="hover:text-primary transition">Features</a>
      <a href="#contact" class="hover:text-primary transition">Contact</a>
      <a href="home.php" class="hover:text-primary transition">List</a>
    </nav>
  </header>

  <!-- Hero Section -->
  <section id="home" class="pt-28 pb-20 relative overflow-hidden">
    <!-- Aurora Blob -->
    <div class="absolute top-[-20%] right-[-20%] w-[60vw] h-[60vw] bg-gradient-to-tr from-primary to-secondary rounded-full opacity-30 blur-3xl z-0"></div>
    
    <div class="relative z-10 text-center max-w-4xl mx-auto px-4">
      <h1 data-aos="fade-up" class="text-5xl font-bold leading-tight mb-4">
        Find Trusted Local Businesses
      </h1>
      <p data-aos="fade-up" data-aos-delay="100" class="text-lg text-slate-600 mb-8">
        Connect with professionals like Carpenters, IT Experts, Drivers, and more in your area.
      </p>
      <div data-aos="fade-up" data-aos-delay="200">
        <form action="home.php" method="GET" class="w-full max-w-md">
            <input type="text" name="search" placeholder="Search for services..." class="px-6 py-3 w-full rounded-xl neumorphic bg-white outline-none text-slate-700" />
            <button type="submit" class="hidden"></button>
        </form>
      </div>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="py-16 bg-white relative">
    <div class="max-w-6xl mx-auto px-4">
      <div class="text-center mb-12">
        <h2 data-aos="fade-up" class="text-3xl font-bold">About BizConnect</h2>
        <p data-aos="fade-up" data-aos-delay="100" class="text-slate-600 mt-2">
          We empower local professionals by providing them a digital platform to showcase their services.
        </p>
      </div>
      <div class="grid md:grid-cols-3 gap-8">
        <div data-aos="zoom-in" class="p-6 rounded-3xl bg-white neumorphic text-center">
          <svg class="w-12 h-12 mx-auto mb-4 text-primary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path d="M12 6v6l4 2" />
          </svg>
          <h3 class="font-bold text-xl">Verified Listings</h3>
          <p class="text-slate-500 mt-2">Only trusted businesses are listed for user safety and authenticity.</p>
        </div>
        <div data-aos="zoom-in" data-aos-delay="100" class="p-6 rounded-3xl bg-white neumorphic text-center">
          <svg class="w-12 h-12 mx-auto mb-4 text-secondary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path d="M12 3v4m0 0v4m0-4h4m-4 0H8" />
          </svg>
          <h3 class="font-bold text-xl">Easy Discovery</h3>
          <p class="text-slate-500 mt-2">Search and filter businesses by service, location, or ratings.</p>
        </div>
        <div data-aos="zoom-in" data-aos-delay="200" class="p-6 rounded-3xl bg-white neumorphic text-center">
          <svg class="w-12 h-12 mx-auto mb-4 text-primary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path d="M12 6v12m6-6H6" />
          </svg>
          <h3 class="font-bold text-xl">Boost Your Reach</h3>
          <p class="text-slate-500 mt-2">Businesses gain visibility, reach, and credibility on our platform.</p>
        </div>
      </div>
    </div>
  </section>
  <!-- Features Section -->
<section id="features" class="py-20 bg-[#f9fafb]">
  <div class="max-w-6xl mx-auto px-4">
    <div class="text-center mb-12">
      <h2 data-aos="fade-up" class="text-3xl font-bold">Our Features</h2>
      <p data-aos="fade-up" data-aos-delay="100" class="text-slate-600 mt-2">
        A powerful platform designed to elevate small businesses.
      </p>
    </div>
    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-8">
      <!-- Feature Card -->
      <div data-aos="zoom-in" class="p-6 rounded-[30px] bg-white shadow-[8px_8px_0px_#cbd5e1] hover:scale-105 transition transform duration-300">
        <div class="text-primary text-4xl mb-4">
          <i class="fas fa-search"></i>
        </div>
        <h3 class="text-xl font-bold">Advanced Search</h3>
        <p class="text-slate-500 mt-2">Find businesses by location, category, and service instantly.</p>
      </div>
      <!-- Feature Card -->
      <div data-aos="zoom-in" data-aos-delay="100" class="p-6 rounded-[30px] bg-white shadow-[8px_8px_0px_#cbd5e1] hover:scale-105 transition transform duration-300">
        <div class="text-secondary text-4xl mb-4">
          <i class="fas fa-map-marker-alt"></i>
        </div>
        <h3 class="text-xl font-bold">Geo Listings</h3>
        <p class="text-slate-500 mt-2">Localized visibility boosts discovery for service providers.</p>
      </div>
      <!-- Feature Card -->
      <div data-aos="zoom-in" data-aos-delay="200" class="p-6 rounded-[30px] bg-white shadow-[8px_8px_0px_#cbd5e1] hover:scale-105 transition transform duration-300">
        <div class="text-indigo-500 text-4xl mb-4">
          <i class="fas fa-ad"></i>
        </div>
        <h3 class="text-xl font-bold">Premium Ads</h3>
        <p class="text-slate-500 mt-2">Get featured in top results with premium placement options.</p>
      </div>
    </div>
  </div>
</section>
  <!-- Business Card Section -->
<section class="py-12">
    <div class="max-w-4xl mx-auto px-4 relative">
        <?php
        // Fetch business card data
        $sql = "SELECT b.id, b.name, b.description, b.services, b.contact_number, b.image, b.city, b.state, b.pincode, b.email, c.name AS category 
                FROM businesses b 
                LEFT JOIN categories c ON b.category_id = c.id";
        $result = $conn->query($sql);
        ?>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="bg-white/50 backdrop-blur-lg border border-white/30 rounded-3xl shadow-[inset_4px_4px_10px_#ffffff40,inset_-4px_-4px_10px_#00000015] p-6 md:p-10 space-y-5 hover:shadow-[inset_10px_10px_25px_#00000025] transform hover:scale-105 transition duration-300 ease-in-out">
                    <?php if ($row['image']): ?>
                        <img src="uploads/<?= $row['image'] ?>" class="h-48 w-full object-cover rounded mb-3" alt="Business Image">
                    <?php endif; ?>
                    <h2 class="text-xl font-bold"><?= htmlspecialchars($row['name']) ?></h2>
                    <p class="text-sm text-gray-500"><?= htmlspecialchars($row['category']) ?> - <?= htmlspecialchars($row['city']) ?>, <?= htmlspecialchars($row['state']) ?> (<?= htmlspecialchars($row['pincode']) ?>)</p>
                    <p class="mt-2 text-gray-700"><?= substr($row['description'], 0, 100) ?>...</p>
                    <p class="text-sm mt-1"><strong>Services:</strong> <?= htmlspecialchars($row['services']) ?></p>
                    <p class="text-sm mt-1"><strong>📞</strong> <?= htmlspecialchars($row['contact_number']) ?> | <strong>✉️</strong> <?= htmlspecialchars($row['email']) ?></p>
                    <a href="business.php?id=<?= $row['id'] ?>" class="text-blue-600 hover:underline">View Details</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center text-slate-600">No business cards available.</p>
        <?php endif; ?>
    </div>
</section>

  <!-- Contact Section -->
<section id="contact" class="py-20 bg-[#f4f6f9]">
    <div class="max-w-6xl mx-auto px-4 text-center">
      <h2 data-aos="fade-up" class="text-3xl font-bold">Contact Us</h2>
      <p data-aos="fade-up" data-aos-delay="100" class="text-slate-600 mt-2">
        We would love to hear from you! Reach out to us for inquiries, suggestions, or support.
      </p>
    </div>
    <div class="max-w-4xl mx-auto mt-12 px-4">
      <form action="#" method="POST" class="space-y-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div>
            <input type="text" placeholder="Your Name" class="w-full px-6 py-3 rounded-xl neumorphic text-slate-700 focus:outline-none" />
          </div>
          <div>
            <input type="email" placeholder="Your Email" class="w-full px-6 py-3 rounded-xl neumorphic text-slate-700 focus:outline-none" />
          </div>
        </div>
        <div>
          <textarea placeholder="Your Message" rows="4" class="w-full px-6 py-3 rounded-xl neumorphic text-slate-700 focus:outline-none"></textarea>
        </div>
        <button type="submit" class="w-full py-3 bg-primary text-white rounded-xl neumorphic hover:bg-indigo-600 transition duration-300">
          Send Message
        </button>
      </form>
    </div>
  </section>
  
  <!-- Footer Section -->
  <footer class="py-8 bg-slate-800 text-white">
    <div class="max-w-6xl mx-auto px-4 text-center">
      <p>&copy; 2025 BizConnect. All rights reserved.</p>
      <div class="mt-4 space-x-6">
        <a href="#" class="hover:text-primary transition">Privacy Policy</a>
        <a href="#" class="hover:text-primary transition">Terms of Service</a>
      </div>
      <div class="mt-6 flex justify-center space-x-6">
        <a href="#" class="text-white hover:text-primary transition">Facebook</a>
        <a href="#" class="text-white hover:text-primary transition">Twitter</a>
        <a href="#" class="text-white hover:text-primary transition">LinkedIn</a>
      </div>
    </div>
  </footer>
  
  <script>
    AOS.init({ once: true, duration: 800 });
  </script>
</body>
</html>
