<?php  
// download_account_data.php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// **Fetch User Data from Database**
// Replace with your actual data fetching logic
$user_data = [
    'Username' => $username,
    'Email' => $_SESSION['email'], // Assuming email is stored in session
    'Joined' => '2024-01-15',
    // Add more fields as necessary
];

// **Convert Data to CSV or JSON**
$data_format = 'csv'; // You can allow users to choose the format

if ($data_format == 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="account_data.csv"');

    $output = fopen('php://output', 'w');
    fputcsv($output, array_keys($user_data));
    fputcsv($output, array_values($user_data));
    fclose($output);
    exit();
} elseif ($data_format == 'json') {
    header('Content-Type: application/json');
    header('Content-Disposition: attachment;filename="account_data.json"');

    echo json_encode($user_data, JSON_PRETTY_PRINT);
    exit();
} else {
    echo "Invalid data format selected.";
    exit();
}
?>
