 <html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   MemberVerse
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
 </head>
 <body class="bg-white font-sans">
  <div class="max-w-7xl mx-auto px-4 py-10">
   <header class="text-center mb-8">
    <h1 class="text-3xl font-bold text-blue-500">
     RohitSamaj Community
    </h1>
    <p class="text-gray-600 mt-1 text-sm sm:text-base">
     Discover and connect with our amazing community members.
    </p>
   </header>
   <form aria-label="Search members" class="flex items-center mb-4 max-w-5xl mx-auto" role="search">
    <label class="sr-only" for="search-members">
     Search members
    </label>
    <input class="flex-grow border border-gray-300 rounded-l-md px-3 py-2 text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="search-members" placeholder="Search members by name or bio..." type="search"/>
    <button aria-label="Search" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-md text-sm flex items-center justify-center" type="submit">
     <i class="fas fa-search">
     </i>
    </button>
   </form>
   <div class="flex space-x-2 max-w-5xl mx-auto mb-6 text-sm">
    <div class="relative group">
     <button aria-controls="interests-menu" aria-expanded="false" aria-haspopup="true" class="flex items-center space-x-1 border border-gray-300 rounded-md px-3 py-1 text-blue-600 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="button">
      <i class="fas fa-filter">
      </i>
      <span>
       Interests
      </span>
      <svg aria-hidden="true" class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
       <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round">
       </path>
      </svg>
     </button>
     <div aria-label="Interests filter" class="absolute z-10 mt-1 w-48 bg-white border border-gray-200 rounded-md shadow-lg p-3 hidden group-hover:block" id="interests-menu" role="menu">
      <form class="space-y-1 text-xs text-gray-700">
       <label class="flex items-center space-x-2">
        <input class="form-checkbox h-4 w-4 text-blue-600" type="checkbox"/>
        <span>
         AI
        </span>
       </label>
       <label class="flex items-center space-x-2">
        <input class="form-checkbox h-4 w-4 text-blue-600" type="checkbox"/>
        <span>
         Accessibility
        </span>
       </label>
       <label class="flex items-center space-x-2">
        <input class="form-checkbox h-4 w-4 text-blue-600" type="checkbox"/>
        <span>
         Branding
        </span>
       </label>
       <label class="flex items-center space-x-2">
        <input class="form-checkbox h-4 w-4 text-blue-600" type="checkbox"/>
        <span>
         Data Visualization
        </span>
       </label>
       <label class="flex items-center space-x-2">
        <input class="form-checkbox h-4 w-4 text-blue-600" type="checkbox"/>
        <span>
         Digital Marketing
        </span>
       </label>
       <label class="flex items-center space-x-2">
        <input class="form-checkbox h-4 w-4 text-blue-600" type="checkbox"/>
        <span>
         JavaScript
        </span>
       </label>
       <label class="flex items-center space-x-2">
        <input class="form-checkbox h-4 w-4 text-blue-600" type="checkbox"/>
        <span>
         Machine Learning
        </span>
       </label>
       <label class="flex items-center space-x-2">
        <input class="form-checkbox h-4 w-4 text-blue-600" type="checkbox"/>
        <span>
         Product Strategy
        </span>
       </label>
       <label class="flex items-center space-x-2">
        <input class="form-checkbox h-4 w-4 text-blue-600" type="checkbox"/>
        <span>
         SEO
        </span>
       </label>
       <label class="flex items-center space-x-2">
        <input class="form-checkbox h-4 w-4 text-blue-600" type="checkbox"/>
        <span>
         UI Design
        </span>
       </label>
      </form>
     </div>
    </div>
    <button class="flex items-center space-x-1 border border-gray-300 rounded-md px-3 py-1 text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" type="button">
     <i class="fas fa-filter">
     </i>
     <span>
      Location
     </span>
    </button>
    <button class="flex items-center space-x-1 border border-gray-300 rounded-md px-3 py-1 text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" type="button">
     <i class="fas fa-filter">
     </i>
     <span>
      Skills
     </span>
    </button>
   </div>
   <section aria-label="Member profiles" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
    <article aria-label="Member profile for Bob Williams" class="border border-gray-200 rounded-lg p-4 flex flex-col space-y-3">
     <div class="flex items-center space-x-3">
      <img alt="Photo of Bob Williams at sunset with water tower" class="w-12 h-12 rounded-full border-2 border-blue-500 object-cover" height="48" src="https://storage.googleapis.com/a1aa/image/2caac178-1125-440a-8dda-7d561bc0abe8.jpg" width="48"/>
      <div>
       <h2 class="font-bold text-black text-base leading-tight">
        Bob Williams
       </h2>
       <p class="text-gray-500 text-xs flex items-center space-x-1">
        <i class="fas fa-map-marker-alt text-gray-400">
        </i>
        <span>
         New York
        </span>
       </p>
      </div>
     </div>
     <p class="text-xs text-gray-900">
      Product Manager with a focus on user experience.
     </p>
     <div class="space-y-1 text-xs text-gray-600">
      <p class="flex items-center space-x-1 font-semibold uppercase tracking-wide">
       <i class="fas fa-tag text-gray-400">
       </i>
       <span>
        Interests
       </span>
      </p>
      <div class="flex flex-wrap gap-1">
       <span class="bg-gray-200 text-gray-800 rounded px-2 py-0.5 font-semibold">
        UX Design
       </span>
       <span class="bg-gray-200 text-gray-800 rounded px-2 py-0.5 font-semibold">
        Product Strategy
       </span>
      </div>
      <p class="flex items-center space-x-1 font-semibold uppercase tracking-wide mt-2">
       <i class="fas fa-wrench text-gray-400">
       </i>
       <span>
        Skills
       </span>
      </p>
      <div class="flex flex-wrap gap-1">
       <span class="border border-blue-300 text-blue-700 rounded-full px-2 py-0.5">
        Agile
       </span>
       <span class="border border-blue-300 text-blue-700 rounded-full px-2 py-0.5">
        Jira
       </span>
       <span class="border border-blue-300 text-blue-700 rounded-full px-2 py-0.5">
        Market Research
       </span>
      </div>
     </div>
    </article>
    <article aria-label="Member profile for Charlie Brown" class="border border-gray-200 rounded-lg p-4 flex flex-col space-y-3">
     <div class="flex items-center space-x-3">
      <img alt="Photo of Charlie Brown black and white pattern" class="w-12 h-12 rounded-full border-2 border-blue-500 object-cover" height="48" src="https://storage.googleapis.com/a1aa/image/9a88d047-0e31-42ab-c266-120faea4dbab.jpg" width="48"/>
      <div>
       <h2 class="font-bold text-black text-base leading-tight">
        Charlie Brown
       </h2>
       <p class="text-gray-500 text-xs flex items-center space-x-1">
        <i class="fas fa-map-marker-alt text-gray-400">
        </i>
        <span>
         London
        </span>
       </p>
      </div>
     </div>
     <p class="text-xs text-gray-900">
      Graphic Designer creating beautiful interfaces.
     </p>
     <div class="space-y-1 text-xs text-gray-600">
      <p class="flex items-center space-x-1 font-semibold uppercase tracking-wide">
       <i class="fas fa-tag text-gray-400">
       </i>
       <span>
        Interests
       </span>
      </p>
      <div class="flex flex-wrap gap-1">
       <span class="bg-gray-200 text-gray-800 rounded px-2 py-0.5 font-semibold">
        UI Design
       </span>
       <span class="bg-gray-200 text-gray-800 rounded px-2 py-0.5 font-semibold">
        Branding
       </span>
      </div>
      <p class="flex items-center space-x-1 font-semibold uppercase tracking-wide mt-2">
       <i class="fas fa-wrench text-gray-400">
       </i>
       <span>
        Skills
       </span>
      </p>
      <div class="flex flex-wrap gap-1">
       <span class="border border-blue-300 text-blue-700 rounded-full px-2 py-0.5">
        Figma
       </span>
       <span class="border border-blue-300 text-blue-700 rounded-full px-2 py-0.5">
        Illustrator
       </span>
       <span class="border border-blue-300 text-blue-700 rounded-full px-2 py-0.5">
        Photoshop
       </span>
      </div>
     </div>
    </article>
    <article aria-label="Member profile for Diana Garcia" class="border border-gray-200 rounded-lg p-4 flex flex-col space-y-3">
     <div class="flex items-center space-x-3">
      <img alt="Photo of Diana Garcia Berlin waterfront" class="w-12 h-12 rounded-full border-2 border-blue-500 object-cover" height="48" src="https://storage.googleapis.com/a1aa/image/f985978d-34ad-40ad-fa8f-f5c5a3541939.jpg" width="48"/>
      <div>
       <h2 class="font-bold text-black text-base leading-tight">
        Diana Garcia
       </h2>
       <p class="text-gray-500 text-xs flex items-center space-x-1">
        <i class="fas fa-map-marker-alt text-gray-400">
        </i>
        <span>
         Berlin
        </span>
       </p>
      </div>
     </div>
     <p class="text-xs text-gray-900">
      Data Scientist exploring machine learning models.
     </p>
     <div class="space-y-1 text-xs text-gray-600">
      <p class="flex items-center space-x-1 font-semibold uppercase tracking-wide">
       <i class="fas fa-tag text-gray-400">
       </i>
       <span>
        Interests
       </span>
      </p>
      <div class="flex flex-wrap gap-1">
       <span class="bg-gray-200 text-gray-800 rounded px-2 py-0.5 font-semibold">
        Machine Learning
       </span>
       <span class="bg-gray-200 text-gray-800 rounded px-2 py-0.5 font-semibold">
        Data Visualization
       </span>
      </div>
      <p class="flex items-center space-x-1 font-semibold uppercase tracking-wide mt-2">
       <i class="fas fa-wrench text-gray-400">
       </i>
       <span>
        Skills
       </span>
      </p>
      <div class="flex flex-wrap gap-1">
       <span class="border border-blue-300 text-blue-700 rounded-full px-2 py-0.5">
        Python
       </span>
       <span class="border border-blue-300 text-blue-700 rounded-full px-2 py-0.5">
        TensorFlow
       </span>
       <span class="border border-blue-300 text-blue-700 rounded-full px-2 py-0.5">
        SQL
       </span>
      </div>
     </div>
    </article>
    <article aria-label="Member profile for Ethan Rodriguez" class="border border-gray-200 rounded-lg p-4 flex flex-col space-y-3">
     <div class="flex items-center space-x-3">
      <img alt="Photo of Ethan Rodriguez black and white waterfall" class="w-12 h-12 rounded-full border-2 border-blue-500 object-cover" height="48" src="https://storage.googleapis.com/a1aa/image/a107cc79-8afe-4046-c7d8-3096793a1881.jpg" width="48"/>
      <div>
       <h2 class="font-bold text-black text-base leading-tight">
        Ethan Rodriguez
       </h2>
       <p class="text-gray-500 text-xs flex items-center space-x-1">
        <i class="fas fa-map-marker-alt text-gray-400">
        </i>
        <span>
         Austin
        </span>
       </p>
      </div>
     </div>
     <p class="text-xs text-gray-900">
      Marketing Specialist focused on growth.
     </p>
     <div class="space-y-1 text-xs text-gray-600">
      <p class="flex items-center space-x-1 font-semibold uppercase tracking-wide">
       <i class="fas fa-tag text-gray-400">
       </i>
       <span>
        Interests
       </span>
      </p>
      <div class="flex flex-wrap gap-1">
       <span class="bg-gray-200 text-gray-800 rounded px-2 py-0.5 font-semibold">
        Digital Marketing
       </span>
       <span class="bg-gray-200 text-gray-800 rounded px-2 py-0.5 font-semibold">
        SEO
       </span>
      </div>
      <p class="flex items-center space-x-1 font-semibold uppercase tracking-wide mt-2">
       <i class="fas fa-wrench text-gray-400">
       </i>
       <span>
        Skills
       </span>
      </p>
      <div class="flex flex-wrap gap-1">
       <span class="border border-blue-300 text-blue-700 rounded-full px-2 py-0.5">
        Google Analytics
       </span>
       <span class="border border-blue-300 text-blue-700 rounded-full px-2 py-0.5">
        Content Marketing
       </span>
       <span class="border border-blue-300 text-blue-700 rounded-full px-2 py-0.5">
        Social Media
       </span>
      </div>
     </div>
    </article>
    <article aria-label="Member profile for Fiona Miller" class="border border-gray-200 rounded-lg p-4 flex flex-col space-y-3">
     <div class="flex items-center space-x-3">
      <img alt="Photo of Fiona Miller metal pipe closeup" class="w-12 h-12 rounded-full border-2 border-blue-500 object-cover" height="48" src="https://storage.googleapis.com/a1aa/image/faed7a55-6650-47da-e8b9-bfec76911b23.jpg" width="48"/>
      <div>
       <h2 class="font-bold text-black text-base leading-tight">
        Fiona Miller
       </h2>
       <p class="text-gray-500 text-xs flex items-center space-x-1">
        <i class="fas fa-map-marker-alt text-gray-400">
        </i>
        <span>
         San Francisco
        </span>
       </p>
      </div>
     </div>
     <p class="text-xs text-gray-900">
      Frontend Developer building interactive web apps.
     </p>
     <div class="space-y-1 text-xs text-gray-600">
      <p class="flex items-center space-x-1 font-semibold uppercase tracking-wide">
       <i class="fas fa-tag text-gray-400">
       </i>
       <span>
        Interests
       </span>
      </p>
      <div class="flex flex-wrap gap-1">
       <span class="bg-gray-200 text-gray-800 rounded px-2 py-0.5 font-semibold">
        JavaScript
       </span>
       <span class="bg-gray-200 text-gray-800 rounded px-2 py-0.5 font-semibold">
        Accessibility
       </span>
      </div>
      <p class="flex items-center space-x-1 font-semibold uppercase tracking-wide mt-2">
       <i class="fas fa-wrench text-gray-400">
       </i>
       <span>
        Skills
       </span>
      </p>
      <div class="flex flex-wrap gap-1">
       <span class="border border-blue-300 text-blue-700 rounded-full px-2 py-0.5">
        Vue.js
       </span>
       <span class="border border-blue-300 text-blue-700 rounded-full px-2 py-0.5">
        CSS
       </span>
       <span class="border border-blue-300 text-blue-700 rounded-full px-2 py-0.5">
        HTML
       </span>
      </div>
     </div>
    </article>
   </section>
  </div>
  <script>
   // filepath: c:\xampp\htdocs\rohit\pages\business.php
   document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search-members');
    const filterCheckboxes = document.querySelectorAll('#interests-menu input[type="checkbox"]');
    const memberProfiles = document.querySelectorAll('section[aria-label="Member profiles"] article');

    // Function to filter profiles
    const filterProfiles = () => {
     const searchTerm = searchInput.value.toLowerCase();
     const selectedFilters = Array.from(filterCheckboxes)
      .filter(checkbox => checkbox.checked)
      .map(checkbox => checkbox.nextElementSibling.textContent.toLowerCase());

     memberProfiles.forEach(profile => {
      const name = profile.querySelector('h2').textContent.toLowerCase();
      const bio = profile.querySelector('p.text-xs').textContent.toLowerCase();
      const interests = Array.from(profile.querySelectorAll('div.flex-wrap span')).map(span => span.textContent.toLowerCase());

      const matchesSearch = name.includes(searchTerm) || bio.includes(searchTerm);
      const matchesFilters = selectedFilters.length === 0 || selectedFilters.some(filter => interests.includes(filter));

      if (matchesSearch && matchesFilters) {
       profile.style.display = '';
      } else {
       profile.style.display = 'none';
      }
     });
    };

    // Event listeners
    searchInput.addEventListener('input', filterProfiles);
    filterCheckboxes.forEach(checkbox => checkbox.addEventListener('change', filterProfiles));
   });
  </script>
 </body>
</html>
