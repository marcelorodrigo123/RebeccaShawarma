<?php
session_start();

// Database connection
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$database = "your_database";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username and password match
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);
    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: welcome.php"); // Redirect to welcome page after successful login
    } else {
        echo "Invalid username or password.";
    }
}
$conn->close();
?>
