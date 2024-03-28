<?php
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

// Check if form data is received
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = $_POST['customer_name'];
    $order = $_POST['order'];
    $location = $_POST['location'];
    $quantity = $_POST['quantity'];
    $total_amount = $_POST['total_amount'];
    $date_ordered = $_POST['date_ordered'];
    $time_ordered = $_POST['time_ordered'];

    // Prepare an insert statement for orders table
    $sql = "INSERT INTO orders (customer_name, order_item, location, quantity, total_amount, date_ordered, time_ordered) VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssssss", $param_customer_name, $param_order, $param_location, $param_quantity, $param_total_amount, $param_date_ordered, $param_time_ordered);

        // Set parameters
        $param_customer_name = $customer_name;
        $param_order = $order;
        $param_location = $location;
        $param_quantity = $quantity;
        $param_total_amount = $total_amount;
        $param_date_ordered = $date_ordered;
        $param_time_ordered = $time_ordered;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Records inserted successfully
            $success_shawarma_db = true;
        } else {
            $success_shawarma_db = false;
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        $success_shawarma_db = false;
    }

    // Send JSON response
    header('Content-Type: application/json');
    if ($success_shawarma_db) {
        echo json_encode(array("success" => true, "message" => "Data added to the database successfully."));
    } else {
        echo json_encode(array("success" => false, "message" => "Error: Could not execute the query."));
    }

} else {
    // If this is not a POST request, return an error response
    header('Content-Type: application/json');
    echo json_encode(array("success" => false, "message" => "Error: Only POST requests are allowed."));
}

// Close connection
mysqli_close($link);
?>
