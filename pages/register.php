<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start(); // Start the session
include "../configs/db.php";
include "../configs/mail_config.php";
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

$email = $password = $msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $otp = rand(100000, 999999);
    $otp_expiry = date("Y-m-d H:i:s", strtotime("+1 minute"));

    $stmt = $conn->prepare("INSERT INTO users (name, phone, email, password, otp, otp_expiry) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssssss", $name, $phone, $email, $password, $otp, $otp_expiry);
        if ($stmt->execute()) {
            $_SESSION['email'] = $email; // Set the session variable
        } else {
            $msg = "Database error: " . $stmt->error; // Debugging
        }
    } else {
        $msg = "Database error: " . $conn->error; // Debugging
    }

    // Send OTP
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = $mail_host;
        $mail->SMTPAuth = true;
        $mail->Username = $mail_username;
        $mail->Password = $mail_password;
        $mail->SMTPSecure = $mail_smtp_secure;
        $mail->Port = $mail_port;
        $mail->isHTML(true);

        $mail->setFrom($mail_from, $mail_from_name);
        $mail->addAddress($email);
        $mail->Subject = 'Your OTP Code';
        $mail->Body = "
        <!DOCTYPE html>
        <html>
        <head>
          <style>
            body { font-family: Arial, sans-serif; }
          </style>
        </head>
        <body style='margin:0; padding:0; background-color:#f4f4f4;'>
          <table width='100%' style='max-width:600px; margin: 0 auto; background-color:#fff; padding:20px; border-radius:8px; box-shadow:0 0 10px rgba(0,0,0,0.1);'>
            <tr>
              <td align='center' style='padding: 20px 0;'>
                <h2 style='color:#333;'>Verify Your Email</h2>
              </td>
            </tr>
            <tr>
              <td style='padding: 20px; text-align: center; font-size: 18px; color:#555;'>
                <p>Thank you for registering with us.</p>
                <p><strong>Your One-Time Password (OTP) is:</strong></p>
                <p style='font-size: 32px; color:#007BFF; margin: 20px 0;'>$otp</p>
                <p>This OTP is valid for <strong>1 minute</strong>.</p>
                <p style='margin-top: 30px; font-size: 14px; color: #999;'>If you did not request this, please ignore this email.</p>
              </td>
            </tr>
          </table>
        </body>
        </html>
        ";
        $mail->send();
        header("Location: verify_otp.php"); // Redirect to verify_otp.php
        exit();
        
    } catch (Exception $e) {
        $msg = "Mailer Error: " . $mail->ErrorInfo;
    }
}
?>

<!-- HTML FORM -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-black to-gray-800 min-h-screen flex items-center justify-center text-white relative overflow-hidden">

  <!-- Background Blob -->
  <div class="absolute top-10 left-5 w-[200px] h-[200px] bg-cyan-400 rounded-full filter blur-[100px] z-[-1]"></div>

  <!-- Registration Card -->
  <div class="bg-gray-800 rounded-xl shadow-xl p-8 w-full max-w-md mx-auto border border-gray-700">
    <h2 class="text-3xl font-bold text-center mb-6 text-cyan-400">Create Account</h2>

    <form method="post" class="space-y-5">
      <div>
        <label for="name" class="block text-gray-300 mb-2">Name</label>
        <input type="text" name="name" id="name" required
               class="w-full px-4 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 transition" 
               placeholder="Your Name">
      </div>

      <div>
        <label for="phone" class="block text-gray-300 mb-2">Phone</label>
        <input type="text" name="phone" id="phone" required
               class="w-full px-4 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 transition" 
               placeholder="123-456-7890">
      </div>

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
      <p><a href="login.php" class="text-cyan-400 hover:underline">Already have an account? Login</a></p>
      <button type="submit" name="register"
              class="w-full bg-cyan-500 hover:bg-cyan-400 text-white font-semibold py-2 px-4 rounded-md transition-all duration-300">
        Register
      </button>
    </form>

    <?php if (!empty($msg)) : ?>
      <p class="text-red-500 text-sm text-center mt-4"><?= $msg ?></p>
    <?php endif; ?>
  </div>
</body>
</html>

