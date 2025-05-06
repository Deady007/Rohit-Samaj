<?php include "../configs/db.php";

$token = $_GET['token'] ?? '';
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $new_password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("SELECT email, reset_token_expiry FROM users WHERE reset_token=?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->bind_result($email, $expiry);
    if ($stmt->fetch() && strtotime($expiry) > time()) {
        $stmt->close();

        $conn->query("UPDATE users SET password='$new_password', reset_token=NULL, reset_token_expiry=NULL WHERE reset_token='$token'");
        $msg = "Password reset successful! <a href='login.php'>Login now</a>";
    } else {
        $stmt->close();

        $msg = "Invalid or expired token.";
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reset Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-black to-gray-800 min-h-screen flex items-center justify-center text-white relative overflow-hidden">

  <!-- Background Blob -->
  <div class="absolute top-10 left-5 w-[200px] h-[200px] bg-cyan-400 rounded-full filter blur-[100px] z-[-1]"></div>

  <!-- Reset Password Card -->
  <div class="bg-gray-800 rounded-xl shadow-xl p-8 w-full max-w-md mx-auto border border-gray-700">
    <h2 class="text-3xl font-bold text-center mb-6 text-cyan-400">Reset Your Password</h2>

    <?php if ($msg == ""): ?>
    <form method="post" class="space-y-5">
      <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

      <div>
        <label for="password" class="block text-gray-300 mb-2">New Password</label>
        <input type="password" name="password" id="password" required
               class="w-full px-4 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 transition"
               placeholder="Enter new password">
      </div>

      <button type="submit"
              class="w-full bg-cyan-500 hover:bg-cyan-400 text-white font-semibold py-2 px-4 rounded-md transition-all duration-300">
        Reset Password
      </button>
    </form>
    <?php else: ?>
    <p class="text-green-500 text-center mt-4"><?= $msg ?></p>
    <?php endif; ?>
  </div>
</body>
</html>
