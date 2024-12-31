<?php 
// cancel_rental.php

// **Start Session**
session_start();

// **Check if User is Logged In**
if (!isset($_SESSION['user_id'])) {
    // **User Not Logged In – Redirect to Login Page**
    header("Location: login.php");
    exit();
}

// **Retrieve User Information**
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// **Check if Rental ID is Provided**
if (!isset($_GET['rental_id']) || empty($_GET['rental_id'])) {
    $_SESSION['error'] = "Invalid rental ID.";
    header("Location: my_rentals.php");
    exit();
}

$rental_id = intval($_GET['rental_id']);

// **Include Database Connection**
require_once 'db_connection.php';

// **Verify that the Rental Belongs to the Logged-In User and is Current**
$stmt = $conn->prepare("SELECT status FROM rentals WHERE rental_id = ? AND user_id = ?");
$stmt->bind_param("ii", $rental_id, $user_id);
$stmt->execute();
$stmt->bind_result($status);
if ($stmt->fetch()) {
    if ($status !== 'current') {
        $_SESSION['error'] = "Only current rentals can be canceled.";
        $stmt->close();
        $conn->close();
        header("Location: my_rentals.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Rental not found.";
    $stmt->close();
    $conn->close();
    header("Location: my_rentals.php");
    exit();
}
$stmt->close();

// **Update Rental Status to 'canceled'**
$update_stmt = $conn->prepare("UPDATE rentals SET status = 'canceled' WHERE rental_id = ?");
$update_stmt->bind_param("i", $rental_id);

if ($update_stmt->execute()) {
    $_SESSION['success'] = "Rental canceled successfully.";
} else {
    $_SESSION['error'] = "Error canceling rental. Please try again.";
}

$update_stmt->close();
$conn->close();

// **Redirect Back to My Rentals Page**
header("Location: my_rentals.php");
exit();
?>
