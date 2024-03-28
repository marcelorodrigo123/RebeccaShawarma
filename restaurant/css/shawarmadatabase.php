<?php
// Retrieve data from the database
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', ''); // Update with your MySQL password
define('DB_NAME', 'takeout');

// Attempt to connect to MySQL database
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Query to retrieve data from the orders table
$sql = "SELECT customer_name, order_item, location, quantity, total_amount, date_ordered, time_ordered FROM orders";

$result = mysqli_query($link, $sql);

// Check if the query was successful
if ($result) {
    // Fetch associative array
    $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($orders);
} else {
    // Handle failure
    echo json_encode(array("success" => false, "message" => "Error: Could not retrieve data from the database."));
}

// Close connection
mysqli_close($link);
?>
