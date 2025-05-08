<?php 
session_start();
include "../configs/db.php";

$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password, verified, role, status FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($user_id, $hashed_pw, $verified, $role, $status);

    if ($stmt->fetch()) {
        if (!password_verify($password, $hashed_pw)) {
            $msg = "Invalid credentials.";
        } elseif (!$verified) {
            $msg = "Please verify your email first.";
        } elseif ($status !== 'active') {
            $msg = "Your account is suspended. Contact support.";
        } else {
            // Authenticated
            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['role'] = $role;

            header("Location: " . ($role === 'admin' ? "../admin/index.php" : "../user/dashboard.php"));
            exit();
        }
    } else {
        $msg = "Invalid login.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-black to-gray-800 min-h-screen flex items-center justify-center text-white relative overflow-hidden">

  <!-- Background Blob -->
  <div class="absolute top-10 left-5 w-[200px] h-[200px] bg-cyan-400 rounded-full filter blur-[100px] z-[-1]"></div>

  <!-- Login Card -->
  <div class="bg-gray-800 rounded-xl shadow-xl p-8 w-full max-w-md mx-auto border border-gray-700">
    <h2 class="text-3xl font-bold text-center mb-6 text-cyan-400">Login</h2>

    <form method="post" class="space-y-5">
      <div>
        <label for="email" class="block text-gray-300 mb-2">Email</label>
        <input type="email" name="email" id="email" required
               class="w-full px-4 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 transition"
               placeholder="you@example.com">
      </div>

      <div>
        <label for="password" class="block text-gray-300 mb-2">Password</label>
        <input type="password" name="password" id="password" required
               class="w-full px-4 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 transition"
               placeholder="••••••••">
      </div>

      <button type="submit" name="login"
              class="w-full bg-cyan-500 hover:bg-cyan-400 text-white font-semibold py-2 px-4 rounded-md transition-all duration-300">
        Login
      </button>

      <div class="text-center text-sm mt-4 space-y-1">
        <p><a href="forgot.php" class="text-cyan-400 hover:underline">Forgot Password?</a></p>
        <p><a href="register.php" class="text-cyan-400 hover:underline">Don’t have an account? Register</a></p>
      </div>
    </form>

    <?php if (!empty($msg)) : ?>
      <p class="text-red-500 text-sm text-center mt-4"><?= $msg ?></p>
    <?php endif; ?>
  </div>
</body>
</html>
