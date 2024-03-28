<?php
// Database connection parameters
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'dine');

// Attempt to connect to the database
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check if the connection was successful
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Define an array to store orders
$orders = array();

// Attempt to fetch orders from the database
$sql = "SELECT customer_name, order_item, quantity, total_amount, order_date FROM orders";
if ($result = mysqli_query($link, $sql)) {
    // Fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
        // Add each row to the orders array
        $orders[] = $row;
    }
    // Free result set
    mysqli_free_result($result);
} else {
    echo "ERROR: Could not execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);

// Return orders as JSON
echo json_encode($orders);
?>
