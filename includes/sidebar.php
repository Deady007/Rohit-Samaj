<div class="w-64 bg-gradient-to-b from-blue-800 to-blue-600 text-white p-6 shadow-lg transition-all duration-300" id="sidebar">
    <button class="text-white mb-4 focus:outline-none" id="toggleSidebar">
        <i class="ph ph-list"></i>
    </button>
    <h2 class="text-2xl font-semibold flex items-center gap-2">
        <i class="ph ph-buildings"></i> <span class="sidebar-text">Dashboard</span>
    </h2>
    <nav class="mt-6">
        <ul class="space-y-2">
            <li>
                <a href="/rohit/user/dashboard.php" class="block py-2 px-4 rounded hover:bg-blue-700 transition <?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'bg-blue-700' : '' ?>">
                    <i class="ph ph-house mr-2"></i> <span class="sidebar-text">Home</span>
                </a>
            </li>
            <li>
                <a href="/rohit/user/cards/list.php" class="block py-2 px-4 rounded hover:bg-blue-700 transition <?= basename($_SERVER['PHP_SELF']) == 'list.php' ? 'bg-blue-700' : '' ?>">
                    <i class="ph ph-list mr-2"></i> <span class="sidebar-text">My Business Cards</span>
                </a>
            </li>
            <li>
                <a href="/rohit/user/cards/add.php" class="block py-2 px-4 rounded hover:bg-blue-700 transition <?= basename($_SERVER['PHP_SELF']) == 'add.php' ? 'bg-blue-700' : '' ?>">
                    <i class="ph ph-plus-square mr-2"></i> <span class="sidebar-text">Add New Card</span>
                </a>
            </li>
            <li>
                <a href="/rohit/user/cards/logout.php" class="block py-2 px-4 rounded hover:bg-blue-700 transition">
                    <i class="ph ph-sign-out mr-2"></i> <span class="sidebar-text">Logout</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

<script>
// filepath: c:\xampp\htdocs\rohit\includes\sidebar.js
document.getElementById('toggleSidebar').addEventListener('click', function () {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('w-64');
    sidebar.classList.toggle('w-16');
    const texts = document.querySelectorAll('.sidebar-text');
    texts.forEach(text => text.classList.toggle('hidden'));
});
</script>

<style>
// filepath: c:\xampp\htdocs\rohit\includes\sidebar.css
#sidebar {
    overflow: hidden;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
}

#sidebar.w-16 {
    width: 4rem;
}

#sidebar.w-16 h2,
#sidebar.w-16 .sidebar-text {
    display: none;
}

#sidebar.w-16 ul {
    padding-left: 0.5rem;
}

#sidebar button {
    background: transparent;
    border: none;
    cursor: pointer;
    font-size: 1.5rem;
}

#sidebar ul li a {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    color: white;
    font-size: 1rem;
}

#sidebar ul li a:hover {
    background: rgba(255, 255, 255, 0.2);
}

#sidebar ul li a i {
    font-size: 1.25rem;
}

#sidebar ul li a .sidebar-text {
    transition: opacity 0.3s ease;
}

@media (max-width: 768px) {
    #sidebar {
        position: absolute;
        z-index: 50;
    }
}
</style>