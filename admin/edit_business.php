<?php
include 'includes/admin_header.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM businesses WHERE id = $id");
$biz = $result->fetch_assoc();

$categories = $conn->query("SELECT * FROM categories");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category_id = $_POST['category'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $address = $_POST['address'];
    $description = $_POST['description'];
    $services = $_POST['services'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE businesses SET name=?, category_id=?, state=?, city=?, pincode=?, address=?, description=?, services=?, contact_number=?, email=? WHERE id=?");
    $stmt->bind_param("sissssssssi", $name, $category_id, $state, $city, $pincode, $address, $description, $services, $contact, $email, $id);
    $stmt->execute();

    header("Location: businesses.php");
    exit;
}
?>

<form method="POST" class="p-6">
  <h2 class="text-xl font-bold mb-4">Edit Business</h2>

  <input type="text" name="name" value="<?= $biz['name'] ?>" class="input" required><br>
  <select name="category" class="input" required>
    <?php while ($cat = $categories->fetch_assoc()): ?>
      <option value="<?= $cat['id'] ?>" <?= $biz['category_id'] == $cat['id'] ? 'selected' : '' ?>>
        <?= $cat['name'] ?>
      </option>
    <?php endwhile; ?>
  </select><br>

  <input type="text" name="state" value="<?= $biz['state'] ?>" class="input" required><br>
  <input type="text" name="city" value="<?= $biz['city'] ?>" class="input" required><br>
  <input type="text" name="pincode" value="<?= $biz['pincode'] ?>" class="input" required><br>
  <textarea name="address" class="input"><?= $biz['address'] ?></textarea><br>
  <textarea name="description" class="input"><?= $biz['description'] ?></textarea><br>
  <textarea name="services" class="input"><?= $biz['services'] ?></textarea><br>
  <input type="text" name="contact" value="<?= $biz['contact_number'] ?>" class="input" required><br>
  <input type="email" name="email" value="<?= $biz['email'] ?>" class="input" required><br>

  <button type="submit" class="btn">Update</button>
</form>
        