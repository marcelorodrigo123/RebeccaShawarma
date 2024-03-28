<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "create_db"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form submission handling for Login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if both username and password fields are empty
    if (empty($username) || empty($password)) {
        $_SESSION['error_message'] = "Please enter both username and password.";
        header("Location: login.html");
        exit();
    }

    // Prepare a SQL statement to retrieve user data based on the provided username and password
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Fetch the user's data
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        header("Location: home.html"); // Redirect to welcome page after successful login
        exit(); // Terminate script execution after redirect
    } else {
        // Set error message if username and password combination is incorrect
        $_SESSION['error_message'] = "Invalid username or password.";
        header("Location: login.html"); // Redirect back to login page
        exit(); // Terminate script execution after redirect
    }

    $stmt->close();
}

$conn->close();
?>