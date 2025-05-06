<?php include "../configs/db.php"; require '../vendor/autoload.php'; use PHPMailer\PHPMailer\PHPMailer; use PHPMailer\PHPMailer\Exception; include "../configs/mail_config.php"; 

$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $token = bin2hex(random_bytes(32));
        $expiry = date("Y-m-d H:i:s", strtotime("+10 minutes"));
        $conn->query("UPDATE users SET reset_token='$token', reset_token_expiry='$expiry' WHERE email='$email'");

        // Send email
        $link = "https:///bizcard.42web.io/pages/reset.php?token=$token"; // Updated link

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = $mail_host;
            $mail->SMTPAuth = true;
            $mail->Username = $mail_username;
            $mail->Password = $mail_password;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            
            $mail->setFrom($mail_from, 'Password Reset');
            $mail->addAddress($email);
            $mail->isHTML(true); // <-- This is necessary to render HTML in emails

            $mail->Subject = "Reset your password";
            $mail->Body = "
            <!DOCTYPE html>
            <html>
            <head>
              <style>
                body { font-family: Arial, sans-serif; }
              </style>
            </head>
            <body style='margin:0; padding:0; background-color:#f8f9fa;'>
              <table width='100%' cellpadding='0' cellspacing='0' style='max-width:600px; margin:0 auto; background-color:#ffffff; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1); padding: 20px;'>
                <tr>
                  <td align='center' style='padding: 20px 0;'>
                    <h2 style='color:#333;'>Reset Your Password</h2>
                  </td>
                </tr>
                <tr>
                  <td style='padding: 20px; color:#555; font-size: 16px; text-align: center;'>
                    <p>We received a request to reset your password.</p>
                    <p>Click the button below to set a new one:</p>
                    <a href='$link' style='display:inline-block; background-color:#007BFF; color:#ffffff; text-decoration:none; padding:12px 20px; border-radius:5px; margin:20px 0; font-weight:bold;'>Reset Password</a>
                    <p>If you didn't request this, you can safely ignore this email.</p>
                    <p style='margin-top: 30px; font-size: 14px; color: #aaa;'>This link will expire in 15 minutes for your security.</p>
                  </td>
                </tr>
              </table>
            </body>
            </html>
            ";
            $mail->send();
            $msg = "Reset link sent! Please check your email.";
        } catch (Exception $e) {
            $msg = "Error sending mail: " . $mail->ErrorInfo;
        }
    } else {
        $msg = "Email not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Forgot Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-black to-gray-800 min-h-screen flex items-center justify-center text-white relative overflow-hidden">

  <!-- Background Blob -->
  <div class="absolute top-10 left-5 w-[200px] h-[200px] bg-cyan-400 rounded-full filter blur-[100px] z-[-1]"></div>

  <!-- Forgot Password Card -->
  <div class="bg-gray-800 rounded-xl shadow-xl p-8 w-full max-w-md mx-auto border border-gray-700">
    <h2 class="text-3xl font-bold text-center mb-6 text-cyan-400">Forgot Password</h2>

    <form method="post" class="space-y-5">
      <div>
        <label for="email" class="block text-gray-300 mb-2">Email Address</label>
        <input type="email" name="email" id="email" required
               class="w-full px-4 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 transition"
               placeholder="you@example.com">
      </div>

      <button type="submit"
              class="w-full bg-cyan-500 hover:bg-cyan-400 text-white font-semibold py-2 px-4 rounded-md transition-all duration-300">
        Send Reset Link
      </button>
    </form>

    <?php if (!empty($msg)) : ?>
      <p class="text-green-500 text-sm text-center mt-4"><?= $msg ?></p>
    <?php endif; ?>
  </div>
</body>
</html>

