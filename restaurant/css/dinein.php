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

// Check if form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare an INSERT statement
    $sql = "INSERT INTO orders (customer_name, order_item, quantity, total_amount, order_date) VALUES (?, ?, ?, ?, NOW())";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssii", $param_customer_name, $param_order_item, $param_quantity, $param_total_amount);

        // Set parameters
        $param_customer_name = $_POST['customer_name'];
        $param_order_item = $_POST['order'];
        $param_quantity = $_POST['quantity'];
        $param_total_amount = $_POST['total_amount'];

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Records inserted successfully
            echo "success";
        } else {
            echo "ERROR: Could not execute query. " . mysqli_error($link);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo "ERROR: Could not prepare query. ";
    }
}

// Close connection
mysqli_close($link);
?>
