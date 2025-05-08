<?php
session_start();
include '../configs/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['business_id'], $_POST['action'])) {
    $id = $_POST['business_id'];
    $action = $_POST['action'];

    if ($action == 'approve') {
        $conn->query("UPDATE businesses SET is_approved = 1 WHERE id = $id");
    } elseif ($action == 'reject') {
        $conn->query("DELETE FROM businesses WHERE id = $id");
    }
}

header("Location: approve_businesses.php");
exit();
