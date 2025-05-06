<?php
session_start();
include '../includes/auth.php';
include '../configs/db.php';

$user_id = $_SESSION['user_id'];

$conn->begin_transaction();

try {
    // Delete related rows in the business_cards table
    $stmt = $conn->prepare("DELETE FROM business_cards WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Delete the user's data from the users table
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Commit the transaction
    $conn->commit();

    // Destroy the session and redirect to the homepage
    session_destroy();
    header('Location: ../');
    exit();
} catch (mysqli_sql_exception $e) {
    // Rollback the transaction on error
    $conn->rollback();

    // Handle errors
    $_SESSION['error'] = 'Failed to delete your account. Please try again.';
    header('Location: profile.php');
    exit();
}
?>