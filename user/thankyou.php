<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Thank You</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6 bg-gray-50">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow text-center">
        <h1 class="text-3xl font-bold text-green-600 mb-4">Thank You!</h1>
        <p class="text-lg text-gray-700">Your business has been successfully submitted for review.</p>
        <p class="text-gray-600 mt-2">Our team will review your submission and approve it shortly.</p>
        <a href="add_business.php" class="mt-6 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Submit Another Business
        </a>
        <a href="../home.php" class="mt-2 inline-block text-blue-600 hover:underline">
            Return to Home
        </a>
    </div>
</body>
</html>