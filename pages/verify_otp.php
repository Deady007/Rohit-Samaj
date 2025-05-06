<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['email'])) {
    echo "Session email not set"; // Debugging
    header("Location: register.php");
    exit();
}

include "../configs/db.php";
include "../configs/mail_config.php";
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$msg = "";
$email = $_SESSION['email'];

if (isset($_POST['verify'])) {
    $otp = $_POST['otp'];
    $stmt = $conn->prepare("SELECT otp, otp_expiry FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($db_otp, $otp_expiry);
    $stmt->fetch();
    $stmt->close();

    if ($otp === $db_otp && strtotime($otp_expiry) > time()) {
        $conn->query("UPDATE users SET verified=1, otp=NULL WHERE email='$email'");
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    } else {
        $msg = "Invalid or expired OTP.";
    }
}

// Resend OTP
if (isset($_POST['resend'])) {
    $otp = rand(100000, 999999);
    $otp_expiry = date("Y-m-d H:i:s", strtotime("+1 minute"));
    $conn->query("UPDATE users SET otp='$otp', otp_expiry='$otp_expiry' WHERE email='$email'");

    
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = $mail_host;
        $mail->SMTPAuth = true;
        $mail->Username = $mail_username;
        $mail->Password = $mail_password;
        $mail->SMTPSecure = $mail_smtp_secure;
        $mail->Port = $mail_port;
        $mail->setFrom($mail_from, $mail_from_name);
        $mail->addAddress($email);
        $mail->isHTML(true); // <-- This is necessary to render HTML in emails

        $mail->Subject = 'Resent OTP Code';
        $mail->Body = "Your new OTP is $otp. It will expire in 1 minute.";
        $mail->send();
        $msg = "OTP resent!";
    } catch (Exception $e) {
        $msg = "Mailer Error: " . $mail->ErrorInfo;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Verify OTP</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    let count = 60;
    function countdown() {
        if (count > 0) {
            document.getElementById("timer").innerText = count + "s";
            count--;
            setTimeout(countdown, 1000);
        } else {
            document.getElementById("resend").disabled = false;
            document.getElementById("timer").innerText = "You can resend now.";
        }
    }
    window.onload = countdown;
  </script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-black to-gray-800 min-h-screen flex items-center justify-center text-white relative overflow-hidden">

  <!-- Background blob -->
  <div class="absolute top-10 left-5 w-[200px] h-[200px] bg-cyan-400 rounded-full filter blur-[100px] z-[-1]"></div>

  <div class="bg-gray-800 border border-gray-700 rounded-xl shadow-lg p-8 max-w-md w-full mx-auto">
    <h2 class="text-3xl font-bold text-cyan-400 text-center mb-6">Verify OTP</h2>

    <form method="post" class="space-y-5">
      <div>
        <label for="otp" class="block text-gray-300 mb-2">Enter OTP</label>
        <input type="text" name="otp" id="otp" required
               class="w-full px-4 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500"
               placeholder="6-digit code">
      </div>

      <button type="submit" name="verify"
              class="w-full bg-cyan-500 hover:bg-cyan-400 text-white font-semibold py-2 px-4 rounded-md transition">
        Verify
      </button>
    </form>

    <p id="timer" class="text-center text-gray-400 mt-4">60s</p>

    <form method="post" class="mt-4">
      <button type="submit" name="resend" id="resend" disabled
              class="w-full bg-gray-600 hover:bg-gray-500 text-white py-2 px-4 rounded-md transition disabled:opacity-50 disabled:cursor-not-allowed">
        Resend OTP
      </button>
    </form>

    <p class="text-red-500 text-center mt-4"><?= $msg ?></p>
  </div>
</body>
</html>
