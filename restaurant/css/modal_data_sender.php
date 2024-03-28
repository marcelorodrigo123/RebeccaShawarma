<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the necessary data is set
    if (isset($_POST['itemName']) && isset($_POST['quantity']) && isset($_POST['totalPrice']) && isset($_POST['orderType'])) {
        // Retrieve data from the POST request
        $itemName = $_POST['itemName'];
        $quantity = $_POST['quantity'];
        $totalPrice = $_POST['totalPrice'];
        $orderType = $_POST['orderType'];

        // Insert the data into the database or perform other required actions
        // Example: Inserting data into a MySQL database
        $servername = "localhost"; // Change this to your database server
        $username = "root"; // Change this to your database username
        $password = ""; // Change this to your database password
        $dbname = "hello1"; // Change this to your database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL statement to insert data into the database
        $sql = "INSERT INTO orders (itemName, quantity, totalPrice, orderType) VALUES (?, ?, ?, ?)";
        
        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdis", $itemName, $quantity, $totalPrice, $orderType);

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            // Return a success message
            echo "Order placed successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Error: Data not set";
    }
} else {
    echo "Error: Invalid request method";
}
?>
