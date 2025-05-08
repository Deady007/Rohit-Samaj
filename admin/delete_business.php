<?php
include '../configs/db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM businesses WHERE id = $id");
header("Location: businesses.php");
exit;
