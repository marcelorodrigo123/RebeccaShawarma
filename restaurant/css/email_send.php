<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "hello";

// Decode JSON data from the request body
$data = json_decode(file_get_contents('php://input'), true);

// Check if the JSON data is properly received and contains email and discounts
if ($data === null || !isset($data['email']) || !isset($data['discounts'])) {
    echo json_encode(array('success' => false, 'message' => 'Invalid data received.'));
    exit;
}

$email = $data['email'];
$discounts = $data['discounts'];

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = true;
$message = '';

// Loop through each discount and insert it into the database
foreach ($discounts as $discount) {
    // Insert the email and discount into the database
    $sql = "INSERT INTO discount_avails (email, discount) VALUES ('$email', '$discount')";

    if ($conn->query($sql) !== TRUE) {
        $success = false;
        $message = 'Failed to insert email and discount into the database.';
        break;
    }
}

// Check if insertion was successful
if ($success) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false, 'message' => $message));
}

// Close connection
$conn->close();
?>
