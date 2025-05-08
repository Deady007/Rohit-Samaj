<?php
session_start();
include '../configs/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php'); exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Business</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6 bg-gray-50">
    <h2 class="text-2xl font-bold mb-4">Submit Your Business</h2>

    <form id="businessForm" enctype="multipart/form-data" class="space-y-4 max-w-xl bg-white p-6 rounded shadow">
        <input name="name" placeholder="Business Name" required class="w-full p-2 border rounded">
        <select name="category_id" required class="w-full p-2 border rounded">
            <option value="">Select Category</option>
            <?php
            $cats = $conn->query("SELECT * FROM categories");
            while ($cat = $cats->fetch_assoc()):
            ?>
                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
            <?php endwhile; ?>
        </select>
        <input name="state" placeholder="State" required class="w-full p-2 border rounded">
        <input name="city" placeholder="City" required class="w-full p-2 border rounded">
        <input name="pincode" placeholder="Pincode" required class="w-full p-2 border rounded">
        <input name="address" placeholder="Flat/Address" required class="w-full p-2 border rounded">
        <textarea name="description" placeholder="Business Description" required class="w-full p-2 border rounded h-24"></textarea>
        <textarea name="services" placeholder="Services Offered (comma separated)" required class="w-full p-2 border rounded h-20"></textarea>
        <input name="contact_number" placeholder="Business Mobile Number" required class="w-full p-2 border rounded">
        <input name="email" type="email" placeholder="Business Email" required class="w-full p-2 border rounded">
        <input type="file" name="image" required class="block">
        <button type="button" id="payAndSubmit" class="bg-blue-600 text-white px-4 py-2 rounded">Pay ₹499 & Submit</button>
    </form>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.getElementById('payAndSubmit').addEventListener('click', function () {
            fetch('pay_now.php')
                .then(res => res.json())
                .then(data => {
                    const options = {
                        key: data.key,
                        amount: data.amount,
                        currency: "INR",
                        name: "BizHub Platform",
                        description: "Business Listing Fee",
                        order_id: data.order_id,
                        handler: function (response) {
                            submitBusinessForm(response.razorpay_payment_id);
                        }
                    };
                    const rzp = new Razorpay(options);
                    rzp.open();
                });
        });

        function submitBusinessForm(paymentId) {
            const form = document.getElementById('businessForm');
            const formData = new FormData(form);
            formData.append('payment_id', paymentId);

            fetch('process_business.php', {
                method: 'POST',
                body: formData
            }).then(res => res.json())
              .then(data => {
                  if (data.success) {
                      alert('Business submitted successfully!');
                      location.href = 'thankyou.php';
                  } else {
                      alert('Submission failed: ' + data.error);
                  }
              });
        }
    </script>
</body>
</html>
