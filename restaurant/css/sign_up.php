<?php
    // MySQL database credentials
    $servername = "localhost";
    $username = "root"; // Replace with your MySQL username
    $password = ""; // Replace with your MySQL password
    $database = "create_db"; // Replace with your MySQL database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Form submission handling
    $response = ""; // Initialize response variable

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['email'];
        $password = $_POST['psw'];

        // Check if username already exists
        $check_query = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($check_query);
        if ($result) {
            if ($result->num_rows > 0) {
                $response = "Username already exists.";
            } else {
                // Insert new user into database
                $insert_query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
                if ($conn->query($insert_query) === TRUE) {
                    $response = "Account created successfully. You can now log in.";
                } else {
                    $response = "Error: " . $insert_query . "<br>" . $conn->error;
                }
            }
        } else {
            $response = "Error: " . $check_query . "<br>" . $conn->error;
        }
    }

    // Close database connection
    $conn->close();

    // Return response
    echo $response;
    ?>